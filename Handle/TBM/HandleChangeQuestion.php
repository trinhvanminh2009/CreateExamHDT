<?php

/**
 * Created by PhpStorm.
 * User: Minh
 * Date: 5/18/2017
 * Time: 7:13 AM
 */
if(isset($_POST['txtNewQuestion']))
{
    $newQuestion = $_POST['txtNewQuestion'];
    $oldQuestion = $_POST['txtOldQuestion'];
    $codeExam = $_POST['codeExam'];
    echo $codeExam;
    echo $oldQuestion;
    echo $newQuestion;
    $con=mysqli_connect("localhost","root","","create_exam");
    mysqli_set_charset($con,"utf8");
    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
   $sql = "Update chitietdethi set `MaCH` = '$newQuestion' WHERE `MaCH` = '$oldQuestion' AND `MaSoDT` = '$codeExam'";
    if($con->query($sql) == true)
    {
       header("Location:danhsachdethi.php?MaDT=$codeExam");


    }
    else{
        echo "Error updating record: " . $con->error;
    }
    $con->close();
}
