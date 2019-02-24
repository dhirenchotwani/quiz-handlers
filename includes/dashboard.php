<?php
include_once("bootstrap.php");
Session::startSession();
$page="Dashboard";
$test_set=0;
$obj=new User();
$test=new Test();
$user_id=$_SESSION['user_id'];
$res=$obj->getUserWithCondition("user_id",$user_id);
if($row=mysqli_fetch_assoc($res))
	extract($row);

if($user_role_id==5){
	$res=$obj->getUserWithJoinCondition("INNER JOIN student on users.user_id = student.user_id INNER JOIN student_class on student.student_class_id=student_class.student_class_id INNER JOIN branch on student.student_branch=branch.branch_id","users.user_id",$_SESSION['user_id']);
$row=mysqli_fetch_assoc($res);
extract($row);
	$res=$test->getAllLiveTest($student_class_id);		
	}


else if($user_role_id==3){
	$res=$test->getAllLiveTestForTeacher($user_id);
	if($row=mysqli_fetch_assoc($res)){
		extract($row);
	$_SESSION['test_id']=$test_id;
		$test_set=1;
	}
}
//Functions::redirect('includes/login.php');

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Quiz Handlers</title>
  <!-- Favicon -->
  <link href="../assets/img/brand/favicon.png" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="../assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
  <link href="../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
  <!-- Argon CSS -->
  <link type="text/css" href="../assets/css/argon.min.css" rel="stylesheet">
</head>

<body>
   <!-- Sidenav -->
  <?php include_once("templates/sidebar.php"); ?>
  <!-- Sidenav Ends here-->
  
  <!-- Main content -->
  <div class="main-content">
    <!-- Top navbar -->
     <?php include_once("templates/topbar.php"); ?>
      <!-- Top navbar here -->
    <!-- Header -->
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          <!-- Card stats -->
  
          <div class="row">
            <?php
			  if(mysqli_num_rows($res) > 0 ){
			foreach($res as $test){
						extract($test);
			?>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                 <?php
					if($user_role_id==3){
							echo "<a href='showTestStatistics.php'>$test_name</a>";
					}else if($user_role_id==5){
                echo "<a href='startTest.php?q=$test_id'>$test_name</a>"; 
                }
					?>
                </div>
              </div>
            </div>
            <?php
			}
			  }
            ?>
           
           
           
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--7">
      <div class="row" >
        <div class="col-xl-8 mb-5 mb-xl-0">
          <div class="card shadow">
            <div class="card-header bg-transparent">
              <div class="row align-items-center">
                <div class="col">
                  <h6 class="text-uppercase text-light ls-1 mb-1">Overview</h6>
                  <h2 class=" mb-0" style="color:black">Performance Rate</h2>
                </div>
                <div class="col">
                  <ul class="nav nav-pills justify-content-end">
                    <li class="nav-item mr-2 mr-md-0" data-toggle="chart" data-target="#chart-sales" data-update='{"data":{"datasets":[{"data":[0, 20, 10, 30, 15, 40, 20, 60, 60]}]}}' data-prefix="$" data-suffix="k">
                      <a href="#" class="nav-link py-2 px-3 active" data-toggle="tab">
                        <span class="d-none d-md-block">Month</span>
                        <span class="d-md-none">M</span>
                      </a>
                    </li>
                    <li class="nav-item" data-toggle="chart" data-target="#chart-sales" data-update='{"data":{"datasets":[{"data":[0, 20, 5, 25, 10, 30, 15, 40, 40]}]}}' data-prefix="$" data-suffix="k">
                      <a href="#" class="nav-link py-2 px-3" data-toggle="tab">
                        <span class="d-none d-md-block">Week</span>
                        <span class="d-md-none">W</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="card-body" style="background:#fff">
              <!-- Chart -->
              <div class="chart">
                <!-- Chart wrapper -->
                <canvas id="chart-sales" class="chart-canvas" style="background=#fff"></canvas>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4">
          <div class="card shadow">
            <div class="card-header bg-transparent">
              <div class="row align-items-center">
                <div class="col">
                  <h6 class="text-uppercase text-muted ls-1 mb-1">Performance</h6>
                  <h2 class="mb-0">Total Score</h2>
                </div>
              </div>
            </div>
            <div class="card-body">
              <!-- Chart -->
              <div class="chart">
                <canvas id="chart-orders" class="chart-canvas" style="background:#fff"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
   
      
    </div>
  </div>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Optional JS -->
  <script src="../assets/vendor/chart.js/dist/Chart.min.js"></script>
  <script src="../assets/vendor/chart.js/dist/Chart.extension.js"></script>
  <!-- Argon JS -->
  <script src="../assets/js/argon.js?v=1.0.0"></script>
</body>

</html>