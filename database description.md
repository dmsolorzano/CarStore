## Working with the database

### Access the database

####      $servername = "earth.cs.utep.edu";
####      $username = "fgarciayala";
####      $password = "cs5339!fgarciayala";
####      $database = "fgarciayala";
---
### Queries to work with the database

#### Display car parts
```mysql
SELECT "columns to be displayed" FROM parts where something = "filter" order by "sorting" ASC;
```

#### Find a customer
```mysql
SELECT * FROM members where  something = "filter";
```

#### Find price
```mysql
SELECT price FROM parts where something = "filter";
```

#### Insert customer
```mysql
INSERT INTO members (id, firstname, lastname, country, state, city, street, zipcode, password, privilege) VALUES();
```
---
### Tables descriptions

#### mysql> describe members;

| Field     | Type             | Null | Key | Default | Extra          |
|-----------|:----------------:|:----:|:---:|:-------:|:--------------:|
| id        | int(20) unsigned | NO   | PRI | NULL    | auto_increment |
| firstname | varchar(30)      | NO   |     | NULL    |                |
| lastname  | varchar(30)      | NO   |     | NULL    |                |
| country   | varchar(30)      | NO   |     | NULL    |                |
| state     | varchar(30)      | NO   |     | NULL    |                |
| city      | varchar(30)      | NO   |     | NULL    |                |
| street    | varchar(30)      | NO   |     | NULL    |                |
| zipcode   | int(20)          | NO   |     | NULL    |                |
| password  | varchar(50)      | NO   |     | NULL    |                |
| privilege | varchar(10)      | NO   |     | NULL    |                |


#### mysql> describe orders;

| Field        | Type        | Null | Key | Default           | Extra |
|--------------|:-----------:|:----:|:---:|:-----------------:|:-----:|
| order_number | int(15)     | NO   | PRI | NULL              |       |
| total_price  | float(8,2)  | NO   |     | NULL              |       |
| num_items    | int(5)      | NO   |     | NULL              |       |
| item_id      | varchar(50) | NO   |     | NULL              |       |
| user_id      | int(10)     | NO   |     | NULL              |       |
| order_time   | timestamp   | NO   |     | CURRENT_TIMESTAMP |       |

#### mysql> describe parts;

| Field                    | Type             | Null | Key | Default | Extra          |
|--------------------------|------------------|------|-----|---------|----------------|
| partID                   | int(10) unsigned | NO   | PRI | NULL    | auto_increment |
| partName                 | varchar(100)     | NO   |     | NULL    |                |
| partNumber               | varchar(15)      | NO   |     | NULL    |                |
| suppliers                | varchar(15)      | YES  |     | NULL    |                |
| category                 | varchar(50)      | YES  |     | NULL    |                |
| description01            | varchar(200)     | YES  |     | NULL    |                |
| description02            | varchar(200)     | YES  |     | NULL    |                |
| description03            | varchar(200)     | YES  |     | NULL    |                |
| description04            | varchar(200)     | YES  |     | NULL    |                |
| description05            | varchar(200)     | YES  |     | NULL    |                |
| description06            | varchar(200)     | YES  |     | NULL    |                |
| price                    | float(6,2)       | YES  |     | NULL    |                |
| estimatedShippingCost    | float(4,2)       | YES  |     | NULL    |                |
| associatedImageFilename1 | varchar(100)     | YES  |     | NULL    |                |
| associatedImageFilename2 | varchar(100)     | YES  |     | NULL    |                |
| associatedImageFilename3 | varchar(100)     | YES  |     | NULL    |                |
| associatedImageFilename4 | varchar(100)     | YES  |     | NULL    |                |
| notes                    | varchar(100)     | YES  |     | NULL    |                |
| shippingWeight           | int(4)           | YES  |     | NULL    |                |

#### mysql> describe UPSGroundWeightZonePrice;

| Field  | Type       | Null | Key | Default | Extra |
|--------|------------|------|-----|---------|-------|
| weight | int(3)     | YES  |     | NULL    |       |
| zone2  | float(7,2) | YES  |     | NULL    |       |
| zone3  | float(7,2) | YES  |     | NULL    |       |
| zone4  | float(7,4) | YES  |     | NULL    |       |
| zone5  | float(7,2) | YES  |     | NULL    |       |
| zone6  | float(7,2) | YES  |     | NULL    |       |
| zone7  | float(7,4) | YES  |     | NULL    |       |
| zone8  | float(7,2) | YES  |     | NULL    |       |


#### mysql> describe ZiptoState;

| Field     | Type        | Null | Key | Default | Extra |
|-----------|-------------|------|-----|---------|-------|
| StateName | varchar(50) | YES  |     | NULL    |       |
| StateAbrv | varchar(2)  | YES  |     | NULL    |       |
| LowZip    | int(6)      | YES  |     | NULL    |       |
| HighZip   | int(6)      | YES  |     | NULL    |       |



#### mysql> describe ZiptoZone;

| Field      | Type    | Null | Key | Default | Extra |
|------------|---------|------|-----|---------|-------|
| LowZip     | int(5)  | YES  |     | NULL    |       |
| HighZip    | int(5)  | YES  |     | NULL    |       |
| ZoneGround | int(11) | YES  |     | NULL    |       |



---
