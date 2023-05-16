<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");
include_once 'product-action.php';
error_reporting(0);
session_start();


function function_alert()
{


    echo "<script>alert('Thank you. Your Order has been placed!');</script>";
    echo "<script>window.location.replace('your_orders.php');</script>";
}

if (empty($_SESSION["user_id"])) {
    header('location:login.php');
} else {


    foreach ($_SESSION["cart_item"] as $item) {

        $item_total += ($item["price"] * $item["quantity"]);

        if ($_POST['submit']) {

            $SQL = "insert into users_orders(u_id,title,quantity,price) values('" . $_SESSION["user_id"] . "','" . $item["title"] . "','" . $item["quantity"] . "','" . $item["price"] . "')";

            mysqli_query($db, $SQL);


            unset($_SESSION["cart_item"]);
            unset($item["title"]);
            unset($item["quantity"]);
            unset($item["price"]);
            $success = "Thank you. Your order has been placed!";

            function_alert();
        }
    }
?>


    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="#">
        <title>Checkout</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <link href="css/animsition.min.css" rel="stylesheet">
        <link href="css/animate.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
       
        <style>
            button {
                border-radius: 3px;
                background-color: rgb(82, 143, 240);
                text-decoration: none;
                border-width: 0.5px;
                border-color: white;
                width: 240px;
                height: 38px;

            }

            button  a{
                text-decoration: none;
                color: white;
                font-size: initial;
                font-weight: 700;
            }
        </style>

    </head>

    <body>

        <div class="site-wrapper">
            <header id="header" class="header-scroll top-header headrom">
                <nav class="navbar navbar-dark">
                    <div class="container">
                        <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button>
                        <a class="navbar-brand" href="index.php"> <img class="img-rounded" src="images\crypto.png" alt=""> </a>
                        <div class="collapse navbar-toggleable-md  float-lg-right" id="mainNavbarCollapse">
                            <ul class="nav navbar-nav">
                                <li class="nav-item"> <a class="nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a> </li>
                                <li class="nav-item"> <a class="nav-link active" href="restaurants.php">Restaurants <span class="sr-only"></span></a> </li>

                                <?php
                                if (empty($_SESSION["user_id"])) {
                                    echo '<li class="nav-item"><a href="login.php" class="nav-link active">Login</a> </li>
							  <li class="nav-item"><a href="registration.php" class="nav-link active">Register</a> </li>';
                                } else {


                                    echo  '<li class="nav-item"><a href="your_orders.php" class="nav-link active">My Orders</a> </li>';
                                    echo  '<li class="nav-item"><a href="logout.php" class="nav-link active">Logout</a> </li>';
                                }

                                ?>

                            </ul>
                        </div>
                    </div>
                </nav>
            </header>
            <div class="page-wrapper">
                <div class="top-links">
                    <div class="container">
                        <ul class="row links">

                            <li class="col-xs-12 col-sm-4 link-item"><span>1</span><a href="restaurants.php">Choose Restaurant</a></li>
                            <li class="col-xs-12 col-sm-4 link-item "><span>2</span><a href="#">Pick Your favorite food</a></li>
                            <li class="col-xs-12 col-sm-4 link-item active"><span>3</span><a href="checkout.php">Order and Pay</a></li>
                        </ul>
                    </div>
                </div>

                <div class="container">

                    <span style="color:green;">
                        <?php echo $success; ?>
                    </span>

                </div>

                 

                <div class="container m-t-30">
                    <form action="" method="post">
                        <div class="widget clearfix">

                            <div class="widget-body">
                                <form method="post" action="#">
                                    <div class="row">

                                        <div class="col-sm-12">
                                            <div class="cart-totals margin-b-20">
                                                <div class="cart-totals-title">
                                                    <h4>Cart Summary</h4>
                                                </div>
                                                <div class="cart-totals-fields">

                                                    <table class="table">
                                                        <tbody>



                                                            <tr>
                                                                <td>Cart Subtotal</td>
                                                                <td> <?php echo "Rs." . $item_total    ?></td>
                                                               
                                                                <!-- <td>0.00015 BTC</td> -->
                                                            </tr>
                                                            <tr>
                                                                <td>Converted Value </td>
                                                                <td>  <?php
                                                                        $txt = $item_total /157437.82;
                                                                        $eth = number_format( $txt, 5, '. ', '' );
                                            
                                                                        echo  $eth ;


                                                                        
                                                                        ?> ETH 
                                                                        <script type="text/javascript">
                                                                        const ethprice="<?php echo $eth; ?>";
                                                                        console.log(ethprice);
                                                      
                                                                        //js value
                                                                       </script>
                                                                        <script type="text/javascript" src="./client/src/components/Welcome.jsx"></script>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-color"><strong>Total</strong></td>
                                                                <td class="text-color"><strong> <?php echo "Rs." . $item_total; ?></strong></td>

                                                            </tr>
                                                            <tr>
                                                                <td class="text-color">Pay through Crypto Wallet</td>
                                                            </tr>

                                                        </tbody>




                                                    </table>
                                                </div>
                                            </div>
                                            <div class="payment-option " style="display: flex;">
                                                <ul class=" list-unstyled">

                                                    <li>
                                                        <label class="custom-control">
                                                            <button  style="margin-left : 40px;" > <img src="images/mp.jpeg" type="button" id="metamask" alt="" width="30" height="30"><a href="http://localhost:3000/" > Metamask </a> </button>
                                                            <script>
                                                                function me() {
                                                                    console.log("yes it's working");
                                                                    document.getElementById("order").disabled = false;
                                                                   
                                                                }
                                                                setTimeout(me , 3000);
                                                            </script>
                                                    </li>
                                                   
                                                    <li>
                                                        <label class="custom-control">
                                                            <div class="razorpay-embed-btn" onclick="me()" data-url="https://pages.razorpay.com/pl_LcAF9kJVjOhvLd/view" data-text="Razor Pay" data-color="#528FF0" data-size="large">
                                                                <script>
                                                                    (function() {
                                                                        var d = document;
                                                                        var x = !d.getElementById('razorpay-embed-btn-js')
                                                                        if (x) {
                                                                            var s = d.createElement('script');
                                                                            s.defer = !0;
                                                                            s.id = 'razorpay-embed-btn-js';
                                                                            s.src = 'https://cdn.razorpay.com/static/embed_btn/bundle.js';
                                                                            d.body.appendChild(s);
                                                                            console.log(s);
                                                                        } else {
                                                                            var rzp = window['_rzp_'];
                                                                            rzp && rzp.init && rzp.init()
                                                                        }
                                                                    })();
                                                                </script>
                                                                    
                                                            </div>

                                                    </li>
                                                </ul>
                                                <ul class="Pay" style="margin-left :450px">
                                                <li>
                                                        <label class="custom-control">
                                                            <button onclick="me()"> <img src="images/binance.png" alt="" width="30" height="30"><a href="http://localhost:3000/" target="_blank"> Binance </a> </button>

                                                    </li>
                                                    <li>
                                                        <label class="custom-control" style="margin-top: 20px;">
                                                            <button onclick="me()"> <img src="images/ftxlogo.webp" alt="" width="30" height="30"><a href="http://localhost:3000/" target="_blank"> FTX </a> </button>

                                                    </li>


                                                   



                                                </ul>


                                            </div>
                                            <p class="text-xs-center"> <input type="submit" id="order" onclick="return confirm('Do you want to confirm the order?');" name="submit" class="btn btn-success btn-block" value="Order Now"> </p>
                                </form>
                            </div>
                            <script>
                                document.getElementById("order").disabled = true;

                                function Active() {
                                    console.log("workin...");
                                    document.getElementById("order").disabled = false;
                                }
                            </script>
                        </div>

                </div>
            </div>
            </form>
        </div>

        <footer class="footer">
            <div class="row bottom-footer">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-3 payment-options color-gray">
                            <h5>Payment Options</h5>
                            <ul>
                                <li>
                                    <a href="#"> <img src="images/meta.jpeg" alt="Paypal"> </a>
                                </li>
                                <li>
                                    <a href="#"> <img src="images/eth.jpg" alt="Mastercard"> </a>
                                </li>
                                <li>
                                    <a href="#"> <img src="images/bin.png" alt="Maestro"> </a>
                                </li>
                                <li>
                                    <a href="#"> <img src="images/ftx.png" alt="Stripe"> </a>
                                </li>
                                <li>
                                    <a href="#"> <img src="images/bitcoin.png" alt="Bitcoin"> </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-xs-12 col-sm-4 address color-gray">
                            <h5>About</h5>
                            <p>Department of Computer Science</p>
                            <p>ABES Engineering Collage, Ghaziabad</p>
                        </div>
                        <div class="col-xs-12 col-sm-5 additional-info color-gray">
                            <h5>CryptoPay</h5>
                            <p> An Initiative to Normalize Crypto Acceptancy</p>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </footer>
        </div>
        </div>

        <script src="js/jquery.min.js"></script>
        <script src="js/tether.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/animsition.min.js"></script>
        <script src="js/bootstrap-slider.min.js"></script>
        <script src="js/jquery.isotope.min.js"></script>
        <script src="js/headroom.js"></script>
        <script src="js/foodpicky.min.js"></script>
    </body>

</html>

<?php
}
?>