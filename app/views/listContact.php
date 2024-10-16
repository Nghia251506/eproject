<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Sản Phẩm</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f0f0f0;
        }

        h2 {
            text-align: center;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
            /* height:20px */
        }

        .pagination a {
            margin: 0 5px;
            padding: 10px 15px;
            /* border: 1px solid #007BFF; */
            color: #007BFF;
            text-decoration: none;
        }

        .pagination a.active {
            background-color: #007BFF;
            color: white;
        }

        .pagination a:hover {
            background-color: #0056b3;
            color: white;
        }

        .form-search {
            display: flex;
            gap: 10px;
            /* Khoảng cách giữa các input */
        }

        .input-search {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .submit-search {
            padding: 8px 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .submit-search:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <?php
    $data = $input["data"];
    $contacts = $data["contacts"];
    $totalPages = $data["totalPages"];
    $currentPage = $data["currentPage"];
    ?>
    <!-- <h2 style="text-align: center;">Search Product</h2>
    <form method="POST" action="http://localhost/eproject/product/searchList" class="form-search">
        <input type="text" name="code" placeholder="Input product code" class="input-search">
        <input type="text" name="name" placeholder="Input product name" class="input-search">
        <input type="submit" value="Tìm kiếm" class="submit-search">
    </form> -->
    <h2>List Contacts</h2>
    <table>
        <tr>
            <th>STT</th>
            <th>Customer Name</th>
            <th>Title</th>
            <th>Phone_number</th>
            <th>Email</th>
            <th>Company</th>
            <th>Question</th>
        </tr>
        <?php
        $index = 1;
        foreach ($contacts as $contact) : ?>
            <tr>
                <td><?= $index++ ?></td>
                <td><?= htmlspecialchars($contact->name) ?></td>
                <td><?= htmlspecialchars($contact->title) ?></td>
                <td><?= htmlspecialchars($contact->phone_number) ?></td>
                <td><?= htmlspecialchars($contact->email) ?></td>
                <td><?= htmlspecialchars($contact->company) ?></td>
                <td><?= htmlspecialchars($contact->question) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <div class="pagination">
        <?php if ($currentPage > 1): ?>
            <a href="http://localhost/eproject/product/list/<?= $currentPage - 1; ?>">« Prev</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="http://localhost/eproject/product/list/<?= $i; ?>" class="<?= ($i == $currentPage) ? 'active' : ''; ?>"><?= $i; ?></a>
        <?php endfor; ?>

        <?php if ($currentPage < $totalPages): ?>
            <a href="http://localhost/eproject/product/list/<?= $currentPage + 1; ?>">Next »</a>
        <?php endif; ?>
    </div>

    <?php

            if (isset($_SESSION['success_message'])) {
                echo '<div class="alert alert-success">' . $_SESSION['success_message'] . '</div>';
                unset($_SESSION['success_message']);
            }
            ?>

    <!-- <script src="http://localhost/eproject/app/assets/js/alert.js"></script> -->
</body>

</html>