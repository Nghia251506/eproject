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
    name varchar(255)
);

create table type_lights(
	id int auto_increment not null primary key,
    name varchar(255),
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
    purchase_price float,
    sale_price float,
    quantity int,
    brand_id int,
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
CREATE PROCEDURE insert_product(IN prod_name VARCHAR(255), IN prod_price DECIMAL(10,2))
BEGIN
  -- Chèn sản phẩm mới
  INSERT INTO products (name, price) VALUES (prod_name, prod_price);
  
  -- Lấy id vừa chèn
  SET @last_id = LAST_INSERT_ID();
  
  -- Cập nhật code cho sản phẩm dựa trên id
  UPDATE products 
  SET code = CONCAT('PROD-', LPAD(@last_id, 5, '0'))
  WHERE id = @last_id;
END //
DELIMITER ;

DROP TRIGGER IF EXISTS generate_product_code;

-- DML
insert into type_lights (`id`, `type_name`) values (2, "acs");
desc products;

