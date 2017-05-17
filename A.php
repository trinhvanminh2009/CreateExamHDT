<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
<?php

$user='root';
$pass='';
$db='create_exam';

$con=mysqli_connect("localhost","root","","create_exam");
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$result = mysqli_query($con,"SELECT * FROM giangvien");

echo "<table border='1'>
<tr>
<th>Ma giang vien</th>
<th>Hoten</th>
</tr>";

while($row = mysqli_fetch_array($result))
{
    echo "<tr>";
    echo "<td>" . $row['MaGiangVien'] . "</td>";
    echo "<td>" . $row['HoTen'] . "</td>";
    echo "</tr>";
}
echo "</table>";

mysqli_close($con);

?>