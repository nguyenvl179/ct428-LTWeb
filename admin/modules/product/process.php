<?php
    include("../../../core/init.php");
    $path = '../../../uploads/';
    if(isset($_POST['themhang'])){
        $mshh=$_POST['MSHH'];
	    $tensach=$_POST['TenHH'];
        $quycach = $_POST['QuyCach'];
        $maloai=$_POST['maloai'];
        $gia=$_POST['Gia'];
        $soluong=$_POST['SoLuongHang'];
        $i = 0;
        $name = "";

        $sql = "SELECT * FROM hanghoa WHERE MSHH='" . $mshh . "'";
        $result = mysqli_query($db, $sql);

        if(mysqli_num_rows($result) > 0){
            header("location: /admin/index.php?module=product");
        }
        $str = "";
        $sql = "INSERT INTO hanghoa VALUE('".$mshh."','".$tensach."','" .$quycach. "','".$gia."','".$soluong."','" .$maloai. "')";
        $result = mysqli_query($db, $sql);
        foreach ($_FILES['hinhanh']['name'] as $file) {
            $tenhinhanh_tmp = $_FILES['hinhanh']['tmp_name'][$i];
            $name = $mshh . $file;
            $path_file = $path . $mshh .$file;
            move_uploaded_file($tenhinhanh_tmp,$path_file);
            $i++;
            $sql1 = "INSERT INTO hinhhanghoa(MSHH,tenhinh,mahinh) VALUE('".$mshh."','".$name."','".$name."');";
            $str .= $sql1;
            mysqli_query($db, $sql1);
        }

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
     if(isset($_GET['action'])){
         $sql2 = "SELECT * FROM hinhhanghoa WHERE MSHH = '".$_GET['id']."'";

         $result = mysqli_query($db, $sql2);
         while($row = mysqli_fetch_assoc($result)){
             unlink($path.$row['tenhinh']);
         }
        $sql = "DELETE FROM hanghoa WHERE (MSHH='".$_GET['id']."')";
        mysqli_query($db, $sql);
        $sql1 = "DELETE FROM hinhhanghoa WHERE (MSHH='".$_GET['id']."')";
        mysqli_query($db, $sql1);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
     }
    if(isset($_POST['suahang'])){
        $mshh=$_POST['MSHH'];
	    $tensach=$_POST['TenHH'];
        $quycach = $_POST['QuyCach'];
        $maloai=$_POST['maloai'];
        $gia=$_POST['Gia'];
        $soluong=$_POST['SoLuongHang'];
        $sql = "UPDATE hanghoa SET TenHH='".$tensach."', QuyCach='" .$quycach. "', Gia='" .$gia. "', SoLuongHang='".$soluong."' ,MaLoaiHang='".$maloai."'WHERE MSHH='".$mshh."'";
        mysqli_query($db, $sql);

        if(empty($_FILES['hinhanh']['size'][0])){
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
        else{
            $sql2 = "SELECT * FROM hinhhanghoa WHERE MSHH = '".$mshh."'";
            $result = mysqli_query($db, $sql2);
            while($row = mysqli_fetch_assoc($result)){
                if(file_exists($path.$row['tenhinh'])) unlink($path.$row['tenhinh']);
            }
            $sql1 = "DELETE FROM hinhhanghoa WHERE (MSHH='".$mshh."')";
            mysqli_query($db, $sql1);
            $i = 0;
            $name = "";

            foreach ($_FILES['hinhanh']['name'] as $file) {
                $tenhinhanh_tmp=$_FILES['hinhanh']['tmp_name'][$i];
                $path_file = $path . $mshh . $file;
                $name = $mshh . $file;
                move_uploaded_file($tenhinhanh_tmp,$path_file);
                $i++;
                $sql3 = "INSERT INTO hinhhanghoa(MSHH,tenhinh,mahinh) VALUE('".$mshh."','".$name."','".$name."')";
                mysqli_query($db, $sql3);
            }
            header('Location:../../index.php?module=product');
        }
    }
?>