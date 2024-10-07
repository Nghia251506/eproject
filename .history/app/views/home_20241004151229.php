<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liên Hệ Chúng Tôi</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 100%;
            max-width: 600px;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        p {
            text-align: center;
            color: #555;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin: 10px 0 5px;
            color: #333;
        }
        input, textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: border 0.3s;
        }
        input:focus, textarea:focus {
            border: 1px solid #007bff;
            outline: none;
        }
        button {
            background-color: #007bff;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #0056b3;
        }
        .contact-info {
            margin-top: 30px;
            border-top: 1px solid #ccc;
            padding-top: 15px;
            text-align: center;
        }
        .contact-info h2 {
            color: #333;
        }
        .contact-info p {
            color: #555;
            margin: 5px 0;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>CONTACT US</h1>
        <p>Hãy liên hệ khi bạn gặp bất cứ vấn đề nào liên quan đến công ty hoặc dịch vụ của chúng tôi. Chúng tôi sẽ cố gắng phản hồi trong thời gian sớm nhất.</p>

        <form>
            <label for="name">Tên * :</label>
            <input type="text" id="name" required>

            <label for="phone">SĐT :</label>
            <input type="text" id="phone">

            <label for="email">Email * :</label>
            <input type="email" id="email" required>

            <label for="company">Công ty của bạn * :</label>
            <input type="text" id="company" required>

            <label for="title">Tiêu đề * :</label>
            <input type="text" id="title" required>

            <label for="question">Câu hỏi của bạn * :</label>
            <textarea id="question" rows="4" required></textarea>

            <button type="submit">Gửi</button>
        </form>

        <div class="contact-info">
            <h2>LIÊN HỆ:</h2>
            <p><strong>Luminous Garden</strong></p>
            <p>✔️  Showroom: 8A Tôn Thất Thuyết, Mỹ Đình, Nam Từ Liêm, Hà Nội.</p>
            <p>✔️  Điện Thoại: 0523652003</p>
        </div>
    </div>

</body>
</html>
