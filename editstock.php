<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<head>
<?php
     session_start();
     $r= $_SESSION['lid'];
     if($r!="")
     {
    ?>
<title>FreshShop</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="css/bootstrap.min.css" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href="css/style-responsive.css" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="css/font.css" type="text/css"/>
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons -->
<script src="js/jquery2.0.3.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
<section id="container">
<!--header start-->
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">

    <a href="index.html" class="logo">
        Seller Panel
    </a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>
<!--logo end-->

<div class="nav notify-row" id="top_menu">
    <!--  notification start -->
   
</div>
<div class="top-nav clearfix">
    <!--search & user info start-->
    <ul class="nav pull-right top-menu">
        <li>
            <input type="text" class="form-control search" placeholder=" Search">
        </li>
        <!-- user login dropdown start-->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img alt="" src="images/2.png">
                <span class="username">Seller</span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
            <li><a href="changepd.php"><i class="fa fa-lock"></i> Change Password</a></li>
            <li><a href="logout.php"><i class="fa fa-key"></i> Log Out</a></li>
            </ul>
        </li>
        <!-- user login dropdown end -->
       
    </ul>
    <!--search & user info end-->
</div>
</header>
<!--header end-->
<!--sidebar start-->
<aside>

    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a href="index.php">
                        <i class="fa fa-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Registration</span>
                    </a>
                    <ul class="sub">
						
						<li><a href="stock.php">Stock</a></li>
						<li><a href="product.php">Product</a></li>
					
                    </ul>
                </li>
              
              

                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class=" fa fa-bar-chart-o"></i>
                        <span>Reports</span>
                    </a>
                    <ul class="sub">
                        <li><a href="reportmember.php">Availability Stock</a></li>
                        
                    </ul>
                </li>
                
               
                
            </ul>            </div>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
	<section class="wrapper">
	<div class="form-w3layouts">
        <!-- page start-->
        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                    <?php
include("config.php");
if(isset($_GET["pid"]))
{
	$pid=$_GET["pid"];
	$sql=mysqli_query($con,"SELECT * FROM tbl_stock  WHERE stockid='$pid'");
	$display=mysqli_fetch_array($sql);
}
?>
                        <header class="panel-heading">
                            Edit Product
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" action="" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="name">Product Name</label>
                                        <input type="text" class="form-control" name="name" id="name" onkeyup="Validstrr();" value="<?php echo $display['sname'];?>" placeholder="Enter Name">
                                        <span id="m" style="color:red;"></span> </div>
                                        <script>
                                             function Validstrr() 
                    {
                    var val = document.getElementById('name').value;
                     if (!val.match(/^[a-zA-Z ]*$/)) 
                     {
                     document.getElementById('m').innerHTML="Only alphabets are allowed ";
                       document.getElementById('name').value = "";
					   document.getElementById('name').style.color = "red";
                        return false;
                    }
                    document.getElementById('m').innerHTML=" ";
					document.getElementById('name').style.color = "green";
                   return true;
                    }
                                        </script>
                                    <div class="form-group">
                            <?php
$con=mysqli_connect("localhost","root","","db_grocerystore");


$sql=mysqli_query($con,"select * from tbl_category WHERE cstatus=0"); 
?>
<label>Category Name</label><br>

     
<select   name="cid" id="category" onchange="showResult(this.value)" class="form-control m-bot15" required >
<option value="">--select--</option>
<?php
while($row=mysqli_fetch_array($sql))
{

?>
<option value="<?php echo $row[0] ?>" ><?php echo $row[1] ?></option>

<?php
	
}
?>

</select></div>
<div class="form-group">
<?php
$con=mysqli_connect("localhost","root","","db_grocerystore");


$sql=mysqli_query($con,"select * from tbl_subcategory WHERE sstatus=0"); 
?>
<label>Subcategory Name</label><br>

     
<select   name="sid" id="sub_category" onchange="showResult(this.value)" class="form-control m-bot15" required >
<option value="">--select--</option>
<?php
while($row=mysqli_fetch_array($sql))
{

?>
<option value="<?php echo $row[0] ?>" ><?php echo $row[2] ?></option>
<?php
	
}
?>

</select></div>                     
                                      
                                   
                                    <div class="panel-body">

                                   <div class="row">
                                     
                                    <div class="col-md-4 form-group">
                                    <label for="qua">StockIn</label>
                                <input type="number"  class="form-control" min="1" value="<?php echo $display['stockin'];?>"  name="quantity">
                                
                            </div>
                            
                            <div class="col-md-3 form-group">
                            
                                    <label for="measure">Measure In </label>
                                    <select class="form-control m-bot15" value="<?php echo $display['measure'];?>"  name="measure" required>
                                    <option>---Select---</option>
                                <option>Kg</option>
                                <option>Lr</option>
                                <option>Gr</option>
                                
                            </select>
                                
                                
                            </div>
                            <div class="col-md-4 form-group">
                                    <label for="price">TotalAmount</label>
                                <input type="number"  class="form-control" value="<?php echo $display['totalamount'];?>"  name="price">
                            </div>
                            
</div>
</div><button type="submit" name="btnsubmit"class="btn btn-info">Submit</button>
                            </form>
                            </div>

                        </div>
                    </section>  </div>
            <div class="col-lg-12">   
            </div>
        </div>
        <div class="row">
            
        </div>
        <?php
include("config.php");

if(isset($_POST["btnsubmit"]))
{

    $Name=$_POST['name'];
    $sid=$_POST['sid'];
    $Q=$_POST['quantity'];
    $m=$_POST['measure'];
    $price=$_POST['price'];
    if($Name!="")
{
	$s=mysqli_query($con,"SELECT count(*) as count FROM tbl_stock WHERE sname='$Name'And stockid!=$pid And lid='$r'");
  		$display=mysqli_fetch_array($s);
  		if($display['count']>0)
		{
			$_SESSION['vstatus'] = "Sry!!Already Exit The Name";
            echo "<script>window.location='stock.php'</script>";
		}
		else
		{
    $sql=mysqli_query($con,"UPDATE tbl_stock SET sid='$sid',sname='$Name',stockin='$Q',astock='$Q',measure='$m',totalamount='$price' WHERE stockid='$pid'");
	if($sql)
	{
		
		$_SESSION['vstatus'] = "Updated Successfully";
        echo "<script>window.location='stock.php'</script>";
       
	}
}
}
}
?>       
 <!-- footer -->
 <!-- / footer -->
</section>
<!--main content end-->
</section>
<script src="js/bootstrap.js"></script>
<script src="js/jquery.dcjqaccordion.2.7.js"></script>
<script src="js/scripts.js"></script>
<script src="js/jquery.slimscroll.js"></script>
<script src="js/jquery.nicescroll.js"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="js/jquery.scrollTo.js"></script>
<script>
$(document).ready(function() {
 $('#category').on('change', function() {
   var category_id = this.value;
   $.ajax({
    url: "get_subcat.php",
    type: "POST",
    data: {
     category_id: category_id
    },
    cache: false,
    success: function(dataResult){
     $("#sub_category").html(dataResult);
    }
   });});
});</script>
</body>
</html>
<?php }  else { 
  	header("location:../Guest/index.php");
} ?>