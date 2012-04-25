# $Id: oscommerce.sql,v 1.84 2003/05/27 17:32:16 hpdl Exp $
#
# osCommerce, Open Source E-Commerce Solutions
# http://www.oscommerce.com
#
# Copyright (c) 2003 osCommerce
#
# Released under the GNU General Public License
#
# NOTE: * Please make any modifications to this file by hand!
#       * DO NOT use a mysqldump created file for new changes!
#       * Please take note of the table structure, and use this
#         structure as a standard for future modifications!
#       * Any tables you add here should be added in admin/backup.php
#         and in catalog/install/includes/functions/database.php
#       * To see the 'diff'erence between MySQL databases, use
#         the mysqldiff perl script located in the extras
#         directory of the 'catalog' module.
#       * Comments should be like these, full line comments.
#         (don't use inline comments)

DROP TABLE IF EXISTS address_book;
CREATE TABLE address_book (
   address_book_id int NOT NULL auto_increment,
   customers_id int NOT NULL,
   entry_gender char(1) NOT NULL,
   entry_company varchar(32),
   entry_firstname varchar(32) NOT NULL,
   entry_lastname varchar(32) NOT NULL,
   entry_street_address varchar(64) NOT NULL,
   entry_suburb varchar(32),
   entry_postcode varchar(10) NOT NULL,
   entry_city varchar(32) NOT NULL,
   entry_state varchar(32),
   entry_country_id int DEFAULT '0' NOT NULL,
   entry_zone_id int DEFAULT '0' NOT NULL,
   PRIMARY KEY (address_book_id),
   KEY idx_address_book_customers_id (customers_id)
);

DROP TABLE IF EXISTS address_format;
CREATE TABLE address_format (
  address_format_id int NOT NULL auto_increment,
  address_format varchar(128) NOT NULL,
  address_summary varchar(48) NOT NULL,
  PRIMARY KEY (address_format_id)
);

DROP TABLE IF EXISTS administrators;
CREATE TABLE administrators (
  id int NOT NULL auto_increment,
  user_name varchar(32) binary NOT NULL,
  user_password varchar(40) NOT NULL,
  PRIMARY KEY (id)
);

DROP TABLE IF EXISTS banners;
CREATE TABLE banners (
  banners_id int NOT NULL auto_increment,
  banners_title varchar(64) NOT NULL,
  banners_url varchar(255) NOT NULL,
  banners_image varchar(64) NOT NULL,
  banners_group varchar(10) NOT NULL,
  banners_html_text text,
  expires_impressions int(7) DEFAULT '0',
  expires_date datetime DEFAULT NULL,
  date_scheduled datetime DEFAULT NULL,
  date_added datetime NOT NULL,
  date_status_change datetime DEFAULT NULL,
  status int(1) DEFAULT '1' NOT NULL,
  PRIMARY KEY  (banners_id)
);

DROP TABLE IF EXISTS banners_history;
CREATE TABLE banners_history (
  banners_history_id int NOT NULL auto_increment,
  banners_id int NOT NULL,
  banners_shown int(5) NOT NULL DEFAULT '0',
  banners_clicked int(5) NOT NULL DEFAULT '0',
  banners_history_date datetime NOT NULL,
  PRIMARY KEY  (banners_history_id)
);

DROP TABLE IF EXISTS categories;
CREATE TABLE categories (
   categories_id int NOT NULL auto_increment,
   categories_image varchar(64),
   parent_id int DEFAULT '0' NOT NULL,
   sort_order int(3),
   date_added datetime,
   last_modified datetime,
   PRIMARY KEY (categories_id),
   KEY idx_categories_parent_id (parent_id)
);

DROP TABLE IF EXISTS categories_description;
CREATE TABLE categories_description (
   categories_id int DEFAULT '0' NOT NULL,
   language_id int DEFAULT '1' NOT NULL,
   categories_name varchar(32) NOT NULL,
   PRIMARY KEY (categories_id, language_id),
   KEY idx_categories_name (categories_name)
);

DROP TABLE IF EXISTS configuration;
CREATE TABLE configuration (
  configuration_id int NOT NULL auto_increment,
  configuration_title varchar(255) NOT NULL,
  configuration_key varchar(255) NOT NULL,
  configuration_value varchar(255) NOT NULL,
  configuration_description varchar(255) NOT NULL,
  configuration_group_id int NOT NULL,
  sort_order int(5) NULL,
  last_modified datetime NULL,
  date_added datetime NOT NULL,
  use_function varchar(255) NULL,
  set_function varchar(255) NULL,
  PRIMARY KEY (configuration_id)
);

DROP TABLE IF EXISTS configuration_group;
CREATE TABLE configuration_group (
  configuration_group_id int NOT NULL auto_increment,
  configuration_group_title varchar(64) NOT NULL,
  configuration_group_description varchar(255) NOT NULL,
  sort_order int(5) NULL,
  visible int(1) DEFAULT '1' NULL,
  PRIMARY KEY (configuration_group_id)
);

DROP TABLE IF EXISTS counter;
CREATE TABLE counter (
  startdate char(8),
  counter int(12)
);

DROP TABLE IF EXISTS counter_history;
CREATE TABLE counter_history (
  month char(8),
  counter int(12)
);

DROP TABLE IF EXISTS countries;
CREATE TABLE countries (
  countries_id int NOT NULL auto_increment,
  countries_name varchar(64) NOT NULL,
  countries_iso_code_2 char(2) NOT NULL,
  countries_iso_code_3 char(3) NOT NULL,
  address_format_id int NOT NULL,
  PRIMARY KEY (countries_id),
  KEY IDX_COUNTRIES_NAME (countries_name)
);

DROP TABLE IF EXISTS currencies;
CREATE TABLE currencies (
  currencies_id int NOT NULL auto_increment,
  title varchar(32) NOT NULL,
  code char(3) binary not null ,
  symbol_left varchar(12),
  symbol_right varchar(12),
  decimal_point char(1),
  thousands_point char(1),
  decimal_places char(1),
  value float(13,8),
  last_updated datetime NULL,
  PRIMARY KEY (currencies_id)
);

DROP TABLE IF EXISTS customers;
CREATE TABLE customers (
   customers_id int NOT NULL auto_increment,
   customers_gender char(1) NOT NULL,
   customers_firstname varchar(32) NOT NULL,
   customers_lastname varchar(32) NOT NULL,
   customers_dob datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
   customers_email_address varchar(96) NOT NULL,
   customers_default_address_id int,
   customers_telephone varchar(32) NOT NULL,
   customers_fax varchar(32),
   customers_password varchar(40) NOT NULL,
   customers_newsletter char(1),
   PRIMARY KEY (customers_id)
);

DROP TABLE IF EXISTS customers_basket;
CREATE TABLE customers_basket (
  customers_basket_id int NOT NULL auto_increment,
  customers_id int NOT NULL,
  products_id tinytext NOT NULL,
  customers_basket_quantity int(2) NOT NULL,
  final_price decimal(15,4),
  customers_basket_date_added char(8),
  PRIMARY KEY (customers_basket_id)
);

DROP TABLE IF EXISTS customers_basket_attributes;
CREATE TABLE customers_basket_attributes (
  customers_basket_attributes_id int NOT NULL auto_increment,
  customers_id int NOT NULL,
  products_id tinytext NOT NULL,
  products_options_id int NOT NULL,
  products_options_value_id int NOT NULL,
  PRIMARY KEY (customers_basket_attributes_id)
);

DROP TABLE IF EXISTS customers_info;
CREATE TABLE customers_info (
  customers_info_id int NOT NULL,
  customers_info_date_of_last_logon datetime,
  customers_info_number_of_logons int(5),
  customers_info_date_account_created datetime,
  customers_info_date_account_last_modified datetime,
  global_product_notifications int(1) DEFAULT '0',
  PRIMARY KEY (customers_info_id)
);

DROP TABLE IF EXISTS languages;
CREATE TABLE languages (
  languages_id int NOT NULL auto_increment,
  name varchar(32)  NOT NULL,
  code char(2) NOT NULL,
  image varchar(64),
  directory varchar(32),
  sort_order int(3),
  PRIMARY KEY (languages_id),
  KEY IDX_LANGUAGES_NAME (name)
);


DROP TABLE IF EXISTS manufacturers;
CREATE TABLE manufacturers (
  manufacturers_id int NOT NULL auto_increment,
  manufacturers_name varchar(32) NOT NULL,
  manufacturers_image varchar(64),
  date_added datetime NULL,
  last_modified datetime NULL,
  PRIMARY KEY (manufacturers_id),
  KEY IDX_MANUFACTURERS_NAME (manufacturers_name)
);

DROP TABLE IF EXISTS manufacturers_info;
CREATE TABLE manufacturers_info (
  manufacturers_id int NOT NULL,
  languages_id int NOT NULL,
  manufacturers_url varchar(255) NOT NULL,
  url_clicked int(5) NOT NULL default '0',
  date_last_click datetime NULL,
  PRIMARY KEY (manufacturers_id, languages_id)
);

DROP TABLE IF EXISTS newsletters;
CREATE TABLE newsletters (
  newsletters_id int NOT NULL auto_increment,
  title varchar(255) NOT NULL,
  content text NOT NULL,
  module varchar(255) NOT NULL,
  date_added datetime NOT NULL,
  date_sent datetime,
  status int(1),
  locked int(1) DEFAULT '0',
  PRIMARY KEY (newsletters_id)
);

DROP TABLE IF EXISTS orders;
CREATE TABLE orders (
  orders_id int NOT NULL auto_increment,
  customers_id int NOT NULL,
  customers_name varchar(64) NOT NULL,
  customers_company varchar(32),
  customers_street_address varchar(64) NOT NULL,
  customers_suburb varchar(32),
  customers_city varchar(32) NOT NULL,
  customers_postcode varchar(10) NOT NULL,
  customers_state varchar(32),
  customers_country varchar(32) NOT NULL,
  customers_telephone varchar(32) NOT NULL,
  customers_email_address varchar(96) NOT NULL,
  customers_address_format_id int(5) NOT NULL,
  delivery_name varchar(64) NOT NULL,
  delivery_company varchar(32),
  delivery_street_address varchar(64) NOT NULL,
  delivery_suburb varchar(32),
  delivery_city varchar(32) NOT NULL,
  delivery_postcode varchar(10) NOT NULL,
  delivery_state varchar(32),
  delivery_country varchar(32) NOT NULL,
  delivery_address_format_id int(5) NOT NULL,
  billing_name varchar(64) NOT NULL,
  billing_company varchar(32),
  billing_street_address varchar(64) NOT NULL,
  billing_suburb varchar(32),
  billing_city varchar(32) NOT NULL,
  billing_postcode varchar(10) NOT NULL,
  billing_state varchar(32),
  billing_country varchar(32) NOT NULL,
  billing_address_format_id int(5) NOT NULL,
  payment_method varchar(32) NOT NULL,
  cc_type varchar(20),
  cc_owner varchar(64),
  cc_number varchar(32),
  cc_expires varchar(4),
  last_modified datetime,
  date_purchased datetime,
  orders_status int(5) NOT NULL,
  orders_date_finished datetime,
  currency char(3),
  currency_value decimal(14,6),
  PRIMARY KEY (orders_id)
);

DROP TABLE IF EXISTS orders_products;
CREATE TABLE orders_products (
  orders_products_id int NOT NULL auto_increment,
  orders_id int NOT NULL,
  products_id int NOT NULL,
  products_model varchar(12),
  products_name varchar(64) NOT NULL,
  products_price decimal(15,4) NOT NULL,
  final_price decimal(15,4) NOT NULL,
  products_tax decimal(7,4) NOT NULL,
  products_quantity int(2) NOT NULL,
  PRIMARY KEY (orders_products_id)
);

drop table if exists orders_status;
create table orders_status (
  orders_status_id int(11) default '0' not null ,
  language_id int(11) default '1' not null ,
  orders_status_name varchar(32) not null ,
  PRIMARY KEY (orders_status_id, language_id),
  KEY idx_orders_status_name (orders_status_name)
);


drop table if exists orders_status_history;
create table orders_status_history (
  orders_status_history_id int(11) not null auto_increment,
  orders_id int(11) not null ,
  orders_status_id int(5) not null ,
  date_added datetime not null ,
  customer_notified int(1) default '0' ,
  comments text ,
  PRIMARY KEY (orders_status_history_id)
);

DROP TABLE IF EXISTS orders_products_attributes;
CREATE TABLE orders_products_attributes (
  orders_products_attributes_id int NOT NULL auto_increment,
  orders_id int NOT NULL,
  orders_products_id int NOT NULL,
  products_options varchar(32) NOT NULL,
  products_options_values varchar(32) NOT NULL,
  options_values_price decimal(15,4) NOT NULL,
  price_prefix char(1) NOT NULL,
  PRIMARY KEY (orders_products_attributes_id),
  KEY idx_orders_products_att_orders_id (orders_id)
);

drop table if exists orders_products_download;
create table orders_products_download (
  orders_products_download_id int(11) not null auto_increment,
  orders_id int(11) default '0' not null ,
  orders_products_id int(11) default '0' not null ,
  orders_products_filename varchar(255) not null ,
  download_maxdays int(2) default '0' not null ,
  download_count int(2) default '0' not null ,
  PRIMARY KEY (orders_products_download_id)
);

drop table if exists orders_total;
create table orders_total (
  orders_total_id int(10) unsigned not null auto_increment,
  orders_id int(11) not null ,
  title varchar(255) not null ,
  text varchar(255) not null ,
  value decimal(15,4) not null ,
  class varchar(32) not null ,
  sort_order int(11) not null ,
  PRIMARY KEY (orders_total_id),
  KEY idx_orders_total_orders_id (orders_id)
);

drop table if exists products;
create table products (
  products_id int(11) not null auto_increment,
  products_quantity int(4) not null ,
  products_model varchar(12) ,
  products_image varchar(64) ,
  products_price decimal(15,4) not null ,
  products_date_added datetime not null ,
  products_last_modified datetime ,
  products_date_available datetime ,
  products_weight decimal(5,2) not null ,
  products_status tinyint(1) not null ,
  products_tax_class_id int(11) not null ,
  manufacturers_id int(11) ,
  products_ordered int(11) default '0' not null ,
  PRIMARY KEY (products_id),
  KEY idx_products_date_added (products_date_added)
);

drop table if exists products_attributes;
create table products_attributes (
  products_attributes_id int(11) not null auto_increment,
  products_id int(11) not null ,
  options_id int(11) not null ,
  options_values_id int(11) not null ,
  options_values_price decimal(15,4) not null ,
  price_prefix char(1) not null ,
  PRIMARY KEY (products_attributes_id)
);

drop table if exists products_attributes_download;
create table products_attributes_download (
  products_attributes_id int(11) not null ,
  products_attributes_filename varchar(255) not null ,
  products_attributes_maxdays int(2) default '0' ,
  products_attributes_maxcount int(2) default '0' ,
  PRIMARY KEY (products_attributes_id)
);

drop table if exists products_description;
create table products_description (
  products_id int(11) not null auto_increment,
  language_id int(11) default '1' not null ,
  products_name varchar(64) not null ,
  products_description text ,
  products_url varchar(255) ,
  products_viewed int(5) default '0' ,
  PRIMARY KEY (products_id, language_id),
  KEY products_name (products_name)
);

drop table if exists products_notifications;
create table products_notifications (
  products_id int(11) not null ,
  customers_id int(11) not null ,
  date_added datetime not null ,
  PRIMARY KEY (products_id, customers_id)
);

drop table if exists products_options;
create table products_options (
  products_options_id int(11) default '0' not null ,
  language_id int(11) default '1' not null ,
  products_options_name varchar(32) not null ,
  PRIMARY KEY (products_options_id, language_id)
);

drop table if exists products_options_values;
create table products_options_values (
  products_options_values_id int(11) default '0' not null ,
  language_id int(11) default '1' not null ,
  products_options_values_name varchar(64) not null ,
  PRIMARY KEY (products_options_values_id, language_id)
);

drop table if exists products_options_values_to_products_options;
create table products_options_values_to_products_options (
  products_options_values_to_products_options_id int(11) not null auto_increment,
  products_options_id int(11) not null ,
  products_options_values_id int(11) not null ,
  PRIMARY KEY (products_options_values_to_products_options_id)
);

drop table if exists products_to_categories;
create table products_to_categories (
  products_id int(11) not null ,
  categories_id int(11) not null ,
  PRIMARY KEY (products_id, categories_id)
);

drop table if exists reviews;
create table reviews (
  reviews_id int(11) not null auto_increment,
  products_id int(11) not null ,
  customers_id int(11) ,
  customers_name varchar(64) not null ,
  reviews_rating int(1) ,
  date_added datetime ,
  last_modified datetime ,
  reviews_read int(5) default '0' not null ,
  PRIMARY KEY (reviews_id)
);
drop table if exists reviews_description;
create table reviews_description (
  reviews_id int(11) not null ,
  languages_id int(11) not null ,
  reviews_text text not null ,
  PRIMARY KEY (reviews_id, languages_id)
);

drop table if exists sessions;
create table sessions (
  sesskey varchar(32) not null ,
  expiry int(11) unsigned not null ,
  value text not null ,
  PRIMARY KEY (sesskey)
);

drop table if exists specials;
create table specials (
  specials_id int(11) not null auto_increment,
  products_id int(11) not null ,
  specials_new_products_price decimal(15,4) not null ,
  specials_date_added datetime ,
  specials_last_modified datetime ,
  expires_date datetime ,
  date_status_change datetime ,
  status int(1) default '1' not null ,
  PRIMARY KEY (specials_id)
);

drop table if exists tax_class;
create table tax_class (
  tax_class_id int(11) not null auto_increment,
  tax_class_title varchar(32) not null ,
  tax_class_description varchar(255) not null ,
  last_modified datetime ,
  date_added datetime not null ,
  PRIMARY KEY (tax_class_id)
);

drop table if exists tax_rates;
create table tax_rates (
  tax_rates_id int(11) not null auto_increment,
  tax_zone_id int(11) not null ,
  tax_class_id int(11) not null ,
  tax_priority int(5) default '1' ,
  tax_rate decimal(7,4) not null ,
  tax_description varchar(255) not null ,
  last_modified datetime ,
  date_added datetime not null ,
  PRIMARY KEY (tax_rates_id)
);

drop table if exists geo_zones;
create table geo_zones (
  geo_zone_id int(11) not null auto_increment,
  geo_zone_name varchar(32) not null ,
  geo_zone_description varchar(255) not null ,
  last_modified datetime ,
  date_added datetime not null ,
  PRIMARY KEY (geo_zone_id)
);

drop table if exists whos_online;
create table whos_online (
  customer_id int(11) ,
  full_name varchar(64) not null ,
  session_id varchar(128) not null ,
  ip_address varchar(15) not null ,
  time_entry varchar(14) not null ,
  time_last_click varchar(14) not null ,
  last_page_url varchar(255) not null 
);

drop table if exists zones;
create table zones (
  zone_id int(11) not null auto_increment,
  zone_country_id int(11) not null ,
  zone_code varchar(32) not null ,
  zone_name varchar(32) not null ,
  PRIMARY KEY (zone_id)
);

drop table if exists zones_to_geo_zones;
create table zones_to_geo_zones (
  association_id int(11) not null auto_increment,
  zone_country_id int(11) not null ,
  zone_id int(11) ,
  geo_zone_id int(11) ,
  last_modified datetime ,
  date_added datetime not null ,
  PRIMARY KEY (association_id)
);


# data

insert into address_book (address_book_id, customers_id, entry_gender, entry_company, entry_firstname, entry_lastname, entry_street_address, entry_suburb, entry_postcode, entry_city, entry_state, entry_country_id, entry_zone_id) values ('1', '1', 'm', 'ACME Inc.', 'John', 'Doe', '1 Way Street', '', '12345', 'NeverNever', '', '223', '12');
insert into address_format (address_format_id, address_format, address_summary) values ('1', '$firstname $lastname$cr$streets$cr$city, $postcode$cr$statecomma$country', '$city / $country');
insert into address_format (address_format_id, address_format, address_summary) values ('2', '$firstname $lastname$cr$streets$cr$city, $state    $postcode$cr$country', '$city, $state / $country');
insert into address_format (address_format_id, address_format, address_summary) values ('3', '$firstname $lastname$cr$streets$cr$city$cr$postcode - $statecomma$country', '$state / $country');
insert into address_format (address_format_id, address_format, address_summary) values ('4', '$firstname $lastname$cr$streets$cr$city ($postcode)$cr$country', '$postcode / $country');
insert into address_format (address_format_id, address_format, address_summary) values ('5', '$firstname $lastname$cr$streets$cr$postcode $city$cr$country', '$city / $country');

insert into banners (banners_id, banners_title, banners_url, banners_image, banners_group, banners_html_text, expires_impressions, expires_date, date_scheduled, date_added, date_status_change, status) values ('1', 'osCommerce', 'http://www.oscommerce.com', 'banners/oscommerce.gif', '468x50', '', '0', NULL, NULL, '2006-08-19 16:05:54', NULL, '1');
insert into banners_history (banners_history_id, banners_id, banners_shown, banners_clicked, banners_history_date) values ('1', '1', '18', '0', '2006-08-19 16:16:10');

insert into categories (categories_id, categories_image, parent_id, sort_order, date_added, last_modified) values ('1', 'category_hardware.gif', '0', '1', '2006-08-19 16:05:54', '2006-08-19 16:35:31');
insert into categories (categories_id, categories_image, parent_id, sort_order, date_added, last_modified) values ('2', 'category_software.gif', '0', '2', '2006-08-19 16:05:54', '2006-08-19 16:35:46');
insert into categories (categories_id, categories_image, parent_id, sort_order, date_added, last_modified) values ('3', 'category_dvd_movies.gif', '0', '3', '2006-08-19 16:05:54', '2006-08-19 16:36:09');
insert into categories (categories_id, categories_image, parent_id, sort_order, date_added, last_modified) values ('4', 'subcategory_graphic_cards.gif', '1', '0', '2006-08-19 16:05:54', '2006-08-19 16:36:45');
insert into categories (categories_id, categories_image, parent_id, sort_order, date_added, last_modified) values ('5', 'subcategory_printers.gif', '1', '0', '2006-08-19 16:05:54', '2006-08-19 16:37:43');
insert into categories (categories_id, categories_image, parent_id, sort_order, date_added, last_modified) values ('6', 'subcategory_monitors.gif', '1', '0', '2006-08-19 16:05:54', '2006-08-19 16:38:50');
insert into categories (categories_id, categories_image, parent_id, sort_order, date_added, last_modified) values ('7', 'subcategory_speakers.gif', '1', '0', '2006-08-19 16:05:54', '2006-08-19 16:37:29');
insert into categories (categories_id, categories_image, parent_id, sort_order, date_added, last_modified) values ('8', 'subcategory_keyboards.gif', '1', '0', '2006-08-19 16:05:54', '2006-08-19 16:37:09');
insert into categories (categories_id, categories_image, parent_id, sort_order, date_added, last_modified) values ('9', 'subcategory_mice.gif', '1', '0', '2006-08-19 16:05:54', '2006-08-19 16:39:02');
insert into categories (categories_id, categories_image, parent_id, sort_order, date_added, last_modified) values ('10', 'subcategory_action.gif', '3', '0', '2006-08-19 16:05:54', NULL);
insert into categories (categories_id, categories_image, parent_id, sort_order, date_added, last_modified) values ('11', 'subcategory_science_fiction.gif', '3', '0', '2006-08-19 16:05:54', NULL);
insert into categories (categories_id, categories_image, parent_id, sort_order, date_added, last_modified) values ('12', 'subcategory_comedy.gif', '3', '0', '2006-08-19 16:05:54', NULL);
insert into categories (categories_id, categories_image, parent_id, sort_order, date_added, last_modified) values ('13', 'subcategory_cartoons.gif', '3', '0', '2006-08-19 16:05:54', NULL);
insert into categories (categories_id, categories_image, parent_id, sort_order, date_added, last_modified) values ('14', 'subcategory_thriller.gif', '3', '0', '2006-08-19 16:05:54', NULL);
insert into categories (categories_id, categories_image, parent_id, sort_order, date_added, last_modified) values ('15', 'subcategory_drama.gif', '3', '0', '2006-08-19 16:05:54', NULL);
insert into categories (categories_id, categories_image, parent_id, sort_order, date_added, last_modified) values ('16', 'subcategory_memory.gif', '1', '0', '2006-08-19 16:05:54', '2006-08-19 16:38:32');
insert into categories (categories_id, categories_image, parent_id, sort_order, date_added, last_modified) values ('17', 'subcategory_cdrom_drives.gif', '1', '0', '2006-08-19 16:05:54', '2006-08-19 16:38:13');
insert into categories (categories_id, categories_image, parent_id, sort_order, date_added, last_modified) values ('18', 'subcategory_simulation.gif', '2', '0', '2006-08-19 16:05:54', NULL);
insert into categories (categories_id, categories_image, parent_id, sort_order, date_added, last_modified) values ('19', 'subcategory_action_games.gif', '2', '0', '2006-08-19 16:05:54', NULL);
insert into categories (categories_id, categories_image, parent_id, sort_order, date_added, last_modified) values ('20', 'subcategory_strategy.gif', '2', '0', '2006-08-19 16:05:54', NULL);

