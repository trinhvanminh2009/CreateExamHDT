<?php
/**
 * Created by PhpStorm.
 * User: Minh
 * Date: 3/31/2017
 * Time: 7:15 AM
 */

$serverName = "localhost";
$username1 = "root";
$password1 = "";
$nameData = "create_exam";

$conn = mysqli_connect($serverName, $username1, $password1, $nameData);
mysqli_set_charset($conn,"utf8");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$teacherCode = $_POST['txtTeacherCode'];
$courseCode = $_POST['txtCourseCode'];
$codeQuestion = $_POST['codeQuestion'];
$contentReport  = $_POST['txtReport'];
$mark = (int)1;

$sql = "insert into BaoCao (MaGiangVien, MaCH, DanhDau, GhiChu,MaHocPhan) VALUES
('$teacherCode', '$codeQuestion',$mark,N'$contentReport',$courseCode)";
if($conn ->query($sql) == true)
{
    header('Location:Bank.php?hocphanID='.$courseCode);
}
else{
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
