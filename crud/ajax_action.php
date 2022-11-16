<?
include 'config.php';
$id= $_POST['id'];

$name= $_POST['name'];
$dob= $_POST['dob'];
$des= $_POST['des'];
$qua= $_POST['qua'];
$email= $_POST['email'];
$mo= $_POST['mo'];
$gender= $_POST['gender'];
$loc= $_POST['loc'];
$country= $_POST['country'];
$state= $_POST['state'];
$city= $_POST['city'];

if($id=="0"){
    $sql="INSERT INTO reg (name,dob,des,qua,email,mo,gender,loc,country,state,city) VALUES ('$name','$dob','$des','$qua','$email','$mo','$gender','$loc','$country','$state','$city')";
    $res=mysqli_query($conn,$sql);
    if($res){
        echo "Inserted Successfully";
        echo "<tr class='{$id}'>
            <td>{$name}</td>
           <td>{$dob}</td>
            <td>{$des}</td>
            <td>{$qua}</td>
            <td>{$email}</td>
            <td>{$mo}</td>
            <td>{$gender}</td>
            <td>{$loc}</td>
            <td>{$country}</td>
            <td>{$state}</td>
            <td>{$city}</td>
            <td><a href='#' class='btn btn-primary edit' id='{'id'}'>Edit</a></td>
            <td><a href='#' class='btn btn-danger delete' id='{'id'}'>Delete</a></td>
            </tr>
            ";		
    }else{
        echo "Not Inserted !";
    }
    
    
}else{
    $sql1 = "UPDATE reg SET name= '{$name}', dob='{$dob}', des='{$des}', qua='{$qua}', gender='{$gender}', email='{$email}', loc='{$loc}', mo='{$mo}', country='{$country}', state='{$state}', city='{$city}' where id = '{$id}'";
    
	$res1=mysqli_query($conn,$sql1);
    if($res1){
        echo" Updated Successfully";
        echo"<tr class='{$id}'>
        <td>{$name}</td>
        <td>{$dob}</td>
        <td>{$des}</td>
        <td>{$qua}</td>
        <td>{$email}</td>
        <td>{$mo}</td>
        <td>{$gender}</td>
        <td>{$loc}</td>
        <td>{$country}</td>
        <td>{$state}</td>
        <td>{$city}</td>
        <td><a href='#' class='btn btn-primary edit' id='{'id'}'>Edit</a></td>
        <td><a href='#' class='btn btn-danger del' id='{'id'}'>Delete</a></td>					
    </tr>";
    }
    else{
        echo"Failed to upload data!";
    }
}
?>