insert into categories_description (categories_id, language_id, categories_name) values ('10', '3', 'Accion');
insert into categories_description (categories_id, language_id, categories_name) values ('19', '3', 'Accion');
insert into categories_description (categories_id, language_id, categories_name) values ('10', '1', 'Action');
insert into categories_description (categories_id, language_id, categories_name) values ('10', '2', 'Action');
insert into categories_description (categories_id, language_id, categories_name) values ('10', '4', 'Action');
insert into categories_description (categories_id, language_id, categories_name) values ('19', '1', 'Action');
insert into categories_description (categories_id, language_id, categories_name) values ('19', '2', 'Action');
insert into categories_description (categories_id, language_id, categories_name) values ('19', '4', 'Action');
insert into categories_description (categories_id, language_id, categories_name) values ('7', '3', 'Altavoces');
insert into categories_description (categories_id, language_id, categories_name) values ('6', '2', 'Bildschirme');
insert into categories_description (categories_id, language_id, categories_name) values ('4', '4', 'Cartes graphiques');
insert into categories_description (categories_id, language_id, categories_name) values ('13', '1', 'Cartoons');
insert into categories_description (categories_id, language_id, categories_name) values ('13', '4', 'Cartoons');
insert into categories_description (categories_id, language_id, categories_name) values ('17', '1', 'CDROM Drives');
insert into categories_description (categories_id, language_id, categories_name) values ('17', '2', 'CDROM Laufwerke');
insert into categories_description (categories_id, language_id, categories_name) values ('11', '3', 'Ciencia Ficcion');
insert into categories_description (categories_id, language_id, categories_name) values ('8', '4', 'Claviers');
insert into categories_description (categories_id, language_id, categories_name) values ('12', '3', 'Comedia');
insert into categories_description (categories_id, language_id, categories_name) values ('12', '1', 'Comedy');
insert into categories_description (categories_id, language_id, categories_name) values ('12', '4', 'Comedy');
insert into categories_description (categories_id, language_id, categories_name) values ('13', '3', 'Dibujos Animados');
insert into categories_description (categories_id, language_id, categories_name) values ('15', '1', 'Drama');
insert into categories_description (categories_id, language_id, categories_name) values ('15', '2', 'Drama');
insert into categories_description (categories_id, language_id, categories_name) values ('15', '3', 'Drama');
insert into categories_description (categories_id, language_id, categories_name) values ('15', '4', 'Drama');
insert into categories_description (categories_id, language_id, categories_name) values ('5', '2', 'Drucker');
insert into categories_description (categories_id, language_id, categories_name) values ('3', '2', 'DVD Filme');
insert into categories_description (categories_id, language_id, categories_name) values ('3', '1', 'DVD Movies');
insert into categories_description (categories_id, language_id, categories_name) values ('20', '3', 'Estrategia');
insert into categories_description (categories_id, language_id, categories_name) values ('3', '4', 'Films et DVD');
insert into categories_description (categories_id, language_id, categories_name) values ('4', '2', 'Grafikkarten');
insert into categories_description (categories_id, language_id, categories_name) values ('4', '1', 'Graphics Cards');
insert into categories_description (categories_id, language_id, categories_name) values ('1', '1', 'Hardware');
insert into categories_description (categories_id, language_id, categories_name) values ('1', '2', 'Hardware');
insert into categories_description (categories_id, language_id, categories_name) values ('1', '3', 'Hardware');
insert into categories_description (categories_id, language_id, categories_name) values ('7', '4', 'Haut-parleurs');
insert into categories_description (categories_id, language_id, categories_name) values ('5', '3', 'Impresoras');
insert into categories_description (categories_id, language_id, categories_name) values ('5', '4', 'Imprimantes');
insert into categories_description (categories_id, language_id, categories_name) values ('8', '1', 'Keyboards');
insert into categories_description (categories_id, language_id, categories_name) values ('12', '2', 'Komödie');
insert into categories_description (categories_id, language_id, categories_name) values ('7', '2', 'Lautsprecher');
insert into categories_description (categories_id, language_id, categories_name) values ('17', '4', 'Lecteurs CDROM');
insert into categories_description (categories_id, language_id, categories_name) values ('2', '4', 'Logiciels');
insert into categories_description (categories_id, language_id, categories_name) values ('1', '4', 'Matériel');
insert into categories_description (categories_id, language_id, categories_name) values ('16', '4', 'Mémoire');
insert into categories_description (categories_id, language_id, categories_name) values ('16', '3', 'Memoria');
insert into categories_description (categories_id, language_id, categories_name) values ('16', '1', 'Memory');
insert into categories_description (categories_id, language_id, categories_name) values ('9', '1', 'Mice');
insert into categories_description (categories_id, language_id, categories_name) values ('6', '4', 'Moniteurs / écrans');
insert into categories_description (categories_id, language_id, categories_name) values ('6', '3', 'Monitores');
insert into categories_description (categories_id, language_id, categories_name) values ('6', '1', 'Monitors');
insert into categories_description (categories_id, language_id, categories_name) values ('9', '2', 'Mäuse');
insert into categories_description (categories_id, language_id, categories_name) values ('3', '3', 'Peliculas DVD');
insert into categories_description (categories_id, language_id, categories_name) values ('5', '1', 'Printers');
insert into categories_description (categories_id, language_id, categories_name) values ('9', '3', 'Ratones');
insert into categories_description (categories_id, language_id, categories_name) values ('11', '1', 'Science Fiction');
insert into categories_description (categories_id, language_id, categories_name) values ('11', '2', 'Science Fiction');
insert into categories_description (categories_id, language_id, categories_name) values ('11', '4', 'Science Fiction');
insert into categories_description (categories_id, language_id, categories_name) values ('18', '3', 'Simulacion');
insert into categories_description (categories_id, language_id, categories_name) values ('18', '1', 'Simulation');
insert into categories_description (categories_id, language_id, categories_name) values ('18', '2', 'Simulation');
insert into categories_description (categories_id, language_id, categories_name) values ('18', '4', 'Simulation');
insert into categories_description (categories_id, language_id, categories_name) values ('2', '1', 'Software');
insert into categories_description (categories_id, language_id, categories_name) values ('2', '2', 'Software');
insert into categories_description (categories_id, language_id, categories_name) values ('2', '3', 'Software');
insert into categories_description (categories_id, language_id, categories_name) values ('9', '4', 'Souris');
insert into categories_description (categories_id, language_id, categories_name) values ('7', '1', 'Speakers');
insert into categories_description (categories_id, language_id, categories_name) values ('16', '2', 'Speicher');
insert into categories_description (categories_id, language_id, categories_name) values ('20', '2', 'Strategie');
insert into categories_description (categories_id, language_id, categories_name) values ('20', '1', 'Strategy');
insert into categories_description (categories_id, language_id, categories_name) values ('20', '4', 'Strategy');
insert into categories_description (categories_id, language_id, categories_name) values ('14', '3', 'Suspense');
insert into categories_description (categories_id, language_id, categories_name) values ('4', '3', 'Tarjetas Graficas');
insert into categories_description (categories_id, language_id, categories_name) values ('8', '2', 'Tastaturen');
insert into categories_description (categories_id, language_id, categories_name) values ('8', '3', 'Teclados');
insert into categories_description (categories_id, language_id, categories_name) values ('14', '1', 'Thriller');
insert into categories_description (categories_id, language_id, categories_name) values ('14', '2', 'Thriller');
insert into categories_description (categories_id, language_id, categories_name) values ('14', '4', 'Thriller');
insert into categories_description (categories_id, language_id, categories_name) values ('17', '3', 'Unidades CDROM');
insert into categories_description (categories_id, language_id, categories_name) values ('13', '2', 'Zeichentrick');

insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('1', 'Nom de la boutique', 'STORE_NAME', 'rc1V4', 'Indiquer le nom de la boutique.', '1', '1', NULL, '2006-08-19 16:05:56', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('2', 'Propriétaire de la boutique', 'STORE_OWNER', 'John Doe', 'Indiquer le nom du Propriétaire de la boutique.', '1', '2', NULL, '2006-08-19 16:05:56', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('3', 'Adresse  E-Mail', 'STORE_OWNER_EMAIL_ADDRESS', 'John.Doe@fai.com', 'L\'adresse email du gérant de la boutique.', '1', '3', NULL, '2006-08-19 16:05:56', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('4', 'Champ \'From\' d\'un email envoyé', 'EMAIL_FROM', '\"John Doe\" <John.Doe@fai.com>', 'L\'adresse email utilisée pour identifier l\'expéditeur des emails envoyés par la boutique.', '1', '4', NULL, '2006-08-19 16:05:56', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('5', 'Pays', 'STORE_COUNTRY', '73', 'Le pays de résidence de la boutique.<br><br><b>Note : Penser à mettre à jour la zone.</b>', '1', '6', NULL, '2006-08-19 16:05:56', 'tep_get_country_name', 'tep_cfg_pull_down_country_list(');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('6', 'Zone', 'STORE_ZONE', '192', 'Zone de la localisation de la boutique.', '1', '7', NULL, '2006-08-19 16:05:56', 'tep_cfg_get_zone_name', 'tep_cfg_pull_down_zone_list(');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('7', 'Ordre de tri des articles', 'EXPECTED_PRODUCTS_SORT', 'desc', 'Ordre de tri utilisé dans la boite \'articles en attente\'.<br>(Ascendant ou Descendant)', '1', '8', NULL, '2006-08-19 16:05:56', NULL, 'tep_cfg_select_option(array(\'asc\', \'desc\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('8', 'Tri des articles en attente', 'EXPECTED_PRODUCTS_FIELD', 'date_expected', 'Critère de tri utilisé dans la boite \'articles en attente\'.<br>(par Nom ou par Date)', '1', '9', NULL, '2006-08-19 16:05:56', NULL, 'tep_cfg_select_option(array(\'products_name\', \'date_expected\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('9', 'Ajustement auto des devises', 'USE_DEFAULT_LANGUAGE_CURRENCY', 'Non', 'Change automatiquement la langue sur celle correspondant à la nouvelle devise choisie.', '1', '10', NULL, '2006-08-19 16:05:56', NULL, 'tep_cfg_select_option(array(\'Oui\', \'Non\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('10', 'E-Mail de copies de commande', 'SEND_EXTRA_ORDER_EMAILS_TO', '', 'Envoie une copie de la commande aux adresses spécifiées. Celles-ci doivent être dans le format :<br>Nom 1 <email@address1>, Nom 2 <email@address2>', '1', '11', NULL, now(), NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('11', 'Utiliser URL pour moteurs de recherche (non fonctionnel)', 'SEARCH_ENGINE_FRIENDLY_URLS', 'Non', 'Utiliser des URL vérifiées pour tous les liens de la boutique.<br>laisser sur False', '6', '12', NULL, '2006-08-19 16:05:57', NULL, 'tep_cfg_select_option(array(\'Oui\', \'Non\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('12', 'Afficher le panier après l\'ajout de produit', 'DISPLAY_CART', 'Oui', 'Affiche le contenu du panier après avoir ajouté un article (ou retourne à l\'origine).', '1', '14', NULL, '2006-08-19 16:05:57', NULL, 'tep_cfg_select_option(array(\'Oui\', \'Non\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('13', 'Permettre la recommandation d\'un article', 'ALLOW_GUEST_TO_TELL_A_FRIEND', 'Non', 'Permettre aux visiteurs de recommander un article.', '1', '15', NULL, '2006-08-19 16:05:57', NULL, 'tep_cfg_select_option(array(\'Oui\', \'Non\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('14', 'Option de recherche par défaut', 'ADVANCED_SEARCH_DEFAULT_OPERATOR', 'and', 'Choisir l\'opérateur de recherche par défaut.<br>(AND ou OR)', '1', '17', NULL, '2006-08-19 16:05:57', NULL, 'tep_cfg_select_option(array(\'and\', \'or\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('15', 'Nom, adresse, pays et tel de la boutique', 'STORE_NAME_ADDRESS', 'Nom, adresse, pays et Tel de la boutique', 'Nom, adresse, pays et téléphone de la boutique utilisés dans les impressions de documents et l\'affichage en ligne.', '1', '18', NULL, '2006-08-19 16:05:57', NULL, 'tep_cfg_textarea(');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('16', 'Décompte des catégories', 'SHOW_COUNTS', 'Oui', 'Décompter combien de produits sont présents dans chaque catégorie.', '1', '19', NULL, '2006-08-19 16:05:57', NULL, 'tep_cfg_select_option(array(\'Oui\', \'Non\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('17', 'Taxe Décimale', 'TAX_DECIMAL_PLACES', '0', 'Emplacement décimal pour la valeur du montant de la taxe.', '1', '20', NULL, '2006-08-19 16:05:57', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('18', 'Afficher les prix avec taxe', 'DISPLAY_PRICE_WITH_TAX', 'Non', 'Afficher les prix taxes incluses (true) ou ajouter la taxe à la fin (false).', '1', '21', NULL, '2006-08-19 16:05:57', NULL, 'tep_cfg_select_option(array(\'Oui\', \'Non\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('19', 'Prénom', 'ENTRY_FIRST_NAME_MIN_LENGTH', '2', 'Nombre de caractères minimum requis pour le prénom.', '2', '1', NULL, '2006-08-19 16:05:57', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('20', 'Nom', 'ENTRY_LAST_NAME_MIN_LENGTH', '2', 'Nombre de caractères minimum requis pour le nom de famille.', '2', '2', NULL, '2006-08-19 16:05:57', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('21', 'Date de naissance', 'ENTRY_DOB_MIN_LENGTH', '10', 'Nombre de caractères minimum requis pour la date de naissance.', '2', '3', NULL, '2006-08-19 16:05:57', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('22', 'Adresse E-Mail', 'ENTRY_EMAIL_ADDRESS_MIN_LENGTH', '6', 'Nombre de caractères minimum requis pour l\'adresse email.', '2', '4', NULL, '2006-08-19 16:05:57', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('23', 'Adresse', 'ENTRY_STREET_ADDRESS_MIN_LENGTH', '5', 'Nombre de caractères minimum requis pour l\'adresse postale.', '2', '5', NULL, '2006-08-19 16:05:57', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('24', 'Société', 'ENTRY_COMPANY_MIN_LENGTH', '2', 'Nombre de caractères minimum requis pour le nom de la société.', '2', '6', NULL, '2006-08-19 16:05:57', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('25', 'Code Postal', 'ENTRY_POSTCODE_MIN_LENGTH', '4', 'Nombre de caractères minimum requis pour le code postal.', '2', '7', NULL, '2006-08-19 16:05:57', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('26', 'Ville', 'ENTRY_CITY_MIN_LENGTH', '3', 'Nombre de caractères minimum requis pour la ville.', '2', '8', NULL, '2006-08-19 16:05:57', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('27', 'Etat', 'ENTRY_STATE_MIN_LENGTH', '2', 'Nombre de caractères minimum requis pour l\'état.', '2', '9', NULL, '2006-08-19 16:05:57', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('28', 'Téléphone', 'ENTRY_TELEPHONE_MIN_LENGTH', '3', 'Nombre de caractères minimum requis pour le téléphone.', '2', '10', NULL, '2006-08-19 16:05:57', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('29', 'Mot de Passe', 'ENTRY_PASSWORD_MIN_LENGTH', '5', 'Nombre de caractères minimum requis pour le mot de passe utilisateur.', '2', '11', NULL, '2006-08-19 16:05:57', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('30', 'Propriétaire de la carte de crédit', 'CC_OWNER_MIN_LENGTH', '3', 'Nombre de caractères minimum requis pour le nom du propriétaire de la carte de crédit.', '2', '12', NULL, '2006-08-19 16:05:57', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('31', 'Numéro de la carte de crédit', 'CC_NUMBER_MIN_LENGTH', '10', 'Nombre de caractères minimum requis pour le numéro de la carte de crédit.', '2', '13', NULL, '2006-08-19 16:05:57', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('32', 'Texte des critiques', 'REVIEW_TEXT_MIN_LENGTH', '50', 'Nombre de caractères minimum requis pour le texte des critiques.', '2', '14', NULL, '2006-08-19 16:05:57', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('33', 'Affichage du Bloc Meilleures ventes', 'MIN_DISPLAY_BESTSELLERS', '1', 'Nombre minimum de meilleures ventes à afficher dans le bloc.', '2', '15', NULL, '2006-08-19 16:05:57', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('34', 'Affichage du Bloc Egalement acheté', 'MIN_DISPLAY_ALSO_PURCHASED', '1', 'Nombre minimum d\'articles déjà achetés à afficher dans le bloc.', '2', '16', NULL, '2006-08-19 16:05:57', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('35', 'Nombre d\'entrées dans le carnet d\'adresses', 'MAX_ADDRESS_BOOK_ENTRIES', '5', 'Nombre maximum d\'entrées dans le carnet d\'adresses pour un client.', '3', '1', NULL, '2006-08-19 16:05:57', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('36', 'Résultat de recherche', 'MAX_DISPLAY_SEARCH_RESULTS', '20', 'Quantité d\'articles à afficher par page.', '3', '2', NULL, '2006-08-19 16:05:57', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('37', 'Liens de page', 'MAX_DISPLAY_PAGE_LINKS', '5', 'Nombre de liens utilisés.', '3', '3', NULL, '2006-08-19 16:05:57', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('38', 'Affichage des promotions', 'MAX_DISPLAY_SPECIAL_PRODUCTS', '9', 'Nombre maximum d\'articles en promotion à afficher.', '3', '4', NULL, '2006-08-19 16:05:57', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('39', 'Affichage nouveaux produits', 'MAX_DISPLAY_NEW_PRODUCTS', '9', 'Nombre maximum de nouveaux produits à afficher.', '3', '5', NULL, '2006-08-19 16:05:57', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('40', 'Affichage produits en attente', 'MAX_DISPLAY_UPCOMING_PRODUCTS', '10', 'Nombre maximum de produits en attente à afficher.', '3', '6', NULL, '2006-08-19 16:05:57', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('41', 'Affichage du Bloc Fabricants', 'MAX_DISPLAY_MANUFACTURERS_IN_A_LIST', '0', 'Quand le nombre de fabricants dépasse cette valeur, une \'liste déroulante\' sera utilisée à la place de la liste par défaut.', '3', '7', NULL, '2006-08-19 16:05:57', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('42', 'Affichage du Bloc Fabricants \'Liste\'', 'MAX_MANUFACTURERS_LIST', '1', 'Quand cette valeur est égale à 1 la \'liste déroulante\' classique sera utilisée. Sinon, une liste sera affichée avec le nombre de lignes spécifiées.', '3', '7', NULL, '2006-08-19 16:05:57', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('43', 'Affichage du Bloc Fabricants \'Longueur du nom\'', 'MAX_DISPLAY_MANUFACTURER_NAME_LEN', '15', 'Longueur maximum du nom de fabricant à afficher.', '3', '8', NULL, '2006-08-19 16:05:58', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('44', 'Affichage des nouvelles critiques', 'MAX_DISPLAY_NEW_REVIEWS', '6', 'Nombre maximum de nouvelles critiques à afficher.', '3', '9', NULL, '2006-08-19 16:05:58', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('45', 'Sélection de critiques au hasard', 'MAX_RANDOM_SELECT_REVIEWS', '10', 'Nombre d\'entrées possible pour choisir (affichage) un des commentaires de produit.', '3', '10', NULL, '2006-08-19 16:05:58', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('46', 'Sélection de nouveaux produits au hasard', 'MAX_RANDOM_SELECT_NEW', '10', 'Nombre d\'entrées possible pour choisir (affichage) un des nouveaux produits.', '3', '11', NULL, '2006-08-19 16:05:58', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('47', 'Sélection d’articles en promotion au hasard', 'MAX_RANDOM_SELECT_SPECIALS', '10', 'Nombre d\'entrées possible pour choisir (affichage) un des articles ayant une offre promotionnelle ou ayant un effet spécial.', '3', '12', NULL, '2006-08-19 16:05:58', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('48', 'Affichage Page Catégories', 'MAX_DISPLAY_CATEGORIES_PER_ROW', '3', 'Nombre de colonnes pour afficher les catégories.', '3', '13', NULL, '2006-08-19 16:05:58', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('49', 'Affichage Page Nouveautés', 'MAX_DISPLAY_PRODUCTS_NEW', '10', 'Nombre maximum de produits à afficher dans la page nouveautés.', '3', '14', NULL, '2006-08-19 16:05:58', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('50', 'Affichage Bloc Meilleures ventes', 'MAX_DISPLAY_BESTSELLERS', '10', 'Nombre maximum de meilleures ventes à afficher dans le bloc.', '3', '15', NULL, '2006-08-19 16:05:58', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('51', 'Affichage Bloc Egalement acheté', 'MAX_DISPLAY_ALSO_PURCHASED', '6', 'Nombre maximum de produits déjà achetés à afficher dans le bloc.', '3', '16', NULL, '2006-08-19 16:05:58', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('52', 'Affichage Bloc Historique de commande', 'MAX_DISPLAY_PRODUCTS_IN_ORDER_HISTORY_BOX', '6', 'Nombre maximum d\'historiques de commande à afficher dans le bloc.', '3', '17', NULL, '2006-08-19 16:05:58', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('53', 'Affichage Page Historique de commande', 'MAX_DISPLAY_ORDER_HISTORY', '10', 'Nombre maximum d\'historiques de commande à afficher dans la page.', '3', '18', NULL, '2006-08-19 16:05:58', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('54', 'Petite image, Largeur', 'SMALL_IMAGE_WIDTH', '100', 'Nombre de pixels pour la largeur des petites images des articles.', '4', '1', NULL, '2006-08-19 16:05:58', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('55', 'Petite image, Hauteur', 'SMALL_IMAGE_HEIGHT', '80', 'Nombre de pixels pour la hauteur des petites images des articles.', '4', '2', NULL, '2006-08-19 16:05:58', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('56', 'Image d\'en-tête, Largeur', 'HEADING_IMAGE_WIDTH', '57', 'Nombre de pixels pour la largeur des images d\'en-tête.', '4', '3', NULL, '2006-08-19 16:05:58', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('57', 'Image d\'en-tête, Hauteur', 'HEADING_IMAGE_HEIGHT', '40', 'Nombre de pixels pour la hauteur des images d\'en-tête.', '4', '4', NULL, '2006-08-19 16:05:58', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('58', 'Image de sous-catégorie, Largeur', 'SUBCATEGORY_IMAGE_WIDTH', '100', 'Nombre de pixels pour la largeur des images de sous-catégorie.', '4', '5', NULL, '2006-08-19 16:05:58', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('59', 'Image de sous-catégorie, Hauteur', 'SUBCATEGORY_IMAGE_HEIGHT', '57', 'Nombre de pixels pour la hauteur des images de sous-catégorie.', '4', '6', NULL, '2006-08-19 16:05:58', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('60', 'Calcul Auto de la taille des images', 'CONFIG_CALCULATE_IMAGE_SIZE', 'Oui', 'Calculer automatiquement la taille des images ?', '4', '7', NULL, '2006-08-19 16:05:58', NULL, 'tep_cfg_select_option(array(\'Oui\', \'Non\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('61', 'Image inexistante', 'IMAGE_REQUIRED', 'Oui', 'Permettre l\'affichage des liens brisés sur les images (pour le développement).', '4', '8', NULL, '2006-08-19 16:05:58', NULL, 'tep_cfg_select_option(array(\'Oui\', \'Non\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('62', 'Genre', 'ACCOUNT_GENDER', 'Oui', 'Afficher le genre dans le compte client.', '5', '1', NULL, '2006-08-19 16:05:58', NULL, 'tep_cfg_select_option(array(\'Oui\', \'Non\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('63', 'Date de naissance', 'ACCOUNT_DOB', 'Oui', 'Afficher la date de naissance dans le compte client.', '5', '2', NULL, '2006-08-19 16:05:58', NULL, 'tep_cfg_select_option(array(\'Oui\', \'Non\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('64', 'Société', 'ACCOUNT_COMPANY', 'Oui', 'Afficher la société dans le compte client.', '5', '3', NULL, '2006-08-19 16:05:58', NULL, 'tep_cfg_select_option(array(\'Oui\', \'Non\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('65', 'Complément d\'adresse', 'ACCOUNT_SUBURB', 'Oui', 'Afficher le complément d\'adresse dans le compte client.', '5', '4', NULL, '2006-08-19 16:05:58', NULL, 'tep_cfg_select_option(array(\'Oui\', \'Non\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('66', 'Etat, Département', 'ACCOUNT_STATE', 'Non', 'Afficher le département (état) dans le compte client.', '5', '5', NULL, '2006-08-19 16:05:58', NULL, 'tep_cfg_select_option(array(\'Oui\', \'Non\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('67', 'Modules de paiement installés', 'MODULE_PAYMENT_INSTALLED', 'cod.php;moneyorder.php', 'Liste des modules de payement installés séparés par un point virgule. Mise à jour automatique. Ne pas éditer. (Exemple: cc.php;cod.php;paypal.php)', '6', '0', '2008-04-16 23:22:24', '2006-08-19 16:05:58', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('68', 'Modules total commande installés', 'MODULE_ORDER_TOTAL_INSTALLED', 'ot_subtotal.php;ot_tax.php;ot_shipping.php;ot_total.php', 'Liste des modules de total installés; séparés par un point virgule. Mise à jour automatique. Ne pas éditer. (Exemple: ot_subtotal.php;ot_tax.php;ot_shipping.php;ot_total.php)', '6', '0', NULL, '2006-08-19 16:05:58', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('69', 'Modules de livraison installés', 'MODULE_SHIPPING_INSTALLED', 'flat.php;item.php', 'Liste des modules de livraison installés; séparés par un point virgule. Mise à jour automatique. Ne pas éditer. (Exemple: ups.php;flat.php;item.php)', '6', '0', '2008-04-16 23:22:45', '2006-08-19 16:05:58', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('70', 'Devise par défaut', 'DEFAULT_CURRENCY', 'EUR', 'Devise par défaut.', '6', '0', NULL, '2006-08-19 16:05:59', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('71', 'Language par défaut', 'DEFAULT_LANGUAGE', 'fr', 'Language par défaut.', '6', '0', NULL, '2006-08-19 16:05:59', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('72', 'Etat par défaut pour une nouvelle commande', 'DEFAULT_ORDERS_STATUS_ID', '1', 'Quand une nouvelle commande est créée, ce statut de commande lui sera assigné.', '6', '0', NULL, '2006-08-19 16:05:59', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('73', 'Affichage livraison', 'MODULE_ORDER_TOTAL_SHIPPING_STATUS', 'Oui', 'Voulez vous afficher le coût de livraison de la commande ?', '6', '1', NULL, '2006-08-19 16:05:59', NULL, 'tep_cfg_select_option(array(\'Oui\', \'Non\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('74', 'Ordre de tri', 'MODULE_ORDER_TOTAL_SHIPPING_SORT_ORDER', '2', 'Ordre de tri pour l\'affichage (Le plus petit nombre est montrer en premier).', '6', '2', NULL, '2006-08-19 16:05:59', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('75', 'Permettre la livraison gratuite', 'MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING', 'Non', 'Voulez vous accepter les livraisons gratuites en fonction du montant ?', '6', '3', NULL, '2006-08-19 16:05:59', NULL, 'tep_cfg_select_option(array(\'Oui\', \'Non\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('76', 'Livraison gratuite pour commande au dessus', 'MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER', '50', 'Permettre la livraison gratuite pour les commandes au dessus du montant suivant.', '6', '4', NULL, '2006-08-19 16:05:59', 'currencies->format', NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('77', 'Attacher livraison gratuite pour les destinations', 'MODULE_ORDER_TOTAL_SHIPPING_DESTINATION', 'national', 'Livraison gratuite pour des commandes envoyés à l\'ensemble des destinations.<br>(both=tous les deux)', '6', '5', NULL, '2006-08-19 16:05:59', NULL, 'tep_cfg_select_option(array(\'national\', \'international\', \'both\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('78', 'Affichage du sous-total', 'MODULE_ORDER_TOTAL_SUBTOTAL_STATUS', 'Oui', 'Voulez-vous montrer le sous-total de la commande ?', '6', '1', NULL, '2006-08-19 16:05:59', NULL, 'tep_cfg_select_option(array(\'Oui\', \'Non\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('79', 'Ordre de tri', 'MODULE_ORDER_TOTAL_SUBTOTAL_SORT_ORDER', '1', 'Ordre de tri pour l\'affichage (Le plus petit nombre est montrer en premier).', '6', '2', NULL, '2006-08-19 16:05:59', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('80', 'Affichage de la taxe', 'MODULE_ORDER_TOTAL_TAX_STATUS', 'Oui', 'Voulez-vous montrer la taxe de la commande ?', '6', '1', NULL, '2006-08-19 16:05:59', NULL, 'tep_cfg_select_option(array(\'Oui\', \'Non\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('81', 'Ordre de tri', 'MODULE_ORDER_TOTAL_TAX_SORT_ORDER', '3', 'Ordre de tri pour l\'affichage (Le plus petit nombre est montrer en premier).', '6', '2', NULL, '2006-08-19 16:05:59', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('82', 'Affichage du total', 'MODULE_ORDER_TOTAL_TOTAL_STATUS', 'Oui', 'Voulez-vous montrer le total de la commande ?', '6', '1', NULL, '2006-08-19 16:05:59', NULL, 'tep_cfg_select_option(array(\'Oui\', \'Non\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('83', 'Ordre de tri', 'MODULE_ORDER_TOTAL_TOTAL_SORT_ORDER', '4', 'Ordre de tri pour l\'affichage (Le plus petit nombre est montrer en premier).', '6', '2', NULL, '2006-08-19 16:05:59', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('84', 'Code pays boutique', 'SHIPPING_ORIGIN_COUNTRY', '73', 'Entrer le code \"ISO 3166\" du pays pour calculer les coûts d\'expédition.', '7', '1', '2008-04-15 15:22:29', '2006-08-19 16:05:59', 'tep_get_country_name', 'tep_cfg_pull_down_country_list(');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('85', 'Code postal boutique', 'SHIPPING_ORIGIN_ZIP', '75000', 'Entrez le code postal de la boutique pour calculer les frais d\'expédition.', '7', '2', '2008-04-15 15:22:43', '2006-08-19 16:05:59', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('86', 'Poids maximum expédiable (en Kg)', 'SHIPPING_MAX_WEIGHT', '50', 'Les transporteurs ont une limite de poids maximum par colis. Cette limite est commune pour tous.', '7', '3', NULL, '2006-08-19 16:05:59', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('87', 'Tare de l\'emballage', 'SHIPPING_BOX_WEIGHT', '3', 'Quel est le poids moyen de l\'emballage et conditionnement des colis de petite à moyenne taille ?', '7', '4', NULL, '2006-08-19 16:05:59', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('88', 'Gros colis - Pourcentage de supplément', 'SHIPPING_BOX_PADDING', '10', 'Pour 10% de supplément, entrer 10.', '7', '5', NULL, '2006-08-19 16:05:59', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('89', 'Affichage de l\'image', 'PRODUCT_LIST_IMAGE', '1', 'Dans la liste des articles, voulez-vous afficher l\'image du produit ?<br>(0 ou ordre de tri)', '8', '1', NULL, '2006-08-19 16:05:59', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('90', 'Affichage du fabricant', 'PRODUCT_LIST_MANUFACTURER', '0', 'Dans la liste des articles, voulez-vous afficher le nom du fabricant ?<br>(0 ou ordre de tri)', '8', '2', NULL, '2006-08-19 16:05:59', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('91', 'Affichage du modèle', 'PRODUCT_LIST_MODEL', '0', 'Dans la liste des articles, voulez-vous afficher le modèle du produit ?<br>(0 ou ordre de tri)', '8', '3', NULL, '2006-08-19 16:05:59', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('92', 'Affichage nom du produit', 'PRODUCT_LIST_NAME', '2', 'Dans la liste des articles, voulez-vous afficher le nom du produit ?<br>(0 ou ordre de tri)', '8', '4', NULL, '2006-08-19 16:05:59', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('93', 'Affichage prix', 'PRODUCT_LIST_PRICE', '3', 'Dans la liste des articles, voulez-vous afficher le prix du produit ?<br>(0 ou ordre de tri)', '8', '5', NULL, '2006-08-19 16:05:59', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('94', 'Affichage quantité', 'PRODUCT_LIST_QUANTITY', '0', 'Dans la liste des articles, voulez-vous afficher la quantité du produit ?<br>(0 ou ordre de tri)', '8', '6', NULL, '2006-08-19 16:05:59', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('95', 'Affichage poids', 'PRODUCT_LIST_WEIGHT', '0', 'Dans la liste des articles, voulez-vous afficher le poids du produit ?<br>(0 ou ordre de tri)', '8', '7', NULL, '2006-08-19 16:05:59', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('96', 'Affichage bouton \'acheter\'', 'PRODUCT_LIST_BUY_NOW', '4', 'Dans la liste des articles, voulez-vous afficher le bouton \"acheter maintenant\" du produit ?<br>(0 ou ordre de tri)', '8', '8', NULL, '2006-08-19 16:05:59', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('97', 'Affichage du filtre Catégorie/Fabricant', 'PRODUCT_LIST_FILTER', '1', 'Afficher le filtre dans la liste des articles ?<br>(0=non, 1=oui)', '8', '9', NULL, '2006-08-19 16:06:00', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('98', 'Position de la barre de navigation', 'PREV_NEXT_BAR_LOCATION', '2', 'Position de la barre de navigation.<br>(1-haut, 2-bas, 3-les deux)', '8', '10', NULL, '2006-08-19 16:06:00', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('99', 'Vérification du stock', 'STOCK_CHECK', 'Oui', 'Vérifier si le niveau de stock est suffisant.', '9', '1', NULL, '2006-08-19 16:06:00', NULL, 'tep_cfg_select_option(array(\'Oui\', \'Non\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('100', 'Décompte du stock', 'STOCK_LIMITED', 'Oui', 'Décompte du stock les articles commandés.', '9', '2', NULL, '2006-08-19 16:06:00', NULL, 'tep_cfg_select_option(array(\'Oui\', \'Non\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('101', 'Autorisation achat hors stock', 'STOCK_ALLOW_CHECKOUT', 'Oui', 'Permet au client de commander même si un article n\'est pas en stock.', '9', '3', NULL, '2006-08-19 16:06:00', NULL, 'tep_cfg_select_option(array(\'Oui\', \'Non\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('102', 'Affichage des produits hors stock', 'STOCK_MARK_PRODUCT_OUT_OF_STOCK', '***', 'Affiche la remarque suivante si le produit n\'est plus en stock.', '9', '4', NULL, '2006-08-19 16:06:00', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('103', 'Stock niveau d\'alerte', 'STOCK_REORDER_LEVEL', '5', 'Niveau pour l\'alerte de réapprovisionnement du stock.', '9', '5', NULL, '2006-08-19 16:06:00', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('104', 'Stockage du temps d\'exécution', 'STORE_PAGE_PARSE_TIME', 'Non', 'Stocke le temps d\'exécution d\'une page.', '10', '1', NULL, '2006-08-19 16:06:00', NULL, 'tep_cfg_select_option(array(\'Oui\', \'Non\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('105', 'Emplacement du fichier pour le stocke d\'exécution', 'STORE_PAGE_PARSE_TIME_LOG', '/var/log/www/tep/page_parse_time.log', 'Chemin d\'accès et nom du fichier des temps d\'exécution.', '10', '2', NULL, '2006-08-19 16:06:00', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('106', 'Format de date des exécutions', 'STORE_PARSE_DATE_TIME_FORMAT', '%d/%m/%Y %H:%M:%S', 'Format de la date des exécutions.', '10', '3', NULL, '2006-08-19 16:06:00', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('107', 'Affichage du temps d\'exécution', 'DISPLAY_PAGE_PARSE_TIME', 'Oui', 'Affiche le temps d\'exécution d\'une page (le stockage du temps d\'exécution doit être activé et avoir choisie l\'emplacement du fichier pour le stocke d\'exécution).', '10', '4', NULL, '2006-08-19 16:06:00', NULL, 'tep_cfg_select_option(array(\'Oui\', \'Non\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('108', 'Requêtes de base des données', 'STORE_DB_TRANSACTIONS', 'Non', 'Stocke les requêtes de la base des données avec les temps d\'exécution (PHP4 seulement).', '10', '5', NULL, '2006-08-19 16:06:00', NULL, 'tep_cfg_select_option(array(\'Oui\', \'Non\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('109', 'Utiliser le cache', 'USE_CACHE', 'Non', 'Utiliser les fonctionnalités de cache.', '11', '1', NULL, '2006-08-19 16:06:00', NULL, 'tep_cfg_select_option(array(\'Oui\', \'Non\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('110', 'Répertoire de cache', 'DIR_FS_CACHE', '/tmp/', 'Répertoire où les fichiers de cache sont stockés.', '11', '2', NULL, '2006-08-19 16:06:00', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('111', 'Méthode de transport d\'email', 'EMAIL_TRANSPORT', 'smtp', 'Définit si le serveur utilise une connexion locale à sendmail ou une connexion SMTP par TCP/IP. Les Serveurs Windows et MacOS devraient codifier SMTP.', '12', '1', NULL, '2006-08-19 16:06:00', NULL, 'tep_cfg_select_option(array(\'sendmail\', \'smtp\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('112', 'Saut de ligne en-tête des emails', 'EMAIL_LINEFEED', 'LF', 'Définit les caractères utilisés pour séparer les en-têtes des emails.', '12', '2', NULL, '2006-08-19 16:06:00', NULL, 'tep_cfg_select_option(array(\'LF\', \'CRLF\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('113', 'Utiliser MIME HTML pour l\'envoi des emails', 'EMAIL_USE_HTML', 'Non', 'Envoie les emails au format html (true) ou texte brut (false).', '12', '3', NULL, '2006-08-19 16:06:00', NULL, 'tep_cfg_select_option(array(\'Oui\', \'Non\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('114', 'Vérifier l\'adresse email par le DNS', 'ENTRY_EMAIL_ADDRESS_CHECK', 'Non', 'Vérifier l\'adresse email au travers un serveur DNS.', '12', '4', NULL, '2006-08-19 16:06:00', NULL, 'tep_cfg_select_option(array(\'Oui\', \'Non\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('115', 'Activation des emails', 'SEND_EMAILS', 'Oui', 'Permettre l\'envoi des emails.', '12', '5', NULL, '2006-08-19 16:06:00', NULL, 'tep_cfg_select_option(array(\'Oui\', \'Non\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('116', 'Permet le téléchargement', 'DOWNLOAD_ENABLED', 'Non', 'Valider la fonction de téléchargement des produits.', '13', '1', NULL, '2006-08-19 16:06:00', NULL, 'tep_cfg_select_option(array(\'Oui\', \'Non\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('117', 'Téléchargement par redirection', 'DOWNLOAD_BY_REDIRECT', 'Non', 'Utiliser la redirection pour télécharger. Désactiver sur des systèmes non UNIX.', '13', '2', NULL, '2006-08-19 16:06:00', NULL, 'tep_cfg_select_option(array(\'Oui\', \'Non\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('120', 'Permettre compression GZip', 'GZIP_COMPRESSION', 'Non', 'Permettre la compression HTTP GZip.', '14', '1', NULL, '2006-08-19 16:06:00', NULL, 'tep_cfg_select_option(array(\'Oui\', \'Non\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('121', 'Niveau de Compression', 'GZIP_LEVEL', '5', 'Employer ce niveau de compression de 0 à 9.<br>(0 = minimum, 9 = maximum)', '14', '2', NULL, '2006-08-19 16:06:00', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('122', 'Répertoire des sessions', 'SESSION_WRITE_DIRECTORY', '/tmp', 'Le chemin où les sessions seront stockées.', '15', '1', NULL, '2006-08-19 16:06:00', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('123', 'Utilisation de force des cookies', 'SESSION_FORCE_COOKIE_USE', 'Non', 'Forcez l\'utilisation des sessions quand les Cookies sont permis.', '15', '2', NULL, '2006-08-19 16:06:00', NULL, 'tep_cfg_select_option(array(\'Oui\', \'Non\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('124', 'Vérifiez l\'identification de session', 'SESSION_CHECK_SSL_SESSION_ID', 'Non', 'Valider la SSL_SESSION_ID sur chaque demande de page sécurisée en HTTPS.', '15', '3', NULL, '2006-08-19 16:06:00', NULL, 'tep_cfg_select_option(array(\'Oui\', \'Non\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('125', 'Vérifiez l\'utilisateur', 'SESSION_CHECK_USER_AGENT', 'Non', 'Validez le navigateur du client sur chaque demande de page.', '15', '4', NULL, '2006-08-19 16:06:00', NULL, 'tep_cfg_select_option(array(\'Oui\', \'Non\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('126', 'Vérifiez l\'adresse IP', 'SESSION_CHECK_IP_ADDRESS', 'Non', 'Validez l\'adresse IP du client sur chaque demande de page.', '15', '5', NULL, '2006-08-19 16:06:00', NULL, 'tep_cfg_select_option(array(\'Oui\', \'Non\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('127', 'Empêchez les sessions d\'araignée', 'SESSION_BLOCK_SPIDERS', 'Non', 'Empêchez les araignées connues de commencer une session.', '15', '6', NULL, '2006-08-19 16:06:00', NULL, 'tep_cfg_select_option(array(\'Oui\', \'Non\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('128', 'Recréez une session', 'SESSION_RECREATE', 'Non', 'Recréez la session pour produire une nouvelle identification de session quand le client entre ou crée un compte (PHP > = 4.1 nécessaire).', '15', '7', NULL, '2006-08-19 16:06:00', NULL, 'tep_cfg_select_option(array(\'Oui\', \'Non\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('129', 'Quantité Maximale de produits dans le panier', 'MAX_QTY_IN_CART', '99', 'Quantité Maximale de produits pouvant être ajoutés au panier (0 pour infini)', '3', '19', NULL, '2008-04-12 16:21:34', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('130', 'Activer ce module de paiement', 'MODULE_PAYMENT_COD_STATUS', 'Oui', 'Souhaitez-vous accepter le paiement à la livraison?', '6', '1', NULL, '2008-04-16 23:22:18', NULL, 'tep_cfg_select_option(array(\'Oui\', \'Non\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('131', 'Zone de paiement', 'MODULE_PAYMENT_COD_ZONE', '0', 'Si une zone est sélectionnée, seule cette zone proposera ce type de paiement.', '6', '2', NULL, '2008-04-16 23:22:18', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('132', 'Ordre d\'affichage.', 'MODULE_PAYMENT_COD_SORT_ORDER', '0', 'Ordre de tri dans l\'affichage. Le plus petit en premier.', '6', '0', NULL, '2008-04-16 23:22:18', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('133', 'Statut de la commande', 'MODULE_PAYMENT_COD_ORDER_STATUS_ID', '0', 'Définissez le statut qui sera assigné aux commandes payées avec ce mode de paiement.', '6', '0', NULL, '2008-04-16 23:22:18', 'tep_get_order_status_name', 'tep_cfg_pull_down_order_statuses(');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('134', 'Activer ce module de paiement', 'MODULE_PAYMENT_MONEYORDER_STATUS', 'Oui', 'Voulez-vous accepter les paiement par chèque?', '6', '1', NULL, '2008-04-16 23:22:24', NULL, 'tep_cfg_select_option(array(\'Oui\', \'Non\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('135', 'Payer à l\'ordre de:', 'MODULE_PAYMENT_MONEYORDER_PAYTO', '', 'A quel ordre doivent être établis les chèques ?', '6', '1', NULL, '2008-04-16 23:22:24', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('136', 'Ordre d\'affichage.', 'MODULE_PAYMENT_MONEYORDER_SORT_ORDER', '0', 'Ordre de tri dans l\'affichage. Le plus petit en premier.', '6', '0', NULL, '2008-04-16 23:22:24', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('137', 'Zone de paiement', 'MODULE_PAYMENT_MONEYORDER_ZONE', '0', 'Si une zone est sélectionnée, seule cette zone proposera ce type de paiement.', '6', '2', NULL, '2008-04-16 23:22:24', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('138', 'Statut de la commande', 'MODULE_PAYMENT_MONEYORDER_ORDER_STATUS_ID', '0', 'Définissez le statut qui sera assigné aux commandes payées avec ce mode de paiement.', '6', '0', NULL, '2008-04-16 23:22:24', 'tep_get_order_status_name', 'tep_cfg_pull_down_order_statuses(');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('139', 'Utiliser ce mode de livraison', 'MODULE_SHIPPING_FLAT_STATUS', 'Oui', 'Voulez-vous proposer ce mode de livraison ?', '6', '0', NULL, '2008-04-16 23:22:39', NULL, 'tep_cfg_select_option(array(\'Oui\', \'Non\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('140', 'Coût de la livraison', 'MODULE_SHIPPING_FLAT_COST', '5.00', 'Le montant forfaitaire de livraison pour toute commande utilisant cette méthode.', '6', '0', NULL, '2008-04-16 23:22:39', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('141', 'TVA applicable', 'MODULE_SHIPPING_FLAT_TAX_CLASS', '0', 'Sélectionnez la TVA applicable sur le montant de la livraison.', '6', '0', NULL, '2008-04-16 23:22:39', 'tep_get_tax_class_title', 'tep_cfg_pull_down_tax_classes(');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('142', 'Zone de livraison', 'MODULE_SHIPPING_FLAT_ZONE', '0', 'Si une zone est sélectionnée, elle sera la seule à proposer ce mode de livraison.', '6', '0', NULL, '2008-04-16 23:22:39', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('143', 'Ordre d\'affichage', 'MODULE_SHIPPING_FLAT_SORT_ORDER', '0', 'Ordre de tri de l\'affichage dans la liste des modules.', '6', '0', NULL, '2008-04-16 23:22:39', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('144', 'Utiliser ce mode de livraison', 'MODULE_SHIPPING_ITEM_STATUS', 'Oui', 'Voulez-vous proposer ce mode de livraison?', '6', '0', NULL, '2008-04-16 23:22:45', NULL, 'tep_cfg_select_option(array(\'Oui\', \'Non\'),');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('145', 'Coût du port par article', 'MODULE_SHIPPING_ITEM_COST', '2.50', 'le montant défini ici sera multiplié par le nombre d\'articles dans la commande.', '6', '0', NULL, '2008-04-16 23:22:45', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('146', 'Frais fixes', 'MODULE_SHIPPING_ITEM_HANDLING', '0', 'Frais fixes ou de manutention pour cette méthode.', '6', '0', NULL, '2008-04-16 23:22:45', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('147', 'TVA applicable', 'MODULE_SHIPPING_ITEM_TAX_CLASS', '0', 'Sélectionnez le type de TVA applicable sur le montant du port.', '6', '0', NULL, '2008-04-16 23:22:45', 'tep_get_tax_class_title', 'tep_cfg_pull_down_tax_classes(');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('148', 'Zone de livraison', 'MODULE_SHIPPING_ITEM_ZONE', '0', 'Si une zone est sélectionnée, elle sera la seule à proposer ce mode de livraison.', '6', '0', NULL, '2008-04-16 23:22:45', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(');
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('149', 'Ordre d\'affichage', 'MODULE_SHIPPING_ITEM_SORT_ORDER', '0', 'Ordre d\'affichage dans la liste des modules.', '6', '0', NULL, '2008-04-16 23:22:45', NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('150', 'Délai expiration (jours)', 'DOWNLOAD_MAX_DAYS', '7', 'Nombre de jours avant expiration du lien. 0 pour sans limite.', 13, 3, NULL, NOW(), NULL, NULL);
insert into configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) values ('151', 'Nombre maxi de téléchargements', 'DOWNLOAD_MAX_COUNT', '5', 'Nombre maxi de téléchargements. 0 pas de téléchargement autorisé.', 13, 4, NULL, NOW(), NULL, NULL);

insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('1', 'Ma boutique', 'Informations générales sur la boutique.', '1', '1');
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('2', 'Valeurs Minimum', 'Valeur minimum pour : fonctions / données', '2', '1');
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('3', 'Valeurs Maximum', 'Valeur maximum pour : fonctions / données', '3', '1');
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('4', 'Images', 'Configuration des images', '4', '1');
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('5', 'Détails clients', 'Configuration du compte client.', '5', '1');
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('6', 'Option des Modules', 'Caché de la configuration.', '6', '0');
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('7', 'Expédition/Emballage', 'Options de livraison possibles dans cette boutique.', '7', '1');
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('8', 'Liste des produits', 'Options de configuration des listes de produits.', '8', '1');
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('9', 'Stock', 'Options de configuration du stock.', '9', '1');
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('10', 'Logging', 'Options de configuration du Logging.', '10', '1');
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('11', 'Cache', 'Options de configuration du cache.', '11', '1');
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('12', 'Options de mail', 'Configuration générale pour le \'client mail\' et les emails au format HTML.', '12', '1');
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('13', 'Téléchargements', 'Options des produits téléchargeable.', '13', '1');
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('14', 'Compression GZip', 'Options de compression GZip.', '14', '1');
insert into configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) values ('15', 'Session', 'Session options', '15', '1');

insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('1', 'Afghanistan', 'AF', 'AFG', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('2', 'Albania', 'AL', 'ALB', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('3', 'Algeria', 'DZ', 'DZA', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('4', 'American Samoa', 'AS', 'ASM', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('5', 'Andorra', 'AD', 'AND', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('6', 'Angola', 'AO', 'AGO', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('7', 'Anguilla', 'AI', 'AIA', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('8', 'Antarctica', 'AQ', 'ATA', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('9', 'Antigua and Barbuda', 'AG', 'ATG', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('10', 'Argentina', 'AR', 'ARG', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('11', 'Armenia', 'AM', 'ARM', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('12', 'Aruba', 'AW', 'ABW', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('13', 'Australia', 'AU', 'AUS', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('14', 'Austria', 'AT', 'AUT', '5');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('15', 'Azerbaijan', 'AZ', 'AZE', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('16', 'Bahamas', 'BS', 'BHS', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('17', 'Bahrain', 'BH', 'BHR', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('18', 'Bangladesh', 'BD', 'BGD', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('19', 'Barbados', 'BB', 'BRB', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('20', 'Belarus', 'BY', 'BLR', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('21', 'Belgium', 'BE', 'BEL', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('22', 'Belize', 'BZ', 'BLZ', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('23', 'Benin', 'BJ', 'BEN', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('24', 'Bermuda', 'BM', 'BMU', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('25', 'Bhutan', 'BT', 'BTN', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('26', 'Bolivia', 'BO', 'BOL', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('27', 'Bosnia and Herzegowina', 'BA', 'BIH', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('28', 'Botswana', 'BW', 'BWA', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('29', 'Bouvet Island', 'BV', 'BVT', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('30', 'Brazil', 'BR', 'BRA', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('31', 'British Indian Ocean Territory', 'IO', 'IOT', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('32', 'Brunei Darussalam', 'BN', 'BRN', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('33', 'Bulgaria', 'BG', 'BGR', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('34', 'Burkina Faso', 'BF', 'BFA', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('35', 'Burundi', 'BI', 'BDI', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('36', 'Cambodia', 'KH', 'KHM', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('37', 'Cameroon', 'CM', 'CMR', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('38', 'Canada', 'CA', 'CAN', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('39', 'Cape Verde', 'CV', 'CPV', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('40', 'Cayman Islands', 'KY', 'CYM', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('41', 'Central African Republic', 'CF', 'CAF', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('42', 'Chad', 'TD', 'TCD', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('43', 'Chile', 'CL', 'CHL', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('44', 'China', 'CN', 'CHN', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('45', 'Christmas Island', 'CX', 'CXR', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('46', 'Cocos (Keeling) Islands', 'CC', 'CCK', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('47', 'Colombia', 'CO', 'COL', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('48', 'Comoros', 'KM', 'COM', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('49', 'Congo', 'CG', 'COG', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('50', 'Cook Islands', 'CK', 'COK', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('51', 'Costa Rica', 'CR', 'CRI', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('52', 'Cote D\'Ivoire', 'CI', 'CIV', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('53', 'Croatia', 'HR', 'HRV', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('54', 'Cuba', 'CU', 'CUB', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('55', 'Cyprus', 'CY', 'CYP', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('56', 'Czech Republic', 'CZ', 'CZE', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('57', 'Denmark', 'DK', 'DNK', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('58', 'Djibouti', 'DJ', 'DJI', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('59', 'Dominica', 'DM', 'DMA', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('60', 'Dominican Republic', 'DO', 'DOM', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('61', 'East Timor', 'TP', 'TMP', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('62', 'Ecuador', 'EC', 'ECU', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('63', 'Egypt', 'EG', 'EGY', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('64', 'El Salvador', 'SV', 'SLV', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('65', 'Equatorial Guinea', 'GQ', 'GNQ', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('66', 'Eritrea', 'ER', 'ERI', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('67', 'Estonia', 'EE', 'EST', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('68', 'Ethiopia', 'ET', 'ETH', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('69', 'Falkland Islands (Malvinas)', 'FK', 'FLK', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('70', 'Faroe Islands', 'FO', 'FRO', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('71', 'Fiji', 'FJ', 'FJI', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('72', 'Finland', 'FI', 'FIN', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('73', 'France', 'FR', 'FRA', '5');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('74', 'France, Metropolitan', 'FX', 'FXX', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('75', 'French Guiana', 'GF', 'GUF', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('76', 'French Polynesia', 'PF', 'PYF', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('77', 'French Southern Territories', 'TF', 'ATF', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('78', 'Gabon', 'GA', 'GAB', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('79', 'Gambia', 'GM', 'GMB', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('80', 'Georgia', 'GE', 'GEO', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('81', 'Germany', 'DE', 'DEU', '5');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('82', 'Ghana', 'GH', 'GHA', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('83', 'Gibraltar', 'GI', 'GIB', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('84', 'Greece', 'GR', 'GRC', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('85', 'Greenland', 'GL', 'GRL', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('86', 'Grenada', 'GD', 'GRD', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('87', 'Guadeloupe', 'GP', 'GLP', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('88', 'Guam', 'GU', 'GUM', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('89', 'Guatemala', 'GT', 'GTM', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('90', 'Guinea', 'GN', 'GIN', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('91', 'Guinea-bissau', 'GW', 'GNB', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('92', 'Guyana', 'GY', 'GUY', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('93', 'Haiti', 'HT', 'HTI', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('94', 'Heard and Mc Donald Islands', 'HM', 'HMD', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('95', 'Honduras', 'HN', 'HND', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('96', 'Hong Kong', 'HK', 'HKG', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('97', 'Hungary', 'HU', 'HUN', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('98', 'Iceland', 'IS', 'ISL', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('99', 'India', 'IN', 'IND', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('100', 'Indonesia', 'ID', 'IDN', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('101', 'Iran (Islamic Republic of)', 'IR', 'IRN', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('102', 'Iraq', 'IQ', 'IRQ', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('103', 'Ireland', 'IE', 'IRL', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('104', 'Israel', 'IL', 'ISR', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('105', 'Italy', 'IT', 'ITA', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('106', 'Jamaica', 'JM', 'JAM', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('107', 'Japan', 'JP', 'JPN', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('108', 'Jordan', 'JO', 'JOR', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('109', 'Kazakhstan', 'KZ', 'KAZ', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('110', 'Kenya', 'KE', 'KEN', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('111', 'Kiribati', 'KI', 'KIR', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('112', 'Korea, Democratic People\'s Republic of', 'KP', 'PRK', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('113', 'Korea, Republic of', 'KR', 'KOR', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('114', 'Kuwait', 'KW', 'KWT', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('115', 'Kyrgyzstan', 'KG', 'KGZ', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('116', 'Lao People\'s Democratic Republic', 'LA', 'LAO', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('117', 'Latvia', 'LV', 'LVA', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('118', 'Lebanon', 'LB', 'LBN', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('119', 'Lesotho', 'LS', 'LSO', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('120', 'Liberia', 'LR', 'LBR', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('121', 'Libyan Arab Jamahiriya', 'LY', 'LBY', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('122', 'Liechtenstein', 'LI', 'LIE', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('123', 'Lithuania', 'LT', 'LTU', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('124', 'Luxembourg', 'LU', 'LUX', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('125', 'Macau', 'MO', 'MAC', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('126', 'Macedonia, The Former Yugoslav Republic of', 'MK', 'MKD', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('127', 'Madagascar', 'MG', 'MDG', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('128', 'Malawi', 'MW', 'MWI', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('129', 'Malaysia', 'MY', 'MYS', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('130', 'Maldives', 'MV', 'MDV', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('131', 'Mali', 'ML', 'MLI', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('132', 'Malta', 'MT', 'MLT', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('133', 'Marshall Islands', 'MH', 'MHL', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('134', 'Martinique', 'MQ', 'MTQ', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('135', 'Mauritania', 'MR', 'MRT', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('136', 'Mauritius', 'MU', 'MUS', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('137', 'Mayotte', 'YT', 'MYT', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('138', 'Mexico', 'MX', 'MEX', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('139', 'Micronesia, Federated States of', 'FM', 'FSM', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('140', 'Moldova, Republic of', 'MD', 'MDA', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('141', 'Monaco', 'MC', 'MCO', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('142', 'Mongolia', 'MN', 'MNG', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('143', 'Montserrat', 'MS', 'MSR', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('144', 'Morocco', 'MA', 'MAR', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('145', 'Mozambique', 'MZ', 'MOZ', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('146', 'Myanmar', 'MM', 'MMR', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('147', 'Namibia', 'NA', 'NAM', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('148', 'Nauru', 'NR', 'NRU', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('149', 'Nepal', 'NP', 'NPL', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('150', 'Netherlands', 'NL', 'NLD', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('151', 'Netherlands Antilles', 'AN', 'ANT', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('152', 'New Caledonia', 'NC', 'NCL', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('153', 'New Zealand', 'NZ', 'NZL', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('154', 'Nicaragua', 'NI', 'NIC', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('155', 'Niger', 'NE', 'NER', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('156', 'Nigeria', 'NG', 'NGA', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('157', 'Niue', 'NU', 'NIU', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('158', 'Norfolk Island', 'NF', 'NFK', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('159', 'Northern Mariana Islands', 'MP', 'MNP', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('160', 'Norway', 'NO', 'NOR', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('161', 'Oman', 'OM', 'OMN', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('162', 'Pakistan', 'PK', 'PAK', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('163', 'Palau', 'PW', 'PLW', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('164', 'Panama', 'PA', 'PAN', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('165', 'Papua New Guinea', 'PG', 'PNG', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('166', 'Paraguay', 'PY', 'PRY', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('167', 'Peru', 'PE', 'PER', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('168', 'Philippines', 'PH', 'PHL', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('169', 'Pitcairn', 'PN', 'PCN', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('170', 'Poland', 'PL', 'POL', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('171', 'Portugal', 'PT', 'PRT', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('172', 'Puerto Rico', 'PR', 'PRI', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('173', 'Qatar', 'QA', 'QAT', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('174', 'Reunion', 'RE', 'REU', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('175', 'Romania', 'RO', 'ROM', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('176', 'Russian Federation', 'RU', 'RUS', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('177', 'Rwanda', 'RW', 'RWA', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('178', 'Saint Kitts and Nevis', 'KN', 'KNA', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('179', 'Saint Lucia', 'LC', 'LCA', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('180', 'Saint Vincent and the Grenadines', 'VC', 'VCT', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('181', 'Samoa', 'WS', 'WSM', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('182', 'San Marino', 'SM', 'SMR', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('183', 'Sao Tome and Principe', 'ST', 'STP', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('184', 'Saudi Arabia', 'SA', 'SAU', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('185', 'Senegal', 'SN', 'SEN', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('186', 'Seychelles', 'SC', 'SYC', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('187', 'Sierra Leone', 'SL', 'SLE', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('188', 'Singapore', 'SG', 'SGP', '4');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('189', 'Slovakia (Slovak Republic)', 'SK', 'SVK', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('190', 'Slovenia', 'SI', 'SVN', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('191', 'Solomon Islands', 'SB', 'SLB', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('192', 'Somalia', 'SO', 'SOM', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('193', 'South Africa', 'ZA', 'ZAF', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('194', 'South Georgia and the South Sandwich Islands', 'GS', 'SGS', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('195', 'Spain', 'ES', 'ESP', '3');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('196', 'Sri Lanka', 'LK', 'LKA', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('197', 'St. Helena', 'SH', 'SHN', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('198', 'St. Pierre and Miquelon', 'PM', 'SPM', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('199', 'Sudan', 'SD', 'SDN', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('200', 'Suriname', 'SR', 'SUR', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('201', 'Svalbard and Jan Mayen Islands', 'SJ', 'SJM', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('202', 'Swaziland', 'SZ', 'SWZ', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('203', 'Sweden', 'SE', 'SWE', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('204', 'Switzerland', 'CH', 'CHE', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('205', 'Syrian Arab Republic', 'SY', 'SYR', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('206', 'Taiwan', 'TW', 'TWN', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('207', 'Tajikistan', 'TJ', 'TJK', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('208', 'Tanzania, United Republic of', 'TZ', 'TZA', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('209', 'Thailand', 'TH', 'THA', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('210', 'Togo', 'TG', 'TGO', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('211', 'Tokelau', 'TK', 'TKL', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('212', 'Tonga', 'TO', 'TON', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('213', 'Trinidad and Tobago', 'TT', 'TTO', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('214', 'Tunisia', 'TN', 'TUN', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('215', 'Turkey', 'TR', 'TUR', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('216', 'Turkmenistan', 'TM', 'TKM', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('217', 'Turks and Caicos Islands', 'TC', 'TCA', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('218', 'Tuvalu', 'TV', 'TUV', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('219', 'Uganda', 'UG', 'UGA', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('220', 'Ukraine', 'UA', 'UKR', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('221', 'United Arab Emirates', 'AE', 'ARE', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('222', 'United Kingdom', 'GB', 'GBR', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('223', 'United States', 'US', 'USA', '2');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('224', 'United States Minor Outlying Islands', 'UM', 'UMI', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('225', 'Uruguay', 'UY', 'URY', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('226', 'Uzbekistan', 'UZ', 'UZB', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('227', 'Vanuatu', 'VU', 'VUT', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('228', 'Vatican City State (Holy See)', 'VA', 'VAT', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('229', 'Venezuela', 'VE', 'VEN', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('230', 'Viet Nam', 'VN', 'VNM', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('231', 'Virgin Islands (British)', 'VG', 'VGB', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('232', 'Virgin Islands (U.S.)', 'VI', 'VIR', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('233', 'Wallis and Futuna Islands', 'WF', 'WLF', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('234', 'Western Sahara', 'EH', 'ESH', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('235', 'Yemen', 'YE', 'YEM', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('236', 'Yugoslavia', 'YU', 'YUG', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('237', 'Zaire', 'ZR', 'ZAR', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('238', 'Zambia', 'ZM', 'ZMB', '1');
insert into countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('239', 'Zimbabwe', 'ZW', 'ZWE', '1');

insert into currencies (currencies_id, title, code, symbol_left, symbol_right, decimal_point, thousands_point, decimal_places, value, last_updated) values ('1', 'US Dollar', 'USD', '$', '', '.', ',', '2', '1.00000000', '2006-08-19 16:06:08');
insert into currencies (currencies_id, title, code, symbol_left, symbol_right, decimal_point, thousands_point, decimal_places, value, last_updated) values ('2', 'Euro', 'EUR', '', 'EUR', '.', ',', '2', '1.00000000', '2006-08-19 16:06:08');

insert into customers (customers_id, customers_gender, customers_firstname, customers_lastname, customers_dob, customers_email_address, customers_default_address_id, customers_telephone, customers_fax, customers_password, customers_newsletter) values ('1', 'm', 'John', 'doe', '2001-01-01 00:00:00', 'root@localhost', '1', '12345', '', 'd95e8fa7f20a009372eb3477473fcd34:1c', '0');
insert into customers_info (customers_info_id, customers_info_date_of_last_logon, customers_info_number_of_logons, customers_info_date_account_created, customers_info_date_account_last_modified, global_product_notifications) values ('1', NULL, '0', '2006-08-19 16:06:08', NULL, '0');

insert into languages (languages_id, name, code, image, directory, sort_order) values ('1', 'English', 'en', 'icon.gif', 'english', '1');
insert into languages (languages_id, name, code, image, directory, sort_order) values ('2', 'Deutsch', 'de', 'icon.gif', 'german', '2');
insert into languages (languages_id, name, code, image, directory, sort_order) values ('3', 'Español', 'es', 'icon.gif', 'espanol', '3');
insert into languages (languages_id, name, code, image, directory, sort_order) values ('4', 'French', 'fr', 'icon.gif', 'french', '0');

insert into manufacturers (manufacturers_id, manufacturers_name, manufacturers_image, date_added, last_modified) values ('1', 'Matrox', 'manufacturer_matrox.gif', '2006-08-19 16:06:09', NULL);
insert into manufacturers (manufacturers_id, manufacturers_name, manufacturers_image, date_added, last_modified) values ('2', 'Microsoft', 'manufacturer_microsoft.gif', '2006-08-19 16:06:09', NULL);
insert into manufacturers (manufacturers_id, manufacturers_name, manufacturers_image, date_added, last_modified) values ('3', 'Warner', 'manufacturer_warner.gif', '2006-08-19 16:06:09', NULL);
insert into manufacturers (manufacturers_id, manufacturers_name, manufacturers_image, date_added, last_modified) values ('4', 'Fox', 'manufacturer_fox.gif', '2006-08-19 16:06:09', NULL);
insert into manufacturers (manufacturers_id, manufacturers_name, manufacturers_image, date_added, last_modified) values ('5', 'Logitech', 'manufacturer_logitech.gif', '2006-08-19 16:06:09', NULL);
insert into manufacturers (manufacturers_id, manufacturers_name, manufacturers_image, date_added, last_modified) values ('6', 'Canon', 'manufacturer_canon.gif', '2006-08-19 16:06:09', NULL);
insert into manufacturers (manufacturers_id, manufacturers_name, manufacturers_image, date_added, last_modified) values ('7', 'Sierra', 'manufacturer_sierra.gif', '2006-08-19 16:06:09', NULL);
insert into manufacturers (manufacturers_id, manufacturers_name, manufacturers_image, date_added, last_modified) values ('8', 'GT Interactive', 'manufacturer_gt_interactive.gif', '2006-08-19 16:06:09', NULL);
insert into manufacturers (manufacturers_id, manufacturers_name, manufacturers_image, date_added, last_modified) values ('9', 'Hewlett Packard', 'manufacturer_hewlett_packard.gif', '2006-08-19 16:06:09', NULL);

insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_url, url_clicked, date_last_click) values ('1', '1', 'http://www.matrox.com', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_url, url_clicked, date_last_click) values ('1', '2', 'http://www.matrox.de', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_url, url_clicked, date_last_click) values ('1', '3', 'http://www.matrox.com', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_url, url_clicked, date_last_click) values ('1', '4', 'http://www.matrox.com', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_url, url_clicked, date_last_click) values ('2', '1', 'http://www.microsoft.com', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_url, url_clicked, date_last_click) values ('2', '2', 'http://www.microsoft.de', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_url, url_clicked, date_last_click) values ('2', '3', 'http://www.microsoft.es', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_url, url_clicked, date_last_click) values ('2', '4', 'http://www.microsoft.com', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_url, url_clicked, date_last_click) values ('3', '1', 'http://www.warner.com', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_url, url_clicked, date_last_click) values ('3', '2', 'http://www.warner.de', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_url, url_clicked, date_last_click) values ('3', '3', 'http://www.warner.com', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_url, url_clicked, date_last_click) values ('3', '4', 'http://www.warner.com', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_url, url_clicked, date_last_click) values ('4', '1', 'http://www.fox.com', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_url, url_clicked, date_last_click) values ('4', '2', 'http://www.fox.de', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_url, url_clicked, date_last_click) values ('4', '3', 'http://www.fox.com', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_url, url_clicked, date_last_click) values ('4', '4', 'http://www.fox.com', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_url, url_clicked, date_last_click) values ('5', '1', 'http://www.logitech.com', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_url, url_clicked, date_last_click) values ('5', '2', 'http://www.logitech.com', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_url, url_clicked, date_last_click) values ('5', '3', 'http://www.logitech.com', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_url, url_clicked, date_last_click) values ('5', '4', 'http://www.logitech.com', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_url, url_clicked, date_last_click) values ('6', '1', 'http://www.canon.com', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_url, url_clicked, date_last_click) values ('6', '2', 'http://www.canon.de', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_url, url_clicked, date_last_click) values ('6', '3', 'http://www.canon.es', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_url, url_clicked, date_last_click) values ('6', '4', 'http://www.canon.com', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_url, url_clicked, date_last_click) values ('7', '1', 'http://www.sierra.com', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_url, url_clicked, date_last_click) values ('7', '2', 'http://www.sierra.de', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_url, url_clicked, date_last_click) values ('7', '3', 'http://www.sierra.com', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_url, url_clicked, date_last_click) values ('7', '4', 'http://www.sierra.com', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_url, url_clicked, date_last_click) values ('8', '1', 'http://www.infogrames.com', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_url, url_clicked, date_last_click) values ('8', '2', 'http://www.infogrames.de', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_url, url_clicked, date_last_click) values ('8', '3', 'http://www.infogrames.com', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_url, url_clicked, date_last_click) values ('8', '4', 'http://www.infogrames.com', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_url, url_clicked, date_last_click) values ('9', '1', 'http://www.hewlettpackard.com', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_url, url_clicked, date_last_click) values ('9', '2', 'http://www.hewlettpackard.de', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_url, url_clicked, date_last_click) values ('9', '3', 'http://welcome.hp.com/country/es/spa/welcome.htm', '0', NULL);
insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_url, url_clicked, date_last_click) values ('9', '4', 'http://www.hewlettpackard.com', '0', NULL);

insert into orders_status (orders_status_id, language_id, orders_status_name) values ('3', '1', 'Delivered');
insert into orders_status (orders_status_id, language_id, orders_status_name) values ('1', '4', 'En Attente');
insert into orders_status (orders_status_id, language_id, orders_status_name) values ('3', '3', 'Entregado');
insert into orders_status (orders_status_id, language_id, orders_status_name) values ('2', '2', 'In Bearbeitung');
insert into orders_status (orders_status_id, language_id, orders_status_name) values ('3', '4', 'Livrée');
insert into orders_status (orders_status_id, language_id, orders_status_name) values ('1', '2', 'Offen');
insert into orders_status (orders_status_id, language_id, orders_status_name) values ('1', '3', 'Pendiente');
insert into orders_status (orders_status_id, language_id, orders_status_name) values ('1', '1', 'Pending');
insert into orders_status (orders_status_id, language_id, orders_status_name) values ('2', '3', 'Proceso');
insert into orders_status (orders_status_id, language_id, orders_status_name) values ('2', '1', 'Processing');
insert into orders_status (orders_status_id, language_id, orders_status_name) values ('2', '4', 'Traitement en cours');
insert into orders_status (orders_status_id, language_id, orders_status_name) values ('3', '2', 'Versendet');

insert into products (products_id, products_quantity, products_model, products_image, products_price, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered) values ('1', '32', 'MG200MMS', 'matrox/mg200mms.gif', '299.9900', '2006-08-19 16:06:10', NULL, NULL, '23.00', '1', '1', '1', '0');
insert into products (products_id, products_quantity, products_model, products_image, products_price, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered) values ('2', '32', 'MG400-32MB', 'matrox/mg400-32mb.gif', '499.9900', '2006-08-19 16:06:10', NULL, NULL, '23.00', '1', '1', '1', '0');
insert into products (products_id, products_quantity, products_model, products_image, products_price, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered) values ('3', '2', 'MSIMPRO', 'microsoft/msimpro.gif', '49.9900', '2006-08-19 16:06:10', NULL, NULL, '7.00', '1', '1', '3', '0');
insert into products (products_id, products_quantity, products_model, products_image, products_price, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered) values ('4', '13', 'DVD-RPMK', 'dvd/replacement_killers.gif', '42.0000', '2006-08-19 16:06:10', NULL, NULL, '23.00', '1', '1', '2', '0');
insert into products (products_id, products_quantity, products_model, products_image, products_price, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered) values ('5', '17', 'DVD-BLDRNDC', 'dvd/blade_runner.gif', '35.9900', '2006-08-19 16:06:10', NULL, NULL, '7.00', '1', '1', '3', '0');
insert into products (products_id, products_quantity, products_model, products_image, products_price, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered) values ('6', '10', 'DVD-MATR', 'dvd/the_matrix.gif', '39.9900', '2006-08-19 16:06:10', NULL, NULL, '7.00', '1', '1', '3', '0');
insert into products (products_id, products_quantity, products_model, products_image, products_price, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered) values ('7', '10', 'DVD-YGEM', 'dvd/youve_got_mail.gif', '34.9900', '2006-08-19 16:06:10', NULL, NULL, '7.00', '1', '1', '3', '0');
insert into products (products_id, products_quantity, products_model, products_image, products_price, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered) values ('8', '10', 'DVD-ABUG', 'dvd/a_bugs_life.gif', '35.9900', '2006-08-19 16:06:10', NULL, NULL, '7.00', '1', '1', '3', '0');
insert into products (products_id, products_quantity, products_model, products_image, products_price, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered) values ('9', '10', 'DVD-UNSG', 'dvd/under_siege.gif', '29.9900', '2006-08-19 16:06:10', NULL, NULL, '7.00', '1', '1', '3', '0');
insert into products (products_id, products_quantity, products_model, products_image, products_price, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered) values ('10', '10', 'DVD-UNSG2', 'dvd/under_siege2.gif', '29.9900', '2006-08-19 16:06:10', NULL, NULL, '7.00', '1', '1', '3', '0');
insert into products (products_id, products_quantity, products_model, products_image, products_price, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered) values ('11', '10', 'DVD-FDBL', 'dvd/fire_down_below.gif', '29.9900', '2006-08-19 16:06:10', NULL, NULL, '7.00', '1', '1', '3', '0');
insert into products (products_id, products_quantity, products_model, products_image, products_price, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered) values ('12', '10', 'DVD-DHWV', 'dvd/die_hard_3.gif', '39.9900', '2006-08-19 16:06:10', NULL, NULL, '7.00', '1', '1', '4', '0');
insert into products (products_id, products_quantity, products_model, products_image, products_price, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered) values ('13', '10', 'DVD-LTWP', 'dvd/lethal_weapon.gif', '34.9900', '2006-08-19 16:06:10', NULL, NULL, '7.00', '1', '1', '3', '0');
insert into products (products_id, products_quantity, products_model, products_image, products_price, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered) values ('14', '10', 'DVD-REDC', 'dvd/red_corner.gif', '32.0000', '2006-08-19 16:06:10', NULL, NULL, '7.00', '1', '1', '3', '0');
insert into products (products_id, products_quantity, products_model, products_image, products_price, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered) values ('15', '10', 'DVD-FRAN', 'dvd/frantic.gif', '35.0000', '2006-08-19 16:06:10', NULL, NULL, '7.00', '1', '1', '3', '0');
insert into products (products_id, products_quantity, products_model, products_image, products_price, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered) values ('16', '10', 'DVD-CUFI', 'dvd/courage_under_fire.gif', '38.9900', '2006-08-19 16:06:10', NULL, NULL, '7.00', '1', '1', '4', '0');
insert into products (products_id, products_quantity, products_model, products_image, products_price, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered) values ('17', '10', 'DVD-SPEED', 'dvd/speed.gif', '39.9900', '2006-08-19 16:06:10', NULL, NULL, '7.00', '1', '1', '4', '0');
insert into products (products_id, products_quantity, products_model, products_image, products_price, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered) values ('18', '10', 'DVD-SPEED2', 'dvd/speed_2.gif', '42.0000', '2006-08-19 16:06:10', NULL, NULL, '7.00', '1', '1', '4', '0');
insert into products (products_id, products_quantity, products_model, products_image, products_price, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered) values ('19', '10', 'DVD-TSAB', 'dvd/theres_something_about_mary.gif', '49.9900', '2006-08-19 16:06:11', NULL, NULL, '7.00', '1', '1', '4', '0');
insert into products (products_id, products_quantity, products_model, products_image, products_price, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered) values ('20', '10', 'DVD-BELOVED', 'dvd/beloved.gif', '54.9900', '2006-08-19 16:06:11', NULL, NULL, '7.00', '1', '1', '3', '0');
insert into products (products_id, products_quantity, products_model, products_image, products_price, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered) values ('21', '16', 'PC-SWAT3', 'sierra/swat_3.gif', '79.9900', '2006-08-19 16:06:11', NULL, NULL, '7.00', '1', '1', '7', '0');
insert into products (products_id, products_quantity, products_model, products_image, products_price, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered) values ('22', '13', 'PC-UNTM', 'gt_interactive/unreal_tournament.gif', '89.9900', '2006-08-19 16:06:11', NULL, NULL, '7.00', '1', '1', '8', '0');
insert into products (products_id, products_quantity, products_model, products_image, products_price, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered) values ('23', '16', 'PC-TWOF', 'gt_interactive/wheel_of_time.gif', '99.9900', '2006-08-19 16:06:11', NULL, NULL, '10.00', '1', '1', '8', '0');
insert into products (products_id, products_quantity, products_model, products_image, products_price, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered) values ('24', '17', 'PC-DISC', 'gt_interactive/disciples.gif', '90.0000', '2006-08-19 16:06:11', NULL, NULL, '8.00', '1', '1', '8', '0');
insert into products (products_id, products_quantity, products_model, products_image, products_price, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered) values ('25', '16', 'MSINTKB', 'microsoft/intkeyboardps2.gif', '69.9900', '2006-08-19 16:06:11', NULL, NULL, '8.00', '1', '1', '2', '0');
insert into products (products_id, products_quantity, products_model, products_image, products_price, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered) values ('26', '10', 'MSIMEXP', 'microsoft/imexplorer.gif', '64.9500', '2006-08-19 16:06:11', NULL, NULL, '8.00', '1', '1', '2', '0');
insert into products (products_id, products_quantity, products_model, products_image, products_price, products_date_added, products_last_modified, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, products_ordered) values ('27', '8', 'HPLJ1100XI', 'hewlett_packard/lj1100xi.gif', '499.9900', '2006-08-19 16:06:11', NULL, NULL, '45.00', '1', '1', '9', '0');

insert into products_attributes (products_attributes_id, products_id, options_id, options_values_id, options_values_price, price_prefix) values ('1', '1', '4', '1', '0.0000', '+');
insert into products_attributes (products_attributes_id, products_id, options_id, options_values_id, options_values_price, price_prefix) values ('2', '1', '4', '2', '50.0000', '+');
insert into products_attributes (products_attributes_id, products_id, options_id, options_values_id, options_values_price, price_prefix) values ('3', '1', '4', '3', '70.0000', '+');
insert into products_attributes (products_attributes_id, products_id, options_id, options_values_id, options_values_price, price_prefix) values ('4', '1', '3', '5', '0.0000', '+');
insert into products_attributes (products_attributes_id, products_id, options_id, options_values_id, options_values_price, price_prefix) values ('5', '1', '3', '6', '100.0000', '+');
insert into products_attributes (products_attributes_id, products_id, options_id, options_values_id, options_values_price, price_prefix) values ('6', '2', '4', '3', '10.0000', '-');
insert into products_attributes (products_attributes_id, products_id, options_id, options_values_id, options_values_price, price_prefix) values ('7', '2', '4', '4', '0.0000', '+');
insert into products_attributes (products_attributes_id, products_id, options_id, options_values_id, options_values_price, price_prefix) values ('8', '2', '3', '6', '0.0000', '+');
insert into products_attributes (products_attributes_id, products_id, options_id, options_values_id, options_values_price, price_prefix) values ('9', '2', '3', '7', '120.0000', '+');
insert into products_attributes (products_attributes_id, products_id, options_id, options_values_id, options_values_price, price_prefix) values ('10', '26', '3', '8', '0.0000', '+');
insert into products_attributes (products_attributes_id, products_id, options_id, options_values_id, options_values_price, price_prefix) values ('11', '26', '3', '9', '6.0000', '+');
insert into products_attributes (products_attributes_id, products_id, options_id, options_values_id, options_values_price, price_prefix) values ('26', '22', '5', '10', '0.0000', '+');
insert into products_attributes (products_attributes_id, products_id, options_id, options_values_id, options_values_price, price_prefix) values ('27', '22', '5', '13', '0.0000', '+');

insert into products_attributes_download (products_attributes_id, products_attributes_filename, products_attributes_maxdays, products_attributes_maxcount) values ('26', 'unreal.zip', '7', '3');

insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('1', '1', 'Matrox G200 MMS', 'Reinforcing its position as a multi-monitor trailblazer, Matrox Graphics Inc. has once again developed the most flexible and highly advanced solution in the industry. Introducing the new Matrox G200 Multi-Monitor Series; the first graphics card ever to support up to four DVI digital flat panel displays on a single 8" PCI board.<br><br>With continuing demand for digital flat panels in the financial workplace, the Matrox G200 MMS is the ultimate in flexible solutions. The Matrox G200 MMS also supports the new digital video interface (DVI) created by the Digital Display Working Group (DDWG) designed to ease the adoption of digital flat panels. Other configurations include composite video capture ability and onboard TV tuner, making the Matrox G200 MMS the complete solution for business needs.<br><br>Based on the award-winning MGA-G200 graphics chip, the Matrox G200 Multi-Monitor Series provides superior 2D/3D graphics acceleration to meet the demanding needs of business applications such as real-time stock quotes (Versus), live video feeds (Reuters & Bloombergs), multiple windows applications, word processing, spreadsheets and CAD.', 'www.matrox.com/mga/products/g200_mms/home.cfm', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('1', '2', 'Matrox G200 MMS', '<b>Unterstützung für zwei bzw. vier analoge oder digitale Monitore</b><br><br>Die Matrox G200 Multi-Monitor-Serie führt die bewährte Matrox Tradition im Multi-Monitor- Bereich fort und bietet flexible und fortschrittliche Lösungen.Matrox stellt als erstes Unternehmen einen vierfachen digitalen PanelLink® DVI Flachbildschirm Ausgang zur Verfügung. Mit den optional erhältlichen TV Tuner und Video-Capture Möglichkeiten stellt die Matrox G200 MMS eine alles umfassende Mehrschirm-Lösung dar.<br><br><b>Leistungsmerkmale:</b><ul><li>Preisgekrönter Matrox G200 128-Bit Grafikchip</li><li>Schneller 8 MB SGRAM-Speicher pro Kanal</li><li>Integrierter, leistungsstarker 250 MHz RAMDAC</li><li>Unterstützung für bis zu 16 Bildschirme über 4 Quad-Karten (unter Win NT,ab Treiber 4.40)</li><li>Unterstützung von 9 Monitoren unter Win 98</li><li>2 bzw. 4 analoge oder digitale Ausgabekanäle pro PCI-Karte</li><li>Desktop-Darstellung von 1800 x 1440 oder 1920 x 1200 pro Chip</li><li>Anschlußmöglichkeit an einen 15-poligen VGA-Monitor oder an einen 30-poligen digitalen DVI-Flachbildschirm plus integriertem Composite-Video-Eingang (bei der TV-Version)</li><li>PCI Grafikkarte, kurze Baulänge</li><li>Treiberunterstützung: Windows® 2000, Windows NT® und Windows® 98</li><li>Anwendungsbereiche: Börsenumgebung mit zeitgleich großem Visualisierungsbedarf, Videoüberwachung, Video-Conferencing</li></ul>', 'www.matrox.com/mga/deutsch/products/g200_mms/home.cfm', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('1', '3', 'Matrox G200 MMS', 'Reinforcing its position as a multi-monitor trailblazer, Matrox Graphics Inc. has once again developed the most flexible and highly advanced solution in the industry. Introducing the new Matrox G200 Multi-Monitor Series; the first graphics card ever to support up to four DVI digital flat panel displays on a single 8" PCI board.<br><br>With continuing demand for digital flat panels in the financial workplace, the Matrox G200 MMS is the ultimate in flexible solutions. The Matrox G200 MMS also supports the new digital video interface (DVI) created by the Digital Display Working Group (DDWG) designed to ease the adoption of digital flat panels. Other configurations include composite video capture ability and onboard TV tuner, making the Matrox G200 MMS the complete solution for business needs.<br><br>Based on the award-winning MGA-G200 graphics chip, the Matrox G200 Multi-Monitor Series provides superior 2D/3D graphics acceleration to meet the demanding needs of business applications such as real-time stock quotes (Versus), live video feeds (Reuters & Bloombergs), multiple windows applications, word processing, spreadsheets and CAD.', 'www.matrox.com/mga/products/g200_mms/home.cfm', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('1', '4', 'Matrox G200 MMS', 'Reinforcing its position as a multi-monitor trailblazer, Matrox Graphics Inc. has once again developed the most flexible and highly advanced solution in the industry. Introducing the new Matrox G200 Multi-Monitor Series; the first graphics card ever to support up to four DVI digital flat panel displays on a single 8" PCI board.<br><br>With continuing demand for digital flat panels in the financial workplace, the Matrox G200 MMS is the ultimate in flexible solutions. The Matrox G200 MMS also supports the new digital video interface (DVI) created by the Digital Display Working Group (DDWG) designed to ease the adoption of digital flat panels. Other configurations include composite video capture ability and onboard TV tuner, making the Matrox G200 MMS the complete solution for business needs.<br><br>Based on the award-winning MGA-G200 graphics chip, the Matrox G200 Multi-Monitor Series provides superior 2D/3D graphics acceleration to meet the demanding needs of business applications such as real-time stock quotes (Versus), live video feeds (Reuters & Bloombergs), multiple windows applications, word processing, spreadsheets and CAD.', 'www.matrox.com/mga/products/g200_mms/home.cfm', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('2', '1', 'Matrox G400 32MB', '<b>Dramatically Different High Performance Graphics</b><br><br>Introducing the Millennium G400 Series - a dramatically different, high performance graphics experience. Armed with the industry\'s fastest graphics chip, the Millennium G400 Series takes explosive acceleration two steps further by adding unprecedented image quality, along with the most versatile display options for all your 3D, 2D and DVD applications. As the most powerful and innovative tools in your PC\'s arsenal, the Millennium G400 Series will not only change the way you see graphics, but will revolutionize the way you use your computer.<br><br><b>Key features:</b><ul><li>New Matrox G400 256-bit DualBus graphics chip</li><li>Explosive 3D, 2D and DVD performance</li><li>DualHead Display</li><li>Superior DVD and TV output</li><li>3D Environment-Mapped Bump Mapping</li><li>Vibrant Color Quality rendering </li><li>UltraSharp DAC of up to 360 MHz</li><li>3D Rendering Array Processor</li><li>Support for 16 or 32 MB of memory</li></ul>', 'www.matrox.com/mga/products/mill_g400/home.htm', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('2', '2', 'Matrox G400 32 MB', '<b>Neu! Matrox G400 "all inclusive" und vieles mehr...</b><br><br>Die neue Millennium G400-Serie - Hochleistungsgrafik mit dem sensationellen Unterschied. Ausgestattet mit dem neu eingeführten Matrox G400 Grafikchip, bietet die Millennium G400-Serie eine überragende Beschleunigung inklusive bisher nie dagewesener Bildqualitat und enorm flexibler Darstellungsoptionen bei allen Ihren 3D-, 2D- und DVD-Anwendungen.<br><br><ul><li>DualHead Display und TV-Ausgang</li><li>Environment Mapped Bump Mapping</li><li>Matrox G400 256-Bit DualBus</li><li>3D Rendering Array Prozessor</li><li>Vibrant Color Quality² (VCQ²)</li><li>UltraSharp DAC</li></ul><i>"Bleibt abschließend festzustellen, daß die Matrox Millennium G400 Max als Allroundkarte für den Highend-PC derzeit unerreicht ist. Das ergibt den Testsieg und unsere wärmste Empfehlung."</i><br><b>GameStar 8/99 (S.184)</b>', 'www.matrox.com/mga/deutsch/products/mill_g400/home.cfm', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('2', '3', 'Matrox G400 32MB', '<b>Dramatically Different High Performance Graphics</b><br><br>Introducing the Millennium G400 Series - a dramatically different, high performance graphics experience. Armed with the industry\'s fastest graphics chip, the Millennium G400 Series takes explosive acceleration two steps further by adding unprecedented image quality, along with the most versatile display options for all your 3D, 2D and DVD applications. As the most powerful and innovative tools in your PC\'s arsenal, the Millennium G400 Series will not only change the way you see graphics, but will revolutionize the way you use your computer.<br><br><b>Key features:</b><ul><li>New Matrox G400 256-bit DualBus graphics chip</li><li>Explosive 3D, 2D and DVD performance</li><li>DualHead Display</li><li>Superior DVD and TV output</li><li>3D Environment-Mapped Bump Mapping</li><li>Vibrant Color Quality rendering </li><li>UltraSharp DAC of up to 360 MHz</li><li>3D Rendering Array Processor</li><li>Support for 16 or 32 MB of memory</li></ul>', 'www.matrox.com/mga/products/mill_g400/home.htm', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('2', '4', 'Matrox G400 32MB', '<b>Dramatically Different High Performance Graphics</b><br><br>Introducing the Millennium G400 Series - a dramatically different, high performance graphics experience. Armed with the industry\'s fastest graphics chip, the Millennium G400 Series takes explosive acceleration two steps further by adding unprecedented image quality, along with the most versatile display options for all your 3D, 2D and DVD applications. As the most powerful and innovative tools in your PC\'s arsenal, the Millennium G400 Series will not only change the way you see graphics, but will revolutionize the way you use your computer.<br><br><b>Key features:</b><ul><li>New Matrox G400 256-bit DualBus graphics chip</li><li>Explosive 3D, 2D and DVD performance</li><li>DualHead Display</li><li>Superior DVD and TV output</li><li>3D Environment-Mapped Bump Mapping</li><li>Vibrant Color Quality rendering </li><li>UltraSharp DAC of up to 360 MHz</li><li>3D Rendering Array Processor</li><li>Support for 16 or 32 MB of memory</li></ul>', 'www.matrox.com/mga/products/mill_g400/home.htm', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('3', '1', 'Microsoft IntelliMouse Pro', 'Every element of IntelliMouse Pro - from its unique arched shape to the texture of the rubber grip around its base - is the product of extensive customer and ergonomic research. Microsoft\'s popular wheel control, which now allows zooming and universal scrolling functions, gives IntelliMouse Pro outstanding comfort and efficiency.', 'www.microsoft.com/hardware/mouse/intellimouse.asp', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('3', '2', 'Microsoft IntelliMouse Pro', 'Die IntelliMouse Pro hat mit der IntelliRad-Technologie einen neuen Standard gesetzt. Anwenderfreundliche Handhabung und produktiveres Arbeiten am PC zeichnen die IntelliMouse aus. Die gewölbte Oberseite paßt sich natürlich in die Handfläche ein, die geschwungene Form erleichtert das Bedienen der Maus. Sie ist sowohl für Rechts- wie auch für Linkshänder geeignet. Mit dem Rad der IntelliMouse kann der Anwender einfach und komfortabel durch Dokumente navigieren.<br><br><b>Eigenschaften:</b><ul><li><b>ANSCHLUSS:</b> PS/2</li><li><b>FARBE:</b> weiß</li><li><b>TECHNIK:</b> Mauskugel</li><li><b>TASTEN:</b> 3 (incl. Scrollrad)</li><li><b>SCROLLRAD:</b> Ja</li></ul>', '', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('3', '3', 'Microsoft IntelliMouse Pro', 'Every element of IntelliMouse Pro - from its unique arched shape to the texture of the rubber grip around its base - is the product of extensive customer and ergonomic research. Microsoft\'s popular wheel control, which now allows zooming and universal scrolling functions, gives IntelliMouse Pro outstanding comfort and efficiency.', 'www.microsoft.com/hardware/mouse/intellimouse.asp', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('3', '4', 'Microsoft IntelliMouse Pro', 'Every element of IntelliMouse Pro - from its unique arched shape to the texture of the rubber grip around its base - is the product of extensive customer and ergonomic research. Microsoft\'s popular wheel control, which now allows zooming and universal scrolling functions, gives IntelliMouse Pro outstanding comfort and efficiency.', 'www.microsoft.com/hardware/mouse/intellimouse.asp', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('4', '1', 'The Replacement Killers', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Languages: English, Deutsch.<br>Subtitles: English, Deutsch, Spanish.<br>Audio: Dolby Surround 5.1.<br>Picture Format: 16:9 Wide-Screen.<br>Length: (approx) 80 minutes.<br>Other: Interactive Menus, Chapter Selection, Subtitles (more languages).', 'www.replacement-killers.com', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('4', '2', 'Die Ersatzkiller', 'Originaltitel: "The Replacement Killers"<br><br>Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Sprachen: English, Deutsch.<br>Untertitel: English, Deutsch, Spanish.<br>Audio: Dolby Surround 5.1.<br>Bildformat: 16:9 Wide-Screen.<br>Dauer: (approx) 80 minutes.<br>Außerdem: Interaktive Menus, Kapitelauswahl, Untertitel.<br><br>(USA 1998). Til Schweiger schießt auf Hongkong-Star Chow Yun-Fat ("Anna und der König") ­ ein Fehler ...', 'www.replacement-killers.com', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('4', '3', 'The Replacement Killers', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Languages: English, Deutsch.<br>Subtitles: English, Deutsch, Spanish.<br>Audio: Dolby Surround 5.1.<br>Picture Format: 16:9 Wide-Screen.<br>Length: (approx) 80 minutes.<br>Other: Interactive Menus, Chapter Selection, Subtitles (more languages).', 'www.replacement-killers.com', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('4', '4', 'The Replacement Killers', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Languages: English, Deutsch.<br>Subtitles: English, Deutsch, Spanish.<br>Audio: Dolby Surround 5.1.<br>Picture Format: 16:9 Wide-Screen.<br>Length: (approx) 80 minutes.<br>Other: Interactive Menus, Chapter Selection, Subtitles (more languages).', 'www.replacement-killers.com', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('5', '1', 'Blade Runner - Director\'s Cut', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Languages: English, Deutsch.<br>Subtitles: English, Deutsch, Spanish.<br>Audio: Dolby Surround 5.1.<br>Picture Format: 16:9 Wide-Screen.<br>Length: (approx) 112 minutes.<br>Other: Interactive Menus, Chapter Selection, Subtitles (more languages).', 'www.bladerunner.com', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('5', '2', 'Blade Runner - Director\'s Cut', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Sprachen: English, Deutsch.<br>Untertitel: English, Deutsch, Spanish.<br>Audio: Dolby Surround 5.1.<br>Bildformat: 16:9 Wide-Screen.<br>Dauer: (approx) 112 minutes.<br>Außerdem: Interaktive Menus, Kapitelauswahl, Untertitel.<br><br><b>Sci-Fi-Klassiker, USA 1983, 112 Min.</b><br><br>Los Angeles ist im Jahr 2019 ein Hexenkessel. Dauerregen und Smog tauchen den überbevölkerten Moloch in ewige Dämmerung. Polizeigleiter schwirren durch die Luft und überwachen das grelle Ethnogemisch, das sich am Fuße 400stöckiger Stahlbeton-Pyramiden tummelt. Der abgehalfterte Ex-Cop und \"Blade Runner\" Rick Deckard ist Spezialist für die Beseitigung von Replikanten, künstlichen Menschen, geschaffen für harte Arbeit auf fremden Planeten. Nur ihm kann es gelingen, vier flüchtige, hochintelligente \"Nexus 6\"-Spezialmodelle zu stellen. Die sind mit ihrem starken und brandgefährlichen Anführer Batty auf der Suche nach ihrem Schöpfer. Er soll ihnen eine längere Lebenszeit schenken. Das muß Rick Deckard verhindern.  Als sich der eiskalte Jäger in Rachel, die Sekretärin seines Auftraggebers, verliebt, gerät sein Weltbild jedoch ins Wanken. Er entdeckt, daß sie - vielleicht wie er selbst - ein Replikant ist ...<br><br>Die Konfrontation des Menschen mit \"Realität\" und \"Virtualität\" und das verstrickte Spiel mit getürkten Erinnerungen zieht sich als roter Faden durch das Werk von Autor Philip K. Dick (\"Die totale Erinnerung\"). Sein Roman \"Träumen Roboter von elektrischen Schafen?\" liefert die Vorlage für diesen doppelbödigen Thriller, der den Zuschauer mit faszinierendenZukunftsvisionen und der gigantischen Kulisse des Großstadtmolochs gefangen nimmt.', 'www.bladerunner.com', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('5', '3', 'Blade Runner - Director\'s Cut', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Languages: English, Deutsch.<br>Subtitles: English, Deutsch, Spanish.<br>Audio: Dolby Surround 5.1.<br>Picture Format: 16:9 Wide-Screen.<br>Length: (approx) 112 minutes.<br>Other: Interactive Menus, Chapter Selection, Subtitles (more languages).', 'www.bladerunner.com', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('5', '4', 'Blade Runner - Director\'s Cut', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Languages: English, Deutsch.<br>Subtitles: English, Deutsch, Spanish.<br>Audio: Dolby Surround 5.1.<br>Picture Format: 16:9 Wide-Screen.<br>Length: (approx) 112 minutes.<br>Other: Interactive Menus, Chapter Selection, Subtitles (more languages).', 'www.bladerunner.com', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('6', '1', 'The Matrix', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Languages: English, Deutsch.<br>Subtitles: English, Deutsch.<br>Audio: Dolby Surround.<br>Picture Format: 16:9 Wide-Screen.<br>Length: (approx) 131 minutes.<br>Other: Interactive Menus, Chapter Selection, Making Of.', 'www.thematrix.com', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('6', '2', 'Matrix', 'Originaltitel: "The Matrix"<br><br>Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Sprachen: English, Deutsch.<br>Untertitel: English, Deutsch, Spanish.<br>Audio: Dolby Surround 5.1.<br>Bildformat: 16:9 Wide-Screen.<br>Dauer: (approx) 136 minuten.<br>Außerdem: Interaktive Menus, Kapitelauswahl, Untertitel.<br><br>(USA 1999) Der Geniestreich der Wachowski-Brüder. In dieser technisch perfekten Utopie kämpft Hacker Keanu Reeves gegen die Diktatur der Maschinen...', 'www.whatisthematrix.com', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('6', '3', 'The Matrix', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Languages: English, Deutsch.<br>Subtitles: English, Deutsch.<br>Audio: Dolby Surround.<br>Picture Format: 16:9 Wide-Screen.<br>Length: (approx) 131 minutes.<br>Other: Interactive Menus, Chapter Selection, Making Of.', 'www.thematrix.com', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('6', '4', 'The Matrix', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Languages: English, Deutsch.<br>Subtitles: English, Deutsch.<br>Audio: Dolby Surround.<br>Picture Format: 16:9 Wide-Screen.<br>Length: (approx) 131 minutes.<br>Other: Interactive Menus, Chapter Selection, Making Of.', 'www.thematrix.com', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('7', '1', 'You\'ve Got Mail', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Languages: English, Deutsch, Spanish.<br>Subtitles: English, Deutsch, Spanish, French, Nordic, Polish.<br>Audio: Dolby Digital 5.1.<br>Picture Format: 16:9 Wide-Screen.<br>Length: (approx) 115 minutes.<br>Other: Interactive Menus, Chapter Selection, Subtitles (more languages).', 'www.youvegotmail.com', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('7', '2', 'e-m@il für Dich', 'Original: "You\'ve got mail"<br>Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Sprachen: English, Deutsch.<br>Untertitel: English, Deutsch, Spanish.<br>Audio: Dolby Surround 5.1.<br>Bildformat: 16:9 Wide-Screen.<br>Dauer: (approx) 112 minutes.<br>Außerdem: Interaktive Menus, Kapitelauswahl, Untertitel.<br><br>(USA 1998) von Nora Ephron (&qout;Schlaflos in Seattle"). Meg Ryan und Tom Hanks knüpfen per E-Mail zarte Bande. Dass sie sich schon kennen, ahnen sie nicht ...', 'www.youvegotmail.com', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('7', '3', 'You\'ve Got Mail', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Languages: English, Deutsch, Spanish.<br>Subtitles: English, Deutsch, Spanish, French, Nordic, Polish.<br>Audio: Dolby Digital 5.1.<br>Picture Format: 16:9 Wide-Screen.<br>Length: (approx) 115 minutes.<br>Other: Interactive Menus, Chapter Selection, Subtitles (more languages).', 'www.youvegotmail.com', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('7', '4', 'You\'ve Got Mail', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Languages: English, Deutsch, Spanish.<br>Subtitles: English, Deutsch, Spanish, French, Nordic, Polish.<br>Audio: Dolby Digital 5.1.<br>Picture Format: 16:9 Wide-Screen.<br>Length: (approx) 115 minutes.<br>Other: Interactive Menus, Chapter Selection, Subtitles (more languages).', 'www.youvegotmail.com', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('8', '1', 'A Bug\'s Life', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Languages: English, Deutsch.<br>Subtitles: English, Deutsch, Spanish.<br>Audio: Dolby Digital 5.1 / Dobly Surround Stereo.<br>Picture Format: 16:9 Wide-Screen.<br>Length: (approx) 91 minutes.<br>Other: Interactive Menus, Chapter Selection, Subtitles (more languages).', 'www.abugslife.com', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('8', '2', 'Das Große Krabbeln', 'Originaltitel: "A Bug\'s Life"<br><br>Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Sprachen: English, Deutsch.<br>Untertitel: English, Deutsch, Spanish.<br>Audio: Dolby Surround 5.1.<br>Bildformat: 16:9 Wide-Screen.<br>Dauer: (approx) 96 minuten.<br>Außerdem: Interaktive Menus, Kapitelauswahl, Untertitel.<br><br>(USA 1998). Ameise Flik zettelt einen Aufstand gegen gefräßige Grashüpfer an ... Eine fantastische Computeranimation des \"Toy Story\"-Teams. ', 'www.abugslife.com', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('8', '3', 'A Bug\'s Life', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Languages: English, Deutsch.<br>Subtitles: English, Deutsch, Spanish.<br>Audio: Dolby Digital 5.1 / Dobly Surround Stereo.<br>Picture Format: 16:9 Wide-Screen.<br>Length: (approx) 91 minutes.<br>Other: Interactive Menus, Chapter Selection, Subtitles (more languages).', 'www.abugslife.com', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('8', '4', 'A Bug\'s Life', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Languages: English, Deutsch.<br>Subtitles: English, Deutsch, Spanish.<br>Audio: Dolby Digital 5.1 / Dobly Surround Stereo.<br>Picture Format: 16:9 Wide-Screen.<br>Length: (approx) 91 minutes.<br>Other: Interactive Menus, Chapter Selection, Subtitles (more languages).', 'www.abugslife.com', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('9', '1', 'Under Siege', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Languages: English, Deutsch.<br>Subtitles: English, Deutsch, Spanish.<br>Audio: Dolby Surround 5.1.<br>Picture Format: 16:9 Wide-Screen.<br>Length: (approx) 98 minutes.<br>Other: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('9', '2', 'Alarmstufe: Rot', 'Originaltitel: "Under Siege"<br><br>Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Sprachen: English, Deutsch.<br>Untertitel: English, Deutsch, Spanish.<br>Audio: Dolby Surround 5.1.<br>Bildformat: 16:9 Wide-Screen.<br>Dauer: (approx) 96 minuten.<br>Außerdem: Interaktive Menus, Kapitelauswahl, Untertitel.<br><br><b>Actionthriller. Smutje Steven Seagal versalzt Schurke Tommy Lee Jones die Suppe</b><br><br>Katastrophe ahoi: Kurz vor Ausmusterung der \"U.S.S. Missouri\" kapert die High-tech-Bande von Ex-CIA-Agent Strannix (Tommy Lee Jones) das Schlachtschiff. Strannix will die Nuklearraketen des Kreuzers klauen und verscherbeln. Mit Hilfe des irren Ersten Offiziers Krill (lustig: Gary Busey) killen die Gangster den Käpt’n und sperren seine Crew unter Deck. Blöd, dass sie dabei Schiffskoch Rybak (Steven Seagal) vergessen. Der Ex-Elitekämpfer knipst einen Schurken nach dem anderen aus. Eine Verbündete findet er in Stripperin Jordan (Ex-\"Baywatch\"-Biene Erika Eleniak). Die sollte eigentlich aus Käpt’ns Geburtstagstorte hüpfen ... Klar: Seagal ist kein Edelmime. Dafür ist Regisseur Andrew Davis (\"Auf der Flucht\") ein Könner: Er würzt die Action-Orgie mit Ironie und nutzt die imposante Schiffskulisse voll aus. Für Effekte und Ton gab es 1993 Oscar-Nominierungen. ', '', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('9', '3', 'Under Siege', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Languages: English, Deutsch.<br>Subtitles: English, Deutsch, Spanish.<br>Audio: Dolby Surround 5.1.<br>Picture Format: 16:9 Wide-Screen.<br>Length: (approx) 98 minutes.<br>Other: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('9', '4', 'Under Siege', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Languages: English, Deutsch.<br>Subtitles: English, Deutsch, Spanish.<br>Audio: Dolby Surround 5.1.<br>Picture Format: 16:9 Wide-Screen.<br>Length: (approx) 98 minutes.<br>Other: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('10', '1', 'Under Siege 2 - Dark Territory', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Languages: English, Deutsch.<br>Subtitles: English, Deutsch, Spanish.<br>Audio: Dolby Surround 5.1.<br>Picture Format: 16:9 Wide-Screen.<br>Length: (approx) 98 minutes.<br>Other: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('10', '2', 'Alarmstufe: Rot 2', 'Originaltitel: "Under Siege 2: Dark Territory"<br><br>Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Sprachen: English, Deutsch.<br>Untertitel: English, Deutsch, Spanish.<br>Audio: Dolby Surround 5.1.<br>Bildformat: 16:9 Wide-Screen.<br>Dauer: (approx) 96 minuten.<br>Außerdem: Interaktive Menus, Kapitelauswahl, Untertitel.<br><br>(USA ’95). Von einem gekaperten Zug aus übernimmt Computerspezi Dane die Kontrolle über einen Kampfsatelliten und erpresst das Pentagon. Aber auch Ex-Offizier Ryback (Steven Seagal) ist im Zug ...', '', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('10', '3', 'Under Siege 2 - Dark Territory', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Languages: English, Deutsch.<br>Subtitles: English, Deutsch, Spanish.<br>Audio: Dolby Surround 5.1.<br>Picture Format: 16:9 Wide-Screen.<br>Length: (approx) 98 minutes.<br>Other: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('10', '4', 'Under Siege 2 - Dark Territory', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Languages: English, Deutsch.<br>Subtitles: English, Deutsch, Spanish.<br>Audio: Dolby Surround 5.1.<br>Picture Format: 16:9 Wide-Screen.<br>Length: (approx) 98 minutes.<br>Other: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('11', '1', 'Fire Down Below', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Languages: English, Deutsch.<br>Subtitles: English, Deutsch, Spanish.<br>Audio: Dolby Surround 5.1.<br>Picture Format: 16:9 Wide-Screen.<br>Length: (approx) 100 minutes.<br>Other: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('11', '2', 'Fire Down Below', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Sprachen: English, Deutsch.<br>Untertitel: English, Deutsch, Spanish.<br>Audio: Dolby Surround 5.1.<br>Bildformat: 16:9 Wide-Screen.<br>Dauer: (approx) 96 minuten.<br>Außerdem: Interaktive Menus, Kapitelauswahl, Untertitel.<br><br>Ein mysteriöser Mordfall führt den Bundesmarschall Jack Taggert in eine Kleinstadt im US-Staat Kentucky. Doch bei seinen Ermittlungen stößt er auf eine Mauer des Schweigens. Angst beherrscht die Stadt, und alle Spuren führen zu dem undurchsichtigen Minen-Tycoon Orin Hanner. Offenbar werden in der friedlichen Berglandschaft gigantische Mengen Giftmülls verschoben, mit unkalkulierbaren Risiken. Um eine Katastrophe zu verhindern, räumt Taggert gnadenlos auf ...', '', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('11', '3', 'Fire Down Below', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Languages: English, Deutsch.<br>Subtitles: English, Deutsch, Spanish.<br>Audio: Dolby Surround 5.1.<br>Picture Format: 16:9 Wide-Screen.<br>Length: (approx) 100 minutes.<br>Other: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('11', '4', 'Fire Down Below', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Languages: English, Deutsch.<br>Subtitles: English, Deutsch, Spanish.<br>Audio: Dolby Surround 5.1.<br>Picture Format: 16:9 Wide-Screen.<br>Length: (approx) 100 minutes.<br>Other: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('12', '1', 'Die Hard With A Vengeance', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Languages: English, Deutsch.<br>Subtitles: English, Deutsch, Spanish.<br>Audio: Dolby Surround 5.1.<br>Picture Format: 16:9 Wide-Screen.<br>Length: (approx) 122 minutes.<br>Other: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('12', '2', 'Stirb Langsam - Jetzt Erst Recht', 'Originaltitel: "Die Hard With A Vengeance"<br><br>Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Sprachen: English, Deutsch.<br>Untertitel: English, Deutsch, Spanish.<br>Audio: Dolby Surround 5.1.<br>Bildformat: 16:9 Wide-Screen.<br>Dauer: (approx) 96 minuten.<br>Außerdem: Interaktive Menus, Kapitelauswahl, Untertitel.<br><br>So explosiv, so spannend, so rasant wie nie zuvor: Bruce Willis als Detectiv John McClane in einem Action-Thriller der Superlative! Das ist heute nicht McClanes Tag. Seine Frau hat ihn verlassen, sein Boß hat ihn vom Dienst suspendiert und irgendein Verrückter hat ihn gerade zum Gegenspieler in einem teuflischen Spiel erkoren - und der Einsatz ist New York selbst. Ein Kaufhaus ist explodiert, doch das ist nur der Auftakt. Der geniale Superverbrecher Simon droht, die ganze Stadt Stück für Stück in die Luft zu sprengen, wenn McClane und sein Partner wider Willen seine explosiven\" Rätsel nicht lösen. Eine mörderische Hetzjagd quer durch New York beginnt - bis McClane merkt, daß der Bombenterror eigentlich nur ein brillantes Ablenkungsmanöver ist...!<br><i>\"Perfekt gemacht und stark besetzt. Das Action-Highlight des Jahres!\"</i> <b>(Bild)</b>', '', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('12', '3', 'Die Hard With A Vengeance', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Languages: English, Deutsch.<br>Subtitles: English, Deutsch, Spanish.<br>Audio: Dolby Surround 5.1.<br>Picture Format: 16:9 Wide-Screen.<br>Length: (approx) 122 minutes.<br>Other: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('12', '4', 'Die Hard With A Vengeance', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Languages: English, Deutsch.<br>Subtitles: English, Deutsch, Spanish.<br>Audio: Dolby Surround 5.1.<br>Picture Format: 16:9 Wide-Screen.<br>Length: (approx) 122 minutes.<br>Other: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('13', '1', 'Lethal Weapon', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Languages: English, Deutsch.<br>Subtitles: English, Deutsch, Spanish.<br>Audio: Dolby Surround 5.1.<br>Picture Format: 16:9 Wide-Screen.<br>Length: (approx) 100 minutes.<br>Other: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('13', '2', 'Zwei stahlharte Profis', 'Originaltitel: "Lethal Weapon"<br><br>Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Sprachen: English, Deutsch.<br>Untertitel: English, Deutsch, Spanish.<br>Audio: Dolby Surround 5.1.<br>Bildformat: 16:9 Wide-Screen.<br>Dauer: (approx) 96 minuten.<br>Außerdem: Interaktive Menus, Kapitelauswahl, Untertitel.<br><br>Sie sind beide Cops in L.A.. Sie haben beide in Vietnam für eine Spezialeinheit gekämpft. Und sie hassen es beide, mit einem Partner arbeiten zu müssen. Aber sie sind Partner: Martin Riggs, der Mann mit dem Todeswunsch, für wen auch immer. Und Roger Murtaugh, der besonnene Polizist. Gemeinsam enttarnen sie einen gigantischen Heroinschmuggel, hinter dem sich eine Gruppe ehemaliger CIA-Söldner verbirgt. Eine Killerbande gegen zwei Profis ...', '', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('13', '3', 'Lethal Weapon', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Languages: English, Deutsch.<br>Subtitles: English, Deutsch, Spanish.<br>Audio: Dolby Surround 5.1.<br>Picture Format: 16:9 Wide-Screen.<br>Length: (approx) 100 minutes.<br>Other: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('13', '4', 'Lethal Weapon', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Languages: English, Deutsch.<br>Subtitles: English, Deutsch, Spanish.<br>Audio: Dolby Surround 5.1.<br>Picture Format: 16:9 Wide-Screen.<br>Length: (approx) 100 minutes.<br>Other: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('14', '1', 'Red Corner', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Languages: English, Deutsch.<br>Subtitles: English, Deutsch, Spanish.<br>Audio: Dolby Surround 5.1.<br>Picture Format: 16:9 Wide-Screen.<br>Length: (approx) 117 minutes.<br>Other: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('14', '2', 'Labyrinth ohne Ausweg', 'Originaltitel: "Red Corner"<br><br>Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Sprachen: English, Deutsch.<br>Untertitel: English, Deutsch, Spanish.<br>Audio: Dolby Surround 5.1.<br>Bildformat: 16:9 Wide-Screen.<br>Dauer: (approx) 96 minuten.<br>Außerdem: Interaktive Menus, Kapitelauswahl, Untertitel.<br><br>Dem Amerikaner Jack Moore wird in China der bestialische Mord an einem Fotomodel angehängt. Brutale Gefängnisschergen versuchen, ihn durch Folter zu einem Geständnis zu zwingen. Vor Gericht fordert die Anklage die Todesstrafe - Moore\'s Schicksal scheint besiegelt. Durch einen Zufall gelingt es ihm, aus der Haft zu fliehen, doch aus der feindseligen chinesischen Hauptstadt gibt es praktisch kein Entkommen ...', '', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('14', '3', 'Red Corner', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Languages: English, Deutsch.<br>Subtitles: English, Deutsch, Spanish.<br>Audio: Dolby Surround 5.1.<br>Picture Format: 16:9 Wide-Screen.<br>Length: (approx) 117 minutes.<br>Other: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('14', '4', 'Red Corner', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Languages: English, Deutsch.<br>Subtitles: English, Deutsch, Spanish.<br>Audio: Dolby Surround 5.1.<br>Picture Format: 16:9 Wide-Screen.<br>Length: (approx) 117 minutes.<br>Other: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('15', '1', 'Frantic', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Languages: English, Deutsch.<br>Subtitles: English, Deutsch, Spanish.<br>Audio: Dolby Surround 5.1.<br>Picture Format: 16:9 Wide-Screen.<br>Length: (approx) 115 minutes.<br>Other: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('15', '2', 'Frantic', 'Originaltitel: "Frantic"<br><br>Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Sprachen: English, Deutsch.<br>Untertitel: English, Deutsch, Spanish.<br>Audio: Dolby Surround 5.1.<br>Bildformat: 16:9 Wide-Screen.<br>Dauer: (approx) 96 minuten.<br>Außerdem: Interaktive Menus, Kapitelauswahl, Untertitel.<br><br>Ein romantischer Urlaub in Paris, der sich in einen Alptraum verwandelt. Ein Mann auf der verzweifelten Suche nach seiner entführten Frau. Ein düster-bedrohliches Paris, in dem nur ein Mensch Licht in die tödliche Affäre bringen kann.', '', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('15', '3', 'Frantic', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Languages: English, Deutsch.<br>Subtitles: English, Deutsch, Spanish.<br>Audio: Dolby Surround 5.1.<br>Picture Format: 16:9 Wide-Screen.<br>Length: (approx) 115 minutes.<br>Other: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('15', '4', 'Frantic', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Languages: English, Deutsch.<br>Subtitles: English, Deutsch, Spanish.<br>Audio: Dolby Surround 5.1.<br>Picture Format: 16:9 Wide-Screen.<br>Length: (approx) 115 minutes.<br>Other: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('16', '1', 'Courage Under Fire', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Languages: English, Deutsch.<br>Subtitles: English, Deutsch, Spanish.<br>Audio: Dolby Surround 5.1.<br>Picture Format: 16:9 Wide-Screen.<br>Length: (approx) 112 minutes.<br>Other: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('16', '2', 'Mut Zur Wahrheit', 'Originaltitel: "Courage Under Fire"<br><br>Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Sprachen: English, Deutsch.<br>Untertitel: English, Deutsch, Spanish.<br>Audio: Dolby Surround 5.1.<br>Bildformat: 16:9 Wide-Screen.<br>Dauer: (approx) 96 minuten.<br>Außerdem: Interaktive Menus, Kapitelauswahl, Untertitel.<br><br>Lieutenant Colonel Nathaniel Serling (Denzel Washington) lässt während einer Schlacht im Golfkrieg versehentlich auf einen US-Panzer schießen, dessen Mannschaft dabei ums Leben kommt. Ein Jahr nach diesem Vorfall wird Serling, der mittlerweile nach Washington D.C. versetzt wurde, die Aufgabe übertragen, sich um einen Kandidaten zu kümmern, der während des Krieges starb und dem der höchste militärische Orden zuteil werden soll. Allerdings sind sowohl der Fall und als auch der betreffende Soldat ein politisch heißes Eisen -- Captain Karen Walden (Meg Ryan) ist Amerikas erster weiblicher Soldat, der im Kampf getötet wurde.<br><br>Serling findet schnell heraus, dass es im Fall des im felsigen Gebiet von Kuwait abgestürzten Rettungshubschraubers Diskrepanzen gibt. In Flashbacks werden von unterschiedlichen Personen verschiedene Versionen von Waldens Taktik, die Soldaten zu retten und den Absturz zu überleben, dargestellt (à la Kurosawas Rashomon). Genau wie in Glory erweist sich Regisseur Edward Zwicks Zusammenstellung von bekannten und unbekannten Schauspielern als die richtige Mischung. Waldens Crew ist besonders überzeugend. Matt Damon als der Sanitäter kommt gut als der leichtfertige Typ rüber, als er Washington seine Geschichte erzählt. Im Kampf ist er ein mit Fehlern behafteter, humorvoller Soldat.<br><br>Die erstaunlichste Arbeit in Mut zur Wahrheit leistet Lou Diamond Phillips (als der Schütze der Gruppe), dessen Karriere sich auf dem Weg in die direkt für den Videomarkt produzierten Filme befand. Und dann ist da noch Ryan. Sie hat sich in dramatischen Filmen in der Vergangenheit gut behauptet (Eine fast perfekte Liebe, Ein blutiges Erbe), es aber nie geschafft, ihrem Image zu entfliehen, das sie in die Ecke der romantischen Komödie steckte. Mit gefärbtem Haar, einem leichten Akzent und der von ihr geforderten Darstellungskunst hat sie endlich einen langlebigen dramatischen Film. Obwohl sie nur halb so oft wie Washington im Film zu sehen ist, macht ihre mutige und beeindruckend nachhaltige Darstellung Mut zur Wahrheit zu einem speziellen Film bis hin zu dessen seltsamer, aber lohnender letzter Szene.', '', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('16', '3', 'Courage Under Fire', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Languages: English, Deutsch.<br>Subtitles: English, Deutsch, Spanish.<br>Audio: Dolby Surround 5.1.<br>Picture Format: 16:9 Wide-Screen.<br>Length: (approx) 112 minutes.<br>Other: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('16', '4', 'Courage Under Fire', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Languages: English, Deutsch.<br>Subtitles: English, Deutsch, Spanish.<br>Audio: Dolby Surround 5.1.<br>Picture Format: 16:9 Wide-Screen.<br>Length: (approx) 112 minutes.<br>Other: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('17', '1', 'Speed', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Languages: English, Deutsch.<br>Subtitles: English, Deutsch, Spanish.<br>Audio: Dolby Surround 5.1.<br>Picture Format: 16:9 Wide-Screen.<br>Length: (approx) 112 minutes.<br>Other: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('17', '2', 'Speed', 'Originaltitel: "Speed"<br><br>Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Sprachen: English, Deutsch.<br>Untertitel: English, Deutsch, Spanish.<br>Audio: Dolby Surround 5.1.<br>Bildformat: 16:9 Wide-Screen.<br>Dauer: (approx) 96 minuten.<br>Außerdem: Interaktive Menus, Kapitelauswahl, Untertitel.<br><br>Er ist ein Cop aus der Anti-Terror-Einheit von Los Angeles. Und so ist der Alarm für Jack Traven nichts Ungewöhnliches: Ein Terrorist will drei Millionen Dollar erpressen, oder die zufälligen Geiseln in einem Aufzug fallen 35 Stockwerke in die Tiefe. Doch Jack schafft das Unmögliche - die Geiseln werden gerettet und der Terrorist stirbt an seiner eigenen Bombe. Scheinbar. Denn schon wenig später steht Jack (Keanu Reeves) dem Bombenexperten Payne erneut gegenüber. Diesmal hat sich der Erpresser eine ganz perfide Mordwaffe ausgedacht: Er plaziert eine Bombe in einem öffentlichen Bus. Der Mechanismus der Sprengladung schaltet sich automatisch ein, sobald der Bus schneller als 50 Meilen in der Stunde fährt und detoniert sofort, sobald die Geschwindigkeit sinkt. Plötzlich wird für eine Handvoll ahnungsloser Durchschnittsbürger der Weg zur Arbeit zum Höllentrip - und nur Jack hat ihr Leben in der Hand. Als der Busfahrer verletzt wird, übernimmt Fahrgast Annie (Sandra Bullock) das Steuer. Doch wohin mit einem Bus, der nicht bremsen kann in der Stadt der Staus? Doch es kommt noch schlimmer: Payne (Dennis Hopper) will jetzt nicht nur seine drei Millionen Dollar. Er will Jack. Um jeden Preis.', '', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('17', '3', 'Speed', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Languages: English, Deutsch.<br>Subtitles: English, Deutsch, Spanish.<br>Audio: Dolby Surround 5.1.<br>Picture Format: 16:9 Wide-Screen.<br>Length: (approx) 112 minutes.<br>Other: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('17', '4', 'Speed', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Languages: English, Deutsch.<br>Subtitles: English, Deutsch, Spanish.<br>Audio: Dolby Surround 5.1.<br>Picture Format: 16:9 Wide-Screen.<br>Length: (approx) 112 minutes.<br>Other: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('18', '1', 'Speed 2: Cruise Control', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Languages: English, Deutsch.<br>Subtitles: English, Deutsch, Spanish.<br>Audio: Dolby Surround 5.1.<br>Picture Format: 16:9 Wide-Screen.<br>Length: (approx) 120 minutes.<br>Other: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('18', '2', 'Speed 2: Cruise Control', 'Originaltitel: "Speed 2 - Cruise Control"<br><br>Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Sprachen: English, Deutsch.<br>Untertitel: English, Deutsch, Spanish.<br>Audio: Dolby Surround 5.1.<br>Bildformat: 16:9 Wide-Screen.<br>Dauer: (approx) 96 minuten.<br>Außerdem: Interaktive Menus, Kapitelauswahl, Untertitel.<br><br>Halten Sie ihre Schwimmwesten bereit, denn die actiongeladene Fortsetzung von Speed begibt sich auf Hochseekurs. Erleben Sie Sandra Bullock erneut in ihrer Star-Rolle als Annie Porter. Die Karibik-Kreuzfahrt mit ihrem Freund Alex entwickelt sich unaufhaltsam zur rasenden Todesfahrt, als ein wahnsinniger Computer-Spezialist den Luxusliner in seine Gewalt bringt und auf einen mörderischen Zerstörungskurs programmiert. Eine hochexplosive Reise, bei der kein geringerer als Action-Spezialist Jan De Bont das Ruder in die Hand nimmt. Speed 2: Cruise Controll läßt ihre Adrenalin-Wellen in rasender Geschwindigkeit ganz nach oben schnellen.', '', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('18', '3', 'Speed 2: Cruise Control', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Languages: English, Deutsch.<br>Subtitles: English, Deutsch, Spanish.<br>Audio: Dolby Surround 5.1.<br>Picture Format: 16:9 Wide-Screen.<br>Length: (approx) 120 minutes.<br>Other: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('18', '4', 'Speed 2: Cruise Control', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Languages: English, Deutsch.<br>Subtitles: English, Deutsch, Spanish.<br>Audio: Dolby Surround 5.1.<br>Picture Format: 16:9 Wide-Screen.<br>Length: (approx) 120 minutes.<br>Other: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('19', '1', 'There\'s Something About Mary', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Languages: English, Deutsch.<br>Subtitles: English, Deutsch, Spanish.<br>Audio: Dolby Surround 5.1.<br>Picture Format: 16:9 Wide-Screen.<br>Length: (approx) 114 minutes.<br>Other: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('19', '2', 'Verrückt nach Mary', 'Originaltitel: "There\'s Something About Mary"<br><br>Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Sprachen: English, Deutsch.<br>Untertitel: English, Deutsch, Spanish.<br>Audio: Dolby Surround 5.1.<br>Bildformat: 16:9 Wide-Screen.<br>Dauer: (approx) 96 minuten.<br>Außerdem: Interaktive Menus, Kapitelauswahl, Untertitel.<br><br>13 Jahre nachdem Teds Rendezvous mit seiner angebeteten Mary in einem peinlichen Fiasko endete, träumt er immer noch von ihr und engagiert den windigen Privatdetektiv Healy um sie aufzuspüren. Der findet Mary in Florida und verliebt sich auf den ersten Blick in die atemberaubende Traumfrau. Um Ted als Nebenbuhler auszuschalten, tischt er ihm dicke Lügen über Mary auf. Ted läßt sich jedoch nicht abschrecken, eilt nach Miami und versucht nun alles, um Healy die Balztour zu vermasseln. Doch nicht nur Healy ist verrückt nach Mary und Ted bekommt es mit einer ganzen Legion liebeskranker Konkurrenten zu tun ...', '', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('19', '3', 'There\'s Something About Mary', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Languages: English, Deutsch.<br>Subtitles: English, Deutsch, Spanish.<br>Audio: Dolby Surround 5.1.<br>Picture Format: 16:9 Wide-Screen.<br>Length: (approx) 114 minutes.<br>Other: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('19', '4', 'There\'s Something About Mary', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Languages: English, Deutsch.<br>Subtitles: English, Deutsch, Spanish.<br>Audio: Dolby Surround 5.1.<br>Picture Format: 16:9 Wide-Screen.<br>Length: (approx) 114 minutes.<br>Other: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('20', '1', 'Beloved', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Languages: English, Deutsch.<br>Subtitles: English, Deutsch, Spanish.<br>Audio: Dolby Surround 5.1.<br>Picture Format: 16:9 Wide-Screen.<br>Length: (approx) 164 minutes.<br>Other: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('20', '2', 'Menschenkind', 'Originaltitel: "Beloved"<br><br>Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Sprachen: English, Deutsch.<br>Untertitel: English, Deutsch, Spanish.<br>Audio: Dolby Surround 5.1.<br>Bildformat: 16:9 Wide-Screen.<br>Dauer: (approx) 96 minuten.<br>Außerdem: Interaktive Menus, Kapitelauswahl, Untertitel.<br><br>Dieser vielschichtige Film ist eine Arbeit, die Regisseur Jonathan Demme und dem amerikanischen Talkshow-Star Oprah Winfrey sehr am Herzen lag. Der Film deckt im Verlauf seiner dreistündigen Spielzeit viele Bereiche ab. Menschenkind ist teils Sklavenepos, teils Mutter-Tochter-Drama und teils Geistergeschichte.<br><br>Der Film fordert vom Publikum höchste Aufmerksamkeit, angefangen bei seiner dramatischen und etwas verwirrenden Eingangssequenz, in der die Bewohner eines Hauses von einem niederträchtigen übersinnlichen Angriff heimgesucht werden. Aber Demme und seine talentierte Besetzung bereiten denen, die dabei bleiben ein unvergessliches Erlebnis. Der Film folgt den Spuren von Sethe (in ihren mittleren Jahren von Oprah Winfrey dargestellt), einer ehemaligen Sklavin, die sich scheinbar ein friedliches und produktives Leben in Ohio aufgebaut hat. Aber durch den erschreckenden und sparsamen Einsatz von Rückblenden deckt Demme, genau wie das literarische Meisterwerk von Toni Morrison, auf dem der Film basiert, langsam die Schrecken von Sethes früherem Leben auf und das schreckliche Ereignis, dass dazu führte, dass Sethes Haus von Geistern heimgesucht wird.<br><br>Während die Gräuel der Sklaverei und das blutige Ereignis in Sethes Familie unleugbar tief beeindrucken, ist die Qualität des Film auch in kleineren, genauso befriedigenden Details sichtbar. Die geistlich beeinflusste Musik von Rachel Portman ist gleichzeitig befreiend und bedrückend, und der Einblick in die afro-amerikanische Gemeinschaft nach der Sklaverei -- am Beispiel eines Familienausflugs zu einem Jahrmarkt, oder dem gospelsingenden Nähkränzchen -- machen diesen Film zu einem speziellen Vergnügen sowohl für den Geist als auch für das Herz. Die Schauspieler, besonders Kimberley Elise als Sethes kämpfende Tochter und Thandie Newton als der mysteriöse Titelcharakter, sind sehr rührend. Achten Sie auch auf Danny Glover (Lethal Weapon) als Paul D.', '', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('20', '3', 'Beloved', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Languages: English, Deutsch.<br>Subtitles: English, Deutsch, Spanish.<br>Audio: Dolby Surround 5.1.<br>Picture Format: 16:9 Wide-Screen.<br>Length: (approx) 164 minutes.<br>Other: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('20', '4', 'Beloved', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Languages: English, Deutsch.<br>Subtitles: English, Deutsch, Spanish.<br>Audio: Dolby Surround 5.1.<br>Picture Format: 16:9 Wide-Screen.<br>Length: (approx) 164 minutes.<br>Other: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('21', '1', 'SWAT 3: Close Quarters Battle', '<b>Windows 95/98</b><br><br>211 in progress with shots fired. Officer down. Armed suspects with hostages. Respond Code 3! Los Angles, 2005, In the next seven days, representatives from every nation around the world will converge on Las Angles to witness the signing of the United Nations Nuclear Abolishment Treaty. The protection of these dignitaries falls on the shoulders of one organization, LAPD SWAT. As part of this elite tactical organization, you and your team have the weapons and all the training necessary to protect, to serve, and \"When needed\" to use deadly force to keep the peace. It takes more than weapons to make it through each mission. Your arsenal includes C2 charges, flashbangs, tactical grenades. opti-Wand mini-video cameras, and other devices critical to meeting your objectives and keeping your men free of injury. Uncompromised Duty, Honor and Valor!', 'www.swat3.com', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('21', '2', 'SWAT 3: Elite Edition', '<b>KEINE KOMPROMISSE!</b><br><i>Kämpfen Sie Seite an Seite mit Ihren LAPD SWAT-Kameraden gegen das organisierte Verbrechen!</i><br><br>Eine der realistischsten 3D-Taktiksimulationen der letzten Zeit jetzt mit Multiplayer-Modus, 5 neuen Missionen und jede Menge nützliche Tools!<br><br>Los Angeles, 2005. In wenigen Tagen steht die Unterzeichnung des Abkommens der Vereinten Nationen zur Atom-Ächtung durch Vertreter aller Nationen der Welt an. Radikale terroristische Vereinigungen machen sich in der ganzen Stadt breit. Verantwortlich für die Sicherheit der Delegierten zeichnet sich eine Eliteeinheit der LAPD: das SWAT-Team. Das Schicksal der Stadt liegt in Ihren Händen.<br><br><b>Neue Features:</b><ul><li>Multiplayer-Modus (Co op-Modus, Deathmatch in den bekannten Variationen)</li><li>5 neue Missionen an original Örtlichkeiten Las (U-Bahn, Whitman Airport, etc.)</li><li>neue Charakter</li><li>neue Skins</li><li>neue Waffen</li><li>neue Sounds</li><li>verbesserte KI</li><li>Tools-Package</li><li>Scenario-Editor</li><li>Level-Editor</li></ul>Die dritte Folge der Bestseller-Reihe im Bereich der 3D-Echtzeit-Simulationen präsentiert sich mit einer neuen Spielengine mit extrem ausgeprägtem Realismusgrad. Der Spieler übernimmt das Kommando über eine der besten Polizei-Spezialeinheiten oder einer der übelsten Terroristen-Gangs der Welt. Er durchläuft - als \"Guter\" oder \"Böser\" - eine der härtesten und elitärsten Kampfausbildungen, in der er lernt, mit jeder Art von Krisensituationen umzugehen. Bei diesem Action-Abenteuer geht es um das Leben prominenter Vertreter der Vereinten Nationen und bei 16 Missionen an Originalschauplätzen in LA gibt die \"lebensechte\" KI den Protagonisten jeder Seite so einige harte Nüsse zu knacken.', 'www.swat3.com', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('21', '3', 'SWAT 3: Close Quarters Battle', '<b>Windows 95/98</b><br><br>211 in progress with shots fired. Officer down. Armed suspects with hostages. Respond Code 3! Los Angles, 2005, In the next seven days, representatives from every nation around the world will converge on Las Angles to witness the signing of the United Nations Nuclear Abolishment Treaty. The protection of these dignitaries falls on the shoulders of one organization, LAPD SWAT. As part of this elite tactical organization, you and your team have the weapons and all the training necessary to protect, to serve, and \"When needed\" to use deadly force to keep the peace. It takes more than weapons to make it through each mission. Your arsenal includes C2 charges, flashbangs, tactical grenades. opti-Wand mini-video cameras, and other devices critical to meeting your objectives and keeping your men free of injury. Uncompromised Duty, Honor and Valor!', 'www.swat3.com', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('21', '4', 'SWAT 3: Close Quarters Battle', '<b>Windows 95/98</b><br><br>211 in progress with shots fired. Officer down. Armed suspects with hostages. Respond Code 3! Los Angles, 2005, In the next seven days, representatives from every nation around the world will converge on Las Angles to witness the signing of the United Nations Nuclear Abolishment Treaty. The protection of these dignitaries falls on the shoulders of one organization, LAPD SWAT. As part of this elite tactical organization, you and your team have the weapons and all the training necessary to protect, to serve, and \"When needed\" to use deadly force to keep the peace. It takes more than weapons to make it through each mission. Your arsenal includes C2 charges, flashbangs, tactical grenades. opti-Wand mini-video cameras, and other devices critical to meeting your objectives and keeping your men free of injury. Uncompromised Duty, Honor and Valor!', 'www.swat3.com', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('22', '1', 'Unreal Tournament', 'From the creators of the best-selling Unreal, comes Unreal Tournament. A new kind of single player experience. A ruthless multiplayer revolution.<br><br>This stand-alone game showcases completely new team-based gameplay, groundbreaking multi-faceted single player action or dynamic multi-player mayhem. It\'s a fight to the finish for the title of Unreal Grand Master in the gladiatorial arena. A single player experience like no other! Guide your team of \'bots\' (virtual teamates) against the hardest criminals in the galaxy for the ultimate title - the Unreal Grand Master.', 'www.unrealtournament.net', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('22', '2', 'Unreal Tournament', '2341: Die Gewalt ist eine Lebensweise, die sich ihren Weg durch die dunklen Risse der Gesellschaft bahnt. Sie bedroht die Macht und den Einfluss der regierenden Firmen, die schnellstens ein Mittel finden müssen, die tobenden Massen zu besänftigen - ein profitables Mittel ... Gladiatorenkämpfe sind die Lösung. Sie sollen den Durst der Menschen nach Blut stillen und sind die perfekte Gelegenheit, die Aufständischen, Kriminellen und Aliens zu beseitigen, die die Firmenelite bedrohen.<br><br>Das Turnier war geboren - ein Kampf auf Leben und Tod. Galaxisweit live und in Farbe! Kämpfen Sie für Freiheit, Ruhm und Ehre. Sie müssen stark, schnell und geschickt sein ... oder Sie bleiben auf der Strecke.<br><br>Kämpfen Sie allein oder kommandieren Sie ein Team gegen Armeen unbarmherziger Krieger, die alle nur ein Ziel vor Augen haben: Die Arenen lebend zu verlassen und sich dem Grand Champion zu stellen ... um ihn dann zu bezwingen!<br><br><b>Features:</b><ul><li>Auf dem PC mehrfach als Spiel des Jahres ausgezeichnet!</li><li>Mehr als 50 faszinierende Level - verlassene Raumstationen, gotische Kathedralen und graffitibedeckte Großstädte.</li><li>Vier actionreiche Spielmodi - Deathmatch, Capture the Flag, Assault und Domination werden Ihren Adrenalinpegel in die Höhe schnellen lassen.</li><li>Dramatische Mehrspieler-Kämpfe mit 2, 3 und 4 Spielern, auch über das Netzwerk</li><li>Gnadenlos aggressive Computergegner verlangen Ihnen das Äußerste ab.</li><li>Neuartiges Benutzerinterface und verbesserte Steuerung - auch mit USB-Maus und -Tastatur spielbar.</li></ul>Der Nachfolger des Actionhits \"Unreal\" verspricht ein leichtes, intuitives Interface, um auch Einsteigern schnellen Zugang zu den Duellen gegen die Bots zu ermöglichen. Mit diesen KI-Kriegern kann man auch Teams bilden und im umfangreichen Multiplayermodus ohne Onlinekosten in den Kampf ziehen. 35 komplett neue Arenen und das erweiterte Waffenangebot bilden dazu den würdigen Rahmen.', 'www.unrealtournament.net', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('22', '3', 'Unreal Tournament', 'From the creators of the best-selling Unreal, comes Unreal Tournament. A new kind of single player experience. A ruthless multiplayer revolution.<br><br>This stand-alone game showcases completely new team-based gameplay, groundbreaking multi-faceted single player action or dynamic multi-player mayhem. It\'s a fight to the finish for the title of Unreal Grand Master in the gladiatorial arena. A single player experience like no other! Guide your team of \'bots\' (virtual teamates) against the hardest criminals in the galaxy for the ultimate title - the Unreal Grand Master.', 'www.unrealtournament.net', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('22', '4', 'Unreal Tournament', 'From the creators of the best-selling Unreal, comes Unreal Tournament. A new kind of single player experience. A ruthless multiplayer revolution.<br><br>This stand-alone game showcases completely new team-based gameplay, groundbreaking multi-faceted single player action or dynamic multi-player mayhem. It\'s a fight to the finish for the title of Unreal Grand Master in the gladiatorial arena. A single player experience like no other! Guide your team of \'bots\' (virtual teamates) against the hardest criminals in the galaxy for the ultimate title - the Unreal Grand Master.', 'www.unrealtournament.net', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('23', '1', 'The Wheel Of Time', 'The world in which The Wheel of Time takes place is lifted directly out of Jordan\'s pages; it\'s huge and consists of many different environments. How you navigate the world will depend largely on which game - single player or multipayer - you\'re playing. The single player experience, with a few exceptions, will see Elayna traversing the world mainly by foot (with a couple notable exceptions). In the multiplayer experience, your character will have more access to travel via Ter\'angreal, Portal Stones, and the Ways. However you move around, though, you\'ll quickly discover that means of locomotion can easily become the least of the your worries...<br><br>During your travels, you quickly discover that four locations are crucial to your success in the game. Not surprisingly, these locations are the homes of The Wheel of Time\'s main characters. Some of these places are ripped directly from the pages of Jordan\'s books, made flesh with Legend\'s unparalleled pixel-pushing ways. Other places are specific to the game, conceived and executed with the intent of expanding this game world even further. Either way, they provide a backdrop for some of the most intense first person action and strategy you\'ll have this year.', 'www.wheeloftime.com', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('23', '2', 'The Wheel Of Time', '<b><i>\"Wheel Of Time\"(Das Rad der Zeit)</i></b> basiert auf den Fantasy-Romanen von Kultautor Robert Jordan und stellt einen einzigartigen Mix aus Strategie-, Action- und Rollenspielelementen dar. Obwohl die Welt von \"Wheel of Time\" eng an die literarische Vorlage der Romane angelehnt ist, erzählt das Spiel keine lineare Geschichte. Die Story entwickelt sich abhängig von den Aktionen der Spieler, die jeweils die Rollen der Hauptcharaktere aus dem Roman übernehmen. Jede Figur hat den Oberbefehl über eine große Gefolgschaft, militärische Einheiten und Ländereien. Die Spieler können ihre eigenen Festungen konstruieren, individuell ausbauen, von dort aus das umliegende Land erforschen, magische Gegenstände sammeln oder die gegnerischen Zitadellen erstürmen. Selbstverständlich kann man sich auch über LAN oder Internet gegenseitig Truppen auf den Hals hetzen und die Festungen seiner Mitspieler in Schutt und Asche legen. Dreh- und Anlegepunkt von \"Wheel of Time\" ist der Kampf um die finstere Macht \"The Dark One\", die vor langer Zeit die Menschheit beinahe ins Verderben stürzte und nur mit Hilfe gewaltiger magischer Energie verbannt werden konnte. \"The Amyrlin Seat\" und \"The Children of the Night\" kämpfen nur gegen \"The Forsaken\" und \"The Hound\" um den Besitz des Schlüssels zu \"Shayol Ghul\" - dem magischen Siegel, mit dessen Hilfe \"The Dark One\" seinerzeit gebannt werden konnte.<br><br><b>Features:</b> <ul><li>Ego-Shooter mit Strategie-Elementen</li><li>Spielumgebung in Echtzeit-3D</li><li>Konstruktion aud Ausbau der eigenen Festung</li><li>Einsatz von über 100 Artefakten und Zaubersprüchen</li><li>Single- und Multiplayermodus</li></ul>Im Mittelpunkt steht der Kampf gegen eine finstere Macht namens The Dark One. Deren Schergen müssen mit dem Einsatz von über 100 Artefakten und Zaubereien wie Blitzschlag oder Teleportation aus dem Weg geräumt werden. Die opulente 3D-Grafik verbindet Strategie- und Rollenspielelemente. <b>Voraussetzungen</b>mind. P200, 32MB RAM, 4x CD-Rom, Win95/98, DirectX 5.0 komp.Grafikkarte und Soundkarte. ', 'www.wheeloftime.com', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('23', '3', 'The Wheel Of Time', 'The world in which The Wheel of Time takes place is lifted directly out of Jordan\'s pages; it\'s huge and consists of many different environments. How you navigate the world will depend largely on which game - single player or multipayer - you\'re playing. The single player experience, with a few exceptions, will see Elayna traversing the world mainly by foot (with a couple notable exceptions). In the multiplayer experience, your character will have more access to travel via Ter\'angreal, Portal Stones, and the Ways. However you move around, though, you\'ll quickly discover that means of locomotion can easily become the least of the your worries...<br><br>During your travels, you quickly discover that four locations are crucial to your success in the game. Not surprisingly, these locations are the homes of The Wheel of Time\'s main characters. Some of these places are ripped directly from the pages of Jordan\'s books, made flesh with Legend\'s unparalleled pixel-pushing ways. Other places are specific to the game, conceived and executed with the intent of expanding this game world even further. Either way, they provide a backdrop for some of the most intense first person action and strategy you\'ll have this year.', 'www.wheeloftime.com', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('23', '4', 'The Wheel Of Time', 'The world in which The Wheel of Time takes place is lifted directly out of Jordan\'s pages; it\'s huge and consists of many different environments. How you navigate the world will depend largely on which game - single player or multipayer - you\'re playing. The single player experience, with a few exceptions, will see Elayna traversing the world mainly by foot (with a couple notable exceptions). In the multiplayer experience, your character will have more access to travel via Ter\'angreal, Portal Stones, and the Ways. However you move around, though, you\'ll quickly discover that means of locomotion can easily become the least of the your worries...<br><br>During your travels, you quickly discover that four locations are crucial to your success in the game. Not surprisingly, these locations are the homes of The Wheel of Time\'s main characters. Some of these places are ripped directly from the pages of Jordan\'s books, made flesh with Legend\'s unparalleled pixel-pushing ways. Other places are specific to the game, conceived and executed with the intent of expanding this game world even further. Either way, they provide a backdrop for some of the most intense first person action and strategy you\'ll have this year.', 'www.wheeloftime.com', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('24', '1', 'Disciples: Sacred Lands', 'A new age is dawning...<br><br>Enter the realm of the Sacred Lands, where the dawn of a New Age has set in motion the most momentous of wars. As the prophecies long foretold, four races now clash with swords and sorcery in a desperate bid to control the destiny of their gods. Take on the quest as a champion of the Empire, the Mountain Clans, the Legions of the Damned, or the Undead Hordes and test your faith in battles of brute force, spellbinding magic and acts of guile. Slay demons, vanquish giants and combat merciless forces of the dead and undead. But to ensure the salvation of your god, the hero within must evolve.<br><br>The day of reckoning has come... and only the chosen will survive.', '', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('24', '2', 'Disciples: Sacred Land', 'Rundenbasierende Fantasy/RTS-Strategie mit gutem Design (vor allem die Levels, 4 versch. Rassen, tolle Einheiten), fantastischer Atmosphäre und exzellentem Soundtrack. Grafisch leider auf das Niveau von 1990.', 'www.strategyfirst.com/disciples/welcome.html', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('24', '3', 'Disciples: Sacred Lands', 'A new age is dawning...<br><br>Enter the realm of the Sacred Lands, where the dawn of a New Age has set in motion the most momentous of wars. As the prophecies long foretold, four races now clash with swords and sorcery in a desperate bid to control the destiny of their gods. Take on the quest as a champion of the Empire, the Mountain Clans, the Legions of the Damned, or the Undead Hordes and test your faith in battles of brute force, spellbinding magic and acts of guile. Slay demons, vanquish giants and combat merciless forces of the dead and undead. But to ensure the salvation of your god, the hero within must evolve.<br><br>The day of reckoning has come... and only the chosen will survive.', '', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('24', '4', 'Disciples: Sacred Lands', 'A new age is dawning...<br><br>Enter the realm of the Sacred Lands, where the dawn of a New Age has set in motion the most momentous of wars. As the prophecies long foretold, four races now clash with swords and sorcery in a desperate bid to control the destiny of their gods. Take on the quest as a champion of the Empire, the Mountain Clans, the Legions of the Damned, or the Undead Hordes and test your faith in battles of brute force, spellbinding magic and acts of guile. Slay demons, vanquish giants and combat merciless forces of the dead and undead. But to ensure the salvation of your god, the hero within must evolve.<br><br>The day of reckoning has come... and only the chosen will survive.', '', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('25', '1', 'Microsoft Internet Keyboard PS/2', 'The Internet Keyboard has 10 Hot Keys on a comfortable standard keyboard design that also includes a detachable palm rest. The Hot Keys allow you to browse the web, or check e-mail directly from your keyboard. The IntelliType Pro software also allows you to customize your hot keys - make the Internet Keyboard work the way you want it to!', '', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('25', '2', 'Microsoft Internet Tastatur PS/2', '<i>Microsoft Internet Keyboard,Windows-Tastatur mit 10 zusätzl. Tasten,2 selbst programmierbar, abnehmbareHandgelenkauflage. Treiber im Lieferumfang.</i><br><br>Ein-Klick-Zugriff auf das Internet und vieles mehr! Das Internet Keyboard verfügt über 10 zusätzliche Abkürzungstasten auf einer benutzerfreundlichen Standardtastatur, die darüber hinaus eine abnehmbare Handballenauflage aufweist. Über die Abkürzungstasten können Sie durch das Internet surfen oder direkt von der Tastatur aus auf E-Mails zugreifen. Die IntelliType Pro-Software ermöglicht außerdem das individuelle Belegen der Tasten.', '', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('25', '3', 'Microsoft Internet Keyboard PS/2', 'The Internet Keyboard has 10 Hot Keys on a comfortable standard keyboard design that also includes a detachable palm rest. The Hot Keys allow you to browse the web, or check e-mail directly from your keyboard. The IntelliType Pro software also allows you to customize your hot keys - make the Internet Keyboard work the way you want it to!', '', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('25', '4', 'Microsoft Internet Keyboard PS/2', 'The Internet Keyboard has 10 Hot Keys on a comfortable standard keyboard design that also includes a detachable palm rest. The Hot Keys allow you to browse the web, or check e-mail directly from your keyboard. The IntelliType Pro software also allows you to customize your hot keys - make the Internet Keyboard work the way you want it to!', '', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('26', '1', 'Microsoft IntelliMouse Explorer', 'Microsoft introduces its most advanced mouse, the IntelliMouse Explorer! IntelliMouse Explorer features a sleek design, an industrial-silver finish, a glowing red underside and taillight, creating a style and look unlike any other mouse. IntelliMouse Explorer combines the accuracy and reliability of Microsoft IntelliEye optical tracking technology, the convenience of two new customizable function buttons, the efficiency of the scrolling wheel and the comfort of expert ergonomic design. All these great features make this the best mouse for the PC!', 'www.microsoft.com/hardware/mouse/explorer.asp', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('26', '2', 'Microsof IntelliMouse Explorer', 'Die IntelliMouse Explorer überzeugt durch ihr modernes Design mit silberfarbenem Gehäuse, sowie rot schimmernder Unter- und Rückseite. Die neuartige IntelliEye-Technologie sorgt für eine noch nie dagewesene Präzision, da statt der beweglichen Teile (zum Abtasten der Bewegungsänderungen an der Unterseite der Maus) ein optischer Sensor die Bewegungen der Maus erfaßt. Das Herzstück der Microsoft IntelliEye-Technologie ist ein kleiner Chip, der einen optischen Sensor und einen digitalen Signalprozessor (DSP) enthält.<br><br>Da auf bewegliche Teile, die Staub, Schmutz und Fett aufnehmen können, verzichtet wurde, muß die IntelliMouse Explorer nicht mehr gereinigt werden. Darüber hinaus arbeitet die IntelliMouse Explorer auf nahezu jeder Arbeitsoberfläche, so daß kein Mauspad mehr erforderlich ist. Mit dem Rad und zwei neuen zusätzlichen Maustasten ermöglicht sie effizientes und komfortables Arbeiten am PC.<br><br><b>Eigenschaften:</b><ul><li><b>ANSCHLUSS:</b> USB (PS/2-Adapter enthalten)</li><li><b>FARBE:</b> metallic-grau</li><li><b>TECHNIK:</b> Optisch (Akt.: ca. 1500 Bilder/s)</li><li><b>TASTEN:</b> 5 (incl. Scrollrad)</li><li><b>SCROLLRAD:</b> Ja</li></ul><i><b>BEMERKUNG:</b><br>Keine Reinigung bewegter Teile mehr notwendig, da statt der Mauskugel ein Fotoempfänger benutzt wird.</i>', '', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('26', '3', 'Microsoft IntelliMouse Explorer', 'Microsoft introduces its most advanced mouse, the IntelliMouse Explorer! IntelliMouse Explorer features a sleek design, an industrial-silver finish, a glowing red underside and taillight, creating a style and look unlike any other mouse. IntelliMouse Explorer combines the accuracy and reliability of Microsoft IntelliEye optical tracking technology, the convenience of two new customizable function buttons, the efficiency of the scrolling wheel and the comfort of expert ergonomic design. All these great features make this the best mouse for the PC!', 'www.microsoft.com/hardware/mouse/explorer.asp', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('26', '4', 'Microsoft IntelliMouse Explorer', 'Microsoft introduces its most advanced mouse, the IntelliMouse Explorer! IntelliMouse Explorer features a sleek design, an industrial-silver finish, a glowing red underside and taillight, creating a style and look unlike any other mouse. IntelliMouse Explorer combines the accuracy and reliability of Microsoft IntelliEye optical tracking technology, the convenience of two new customizable function buttons, the efficiency of the scrolling wheel and the comfort of expert ergonomic design. All these great features make this the best mouse for the PC!', 'www.microsoft.com/hardware/mouse/explorer.asp', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('27', '1', 'Hewlett Packard LaserJet 1100Xi', 'HP has always set the pace in laser printing technology. The new generation HP LaserJet 1100 series sets another impressive pace, delivering a stunning 8 pages per minute print speed. The 600 dpi print resolution with HP\'s Resolution Enhancement technology (REt) makes every document more professional.<br><br>Enhanced print speed and laser quality results are just the beginning. With 2MB standard memory, HP LaserJet 1100xi users will be able to print increasingly complex pages. Memory can be increased to 18MB to tackle even more complex documents with ease. The HP LaserJet 1100xi supports key operating systems including Windows 3.1, 3.11, 95, 98, NT 4.0, OS/2 and DOS. Network compatibility available via the optional HP JetDirect External Print Servers.<br><br>HP LaserJet 1100xi also features The Document Builder for the Web Era from Trellix Corp. (featuring software to create Web documents).', 'www.pandi.hp.com/pandi-db/prodinfo.main?product=laserjet1100', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('27', '2', 'Hewlett-Packard LaserJet 1100Xi', '<b>HP LaserJet für mehr Produktivität und Flexibilität am Arbeitsplatz</b><br><br>Der HP LaserJet 1100Xi Drucker verbindet exzellente Laserdruckqualität mit hoher Geschwindigkeit für mehr Effizienz.<br><br><b>Zielkunden</b><ul><li>Einzelanwender, die Wert auf professionelle Ausdrucke in Laserqualität legen und schnelle Ergebnisse auch bei komplexen Dokumenten erwarten.</li><li>Der HP LaserJet 1100 sorgt mit gestochen scharfen Texten und Grafiken für ein professionelles Erscheinungsbild Ihrer Arbeit und Ihres Unternehmens. Selbst bei komplexen Dokumenten liefert er schnelle Ergebnisse. Andere Medien - wie z.B. Transparentfolien und Briefumschläge, etc. - lassen sich problemlos bedrucken. Somit ist der HP LaserJet 1100 ein Multifunktionstalent im Büroalltag.</li></ul><b>Eigenschaften</b><ul><li><b>Druckqualität</b> Schwarzweiß: 600 x 600 dpi</li><li><b>Monatliche Druckleistung</b> Bis zu 7000 Seiten</li><li><b>Speicher</b> 2 MB Standardspeicher, erweiterbar auf 18 MB</li><li><b>Schnittstelle/gemeinsame Nutzung</b> Parallel, IEEE 1284-kompatibel</li><li><b>Softwarekompatibilität</b> DOS/Win 3.1x/9x/NT 4.0</li><li><b>Papierzuführung</b> 125-Blatt-Papierzuführung</li><li><b>Druckmedien</b> Normalpapier, Briefumschläge, Transparentfolien, kartoniertes Papier, Postkarten und Etiketten</li><li><b>Netzwerkfähig</b> Über HP JetDirect PrintServer</li><li><b>Lieferumfang</b> HP LaserJet 1100Xi Drucker (Lieferumfang: Drucker, Tonerkassette, 2 m Parallelkabel, Netzkabel, Kurzbedienungsanleitung, Benutzerhandbuch, CD-ROM, 3,5\"-Disketten mit Windows® 3.1x, 9x, NT 4.0 Treibern und DOS-Dienstprogrammen)</li><li><b>Gewährleistung</b> Ein Jahr</li></ul>', 'www.hp.com', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('27', '3', 'Hewlett Packard LaserJet 1100Xi', 'HP has always set the pace in laser printing technology. The new generation HP LaserJet 1100 series sets another impressive pace, delivering a stunning 8 pages per minute print speed. The 600 dpi print resolution with HP\'s Resolution Enhancement technology (REt) makes every document more professional.<br><br>Enhanced print speed and laser quality results are just the beginning. With 2MB standard memory, HP LaserJet 1100xi users will be able to print increasingly complex pages. Memory can be increased to 18MB to tackle even more complex documents with ease. The HP LaserJet 1100xi supports key operating systems including Windows 3.1, 3.11, 95, 98, NT 4.0, OS/2 and DOS. Network compatibility available via the optional HP JetDirect External Print Servers.<br><br>HP LaserJet 1100xi also features The Document Builder for the Web Era from Trellix Corp. (featuring software to create Web documents).', 'www.pandi.hp.com/pandi-db/prodinfo.main?product=laserjet1100', '0');
insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('27', '4', 'Hewlett Packard LaserJet 1100Xi', 'HP has always set the pace in laser printing technology. The new generation HP LaserJet 1100 series sets another impressive pace, delivering a stunning 8 pages per minute print speed. The 600 dpi print resolution with HP\'s Resolution Enhancement technology (REt) makes every document more professional.<br><br>Enhanced print speed and laser quality results are just the beginning. With 2MB standard memory, HP LaserJet 1100xi users will be able to print increasingly complex pages. Memory can be increased to 18MB to tackle even more complex documents with ease. The HP LaserJet 1100xi supports key operating systems including Windows 3.1, 3.11, 95, 98, NT 4.0, OS/2 and DOS. Network compatibility available via the optional HP JetDirect External Print Servers.<br><br>HP LaserJet 1100xi also features The Document Builder for the Web Era from Trellix Corp. (featuring software to create Web documents).', 'www.pandi.hp.com/pandi-db/prodinfo.main?product=laserjet1100', '0');

insert into products_options (products_options_id, language_id, products_options_name) values ('1', '1', 'Color');
insert into products_options (products_options_id, language_id, products_options_name) values ('1', '2', 'Farbe');
insert into products_options (products_options_id, language_id, products_options_name) values ('1', '3', 'Color');
insert into products_options (products_options_id, language_id, products_options_name) values ('1', '4', 'Color');
insert into products_options (products_options_id, language_id, products_options_name) values ('2', '1', 'Size');
insert into products_options (products_options_id, language_id, products_options_name) values ('2', '2', 'Größe');
insert into products_options (products_options_id, language_id, products_options_name) values ('2', '3', 'Talla');
insert into products_options (products_options_id, language_id, products_options_name) values ('2', '4', 'Size');
insert into products_options (products_options_id, language_id, products_options_name) values ('3', '1', 'Model');
insert into products_options (products_options_id, language_id, products_options_name) values ('3', '2', 'Modell');
insert into products_options (products_options_id, language_id, products_options_name) values ('3', '3', 'Modelo');
insert into products_options (products_options_id, language_id, products_options_name) values ('3', '4', 'Model');
insert into products_options (products_options_id, language_id, products_options_name) values ('4', '1', 'Memory');
insert into products_options (products_options_id, language_id, products_options_name) values ('4', '2', 'Speicher');
insert into products_options (products_options_id, language_id, products_options_name) values ('4', '3', 'Memoria');
insert into products_options (products_options_id, language_id, products_options_name) values ('4', '4', 'Memory');
insert into products_options (products_options_id, language_id, products_options_name) values ('5', '1', 'Version');
insert into products_options (products_options_id, language_id, products_options_name) values ('5', '2', 'Version');
insert into products_options (products_options_id, language_id, products_options_name) values ('5', '3', 'Version');
insert into products_options (products_options_id, language_id, products_options_name) values ('5', '4', 'Version');

insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('1', '1', '4 mb');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('1', '2', '4 MB');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('1', '3', '4 mb');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('1', '4', '4 mb');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('2', '1', '8 mb');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('2', '2', '8 MB');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('2', '3', '8 mb');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('2', '4', '8 mb');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('3', '1', '16 mb');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('3', '2', '16 MB');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('3', '3', '16 mb');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('3', '4', '16 mb');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('4', '1', '32 mb');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('4', '2', '32 MB');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('4', '3', '32 mb');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('4', '4', '32 mb');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('5', '1', 'Value');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('5', '2', 'Value Ausgabe');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('5', '3', 'Value');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('5', '4', 'Value');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('6', '1', 'Premium');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('6', '2', 'Premium Ausgabe');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('6', '3', 'Premium');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('6', '4', 'Premium');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('7', '1', 'Deluxe');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('7', '2', 'Deluxe Ausgabe');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('7', '3', 'Deluxe');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('7', '4', 'Deluxe');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('8', '1', 'PS/2');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('8', '2', 'PS/2 Anschluss');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('8', '3', 'PS/2');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('8', '4', 'PS/2');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('9', '1', 'USB');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('9', '2', 'USB Anschluss');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('9', '3', 'USB');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('9', '4', 'USB');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('10', '1', 'Download: Windows - English');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('10', '2', 'Download: Windows - Englisch');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('10', '3', 'Download: Windows - Inglese');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('10', '4', 'Download: Windows - English');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('13', '1', 'Box: Windows - English');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('13', '2', 'Box: Windows - Englisch');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('13', '3', 'Box: Windows - Inglese');
insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('13', '4', 'Box: Windows - English');
insert into products_options_values_to_products_options (products_options_values_to_products_options_id, products_options_id, products_options_values_id) values ('1', '4', '1');
insert into products_options_values_to_products_options (products_options_values_to_products_options_id, products_options_id, products_options_values_id) values ('2', '4', '2');
insert into products_options_values_to_products_options (products_options_values_to_products_options_id, products_options_id, products_options_values_id) values ('3', '4', '3');
insert into products_options_values_to_products_options (products_options_values_to_products_options_id, products_options_id, products_options_values_id) values ('4', '4', '4');
insert into products_options_values_to_products_options (products_options_values_to_products_options_id, products_options_id, products_options_values_id) values ('5', '3', '5');
insert into products_options_values_to_products_options (products_options_values_to_products_options_id, products_options_id, products_options_values_id) values ('6', '3', '6');
insert into products_options_values_to_products_options (products_options_values_to_products_options_id, products_options_id, products_options_values_id) values ('7', '3', '7');
insert into products_options_values_to_products_options (products_options_values_to_products_options_id, products_options_id, products_options_values_id) values ('8', '3', '8');
insert into products_options_values_to_products_options (products_options_values_to_products_options_id, products_options_id, products_options_values_id) values ('9', '3', '9');
insert into products_options_values_to_products_options (products_options_values_to_products_options_id, products_options_id, products_options_values_id) values ('10', '5', '10');
insert into products_options_values_to_products_options (products_options_values_to_products_options_id, products_options_id, products_options_values_id) values ('13', '5', '13');

insert into products_to_categories (products_id, categories_id) values ('1', '4');
insert into products_to_categories (products_id, categories_id) values ('2', '4');
insert into products_to_categories (products_id, categories_id) values ('3', '9');
insert into products_to_categories (products_id, categories_id) values ('4', '10');
insert into products_to_categories (products_id, categories_id) values ('5', '11');
insert into products_to_categories (products_id, categories_id) values ('6', '10');
insert into products_to_categories (products_id, categories_id) values ('7', '12');
insert into products_to_categories (products_id, categories_id) values ('8', '13');
insert into products_to_categories (products_id, categories_id) values ('9', '10');
insert into products_to_categories (products_id, categories_id) values ('10', '10');
insert into products_to_categories (products_id, categories_id) values ('11', '10');
insert into products_to_categories (products_id, categories_id) values ('12', '10');
insert into products_to_categories (products_id, categories_id) values ('13', '10');
insert into products_to_categories (products_id, categories_id) values ('14', '15');
insert into products_to_categories (products_id, categories_id) values ('15', '14');
insert into products_to_categories (products_id, categories_id) values ('16', '15');
insert into products_to_categories (products_id, categories_id) values ('17', '10');
insert into products_to_categories (products_id, categories_id) values ('18', '10');
insert into products_to_categories (products_id, categories_id) values ('19', '12');
insert into products_to_categories (products_id, categories_id) values ('20', '15');
insert into products_to_categories (products_id, categories_id) values ('21', '18');
insert into products_to_categories (products_id, categories_id) values ('22', '19');
insert into products_to_categories (products_id, categories_id) values ('23', '20');
insert into products_to_categories (products_id, categories_id) values ('24', '20');
insert into products_to_categories (products_id, categories_id) values ('25', '8');
insert into products_to_categories (products_id, categories_id) values ('26', '9');
insert into products_to_categories (products_id, categories_id) values ('27', '5');

insert into reviews (reviews_id, products_id, customers_id, customers_name, reviews_rating, date_added, last_modified, reviews_read) values ('1', '19', '1', 'John doe', '5', '2006-08-19 16:06:16', NULL, '0');

insert into reviews_description (reviews_id, languages_id, reviews_text) values ('1', '1', 'this has to be one of the funniest movies released for 1999!');

insert into specials (specials_id, products_id, specials_new_products_price, specials_date_added, specials_last_modified, expires_date, date_status_change, status) values ('1', '3', '39.9900', '2006-08-19 16:06:16', NULL, NULL, NULL, '1');
insert into specials (specials_id, products_id, specials_new_products_price, specials_date_added, specials_last_modified, expires_date, date_status_change, status) values ('2', '5', '30.0000', '2006-08-19 16:06:16', NULL, NULL, NULL, '1');
insert into specials (specials_id, products_id, specials_new_products_price, specials_date_added, specials_last_modified, expires_date, date_status_change, status) values ('3', '6', '30.0000', '2006-08-19 16:06:16', NULL, NULL, NULL, '1');
insert into specials (specials_id, products_id, specials_new_products_price, specials_date_added, specials_last_modified, expires_date, date_status_change, status) values ('4', '16', '29.9900', '2006-08-19 16:06:16', NULL, NULL, NULL, '1');

insert into tax_class (tax_class_id, tax_class_title, tax_class_description, last_modified, date_added) values ('1', 'Taxable Goods', 'The following types of products are included non-food, services, etc', '2006-08-19 16:06:16', '2006-08-19 16:06:16');
insert into tax_class (tax_class_id, tax_class_title, tax_class_description, last_modified, date_added) values ('2', 'TVA 19.6%', 'TVA 19.6%', NULL, '2008-04-15 15:26:48');
insert into tax_class (tax_class_id, tax_class_title, tax_class_description, last_modified, date_added) values ('3', 'TVA 5,5%', 'TVA 5.50%', NULL, '2008-04-15 15:27:01');

insert into tax_rates (tax_rates_id, tax_zone_id, tax_class_id, tax_priority, tax_rate, tax_description, last_modified, date_added) values ('1', '1', '1', '1', '7.0000', 'FL TAX 7.0%', '2006-08-19 16:06:17', '2006-08-19 16:06:17');
insert into tax_rates (tax_rates_id, tax_zone_id, tax_class_id, tax_priority, tax_rate, tax_description, last_modified, date_added) values ('2', '2', '2', '0', '19.6000', 'TVA 19.6', NULL, '2008-04-15 15:27:29');
insert into tax_rates (tax_rates_id, tax_zone_id, tax_class_id, tax_priority, tax_rate, tax_description, last_modified, date_added) values ('3', '2', '3', '1', '5.5000', 'TVA 5.5', NULL, '2008-04-15 15:27:51');

insert into geo_zones (geo_zone_id, geo_zone_name, geo_zone_description, last_modified, date_added) values ('1', 'Florida', 'Florida local sales tax zone', NULL, '2006-08-19 16:06:17');
insert into geo_zones (geo_zone_id, geo_zone_name, geo_zone_description, last_modified, date_added) VALUES('2', 'CEE', 'Zone de TVA applicable depuis la France', NULL, '2008-04-15 17:35:09');

insert into whos_online (customer_id, full_name, session_id, ip_address, time_entry, time_last_click, last_page_url) values ('0', 'Guest', '203822a35c819c7e779120b5033a9f6e', '192.168.1.10', '1155997988', '1155998050', '/osc_060817/catalog/index.php?cPath=1)#uage=fr&osCsid=203822a35c819c7e779120b5033a9f6e');

insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('1', '223', 'AL', 'Alabama');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('2', '223', 'AK', 'Alaska');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('3', '223', 'AS', 'American Samoa');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('4', '223', 'AZ', 'Arizona');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('5', '223', 'AR', 'Arkansas');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('6', '223', 'AF', 'Armed Forces Africa');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('7', '223', 'AA', 'Armed Forces Americas');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('8', '223', 'AC', 'Armed Forces Canada');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('9', '223', 'AE', 'Armed Forces Europe');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('10', '223', 'AM', 'Armed Forces Middle East');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('11', '223', 'AP', 'Armed Forces Pacific');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('12', '223', 'CA', 'California');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('13', '223', 'CO', 'Colorado');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('14', '223', 'CT', 'Connecticut');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('15', '223', 'DE', 'Delaware');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('16', '223', 'DC', 'District of Columbia');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('17', '223', 'FM', 'Federated States Of Micronesia');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('18', '223', 'FL', 'Florida');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('19', '223', 'GA', 'Georgia');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('20', '223', 'GU', 'Guam');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('21', '223', 'HI', 'Hawaii');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('22', '223', 'ID', 'Idaho');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('23', '223', 'IL', 'Illinois');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('24', '223', 'IN', 'Indiana');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('25', '223', 'IA', 'Iowa');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('26', '223', 'KS', 'Kansas');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('27', '223', 'KY', 'Kentucky');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('28', '223', 'LA', 'Louisiana');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('29', '223', 'ME', 'Maine');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('30', '223', 'MH', 'Marshall Islands');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('31', '223', 'MD', 'Maryland');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('32', '223', 'MA', 'Massachusetts');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('33', '223', 'MI', 'Michigan');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('34', '223', 'MN', 'Minnesota');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('35', '223', 'MS', 'Mississippi');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('36', '223', 'MO', 'Missouri');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('37', '223', 'MT', 'Montana');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('38', '223', 'NE', 'Nebraska');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('39', '223', 'NV', 'Nevada');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('40', '223', 'NH', 'New Hampshire');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('41', '223', 'NJ', 'New Jersey');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('42', '223', 'NM', 'New Mexico');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('43', '223', 'NY', 'New York');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('44', '223', 'NC', 'North Carolina');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('45', '223', 'ND', 'North Dakota');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('46', '223', 'MP', 'Northern Mariana Islands');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('47', '223', 'OH', 'Ohio');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('48', '223', 'OK', 'Oklahoma');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('49', '223', 'OR', 'Oregon');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('50', '223', 'PW', 'Palau');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('51', '223', 'PA', 'Pennsylvania');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('52', '223', 'PR', 'Puerto Rico');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('53', '223', 'RI', 'Rhode Island');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('54', '223', 'SC', 'South Carolina');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('55', '223', 'SD', 'South Dakota');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('56', '223', 'TN', 'Tennessee');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('57', '223', 'TX', 'Texas');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('58', '223', 'UT', 'Utah');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('59', '223', 'VT', 'Vermont');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('60', '223', 'VI', 'Virgin Islands');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('61', '223', 'VA', 'Virginia');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('62', '223', 'WA', 'Washington');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('63', '223', 'WV', 'West Virginia');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('64', '223', 'WI', 'Wisconsin');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('65', '223', 'WY', 'Wyoming');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('66', '38', 'AB', 'Alberta');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('67', '38', 'BC', 'British Columbia');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('68', '38', 'MB', 'Manitoba');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('69', '38', 'NF', 'Newfoundland');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('70', '38', 'NB', 'New Brunswick');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('71', '38', 'NS', 'Nova Scotia');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('72', '38', 'NT', 'Northwest Territories');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('73', '38', 'NU', 'Nunavut');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('74', '38', 'ON', 'Ontario');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('75', '38', 'PE', 'Prince Edward Island');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('76', '38', 'QC', 'Quebec');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('77', '38', 'SK', 'Saskatchewan');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('78', '38', 'YT', 'Yukon Territory');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('79', '81', 'NDS', 'Niedersachsen');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('80', '81', 'BAW', 'Baden-Württemberg');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('81', '81', 'BAY', 'Bayern');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('82', '81', 'BER', 'Berlin');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('83', '81', 'BRG', 'Brandenburg');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('84', '81', 'BRE', 'Bremen');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('85', '81', 'HAM', 'Hamburg');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('86', '81', 'HES', 'Hessen');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('87', '81', 'MEC', 'Mecklenburg-Vorpommern');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('88', '81', 'NRW', 'Nordrhein-Westfalen');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('89', '81', 'RHE', 'Rheinland-Pfalz');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('90', '81', 'SAR', 'Saarland');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('91', '81', 'SAS', 'Sachsen');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('92', '81', 'SAC', 'Sachsen-Anhalt');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('93', '81', 'SCN', 'Schleswig-Holstein');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('94', '81', 'THE', 'Thüringen');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('95', '14', 'WI', 'Wien');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('96', '14', 'NO', 'Niederösterreich');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('97', '14', 'OO', 'Oberösterreich');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('98', '14', 'SB', 'Salzburg');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('99', '14', 'KN', 'Kärnten');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('100', '14', 'ST', 'Steiermark');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('101', '14', 'TI', 'Tirol');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('102', '14', 'BL', 'Burgenland');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('103', '14', 'VB', 'Voralberg');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('104', '204', 'AG', 'Aargau');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('105', '204', 'AI', 'Appenzell Innerrhoden');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('106', '204', 'AR', 'Appenzell Ausserrhoden');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('107', '204', 'BE', 'Bern');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('108', '204', 'BL', 'Basel-Landschaft');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('109', '204', 'BS', 'Basel-Stadt');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('110', '204', 'FR', 'Freiburg');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('111', '204', 'GE', 'Genf');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('112', '204', 'GL', 'Glarus');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('113', '204', 'JU', 'Graubünden');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('114', '204', 'JU', 'Jura');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('115', '204', 'LU', 'Luzern');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('116', '204', 'NE', 'Neuenburg');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('117', '204', 'NW', 'Nidwalden');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('118', '204', 'OW', 'Obwalden');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('119', '204', 'SG', 'St. Gallen');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('120', '204', 'SH', 'Schaffhausen');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('121', '204', 'SO', 'Solothurn');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('122', '204', 'SZ', 'Schwyz');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('123', '204', 'TG', 'Thurgau');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('124', '204', 'TI', 'Tessin');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('125', '204', 'UR', 'Uri');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('126', '204', 'VD', 'Waadt');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('127', '204', 'VS', 'Wallis');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('128', '204', 'ZG', 'Zug');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('129', '204', 'ZH', 'Zürich');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('130', '195', 'A Coruña', 'A Coruña');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('131', '195', 'Alava', 'Alava');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('132', '195', 'Albacete', 'Albacete');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('133', '195', 'Alicante', 'Alicante');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('134', '195', 'Almeria', 'Almeria');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('135', '195', 'Asturias', 'Asturias');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('136', '195', 'Avila', 'Avila');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('137', '195', 'Badajoz', 'Badajoz');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('138', '195', 'Baleares', 'Baleares');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('139', '195', 'Barcelona', 'Barcelona');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('140', '195', 'Burgos', 'Burgos');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('141', '195', 'Caceres', 'Caceres');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('142', '195', 'Cadiz', 'Cadiz');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('143', '195', 'Cantabria', 'Cantabria');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('144', '195', 'Castellon', 'Castellon');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('145', '195', 'Ceuta', 'Ceuta');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('146', '195', 'Ciudad Real', 'Ciudad Real');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('147', '195', 'Cordoba', 'Cordoba');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('148', '195', 'Cuenca', 'Cuenca');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('149', '195', 'Girona', 'Girona');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('150', '195', 'Granada', 'Granada');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('151', '195', 'Guadalajara', 'Guadalajara');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('152', '195', 'Guipuzcoa', 'Guipuzcoa');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('153', '195', 'Huelva', 'Huelva');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('154', '195', 'Huesca', 'Huesca');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('155', '195', 'Jaen', 'Jaen');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('156', '195', 'La Rioja', 'La Rioja');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('157', '195', 'Las Palmas', 'Las Palmas');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('158', '195', 'Leon', 'Leon');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('159', '195', 'Lleida', 'Lleida');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('160', '195', 'Lugo', 'Lugo');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('161', '195', 'Madrid', 'Madrid');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('162', '195', 'Malaga', 'Malaga');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('163', '195', 'Melilla', 'Melilla');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('164', '195', 'Murcia', 'Murcia');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('165', '195', 'Navarra', 'Navarra');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('166', '195', 'Ourense', 'Ourense');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('167', '195', 'Palencia', 'Palencia');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('168', '195', 'Pontevedra', 'Pontevedra');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('169', '195', 'Salamanca', 'Salamanca');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('170', '195', 'Santa Cruz de Tenerife', 'Santa Cruz de Tenerife');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('171', '195', 'Segovia', 'Segovia');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('172', '195', 'Sevilla', 'Sevilla');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('173', '195', 'Soria', 'Soria');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('174', '195', 'Tarragona', 'Tarragona');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('175', '195', 'Teruel', 'Teruel');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('176', '195', 'Toledo', 'Toledo');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('177', '195', 'Valencia', 'Valencia');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('178', '195', 'Valladolid', 'Valladolid');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('179', '195', 'Vizcaya', 'Vizcaya');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('180', '195', 'Zamora', 'Zamora');

insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('181', '73', '67-68', 'Alsace');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('182', '73', '24-33-40-47-64', 'Aquitaine');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('183', '73', '03-15-43-63', 'Auvergne');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('184', '73', '14-50-61', 'Basse-Normandie');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('185', '73', '21-58-71-89', 'Bourgogne');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('186', '73', '22-29-35-59', 'Bretagne');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('187', '73', '18-28-36-37-41-45', 'Centre');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('188', '73', '08-10-51-52', 'Champagne-Ardenne');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('189', '73', '20-2A-2B', 'Corse');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('190', '73', '25-39-70-90', 'Franche-Comté');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('191', '73', '27-76', 'Haute-Normandie');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('192', '73', '75-77-78-91-92-93-94-95', 'Ile-de-France');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('193', '73', '11-30-34-48-66', 'Languedoc-Roussillon');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('194', '73', '19-23-87', 'Limousin');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('195', '73', '54-55-57-88', 'Lorraine');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('196', '73', '09-12-31-32-46-65-81-82', 'Midi-Pyrénées');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('197', '73', '59-62', 'Nord-Pas-de-Calais');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('198', '73', '44-49-53-72-85', 'Pays de la Loire');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('199', '73', '02-60-80', 'Picardie');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('200', '73', '16-17-79-86', 'Poitou-Charentes');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('201', '73', '04-05-06-13-83-84', 'Provence-Alpes-Côte-d''Azu');
insert into zones (zone_id, zone_country_id, zone_code, zone_name) values ('202', '73', '01-07-26-38-42-69-73-74', 'Rhône-Alpes');

insert into zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) values ('1', '223', '18', '1', NULL, '2006-08-19 16:06:17');
insert into zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) values ('2', '73', '0', '2', NULL, '2008-04-15 15:25:46');
insert into zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) values ('3', '21', NULL, '2', '2008-04-15 15:26:10', '2008-04-15 15:25:59');
insert into zones_to_geo_zones (association_id, zone_country_id, zone_id, geo_zone_id, last_modified, date_added) values ('4', '74', '0', '2', NULL, '2008-04-15 15:26:23');
