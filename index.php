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
    <!-- Animate.css -->
    <link href="vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">            
                <div>
                  <img class="img-responsive" src="bahan/oti.png" alt="">
                </div>
				</br>
              <?php
                if (isset($_GET['message'])) {
                  if($_GET['message'] == 'validate'){
                    echo "<div class='alert alert-warning alert-dismissible fade in' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' >
                    </button>
                    <strong></strong> Anda harus login terlebih dahulu.</strong>
                    </div>";
                  }
                  elseif($_GET['message'] == 'error'){
                    echo "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' ><span aria-hidden='true'>×</span>
                    </button>
                    <strong>Error!</strong> Silahkan coba input kembali.
                    </div>";
                  }
                }
              ?>
            <form action="proses.php?admin=login" method="post">
              <h1>Login Form</h1>
              <div>
                <input type="text" class="form-control" placeholder="NIK" required="" name="nik" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" name="password" />
              </div>
			  <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <input type="submit" class="btn btn-success" value="Login">
                        </div>
                      </div>

              <div class="clearfix"></div>
				</br>
              <div class="separator">
                <div class="clearfix"></div>
                <div>
                  <h1>O T I C S &nbsp W E L F A R E<br><br>I N V E N T O R Y</h1>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
