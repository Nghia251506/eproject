-- DDL
create database eproject;
use eproject;

create table users (
	id int auto_increment not null primary key,
    name varchar(255),
	email varchar(255),
    phone varchar(20),
    address varchar(255),
    date_of_birth date,
    username varchar(255),
    password varchar(255),
    role ENUM('admin', 'employee', 'customer')
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
    type_name varchar(255)
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
    description LONGTEXT,
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
    price_subtotal decimal(10,2),
    foreign key(order_id) references sale_order(id),
    foreign key(product_id) references products(id)
);

-- PROCEDURE insert
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
    IN prod_image_url VARCHAR(500),
    IN prod_description LONGTEXT
)
BEGIN
    -- Chèn sản phẩm mới
    INSERT INTO products (name, type_id, watt, socket, color, purchase_price, sale_price, quantity, brand_id, image_url, description) 
    VALUES (prod_name, prod_type_id, prod_watt, prod_socket, prod_color, prod_purchase_price, prod_sale_price, prod_quantity, prod_brand_id, prod_image_url, prod_description);
  
    -- Lấy id vừa chèn
    SET @last_id = LAST_INSERT_ID();
  
    -- Cập nhật code cho sản phẩm dựa trên id
    UPDATE products 
    SET code = CONCAT('PROD-', LPAD(@last_id, 5, '0'))
    WHERE id = @last_id;
END //
DELIMITER ;

