<?php
/**
 * Created by PhpStorm.
 * User: Minh
 * Date: 3/24/2017
 * Time: 2:10 PM
 */
session_start();
$_SESSION['email'] = $_POST['txtEmail'];
$_SESSION['pass'] = $_POST['txtPassword'];
if (isset($_SESSION['email']) && isset($_SESSION['pass'])) {
    $userName = $_SESSION['email'];
    $password = $_SESSION['pass'];


    if ($userName != '' || $password != '') {
        $serverName = "localhost";
        $username1 = "root";
        $password1 = "";
        $nameData = "create_exam";

// Create connection
        $conn = mysqli_connect($serverName, $username1, $password1, $nameData);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "select taikhoan from DangNhap where taikhoan = '$userName' and matkhau = '$password' and taikhoan like 'gv%'";
        $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));

        $count = mysqli_num_rows($result);
        echo "$count";
        if($count == 1)
        {

            header("location:../giangvien/ExamBank.php");

        }
        else{
            header("location:index.php");
            $_SESSION['error'] = "Tài khoản hoặc mật khẩu không tồn tại";

        }

    }
}

