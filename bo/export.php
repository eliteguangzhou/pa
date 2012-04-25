<?php
/*
  $Id: categories.php 1755 2007-12-21 14:02:36Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2007 osCommerce

  Released under the GNU General Public License
*/

    require('includes/application_top.php');

    $file = '';
    $datas = '';
    $excluded_brand = array('lancome','givenchy','kenzo','guerlain','christian dior');
    if (!empty($_POST['margin'])) {
        $margin = (float) $_POST['margin'];

        if (!empty($margin)) {
            $where = '';
            switch ($_POST['type']) {
                case 'euro' : $where = '(pd.Prix_conseille - pd.Prix_achat)*0.75 > '.$margin;break;
                case 'dollar' : $where = '(pd.Prix_conseille - pd.Prix_achat) > '.$margin;break;
                case 'percent' : $where = '(pd.Prix_achat * '.$margin.' / 100) <= pd.Prix_conseille';break;
            }
            $query = "SELECT p.products_model, pd.products_name, pd.products_description".($_POST['type'] == 'percent' ? ', CONCAT(ROUND(pd.Prix_conseille / pd.Prix_achat * 100), "%") as diff':'').",pd.Prix_achat, pd.Prix_conseille, p.products_price, p.products_status FROM ".TABLE_PRODUCTS." p, ".TABLE_PRODUCTS_DESCRIPTION." pd WHERE pd.language_id = 5 AND p.products_id = pd.products_id AND ".$where;
            $query = tep_db_query($query);
            $datas = "Modèle\tNom\tDescription\t".($_POST['type'] == 'percent' ? "Marge\t" : '')."Prix Achat\tPrix Conseillé\tPrix Vente\tStatut";
            while ($data = tep_db_fetch_array($query)) {
                $datas .= "\n\r".join("\t", $data);
            }
            
            $file = 'export_datas.xls';
        }
    }
    elseif (isset($_POST['export_products'])) {
        $fields = array ('p.products_id','products_quantity','products_model','products_price','products_status','products_ordered','products_name','products_description','products_viewed','Brand','Gender','Gamme','Prix_achat','Item_size','Prix_conseille','Type');
        $query = tep_db_query("
            SELECT ".join(',', $fields)."
            FROM `products` p, products_description pd
            WHERE pd.products_id = p.products_id
            and pd.language_id = 5
            and pd.Brand NOT IN ('".join("','", $excluded_brand)."')");
        $datas = join(';', $fields);
        while ($data = tep_db_fetch_array($query)) {
            $data['Item_size'] = str_replace(chr(13), '', $data['Item_size']);
            $datas .= "\r\n".join(';', $data);
        }
        $file = 'export_products.csv';
    }
    elseif (isset($_POST['export_customers'])) {
        $fields = array ('c.customers_firstname', 'c.customers_lastname', 'c.customers_email_address');
        $query = tep_db_query("SELECT ".join(',', $fields)." FROM customers c LEFT JOIN orders o ON c.customers_id = o.customers_id WHERE c.customers_id > 6 GROUP BY c.customers_id HAVING count(o.orders_id) = 0");
        $datas = join(';', $fields);
        while ($data = tep_db_fetch_array($query))
            $datas .= "\r\n".join(';', $data);
        $file = 'export_customers.csv';
    }
    
    if (isset($_POST) && !empty($file) && !empty($datas)) {
        file_put_contents($file, $datas);
        header('Content-disposition: attachment; filename="' . $file . '"');
        header('Content-Type: application/force-download');
        header('Content-Transfer-Encoding: binary');
        header('Content-Length: '. filesize($file));
        header('Pragma: no-cache');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Expires: 0');
        readfile($file);die;
    }
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
</head>
<body>
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<table border="0" width="100%" cellspacing="2" cellpadding="2">
    <tr>
        <td width="<?php echo BOX_WIDTH; ?>" valign="top">
            <table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="1" cellpadding="1" class="columnLeft">
                <?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
            </table>
        </td>
        <td width="100%" valign="top">
            <table border="0" width="100%" cellspacing="0" cellpadding="2">
                <tr>
                    <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
                </tr>
                <tr>
                    <td>
                        <?php echo EXPORT_INTRO_MARGIN;?><br />
                        <?php echo tep_draw_form('export_margin', FILENAME_EXPORT); ?>
                            <input type="text" name="margin" />
                            <select name="type" />
                                <option value="euro"><?php echo EXPORT_EURO;?></option>
                                <option value="dollar"><?php echo EXPORT_DOLLAR;?></option>
                                <option value="percent"><?php echo EXPORT_PERCENT;?></option>
                            </select>
                            <input type="submit" value="Exporter" />
                        </form>
                    </td>
                </tr>
                <tr style="height:20px;"><td></td></tr>
                <tr>
                    <td>
                        <?php echo EXPORT_INTRO_PRODUCTS;?>(<i><?php echo EXPORT_EXCLUDED_BRAND.join(', ', $excluded_brand);?></i>)<br />
                        <?php echo tep_draw_form('export_products', FILENAME_EXPORT); ?>
                            <input type="submit" name="export_products" value="Exporter" />
                        </form>
                    </td>
                </tr>
                <tr style="height:20px;"><td></td></tr>
                <tr>
                    <td>
                        <?php echo EXPORT_INTRO_CUSTOMERS;?><br />
                        <?php echo tep_draw_form('export_customers', FILENAME_EXPORT); ?>
                            <input type="submit" name="export_customers" value="Exporter" />
                        </form>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<br>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
