



<?php
    session_start();
    $magiangvien=$_SESSION['emailTBM'];
    $user='root';
    $pass='';
    $db='create_exam';

    $con=mysqli_connect("localhost","root","","create_exam");
    mysqli_set_charset($con,"utf8");
    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    $result = mysqli_query($con,"SELECT * FROM truongbomon WHERE MaTruongBoMon='$magiangvien'");

    while($row = mysqli_fetch_array($result))
    {
       $MaGiangVien=$row['MaTruongBoMon'];
       $Hoten=$row['HoTen'] ;
       $MaBoMon=$row['MaBoMon'];
       $NgaySinh=$row['NgaySinh'];
       $HocVi=$row['HocVi'];
    }
    session_commit();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Tạo đề thi</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">



    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<div id="wrapper">

    <?php require "MainLayout.php"?>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Thông tin giảng viên</h1>
                <div class="row">
                    <div class="col-lg-3 col-md-6" style=" margin-left: 350px;font-size: large">
                        <img src="../../img/teacher.png" height="100" width="100" style="margin-left: 50px" />
                        <br/><br/>
                        <table>
                            <tr>
                                <td>  <label>Mã TBM:</label></td>
                                <td> <label class="text-info" name="MTBM"><?php echo $MaGiangVien?></label></td>
                            </tr>
                            <tr>
                                <td>  <label>Mã bộ môn:</label></td>
                                <td> <label class="text-info" name="MBM"><?php  echo $MaBoMon?></label><br/></td>
                            </tr>
                            <tr>
                                <td>  <label>Họ tên:</label></td>
                                <td> <label class="text-info" name="hotentbm"><?php echo $Hoten?></label><br/></label></td>
                            </tr>
                            <tr>
                                <td>  <label>Ngày sinh:</label></td>
                                <td> <label class="text-info" name="ngaysinhtbm"><?php echo $NgaySinh?></label></td>
                            </tr>
                            <tr>
                                <td> <label>Học vị:</label></td>
                                <td> <label class="text-info" name="hocvitbm"><?php echo $HocVi?></label></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

    </div>
    <!-- /.row -->
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->

</div>
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

