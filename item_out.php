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

    <title>OTICS INDONESIA</title>

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
			<!--<li><a href="index_transaction.php"><i class="fa fa-shopping-cart"></i> Transaction</a></li>
                  <li><a href="index_exchange.php"><i class="fa fa-exchange"></i> Exchange</a></li>-->
                  <?php
                    if($b['level'] == 'superadmin'){
                    echo"
                      <li><a href='index_pic.php'><i class='fa fa-users'></i> PIC</a></li>
                    ";
                    }
                  ?>

                  <li><a><i class="fa fa-file-pdf-o"></i> Report <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="index_item_in.php">Report Item In</a></li>
                      <li><a href="index_item_out.php">Report Item Out</a></li>
					  <li><a href="index_jatah.php">Report Jatah</a></li>
                    </ul>
                  </li>
                  <li><a href="jatah.php"><i class="fa fa-users"></i>Jatah Karyawan</a></li>
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
                          <img src='production/images/img.jpg'>
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
                    <li><a href="javascript:;"> Profile</a></li>
                    <li><a href="index.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
 <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Uniform Stock</h3>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Stock Out</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <?php
                    switch($_GET['a']){
                    case "beranda":
                    $dist = mysql_query("select * from tbl_item where id='$_GET[id]'");
                    while ($a=mysql_fetch_array($dist))
                    {
                    echo"
                    <form id='demo-form2' data-parsley-validate class='form-horizontal form-label-left' action='proses.php?admin=remove_item' method='post'>
					
					<div class='form-group'>
                        <label class='control-label col-md-3 col-sm-3 col-xs-12' for='nik'>Nik <span class='required'>*</span>
                        </label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <input type='text' id='nik' name='nik' required='required' class='form-control col-md-7 col-xs-12'>						   
                        </div>
                      </div>
					  <div class='form-group'>
                        <label class='control-label col-md-3 col-sm-3 col-xs-12' for='name'>Name <span class='required'>*</span>
                        </label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <input type='text' id='name' name='name' required='required' class='form-control col-md-7 col-xs-12'>						   
                        </div>
                      </div>
					  <div class='form-group'>
                        <label class='control-label col-md-3 col-sm-3 col-xs-12' for='line'>Line <span class='required'>*</span>
                        </label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <input type='text' id='line' name='line' required='required' class='form-control col-md-7 col-xs-12'>						   
                        </div>
                      </div>
                      
					<div class='ln_solid'></div>
                    <input type='hidden' id='id_item' name='id_item' class='form-control col-md-7 col-xs-12' value='$a[id]'>
                      <div class='form-group'>
                        <label class='control-label col-md-3 col-sm-3 col-xs-12' for='item'>Item <span class='required'>*</span>
                        </label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
            						  <input type='text' required='required' class='form-control col-md-7 col-xs-12' value='$a[item] - $a[size]' readonly>
                        </div>
                      </div>
                      <div class='form-group'>
                        <label class='control-label col-md-3 col-sm-3 col-xs-12' for='quanity'>Quanity <span class='required'>*</span>
                        </label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <input type='number' id='quanity' name='qty' required='required' class='form-control col-md-7 col-xs-12'>
						   
                        </div>
                      </div>
                      <div class='form-group'>
                        <label for='tgl_k' class='control-label col-md-3 col-sm-3 col-xs-12'>Date</label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <input id='tgl_k' class='form-control col-md-7 col-xs-12' type='text' name='tgl' value='".date('Y-m-d')."' >
                        </div>
                      </div>
                      <input id='birthday' class='date-picker form-control col-md-7 col-xs-12' type='hidden' name='pic' value='$b[id]'>
                      <div class='ln_solid'></div>
					  <div class='form-group'>
                        <div class='col-md-6 col-sm-6 col-xs-12 col-md-offset-3'>
                          <button type='submit' class='btn btn-primary'>Submit</button>
                        </div>
                      </div>
                    </form>
                    ";
                      }
                      break;
                    }
                    ?>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <!-- /page content -->
		
		<!-- page content 2 -->
		<div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Report Stock Out</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>NIK</th>
                          <th>Nama</th>
                          <th>Line</th>						  
                          <th>Nama Item</th>
						  <th>Size</th>
                          <th>Stock Keluar</th>
                          <th>PIC</th>
                          <th>Tanggal</th>
                        </tr>
                      </thead>

                      <tbody>
                        <?php
                          $sql=mysql_query("select * from tbl_transaksi where tipe='keluar' ");
                          while($a=mysql_fetch_array($sql)){
                            $b=mysql_query("select item from tbl_item where id='$a[id_item]'");
                            $c=mysql_fetch_array($b);
                            $d=mysql_query("select nama from tbl_pic where id='$a[id_pic]'");
                            $e=mysql_fetch_array($d);
							$f=mysql_query("select size from tbl_item where id='$a[id_item]'");
                            $g=mysql_fetch_array($f);
                            echo"
                              <tr>
								<td style='vertical-align: middle'>$a[nik]</td>
								<td style='vertical-align: middle'>$a[nama]</td>
								<td style='vertical-align: middle'>$a[line]</td>
                                <td style='vertical-align: middle'>$c[item]</td>
								<td style='vertical-align: middle'>$g[size]</td>
                                <td style='vertical-align: middle'>$a[qty]</td>
                                <td style='vertical-align: middle'>$e[nama]</td>
                                <td style='vertical-align: middle'>$a[tgl]</td>
                              </tr>";
                          }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
		<!-- /page content 2-->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            PT.Otics Indonesia | PGA Departement
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
	<!-- validation js -->
	<script src="vendors/validator/validator.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="build/js/custom.min.js"></script>
	
  </body>
</html>
<?php
}
      else{
        echo"Anda harus login telebih dahulu";
      }
?>