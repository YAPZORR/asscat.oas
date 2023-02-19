<?php

$requests = array();

$query = "
SELECT
tr.*,DATE_FORMAT( tr.date_accepted, '%b. %d, %Y') as date_accept, stp.position_name
FROM tbl_transac as tr
LEFT JOIN tbl_students as s ON s.student_id = tr.student_id
LEFT JOIN tbl_staff as st ON st.staff_id = tr.staff_id
LEFT JOIN tbl_staff_position as stp ON stp.staff_position_id = st.staff_position_id
LEFT JOIN tbl_course as c ON c.course_id = s.course_id
WHERE tr.student_id = '".$_SESSION['user1']['student_id']."'
";

$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $temp_arr = array();

// STATUS
$status = "";
if ($row['status'] == '0') {
 $status = '<span class="bg-warning text-white" style="padding: 3px 8px; border-radius: 5px;">PENDING</span>';
}
if ($row['status'] == '1') {
 $status = '<span class="bg-success text-white" style="padding: 3px 8px; border-radius: 5px;">APPROVED</span>';
}
if ($row['status'] == '2') {
 $status = '<span class="bg-warning text-white" style="padding: 3px 8px; border-radius: 5px;">PENDING</span>';
}

$temp_arr['location']           = $row['location'];
$temp_arr['appointed_date']     = $row['date_accept'];
$temp_arr['appointed_time']     = $row['time_appointed'];
$temp_arr['office']             = $row['position_name'];
$temp_arr['status']             =  $status;

$requests[] = $temp_arr;
  }
}
?>