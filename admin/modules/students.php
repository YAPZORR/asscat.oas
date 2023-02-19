<?php
  include('../header.php');
  include('students/students.php')
?>

<div class="page-heading">
     <h3>Students</h3>
 </div>

  <div style="flex: 1;"></div>
  <button class="btn btn-large btn-rasied btn-primary " data-bs-toggle="modal" data-bs-target="#list_add_modal"><i class="fa fa-plus"></i> Add Student</button>
<br><br>

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
                             <th class="text-center">Action</th>
                             <!-- <th class="text-center">Action</th> -->

                         </tr>

                     </thead>
                     <tbody>

                         <?php

                                if ($students) {
                                foreach ($students as $stud) {
                                    ?>
                         <tr>
                             <td class="text-center"><?php echo $stud['username'];  ?></td>
                             <td class="text-center"><?php echo $stud['fname']; ?> <?php echo $stud['lname']; ?></td>
                             <td class="text-center"><?php echo $stud['course']; ?></td>
                             <td class="text-center"><?php echo $stud['gender']; ?></td>
                             <td class="text-center"><?php echo $stud['year_level']; ?></td>
                             <td class="text-center">
                                 <div class="d-flex justify-content-center order-actions">
                                     <a href="#" class="btn btn-primary"
                                         onclick="edit_student('<?php echo $stud['student_id'];?>')"><i
                                             class="fa fa-edit"></i></a>&nbsp;&nbsp;
                                     <a href="#" class="btn btn-danger"
                                         onclick="students_delete('<?php echo $stud['username'];?>')"><i
                                             class="fa fa-trash"></i></a>
                                 </div>
                             </td>
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


 <!--------------------------------------- ADD STUDENT MODAL ------------------------------------------->
<?php

$sql = "SELECT course_id, course_name FROM tbl_course";
$result = mysqli_query($db, $sql) or die ("Bad SQL: $sql");

$opt1 = "<select class='form-control' name='type' id = 'add_course'>";
$opt1 .= "<option value='' selected hidden>Select Course</option>";
  while ($row = mysqli_fetch_assoc($result)) {
    $opt1 .= "<option value='".$row['course_id']."'>".$row['course_name']."</option>";
  }

$opt1 .= "</select>";

?>

<div class="modal fade" id="list_add_modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- username, lname, fname, gender, phone, user_type_id -->

      <div class="modal-header text-center">
        <h3 class="modal-title w-100 dark-grey-text font-weight-bold">Add New Student</h3>
        <button type="button" class="close" data-bs-dismiss="modal" aria-lable="close">&times;</button>
      </div>

      <form id="form_insert_student">
        <div class="modal-body mx-4">

          <div class="md-form">
            <label data-error="wrong" data-success="right">Username <span class="text-danger">*</span></label>
            <input type="text" class="form-control validate" id="add_username">
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">First Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control validate" id="add_fname">
          </div>


          <div class="md-form">
            <label data-error="wrong" data-success="right">Last Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control validate" id="add_lname">
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">Gender <span class="text-danger">*</span></label>
            <select class='form-control' id="add_gender">
              <option value="" selected hidden>- Select Gender</option>
              <option value="1">Male</option>
              <option value="0">Female</option>
            </select>
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">Year <span class="text-danger">*</span></label>
            <select class='form-control' id="add_year">
              <option value="" selected hidden>- Select year</option>
              <option value="1">1st Year</option>
              <option value="2">2nd Year</option>
              <option value="3">3rd Year</option>
              <option value="4">4th Year</option>
            </select>
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">Phone</label>
            <input type="number" class="form-control validate" id="add_phone">
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">Course <span class="text-danger">*</span></label>
           <?php echo $opt1;  ?>
          </div>

          <div class="text-center mt-3">
            <button type="submit" class="btn btn-primary btn-block z-depth-1a" id="btn_add">SUBMIT</button>
          </div>

        </div>
      </form>

    </div>
  </div>
</div>

<!--------------------------------------- EDIT STUDENT MODAL ------------------------------------------->
<?php

$sql = "SELECT course_id, course_name FROM tbl_course";
$result = mysqli_query($db, $sql) or die ("Bad SQL: $sql");

$opt2 = "<select class='form-control' name='type' id = 'edit_course'>";
$opt2 .= "<option value='' selected hidden>Select Course</option>";
  while ($row = mysqli_fetch_assoc($result)) {
    $opt2 .= "<option value='".$row['course_id']."'>".$row['course_name']."</option>";
  }

$opt2 .= "</select>";

?>

<div class="modal fade" id="list_edit_modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- username, lname, fname, gender, phone, user_type_id -->

      <div class="modal-header text-center">
        <h3 class="modal-title w-100 dark-grey-text font-weight-bold">Edit Student</h3>
        <button type="button" class="close" data-bs-dismiss="modal" aria-lable="close">&times;</button>
      </div>

      <form id="form_update_student">
        <div class="modal-body mx-4">

        <input type="hidden" class="form-control validate" id="edit_student_id">
          <div class="md-form">
            <label data-error="wrong" data-success="right">Username <span class="text-danger">*</span></label>
            <input type="text" class="form-control validate" id="edit_username" readonly>
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">First Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control validate" id="edit_fname">
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">Last Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control validate" id="edit_lname">
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">Gender <span class="text-danger">*</span></label>
            <select class='form-control' id="edit_gender">
              <option value="" selected hidden>- Select Gender</option>
              <option value="1">Male</option>
              <option value="0">Female</option>
            </select>
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">Year <span class="text-danger">*</span></label>
            <select class='form-control' id="edit_year">
              <option value="" selected hidden>- Select year</option>
              <option value="1">1st Year</option>
              <option value="2">2nd Year</option>
              <option value="3">3rd Year</option>
              <option value="4">4th Year</option>
            </select>
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">Phone</label>
            <input type="number" class="form-control validate" id="edit_phone">
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">Course <span class="text-danger">*</span></label>
           <?php echo $opt2;  ?>
          </div>

          <div class="text-center mt-3">
            <button type="submit" class="btn btn-primary btn-block z-depth-1a" id="btn_add">SUBMIT</button>
          </div>

        </div>
      </form>

    </div>
  </div>
</div>





<?php
  include('../footer.php');
?>

<script>

      //EDIT STUDENT MODAL
      function edit_student(student_id){
      
      $.ajax({
    url: 'students/student_edit.php',
    type: 'POST',
    data: {
      student_id: student_id
    },
    dataType: 'JSON',
    beforeSend: function () {
      $('#btn_edit').prop("disabled", true);
    }
  }).done(function (res) {

  
    $("#edit_gender").val(res.gender);

    $("#edit_student_id").val(res.student_id);
    $("#edit_username").val(res.username);
    $("#edit_lname").val(res.lname);
    $("#edit_fname").val(res.fname);
    $("#edit_phone").val(res.phone);
    $("#edit_course").val(res.course);
    $("#edit_year").val(res.year_level);
    $('#list_edit_modal').modal('show');

  })
  
  }

$(document).ready(function(){

     //-------------------------------------------- ADD Student SUMBIT ---------------------------------------//
     $('#form_insert_student').on('submit', function(e){
            e.preventDefault();

            let username      = $('#add_username').val();
            let lname         = $('#add_lname').val();
            let fname         = $('#add_fname').val();
            let gender        = $('#add_gender').val();
            let year_level    = $('#add_year').val();
            let phone         = $('#add_phone').val();
            let course        = $('#add_course').val();

            let errors = new Array();
            let input = "Please Input";

            if (username == '') {
              errors.push('Username');
            }
            if (lname == '') {
              errors.push('Last Name');
            }
            if (fname == '') {
              errors.push('First Name');
            }
            if (gender == '') {
              errors.push('Gender');
            }
            if (year_level == '') {
              errors.push('Year Level');
            }
            if (course == '') {
              errors.push('Course');
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
          }else {

            $.ajax({
              url           : 'students/student_add.php',
              type          :'POST',
              data          :{
                username     : username,
                fname        : fname,
                lname        : lname,
                gender       : gender,
                year_level   : year_level,
                phone        : phone,
                course       : course
              },
              dataType       : 'JSON',
              beforeSend     : function(){

              }
            }).done(function(res){
                if(res.res_success == 1){
                  alert('Your password is your username');
                  window.location.reload();
                }else{
                  alert(res.res_message);
                }
              
            }).fail(function(){
                console.log('fail')
            })

          }
            })

             //--------------------------------------------UPDATE Student---------------------------------------//
        $('#form_update_student').on('submit', function(e){
            e.preventDefault();

            let student_id    = $('#edit_student_id').val();
            let lname         = $('#edit_lname').val();
            let fname         = $('#edit_fname').val();
            let gender        = $('#edit_gender').val();
            let year_level    = $('#edit_year').val();
            let phone         = $('#edit_phone').val();
            let course        = $('#edit_course').val();

            let errors = new Array();
            let input = "Please Input";

           
            if (lname == '') {
              errors.push('Last Name');
            }
            if (fname == '') {
              errors.push('First Name');
            }
            if (gender == '') {
              errors.push('Gender');
            }
            if (year_level == '') {
              errors.push('Year Level');
            }
            if (course == '') {
              errors.push('Course');
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
          }else {

            $.ajax({
              url           : 'students/student_update.php',
              type          :'POST',
              data          :{
                student_id   :student_id,
                fname        : fname,
                lname        : lname,
                gender       : gender,
                year_level   : year_level,
                phone        : phone,
                course       : course
              },
              dataType       : 'JSON',
              beforeSend     : function(){

              }
            }).done(function(res){
                if(res.res_success == 1){
                  alert('Successfully Updated!');
                  window.location.reload();
                }else{
                  alert(res.res_message);
                }
              
            }).fail(function(){
                console.log('fail')
            })

          }
            })


//document ready
})


</script>