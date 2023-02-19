<?php date_default_timezone_set('Asia/Manila');

require_once '../../backend/connection.php';


$username     = mysqli_real_escape_string($db, trim($_POST['username']));
$lname        = mysqli_real_escape_string($db, trim($_POST['lname']));
$fname        = mysqli_real_escape_string($db, trim($_POST['fname']));
$gender       = mysqli_real_escape_string($db, trim($_POST['gender']));
$phone        = mysqli_real_escape_string($db, trim($_POST['phone']));
$user_type_id = mysqli_real_escape_string($db, trim($_POST['user_type_id']));
$position     = mysqli_real_escape_string($db, trim($_POST['position']));
$dept         = mysqli_real_escape_string($db, trim($_POST['dept']));

$data = array();
$res_success = 0;
$res_message = "";

$query = "
SELECT * FROM tbl_staff as st
LEFT JOIN tbl_staff_position as stp ON st.staff_position_id = stp.staff_position_id
 WHERE username = '$username'
";

$result = mysqli_query($db, $query);

if (!mysqli_num_rows($result)) {

    $query = "
    INSERT INTO tbl_staff(username,
        password,
        fname,
        lname,
        gender,
        phone,
        user_type_id,
        staff_position_id,
        department_id) VALUES('$username',
        '".md5($username)."',
        '$fname',
        '$lname',
        '$gender',
        '$phone',
        '$user_type_id',
        '$position',
        '$dept'
    )
    ";
   

    if (mysqli_query($db, $query)) {
        $res_success = 1;
    } else {
        $res_message = "Query Failed";
    }

} else {
    $res_message = "Username already Exists";
}

$data['res_success'] = $res_success;
$data['res_message'] = $res_message;


echo json_encode($data);





?>