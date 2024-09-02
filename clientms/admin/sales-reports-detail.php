<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['clientmsaid']==0)) {
  header('location:logout.php');
  } else{
  	?>

<!DOCTYPE HTML>
<html>
<head>
	<title>Client Management Sysytem || Sales Reports </title>
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
	<!-- /js -->
	<script src="js/jquery-1.10.2.min.js"></script>
	<!-- //js-->
	<script src="
https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js
"></script>
<style>
	.radio-inputs {
  position: relative;
  display: flex;
  flex-wrap: wrap;
  border-radius: 0.5rem;
  background-color: #EEE;
  box-sizing: border-box;
  box-shadow: 0 0 0px 1px rgba(0, 0, 0, 0.06);
  padding: 0.25rem;
  width: 300px;
  font-size: 14px;
  margin: 20px auto;
}

.radio-inputs .radio {
 all: unset;
  flex: 1 1 auto;
  text-align: center;
}

.radio-inputs .radio input {
  display: none;
}

.radio-inputs .radio .name {
  display: flex;
  cursor: pointer;
  align-items: center;
  justify-content: center;
  border-radius: 0.5rem;
  border: none;
  padding: .5rem 0;
  color: rgba(51, 65, 85, 1);
  transition: all .15s ease-in-out;
}

.radio-inputs .radio input:checked + .name {
  background-color: #fff;
  font-weight: 600;
}
</style>
</head> 
<body>
	<div class="page-container">
		<!--/content-inner-->
		<div class="left-content">
			<div class="inner-content">
				<!-- header-starts -->
				<?php include_once('includes/header.php');?>
				<!-- //header-ends -->
				<!--outter-wp-->
				<div class="outter-wp">
					<!--sub-heard-part-->
					<div class="sub-heard-part">
						<ol class="breadcrumb m-b-0">
							<li><a href="dashboard.php">Home</a></li>
							<li class="active">Sales Reports</li>
						</ol>
					</div>
					<!--//sub-heard-part-->
					<div class="graph-visual tables-main">
						
					
						<h3 class="inner-tittle two">Sales Reports </h3>
						<div class="graph">

							<div class="tables">
								 <?php
$fdate=$_POST['fromdate'];
$tdate=$_POST['todate'];
$rtype=$_POST['requesttype'];
?>
<?php if($rtype=='mtwise'){
$month1=strtotime($fdate);
$month2=strtotime($tdate);
$m1=date("F",$month1);
$m2=date("F",$month2);
$y1=date("Y",$month1);
$y2=date("Y",$month2);
    ?>
<h4 class="header-title m-t-0 m-b-30">Sales Report Month Wise</h4>
<h4 align="center" style="color:blue">Sales Report  from <?php echo $m1."-".$y1;?> to <?php echo $m2."-".$y2;?></h4>
<hr />

<div style="width:500px; margin:auto; overflow-x:auto;" id="Chartcontainer">
    <div class="radio-inputs">
        <label class="radio">
            <input type="radio" name="chartType" value="pie" checked onchange="changeChartType()">
            <span class="name">Pie</span>
        </label>
        <label class="radio">
            <input type="radio" name="chartType" value="bar" onchange="changeChartType()">
            <span class="name">Bar</span>
        </label>
        <label class="radio">
            <input type="radio" name="chartType" value="doughnut" onchange="changeChartType()">
            <span class="name">Doughnut</span>
        </label>
		<label class="radio">
            <input type="radio" name="chartType" value="line" onchange="changeChartType()">
            <span class="name">Line</span>
        </label>
    </div>
    <canvas id="salesChart"></canvas>
</div>

<hr>
								<table class="table" border="1"> <thead> <tr>  
									<th>S.NO</th>
<th>Month / Year </th>
<th>Sales</th>
									  </tr>
									   </thead>
									    <tbody>
									    	<?php
$sql="select month(PostingDate) as lmonth,year(PostingDate) as lyear,sum(ServicePrice) as totalprice from  tblinvoice join tblservices on tblservices.ID= tblinvoice.ServiceId where date(tblinvoice.PostingDate) between '$fdate' and '$tdate' group by lmonth,lyear";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
									     <tr class="active">
									      <th scope="row"><?php echo htmlentities($cnt);?></th>
									       
									       <td><?php  echo  $row->lmonth."/".$row->lyear;?></td>
									       <td><?php  echo "$".$total=$row->totalprice;?></td>
									        
									     </tr>
									     <?php
									     $ftotal+=$total;
									      $cnt=$cnt+1;}} ?>
									      <tr>
                  <td colspan="2" align="center">Total </td>
              <td><?php  echo "$".$ftotal;?></td>
   
                 
                 
                </tr>
									     </tbody> </table>
									     <?php } else {
$year1=strtotime($fdate);
$year2=strtotime($tdate);
$y1=date("Y",$year1);
$y2=date("Y",$year2);
 ?>
 <h4 class="header-title m-t-0 m-b-30">Sales Report Year Wise</h4>
    <h4 align="center" style="color:blue">Sales Report  from <?php echo $y1;?> to <?php echo $y2;?></h4>
    <hr /> 

	<div style="width:500px; margin:auto; overflow-x:auto;" id="Chartcontainer">
    <div class="radio-inputs">
        <label class="radio">
            <input type="radio" name="chartType" value="pie" checked onchange="changeChartType()">
            <span class="name">Pie</span>
        </label>
        <label class="radio">
            <input type="radio" name="chartType" value="bar" onchange="changeChartType()">
            <span class="name">Bar</span>
        </label>
        <label class="radio">
            <input type="radio" name="chartType" value="doughnut" onchange="changeChartType()">
            <span class="name">Doughnut</span>
        </label>
		<label class="radio">
            <input type="radio" name="chartType" value="line" onchange="changeChartType()">
            <span class="name">Line</span>
        </label>
    </div>
    <canvas id="salesChart"></canvas>
</div>
<hr>

    <table class="table" border="1"> <thead> <tr>  
									<th>S.NO</th>
<th>Month / Year </th>
<th>Sales</th>
									  </tr>
									   </thead>
									    <tbody>
									    	<?php
$sql="select year(PostingDate) as lyear,sum(ServicePrice) as totalprice from  tblinvoice join tblservices on tblservices.ID= tblinvoice.ServiceId where date(tblinvoice.PostingDate) between '$fdate' and '$tdate' group by lyear";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
									     <tr class="active">
									      <th scope="row"><?php echo htmlentities($cnt);?></th>
									       
									       <td><?php  echo  $row->lyear;?></td>
									       <td><?php  echo "$".$total=$row->totalprice;?></td>
									        
									     </tr>
									     <?php
									     $ftotal+=$total;
									      $cnt=$cnt+1;}} }?>
									      <tr>
                  <td colspan="2" align="center">Total </td>
              <td><?php  echo "$".$ftotal;?></td>
   
                 
                 
                </tr>
									     </tbody> </table>
							</div>

						</div>
				
					</div>
					<!--//graph-visual-->

				</div>
				<!--//outer-wp-->
				<?php include_once('includes/footer.php');?>
			</div>
		</div>
		<!--//content-inner-->
		<!--/sidebar-menu-->
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
	<script src="js/jquery.nicescroll.js"></script>
	<script src="js/scripts.js"></script>
	<!-- Bootstrap Core JavaScript -->
	<script src="js/bootstrap.min.js"></script>
	<script>
   var labels = [];
    var data = [];
    var salesChart; // Declare salesChart in the global scope

    document.addEventListener('DOMContentLoaded', function () {
        // Extract data from table
        var tableRows = document.querySelectorAll('.table tbody tr.active');
        tableRows.forEach(function (row) {
            var year = row.cells[1].textContent.trim();
            var sales = parseFloat(row.cells[2].textContent.trim().replace('$', ''));

            labels.push(year);
            data.push(sales);
        });

		var ctx = document.getElementById('salesChart').getContext('2d');
        salesChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Sales',
                    data: data,
                    backgroundColor: generateRandomColors(data.length),
                    // borderColor: 'rgba(75, 192, 192, 1)',	
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });

    function generateRandomColors(numColors) {
        var colors = [];
        for (var i = 0; i < numColors; i++) {
            colors.push(getRandomColor());
        }
        return colors;
    }

    function getRandomColor() {
        var letters = '0123456789ABCDEF';
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }

    function changeChartType() {
        var selectedType = document.querySelector('input[name="chartType"]:checked').value;
        salesChart.config.type = selectedType;
        salesChart.update();
    }
</script>
</body>
</html>
<?php }  ?>