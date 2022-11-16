<?php
include 'config.php';
$state_id = $_POST['state_id'];

?>
<select>
    <option value="">Select City</option>
<?
$sql="SELECT * from cities where state_id = '$state_id'";
$res=mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($res)) {
    
?>
    <option value="<?php echo $row['id']?>"><?php echo $row['name']?></option>
<? } ?>
</select>
?>