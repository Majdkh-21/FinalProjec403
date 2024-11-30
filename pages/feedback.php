<?php include 'includes/header.php'; ?>

<?php
// إعداد الاتصال بقاعدة البيانات
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
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $service = mysqli_real_escape_string($conn, $_POST['service']);
    $satisfaction = mysqli_real_escape_string($conn, $_POST['satisfaction']);
    $feedback = mysqli_real_escape_string($conn, $_POST['feedback']);

    $sql = "INSERT INTO feedback (name, email, service, satisfaction, feedback) 
            VALUES ('$name', '$email', '$service', '$satisfaction', '$feedback')";

    if (mysqli_query($conn, $sql)) {
        echo "<p style='color:green;'>شكراً لك! تم إرسال ملاحظاتك بنجاح.</p>";
    } else {
        echo "<p style='color:red;'>حدث خطأ: " . mysqli_error($conn) . "</p>";
    }

    $result = mysqli_query($conn, "SELECT * FROM feedback");
    while($row = mysqli_fetch_assoc($result)){
    $name = $row["name"];
    echo "$name";
    }





}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نموذج الملاحظات</title>
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/validation.js" defer></script> <!-- ربط ملف JavaScript -->
</head>
<body>
    <div class="main-content">
        <h1>Feedback Submission Form</h1>
        <form id="feedbackForm" action="" method="POST" novalidate >
            <fieldset>
                <legend>User Information</legend>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required><br><br>
                
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required><br><br>
            </fieldset>

            <fieldset>
                <legend>Feedback and Service Details</legend>
                
                <label for="service">Select Service:</label>
                <select id="service" name="service" required>
                    <option value="">Select a Service...</option>
                    <option value="delivery">Delivery</option>
                    <option value="return">Return</option>
                    <option value="support">Technical Support</option>
                </select><br><br>

                <p>Were you satisfied with the service?</p>
                <input type="radio" id="satisfied" name="satisfaction" value="satisfied" required>
                <label for="satisfied">Satisfied</label>
                <input type="radio" id="not_satisfied" name="satisfaction" value="not_satisfied" required>
                <label for="not_satisfied">Not Satisfied</label><br><br>

                <label for="feedback">Feedback:</label><br>
                <textarea id="feedback" name="feedback" rows="4" cols="50" placeholder="Enter your feedback here" required></textarea><br><br>
            </fieldset>

            <input type="submit" value="Submit">
        </form>
    </div>
<?php include '../includes/footer.php'; ?>
</body>
</html>
