<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liên Hệ Chúng Tôi</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f9fc;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            box-sizing: border-box;
        }
        .container {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 100%;
            max-width: 500px;
            text-align: center;
            transition: transform 0.3s;
        }
        .container:hover {
            transform: translateY(-5px);
        }
        h1 {
            color: #343a40;
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: bold;
        }
        p {
            color: #6c757d;
            margin-bottom: 20px;
            line-height: 1.5;
        }
        label {
            display: block;
            margin: 12px 0 5px;
            color: #495057;
            font-weight: 600;
        }
        input, textarea {
            width: 100%;
            padding: 14px;
            margin-bottom: 15px;
            border: 1px solid #ced4da;
            border-radius: 8px;
            transition: border 0.3s;
            box-sizing: border-box;
            font-size: 16px;
        }
        input:focus, textarea:focus {
            border: 1px solid #007bff;
            outline: none;
        }
        button {
            background-color: #007bff;
            color: white;
            padding: 14px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            width: 100%;
            font-size: 18px;
            transition: background-color 0.3s, transform 0.3s;
        }
        button:hover {
            background-color: #0056b3;
            transform: scale(1.02);
        }
        .contact-info {
            margin-top: 30px;
            border-top: 1px solid #dee2e6;
            padding-top: 15px;
        }
        .contact-info h2 {
            color: #343a40;
            font-size: 20px;
            margin-bottom: 10px;
        }
        .contact-info p {
            color: #6c757d;
            margin: 5px 0;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>LIÊN HỆ CHÚNG TÔI</h1>
        <p>Hãy liên hệ với chúng tôi nếu bạn gặp bất cứ vấn đề nào liên quan đến công ty hoặc dịch vụ của chúng tôi. Chúng tôi sẽ cố gắng phản hồi trong thời gian sớm nhất.</p>

        <form>
            <label for="name">Tên * :</label>
            <input type="text" id="name" required placeholder="Nhập tên của bạn">

            <label for="phone">SĐT :</label>
            <input type="tel" id="phone" placeholder="Nhập số điện thoại của bạn">

            <label for="email">Email * :</label>
            <input type="email" id="email" required placeholder="Nhập email của bạn">

            <label for="company">Công ty của bạn * :</label>
            <input type="text" id="company" required placeholder="Nhập tên công ty">

            <label for="title">Tiêu đề * :</label>
            <input type="text" id="title" required placeholder="Nhập tiêu đề câu hỏi">

            <label for="question">Câu hỏi của bạn * :</label>
            <textarea id="question" rows="4" required placeholder="Nhập câu hỏi của bạn"></textarea>

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
