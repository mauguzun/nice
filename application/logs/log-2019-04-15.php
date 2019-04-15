<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-04-15 08:23:38 --> Query error: Table 'tricypolitain.translate' doesn't exist - Invalid query: SELECT `points`.`lat` as `lat`, `points`.`lng` as `lng`, `points`.`meeting` as `meeting`, `points`.`id` as `pid`, `translate`.`title` as `title`, `translate`.`text` as `text`, `tours_points`.`tour_id` as `tid`, `img_t`.`img` as `tour_img`, `tour_trans`.`text` as `tour_trans_text`, `tour_trans`.`title` as `tour_trans_title`, `tour`.`text` as `tour_text`, `tour`.`title` as `tour_title`, `tours`.*, `translate_en`.`text` as `en_text`, `translate_en`.`title` as `en_title`
FROM `points`
LEFT JOIN `tours_points` ON `tours_points`.`point_id` = `points`.`id`
LEFT JOIN `tours` ON `tours`.`id` = `tours_points`.`tour_id`
LEFT JOIN `translate` as `tour_trans` ON `tours`.`id` = `tour_trans`.`parent_id` and `tour_trans`.`lang_code` = 'en' 
LEFT JOIN `translate` as `tour` ON `tours`.`id` = `tour`.`parent_id` and `tour`.`lang_code` = 'en' 
LEFT JOIN `translate` ON `points`.`id` = `translate`.`parent_id` and `translate`.`lang_code` = 'en' 
LEFT JOIN `translate` as `translate_en` ON `points`.`id` = `translate_en`.`parent_id` and `translate_en`.`lang_code` = 'en' 
LEFT JOIN `img_tours` as `img_t` ON `img_t`.`tour_id` = `tours`.`id`
ERROR - 2019-04-15 09:45:11 --> Could not find the language line "Discount Code"
ERROR - 2019-04-15 10:08:38 --> Severity: error --> Exception: syntax error, unexpected '?>', expecting ',' or ')' C:\server\OSPanel\domains\localhost\tricypolitain.com\application\views\front\paypal.php 172
ERROR - 2019-04-15 10:10:51 --> Severity: error --> Exception: syntax error, unexpected ')', expecting ',' or ';' C:\server\OSPanel\domains\localhost\tricypolitain.com\application\views\front\paypal.php 172
ERROR - 2019-04-15 10:11:05 --> Severity: error --> Exception: syntax error, unexpected ')', expecting ',' or ';' C:\server\OSPanel\domains\localhost\tricypolitain.com\application\views\front\paypal.php 172
ERROR - 2019-04-15 10:11:22 --> Severity: error --> Exception: syntax error, unexpected ')', expecting ',' or ';' C:\server\OSPanel\domains\localhost\tricypolitain.com\application\views\front\paypal.php 172
ERROR - 2019-04-15 10:11:23 --> Severity: error --> Exception: syntax error, unexpected ')', expecting ',' or ';' C:\server\OSPanel\domains\localhost\tricypolitain.com\application\views\front\paypal.php 172
ERROR - 2019-04-15 10:12:23 --> Severity: Notice --> Undefined variable: SERVER C:\server\OSPanel\domains\localhost\tricypolitain.com\application\views\front\paypal.php 171
ERROR - 2019-04-15 10:12:23 --> Severity: Notice --> Undefined variable: SERVER C:\server\OSPanel\domains\localhost\tricypolitain.com\application\views\front\paypal.php 171
ERROR - 2019-04-15 10:12:23 --> Severity: Notice --> Undefined variable: SERVER C:\server\OSPanel\domains\localhost\tricypolitain.com\application\views\front\paypal.php 171
ERROR - 2019-04-15 10:12:23 --> Severity: Notice --> Undefined variable: SERVER C:\server\OSPanel\domains\localhost\tricypolitain.com\application\views\front\paypal.php 171
ERROR - 2019-04-15 10:12:23 --> Severity: Notice --> Undefined variable: SERVER C:\server\OSPanel\domains\localhost\tricypolitain.com\application\views\front\paypal.php 171
ERROR - 2019-04-15 10:12:23 --> Severity: Notice --> Undefined variable: SERVER C:\server\OSPanel\domains\localhost\tricypolitain.com\application\views\front\paypal.php 171
ERROR - 2019-04-15 10:12:23 --> Severity: Notice --> Undefined variable: SERVER C:\server\OSPanel\domains\localhost\tricypolitain.com\application\views\front\paypal.php 171
ERROR - 2019-04-15 10:12:23 --> Severity: Notice --> Undefined variable: SERVER C:\server\OSPanel\domains\localhost\tricypolitain.com\application\views\front\paypal.php 171
ERROR - 2019-04-15 10:12:23 --> Severity: Notice --> Undefined variable: SERVER C:\server\OSPanel\domains\localhost\tricypolitain.com\application\views\front\paypal.php 171
ERROR - 2019-04-15 10:24:36 --> Severity: error --> Exception: Call to undefined function option_value() C:\server\OSPanel\domains\localhost\tricypolitain.com\application\views\front\paypal.php 228
ERROR - 2019-04-15 10:44:47 --> Severity: error --> Exception: syntax error, unexpected '<' C:\server\OSPanel\domains\localhost\tricypolitain.com\application\views\front\paypal.php 244
ERROR - 2019-04-15 10:45:03 --> Severity: error --> Exception: syntax error, unexpected '<' C:\server\OSPanel\domains\localhost\tricypolitain.com\application\views\front\paypal.php 244
ERROR - 2019-04-15 10:45:19 --> Could not find the language line "Discount code accepted"
ERROR - 2019-04-15 10:47:46 --> Could not find the language line "Discount code accepted"
ERROR - 2019-04-15 10:56:54 --> Severity: Notice --> Undefined index: code C:\server\OSPanel\domains\localhost\tricypolitain.com\application\controllers\Manage.php 41
ERROR - 2019-04-15 10:56:54 --> Could not find the language line "Discount code accepted"
ERROR - 2019-04-15 10:57:06 --> Severity: Notice --> Undefined index: code C:\server\OSPanel\domains\localhost\tricypolitain.com\application\controllers\Manage.php 41
ERROR - 2019-04-15 10:57:06 --> Could not find the language line "Discount code accepted"
ERROR - 2019-04-15 10:57:24 --> Query error: Unknown column 'tours.code' in 'field list' - Invalid query: SELECT `tours_orders`.*, `translate`.`title` as `tour`, `tours`.`price` as `price`, `tours`.`code` as `code`, `translate`.`title` as `tour_id`, `users`.`email` as `driver`, `tours_statuses`.`status` as `status`
FROM `tours_orders`
LEFT JOIN `users` ON `users`.`id` = `tours_orders`.`driver_id`
LEFT JOIN `tours_statuses` ON `tours_statuses`.`id` = `tours_orders`.`status_id`
LEFT JOIN `tours` ON `tours`.`id` = `tours_orders`.`tour_id`
LEFT JOIN `translate` ON `translate`.`parent_id` = `tours_orders`.`tour_id` and `translate`.`lang_code` = 'it' and `translate`.`table` = 'tours' 
WHERE `tours_orders`.`id` = '45'
ERROR - 2019-04-15 10:58:48 --> Could not find the language line "Discount code accepted"
ERROR - 2019-04-15 10:59:44 --> Could not find the language line "Discount code accepted"
ERROR - 2019-04-15 10:59:58 --> Could not find the language line "Discount code accepted"
ERROR - 2019-04-15 11:00:12 --> Could not find the language line "Discount code accepted"
ERROR - 2019-04-15 11:03:03 --> Could not find the language line "Discount code accepted"
ERROR - 2019-04-15 11:04:11 --> Could not find the language line "Discount code accepted"
ERROR - 2019-04-15 11:04:44 --> Could not find the language line "Discount code accepted"
ERROR - 2019-04-15 11:04:46 --> Could not find the language line "Discount code accepted"
ERROR - 2019-04-15 11:05:25 --> Could not find the language line "Discount code accepted"
ERROR - 2019-04-15 11:05:43 --> Could not find the language line "Discount code accepted"
ERROR - 2019-04-15 11:06:53 --> Could not find the language line "Discount code accepted"
ERROR - 2019-04-15 11:07:08 --> Could not find the language line "Discount code accepted"
ERROR - 2019-04-15 11:07:17 --> Could not find the language line "Discount code accepted"
ERROR - 2019-04-15 11:07:33 --> Could not find the language line "Discount code accepted"
ERROR - 2019-04-15 11:07:35 --> Could not find the language line "Discount code accepted"
ERROR - 2019-04-15 11:07:58 --> Could not find the language line "Discount code accepted"
ERROR - 2019-04-15 11:08:17 --> Could not find the language line "Discount code accepted"
ERROR - 2019-04-15 11:08:19 --> Could not find the language line "Discount code accepted"
ERROR - 2019-04-15 11:12:31 --> Could not find the language line "Discount code accepted"
ERROR - 2019-04-15 11:12:40 --> Could not find the language line "Discount code accepted"
ERROR - 2019-04-15 11:14:07 --> Could not find the language line "Discount code accepted"
ERROR - 2019-04-15 11:32:40 --> Could not find the language line "Discount Code"
ERROR - 2019-04-15 11:34:51 --> Could not find the language line "Discount Code"
ERROR - 2019-04-15 11:37:03 --> Could not find the language line "Discount code accepted"
ERROR - 2019-04-15 11:47:17 --> Could not find the language line "Discount Code"
ERROR - 2019-04-15 11:47:35 --> Could not find the language line "Discount code accepted"
ERROR - 2019-04-15 11:50:10 --> Could not find the language line "Discount code accepted"
ERROR - 2019-04-15 20:00:49 --> Could not find the language line "I agree terms of user"
ERROR - 2019-04-15 20:01:53 --> Could not find the language line "I agree terms of user"
ERROR - 2019-04-15 20:02:48 --> Could not find the language line "I agree terms of user"
ERROR - 2019-04-15 20:03:15 --> Could not find the language line "I agree terms of user"
ERROR - 2019-04-15 20:06:33 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\server\OSPanel\domains\localhost\tricypolitain.com\application\language\en\front_lang.php:56) C:\server\OSPanel\domains\localhost\tricypolitain.com\system\core\Common.php 574
ERROR - 2019-04-15 20:06:33 --> Severity: Parsing Error --> syntax error, unexpected end of file C:\server\OSPanel\domains\localhost\tricypolitain.com\application\language\en\front_lang.php 56
ERROR - 2019-04-15 20:06:44 --> Severity: Parsing Error --> syntax error, unexpected 'foreach' (T_FOREACH) C:\server\OSPanel\domains\localhost\tricypolitain.com\application\views\front\form.php 171
ERROR - 2019-04-15 20:07:09 --> Severity: Parsing Error --> syntax error, unexpected 'foreach' (T_FOREACH) C:\server\OSPanel\domains\localhost\tricypolitain.com\application\views\front\form.php 171
ERROR - 2019-04-15 20:07:18 --> Could not find the language line "I agree terms of user"
ERROR - 2019-04-15 20:07:43 --> Could not find the language line "I agree terms of user"
ERROR - 2019-04-15 20:08:09 --> Could not find the language line "I agree terms of user"
ERROR - 2019-04-15 20:08:48 --> Could not find the language line "I agree terms of user"
ERROR - 2019-04-15 20:09:15 --> Could not find the language line "I agree terms of user"
ERROR - 2019-04-15 20:09:36 --> Could not find the language line "I agree terms of user"
ERROR - 2019-04-15 20:14:05 --> Could not find the language line "I agree terms of user"
ERROR - 2019-04-15 20:15:08 --> Could not find the language line "I agree terms of user"
ERROR - 2019-04-15 20:15:33 --> Could not find the language line "I agree terms of user"
ERROR - 2019-04-15 20:15:48 --> Could not find the language line "I agree terms of user"
