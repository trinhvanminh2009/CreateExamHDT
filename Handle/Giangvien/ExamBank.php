<?php
/**
 * Created by PhpStorm.
 * User: azaudio
 * Date: 3/24/2017
 * Time: 3:31 PM
 */
session_start();
$maGiangVien=$_SESSION['email'];
$con=mysqli_connect("localhost","root","","create_exam");
mysqli_set_charset($con, "utf8");
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
if(isset($_POST['hocky'])) {
    $dropdown = $_POST['hocky'];
    $resultTable = mysqli_query($con,"SELECT * FROM HocPhan Where MaHocPhan in (SELECT  MaHocPhan FROM  ChiTietHocKy WHERE MaHK='$dropdown')");
    echo "<table>";

    echo "</table>";
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

    <title>Tạo đề thi</title>
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
                    <li><a href="../Login/index.php"><i class="fa fa-sign-out fa-fw"></i> Đăng Xuất</a>
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
                <h1 class="page-header">Học phần hiện có</h1>
            </div>
            <div class="form-group">
                <label style="font-size: larger">Chọn học kỳ để xem học phần:</label>
                <?php

                $result = mysqli_query($con,"SELECT * FROM hocky");
                echo "<form name='dropdownform' action='ExamBank.php' method='post'>";
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
                <?php
                echo"
                         <div class='table-responsive'>
                        
                                <table class=table '>
                                    <thead>
                                    <tr>
                                        <th>Mã học phần</th>
                                        <th>Tên học phần</th>
                                        <th>Số tín chỉ</th>
                                        <th>Chức năng</th>
                                    </tr>
                                    </thead>
                                    <tbody>";
                if(isset($dropdown)) {
                    while ($row = mysqli_fetch_array($resultTable)) {


                        echo " <tr>";
                        $a=$row['MaHocPhan'];
                        echo "<td>" . $row['MaHocPhan'] . "</td>";
                        echo "<td>" . $row['TenHocPhan'] . "</td>";
                        echo "<td>" . $row['SoTinChi'] . "</td>";
                        echo "<td>
                                     <button type=\"button\" class=\"btn btn - outline btn - primary\"><a href='bank.php?hocphanID=$a'>
                                            Vào ngân hàng câu hỏi
                                        </a></button>       
                                        </td>";
                        echo "</tr>";

                    }
                }

                echo" </tbody>
                                </table>";


                ?>
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-6 -->
    </div>
    <!-- /.row -->
    <!-- /.col-lg-12 -->
</div>

<!-- /.row -->

</div>
<!-- /.row -->
<!-- /.row -->
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
<script src="../js/popup.js"></script>
<?php mysqli_close($con);?>
</body>

</html>
