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
                        <strong>Validate!</strong> Acan 1 taun.
                        </div>";
                      }
                    }
                  ?>
                  <?php
                    switch($_GET['a']){
                    case "beranda":
                    $dist = mysql_query("select * from tbl_jatah where id='$_GET[id]'");
                    while ($data=mysql_fetch_array($dist))
                    {
                      echo"
                    <form class='form-horizontal form-label-left' action='proses.php?admin=update_jatah' method='post'>
                    <input type='hidden' name='tgl' value='".date('Y-m-d')."'>
                    <input type='hidden' name='id_pic' value='$b[id]'>
                    <input type='hidden' name='old_nik' value='$data[nik]'>
                    <input type='hidden' name='old_nama' value='$data[nama]'>
                    <input type='hidden' name='old_line' value='$data[line]'>
                    <input type='hidden' name='old_baju' value='$data[baju]'>
                    <input type='hidden' name='old_celana' value='$data[celana]'>
                    <input type='hidden' name='old_sepatu' value='$data[sepatu]'>
                    <input type='hidden' name='old_topi' value='$data[topi]'>
                    <input type='hidden' name='old_kacamata' value='$data[kacamata]'>
                    <input type='hidden' name='old_kerudung' value='$data[kerudung]'>
                      <div class='item form-group'>
                        <label class='control-label col-md-3 col-sm-3 col-xs-12' for='category'>NIK <span class='required'>*  </span>
                        </label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <input type='text' id='name' name='nik' required='required' data-validate-minmax='10,100' class='form-control col-md-7 col-xs-12' value='$data[nik]'>
                        </div>
                      </div>
                      <div class='item form-group'>
                        <label class='control-label col-md-3 col-sm-3 col-xs-12'>Nama <span class='required'>*</span>
                        </label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <input type='text' id='size' name='nama' required='required' class='form-control col-md-7 col-xs-12' value='$data[nama]'>
                        </div>
                      </div>
                 <div class='item form-group'>
                        <label class='control-label col-md-3 col-sm-3 col-xs-12'>Line <span class='required'>*</span>
                        </label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <input type='text' id='size' name='line' required='required' class='form-control col-md-7 col-xs-12' value='$data[line]'>
                        </div>
                      </div>
                      <div class='ln_solid'></div>
                 <div class='item form-group'>
                        <label class='control-label col-md-3 col-sm-3 col-xs-12' for='category'>Baju <span class='required'>*</span>
                        </label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <select id='item' class='form-control col-md-7 col-xs-12' name='baju'>
                          <option>=== Pilih Baju ===</option>
                          ";
                            $no=0;
                            $qr = mysql_query("select * from tbl_item where item LIKE 'baju%'");
                            
                            while($a = mysql_fetch_array($qr))
                            {
                              echo '<option value="'.$a[id].'" '.(($a[id]==$data[baju])?'selected=selected"':'').' '.(($a[qty]==0)?'disabled style="color:red;"':'').'>'.$a[item].' - '.$a[size].'</option>';
                            }
                          echo"
                          </select>
                        </div>
                      </div>
            <div class='item form-group'>
                        <label class='control-label col-md-3 col-sm-3 col-xs-12' for='category'>Celana <span class='required'>*</span>
                        </label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <select id='item' class='form-control col-md-7 col-xs-12' name='celana'>
                          <option>=== Pilih Celana ===</option>
                          ";
                            $no=0;
                            $qr = mysql_query("select * from tbl_item where item LIKE 'celana%'");
                            
                            while($a = mysql_fetch_array($qr))
                            {
                              echo '<option value="'.$a[id].'" '.(($a[id]==$data[celana])?'selected=selected"':'').' '.(($a[qty]==0)?'disabled style="color:red;"':'').'>'.$a[item].' - '.$a[size].'</option>';
                            }
                          echo"
                          </select>
                        </div>
                      </div>
           <div class='item form-group'>
                        <label class='control-label col-md-3 col-sm-3 col-xs-12' for='category'>Sepatu <span class='required'>*</span>
                        </label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <select id='item' class='form-control col-md-7 col-xs-12' name='sepatu'>
                          <option>=== Pilih Sepatu ===</option>
                          ";
                            $no=0;
                            $qr = mysql_query("select * from tbl_item where item LIKE 'sepatu%'");
                            
                            while($a = mysql_fetch_array($qr))
                            {
                              echo '<option value="'.$a[id].'" '.(($a[id]==$data[sepatu])?'selected=selected"':'').' '.(($a[qty]==0)?'disabled style="color:red;"':'').'>'.$a[item].' - '.$a[size].'</option>';
                            }
                          echo"
                          </select>
                        </div>
                      </div>
            <div class='item form-group'>
                        <label class='control-label col-md-3 col-sm-3 col-xs-12' for='category'>Topi <span class='required'>*</span>
                        </label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          <select id='item' class='form-control col-md-7 col-xs-12' name='topi'>
                          <option>=== Pilih Topi ===</option>
                            ";
                            $no=0;
                            $qr = mysql_query("select * from tbl_item where item LIKE 'topi%'");
                            
                            while($a = mysql_fetch_array($qr))
                            {
                              echo '<option value="'.$a[id].'" '.(($a[id]==$data[topi])?'selected=selected"':'').' '.(($a[qty]==0)?'disabled style="color:red;"':'').'>'.$a[item].' - '.$a[size].'</option>';
                            }
                          echo"
                          </select>
                        </div>
                      </div>
             <div class='item form-group'>
                        <label class='control-label col-md-3 col-sm-3 col-xs-12' for='category'>Kacamata<span class='required'>*  </span>
                        </label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                          ";
                          $qr = mysql_query("select * from tbl_item where item LIKE 'kacamata%'");
                          while($a = mysql_fetch_array($qr))
                          {
                            echo"
                              <input type='checkbox' id='name' name='kacamata' class='form-control col-md-7 col-xs-12' value='$a[id]' ".(($a['qty']==0)?"disabled":"")." ".(($a['id']==$data[kacamata])?"checked":"").">
                            ";
                          }
                          echo"
                        </div>
                      </div>
            <div class='item form-group'>
                        <label class='control-label col-md-3 col-sm-3 col-xs-12' for='category'>Kerudung<span class='required'>*  </span>
                        </label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                        ";
                          $qr = mysql_query("select * from tbl_item where item LIKE 'kerudung%'");
                          while($a = mysql_fetch_array($qr))
                          {
                            echo"
                              <input type='checkbox' id='name' name='kerudung' class='form-control col-md-7 col-xs-12' value='$a[id]' ".(($a['qty']==0)?"disabled":"")." ".(($a['id']==$data[kerudung])?"checked":"").">
                            ";
                          }
                        echo"
                        </div>
                      </div>
                    <div class='item form-group'>
                        <label class='control-label col-md-3 col-sm-3 col-xs-12' for='category'>Note</label>
                        <div class='col-md-6 col-sm-6 col-xs-12'>
                        <textarea name='note' class='resizable_textarea form-control' placeholder='Note'>$data[note]</textarea>
                        </div>
                      </div>
                      <div class='form-group'>
                        <div class='col-md-6 col-md-offset-3'>
                          <button id='send' type='submit' class='btn btn-primary'>Submit</button>
                        </div>
                      </div>
                    </form>";
                    }
                    }
                    ?>
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
  
  </body>
</html>
<?php
}
      else{
        header('location:index.php?message=validate');
      }
?>