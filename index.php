<?php include('partials-front/menu.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

</head>

<body>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">

            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search Foods" required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php 
        if(isset($_SESSION['order']))
        {
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }
    ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Various Food Categories</h2>

            <?php 
                //Create SQL Query to Display CAtegories from Database
                $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' ORDER BY id DESC LIMIT 3";
                //Execute the Query
                $res = mysqli_query($conn, $sql);
                //Count rows to check whether the category is available or not
                $count = mysqli_num_rows($res);

                if($count>0)
                {
                    //CAtegories Available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //Get the Values like id, title, image_name
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>

            <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                <div class="box-3 float-container">
                    <?php 
                                    //Check whether Image is available or not
                                    if($image_name=="")
                                    {
                                        //Display MEssage
                                        echo "<div class='error'>Image not Available</div>";
                                    }
                                    else
                                    {
                                        //Image Available
                                        ?>
                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza"
                        class="img-responsive img-curve">
                    <?php
                                    }
                                ?>


                    <h3 class="float-text text-white"><mark style="background-color:white;"><?php echo $title; ?></mark>
                    </h3>
                </div>
            </a>

            <?php
                    }
                }
                else
                {
                    //Categories not Available
                    echo "<div class='error'>Category not Added.</div>";
                }
            ?>


            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Our Food Menu</h2>

            <?php 
                
                //Getting Foods from Database that are active and featured
                //SQL Query
                $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6";
    
                //Execute the Query
                $res2 = mysqli_query($conn, $sql2);
    
                //Count Rows
                $count2 = mysqli_num_rows($res2);
    
                //CHeck whether food available or not
                if($count2>0)
                {
                    //Food Available
                    while($row=mysqli_fetch_assoc($res2))
                    {
                        //Get all the values
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];
                        ?>

            <div class="mt-3">
                <div class="card mb-3" style="max-width: 100%; height: 100%">
                    <div class="row g-0">
                        <div class="col-md-3">
                            <?php 
                                                    //Check whether image available or not
                                                    if($image_name=="")
                                                    {
                                                        //Image not Available
                                                        echo "<div class='error'>Image not available.</div>";
                                                    }
                                                    else
                                                    {
                                                        //Image Available
                                                        ?>
                            <img width="100%" src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>"
                                alt="Chicke Hawain Pizza">
                            <?php
                                                    }
                                                ?>

                        </div>
                        <div class="col-md-9">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $title; ?></h5>
                                <p class="card-text">৳<?php echo $price; ?></p>
                                <p class="card-text"><small class="text-muted"><?php echo $description; ?></small></p>
                                <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>"
                                    class="btn btn-success">Order Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php
                    }
                }
                else
                {
                    //Food Not Available 
                    echo "<div class='error'>Food not available.</div>";
                }
                
                ?>
            <div class="clearfix"></div>


        </div>

        <p class="text-center">
            <a class="nav-link" href="#">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->
</body>

</html>


<?php include('partials-front/footer.php'); ?>