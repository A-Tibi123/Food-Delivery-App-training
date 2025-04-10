CREATE TABLE `carrier` (
	`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`currency_id` INT(11) UNSIGNED NOT NULL,
	`tax_id` INT(11) UNSIGNED NULL DEFAULT NULL,
	`position` INT(4) UNSIGNED NOT NULL DEFAULT '0',
	`is_free` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
	`active` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
    `deleted` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
	`max_width` INT(10) UNSIGNED NOT NULL DEFAULT '0',
	`max_height` INT(10) UNSIGNED NOT NULL DEFAULT '0',
	`max_depth` INT(10) UNSIGNED NOT NULL DEFAULT '0',
	`max_weight` DECIMAL(20,6) UNSIGNED NOT NULL DEFAULT '0.000000',
	`price` DECIMAL(20,6) UNSIGNED NOT NULL DEFAULT '0.000000',
	`name` VARCHAR(254) NOT NULL,
	`description` TEXT NULL DEFAULT NULL,
	`created_at` DATETIME NOT NULL,
	`updated_at` TIMESTAMP NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
	PRIMARY KEY (`id`),
	INDEX `active_deleted` (`active`, `deleted`),
	INDEX `currency_id` (`currency_id`)
)
COLLATE='utf8mb4_unicode_ci'
ENGINE=InnoDB;


CREATE TABLE `cart` (
	`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`currency_id` INT(11) UNSIGNED NOT NULL,
	`client_id` INT(11) UNSIGNED NULL DEFAULT NULL,
	`address_invoice` INT(11) UNSIGNED NULL DEFAULT NULL,
	`address_delivery` INT(11) UNSIGNED NULL DEFAULT NULL,
	`carrier_id` INT(11) UNSIGNED NULL DEFAULT NULL,
	`payment_id` INT(11) UNSIGNED NULL DEFAULT NULL,
	`total_products` DECIMAL(20,6) UNSIGNED NOT NULL DEFAULT '0.000000',
	`total_taxes` DECIMAL(20,6) UNSIGNED NOT NULL DEFAULT '0.000000',
	`total_discounts` DECIMAL(20,6) UNSIGNED NOT NULL DEFAULT '0.000000',
	`total_delivery` DECIMAL(20,6) UNSIGNED NOT NULL DEFAULT '0.000000',
	`total` DECIMAL(20,6) UNSIGNED NOT NULL DEFAULT '0.000000',
	`active` TINYINT(1) UNSIGNED NOT NULL DEFAULT '1',
	`identifier` VARCHAR(32) NOT NULL,
	`client_name` VARCHAR(254) NULL DEFAULT NULL,
	`client_email` VARCHAR(254) NULL DEFAULT NULL,
	`client_phone` VARCHAR(32) NULL DEFAULT NULL,
	`created_at` DATETIME NOT NULL,
	`updated_at` TIMESTAMP NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
	PRIMARY KEY (`id`),
	UNIQUE INDEX `client` (`client_id`, `identifier`),
	INDEX `currency_id` (`currency_id`),
	INDEX `address_invoice` (`address_invoice`),
	INDEX `address_delivery` (`address_delivery`),
	INDEX `carrier_id` (`carrier_id`),
	INDEX `payment_id` (`payment_id`),
	INDEX `active` (`active`)
)
COLLATE='utf8mb4_unicode_ci'
ENGINE=InnoDB;

