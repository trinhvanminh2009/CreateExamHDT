<!-- Navigation -->
<?php
    session_start();
    if(isset($tbmID)){

    }
    else{
        if(isset($_SESSION['emailTBM']))
        {
            $tbmID=$_SESSION['emailTBM'];
        }
        else{
            header("Location:../Login/index.php");
        }
    }




?>
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">Trang tạo đề thi</a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">
        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="#"><i class="fa fa-user fa-fw"></i><?php echo $tbmID?></a>
                </li>

                <li class="divider"></li>
                <li><a href="handleSession.php" "><i class="fa fa-sign-out fa-fw"></i> Logout </a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->

    <?php require "Layout.php";?>
    <!-- /.navbar-static-side -->
</nav>
