<?php
/**
 * Created by PhpStorm.
 * User: Minh
 * Date: 4/26/2017
 * Time: 7:53 AM
 */
if(isset($_POST['deleteQuestion']))
{
    $teacherCode = $_POST['txtTeacherCode'];
    $courseCode = $_POST['txtCourseCode'];
    $codeQuestion = $_POST['codeQuestion'];

    $serverName = "localhost";
    $username1 = "root";
    $password1 = "";
    $nameData = "create_exam";

    $conn = mysqli_connect($serverName, $username1, $password1, $nameData);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "insert into xoacauhoi(MagiangVien, MaHocPhan, MaCH) 
    VALUES ('$teacherCode', '$courseCode', '$codeQuestion')";
    if($conn->query($sql) == true)
    {
        header("Location:bank.php?hocphanID=$courseCode");
    }
    else{
        echo $conn->error;
    }

}