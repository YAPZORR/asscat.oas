<?php
date_default_timezone_set('Asia/Manila');

require_once '../../backend/connection.php';

$staff_id     = mysqli_real_escape_string($db, trim($_POST['staff_id']));
$lname        = mysqli_real_escape_string($db, trim($_POST['lname']));
$fname        = mysqli_real_escape_string($db, trim($_POST['fname']));
$gender       = mysqli_real_escape_string($db, trim($_POST['gender']));
$phone        = mysqli_real_escape_string($db, trim($_POST['phone']));
$user_type_id = mysqli_real_escape_string($db, trim($_POST['user_type_id']));
$position     = mysqli_real_escape_string($db, trim($_POST['position']));

$data = array();

$res_success = 0;
$res_message = '';

$query = "
SELECT *
FROM tbl_staff st
LEFT JOIN tbl_user_types as ut ON st.user_type_id = ut.user_type_id
ORDER by st.staff_id ASC
";

 $result = mysqli_query($db,$query);
 if(mysqli_num_rows($result)> 0){

    $query = "
    UPDATE tbl_staff
    SET
    lname = '$lname',
    fname =  '$fname',
    gender = '$gender ',
    phone = '$phone',
    user_type_id = '$user_type_id',
    staff_position_id = '$position'
    WHERE staff_id = '$staff_id'
    ";

    if(mysqli_query($db, $query)){
        $res_success = 1;

    }else{
        $res_message = "Query Failed";
    }

 }else{

    $res_message = 'Username does not exists!';
 }

    $data['res_success'] = $res_success;
    $data['res_message'] = $res_message;

    echo json_encode($data);
    

?>