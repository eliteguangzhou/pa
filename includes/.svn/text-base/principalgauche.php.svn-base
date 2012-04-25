<?php

function bestmarque($current_category_id,$lettre){ 
if (empty($current_category_id)){

				//si il n y a pas de categoriees selectionnnees

				debuttableau(meilleurs_marques);
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
									

				echo '<td class="box_body box_body_td"><ul>';								
				while($products = tep_db_fetch_array( $best_sellers_query)) 
   					 {
					 echo '<li class="box_body bg_list"><a  href="'.tep_href_link(FILENAME_DEFAULT, 'manufacturers_id='.$products['manufacturers_id']).'">'.$products['manufacturers_name'].'</a>';
 
					}

			echo '</ul></td>';	
			fintableau();	


}else{

		//si il y a un categorie selectionnee
		
											

		pavegauche($current_category_id,$lettre);
}

}


//-----------------------------------------------------------------------------------------
function pavegauche($current_category_id,$lettre) {

global $languages_id;
$i = 0;


debuttableau(Nos_marques);

 //--------------------Affichage best sellers
 /*
 $best_sellers_query = tep_db_query("select distinct p.products_id, pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_CATEGORIES . " c where p.products_status = '1' and p.products_ordered > 0 and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' and p.products_id = p2c.products_id and p2c.categories_id = c.categories_id and '" . (int)$current_category_id . "' in (c.categories_id, c.parent_id) order by p.products_ordered desc, pd.products_name limit 5");
										

while($products = tep_db_fetch_array( $best_sellers_query)) 
   					 {
					 echo '<li class="box_body bg_list"><a  href="index.php?manufacturers_id='.$products['products_id'].'">'.$products['products_name'].'</a></li>';
 
 }*/
  //--------------------fin  Affichage best sellers
 
//---------------Affichage du pave
$tableaulettre = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");


for ($i=0; $i<26 ; $i++){ 
if($i %8 <> 0 )  
echo '<a class="letters" href="index.php?cPath='.$current_category_id.'&letter='.$tableaulettre[$i].'"> &nbsp '.$tableaulettre[$i].' </a> ';
else  echo ' <br> <a class="letters" href="index.php?cPath='.$current_category_id.'&letter='.$tableaulettre[$i].'"> &nbsp '.$tableaulettre[$i].' </a> ';
}
//---------------Fin Affichage du pave	



//---------------Affichage des lettres	
$sql='SELECT DISTINCT manufacturers.manufacturers_name, manufacturers.manufacturers_id FROM manufacturers INNER JOIN products ON products.manufacturers_id = manufacturers.manufacturers_id INNER JOIN products_to_categories ON products.products_id = products_to_categories.products_id
WHERE products_to_categories.categories_id ='. $current_category_id .' and manufacturers.manufacturers_name like \''.$lettre.'%\' and products.products_status != 0 ORDER BY manufacturers_name';


$products_query = tep_db_query($sql);
												

//echo '<tr>'; 
echo '<td class="box_body box_body_td"><ul>';
while($products = tep_db_fetch_array($products_query)) 
   					 {

	echo '<li class="box_body bg_list"> <a  href="index.php?filter_id='.$products['manufacturers_id'].'&cPath='.$current_category_id.'">'.$products['manufacturers_name'].'</a>';	
	
	

}
echo '</ul></td>'; 
fintableau();
//fin Affichage des lettres	
}
//------------------------------------------------------------

function debuttableau($titre)
{

echo '<table border="0" width="100%" cellspacing="0" cellpadding="0"  class="box_heading_table_2">
  <tr>
    <td></td>
    <td  style="width:100%;" class="box_heading_td_2">'.$titre.'</td>
    <td></td>
  </tr>
</table>
';	

echo '<table border="0" width="200" cellspacing="0" cellpadding="0">
  <tr>
    <td >';
echo '<table border="0" width="100%" cellspacing="0" cellpadding="0"  style="margin-bottom:10px;" class="box_body_table">';	

} 

function fintableau()
{

echo '<tr><td><img src="images/line.gif" border="0" alt=""></td></tr>';
echo '</table>
<tr><td>
<table border="0" width="100%" cellspacing="0" cellpadding="0"  style="margin-bottom:10px;" class="box_body_table">
</td></tr>

  </td>
    </tr></table>
';
}
function statiquebestproducts($current_category_id)
{
$usage="";
$titrepave="";

switch ($current_category_id) {
case 31:
    $usage="besther";
	$titrepave=Our_Best_P_Her;
    break;
case 32:
    $usage="besther";
	$titrepave=Our_Best_P_Her;
    break;
case 47:
    $usage="besthim";
	$titrepave=Our_Best_P_Him;
    break;
case 48:
    $usage="besther";
	$titrepave=Our_Best_P_Her;
    break;
case 33:
    $usage="bestskincare";
	$titrepave=Skin_Care;
	break;
case 34:
    $usage="besthim";
	$titrepave=Our_Best_P_Him;
    break;
case 35:
    $usage="besther";
	$titrepave=Our_Best_P_Her;
    break;
case 36:
    $usage="bestskincare";
	$titrepave=Skin_Care;
	break;
case 37:
    $usage="besther";
	$titrepave=Our_Best_P_Her;
    break;
case 38:
    $usage="besther";
	$titrepave=Our_Best_P_Her;
    break;
case 28:
    $usage="besther";
	$titrepave=Our_Best_P_Her;
    break;
case 27:
    $usage="besthim";
	$titrepave=Our_Best_P_Him;
    break;
case 30:
    $usage="besther";
	$titrepave=Our_Best_P_Her;
    break;
case 39:
    $usage="bestgifsetw";
	$titrepave=Nos_meilleurs_coffrets_w;
    break;
case 49:
    $usage="bestgifsetw";
	$titrepave=Nos_meilleurs_coffrets_w;
    break;
case 50:
    $usage="bestgifsetm";
	$titrepave=Nos_meilleurs_coffrets_m;
    break;
case 40:
    $usage="bestskincare";
	$titrepave=Skin_Care;
	break;
case 53:
    $usage="besther";
	$titrepave=Our_Best_P_Her;
    break;
	
	
}
if (!empty($usage)){
debuttableau($titrepave);
global $languages_id;
				$best_sellers_query = tep_db_query("SELECT distinct products_description.products_name, products_description.products_id FROM `statique_best_seller` inner join products  ON products.products_model = statique_best_seller.codep  INNER JOIN products_description on (products_description.products_id=products.products_id AND products_description.language_id = ".(int)$languages_id.") where statique_best_seller.usage like '".$usage."' order by ordre LIMIT 0 , 30");
									

				echo '<td class="box_body box_body_td"><ul>';								
				while($products = tep_db_fetch_array( $best_sellers_query)) 
   					 {
					 echo '<li class="box_body bg_list"><a  href="product_info.php?cPath='.$current_category_id.'&products_id='.$products['products_id'].'">'.$products['products_name'].'</a>';
					 
 
					}

			echo '</ul></td>';	
			fintableau();

}

}

?>