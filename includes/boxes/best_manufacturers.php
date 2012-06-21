<tr><td>
<?php

$lettre="A";
if (isset($HTTP_GET_VARS['letter']))
  $lettre = $HTTP_GET_VARS['letter'];

$info_box_contents = array();
  
//si il n y a pas de categoriees selectionnnees
if (empty($current_category_id)){
    $cat_name = '';
	$best_sellers_query = tep_db_query("SELECT
                    m.manufacturers_name, m.manufacturers_id
                    FROM products p, `statique_best_seller` sbs
                    INNER JOIN manufacturers m ON (sbs.marque = m.manufacturers_name and m.manufacturers_name NOT IN ('Chanel', 'Christian Dior'))
                    where sbs.type='marque'
                    and p.manufacturers_id = m.manufacturers_id
                    and p.products_status != 0
                    group by m.manufacturers_name
                    having COUNT(p.products_id) > 0
                    LIMIT 0 , 30");
    
    $newResult = array();
  while($item = tep_db_fetch_array( $best_sellers_query))      
        $newResult[$item['manufacturers_name']] = $item['manufacturers_id'];
asort($newResult);
        
  $str = '<ul>';
	foreach ($newResult as $name => $id)
    $str .= '<li class="bg_list"><a href="'.tep_href_link(FILENAME_DEFAULT, 'manufacturers_id='.$id.'&name='.$name).'">'.$name.'</a>';
  $str .= '</ul>';
  
  $info_box_contents[] = array('text' => meilleurs_marques);
  new infoBoxHeading($info_box_contents, false, false);

  $info_box_contents = array();
  $info_box_contents[] = array('text' => $str);
  new infoBox($info_box_contents);
}
else {
 $cat_name = '';
  $str = '';
  for ($i = ord("A"), $j = 0; $i <= ord("Z"); $i++, $j++) {
    if($j % 8 == 0)
      $str .= '<br>';
    $str .= '<a class="letters" href="'.tep_href_link('index.php', 'cPath='.$current_category_id.'&letter='.chr($i).'&name='.$cat_name).'"> &nbsp '.chr($i).'</a> ';
  }

  $sql='SELECT DISTINCT
    m.manufacturers_name,
    m.manufacturers_id
  FROM manufacturers m, products p, products_to_categories p2c
  WHERE p.manufacturers_id = m.manufacturers_id
  AND p2c.categories_id ='. $current_category_id .'
  AND p.products_id = p2c.products_id
  and m.manufacturers_name like \''.$lettre.'%\'
  GROUP BY p.manufacturers_id
  HAVING SUM(p.products_quantity) > 2
  ORDER BY m.manufacturers_name';

  $products_query = tep_db_query($sql);

  $str .= '<ul>';
  $cat_name ='';
  while($products = tep_db_fetch_array($products_query))
  	$str .= '<li class="bg_list"> <a  href="'.tep_href_link('index.php', 'cPath='.$current_category_id.'&filter_id='.$products['manufacturers_id'].'&name='.$cat_name.'&name1='.$products['manufacturers_name']).'">'.$products['manufacturers_name'].'</a>';
  $str .= '</ul>';
/*
  $best_sellers_query = tep_db_query("select distinct p.products_id, pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_CATEGORIES . " c where p.products_status = '1' and p.products_ordered > 0 and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' and p.products_id = p2c.products_id and p2c.categories_id = c.categories_id and '" . (int)$current_category_id . "' in (c.categories_id, c.parent_id) order by p.products_ordered desc, pd.products_name limit 5");

  $str .= '<ul>';
  while($products = tep_db_fetch_array($best_sellers_query))
    $str .= '<li class="bg_list"><a  href="index.php?manufacturers_id='.$products['products_id'].'">'.$products['products_name'].'</a></li>';
  $str .= '</ul>';
*/
  $info_box_contents[] = array('text' => Nos_marques);
  new infoBoxHeading($info_box_contents, false, false);
  
  $info_box_contents = array();
  $info_box_contents[] = array('text' => $str);
  new infoBox($info_box_contents);
}
?>
</td></tr>