<?php include('partials-front/constant.php'); ?>

<?php include('partials-front/check-login.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Food Order Website</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">

    <!--css for custom alert-->
    <style>
        #customAlert{
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
        animation: 0.4s ease;
        };
    </style>
</head>

<body>

    <!-- Navbar Section Starts -->
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="#" title="Logo">
                    <img src="images/logp.png" alt="Logo" class="img-responsive1">
                </a>
            </div>

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="<?php echo SITEURL; ?>index.php">Home</a>
                    </li>
                    <li>
                        <a href="<?PHP echo SITEURL;?>categories.php">Categories</a>
                    </li>
                    <li>
                        <a href="<?PHP echo SITEURL;?>foods.php">Foods</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>about-us.php">About Us</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL;?>logout.php">Logout</a>
                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends -->