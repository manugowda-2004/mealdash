<?php include('partials-front/menu.php'); ?>

    <!-- Food Search Section Starts -->
    <section class="food-search text-center">
        <div class="container">

            <?php 
                //get the search keyword
                $search=mysqli_real_escape_string($conn, $_POST['search']);

            ?>
            
            <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>

        </div>
    </section>
    <!-- Food Search Section Ends -->



    <!-- Food Menu Section Starts -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 
                //sql query to get food based on searck key
                //$search= fried rice'''
                //"SELECT * FROM tbl_food WHERE title LIKE '%fried rice''%' OR description LIKE '%fried rice''%'";
                $sql= "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

                //execute the query
                $res=mysqli_query($conn,$sql);

                //count rows
                $count=mysqli_num_rows($res);

                //check whether food available or not
                if($count>0)
                {
                    //food available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //to get the details
                        $id=$row['id'];
                        $title=$row['title'];
                        $price=$row['price'];
                        $description=$row['description'];
                        $image_name=$row['image_name'];

                        ?>
                            <div class="food-menu-box">
                                <div class="food-menu-img">

                                    <?php 
                                        //check whether image name is available or not
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
                                    <h4><?php echo $title; ?></h4>
                                    <p class="food-price">₹<?php echo $price; ?></p>
                                    <p class="food-detail">
                                        <?php echo $description; ?>
                                    </p>
                                    <br>

                                    <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                                </div>
                            </div>
                        <?php
                    }
                }
                else
                {
                    //food not available
                    echo "<div class='error'>Food Not Found...</div>";
                }
            ?>

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- Food Menu Section Ends -->

    <?php include('partials-front/footer.php'); ?>