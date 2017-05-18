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

    <link rel="icon" type="image/png" href="../../img/Create%20New-24.png">
    <title>Create Exam</title>


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
    <link rel="stylesheet" type="text/css" href="../dist/css/normalize.css" />
    <link rel="stylesheet" type="text/css" href="../dist/css/demo.css" />
    <link rel="stylesheet" type="text/css" href="../dist/css/component.css" />
    <link rel="stylesheet" type="text/css" href="../dist/css/checkBox.css" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>

    </style>
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
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal<?php echo $a?>">
                            Đổi câu hỏi
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="myModal<?php echo $a?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Đổi câu hỏi</h4>
                                    </div>
                                    <div class="modal-body">
                                        <?php
                                        $sqlSelectHardLevel = "SELECT DoKho from cauhoi WHERE cauhoi.MaCH = '$a'";
                                        $tempDoKho = $con->query($sqlSelectHardLevel);
                                        $hardLevel = $tempDoKho->fetch_assoc();
                                        $dokho = $hardLevel['DoKho'];
                                        echo "<h2 style='color: green;'>Các câu hỏi có độ khó ($dokho) còn lại: </h2> <br>";
                                        $sqlSelectOther = "SELECT cauhoi.MaCH,cauhoi.NoiDung,
                                      cauhoi.DapAnA, cauhoi.DapAnB, cauhoi.DapAnC, 
                                      cauhoi.DapAnD, cauhoi.DapAnDung, cauhoi.DoKho 
                                      FROM cauhoi WHERE cauhoi.MaCH NOT IN(SELECT cauhoi.MaCH FROM cauhoi
                                       INNER JOIN chitietdethi ON cauhoi.MaCH = chitietdethi.MaCH WHERE
                                        cauhoi.DoKho = '$dokho' and cauhoi.MaCH NOT IN ('$a')
                                        AND chitietdethi.MaSoDT = '$madt')
                                         AND cauhoi.DoKho = '$dokho' and cauhoi.MaCH NOT IN ('$a')";
                                        $resultOtherQuestions = $con->query($sqlSelectOther);
                                        if($resultOtherQuestions->num_rows >0)
                                        {
                                            while ($rowOtherQuestions = $resultOtherQuestions->fetch_assoc())
                                            {
                                                echo "<form action='HandleChangeQuestion.php' method='post'>";
                                                $maCauHoi = $rowOtherQuestions['MaCH'];
                                                 echo  $rowOtherQuestions['MaCH']. ": ". $rowOtherQuestions['NoiDung'] ."<br>";
                                                echo "<input type='hidden' value='$madt' name='codeExam'>";
                                                switch ($rowOtherQuestions['DapAnDung'] )
                                                {
                                                    case "DapAnA":
                                                        echo "<table>";
                                                         $tempDapAnA = $rowOtherQuestions['DapAnA'];
                                                          echo "<tr><td style='color: red'> <b>Đáp án A:$tempDapAnA</b><br></td></tr>" ;
                                                        echo "<tr><td>Đáp án B:". $rowOtherQuestions['DapAnB']."<br></td></tr>";
                                                        echo "<tr><td>Đáp án C:". $rowOtherQuestions['DapAnC']."<br></td></tr>";
                                                        echo "<tr><td>Đáp án D:". $rowOtherQuestions['DapAnD']."</td></tr>";
                                                        echo "<input type='hidden' name ='txtNewQuestion' value='$maCauHoi'>";
                                                        echo "<input type='hidden' name='txtOldQuestion' value='$a'>'";
                                                        echo "<tr><td><button type='submit' class='btn btn-danger'>Thay bằng câu hỏi $maCauHoi</button> </td></tr>";
                                                        echo "</table>";
                                                        break;
                                                    case "DapAnB":
                                                        echo "<table>";
                                                        $tempDapAnB = $rowOtherQuestions['DapAnA'];
                                                        echo "<tr><td>Đáp án A:". $rowOtherQuestions['DapAnA']."<br></td></tr>";
                                                        echo "<tr><td  style='color: red'>Đáp án B: <b>$tempDapAnB</b><br></td></tr>" ;
                                                        echo "<tr><td>Đáp án C:". $rowOtherQuestions['DapAnC']."<br></td></tr>";
                                                        echo "<tr><td>Đáp án D:". $rowOtherQuestions['DapAnD']."<br></td></tr>";
                                                        echo "<input type='hidden' name ='txtNewQuestion' value='$maCauHoi'>";
                                                        echo "<input type='hidden' name='txtOldQuestion' value='$a'>'";
                                                        echo "<tr><td><button type='submit' class='btn btn-danger'>Thay bằng câu hỏi $maCauHoi</button> </td></tr>";

                                                        echo "</table>";

                                                        break;
                                                    case "DapAnC":
                                                        echo "<table>";
                                                        $tempDapAnC = $rowOtherQuestions['DapAnC'];
                                                        echo "<tr><td>Đáp án A:". $rowOtherQuestions['DapAnA']."<br></td></tr>";
                                                        echo "<tr><td>Đáp án B:". $rowOtherQuestions['DapAnB']."<br></td></tr>";
                                                        echo "<tr><td  style='color: red'>Đáp án C: <b>$tempDapAnC</b><br></td></tr>" ;
                                                        echo "<tr><td>Đáp án D:". $rowOtherQuestions['DapAnD']."<br></td></tr>";
                                                        echo "<input type='hidden' name ='txtNewQuestion' value='$maCauHoi'>";
                                                        echo "<input type='hidden' name='txtOldQuestion' value='$a'>'";
                                                        echo "<tr><td><button type='submit' class='btn btn-danger'>Thay bằng câu hỏi $maCauHoi</button> </td></tr>";

                                                        echo "</table>";
                                                        break;
                                                    case "DapAnD":
                                                        echo "<table>";
                                                        $tempDapAnD = $rowOtherQuestions['DapAnD'];
                                                        echo "<tr><td>Đáp án A:". $rowOtherQuestions['DapAnA']."<br></td></tr>";
                                                        echo "<tr><td>Đáp án B:". $rowOtherQuestions['DapAnB']."<br></td></tr>";
                                                        echo "<tr><td>Đáp án C:". $rowOtherQuestions['DapAnC']."<br></td></tr>";
                                                        echo "<tr><td  style='color: red'>Đáp án D: <b>$tempDapAnD</b><br></td></tr>" ;
                                                        echo "<input type='hidden' name ='txtNewQuestion' value='$maCauHoi'>";
                                                        echo "<input type='hidden' name='txtOldQuestion' value='$a'>'";
                                                        echo "<tr><td><button type='submit' class='btn btn-danger'>Thay bằng câu hỏi $maCauHoi</button> </td></tr>";

                                                        echo "</table>";
                                                        break;


                                                }
                                                echo "<br> <br>";



                                                echo "</form>";

                                            }
                                        }
                                        else
                                        {
                                            echo "<b style='color: red'>Không còn câu hỏi khác để thay đổi cho câu hỏi này !</b>";
                                        }
                                        ?>
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
<script>
    $(document).ready(function () {
        $('[data-toggle="popover"]').popover();
    });
</script>
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
