<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Bootstrap Admin Theme</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Social Buttons CSS -->
    <link href="../vendor/bootstrap-social/bootstrap-social.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "create_exam";

    if(isset($_GET['macauhoi'])) {

        $masodt=$_GET['masodt'];
        $MaSoDT="DT".(string)$masodt;
        $listMacauhoi=$_GET['macauhoi'];
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

        foreach ($listMacauhoi as $macauhoi){
            // set the PDO error mode to exception
            //printf($macauhoi);
            $sql = "INSERT INTO chitietdethi (MaSoDT, MaCH)
            VALUES ('$MaSoDT','$macauhoi')";

            // use exec() because no results are returned
          $conn->query($sql);
        }

        header("location:../TBM/index.php");


    }
?>
<body>
<div id="wrapper">
    <?php require "MainLayout.php"?>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Thông tin đề thi</h1>
            </div>
</body>
<?php


if(isset($_POST['hocphanID'])||isset($_POST['tbmid'])) {
    include 'CauHoi.php';
    $hocphanId=$_POST['hocphanID'];
    $tbmid=$_POST['tbmid'];
    $time=$_POST['time'];
    $schtb=$_POST['schtb'];
    $schrd=$_POST['schrd'];
    $schd=$_POST['schd'];
    $schk=$_POST['schk'];
    $schrk=$_POST['schrk'];
    $MaSoDT="DT";
    $count=1;
    try {
        $con=mysqli_connect("localhost","root","","create_exam");
        $result = mysqli_query($con,"SELECT * FROM dethi");
        while($row = mysqli_fetch_array($result))
        {
            $count+=1;
        }
        $MaSoDT="DT".(string)$count;
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO dethi (MaSoDT, ThoiGian, SoCauHoiDe,SoCauHoiTB,SoCauHoiKho,SoCauHoiRatKho,MaHocPhan,MaTruongBoMon)
        VALUES ('$MaSoDT','$time','$schd','$schtb','$schk','$schrk','$hocphanId', '$tbmid')";
        // use exec() because no results are returned
        $conn->exec($sql);
        echo "
            
             <div class=\"col-lg-12\">
                    <div class=\"panel panel-green\">
                    <div class=\"panel-heading\">
                       Tạo đề thi thành công, Chi Tiết đề thi:
                    </div>
                    <div class=\"panel-body\">
                    <div class=\"table-responsive\">
                    <form method='get'>
                    <table class=\"table\">
                    <thead>
                           <tr>
                                <th>#</th>
                                <th>Nội Dung</th>
                                <th>Độ khó</th>
                                <th></th>
                                <th>Chức năng</th>
                           </tr>
                    </thead>       
                    <tbody>
                    ";
            if($schrd>0) {
                echo "<tr class='info'>";
                echo "<td colspan='4'> Số câu hỏi rất dễ: </td>";
                echo "</tr>";
                writeTable($schrd, getListchrde($schrd,$hocphanId));
            }
            if($schd>0) {
                echo "<tr class='info'>";
                echo "<td colspan='4'> Số câu hỏi dễ: </td>";
                echo "</tr>";
                writeTable($schd, getListchde($schd,$hocphanId));
            }
            if($schtb>0) {
                echo "<tr class='info'>";
                echo "<td colspan='4'> Số câu hỏi trung bình: </td>";
                echo "</tr>";
                writeTable($schtb, getListchtb($schtb,$hocphanId));
            }
            if($schk>0) {
                echo "<tr class='info'>";
                echo "<td colspan='4'> Số câu hỏi khó: </td>";
                echo "</tr>";
                writeTable($schk, getListchk($schk,$hocphanId));
            }
            if($schrk>0) {
                echo "<tr class='info'>";
                echo "<td colspan='4'> Số câu hỏi rất khó: </td>";
                echo "</tr>";
                writeTable($schrk, getListchrk($schrk,$hocphanId));

            }
            echo "<tr>";
            echo "
            <input type='hidden' name='masodt' value='$count'>
            <td colspan='4'> <button style='text-align: right' class='btn-default btn' type='submit' value='Tạo đề thi'>Tạo đề thi</button> </td>";
            echo "</tr>";
            echo"</tbody>
            </form>
            </div>";
    } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
    mysqli_close($con);
}
function getListchrde($schd,$hocphanID){
    if($schd!=0) {

        $listCauHoiDe = array();
        $con = mysqli_connect("localhost", "root", "", "create_exam");
        mysqli_set_charset($con,"utf8");
        $resultCauHoiDe = mysqli_query($con, "SELECT NoiDung,DoKho,MaCH  FROM cauhoi WHERE DoKho=N'Rất Dễ' AND MaHocPhan='$hocphanID'");
        while ($row = mysqli_fetch_array($resultCauHoiDe)) {
            $cauhoide = new CauHoi();
            $cauhoide->macauhoi = $row['MaCH'];
            $cauhoide->noidung = $row['NoiDung'];
            $cauhoide->dokho = $row['DoKho'];
            array_push($listCauHoiDe, $cauhoide);

        }
        mysqli_close($con);
        return $listCauHoiDe;
    }
}
function getListchde($schd,$hocphanID){
    if($schd!=0) {

        $listCauHoiDe = array();
        $con = mysqli_connect("localhost", "root", "", "create_exam");
        mysqli_set_charset($con,"utf8");
        $resultCauHoiDe = mysqli_query($con, "SELECT NoiDung,DoKho,MaCH  FROM cauhoi WHERE DoKho=N'Dễ' AND MaHocPhan='$hocphanID'");
        while ($row = mysqli_fetch_array($resultCauHoiDe)) {
            $cauhoide = new CauHoi();
            $cauhoide->macauhoi = $row['MaCH'];
            $cauhoide->noidung = $row['NoiDung'];
            $cauhoide->dokho = $row['DoKho'];
            array_push($listCauHoiDe, $cauhoide);

        }
        mysqli_close($con);
        return $listCauHoiDe;
    }
}
function getListchtb($schd,$hocphanID){
    if($schd!=0) {
        $listCauHoiDe = array();
        $con = mysqli_connect("localhost", "root", "", "create_exam");
        mysqli_set_charset($con,"utf8");
        $resultCauHoiDe = mysqli_query($con, "SELECT NoiDung,DoKho,MaCH FROM cauhoi WHERE DoKho=N'Trung Bình' AND MaHocPhan='$hocphanID'");
        mysqli_set_charset($con,"utf8");
        while ($row = mysqli_fetch_array($resultCauHoiDe)) {
            $cauhoide = new CauHoi();
            $cauhoide->macauhoi=$row['MaCH'];
            $cauhoide->noidung = $row['NoiDung'];
            $cauhoide->dokho=$row['DoKho'];
            array_push($listCauHoiDe, $cauhoide);
        }
        mysqli_close($con);
        return $listCauHoiDe;
    }
}
function getListchk($schd,$hocphanID){
    if($schd!=0) {
        $listCauHoiDe = array();
        $con = mysqli_connect("localhost", "root", "", "create_exam");
        mysqli_set_charset($con,"utf8");
        $resultCauHoiDe = mysqli_query($con, "SELECT NoiDung,DoKho,MaCH FROM cauhoi WHERE DoKho=N'Khó' AND MaHocPhan='$hocphanID'");
        mysqli_set_charset($con,"utf8");
        while ($row = mysqli_fetch_array($resultCauHoiDe)) {
            $cauhoide = new CauHoi();
            $cauhoide->macauhoi=$row['MaCH'];
            $cauhoide->noidung = $row['NoiDung'];
            $cauhoide->dokho=$row['DoKho'];
            array_push($listCauHoiDe, $cauhoide);
        }
        mysqli_close($con);
        return $listCauHoiDe;
    }
}
function getListchrk($schd,$hocphanID){
    if($schd!=0) {
        $listCauHoiDe = array();
        $con = mysqli_connect("localhost", "root", "", "create_exam");
        mysqli_set_charset($con,"utf8");
        $resultCauHoiDe = mysqli_query($con, "SELECT NoiDung,DoKho,MaCH FROM cauhoi WHERE DoKho=N'Rất Khó'AND MaHocPhan='$hocphanID'");
        mysqli_set_charset($con,"utf8");
        while ($row = mysqli_fetch_array($resultCauHoiDe)) {
            $cauhoide = new CauHoi();
            $cauhoide->macauhoi=$row['MaCH'];
            $cauhoide->noidung = $row['NoiDung'];
            $cauhoide->dokho=$row['DoKho'];
            array_push($listCauHoiDe, $cauhoide);
        }
        mysqli_close($con);
        return $listCauHoiDe;
    }
}

