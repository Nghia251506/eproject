<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <style>
        .contact-container {
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: auto;
            transition: box-shadow 0.3s ease;
            margin-top: 30px;
        }

        .contact-container:hover {
            box-shadow: 0 8px 40px rgba(0, 0, 0, 0.2);
        }

        .contact-description {
            margin-bottom: 20px;
            color: #666;
            font-size: 16px;
        }

        .contact-form-group {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            flex-wrap: wrap; /* Allow flex items to wrap */
        }

        .contact-form-label {
            flex: 0 0 150px; /* Fixed width for label */
            margin-right: 15px; /* Space between label and input */
            font-weight: bold;
            color: #333;
            font-size: 16px;
        }

        .contact-form-input,
        .contact-form-textarea {
            flex: 1; /* Occupy remaining space */
            min-width: 200px; /* Minimum width for inputs */
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        .contact-form-input:focus,
        .contact-form-textarea:focus {
            border-color: #f2d265; /* Change border color on focus */
            outline: none;
        }

        .contact-submit-button {
            background-color: #f2d265;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
            display: block; /* Make button block to center */
            width: 100%; /* Full width for button */
            transition: background-color 0.3s ease; /* Smooth hover effect */
        }

        .contact-submit-button:hover {
            background-color: #f2d230; /* Darker green on hover */
        }

        .contact-info {
            margin-top: 20px;
            border-top: 1px solid #ccc;
            padding-top: 15px;
        }

        .contact-info-title {
            margin: 0;
            font-size: 24px;
            color: #333;
        }

        .contact-bold {
            font-weight: bold;
            font-size: 18px;
            margin-bottom: 5px;
        }

        .contact-info-details {
            color: #666;
            font-size: 14px;
        }

        .required {
            color: red; /* Red color for required asterisk */
        }

    </style>
</head>
<body>
    <div class="contact-container col-xl-12">
        <p class="contact-description">
            Please contact us if you encounter any issues related to our company or services. 
            We will strive to respond as soon as possible.
        </p>
        <form class="contact-form">
            <div class="contact-form-group">
                <label for="name" class="contact-form-label">Name <span class="required">*</span>:</label>
                <input type="text" id="name" name="name" class="contact-form-input" required>
            </div>

            <div class="contact-form-group">
                <label for="phone" class="contact-form-label">Phone:</label>
                <input type="text" id="phone" name="phone" class="contact-form-input">
            </div>

            <div class="contact-form-group">
                <label for="email" class="contact-form-label">Email <span class="required">*</span>:</label>
                <input type="email" id="email" name="email" class="contact-form-input" required>
            </div>

            <div class="contact-form-group">
                <label for="company" class="contact-form-label">Your Company <span class="required">*</span>:</label>
                <input type="text" id="company" name="company" class="contact-form-input" required>
            </div>

            <div class="contact-form-group">
                <label for="subject" class="contact-form-label">Subject <span class="required">*</span>:</label>
                <input type="text" id="subject" name="subject" class="contact-form-input" required>
            </div>

            <div class="contact-form-group">
                <label for="message" class="contact-form-label">Your Message <span class="required">*</span>:</label>
                <textarea id="message" name="message" class="contact-form-textarea" rows="4" required></textarea>
            </div>

            <button type="submit" class="contact-submit-button">Submit</button>
        </form>

        <hr class="contact-separator">

        <div class="contact-info">
            <h2 class="contact-info-title">CONTACT:</h2>
            <p class="contact-bold">Luminous Garden</p>
            <p class="contact-info-details">✔ Showroom: 8A Ton That Thuyet, My Dinh, Nam Tu Liem, Hanoi.</p>
            <p class="contact-info-details">✔ Phone: 0523652003</p>
        </div>
        
    </div>
</body>
</html>