CREATE TABLE `cart_product` (
	`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`cart_id` INT(11) UNSIGNED NOT NULL,
	`product_id` INT(11) UNSIGNED NOT NULL,
	`tax_id` INT(11) UNSIGNED NULL DEFAULT NULL,
	`quantity` INT(11) UNSIGNED NOT NULL DEFAULT '1',
	`price` DECIMAL(20,6) UNSIGNED NOT NULL DEFAULT '0.000000',
	`green_tax` DECIMAL(14,6) UNSIGNED NOT NULL DEFAULT '0.000000',
	`identifier` VARCHAR(32) NOT NULL,
	`created_at` DATETIME NOT NULL,
	`updated_at` TIMESTAMP NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
	PRIMARY KEY (`id`),
	UNIQUE INDEX `cart_identifier` (`cart_id`, `identifier`),
	INDEX `cart_id` (`cart_id`),
	INDEX `product_id` (`product_id`)
)
COLLATE='utf8mb4_unicode_ci'
ENGINE=InnoDB;

CREATE TABLE `category` (
	`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`parent_id` INT(11) UNSIGNED NOT NULL DEFAULT '0',
	`position` INT(4) UNSIGNED NOT NULL DEFAULT '0',
	`file_type` VARCHAR(5) NULL DEFAULT NULL,
	`active` TINYINT(1) UNSIGNED NOT NULL DEFAULT '1',
	`title` VARCHAR(254) NOT NULL,
	`description` MEDIUMTEXT NULL DEFAULT NULL,
	PRIMARY KEY (`id`)
)
COLLATE='utf8mb4_unicode_ci'
ENGINE=InnoDB;



CREATE TABLE `country` (
	`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`iso_code` VARCHAR(3) NOT NULL,
	`name` VARCHAR(254) NOT NULL,
	`call_prefix` INT(11) UNSIGNED NOT NULL DEFAULT '0',
	`zip_code_format` VARCHAR(12) NOT NULL DEFAULT '',
	`need_zip_code` TINYINT(1) UNSIGNED NOT NULL DEFAULT '1',
	`active` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
	`contains_states` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
	PRIMARY KEY (`id`),
	UNIQUE INDEX `iso_code` (`iso_code`)
)
COLLATE='utf8mb4_unicode_ci'
ENGINE=InnoDB;



CREATE TABLE `currency` (
	`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(254) NOT NULL,
	`code` VARCHAR(3) NOT NULL,
	`numerical_code` INT(4) NOT NULL,
	`sign` VARCHAR(3) NOT NULL,
	`active` TINYINT(1) UNSIGNED NOT NULL DEFAULT '1',
	`is_default` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
	PRIMARY KEY (`id`),
	UNIQUE INDEX `code` (`code`),
	UNIQUE INDEX `idx_currency_numerical_code` (`numerical_code`)
)
COLLATE='utf8mb4_unicode_ci'
ENGINE=InnoDB;



CREATE TABLE `currency_rate` (
	`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`reference_currency_id` INT(11) UNSIGNED NOT NULL,
	`currency_id` INT(11) UNSIGNED NOT NULL,
	`valability_date` DATE NOT NULL,
	`conversion_rate` DECIMAL(20,6) UNSIGNED NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE INDEX `currency_id_valability_date` (`currency_id`, `valability_date`),
	INDEX `reference_currency_id` (`reference_currency_id`),
	INDEX `valability_date` (`valability_date`)
)
COLLATE='utf8mb4_unicode_ci'
ENGINE=InnoDB;

CREATE TABLE `language` (
	`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(32) NOT NULL,
	`iso_code` VARCHAR(2) NOT NULL,
	`language_code` VARCHAR(5) NOT NULL,
	`date_format_lite` VARCHAR(32) NOT NULL DEFAULT 'Y-m-d',
	`date_format_full` VARCHAR(32) NOT NULL DEFAULT 'Y-m-d H:i:s',
	`display_order` INT(11) UNSIGNED NOT NULL DEFAULT '0',
	`active` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
	`is_rtl` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
	PRIMARY KEY (`id`),
	UNIQUE INDEX `iso_code` (`iso_code`),
	INDEX `order` (`display_order`)
)
COLLATE='utf8mb4_unicode_ci'
ENGINE=InnoDB;

CREATE TABLE `manufacturer` (
	`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`active` TINYINT(1) UNSIGNED NOT NULL DEFAULT '1',
	`file_type` VARCHAR(5) NULL DEFAULT NULL,
	`name` VARCHAR(254) NOT NULL,
	`description` MEDIUMTEXT NULL DEFAULT NULL,
	`created_at` DATETIME NOT NULL,
	`updated_at` TIMESTAMP NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
	PRIMARY KEY (`id`),
	INDEX `active` (`active`),
	INDEX `brand_id` (`brand_id`)
)
COLLATE='utf8mb4_unicode_ci'
ENGINE=InnoDB;



CREATE TABLE `order` (
	`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`currency_id` INT(11) UNSIGNED NOT NULL,
	`cart_id` INT(11) UNSIGNED NULL DEFAULT NULL,
	`client_id` INT(11) UNSIGNED NULL DEFAULT NULL,
	`address_invoice` INT(11) UNSIGNED NULL DEFAULT NULL,
	`address_delivery` INT(11) UNSIGNED NULL DEFAULT NULL,
	`carrier_id` INT(11) UNSIGNED NULL DEFAULT NULL,
	`payment_id` INT(11) UNSIGNED NULL DEFAULT NULL,
	`order_status_id` INT(11) UNSIGNED NULL DEFAULT NULL,
	`total_products` DECIMAL(20,6) UNSIGNED NOT NULL DEFAULT '0.000000',
	`total_taxes` DECIMAL(20,6) UNSIGNED NOT NULL DEFAULT '0.000000',
	`total_discounts` DECIMAL(20,6) UNSIGNED NOT NULL DEFAULT '0.000000',
	`total_delivery` DECIMAL(20,6) UNSIGNED NOT NULL DEFAULT '0.000000',
	`total` DECIMAL(20,6) UNSIGNED NOT NULL DEFAULT '0.000000',
	`client_name` VARCHAR(254) NULL DEFAULT NULL,
	`client_email` VARCHAR(254) NULL DEFAULT NULL,
	`client_phone` VARCHAR(32) NULL DEFAULT NULL,
	`created_at` DATETIME NOT NULL,
	`updated_at` TIMESTAMP NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
	PRIMARY KEY (`id`),
	INDEX `currency_id` (`currency_id`),
	INDEX `cart_id` (`cart_id`),
	INDEX `client` (`client_id`),
	INDEX `address_invoice` (`address_invoice`),
	INDEX `address_delivery` (`address_delivery`),
	INDEX `carrier_id` (`carrier_id`),
	INDEX `order_status_id` (`order_status_id`),
	INDEX `payment_id` (`payment_id`)
)
COLLATE='utf8mb4_unicode_ci'
ENGINE=InnoDB;

CREATE TABLE `order_address` (
	`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`order_id` INT(11) UNSIGNED NOT NULL,
	`country_id` INT(11) UNSIGNED NOT NULL,
	`state_id` INT(11) UNSIGNED NULL DEFAULT NULL,
	`client_address_id` INT(11) UNSIGNED NOT NULL,
	`district` TINYINT(1) UNSIGNED NULL DEFAULT NULL,
	`city` VARCHAR(64) NOT NULL,
	`street` VARCHAR(254) NOT NULL,
	`street_nb` VARCHAR(32) NULL DEFAULT NULL,
	`other` VARCHAR(254) NULL DEFAULT NULL,
	`postcode` VARCHAR(12) NULL DEFAULT NULL,
	`pj_pf` ENUM('pf','pj') NOT NULL DEFAULT 'pf',
	`company_name` VARCHAR(254) NULL DEFAULT NULL,
	`cui` VARCHAR(16) NULL DEFAULT NULL,
	`nr_reg` VARCHAR(16) NULL DEFAULT NULL,
	`bank` VARCHAR(64) NULL DEFAULT NULL,
	`iban` VARCHAR(64) NULL DEFAULT NULL,
	`observations` TEXT NULL DEFAULT NULL,
	`created_at` DATETIME NOT NULL,
	`updated_at` TIMESTAMP NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
	PRIMARY KEY (`id`),
	INDEX `order_id` (`order_id`),
	INDEX `country_state` (`country_id`, `state_id`),
	INDEX `district` (`district`),
	INDEX `client_address_id` (`client_address_id`)
)
COLLATE='utf8mb4_unicode_ci'
ENGINE=InnoDB;

CREATE TABLE `order_product` (
	`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`order_id` INT(11) UNSIGNED NOT NULL,
	`product_id` INT(11) UNSIGNED NOT NULL,
	`tax_id` INT(11) UNSIGNED NULL DEFAULT NULL,
	`quantity` INT(11) UNSIGNED NOT NULL DEFAULT '1',
	`price` DECIMAL(20,6) UNSIGNED NOT NULL DEFAULT '0.000000',
	`green_tax` DECIMAL(14,6) UNSIGNED NOT NULL DEFAULT '0.000000',
	`product_name` VARCHAR(254) NULL DEFAULT NULL,
	`created_at` DATETIME NOT NULL,
	`updated_at` TIMESTAMP NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
	PRIMARY KEY (`id`),
	UNIQUE INDEX `order_product` (`order_id`, `product_id`),
	INDEX `order_id` (`order_id`),
	INDEX `product_id` (`product_id`),
	INDEX `client_product_id` (`client_product_id`)
)
COLLATE='utf8mb4_unicode_ci'
ENGINE=InnoDB;

