<?php include('partials-front/menu.php'); ?>

    <!-- Categories Section Starts -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
                //to display all the category tht are active
                //sql query
                $sql="SELECT * FROM tbl_category WHERE active='Yes'";

                //to execute the query
                $res=mysqli_query($conn,$sql);

                //count rows
                $count=mysqli_num_rows($res);

                //check if the categories are available or not
                if($count>0){
                    //category available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //to get values
                        $id=$row['id'];
                        $title=$row['title'];
                        $image_name=$row['image_name'];

                        ?>
                            <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                                <div class="box-3 float-container">
                                    <?php 

                                    //check whether the image is there or not
                                    if($image_name=="")
                                    {
                                        //not available
                                        echo "<div class='error'>Image Not Found...</div>";
                                    }    
                                    else
                                    {
                                        //image available
                                        ?>
                                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="VEG" class="img-responsive img-curve">
                                        <?php
                                    }

                                    ?>

                                    <h3 class="float-text text-white"><?php echo $title; ?></h3>
                                </div>
                            </a>
                        <?php

                    }
                }
                else
                {
                    //category not available
                    echo "<div class='error'>Category Not Found...</div>";
                }
            ?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends -->

<?php include('partials-front/footer.php'); ?>