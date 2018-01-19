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
    <!-- Datatables -->
    <link href="vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

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
                <h3>Report Transaction</h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Data Jatah</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li>
                        <!-- <a href="report_jatah.php"><div class="pull-right"><button type="button" class="btn btn-primary btn-sm" style="height:34px;">Create Report PDF</button></div></a> -->
                      </li>
                    </ul>
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
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>NIK</th>
                          <th>Name</th>
                          <th>Line</th>
                          <th>Date</th>
						  <th>Clothes</th>
						  <th>Pants</th>
						  <th>Hat</th>
						  <th>Eyeglasses</th>
						  <th>Veil</th>
						  <th>Note</th>
                          <th>Action</th>
                        </tr>
                      </thead>

                      <tbody>
                        <?php
                          $sql=mysql_query("select * from tbl_jatah");
                          while($a=mysql_fetch_array($sql)){
                            echo"
                              <tr>
                                <td style='vertical-align: middle'>$a[nik]</td>
                                <td style='vertical-align: middle'>$a[nama]</td>
                                <td style='vertical-align: middle'>$a[line]</td>
                                <td style='vertical-align: middle'>$a[tgl]</td>
								<td style='vertical-align: middle'>$a[baju]</td>
								<td style='vertical-align: middle'>$a[celana]</td>
								<td style='vertical-align: middle'>$a[topi]</td>
								<td style='vertical-align: middle'>$a[kacamata]</td>
								<td style='vertical-align: middle'>$a[kerudung]</td>
								<td style='vertical-align: middle'>$a[note]</td>
                                <td style='vertical-align: middle'>
                                  <button type='button' class='btn btn-primary' data-toggle='modal' data-target='.bs-example-modal-sm" . $a['id'] . "'>See More</button>

                                  <div class='modal fade bs-example-modal-sm" . $a['id'] . "' tabindex='-1' role='dialog' aria-hidden='true'>
                                    <div class='modal-dialog modal-sm'>
                                      <div class='modal-content'>

                                        <div class='modal-header'>
                                          <button type='button' class='close' data-dismiss='modal'><span aria-hidden='true'>×</span>
                                          </button>
                                          <h4 class='modal-title' id='myModalLabel'>Detail Section</h4>
                                        </div>
                                        <div class='modal-body'>";
                                          echo"<div class='row'>
                                            <label class='col-md-1 col-sm-1 col-xs-12' for='item'>Baju:</div>
											<div class='row'>
                                            </label>
                                            <div class='col-md-11 col-sm-11 col-xs-12'>
                                            ";
                                      if(empty($a['baju'])){
                                        echo"-";
                                      }else{
                                        $baju = mysql_query("select * from tbl_item where id = '$a[baju]'");
                                        while($fabaju = mysql_fetch_array($baju)){
                                        echo"
                                              ". $fabaju['item'] ." - ". $fabaju['size']."
                                        ";
                                        }
                                      }
                                          echo"
                                            </div>
                                          </div>
                                          <div class='row'>
                                            <label class='col-md-1 col-sm-1 col-xs-12' for='item'><br> Celana:</div>
											<div class='row'>
                                            </label>
                                            <div class='col-md-11 col-sm-11 col-xs-12'>
                                          ";
                                      if(empty($a['celana'])){
                                        echo"-";
                                      }else{
                                        $celana = mysql_query("select * from tbl_item where id = '$a[celana]'");
                                        while($facelana = mysql_fetch_array($celana)){
                                        echo"
                                              ". $facelana['item'] ." - ". $facelana['size']."
                                        ";
                                        }
                                      }
                                          echo"
                                            </div>
                                          </div>
                                          <div class='row'>
                                            <label class='col-md-1 col-sm-1 col-xs-12' for='item'><br> Sepatu:</div>
											<div class='row'>
                                            </label>
                                            <div class='col-md-11 col-sm-11 col-xs-12'>
                                            ";
                                      if(empty($a['sepatu'])){
                                        echo"-";
                                      }else{
                                        $sepatu = mysql_query("select * from tbl_item where id = '$a[sepatu]'");
                                        while($fasepatu = mysql_fetch_array($sepatu)){
                                        echo"
                                              ". $fasepatu['item'] ." - ". $fasepatu['size']."
                                        ";
                                        }
                                      }
                                       echo "
                                            </div>
                                          </div>
                                          <div class='row'>
                                            <label class='col-md-1 col-sm-1 col-xs-12' for='item'><br>Topi:</div>
											<div class='row'>
                                            </label>
                                            <div class='col-md-11 col-sm-11 col-xs-12'>
                                            ";
                                      if(empty($a['topi'])){
                                        echo"-";
                                      }else{
                                        $topi = mysql_query("select * from tbl_item where id = '$a[topi]'");
                                        while($fatopi = mysql_fetch_array($topi)){
                                        echo"
                                              ". $fatopi['item'] ."
                                        ";
                                        }
                                      }
                                      echo "
                                            </div>
                                          </div>
                                          <div class='row'>
                                            <label class='col-md-1 col-sm-1 col-xs-12' for='item'><br>Kacamata:</div>
											<div class='row'>
                                            </label>
                                            <div class='col-md-11 col-sm-11 col-xs-12'>
                                            ";
                                      if(empty($a['kacamata'])){
                                        echo"-";
                                      }else{
                                        $kacamata = mysql_query("select * from tbl_item where id = '$a[kacamata]'");
                                        while($fakacamata = mysql_fetch_array($kacamata)){
                                        echo"
                                              ". $fakacamata['item'] ."
                                        ";
                                        }
                                      }
                                      echo "
                                            </div>
                                          </div>
                                          <div class='row'>
                                            <label class='col-md-1 col-sm-1 col-xs-12' for='item'><br>Kerudung:</div>
											<div class='row'>
                                            </label>
                                            <div class='col-md-11 col-sm-11 col-xs-12'>
                                            ";
                                      if(empty($a['kerudung'])){
                                        echo"-";
                                      }else{
                                        $kerudung = mysql_query("select * from tbl_item where id = '$a[kerudung]'");
                                        while($fakerudung = mysql_fetch_array($kerudung)){
                                        echo"
                                              ". $fakerudung['item'] ."
                                        ";
                                        }
                                      }
                                      echo "
                                            </div>
                                          </div>
                                          <div class='row'>
                                            <label class='col-md-1 col-sm-1 col-xs-12' for='item'><br>Note:</div>
											<div class='row'>
                                            </label>
                                            <div class='col-md-11 col-sm-11 col-xs-12'>
                                            ";
                                      if(empty($a['note'])){
                                        echo"-";
                                      }else{
                                        echo"
                                              ". $a['note'] ."
                                        ";
                                      }
                                       echo "
                                            </div>
                                          </div>
                                          <div class='modal-footer'>
                                            <a href='update_jatah.php?a=beranda&id=$a[id]' title='Edit'>
                                              <button type='button' class='btn btn-icon btn-primary' style='width: 40px'><i class='fa fa-edit'></i></button>
                                            </a>
                                          </div>
                                          ";
                          }
                        ?>
                      </tbody>
                    </table>
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
    <!-- iCheck -->
    <script src="vendors/iCheck/icheck.min.js"></script>
    <!-- Datatables -->
    <script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="vendors/jszip/dist/jszip.min.js"></script>
    <script src="vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="vendors/pdfmake/build/vfs_fonts.js"></script>

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