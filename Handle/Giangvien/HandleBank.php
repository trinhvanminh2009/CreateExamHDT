<?php
include "Question.php";


/**
 *
 * Created by PhpStorm.
 * User: Minh
 * Date: 3/26/2017
 * Time: 5:48 PM
 */
$serverName = "localhost";
$username1 = "root";
$password1 = "";
$nameData = "create_exam";
$conn = mysqli_connect($serverName, $username1, $password1, $nameData);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sqlRows = "select * from CauHoi";
$resultRows=mysqli_query($conn,$sqlRows);
$row=mysqli_num_rows($resultRows);


//Define variables
$questionCode = "CH".++$row;
$content = $_POST['txtQuestion'];
$answerA = $_POST['txtAnswerA'];
$answerB = $_POST['txtAnswerB'];
$answerC = $_POST['txtAnswerC'];
$answerD = $_POST['txtAnswerD'];
$hardLevel = $_POST['levelQuestion'];
$rightAnswer = $_POST['rightAnswer'];
$teacherCode = $_POST['txtTeacherCode'];
$courseCode = $_POST['txtCourseCode'];

if($rightAnswer != '' && $hardLevel != '')
{
    $sql = "insert into CauHoi (MaCH, NoiDung,DapAnA, DapAnB, DapAnC,DapAnD, DoKho, DapAnDung,MaGiangVien,MaHocPhan)
VALUES (N'$questionCode', N'$content', N'$answerA', N'$answerB', N'$answerC', N'$answerD',N'$hardLevel', N'$rightAnswer',
N'$teacherCode', N'$courseCode')";
    mysqli_set_charset($conn,"utf8");
    if($conn ->query($sql) == true)
    {
        header('Location:Bank.php?hocphanID='.$courseCode.'');
    }
    else{
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
else{



}


$conn->close();