function writeTable($sch,$list){
    $i=(int)0;
    $stt=(int)1;
    $scht=$sch-1;
    $chso=rand(0,$scht);
    $listchdathem=array();
    $kt=true;

    for ($i; $i < $sch; $i++) {
        echo "<tr>";
        echo "<ul class nav>";
        echo "<td>" . $stt . "</td>";
        $stt+=1;
        while($kt==false){
            $chso=rand(0,$scht);
            $kt=true;
            foreach ($listchdathem as$cauhoidathem){
                if($cauhoidathem==$chso){
                    $kt=false;
                }

            }

        }
        array_push($listchdathem,$chso);
        $kt=false;
        $a=$list[$chso]->macauhoi;
        echo "<input type='hidden' name='macauhoi[]' value='$a'>";
        echo "<td>" . $list[$chso]->noidung . "</td>";
        echo "<td>" . $list[$chso]->dokho . "</td>";
        echo"<td><a  class=\"btn btn-facebook\" onclick='return popup2(\"../TBM/chitietcauhoi.php?macauhoi=$a\",\"note\")'>Chi Tiết câu hỏi</button></td>";
        echo "</tr>";
    }
}
function getListCauhoi($mach,$arr){
    $arr=array();
    array_push($arr,$mach);
}
?>

<script src="../js/popup.js"></script>
<!-- /#wrapper -->
<!-- jQuery -->
<script src="../vendor/jquery/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="../vendor/metisMenu/metisMenu.min.js"></script>
<!-- Morris Charts JavaScript -->
<script src="../vendor/raphael/raphael.min.js"></script>
<script src="../vendor/morrisjs/morris.min.js"></script>
<script src="../data/morris-data.js"></script>

<!-- Custom Theme JavaScript -->
<script src="../dist/js/sb-admin-2.js"></script>
</body>

</html>
