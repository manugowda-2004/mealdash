<?php include('partials-front/constant.php'); ?>

<html>
<head>
    <title>Login-Food Order Website</title>
    <link rel="stylesheet" href="css/front-login.css">

    <!-- CSS for custom alert -->
    <style>
        #customAlert {
            display: none;
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #f0fff4;
            color: #2f855a;
            border: 1px solid #c6f6d5;
            padding: 15px 25px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            font-family: Arial, sans-serif;
            z-index: 1000;
            animation: fadeIn 0.4s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; top: 10px; }
            to { opacity: 1; top: 20px; }
        }
    </style>
</head>
<body>

<?php

if (isset($_SESSION['invalid-email'])) {
    $message = $_SESSION['invalid-email'];
    echo "<div id='customAlert'>" . htmlspecialchars($message) . "</div>";
    unset($_SESSION['invalid-email']);
}
?>

<!-- Login form -->
<div>
    <form action="" method="POST" class="container">
        <h1 class="login-title">Welcome To MealDash...</h1>
        <br>
        <section class="input-box">
            <input type="text" name="full_name" placeholder="Full Name" required>
            <i class="bx bxs-user"></i>
        </section>

        <section class="input-box">
            <input type="text" name="email" placeholder="Email" required>
            <i class="bx bxs-user"></i>
        </section>

        <section class="input-box">
            <input type="password" name="password" placeholder="Password" class="bx bxs-lock-alt" required>
            <i class="bx bxs-user"></i>
        </section>

        <input class="login-button" type="submit" name="signup" value="SignUp">

        <br>
        <section class="row">
            <p>Already have an account?</p>
            <a href="login.php" class="reg">Log-In</a>
        </section>
    </form>
</div>

<!-- Client-side email validation using custom alert -->
<script>
    document.querySelector("form").addEventListener("submit", function(event) {
        const email = document.querySelector("input[name='email']").value;
        const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;

        const customAlert = document.getElementById('customAlert');

        customAlert.innerHTML = '';
        customAlert.style.display = 'none';

        if (!emailRegex.test(email)) {
            event.preventDefault();
            customAlert.innerHTML = 'Please enter a valid email address.';
            customAlert.style.display = 'block';

            setTimeout(() => {
                customAlert.style.display = 'none';
            }, 3000);
        }
    });

    // Server-side alert animation trigger
    window.addEventListener('DOMContentLoaded', function () {
        const alertBox = document.getElementById('customAlert');
        if (alertBox && alertBox.innerHTML.trim() !== '') {
            alertBox.style.display = 'block';
            setTimeout(() => {
                alertBox.style.display = 'none';
            }, 3000);
        }
    });
</script>

</body>
</html>

<?php
if (isset($_POST['signup'])) {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    // Server-side email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['invalid-email'] = "Invalid email format...";
        header('location:' . SITEURL . 'signup.php');
        exit();
    }

    // SQL query
    $sql = "INSERT INTO tbl_user SET 
        full_name='$full_name',
        email='$email',
        password='$password'
    ";

    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    if ($res == true) {
        $_SESSION['sign-up'] = "<div class='success'>Sign-Up Is Successful...</div>";
        header('location:' . SITEURL . 'login.php');
    } else {
        $_SESSION['sign-up'] = "<div class='error'>Failed To Sign-Up...</div>";
        header('location:' . SITEURL . 'login.php');
    }
}
?>
