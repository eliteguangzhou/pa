<?php

class Sponsorship {

    var $godfather, $godchildren;

    function check($email, $key){
        $query = tep_db_query("
            select
                customers_firstname,
                customers_lastname,
                customers_email_address
            from " . TABLE_CUSTOMERS . " c, ".TABLE_SPONSORSHIP." s
            where s.customers_id = c.customers_id
            and   s.email = '".$_GET['email']."'
            and   s.unlock_key = '".strip_tags($_GET['key'])."'");
        $this->godfather = tep_db_fetch_array($query);
        return !empty($this->godfather['customers_firstname']);
    }

    function update($email, $key){
        tep_db_query("update " . TABLE_SPONSORSHIP . " set subscribed = 1 where email = '" . $email . "' and unlock_key = '" . $key . "'");
    }

    function generate_discount($code, $amount, $email, $expiration, $order_id = 0, $is_sponsorship = 1){
        $sql_data_array = array('orders_id_issued' => $order_id,
                              'code'             => $code,
                              'discount'         => $amount,
                              'type'             => 'm',
                              'enddate'          => $expiration,
                              'email'            => $email,
                              'sponsorship'      => $is_sponsorship,
                              'generated_by'     => $is_sponsorship ? 'sponsorship' : 'friend',
                              'creation_date'    => date('Y-m-d H:i:s'));

        tep_db_perform(TABLE_COUPONS, $sql_data_array, 'insert');
    }

    function get_infos($email) {
        $query = tep_db_query("
            select
                COUNT(o.orders_id) as total_gc_orders,
                gf.customers_email_address as gf_email1,
                gf_rank2.customers_email_address as gf_email2,
                gf_rank3.customers_email_address as gf_email3
            from (" . TABLE_CUSTOMERS . " gf, ".TABLE_SPONSORSHIP." s, " . TABLE_CUSTOMERS . " gc)
            left join ".TABLE_ORDERS." o on
                o.customers_id = gc.customers_id
            left join " . TABLE_SPONSORSHIP . " s_rank2 on (
                s_rank2.email = gf.customers_email_address
                and s_rank2.subscribed = 1
            )
            left join " . TABLE_CUSTOMERS . " gf_rank2 on
                s_rank2.customers_id = gf_rank2.customers_id
            left join " . TABLE_SPONSORSHIP . " s_rank3 on (
                s_rank3.email = gf_rank2.customers_email_address
                and s_rank3.subscribed = 1
            )
            left join " . TABLE_CUSTOMERS . " gf_rank3 on
                s_rank3.customers_id = gf_rank3.customers_id
            where s.customers_id = gf.customers_id
            and   gc.customers_email_address = s.email
            and   s.subscribed = 1
            and   s.email = '".$email."'
            group by gc.customers_id");
        $infos = tep_db_fetch_array($query);

        if (empty($infos) || SPONSORSHIP_MAX_ORDER > 0 && $infos['total_gc_orders'] > SPONSORSHIP_MAX_ORDER)
            return false;

        return $infos;
    }

    function check_new_discounts($customer_email) {
        $query = tep_db_query("
            select COUNT(id) as total
            from " . TABLE_COUPONS . "
            where email = '".$customer_email."'
            and   viewed = 0
            and used = 0
            and (enddate >= CURDATE() OR enddate IS NULL)");
        $total = tep_db_fetch_array($query);
        return $total['total'];
    }

    function update_view($customer_email) {
        $query = tep_db_query("
            UPDATE " . TABLE_COUPONS . "
            SET viewed = 1
            where email = '".$customer_email."'
            and   viewed = 0");
        return true;
    }
}
?>