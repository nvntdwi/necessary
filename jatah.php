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
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-css/1.4.6/select2-bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><span>OTICS INDONESIA</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <?php 
                  if (!empty($b['photo'])){
                    echo"
                      <img src='images/profile/$b[photo]' class='img-circle profile_img'>
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
                  <li><a href="index_item.php"><i class="fa fa-shopping-cart"></i> Item</a></li>
                  <li><a href="index_transaction.php"><i class="fa fa-exchange"></i> Transaction</a></li>
                  <li><a href="index_exchange.php"><i class="fa fa-exchange"></i> Exchange</a></li>
                  <?php
                    if($b['level'] == 'superadmin'){
                    echo"
                      <li><a href='index_pic.php'><i class='fa fa-users'></i> PIC</a></li>
                    ";
                    }
                  ?>

                  <li><a><i class="fa fa-file-pdf-o"></i> Report <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="index_item_in.php">Item in</a></li>
                      <li><a href="index_item_out.php">Item out</a></li>
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
                    <li><a href="login.html"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
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
                <h3>Jatah Karyawan</h3>
              </div>
            </div>
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Data Karyawan</h2>                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <?php
                    if (isset($_GET['result'])) {
                      if($_GET['result'] == 'success'){
                        echo "<div class='alert alert-success alert-dismissible fade in' role='alert'>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span>
                        </button>
                        <strong>Success!</strong> input data jatah.
                        </div>";
                      }
                      elseif($_GET['result'] == 'error'){
                        echo "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span>
                        </button>
                        <strong>Error!</strong> Silahkan coba input kembali.
                        </div>";
                      }
                      elseif($_GET['result'] == 'validate'){
                        echo "<div class='alert alert-warning alert-dismissible fade in' role='alert'>
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span>
                        </button>
                        <strong>Validate!</strong> Belum 1 tahun.
                        </div>";
                      }
                    }
                  ?>
                    <form class="form-horizontal form-label-left" action="proses.php?admin=input_jatah" method="post">
					            <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category">Karyawan <span class="required">*	</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="sosearch" name="nik" class="form-control col-md-7 col-xs-12 employee">
                            <?php
                              include "koneksi_karyawan.php";
                              $no=0;
                              $qr = mysql_query("Select tbl_emp.Nama, tbl_emp.NIK, tbl_emp.id_line, tbl_line.n_line from tbl_emp INNER JOIN tbl_line ON tbl_emp.id_line = tbl_line.id_line where emp != 'TR' AND status = '1'");
                              
                              while($a = mysql_fetch_array($qr))
                              {
                                echo '<option value="'.$a[NIK].'" data-employee-name="'.$a[Nama].'" data-line="'.$a[n_line].'">'.$a[NIK].' - '.$a[Nama].'</option>';
                              }
                            ?>
                          </select>
                        </div>
                      </div>
                      <input type="hidden" id="name_hidden" name="nama" required="required" class="form-control col-md-7 col-xs-12">
								 <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Line <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="line_hidden" name="line" required="required" class="form-control col-md-7 col-xs-12" readonly>
                        </div>
                      </div>
                      <div class="ln_solid"></div>
								 <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category">Baju <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="item" class="form-control col-md-7 col-xs-12" name="baju">
                            <?php
                              include "koneksi.php";
                              $no=0;
                              $qr = mysql_query("select * from tbl_item where item LIKE 'baju%'");
                              
                              while($a = mysql_fetch_array($qr))
                              {
                                echo '<option value="'.$a[id].'" '.(($a[qty]==0)?'disabled style="color:red;"':'').'>'.$a[item].' - '.$a[size].'</option>';
                              }
                            ?>
                          </select>
                        </div>
                      </div>
					  <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category">Celana <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="item" class="form-control col-md-7 col-xs-12" name="celana">
                            <?php
                              include "koneksi.php";
                              $no=0;
                              $qr = mysql_query("select * from tbl_item where item = 'celana'");
                              
                              while($a = mysql_fetch_array($qr))
                              {
                                echo '<option value="'.$a[id].'" '.(($a[qty]==0)?'disabled style="color:red;"':'').'>'.$a[item].' - '.$a[size].'</option>';
                              }
                            ?>
                          </select>
                        </div>
                      </div>
					 <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category">Sepatu <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="item" class="form-control col-md-7 col-xs-12" name="sepatu">
                            <?php
                              include "koneksi.php";
                              $no=0;
                              $qr = mysql_query("select * from tbl_item where item LIKE 'sepatu%'");
                              
                              while($a = mysql_fetch_array($qr))
                              {
                                echo"
                                  <option value='$a[id]'> $a[item] - $a[size]</option>
                                ";
                              }
                            ?>
                          </select>
                        </div>
                      </div>
					  <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category">Topi <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select id="item" class="form-control col-md-7 col-xs-12" name="topi">
                            <?php
                              include "koneksi.php";
                              $no=0;
                              $qr = mysql_query("select * from tbl_item where item LIKE 'topi%'");
                              
                              while($a = mysql_fetch_array($qr))
                              {
                                echo '<option value="'.$a[id].'" '.(($a[qty]==0)?'disabled style="color:red;"':'').'>'.$a[item].' - '.$a[size].'</option>';
                              }
                            ?>
                          </select>
                        </div>
                      </div>
					   <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category">Kacamata<span class="required">*	</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <?php
                              include "koneksi.php";
                              $qr = mysql_query("select * from tbl_item where item LIKE 'kacamata%'");
                              
                              while($a = mysql_fetch_array($qr))
                              {
                                echo"
                                  <input type='checkbox' id='name' name='kacamata' class='form-control col-md-7 col-xs-12' value='$a[id]' ".(($a['qty']==0)?"disabled":"").">
                                ";
                              }
                            ?>
                        </div>
                      </div>
					  <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category">Kerudung<span class="required">*	</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <?php
                              include "koneksi.php";
                              $qr = mysql_query("select * from tbl_item where item LIKE 'kerudung%'");
                              
                              while($a = mysql_fetch_array($qr))
                              {
                                echo"
                                  <input type='checkbox' id='name' name='kerudung' class='form-control col-md-7 col-xs-12' value='$a[id]' ".(($a['qty']==0)?"disabled":"").">
                                ";
                              }
                            ?>
                        </div>
                      </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category">Keterangan</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <textarea name="note" class="resizable_textarea form-control" placeholder=""></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <button id="send" type="submit" class="btn btn-primary">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

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
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script>
    $(document).ready(function (){
       $("#sosearch").select2({
         allowClear:true,
         placeholder: 'Search for Data Karyawan'
       });
    })
    </script>
<script>
  $(function(){
      $(document).on('change', '.employee', function(){
          var employee = $(this).find('option:selected').data('employee-name');
          var position = $(this).find('option:selected').data('line');

          $('#name_hidden').val(employee);
          $('#line_hidden').val(position);
      });
  });
</script>
  </body>
</html>
<?php
}
      else{
        header('location:index.php?message=validate');
      }
?>