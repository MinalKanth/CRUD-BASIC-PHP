<?
include 'config.php';
$id = $_POST['id'];

$sql= "DELETE FROM reg where id='$id'";
$res=mysqli_query($conn,$sql);
if($res){
    echo "Deleted!";
}
else{
    echo "Not Deleted !";
}
?>