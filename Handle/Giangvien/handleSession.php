<?php
/**
 * Created by PhpStorm.
 * User: Minh
 * Date: 5/18/2017
 * Time: 9:24 AM
 */
session_start();
session_destroy();
header("Location:../Login/index.php");