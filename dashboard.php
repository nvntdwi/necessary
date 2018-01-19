<?php 
include "koneksi.php";
session_start();
  if (isset($_SESSION['nik']))
{
  $a=mysql_query("select * from tbl_pic where nik = '".$_SESSION['nik']."'");
  $b=mysql_fetch_array($a);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>OTICS WELFARE INVENTORY</title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="vendors/iCheck/skins/flat/green.css" rel="stylesheet">
	
    <!-- bootstrap-progressbar -->
    <link href="vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title"  style="border: 0; background-color: #F1f1f2;">
              <a href="dashboard.php" class="site_title"><i style="border:0px; margin-left: -1px"><img src="images/lot.png" height="30px"></i> <span><img src="images/tulisan.png" height="30px"></span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <?php 
                  if (!empty($b['photo'])){
                    echo"
                      <img src='images/profile/$b[photo]' class='img-circle profile_img' height='55px' width='50px'>
                    ";
                  }
                  else{
                    echo"
                      <img src='production/images/img.jpg' class='img-circle profile_img'>
                    ";
                  }
                ?>
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>
                  <?php 
                    echo"
                      $b[nama]
                    ";
                  ?>
                </h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a href="dashboard.php"><i class="fa fa-home"></i> Dashboard</a></li>
                  <li><a href="index_item.php"><i class="fa fa-bars"></i> Item</a></li>                  
                  <li><a href="jatah.php"><i class="fa fa-user"></i>Jatah Karyawan</a></li>
				  <li><a><i class="fa fa-file-pdf-o"></i> Report <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="index_item_in.php">Report Item In</a></li>
                      <li><a href="index_item_out.php">Report Item Out</a></li>
					  <li><a href="index_jatah.php">Report Jatah</a></li>
                    </ul>
                  </li>
				  <li><a><i class="fa fa-users"></i> Training <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="trainee.php">Jatah Training</a></li>
                      <li><a href="report_jatah.php">Report Jatah Training</a></li>
                    </ul>
                  </li>
				  <?php
                    if($b['level'] == 'superadmin'){
                    echo"
                      <li><a href='index_pic.php'><i class='fa fa-key'></i> PIC</a></li>
                    ";
                    }
                  ?>
                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->
			
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <?php 
                      if (!empty($b['photo'])){
                        echo"
                          <img src='images/profile/$b[photo]'>
                        ";
                      }
                      else{
                        echo"
                          <img src='production/images/lot.png'>
                        ";
                      }
                    ?>
                    <?php 
                      echo"
                        $b[nama]
                      ";
                    ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="proses.php?admin=logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="row tile_count">
            
          </div>
          <!-- /top tiles -->

          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="dashboard_graph">

                <div class="row x_title">
                  <div class="col-md-6">
                    <h3>Stok Hari Berjalan</h3>
                  </div>
                </div>
				
				 <h3><center><b>Baju Pria</b></small></h3>
				<div class="row tile_count">
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class=""></i><center>Baju Pria S</center></span>
                <?php
                  $query = mysql_query("SELECT SUM(qty) AS total FROM tbl_item where item = 'baju pria' and size = 's'");
                  $data = mysql_fetch_array($query);
                  if($data['total'] <= 10){
                    echo "
                      <div class='count red'>
                    ";
                  }else{
                    echo "
                      <div class='count'>
                    ";
                  }
                  echo"
                    <center>
                      ".$data['total']."
                    </center>
                  </div>
                  ";
                ?>
            </div>
			<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class=""></i><center>Baju Pria M</center></span>
                <?php
                  $query = mysql_query("SELECT SUM(qty) AS total FROM tbl_item where item = 'baju pria' and size = 'M'");
                  $data = mysql_fetch_array($query);
                  if($data['total'] <= 10){
                    echo "
                      <div class='count red'>
                    ";
                  }else{
                    echo "
                      <div class='count'>
                    ";
                  }
                  echo"
                    <center>
                      ".$data['total']."
                    </center>
                  </div>
                  ";
                ?>
            </div>
			<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class=""></i><center>Baju Pria L</center></span>
                <?php
                  $query = mysql_query("SELECT SUM(qty) AS total FROM tbl_item where item = 'baju pria' and size = 'l'");
                  $data = mysql_fetch_array($query);
                  if($data['total'] <= 10){
                    echo "
                      <div class='count red'>
                    ";
                  }else{
                    echo "
                      <div class='count'>
                    ";
                  }
                  echo"
                    <center>
                      ".$data['total']."
                    </center>
                  </div>
                  ";
                ?>
            </div>
			<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class=""></i><center>Baju Pria XL</center></span>
                <?php
                  $query = mysql_query("SELECT SUM(qty) AS total FROM tbl_item where item = 'baju pria' and size = 'xl'");
                  $data = mysql_fetch_array($query);
                  if($data['total'] <= 10){
                    echo "
                      <div class='count red'>
                    ";
                  }else{
                    echo "
                      <div class='count'>
                    ";
                  }
                  echo"
                    <center>
                      ".$data['total']."
                    </center>
                  </div>
                  ";
                ?>
            </div>
			<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class=""></i><center>Baju Pria XXL</center></span>
                <?php
                  $query = mysql_query("SELECT SUM(qty) AS total FROM tbl_item where item = 'baju pria' and size = 'xxl'");
                  $data = mysql_fetch_array($query);
                  if($data['total'] <= 10){
                    echo "
                      <div class='count red'>
                    ";
                  }else{
                    echo "
                      <div class='count'>
                    ";
                  }
                  echo"
                    <center>
                      ".$data['total']."
                    </center>
                  </div>
                  ";
                ?>
            </div>
			<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class=""></i><center>Baju Pria XXXL</center></span>
                <?php
                  $query = mysql_query("SELECT SUM(qty) AS total FROM tbl_item where item = 'baju pria' and size = 'xxxl'");
                  $data = mysql_fetch_array($query);
                  if($data['total'] <= 10){
                    echo "
                      <div class='count red'>
                    ";
                  }else{
                    echo "
                      <div class='count'>
                    ";
                  }
                  echo"
                    <center>
                      ".$data['total']."
                    </center>
                  </div>
                  ";
                ?>
            </div>
		</div>
		
		<h3><center><b>Baju Wanita</b></small></h3>
		<div class="row tile_count">
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class=""></i><center>Lengan Pendek <br> S</center></span>
                <?php
                  $query = mysql_query("SELECT SUM(qty) AS total FROM tbl_item where item like 'baju wanita pendek' and size ='s'");
                  $data = mysql_fetch_array($query);
                  if($data['total'] <= 10){
                    echo "
                      <div class='count red'>
                    ";
                  }else{
                    echo "
                      <div class='count'>
                    ";
                  }
                  echo"
                    <center>
                      ".$data['total']."
                    </center>
                  </div>
                  ";
                ?>
            </div>
			<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class=""></i><center>Lengan Pendek <br> M</center></span>
                <?php
                  $query = mysql_query("SELECT SUM(qty) AS total FROM tbl_item where item like 'baju wanita pendek' and size ='m'");
                  $data = mysql_fetch_array($query);
                  if($data['total'] <= 10){
                    echo "
                      <div class='count red'>
                    ";
                  }else{
                    echo "
                      <div class='count'>
                    ";
                  }
                  echo"
                    <center>
                      ".$data['total']."
                    </center>
                  </div>
                  ";
                ?>
            </div>
			<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class=""></i><center>Lengan Pendek <br> L</center></span>
                <?php
                  $query = mysql_query("SELECT SUM(qty) AS total FROM tbl_item where item like 'baju wanita pendek' and size ='l'");
                  $data = mysql_fetch_array($query);
                  if($data['total'] <= 10){
                    echo "
                      <div class='count red'>
                    ";
                  }else{
                    echo "
                      <div class='count'>
                    ";
                  }
                  echo"
                    <center>
                      ".$data['total']."
                    </center>
                  </div>
                  ";
                ?>
            </div>
			<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class=""></i><center>Lengan Pendek <br> XL</center></span>
                <?php
                  $query = mysql_query("SELECT SUM(qty) AS total FROM tbl_item where item like 'baju wanita pendek' and size ='xl'");
                  $data = mysql_fetch_array($query);
                  if($data['total'] <= 10){
                    echo "
                      <div class='count red'>
                    ";
                  }else{
                    echo "
                      <div class='count'>
                    ";
                  }
                  echo"
                    <center>
                      ".$data['total']."
                    </center>
                  </div>
                  ";
                ?>
            </div>
		</div>
			
		<div class="row tile_count">
			<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class=""></i><center>Lengan Panjang <br> S</center></span>
                <?php
                  $query = mysql_query("SELECT SUM(qty) AS total FROM tbl_item where item like 'baju wanita panjang' and size ='s'");
                  $data = mysql_fetch_array($query);
                  if($data['total'] <= 10){
                    echo "
                      <div class='count red'>
                    ";
                  }else{
                    echo "
                      <div class='count'>
                    ";
                  }
                  echo"
                    <center>
                      ".$data['total']."
                    </center>
                  </div>
                  ";
                ?>
            </div>
			<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class=""></i><center>Lengan Panjang <br> M</center></span>
                <?php
                  $query = mysql_query("SELECT SUM(qty) AS total FROM tbl_item where item like 'baju wanita panjang' and size ='m'");
                  $data = mysql_fetch_array($query);
                  if($data['total'] <= 10 && $data['total'] >= 6){
                    echo "
                      <div class='count white'>
                    ";
                  }
				  else{
                    echo "
                      <div class='count'>
                    ";
                  }
                  echo"
                    <center>
                      ".$data['total']."
                    </center>
                  </div>
                  ";
                ?>
            </div>
			<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class=""></i><center>Lengan Panjang <br> L</center></span>
                <?php
                  $query = mysql_query("SELECT SUM(qty) AS total FROM tbl_item where item like 'baju wanita panjang' and size ='l'");
                  $data = mysql_fetch_array($query);
                  if($data['total'] <= 10){
                    echo "
                      <div class='count red'>
                    ";
                  }else{
                    echo "
                      <div class='count'>
                    ";
                  }
                  echo"
                    <center>
                      ".$data['total']."
                    </center>
                  </div>
                  ";
                ?>
            </div>
			<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class=""></i><center>Lengan Panjang <br> XL</center></span>
                <?php
                  $query = mysql_query("SELECT SUM(qty) AS total FROM tbl_item where item like 'baju wanita panjang' and size ='xl'");
                  $data = mysql_fetch_array($query);
                  if($data['total'] <= 10){
                    echo "
                      <div class='count red'>
                    ";
                  }else{
                    echo "
                      <div class='count'>
                    ";
                  }
                  echo"
                    <center>
                      ".$data['total']."
                    </center>
                  </div>
                  ";
                ?>
            </div>
			</div>
		
			<h3><center><b>Celana</b></small></h3>
			<div class="row tile_count">
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class=""></i><center>Celana-27</center></span>
                <?php
                  $query = mysql_query("SELECT SUM(qty) AS total FROM tbl_item where item = 'celana' and size = '27'");
                  $data = mysql_fetch_array($query);
                  if($data['total'] <= 10){
                    echo "
                      <div class='count red'>
                    ";
                  }else{
                    echo "
                      <div class='count'>
                    ";
                  }
                  echo"
                    <center>
                      ".$data['total']."
                    </center>
                  </div>
                  ";
                ?>
			  </div>
			  <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class=""></i><center>Celana-28</center></span>
                <?php
                  $query = mysql_query("SELECT SUM(qty) AS total FROM tbl_item where item = 'celana' and size = '28'");
                  $data = mysql_fetch_array($query);
                  if($data['total'] <= 10){
                    echo "
                      <div class='count red'>
                    ";
                  }else{
                    echo "
                      <div class='count'>
                    ";
                  }
                  echo"
                    <center>
                      ".$data['total']."
                    </center>
                  </div>
                  ";
                ?>
			  </div>
			  <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class=""></i><center>Celana-29</center></span>
                <?php
                  $query = mysql_query("SELECT SUM(qty) AS total FROM tbl_item where item = 'celana' and size = '29'");
                  $data = mysql_fetch_array($query);
                  if($data['total'] <= 10){
                    echo "
                      <div class='count red'>
                    ";
                  }else{
                    echo "
                      <div class='count'>
                    ";
                  }
                  echo"
                    <center>
                      ".$data['total']."
                    </center>
                  </div>
                  ";
                ?>
			  </div>
			  <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class=""></i><center>Celana-30</center></span>
                <?php
                  $query = mysql_query("SELECT SUM(qty) AS total FROM tbl_item where item = 'celana' and size = '30'");
                  $data = mysql_fetch_array($query);
                  if($data['total'] <= 10){
                    echo "
                      <div class='count red'>
                    ";
                  }else{
                    echo "
                      <div class='count'>
                    ";
                  }
                  echo"
                    <center>
                      ".$data['total']."
                    </center>
                  </div>
                  ";
                ?>
			  </div>
			  <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class=""></i><center>Celana-31</center></span>
                <?php
                  $query = mysql_query("SELECT SUM(qty) AS total FROM tbl_item where item = 'celana' and size = '31'");
                  $data = mysql_fetch_array($query);
                  if($data['total'] <= 10){
                    echo "
                      <div class='count red'>
                    ";
                  }else{
                    echo "
                      <div class='count'>
                    ";
                  }
                  echo"
                    <center>
                      ".$data['total']."
                    </center>
                  </div>
                  ";
                ?>
			  </div>
			 </div>
			 <div class="row tile_count">
			  <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class=""></i><center>Celana-32</center></span>
                <?php
                  $query = mysql_query("SELECT SUM(qty) AS total FROM tbl_item where item = 'celana' and size = '32'");
                  $data = mysql_fetch_array($query);
                  if($data['total'] <= 10){
                    echo "
                      <div class='count red'>
                    ";
                  }else{
                    echo "
                      <div class='count'>
                    ";
                  }
                  echo"
                    <center>
                      ".$data['total']."
                    </center>
                  </div>
                  ";
                ?>
			  </div>
			  <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class=""></i><center>Celana-33</center></span>
                <?php
                  $query = mysql_query("SELECT SUM(qty) AS total FROM tbl_item where item = 'celana' and size = '33'");
                  $data = mysql_fetch_array($query);
                  if($data['total'] <= 10){
                    echo "
                      <div class='count red'>
                    ";
                  }else{
                    echo "
                      <div class='count'>
                    ";
                  }
                  echo"
                    <center>
                      ".$data['total']."
                    </center>
                  </div>
                  ";
                ?>
			  </div>
			  <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class=""></i><center>Celana-34</center></span>
                <?php
                  $query = mysql_query("SELECT SUM(qty) AS total FROM tbl_item where item = 'celana' and size = '34'");
                  $data = mysql_fetch_array($query);
                  if($data['total'] <= 10){
                    echo "
                      <div class='count red'>
                    ";
                  }else{
                    echo "
                      <div class='count'>
                    ";
                  }
                  echo"
                    <center>
                      ".$data['total']."
                    </center>
                  </div>
                  ";
                ?>
			  </div>
			  <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class=""></i><center>Celana-35</center></span>
                <?php
                  $query = mysql_query("SELECT SUM(qty) AS total FROM tbl_item where item = 'celana' and size = '35'");
                  $data = mysql_fetch_array($query);
                  if($data['total'] <= 10){
                    echo "
                      <div class='count red'>
                    ";
                  }else{
                    echo "
                      <div class='count'>
                    ";
                  }
                  echo"
                    <center>
                      ".$data['total']."
                    </center>
                  </div>
                  ";
                ?>
			  </div>
			  <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class=""></i><center>Celana-36</center></span>
                <?php
                  $query = mysql_query("SELECT SUM(qty) AS total FROM tbl_item where item = 'celana' and size = '36'");
                  $data = mysql_fetch_array($query);
                  if($data['total'] <= 10){
                    echo "
                      <div class='count red'>
                    ";
                  }else{
                    echo "
                      <div class='count'>
                    ";
                  }
                  echo"
                    <center>
                      ".$data['total']."
                    </center>
                  </div>
                  ";
                ?>
			  </div>
			</div>
			<div class="row tile_count">
			 <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class=""></i><center>Celana-38</center></span>
                <?php
                  $query = mysql_query("SELECT SUM(qty) AS total FROM tbl_item where item = 'celana' and size = '38'");
                  $data = mysql_fetch_array($query);
                  if($data['total'] <= 10){
                    echo "
                      <div class='count red'>
                    ";
                  }else{
                    echo "
                      <div class='count'>
                    ";
                  }
                  echo"
                    <center>
                      ".$data['total']."
                    </center>
                  </div>
                  ";
                ?>
			  </div>
			   <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class=""></i><center>Celana-39</center></span>
                <?php
                  $query = mysql_query("SELECT SUM(qty) AS total FROM tbl_item where item = 'celana' and size = '39'");
                  $data = mysql_fetch_array($query);
                  if($data['total'] <= 10){
                    echo "
                      <div class='count red'>
                    ";
                  }else{
                    echo "
                      <div class='count'>
                    ";
                  }
                  echo"
                    <center>
                      ".$data['total']."
                    </center>
                  </div>
                  ";
                ?>
			  </div>
			   <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class=""></i><center>Celana-40</center></span>
                <?php
                  $query = mysql_query("SELECT SUM(qty) AS total FROM tbl_item where item = 'celana' and size = '40'");
                  $data = mysql_fetch_array ($query);
                  if($data['total'] <= 10  && $data['total'] >5 ){
                    echo "
                      <div class='count red'>
                    ";
                  }else if($data['total'] <= 5){
                    echo "
                      <div class='count red'>
                    ";
                  }else{
                    echo "
                      <div class='count'>
                    ";
                  }
                  echo"
                    <center>
                      ".$data['total']."
                    </center>
                  </div>
                  ";
                ?>
			  </div>
			   <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class=""></i><center>Celana-41</center></span>
                <?php
                  $query = mysql_query("SELECT SUM(qty) AS total FROM tbl_item where item = 'celana' and size = '41'");
                  $data = mysql_fetch_array($query);
                  if($data['total'] <= 10  && $data['total'] >5 ){
                    echo "
                      <div class='count u'>
                    ";
                  }else if($data['total'] <= 5){
                    echo "
                      <div class='count red'>
                    ";
                  }else{
                    echo "
                      <div class='count'>
                    ";
                  }
                  echo"
                    <center>
                      ".$data['total']."
                    </center>
                  </div>
                  ";
                ?>
			  </div>
			</div>
			
			<h3><center><b>Topi</b></small></h3>
			  <div class="row tile_count">
				<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
          <span class="count_top"><i class=""></i><center>Topi Training Bekas</center></span>
            <?php
              $query = mysql_query("SELECT SUM(qty) AS total FROM tbl_item where item = 'topi training bekas'");
              $data = mysql_fetch_array($query);
              if($data['total'] <= 10){
                    echo "
                      <div class='count red'>
                    ";
                  }else{
                    echo "
                      <div class='count'>
                    ";
                  }
                  echo"
                    <center>
                      ".$data['total']."
                    </center>
                  </div>
                  ";
            ?>
        </div>
			<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class=""></i><center>Topi Training Baru</center></span>
                <?php
                  $query = mysql_query("SELECT SUM(qty) AS total FROM tbl_item where item = 'topi training baru'");
                  $data = mysql_fetch_array($query);
                  if($data['total'] <= 10){
                    echo "
                      <div class='count red'>
                    ";
                  }else{
                    echo "
                      <div class='count'>
                    ";
                  }
                  echo"
                    <center>
                      ".$data['total']."
                    </center>
                  </div>
                  ";
                ?>
            </div>
			<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class=""></i><center>Topi Kontrak</center></span>
                <?php
                  $query = mysql_query("SELECT SUM(qty) AS total FROM tbl_item where item = 'topi kontrak'");
                  $data = mysql_fetch_array($query);
                  if($data['total'] <= 10){
                    echo "
                      <div class='count red'>
                    ";
                  }else{
                    echo "
                      <div class='count'>
                    ";
                  }
                  echo"
                    <center>
                      ".$data['total']."
                    </center>
                  </div>
                  ";
                ?>
            </div>
			<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class=""></i><center>Topi Kartap</center></span>
                <?php
                  $query = mysql_query("SELECT SUM(qty) AS total FROM tbl_item where item = 'topi kartap'");
                  $data = mysql_fetch_array($query);
                  if($data['total'] <= 10){
                    echo "
                      <div class='count red'>
                    ";
                  }else{
                    echo "
                      <div class='count'>
                    ";
                  }
                  echo"
                    <center>
                      ".$data['total']."
                    </center>
                  </div>
                  ";
                ?>
            </div>
            </div>
			
			  <div class="row tile_count">
				<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class=""></i><center>Topi Sub-Lead</center></span>
                <?php
                  $query = mysql_query("SELECT SUM(qty) AS total FROM tbl_item where item = 'topi sub-leader'");
                  $data = mysql_fetch_array($query);
                  if($data['total'] <= 10){
                    echo "
                      <div class='count red'>
                    ";
                  }else{
                    echo "
                      <div class='count'>
                    ";
                  }
                  echo"
                    <center>
                      ".$data['total']."
                    </center>
                  </div>
                  ";
                ?>
            </div>
			<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class=""></i><center>Topi Leader</center></span>
                <?php
                  $query = mysql_query("SELECT SUM(qty) AS total FROM tbl_item where item = 'topi leader'");
                  $data = mysql_fetch_array($query);
                  if($data['total'] <= 10){
                    echo "
                      <div class='count red'>
                    ";
                  }else{
                    echo "
                      <div class='count'>
                    ";
                  }
                  echo"
                    <center>
                      ".$data['total']."
                    </center>
                  </div>
                  ";
                ?>
            </div>
			<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class=""></i><center>Topi JSP</center></span>
                <?php
                  $query = mysql_query("SELECT SUM(qty) AS total FROM tbl_item where item = 'topi jsp'");
                  $data = mysql_fetch_array($query);
                  if($data['total'] <= 10){
                    echo "
                      <div class='count red'>
                    ";
                  }else{
                    echo "
                      <div class='count'>
                    ";
                  }
                  echo"
                    <center>
                      ".$data['total']."
                    </center>
                  </div>
                  ";
                ?>
            </div>
			<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class=""></i><center>Topi Supervisor</center></span>
                <?php
                  $query = mysql_query("SELECT SUM(qty) AS total FROM tbl_item where item = 'topi sp'");
                  $data = mysql_fetch_array($query);
                  if($data['total'] <= 10){
                    echo "
                      <div class='count red'>
                    ";
                  }else{
                    echo "
                      <div class='count'>
                    ";
                  }
                  echo"
                    <center>
                      ".$data['total']."
                    </center>
                  </div>
                  ";
                ?>
            </div>
			<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class=""></i><center>Topi Asmen</center></span>
                <?php
                  $query = mysql_query("SELECT SUM(qty) AS total FROM tbl_item where item = 'topi asmen'");
                  $data = mysql_fetch_array($query);
                  if($data['total'] <= 10){
                    echo "
                      <div class='count red'>
                    ";
                  }else{
                    echo "
                      <div class='count'>
                    ";
                  }
                  echo"
                    <center>
                      ".$data['total']."
                    </center>
                  </div>
                  ";
                ?>
            </div>
            </div>
			
			<h3><center><b>Lain - lain</b></small></h3>
			<div class="row tile_count">
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class=""></i><center>Kacamata</center></span>
                <?php
                  $query = mysql_query("SELECT SUM(qty) AS total FROM tbl_item where item = 'kacamata'");
                  $data = mysql_fetch_array($query);
                  if($data['total'] <= 10){
                    echo "
                      <div class='count red'>
                    ";
                  }else{
                    echo "
                      <div class='count'>
                    ";
                  }
                  echo"
                    <center>
                      ".$data['total']."
                    </center>
                  </div>
                  ";
                ?>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class=""></i><center>Kerudung</center></span>
                <?php
                  $query = mysql_query("SELECT SUM(qty) AS total FROM tbl_item where item = 'kerudung'");
                  $data = mysql_fetch_array($query);
                  if($data['total'] <= 10){
                    echo "
                      <div class='count red'>
                    ";
                  }else{
                    echo "
                      <div class='count'>
                    ";
                  }
                  echo"
                    <center>
                      ".$data['total']."
                    </center>
                  </div>
                  ";
                ?>
            </div>
			</div>
            </div>
          </div>
		  

                <div class="clearfix"></div>
              

          </div>
          <br />


          
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
           PT.Otics Indonesia | PGA Departement</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="vendors/Flot/jquery.flot.js"></script>
    <script src="vendors/Flot/jquery.flot.pie.js"></script>
    <script src="vendors/Flot/jquery.flot.time.js"></script>
    <script src="vendors/Flot/jquery.flot.stack.js"></script>
    <script src="vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="vendors/moment/min/moment.min.js"></script>
    <script src="vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="build/js/custom.min.js"></script>
	
  </body>
</html>
<?php
}
      else{
        header('location:index.php?message=validate');
      }
?>