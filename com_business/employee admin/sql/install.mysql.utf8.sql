
CREATE TABLE `#__business_employees` ( 
    `id` INT(11) NOT NULL AUTO_INCREMENT , 
    `title` VARCHAR(255) NOT NULL , 
    `alias` VARCHAR(400) NOT NULL , 
    `short_description` MEDIUMTEXT NOT NULL , 
    `description` TEXT NOT NULL , 
    `image` TEXT NOT NULL , 
    `category` INT(11) NOT NULL , 
    `priority` VARCHAR(255) NOT NULL , 
    `privacy` VARCHAR(255) NOT NULL , 
    `created_by` INT(11) NOT NULL , 
    `modified_by` INT(11) NOT NULL , 
    `created_date` DATETIME NOT NULL , 
    `modified_date` DATETIME NOT NULL , 
    `state` TINYINT(1) NOT NULL , 
    `checked_out` INT(11) NOT NULL , 
    `checked_out_time` DATETIME NOT NULL , 
    `ordering` INT(11) NOT NULL , 
    PRIMARY KEY (`id`)
) ENGINE = InnoDB CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci;


CREATE TABLE `#__business_companies` ( 
    `id` INT(11) NOT NULL AUTO_INCREMENT , 
    `name` VARCHAR(255) NOT NULL , 
    `description` TEXT NOT NULL , 
    `established_by` VARCHAR(255) NOT NULL , 
    `establishment` DATETIME NOT NULL , 
    `company_type` VARCHAR(255) NOT NULL , 
    `created_by` INT(11) NOT NULL , 
    `modified_by` INT(11) NOT NULL , 
    `created_date` DATETIME NOT NULL , 
    `modified_date` DATETIME NOT NULL , 
    `state` TINYINT(1) NOT NULL , 
    `checked_out` INT(11) NOT NULL , 
    `checked_out_time` DATETIME NOT NULL , 
    `ordering` INT(11) NOT NULL , 
    PRIMARY KEY (`id`)) ENGINE = InnoDB CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci;