 <?php
  include('../header.php');
  include('dashboard/dashboard.php');
 ?>

 <div class="page-heading">
     <h3>Appointments</h3>
 </div>

 <div class="page-content">
     <div class="card shadow mb-4">
         <div class="card-body">
             <div class="table-responsive">
                 <table class="table " id="dataTable" width="100%" cellspacing="0">

                     <thead>

                         <tr>
                             <th class="text-center">Id Number</th>
                             <th class="text-center">Name</th>
                             <th class="text-center">Course</th>
                             <th class="text-center">Gender</th>
                             <th class="text-center">Year Level</th>
                             <th class="text-center">Status</th>
                             <th class="text-center">Appointed Date</th>
                             <th class="text-center">Time</th>
                             <!-- <th class="text-center">Action</th> -->

                         </tr>

                     </thead>
                     <tbody>

                         <?php

                                if ($requests) {
                                foreach ($requests as $req) {
                                    ?>
                         <tr>
                             <td class="text-center"><?php echo $req['username'];?></td>
                             <td class="text-center"><?php echo $req['fname']; echo "&nbsp"; echo $req['lname'];?></td>
                             <td class="text-center"><?php echo $req['course'];?></td>
                             <td class="text-center"><?php echo $req['gender'];?></td>
                             <td class="text-center"><?php echo $req['year_level'];?></td>
                             <td class="text-center"><?php echo $req['status'];?></td>
                             <td class="text-center"><?php echo $req['date_accepted'];?></td>
                             <td class="text-center"><?php echo $req['time_appointed'];?></td>
                             <!-- <td class="text-center">
                                 <div class="d-flex justify-content-center order-actions">
                                     <a href="#" class="btn btn-primary"
                                         onclick="student_edit('<?php echo $req['student_id'];?>')"><i
                                             class="fa fa-edit"></i> Edit
                                     </a>&nbsp;&nbsp;
                                     <a href="#" class="btn btn-warning"
                                         onclick="view_grade('<?php echo $req['username'];?>')"><i
                                             class="fa fa-eye"></i> View Grade</a> </a>&nbsp;&nbsp;
                                     <a href="#" class="btn btn-danger"
                                         onclick="students_delete('<?php echo $req['username'];?>')"><i
                                             class="fa fa-trash"></i> Delete</a>
                                 </div>
                             </td> -->
                             <?php
                                     }
                               }else{
                                ?>
                         <tr class="text-center">
                             <td class="text-start text-danger" colspan="11">No Record Found</td>
                         </tr>

                         <?php
                               }
                         ?>
                     </tbody>
                 </table>
             </div>
         </div>
     </div>
 </div>


 <?php
  include('../footer.php');
 ?>

 <!------------------------------------- DELETE USER -------------------------------------------------->
 <div class="modal fade" id="delete_modal">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header text-center">
                 <h5 class="modal-title" id="exampleModalLabel">Ready to Delete?</h5>
                 <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">×</span>
                 </button>
             </div>
             <form id="delete_form">
                 <div class="modal-body">
                     <span>are you sure do you want to delete?</span>
                     <input type="hidden" name="" id="stud_id">
                 </div>
                 <div class="modal-footer">
                     <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                     <button type="submit" class="btn btn-danger">Delete</button>
                 </div>
             </form>
         </div>

     </div>
 </div>

 <!------------------------------------- ADD USER -------------------------------------------------->
 <?php


$sql = "SELECT DISTINCT course_id,course_name FROM tbl_course";
$result = mysqli_query($db, $sql) or die ("Bad SQL: $sql");

$course = "<select class='form-control' name='type' id = 'add_course'>";
$course .= "<option value='' selected hidden>Select Course</option>";
  while ($row = mysqli_fetch_assoc($result)) {
    $course .= "<option value='".$row['course_id']."'>".$row['course_name']."</option>";
  }

$course .= "</select>";

