CREATE TABLE parts (
    `partID` INT(10)UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `partName` VARCHAR(100) NOT NULL,
    `partNumber` VARCHAR(15) NOT NULL,
    `suppliers` VARCHAR(15),
    `category` VARCHAR(50),
    `description01` VARCHAR(200),
    `description02` VARCHAR(200),
    `description03` VARCHAR(200),
    `description04` VARCHAR(200),
    `description05` VARCHAR(200),
    `description06` VARCHAR(200),
    `price` FLOAT(6,2),
    `estimatedShippingCost` FLOAT(4,2),
    `associatedImageFilename1` VARCHAR(100),
    `associatedImageFilename2` VARCHAR(100),
    `associatedImageFilename3` VARCHAR(100),
    `associatedImageFilename4` VARCHAR(100),
    `notes` VARCHAR(100),
    `shippingWeight` INT(4)
);

CREATE TABLE members (
    `id` INT(20)UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `firstname` VARCHAR(30) NOT NULL,
    `lastname` VARCHAR(30) NOT NULL,
    `country` VARCHAR(30) NOT NULL,
    `state` VARCHAR(30) NOT NULL,
    `city` VARCHAR(30) NOT NULL,
    `street` VARCHAR(30) NOT NULL,
    `zipcode` INT(20) NOT NULL,
    `password` VARCHAR(50) NOT NULL,
    `privilege` VARCHAR(10) NOT NULL
);

CREATE TABLE orders (
    `order_number` INT(15) NOT NULL PRIMARY KEY,
    `total_price` FLOAT(8,2) NOT NULL,
    `num_items` INT(5) NOT NULL,
    `item_id` VARCHAR(50) NOT NULL,
    `user_id` INT(10) NOT NULL,
    `order_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE UPSGroundWeightZonePrice (
    `weight` INT(3),
    `zone2` FLOAT(7,2),
    `zone3` FLOAT(7,2),
    `zone4` FLOAT(7,4),
    `zone5` FLOAT(7,2),
    `zone6` FLOAT(7,2),
    `zone7` FLOAT(7,4),
    `zone8` FLOAT(7,2)
);

CREATE TABLE ZiptoState (
    `StateName` VARCHAR(50),
    `StateAbrv` VARCHAR(2),
    `LowZip` INT(6),
    `HighZip` INT(6)
);

CREATE TABLE ZiptoZone (
    `LowZip` INT(5),
    `HighZip` INT(5),
    `ZoneGround` INT(11)
);