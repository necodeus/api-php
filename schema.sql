CREATE TABLE `b_categories` (
  `id` char(36) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci

CREATE TABLE `b_comments` (
  `id` varchar(34) NOT NULL,
  `data` text NOT NULL,
  `content_id` varchar(34) NOT NULL,
  `account_id_author` varchar(34) NOT NULL,
  `created_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci

CREATE TABLE `b_post_ratings` (
  `user_hash` char(32) NOT NULL,
  `post_id` int(11) NOT NULL,
  `rating` tinyint(4) NOT NULL,
  PRIMARY KEY (`user_hash`,`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci

CREATE TABLE `b_post_ratings_summary` (
  `post_id` int(11) NOT NULL,
  `average` float NOT NULL,
  `count` int(11) NOT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci

CREATE TABLE `b_posts` (
  `id` char(36) NOT NULL,
  `title` varchar(512) DEFAULT NULL,
  `teaser` varchar(1024) DEFAULT NULL,
  `main_image_id` char(36) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `editor_account_id` char(36) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `publisher_account_id` char(36) DEFAULT NULL,
  `published_at` datetime DEFAULT NULL,
  `category_id` char(36) DEFAULT NULL,
  `tags` varchar(256) DEFAULT NULL,
  `is_commentable` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci

CREATE TABLE `b_tags` (
  `id` char(36) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci

CREATE TABLE `c_contents` (
  `id` char(36) NOT NULL,
  `title` varchar(64) DEFAULT NULL,
  `teaser` varchar(256) DEFAULT NULL,
  `image_id_main` char(36) DEFAULT NULL,
  `cached_fragments` text DEFAULT NULL,
  `account_id_editor` char(36) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `account_id_publisher` char(36) NOT NULL,
  `published_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci

CREATE TABLE `c_contents_fragments` (
  `id` char(36) NOT NULL,
  `content_id` char(36) NOT NULL,
  `fragment_id` char(36) NOT NULL,
  `order` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci

CREATE TABLE `c_fragments` (
  `id` char(36) NOT NULL,
  `type` varchar(36) NOT NULL,
  `data` text NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `account_id_author` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci

CREATE TABLE `c_images` (
  `id` char(36) NOT NULL,
  `type` varchar(36) NOT NULL,
  `local_path` varchar(255) NOT NULL,
  `remote_path` varchar(255) NOT NULL,
  `resolution_x` int(11) DEFAULT NULL,
  `resolution_y` int(11) DEFAULT NULL,
  `size` bigint(20) DEFAULT NULL,
  `mime_type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci

CREATE TABLE `c_navigation_tree` (
  `id` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci

CREATE TABLE `c_navigations` (
  `id` char(36) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci

CREATE TABLE `c_pages` (
  `id` char(36) NOT NULL,
  `method` varchar(36) NOT NULL,
  `slug` varchar(2048) NOT NULL,
  `status_code` int(11) NOT NULL,
  `content_type` varchar(36) NOT NULL,
  `content_id` char(36) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `extra_data` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci

CREATE TABLE `c_redirections` (
  `id` char(36) NOT NULL,
  `link` varchar(512) DEFAULT NULL,
  `code` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci

CREATE TABLE `c_resources` (
  `id` char(36) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci

CREATE TABLE `c_setting_groups` (
  `id` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci

CREATE TABLE `c_setting_items` (
  `id` char(36) NOT NULL,
  `nav_group_id` char(36) DEFAULT NULL,
  `parent_id` char(36) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci

CREATE TABLE `f_categories` (
  `id` char(36) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci

CREATE TABLE `f_category_tree` (
  `id` char(36) NOT NULL,
  `lp` int(11) DEFAULT NULL,
  `rp` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `resource_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci

CREATE TABLE `f_posts` (
  `id` char(36) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci

CREATE TABLE `f_threads` (
  `id` char(36) NOT NULL,
  `lp` int(11) DEFAULT NULL,
  `rp` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci

CREATE TABLE `s_complaints` (
  `id` char(36) NOT NULL,
  `order_id` char(36) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `reason` varchar(2048) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `account_id_creator` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci

CREATE TABLE `s_coupons` (
  `id` char(36) NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `account_id_creator` char(36) DEFAULT NULL,
  `discount_type` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci

CREATE TABLE `s_couriers` (
  `id` char(36) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci

CREATE TABLE `s_deliveries` (
  `id` char(36) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci

CREATE TABLE `s_discount_types` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `value` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci

CREATE TABLE `s_invoices` (
  `id` char(36) NOT NULL,
  `order_id` char(36) DEFAULT NULL,
  `local_path` varchar(255) DEFAULT NULL,
  `remote_path` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `generated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci

CREATE TABLE `s_order_products` (
  `id` char(36) NOT NULL,
  `order_id` char(36) DEFAULT NULL,
  `product_id` char(36) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci

CREATE TABLE `s_orders` (
  `id` char(36) NOT NULL,
  `account_id_customer` varchar(255) DEFAULT NULL,
  `calculated_price` decimal(10,2) DEFAULT NULL,
  `ordered_at` datetime DEFAULT NULL,
  `payment_created_at` datetime DEFAULT NULL,
  `payment_paid_at` datetime DEFAULT NULL,
  `shipment_created_at` datetime DEFAULT NULL,
  `shipment_shipped_at` datetime DEFAULT NULL,
  `invoice_created_at` datetime DEFAULT NULL,
  `invoice_generated_at` datetime DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci

CREATE TABLE `s_parcel_lockers` (
  `id` char(36) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci

CREATE TABLE `s_payment_providers` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci

CREATE TABLE `s_payments` (
  `id` char(36) NOT NULL,
  `order_id` char(36) DEFAULT NULL,
  `payment_provider_id` char(36) DEFAULT NULL,
  `value` double DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `paid_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci

CREATE TABLE `s_product_attributes` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci

CREATE TABLE `s_product_categories` (
  `id` char(36) NOT NULL,
  `product_id` char(36) DEFAULT NULL,
  `category_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci

CREATE TABLE `s_products` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `dimension_x` double DEFAULT NULL,
  `dimension_y` double DEFAULT NULL,
  `dimension_z` double DEFAULT NULL,
  `weight` double DEFAULT NULL,
  `gtin` varchar(255) DEFAULT NULL,
  `brand` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci

CREATE TABLE `s_returns` (
  `id` char(36) NOT NULL,
  `order_id` char(36) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `reason` varchar(2048) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci

CREATE TABLE `s_reviews` (
  `id` char(36) NOT NULL,
  `product_id` char(36) DEFAULT NULL,
  `account_id_reviewer` char(36) DEFAULT NULL,
  `rating` tinyint(1) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci

CREATE TABLE `s_shipments` (
  `id` char(36) NOT NULL,
  `order_id` char(36) DEFAULT NULL,
  `shipping_provider_id` char(36) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `shipped_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci

CREATE TABLE `s_shipping_providers` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci

CREATE TABLE `s_streets` (
  `id` char(36) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci

CREATE TABLE `u_accounts` (
  `id` varchar(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `is_verified` tinyint(1) NOT NULL,
  `authkey_id` char(36) DEFAULT 'DEFAULT',
  `role_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `index2` (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci

CREATE TABLE `u_authorizations` (
  `id` varchar(36) NOT NULL,
  `account_id` varchar(36) NOT NULL,
  `type` varchar(256) NOT NULL,
  `key` varchar(1024) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci

CREATE TABLE `u_profiles` (
  `id` char(36) NOT NULL,
  `account_id` char(36) NOT NULL,
  `display_name` varchar(255) NOT NULL,
  `bio` varchar(4096) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `image_id_avatar` char(36) DEFAULT NULL,
  `image_id_background` char(36) DEFAULT NULL,
  `link_id` char(36) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci

CREATE TABLE `u_roles` (
  `id` char(36) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci

CREATE TABLE `u_sessions` (
  `id` char(36) NOT NULL,
  `account_id` char(36) DEFAULT NULL,
  `key` varchar(255) DEFAULT NULL,
  `ua` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `accessed_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci

CREATE TABLE `u_verifications` (
  `id` char(36) NOT NULL,
  `account_id` char(36) NOT NULL,
  `type` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `verified_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci
