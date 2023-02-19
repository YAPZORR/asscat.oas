<?php 

require_once '../../backend/connection.php'; 

$staff_id          = mysqli_real_escape_string($db, trim($_POST['staff_id']));
$new_password     = mysqli_real_escape_string($db, trim($_POST['new_password']));
$re_new_password  = mysqli_real_escape_string($db, trim($_POST['re_new_password']));

$data = array();

$res_success = 0;
$res_message = '';

if ($new_password == $re_new_password) {
  $password     = md5($new_password);
  $res_success  = 1;
  $query = "
    UPDATE tbl_staff
    SET password = '$password'
    WHERE staff_id = '$staff_id' 
  ";
  mysqli_query($db, $query);
} else {
  $res_message = 'Password does not match!';
}

$data['res_success'] = $res_success;
$data['res_message'] = $res_message;

echo json_encode($data);


?>