<?php
include "functions/functions.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Best-Bargain</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Beau+Rivage&display=swap" rel="stylesheet">
</head>

<body>

    <!--Main Container-->
    <div class="main_wrapper">

        <!--Header start-->
        <div class="header_wrapper">

            <a href="index.php"><img id="logo" src="images/Best Bargain5.png" /></a>
            <!-- <img id="banner" src="images/Best Bargain5.png" /> -->
            <div id="banner">
                <h1>Affordable household solutions</h1>
            </div>

            <!--Navigation start-->
            <div class="menubar">

                <!--Menu start-->
                <ul id="menu">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="all_products.php">All Products</a></li>
                    <li><a href="customer/my_account.php">My Account</a></li>
                    <li><a href="#">Sign Up</a></li>
                    <li><a href="cart.php">Shopping Cart</a></li>
                    <li><a href="#">Contact Us</a></li>
                </ul>
                <!--Menu end-->

                <!--Search bar start-->
                <div id="form">
                    <form method="get" action="results.php" enctype="multipart/form-data">
                        <input type="text" name="user_query" placeholder="Search product" style="text-align:center;font-weight:700" />
                        <input type="submit" name="search" value="Search" />
                    </form>
                </div>
                <!--Search bar end-->

            </div>
            <!--Navigation end-->

        </div>
        <!--Header end-->

        <div class="content_wrapper">

            <div id="sidebar">
                <div id="sidebar_title">Categories</div>

                <ul id="cats">
                    <?php getCats(); ?>
                </ul>

                <div id="sidebar_title">Brands</div>

                <ul id="cats">
                    <?php getBrands(); ?>
                </ul>

            </div>

            <div id="content_area">
                <div id="shopping_cart">
                    <span>
                        Welcome Guest <b style="color:yellow;">Shopping Cart-</b>Total items: Total price: <a href="cart.php" style="color:yellow;">
                            Go to Cart</a>
                    </span>
                </div>
                <div id="products_box">
                    <?php

                    if (isset($_GET['search'])) {

                        $search_query = $_GET['user_query'];

                        $get_pro = " SELECT * FROM products WHERE product_keywords OR product_title LIKE '%$search_query%' ";

                        $run_pro = mysqli_query($con, $get_pro);

                        $product_row_count = mysqli_num_rows($run_pro);

                        // echo   $product_row_count;

                        if (!$product_row_count == 0) {

                            while ($row_pro = mysqli_fetch_array($run_pro)) {

                                $pro_id = $row_pro['product_id'];
                                $pro_cat = $row_pro['product_cat'];
                                $pro_brand = $row_pro['product_brand'];
                                $pro_title = $row_pro['product_title'];
                                $pro_price = $row_pro['product_price'];
                                $pro_image = $row_pro['product_image'];

                                echo " 
                       <div id='single_product'> 
                        <div style='height:50px;width:100%;border-bottom:1px solid black;margin-bottom:10px;'>
                        <h5>$pro_title</h5>
                        </div>
                        <img src='admin_area/product_images/$pro_image'/>
                        <p><b>Ksh $pro_price</b></p>
                        <a style='float:left' href='details.php?pro_id=$pro_id'>Details</a>
                        <a style='float:right' href='index.php'><button>Add to Cart</button></a> 
                      </div>
                       ";
                            } //end of while loop
                        } else {
                            echo "<h2>Sorry no products available with that name</h2>";
                        }
                    }
                    ?>
                </div>
            </div>

        </div>

        <div id="footer">
            <h4>&copy; Trevor Toni 2022 Best Bargain.com</h4>
        </div>

    </div>
    <!--Main Container-->
</body>

</html>