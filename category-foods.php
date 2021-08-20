    <?php include('partials-front/menu.php'); ?>

    <?php 
        //CHeck whether id is passed or not
        if(isset($_GET['category_id']))
        {
            //Category id is set and get the id
            $category_id = $_GET['category_id'];
            // Get the CAtegory Title Based on Category ID
            $sql = "SELECT title FROM tbl_category WHERE id=$category_id";

            //Execute the Query
            $res = mysqli_query($conn, $sql);

            //Get the value from Database
            $row = mysqli_fetch_assoc($res);
            //Get the TItle
            $category_title = $row['title'];
        }
        else
        {
            //CAtegory not passed
            //Redirect to Home page
            header('location:'.SITEURL);
        }
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    </head>

    <body>

        <!-- fOOD sEARCH Section Starts Here -->
        <section class="food-search text-center">
            <div class="container">

                <h2><a style="text-decoration: none" href="#" class="text-white">Foods on
                        "<?php echo $category_title; ?>"</a></h2>

            </div>
        </section>
        <!-- fOOD sEARCH Section Ends Here -->



        <!-- fOOD MEnu Section Starts Here -->
        <section class="food-menu">
            <div class="container">
                <h2 class="text-center">Food Menu</h2>

                <?php 
            
                //Create SQL Query to Get foods based on Selected CAtegory
                $sql2 = "SELECT * FROM tbl_food WHERE category_id=$category_id";

                //Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                //Count the Rows
                $count2 = mysqli_num_rows($res2);

                //CHeck whether food is available or not
                if($count2>0)
                {
                    //Food is Available
                    while($row2=mysqli_fetch_assoc($res2))
                    {
                        $id = $row2['id'];
                        $title = $row2['title'];
                        $price = $row2['price'];
                        $description = $row2['description'];
                        $image_name = $row2['image_name'];
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
                                <img width="80%" src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>"
                                    alt="Chicke Hawain Pizza">
                                <?php
                                                    }
                                                ?>

                            </div>
                            <div class="col-md-9">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $title; ?></h5>
                                    <p class="card-text">৳<?php echo $price; ?></p>
                                    <p class="card-text"><small class="text-muted"><?php echo $description; ?></small>
                                    </p>
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
                    //Food not available
                    echo "<div class='error'>Food not Available.</div>";
                }
            
            ?>



                <div class="clearfix"></div>



            </div>

        </section>
        <!-- fOOD Menu Section Ends Here -->
    </body>

    </html>

    <?php include('partials-front/footer.php'); ?>