CREATE TABLE `order_status` (
	`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`active` TINYINT(1) UNSIGNED NOT NULL DEFAULT '1',
	`name` VARCHAR(254) NOT NULL,
	`color` VARCHAR(16) NULL DEFAULT NULL,
	`validated` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
	`invoiced` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
	`shipped` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
	`finalised` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
	`created_at` DATETIME NOT NULL,
	`updated_at` TIMESTAMP NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
	PRIMARY KEY (`id`),
	INDEX `active` (`active`),
	INDEX `validated` (`validated`),
	INDEX `invoiced` (`invoiced`),
	INDEX `shipped` (`shipped`),
	INDEX `finalised` (`finalised`)
)
COLLATE='utf8mb4_unicode_ci'
ENGINE=InnoDB;



CREATE TABLE `payment` (
	`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`code` VARCHAR(16) NOT NULL,
	`name` VARCHAR(254) NOT NULL,
	`description` TEXT NULL DEFAULT NULL,
	`is_prepay` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
	`active` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
	`position` INT(3) UNSIGNED NOT NULL DEFAULT '0',
	`created_at` DATETIME NOT NULL,
	`updated_at` TIMESTAMP NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
	PRIMARY KEY (`id`),
	UNIQUE INDEX `code` (`code`),
	INDEX `active` (`active_for_order`),
	INDEX `is_prepay` (`is_prepay`),
	INDEX `position` (`position`)
)
COLLATE='utf8mb4_unicode_ci'
ENGINE=InnoDB;



CREATE TABLE `product` (
	`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`manufacturer_id` INT(11) UNSIGNED NULL DEFAULT NULL,
	`category_id` INT(11) UNSIGNED NULL DEFAULT NULL,
	`tax_id` INT(11) UNSIGNED NULL DEFAULT NULL,
	`currency_id` INT(11) UNSIGNED NOT NULL,
	`file_type` VARCHAR(5) NULL DEFAULT NULL,
	`active` TINYINT(1) UNSIGNED NOT NULL DEFAULT '1',
	`available_for_order` TINYINT(1) UNSIGNED NOT NULL DEFAULT '1',
	`display_price` TINYINT(1) UNSIGNED NOT NULL DEFAULT '1',
	`price` DECIMAL(20,6) UNSIGNED NOT NULL DEFAULT '0.000000',
	`green_tax` DECIMAL(14,6) UNSIGNED NOT NULL DEFAULT '0.000000',
	`reference` VARCHAR(32) NOT NULL,
	`manufacturer_reference` VARCHAR(32) NULL DEFAULT NULL,
	`ean13` VARCHAR(32) NULL DEFAULT NULL,
	`weight` FLOAT UNSIGNED NULL DEFAULT NULL,
	`title` VARCHAR(254) NOT NULL,
	`short_description` MEDIUMTEXT NULL DEFAULT NULL,
	`description` MEDIUMTEXT NULL DEFAULT NULL,
	`created_at` DATETIME NOT NULL,
	`updated_at` TIMESTAMP NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
	PRIMARY KEY (`id`),
	UNIQUE INDEX `reference` (`reference`),
	UNIQUE INDEX `manufacturer_reference` (`manufacturer_reference`),
	UNIQUE INDEX `ean13` (`ean13`),
	INDEX `manufacturer_id` (`manufacturer_id`),
	INDEX `default_category_id` (`default_category_id`),
	INDEX `tax_id` (`tax_id`),
	INDEX `currency_id` (`currency_id`),
	INDEX `active` (`active`)
)
COLLATE='utf8mb4_unicode_ci'
ENGINE=InnoDB;



CREATE TABLE `state` (
	`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`country_id` INT(11) UNSIGNED NOT NULL,
	`name` VARCHAR(64) NOT NULL,
	`iso_code` VARCHAR(7) NOT NULL,
	`active` TINYINT(1) NOT NULL DEFAULT '0',
	PRIMARY KEY (`id`),
	INDEX `country_id` (`country_id`),
	INDEX `name` (`name`)
)
COLLATE='utf8mb4_unicode_ci'
ENGINE=InnoDB;

