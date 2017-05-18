
<?php
session_start();
?>
<!DOCTYPE html>
<head>
  <meta charset="UTF-8">
  <title>Sign-Up/Login Form</title>
    <link rel="stylesheet" href="css/style.css">
  <script src="jquery/changeForm.js"></script>
</head>
<body>
  <div class="form">
      
      <ul class="tab-group">
        <li class="tab "><a href="#loginTBM">Trưởng Bộ Môn</a></li>
        <li class="tab active"><a href="#loginGV">Giảng Viên</a></li>
      </ul>
      
      <div class="tab-content">
        <div id="loginGV">
          <h1 style="color: green">Đăng nhập giảng viên !</h1>

          <form action="login.php" method="post">

            <div class="field-wrap">
              <label>
                Tài Khoản<span class="req">*</span>
              </label>
              <input type="text"required autocomplete="off" name = "txtEmail"/>
            </div>

            <div class="field-wrap">
              <label>
                Mật Khẩu<span class="req">*</span>
              </label>
              <input type="password"required autocomplete="off" name = "txtPassword"/>
            </div>
              <?php
                if(isset($_SESSION['error']))
                {
                   echo '<h3 style="text-align: center ; font-weight: 300; color: red">'. $_SESSION['error']. '</h3>';
                   session_destroy();
                }
                else
                 {

                }
              ?>
            <p class="forgot"><a href="#">Quên mật khẩu?</a></p>

            <button class="button1 button-block1" />Đăng Nhập</button>
            

          </form>

        </div>
        <div id="loginTBM">


            <h1 style="color: green">Đăng nhập Trưởng Bộ Môn !</h1>

            <form action="loginTBM.php" method="post">

                <div class="field-wrap">
                    <label>
                        Tài Khoản<span class="req">*</span>
                    </label>
                    <input type="text" required autocomplete="off" name = "txtEmailTBM"/>
                </div>

                <div class="field-wrap">
                    <label>
                        Mật Khẩu<span class="req">*</span>
                    </label>
                    <input type="password"required autocomplete="off" name = "txtPasswordTBM"/>
                </div>
                <?php
                if(isset($_SESSION['errorTBM']))
                {
                    echo '<h3 style="text-align: center ; font-weight: 300; color: red">'. $_SESSION['errorTBM']. '</h3>';
                    session_destroy();
                }
                else
                {

                }
                ?>
                <p class="forgot"><a href="#">Quên mật khẩu?</a></p>

                <button  class="button1 button-block1" id = "btnLogin""/>Đăng Nhập</button>
            </form>
        </div>
        

        
      </div>
      
</div>

    <script src="js/index.js"></script>

</body>
</html>
