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
		<head>
			<link rel="shortcut icon" href="images/favicon.ico" />
			<link rel="stylesheet" type="text/css" href="contentStyle.css">
		</head>
	   	<header>
			<?php include 'header.php'; ?>
		</header>
	</head>

	<body>
    	<div id="wrapper">
			<!-- Navigation at the top -->
        	<nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            	<div class="navbar-header">
					<a class="navbar-brand" href="homepage.php">Tomatus Station</a> 
				</div>
				
				<!-- Logout button & register button at the top -->
                <div style="color: white; padding: 15px 50px 5px 50px; float: right; font-size: 16px;">
                    <a href="suppliersignup.php" class="btn btn-danger square-btn-adjust">Supplier Registration</a> 
					<a href="logout.php" class="btn btn-danger square-btn-adjust">Logout</a>
                </div>
				
				<div style="color: white; padding: 15px 50px 5px 50px; float: left; font-size: 16px;">
                    <a href="homepage.php"class="btn btn-danger square-btn-adjust">Order Management System</a> 
				</div>
	   		</nav>   
			<!-- END NAV TOP  -->
			
			<!-- Sidebar Navigation -->
			<nav class="navbar-default navbar-side" role="navigation">
				<div class="sidebar-collapse">
					<ul class="nav" id="main-menu">
						<?php include 'navigation.php'; ?>
					</ul>				
				</div>
			</nav>  
			<!-- END NAV SIDE  -->
			
			<div id="page-wrapper" >
            	<div id="page-inner">
                	<div class="row">
                    	<div class="col-md-12">
                     		<h1 style="text-align: center">List Of Products</h1>
							<br>
							<br>
                    </div>
        
					<div class="content">
						<article>
							
							<table class="table">
								<thead class="thead-dark">
									<tr>
										<th>Product ID</th>
										<th>Supplier ID</th>
										<th>Product Name</th>
										<th>Product Price</th>
										<th>Date Manufactured</th>
									</tr>
								</thead>

							<?php
								$conn = OpenCon();
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

								$sql = "select * from product limit $page1,4";
								$result = $conn ->query($sql);

								if($result-> num_rows > 0) {
									//output data of each row
									while($row = $result->fetch_assoc()){

										$productid = $row["productid"];
										$supplierid = $row["supplierid"];
										$productname =$row["productname"];
										$productprice = $row["productprice"];
										$productmanufactured = $row["productDManufactured"];
									echo "<tr>";
										echo "<td><a href=displayproductdetails.php?productID=$productid>$productid</a></td>";
										echo "<td><a href=displaysupplierdetails.php?supplierID=$supplierid>$supplierid</a></td>";
										echo "<td>$productname</td>";
										echo "<td>$productprice</td>";
										echo "<td>$productmanufactured</td>";
									echo "</tr>";
									}
								}else 
									echo "Error in fetching data";
								
								echo "</table>";

								$sql2 = "select count(*) FROM product";
								$result = $conn->query($sql2);
								$row = $result ->fetch_row();
								$count =ceil($row[0]/4);
								for($pageno=1;$pageno<=$count;$pageno++){
									?><a href="displayproduct.php?page=<?php echo $pageno; ?>" style="text-decoration:whites"> <?php echo $pageno. " "; ?></a><?php
								}

								CloseCon($conn);
							?>
						</article>  
					</div>
             		<!-- END PAGE INNER  -->
           	 	</div>
         		<!-- END PAGE WRAPPER  -->
			</div>
			
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
	</body>
</html>
