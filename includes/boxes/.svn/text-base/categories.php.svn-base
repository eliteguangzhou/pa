<?php
/*
  $Id: categories.php,v 1.25 2003/07/09 01:13:58 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  function tep_show_category($counter, $count) {
       global $tree, $categories_string, $cPath_array, $ii;

if ($count == 0 ) $kk=' class="bg_list"'; else $kk=' class="bg_list"'; 
 							
 $count++;
 
 if(!$tree[$counter]['level']){ 
 $categories_string .= $categories_string ? '' : ''; 
 $categories_string .= '<li'.$kk.'><a href=';

if (SHOW_COUNTS == 'true') {
      $products_in_category = tep_count_products_in_category($counter);
      if ($products_in_category > 0) {
        $num_prod =  '&nbsp;('.$products_in_category.')';
		 
      }
    }

 if ($tree[$counter]['parent'] == 0) {
 $cPath_new = 'cPath=' . $counter;
 } else {
 $cPath_new = 'cPath=' . $tree[$counter]['path'];
 }
 $categories_string .= tep_href_link('index.php', $cPath_new) . '>';
  
// display categry name

if ($tree[$counter]['name']=='Fragrances'){
	$categories_string .= '<span class="fragrance"><b>'.$tree[$counter]['name'].'</b></span>';
}else{
    $categories_string .= $tree[$counter]['name'];
	}
    $categories_string .= '</a></li>';
	//$categories_string .= $num_prod.'</a></li>';
   
   }else{
   
     // SUBCATEGORY
if (SHOW_COUNTS == 'true') {
      $products_in_category = tep_count_products_in_category($counter);
      if ($products_in_category > 0) {
        $num_prod =  '&nbsp;('.$products_in_category.')';
      }
    }	 
    $count = 2;
    $categories_string .= '';
	
	
    $categories_string .= '<li class="bg_list_sub">';  
	 
    for($i=0;$i<$tree[$counter]['level'];$i++)
     $categories_string .= '&nbsp;&nbsp;&nbsp;';
    
    $categories_string .= '<a href=';   
    if ($tree[$counter]['parent'] == 0) {
      $cPath_new = 'cPath=' . $counter;
    } else {
      $cPath_new = 'cPath=' . $tree[$counter]['path'];
    }
    $categories_string .= tep_href_link('index.php', $cPath_new) . '>';
// display category name
    $categories_string .= $tree[$counter]['name'];
	 $categories_string .= '</a></li>';
 //   $categories_string .= $num_prod.'</a></li>';
     }
   
	
	
    if ($tree[$counter]['next_id'] != false && $ii < 30) {
      tep_show_category($tree[$counter]['next_id'], $count);
    }  
  }
?>
<!-- categories //-->
          <tr>
            <td>
<?php
  $info_box_contents = array();
  $info_box_contents[] = array('text' => BOX_HEADING_CATEGORIES);

  new infoBoxHeading2($info_box_contents, true, false);

  $categories_string = '<ul>';
  $tree = array();

  $categories_query = tep_db_query("select c.categories_id, cd.categories_name, c.parent_id from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.parent_id = '0' and c.categories_id = cd.categories_id and cd.language_id='" . (int)$languages_id ."' order by sort_order, cd.categories_name");
  while ($categories = tep_db_fetch_array($categories_query))  {
    $tree[$categories['categories_id']] = array('name' => $categories['categories_name'],
                                                'parent' => $categories['parent_id'],
                                                'level' => 0,
                                                'path' => $categories['categories_id'],
                                                'next_id' => false);

    if (isset($parent_id)) {
      $tree[$parent_id]['next_id'] = $categories['categories_id'];
    }

    $parent_id = $categories['categories_id'];

    if (!isset($first_element)) {
      $first_element = $categories['categories_id'];
    }
  }

  //------------------------
if (empty($cPath)){$cPath='38';
$cPath_array = tep_parse_category_path($cPath);
}

  if (tep_not_null($cPath)) {
    $new_path = '';
    reset($cPath_array);
    while (list($key, $value) = each($cPath_array)) {
      unset($parent_id);
      unset($first_id);
      $categories_query = tep_db_query("select c.categories_id, cd.categories_name, c.parent_id from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.parent_id = '" . (int)$value . "' and c.categories_id = cd.categories_id and cd.language_id='" . (int)$languages_id ."' order by sort_order, cd.categories_name");
      if (tep_db_num_rows($categories_query)) {
        $new_path .= $value;
        while ($row = tep_db_fetch_array($categories_query)) {
          $tree[$row['categories_id']] = array('name' => $row['categories_name'],
                                               'parent' => $row['parent_id'],
                                               'level' => $key+1,
                                               'path' => $new_path . '_' . $row['categories_id'],
                                               'next_id' => false);

          if (isset($parent_id)) {
            $tree[$parent_id]['next_id'] = $row['categories_id'];
          }

          $parent_id = $row['categories_id'];

          if (!isset($first_id)) {
            $first_id = $row['categories_id'];
          }

          $last_id = $row['categories_id'];
        }
        $tree[$last_id]['next_id'] = $tree[$value]['next_id'];
        $tree[$value]['next_id'] = $first_id;
        $new_path .= '_';
      } else {
        break;
      }
    }
  }
  $count = 0;
  tep_show_category($first_element, $count); 
  $categories_string .='</ul>';
  $info_box_contents = array();
  $info_box_contents[] = array('text' => $categories_string);

  new infoBox($info_box_contents);
?>
            </td>
          </tr>
<!-- categories_eof //-->
