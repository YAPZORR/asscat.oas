<?php
include('connection.php');


$data        = array();
$res_success = 0;
$res_message = 0;
$errors = array();

$username         = mysqli_real_escape_string($db, trim($_POST['username'])); 
$password         = mysqli_real_escape_string($db, trim($_POST['password'])); 


if (empty($username)) {
    array_push($errors, "Username is Required"); // add error to errors array
}
if (empty($password)) {
    array_push($errors, "Password is Required"); // add error to errors array
}
if (count($errors) == 0) {

        $query = "
        SELECT 
        stud.*,
        c.course_name AS c_course_name
        FROM tbl_students AS stud
        LEFT JOIN tbl_course as c ON c.course_id = stud.course_id
        WHERE
        stud.username = '$username'
        AND stud.password = '".md5($password)."'
          ";


          $result = mysqli_query($db, $query) or die ('Error in Inserting users in '. $query);
          if (mysqli_num_rows($result) == 1) {
            //log user in
                   $res_success          = 1; 
                  $row = mysqli_fetch_array($result);
                  $_SESSION['user1']     = $row;
  
                
          }else{
              array_push($errors, "Invalid Credentials");
      
            }

}

$data['post'] = $_POST;
$data['res_success'] = $res_success;
$data['res_message'] = $errors;


print_r(json_encode($data));

?>
