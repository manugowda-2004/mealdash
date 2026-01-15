<?php ob_start(); ?>

<?php include('partials-front/menu.php'); ?>

    <?php 

        date_default_timezone_set('Asia/Kolkata'); // Set the timezone to India Standard Time (IST)

        //check whether the food id is set or not
        if(isset($_GET['food_id']))
        {
            //get the food id and details of the selected food
            $food_id=$_GET['food_id'];

            //get the details of the selected food
            $sql="SELECT * FROM tbl_food WHERE id=$food_id";

            //execute the query
            $res=mysqli_query($conn,$sql);

            //to count the rows
            $count=mysqli_num_rows($res);

            //check whether the data is available or not
            if($count==1)
            {
                //we have data
                //TO GET DATA FROM DATABASE
                $row=mysqli_fetch_assoc($res);
                $title=$row['title'];
                $price=$row['price'];
                $image_name=$row['image_name'];
            }
            else
            {
                //food not available
                //redirect to home page
                header('location:'.SITEURL);
            }
        }
        else
        {
            //redirect to homepage
            header('location:'.SITEURL);
        }
    ?>

    <!-- Food Search Section Starts -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order:</h2>

            <form action="#" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php 
                            //check whether the image is available or not
                            if($image_name=="")
                            {
                                //image not available
                                echo "<div class='error'>Image Not Available...</div>";
                            }
                            else
                            {
                                //image available
                                ?>
                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Vegetable Fried Rice" class="img-responsive img-curve">
                                <?php
                            }
                        ?>
                        
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">
                        <p class="food-price">₹<?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" min="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Abhishek" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hiabhi299@gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php 
                //check whether submit button is clicked or not
                if(isset($_POST['submit']))
                {
                    //get all the details from the form
                    $food=$_POST['food'];
                    $price=$_POST['price'];
                    $qty=$_POST['qty'];


                    $total=$price * $qty;//total=price x qty

                    $order_date=date("Y-m-d H:i:sa"); //orderr date

                    $status="ordered";//ordered, on delevery,delivered canclled

                    $customer_name=mysqli_real_escape_string($conn, $_POST['full-name']);
                    $customer_contact=mysqli_real_escape_string($conn, $_POST['contact']);
                    $customer_email=mysqli_real_escape_string($conn, $_POST['email']);
                    $customer_address=mysqli_real_escape_string($conn, $_POST['address']);

                    //to save the order in database
                    //create sql to save the data
                    $sql2="INSERT INTO tbl_order SET 
                        food='$food',
                        price='$price',
                        qty='$qty',
                        total='$total',
                        order_date='$order_date',
                        status='$status',
                        customer_name='$customer_name',
                        customer_contact='$customer_contact',
                        customer_email='$customer_email',
                        customer_address='$customer_address'
                    ";


                    //execute the query
                    $res2=mysqli_query($conn,$sql2);

                    //to chech whether the query is executed full or not
                    if($res2==true)
                    {
                        //query is executed
                        $_SESSION['order']="Order Placed Successfully...";
                        header('location:'.SITEURL);
                    }
                    else
                    {
                        //failed to save order
                        $_SESSION['order']="Failed To Order Food...";
                        header('location:'.SITEURL);
                    }
                }
            ?>

        </div>
    </section>
    <!-- Food Search Section Ends -->

    <?php include('partials-front/footer.php'); ?>

    <?php ob_end_flush(); ?>