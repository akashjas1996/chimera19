<?php
include 'inc/dbconnection.php';
echo "<h1>Hello</h1>";
$query_mobile = "SELECT * FROM khata";
$res_query = mysqli_query($link, $query_mobile);
while($row_query = mysqli_fetch_assoc($res_query));
{
  echo $row_query['contact'];
}

?>