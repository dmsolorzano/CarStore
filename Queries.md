## Queries to work with the database
### to access te datatbase
### - servername: earth.cs.utep.edu
### - username: fgarciayala
### - password: cs5339!fgarciayala
### - database: fgarciayala


### Display car parts
```mysql
SELECT * FROM parts where something = "filter";
```
---
### Find a custumer
```mysql
SELECT * FROM members where  something = "filter";
```
---
### Find price
```mysql
SELECT price FROM parts where something = "filter";
```
---
### Insert custumer
```mysql
INSERT INTO members (id, firstname, lastname, country, state, city, street, zipcode, password, privilege) VALUES();
```
---
####
mysql> describe members;
+-----------+------------------+------+-----+---------+----------------+
| Field     | Type             | Null | Key | Default | Extra          |
+-----------+------------------+------+-----+---------+----------------+
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
+-----------+------------------+------+-----+---------+----------------+
---

mysql> describe orders;
+--------------+-------------+------+-----+-------------------+-------+
| Field        | Type        | Null | Key | Default           | Extra |
+--------------+-------------+------+-----+-------------------+-------+
| order_number | int(15)     | NO   | PRI | NULL              |       |
| total_price  | float(8,2)  | NO   |     | NULL              |       |
| num_items    | int(5)      | NO   |     | NULL              |       |
| item_id      | varchar(50) | NO   |     | NULL              |       |
| user_id      | int(10)     | NO   |     | NULL              |       |
| order_time   | timestamp   | NO   |     | CURRENT_TIMESTAMP |       |
+--------------+-------------+------+-----+-------------------+-------+
