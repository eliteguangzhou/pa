<?php

//if (!empty($_POST) && $_POST['log23'] = 'admin' && $_POST['pass97'] == 'CurL2010') {
    require('includes/application_top.php');

    $excluded_brand = array('lancome','givenchy','kenzo','guerlain','christian dior','hermes','shiseido', 'chanel');
    $str = '';
    foreach ($excluded_brand as $r)
        $str .= " manufacturers_name LIKE '%".$r."%' OR";

    $str = substr($str,0 , -3);

    //Correction des prix dans la table specials s'ils ont change
    $query = tep_db_query("UPDATE specials s, products p set s.specials_new_products_price = p.products_price where s.products_id = p.products_id");

    //Suppression des produits prevus en rupture de stock
    $query = tep_db_query("select DISTINCT(products_id) as id FROM products p, manufacturers m where m.manufacturers_id = p.manufacturers_id and (".$str.")");
    delete_ids($query, 0);
    $query = tep_db_query("DELETE FROM manufacturers where ".$str);
    echo "Produits prevus en rupture de stock supprimes !<br />";
	/*
    $where = 'categories_id NOT IN (27, 28, 30, 38, 49, 50, 39)';
    $query = tep_db_query("DELETE p FROM `products` p, `products_to_categories` p2c WHERE p2c.products_id = p.products_id AND p2c.".$where);
    $query = tep_db_query("DELETE FROM `products_to_categories` WHERE ".$where);
    $query = tep_db_query("DELETE FROM `categories` WHERE ".$where);
    $query = tep_db_query("DELETE FROM `categories_description` WHERE ".$where);*/
	
    //***************************************
    //CSV SHOPPING.COM
    //***************************************
    $fields = array (
        'MPN' => 'products_model',
        'Marque / Fabriquant' => 'm.manufacturers_name as manufacturer',
        'EAN / UPC' => 'products_model as model',
        'Référence Interne' => 'products_model as intern',
        'Nom du produit' => 'CONCAT(products_name, " - ", products_description) as products_name',
        'Description du produit' => 'products_description',
        'Prix actuel' => 'products_price',
        
        'Expedition standard' => "'15'",
        'Disponibilité' => 'IF(products_status, "O", "N") as products_status',
        'Description de la disponibilité + garantie' => "'Livraison sous 8 à 12 jours ouvrables'",
        'URL produit' => "CONCAT('http://www.parfumrama.com/product_info.php?products_id=', p.products_id)",
        'URL image' => "CONCAT('http://www.parfumwholesale.com/images/', products_image)",
        'Catégorie' => 'p.type as cat',
        'Type' => 'p.type as Type',
        'Sexe' => 'p.gender as Gender',
 	   'Prix d\'origine' => 'products_price',
    );

    $cat = array(
        'Shampoo' => 'Santé et beauté > Parfum',
        'Conditioner' => 'Santé et beauté > Parfum',
        'Fragrances' => 'Santé et beauté > Parfum',
        'Bath & Body' => 'Santé et beauté > Parfum',
        'Gift Sets' => 'Santé et beauté > Parfum',
        'Gift Set' => 'Santé et beauté > Parfum'
    );

    $type = array(
        'Shampoo' => 'Shampooings',
        'Conditioner' => 'Conditionneur',
        'Fragrances' => 'Parfum',
        'Bath & Body' => 'Bain et corps',
        'Gift Sets' => 'Coffret',
        'Gift Set' => 'Coffret'
    );

    $query = tep_db_query("
        SELECT ".join(',', $fields).",products_tax_class_id, buy_price
        FROM `products` p, products_description pd, manufacturers m
        WHERE pd.products_id = p.products_id
        and m.manufacturers_id = p.manufacturers_id
        and pd.language_id = 5
        and p.products_status = 1
        and p.products_quantity > 0
		and p.type in ('Fragrances', 'Gift Sets', 'Gift Set')");
		
    $datas = join('|', array_keys($fields));
    while ($data = tep_db_fetch_array($query)) {
        $data['products_price'] = round($currencies->currencies[$currency]['value']*$data['products_price']*100)/100;
        $data['products_price_r'] = substr($currencies->display_price(get_reduced_price($data['buy_price']), tep_get_tax_rate($data['products_tax_class_id'])),0,-3);
		unset($data['buy_price']);
		unset($data['products_tax_class_id']);
        $data['cat'] = $cat[$data['cat']];
        $data['Type'] = $type[$data['Type']];
        $datas .= "\r\n".join('|', $data);
        if (strpos($data['products_description'], 'vaporisateur') !== false) {
          $data['products_name'] = str_replace('vaporisateur', 'spray', $data['products_name']);
          $data['products_description'] = str_replace('vaporisateur', 'spray', $data['products_description']);
          $data['model'] = $data['model'] . '1';
          $data['intern'] = $data['intern'] . '1';
          $data['products_model'] = $data['products_model'] . '1';
          $datas .= "\r\n".join('|', $data);
        }
        elseif (strpos($data['products_description'], 'Vaporisateur') !== false) {
          $data['products_name'] = str_replace('Vaporisateur', 'Spray', $data['products_name']);
          $data['products_description'] = str_replace('Vaporisateur', 'Spray', $data['products_description']);
          $data['model'] = $data['model'] . '1';
          $data['intern'] = $data['intern'] . '1';
          $data['products_model'] = $data['products_model'] . '1';
          $datas .= "\r\n".join('|', $data);
        }
    }
    $file = 'download/csv/shopping_fr.csv';
    if (file_put_contents($file, $datas)) echo 'CSV fr.Shopping.com mis a jour <br />';
    else echo '<div style="color:red;">Probleme maj CSV fr.Shopping.com</div><br />';

    //***************************************
    //CSV SHOPZILLA.com
    //***************************************
    $fields = array (
        'Catégorie' => 'p.type as Type',
        'Fabriquant' => 'm.manufacturers_name as manufacturer',
        'Titre' => 'CONCAT(products_name, " - ", products_description) as products_name',
        'Desc' => 'products_description',
        'Lien' => "CONCAT('http://www.parfumrama.com/product_info.php?products_id=', p.products_id)",
        'Image' => "CONCAT('http://www.parfumwholesale.com/images/', products_image)",
        'SKU' => 'products_model',
        'Stock' => 'products_quantity',
        'Condition' => "'' as cond",
        'Poids' => "'' as poids",
        'Frais de Livraison' => "'15' as frais",
        'Enchére' => "'' as enchere",
        'Promo' => "'' as promo",
        'EAN/UPC' => 'products_model as upc',
        'Prix' => 'products_price',
    	'Prix Barrés' => 'products_price'
    );

    $type = array(
        'Shampoo' =>  	'14.560',
        'Conditioner' => '14.570',
        'Fragrances' => '14.539',
        'Bath & Body' => '14.570',
        'Gift Sets' => '15.289',
        'Gift Set' => '15.289'
    );

    $query = tep_db_query("
        SELECT ".join(',', $fields)."
        FROM `products` p, products_description pd, products_to_categories ptc, manufacturers m
        WHERE pd.products_id = p.products_id
        and m.manufacturers_id = p.manufacturers_id
        and pd.language_id = 5
        and p.products_status = 1
        and p.products_quantity > 0
        and ptc.products_id = p.products_id
        and ptc.categories_id != 35
		and p.type in ('Fragrances', 'Gift Sets', 'Gift Set')");

    $datas = join(chr(9), array_keys($fields));
    while ($data = tep_db_fetch_array($query)) {
        $data['products_price'] = round($currencies->currencies[$currency]['value']*$data['products_price']*100)/100;
        $data['Type'] = $type[$data['Type']]; 
        $datas .= "\r\n".join(chr(9), $data);
        $data['products_price_r'] = substr($currencies->display_price(get_reduced_price($data['buy_price']), tep_get_tax_rate($data['products_tax_class_id'])),0,-3);
		
        if (strpos($data['products_description'], 'vaporisateur') !== false) {
          $data['products_description'] = str_replace('vaporisateur', 'spray', $data['products_description']);
          $data['products_name'] = str_replace('vaporisateur', 'spray', $data['products_name']);
          $data['upc'] = $data['upc'] . '1';
          $data['products_model'] = $data['products_model'] . '1';
          $datas .= "\r\n".join(chr(9), $data);
        }
        elseif (strpos($data['products_description'], 'Vaporisateur') !== false) {
          $data['products_description'] = str_replace('Vaporisateur', 'Spray', $data['products_description']);
          $data['products_name'] = str_replace('Vaporisateur', 'Spray', $data['products_name']);
          $data['upc'] = $data['upc'] . '1';
          $data['products_model'] = $data['products_model'] . '1';
          $datas .= "\r\n".join(chr(9), $data);
        }
        
    }
    $file = 'download/csv/shopzilla.csv';
    if (file_put_contents($file, $datas)) echo 'CSV Shopzilla.com mis a jour <br />';
    else echo '<div style="color:red;">Probleme maj CSV Shopzilla.com</div><br />';
	
    /**********************
     *   Netaffiliation   *
     **********************/

    $fields = array (
        'p.products_id',
        'products_quantity',
        'products_model',
        'products_price',
        'products_status',
        'products_ordered',
        'products_name',
        'products_description',
        'products_viewed',
        'm.manufacturers_name as marque',
        'p.gender as Gender',
        'p.gamme',
        'p.item_size',
        'p.type as Type',
        'products_image',
        'pd.products_id',
        'products_model as EAN',
        '14 as frais_port',
    );

    $query = tep_db_query("
        SELECT ".str_replace('products_name', 'CONCAT(products_name, " ", products_model)',
                str_replace('products_image', "CONCAT('http://www.parfumwholesale.com/images/', products_image)",
                str_replace('pd.products_id', "CONCAT('http://www.parfumrama.com/product_info.php?products_id=', pd.products_id)",
                join(',', $fields))))."
        FROM `products` p, products_description pd, manufacturers m
        WHERE pd.products_id = p.products_id
        and pd.language_id = 5
        and p.products_status = 1
        and p.products_quantity > 0
        and m.manufacturers_id = p.manufacturers_id
		and p.type in ('Fragrances', 'Gift Sets', 'Gift Set')");
    $datas = '"'.str_replace('products_model as EAN', 'EAN', str_replace('14 as frais_port', 'frais_port', join('";"', $fields))).'"';
    while ($data = tep_db_fetch_array($query)) {
        $data['products_price'] = round($currencies->currencies[$currency]['value']*$data['products_price']*100)/100;
        $data['item_size'] = str_replace(chr(13), '', $data['item_size']);
        $datas .= "\r\n".'"'.join('";"', $data).'"';
		
        if (stripos($data['products_description'], 'vaporisateur') !== false) {
          $data['CONCAT(products_name, " ", products_model)'] = str_ireplace('vaporisateur', 'spray', $data['CONCAT(products_name, " ", products_model)']) . '1';
          $data['products_description'] = str_ireplace('vaporisateur', 'spray', $data['products_description']);
          $data['products_model'] = $data['products_model'] . '1';
          $data['EAN'] = $data['EAN'] . '1';
          $data['products_id'] = $data['products_id'] . '1';
          $datas .= "\r\n".'"'.join('";"', $data).'"';
        }
    }
    $file = 'download/csv/netaffiliation.csv';
    $datas = utf8_encode($datas);
    file_put_contents($file, $datas);
    echo 'CSV Netaffiliation mis a jour <br />';
//}

 //************//
 //==Google****//
 //************//
     $fields = array (
        'p.products_id',
	'p.products_status',
        'products_model',
        'products_price',
        'products_status',
        'products_ordered',
        'products_description',
        'products_image',
        'pd.products_id',
        
    );

    $query = tep_db_query("
SELECT p.products_id, p.products_model, p.products_status, products_price, pd.products_description, pd.products_name, products_image, pd.language_id
FROM  `products` p, products_description pd
WHERE pd.products_id = p.products_id
AND products_status =1
AND products_quantity >0
and pd.language_id = 6");
    $datas = "id\ttitle\tlink\tprice\tdescription\tcondition\timage_link\tshipping\tavailability";
    while ($data = tep_db_fetch_array($query)) {
	$data['products_price'] = round($currencies->currencies[$currency]['value']*$data['products_price']*100)/100;
        $datas .= "\r\n\"".$data['products_id']."\"\t\"".$data['products_name']."\"\t\"http://www.perfumeslovers.com/product_info.php?products_id=".$data['products_id']."\"\t\"".$data['products_price']." \"\t\" ".$data['products_description']."\"\t\"new\"\t\"http://www.parfumwholesale.com/images/".$data['products_image']."\"\t\":::7 EUR\" \t \"in stock\"";
	
        // echo utf8_encode($data['products_description']);
    }
    $file = 'download/csv/google.csv';
    $datas = utf8_encode($datas);
    file_put_contents($file, $datas);
    echo 'CSV Google mis a jour <br />';

    echo "<br />Mise a jour terminee !";
 
 
 
 
 
 
function delete_ids($query, $j) {
    $i = 0;
    $delete_list = array();
    while ($list = tep_db_fetch_array($query))
    {
        $delete_list[] = $list['id'];

        if ($i++ == 100){
            delete($delete_list);
            echo "Centaine " . $j++ . "<br />";
            $i = 0;
            $delete_list = array();
        }

    }

    if ($i != 0 && !empty($delete_list))
        delete($delete_list);
}

function delete($ids){

    $tables = array(
        'products',
        'products_to_categories',
        'products_attributes',
        'products_description',
        'products_notifications'
    );

    foreach ($tables as $table)
        $query = tep_db_query("DELETE FROM " . $table . " where products_id IN  (" . join(',', $ids) . ")");
}
?>