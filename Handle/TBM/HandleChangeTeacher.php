<?php
/**
 * Created by PhpStorm.
 * User: Minh
 * Date: 4/26/2017
 * Time: 6:19 PM
 */

session_start();
$serverName = "localhost";
$username1 = "root";
$password1 = "";
$nameData = "create_exam";
$conn = mysqli_connect($serverName, $username1, $password1, $nameData);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['changeTeacher']))
{
    $newTeacher = $_POST['newTeacher'];
    $MaPhanCong = $_POST['MaPhanCong'];
    $maHocPhan = $_POST['maHocPhan'];
    echo $maHocPhan ."_". $newTeacher;

    $sql = "update phanconggiangvien set MaGiangVien = '$newTeacher' where MaPhanCong = '$MaPhanCong'";
    if($conn->query($sql) == true)
    {
        $sqlCourse = "UPDATE `chitietgiangday` SET `MaGiangVien` = '$newTeacher' WHERE `chitietgiangday`.`MaHocPhan` = '$maHocPhan'";
        if($conn->query($sqlCourse) == true)
        {
            $conn->close();
            header("Location:PhanCongGiangVien.php");
        }
        else{

            echo $conn->error;
        }

    }else
    {
        echo $conn->error;
        $conn->close();

    }
}

if(isset($_POST['CancelTeacher']))
{
    $cancelMaGiangVien = $_POST['removeMaGiangVien'];
    $cancelMaHocPhan = $_POST['removeMaHocPhan'];
    $cancelMaTruongBoMon = $_POST['removeTruongBoMon'];
    $cancelMaPhanCong = $_POST['removeMaPhanCong'];
    $sqlDeleteGiangDay = "delete from chitietgiangday where mahocphan = '$cancelMaHocPhan' and MaGiangVien = '$cancelMaGiangVien'";
    if($conn->query($sqlDeleteGiangDay) == true)
    {
        $sqlDeletePhanCong = "delete from phanconggiangvien WHERE MaPhanCong = '$cancelMaPhanCong'";
        if($conn->query($sqlDeletePhanCong) == true)
        {
            $conn->close();
            header("Location:PhanCongGiangVien.php");
        }
        else{

            echo $conn->error;
        }
    }
    else{
        echo $conn->error;
        $conn->close();

    }

}

if(isset($_POST['addTeacher']))
{

    $maTruongBoMon = $_POST['maTruongBoMon'];
    $maGiangVien = $_POST['listTeacher'];
    $maHocPhanAdd = $_POST['listCourse'];

    $sqlHocKy = "select MaHK from chitiethocky where MaHocPhan = '$maHocPhanAdd'";
    $resultHocKy = $conn->query($sqlHocKy);
    while ($row = mysqli_fetch_array($resultHocKy))
    {
        $maHocKy = $row['MaHK'];
    }

    $sqlPhanCong = "insert into phanconggiangvien (`MaTruongBoMon`,`MaHocPhan`,`MaHK`,`MaGiangVien`) VALUES 
    ('$maTruongBoMon' , '$maHocPhanAdd','$maHocKy','$maGiangVien')";
    $sqlGiangDay = "insert into chitietgiangday(`MaHocPhan`, `MaGiangVien`) VALUES
        ('$maHocPhanAdd', '$maGiangVien')";
    if($conn->query($sqlGiangDay) && $conn->query($sqlPhanCong) == true  )
    {
            $conn->close();
            header("Location:PhanCongGiangVien.php");

    }
    else{
        //echo  $conn->error;
        header("Location:PhanCongGiangVien.php");
        $_SESSION['errorAdd'] = "Giảng viên này đã được phân công cho môn học này. Vui lòng kiểm tra lại!";
        $conn->close();

    }

}
?>

