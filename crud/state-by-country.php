<?
include 'config.php';
$country_id= $_POST['country_id'];
$sql="SELECT * from states where country_id = '$country_id'";
$res=mysqli_query($conn,$sql);
?>
<select><option value="">Select State</option>
<? 

while($row=mysqli_fetch_array($res)) {

?>

<option value="<? echo $row['id']?>"><? echo $row['name']?></option> 
<? } ?>
</select>


