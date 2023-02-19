<?php

$users = array();

$query = "
  SELECT
    st.*,
    ut.name as type_name, st.staff_id, p.position_name
  FROM tbl_staff AS st
  LEFT JOIN tbl_user_types AS ut ON st.user_type_id = ut.user_type_id
  LEFT JOIN tbl_staff_position as p ON p.staff_position_id = st.staff_position_id
  ORDER BY st.lname, st.fname ASC
";
// $query = "
//   SELECT
//     u.*,
//     ut.name as ut_name
//   FROM users AS u
//   LEFT JOIN user_types AS ut ON u.user_type_id = ut.user_type_id
//   WHERE u.user_type_id != '1'
//   ORDER BY u.lname, u.fname ASC
// ";

$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $temp_arr = array();


    $gender_status = "";
    if($row['gender'] == 0){
      $gender_status = '<span class="text-black" style="padding: 3px 8px; border-radius: 5px;">Female</span>';

    }
    if($row['gender'] == 1){
      $gender_status = '<span class="text-black" style="padding: 3px 8px; border-radius: 5px;">Male</span>';

    }




    $temp_arr['staff_id']  = $row['staff_id'];
    $temp_arr['username']  = $row['username'];
    $temp_arr['lname']     = $row['lname'];
    $temp_arr['fname']     = $row['fname'];
    $temp_arr['gender']    = $gender_status;
    $temp_arr['phone']     = $row['phone'];
    $temp_arr['type']      = $row['type_name'];
    $temp_arr['position']  = $row['position_name'];

    $users[] = $temp_arr;
  }
}


?>




