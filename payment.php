<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
  { 
header('location:index.php');
}
else{
if(isset($_POST['submit9']))
{
$cname=$_POST['cardname'];
$bbid=$_POST['bcid'];
$email=$_POST['email'];
$ccnum=$_POST['cardnumber'];
$cvv=$_POST['cvv'];
$expdate=$_POST['expdate'];

$sql="INSERT INTO  tblpayment(Name,BookingId,EmailId,CreditCardNumber,CVV,ExpDate) VALUES(:cname,:bbid,:email,:ccnum,:cvv,:expdate)";
$query = $dbh->prepare($sql);
$query->bindParam(':cname',$cname,PDO::PARAM_STR);
$query->bindParam(':bbid',$bbid,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':ccnum',$ccnum,PDO::PARAM_STR);
$query->bindParam(':cvv',$cvv,PDO::PARAM_STR);
$query->bindParam(':expdate',$expdate,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Payment Successfull";
}
else
{
$error="Something went wrong. Please try again";
}

$rec = "$email";
$subject = "Payment Confirmation!";
$masg = "Dear Sir/Madam,

You're payment is successfully done. Please wait for the confirmation e-mail of you're booking.

Thankyou!";
  
  mail($rec,$subject,$masg);
  
}

}
?>


<!DOCTYPE HTML>
<html>
<head>
<title>Travelers BD</title>
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- Custom Theme files -->
<script src="js/jquery-1.12.0.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<!--animate-->
<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">

<script src="js/wow.min.js"></script>

  <script>
     new WOW().init();
  </script>
<script type="text/javascript">
  $(function(){
    var dtToday = new Date();
    
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();
    
    var minDate= year + '-' + month + '-' + day;
    
    $('#txtDate').attr('min', minDate);
});
</script>
  
  <style>
    body {
  font-family: Arial;
  font-size: 17px;
  padding: 10px;
}

* {
  box-sizing: border-box;
}

.row {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  -ms-flex-wrap: wrap; /* IE10 */
  flex-wrap: wrap;
  margin: 0 -16px;
}

.col-25 {
  -ms-flex: 25%; /* IE10 */
  flex: 25%;
}

.col-50 {
  -ms-flex: 50%; /* IE10 */
  flex: 50%;
}

.col-75 {
  -ms-flex: 75%; /* IE10 */
  flex: 75%;
}

.col-25,
.col-50,
.col-75 {
  padding: 0 16px;
}

input[type=text] {
  width: 30%;
  margin-bottom: 20px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

label {
  margin-bottom: 10px;
  display: block;

}

.icon-container {
  margin-bottom: 20px;
  padding: 7px 0;
  font-size: 24px;
}

.btn {
  background-color: #4CAF50;
  color: white;
  padding: 12px;
  margin: 10px 0;
  border: none;
  width: 50%;
  border-radius: 3px;
  cursor: pointer;
  font-size: 17px;
}

.btn:hover {
  background-color: #45a049;
}

a {
  color: #2196F3;
}

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

<div class="container"> 
      <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
        else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>



<form name="payment" method="post">
<div class="privacy">
  
    <div class="row">
  <div class="col-75">
    
<div class="container">
    <h3 class="wow fadeInDown animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInDown;">Payment</h3>
   
    <div class="col-50">  
   
   <label>Accepted Cards</label>
   <div class="icon-container">
      <i class="fa fa-cc-visa" style="color:navy;"></i>
      <i class="fa fa-cc-amex" style="color:blue;"></i>
      <i class="fa fa-cc-mastercard" style="color:red;"></i>
    </div>
    
    <label>Name on Card</label>
    <input type="text" id="cname" name="cardname" pattern="[a-zA-Z\s]*$" placeholder="Enter your Name" required="">
    <label>Booking Id</label>
    <input type="text" id="bbid" name="bcid" pattern="[a-zA-Z0-9]*$" placeholder="Enter your Booking Id" required>
    <label>Email Id</label>
    <input type="text" id="email" name="email" pattern="^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$" placeholder="name@gmail.com" required="">
    <label>Credit card number</label>
    <input type="tel" id="ccnum" name="cardnumber" pattern="[0-9]{4}-[0-9]{4}-[0-9]{4}-[0-9]{4}" placeholder="1111-2222-3333-4444" required="">
    <label>CVV</label>
    <input type="password" id="cvv" name="cvv" pattern="[0-9]{4}" placeholder="4 digit PIN" required="">
    <div>
    <label>Exp Date</label>
    <input type="date" class="date" id="txtDate" name="expdate"s placeholder="yyyy-mm-dd">
    </div>

  </div>
<div class="clearfix"></div>

    <input type="submit" name="submit9" id="submit9" value="Checkout" class="btn">

    <button name="back" id="back" value="Back" class="btn"><a href="tour-history.php" style="color: white">Back</a></button>
<div class="clearfix"></div>

      </form>
    </div>
  </div>
  </div>
</div>
</div>


  
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
