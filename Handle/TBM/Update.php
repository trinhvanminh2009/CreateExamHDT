<?php
/**
 * Created by PhpStorm.
 * User: Minh
 * Date: 3/27/2017
 * Time: 5:44 PM
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

$content = $_POST['txtQuestionFix'];
$answerA = $_POST['txtAnswerA'];
$answerB = $_POST['txtAnswerB'];
$answerC = $_POST['txtAnswerC'];
$answerD = $_POST['txtAnswerD'];
$hardLevel = $_POST['levelQuestion'];
$rightAnswer = $_POST['rightAnswer'];
$teacherCode = $_POST['txtTeacherCode'];
$courseCode = $_POST['txtCourseCode'];
$codeQuestion = $_POST['codeQuestion'];


if($codeQuestion != '' && $courseCode != '')
{
    $sql = "UPDATE cauhoi set NoiDung = N'$content' , DapAnA = N'$answerA' ,DapAnB = N'$answerB' ,
 DapAnC = N'$answerC' , DapAnD = N'$answerD', DoKho = N'$hardLevel' , DapAnDung = '$rightAnswer'
  WHERE MaHocPhan = '$courseCode' and MaCH = '$codeQuestion'";
    $updatebao="UPDATE baocao set DanhDau = 0 
  WHERE MaHocPhan = '$courseCode' and MaCH = '$codeQuestion'";
    if($conn ->query($sql) == true && $conn->query($updatebao))
    {
        header('Location:processBaoCao.php');
    }
    else{
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();