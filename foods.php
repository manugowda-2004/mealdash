<?php include('partials-front/menu.php'); ?>

    <!-- Food Search Section Starts -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- Food Search Section Ends -->



    <!-- Food Menu Section Starts -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
                //display foods that are active
                $sql="SELECT * FROM tbl_food Where active='Yes'";

                //execute the query
                $res=mysqli_query($conn,$sql);

                //count rows
                $count=mysqli_num_rows($res);

                //check whether the food are available
                if($count>0)
                {
                    //foods available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //get values like id ,title etc
                        $id=$row['id'];
                        $title=$row['title'];
                        $price=$row['price'];
                        $description=$row['description'];
                        $image_name=$row['image_name'];

                        ?>
                            <div class="food-menu-box">
                                <div class="food-menu-img">
                                    <?php 
                                        //check whether image is available or not
                                        if($image_name=="")
                                        {
                                            //image is not available
                                            echo "<div class='error'>Image Not Available...</div>";
                                        }else
                                        {
                                            //image is available
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
                    //foods not available
                    echo "<div class='error'>Food Not Found...</div>";
                }
            ?>

            

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- Food Menu Section Ends -->

    <?php include('partials-front/footer.php'); ?>