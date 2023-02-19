<?php 

require_once '../../backend/connection.php';

$staff_id = mysqli_real_escape_string($db, trim($_POST['staff_id']));

$data = array();

$username     = '';
$lname        = '';
$fname        = '';
$gender       = '';
$phone        = '';
$user_type_id = '';
$position     = '';

$user_types = array();

$query = "
  SELECT *
  FROM tbl_staff
  WHERE staff_id = '$staff_id'
";
$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {

  $row = mysqli_fetch_assoc($result);

  $username      = $row['username'];
  $lname         = $row['lname'];
  $fname         = $row['fname'];
  $gender        = $row['gender'];
  $phone         = $row['phone'];
  $user_type_id  = $row['user_type_id'];
  $position      = $row['staff_position_id'];

}

$data['staff_id']      = $staff_id;
$data['username']     = $username;
$data['lname']        = $lname;
$data['fname']        = $fname;
$data['gender']       = $gender;
$data['phone']        = $phone;
$data['position']     = $position;
$data['user_type_id'] = $user_type_id;



echo json_encode($data);


?>
