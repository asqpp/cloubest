<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2025-11-11 20:32:18 --> 404 Page Not Found: ../modules/dashboard/controllers//index
ERROR - 2025-11-11 20:32:47 --> Query error: Unknown column 'r.role_name' in 'field list' - Invalid query: SELECT `u`.*, `r`.`role_name`
FROM `users` `u`
LEFT JOIN `roles` `r` ON `r`.`role_id` = `u`.`role_id`
WHERE `u`.`email` = 'admin@example.com'
AND `u`.`is_active` = 1
 LIMIT 1
ERROR - 2025-11-11 20:36:55 --> Query error: Unknown column 'full_name' in 'field list' - Invalid query: INSERT INTO `users` (`username`, `email`, `full_name`, `password`, `role_id`, `company_id`, `is_active`, `created_at`) VALUES ('adm', 'nafixerpsolution@gmail.com', 'NA-FIX ERP SOLUTION', '$2y$10$iPUODhw.MGMQVZYYlNfnSuwKaqsZv1ACIlZuz0r/Ldedvw.16SVJK', 2, 1, 1, '2025-11-11 20:36:55')
ERROR - 2025-11-11 20:39:44 --> 404 Page Not Found: ../modules/dashboard/controllers//index
ERROR - 2025-11-11 20:39:49 --> 404 Page Not Found: /index