-- DML
-- insert brand_lights
insert into brand_lights (`id`, `brand_name`) values (1, "Philips");
insert into brand_lights (`id`, `brand_name`) values (2, "Osram");
insert into brand_lights (`id`, `brand_name`) values (3, "Panasonic");
insert into brand_lights (`id`, `brand_name`) values (4, "Cree");
insert into brand_lights (`id`, `brand_name`) values (5, "General Electric");
insert into brand_lights (`id`, `brand_name`) values (6, "Acuity Brands");
insert into brand_lights (`id`, `brand_name`) values (7, "Zumtobel");
insert into brand_lights (`id`, `brand_name`) values (8, "FLOS");
insert into brand_lights (`id`, `brand_name`) values (9, "Artemide");
insert into brand_lights (`id`, `brand_name`) values (10, "Louis Poulsen");
-- insert type_lights
insert into type_lights (`id`, `type_name`) values (1, "Chandelier");
insert into type_lights (`id`, `type_name`) values (2, "Table Lamp");
insert into type_lights (`id`, `type_name`) values (3, "Recessed Lighting");
insert into type_lights (`id`, `type_name`) values (4, "Floor Lamp");
insert into type_lights (`id`, `type_name`) values (5, "Flush Mount Light");
insert into type_lights (`id`, `type_name`) values (6, "Wall Sconce");
insert into type_lights (`id`, `type_name`) values (7, "FPendant Light");
insert into type_lights (`id`, `type_name`) values (8, "LED Strip Light");
insert into type_lights (`id`, `type_name`) values (9, "Floodlight");
insert into type_lights (`id`, `type_name`) values (10, "Spotlight");
-- insert products test
CALL insert_product('product1', 1, 30, 'E27', 'red', 32000000, 47000000, 23, 2, 'https://denanhsang.vn/uploaded/images/kho-hinh-anh-dep-chum-dep-tai-den-anh-sang-17.jpg', 'Mô tả: Đèn chùm là biểu tượng của sự sang trọng và phong cách, thường xuất hiện trong các không gian nội thất cao cấp như phòng khách, phòng ăn hoặc sảnh lớn. Với thiết kế đa dạng, từ cổ điển đến hiện đại, đèn chùm có thể đi kèm nhiều bóng đèn và pha lê, tạo nên vẻ đẹp lung linh và ấn tượng. Đèn chùm không chỉ cung cấp ánh sáng chính mà còn đóng vai trò như một tác phẩm nghệ thuật, nâng cao giá trị thẩm mỹ của ngôi nhà.');
CALL insert_product('product2', 2, 30, 'E27', 'red', 32000000, 47000000, 23, 2, 'https://vuongquocden.vn/images/2018/06/12/den-chum-pha-le-nen-sang-trong_20LDH1010.jpg', 'Mô tả: Đèn bàn là sự kết hợp hoàn hảo giữa chức năng và thẩm mỹ. Với thiết kế nhỏ gọn và đa dạng về kiểu dáng, đèn bàn không chỉ giúp chiếu sáng một khu vực cụ thể như bàn làm việc, bàn học hay bàn trang điểm mà còn là một vật trang trí đầy phong cách. Các loại đèn bàn hiện đại thường có chế độ điều chỉnh ánh sáng để phù hợp với nhu cầu đọc sách, làm việc hay thư giãn.');
CALL insert_product('product3', 1, 30, 'E27', 'red', 32000000, 47000000, 23, 2, 'https://tuyetlights.com/Uploads/793/images/H%C3%ACnh%20D%E1%BB%B1%20%C3%81n%20Th%E1%BB%B1c%20T%E1%BA%BF/%C4%90%C3%A8n%20Trang%20Tr%C3%AD/den-chum-pha-le-du-an-so-8.jpg', 'Mô tả: Đèn chùm là biểu tượng của sự sang trọng và phong cách, thường xuất hiện trong các không gian nội thất cao cấp như phòng khách, phòng ăn hoặc sảnh lớn. Với thiết kế đa dạng, từ cổ điển đến hiện đại, đèn chùm có thể đi kèm nhiều bóng đèn và pha lê, tạo nên vẻ đẹp lung linh và ấn tượng. Đèn chùm không chỉ cung cấp ánh sáng chính mà còn đóng vai trò như một tác phẩm nghệ thuật, nâng cao giá trị thẩm mỹ của ngôi nhà.');
CALL insert_product('product4', 2, 30, 'E27', 'red', 32000000, 47000000, 23, 2, 'https://salt.tikicdn.com/cache/280x280/ts/product/52/f2/1d/468ef93ef92a34e678c05fa5b62d7c70.jpg', 'Mô tả: Đèn bàn là sự kết hợp hoàn hảo giữa chức năng và thẩm mỹ. Với thiết kế nhỏ gọn và đa dạng về kiểu dáng, đèn bàn không chỉ giúp chiếu sáng một khu vực cụ thể như bàn làm việc, bàn học hay bàn trang điểm mà còn là một vật trang trí đầy phong cách. Các loại đèn bàn hiện đại thường có chế độ điều chỉnh ánh sáng để phù hợp với nhu cầu đọc sách, làm việc hay thư giãn.');
CALL insert_product('product5', 1, 30, 'E27', 'red', 32000000, 47000000, 23, 2, 'https://vuongquocsofa.com/images/2021/06/10/1-vi-sao-can-trang-tri-den-phong-khach-1.jpg', 'Mô tả: Đèn chùm là biểu tượng của sự sang trọng và phong cách, thường xuất hiện trong các không gian nội thất cao cấp như phòng khách, phòng ăn hoặc sảnh lớn. Với thiết kế đa dạng, từ cổ điển đến hiện đại, đèn chùm có thể đi kèm nhiều bóng đèn và pha lê, tạo nên vẻ đẹp lung linh và ấn tượng. Đèn chùm không chỉ cung cấp ánh sáng chính mà còn đóng vai trò như một tác phẩm nghệ thuật, nâng cao giá trị thẩm mỹ của ngôi nhà.');
CALL insert_product('product6', 3, 30, 'E27', 'red', 32000000, 47000000, 23, 1, 'https://down-vn.img.susercontent.com/file/vn-11134201-23030-b8vbtdu65fov46', 'Mô tả: Đèn âm trần được thiết kế để lắp đặt chìm vào trần nhà, mang đến vẻ gọn gàng và tinh tế cho không gian. Loại đèn này tạo ra ánh sáng lan tỏa đều khắp căn phòng mà không làm chiếm diện tích không gian. Đèn âm trần thường có ánh sáng dịu nhẹ, thích hợp cho những ngôi nhà hiện đại, tối giản. Một số mẫu đèn âm trần có thể điều chỉnh hướng chiếu sáng, giúp tập trung ánh sáng vào các khu vực cần thiết.');
CALL insert_product('product7', 4, 30, 'E27', 'red', 32000000, 47000000, 23, 1, 'https://khodengiare.com/wp-content/uploads/2021/06/Den-chum-pha-le-DC414-5.jpg', 'Mô tả: Đèn sàn là một trong những giải pháp chiếu sáng linh hoạt nhất, không chỉ cung cấp ánh sáng mà còn giúp trang trí không gian một cách tinh tế. Với thiết kế đứng cao, đèn sàn có thể dễ dàng di chuyển và đặt ở bất kỳ góc nào trong phòng để cung cấp ánh sáng phụ trợ. Nhiều mẫu đèn sàn hiện đại có thể điều chỉnh độ cao và hướng chiếu sáng, phù hợp với nhiều mục đích sử dụng khác nhau từ đọc sách đến trang trí nội thất.');
CALL insert_product('product8', 2, 30, 'E27', 'red', 32000000, 47000000, 23, 3, 'https://virgolighting.vn/uploaded/san-pham/Den-chum-bong-led-zone-pha-le/Den-chum-bong-led-zone-pha-le%20(7).jpg', 'Mô tả: Đèn bàn là sự kết hợp hoàn hảo giữa chức năng và thẩm mỹ. Với thiết kế nhỏ gọn và đa dạng về kiểu dáng, đèn bàn không chỉ giúp chiếu sáng một khu vực cụ thể như bàn làm việc, bàn học hay bàn trang điểm mà còn là một vật trang trí đầy phong cách. Các loại đèn bàn hiện đại thường có chế độ điều chỉnh ánh sáng để phù hợp với nhu cầu đọc sách, làm việc hay thư giãn.');
CALL insert_product('product9', 5, 30, 'E27', 'red', 32000000, 47000000, 23, 5, 'https://khodengiare.com/wp-content/uploads/2022/08/Den-chum-pha-le-tha-phong-khach-DC515D-4.jpg', 'Mô tả: Đèn ốp trần là lựa chọn lý tưởng cho các căn phòng có trần thấp. Đèn được lắp sát vào trần nhà, mang đến ánh sáng mạnh và đều khắp phòng. Thiết kế này giúp tiết kiệm không gian, tạo nên vẻ thanh lịch và hiện đại cho ngôi nhà. Đèn ốp trần thường có các thiết kế đơn giản nhưng tinh tế, dễ dàng hòa hợp với các phong cách nội thất khác nhau.');
CALL insert_product('product10', 3, 30, 'E27', 'red', 32000000, 47000000, 23, 4, 'https://virgolighting.vn/uploaded/san-pham/Den-chum-bong-led-zone-pha-le/Den-chum-bong-led-zone-pha-le%20(1).jpg', 'Mô tả: Đèn âm trần được thiết kế để lắp đặt chìm vào trần nhà, mang đến vẻ gọn gàng và tinh tế cho không gian. Loại đèn này tạo ra ánh sáng lan tỏa đều khắp căn phòng mà không làm chiếm diện tích không gian. Đèn âm trần thường có ánh sáng dịu nhẹ, thích hợp cho những ngôi nhà hiện đại, tối giản. Một số mẫu đèn âm trần có thể điều chỉnh hướng chiếu sáng, giúp tập trung ánh sáng vào các khu vực cần thiết.');
CALL insert_product('product11', 5, 30, 'E27', 'red', 32000000, 47000000, 23, 5, 'https://fuhouse.vn/uploads/images/tin-tuc/den-chum-1_result.jpg', 'Mô tả: Đèn ốp trần là lựa chọn lý tưởng cho các căn phòng có trần thấp. Đèn được lắp sát vào trần nhà, mang đến ánh sáng mạnh và đều khắp phòng. Thiết kế này giúp tiết kiệm không gian, tạo nên vẻ thanh lịch và hiện đại cho ngôi nhà. Đèn ốp trần thường có các thiết kế đơn giản nhưng tinh tế, dễ dàng hòa hợp với các phong cách nội thất khác nhau.');
CALL insert_product('product12', 1, 30, 'E27', 'red', 32000000, 47000000, 23, 3, 'https://virgolighting.vn/uploaded/san-pham/den-tha-pha-le-chum-la-vang-dong/den-tha-pha-le-chum-la-vang-dong%20(6).jpg', 'Mô tả: Đèn chùm là biểu tượng của sự sang trọng và phong cách, thường xuất hiện trong các không gian nội thất cao cấp như phòng khách, phòng ăn hoặc sảnh lớn. Với thiết kế đa dạng, từ cổ điển đến hiện đại, đèn chùm có thể đi kèm nhiều bóng đèn và pha lê, tạo nên vẻ đẹp lung linh và ấn tượng. Đèn chùm không chỉ cung cấp ánh sáng chính mà còn đóng vai trò như một tác phẩm nghệ thuật, nâng cao giá trị thẩm mỹ của ngôi nhà.');
-- insert users test
insert into users(`name`,`email`,`phone`,`address`,`date_of_birth`,`username`,`password`,`role`) values ('Nguyễn Trọng Nghĩa','ntn8530@gmail.com','0862273012','Hà Nội','2002-06-15','tnc2002','Ntn1506@','admin');
insert into users(`name`,`email`,`phone`,`address`,`date_of_birth`,`username`,`password`,`role`) values ('Phan Anh Tiến Quý','ad1@gmail.com','0123456789','Hà Nội','1995-06-15','ad1','123456','admin');
insert into users(`name`,`email`,`phone`,`address`,`date_of_birth`,`username`,`password`,`role`) values ('Nguyễn Văn A','cs1@gmail.com','0123456789','Hà Nội','1995-06-15','cs1','123456','customer');




