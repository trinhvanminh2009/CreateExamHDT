<?php
/**
 * Created by PhpStorm.
 * User: Minh
 * Date: 4/26/2017
 * Time: 1:50 PM
 */
if(isset($_POST['btnUndo']))
{
    $codeQuestion = $_POST['txtCodeQuestion'];
    $serverName = "localhost";
    $username1 = "root";
    $password1 = "";
    $nameData = "create_exam";
    $conn = mysqli_connect($serverName, $username1, $password1, $nameData);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "Delete from `XoaCauHoi` WHERE MaCH = '$codeQuestion'";
    if($conn->query($sql) == true)
    {
        header("Location:ListDeleteQuestion.php");
    }
    else{
        echo $conn->error;
    }
}