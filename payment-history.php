<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
	{	
header('location:index.php');
}
else{
if(isset($_REQUEST['payid']))
	{
	$pmid=intval($_GET['payid']);
    $email=$_SESSION['login'];
	$sql ="SELECT PaymentTime FROM tblpayment WHERE EmailId=:email and id=:pmid";
$query= $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> bindParam(':pmid', $pmid, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
{
	 $fdate=$result->PaymentTime;

	$a=explode("/",$fdate);
	$val=array_reverse($a);
	 $mydate =implode("/",$val);
	$cdate=date('Y/m/d');
	$date1=date_create("$cdate");
	$date2=date_create("$fdate");
 $diff=date_diff($date1,$date2);
 $df=$diff->format("%a");
if($df>1)
{
$status=2;
$cancelby='user';
$sql = "UPDATE tblpayment SET status=:status,CancelledBy=:cancelby WHERE EmailId=:email and id=:pmid";
$query = $dbh->prepare($sql);
$query -> bindParam(':status',$status, PDO::PARAM_STR);
$query -> bindParam(':cancelby',$cancelby , PDO::PARAM_STR);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> bindParam(':pmid',$pmid, PDO::PARAM_STR);
$query -> execute();

$msg="Payment Cancelled successfully!";

  $rec = "$email";
  $subject = "Payment Cancellation!";
  $masg = "Dear Sir/Madam,
You have cancelled the Payment. Please follow the cancellation policy.

Thankyou!";
  
  mail($rec,$subject,$masg);
}
else
{
$error="You can't cancel Payment before 24 hours!";
}
}
}
}



?>
<!DOCTYPE HTML>
<html>
<head>
<title>TBD | Travelers BD</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Travelers BD" />
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
	<script>
		 new WOW().init();
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
<div class="top-header">
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
<!--- /banner-1 ---->
<!--- privacy ---->
<div class="privacy">
	<div class="container">
		<h3 class="wow fadeInDown animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInDown;">My Payment History</h3>
		<form name="chngpwd" method="post" onSubmit="return valid();">
		 <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
	<p>

	<table border="1" width="100%">
<tr align="center">
<th>#</th>
<th>Payment Id</th>
<th>Name</th>
<th>BookingId</th>
<th>Email Id</th>
<th>Credit Card Number</th>
<th>Payment Time</th>
<th>Refund</th>
<th>Status</th>
<th>Action</th>
</tr>

<?php

$sql = "SELECT *FROM tblpayment";
$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{ ?>
<tr align="center">
<td><?php echo htmlentities($cnt);?></td>
<td>ID<?php echo htmlentities($result->id);?></td>
<td><?php echo htmlentities($result->Name);?></td>
<td><?php echo htmlentities($result->BookingId);?></td>
<td><?php echo htmlentities($result->EmailId);?></td>
<td><?php echo htmlentities($result->CreditCardNumber);?></td>
<td><?php echo htmlentities($result->PaymentTime);?></td>
<td><?php echo htmlentities($result->Refund);?></td>


<td><?php if($result->status==0)
{
echo "Pending";
}
if($result->status==1)
{
echo "Confirmed";
}
if($result->status==2 and  $result->CancelBy=='user')
{
echo "Cancelled by user";
} 
if($result->status==2 and $result->CancelBy=='admin')
{
echo "Cancelled by admin ";
}
?></td>

<?php if($result->status==2)
{
  ?><td>Cancelled</td>

<?php } else {?>
<td><a href="payment-history.php?payid=<?php echo htmlentities($result->id);?>" onclick="return confirm('Do you really want to cancel Payment?')" >Cancel</a></td>
<?php }?>
</tr>
<?php $cnt=$cnt+1; }} ?>
  </table>
    
      </p>
      </form>
    
  </div>
</div>
<!--- /privacy ---->
<!--- footer-top ---->
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
<?php } ?>