<?php
class friendDiscount {
    function get($order_id) {
        $friend_emails = array();
        $query = tep_db_query('SELECT email FROM '.TABLE_COUPONS.' WHERE orders_id_issued = '.$order_id.' and sponsorship = 0');
        while ($data = tep_db_fetch_array($query))
            $friend_emails[] = $data['email'];

        return $friend_emails;
    }

    function check_max($friend_emails) {
        return count($friend_emails) >= 3;
    }

    function check_reach($friend_emails, $new_friends = array()) {
        return (count($friend_emails) + count($new_friends)) > 3;
    }

    function check_valid($order_id, $customer_id) {
        $query = tep_db_query('SELECT orders_id FROM '.TABLE_ORDERS.' WHERE orders_id = '.$order_id.' and customers_id = '.$customer_id.' and date_purchased >= "2009-12-01 00:00:00"');
        $data = tep_db_fetch_array($query);
        return empty($data['orders_id']);
    }

    function track_friend($email, $customer_id, $order_id) {
        tep_db_query('INSERT INTO '.TABLE_CUSTOMERS_FRIENDS.' SET orders_id = '.$order_id.',customers_id = '.$customer_id.', friend_email = "'.$email.'", date_email_sent = "'.date('Y-m-d H:i:s').'"');
        $data = tep_db_fetch_array($query);
        return true;
    }

    function check_email($email, $customer_id) {
        $friend_emails = array();
        $query = tep_db_query('SELECT friend_email FROM '.TABLE_CUSTOMERS_FRIENDS.' WHERE friend_email = "'.$email.'" and customers_id = '.$customer_id);
        $data = tep_db_fetch_array($query);

        return !empty($data['friend_email']);
    }
}
?>