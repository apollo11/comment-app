/*!999999\- enable the sandbox mode */
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache`
(
    `key`        varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `value`      mediumtext COLLATE utf8mb4_unicode_ci   NOT NULL,
    `expiration` int                                     NOT NULL,
    PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache_locks`
(
    `key`        varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `owner`      varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `expiration` int                                     NOT NULL,
    PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `comment_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comment_types`
(
    `id`         bigint unsigned NOT NULL AUTO_INCREMENT,
    `name`       varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments`
(
    `id`               bigint unsigned NOT NULL AUTO_INCREMENT,
    `commentable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `commentable_id`   bigint unsigned NOT NULL,
    `user_id`          bigint unsigned NOT NULL,
    `comment_type_id`  bigint unsigned NOT NULL,
    `body`             text COLLATE utf8mb4_unicode_ci         NOT NULL,
    `created_at`       timestamp NULL DEFAULT NULL,
    `updated_at`       timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY                `comments_commentable_type_commentable_id_index` (`commentable_type`,`commentable_id`),
    KEY                `comments_user_id_foreign` (`user_id`),
    KEY                `comments_comment_type_id_foreign` (`comment_type_id`),
    CONSTRAINT `comments_comment_type_id_foreign` FOREIGN KEY (`comment_type_id`) REFERENCES `comment_types` (`id`),
    CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs`
(
    `id`         bigint unsigned NOT NULL AUTO_INCREMENT,
    `uuid`       varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `connection` text COLLATE utf8mb4_unicode_ci         NOT NULL,
    `queue`      text COLLATE utf8mb4_unicode_ci         NOT NULL,
    `payload`    longtext COLLATE utf8mb4_unicode_ci     NOT NULL,
    `exception`  longtext COLLATE utf8mb4_unicode_ci     NOT NULL,
    `failed_at`  timestamp                               NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_batches`
(
    `id`             varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `name`           varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `total_jobs`     int                                     NOT NULL,
    `pending_jobs`   int                                     NOT NULL,
    `failed_jobs`    int                                     NOT NULL,
    `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci     NOT NULL,
    `options`        mediumtext COLLATE utf8mb4_unicode_ci,
    `cancelled_at`   int DEFAULT NULL,
    `created_at`     int                                     NOT NULL,
    `finished_at`    int DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs`
(
    `id`           bigint unsigned NOT NULL AUTO_INCREMENT,
    `queue`        varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `payload`      longtext COLLATE utf8mb4_unicode_ci     NOT NULL,
    `attempts`     tinyint unsigned NOT NULL,
    `reserved_at`  int unsigned DEFAULT NULL,
    `available_at` int unsigned NOT NULL,
    `created_at`   int unsigned NOT NULL,
    PRIMARY KEY (`id`),
    KEY            `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations`
(
    `id`        int unsigned NOT NULL AUTO_INCREMENT,
    `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `batch`     int                                     NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reset_tokens`
(
    `email`      varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `token`      varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens`
(
    `id`             bigint unsigned NOT NULL AUTO_INCREMENT,
    `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `tokenable_id`   bigint unsigned NOT NULL,
    `name`           varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `token`          varchar(64) COLLATE utf8mb4_unicode_ci  NOT NULL,
    `abilities`      text COLLATE utf8mb4_unicode_ci,
    `last_used_at`   timestamp NULL DEFAULT NULL,
    `expires_at`     timestamp NULL DEFAULT NULL,
    `created_at`     timestamp NULL DEFAULT NULL,
    `updated_at`     timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
    KEY              `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `photos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `photos`
(
    `id`         bigint unsigned NOT NULL AUTO_INCREMENT,
    `user_id`    bigint unsigned NOT NULL,
    `title`      varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `image_url`  varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY          `photos_user_id_foreign` (`user_id`),
    CONSTRAINT `photos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts`
(
    `id`          bigint unsigned NOT NULL AUTO_INCREMENT,
    `user_id`     bigint unsigned NOT NULL,
    `title`       varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `description` text COLLATE utf8mb4_unicode_ci         NOT NULL,
    `created_at`  timestamp NULL DEFAULT NULL,
    `updated_at`  timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY           `posts_user_id_foreign` (`user_id`),
    CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions`
(
    `id`            varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `user_id`       bigint unsigned DEFAULT NULL,
    `ip_address`    varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `user_agent`    text COLLATE utf8mb4_unicode_ci,
    `payload`       longtext COLLATE utf8mb4_unicode_ci     NOT NULL,
    `last_activity` int                                     NOT NULL,
    PRIMARY KEY (`id`),
    KEY             `sessions_user_id_index` (`user_id`),
    KEY             `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users`
(
    `id`                bigint unsigned NOT NULL AUTO_INCREMENT,
    `name`              varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `email`             varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `email_verified_at` timestamp NULL DEFAULT NULL,
    `password`          varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `remember_token`    varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `created_at`        timestamp NULL DEFAULT NULL,
    `updated_at`        timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `videos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `videos`
(
    `id`         bigint unsigned NOT NULL AUTO_INCREMENT,
    `user_id`    bigint unsigned NOT NULL,
    `title`      varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `video_url`  text COLLATE utf8mb4_unicode_ci         NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY          `videos_user_id_foreign` (`user_id`),
    CONSTRAINT `videos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

/*!999999\- enable the sandbox mode */
INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES (4, '0001_01_01_000000_create_users_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES (5, '0001_01_01_000001_create_cache_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES (6, '0001_01_01_000002_create_jobs_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES (7, '2025_01_16_180536_create_personal_access_tokens_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES (13, '2025_01_16_191138_create_posts_table', 2);
INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES (14, '2025_01_16_193108_create_videos_table', 2);
INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES (15, '2025_01_16_194834_create_photos_table', 2);
INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES (16, '2025_01_16_195755_create_comment_types_table', 2);
INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES (17, '2025_01_16_195756_create_comments_table', 2);