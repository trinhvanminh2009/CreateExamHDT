

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<meta http-equiv=”Content-Type” content=”text/html; charset=utf-8″ />
<?php

header('Content-Type: text/html;charset=UTF-8');

/**
 * Created by PhpStorm.
 * User: Minh
 * Date: 3/24/2017
 * Time: 6:00 PM
 */


$servername = "localhost";
$username = "root";
$password = "";
$nameData = "create_exam";

// Create connection
$conn = mysqli_connect($servername, $username, $password,$nameData);




if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
$result = mysqli_query($conn,"SELECT * FROM DangNhap");

echo "<table border='1'>
<tr>
<th>TaiKhoan</th>
<th>MatKhau</th>
</tr>";

while($row = mysqli_fetch_array($result))
{
    echo $row['TaiKhoan'];
    echo $row['MatKhau'];

}


mysqli_close($conn);
?>
</body>
</html>
