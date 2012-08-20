# phpMyAdmin SQL Dump
# version 2.8.2.4
# http://www.phpmyadmin.net
# 
# Host: localhost
# Generation Time: Apr 08, 2008 at 10:50 AM
# Server version: 4.1.19
# PHP Version: 4.4.3
# 
# Database: 'osc_sea_Trinity_3623'
# 

# --------------------------------------------------------

# 
# Table structure for table 'address_book'
# 

DROP TABLE IF EXISTS address_book;
CREATE TABLE IF NOT EXISTS address_book (
  address_book_id int(11) NOT NULL auto_increment,
  customers_id int(11) NOT NULL default '0',
  entry_gender char(1) NOT NULL default '',
  entry_company varchar(32) default NULL,
  entry_firstname varchar(32) NOT NULL default '',
  entry_lastname varchar(32) NOT NULL default '',
  entry_street_address varchar(64) NOT NULL default '',
  entry_suburb varchar(32) default NULL,
  entry_postcode varchar(10) NOT NULL default '',
  entry_city varchar(32) NOT NULL default '',
  entry_state varchar(32) default NULL,
  entry_country_id int(11) NOT NULL default '0',
  entry_zone_id int(11) NOT NULL default '0',
  PRIMARY KEY  (address_book_id),
  KEY idx_address_book_customers_id (customers_id)
);

# 
# Dumping data for table 'address_book'
# 

INSERT INTO address_book (address_book_id, customers_id, entry_gender, entry_company, entry_firstname, entry_lastname, entry_street_address, entry_suburb, entry_postcode, entry_city, entry_state, entry_country_id, entry_zone_id) VALUES (1, 1, 'm', 'ACME Inc.', 'John', 'Doe', '1 Way Street', '', '12345', 'NeverNever', '', 223, 12);
INSERT INTO address_book (address_book_id, customers_id, entry_gender, entry_company, entry_firstname, entry_lastname, entry_street_address, entry_suburb, entry_postcode, entry_city, entry_state, entry_country_id, entry_zone_id) VALUES (2, 2, 'm', '', 'Fernando', 'De Cortece', 'Suite 17, 2nd Floor, 223 Richardson Street', '', '53455543', 'Casablanka', 'Tyan-Shan', 209, 0);

# --------------------------------------------------------

# 
# Table structure for table 'address_format'
# 

DROP TABLE IF EXISTS address_format;
CREATE TABLE IF NOT EXISTS address_format (
  address_format_id int(11) NOT NULL auto_increment,
  address_format varchar(128) NOT NULL default '',
  address_summary varchar(48) NOT NULL default '',
  PRIMARY KEY  (address_format_id)
);

# 
# Dumping data for table 'address_format'
# 

INSERT INTO address_format (address_format_id, address_format, address_summary) VALUES (1, '$firstname $lastname$cr$streets$cr$city, $postcode$cr$statecomma$country', '$city / $country');
INSERT INTO address_format (address_format_id, address_format, address_summary) VALUES (2, '$firstname $lastname$cr$streets$cr$city, $state    $postcode$cr$country', '$city, $state / $country');
INSERT INTO address_format (address_format_id, address_format, address_summary) VALUES (3, '$firstname $lastname$cr$streets$cr$city$cr$postcode - $statecomma$country', '$state / $country');
INSERT INTO address_format (address_format_id, address_format, address_summary) VALUES (4, '$firstname $lastname$cr$streets$cr$city ($postcode)$cr$country', '$postcode / $country');
INSERT INTO address_format (address_format_id, address_format, address_summary) VALUES (5, '$firstname $lastname$cr$streets$cr$postcode $city$cr$country', '$city / $country');

# --------------------------------------------------------

# 
# Table structure for table 'administrators'
# 

DROP TABLE IF EXISTS administrators;
CREATE TABLE IF NOT EXISTS administrators (
  id int(11) NOT NULL auto_increment,
  user_name varchar(32) character set latin1 collate latin1_bin NOT NULL default '',
  user_password varchar(40) NOT NULL default '',
  PRIMARY KEY  (id)
);


# --------------------------------------------------------

# 
# Table structure for table 'banners'
# 

DROP TABLE IF EXISTS banners;
CREATE TABLE IF NOT EXISTS banners (
  banners_id int(11) NOT NULL auto_increment,
  banners_title varchar(64) NOT NULL default '',
  banners_url varchar(255) NOT NULL default '',
  banners_image varchar(64) NOT NULL default '',
  banners_group varchar(10) NOT NULL default '',
  banners_html_text text,
  expires_impressions int(7) default '0',
  expires_date datetime default NULL,
  date_scheduled datetime default NULL,
  date_added datetime NOT NULL default '0000-00-00 00:00:00',
  date_status_change datetime default NULL,
  status int(1) NOT NULL default '1',
  PRIMARY KEY  (banners_id),
  KEY idx_banners_group (banners_group)
);

# 
# Dumping data for table 'banners'
# 

INSERT INTO banners (banners_id, banners_title, banners_url, banners_image, banners_group, banners_html_text, expires_impressions, expires_date, date_scheduled, date_added, date_status_change, status) VALUES (1, 'osCommerce', 'http://www.oscommerce.com', 'banners/oscommerce.gif', '468x50', '', 0, NULL, NULL, '2007-07-10 13:43:01', NULL, 1);

# --------------------------------------------------------

# 
# Table structure for table 'banners_history'
# 

DROP TABLE IF EXISTS banners_history;
CREATE TABLE IF NOT EXISTS banners_history (
  banners_history_id int(11) NOT NULL auto_increment,
  banners_id int(11) NOT NULL default '0',
  banners_shown int(5) NOT NULL default '0',
  banners_clicked int(5) NOT NULL default '0',
  banners_history_date datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (banners_history_id),
  KEY idx_banners_history_banners_id (banners_id)
);

# 
# Dumping data for table 'banners_history'
# 

INSERT INTO banners_history (banners_history_id, banners_id, banners_shown, banners_clicked, banners_history_date) VALUES (1, 1, 2, 0, '2007-07-10 13:45:11');

# --------------------------------------------------------

# 
# Table structure for table 'categories'
# 

DROP TABLE IF EXISTS categories;
CREATE TABLE IF NOT EXISTS categories (
  categories_id int(11) NOT NULL auto_increment,
  categories_image varchar(64) default NULL,
  parent_id int(11) NOT NULL default '0',
  sort_order int(3) default NULL,
  date_added datetime default NULL,
  last_modified datetime default NULL,
  PRIMARY KEY  (categories_id),
  KEY idx_categories_parent_id (parent_id)
);

# 
# Dumping data for table 'categories'
# 

INSERT INTO categories (categories_id, categories_image, parent_id, sort_order, date_added, last_modified) VALUES (1, '', 0, 10, '2006-08-00 00:00:00', '2006-08-00 00:00:00');
INSERT INTO categories (categories_id, categories_image, parent_id, sort_order, date_added, last_modified) VALUES (2, '', 0, 20, '2006-08-00 00:00:01', '2006-08-00 00:00:01');
INSERT INTO categories (categories_id, categories_image, parent_id, sort_order, date_added, last_modified) VALUES (3, '', 0, 30, '2006-08-00 00:00:02', '2006-08-00 00:00:02');
INSERT INTO categories (categories_id, categories_image, parent_id, sort_order, date_added, last_modified) VALUES (4, '', 0, 40, '2006-08-00 00:00:03', '2006-08-00 00:00:03');
INSERT INTO categories (categories_id, categories_image, parent_id, sort_order, date_added, last_modified) VALUES (5, '', 0, 50, '2006-08-00 00:00:04', '2006-08-00 00:00:04');
INSERT INTO categories (categories_id, categories_image, parent_id, sort_order, date_added, last_modified) VALUES (6, '', 0, 60, '2006-08-00 00:00:05', '2006-08-00 00:00:05');
INSERT INTO categories (categories_id, categories_image, parent_id, sort_order, date_added, last_modified) VALUES (7, '', 0, 70, '2006-08-00 00:00:06', '2006-08-00 00:00:06');
INSERT INTO categories (categories_id, categories_image, parent_id, sort_order, date_added, last_modified) VALUES (8, '', 0, 80, '2006-08-00 00:00:07', '2006-08-00 00:00:07');
INSERT INTO categories (categories_id, categories_image, parent_id, sort_order, date_added, last_modified) VALUES (9, '', 0, 90, '2006-08-00 00:00:08', '2006-08-00 00:00:08');
INSERT INTO categories (categories_id, categories_image, parent_id, sort_order, date_added, last_modified) VALUES (10, '', 0, 100, '2006-08-00 00:00:09', '2006-08-00 00:00:09');
INSERT INTO categories (categories_id, categories_image, parent_id, sort_order, date_added, last_modified) VALUES (11, '', 0, 110, '2006-08-00 00:00:10', '2006-08-00 00:00:10');
INSERT INTO categories (categories_id, categories_image, parent_id, sort_order, date_added, last_modified) VALUES (12, '', 0, 120, '2006-08-00 00:00:11', '2006-08-00 00:00:11');
INSERT INTO categories (categories_id, categories_image, parent_id, sort_order, date_added, last_modified) VALUES (13, 'sub2.jpg', 12, 130, '2006-08-00 00:00:12', '2008-04-08 10:34:41');
INSERT INTO categories (categories_id, categories_image, parent_id, sort_order, date_added, last_modified) VALUES (14, 'sub1.jpg', 12, 0, '2008-04-08 10:34:34', NULL);

# --------------------------------------------------------

# 
# Table structure for table 'categories_description'
# 

DROP TABLE IF EXISTS categories_description;
CREATE TABLE IF NOT EXISTS categories_description (
  categories_id int(11) NOT NULL default '0',
  language_id int(11) NOT NULL default '1',
  categories_name varchar(32) NOT NULL default '',
  PRIMARY KEY  (categories_id,language_id),
  KEY idx_categories_name (categories_name)
);

# 
# Dumping data for table 'categories_description'
# 

INSERT INTO categories_description (categories_id, language_id, categories_name) VALUES (1, 1, 'Bustiers');
INSERT INTO categories_description (categories_id, language_id, categories_name) VALUES (1, 2, 'Bustiers');
INSERT INTO categories_description (categories_id, language_id, categories_name) VALUES (1, 3, 'Bustiers');
INSERT INTO categories_description (categories_id, language_id, categories_name) VALUES (2, 1, 'Lingerie Sets');
INSERT INTO categories_description (categories_id, language_id, categories_name) VALUES (2, 2, 'Lingerie Sets');
INSERT INTO categories_description (categories_id, language_id, categories_name) VALUES (2, 3, 'Lingerie Sets');
INSERT INTO categories_description (categories_id, language_id, categories_name) VALUES (3, 1, 'Stockings');
INSERT INTO categories_description (categories_id, language_id, categories_name) VALUES (3, 2, 'Stockings');
INSERT INTO categories_description (categories_id, language_id, categories_name) VALUES (3, 3, 'Stockings');
INSERT INTO categories_description (categories_id, language_id, categories_name) VALUES (4, 1, 'Thigh Highs');
INSERT INTO categories_description (categories_id, language_id, categories_name) VALUES (4, 2, 'Thigh Highs');
INSERT INTO categories_description (categories_id, language_id, categories_name) VALUES (4, 3, 'Thigh Highs');
INSERT INTO categories_description (categories_id, language_id, categories_name) VALUES (5, 1, 'Hold Up');
INSERT INTO categories_description (categories_id, language_id, categories_name) VALUES (5, 2, 'Hold Up');
INSERT INTO categories_description (categories_id, language_id, categories_name) VALUES (5, 3, 'Hold Up');
INSERT INTO categories_description (categories_id, language_id, categories_name) VALUES (6, 1, 'Knickers');
INSERT INTO categories_description (categories_id, language_id, categories_name) VALUES (6, 2, 'Knickers');
INSERT INTO categories_description (categories_id, language_id, categories_name) VALUES (6, 3, 'Knickers');
INSERT INTO categories_description (categories_id, language_id, categories_name) VALUES (7, 1, 'Baby dolls');
INSERT INTO categories_description (categories_id, language_id, categories_name) VALUES (7, 2, 'Baby dolls');
INSERT INTO categories_description (categories_id, language_id, categories_name) VALUES (7, 3, 'Baby dolls');
INSERT INTO categories_description (categories_id, language_id, categories_name) VALUES (8, 1, 'Bras');
INSERT INTO categories_description (categories_id, language_id, categories_name) VALUES (8, 2, 'Bras');
INSERT INTO categories_description (categories_id, language_id, categories_name) VALUES (8, 3, 'Bras');
INSERT INTO categories_description (categories_id, language_id, categories_name) VALUES (9, 1, 'Bridal Wear');
INSERT INTO categories_description (categories_id, language_id, categories_name) VALUES (9, 2, 'Bridal Wear');
INSERT INTO categories_description (categories_id, language_id, categories_name) VALUES (9, 3, 'Bridal Wear');
INSERT INTO categories_description (categories_id, language_id, categories_name) VALUES (10, 1, 'Wedding Lingerie');
INSERT INTO categories_description (categories_id, language_id, categories_name) VALUES (10, 2, 'Wedding Lingerie');
INSERT INTO categories_description (categories_id, language_id, categories_name) VALUES (10, 3, 'Wedding Lingerie');
INSERT INTO categories_description (categories_id, language_id, categories_name) VALUES (11, 1, 'Camisole');
INSERT INTO categories_description (categories_id, language_id, categories_name) VALUES (11, 2, 'Camisole');
INSERT INTO categories_description (categories_id, language_id, categories_name) VALUES (11, 3, 'Camisole');
INSERT INTO categories_description (categories_id, language_id, categories_name) VALUES (12, 1, 'Everyday Bras');
INSERT INTO categories_description (categories_id, language_id, categories_name) VALUES (12, 2, 'Everyday Bras');
INSERT INTO categories_description (categories_id, language_id, categories_name) VALUES (12, 3, 'Everyday Bras');
INSERT INTO categories_description (categories_id, language_id, categories_name) VALUES (13, 1, 'Varius mi');
INSERT INTO categories_description (categories_id, language_id, categories_name) VALUES (13, 2, 'Varius mi');
INSERT INTO categories_description (categories_id, language_id, categories_name) VALUES (13, 3, 'Varius mi');
INSERT INTO categories_description (categories_id, language_id, categories_name) VALUES (14, 1, 'Fusce suscipit');
INSERT INTO categories_description (categories_id, language_id, categories_name) VALUES (14, 2, 'Fusce suscipit');
INSERT INTO categories_description (categories_id, language_id, categories_name) VALUES (14, 3, 'Fusce suscipit');

# --------------------------------------------------------

# 
# Table structure for table 'configuration'
# 

DROP TABLE IF EXISTS configuration;
CREATE TABLE IF NOT EXISTS configuration (
  configuration_id int(11) NOT NULL auto_increment,
  configuration_title varchar(255) NOT NULL default '',
  configuration_key varchar(255) NOT NULL default '',
  configuration_value varchar(255) NOT NULL default '',
  configuration_description varchar(255) NOT NULL default '',
  configuration_group_id int(11) NOT NULL default '0',
  sort_order int(5) default NULL,
  last_modified datetime default NULL,
  date_added datetime NOT NULL default '0000-00-00 00:00:00',
  use_function varchar(255) default NULL,
  set_function varchar(255) default NULL,
  PRIMARY KEY  (configuration_id)
);

# 
# Dumping data for table 'configuration'
# 

INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (1, 'Store Name', 'STORE_NAME', 'Online Shop', 'The name of my store', 1, 1, NULL, '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (2, 'Store Owner', 'STORE_OWNER', 'seaman', 'The name of my store owner', 1, 2, NULL, '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (3, 'E-Mail Address', 'STORE_OWNER_EMAIL_ADDRESS', 'your@sea.com', 'The e-mail address of my store owner', 1, 3, NULL, '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (4, 'E-Mail From', 'EMAIL_FROM', '"seaman" <your@sea.com>', 'The e-mail address used in (sent) e-mails', 1, 4, NULL, '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (5, 'Country', 'STORE_COUNTRY', '223', 'The country my store is located in <br><br><b>Note: Please remember to update the store zone.</b>', 1, 6, NULL, '2007-07-10 13:43:01', 'tep_get_country_name', 'tep_cfg_pull_down_country_list(');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (6, 'Zone', 'STORE_ZONE', '18', 'The zone my store is located in', 1, 7, NULL, '2007-07-10 13:43:01', 'tep_cfg_get_zone_name', 'tep_cfg_pull_down_zone_list(');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (7, 'Expected Sort Order', 'EXPECTED_PRODUCTS_SORT', 'desc', 'This is the sort order used in the expected products box.', 1, 8, NULL, '2007-07-10 13:43:01', NULL, 'tep_cfg_select_option(array(''asc'', ''desc''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (8, 'Expected Sort Field', 'EXPECTED_PRODUCTS_FIELD', 'date_expected', 'The column to sort by in the expected products box.', 1, 9, NULL, '2007-07-10 13:43:01', NULL, 'tep_cfg_select_option(array(''products_name'', ''date_expected''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (9, 'Switch To Default Language Currency', 'USE_DEFAULT_LANGUAGE_CURRENCY', 'false', 'Automatically switch to the language''s currency when it is changed', 1, 10, NULL, '2007-07-10 13:43:01', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (10, 'Send Extra Order Emails To', 'SEND_EXTRA_ORDER_EMAILS_TO', '', 'Send extra order emails to the following email addresses, in this format: Name 1 &lt;email@address1&gt;, Name 2 &lt;email@address2&gt;', 1, 11, NULL, '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (11, 'Use Search-Engine Safe URLs (still in development)', 'SEARCH_ENGINE_FRIENDLY_URLS', 'false', 'Use search-engine safe urls for all site links', 1, 12, NULL, '2007-07-10 13:43:01', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (12, 'Display Cart After Adding Product', 'DISPLAY_CART', 'true', 'Display the shopping cart after adding a product (or return back to their origin)', 1, 14, NULL, '2007-07-10 13:43:01', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (13, 'Allow Guest To Tell A Friend', 'ALLOW_GUEST_TO_TELL_A_FRIEND', 'false', 'Allow guests to tell a friend about a product', 1, 15, NULL, '2007-07-10 13:43:01', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (14, 'Default Search Operator', 'ADVANCED_SEARCH_DEFAULT_OPERATOR', 'and', 'Default search operators', 1, 17, NULL, '2007-07-10 13:43:01', NULL, 'tep_cfg_select_option(array(''and'', ''or''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (15, 'Store Address and Phone', 'STORE_NAME_ADDRESS', 'Store Name\nAddress\nCountry\nPhone', 'This is the Store Name, Address and Phone used on printable documents and displayed online', 1, 18, NULL, '2007-07-10 13:43:01', NULL, 'tep_cfg_textarea(');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (16, 'Show Category Counts', 'SHOW_COUNTS', 'false', 'Count recursively how many products are in each category', 1, 19, '2007-07-10 15:38:18', '2007-07-10 13:43:01', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (17, 'Tax Decimal Places', 'TAX_DECIMAL_PLACES', '0', 'Pad the tax value this amount of decimal places', 1, 20, NULL, '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (18, 'Display Prices with Tax', 'DISPLAY_PRICE_WITH_TAX', 'false', 'Display prices with tax included (true) or add the tax at the end (false)', 1, 21, NULL, '2007-07-10 13:43:01', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (19, 'First Name', 'ENTRY_FIRST_NAME_MIN_LENGTH', '2', 'Minimum length of first name', 2, 1, NULL, '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (20, 'Last Name', 'ENTRY_LAST_NAME_MIN_LENGTH', '2', 'Minimum length of last name', 2, 2, NULL, '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (21, 'Date of Birth', 'ENTRY_DOB_MIN_LENGTH', '10', 'Minimum length of date of birth', 2, 3, NULL, '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (22, 'E-Mail Address', 'ENTRY_EMAIL_ADDRESS_MIN_LENGTH', '6', 'Minimum length of e-mail address', 2, 4, NULL, '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (23, 'Street Address', 'ENTRY_STREET_ADDRESS_MIN_LENGTH', '5', 'Minimum length of street address', 2, 5, NULL, '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (24, 'Company', 'ENTRY_COMPANY_MIN_LENGTH', '2', 'Minimum length of company name', 2, 6, NULL, '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (25, 'Post Code', 'ENTRY_POSTCODE_MIN_LENGTH', '4', 'Minimum length of post code', 2, 7, NULL, '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (26, 'City', 'ENTRY_CITY_MIN_LENGTH', '3', 'Minimum length of city', 2, 8, NULL, '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (27, 'State', 'ENTRY_STATE_MIN_LENGTH', '2', 'Minimum length of state', 2, 9, NULL, '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (28, 'Telephone Number', 'ENTRY_TELEPHONE_MIN_LENGTH', '3', 'Minimum length of telephone number', 2, 10, NULL, '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (29, 'Password', 'ENTRY_PASSWORD_MIN_LENGTH', '5', 'Minimum length of password', 2, 11, NULL, '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (30, 'Credit Card Owner Name', 'CC_OWNER_MIN_LENGTH', '3', 'Minimum length of credit card owner name', 2, 12, NULL, '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (31, 'Credit Card Number', 'CC_NUMBER_MIN_LENGTH', '10', 'Minimum length of credit card number', 2, 13, NULL, '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (32, 'Review Text', 'REVIEW_TEXT_MIN_LENGTH', '50', 'Minimum length of review text', 2, 14, NULL, '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (33, 'Best Sellers', 'MIN_DISPLAY_BESTSELLERS', '1', 'Minimum number of best sellers to display', 2, 15, NULL, '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (34, 'Also Purchased', 'MIN_DISPLAY_ALSO_PURCHASED', '1', 'Minimum number of products to display in the ''This Customer Also Purchased'' box', 2, 16, NULL, '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (35, 'Address Book Entries', 'MAX_ADDRESS_BOOK_ENTRIES', '5', 'Maximum address book entries a customer is allowed to have', 3, 1, NULL, '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (36, 'Search Results', 'MAX_DISPLAY_SEARCH_RESULTS', '2', 'Amount of products to list', 3, 2, '2008-04-08 10:36:54', '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (37, 'Page Links', 'MAX_DISPLAY_PAGE_LINKS', '5', 'Number of ''number'' links use for page-sets', 3, 3, NULL, '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (38, 'Special Products', 'MAX_DISPLAY_SPECIAL_PRODUCTS', '2', 'Maximum number of products on special to display', 3, 4, '2008-04-08 10:36:56', '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (39, 'New Products Module', 'MAX_DISPLAY_NEW_PRODUCTS', '2', 'Maximum number of new products to display in a category', 3, 5, '2008-04-08 10:37:12', '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (40, 'Products Expected', 'MAX_DISPLAY_UPCOMING_PRODUCTS', '10', 'Maximum number of products expected to display', 3, 6, NULL, '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (41, 'Manufacturers List', 'MAX_DISPLAY_MANUFACTURERS_IN_A_LIST', '0', 'Used in manufacturers box; when the number of manufacturers exceeds this number, a drop-down list will be displayed instead of the default list', 3, 7, NULL, '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (42, 'Manufacturers Select Size', 'MAX_MANUFACTURERS_LIST', '1', 'Used in manufacturers box; when this value is ''1'' the classic drop-down list will be used for the manufacturers box. Otherwise, a list-box with the specified number of rows will be displayed.', 3, 7, NULL, '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (43, 'Length of Manufacturers Name', 'MAX_DISPLAY_MANUFACTURER_NAME_LEN', '15', 'Used in manufacturers box; maximum length of manufacturers name to display', 3, 8, NULL, '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (44, 'New Reviews', 'MAX_DISPLAY_NEW_REVIEWS', '6', 'Maximum number of new reviews to display', 3, 9, NULL, '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (45, 'Selection of Random Reviews', 'MAX_RANDOM_SELECT_REVIEWS', '10', 'How many records to select from to choose one random product review', 3, 10, NULL, '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (46, 'Selection of Random New Products', 'MAX_RANDOM_SELECT_NEW', '10', 'How many records to select from to choose one random new product to display', 3, 11, NULL, '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (47, 'Selection of Products on Special', 'MAX_RANDOM_SELECT_SPECIALS', '10', 'How many records to select from to choose one random product special to display', 3, 12, NULL, '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (48, 'Categories To List Per Row', 'MAX_DISPLAY_CATEGORIES_PER_ROW', '2', 'How many categories to list per row', 3, 13, '2007-10-09 16:15:41', '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (49, 'New Products Listing', 'MAX_DISPLAY_PRODUCTS_NEW', '2', 'Maximum number of new products to display in new products page', 3, 14, '2008-04-08 10:37:02', '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (50, 'Best Sellers', 'MAX_DISPLAY_BESTSELLERS', '7', 'Maximum number of best sellers to display', 3, 15, '2008-04-08 10:48:28', '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (51, 'Also Purchased', 'MAX_DISPLAY_ALSO_PURCHASED', '6', 'Maximum number of products to display in the ''This Customer Also Purchased'' box', 3, 16, NULL, '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (52, 'Customer Order History Box', 'MAX_DISPLAY_PRODUCTS_IN_ORDER_HISTORY_BOX', '6', 'Maximum number of products to display in the customer order history box', 3, 17, NULL, '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (53, 'Order History', 'MAX_DISPLAY_ORDER_HISTORY', '10', 'Maximum number of orders to display in the order history page', 3, 18, NULL, '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (54, 'Product Quantities In Shopping Cart', 'MAX_QTY_IN_CART', '99', 'Maximum number of product quantities that can be added to the shopping cart (0 for no limit)', 3, 19, NULL, '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (55, 'Small Image Width', 'SMALL_IMAGE_WIDTH', '165', 'The pixel width of small images', 4, 1, '2008-04-08 10:40:00', '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (56, 'Small Image Height', 'SMALL_IMAGE_HEIGHT', '82', 'The pixel height of small images', 4, 2, '2008-04-08 10:39:55', '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (57, 'Heading Image Width', 'HEADING_IMAGE_WIDTH', '135', 'The pixel width of heading images', 4, 3, '2008-04-08 10:42:03', '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (58, 'Heading Image Height', 'HEADING_IMAGE_HEIGHT', '67', 'The pixel height of heading images', 4, 4, '2008-04-08 10:41:32', '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (59, 'Subcategory Image Width', 'SUBCATEGORY_IMAGE_WIDTH', '165', 'The pixel width of subcategory images', 4, 5, '2008-04-08 10:40:26', '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (60, 'Subcategory Image Height', 'SUBCATEGORY_IMAGE_HEIGHT', '82', 'The pixel height of subcategory images', 4, 6, '2008-04-08 10:40:31', '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (61, 'Calculate Image Size', 'CONFIG_CALCULATE_IMAGE_SIZE', 'true', 'Calculate the size of images?', 4, 7, NULL, '2007-07-10 13:43:01', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (62, 'Image Required', 'IMAGE_REQUIRED', 'true', 'Enable to display broken images. Good for development.', 4, 8, NULL, '2007-07-10 13:43:01', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (63, 'Gender', 'ACCOUNT_GENDER', 'true', 'Display gender in the customers account', 5, 1, NULL, '2007-07-10 13:43:01', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (64, 'Date of Birth', 'ACCOUNT_DOB', 'true', 'Display date of birth in the customers account', 5, 2, NULL, '2007-07-10 13:43:01', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (65, 'Company', 'ACCOUNT_COMPANY', 'true', 'Display company in the customers account', 5, 3, NULL, '2007-07-10 13:43:01', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (66, 'Suburb', 'ACCOUNT_SUBURB', 'true', 'Display suburb in the customers account', 5, 4, NULL, '2007-07-10 13:43:01', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (67, 'State', 'ACCOUNT_STATE', 'true', 'Display state in the customers account', 5, 5, NULL, '2007-07-10 13:43:01', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (68, 'Installed Modules', 'MODULE_PAYMENT_INSTALLED', 'cc.php;cod.php', 'List of payment module filenames separated by a semi-colon. This is automatically updated. No need to edit. (Example: cc.php;cod.php;paypal.php)', 6, 0, NULL, '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (69, 'Installed Modules', 'MODULE_ORDER_TOTAL_INSTALLED', 'ot_subtotal.php;ot_tax.php;ot_shipping.php;ot_total.php', 'List of order_total module filenames separated by a semi-colon. This is automatically updated. No need to edit. (Example: ot_subtotal.php;ot_tax.php;ot_shipping.php;ot_total.php)', 6, 0, NULL, '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (70, 'Installed Modules', 'MODULE_SHIPPING_INSTALLED', 'flat.php', 'List of shipping module filenames separated by a semi-colon. This is automatically updated. No need to edit. (Example: ups.php;flat.php;item.php)', 6, 0, NULL, '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (71, 'Enable Cash On Delivery Module', 'MODULE_PAYMENT_COD_STATUS', 'True', 'Do you want to accept Cash On Delevery payments?', 6, 1, NULL, '2007-07-10 13:43:01', NULL, 'tep_cfg_select_option(array(''True'', ''False''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (72, 'Payment Zone', 'MODULE_PAYMENT_COD_ZONE', '0', 'If a zone is selected, only enable this payment method for that zone.', 6, 2, NULL, '2007-07-10 13:43:01', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (73, 'Sort order of display.', 'MODULE_PAYMENT_COD_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', 6, 0, NULL, '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (74, 'Set Order Status', 'MODULE_PAYMENT_COD_ORDER_STATUS_ID', '0', 'Set the status of orders made with this payment module to this value', 6, 0, NULL, '2007-07-10 13:43:01', 'tep_get_order_status_name', 'tep_cfg_pull_down_order_statuses(');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (75, 'Enable Credit Card Module', 'MODULE_PAYMENT_CC_STATUS', 'True', 'Do you want to accept credit card payments?', 6, 0, NULL, '2007-07-10 13:43:01', NULL, 'tep_cfg_select_option(array(''True'', ''False''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (76, 'Split Credit Card E-Mail Address', 'MODULE_PAYMENT_CC_EMAIL', '', 'If an e-mail address is entered, the middle digits of the credit card number will be sent to the e-mail address (the outside digits are stored in the database with the middle digits censored)', 6, 0, NULL, '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (77, 'Sort order of display.', 'MODULE_PAYMENT_CC_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', 6, 0, NULL, '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (78, 'Payment Zone', 'MODULE_PAYMENT_CC_ZONE', '0', 'If a zone is selected, only enable this payment method for that zone.', 6, 2, NULL, '2007-07-10 13:43:01', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (79, 'Set Order Status', 'MODULE_PAYMENT_CC_ORDER_STATUS_ID', '0', 'Set the status of orders made with this payment module to this value', 6, 0, NULL, '2007-07-10 13:43:01', 'tep_get_order_status_name', 'tep_cfg_pull_down_order_statuses(');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (80, 'Enable Flat Shipping', 'MODULE_SHIPPING_FLAT_STATUS', 'True', 'Do you want to offer flat rate shipping?', 6, 0, NULL, '2007-07-10 13:43:01', NULL, 'tep_cfg_select_option(array(''True'', ''False''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (81, 'Shipping Cost', 'MODULE_SHIPPING_FLAT_COST', '5.00', 'The shipping cost for all orders using this shipping method.', 6, 0, NULL, '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (82, 'Tax Class', 'MODULE_SHIPPING_FLAT_TAX_CLASS', '0', 'Use the following tax class on the shipping fee.', 6, 0, NULL, '2007-07-10 13:43:01', 'tep_get_tax_class_title', 'tep_cfg_pull_down_tax_classes(');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (83, 'Shipping Zone', 'MODULE_SHIPPING_FLAT_ZONE', '0', 'If a zone is selected, only enable this shipping method for that zone.', 6, 0, NULL, '2007-07-10 13:43:01', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (84, 'Sort Order', 'MODULE_SHIPPING_FLAT_SORT_ORDER', '0', 'Sort order of display.', 6, 0, NULL, '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (85, 'Default Currency', 'DEFAULT_CURRENCY', 'USD', 'Default Currency', 6, 0, NULL, '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (86, 'Default Language', 'DEFAULT_LANGUAGE', 'en', 'Default Language', 6, 0, NULL, '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (87, 'Default Order Status For New Orders', 'DEFAULT_ORDERS_STATUS_ID', '1', 'When a new order is created, this order status will be assigned to it.', 6, 0, NULL, '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (88, 'Display Shipping', 'MODULE_ORDER_TOTAL_SHIPPING_STATUS', 'true', 'Do you want to display the order shipping cost?', 6, 1, NULL, '2007-07-10 13:43:01', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (89, 'Sort Order', 'MODULE_ORDER_TOTAL_SHIPPING_SORT_ORDER', '2', 'Sort order of display.', 6, 2, NULL, '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (90, 'Allow Free Shipping', 'MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING', 'false', 'Do you want to allow free shipping?', 6, 3, NULL, '2007-07-10 13:43:01', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (91, 'Free Shipping For Orders Over', 'MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER', '50', 'Provide free shipping for orders over the set amount.', 6, 4, NULL, '2007-07-10 13:43:01', 'currencies->format', NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (92, 'Provide Free Shipping For Orders Made', 'MODULE_ORDER_TOTAL_SHIPPING_DESTINATION', 'national', 'Provide free shipping for orders sent to the set destination.', 6, 5, NULL, '2007-07-10 13:43:01', NULL, 'tep_cfg_select_option(array(''national'', ''international'', ''both''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (93, 'Display Sub-Total', 'MODULE_ORDER_TOTAL_SUBTOTAL_STATUS', 'true', 'Do you want to display the order sub-total cost?', 6, 1, NULL, '2007-07-10 13:43:01', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (94, 'Sort Order', 'MODULE_ORDER_TOTAL_SUBTOTAL_SORT_ORDER', '1', 'Sort order of display.', 6, 2, NULL, '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (95, 'Display Tax', 'MODULE_ORDER_TOTAL_TAX_STATUS', 'true', 'Do you want to display the order tax value?', 6, 1, NULL, '2007-07-10 13:43:01', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (96, 'Sort Order', 'MODULE_ORDER_TOTAL_TAX_SORT_ORDER', '3', 'Sort order of display.', 6, 2, NULL, '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (97, 'Display Total', 'MODULE_ORDER_TOTAL_TOTAL_STATUS', 'true', 'Do you want to display the total order value?', 6, 1, NULL, '2007-07-10 13:43:01', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (98, 'Sort Order', 'MODULE_ORDER_TOTAL_TOTAL_SORT_ORDER', '4', 'Sort order of display.', 6, 2, NULL, '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (99, 'Country of Origin', 'SHIPPING_ORIGIN_COUNTRY', '223', 'Select the country of origin to be used in shipping quotes.', 7, 1, NULL, '2007-07-10 13:43:01', 'tep_get_country_name', 'tep_cfg_pull_down_country_list(');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (100, 'Postal Code', 'SHIPPING_ORIGIN_ZIP', 'NONE', 'Enter the Postal Code (ZIP) of the Store to be used in shipping quotes.', 7, 2, NULL, '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (101, 'Enter the Maximum Package Weight you will ship', 'SHIPPING_MAX_WEIGHT', '50', 'Carriers have a max weight limit for a single package. This is a common one for all.', 7, 3, NULL, '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (102, 'Package Tare weight.', 'SHIPPING_BOX_WEIGHT', '3', 'What is the weight of typical packaging of small to medium packages?', 7, 4, NULL, '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (103, 'Larger packages - percentage increase.', 'SHIPPING_BOX_PADDING', '10', 'For 10% enter 10', 7, 5, NULL, '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (104, 'Display Product Image', 'PRODUCT_LIST_IMAGE', '1', 'Do you want to display the Product Image?', 8, 1, NULL, '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (105, 'Display Product Manufaturer Name', 'PRODUCT_LIST_MANUFACTURER', '0', 'Do you want to display the Product Manufacturer Name?', 8, 2, NULL, '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (106, 'Display Product Model', 'PRODUCT_LIST_MODEL', '0', 'Do you want to display the Product Model?', 8, 3, NULL, '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (107, 'Display Product Name', 'PRODUCT_LIST_NAME', '2', 'Do you want to display the Product Name?', 8, 4, NULL, '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (108, 'Display Product Price', 'PRODUCT_LIST_PRICE', '3', 'Do you want to display the Product Price', 8, 5, NULL, '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (109, 'Display Product Quantity', 'PRODUCT_LIST_QUANTITY', '0', 'Do you want to display the Product Quantity?', 8, 6, NULL, '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (110, 'Display Product Weight', 'PRODUCT_LIST_WEIGHT', '0', 'Do you want to display the Product Weight?', 8, 7, NULL, '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (111, 'Display Buy Now column', 'PRODUCT_LIST_BUY_NOW', '4', 'Do you want to display the Buy Now column?', 8, 8, NULL, '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (112, 'Display Category/Manufacturer Filter (0=disable; 1=enable)', 'PRODUCT_LIST_FILTER', '1', 'Do you want to display the Category/Manufacturer Filter?', 8, 9, NULL, '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (113, 'Location of Prev/Next Navigation Bar (1-top, 2-bottom, 3-both)', 'PREV_NEXT_BAR_LOCATION', '2', 'Sets the location of the Prev/Next Navigation Bar (1-top, 2-bottom, 3-both)', 8, 10, NULL, '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (114, 'Check stock level', 'STOCK_CHECK', 'true', 'Check to see if sufficent stock is available', 9, 1, NULL, '2007-07-10 13:43:01', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (115, 'Subtract stock', 'STOCK_LIMITED', 'true', 'Subtract product in stock by product orders', 9, 2, NULL, '2007-07-10 13:43:01', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (116, 'Allow Checkout', 'STOCK_ALLOW_CHECKOUT', 'true', 'Allow customer to checkout even if there is insufficient stock', 9, 3, NULL, '2007-07-10 13:43:01', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (117, 'Mark product out of stock', 'STOCK_MARK_PRODUCT_OUT_OF_STOCK', '***', 'Display something on screen so customer can see which product has insufficient stock', 9, 4, NULL, '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (118, 'Stock Re-order level', 'STOCK_REORDER_LEVEL', '5', 'Define when stock needs to be re-ordered', 9, 5, NULL, '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (119, 'Store Page Parse Time', 'STORE_PAGE_PARSE_TIME', 'false', 'Store the time it takes to parse a page', 10, 1, NULL, '2007-07-10 13:43:01', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (120, 'Log Destination', 'STORE_PAGE_PARSE_TIME_LOG', '/var/log/www/tep/page_parse_time.log', 'Directory and filename of the page parse time log', 10, 2, NULL, '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (121, 'Log Date Format', 'STORE_PARSE_DATE_TIME_FORMAT', '%d/%m/%Y %H:%M:%S', 'The date format', 10, 3, NULL, '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (122, 'Display The Page Parse Time', 'DISPLAY_PAGE_PARSE_TIME', 'true', 'Display the page parse time (store page parse time must be enabled)', 10, 4, NULL, '2007-07-10 13:43:01', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (123, 'Store Database Queries', 'STORE_DB_TRANSACTIONS', 'false', 'Store the database queries in the page parse time log (PHP4 only)', 10, 5, NULL, '2007-07-10 13:43:01', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (124, 'Use Cache', 'USE_CACHE', 'false', 'Use caching features', 11, 1, NULL, '2007-07-10 13:43:01', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (125, 'Cache Directory', 'DIR_FS_CACHE', '/tmp/', 'The directory where the cached files are saved', 11, 2, NULL, '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (126, 'E-Mail Transport Method', 'EMAIL_TRANSPORT', 'sendmail', 'Defines if this server uses a local connection to sendmail or uses an SMTP connection via TCP/IP. Servers running on Windows and MacOS should change this setting to SMTP.', 12, 1, NULL, '2007-07-10 13:43:01', NULL, 'tep_cfg_select_option(array(''sendmail'', ''smtp''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (127, 'E-Mail Linefeeds', 'EMAIL_LINEFEED', 'LF', 'Defines the character sequence used to separate mail headers.', 12, 2, NULL, '2007-07-10 13:43:01', NULL, 'tep_cfg_select_option(array(''LF'', ''CRLF''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (128, 'Use MIME HTML When Sending Emails', 'EMAIL_USE_HTML', 'false', 'Send e-mails in HTML format', 12, 3, NULL, '2007-07-10 13:43:01', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (129, 'Verify E-Mail Addresses Through DNS', 'ENTRY_EMAIL_ADDRESS_CHECK', 'false', 'Verify e-mail address through a DNS server', 12, 4, NULL, '2007-07-10 13:43:01', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (130, 'Send E-Mails', 'SEND_EMAILS', 'true', 'Send out e-mails', 12, 5, NULL, '2007-07-10 13:43:01', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (131, 'Enable download', 'DOWNLOAD_ENABLED', 'false', 'Enable the products download functions.', 13, 1, NULL, '2007-07-10 13:43:01', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (132, 'Download by redirect', 'DOWNLOAD_BY_REDIRECT', 'false', 'Use browser redirection for download. Disable on non-Unix systems.', 13, 2, NULL, '2007-07-10 13:43:01', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (133, 'Expiry delay (days)', 'DOWNLOAD_MAX_DAYS', '7', 'Set number of days before the download link expires. 0 means no limit.', 13, 3, NULL, '2007-07-10 13:43:01', NULL, '');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (134, 'Maximum number of downloads', 'DOWNLOAD_MAX_COUNT', '5', 'Set the maximum number of downloads. 0 means no download authorized.', 13, 4, NULL, '2007-07-10 13:43:01', NULL, '');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (135, 'Enable GZip Compression', 'GZIP_COMPRESSION', 'false', 'Enable HTTP GZip compression.', 14, 1, NULL, '2007-07-10 13:43:01', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (136, 'Compression Level', 'GZIP_LEVEL', '5', 'Use this compression level 0-9 (0 = minimum, 9 = maximum).', 14, 2, NULL, '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (137, 'Session Directory', 'SESSION_WRITE_DIRECTORY', '/tmp', 'If sessions are file based, store them in this directory.', 15, 1, NULL, '2007-07-10 13:43:01', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (138, 'Force Cookie Use', 'SESSION_FORCE_COOKIE_USE', 'False', 'Force the use of sessions when cookies are only enabled.', 15, 2, NULL, '2007-07-10 13:43:01', NULL, 'tep_cfg_select_option(array(''True'', ''False''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (139, 'Check SSL Session ID', 'SESSION_CHECK_SSL_SESSION_ID', 'False', 'Validate the SSL_SESSION_ID on every secure HTTPS page request.', 15, 3, NULL, '2007-07-10 13:43:01', NULL, 'tep_cfg_select_option(array(''True'', ''False''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (140, 'Check User Agent', 'SESSION_CHECK_USER_AGENT', 'False', 'Validate the clients browser user agent on every page request.', 15, 4, NULL, '2007-07-10 13:43:01', NULL, 'tep_cfg_select_option(array(''True'', ''False''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (141, 'Check IP Address', 'SESSION_CHECK_IP_ADDRESS', 'False', 'Validate the clients IP address on every page request.', 15, 5, NULL, '2007-07-10 13:43:01', NULL, 'tep_cfg_select_option(array(''True'', ''False''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (142, 'Prevent Spider Sessions', 'SESSION_BLOCK_SPIDERS', 'False', 'Prevent known spiders from starting a session.', 15, 6, NULL, '2007-07-10 13:43:01', NULL, 'tep_cfg_select_option(array(''True'', ''False''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES (143, 'Recreate Session', 'SESSION_RECREATE', 'False', 'Recreate the session to generate a new session ID when the customer logs on or creates an account (PHP >=4.1 needed).', 15, 7, NULL, '2007-07-10 13:43:01', NULL, 'tep_cfg_select_option(array(''True'', ''False''),');

# --------------------------------------------------------

# 
# Table structure for table 'configuration_group'
# 

DROP TABLE IF EXISTS configuration_group;
CREATE TABLE IF NOT EXISTS configuration_group (
  configuration_group_id int(11) NOT NULL auto_increment,
  configuration_group_title varchar(64) NOT NULL default '',
  configuration_group_description varchar(255) NOT NULL default '',
  sort_order int(5) default NULL,
  visible int(1) default '1',
  PRIMARY KEY  (configuration_group_id)
);

# 
# Dumping data for table 'configuration_group'
# 

INSERT INTO configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) VALUES (1, 'My Store', 'General information about my store', 1, 1);
INSERT INTO configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) VALUES (2, 'Minimum Values', 'The minimum values for functions / data', 2, 1);
INSERT INTO configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) VALUES (3, 'Maximum Values', 'The maximum values for functions / data', 3, 1);
INSERT INTO configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) VALUES (4, 'Images', 'Image parameters', 4, 1);
INSERT INTO configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) VALUES (5, 'Customer Details', 'Customer account configuration', 5, 1);
INSERT INTO configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) VALUES (6, 'Module Options', 'Hidden from configuration', 6, 0);
INSERT INTO configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) VALUES (7, 'Shipping/Packaging', 'Shipping options available at my store', 7, 1);
INSERT INTO configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) VALUES (8, 'Product Listing', 'Product Listing    configuration options', 8, 1);
INSERT INTO configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) VALUES (9, 'Stock', 'Stock configuration options', 9, 1);
INSERT INTO configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) VALUES (10, 'Logging', 'Logging configuration options', 10, 1);
INSERT INTO configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) VALUES (11, 'Cache', 'Caching configuration options', 11, 1);
INSERT INTO configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) VALUES (12, 'E-Mail Options', 'General setting for E-Mail transport and HTML E-Mails', 12, 1);
INSERT INTO configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) VALUES (13, 'Download', 'Downloadable products options', 13, 1);
INSERT INTO configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) VALUES (14, 'GZip Compression', 'GZip compression options', 14, 1);
INSERT INTO configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) VALUES (15, 'Sessions', 'Session options', 15, 1);

# --------------------------------------------------------

# 
# Table structure for table 'counter'
# 

DROP TABLE IF EXISTS counter;
CREATE TABLE IF NOT EXISTS counter (
  startdate char(8) default NULL,
  counter int(12) default NULL
);

# 
# Dumping data for table 'counter'
# 

INSERT INTO counter (startdate, counter) VALUES ('20070710', 1468);

# --------------------------------------------------------

# 
# Table structure for table 'counter_history'
# 

DROP TABLE IF EXISTS counter_history;
CREATE TABLE IF NOT EXISTS counter_history (
  month char(8) default NULL,
  counter int(12) default NULL
);

# 
# Dumping data for table 'counter_history'
# 


# --------------------------------------------------------

# 
# Table structure for table 'countries'
# 

DROP TABLE IF EXISTS countries;
CREATE TABLE IF NOT EXISTS countries (
  countries_id int(11) NOT NULL auto_increment,
  countries_name varchar(64) NOT NULL default '',
  countries_iso_code_2 char(2) NOT NULL default '',
  countries_iso_code_3 char(3) NOT NULL default '',
  address_format_id int(11) NOT NULL default '0',
  PRIMARY KEY  (countries_id),
  KEY IDX_COUNTRIES_NAME (countries_name)
);

# 
# Dumping data for table 'countries'
# 

INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (1, 'Afghanistan', 'AF', 'AFG', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (2, 'Albania', 'AL', 'ALB', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (3, 'Algeria', 'DZ', 'DZA', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (4, 'American Samoa', 'AS', 'ASM', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (5, 'Andorra', 'AD', 'AND', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (6, 'Angola', 'AO', 'AGO', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (7, 'Anguilla', 'AI', 'AIA', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (8, 'Antarctica', 'AQ', 'ATA', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (9, 'Antigua and Barbuda', 'AG', 'ATG', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (10, 'Argentina', 'AR', 'ARG', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (11, 'Armenia', 'AM', 'ARM', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (12, 'Aruba', 'AW', 'ABW', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (13, 'Australia', 'AU', 'AUS', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (14, 'Austria', 'AT', 'AUT', 5);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (15, 'Azerbaijan', 'AZ', 'AZE', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (16, 'Bahamas', 'BS', 'BHS', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (17, 'Bahrain', 'BH', 'BHR', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (18, 'Bangladesh', 'BD', 'BGD', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (19, 'Barbados', 'BB', 'BRB', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (20, 'Belarus', 'BY', 'BLR', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (21, 'Belgium', 'BE', 'BEL', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (22, 'Belize', 'BZ', 'BLZ', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (23, 'Benin', 'BJ', 'BEN', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (24, 'Bermuda', 'BM', 'BMU', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (25, 'Bhutan', 'BT', 'BTN', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (26, 'Bolivia', 'BO', 'BOL', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (27, 'Bosnia and Herzegowina', 'BA', 'BIH', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (28, 'Botswana', 'BW', 'BWA', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (29, 'Bouvet Island', 'BV', 'BVT', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (30, 'Brazil', 'BR', 'BRA', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (31, 'British Indian Ocean Territory', 'IO', 'IOT', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (32, 'Brunei Darussalam', 'BN', 'BRN', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (33, 'Bulgaria', 'BG', 'BGR', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (34, 'Burkina Faso', 'BF', 'BFA', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (35, 'Burundi', 'BI', 'BDI', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (36, 'Cambodia', 'KH', 'KHM', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (37, 'Cameroon', 'CM', 'CMR', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (38, 'Canada', 'CA', 'CAN', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (39, 'Cape Verde', 'CV', 'CPV', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (40, 'Cayman Islands', 'KY', 'CYM', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (41, 'Central African Republic', 'CF', 'CAF', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (42, 'Chad', 'TD', 'TCD', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (43, 'Chile', 'CL', 'CHL', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (44, 'China', 'CN', 'CHN', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (45, 'Christmas Island', 'CX', 'CXR', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (46, 'Cocos (Keeling) Islands', 'CC', 'CCK', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (47, 'Colombia', 'CO', 'COL', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (48, 'Comoros', 'KM', 'COM', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (49, 'Congo', 'CG', 'COG', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (50, 'Cook Islands', 'CK', 'COK', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (51, 'Costa Rica', 'CR', 'CRI', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (52, 'Cote D''Ivoire', 'CI', 'CIV', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (53, 'Croatia', 'HR', 'HRV', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (54, 'Cuba', 'CU', 'CUB', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (55, 'Cyprus', 'CY', 'CYP', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (56, 'Czech Republic', 'CZ', 'CZE', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (57, 'Denmark', 'DK', 'DNK', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (58, 'Djibouti', 'DJ', 'DJI', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (59, 'Dominica', 'DM', 'DMA', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (60, 'Dominican Republic', 'DO', 'DOM', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (61, 'East Timor', 'TP', 'TMP', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (62, 'Ecuador', 'EC', 'ECU', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (63, 'Egypt', 'EG', 'EGY', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (64, 'El Salvador', 'SV', 'SLV', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (65, 'Equatorial Guinea', 'GQ', 'GNQ', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (66, 'Eritrea', 'ER', 'ERI', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (67, 'Estonia', 'EE', 'EST', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (68, 'Ethiopia', 'ET', 'ETH', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (69, 'Falkland Islands (Malvinas)', 'FK', 'FLK', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (70, 'Faroe Islands', 'FO', 'FRO', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (71, 'Fiji', 'FJ', 'FJI', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (72, 'Finland', 'FI', 'FIN', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (73, 'France', 'FR', 'FRA', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (74, 'France, Metropolitan', 'FX', 'FXX', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (75, 'French Guiana', 'GF', 'GUF', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (76, 'French Polynesia', 'PF', 'PYF', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (77, 'French Southern Territories', 'TF', 'ATF', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (78, 'Gabon', 'GA', 'GAB', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (79, 'Gambia', 'GM', 'GMB', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (80, 'Georgia', 'GE', 'GEO', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (81, 'Germany', 'DE', 'DEU', 5);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (82, 'Ghana', 'GH', 'GHA', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (83, 'Gibraltar', 'GI', 'GIB', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (84, 'Greece', 'GR', 'GRC', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (85, 'Greenland', 'GL', 'GRL', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (86, 'Grenada', 'GD', 'GRD', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (87, 'Guadeloupe', 'GP', 'GLP', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (88, 'Guam', 'GU', 'GUM', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (89, 'Guatemala', 'GT', 'GTM', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (90, 'Guinea', 'GN', 'GIN', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (91, 'Guinea-bissau', 'GW', 'GNB', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (92, 'Guyana', 'GY', 'GUY', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (93, 'Haiti', 'HT', 'HTI', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (94, 'Heard and Mc Donald Islands', 'HM', 'HMD', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (95, 'Honduras', 'HN', 'HND', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (96, 'Hong Kong', 'HK', 'HKG', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (97, 'Hungary', 'HU', 'HUN', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (98, 'Iceland', 'IS', 'ISL', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (99, 'India', 'IN', 'IND', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (100, 'Indonesia', 'ID', 'IDN', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (101, 'Iran (Islamic Republic of)', 'IR', 'IRN', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (102, 'Iraq', 'IQ', 'IRQ', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (103, 'Ireland', 'IE', 'IRL', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (104, 'Israel', 'IL', 'ISR', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (105, 'Italy', 'IT', 'ITA', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (106, 'Jamaica', 'JM', 'JAM', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (107, 'Japan', 'JP', 'JPN', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (108, 'Jordan', 'JO', 'JOR', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (109, 'Kazakhstan', 'KZ', 'KAZ', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (110, 'Kenya', 'KE', 'KEN', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (111, 'Kiribati', 'KI', 'KIR', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (112, 'Korea, Democratic People''s Republic of', 'KP', 'PRK', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (113, 'Korea, Republic of', 'KR', 'KOR', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (114, 'Kuwait', 'KW', 'KWT', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (115, 'Kyrgyzstan', 'KG', 'KGZ', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (116, 'Lao People''s Democratic Republic', 'LA', 'LAO', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (117, 'Latvia', 'LV', 'LVA', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (118, 'Lebanon', 'LB', 'LBN', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (119, 'Lesotho', 'LS', 'LSO', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (120, 'Liberia', 'LR', 'LBR', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (121, 'Libyan Arab Jamahiriya', 'LY', 'LBY', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (122, 'Liechtenstein', 'LI', 'LIE', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (123, 'Lithuania', 'LT', 'LTU', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (124, 'Luxembourg', 'LU', 'LUX', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (125, 'Macau', 'MO', 'MAC', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (126, 'Macedonia, The Former Yugoslav Republic of', 'MK', 'MKD', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (127, 'Madagascar', 'MG', 'MDG', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (128, 'Malawi', 'MW', 'MWI', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (129, 'Malaysia', 'MY', 'MYS', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (130, 'Maldives', 'MV', 'MDV', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (131, 'Mali', 'ML', 'MLI', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (132, 'Malta', 'MT', 'MLT', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (133, 'Marshall Islands', 'MH', 'MHL', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (134, 'Martinique', 'MQ', 'MTQ', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (135, 'Mauritania', 'MR', 'MRT', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (136, 'Mauritius', 'MU', 'MUS', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (137, 'Mayotte', 'YT', 'MYT', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (138, 'Mexico', 'MX', 'MEX', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (139, 'Micronesia, Federated States of', 'FM', 'FSM', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (140, 'Moldova, Republic of', 'MD', 'MDA', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (141, 'Monaco', 'MC', 'MCO', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (142, 'Mongolia', 'MN', 'MNG', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (143, 'Montserrat', 'MS', 'MSR', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (144, 'Morocco', 'MA', 'MAR', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (145, 'Mozambique', 'MZ', 'MOZ', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (146, 'Myanmar', 'MM', 'MMR', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (147, 'Namibia', 'NA', 'NAM', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (148, 'Nauru', 'NR', 'NRU', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (149, 'Nepal', 'NP', 'NPL', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (150, 'Netherlands', 'NL', 'NLD', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (151, 'Netherlands Antilles', 'AN', 'ANT', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (152, 'New Caledonia', 'NC', 'NCL', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (153, 'New Zealand', 'NZ', 'NZL', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (154, 'Nicaragua', 'NI', 'NIC', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (155, 'Niger', 'NE', 'NER', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (156, 'Nigeria', 'NG', 'NGA', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (157, 'Niue', 'NU', 'NIU', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (158, 'Norfolk Island', 'NF', 'NFK', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (159, 'Northern Mariana Islands', 'MP', 'MNP', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (160, 'Norway', 'NO', 'NOR', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (161, 'Oman', 'OM', 'OMN', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (162, 'Pakistan', 'PK', 'PAK', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (163, 'Palau', 'PW', 'PLW', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (164, 'Panama', 'PA', 'PAN', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (165, 'Papua New Guinea', 'PG', 'PNG', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (166, 'Paraguay', 'PY', 'PRY', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (167, 'Peru', 'PE', 'PER', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (168, 'Philippines', 'PH', 'PHL', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (169, 'Pitcairn', 'PN', 'PCN', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (170, 'Poland', 'PL', 'POL', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (171, 'Portugal', 'PT', 'PRT', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (172, 'Puerto Rico', 'PR', 'PRI', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (173, 'Qatar', 'QA', 'QAT', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (174, 'Reunion', 'RE', 'REU', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (175, 'Romania', 'RO', 'ROM', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (176, 'Russian Federation', 'RU', 'RUS', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (177, 'Rwanda', 'RW', 'RWA', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (178, 'Saint Kitts and Nevis', 'KN', 'KNA', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (179, 'Saint Lucia', 'LC', 'LCA', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (180, 'Saint Vincent and the Grenadines', 'VC', 'VCT', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (181, 'Samoa', 'WS', 'WSM', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (182, 'San Marino', 'SM', 'SMR', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (183, 'Sao Tome and Principe', 'ST', 'STP', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (184, 'Saudi Arabia', 'SA', 'SAU', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (185, 'Senegal', 'SN', 'SEN', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (186, 'Seychelles', 'SC', 'SYC', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (187, 'Sierra Leone', 'SL', 'SLE', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (188, 'Singapore', 'SG', 'SGP', 4);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (189, 'Slovakia (Slovak Republic)', 'SK', 'SVK', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (190, 'Slovenia', 'SI', 'SVN', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (191, 'Solomon Islands', 'SB', 'SLB', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (192, 'Somalia', 'SO', 'SOM', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (193, 'South Africa', 'ZA', 'ZAF', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (194, 'South Georgia and the South Sandwich Islands', 'GS', 'SGS', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (195, 'Spain', 'ES', 'ESP', 3);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (196, 'Sri Lanka', 'LK', 'LKA', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (197, 'St. Helena', 'SH', 'SHN', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (198, 'St. Pierre and Miquelon', 'PM', 'SPM', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (199, 'Sudan', 'SD', 'SDN', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (200, 'Suriname', 'SR', 'SUR', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (201, 'Svalbard and Jan Mayen Islands', 'SJ', 'SJM', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (202, 'Swaziland', 'SZ', 'SWZ', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (203, 'Sweden', 'SE', 'SWE', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (204, 'Switzerland', 'CH', 'CHE', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (205, 'Syrian Arab Republic', 'SY', 'SYR', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (206, 'Taiwan', 'TW', 'TWN', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (207, 'Tajikistan', 'TJ', 'TJK', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (208, 'Tanzania, United Republic of', 'TZ', 'TZA', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (209, 'Thailand', 'TH', 'THA', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (210, 'Togo', 'TG', 'TGO', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (211, 'Tokelau', 'TK', 'TKL', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (212, 'Tonga', 'TO', 'TON', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (213, 'Trinidad and Tobago', 'TT', 'TTO', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (214, 'Tunisia', 'TN', 'TUN', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (215, 'Turkey', 'TR', 'TUR', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (216, 'Turkmenistan', 'TM', 'TKM', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (217, 'Turks and Caicos Islands', 'TC', 'TCA', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (218, 'Tuvalu', 'TV', 'TUV', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (219, 'Uganda', 'UG', 'UGA', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (220, 'Ukraine', 'UA', 'UKR', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (221, 'United Arab Emirates', 'AE', 'ARE', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (222, 'United Kingdom', 'GB', 'GBR', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (223, 'United States', 'US', 'USA', 2);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (224, 'United States Minor Outlying Islands', 'UM', 'UMI', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (225, 'Uruguay', 'UY', 'URY', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (226, 'Uzbekistan', 'UZ', 'UZB', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (227, 'Vanuatu', 'VU', 'VUT', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (228, 'Vatican City State (Holy See)', 'VA', 'VAT', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (229, 'Venezuela', 'VE', 'VEN', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (230, 'Viet Nam', 'VN', 'VNM', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (231, 'Virgin Islands (British)', 'VG', 'VGB', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (232, 'Virgin Islands (U.S.)', 'VI', 'VIR', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (233, 'Wallis and Futuna Islands', 'WF', 'WLF', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (234, 'Western Sahara', 'EH', 'ESH', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (235, 'Yemen', 'YE', 'YEM', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (236, 'Yugoslavia', 'YU', 'YUG', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (237, 'Zaire', 'ZR', 'ZAR', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (238, 'Zambia', 'ZM', 'ZMB', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES (239, 'Zimbabwe', 'ZW', 'ZWE', 1);

# --------------------------------------------------------

# 
# Table structure for table 'currencies'
# 

DROP TABLE IF EXISTS currencies;
CREATE TABLE IF NOT EXISTS currencies (
  currencies_id int(11) NOT NULL auto_increment,
  title varchar(32) NOT NULL default '',
  code char(3) NOT NULL default '',
  symbol_left varchar(12) default NULL,
  symbol_right varchar(12) default NULL,
  decimal_point char(1) default NULL,
  thousands_point char(1) default NULL,
  decimal_places char(1) default NULL,
  value float(13,8) default NULL,
  last_updated datetime default NULL,
  PRIMARY KEY  (currencies_id),
  KEY idx_currencies_code (code)
);

# 
# Dumping data for table 'currencies'
# 

INSERT INTO currencies (currencies_id, title, code, symbol_left, symbol_right, decimal_point, thousands_point, decimal_places, value, last_updated) VALUES (1, 'US Dollar', 'USD', '$', '', '.', ',', '2', 1.00000000, '2007-07-10 13:43:01');
INSERT INTO currencies (currencies_id, title, code, symbol_left, symbol_right, decimal_point, thousands_point, decimal_places, value, last_updated) VALUES (2, 'Euro', '&eu', '', '&euro;', '.', ',', '2', 1.10360003, '2007-07-10 13:43:01');

# --------------------------------------------------------

# 
# Table structure for table 'customers'
# 

DROP TABLE IF EXISTS customers;
CREATE TABLE IF NOT EXISTS customers (
  customers_id int(11) NOT NULL auto_increment,
  customers_gender char(1) NOT NULL default '',
  customers_firstname varchar(32) NOT NULL default '',
  customers_lastname varchar(32) NOT NULL default '',
  customers_dob datetime NOT NULL default '0000-00-00 00:00:00',
  customers_email_address varchar(96) NOT NULL default '',
  customers_default_address_id int(11) default NULL,
  customers_telephone varchar(32) NOT NULL default '',
  customers_fax varchar(32) default NULL,
  customers_password varchar(40) NOT NULL default '',
  customers_newsletter char(1) default NULL,
  PRIMARY KEY  (customers_id),
  KEY idx_customers_email_address (customers_email_address)
);

# 
# Dumping data for table 'customers'
# 

INSERT INTO customers (customers_id, customers_gender, customers_firstname, customers_lastname, customers_dob, customers_email_address, customers_default_address_id, customers_telephone, customers_fax, customers_password, customers_newsletter) VALUES (1, 'm', 'John', 'doe', '2001-01-01 00:00:00', 'root@localhost', 1, '12345', '', 'd95e8fa7f20a009372eb3477473fcd34:1c', '0');
INSERT INTO customers (customers_id, customers_gender, customers_firstname, customers_lastname, customers_dob, customers_email_address, customers_default_address_id, customers_telephone, customers_fax, customers_password, customers_newsletter) VALUES (2, 'm', 'Fernando', 'De Cortece', '1970-05-21 00:00:00', 'your@sea.com', 2, '(010) 5454545454', '', '21df9afa7977a00a7cdb0da6f74e353e:53', '0');

# --------------------------------------------------------

# 
# Table structure for table 'customers_basket'
# 

DROP TABLE IF EXISTS customers_basket;
CREATE TABLE IF NOT EXISTS customers_basket (
  customers_basket_id int(11) NOT NULL auto_increment,
  customers_id int(11) NOT NULL default '0',
  products_id tinytext NOT NULL,
  customers_basket_quantity int(2) NOT NULL default '0',
  final_price decimal(15,4) default NULL,
  customers_basket_date_added varchar(8) default NULL,
  PRIMARY KEY  (customers_basket_id),
  KEY idx_customers_basket_customers_id (customers_id)
);

# 
# Dumping data for table 'customers_basket'
# 


# --------------------------------------------------------

# 
# Table structure for table 'customers_basket_attributes'
# 

DROP TABLE IF EXISTS customers_basket_attributes;
CREATE TABLE IF NOT EXISTS customers_basket_attributes (
  customers_basket_attributes_id int(11) NOT NULL auto_increment,
  customers_id int(11) NOT NULL default '0',
  products_id tinytext NOT NULL,
  products_options_id int(11) NOT NULL default '0',
  products_options_value_id int(11) NOT NULL default '0',
  PRIMARY KEY  (customers_basket_attributes_id),
  KEY idx_customers_basket_att_customers_id (customers_id)
);

# 
# Dumping data for table 'customers_basket_attributes'
# 


# --------------------------------------------------------

# 
# Table structure for table 'customers_info'
# 

DROP TABLE IF EXISTS customers_info;
CREATE TABLE IF NOT EXISTS customers_info (
  customers_info_id int(11) NOT NULL default '0',
  customers_info_date_of_last_logon datetime default NULL,
  customers_info_number_of_logons int(5) default NULL,
  customers_info_date_account_created datetime default NULL,
  customers_info_date_account_last_modified datetime default NULL,
  global_product_notifications int(1) default '0',
  PRIMARY KEY  (customers_info_id)
);

# 
# Dumping data for table 'customers_info'
# 

INSERT INTO customers_info (customers_info_id, customers_info_date_of_last_logon, customers_info_number_of_logons, customers_info_date_account_created, customers_info_date_account_last_modified, global_product_notifications) VALUES (1, NULL, 0, '2007-07-10 13:43:01', NULL, 0);
INSERT INTO customers_info (customers_info_id, customers_info_date_of_last_logon, customers_info_number_of_logons, customers_info_date_account_created, customers_info_date_account_last_modified, global_product_notifications) VALUES (2, '2008-04-08 10:44:07', 8, '2007-07-11 12:33:39', '2007-07-11 13:44:14', 0);

# --------------------------------------------------------

# 
# Table structure for table 'geo_zones'
# 

DROP TABLE IF EXISTS geo_zones;
CREATE TABLE IF NOT EXISTS geo_zones (
  geo_zone_id int(11) NOT NULL auto_increment,
  geo_zone_name varchar(32) NOT NULL default '',
  geo_zone_description varchar(255) NOT NULL default '',
  last_modified datetime default NULL,
  date_added datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (geo_zone_id)
);

# 
# Dumping data for table 'geo_zones'
# 

INSERT INTO geo_zones (geo_zone_id, geo_zone_name, geo_zone_description, last_modified, date_added) VALUES (1, 'Florida', 'Florida local sales tax zone', NULL, '2007-07-10 13:43:01');

# --------------------------------------------------------

# 
# Table structure for table 'languages'
# 

DROP TABLE IF EXISTS languages;
CREATE TABLE IF NOT EXISTS languages (
  languages_id int(11) NOT NULL auto_increment,
  name varchar(32) NOT NULL default '',
  code char(2) NOT NULL default '',
  image varchar(64) default NULL,
  directory varchar(32) default NULL,
  sort_order int(3) default NULL,
  PRIMARY KEY  (languages_id),
  KEY IDX_LANGUAGES_NAME (name)
);

# 
# Dumping data for table 'languages'
# 

INSERT INTO languages (languages_id, name, code, image, directory, sort_order) VALUES (1, 'English', 'en', 'icon.gif', 'english', 1);
INSERT INTO languages (languages_id, name, code, image, directory, sort_order) VALUES (2, 'Deutsch', 'de', 'icon.gif', 'german', 2);
INSERT INTO languages (languages_id, name, code, image, directory, sort_order) VALUES (3, 'Espanol', 'es', 'icon.gif', 'espanol', 3);

# --------------------------------------------------------

# 
# Table structure for table 'manufacturers'
# 

DROP TABLE IF EXISTS manufacturers;
CREATE TABLE IF NOT EXISTS manufacturers (
  manufacturers_id int(11) NOT NULL auto_increment,
  manufacturers_name varchar(32) NOT NULL default '',
  manufacturers_image varchar(64) default NULL,
  date_added datetime default NULL,
  last_modified datetime default NULL,
  PRIMARY KEY  (manufacturers_id),
  KEY IDX_MANUFACTURERS_NAME (manufacturers_name)
);

# 
# Dumping data for table 'manufacturers'
# 

INSERT INTO manufacturers (manufacturers_id, manufacturers_name, manufacturers_image, date_added, last_modified) VALUES (4, 'Example_1', '', '2007-07-10 13:43:01', '2007-07-11 15:06:21');
INSERT INTO manufacturers (manufacturers_id, manufacturers_name, manufacturers_image, date_added, last_modified) VALUES (8, 'Example_2', '', '2007-07-10 13:43:01', '2007-07-11 15:06:37');
INSERT INTO manufacturers (manufacturers_id, manufacturers_name, manufacturers_image, date_added, last_modified) VALUES (9, 'Example_3', '', '2007-07-10 13:43:01', '2007-07-11 15:06:52');

# --------------------------------------------------------

# 
# Table structure for table 'manufacturers_info'
# 

DROP TABLE IF EXISTS manufacturers_info;
CREATE TABLE IF NOT EXISTS manufacturers_info (
  manufacturers_id int(11) NOT NULL default '0',
  languages_id int(11) NOT NULL default '0',
  manufacturers_url varchar(255) NOT NULL default '',
  url_clicked int(5) NOT NULL default '0',
  date_last_click datetime default NULL,
  PRIMARY KEY  (manufacturers_id,languages_id)
);

# 
# Dumping data for table 'manufacturers_info'
# 

INSERT INTO manufacturers_info (manufacturers_id, languages_id, manufacturers_url, url_clicked, date_last_click) VALUES (4, 1, '', 0, NULL);
INSERT INTO manufacturers_info (manufacturers_id, languages_id, manufacturers_url, url_clicked, date_last_click) VALUES (4, 2, '', 0, NULL);
INSERT INTO manufacturers_info (manufacturers_id, languages_id, manufacturers_url, url_clicked, date_last_click) VALUES (4, 3, '', 0, NULL);
INSERT INTO manufacturers_info (manufacturers_id, languages_id, manufacturers_url, url_clicked, date_last_click) VALUES (8, 1, '', 0, NULL);
INSERT INTO manufacturers_info (manufacturers_id, languages_id, manufacturers_url, url_clicked, date_last_click) VALUES (8, 2, '', 0, NULL);
INSERT INTO manufacturers_info (manufacturers_id, languages_id, manufacturers_url, url_clicked, date_last_click) VALUES (8, 3, '', 0, NULL);
INSERT INTO manufacturers_info (manufacturers_id, languages_id, manufacturers_url, url_clicked, date_last_click) VALUES (9, 1, '', 0, NULL);
INSERT INTO manufacturers_info (manufacturers_id, languages_id, manufacturers_url, url_clicked, date_last_click) VALUES (9, 2, '', 0, NULL);
INSERT INTO manufacturers_info (manufacturers_id, languages_id, manufacturers_url, url_clicked, date_last_click) VALUES (9, 3, '', 0, NULL);

# --------------------------------------------------------

# 
# Table structure for table 'newsletters'
# 

DROP TABLE IF EXISTS newsletters;
CREATE TABLE IF NOT EXISTS newsletters (
  newsletters_id int(11) NOT NULL auto_increment,
  title varchar(255) NOT NULL default '',
  content text NOT NULL,
  module varchar(255) NOT NULL default '',
  date_added datetime NOT NULL default '0000-00-00 00:00:00',
  date_sent datetime default NULL,
  status int(1) default NULL,
  locked int(1) default '0',
  PRIMARY KEY  (newsletters_id)
);

# 
# Dumping data for table 'newsletters'
# 


# --------------------------------------------------------

# 
# Table structure for table 'orders'
# 

DROP TABLE IF EXISTS orders;
CREATE TABLE IF NOT EXISTS orders (
  orders_id int(11) NOT NULL auto_increment,
  customers_id int(11) NOT NULL default '0',
  customers_name varchar(64) NOT NULL default '',
  customers_company varchar(32) default NULL,
  customers_street_address varchar(64) NOT NULL default '',
  customers_suburb varchar(32) default NULL,
  customers_city varchar(32) NOT NULL default '',
  customers_postcode varchar(10) NOT NULL default '',
  customers_state varchar(32) default NULL,
  customers_country varchar(32) NOT NULL default '',
  customers_telephone varchar(32) NOT NULL default '',
  customers_email_address varchar(96) NOT NULL default '',
  customers_address_format_id int(5) NOT NULL default '0',
  delivery_name varchar(64) NOT NULL default '',
  delivery_company varchar(32) default NULL,
  delivery_street_address varchar(64) NOT NULL default '',
  delivery_suburb varchar(32) default NULL,
  delivery_city varchar(32) NOT NULL default '',
  delivery_postcode varchar(10) NOT NULL default '',
  delivery_state varchar(32) default NULL,
  delivery_country varchar(32) NOT NULL default '',
  delivery_address_format_id int(5) NOT NULL default '0',
  billing_name varchar(64) NOT NULL default '',
  billing_company varchar(32) default NULL,
  billing_street_address varchar(64) NOT NULL default '',
  billing_suburb varchar(32) default NULL,
  billing_city varchar(32) NOT NULL default '',
  billing_postcode varchar(10) NOT NULL default '',
  billing_state varchar(32) default NULL,
  billing_country varchar(32) NOT NULL default '',
  billing_address_format_id int(5) NOT NULL default '0',
  payment_method varchar(255) NOT NULL default '',
  cc_type varchar(20) default NULL,
  cc_owner varchar(64) default NULL,
  cc_number varchar(32) default NULL,
  cc_expires varchar(4) default NULL,
  last_modified datetime default NULL,
  date_purchased datetime default NULL,
  orders_status int(5) NOT NULL default '0',
  orders_date_finished datetime default NULL,
  currency char(3) default NULL,
  currency_value decimal(14,6) default NULL,
  PRIMARY KEY  (orders_id),
  KEY idx_orders_customers_id (customers_id)
);

# 
# Dumping data for table 'orders'
# 

INSERT INTO orders (orders_id, customers_id, customers_name, customers_company, customers_street_address, customers_suburb, customers_city, customers_postcode, customers_state, customers_country, customers_telephone, customers_email_address, customers_address_format_id, delivery_name, delivery_company, delivery_street_address, delivery_suburb, delivery_city, delivery_postcode, delivery_state, delivery_country, delivery_address_format_id, billing_name, billing_company, billing_street_address, billing_suburb, billing_city, billing_postcode, billing_state, billing_country, billing_address_format_id, payment_method, cc_type, cc_owner, cc_number, cc_expires, last_modified, date_purchased, orders_status, orders_date_finished, currency, currency_value) VALUES (1, 2, 'Fernando De Cortece', '', 'Suite 17, 2nd Floor, 223 Richardson Street', '', 'Casablanka', '53455543', 'Tyan-Shan', 'Thailand', '(010) 5454545454', 'aa@qq.com', 1, 'Fernando De Cortece', '', 'Suite 17, 2nd Floor, 223 Richardson Street', '', 'Casablanka', '53455543', 'Tyan-Shan', 'Thailand', 1, 'Fernando De Cortece', '', 'Suite 17, 2nd Floor, 223 Richardson Street', '', 'Casablanka', '53455543', 'Tyan-Shan', 'Thailand', 1, 'Cash on Delivery', '', '', '', '', NULL, '2007-07-11 12:55:35', 1, NULL, 'USD', 1.000000);
INSERT INTO orders (orders_id, customers_id, customers_name, customers_company, customers_street_address, customers_suburb, customers_city, customers_postcode, customers_state, customers_country, customers_telephone, customers_email_address, customers_address_format_id, delivery_name, delivery_company, delivery_street_address, delivery_suburb, delivery_city, delivery_postcode, delivery_state, delivery_country, delivery_address_format_id, billing_name, billing_company, billing_street_address, billing_suburb, billing_city, billing_postcode, billing_state, billing_country, billing_address_format_id, payment_method, cc_type, cc_owner, cc_number, cc_expires, last_modified, date_purchased, orders_status, orders_date_finished, currency, currency_value) VALUES (2, 2, 'Fernando De Cortece', '', 'Suite 17, 2nd Floor, 223 Richardson Street', '', 'Casablanka', '53455543', 'Tyan-Shan', 'Thailand', '(010) 5454545454', 'your@sea.com', 1, 'Fernando De Cortece', '', 'Suite 17, 2nd Floor, 223 Richardson Street', '', 'Casablanka', '53455543', 'Tyan-Shan', 'Thailand', 1, 'Fernando De Cortece', '', 'Suite 17, 2nd Floor, 223 Richardson Street', '', 'Casablanka', '53455543', 'Tyan-Shan', 'Thailand', 1, 'Cash on Delivery', '', '', '', '', NULL, '2007-07-11 13:48:40', 1, NULL, 'USD', 1.000000);
INSERT INTO orders (orders_id, customers_id, customers_name, customers_company, customers_street_address, customers_suburb, customers_city, customers_postcode, customers_state, customers_country, customers_telephone, customers_email_address, customers_address_format_id, delivery_name, delivery_company, delivery_street_address, delivery_suburb, delivery_city, delivery_postcode, delivery_state, delivery_country, delivery_address_format_id, billing_name, billing_company, billing_street_address, billing_suburb, billing_city, billing_postcode, billing_state, billing_country, billing_address_format_id, payment_method, cc_type, cc_owner, cc_number, cc_expires, last_modified, date_purchased, orders_status, orders_date_finished, currency, currency_value) VALUES (3, 2, 'Fernando De Cortece', '', 'Suite 17, 2nd Floor, 223 Richardson Street', '', 'Casablanka', '53455543', 'Tyan-Shan', 'Thailand', '(010) 5454545454', 'your@sea.com', 1, 'Fernando De Cortece', '', 'Suite 17, 2nd Floor, 223 Richardson Street', '', 'Casablanka', '53455543', 'Tyan-Shan', 'Thailand', 1, 'Fernando De Cortece', '', 'Suite 17, 2nd Floor, 223 Richardson Street', '', 'Casablanka', '53455543', 'Tyan-Shan', 'Thailand', 1, 'Cash on Delivery', '', '', '', '', NULL, '2007-07-11 14:14:37', 1, NULL, 'USD', 1.000000);
INSERT INTO orders (orders_id, customers_id, customers_name, customers_company, customers_street_address, customers_suburb, customers_city, customers_postcode, customers_state, customers_country, customers_telephone, customers_email_address, customers_address_format_id, delivery_name, delivery_company, delivery_street_address, delivery_suburb, delivery_city, delivery_postcode, delivery_state, delivery_country, delivery_address_format_id, billing_name, billing_company, billing_street_address, billing_suburb, billing_city, billing_postcode, billing_state, billing_country, billing_address_format_id, payment_method, cc_type, cc_owner, cc_number, cc_expires, last_modified, date_purchased, orders_status, orders_date_finished, currency, currency_value) VALUES (4, 2, 'Fernando De Cortece', '', 'Suite 17, 2nd Floor, 223 Richardson Street', '', 'Casablanka', '53455543', 'Tyan-Shan', 'Thailand', '(010) 5454545454', 'your@sea.com', 1, 'Fernando De Cortece', '', 'Suite 17, 2nd Floor, 223 Richardson Street', '', 'Casablanka', '53455543', 'Tyan-Shan', 'Thailand', 1, 'Fernando De Cortece', '', 'Suite 17, 2nd Floor, 223 Richardson Street', '', 'Casablanka', '53455543', 'Tyan-Shan', 'Thailand', 1, 'Cash on Delivery', '', '', '', '', NULL, '2007-07-11 14:14:40', 1, NULL, 'USD', 1.000000);
INSERT INTO orders (orders_id, customers_id, customers_name, customers_company, customers_street_address, customers_suburb, customers_city, customers_postcode, customers_state, customers_country, customers_telephone, customers_email_address, customers_address_format_id, delivery_name, delivery_company, delivery_street_address, delivery_suburb, delivery_city, delivery_postcode, delivery_state, delivery_country, delivery_address_format_id, billing_name, billing_company, billing_street_address, billing_suburb, billing_city, billing_postcode, billing_state, billing_country, billing_address_format_id, payment_method, cc_type, cc_owner, cc_number, cc_expires, last_modified, date_purchased, orders_status, orders_date_finished, currency, currency_value) VALUES (5, 2, 'Fernando De Cortece', '', 'Suite 17, 2nd Floor, 223 Richardson Street', '', 'Casablanka', '53455543', 'Tyan-Shan', 'Thailand', '(010) 5454545454', 'your@sea.com', 1, 'Fernando De Cortece', '', 'Suite 17, 2nd Floor, 223 Richardson Street', '', 'Casablanka', '53455543', 'Tyan-Shan', 'Thailand', 1, 'Fernando De Cortece', '', 'Suite 17, 2nd Floor, 223 Richardson Street', '', 'Casablanka', '53455543', 'Tyan-Shan', 'Thailand', 1, 'Cash on Delivery', '', '', '', '', NULL, '2007-07-11 14:18:44', 1, NULL, 'USD', 1.000000);
INSERT INTO orders (orders_id, customers_id, customers_name, customers_company, customers_street_address, customers_suburb, customers_city, customers_postcode, customers_state, customers_country, customers_telephone, customers_email_address, customers_address_format_id, delivery_name, delivery_company, delivery_street_address, delivery_suburb, delivery_city, delivery_postcode, delivery_state, delivery_country, delivery_address_format_id, billing_name, billing_company, billing_street_address, billing_suburb, billing_city, billing_postcode, billing_state, billing_country, billing_address_format_id, payment_method, cc_type, cc_owner, cc_number, cc_expires, last_modified, date_purchased, orders_status, orders_date_finished, currency, currency_value) VALUES (6, 2, 'Fernando De Cortece', '', 'Suite 17, 2nd Floor, 223 Richardson Street', '', 'Casablanka', '53455543', 'Tyan-Shan', 'Thailand', '(010) 5454545454', 'your@sea.com', 1, 'Fernando De Cortece', '', 'Suite 17, 2nd Floor, 223 Richardson Street', '', 'Casablanka', '53455543', 'Tyan-Shan', 'Thailand', 1, 'Fernando De Cortece', '', 'Suite 17, 2nd Floor, 223 Richardson Street', '', 'Casablanka', '53455543', 'Tyan-Shan', 'Thailand', 1, 'Cash on Delivery', '', '', '', '', NULL, '2007-07-11 14:18:46', 1, NULL, 'USD', 1.000000);
INSERT INTO orders (orders_id, customers_id, customers_name, customers_company, customers_street_address, customers_suburb, customers_city, customers_postcode, customers_state, customers_country, customers_telephone, customers_email_address, customers_address_format_id, delivery_name, delivery_company, delivery_street_address, delivery_suburb, delivery_city, delivery_postcode, delivery_state, delivery_country, delivery_address_format_id, billing_name, billing_company, billing_street_address, billing_suburb, billing_city, billing_postcode, billing_state, billing_country, billing_address_format_id, payment_method, cc_type, cc_owner, cc_number, cc_expires, last_modified, date_purchased, orders_status, orders_date_finished, currency, currency_value) VALUES (7, 2, 'Fernando De Cortece', '', 'Suite 17, 2nd Floor, 223 Richardson Street', '', 'Casablanka', '53455543', 'Tyan-Shan', 'Thailand', '(010) 5454545454', 'your@sea.com', 1, 'Fernando De Cortece', '', 'Suite 17, 2nd Floor, 223 Richardson Street', '', 'Casablanka', '53455543', 'Tyan-Shan', 'Thailand', 1, 'Fernando De Cortece', '', 'Suite 17, 2nd Floor, 223 Richardson Street', '', 'Casablanka', '53455543', 'Tyan-Shan', 'Thailand', 1, 'Cash on Delivery', '', '', '', '', NULL, '2007-10-10 11:05:27', 1, NULL, 'USD', 1.000000);
INSERT INTO orders (orders_id, customers_id, customers_name, customers_company, customers_street_address, customers_suburb, customers_city, customers_postcode, customers_state, customers_country, customers_telephone, customers_email_address, customers_address_format_id, delivery_name, delivery_company, delivery_street_address, delivery_suburb, delivery_city, delivery_postcode, delivery_state, delivery_country, delivery_address_format_id, billing_name, billing_company, billing_street_address, billing_suburb, billing_city, billing_postcode, billing_state, billing_country, billing_address_format_id, payment_method, cc_type, cc_owner, cc_number, cc_expires, last_modified, date_purchased, orders_status, orders_date_finished, currency, currency_value) VALUES (8, 2, 'Fernando De Cortece', '', 'Suite 17, 2nd Floor, 223 Richardson Street', '', 'Casablanka', '53455543', 'Tyan-Shan', 'Thailand', '(010) 5454545454', 'your@sea.com', 1, 'Fernando De Cortece', '', 'Suite 17, 2nd Floor, 223 Richardson Street', '', 'Casablanka', '53455543', 'Tyan-Shan', 'Thailand', 1, 'Fernando De Cortece', '', 'Suite 17, 2nd Floor, 223 Richardson Street', '', 'Casablanka', '53455543', 'Tyan-Shan', 'Thailand', 1, 'Cash on Delivery', '', '', '', '', NULL, '2008-01-24 13:21:56', 1, NULL, 'USD', 1.000000);
INSERT INTO orders (orders_id, customers_id, customers_name, customers_company, customers_street_address, customers_suburb, customers_city, customers_postcode, customers_state, customers_country, customers_telephone, customers_email_address, customers_address_format_id, delivery_name, delivery_company, delivery_street_address, delivery_suburb, delivery_city, delivery_postcode, delivery_state, delivery_country, delivery_address_format_id, billing_name, billing_company, billing_street_address, billing_suburb, billing_city, billing_postcode, billing_state, billing_country, billing_address_format_id, payment_method, cc_type, cc_owner, cc_number, cc_expires, last_modified, date_purchased, orders_status, orders_date_finished, currency, currency_value) VALUES (9, 2, 'Fernando De Cortece', '', 'Suite 17, 2nd Floor, 223 Richardson Street', '', 'Casablanka', '53455543', 'Tyan-Shan', 'Thailand', '(010) 5454545454', 'your@sea.com', 1, 'Fernando De Cortece', '', 'Suite 17, 2nd Floor, 223 Richardson Street', '', 'Casablanka', '53455543', 'Tyan-Shan', 'Thailand', 1, 'Fernando De Cortece', '', 'Suite 17, 2nd Floor, 223 Richardson Street', '', 'Casablanka', '53455543', 'Tyan-Shan', 'Thailand', 1, 'Cash on Delivery', '', '', '', '', NULL, '2008-04-08 10:44:16', 1, NULL, 'USD', 1.000000);

# --------------------------------------------------------

# 
# Table structure for table 'orders_products'
# 

DROP TABLE IF EXISTS orders_products;
CREATE TABLE IF NOT EXISTS orders_products (
  orders_products_id int(11) NOT NULL auto_increment,
  orders_id int(11) NOT NULL default '0',
  products_id int(11) NOT NULL default '0',
  products_model varchar(12) default NULL,
  products_name varchar(64) NOT NULL default '',
  products_price decimal(15,4) NOT NULL default '0.0000',
  final_price decimal(15,4) NOT NULL default '0.0000',
  products_tax decimal(7,4) NOT NULL default '0.0000',
  products_quantity int(2) NOT NULL default '0',
  PRIMARY KEY  (orders_products_id),
  KEY idx_orders_products_orders_id (orders_id),
  KEY idx_orders_products_products_id (products_id)
);

# 
# Dumping data for table 'orders_products'
# 

INSERT INTO orders_products (orders_products_id, orders_id, products_id, products_model, products_name, products_price, final_price, products_tax, products_quantity) VALUES (1, 1, 102, '', 'Slytherin 4735', 55.0000, 55.0000, 0.0000, 3);
INSERT INTO orders_products (orders_products_id, orders_id, products_id, products_model, products_name, products_price, final_price, products_tax, products_quantity) VALUES (2, 1, 100, '', 'Battleship', 44.0000, 44.0000, 0.0000, 1);
INSERT INTO orders_products (orders_products_id, orders_id, products_id, products_model, products_name, products_price, final_price, products_tax, products_quantity) VALUES (3, 1, 104, '', 'Vehicles Trevor', 63.0000, 63.0000, 0.0000, 1);
INSERT INTO orders_products (orders_products_id, orders_id, products_id, products_model, products_name, products_price, final_price, products_tax, products_quantity) VALUES (4, 1, 35, '', 'Crew Big Mike Mower', 80.0000, 80.0000, 0.0000, 2);
INSERT INTO orders_products (orders_products_id, orders_id, products_id, products_model, products_name, products_price, final_price, products_tax, products_quantity) VALUES (5, 2, 35, '', 'Crew Big Mike Mower', 80.0000, 80.0000, 0.0000, 1);
INSERT INTO orders_products (orders_products_id, orders_id, products_id, products_model, products_name, products_price, final_price, products_tax, products_quantity) VALUES (6, 2, 43, '', 'Imaginarium Bathtub', 80.0000, 80.0000, 0.0000, 1);
INSERT INTO orders_products (orders_products_id, orders_id, products_id, products_model, products_name, products_price, final_price, products_tax, products_quantity) VALUES (7, 3, 34, '', 'Playskool Yard', 30.0000, 30.0000, 0.0000, 1);
INSERT INTO orders_products (orders_products_id, orders_id, products_id, products_model, products_name, products_price, final_price, products_tax, products_quantity) VALUES (8, 4, 34, '', 'Playskool Yard', 30.0000, 30.0000, 0.0000, 1);
INSERT INTO orders_products (orders_products_id, orders_id, products_id, products_model, products_name, products_price, final_price, products_tax, products_quantity) VALUES (9, 5, 103, '', 'Learning Curve', 86.0000, 86.0000, 0.0000, 1);
INSERT INTO orders_products (orders_products_id, orders_id, products_id, products_model, products_name, products_price, final_price, products_tax, products_quantity) VALUES (10, 6, 103, '', 'Learning Curve', 86.0000, 86.0000, 0.0000, 1);
INSERT INTO orders_products (orders_products_id, orders_id, products_id, products_model, products_name, products_price, final_price, products_tax, products_quantity) VALUES (11, 7, 4, '', 'Womens Underwire', 58.0000, 58.0000, 0.0000, 1);
INSERT INTO orders_products (orders_products_id, orders_id, products_id, products_model, products_name, products_price, final_price, products_tax, products_quantity) VALUES (12, 7, 60, '', 'End Mens Straight', 64.0000, 64.0000, 0.0000, 1);
INSERT INTO orders_products (orders_products_id, orders_id, products_id, products_model, products_name, products_price, final_price, products_tax, products_quantity) VALUES (13, 7, 59, '', 'Sleeveless Tank', 30.0000, 30.0000, 0.0000, 1);
INSERT INTO orders_products (orders_products_id, orders_id, products_id, products_model, products_name, products_price, final_price, products_tax, products_quantity) VALUES (14, 7, 57, '', 'Liberty Cross', 61.0000, 61.0000, 0.0000, 1);
INSERT INTO orders_products (orders_products_id, orders_id, products_id, products_model, products_name, products_price, final_price, products_tax, products_quantity) VALUES (15, 7, 56, '', 'Eagle Shield', 53.0000, 53.0000, 0.0000, 1);
INSERT INTO orders_products (orders_products_id, orders_id, products_id, products_model, products_name, products_price, final_price, products_tax, products_quantity) VALUES (16, 7, 55, '', 'Short Chest', 52.0000, 52.0000, 0.0000, 1);
INSERT INTO orders_products (orders_products_id, orders_id, products_id, products_model, products_name, products_price, final_price, products_tax, products_quantity) VALUES (17, 7, 5, '', 'Blues Thong', 30.0000, 30.0000, 0.0000, 1);
INSERT INTO orders_products (orders_products_id, orders_id, products_id, products_model, products_name, products_price, final_price, products_tax, products_quantity) VALUES (18, 7, 6, '', 'Cotton Wide', 30.0000, 30.0000, 0.0000, 1);
INSERT INTO orders_products (orders_products_id, orders_id, products_id, products_model, products_name, products_price, final_price, products_tax, products_quantity) VALUES (19, 7, 38, '', 'Mens GORE-TEX', 40.0000, 40.0000, 0.0000, 1);
INSERT INTO orders_products (orders_products_id, orders_id, products_id, products_model, products_name, products_price, final_price, products_tax, products_quantity) VALUES (20, 8, 38, '', 'Mens GORE-TEX', 40.0000, 40.0000, 0.0000, 1);
INSERT INTO orders_products (orders_products_id, orders_id, products_id, products_model, products_name, products_price, final_price, products_tax, products_quantity) VALUES (21, 8, 59, '', 'Sleeveless Tank', 30.0000, 30.0000, 0.0000, 1);
INSERT INTO orders_products (orders_products_id, orders_id, products_id, products_model, products_name, products_price, final_price, products_tax, products_quantity) VALUES (22, 9, 15, '', 'Long Sleeve', 60.0000, 60.0000, 0.0000, 1);
INSERT INTO orders_products (orders_products_id, orders_id, products_id, products_model, products_name, products_price, final_price, products_tax, products_quantity) VALUES (23, 9, 26, '', 'Blues Relaxed', 83.0000, 83.0000, 0.0000, 1);
INSERT INTO orders_products (orders_products_id, orders_id, products_id, products_model, products_name, products_price, final_price, products_tax, products_quantity) VALUES (24, 9, 25, '', 'Pleated CoolMax', 76.0000, 76.0000, 0.0000, 1);
INSERT INTO orders_products (orders_products_id, orders_id, products_id, products_model, products_name, products_price, final_price, products_tax, products_quantity) VALUES (25, 9, 6, '', 'Cotton Wide', 30.0000, 30.0000, 0.0000, 1);
INSERT INTO orders_products (orders_products_id, orders_id, products_id, products_model, products_name, products_price, final_price, products_tax, products_quantity) VALUES (26, 9, 24, '', 'Mens Merino Polo', 90.0000, 90.0000, 0.0000, 1);
INSERT INTO orders_products (orders_products_id, orders_id, products_id, products_model, products_name, products_price, final_price, products_tax, products_quantity) VALUES (27, 9, 13, '', 'Short Sleeve', 73.0000, 73.0000, 0.0000, 1);
INSERT INTO orders_products (orders_products_id, orders_id, products_id, products_model, products_name, products_price, final_price, products_tax, products_quantity) VALUES (28, 9, 9, '', 'Acrylic Amicor', 51.0000, 51.0000, 0.0000, 1);
INSERT INTO orders_products (orders_products_id, orders_id, products_id, products_model, products_name, products_price, final_price, products_tax, products_quantity) VALUES (29, 9, 4, '', 'Womens Underwire', 32.0000, 32.0000, 0.0000, 1);
INSERT INTO orders_products (orders_products_id, orders_id, products_id, products_model, products_name, products_price, final_price, products_tax, products_quantity) VALUES (30, 9, 2, '', 'Rib One Piece', 71.0000, 61.0000, 0.0000, 1);

# --------------------------------------------------------

# 
# Table structure for table 'orders_products_attributes'
# 

DROP TABLE IF EXISTS orders_products_attributes;
CREATE TABLE IF NOT EXISTS orders_products_attributes (
  orders_products_attributes_id int(11) NOT NULL auto_increment,
  orders_id int(11) NOT NULL default '0',
  orders_products_id int(11) NOT NULL default '0',
  products_options varchar(32) NOT NULL default '',
  products_options_values varchar(32) NOT NULL default '',
  options_values_price decimal(15,4) NOT NULL default '0.0000',
  price_prefix char(1) NOT NULL default '',
  PRIMARY KEY  (orders_products_attributes_id),
  KEY idx_orders_products_att_orders_id (orders_id)
);

# 
# Dumping data for table 'orders_products_attributes'
# 

INSERT INTO orders_products_attributes (orders_products_attributes_id, orders_id, orders_products_id, products_options, products_options_values, options_values_price, price_prefix) VALUES (1, 1, 3, 'Color', '16 mb', 0.0000, '+');
INSERT INTO orders_products_attributes (orders_products_attributes_id, orders_id, orders_products_id, products_options, products_options_values, options_values_price, price_prefix) VALUES (2, 9, 23, 'Model', 'PS/2', 0.0000, '+');
INSERT INTO orders_products_attributes (orders_products_attributes_id, orders_id, orders_products_id, products_options, products_options_values, options_values_price, price_prefix) VALUES (3, 9, 30, 'Memory', '16 mb', 10.0000, '-');
INSERT INTO orders_products_attributes (orders_products_attributes_id, orders_id, orders_products_id, products_options, products_options_values, options_values_price, price_prefix) VALUES (4, 9, 30, 'Model', 'Premium', 0.0000, '+');

# --------------------------------------------------------

# 
# Table structure for table 'orders_products_download'
# 

DROP TABLE IF EXISTS orders_products_download;
CREATE TABLE IF NOT EXISTS orders_products_download (
  orders_products_download_id int(11) NOT NULL auto_increment,
  orders_id int(11) NOT NULL default '0',
  orders_products_id int(11) NOT NULL default '0',
  orders_products_filename varchar(255) NOT NULL default '',
  download_maxdays int(2) NOT NULL default '0',
  download_count int(2) NOT NULL default '0',
  PRIMARY KEY  (orders_products_download_id),
  KEY idx_orders_products_download_orders_id (orders_id)
);

# 
# Dumping data for table 'orders_products_download'
# 


# --------------------------------------------------------

# 
# Table structure for table 'orders_status'
# 

DROP TABLE IF EXISTS orders_status;
CREATE TABLE IF NOT EXISTS orders_status (
  orders_status_id int(11) NOT NULL default '0',
  language_id int(11) NOT NULL default '1',
  orders_status_name varchar(32) NOT NULL default '',
  public_flag int(11) default '1',
  downloads_flag int(11) default '0',
  PRIMARY KEY  (orders_status_id,language_id),
  KEY idx_orders_status_name (orders_status_name)
);

# 
# Dumping data for table 'orders_status'
# 

INSERT INTO orders_status (orders_status_id, language_id, orders_status_name, public_flag, downloads_flag) VALUES (1, 1, 'Pending', 1, 0);
INSERT INTO orders_status (orders_status_id, language_id, orders_status_name, public_flag, downloads_flag) VALUES (1, 2, 'Offen', 1, 0);
INSERT INTO orders_status (orders_status_id, language_id, orders_status_name, public_flag, downloads_flag) VALUES (1, 3, 'Pendiente', 1, 0);
INSERT INTO orders_status (orders_status_id, language_id, orders_status_name, public_flag, downloads_flag) VALUES (2, 1, 'Processing', 1, 0);
INSERT INTO orders_status (orders_status_id, language_id, orders_status_name, public_flag, downloads_flag) VALUES (2, 2, 'In Bearbeitung', 1, 0);
INSERT INTO orders_status (orders_status_id, language_id, orders_status_name, public_flag, downloads_flag) VALUES (2, 3, 'Proceso', 1, 0);
INSERT INTO orders_status (orders_status_id, language_id, orders_status_name, public_flag, downloads_flag) VALUES (3, 1, 'Delivered', 1, 0);
INSERT INTO orders_status (orders_status_id, language_id, orders_status_name, public_flag, downloads_flag) VALUES (3, 2, 'Versendet', 1, 0);
INSERT INTO orders_status (orders_status_id, language_id, orders_status_name, public_flag, downloads_flag) VALUES (3, 3, 'Entregado', 1, 0);

# --------------------------------------------------------

# 
# Table structure for table 'orders_status_history'
# 

DROP TABLE IF EXISTS orders_status_history;
CREATE TABLE IF NOT EXISTS orders_status_history (
  orders_status_history_id int(11) NOT NULL auto_increment,
  orders_id int(11) NOT NULL default '0',
  orders_status_id int(5) NOT NULL default '0',
  date_added datetime NOT NULL default '0000-00-00 00:00:00',
  customer_notified int(1) default '0',
  comments text,
  PRIMARY KEY  (orders_status_history_id),
  KEY idx_orders_status_history_orders_id (orders_id)
);

# 
# Dumping data for table 'orders_status_history'
# 

INSERT INTO orders_status_history (orders_status_history_id, orders_id, orders_status_id, date_added, customer_notified, comments) VALUES (1, 1, 1, '2007-07-11 12:55:35', 1, '');
INSERT INTO orders_status_history (orders_status_history_id, orders_id, orders_status_id, date_added, customer_notified, comments) VALUES (2, 2, 1, '2007-07-11 13:48:40', 1, '');
INSERT INTO orders_status_history (orders_status_history_id, orders_id, orders_status_id, date_added, customer_notified, comments) VALUES (3, 3, 1, '2007-07-11 14:14:37', 1, '');
INSERT INTO orders_status_history (orders_status_history_id, orders_id, orders_status_id, date_added, customer_notified, comments) VALUES (4, 4, 1, '2007-07-11 14:14:40', 1, '');
INSERT INTO orders_status_history (orders_status_history_id, orders_id, orders_status_id, date_added, customer_notified, comments) VALUES (5, 5, 1, '2007-07-11 14:18:44', 1, '');
INSERT INTO orders_status_history (orders_status_history_id, orders_id, orders_status_id, date_added, customer_notified, comments) VALUES (6, 6, 1, '2007-07-11 14:18:46', 1, '');
INSERT INTO orders_status_history (orders_status_history_id, orders_id, orders_status_id, date_added, customer_notified, comments) VALUES (7, 7, 1, '2007-10-10 11:05:27', 1, '');
INSERT INTO orders_status_history (orders_status_history_id, orders_id, orders_status_id, date_added, customer_notified, comments) VALUES (8, 8, 1, '2008-01-24 13:21:56', 1, '');
INSERT INTO orders_status_history (orders_status_history_id, orders_id, orders_status_id, date_added, customer_notified, comments) VALUES (9, 9, 1, '2008-04-08 10:44:16', 1, '');

# --------------------------------------------------------

# 
# Table structure for table 'orders_total'
# 

DROP TABLE IF EXISTS orders_total;
CREATE TABLE IF NOT EXISTS orders_total (
  orders_total_id int(10) unsigned NOT NULL auto_increment,
  orders_id int(11) NOT NULL default '0',
  title varchar(255) NOT NULL default '',
  text varchar(255) NOT NULL default '',
  value decimal(15,4) NOT NULL default '0.0000',
  class varchar(32) NOT NULL default '',
  sort_order int(11) NOT NULL default '0',
  PRIMARY KEY  (orders_total_id),
  KEY idx_orders_total_orders_id (orders_id)
);

# 
# Dumping data for table 'orders_total'
# 

INSERT INTO orders_total (orders_total_id, orders_id, title, text, value, class, sort_order) VALUES (1, 1, 'Sub-Total:', '$432.00', 432.0000, 'ot_subtotal', 1);
INSERT INTO orders_total (orders_total_id, orders_id, title, text, value, class, sort_order) VALUES (2, 1, 'Flat Rate (Best Way):', '$5.00', 5.0000, 'ot_shipping', 2);
INSERT INTO orders_total (orders_total_id, orders_id, title, text, value, class, sort_order) VALUES (3, 1, 'Total:', '<b>$437.00</b>', 437.0000, 'ot_total', 4);
INSERT INTO orders_total (orders_total_id, orders_id, title, text, value, class, sort_order) VALUES (4, 2, 'Sub-Total:', '$160.00', 160.0000, 'ot_subtotal', 1);
INSERT INTO orders_total (orders_total_id, orders_id, title, text, value, class, sort_order) VALUES (5, 2, 'Flat Rate (Best Way):', '$5.00', 5.0000, 'ot_shipping', 2);
INSERT INTO orders_total (orders_total_id, orders_id, title, text, value, class, sort_order) VALUES (6, 2, 'Total:', '<b>$165.00</b>', 165.0000, 'ot_total', 4);
INSERT INTO orders_total (orders_total_id, orders_id, title, text, value, class, sort_order) VALUES (7, 3, 'Sub-Total:', '$30.00', 30.0000, 'ot_subtotal', 1);
INSERT INTO orders_total (orders_total_id, orders_id, title, text, value, class, sort_order) VALUES (8, 3, 'Flat Rate (Best Way):', '$5.00', 5.0000, 'ot_shipping', 2);
INSERT INTO orders_total (orders_total_id, orders_id, title, text, value, class, sort_order) VALUES (9, 3, 'Total:', '<b>$35.00</b>', 35.0000, 'ot_total', 4);
INSERT INTO orders_total (orders_total_id, orders_id, title, text, value, class, sort_order) VALUES (10, 4, 'Sub-Total:', '$30.00', 30.0000, 'ot_subtotal', 1);
INSERT INTO orders_total (orders_total_id, orders_id, title, text, value, class, sort_order) VALUES (11, 4, 'Flat Rate (Best Way):', '$5.00', 5.0000, 'ot_shipping', 2);
INSERT INTO orders_total (orders_total_id, orders_id, title, text, value, class, sort_order) VALUES (12, 4, 'Total:', '<b>$35.00</b>', 35.0000, 'ot_total', 4);
INSERT INTO orders_total (orders_total_id, orders_id, title, text, value, class, sort_order) VALUES (13, 5, 'Sub-Total:', '$86.00', 86.0000, 'ot_subtotal', 1);
INSERT INTO orders_total (orders_total_id, orders_id, title, text, value, class, sort_order) VALUES (14, 5, 'Flat Rate (Best Way):', '$5.00', 5.0000, 'ot_shipping', 2);
INSERT INTO orders_total (orders_total_id, orders_id, title, text, value, class, sort_order) VALUES (15, 5, 'Total:', '<b>$91.00</b>', 91.0000, 'ot_total', 4);
INSERT INTO orders_total (orders_total_id, orders_id, title, text, value, class, sort_order) VALUES (16, 6, 'Sub-Total:', '$86.00', 86.0000, 'ot_subtotal', 1);
INSERT INTO orders_total (orders_total_id, orders_id, title, text, value, class, sort_order) VALUES (17, 6, 'Flat Rate (Best Way):', '$5.00', 5.0000, 'ot_shipping', 2);
INSERT INTO orders_total (orders_total_id, orders_id, title, text, value, class, sort_order) VALUES (18, 6, 'Total:', '<b>$91.00</b>', 91.0000, 'ot_total', 4);
INSERT INTO orders_total (orders_total_id, orders_id, title, text, value, class, sort_order) VALUES (19, 7, 'Sub-Total:', '$418.00', 418.0000, 'ot_subtotal', 1);
INSERT INTO orders_total (orders_total_id, orders_id, title, text, value, class, sort_order) VALUES (20, 7, 'Flat Rate (Best Way):', '$5.00', 5.0000, 'ot_shipping', 2);
INSERT INTO orders_total (orders_total_id, orders_id, title, text, value, class, sort_order) VALUES (21, 7, 'Total:', '<b>$423.00</b>', 423.0000, 'ot_total', 4);
INSERT INTO orders_total (orders_total_id, orders_id, title, text, value, class, sort_order) VALUES (22, 8, 'Sub-Total:', '$70.00', 70.0000, 'ot_subtotal', 1);
INSERT INTO orders_total (orders_total_id, orders_id, title, text, value, class, sort_order) VALUES (23, 8, 'Flat Rate (Best Way):', '$5.00', 5.0000, 'ot_shipping', 2);
INSERT INTO orders_total (orders_total_id, orders_id, title, text, value, class, sort_order) VALUES (24, 8, 'Total:', '<b>$75.00</b>', 75.0000, 'ot_total', 4);
INSERT INTO orders_total (orders_total_id, orders_id, title, text, value, class, sort_order) VALUES (25, 9, 'Sub-Total:', '$556.00', 556.0000, 'ot_subtotal', 1);
INSERT INTO orders_total (orders_total_id, orders_id, title, text, value, class, sort_order) VALUES (26, 9, 'Flat Rate (Best Way):', '$5.00', 5.0000, 'ot_shipping', 2);
INSERT INTO orders_total (orders_total_id, orders_id, title, text, value, class, sort_order) VALUES (27, 9, 'Total:', '<b>$561.00</b>', 561.0000, 'ot_total', 4);

# --------------------------------------------------------

# 
# Table structure for table 'products'
# 

DROP TABLE IF EXISTS products;
CREATE TABLE IF NOT EXISTS products (
  products_id int(11) NOT NULL auto_increment,
  products_quantity int(4) NOT NULL default '0',
  products_model varchar(12) default NULL,
  products_image varchar(64) default NULL,
  products_price decimal(15,4) NOT NULL default '0.0000',
  products_date_added datetime NOT NULL default '0000-00-00 00:00:00',
  products_last_modified datetime default NULL,
  products_date_available datetime default NULL,
  products_weight decimal(5,2) NOT NULL default '0.00',
  products_status tinyint(1) NOT NULL default '0',
  products_tax_class_id int(11) NOT NULL default '0',
  manufacturers_id int(11) default NULL,
  products_ordered int(11) NOT NULL default '0',
  PRIMARY KEY  (products_id),
  KEY idx_products_date_added (products_date_added)
);

# 
# Dumping data for table 'products'
# 

INSERT INTO products (products_id, products_quantity, products_model, products_image, products_price, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered) VALUES (1, 1000, '', 'skin_1.jpg', 39.0000, '2006-08-00 00:00:00', '2006-08-00 00:00:00', NULL, 0.00, 1, 0, 0, 0);
INSERT INTO products (products_id, products_quantity, products_model, products_image, products_price, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered) VALUES (2, 999, '', 'skin_2.jpg', 71.0000, '2006-08-00 00:00:01', '2006-08-00 00:00:01', NULL, 0.00, 1, 0, 0, 1);
INSERT INTO products (products_id, products_quantity, products_model, products_image, products_price, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered) VALUES (3, 1000, '', 'skin_3.jpg', 46.0000, '2006-08-00 00:00:02', '2006-08-00 00:00:02', NULL, 0.00, 1, 0, 0, 0);
INSERT INTO products (products_id, products_quantity, products_model, products_image, products_price, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered) VALUES (4, 999, '', 'skin_4.jpg', 32.0000, '2006-08-00 00:00:03', '2006-08-00 00:00:03', NULL, 0.00, 1, 0, 0, 1);
INSERT INTO products (products_id, products_quantity, products_model, products_image, products_price, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered) VALUES (5, 1000, '', 'skin_5.jpg', 46.0000, '2006-08-00 00:00:04', '2006-08-00 00:00:04', NULL, 0.00, 1, 0, 0, 0);
INSERT INTO products (products_id, products_quantity, products_model, products_image, products_price, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered) VALUES (6, 999, '', 'skin_6.jpg', 52.0000, '2006-08-00 00:00:05', '2006-08-00 00:00:05', NULL, 0.00, 1, 0, 0, 1);
INSERT INTO products (products_id, products_quantity, products_model, products_image, products_price, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered) VALUES (7, 1000, '', 'skin_7.jpg', 80.0000, '2006-08-00 00:00:06', '2006-08-00 00:00:06', NULL, 0.00, 1, 0, 0, 0);
INSERT INTO products (products_id, products_quantity, products_model, products_image, products_price, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered) VALUES (8, 1000, '', 'skin_8.jpg', 59.0000, '2006-08-00 00:00:07', '2006-08-00 00:00:07', NULL, 0.00, 1, 0, 0, 0);
INSERT INTO products (products_id, products_quantity, products_model, products_image, products_price, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered) VALUES (9, 999, '', 'skin_9.jpg', 51.0000, '2006-08-00 00:00:08', '2006-08-00 00:00:08', NULL, 0.00, 1, 0, 0, 1);
INSERT INTO products (products_id, products_quantity, products_model, products_image, products_price, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered) VALUES (10, 1000, '', 'skin_10.jpg', 49.0000, '2006-08-00 00:00:09', '2006-08-00 00:00:09', NULL, 0.00, 1, 0, 0, 0);
INSERT INTO products (products_id, products_quantity, products_model, products_image, products_price, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered) VALUES (11, 1000, '', 'skin_11.jpg', 56.0000, '2006-08-00 00:00:10', '2008-04-08 10:44:59', NULL, 0.00, 1, 0, 4, 0);
INSERT INTO products (products_id, products_quantity, products_model, products_image, products_price, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered) VALUES (12, 1000, '', 'skin_12.jpg', 41.0000, '2006-08-00 00:00:11', '2008-04-08 10:45:04', NULL, 0.00, 1, 0, 4, 0);
INSERT INTO products (products_id, products_quantity, products_model, products_image, products_price, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered) VALUES (13, 999, '', 'skin_13.jpg', 73.0000, '2006-08-00 00:00:12', '2006-08-00 00:00:12', NULL, 0.00, 1, 0, 0, 1);
INSERT INTO products (products_id, products_quantity, products_model, products_image, products_price, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered) VALUES (14, 1000, '', 'skin_14.jpg', 58.0000, '2006-08-00 00:00:13', '2006-08-00 00:00:13', NULL, 0.00, 1, 0, 0, 0);
INSERT INTO products (products_id, products_quantity, products_model, products_image, products_price, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered) VALUES (15, 999, '', 'skin_15.jpg', 60.0000, '2006-08-00 00:00:14', '2006-08-00 00:00:14', NULL, 0.00, 1, 0, 0, 1);
INSERT INTO products (products_id, products_quantity, products_model, products_image, products_price, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered) VALUES (16, 1000, '', 'skin_16.jpg', 88.0000, '2006-08-00 00:00:15', '2006-08-00 00:00:15', NULL, 0.00, 1, 0, 0, 0);
INSERT INTO products (products_id, products_quantity, products_model, products_image, products_price, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered) VALUES (17, 1000, '', 'skin_17.jpg', 47.0000, '2006-08-00 00:00:16', '2006-08-00 00:00:16', NULL, 0.00, 1, 0, 0, 0);
INSERT INTO products (products_id, products_quantity, products_model, products_image, products_price, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered) VALUES (18, 1000, '', 'skin_18.jpg', 44.0000, '2006-08-00 00:00:17', '2006-08-00 00:00:17', NULL, 0.00, 1, 0, 0, 0);
INSERT INTO products (products_id, products_quantity, products_model, products_image, products_price, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered) VALUES (19, 1000, '', 'skin_19.jpg', 33.0000, '2006-08-00 00:00:18', '2006-08-00 00:00:18', NULL, 0.00, 1, 0, 0, 0);
INSERT INTO products (products_id, products_quantity, products_model, products_image, products_price, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered) VALUES (20, 1000, '', 'skin_20.jpg', 54.0000, '2006-08-00 00:00:19', '2008-04-08 10:45:13', NULL, 0.00, 1, 0, 8, 0);
INSERT INTO products (products_id, products_quantity, products_model, products_image, products_price, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered) VALUES (21, 1000, '', 'skin_21.jpg', 37.0000, '2006-08-00 00:00:20', '2006-08-00 00:00:20', NULL, 0.00, 1, 0, 0, 0);
INSERT INTO products (products_id, products_quantity, products_model, products_image, products_price, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered) VALUES (22, 1000, '', 'skin_22.jpg', 57.0000, '2006-08-00 00:00:21', '2006-08-00 00:00:21', NULL, 0.00, 1, 0, 0, 0);
INSERT INTO products (products_id, products_quantity, products_model, products_image, products_price, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered) VALUES (23, 1000, '', 'skin_23.jpg', 45.0000, '2006-08-00 00:00:22', '2006-08-00 00:00:22', NULL, 0.00, 1, 0, 0, 0);
INSERT INTO products (products_id, products_quantity, products_model, products_image, products_price, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered) VALUES (24, 999, '', 'skin_24.jpg', 90.0000, '2006-08-00 00:00:23', '2006-08-00 00:00:23', NULL, 0.00, 1, 0, 0, 1);
INSERT INTO products (products_id, products_quantity, products_model, products_image, products_price, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered) VALUES (25, 999, '', 'skin_25.jpg', 76.0000, '2006-08-00 00:00:24', '2006-08-00 00:00:24', NULL, 0.00, 1, 0, 0, 1);
INSERT INTO products (products_id, products_quantity, products_model, products_image, products_price, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered) VALUES (26, 999, '', 'skin_26.jpg', 83.0000, '2006-08-00 00:00:25', '2006-08-00 00:00:25', NULL, 0.00, 1, 0, 0, 1);

# --------------------------------------------------------

# 
# Table structure for table 'products_attributes'
# 

DROP TABLE IF EXISTS products_attributes;
CREATE TABLE IF NOT EXISTS products_attributes (
  products_attributes_id int(11) NOT NULL auto_increment,
  products_id int(11) NOT NULL default '0',
  options_id int(11) NOT NULL default '0',
  options_values_id int(11) NOT NULL default '0',
  options_values_price decimal(15,4) NOT NULL default '0.0000',
  price_prefix char(1) NOT NULL default '',
  PRIMARY KEY  (products_attributes_id),
  KEY idx_products_attributes_products_id (products_id)
);

# 
# Dumping data for table 'products_attributes'
# 

INSERT INTO products_attributes (products_attributes_id, products_id, options_id, options_values_id, options_values_price, price_prefix) VALUES (1, 1, 4, 1, 0.0000, '+');
INSERT INTO products_attributes (products_attributes_id, products_id, options_id, options_values_id, options_values_price, price_prefix) VALUES (2, 1, 4, 2, 50.0000, '+');
INSERT INTO products_attributes (products_attributes_id, products_id, options_id, options_values_id, options_values_price, price_prefix) VALUES (3, 1, 4, 3, 70.0000, '+');
INSERT INTO products_attributes (products_attributes_id, products_id, options_id, options_values_id, options_values_price, price_prefix) VALUES (4, 1, 3, 5, 0.0000, '+');
INSERT INTO products_attributes (products_attributes_id, products_id, options_id, options_values_id, options_values_price, price_prefix) VALUES (5, 1, 3, 6, 100.0000, '+');
INSERT INTO products_attributes (products_attributes_id, products_id, options_id, options_values_id, options_values_price, price_prefix) VALUES (6, 2, 4, 3, 10.0000, '-');
INSERT INTO products_attributes (products_attributes_id, products_id, options_id, options_values_id, options_values_price, price_prefix) VALUES (7, 2, 4, 4, 0.0000, '+');
INSERT INTO products_attributes (products_attributes_id, products_id, options_id, options_values_id, options_values_price, price_prefix) VALUES (8, 2, 3, 6, 0.0000, '+');
INSERT INTO products_attributes (products_attributes_id, products_id, options_id, options_values_id, options_values_price, price_prefix) VALUES (9, 2, 3, 7, 120.0000, '+');
INSERT INTO products_attributes (products_attributes_id, products_id, options_id, options_values_id, options_values_price, price_prefix) VALUES (10, 26, 3, 8, 0.0000, '+');
INSERT INTO products_attributes (products_attributes_id, products_id, options_id, options_values_id, options_values_price, price_prefix) VALUES (11, 26, 3, 9, 6.0000, '+');
INSERT INTO products_attributes (products_attributes_id, products_id, options_id, options_values_id, options_values_price, price_prefix) VALUES (26, 22, 5, 10, 0.0000, '+');
INSERT INTO products_attributes (products_attributes_id, products_id, options_id, options_values_id, options_values_price, price_prefix) VALUES (27, 22, 5, 13, 0.0000, '+');
INSERT INTO products_attributes (products_attributes_id, products_id, options_id, options_values_id, options_values_price, price_prefix) VALUES (28, 58, 1, 3, 0.0000, '+');
INSERT INTO products_attributes (products_attributes_id, products_id, options_id, options_values_id, options_values_price, price_prefix) VALUES (29, 12, 1, 3, 0.0000, '+');
INSERT INTO products_attributes (products_attributes_id, products_id, options_id, options_values_id, options_values_price, price_prefix) VALUES (30, 104, 1, 3, 0.0000, '+');

# --------------------------------------------------------

# 
# Table structure for table 'products_attributes_download'
# 

DROP TABLE IF EXISTS products_attributes_download;
CREATE TABLE IF NOT EXISTS products_attributes_download (
  products_attributes_id int(11) NOT NULL default '0',
  products_attributes_filename varchar(255) NOT NULL default '',
  products_attributes_maxdays int(2) default '0',
  products_attributes_maxcount int(2) default '0',
  PRIMARY KEY  (products_attributes_id)
);

# 
# Dumping data for table 'products_attributes_download'
# 

INSERT INTO products_attributes_download (products_attributes_id, products_attributes_filename, products_attributes_maxdays, products_attributes_maxcount) VALUES (26, 'unreal.zip', 7, 3);

# --------------------------------------------------------

# 
# Table structure for table 'products_description'
# 

DROP TABLE IF EXISTS products_description;
CREATE TABLE IF NOT EXISTS products_description (
  products_id int(11) NOT NULL auto_increment,
  language_id int(11) NOT NULL default '1',
  products_name varchar(64) NOT NULL default '',
  products_description text,
  products_url varchar(255) default NULL,
  products_viewed int(5) default '0',
  PRIMARY KEY  (products_id,language_id),
  KEY products_name (products_name)
);

# 
# Dumping data for table 'products_description'
# 

INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (1, 1, 'Womens Solid Beach', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (1, 2, 'Womens Solid Beach', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (1, 3, 'Womens Solid Beach', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (2, 1, 'Rib One Piece', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 1);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (2, 2, 'Rib One Piece', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (2, 3, 'Rib One Piece', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (3, 1, 'Orchid Leapord Mailot', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (3, 2, 'Orchid Leapord Mailot', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (3, 3, 'Orchid Leapord Mailot', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (4, 1, 'Womens Underwire', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (4, 2, 'Womens Underwire', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (4, 3, 'Womens Underwire', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (5, 1, 'Blues Thong', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (5, 2, 'Blues Thong', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (5, 3, 'Blues Thong', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (6, 1, 'Cotton Wide', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (6, 2, 'Cotton Wide', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (6, 3, 'Cotton Wide', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (7, 1, 'Kenwood Socks', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (7, 2, 'Kenwood Socks', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (7, 3, 'Kenwood Socks', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (8, 1, 'Pin Dot Socks', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (8, 2, 'Pin Dot Socks', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (8, 3, 'Pin Dot Socks', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (9, 1, 'Acrylic Amicor', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (9, 2, 'Acrylic Amicor', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (9, 3, 'Acrylic Amicor', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (10, 1, 'Womens Beach', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (10, 2, 'Womens Beach', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (10, 3, 'Womens Beach', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (11, 1, 'Hi Waist Bottom', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (11, 2, 'Hi Waist Bottom', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (11, 3, 'Hi Waist Bottom', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (12, 1, 'Hipster Buckle', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (12, 2, 'Hipster Buckle', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (12, 3, 'Hipster Buckle', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (13, 1, 'Short Sleeve', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (13, 2, 'Short Sleeve', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (13, 3, 'Short Sleeve', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (14, 1, 'Carpenter Bib', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (14, 2, 'Carpenter Bib', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (14, 3, 'Carpenter Bib', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (15, 1, 'Long Sleeve', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (15, 2, 'Long Sleeve', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (15, 3, 'Long Sleeve', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (16, 1, 'Twill Pants', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (16, 2, 'Twill Pants', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (16, 3, 'Twill Pants', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (17, 1, 'Long Shirts', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (17, 2, 'Long Shirts', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (17, 3, 'Long Shirts', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (18, 1, 'Carpenter Jean', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (18, 2, 'Carpenter Jean', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (18, 3, 'Carpenter Jean', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (19, 1, 'Mens Sweater', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (19, 2, 'Mens Sweater', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (19, 3, 'Mens Sweater', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (20, 1, 'Mens Cashmere', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (20, 2, 'Mens Cashmere', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (20, 3, 'Mens Cashmere', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (21, 1, 'Mens Tone', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (21, 2, 'Mens Tone', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (21, 3, 'Mens Tone', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (22, 1, 'Mens Mock Sweater', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (22, 2, 'Mens Mock Sweater', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (22, 3, 'Mens Mock Sweater', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (23, 1, 'Mens Merino Vest', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (23, 2, 'Mens Merino Vest', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (23, 3, 'Mens Merino Vest', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (24, 1, 'Mens Merino Polo', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (24, 2, 'Mens Merino Polo', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (24, 3, 'Mens Merino Polo', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (25, 1, 'Pleated CoolMax', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 1);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (25, 2, 'Pleated CoolMax', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (25, 3, 'Pleated CoolMax', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (26, 1, 'Blues Relaxed', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 1);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (26, 2, 'Blues Relaxed', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);
INSERT INTO products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) VALUES (26, 3, 'Blues Relaxed', 'Mauris eget diam. Integer nisl neque, tempus quis, varius sed, suscipit sed, augue. Nam cursus dui sit amet nibh. Suspendisse sem metus, semper ac, egestas nec, fermentum non, lectus. Sed nisl. Nulla eros. Nullam in justo. In lobortis semper eros. Morbi tempus. Praesent in felis. Nunc eu nulla. Praesent facilisis nonummy odio. Cras eu neque quis mauris pretium adipiscing. Maecenas in magna eget sapien semper hendrerit. Fusce dolor. Nulla bibendum blandit pede. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hymenaeos. Mauris consequat, risus eu aliquam vehicula, lectus orci imperdiet justo, nec blandit nunc quam ut nulla.', '', 0);

# --------------------------------------------------------

# 
# Table structure for table 'products_notifications'
# 

DROP TABLE IF EXISTS products_notifications;
CREATE TABLE IF NOT EXISTS products_notifications (
  products_id int(11) NOT NULL default '0',
  customers_id int(11) NOT NULL default '0',
  date_added datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (products_id,customers_id)
);

# 
# Dumping data for table 'products_notifications'
# 

INSERT INTO products_notifications (products_id, customers_id, date_added) VALUES (0, 2, '2007-07-11 13:50:56');

# --------------------------------------------------------

# 
# Table structure for table 'products_options'
# 

DROP TABLE IF EXISTS products_options;
CREATE TABLE IF NOT EXISTS products_options (
  products_options_id int(11) NOT NULL default '0',
  language_id int(11) NOT NULL default '1',
  products_options_name varchar(32) NOT NULL default '',
  PRIMARY KEY  (products_options_id,language_id)
);

# 
# Dumping data for table 'products_options'
# 

INSERT INTO products_options (products_options_id, language_id, products_options_name) VALUES (1, 1, 'Color');
INSERT INTO products_options (products_options_id, language_id, products_options_name) VALUES (2, 1, 'Size');
INSERT INTO products_options (products_options_id, language_id, products_options_name) VALUES (3, 1, 'Model');
INSERT INTO products_options (products_options_id, language_id, products_options_name) VALUES (4, 1, 'Memory');
INSERT INTO products_options (products_options_id, language_id, products_options_name) VALUES (1, 2, 'Farbe');
INSERT INTO products_options (products_options_id, language_id, products_options_name) VALUES (2, 2, 'Gro?e');
INSERT INTO products_options (products_options_id, language_id, products_options_name) VALUES (3, 2, 'Modell');
INSERT INTO products_options (products_options_id, language_id, products_options_name) VALUES (4, 2, 'Speicher');
INSERT INTO products_options (products_options_id, language_id, products_options_name) VALUES (1, 3, 'Color');
INSERT INTO products_options (products_options_id, language_id, products_options_name) VALUES (2, 3, 'Talla');
INSERT INTO products_options (products_options_id, language_id, products_options_name) VALUES (3, 3, 'Modelo');
INSERT INTO products_options (products_options_id, language_id, products_options_name) VALUES (4, 3, 'Memoria');
INSERT INTO products_options (products_options_id, language_id, products_options_name) VALUES (5, 3, 'Version');
INSERT INTO products_options (products_options_id, language_id, products_options_name) VALUES (5, 2, 'Version');
INSERT INTO products_options (products_options_id, language_id, products_options_name) VALUES (5, 1, 'Version');

# --------------------------------------------------------

# 
# Table structure for table 'products_options_values'
# 

DROP TABLE IF EXISTS products_options_values;
CREATE TABLE IF NOT EXISTS products_options_values (
  products_options_values_id int(11) NOT NULL default '0',
  language_id int(11) NOT NULL default '1',
  products_options_values_name varchar(64) NOT NULL default '',
  PRIMARY KEY  (products_options_values_id,language_id)
);

# 
# Dumping data for table 'products_options_values'
# 

INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name) VALUES (1, 1, '4 mb');
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name) VALUES (2, 1, '8 mb');
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name) VALUES (3, 1, '16 mb');
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name) VALUES (4, 1, '32 mb');
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name) VALUES (5, 1, 'Value');
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name) VALUES (6, 1, 'Premium');
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name) VALUES (7, 1, 'Deluxe');
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name) VALUES (8, 1, 'PS/2');
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name) VALUES (9, 1, 'USB');
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name) VALUES (1, 2, '4 MB');
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name) VALUES (2, 2, '8 MB');
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name) VALUES (3, 2, '16 MB');
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name) VALUES (4, 2, '32 MB');
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name) VALUES (5, 2, 'Value Ausgabe');
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name) VALUES (6, 2, 'Premium Ausgabe');
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name) VALUES (7, 2, 'Deluxe Ausgabe');
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name) VALUES (8, 2, 'PS/2 Anschluss');
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name) VALUES (9, 2, 'USB Anschluss');
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name) VALUES (1, 3, '4 mb');
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name) VALUES (2, 3, '8 mb');
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name) VALUES (3, 3, '16 mb');
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name) VALUES (4, 3, '32 mb');
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name) VALUES (5, 3, 'Value');
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name) VALUES (6, 3, 'Premium');
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name) VALUES (7, 3, 'Deluxe');
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name) VALUES (8, 3, 'PS/2');
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name) VALUES (9, 3, 'USB');
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name) VALUES (10, 1, 'Download: Windows - English');
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name) VALUES (10, 2, 'Download: Windows - Englisch');
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name) VALUES (10, 3, 'Download: Windows - Inglese');
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name) VALUES (13, 1, 'Box: Windows - English');
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name) VALUES (13, 2, 'Box: Windows - Englisch');
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name) VALUES (13, 3, 'Box: Windows - Inglese');

# --------------------------------------------------------

# 
# Table structure for table 'products_options_values_to_products_options'
# 

DROP TABLE IF EXISTS products_options_values_to_products_options;
CREATE TABLE IF NOT EXISTS products_options_values_to_products_options (
  products_options_values_to_products_options_id int(11) NOT NULL auto_increment,
  products_options_id int(11) NOT NULL default '0',
  products_options_values_id int(11) NOT NULL default '0',
  PRIMARY KEY  (products_options_values_to_products_options_id)
);

# 
# Dumping data for table 'products_options_values_to_products_options'
# 

INSERT INTO products_options_values_to_products_options (products_options_values_to_products_options_id, products_options_id, products_options_values_id) VALUES (1, 4, 1);
INSERT INTO products_options_values_to_products_options (products_options_values_to_products_options_id, products_options_id, products_options_values_id) VALUES (2, 4, 2);
INSERT INTO products_options_values_to_products_options (products_options_values_to_products_options_id, products_options_id, products_options_values_id) VALUES (3, 4, 3);
INSERT INTO products_options_values_to_products_options (products_options_values_to_products_options_id, products_options_id, products_options_values_id) VALUES (4, 4, 4);
INSERT INTO products_options_values_to_products_options (products_options_values_to_products_options_id, products_options_id, products_options_values_id) VALUES (5, 3, 5);
INSERT INTO products_options_values_to_products_options (products_options_values_to_products_options_id, products_options_id, products_options_values_id) VALUES (6, 3, 6);
INSERT INTO products_options_values_to_products_options (products_options_values_to_products_options_id, products_options_id, products_options_values_id) VALUES (7, 3, 7);
INSERT INTO products_options_values_to_products_options (products_options_values_to_products_options_id, products_options_id, products_options_values_id) VALUES (8, 3, 8);
INSERT INTO products_options_values_to_products_options (products_options_values_to_products_options_id, products_options_id, products_options_values_id) VALUES (9, 3, 9);
INSERT INTO products_options_values_to_products_options (products_options_values_to_products_options_id, products_options_id, products_options_values_id) VALUES (10, 5, 10);
INSERT INTO products_options_values_to_products_options (products_options_values_to_products_options_id, products_options_id, products_options_values_id) VALUES (13, 5, 13);

# --------------------------------------------------------

# 
# Table structure for table 'products_to_categories'
# 

DROP TABLE IF EXISTS products_to_categories;
CREATE TABLE IF NOT EXISTS products_to_categories (
  products_id int(11) NOT NULL default '0',
  categories_id int(11) NOT NULL default '0',
  PRIMARY KEY  (products_id,categories_id)
);

# 
# Dumping data for table 'products_to_categories'
# 

INSERT INTO products_to_categories (products_id, categories_id) VALUES (1, 1);
INSERT INTO products_to_categories (products_id, categories_id) VALUES (2, 1);
INSERT INTO products_to_categories (products_id, categories_id) VALUES (3, 2);
INSERT INTO products_to_categories (products_id, categories_id) VALUES (4, 2);
INSERT INTO products_to_categories (products_id, categories_id) VALUES (5, 3);
INSERT INTO products_to_categories (products_id, categories_id) VALUES (6, 3);
INSERT INTO products_to_categories (products_id, categories_id) VALUES (7, 4);
INSERT INTO products_to_categories (products_id, categories_id) VALUES (8, 4);
INSERT INTO products_to_categories (products_id, categories_id) VALUES (9, 5);
INSERT INTO products_to_categories (products_id, categories_id) VALUES (10, 5);
INSERT INTO products_to_categories (products_id, categories_id) VALUES (11, 6);
INSERT INTO products_to_categories (products_id, categories_id) VALUES (12, 6);
INSERT INTO products_to_categories (products_id, categories_id) VALUES (13, 7);
INSERT INTO products_to_categories (products_id, categories_id) VALUES (14, 7);
INSERT INTO products_to_categories (products_id, categories_id) VALUES (15, 8);
INSERT INTO products_to_categories (products_id, categories_id) VALUES (16, 8);
INSERT INTO products_to_categories (products_id, categories_id) VALUES (17, 9);
INSERT INTO products_to_categories (products_id, categories_id) VALUES (18, 9);
INSERT INTO products_to_categories (products_id, categories_id) VALUES (19, 10);
INSERT INTO products_to_categories (products_id, categories_id) VALUES (20, 10);
INSERT INTO products_to_categories (products_id, categories_id) VALUES (21, 11);
INSERT INTO products_to_categories (products_id, categories_id) VALUES (22, 11);
INSERT INTO products_to_categories (products_id, categories_id) VALUES (23, 14);
INSERT INTO products_to_categories (products_id, categories_id) VALUES (24, 14);
INSERT INTO products_to_categories (products_id, categories_id) VALUES (25, 13);
INSERT INTO products_to_categories (products_id, categories_id) VALUES (26, 13);

# --------------------------------------------------------

# 
# Table structure for table 'reviews'
# 

DROP TABLE IF EXISTS reviews;
CREATE TABLE IF NOT EXISTS reviews (
  reviews_id int(11) NOT NULL auto_increment,
  products_id int(11) NOT NULL default '0',
  customers_id int(11) default NULL,
  customers_name varchar(64) NOT NULL default '',
  reviews_rating int(1) default NULL,
  date_added datetime default NULL,
  last_modified datetime default NULL,
  reviews_read int(5) NOT NULL default '0',
  PRIMARY KEY  (reviews_id),
  KEY idx_reviews_products_id (products_id),
  KEY idx_reviews_customers_id (customers_id)
);

# 
# Dumping data for table 'reviews'
# 

INSERT INTO reviews (reviews_id, products_id, customers_id, customers_name, reviews_rating, date_added, last_modified, reviews_read) VALUES (1, 19, 1, 'John doe', 5, '2007-07-10 13:43:01', NULL, 0);
INSERT INTO reviews (reviews_id, products_id, customers_id, customers_name, reviews_rating, date_added, last_modified, reviews_read) VALUES (2, 103, 2, 'Fernando De Cortece', 1, '2007-07-11 14:32:51', NULL, 18);
INSERT INTO reviews (reviews_id, products_id, customers_id, customers_name, reviews_rating, date_added, last_modified, reviews_read) VALUES (3, 103, 2, 'Fernando De Cortece', 5, '2007-07-11 14:39:08', NULL, 0);

# --------------------------------------------------------

# 
# Table structure for table 'reviews_description'
# 

DROP TABLE IF EXISTS reviews_description;
CREATE TABLE IF NOT EXISTS reviews_description (
  reviews_id int(11) NOT NULL default '0',
  languages_id int(11) NOT NULL default '0',
  reviews_text text NOT NULL,
  PRIMARY KEY  (reviews_id,languages_id)
);

# 
# Dumping data for table 'reviews_description'
# 

INSERT INTO reviews_description (reviews_id, languages_id, reviews_text) VALUES (1, 1, 'this has to be one of the funniest movies released for 1999!');
INSERT INTO reviews_description (reviews_id, languages_id, reviews_text) VALUES (2, 1, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas mi. Aliquam odio libero, convallis vitae, porttitor in, convallis et, tortor. Aenean consequat dui id mi. Nullam placerat, sem eu malesuada pretium, lacus dolor feugiat lacus, at egestas ipsum quam vulputate nibh. Cras sit amet mauris. Curabitur ultrices.');
INSERT INTO reviews_description (reviews_id, languages_id, reviews_text) VALUES (3, 1, 'Sed semper dapibus est. Aenean dui sem, dictum eget, viverra id, sodales quis, leo. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. In condimentum odio. Quisque ultricies rhoncus ligula.');

# --------------------------------------------------------

# 
# Table structure for table 'sessions'
# 

DROP TABLE IF EXISTS sessions;
CREATE TABLE IF NOT EXISTS sessions (
  sesskey varchar(32) NOT NULL default '',
  expiry int(11) unsigned NOT NULL default '0',
  value text NOT NULL,
  PRIMARY KEY  (sesskey)
);

# 
# Dumping data for table 'sessions'
# 

INSERT INTO sessions (sesskey, expiry, value) VALUES ('a64672ed4c52dc10f40b2ed9297df661', 1207642349, 'language|s:7:"english";languages_id|s:1:"1";selected_box|s:13:"configuration";admin|a:2:{s:2:"id";s:1:"1";s:8:"username";s:5:"admin";}');
INSERT INTO sessions (sesskey, expiry, value) VALUES ('828aa5c2767319812759cf2f01ebcae0', 1207642455, 'cart|O:12:"shoppingcart":5:{s:8:"contents";a:1:{i:35;a:1:{s:3:"qty";i:1;}}s:5:"total";i:0;s:6:"weight";i:0;s:6:"cartID";s:5:"90997";s:12:"content_type";b:0;}language|s:7:"english";languages_id|s:1:"1";currency|s:3:"USD";navigation|O:17:"navigationhistory":2:{s:4:"path";a:1:{i:0;a:4:{s:4:"page";s:9:"index.php";s:4:"mode";s:6:"NONSSL";s:3:"get";a:0:{}s:4:"post";a:0:{}}}s:8:"snapshot";a:4:{s:4:"page";s:11:"account.php";s:4:"mode";s:6:"NONSSL";s:3:"get";a:0:{}s:4:"post";a:0:{}}}new_products_id_in_cart|s:2:"25";');
INSERT INTO sessions (sesskey, expiry, value) VALUES ('44fcbed0c6e4e501b88ebd57fd2fcd27', 1207642266, 'cart|O:12:"shoppingcart":5:{s:8:"contents";a:0:{}s:5:"total";i:0;s:6:"weight";i:0;s:6:"cartID";N;s:12:"content_type";b:0;}language|s:7:"english";languages_id|s:1:"1";currency|s:3:"USD";navigation|O:17:"navigationhistory":2:{s:4:"path";a:1:{i:0;a:4:{s:4:"page";s:9:"index.php";s:4:"mode";s:6:"NONSSL";s:3:"get";a:0:{}s:4:"post";a:0:{}}}s:8:"snapshot";a:0:{}}new_products_id_in_cart|s:1:"2";customer_id|s:1:"2";customer_default_address_id|s:1:"2";customer_first_name|s:8:"Fernando";customer_country_id|s:3:"209";customer_zone_id|s:1:"0";');

# --------------------------------------------------------

# 
# Table structure for table 'specials'
# 

DROP TABLE IF EXISTS specials;
CREATE TABLE IF NOT EXISTS specials (
  specials_id int(11) NOT NULL auto_increment,
  products_id int(11) NOT NULL default '0',
  specials_new_products_price decimal(15,4) NOT NULL default '0.0000',
  specials_date_added datetime default NULL,
  specials_last_modified datetime default NULL,
  expires_date datetime default NULL,
  date_status_change datetime default NULL,
  status int(1) NOT NULL default '1',
  PRIMARY KEY  (specials_id),
  KEY idx_specials_products_id (products_id)
);

# 
# Dumping data for table 'specials'
# 

INSERT INTO specials (specials_id, products_id, specials_new_products_price, specials_date_added, specials_last_modified, expires_date, date_status_change, status) VALUES (1, 3, 39.9900, '2007-07-10 13:43:01', NULL, NULL, NULL, 1);
INSERT INTO specials (specials_id, products_id, specials_new_products_price, specials_date_added, specials_last_modified, expires_date, date_status_change, status) VALUES (2, 5, 30.0000, '2007-07-10 13:43:01', NULL, NULL, NULL, 1);
INSERT INTO specials (specials_id, products_id, specials_new_products_price, specials_date_added, specials_last_modified, expires_date, date_status_change, status) VALUES (3, 6, 30.0000, '2007-07-10 13:43:01', NULL, NULL, NULL, 1);
INSERT INTO specials (specials_id, products_id, specials_new_products_price, specials_date_added, specials_last_modified, expires_date, date_status_change, status) VALUES (4, 16, 29.9900, '2007-07-10 13:43:01', NULL, NULL, NULL, 1);

# --------------------------------------------------------

# 
# Table structure for table 'tax_class'
# 

DROP TABLE IF EXISTS tax_class;
CREATE TABLE IF NOT EXISTS tax_class (
  tax_class_id int(11) NOT NULL auto_increment,
  tax_class_title varchar(32) NOT NULL default '',
  tax_class_description varchar(255) NOT NULL default '',
  last_modified datetime default NULL,
  date_added datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (tax_class_id)
);

# 
# Dumping data for table 'tax_class'
# 

INSERT INTO tax_class (tax_class_id, tax_class_title, tax_class_description, last_modified, date_added) VALUES (1, 'Taxable Goods', 'The following types of products are included non-food, services, etc', '2007-07-10 13:43:01', '2007-07-10 13:43:01');

# --------------------------------------------------------

# 
# Table structure for table 'tax_rates'
# 

DROP TABLE IF EXISTS tax_rates;
CREATE TABLE IF NOT EXISTS tax_rates (
  tax_rates_id int(11) NOT NULL auto_increment,
  tax_zone_id int(11) NOT NULL default '0',
  tax_class_id int(11) NOT NULL default '0',
  tax_priority int(5) default '1',
  tax_rate decimal(7,4) NOT NULL default '0.0000',
  tax_description varchar(255) NOT NULL default '',
  last_modified datetime default NULL,
  date_added datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (tax_rates_id)
);

# 
# Dumping data for table 'tax_rates'
# 

INSERT INTO tax_rates (tax_rates_id, tax_zone_id, tax_class_id, tax_priority, tax_rate, tax_description, last_modified, date_added) VALUES (1, 1, 1, 1, 7.0000, 'FL TAX 7.0%', '2007-07-10 13:43:01', '2007-07-10 13:43:01');

# --------------------------------------------------------

# 
# Table structure for table 'whos_online'
# 

DROP TABLE IF EXISTS whos_online;
CREATE TABLE IF NOT EXISTS whos_online (
  customer_id int(11) default NULL,
  full_name varchar(64) NOT NULL default '',
  session_id varchar(128) NOT NULL default '',
  ip_address varchar(15) NOT NULL default '',
  time_entry varchar(14) NOT NULL default '',
  time_last_click varchar(14) NOT NULL default '',
  last_page_url text NOT NULL
);

# 
# Dumping data for table 'whos_online'
# 

INSERT INTO whos_online (customer_id, full_name, session_id, ip_address, time_entry, time_last_click, last_page_url) VALUES (2, 'Fernando De Cortece', '44fcbed0c6e4e501b88ebd57fd2fcd27', '192.168.9.17', '1207640567', '1207640826', '/~seaman/osc_19/Trinity.3623/index.php');
INSERT INTO whos_online (customer_id, full_name, session_id, ip_address, time_entry, time_last_click, last_page_url) VALUES (0, 'Guest', '828aa5c2767319812759cf2f01ebcae0', '192.168.9.17', '1207636644', '1207641015', '/~seaman/osc_19/Trinity.3623/index.php');

# --------------------------------------------------------

# 
# Table structure for table 'zones'
# 

DROP TABLE IF EXISTS zones;
CREATE TABLE IF NOT EXISTS zones (
  zone_id int(11) NOT NULL auto_increment,
  zone_country_id int(11) NOT NULL default '0',
  zone_code varchar(32) NOT NULL default '',
  zone_name varchar(32) NOT NULL default '',
  PRIMARY KEY  (zone_id),
  KEY idx_zones_to_geo_zones_country_id (zone_country_id)
);

# 
# Dumping data for table 'zones'
# 

INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (1, 223, 'AL', 'Alabama');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (2, 223, 'AK', 'Alaska');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (3, 223, 'AS', 'American Samoa');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (4, 223, 'AZ', 'Arizona');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (5, 223, 'AR', 'Arkansas');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (6, 223, 'AF', 'Armed Forces Africa');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (7, 223, 'AA', 'Armed Forces Americas');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (8, 223, 'AC', 'Armed Forces Canada');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (9, 223, 'AE', 'Armed Forces Europe');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (10, 223, 'AM', 'Armed Forces Middle East');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (11, 223, 'AP', 'Armed Forces Pacific');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (12, 223, 'CA', 'California');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (13, 223, 'CO', 'Colorado');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (14, 223, 'CT', 'Connecticut');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (15, 223, 'DE', 'Delaware');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (16, 223, 'DC', 'District of Columbia');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (17, 223, 'FM', 'Federated States Of Micronesia');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (18, 223, 'FL', 'Florida');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (19, 223, 'GA', 'Georgia');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (20, 223, 'GU', 'Guam');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (21, 223, 'HI', 'Hawaii');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (22, 223, 'ID', 'Idaho');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (23, 223, 'IL', 'Illinois');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (24, 223, 'IN', 'Indiana');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (25, 223, 'IA', 'Iowa');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (26, 223, 'KS', 'Kansas');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (27, 223, 'KY', 'Kentucky');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (28, 223, 'LA', 'Louisiana');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (29, 223, 'ME', 'Maine');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (30, 223, 'MH', 'Marshall Islands');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (31, 223, 'MD', 'Maryland');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (32, 223, 'MA', 'Massachusetts');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (33, 223, 'MI', 'Michigan');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (34, 223, 'MN', 'Minnesota');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (35, 223, 'MS', 'Mississippi');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (36, 223, 'MO', 'Missouri');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (37, 223, 'MT', 'Montana');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (38, 223, 'NE', 'Nebraska');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (39, 223, 'NV', 'Nevada');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (40, 223, 'NH', 'New Hampshire');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (41, 223, 'NJ', 'New Jersey');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (42, 223, 'NM', 'New Mexico');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (43, 223, 'NY', 'New York');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (44, 223, 'NC', 'North Carolina');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (45, 223, 'ND', 'North Dakota');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (46, 223, 'MP', 'Northern Mariana Islands');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (47, 223, 'OH', 'Ohio');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (48, 223, 'OK', 'Oklahoma');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (49, 223, 'OR', 'Oregon');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (50, 223, 'PW', 'Palau');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (51, 223, 'PA', 'Pennsylvania');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (52, 223, 'PR', 'Puerto Rico');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (53, 223, 'RI', 'Rhode Island');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (54, 223, 'SC', 'South Carolina');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (55, 223, 'SD', 'South Dakota');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (56, 223, 'TN', 'Tennessee');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (57, 223, 'TX', 'Texas');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (58, 223, 'UT', 'Utah');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (59, 223, 'VT', 'Vermont');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (60, 223, 'VI', 'Virgin Islands');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (61, 223, 'VA', 'Virginia');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (62, 223, 'WA', 'Washington');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (63, 223, 'WV', 'West Virginia');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (64, 223, 'WI', 'Wisconsin');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (65, 223, 'WY', 'Wyoming');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (66, 38, 'AB', 'Alberta');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (67, 38, 'BC', 'British Columbia');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (68, 38, 'MB', 'Manitoba');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (69, 38, 'NF', 'Newfoundland');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (70, 38, 'NB', 'New Brunswick');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (71, 38, 'NS', 'Nova Scotia');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (72, 38, 'NT', 'Northwest Territories');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (73, 38, 'NU', 'Nunavut');

INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (74, 38, 'ON', 'Ontario');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (75, 38, 'PE', 'Prince Edward Island');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (76, 38, 'QC', 'Quebec');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (77, 38, 'SK', 'Saskatchewan');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (78, 38, 'YT', 'Yukon Territory');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (79, 81, 'NDS', 'Niedersachsen');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (80, 81, 'BAW', 'Baden-Wurttemberg');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (81, 81, 'BAY', 'Bayern');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (82, 81, 'BER', 'Berlin');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (83, 81, 'BRG', 'Brandenburg');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (84, 81, 'BRE', 'Bremen');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (85, 81, 'HAM', 'Hamburg');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (86, 81, 'HES', 'Hessen');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (87, 81, 'MEC', 'Mecklenburg-Vorpommern');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (88, 81, 'NRW', 'Nordrhein-Westfalen');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (89, 81, 'RHE', 'Rheinland-Pfalz');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (90, 81, 'SAR', 'Saarland');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (91, 81, 'SAS', 'Sachsen');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (92, 81, 'SAC', 'Sachsen-Anhalt');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (93, 81, 'SCN', 'Schleswig-Holstein');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (94, 81, 'THE', 'Thuringen');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (95, 14, 'WI', 'Wien');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (96, 14, 'NO', 'Niederosterreich');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (97, 14, 'OO', 'Oberosterreich');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (98, 14, 'SB', 'Salzburg');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (99, 14, 'KN', 'Karnten');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (100, 14, 'ST', 'Steiermark');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (101, 14, 'TI', 'Tirol');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (102, 14, 'BL', 'Burgenland');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (103, 14, 'VB', 'Voralberg');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (104, 204, 'AG', 'Aargau');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (105, 204, 'AI', 'Appenzell Innerrhoden');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (106, 204, 'AR', 'Appenzell Ausserrhoden');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (107, 204, 'BE', 'Bern');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (108, 204, 'BL', 'Basel-Landschaft');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (109, 204, 'BS', 'Basel-Stadt');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (110, 204, 'FR', 'Freiburg');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (111, 204, 'GE', 'Genf');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (112, 204, 'GL', 'Glarus');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (113, 204, 'JU', 'Graubunden');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (114, 204, 'JU', 'Jura');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (115, 204, 'LU', 'Luzern');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (116, 204, 'NE', 'Neuenburg');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (117, 204, 'NW', 'Nidwalden');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (118, 204, 'OW', 'Obwalden');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (119, 204, 'SG', 'St. Gallen');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (120, 204, 'SH', 'Schaffhausen');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (121, 204, 'SO', 'Solothurn');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (122, 204, 'SZ', 'Schwyz');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (123, 204, 'TG', 'Thurgau');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (124, 204, 'TI', 'Tessin');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (125, 204, 'UR', 'Uri');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (126, 204, 'VD', 'Waadt');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (127, 204, 'VS', 'Wallis');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (128, 204, 'ZG', 'Zug');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (129, 204, 'ZH', 'Zurich');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (130, 195, 'A Coruna', 'A Coruna');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (131, 195, 'Alava', 'Alava');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (132, 195, 'Albacete', 'Albacete');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (133, 195, 'Alicante', 'Alicante');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (134, 195, 'Almeria', 'Almeria');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (135, 195, 'Asturias', 'Asturias');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (136, 195, 'Avila', 'Avila');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (137, 195, 'Badajoz', 'Badajoz');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (138, 195, 'Baleares', 'Baleares');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (139, 195, 'Barcelona', 'Barcelona');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (140, 195, 'Burgos', 'Burgos');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (141, 195, 'Caceres', 'Caceres');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (142, 195, 'Cadiz', 'Cadiz');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (143, 195, 'Cantabria', 'Cantabria');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (144, 195, 'Castellon', 'Castellon');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (145, 195, 'Ceuta', 'Ceuta');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (146, 195, 'Ciudad Real', 'Ciudad Real');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (147, 195, 'Cordoba', 'Cordoba');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (148, 195, 'Cuenca', 'Cuenca');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (149, 195, 'Girona', 'Girona');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (150, 195, 'Granada', 'Granada');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (151, 195, 'Guadalajara', 'Guadalajara');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (152, 195, 'Guipuzcoa', 'Guipuzcoa');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (153, 195, 'Huelva', 'Huelva');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (154, 195, 'Huesca', 'Huesca');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (155, 195, 'Jaen', 'Jaen');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (156, 195, 'La Rioja', 'La Rioja');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (157, 195, 'Las Palmas', 'Las Palmas');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (158, 195, 'Leon', 'Leon');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (159, 195, 'Lleida', 'Lleida');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (160, 195, 'Lugo', 'Lugo');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (161, 195, 'Madrid', 'Madrid');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (162, 195, 'Malaga', 'Malaga');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (163, 195, 'Melilla', 'Melilla');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (164, 195, 'Murcia', 'Murcia');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (165, 195, 'Navarra', 'Navarra');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (166, 195, 'Ourense', 'Ourense');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (167, 195, 'Palencia', 'Palencia');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (168, 195, 'Pontevedra', 'Pontevedra');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (169, 195, 'Salamanca', 'Salamanca');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (170, 195, 'Santa Cruz de Tenerife', 'Santa Cruz de Tenerife');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (171, 195, 'Segovia', 'Segovia');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (172, 195, 'Sevilla', 'Sevilla');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (173, 195, 'Soria', 'Soria');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (174, 195, 'Tarragona', 'Tarragona');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (175, 195, 'Teruel', 'Teruel');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (176, 195, 'Toledo', 'Toledo');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (177, 195, 'Valencia', 'Valencia');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (178, 195, 'Valladolid', 'Valladolid');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (179, 195, 'Vizcaya', 'Vizcaya');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (180, 195, 'Zamora', 'Zamora');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES (181, 195, 'Zaragoza', 'Zaragoza');

# --------------------------------------------------------

# 
# Table structure for table 'zones_to_geo_zones'
# 

DROP TABLE IF EXISTS zones_to_geo_zones;
CREATE TABLE IF NOT EXISTS zones_to_geo_zones (
  association_id int(11) NOT NULL auto_increment,
  zone_country_id int(11) NOT NULL default '0',
  zone_id int(11) default NULL,
  geo_zone_id int(11) default NULL,
  last_modified datetime default NULL,
  date_added datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (association_id)
);

# 
# Dumping data for table 'zones_to_geo_zones'
# 

INSERT INTO zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) VALUES (1, 223, 18, 1, NULL, '2007-07-10 13:43:01');
