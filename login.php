<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Trang đăng nhập</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="admin/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<?php
  include("core/init.php");
  session_start();
  // if(isset($_SESSION["nhanvien"])) header("location: index.php?action=myaccount");
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    if($_POST['MSKH'] == '' || $_POST['password'] == '') $error = "Vui long nhap MSKH hoac password";
    $sql = "SELECT MSKH FROM KHACHHANG WHERE MSKH='". $_POST['MSKH'] ."' AND Pass='" . md5($_POST['password']) . "'";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_assoc($result);

    $error = "";
    if(mysqli_num_rows($result) == 1){
      $_SESSION["account"] = $_POST['MSKH'];
      header("location: index.php?action=myaccount");
    }else{
      if($error == "")
        $error = "MSKH hoac password khong dung";
    }
  }
?>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <!-- <div class="col-lg-6 d-none d-lg-block bg-login-image"></div> -->
              <div class="col-lg-12">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Đăng nhập khách hàng</h1>
                  </div>
                  <form class="user" method="POST">
                    <div class="form-group">
                      <input type="text" name="MSKH" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Nhập mã số KH">
                    </div>
                    <div class="form-group">
                      <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                    </div>
                    <?php     
                      if(isset($error)):
                    ?>
                    <div class="text-danger my-3">
                      <p><?=$error?></p>
                    </div>
                    <?php
                      endif;
                    ?>
                    <button type="submit" class="btn btn-primary btn-user btn-block">Đăng nhập</button>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="register.php">Tạo tài khoản</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="admin/vendor/jquery/jquery.min.js"></script>
  <script src="admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="admin/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="admin/js/sb-admin-2.min.js"></script>

</body>

</html>
