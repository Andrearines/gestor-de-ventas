CREATE TABLE `roles` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(255)
);

CREATE TABLE `users` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(255),
  `password` varchar(255),
  `role_id` int,
  `active` boolean
);

CREATE TABLE `events` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(255),
  `code` varchar(255) UNIQUE,
  `school_name` varchar(255),
  `start_date` date,
  `end_date` date,
  `status` varchar(255)
);

CREATE TABLE `restaurants` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(255),
  `contact_info` varchar(255)
);

CREATE TABLE `event_restaurants` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `event_id` int,
  `restaurant_id` int
);

CREATE TABLE `teams` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(255),
  `event_id` int
);

CREATE TABLE `team_members` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `team_id` int,
  `user_id` int,
  `owner_id` int
);

CREATE TABLE `tickets` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `event_id` int,
  `number` int,
  `status` varchar(255),
  `assigned_to` int
);

CREATE TABLE `combos` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(255),
  `description` text,
  `price` decimal
);

CREATE TABLE `event_combos` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `event_id` int,
  `combo_id` int,
  `price_override` decimal
);

CREATE TABLE `sales` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `user_id` int,
  `event_id` int,
  `ticket_id` int,
  `combo_id` int,
  `amount` decimal,
  `sale_date` datetime
);

CREATE TABLE `reservations` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `sale_id` int,
  `customer_name` varchar(255),
  `status` varchar(255)
);

CREATE TABLE `offline_sales` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `local_uuid` varchar(255),
  `payload` json,
  `synced` boolean
);

CREATE TABLE `system_logs` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `type` varchar(255),
  `message` text,
  `model` varchar(255),
  `model_id` int,
  `created_at` datetime
);

ALTER TABLE `users` ADD FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

ALTER TABLE `teams` ADD FOREIGN KEY (`event_id`) REFERENCES `events` (`id`);

ALTER TABLE `team_members` ADD FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`);

ALTER TABLE `team_members` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

ALTER TABLE `event_restaurants` ADD FOREIGN KEY (`event_id`) REFERENCES `events` (`id`);

ALTER TABLE `event_restaurants` ADD FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`id`);

ALTER TABLE `tickets` ADD FOREIGN KEY (`event_id`) REFERENCES `events` (`id`);

ALTER TABLE `tickets` ADD FOREIGN KEY (`assigned_to`) REFERENCES `users` (`id`);

ALTER TABLE `sales` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

ALTER TABLE `sales` ADD FOREIGN KEY (`event_id`) REFERENCES `events` (`id`);

ALTER TABLE `sales` ADD FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`);

ALTER TABLE `sales` ADD FOREIGN KEY (`combo_id`) REFERENCES `combos` (`id`);

ALTER TABLE `event_combos` ADD FOREIGN KEY (`event_id`) REFERENCES `events` (`id`);

ALTER TABLE `event_combos` ADD FOREIGN KEY (`combo_id`) REFERENCES `combos` (`id`);

ALTER TABLE `reservations` ADD FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`);

ALTER TABLE `users` ADD FOREIGN KEY (`id`) REFERENCES `team_members` (`owner_id`);
