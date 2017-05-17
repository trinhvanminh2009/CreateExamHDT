<?php
session_start();
$maGiangVien=$_SESSION['email'];
?>
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
<?php

if(isset($_GET['hocphanID'])){
    $maHocPhan=$_GET['hocphanID'];
}
if(isset($_GET['start'])){
    $X=$_GET['start'];
    $sotrang=$X/5;
}else{
    $sotrang=0;
}
global $maHocPhan;
global $maGiangVien;

$serverName = "localhost";
$username1 = "root";
$password1 = "";
$nameData = "create_exam";
$conn = mysqli_connect($serverName, $username1, $password1, $nameData);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "select NoiDung from CauHoi where MaHocPhan ='$maHocPhan'";
mysqli_set_charset($conn, "utf8");
$result = $conn->query($sql);
$noidung;
$listnoidung = array();
$stt = (int)0;
$count=(int)0;
if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        array_push($listnoidung, $row['NoiDung']);
    }
}
$mov_str = implode(",", $listnoidung);
?>
<?php
function loadAll()
{
    global $maHocPhan;
    global $maGiangVien;

    if ($maHocPhan != '') {
        $serverName = "localhost";
        $username1 = "root";
        $password1 = "";
        $nameData = "create_exam";

        $conn = mysqli_connect($serverName, $username1, $password1, $nameData);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }


        $B=5;
        if(isset($_GET['start'])){
            $X=$_GET['start'];
        }
        else{
            $X=0;
        }
        $sqlall="select * from cauhoi WHERE MaHocPhan='$maHocPhan'";
        $sql = "SELECT MaCH,NoiDung, DapAnA, DapAnB, DapAnC, DapAnD, DapAnDung, DoKho from cauhoi where MaCH NOT IN (SELECT MaCH FROM xoacauhoi) and MaHocPhan = '$maHocPhan' LIMIT $X,$B ";
        $queryAll=mysqli_query($conn,$sqlall);
        $A=mysqli_num_rows($queryAll);
        $C=ceil($A/$B);
        mysqli_set_charset($conn, "utf8");
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $maCH=$row['MaCH'];
                echo "Câu hỏi " . $maCH . ":";
                echo $row['NoiDung'] . "<br>";
                if ($row['DapAnDung'] == "DapAnA") {

                    echo "<b style='color: red'> " . "Câu a) " . trim($row['DapAnA']) . "</b> <br>";
                } else {
                    echo "Câu a) " . $row['DapAnA'] . "<br>";
                }

                if ($row['DapAnDung'] == "DapAnB") {
                    echo "<b style='color: red'> " . "Câu b) " . trim($row['DapAnB']) . "</b> <br>";
                } else {
                    echo "Câu b) " . $row['DapAnB'] . "<br>";
                }
                if ($row['DapAnDung'] == "DapAnC") {
                    echo "<b style='color: red'> " . "Câu c) " . trim($row['DapAnC']) . "</b> <br>";
                } else {
                    echo "Câu c) " . $row['DapAnC'] . "<br>";
                }
                if ($row['DapAnDung'] == "DapAnD") {
                    echo "<b style='color: red'> " . "Câu d) " . trim($row['DapAnD']) . "</b> <br>";
                } else {
                    echo "Câu d) " . $row['DapAnD'] . "<br>";
                }

                echo "Độ khó: " . $row['DoKho'];
                echo "<br>";
                $sqlCourse  = "select * from chitietgiangday where MaGiangVien = '$maGiangVien' and MaHocPhan = '$maHocPhan'";
                $resultCourse = mysqli_query($conn,$sqlCourse);
                if($resultCourse->num_rows >0)
                {
                    ?>
                    <form action="Update.php" method="post">

                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                data-target="#myFix<?php echo $maCH ?>" name="btnFix">
                            Sửa câu hỏi <?php echo $maCH ?>

                        </button>

                        <div class="modal fade" id="myFix<?php echo $maCH ?>" tabindex="-1" role="dialog"
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
                                        <input type="hidden" value="<?php echo $maCH ?>" name='codeQuestion'>
                                        <?php

                                        $text =$maCH;
                                        $query = "select NoiDung, DapAnA, DapAnB, DapAnC, DapAnD, DapAnDung, DoKho from cauhoi where MaHocPhan = $maHocPhan and MaCH = '" . $text . "'";
                                        $result1 = $conn->query($query);
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
                    <!-- Delete question -->
                    <form action="Delete.php" method="post" style="margin-top: -30px; margin-left: 130px">

                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                data-target="#myDelete<?php echo $maCH ?>" name="btnFix">
                            Xóa câu hỏi <?php echo $maCH ?>

                        </button>

                        <div class="modal fade" id="myDelete<?php echo $maCH ?>" tabindex="-1" role="dialog"
                             aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                                    aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel" style="color:red">Vui lòng kiểm tra kĩ nội dung câu hỏi trước khi xóa !</h4>.
                                    </div>
                                    <div class="modal-body">
                                        <!-- Get information -->
                                        <input type="hidden" name="txtCourseCode" value="<?php echo $maHocPhan ?>">
                                        <input type="hidden" name="txtTeacherCode" value="<?php echo $maGiangVien ?>">
                                        <input type="hidden" name='codeQuestion' value="<?php echo $maCH ?>" >
                                        <?php

                                        $text =$maCH;
                                        $query = "select NoiDung, DapAnA, DapAnB, DapAnC, DapAnD, DapAnDung, DoKho from cauhoi where MaHocPhan = $maHocPhan and MaCH = '" . $text . "'";
                                        $result1 = $conn->query($query);
                                        if ($result1->num_rows > 0) {
                                            while ($row1 = $result1->fetch_assoc()) {
                                                ?>
                                                <b>Nội dung câu hỏi:</b>
                                                <br>
                                                <textarea name="txtQuestionFix"
                                                          style="border: 3px solid #765942;border-radius: 10px;height: 60px;width: 530px;"
                                                          required
                                                          autocomplete="off" readonly><?php echo $row1['NoiDung'] ?>  </textarea>
                                                <br>
                                                <b>Đáp án a :</b>
                                                <textarea name="txtAnswerA"  style="border: 3px solid #765942;border-radius: 10px;
                        height: 60px;width: 530px;" required autocomplete="off" readonly><?php echo $row1['DapAnA'] ?></textarea>
                                                <br>
                                                <b>Đáp án b :</b>
                                                <textarea name="txtAnswerB"  style="border: 3px solid #765942;border-radius: 10px;
                        height: 60px;width: 530px;" required autocomplete="off" readonly><?php echo $row1['DapAnB'] ?></textarea>
                                                <br>
                                                <b>Đáp án c :</b>
                                                <textarea name="txtAnswerC"  style="border: 3px solid #765942;border-radius: 10px;
                        height: 60px;width: 530px;" required autocomplete="off" readonly><?php echo $row1['DapAnC'] ?></textarea>
                                                <br>
                                                <b>Đáp án d :</b>
                                                <textarea name="txtAnswerD"  style="border: 3px solid #765942;border-radius: 10px;
                        height: 60px;width: 530px;" required autocomplete="off" readonly><?php echo $row1['DapAnD'] ?></textarea>
                                                <br>
                                                <b>Đáp án đúng:</b>
                                                <?php
                                                switch ($row1['DapAnDung']) {
                                                    case "DapAnA":
                                                        ?>
                                                        <select id="soflow-color" name="rightAnswer" required
                                                                autocomplete="off">
                                                            <option value="DapAnA" selected=selected>Đáp án a</option>

                                                        </select>
                                                        <?php
                                                        break;
                                                    case "DapAnB":
                                                        ?>

                                                        <select id="soflow-color" name="rightAnswer" required
                                                                autocomplete="off">

                                                            <option value="DapAnB" selected=selected>Đáp án b</option>
                                                        </select>
                                                        <?php
                                                        break;
                                                    case "DapAnC":
                                                        ?>
                                                        <select id="soflow-color" name="rightAnswer" required
                                                                autocomplete="off">
                                                            <option value="DapAnC" selected=selected>Đáp án c</option>
                                                        </select>
                                                        <?php
                                                        break;
                                                    case "DapAnD":
                                                        ?>
                                                        <select id="soflow-color" name="rightAnswer" required
                                                                autocomplete="off">
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
                                                            <option selected=selected>Rất Dễ</option>

                                                        </select>
                                                        <?php
                                                        break;

                                                    case "Dễ":
                                                        ?>
                                                        <b style="margin-left: 40px">Độ khó: </b>

                                                        <select id="soflow-color" name="levelQuestion" required
                                                                autocomplete="off">
                                                            <option selected=selected>Dễ</option>

                                                        </select>
                                                        <?php
                                                        break;


                                                    case "Trung Bình":
                                                        ?>
                                                        <b style="margin-left: 40px">Độ khó: </b>

                                                        <select id="soflow-color" name="levelQuestion" required
                                                                autocomplete="off">
                                                            <option selected=selected> Trung Bình</option>

                                                        </select>
                                                        <?php
                                                        break;

                                                    case "Khó":
                                                        ?>
                                                        <b style="margin-left: 40px">Độ khó: </b>

                                                        <select id="soflow-color" name="levelQuestion" required
                                                                autocomplete="off">
                                                            <option selected=selected>Khó</option>
                                                        </select>
                                                        <?php
                                                        break;

                                                    case "Rất Khó":
                                                        ?>
                                                        <b style="margin-left: 40px">Độ khó: </b>

                                                        <select id="soflow-color" name="levelQuestion" required
                                                                autocomplete="off">
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
                                        <button type="submit" name = "deleteQuestion" class="btn btn-danger">Xóa</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End Button updates with popup Fix -->
                    </form>
                    <!-- End Delete question -->
                    <?php
                }
                else
                {
                    ?>
                    <br>
                    <form action="Report.php" method="post" >

                        <!-- Start Button report with popup Report -->
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                data-target="#myReport<?php echo $maCH ?>"
                        ">
                        Đánh dấu câu hỏi số <?php echo $maCH ?>
                        </button>
                        <div class="modal fade" id="myReport<?php echo $maCH ?>" tabindex="-1" role="dialog"
                             aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                                    aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Đánh dấu , ghi chú câu hỏi
                                            số <?php echo $maCH ?></h4>.
                                        <!-- Get information -->
                                        <input type="hidden" name="txtCourseCode" value="<?php echo $maHocPhan ?>">
                                        <input type="hidden" name="txtTeacherCode" value="<?php echo $maGiangVien ?>">
                                        <input type="hidden" value="<?php echo $maCH ?>" name='codeQuestion'>
                                    </div>
                                    <div class="modal-body">

                                        <b>Ghi chú </b>
                                        <textarea name="txtReport" style="border: 3px solid #765942;border-radius: 10px;
                        height: 60px;width: 530px;" required autocomplete="off"> </textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                                        <button type="submit" class="btn btn-primary">Lưu ghi chú</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Button report with popup Report -->
                    </form>
                    <?php
                }
                ?>



                <!--Start Button updates with popup Fix -->
                <!-- Modal -->

                <?php
                echo "<br> <br>";


            }
            ?>

            <?php
        } else {
            echo "Hiện chưa có câu hỏi ở trang nay, vui lòng thêm câu hỏi";
        }
        //phân trang
        echo "<div align='center' style='font-size: 250%;'>";
        echo "<div class='table-responsive'>";
        echo"<table cellspacing='5'>";
        echo"<tr>";


        if($C>1){
            $D=$X/$B+1;
            //dieu kien xuat hie nut lui
            if($D!=1){
                $Y =$X- $B;
                echo "<td><button type=\"button\" class=\"btn btn-outline btn-primary\"><a href='Bank.php?hocphanID=$maHocPhan&start=$Y'>pre</a></button></td>";
            }
            for($i=1;$i<=$C;$i++){
                $Y=($i-1)*$B;
                echo "<td><button type=\"button\" class=\"btn btn-outline btn-primary\"><a href='Bank.php?hocphanID=$maHocPhan&start=$Y'>$i</a></button></td>";
            }
            // dieu kien xuat hien nut next
            if($D!=$C){
                $Y=$X+$B;
                echo "<td><button type=\"button\" class=\"btn btn-outline btn-primary\"><a href='Bank.php?hocphanID=$maHocPhan&start=$Y'>Next</a></button></td>";
            }
        }
        echo"</tr>";
        echo"</table>";
       echo"</div>";
        echo"</div>";
        $conn->close();
    }

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
                                <a href="ExamBank.php">Ngân hàng Câu hỏi</a>
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
        <div class="col-lg-12">
            <h1 class="page-header">Số câu hỏi ở trang <?php echo $sotrang+1 ?>:</h1>
        </div>
        <div class="row">
        <?php
        loadAll();
        ?>

            <?php
            $sqlCourse1  = "select * from chitietgiangday where MaGiangVien = '$maGiangVien' and MaHocPhan = '$maHocPhan'";
            $resultCourse1 = mysqli_query($conn,$sqlCourse1);
            if($resultCourse1->num_rows >0)
            {
                ?>
                <form action="HandleBank.php" method="post" id="addQuestion">
                    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
                        Thêm Câu Hỏi
                    </button>
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                                aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">Tạo Câu hỏi</h4>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="txtCourseCode" value="<?php echo $maHocPhan ?>">
                                    <input type="hidden" name="txtTeacherCode" value="<?php echo $maGiangVien ?>">

                                    <b>Nội dung câu hỏi:</b>
                                    <br>

                                    <textarea name = "txtQuestion" id = "txtQuestion" onkeypress ="findMax(this,'.<?php echo $mov_str?>.')"  style="border: 3px solid #765942;border-radius: 10px;
                                 height: 60px;width: 530px;" required autocomplete=\"off\"></textarea>
                                    <br>

                                    <br>

                                    <b>Đáp án a :</b>
                                    <textarea name="txtAnswerA" style="border: 3px solid #765942;border-radius: 10px;
                        height: 60px;width: 530px;" required autocomplete="off"></textarea>
                                    <br>
                                    <b>Đáp án b :</b>
                                    <textarea name="txtAnswerB" style="border: 3px solid #765942;border-radius: 10px;
                        height: 60px;width: 530px;"
                                              required autocomplete="off"></textarea>
                                    <br>
                                    <b>Đáp án c :</b>
                                    <textarea name="txtAnswerC" style="border: 3px solid #765942;border-radius: 10px;
                        height: 60px;width: 530px;" required autocomplete="off"></textarea>
                                    <br>
                                    <b>Đáp án d :</b>
                                    <textarea name="txtAnswerD" style="border: 3px solid #765942;border-radius: 10px;
                        height: 60px;width: 530px;" required autocomplete="off"></textarea>
                                    <br>
                                    <b>Đáp án đúng:</b>
                                    <select id="selectRightAnswer" name="rightAnswer" required autocomplete="off" onchange="checkAddQuestion()">
                                        <option value="chooseRightAnswer">Chọn đán án đúng</option>
                                        <option value="DapAnA">Đáp án a</option>
                                        <option value="DapAnB">Đáp án b</option>
                                        <option value="DapAnC">Đáp án c</option>
                                        <option value="DapAnD">Đáp án d</option>
                                    </select>
                                    <br>
                                    <b style="margin-left: 40px">Độ khó: </b>
                                    <select id = "selectHardLevel"  name="levelQuestion" onchange="checkAddQuestion()" required autocomplete="off">
                                        <option  selected disabled>Chọn độ khó</option>
                                        <option>Rất Dễ</option>
                                        <option>Dễ</option>
                                        <option>Trung Bình</option>
                                        <option>Khó</option>
                                        <option>Rất Khó</option>
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal"
                                    ">Hủy</button>
                                    <button type="submit" class="btn btn-primary" id ="btnAddQuestion" onclick="checkAddQuestion()">Lưu câu hỏi</button>
                                    <br>

                                    <table>
                                        <tr>
                                            <td>
                                                <div>
                                                    <p >
                                                        <strong id="showQuestion"></strong>
                                                        <span class="pull-right text-muted"  style="float: right"></span>
                                                    </p>
                                                    <div class="progress progress-striped active">
                                                        <div id="txtPercent"class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                                            <p id="percentComplete"></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>

                </form>
            <?php
            }
            else{

            }

            ?>
        <!-- Start Add question -->


        <!-- End Add question  -->
    </div>
    <!-- /.panel -->
</div>
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
