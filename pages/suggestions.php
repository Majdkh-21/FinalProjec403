<?php include '../includes/header.php'; ?>

<?php

$database_url = "mysql://root:dLAmBflfVGqLOuEVfLzJEkwDqaZprjyd@junction.proxy.rlwy.net:48554/railway";

// Parse the URL
$db_url = parse_url($database_url);

$host = $db_url["host"];
$dbname = ltrim($db_url["path"], '/');
$username = $db_url["user"];
$password = $db_url["pass"];
$port = $db_url["port"];

// Establish a connection to the MySQL database
$conn = mysqli_connect($host, $username, $password, $dbname, $port);


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $suggestion = mysqli_real_escape_string($conn, $_POST['suggestion']);


    $sql = "INSERT INTO suggest (name, suggestion) VALUES ('$name', '$suggestion')";

    if (mysqli_query($conn, $sql)) {
        echo "<p style='color:green;'>شكراً لك! تم إرسال اقتراحك بنجاح.</p>";
    } else {
        echo "<p style='color:red;'>حدث خطأ: " . mysqli_error($conn) . "</p>";
    }
}
?>


<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>صفحة الاقتراحات</title>
    <link rel="style" href="../css/style.css">
</head>
<body>
    <div class="main-content suggestions-container">
        <h1>صفحة الاقتراحات</h1>
        <form class="suggestions-form" method="POST" action="">
            <label for="name">اسمك:</label>
            <input type="text" id="name" name="name" placeholder="أدخل اسمك" required>

            <label for="suggestion">اقتراحك:</label>
            <textarea id="suggestion" name="suggestion" rows="5" placeholder="اكتب اقتراحك هنا" required></textarea>

            <button type="submit">إرسال الاقتراح</button>
        </form>
        <?php if (isset($message)) echo $message; ?>
    </div>

<?php include '../includes/footer.php'; ?>
</body>
</html>