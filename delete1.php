<?php
if(isset($_GET["sno"])){
    $sno=$_GET["sno"];
    $inter=$_GET["inter"];

    $servername="localhost";
    $username="root";
    $password="";
    $dbName='doctors';

$conn=new mysqli($servername ,$username,$password,$dbName);

$sql="DELETE FROM availability WHERE Sno='$sno'  and inter='$inter'";
$conn->query($sql);

}

header("location: /E Care/admin1.php");
exit;

?>