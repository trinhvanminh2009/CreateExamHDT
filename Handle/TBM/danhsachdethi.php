<?php
if(isset($_GET['MaDT'])){
    $madt=$_GET['MaDT'];

    $con=mysqli_connect("localhost","root","","create_exam");
    mysqli_set_charset($con,"utf8");
    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    $resultTable = mysqli_query($con,"SELECT MaCH,NoiDung FROM cauhoi Where MaCH in (SELECT  MaCH FROM  chitietdethi WHERE MaSoDT='$madt')");

}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Chi tiết đề thi</title>

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
<body>
<div id="wrapper">
    <?php require "MainLayout.php"?>
    <div id="page-wrapper">
        <div id="row">
            <div class="col-lg-12">
                <h1 class="page-header">Chi tiết đề thi <?php $madt?></h1>
            </div>
            <?php
                echo "<h2>Mã đề thi $madt</h2>"
            ?>
            <div class='table-responsive'>
                <?php
                echo "
                      <table class=table name='hocphan'>
                        <thead>
                                    <tr>
                                        <th>Mã câu hỏi </th>
                                        <th>Nội dung</th>
                                        <th>Chức năng</th>
                                    </tr>
                                    </thead>
                                    <tbody>";

                while ($row = mysqli_fetch_array($resultTable)) {
                    echo "<tr>";
                    $a=$row['MaCH'];
                    echo "<td>" . $row['MaCH'] . "</td>";
                    echo "<td>" . $row['NoiDung'] . "</td>";
                    ?>

                    <td><!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">
                            Đổi câu hỏi
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Đổi câu hỏi</h4>
                                    </div>
                                    <div class="modal-body">
                                        <?php

                                        $maCauHoi = $row['MaCH'];
                                        $doKho = $con->query("SELECT DoKho from cauhoi WHERE cauhoi.MaCH = '$maCauHoi'");
                                       // echo  $doKho;
                                        /*$sqlSelectOther = "SELECT cauhoi.MaCH,cauhoi.NoiDung,
                                      cauhoi.DapAnA, cauhoi.DapAnB, cauhoi.DapAnC, 
                                      cauhoi.DapAnD, cauhoi.DapAnDung, cauhoi.DoKho 
                                      FROM cauhoi WHERE cauhoi.MaCH NOT IN(SELECT cauhoi.MaCH FROM cauhoi
                                       INNER JOIN chitietdethi ON cauhoi.MaCH = chitietdethi.MaCH WHERE
                                        cauhoi.DoKho = 'Dễ' and cauhoi.MaCH NOT IN ('$maCauHoi'))
                                         AND cauhoi.DoKho = 'Dễ' and cauhoi.MaCH NOT IN ('$maCauHoi')";*/
                                        ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
                                        <button type="button" class="btn btn-primary">Thay đổi</button>
                                    </div>
                                </div>
                            </div>
                        </div></td>
                    <?php
                    echo "
                           <td>
                                <button type=\"button\" class=\"btn btn-primary\" onclick='return popup2(\" ../TBM/chitietcauhoi.php?macauhoi=$a\",\"note\")'>
                                       Chi Tiết câu hỏi</button>
                                       
                                                            
                           </td>";

                    echo "</tr>";

                }

                echo" </tbody>
                                </table>
                         </form>
                        ";
                ?>
            </div>
        </div>
    </div>



</body>
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
<script src="../js/popup.js"></script>
</body>

</html>
