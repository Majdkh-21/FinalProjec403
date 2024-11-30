<?php include '../includes/header.php'; ?>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "testdb";

// إنشاء اتصال بقاعدة البيانات
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// التحقق من طلب POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // تنظيف المدخلات لمنع XSS
    $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
    $pass = htmlspecialchars($_POST['pass'], ENT_QUOTES, 'UTF-8');

    // التحقق من البريد الإلكتروني باستخدام prepared statement
    $stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<p style='color:red; text-align:center;'>An account with this email already exists.</p>";
    } else {
        // تجزئة كلمة المرور
        $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

        // إدخال بيانات جديدة باستخدام prepared statement
        $insert_stmt = $conn->prepare("INSERT INTO user (email, pass) VALUES (?, ?)");
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

// إغلاق الاتصال بقاعدة البيانات
$conn->close();
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

            <label for="pass">password:</label>
            <input type="password" id="pass" name="pass" required><br><br>

            <button type="submit">Register</button>
        </form>

        <p>
            <a href="?view_terms=1" target="_self">عرض الشروط والأحكام</a>
        </p>

        <?php
        // عرض الشروط والأحكام عند الضغط على الرابط
        if (isset($_GET['view_terms'])) {
            echo '
            <div class="pdf-viewer">
                <h2>الشروط والأحكام</h2>
                <object data="../pdf/terms.pdf" type="application/pdf" width="100%" height="600px">
                    <p>عذراً، متصفحك لا يدعم عرض ملفات PDF. يمكنك <a href="../pdf/terms.pdf">تحميل الملف هنا</a>.</p>
                </object>
            </div>';
        }
        ?>
    </div>
<?php include '../includes/footer.php'; ?>
</body>
</html>