CREATE TABLE `tax` (
	`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`rate` INT(3) UNSIGNED NOT NULL DEFAULT '0',
	`name` VARCHAR(128) NOT NULL,
	`created_at` DATETIME NOT NULL,
	`updated_at` TIMESTAMP NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
	PRIMARY KEY (`id`)
)
COLLATE='utf8mb4_unicode_ci'
ENGINE=InnoDB;



CREATE TABLE `client` (
	`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`default_address_id` INT(11) UNSIGNED NULL DEFAULT NULL,
	`email` VARCHAR(254) NOT NULL,
	`firstname` VARCHAR(254) NOT NULL,
	`lastname` VARCHAR(254) NOT NULL,
	`sex` ENUM('F','M') NULL DEFAULT NULL,
	`phone` VARCHAR(32) NULL DEFAULT NULL,
	`birth_date` DATE NULL DEFAULT NULL,
	`status` SMALLINT(6) NOT NULL DEFAULT '10',
	`auth_key` VARCHAR(32) NULL DEFAULT NULL,
	`password_hash` VARCHAR(254) NULL DEFAULT NULL,
	`password_reset_token` VARCHAR(254) NULL DEFAULT NULL,
	`created_at` DATETIME NOT NULL,
	`updated_at` TIMESTAMP NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
	PRIMARY KEY (`id`),
	UNIQUE INDEX `email` (`email`),
	UNIQUE INDEX `password_reset_token` (`password_reset_token`),
	UNIQUE INDEX `auth_key` (`auth_key`)
)
COLLATE='utf8mb4_unicode_ci'
ENGINE=InnoDB;

CREATE TABLE `client_address` (
	`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`client_id` INT(11) UNSIGNED NOT NULL,
	`country_id` INT(11) UNSIGNED NOT NULL,
	`state_id` INT(11) UNSIGNED NULL DEFAULT NULL,
	`active` TINYINT(1) UNSIGNED NOT NULL DEFAULT '1',
	`district` TINYINT(1) UNSIGNED NULL DEFAULT NULL,
	`city` VARCHAR(64) NOT NULL,
	`street` VARCHAR(254) NOT NULL,
	`street_nb` VARCHAR(32) NULL DEFAULT NULL,
	`other` VARCHAR(254) NULL DEFAULT NULL,
	`postcode` VARCHAR(12) NULL DEFAULT NULL,
	`pj_pf` ENUM('pf','pj') NOT NULL DEFAULT 'pf',
	`company_name` VARCHAR(254) NULL DEFAULT NULL,
	`cui` VARCHAR(16) NULL DEFAULT NULL,
	`nr_reg` VARCHAR(16) NULL DEFAULT NULL,
	`bank` VARCHAR(64) NULL DEFAULT NULL,
	`iban` VARCHAR(64) NULL DEFAULT NULL,
	`observations` TEXT NULL DEFAULT NULL,
    `website_address_id` INT(11) UNSIGNED NULL DEFAULT NULL,
	`created_at` DATETIME NOT NULL,
	`updated_at` TIMESTAMP NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
	PRIMARY KEY (`id`),
	UNIQUE INDEX `website_address_id` (`website_address_id`),
	INDEX `client_active` (`client_id`, `active`),
	INDEX `country_state` (`country_id`, `state_id`),
	INDEX `district` (`district`)
)
COLLATE='utf8mb4_unicode_ci'
ENGINE=InnoDB;
