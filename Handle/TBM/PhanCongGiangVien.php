<?php
/**
 * Created by PhpStorm.
 * User: Minh
 * Date: 4/26/2017
 * Time: 3:20 PM
 */

?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Bootstrap Admin Theme</title>
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
    <?php include_once "MainLayout.php";
    $serverName = "localhost";
    $username1 = "root";
    $password1 = "";
    $nameData = "create_exam";
    $conn = mysqli_connect($serverName, $username1, $password1, $nameData);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "select * from phanconggiangvien where MaTruongBoMon='$tbmID'";
    mysqli_set_charset($conn, "utf8");
    $result = $conn->query($sql);
    ?>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Danh sách phân công</h1>
                <table class=table name='hocphan'>
                    <thead>
                    <tr>

                        <th>Mã học phần</th>
                        <th>Tên Học Phần</th>
                        <th>Học Kỳ</th>
                        <th>Tên giảng viên-Mã Giảng viên</th>
                        <th>Ngày phân công</th>
                        <th>Chức năng</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php
                    while ($row = mysqli_fetch_array($result))
                     {
                        echo "<tr>";

                       ?>
                         <td><?php echo $row['MaHocPhan'] ?></td>
                         <td> <?php
                             $maHocPhan = $row['MaHocPhan'];
                            $mysql = "SELECT TenHocPhan from hocphan WHERE MaHocPhan = '$maHocPhan'";
                             mysqli_set_charset($conn, "utf8");
                             $resultTenHocPhan = $conn->query($mysql);
                             while ($row1 = mysqli_fetch_array($resultTenHocPhan))
                             {
                                 echo $row1[0];
                             }
                             ?></td>
                         <td><?php echo $row['MaHK'] ?></td>
                         <td><?php
                             $maGiangVien = $row['MaGiangVien'];
                             $sqlGiangVien = "SELECT HoTen from giangvien WHERE MaGiangVien = '$maGiangVien'";
                             mysqli_set_charset($conn, "utf8");
                             $resultTenGiangVien = $conn->query($sqlGiangVien);
                             while ($row2 = mysqli_fetch_array($resultTenGiangVien))
                             {
                                 echo $row2['HoTen'];
                                 $fullNameTeacher = $row2['HoTen'];
                             }
                             echo "-".$row['MaGiangVien'];


                             ?></td>
                         <td><?php echo $row['NgayPhanCong']?></td>

                        <td>
                            <form method='post' action='HandleChangeTeacher.php'>
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">
                                    Đổi giảng viên
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">Đổi phân công giảng viên</h4>
                                            </div>
                                            <div class="modal-body">
                                                <?php
                                                $TBMID = $row['MaTruongBoMon'];

                                                 $sqlMaBoMon = "SELECT MaBoMon from truongbomon WHERE MaTruongBoMon = '$TBMID'";
                                                $resultMaBoMon = $conn->query($sqlMaBoMon);
                                                     while ($row3 = mysqli_fetch_array($resultMaBoMon))
                                                     {
                                                         $maBoMon = $row3['MaBoMon'];
                                                     }
                                                     ?>
                                                <h4>Danh sách giảng viên khác cùng trong bộ môn</h4>
                                                <select id="selectRightAnswer" name="newTeacher" required autocomplete="off"">
                                                <?php
                                                $teacherPresent = $row['MaGiangVien'];
                                                $sqlListTeacher = "SELECT * from GiangVien WHERE MaBoMon = '$maBoMon' and  MaGiangVien != '$teacherPresent' ";
                                                $resultListTeacher = $conn->query($sqlListTeacher);
                                                while ($row4 = mysqli_fetch_array($resultListTeacher))
                                                {
                                                    ?>
                                                    <option value="<?php echo $row4['MaGiangVien']?>"><?php echo $row4['HoTen'] ."-".$row4['MaGiangVien'] ?></option>
                                                <?php
                                                }
                                                ?>
                                                </select>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="hidden" name = "maHocPhan" value="<?php echo $row['MaHocPhan']?>">
                                                <input type="hidden" name="MaPhanCong" value="<?php echo $row['MaPhanCong']?>" >
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
                                                <button type="submit" name = "changeTeacher" class="btn btn-primary">Thay đổi</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myRemoveTeacher">
                                    Hủy phân công
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="myRemoveTeacher" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">Hủy phân công giảng viên</h4>
                                            </div>
                                            <div class="modal-body">
                                                <h4 style="color: red">Cảnh báo ! Vui lòng cân nhắc kỹ trước khi hủy phân công giảng viên
                                                    (Có thể môn học chưa được ai quản lý ngân hàng đề).
                                                    Nên đổi giảng viên quản lý hoặc sau khi hủy nên thêm giảng viên quản lý ngay lập tức.</h4>
                                                <h4>Giảng viên đang được chọn để hủy :<?php echo $fullNameTeacher ."-".$row['MaGiangVien'] ?></h4>
                                                <h3></h3>
                                                <input type="hidden" name ="removeMaGiangVien"  value="<?php  echo  $row['MaGiangVien']?>">
                                                <input type="hidden" name = "removeMaHocPhan" value="<?php echo $row['MaHocPhan']?>">
                                                <input type="hidden" name ="removeTruongBoMon"  value="<?php  echo  $row['MaTruongBoMon']?>">
                                                <input type="hidden" name = "removeMaPhanCong" value="<?php echo $row['MaPhanCong']?>">

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                                                <button type="submit" name ="CancelTeacher" class="btn btn-primary">Xác nhận hủy</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <br>
                            <span></span>


                        </td>
                        <?php
                        echo "</tr>";


                    }?>

                    </tbody>
                </table>
                <form action="HandleChangeTeacher.php" method="post">
                    <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#myAddTeacher">
                        Thêm Phân Công
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="myAddTeacher" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Thêm phân công giảng viên</h4>
                                </div>
                                <div class="modal-body">
                                    <?php

                                            //Mã bộ môn
                                    $sqlMaBoMon1 = "SELECT MaBoMon from truongbomon WHERE MaTruongBoMon = '$tbmID'";
                                    $resultMaBoMon = $conn->query($sqlMaBoMon1);

                                    while ($row5 = mysqli_fetch_array($resultMaBoMon)) {
                                        $maBoMon = $row5['MaBoMon'];
                                    }

                                    ?>
                                    <b>Chọn môn học :</b>

                                    <select style="width: 350px" name="listCourse" required autocomplete="off" ">

                                    <?php
                                    $sqlMaHocPhan = "select MaHocPhan from chitiethocphan where MaBoMon = '$maBoMon'";
                                    $resultHocPhan = $conn->query($sqlMaHocPhan);
                                    while ($row6 = mysqli_fetch_array($resultHocPhan))
                                    {
                                        $maHocPhanAdd = $row6['MaHocPhan'];
                                        $mysql = "SELECT TenHocPhan from hocphan WHERE MaHocPhan = '$maHocPhanAdd'";
                                        mysqli_set_charset($conn, "utf8");
                                        $resultTenHocPhan = $conn->query($mysql);
                                        while ($row7 = mysqli_fetch_array($resultTenHocPhan))
                                        {
                                            ?>
                                            <option value="<?php echo $row6['MaHocPhan']?>"><?php echo $row6['MaHocPhan'] ."-".$row7['TenHocPhan'] ?></option>
                                            <?php
                                        }

                                    }
                                    ?>
                                    </select>
                                    <br>

                                    <b>Chọn giảng viên:</b>
                                    <select  name="listTeacher" required autocomplete="off"">
                                    <?php
                                    $teacherPresent = $row['MaGiangVien'];
                                    $sqlListTeacher = "SELECT * from GiangVien WHERE MaBoMon = '$maBoMon' ";//and  MaGiangVien != '$teacherPresent' ";
                                    $resultListTeacher = $conn->query($sqlListTeacher);
                                    while ($row7 = mysqli_fetch_array($resultListTeacher))
                                    {
                                        ?>
                                        <option value="<?php echo $row7['MaGiangVien']?>"><?php echo $row7['HoTen'] ."-".$row7['MaGiangVien'] ?></option>
                                        <?php
                                    }
                                    ?>
                                    </select>

                                </div>
                                <div class="modal-footer">

                                    <input type="hidden" name = "maTruongBoMon" value="<?php echo $tbmID?>">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
                                    <button type="submit" name ="addTeacher" class="btn btn-primary">Thêm phân công</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
                <?php
                if(isset($_SESSION['errorAdd']))
                {
                    echo '<h3 style="text-align: center ; font-weight: 300; color: red">'. $_SESSION['errorAdd']. '</h3>';
                    unset($_SESSION['errorAdd']);
                }
                else
                {

                }
                ?>
            </div>
            <?php   $conn->close(); ?>
        </div>
    </div>
</div>


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
<script src="../dist/js/sb-admin-2.js"></script>
<script src="../js/popup2.js"></script>
</body>

</html>
