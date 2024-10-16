<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liên Hệ Chúng Tôi</title>
    <link rel="stylesheet" href="http://localhost/eproject/app/assets/css/contact.css">
</head>
<body>
    <?php
    $data = $input["data"];
    $contact = $data["contact"] ?? "";    
    ?>
    <div class="container-contact">
        <h1>CONTACT US</h1>
        <p>Please contact us if you have any problems related to our company or services. We will try to respond as soon as possible.</p>

        <form action="http://localhost/eproject/contact/add" method="POST">
            <label for="name">NAME * :</label>
            <input type="text" name="name" required placeholder="NAME">

            <label for="phone">PHONE :</label>
            <input type="tel" name="phone_number" placeholder="PHONE">

            <label for="email">EMAIL * :</label>
            <input type="email" name="email" required placeholder="EMAIL">

            <label for="company">COMPANY * :</label>
            <input type="text" name="company" required placeholder="COMPANY">

            <label for="title">TITLE * :</label>
            <input type="text" name="title" required placeholder="TITLE">

            <label for="question">YOUR QUESTION * :</label>
            <textarea id="question" rows="4" required placeholder="YOUR QUESTION" name="question"></textarea>

            <button type="submit">SUBMIT</button>
        </form>

        <div class="contact-info">
            <h2>CONTAT:</h2>
            <p><strong>Luminous Garden</strong></p>
            <p>✔️  Showroom: 8A Tôn Thất Thuyết, Mỹ Đình, Nam Từ Liêm, Hà Nội.</p>
            <p>✔️  Hotline: 0523652003</p>
        </div>
    </div>

</body>
</html>
