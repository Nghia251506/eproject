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
    role ENUM('admin', 'customer')
);

create table contacts(
	id int auto_increment not null primary key,
	name varchar(255),
    phone_number varchar(255),
    email varchar(255),
    company varchar(255),
    title varchar(255),
    question LONGTEXT
);



create table brand_lights(
	id int auto_increment not null primary key,
    brand_name varchar(255)
);

create table categorys(
	id int auto_increment not null primary key,
    category_name varchar(255)
);

create table type_lights(
	id int auto_increment not null primary key,
    type_name varchar(255),
    category_id int not null,
    foreign key(category_id) references categorys(id)
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

create table orders(
	id int auto_increment not null primary key,
    customer_name varchar(255),
    phone_number varchar(255),
    email varchar(255),
    address varchar(255),
    messenger longtext
);

create table sale_order(
	id int auto_increment not null primary key,
    customer_name varchar(255),
	order_id int,
    create_date date,
    user_id int,
    foreign key(user_id) references users(id)
);

create table sale_order_line(
	id int auto_increment not null primary key,
    order_id int,
    product_id int,
    price float,
    quantity int,
    price_subtotal decimal(10,2),
    foreign key(order_id) references orders(id),
    foreign key(product_id) references products(id)
);

-- PROCEDURE insert and auto build code product
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
-- insert categorys test
insert into categorys (`id`, `category_name`) values (1, "ceiling");
insert into categorys (`id`, `category_name`) values (2, "table");
insert into categorys (`id`, `category_name`) values (3, "wall");
insert into categorys (`id`, `category_name`) values (4, "pendant");
insert into categorys (`id`, `category_name`) values (5, "led");
insert into categorys (`id`, `category_name`) values (6, "outdoor");
insert into categorys (`id`, `category_name`) values (7, "spotlight");
-- insert type_lights
insert into type_lights (`id`, `type_name`,`category_id`) values (1, "Chandelier", "1");
insert into type_lights (`id`, `type_name`,`category_id`) values (2, "Table Lamp","2");
insert into type_lights (`id`, `type_name`,`category_id`) values (3, "Recessed Lighting", "1");
insert into type_lights (`id`, `type_name`,`category_id`) values (4, "Floor Lamp","1");
insert into type_lights (`id`, `type_name`,`category_id`) values (5, "Flush Mount Light","1");
insert into type_lights (`id`, `type_name`,`category_id`) values (6, "Wall Sconce","3");
insert into type_lights (`id`, `type_name`,`category_id`) values (7, "Pendant Light","4");
insert into type_lights (`id`, `type_name`,`category_id`) values (8, "LED Strip Light","5");
insert into type_lights (`id`, `type_name`,`category_id`) values (9, "Floodlight","6");
insert into type_lights (`id`, `type_name`,`category_id`) values (10, "Spotlight","7");
-- insert products test
CALL insert_product('Crystal Chandelier', 1, 30, 'E27', 'red', 32000000, 47000000, 23, 2, 'https://tuyetlights.com/Uploads/793/images/H%C3%ACnh%20D%E1%BB%B1%20%C3%81n%20Th%E1%BB%B1c%20T%E1%BA%BF/%C4%90%C3%A8n%20Trang%20Tr%C3%AD/den-chum-pha-le-du-an-so-8.jpg', 'Chandeliers are a symbol of luxury and style, often appearing in high-end interior spaces such as living rooms, dining rooms or large halls. With diverse designs, from classic to modern, chandeliers can come with many bulbs and crystals, creating a sparkling and impressive beauty. Chandeliers not only provide the main light but also act as a work of art, enhancing the aesthetic value of the house.');
CALL insert_product('Elegant Table Lamp', 2, 30, 'E27', 'red', 32000000, 47000000, 23, 2, 'https://fuhouse.vn/uploads/images/tin-tuc/den-ban-1_result.jpg', 'Mô tả: Đèn bàn là sự kết hợp hoàn hảo giữa chức năng và thẩm mỹ. Với thiết kế nhỏ gọn và đa dạng về kiểu dáng, đèn bàn không chỉ giúp chiếu sáng một khu vực cụ thể như bàn làm việc, bàn học hay bàn trang điểm mà còn là một vật trang trí đầy phong cách. Các loại đèn bàn hiện đại thường có chế độ điều chỉnh ánh sáng để phù hợp với nhu cầu đọc sách, làm việc hay thư giãn.');
CALL insert_product('Luxury Chandelier', 1, 30, 'E27', 'red', 32000000, 47000000, 23, 2, 'https://tuyetlights.com/Uploads/793/images/H%C3%ACnh%20D%E1%BB%B1%20%C3%81n%20Th%E1%BB%B1c%20T%E1%BA%BF/%C4%90%C3%A8n%20Trang%20Tr%C3%AD/den-chum-pha-le-du-an-so-8.jpg', 'Mô tả: Đèn chùm là biểu tượng của sự sang trọng và phong cách, thường xuất hiện trong các không gian nội thất cao cấp như phòng khách, phòng ăn hoặc sảnh lớn. Với thiết kế đa dạng, từ cổ điển đến hiện đại, đèn chùm có thể đi kèm nhiều bóng đèn và pha lê, tạo nên vẻ đẹp lung linh và ấn tượng. Đèn chùm không chỉ cung cấp ánh sáng chính mà còn đóng vai trò như một tác phẩm nghệ thuật, nâng cao giá trị thẩm mỹ của ngôi nhà.');
CALL insert_product('Modern Table Lamp', 2, 30, 'E27', 'red', 32000000, 47000000, 23, 2, 'https://catihome.com/wp-content/uploads/2023/03/NX57.jpeg', 'Mô tả: Đèn bàn là sự kết hợp hoàn hảo giữa chức năng và thẩm mỹ. Với thiết kế nhỏ gọn và đa dạng về kiểu dáng, đèn bàn không chỉ giúp chiếu sáng một khu vực cụ thể như bàn làm việc, bàn học hay bàn trang điểm mà còn là một vật trang trí đầy phong cách. Các loại đèn bàn hiện đại thường có chế độ điều chỉnh ánh sáng để phù hợp với nhu cầu đọc sách, làm việc hay thư giãn.');
CALL insert_product('Classic Chandelier', 1, 30, 'E27', 'red', 32000000, 47000000, 23, 2, 'https://www.worldclasslighting.com/pictures/largepict/RL%201911-146.jpg', 'Mô tả: Đèn chùm là biểu tượng của sự sang trọng và phong cách, thường xuất hiện trong các không gian nội thất cao cấp như phòng khách, phòng ăn hoặc sảnh lớn. Với thiết kế đa dạng, từ cổ điển đến hiện đại, đèn chùm có thể đi kèm nhiều bóng đèn và pha lê, tạo nên vẻ đẹp lung linh và ấn tượng. Đèn chùm không chỉ cung cấp ánh sáng chính mà còn đóng vai trò như một tác phẩm nghệ thuật, nâng cao giá trị thẩm mỹ của ngôi nhà.');
CALL insert_product('Sleek Recessed Lighting', 3, 30, 'E27', 'red', 32000000, 47000000, 23, 1, 'https://www.beeslighting.com/cdn/shop/files/S11876_Satco-Lighting-01.default.jpg?v=1718023453&width=2048', 'Mô tả: Đèn âm trần được thiết kế để lắp đặt chìm vào trần nhà, mang đến vẻ gọn gàng và tinh tế cho không gian. Loại đèn này tạo ra ánh sáng lan tỏa đều khắp căn phòng mà không làm chiếm diện tích không gian. Đèn âm trần thường có ánh sáng dịu nhẹ, thích hợp cho những ngôi nhà hiện đại, tối giản. Một số mẫu đèn âm trần có thể điều chỉnh hướng chiếu sáng, giúp tập trung ánh sáng vào các khu vực cần thiết.');
CALL insert_product('Versatile Floor Lamp', 4, 30, 'E27', 'red', 32000000, 47000000, 23, 1, 'https://www.relaxhouse.com.au/blog/wp-content/uploads/2024/02/Yellow-floor-lamp-1024x668.png', 'Mô tả: Đèn sàn là một trong những giải pháp chiếu sáng linh hoạt nhất, không chỉ cung cấp ánh sáng mà còn giúp trang trí không gian một cách tinh tế. Với thiết kế đứng cao, đèn sàn có thể dễ dàng di chuyển và đặt ở bất kỳ góc nào trong phòng để cung cấp ánh sáng phụ trợ. Nhiều mẫu đèn sàn hiện đại có thể điều chỉnh độ cao và hướng chiếu sáng, phù hợp với nhiều mục đích sử dụng khác nhau từ đọc sách đến trang trí nội thất.');
CALL insert_product('Beautiful Table Lamp', 2, 30, 'E27', 'red', 32000000, 47000000, 23, 3, 'https://tongkhodenngu.com/wp-content/uploads/2021/01/den-ngu-de-ban-3004.jpg', 'Mô tả: Đèn bàn là sự kết hợp hoàn hảo giữa chức năng và thẩm mỹ. Với thiết kế nhỏ gọn và đa dạng về kiểu dáng, đèn bàn không chỉ giúp chiếu sáng một khu vực cụ thể như bàn làm việc, bàn học hay bàn trang điểm mà còn là một vật trang trí đầy phong cách. Các loại đèn bàn hiện đại thường có chế độ điều chỉnh ánh sáng để phù hợp với nhu cầu đọc sách, làm việc hay thư giãn.');
CALL insert_product('Elegant Flush Mount Light', 5, 30, 'E27', 'red', 32000000, 47000000, 23, 5, 'https://lightfixturesusa.com/cdn/shop/products/lightfixturesusa-mid-century-modern-white-flush-mount-light-ceiling-light-23-in-955856_900x.jpg?v=1686043224', 'Mô tả: Đèn ốp trần là lựa chọn lý tưởng cho các căn phòng có trần thấp. Đèn được lắp sát vào trần nhà, mang đến ánh sáng mạnh và đều khắp phòng. Thiết kế này giúp tiết kiệm không gian, tạo nên vẻ thanh lịch và hiện đại cho ngôi nhà. Đèn ốp trần thường có các thiết kế đơn giản nhưng tinh tế, dễ dàng hòa hợp với các phong cách nội thất khác nhau.');
CALL insert_product('Modern Recessed Lighting', 3, 30, 'E27', 'red', 32000000, 47000000, 23, 4, 'https://www.cristalrecord.com/18685-large_default/luxor-recessed-light-sq-black.jpg', 'Mô tả: Đèn âm trần được thiết kế để lắp đặt chìm vào trần nhà, mang đến vẻ gọn gàng và tinh tế cho không gian. Loại đèn này tạo ra ánh sáng lan tỏa đều khắp căn phòng mà không làm chiếm diện tích không gian. Đèn âm trần thường có ánh sáng dịu nhẹ, thích hợp cho những ngôi nhà hiện đại, tối giản. Một số mẫu đèn âm trần có thể điều chỉnh hướng chiếu sáng, giúp tập trung ánh sáng vào các khu vực cần thiết.');
CALL insert_product('Modern Flush Mount Light', 5, 30, 'E27', 'red', 32000000, 47000000, 23, 5, 'https://m.media-amazon.com/images/I/71H7woU9GzL.jpg', 'Mô tả: Đèn ốp trần là lựa chọn lý tưởng cho các căn phòng có trần thấp. Đèn được lắp sát vào trần nhà, mang đến ánh sáng mạnh và đều khắp phòng. Thiết kế này giúp tiết kiệm không gian, tạo nên vẻ thanh lịch và hiện đại cho ngôi nhà. Đèn ốp trần thường có các thiết kế đơn giản nhưng tinh tế, dễ dàng hòa hợp với các phong cách nội thất khác nhau.');
CALL insert_product('Luxury Chandelier', 1, 30, 'E27', 'red', 32000000, 47000000, 23, 3, 'https://denanhsang.vn/uploaded/images/kho-hinh-anh-dep-chum-dep-tai-den-anh-sang-17.jpg', 'Mô tả: Đèn chùm là biểu tượng của sự sang trọng và phong cách, thường xuất hiện trong các không gian nội thất cao cấp như phòng khách, phòng ăn hoặc sảnh lớn. Với thiết kế đa dạng, từ cổ điển đến hiện đại, đèn chùm có thể đi kèm nhiều bóng đèn và pha lê, tạo nên vẻ đẹp lung linh và ấn tượng. Đèn chùm không chỉ cung cấp ánh sáng chính mà còn đóng vai trò như một tác phẩm nghệ thuật, nâng cao giá trị thẩm mỹ của ngôi nhà.');
-- next insert product
CALL insert_product('Crystal Chandelier', 1, 30, 'E27', 'Gold', 32000000, 47000000, 23, 2, 'https://tuyetlights.com/Uploads/793/images/H%C3%ACnh%20D%E1%BB%B1%20%C3%81n%20Th%E1%BB%B1c%20T%E1%BA%BF/%C4%90%C3%A8n%20Trang%20Tr%C3%AD/den-chum-pha-le-du-an-so-8.jpg', 'Chandeliers are a symbol of luxury and style, often appearing in high-end interior spaces such as living rooms, dining rooms, or large halls. With diverse designs, from classic to modern, chandeliers can come with many bulbs and crystals, creating a sparkling and impressive beauty.');
CALL insert_product('Elegant Table Lamp', 2, 30, 'E27', 'White', 2500000, 3700000, 20, 3, 'https://fuhouse.vn/uploads/images/tin-tuc/den-ban-1_result.jpg', 'Table lamps are the perfect combination of function and aesthetics. With compact designs, table lamps can brighten up specific areas like desks, dressing tables, or reading corners while also serving as stylish decor.');
CALL insert_product('Luxury Chandelier', 1, 30, 'E27', 'Silver', 35000000, 49000000, 22, 1, 'https://tuyetlights.com/Uploads/793/images/H%C3%ACnh%20D%E1%BB%B1%20%C3%81n%20Th%E1%BB%B1c%20T%E1%BA%BF/%C4%90%C3%A8n%20Trang%20Tr%C3%AD/den-chum-pha-le-du-an-so-8.jpg', 'Luxury chandeliers elevate the atmosphere of any room, featuring elegant designs with crystals that provide both lighting and aesthetic value.');
CALL insert_product('Modern Table Lamp', 2, 30, 'E27', 'Black', 3200000, 4700000, 18, 3, 'https://catihome.com/wp-content/uploads/2023/03/NX57.jpeg', 'Modern table lamps combine functionality and sleek designs to illuminate workspaces or cozy corners, offering adjustable brightness levels for optimal lighting.');
CALL insert_product('Classic Chandelier', 1, 30, 'E27', 'Bronze', 40000000, 60000000, 24, 1, 'https://www.worldclasslighting.com/pictures/largepict/RL%201911-146.jpg', 'Classic chandeliers bring timeless elegance to any space, featuring intricate designs that are perfect for grand halls, living rooms, or dining areas.');
CALL insert_product('Sleek Recessed Lighting', 3, 30, 'E27', 'White', 1500000, 2500000, 25, 1, 'https://www.beeslighting.com/cdn/shop/files/S11876_Satco-Lighting-01.default.jpg?v=1718023453&width=2048', 'Recessed lighting is designed to fit seamlessly into ceilings, providing uniform lighting across the room without taking up space.');
CALL insert_product('Versatile Floor Lamp', 4, 30, 'E27', 'Black', 5000000, 7500000, 15, 4, 'https://www.relaxhouse.com.au/blog/wp-content/uploads/2024/02/Yellow-floor-lamp-1024x668.png', 'Floor lamps are highly versatile lighting solutions that can be moved around the room, offering supplemental lighting with a stylish design.');
CALL insert_product('Beautiful Table Lamp', 2, 30, 'E27', 'Yellow', 1800000, 2500000, 16, 3, 'https://tongkhodenngu.com/wp-content/uploads/2021/01/den-ngu-de-ban-3004.jpg', 'Table lamps are a combination of function and style, providing localized lighting for specific areas like work desks or nightstands.');
CALL insert_product('Elegant Flush Mount Light', 5, 30, 'E27', 'White', 3200000, 4700000, 23, 5, 'https://lightfixturesusa.com/cdn/shop/products/lightfixturesusa-mid-century-modern-white-flush-mount-light-ceiling-light-23-in-955856_900x.jpg?v=1686043224', 'Flush mount lights are ideal for low-ceiling rooms, offering bright and even lighting with a sleek, modern design.');
CALL insert_product('Modern Recessed Lighting', 3, 30, 'E27', 'Black', 3200000, 4700000, 23, 4, 'https://www.cristalrecord.com/18685-large_default/luxor-recessed-light-sq-black.jpg', 'Recessed lighting is perfect for modern homes, creating a clean and minimalist look while providing soft, even illumination.');
CALL insert_product('Modern Flush Mount Light', 5, 30, 'E27', 'White', 3200000, 4700000, 23, 5, 'https://m.media-amazon.com/images/I/71H7woU9GzL.jpg', 'Flush mount lights fit closely to the ceiling, making them ideal for low-ceiling spaces while providing ample lighting with a stylish design.');
CALL insert_product('Luxury Chandelier', 1, 30, 'E27', 'Crystal', 50000000, 75000000, 22, 2, 'https://denanhsang.vn/uploaded/images/kho-hinh-anh-dep-chum-dep-tai-den-anh-sang-17.jpg', 'Luxury chandeliers are a statement piece, providing both illumination and artistic value with their elegant design and luxurious materials.');
CALL insert_product('Retro Pendant Light', 7, 30, 'E27', 'Copper', 2000000, 3000000, 20, 6, 'https://noithatsct.com/wp-content/uploads/2020/04/Den-tha-van-phong-hinh-chu-Y-300x300.jpg', 'Pendant lights bring a retro touch to any space with their vintage-inspired design, providing focused lighting for dining or living rooms.');
CALL insert_product('Outdoor LED Floodlight', 9, 30, 'LED', 'Gray', 4000000, 6000000, 30, 8, 'https://denledsct.com/wp-content/uploads/2019/04/Den-pha-LED-cao-cap-ngoai-troi.jpg', 'Outdoor LED floodlights are designed to illuminate large areas with bright, energy-efficient light, perfect for security and exterior lighting.');
CALL insert_product('Industrial Wall Sconce', 6, 30, 'E27', 'Black', 2500000, 3500000, 17, 7, 'https://denledsct.com/wp-content/uploads/2020/12/Den-LED-doc-sach-dau-giuong-cao-cap-3103-anh1-300x300.jpg', 'Industrial wall sconces offer a rugged aesthetic with a minimalist design, providing focused lighting for hallways or living rooms.');
CALL insert_product('Contemporary Pendant Light', 7, 30, 'E27', 'Chrome', 3000000, 4500000, 18, 6, 'https://flexhouse.vn/wp-content/uploads/2023/09/den-tha-tran-tron-mau-vang-sang-trong-zk0187-6.jpg', 'Contemporary pendant lights provide stylish illumination with sleek designs, ideal for modern kitchens, dining areas, or living rooms.');
CALL insert_product('Stylish LED Strip Light', 8, 30, 'LED', 'RGB', 1200000, 2200000, 25, 9, 'https://www.lightstec.com/wp-content/uploads/bb-plugin/cache/SMD-2835-192Leds-Strip-light-24V-1-landscape-15114abc7085acd41b1e9fdbd2a4ac0a-.jpg', 'LED strip lights offer versatile lighting solutions with customizable colors, perfect for accent lighting in modern homes or entertainment areas.');
CALL insert_product('Outdoor Spotlight', 10, 30, 'LED', 'Black', 6000000, 8000000, 20, 8, 'https://bizweb.dktcdn.net/100/321/653/products/4429578den-spotlight-650w-quay-phim-chup-anh-chinh-hang-jietu-5-jpeg.jpg?v=1530782628213', 'Outdoor spotlights are designed for highlighting specific areas in gardens or exteriors, providing bright, directional light for enhanced visibility.');
CALL insert_product('Vintage Wall Sconce', 6, 30, 'E27', 'Bronze', 2200000, 3200000, 19, 7, 'https://flexhouse.vn/wp-content/uploads/2023/11/Den-hat-tuong-hinh-hop-chu-nhat-chong-nuoc-LXG062-7.jpg', 'Vintage wall sconces bring classic charm with their timeless design, perfect for creating a warm, inviting atmosphere in any room.');
CALL insert_product('Modern LED Ceiling Light', 5, 30, 'LED', 'White', 2800000, 4000000, 23, 5, 'https://khodengiare.com/wp-content/uploads/2022/10/640bb5fb541273065d591467ee0a5879.jpg', 'Modern LED ceiling lights provide energy-efficient lighting with a sleek design, perfect for minimalist homes with low ceilings.');
CALL insert_product('Classic Wall Lamp', 6, 30, 'E27', 'Gold', 2400000, 3500000, 20, 7, 'https://images.kingled.vn/data/Product/4F46D144-E36A-400C-A8CE-03529AD57CFB/KL053.jpg?w=1000', 'Classic wall lamps bring timeless elegance to any space, perfect for lighting hallways or bedrooms while adding a touch of sophistication.');
CALL insert_product('Smart LED Bulb', 8, 30, 'LED', 'RGB', 900000, 1200000, 25, 9, 'https://product.hstatic.net/1000054140/product/3k_b1fd558638f348869411388438bcfaef_grande.jpg', 'Smart LED bulbs offer customizable lighting, allowing you to change colors and adjust brightness remotely using a smartphone or voice control.');
CALL insert_product('Luxury Pendant Light', 7, 30, 'E27', 'Gold', 4500000, 6000000, 22, 6, 'https://images.kingled.vn/data/Product/3399288E-6592-4E4B-9FB9-587984524C4E/P0082002A.jpg?w=1000', 'Luxury pendant lights offer both function and beauty, featuring high-end materials and designs to create a focal point in any room.');
CALL insert_product('Minimalist Table Lamp', 2, 30, 'E27', 'Gray', 2200000, 3300000, 18, 3, 'https://down-vn.img.susercontent.com/file/4ed5f51beade2895e6b1628dafbd39a8', 'Minimalist table lamps provide functional lighting with sleek, modern designs, perfect for workspaces or reading corners in contemporary homes.');
CALL insert_product('Decorative Ceiling Fan Light', 5, 30, 'E27', 'White', 6000000, 8000000, 24, 5, 'https://philipshue.vn/wp-content/uploads/2019/02/philips-hue-white-ambiance-being-flushmount-yellow-600x600.jpg', 'Decorative ceiling fan lights combine functionality and style, offering cooling and lighting in a single, stylish unit for modern homes.');
CALL insert_product('Modern Track Lighting', 3, 30, 'LED', 'Black', 4800000, 6000000, 21, 4, 'https://img.phenikaalighting.com/file_manager/images%20chung/l%E1%BA%AFp%20%C4%91%E1%BA%B7t%20%C4%91%C3%A8n/be-mat-cua-den-led-downlight-am-tran-co-mau-trang-hinh-tron-phang-giup-tan-quang-hieu-qua.png', 'Modern track lighting provides adjustable lighting with multiple heads, perfect for highlighting specific areas like art, furniture, or workspaces.');
CALL insert_product('Outdoor Hanging Lantern', 10, 30, 'E27', 'Bronze', 2800000, 4000000, 19, 8, 'https://flexhouse.vn/wp-content/uploads/2023/07/den-led-downlight-roi-tranh-gap-goc-90-do-fd3656-10.jpg', 'Outdoor hanging lanterns bring classic charm to patios and gardens, offering decorative and functional lighting for exterior spaces.');
CALL insert_product('Energy-Efficient Ceiling Light', 5, 30, 'LED', 'White', 3500000, 5000000, 23, 5, 'https://flexhouse.vn/wp-content/uploads/2023/11/Den-tha-tran-hinh-tron-thuy-tinh-cao-cap-BO7720-3.png', 'Energy-efficient ceiling lights provide bright, even lighting while using less electricity, perfect for modern homes aiming for sustainability.');
CALL insert_product('Vintage Pendant Light', 7, 30, 'E27', 'Copper', 3300000, 4500000, 20, 6, 'https://philipshue.vn/wp-content/uploads/2020/12/hue-filament-decoration-2.jpg', 'Vintage pendant lights offer a retro aesthetic with modern functionality, perfect for lighting over kitchen islands or dining tables.');
CALL insert_product('Smart Ceiling Light', 5, 30, 'LED', 'White', 5200000, 6800000, 23, 5, 'https://fuhouse.vn/uploads/images/tin-tuc/den-chum-3_result.png', 'Smart ceiling lights can be controlled remotely, offering customizable brightness and color settings, ideal for smart homes with modern designs.');

-- The above format will continue with different product names, descriptions, images, and combinations of type_id and brand_id for the remaining 80 products.

-- insert users test
insert into users(`name`,`email`,`phone`,`address`,`date_of_birth`,`username`,`password`,`role`) values ('Nguyễn Trọng Nghĩa','ntn8530@gmail.com','0862273012','Hà Nội','2002-06-15','tnc2002','Ntn1506@','admin');
insert into users(`name`,`email`,`phone`,`address`,`date_of_birth`,`username`,`password`,`role`) values ('Phan Anh Tiến Quý','ad1@gmail.com','0123456789','Hà Nội','1995-06-15','ad1','123456','admin');
insert into users(`name`,`email`,`phone`,`address`,`date_of_birth`,`username`,`password`,`role`) values ('Nguyễn Văn A','cs1@gmail.com','0123456789','Hà Nội','1995-06-15','cs1','123456','customer');

-- ALTER TABLE type_lights ADD category VARCHAR(255);
-- UPDATE type_lights SET category = 'ceiling' WHERE id IN (1, 3, 4, 5);
-- UPDATE type_lights SET category = 'table' WHERE id = 2; 
-- UPDATE type_lights SET category = 'wall' WHERE id = 6; 
-- UPDATE type_lights SET category = 'pendant' WHERE id = 7; 
-- UPDATE type_lights SET category = 'led' WHERE id = 8; 
-- UPDATE type_lights SET category = 'outdoor' WHERE id = 9; 
-- UPDATE type_lights SET category = 'spotlight' WHERE id = 10; 


