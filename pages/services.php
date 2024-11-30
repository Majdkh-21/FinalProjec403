<?php include '../includes/header.php'; ?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/print.css" media="print"> 
</head>
<body>
    <div class="services-table">
        <table>
            <tr>
                <th>النوع</th>
                <th colspan="2">الوصف</th>
            </tr>
            <tr>
                <td rowspan="2">التوصيل</td>
                <td>توصيل سريع</td>
                <td>داخل المدينة</td>
            </tr>
            <tr>
                <td>توصيل مجاني</td>
                <td>لكل الطلبات فوق 200 ريال</td>
            </tr>
            <tr>
                <td rowspan="2">التخفيضات</td>
                <td colspan="2">تخفيضات موسمية تصل إلى 50%</td>
            </tr>
            <tr>
                <td>خصومات خاصة</td>
                <td>للعملاء المميزين</td>
            </tr>
        </table>
    </div>

    <button onclick="window.print()" style="margin: 20px; display: block;">Print Table</button>
    
<?php include '../includes/footer.php'; ?>
</body>
</html>
