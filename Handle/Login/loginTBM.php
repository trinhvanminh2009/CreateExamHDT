<?php
/**
 * Created by PhpStorm.
 * User: Minh
 * Date: 3/25/2017
 * Time: 4:46 PM
 */
session_start();
$_SESSION['emailTBM'] = $_POST['txtEmailTBM'];
$_SESSION['passTBM'] = $_POST['txtPasswordTBM'];
if (isset($_SESSION['emailTBM']) && isset($_SESSION['passTBM'])) {
    $userName = $_SESSION['emailTBM'];
    $password = $_SESSION['passTBM'];


    if ($userName != '' || $password != '') {
        $serverName = "localhost";
        $username1 = "root";
        $password1 = "";
        $nameData = "create_exam";

// Create connection
        $conn = mysqli_connect($serveName, $username1, $password1, $nameData);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "select taikhoan from DangNhap where taikhoan = '$userName' and matkhau = '$password' and taikhoan like 'tbm%'";
        $result = mysqli_query($conn,$sql) or die(mysqlli_error($conn));

        $count = mysqli_num_rows($result);
        echo "$count";
        if($count == 1)
        {

            header("location:../TBM/index.php");

        }
        else{
            header("location:index.php");
            $_SESSION['errorTBM'] = "Tài khoản hoặc mật khẩu không tồn tại";

        }

    }
}
