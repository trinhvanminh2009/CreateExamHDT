<?php
/**
 * Created by PhpStorm.
 * User: azaudio
 * Date: 3/24/2017
 * Time: 3:31 PM
 */
$con=mysqli_connect("localhost","root","","create_exam");
mysqli_set_charset($con,"utf8");
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
if(isset($_POST['hocky'])) {
    $dropdown = $_POST['hocky'];
    $resultTable = mysqli_query($con,"SELECT * FROM HocPhan Where MaHocPhan in (SELECT  MaHocPhan FROM  ChiTietHocKy WHERE MaHK='$dropdown')");
}

?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="icon" type="image/png" href="../../img/Create%20New-24.png">
    <title>Create Exam</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- DataTables Responsive CSS -->
    <link href="../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<div id="wrapper">

    <!-- Navigation -->
    <?php require "MainLayout.php"?>
        <!-- /.navbar-static-side -->

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Học phần hiện có</h1>
            </div>
            <div class="form-group">
                <label style="font-size: larger">Chọn học kỳ để xem học phần:</label>
                <?php

                $result = mysqli_query($con,"SELECT * FROM hocky");
                echo "<form name='dropdownform' action='index.php' method='post'>";
                echo "<select class='form-control' name='hocky' onchange='this.form.submit();'>"; // Open your drop down box

                    // Loop through the query results, outputing the options one by one
                    while ($row = mysqli_fetch_array($result)) {
                        if($row['MaHK']==$dropdown && isset($dropdown)) {
                            echo "<option value='" . $row['MaHK'] . "'selected=selected>" . $row['MaHK'] . "</option>";
                        }
                        else{
                            echo "<option value='" . $row['MaHK'] . "'>" . $row['MaHK'] . "</option>";
                        }

                    }

                    echo "</select>";
                ?>
                <div class='table-responsive'>
                    <?php
                            echo "
                             <form method='get' action='index.php' name='formsubmit' target='_blank' id='myform'>
                                <table class=table name='hocphan'>
                                    <thead>
                                    <tr>
                                        <th>Mã học phần</th>
                                        <th>Tên học phần</th>
                                        <th>Số tín chỉ</th>
                                        <th>Chức năng</th>
                                    </tr>
                                    </thead>
                                    <tbody>";
                                $count=0;
                                if(isset($dropdown)) {
                                    while ($row = mysqli_fetch_array($resultTable)) {
                                        echo "<tr>";
                                        echo"<input type='hidden' name='hocphanID[]' value='" . $row['MaHocPhan'] . "'>";
                                        echo"<input type='hidden' name='index[]' value='" .$count  . "'>";
                                        $a=$row['MaHocPhan'];
                                        $count+=1;
                                        echo "<td>" . $row['MaHocPhan'] . "</td>";
                                        echo "<td>" . $row['TenHocPhan'] . "</td>";
                                        echo "<td>" . $row['SoTinChi'] . "</td>";
                                        echo "
                                         <td>
                                          <button type=\"button\" class=\"btn btn-outline btn-primary\"><a href='examInfo.php?hocphanID=$a'>
                                            Tạo đề thi
                                        </a></button>
                                         <button type=\"button\" class=\"btn btn-outline btn-info\"><a href='index.php?hocphanID=$a'>Vào ngân hàng đề</a></button>
                                        
                                         </td>";

                                        echo "</tr>";
                                    }

                                }

                                echo" </tbody>
                                </table>
                         </form>
                        ";
                    ?>
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->
            <!-- /.col-lg-12 -->
        <?php
        if(isset($_GET['hocphanID'])){
            $hocphanId=$_GET['hocphanID'];
            mysqli_set_charset($con,"utf8");
            $result = mysqli_query($con,"SELECT * FROM dethi WHERE MaHocPhan='$hocphanId'");
            echo"<h1 class=\"page-header\">Ngân hàng đề thi của mã học phần: $hocphanId</h1>";
            echo"  <table class=table name='hocphan'>
                                    <thead>
                                    <tr>
                                        <th>Mã số đề thi</th>
                                        <th>Thời gian</th>
                                        <th>Số câu hỏi dễ</th>
                                        <th>Số câu hỏi trung bình</th>
                                        <th>Số câu hỏi khó</th>
                                        <th>Số câu hỏi rất khó</th>
                                        <th>Mã Trưởng bộ môn</th>
                                        <th>Chức năng</th>
                                    </tr>
                                    </thead>
                                    <tbody>";
            while ($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo"<input type='hidden' name='hocphanID' value='" . $row['MaHocPhan'] . "'>";
                $a=$row['MaSoDT'];
                echo "<td>" . $row['MaSoDT'] . "</td>";
                echo "<td>" . $row['ThoiGian'] . "</td>";
                echo "<td>" . $row['SoCauHoiDe'] . "</td>";
                echo "<td>" . $row['SoCauHoiTB'] . "</td>";
                echo "<td>" . $row['SoCauHoiKho'] . "</td>";
                echo "<td>" . $row['SoCauHoiRatKho'] . "</td>";
                echo "<td>" . $row['MaTruongBoMon'] . "</td>";
                echo "
                        <td>
                            <button type=\"button\" class=\"btn btn-outline btn-danger\">   <a href='danhsachdethi.php?MaDT=$a' style='color:darkred'>
                                 Chi Tiết Đề Thi
                        </a></button></td>";
                echo "</tr>";
            }
            echo" </tbody>
                   </table>";
        }
        ?>
    </div>

        <!-- /.row -->

    </div>
    <!-- /.row -->
    <!-- /.row -->
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
<?php mysqli_close($con);?>
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
<script src="../js/popup2.js"></script>
</body>

</html>
