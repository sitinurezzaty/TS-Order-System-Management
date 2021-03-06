<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml"></html>
<html>
	<!-- Sidebar CSS -->
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
        <head>
            <link rel="shortcut icon" href="images/favicon.ico">
            <link rel="stylesheet" type="text/css" href="contentStyle.css">
        </head>
        <header>
            <?php include 'headerSupp.php'; ?>
        </header>
    </head>
	
	<body>
		<div id="wrapper">
            <!--TOP NAVIGATION -->
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

            <!-- /. NAV TOP  -->
            <nav class="navbar-default navbar-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav" id="main-menu">
                        <?php include 'navigationSupp.php'; ?>
                    </ul>
                </div>                    
            </nav>
            
            <!-- WRAPPER CONTENT  -->
            <div id="page-wrapper" >
                <div id="page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 style="text-align:center">Invoices</h1>
							<br>
							<br>
                        </div>

                        <!-- INNER PAGE CONTENT  -->
                        <div class = "content">			
                            <article>
                                
                                <table class="table">
                                    <tr>
                                        <th> Invoice ID        </th>
                                        <th> Invoice Date      </th>
                                        <th> Order ID          </th>                   
                                        <th> Product ID        </th>
                                        <th> Product Name      </th>
                                        <th> Product Price(RM) </th>
                                        <th> Product Quantity  </th>
                                        <th> Total Price(RM)   </th>
                                    </tr>
                                <?php
                                    $conn = OpenCon();

                                    /**Value supplierid coming from supplierloginaction.php**/
                                    $suppID = $_SESSION['login_supplier'];
                                    
                                    //get page number
                                    $page = 0;

                                    //set variable
                                    if(isset($_GET["page"])==true) {
                                        $page = ($_GET["page"]);
                                    }
                                    else {
                                        $page = 0;	
                                    }

                                    //algo for pagination in sql
                                    if ($page=="" || $page=="1"){
                                            $page1 = 0;
                                    }
                                    else {
                                        $page1= ($page*4)-4;
                                    }

                                    $sql = "SELECT * FROM `invoice` i, `orders` o, `order_product` op, `product` p
                                            WHERE o.orderid = i.orderid
                                            AND o.orderid = op.orderid
                                            and op.productid = p.productid
                                            and p.supplierid = $suppID
                                            limit $page1,4";

                                    //$sql = "SELECT * FROM `invoice` i";
                                    $result = $conn->query($sql);

                                    if($result->num_rows > 0){
                                        while($row = $result->fetch_assoc()){
                                            $invID = $row["invoiceid"];
                                            $invDate = $row["invoicedate"];
                                            $orderid = $row["orderid"];
                                            $prodID = $row["productid"];
                                            $prodNm = $row["productname"];
                                            $prodPrice = $row["productprice"];
                                            $prodQty = $row["productqty"];
                                            $totalPrice = $row["totalPrice"];

                                            echo "<tr>";
                                                echo "<td>$invID</td>";
                                                echo "<td>$invDate</td>";
                                                echo "<td>$orderid</td>";
                                                echo "<td>$prodID</td>";
                                                echo "<td>$prodNm</td>";
                                                echo "<td>$prodPrice</td>";
                                                echo "<td>$prodQty</td>";
                                                echo "<td>$totalPrice</td>";
                                            echo "</tr>";
                                        }
                                    }
                                    else{
                                        echo "<p>There is no invoices has been made yet!</p>";
                                    }

                                    echo "</table>";

                                    $sql2 = "SELECT count(*) FROM `orders` o, `product` p, `supplier` s
                                            WHERE o.orderproduct = p.productname
                                            AND p.supplierid = s.supplierid
                                            AND o.orderstatus = 'APPROVED'
                                            AND s.supplierid = $suppID";
                                    $result2 = $conn->query($sql2);
                                    $row = $result2 ->fetch_row();
                                    $count = ceil($row[0]/4);
                                    for($pageno=1;$pageno<=$count;$pageno++){
                                        ?><a href="invoicesSupp.php?page=<?php echo $pageno; ?>" style="text-decoration:none"> <?php echo $pageno. " "; ?></a><?php
                                    }

                                    CloseCon($conn);
                                ?>
                            </article>
                        </div>
                        <!-- End of content -->
                    </div>
                    <!-- End of row -->
                </div>
			    <!-- END PAGE INNER  -->
            </div>
            <!-- END PAGE WRAPPER -->
        </div>
        <!-- End div WRAPPER  -->
        
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
		
		
		
	</body>
</html>