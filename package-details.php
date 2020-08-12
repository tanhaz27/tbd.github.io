<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_POST['submit2']))
{
$pid=intval($_GET['pkgid']);
$useremail=$_SESSION['login'];
$fromdate=$_POST['fromdate'];
$todate=$_POST['todate'];
$pprice=$_POST['packageprice'];
$member=$_POST['member'];
$amount=$_POST['amount'];
$status=0;
$sql="INSERT INTO tblbooking(PackageId,UserEmail,FromDate,ToDate,PackagePrice,Member,TotalAmount,status) VALUES(:pid,:useremail,:fromdate,:todate,:pprice,:member,:amount,:status)";
$query = $dbh->prepare($sql);
$query->bindParam(':pid',$pid,PDO::PARAM_STR);
$query->bindParam(':useremail',$useremail,PDO::PARAM_STR);
$query->bindParam(':fromdate',$fromdate,PDO::PARAM_STR);
$query->bindParam(':todate',$todate,PDO::PARAM_STR);
$query->bindParam(':pprice',$pprice,PDO::PARAM_STR);
$query->bindParam(':member',$member,PDO::PARAM_STR);
$query->bindParam(':amount',$amount,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Booked Successfully";

$rec = "$useremail";
$subject = "Booking Confirmation!";
$masg = "Dear Sir/Madam,

You have successfully booked the package. Please complete the payment procedures.

Thankyou!";
	
	mail($rec,$subject,$masg);

}
else 
{
$error="Something went wrong. Please try again";
}


}
?>
<!DOCTYPE HTML>
<html>
<head>
<title>TBD | Package Details</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="applijewelleryion/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
<link href="css/font-awesome.css" rel="stylesheet">
<!-- Custom Theme files -->
<script src="js/jquery-1.12.0.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<!--animate-->
<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="js/wow.min.js"></script>
<link rel="stylesheet" href="css/jquery-ui.css" />
	<script>
		 new WOW().init();
	</script>
<script src="js/jquery-ui.js"></script>
	<script>
	var dateToday = new Date(); 
	 $(function() {
		$( "#datepicker,#datepicker1" ).datepicker({minDate: dateToday
    })
		})
</script>

<script type="text/javascript">
    function calculateAmount(member,pprice) {

    	var p = document.getElementById('pprice').value;
        var q = document.getElementById('member').value;
        
        var tot_price = q * p;
                /*display the result*/
         var divobj = document.getElementById('amount');

          divobj.value = tot_price;
      }

</script>

 <style>
		.errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
		</style>				
</head>
<body>
<!-- top-header -->
<?php include('includes/header.php');?>

<div class="container">
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
      <div class="item active">
        <img src="images/cover1.jpg" alt="" style="width:100%;">
      </div>

      <div class="item">
        <img src="images/cover2.jpg" alt="" style="width:100%;">
      </div>
    
      <div class="item">
        <img src="images/cover3.jpg" alt="" style="width:100%;">
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
</div>
	
</div>
<!--- /banner ---->
<!--- selectroom ---->
<div class="selectroom">
	<div class="container">
	 <h1><center>Tour Package Details</center></h1>
	</div>

	<div class="container">	
		  <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
<?php 
$pid=intval($_GET['pkgid']);
$sql = "SELECT * from tbltourpackages where PackageId=:pid";
$query = $dbh->prepare($sql);
$query -> bindParam(':pid', $pid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{	?>

<form name="book" method="post">
  <div class="selectroom_top">
	<div class="col-md-4 selectroom_left wow fadeInLeft animated" data-wow-delay=".5s">
	 <img src="admin/pacakgeimages/<?php echo htmlentities($result->PackageImage);?>" class="img-responsive" alt="">
	</div>
	<div class="col-md-8 selectroom_right wow fadeInRight animated" data-wow-delay=".5s">

	<h2><?php echo htmlentities($result->PackageName);?></h2>
	<p class="grand"><b>Package Price : <?php echo htmlentities($result->PackagePrice);?>$</b></p>
	<p class="dow">#PKG-<?php echo htmlentities($result->PackageId);?></p> 
	<p><b>Package Type :</b> <?php echo htmlentities($result->PackageType);?></p>
	<p><b>Package Location :</b> <?php echo htmlentities($result->PackageLocation);?></p>
	<p><b>Features</b> <?php echo htmlentities($result->PackageFetures);?></p>
		
</div>
    <div class="clearfix"></div>

   <div>
	<div class="selectroom_top">
	  <h3>Package Details</h3>
		<p style="padding-top: 1%"><?php echo htmlentities($result->PackageDetails);?> </p>	
	</div>
	</div>
	
	<?php if($_SESSION['login'])
		{?>
		<div class="ban-bottom">
		<div class="bnr-right">
		<label class="inputLabel">From</label>
		<input class="date" id="datepicker" type="text" placeholder="yyyy-mm-dd"  name="fromdate" required="">
		</div>
		<div class="bnr-right">
		<label class="inputLabel">To</label>
		<input class="date" id="datepicker1" type="text" placeholder="yyyy-mm-dd" name="todate" required="">
		</div>
		</div>
		
		<div class="clearfix"></div>

	
	<div class="bnr-right">
	  <label class="inputLabel">Package Price</label>
		<input type="text" class="packageprice" name="packageprice" id="pprice" value="<?php echo htmlentities($result->PackagePrice);?>" onchange="calculateAmount(this.value,'member')" readonly>$
	  </div>
	  <div class="bnr-right">
		<div>
		<label class="inputLabel">Member </label>
		<select class="member" name="member" id="member" onchange="calculateAmount(this.value,'pprice')"  required>
			<option>Choose your option</option>
			<option value="1">1 person</option>
			<option value="2">2 person</option>
			<option value="3">3 person</option>
			<option value="4">4 person</option>
			<option value="5">5 person</option>
	    </select>
	  </div>
</div>
	  	<div class="clearfix"></div>

	    <div class="bnr-right">
        <label class="inputLabel"><b>Total Amount</b></label>
        <input name="amount" id="amount" type="text" readonly/>$
	</div>
    
    <div class="clearfix"></div>
	
	<div class="selectroom_top">
	  
	   <div class="selectroom-info animated wow fadeInUp animated" data-wow-duration="1200ms" data-wow-delay="500ms" style="visibility: visible; animation-duration: 1200ms; animation-delay: 500ms; animation-name: fadeInUp; margin-top: -70px">
		<ul>
		
	<li class="spe" align="center">
		<button type="submit" name="submit2" class="btn-primary btn">Book</button>
	</li>
	
		<?php } else { ?>
	

	  <h2 align="center">Login to Book packages</h2>
      
	

		<?php } ?>

	

		<div class="clearfix"></div>
	
	</div>
	</div>
	</ul>
</div>
	</form>
</div>

<?php }} ?>

</div>

<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5e5c1884298c395d1cea9494/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->

<!--- /selectroom ---->
<!--- /footer-top ---->
<?php include('includes/footer.php');?>
<!-- signup -->
<?php include('includes/signup.php');?>			
<!-- //signu -->
<!-- signin -->
<?php include('includes/signin.php');?>			
<!-- //signin -->
<!-- write us -->
<?php include('includes/write-us.php');?>
</body>
</html>