?>

 <div class="modal fade" id="add_student_modal">
     <div class="modal-dialog">
         <div class="modal-content">

             <!-- username, lname, fname, gender, phone, user_type_id -->

             <div class="modal-header text-center">
                 <h3 class="modal-title w-100 dark-grey-text font-weight-bold">Add Students</h3>
                 <button type="button" class="close" data-bs-dismiss="modal" aria-lable="close">&times;</button>
             </div>


             <form id="form_add">
                 <div class="modal-body mx-4">

                     <input type="hidden" id="edit_user_id" readonly>

                     <div class="md-form">
                         <label data-error="wrong" data-success="right">ID Number <span
                                 class="text-danger">*</span></label>
                         <input type="text" class="form-control validate" id="add_username">
                     </div>

                     <div class="md-form">
                         <label data-error="wrong" data-success="right">First Name <span
                                 class="text-danger">*</span></label>
                         <input type="text" class="form-control validate" id="add_fname">
                     </div>

                     <div class="md-form">
                         <label data-error="wrong" data-success="right">Last Name <span
                                 class="text-danger">*</span></label>
                         <input type="text" class="form-control validate" id="add_lname">
                     </div>

                     <div class="md-form">
                         <label data-error="wrong" data-success="right">Gender <span
                                 class="text-danger">*</span></label>
                         <select class='form-control' id="add_gender">
                             <option value="" selected hidden>- Select Gender</option>
                             <option value="1">Male</option>
                             <option value="0">Female</option>
                         </select>
                     </div>
                     <div class="md-form">
                         <label data-error="wrong" data-success="right">Course <span
                                 class="text-danger">*</span></label>
                         <?php 
                        echo $course; 
                        ?>
                     </div>

                     <div class="text-center mt-3">
                         <button type="submit" class="btn btn-primary btn-block z-depth-1a" id="btn_add">SUBMIT</button>
                     </div>

                 </div>
             </form>

         </div>
     </div>
 </div>

 <!----------------------------- EDIT STUDENT ------------------------------->


 <?php


$sql = "SELECT DISTINCT course_id,course_name FROM tbl_course";
$result = mysqli_query($db, $sql) or die ("Bad SQL: $sql");

$course1 = "<select class='form-control' name='type' id = 'edit_course'>";
$course1 .= "<option value='' selected hidden>Select Course</option>";
  while ($row = mysqli_fetch_assoc($result)) {
    $course1 .= "<option value='".$row['course_id']."'>".$row['course_name']."</option>";
  }

$course1 .= "</select>";

