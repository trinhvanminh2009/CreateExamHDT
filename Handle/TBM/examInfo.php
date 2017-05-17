<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Thông tin đề thi</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

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
    <?php
     $MATBM=$_SESSION['emailTBM'];
   ?>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Thông tin đề thi</h1>
            </div>
                    <div clas="row" >
                                <div class="col-lg-6">
                                    <form role="form"  id="examinfo" action="insertDeThi.php" onsubmit="return limiter()" method="post">
                                        <div class="form-group">
                                            <label>Mã học phần:</label>
                                            <?php
                                            $hocphanId=$_GET['hocphanID'];
                                            echo "<input class='form-control' id='disabledInput' name='hocphanID' type='text' value='".$hocphanId."'' >";
                                            ?>
                                        </div>
                                        <div class="form-group">
                                            <label>Mã TBM:</label>
                                            <input class="form-control" id="disabledInput" name="tbmid" type="text" value="<?php echo $MATBM?>" >
                                        </div>
                                        <div class="form-group">
                                            <label>Thời gian:</label>
                                            <select name="time" class="form-control">
                                                <option value="45">45 phút</option>
                                                <option value="60">60 phút</option>
                                                <option value="90">90 phút</option>
                                                <option value="120">120 phút</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Số câu hỏi trắc nghiệm:</label>
                                            <select class="form-control" name="soluong">
                                                <option  value="40" selected="selected">40 câu</option>
                                                <option  value="60">60 câu</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Số câu hỏi rất dễ: </label>
                                            <input type="number" class="form-control" id="schrd" name="schrd" min="0" placeholder="Nhập vào số" value="3">
                                        </div>
                                        <div class="form-group">
                                            <label>Số câu hỏi dễ: </label>
                                            <input type="number" class="form-control" id="schd" name="schd" min="0" placeholder="Nhập vào số" value="25">
                                        </div>
                                        <div class="form-group">
                                            <label>Số câu hỏi trung bình: </label>
                                            <input class="form-control" type="number" id="schtb" name="schtb" min="0" placeholder="Nhập vào số" value="7" >
                                        </div>
                                        <div class="form-group">
                                            <label>Số câu hỏi khó: </label>
                                            <input class="form-control" type="number" id="schk" name="schk" min="0"placeholder="Nhập vào số" value="3">
                                        </div>
                                        <div class="form-group">
                                            <label>Số câu hỏi rất khó: </label>
                                            <input class="form-control" type="number" id ="schrk" name="schrk" min="0" placeholder="Nhập vào số" value="2">
                                        </div>
                                        <button type="submit" class="btn btn-default">Tiếp tục</button>
                                        <button type="reset" class="btn btn-default">Reset</button>
                                    </form>
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
</body>
<script src="../js/checkinput.js"></script>
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
<script src="../js/popup2.js"></script>
</body>

</html>
