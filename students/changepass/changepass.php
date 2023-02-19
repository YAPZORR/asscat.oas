<?php

require_once '../backend/connection.php';

$data = array();

$password = mysqli_real_escape_string($db, trim($_POST['password']));

$query  = "
  UPDATE tbl_students
  SET password = '".md5($password)."' 
  WHERE student_id= '".$_SESSION['user1']['student_id']."'
";
mysqli_query($db, $query);

echo json_encode($data);

?>
