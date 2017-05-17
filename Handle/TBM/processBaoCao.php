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

    <!-- Navigation -->
    <?php require "MainLayout.php"?>
    <!-- /.navbar-static-side -->
    <?php
    /**
     * Created by PhpStorm.
     * User: azaudio
     * Date: 3/24/2017
     * Time: 3:31 PM
     */
    $maTBM=$_SESSION['emailTBM'];
    $con=mysqli_connect("localhost","root","","create_exam");
    mysqli_set_charset($con,"utf8");
    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    $sql = "SELECT * FROM baocao WHERE DanhDau='1' and MaHocPhan in 
(SELECT MaHocPhan FROM chitiethocphan WHERE MaBoMon in (SELECT  MaBoMon FROM  truongbomon WHERE MaTruongBoMon='$maTBM'))";
    $resultTable = $con->query($sql);
    ?>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Báo Cáo Hiện Có</h1>
            </div>
            <div class='table'>
                <table class=table name='hocphan'>
                    <thead>
                    <tr>
                        <th>Mã Giảng viên</th>
                        <th>Mã Câu hỏi</th>
                        <th>Trạng thái</th>
                        <th>Ghi chú</th>
                        <th>Mã học phần</th>
                        <th>Chức năng</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    while ($row = mysqli_fetch_array($resultTable)) {
                        echo "<tr>";
                        echo"<td>".$row['MaGiangVien']."</td>";
                        echo "<td>".$row['MaCH']."</td>";
                        $mach=$row['MaCH'];
                        $maHocPhan=$row['MaHocPhan'];
                        $maGiangVien=$maTBM;
                        echo"<td>Chờ xử lý</td>";

                        echo "<td>" . $row['GhiChu'] . "</td>";
                        echo "
                        <td>".$row['MaHocPhan']."</td>";
                        ?>
                        <td><form action="Update.php" method="post">

                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                        data-target="#myFix<?php echo $mach ?>" name="btnFix">
                                    Sửa câu hỏi

                                </button>

                                <div class="modal fade" id="myFix<?php echo $mach ?>" tabindex="-1" role="dialog"
                                     aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                                            aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">Sửa Câu Hỏi</h4>.
                                            </div>
                                            <div class="modal-body">
                                                <!-- Get information -->
                                                <input type="hidden" name="txtCourseCode" value="<?php echo $maHocPhan ?>">
                                                <input type="hidden" name="txtTeacherCode" value="<?php echo $maGiangVien ?>">
                                                <input type="hidden" value="<?php echo $mach ?>" name='codeQuestion'>
                                                <?php

                                                $text = $mach;
                                                $query = "select NoiDung, DapAnA, DapAnB, DapAnC, DapAnD, DapAnDung, DoKho from cauhoi where MaHocPhan = $maHocPhan and MaCH = '" . $text . "'";
                                                $result1 = $con->query($query);
                                                if ($result1->num_rows > 0) {
                                                    while ($row1 = $result1->fetch_assoc()) {
                                                        ?>
                                                        <b>Nội dung câu hỏi:</b>
                                                        <br>
                                                        <textarea name="txtQuestionFix"
                                                                  style="border: 3px solid #765942;border-radius: 10px;height: 60px;width: 530px;"
                                                                  required
                                                                  autocomplete="off"><?php echo $row1['NoiDung'] ?> </textarea>
                                                        <br>
                                                        <b>Đáp án a :</b>
                                                        <textarea name="txtAnswerA" style="border: 3px solid #765942;border-radius: 10px;
                        height: 60px;width: 530px;" required autocomplete="off"><?php echo $row1['DapAnA'] ?></textarea>
                                                        <br>
                                                        <b>Đáp án b :</b>
                                                        <textarea name="txtAnswerB" style="border: 3px solid #765942;border-radius: 10px;
                        height: 60px;width: 530px;" required autocomplete="off"><?php echo $row1['DapAnB'] ?></textarea>
                                                        <br>
                                                        <b>Đáp án c :</b>
                                                        <textarea name="txtAnswerC" style="border: 3px solid #765942;border-radius: 10px;
                        height: 60px;width: 530px;" required autocomplete="off"><?php echo $row1['DapAnC'] ?></textarea>
                                                        <br>
                                                        <b>Đáp án d :</b>
                                                        <textarea name="txtAnswerD" style="border: 3px solid #765942;border-radius: 10px;
                        height: 60px;width: 530px;" required autocomplete="off"><?php echo $row1['DapAnD'] ?></textarea>
                                                        <br>
                                                        <b>Đáp án đúng:</b>
                                                        <?php
                                                        switch ($row1['DapAnDung']) {
                                                            case "DapAnA":
                                                                ?>
                                                                <select id="soflow-color" name="rightAnswer" required
                                                                        autocomplete="off">

                                                                    <option selected disabled>Chọn đán án đúng</option>
                                                                    <option value="DapAnA" selected=selected>Đáp án a</option>
                                                                    <option value="DapAnB">Đáp án b</option>
                                                                    <option value="DapAnC">Đáp án c</option>
                                                                    <option value="DapAnD">Đáp án d</option>
                                                                </select>
                                                                <?php
                                                                break;
                                                            case "DapAnB":
                                                                ?>

                                                                <select id="soflow-color" name="rightAnswer" required
                                                                        autocomplete="off">

                                                                    <option selected disabled>Chọn đán án đúng</option>
                                                                    <option value="DapAnA">Đáp án a</option>
                                                                    <option value="DapAnB" selected=selected>Đáp án b</option>
                                                                    <option value="DapAnC">Đáp án c</option>
                                                                    <option value="DapAnD">Đáp án d</option>
                                                                </select>
                                                                <?php
                                                                break;
                                                            case "DapAnC":
                                                                ?>
                                                                <select id="soflow-color" name="rightAnswer" required
                                                                        autocomplete="off">

                                                                    <option selected disabled>Chọn đán án đúng</option>
                                                                    <option value="DapAnA">Đáp án a</option>
                                                                    <option value="DapAnB">Đáp án b</option>
                                                                    <option value="DapAnC" selected=selected>Đáp án c</option>
                                                                    <option value="DapAnD">Đáp án d</option>
                                                                </select>
                                                                <?php
                                                                break;
                                                            case "DapAnD":
                                                                ?>
                                                                <select id="soflow-color" name="rightAnswer" required
                                                                        autocomplete="off">

                                                                    <option selected disabled>Chọn đán án đúng</option>
                                                                    <option value="DapAnA">Đáp án a</option>
                                                                    <option value="DapAnB">Đáp án b</option>
                                                                    <option value="DapAnC">Đáp án c</option>
                                                                    <option value="DapAnD" selected=selected>Đáp án d</option>
                                                                </select>
                                                                <?php
                                                                break;
                                                                ?>

                                                                }

                                                                <?php
                                                        }
                                                        ?>
                                                        <br>
                                                        <?php
                                                        switch ($row1['DoKho']) {
                                                            case "Rất Dễ":

                                                                ?>
                                                                <b style="margin-left: 40px">Độ khó: </b>

                                                                <select id="soflow-color" name="levelQuestion" required
                                                                        autocomplete="off">

                                                                    <option selected disabled>Chọn độ khó</option>
                                                                    <option selected=selected>Rất Dễ</option>
                                                                    <option>Dễ</option>
                                                                    <option>Trung Bình</option>
                                                                    <option>Khó</option>
                                                                    <option>Rất Khó</option>
                                                                </select>
                                                                <?php
                                                                break;

                                                            case "Dễ":
                                                                ?>
                                                                <b style="margin-left: 40px">Độ khó: </b>

                                                                <select id="soflow-color" name="levelQuestion" required
                                                                        autocomplete="off">

                                                                    <option selected disabled>Chọn độ khó</option>
                                                                    <option>Rất Dễ</option>
                                                                    <option selected=selected>Dễ</option>
                                                                    <option>Trung Bình</option>
                                                                    <option>Khó</option>
                                                                    <option>Rất Khó</option>
                                                                </select>
                                                                <?php
                                                                break;


                                                            case "Trung Bình":
                                                                ?>
                                                                <b style="margin-left: 40px">Độ khó: </b>

                                                                <select id="soflow-color" name="levelQuestion" required
                                                                        autocomplete="off">

                                                                    <option selected disabled>Chọn độ khó</option>
                                                                    <option>Rất Dễ</option>
                                                                    <option>Dễ</option>
                                                                    <option selected=selected> Trung Bình</option>
                                                                    <option>Khó</option>
                                                                    <option>Rất Khó</option>
                                                                </select>
                                                                <?php
                                                                break;

                                                            case "Khó":
                                                                ?>
                                                                <b style="margin-left: 40px">Độ khó: </b>

                                                                <select id="soflow-color" name="levelQuestion" required
                                                                        autocomplete="off">

                                                                    <option selected disabled>Chọn độ khó</option>
                                                                    <option>Rất Dễ</option>
                                                                    <option>Dễ</option>
                                                                    <option> Trung Bình</option>
                                                                    <option selected=selected>Khó</option>
                                                                    <option>Rất Khó</option>
                                                                </select>
                                                                <?php
                                                                break;

                                                            case "Rất Khó":
                                                                ?>
                                                                <b style="margin-left: 40px">Độ khó: </b>

                                                                <select id="soflow-color" name="levelQuestion" required
                                                                        autocomplete="off">

                                                                    <option selected disabled>Chọn độ khó</option>
                                                                    <option>Rất Dễ</option>
                                                                    <option>Dễ</option>
                                                                    <option> Trung Bình</option>
                                                                    <option>Khó</option>
                                                                    <option selected=selected>Rất Khó</option>
                                                                </select>
                                                                <?php
                                                                break;

                                                        }

                                                        ?>


                                                        <?php
                                                    }
                                                }

                                                ?>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                                                <button type="submit" class="btn btn-primary">Lưu lại</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--End Button updates with popup Fix -->
                            </form>
                        </td>
                        <?php

                        echo "</tr>";
                    }
                    ?>

                    </tbody>
            </div>
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
