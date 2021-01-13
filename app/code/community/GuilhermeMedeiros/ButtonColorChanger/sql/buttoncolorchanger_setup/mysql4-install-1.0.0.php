<?php
$installer = $this;
$installer->startSetup();

$installer->run("
    CREATE TABLE IF NOT EXISTS `buttoncolorchanger_rules` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
        `color` varchar(6) NOT NULL,
        `type` int(8) unsigned NOT NULL,
        `date_from` datetime,
        `date_to` datetime,
        `day_week` varchar(255),
        `description` text NULL,
        `created_at` datetime NOT NULL,
        `updated_at` datetime NOT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
    ");
$installer->endSetup();
