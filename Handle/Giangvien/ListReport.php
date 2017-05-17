<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

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


</head>

<body>
<!-- /.navbar-top-links -->

<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                </div>
                <!-- /input-group -->
            </li>
            <li>
                <a href="#"><i class="fa fa-dashboard fa-fw"></i> Giảng Viên<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="TBM/index.php">Ngân hàng đề</a>
                    </li>
                    <li>
                        <a href="userinfo.php">Thông tin giảng viên</a>
                    </li>
                    <li>
                        <a href="ListReport.php">Danh sách ghi chú</a>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->
<?php
/**
 * Created by PhpStorm.
 * User: azaudio
 * Date: 4/15/2017
 * Time: 1:23 PM
 */
session_start();
   if(isset($_SESSION['email'])){
       $maGiangVien=$_SESSION['email'];
       $serverName = "localhost";
       $username1 = "root";
       $password1 = "";
       $nameData = "create_exam";
       $conn = mysqli_connect($serverName, $username1, $password1, $nameData);
       if ($conn->connect_error) {
           die("Connection failed: " . $conn->connect_error);
       }
       $sql = "select * from baocao where MaGiangVien='$maGiangVien'";
       mysqli_set_charset($conn, "utf8");
       $result = $conn->query($sql);

   }
?>
<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="ExamBank.php">Trang tạo đề thi</a>
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">
            <!-- /.dropdown -->
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="#"><i class="fa fa-user fa-fw"></i> <?php echo $maGiangVien ?></a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="..//Login/index.php"><i class="fa fa-sign-out fa-fw"></i> Đăng Xuất</a>
                    </li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="sidebar-search">
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                        </div>
                        <!-- /input-group -->
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-dashboard fa-fw"></i> Giảng Viên<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="ExamBank.php">Xem ngân hàng câu hỏi</a>
                            </li>
                            <li>
                                <a href="userinfo.php">Thông tin giảng viên</a>
                            </li>
                            <li>
                                <a href="ListReport.php">Xem báo cáo đã gửi</a>
                            </li>
                            <li>
                                <a href="ListDeleteQuestion.php">Danh sách câu hỏi đã xóa</a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Danh sách báo cáo đã gửi</h1>
        </div>
            <table class=table name='hocphan'>
                <thead>
                <tr>
                    <th>Mã Câu hỏi</th>
                    <th>Trạng thái</th>
                    <th>Ghi chú</th>
                    <th>Mã học phần</th>
                </tr>
                </thead>
                <tbody>
                <?php while ($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                    echo "<td>".$row['MaCH']."</td>";
                    if($row['DanhDau']==0){
                        echo "<td>Đã xử lý</td>";
                    }
                    else{
                        echo"<td>Chờ xử lý</td>";
                    }
                    echo "<td>" . $row['GhiChu'] . "</td>";
                    echo "
                    <td>".$row['MaHocPhan']."</td>";

                    echo "</tr>";
                    }?>
                </tbody>
            </table>
    </div>
</div>
</div>
</body>
<link rel="stylesheet" type="text/css" href="../dist/css/selector.css">
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
<script src="../dist/js/test2.js"></script>
<script src="../dist/js/sb-admin-2.js"></script>
<script src="../js/popup.js"></script>

</body>

</html>
