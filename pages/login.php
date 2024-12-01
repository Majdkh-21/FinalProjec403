<?php

include '../includes/header.php';


$database_url = "mysql://root:NDOcmATZaFjHLsXTnqgFdVTKezgqrqvk@junction.proxy.rlwy.net:46016/railway";


$db_url = parse_url($database_url);

$host = $db_url["host"];
$dbname = ltrim($db_url["path"], '/');
$username = $db_url["user"];
$password = $db_url["pass"];
$port = $db_url["port"];


$conn = mysqli_connect($host, $username, $password, $dbname, $port);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    echo "<p style='color:green; text-align:center;'>Database connection successful!</p>";
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
    $pass = htmlspecialchars($_POST['pass'], ENT_QUOTES, 'UTF-8');


    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<p style='color:red; text-align:center;'>An account with this email already exists.</p>";
    } else {

        $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);


        $insert_stmt = $conn->prepare("INSERT INTO users (email, pass) VALUES (?, ?)");
        $insert_stmt->bind_param("ss", $email, $hashed_pass);

        if ($insert_stmt->execute()) {
            echo "<p style='color:green; text-align:center;'>Registration successful!</p>";
        } else {
            echo "<p style='color:red; text-align:center;'>Error: " . $conn->error . "</p>";
        }
        $insert_stmt->close();
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="main-content">
        <h1>Login Form</h1>
        <form action="" method="POST">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br>

            <label for="pass">Password:</label>
            <input type="password" id="pass" name="pass" required><br><br>

            <button type="submit">Register</button>
        </form>

        <p>
            <a href="?view_terms=1" target="_self">عرض الشروط والأحكام</a>
        </p>

        <?php
        
        if (isset($_GET['view_terms'])) {
            echo '
            <div class="pdf-viewer">
                <h2>الشروط والأحكام</h2>
                <object data="../pdf/terms.pdf" type="application/pdf" width="100%" height="600px">
                    <p>عذراً، متصفحك لا يدعم عرض ملفات PDF. يمكنك <a href="../pdf/terms.pdf">تحميل الملف هنا</a>.</p>
                </object>
            </div>';
        }



        
        $conn->close();
        ?>
    </div>
<?php include '../includes/footer.php'; ?>
</body>
</html>
