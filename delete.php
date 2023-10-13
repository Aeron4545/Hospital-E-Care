<?php
if(isset($_GET["sno"])){
    $sno=$_GET["sno"];

    $servername="localhost";
    $username="root";
    $password="";
    $dbName='doctors';

$conn=new mysqli($servername ,$username,$password,$dbName);

$sql="DELETE FROM doc WHERE sno='$sno'";
$conn->query($sql);

}

header("location: /E Care/admin.php");
exit;

?>