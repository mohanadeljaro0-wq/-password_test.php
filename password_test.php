<?php
// بدء الجلسة لتخزين الـ hash بين عمليات الإرسال
session_start();

$hashResult = "";
$verifyResult = "";

// عند الضغط على زر التجزئة
if (isset($_POST['hash'])) {
    $password = $_POST['password'];

    // تجزئة كلمة المرور
    $hash = password_hash($password, PASSWORD_DEFAULT);

    // تخزين الـ hash في الجلسة
    $_SESSION['hash'] = $hash;

    $hashResult = "Hash الناتج: <br><strong>$hash</strong>";
}

// عند الضغط على زر التحقق
if (isset($_POST['verify'])) {
    $password = $_POST['password'];

    if (isset($_SESSION['hash'])) {
        // التحقق من التطابق
        if (password_verify($password, $_SESSION['hash'])) {
            $verifyResult = "<span style='color:green;'>Match ✔</span>";
        } else {
            $verifyResult = "<span style='color:red;'>No Match ✖</span>";
        }
    } else {
        $verifyResult = "<span style='color:orange;'>لم يتم إنشاء Hash بعد</span>";
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>اختبار تجزئة كلمة المرور</title>
</head>
<body>

<h2>اختبار Hash و Verify لكلمة المرور</h2>

<form method="post">
    <label>أدخل كلمة المرور:</label><br><br>
    <input type="password" name="password" required>
    <br><br>

    <input type="submit" name="hash" value="Hashing">
    <input type="submit" name="verify" value="Verify">
</form>

<br><br>

<!-- عرض النتائج -->
<div>
    <?php
        echo $hashResult;
        echo "<br><br>";
        echo $verifyResult;
    ?>
</div>

</body>
</html>
