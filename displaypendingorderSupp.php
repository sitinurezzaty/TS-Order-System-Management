<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Tomatus Station</title>
        <!-- BOOTSTRAP STYLES-->
        <link href="assets/css/bootstrap.css" rel="stylesheet" />
        <!-- FONTAWESOME STYLES-->
        <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- MORRIS CHART STYLES-->
        <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
        <link href="assets/css/custom.css" rel="stylesheet" />
        <!-- GOOGLE FONTS-->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    </head>

    <head>
        <script type="text/javascript">
            function confirmDelete($orderid)
            {
                if(confirm('Are you sure you want to delete the order?'))
                {
                    window.location.href='deleteorder.php?orderid=' + $orderid;
                }
                else {
                    return false;
                }
            }			
        </script>
        <style>
            .content a:link, a:visited {
                background-color: #f44336;
                color: white;
                padding: 10px 15px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
            }

            a:hover, a:active {
                background-color: red;
            }

            .content{
                font-size: medium;
                /* text-align: center; */
            }
        </style>	
    </head>

    <head>
        <head>
            <link rel="shortcut icon" href="images/favicon.ico" />
        </head>
        <header>
            <?php include 'headerSupp.php'; ?>
        </header>
    </head>

    <body>
        <div id="wrapper">
            <!-- Top Navigation -->
            <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-brand" href="homepageSupp.php">Tomatus Station</a> 
                </div>

                <div style="color: white; padding: 15px 50px 5px 50px; float: right; font-size: 16px;">
                    <a href="logout.php" class="btn btn-danger square-btn-adjust">Logout</a>
                </div>

                <div style="color: white; padding: 15px 50px 5px 50px; float: left; font-size: 16px;">
                    <a href="homepageSupp.php"class="btn btn-danger square-btn-adjust">Order Management System</a> 
                </div>
            </nav>   
            <!-- END NAV TOP  -->

            <!-- Side Navigation to make it look nicer -->
            <nav class="navbar-default navbar-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav" id="main-menu">
                        <?php include 'navigationSupp.php'; ?>
                    </ul>                
                </div>            
            </nav>  
            <!-- END NAV SIDE  -->

            <div id="page-wrapper" >
                <div id="page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 style = "text-align: center">Pending Order</h1>
							<br>
							<br>
                        </div>
                    </div>              
                    <!-- END OF ROW  -->

                    <div class="content">
                        
                        <p>Please be alert! Order will be deleted once you click the button delete!</p>
                        <table class="table">
                            <tr>
                                <th> Order ID </th>
                                <th> Product ID </th>                     
                                <th> Product Name </th>
                                <th> Product Quantity </th>
                                <th> Total Price </th>
                                <th> Order Status </th>                                
                                <th> Action </th>
                            </tr>
                        <?php
                            $conn = OpenCon();

                            /**Value suppID coming from supplierloginaction.php**/
	                        $suppID = $_SESSION['login_supplier'];

                            $sql = "select *
                                    from `order_product` op, `product` p, `orders` o, `supplier` s
                                    where op.productid = p.productid
                                    and o.orderid = op.orderid
                                    and p.supplierid = s.supplierid
                                    and o.orderstatus = 'PENDING'
                                    and s.supplierid = $suppID";
                            
                            $result = $conn->query($sql);

                            if($result-> num_rows > 0) {
                                //output data of each row
                                while($row = $result->fetch_assoc()){
                                                        
                                    $orderid = $row["orderid"];
                                    $proID = $row["productid"];
                                    $product = $row["productname"];                            
                                    $proQty = $row["productqty"];
                                    $totalPrice = $row["totalPrice"];                            
                                    $status = $row["orderstatus"];
                                                            
                                    echo "<tr>";
                                        echo "<td><a href=displayorderdetails.php?orderid=$orderid>$orderid</a></td>";
                                        echo "<td> $proID </td>";
                                        echo "<td> $product </td>";
                                        echo "<td> $proQty </td>";
                                        echo "<td> $totalPrice </td>";
                                        echo "<td> $status </td>";
                                        echo "<td>" ?><button onclick="confirmDelete('<?php echo $orderid ?>')"> DELETE </button> <?php "</td>";
                                    echo "</tr>";
                                }
                            }                                        
                            CloseCon($conn);
                        ?>
                    </div>

                    <table class="table">
						<tr>
							<td colspan="2" align="center">
							    <input type="button" value="Back" onclick="history.back()" />
							</td>
						</tr>
					</table>
                </div>
                <!-- End of page-inner -->
            </div>
            <!-- End of page-wrapper -->
      
                
            <!-- /. WRAPPER  -->
            <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
            <!-- JQUERY SCRIPTS -->
            <script src="assets/js/jquery-1.10.2.js"></script>
            <!-- BOOTSTRAP SCRIPTS -->
            <script src="assets/js/bootstrap.min.js"></script>
            <!-- METISMENU SCRIPTS -->
            <script src="assets/js/jquery.metisMenu.js"></script>
            <!-- MORRIS CHART SCRIPTS -->
            <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
            <script src="assets/js/morris/morris.js"></script>
            <!-- CUSTOM SCRIPTS -->
            <script src="assets/js/custom.js"></script>
        </div>
        <!-- End of div wrapper -->
    </body>
</html>
