create database eproject;
use eproject;

create table permisions(
	id int auto_increment not null primary key,
    name varchar(255)
);

create table users (
	id int auto_increment not null primary key,
    name varchar(255),
	email varchar(255),
    phone varchar(20),
    address varchar(255),
    date_of_birth date,
    username varchar(255),
    password varchar(255),
    department_id int not null,
    foreign key(department_id) references permisions(id)
);

create table customers(
	id int auto_increment not null primary key,
	name varchar(255),
    address varchar(255),
    phone_number varchar(255),
    score float,
    is_vip boolean
);

create table brand_lights(
	id int auto_increment not null primary key,
    brand_name varchar(255)
);

create table type_lights(
	id int auto_increment not null primary key,
    type_name varchar(255),
    type varchar(255),
    color varchar(255),
	material varchar(255)
);

create table products(
	id int auto_increment not null primary key,
    name varchar(255),
    code varchar(50),
	type_id int not null,
    watt int,
    socket varchar(255),
    color varchar(50),
    purchase_price decimal(10,2),
    sale_price decimal(10,2),
    quantity int,
    brand_id int,
    image_url varchar(500),
    foreign key(type_id) references type_lights(id),
    foreign key(brand_id) references brand_lights(id)
);

create table sale_order(
	id int auto_increment not null primary key,
    name varchar(255),
	customer_id int,
    create_date date,
    user_id int,
    foreign key(customer_id) references customers(id),
    foreign key(user_id) references users(id)
);

create table sale_order_line(
	id int auto_increment not null primary key,
    order_id int,
    product_id int,
    price float,
    quantity int,
    price_subtotal float,
    foreign key(order_id) references sale_order(id),
    foreign key(product_id) references products(id)
);

-- trigger
DELIMITER //
CREATE PROCEDURE insert_product(
    IN prod_name VARCHAR(255),
    IN prod_type_id INT,
    IN prod_watt INT,
    IN prod_socket VARCHAR(255), 
    IN prod_color VARCHAR(50), 
    IN prod_purchase_price DECIMAL(10,2), 
    IN prod_sale_price DECIMAL(10,2), 
    IN prod_quantity INT, 
    IN prod_brand_id INT, 
    IN prod_image_url VARCHAR(500)
)
BEGIN
    -- Chèn sản phẩm mới
    INSERT INTO products (name, type_id, watt, socket, color, purchase_price, sale_price, quantity, brand_id, image_url) 
    VALUES (prod_name, prod_type_id, prod_watt, prod_socket, prod_color, prod_purchase_price, prod_sale_price, prod_quantity, prod_brand_id, prod_image_url);
  
    -- Lấy id vừa chèn
    SET @last_id = LAST_INSERT_ID();
  
    -- Cập nhật code cho sản phẩm dựa trên id
    UPDATE products 
    SET code = CONCAT('PROD-', LPAD(@last_id, 5, '0'))
    WHERE id = @last_id;
END //
DELIMITER ;
DROP PROCEDURE IF EXISTS insert_product;

DROP TRIGGER IF EXISTS after_insert_product;

-- DML
-- insert brand_lights
insert into brand_lights (`id`, `brand_name`) values (2, "abc");
insert into brand_lights (`id`, `brand_name`) values (1, "acb");
insert into brand_lights (`id`, `brand_name`) values (3, "b");
insert into brand_lights (`id`, `brand_name`) values (4, "c");
insert into brand_lights (`id`, `brand_name`) values (5, "d");
-- insert type_lights
insert into type_lights (`id`, `type_name`) values (1, "abc");
insert into type_lights (`id`, `type_name`) values (2, "acb");
insert into type_lights (`id`, `type_name`) values (3, "b");
insert into type_lights (`id`, `type_name`) values (4, "c");
insert into type_lights (`id`, `type_name`) values (5, "d");
-- insert products test
CALL insert_product('product1', 1, 30, 'E27', 'red', 32000000, 47000000, 23, 2, 'https://denanhsang.vn/uploaded/images/kho-hinh-anh-dep-chum-dep-tai-den-anh-sang-17.jpg');
CALL insert_product('product2', 1, 30, 'E27', 'red', 32000000, 47000000, 23, 2, 'https://vuongquocden.vn/images/2018/06/12/den-chum-pha-le-nen-sang-trong_20LDH1010.jpg');
CALL insert_product('product3', 1, 30, 'E27', 'red', 32000000, 47000000, 23, 2, 'https://tuyetlights.com/Uploads/793/images/H%C3%ACnh%20D%E1%BB%B1%20%C3%81n%20Th%E1%BB%B1c%20T%E1%BA%BF/%C4%90%C3%A8n%20Trang%20Tr%C3%AD/den-chum-pha-le-du-an-so-8.jpg');
CALL insert_product('product4', 1, 30, 'E27', 'red', 32000000, 47000000, 23, 2, 'https://salt.tikicdn.com/cache/280x280/ts/product/52/f2/1d/468ef93ef92a34e678c05fa5b62d7c70.jpg');
CALL insert_product('product5', 1, 30, 'E27', 'red', 32000000, 47000000, 23, 2, 'https://vuongquocsofa.com/images/2021/06/10/1-vi-sao-can-trang-tri-den-phong-khach-1.jpg');
delete from products where id = 11;
-- , "product2","product3","product4","product5"