?>
 <div class="modal fade" id="edit_student_modal">
     <div class="modal-dialog">
         <div class="modal-content">

             <!-- username, lname, fname, gender, phone, user_type_id -->

             <div class="modal-header text-center">
                 <h3 class="modal-title w-100 dark-grey-text font-weight-bold">Edit Student</h3>
                 <button type="button" class="close" data-bs-dismiss="modal" aria-lable="close">&times;</button>
             </div>

             <form id="form_update_student">
                 <div class="modal-body mx-4">
                 <div class="alert alert-warning d-flex align-items-center" role="alert">
                         <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:">
                             <use xlink:href="#exclamation-triangle-fill" /></svg>
                         <div>
                             Warning! The default student username and password is the ID Number.
                         </div>
                     </div>

                     <input type="hidden" id="edit_student_id" readonly>

                     <div class="md-form">
                         <label data-error="wrong" data-success="right">ID Number <span
                                 class="text-danger">*</span></label>
                         <input type="text" class="form-control validate" id="edit_username" readonly>
                     </div>

                     <div class="md-form">
                         <label data-error="wrong" data-success="right">First Name <span
                                 class="text-danger">*</span></label>
                         <input type="text" class="form-control validate" id="edit_fname">
                     </div>

                     <div class="md-form">
                         <label data-error="wrong" data-success="right">Last Name <span
                                 class="text-danger">*</span></label>
                         <input type="text" class="form-control validate" id="edit_lname">
                     </div>

                     <div class="md-form">
                         <label data-error="wrong" data-success="right">Gender <span
                                 class="text-danger">*</span></label>
                         <select class='form-control' id="edit_gender">
                             <option value="" selected hidden>- Select Gender</option>
                             <option value="1">Male</option>
                             <option value="0">Female</option>
                         </select>
                     </div>
                     <div class="md-form">
                         <label data-error="wrong" data-success="right">Course <span
                                 class="text-danger">*</span></label>
                         <?php 
                        echo $course1; 
                        ?>
                     </div>

                     <div class="text-center mt-3">
                         <button type="submit" class="btn btn-primary btn-block z-depth-1a"
                             id="btn_edit">SUBMIT</button>
                     </div>

                 </div>
             </form>

         </div>
     </div>
 </div>

 <script>
     function students_delete(username) {

         $('#stud_id').val(username)
         $('#delete_modal').modal('show')

     }
     //VIEW GRADE
     function view_grade(username, student_id) {

         let data = '';
         data += 'IDNumber=' + username;

         window.location.href = "editgrade.php?" + data;
     }


     //EDIT USER
     function student_edit(student_id) {

         $.ajax({
             url: 'dashboard/edit_student.php',
             type: 'POST',
             data: {
                 student_id: student_id

             },
             dataType: 'JSON',
             beforeSend: function () {

             }
         }).done(function (res) {


             let html = '';
             html += (res.gender == '1') ? '<option value="1" selected >Male</option>' :
                 '<option value="1">Male</option>';
             html += (res.gender == '0') ? '<option value="0" selected >Female</option>' :
                 '<option value="0">Female</option>';
             html += (res.course == '1') ? '<option value="1" selected >Male</option>' :
                 '<option value="1">BSIT</option>';
             $('#edit_gender').val(res.gender);
             $('#edit_course').val(res.course);

             $('#edit_username').val(res.username);
             $('#edit_student_id').val(res.student_id);
             $('#edit_fname').val(res.fname);
             $('#edit_lname').val(res.lname);
             $('#edit_student_modal').modal('show');

         }).fail(function () {
             console.log("FAIL");
         })

     }
 </script>

 <script>
     $(document).ready(function () {

         //DELETING STUDENTS INFORMATION
         $('#delete_form').submit(function (e) {
             e.preventDefault()

             let username = $('#stud_id').val()

             $.ajax({
                 url: 'dashboard/student_delete.php',
                 type: 'POST',
                 data: {
                     username: username

                 },
                 dataType: 'JSON',
                 beforeSend: function () {

                 }
             }).done(function (res) {
                 if (res.res_success == 1) {
                     alert('Successfully Deleted');
                     $('#delete_modal').modal('hide')
                     window.location.reload();
                 } else {
                     alert()
                     alert(res.res_message);
                 }
             }).fail(function () {
                 console.log("FAIL");
             })

         })

         // ADD STUDENTS
         $('#form_add').submit(function (e) {
             e.preventDefault();

             let username = $('#add_username').val()
             let fname = $('#add_fname').val()
             let lname = $('#add_lname').val()
             let gender = $('#add_gender').val()
             let course = $('#add_course').val()

             let errors = [];
             let input = "Please Input";

             if (username == '') {
                 errors.push('Id Number')
             }
             if (fname == '') {
                 errors.push('First Name')
             }
             if (lname == '') {
                 errors.push('last Name')
             }
             if (gender == '') {
                 errors.push('Gender')
             }
             if (course == '') {
                 errors.push('Course')
             }
             if (errors.length > 0) {
                 let error = '';
                 $.each(errors, function (key, value) {
                     if (error == '') {
                         error += '• ' + value;
                     } else {
                         error += '\n• ' + value;
                     }
                 });
                 alert(input + '\n' + error);
             } else {

                 $.ajax({
                     url: 'dashboard/add_student.php',
                     type: 'POST',
                     data: {
                         username: username,
                         fname: fname,
                         lname: lname,
                         gender: gender,
                         course: course
                     },

                     dataType: 'JSON',
                     beforeSend: function () {

                     }

                 }).done(function (res) {
                     if (res.res_success == 1) {
                         alert('Username & Password is ID NUMBER');
                         window.location.reload();
                     } else {
                         alert(res.res_message);
                     }
                 }).fail(function () {
                     console.log("FAIL!")
                 })



             }

         })



         //UDPATE STUDENT
         $('#form_update_student').on('submit', function (e) {
             e.preventDefault();


             let student_id = $('#edit_student_id').val()
             let username = $('#edit_username').val()
             let fname = $('#edit_fname').val()
             let lname = $('#edit_lname').val()
             let gender = $('#edit_gender').val()
             let course = $('#edit_course').val()


             if (fname == "") {
                 alert('Please input First Name')
             } else if (lname == "") {
                 alert('Please input Last Name')
             } else {

                 $.ajax({
                     url: 'dashboard/update_student.php',
                     type: 'POST',
                     data: {
                         student_id: student_id,
                         username: username,
                         fname: fname,
                         lname: lname,
                         gender: gender,
                         course: course

                     },
                     dataType: 'JSON',
                     beforeSend: function () {

                     }
                 }).done(function (res) {
                     if (res.res_success == 1) {
                         alert('Successfully Updated!');
                         window.location.reload();
                     } else {

                         alert(res.res_message);
                     }
                 }).fail(function () {
                     console.log("FAIL");
                 })
             }

         })



     })
 </script>