<?php include('partials-front/menu.php'); ?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

</head>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for Food.." required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php 
                //Display Foods that are Active
                $sql = "SELECT * FROM tbl_food WHERE active='Yes'";

                //Execute the Query
                $res=mysqli_query($conn, $sql);

                //Count Rows
                $count = mysqli_num_rows($res);

                //CHeck whether the foods are availalable or not
                if($count>0)
                {
                    //Foods Available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //Get the Values
                        $id = $row['id'];
                        $title = $row['title'];
                        $description = $row['description'];
                        $price = $row['price'];
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
                    //Food not Available
                    echo "<div class='error'>Food not found.</div>";
                }
            ?>





        <div class="clearfix"></div>



    </div>

</section>
<!-- fOOD Menu Section Ends Here -->

<?php include('partials-front/footer.php'); ?>