<?php

if(isset($_GET['macauhoi'])){
        $mach=$_GET['macauhoi'];

        $con=mysqli_connect("localhost","root","","create_exam");
        mysqli_set_charset($con,"utf8");
        $resultTable = mysqli_query($con,"SELECT * FROM cauhoi WHERE MaCH='$mach'");

        if (!$resultTable) {
            printf("Error: %s\n", mysqli_error($con));
            exit();
        }
        while($row = mysqli_fetch_array($resultTable))
        {
            $noidung=$row['NoiDung'];
            $dapanA=$row['DapAnA'];
            $dapanB=$row['DapAnB'] ;
            $dapanC=$row['DapAnC'] ;
            $dapanD=$row['DapAnD'] ;
            $dapanDung=$row['DapAnDung'];
            $doKho = $row['DoKho'];

        }
        mysqli_close($con);
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

    <title>Chi tiết câu hỏi</title>

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

<?php
echo"
          <div class=\"col-lg-4\">
                <div class=\"panel panel-default\">
                   <div class=\"panel-heading\">";

echo $noidung;
echo"       </div>
                        <div class=\"panel-body\">";
writeReply($dapanA,1,$dapanDung);
writeReply($dapanB,2,$dapanDung);
writeReply($dapanC,3,$dapanDung);
writeReply($dapanD,4,$dapanDung);
echo"
           </div>
                 <div class=\"panel-footer\">
                    <a class=\"btn btn-block btn-social btn-twitter\" onclick='window.close()'>
                        Trở về
                    </a>
            </div>
           </div>
         </div>";

?>
</body>
<?php
function writeReply($reply,$role,$result){


    if($role==1){
        if($result=="DapAnA")
        {
            echo" <a class=\"btn btn-block btn-social btn-pinterest\">";
            echo "<i >A:</i> ".$reply;
        }
        else{
            echo" <a class=\"btn btn-block btn-social btn-facebook\">";
            echo "<i >A:</i> ".$reply;
        }
    }
    if($role==2){
        if($result=="DapAnB")
        {
            echo" <a class=\"btn btn-block btn-social btn-pinterest\">";
            echo "<i >B:</i> ".$reply;
        }
        else{
            echo" <a class=\"btn btn-block btn-social btn-facebook\">";
            echo "<i >B:</i> ".$reply;
        }
    }
    if($role==3){
        if($result=="DapAnC")
        {
            echo" <a class=\"btn btn-block btn-social btn-pinterest\">";
            echo "<i >C:</i> ".$reply;
        }
        else{
            echo" <a class=\"btn btn-block btn-social btn-facebook\">";
            echo "<i >C:</i> ".$reply;
        }
    }
    if($role==4){
        if($result=="DapAnD")
        {
            echo" <a class=\"btn btn-block btn-social btn-pinterest\">";
            echo "<i >D:</i> ".$reply;
        }
        else{
            echo" <a class=\"btn btn-block btn-social btn-facebook\">";
            echo "<i >D:</i> ".$reply;
        }
    }

    echo"</a>";
}

?>
<script src="../js/popup.js"></script>
