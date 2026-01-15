<?php include('partials-front/menu.php'); ?>

<?php

    if (isset($_SESSION['login'])) {
        $message = $_SESSION['login'];
        echo "<div id='customAlert'>
            <p>" . htmlspecialchars($message) . "</p>
        </div>";
        unset($_SESSION['login']); 
    }

    if (isset($_SESSION['order'])) {
        $message = $_SESSION['order'];
        echo "<div id='customAlert'>
            <p>" . htmlspecialchars($message) . "</p>
        </div>";
        unset($_SESSION['order']); 
    }

?>



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

    <!-- Categories Section Starts -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
                //sql query to display categories from database
                $sql="SELECT * FROM tbl_category where featured='Yes' AND active='Yes' LIMIT 3";
                //to execute the query
                $res=mysqli_query($conn,$sql);

                //to count rows to check whether the category is available or not
                $count=mysqli_num_rows($res);

                if($count>0)
                {
                    //category available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //get values like id,title,image_name
                        $id=$row['id'];
                        $title=$row['title'];
                        $image_name=$row['image_name'];

                        ?>
                            <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                                <div class="box-3 float-container">
                                    <?php 
                                        //check whether the image is available or not
                                        if($image_name=="")
                                        {
                                            //display a message
                                            echo "<div class='error'>Image Not Available...</div>";
                                        }
                                        else{
                                            //image available
                                            ?>
                                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" style="width:300px" alt="VEG" class="img-responsive img-curve">
                                            <?php
                                        }
                                    ?>
                                    

                                    <h3 class="float-text text-white" ><?php echo $title; ?></h3>
                                </div>
                            </a>
                        <?php
                    }
                }
                else
                {
                    //category not available
                    echo "<div class='error'>Category Not Added...</div>";
                }


            ?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends -->

    <!-- Food Menu Section Starts -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 
                //getting foods from database that are active and featured
                $sql2= "SELECT * FROM tbl_food WHERE featured='Yes' AND active='Yes' LIMIT 6";

                //execute the query
                $res2=mysqli_query($conn,$sql2);

                //count rows
                $count2=mysqli_num_rows($res2);

                //check whether food is available or not
                if($count2>0)
                {
                    //food available
                    while($row=mysqli_fetch_assoc($res2))
                    {
                        //get all the values
                        $id=$row['id'];
                        $title=$row['title'];
                        $price=$row['price'];
                        $description=$row['description'];
                        $image_name=$row['image_name'];
                        ?>
                            <div class="food-menu-box">
                                <div class="food-menu-img">
                                    <?php 
                                        //check whether the image is available or not
                                        if($image_name=="")
                                        {
                                            //image not available
                                            echo "<div class='error'>Image Not Available...</div>";
                                        }
                                        else{
                                            //image available
                                            ?>
                                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Pani Puri" class="img-responsive img-curve">
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
                    echo "<div class='error'>Food Not Available...</div>";
                }

            ?>

            

            <div class="clearfix"></div>
        </div>

    </section>
    <!-- Food Menu Ends -->

    
    <script>
        const message = <?php echo json_encode($message); ?>;
        if (message) {
            const alertBox = document.getElementById('customAlert');
            alertBox.style.display = 'block';

            setTimeout(() => {
            alertBox.style.display = 'none';
            window.location.href = 'index.php'; // Redirect after 3 seconds
            }, 3000);
    }
</script>

    <?php include('partials-front/footer.php'); ?>