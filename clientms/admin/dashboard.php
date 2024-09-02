<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['clientmsaid']==0)) {
  header('location:logout.php');
  } 
     ?>
<!DOCTYPE HTML>
<html>
<head>
<title>Client Management System||Dashboard</title>

<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<!-- Graph CSS -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- jQuery -->
<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'>
<!-- lined-icons -->
<link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
<!-- //lined-icons -->
<script src="js/jquery-1.10.2.min.js"></script>
<script src="js/amcharts.js"></script>	
<script src="js/serial.js"></script>	
<script src="js/light.js"></script>	
<script src="js/radar.js"></script>	
<link href="css/barChart.css" rel='stylesheet' type='text/css' />
<link href="css/fabochart.css" rel='stylesheet' type='text/css' />
<!--clock init-->
<script src="js/css3clock.js"></script>
<!--Easy Pie Chart-->
<!--skycons-icons-->
<script src="js/skycons.js"></script>

<script src="js/jquery.easydropdown.js"></script>

<!--//skycons-icons-->
</head> 
<body>
<div class="page-container">
	<!--/content-inner-->
	<div class="left-content">
		<div class="inner-content">
		
			<?php include_once('includes/header.php');?>
			
			<div class="outter-wp">
				<!--custom-widgets-->
				<div class="custom-widgets">
					<div class="row-one">
						<div class="col-md-4 widget">
							<div class="stats-left ">
								<?php 
$sql ="SELECT ID from tblclient ";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$tclients=$query->rowCount();
?>
								<h5>Total</h5>
								<h4> Clients</h4>
							</div>
							<div class="stats-right">
								<label><?php echo htmlentities($tclients);?></label>
							</div>
							<div class="clearfix"> </div>	
						</div>
						<div class="col-md-4 widget states-mdl">
							<div class="stats-left">
							<?php 
$sql1 ="SELECT ID from tblservices ";
$query1 = $dbh -> prepare($sql1);
$query1->execute();
$results1=$query1->fetchAll(PDO::FETCH_OBJ);
$tser=$query1->rowCount();
?>	
								<h5>Total</h5>
								<h4>Services</h4>
							</div>
							<div class="stats-right">
								<label> <?php echo htmlentities($tser);?></label>
							</div>
							<div class="clearfix"> </div>	
						</div>
						
						<div class="col-md-4 widget">
							<div class="stats-left">
								<?php
$sql6="select  sum(tblservices.ServicePrice) as todaysale
 from tblinvoice 
  join tblservices  on tblservices.ID=tblinvoice.ServiceId where date(PostingDate)=CURDATE()";

  $query6 = $dbh -> prepare($sql6);
  $query6->execute();
  $results6=$query6->fetchAll(PDO::FETCH_OBJ);
  foreach($results6 as $row6)
{

$todays_sale=$row6->todaysale;
}


  ?>
								<h5>Today</h5>
								<h4>Sales($)</h4>
							</div>
							<div class="stats-right">
								<label><?php echo $todays_sale;?></label>
							</div>
							<div class="clearfix"> </div>	
						</div>
						<div class="clearfix"> </div>	
					</div>
				</div>
						</div>
						<div class="outter-wp">
				<!--custom-widgets-->
				<div class="custom-widgets">
					<div class="row-one">
					
						<div class="col-md-4 widget states-mdl">
							<div class="stats-left">
								<?php
$sql7="select  sum(tblservices.ServicePrice) as totalcost
 from tblinvoice 
  join tblservices  on tblservices.ID=tblinvoice.ServiceId where date(PostingDate)=CURDATE()-1;";

  $query7 = $dbh -> prepare($sql7);
  $query7->execute();
  $results7=$query7->fetchAll(PDO::FETCH_OBJ);
  foreach($results7 as $row7)
{

$yest_sale=$row7->totalcost;
}


  ?>
								<h5>Yesterday</h5>
								<h4>Sales($)</h4>
							</div>
							<div class="stats-right">
								<label> <?php echo $yest_sale;?></label>
							</div>
							<div class="clearfix"> </div>	
						</div>
						<div class="col-md-4 widget states-thrd">
							<div class="stats-left">
								<?php
$sql8="select  sum(tblservices.ServicePrice) as totalcost
 from tblinvoice 
  join tblservices  on tblservices.ID=tblinvoice.ServiceId where date(PostingDate)>=(DATE(NOW()) - INTERVAL 7 DAY);";

  $query8 = $dbh -> prepare($sql8);
  $query8->execute();
  $results8=$query8->fetchAll(PDO::FETCH_OBJ);
  foreach($results8 as $row8)
{

$sevendays_sale=$row8->totalcost;
}


  ?>

								<h5>Last Sevendays</h5>
								<h4>Sale($)</h4>
							</div>
							<div class="stats-right">
								<label><?php echo $sevendays_sale;?></label>
							</div>
							<div class="clearfix"> </div>	
						</div>
						<div class="col-md-4 widget states-last">
							<div class="stats-left">
								<?php
$sql9="select  sum(tblservices.ServicePrice) as totalcost
 from tblinvoice 
  join tblservices  on tblservices.ID=tblinvoice.ServiceId";

  $query9 = $dbh -> prepare($sql9);
  $query9->execute();
  $results9=$query9->fetchAll(PDO::FETCH_OBJ);
  foreach($results9 as $row9)
{

$total_sale=$row9->totalcost;
}


  ?>
								<h5>Total</h5>
								<h4>Sales($)</h4>
							</div>
							<div class="stats-right">
								<label><?php echo $total_sale;?></label>
							</div>
							<div class="clearfix"> </div>	
						</div>
						<div class="clearfix"> </div>	
					</div>
				</div>
						</div>
		
		<?php include_once('includes/footer.php');?>
		
	</div>
</div>
<!--//content-inner-->

<?php include_once('includes/sidebar.php');?>
<div class="clearfix"></div>		
</div>
<script>
var toggle = true;

$(".sidebar-icon").click(function() {                
	if (toggle)
	{
		$(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
		$("#menu span").css({"position":"absolute"});
	}
	else
	{
		$(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
		setTimeout(function() {
			$("#menu span").css({"position":"relative"});
		}, 400);
	}

	toggle = !toggle;
});
</script>
<!--js -->
<link rel="stylesheet" href="css/vroom.css">
<script type="text/javascript" src="js/vroom.js"></script>
<script type="text/javascript" src="js/TweenLite.min.js"></script>
<script type="text/javascript" src="js/CSSPlugin.min.js"></script>
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>