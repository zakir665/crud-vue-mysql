<?php
$conn = new mysqli("localhost", "root", "root", "curd");
 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$out = array('error' => false);
 
$action = '';
 
if(isset($_GET['action'])){
	$action = $_GET['action'];
}
 
 
if($action == 'read'){
	$sql = "select * from users";
	$query = $conn->query($sql);
	$users = array();
 
	while($row = $query->fetch_assoc()){
		array_push($users, $row);
	}
 
	$out['users'] = $users;
}
if($action == 'update'){
	$id = $_POST['id'];
	$name = $_POST['name'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$sql = "UPDATE users set name = '$name',email='$email',phone='$phone' where id='$id'";
	$query = $conn->query($sql);
	if($query)
	{
		$out['message'] = "User Updated successfully!";
	}
	else
	{
		$out['error'] = true;
		$out['message'] = "Failed to Update user!";
	}
 
}
if($action == 'create'){
	$name = $_POST['name'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$sql = "INSERT INTO users (name,email,phone) VALUES('$name','$email','$phone')";
	$query = $conn->query($sql);
	if($query)
	{
		$out['message'] = "user added successfully!";
	}
	else
	{
		$out['error'] = true;
		$out['message'] = "failed to add user!";
	}
 
}
if($action == 'delete'){
	$id = $_POST['id'];
	$sql = "DELETE from users where id = '$id'";
	$query = $conn->query($sql);
	if($query)
	{
		$out['message'] = "user deleted successfully!";
	}
	else
	{
		$out['error'] = true;
		$out['message'] = "failed to delete user!";
	}
 
}
echo json_encode($out); 

?>