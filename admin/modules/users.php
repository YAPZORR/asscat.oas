<?php
include('../header.php');
include('users/user.php');
?>


<div class="page-heading">
    <h3>User</h3>
</div>

<div>
    <button data-bs-toggle="modal" data-bs-target="#list_add_modal" class="btn btn-primary" id="add_students"><i
            class="fa fa-plus"></i> Add User</button>
</div><br>

<div class="page-content">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table " id="dataTable" width="100%" cellspacing="0">

                    <thead>

                        <tr>

                            <th class="text-center">Username</th>
                            <th class="text-center">Firstname</th>
                            <th class="text-center">Lastname</th>
                            <th class="text-center">Gender</th>
                            <th class="text-center">Phone</th>
                            <th class="text-center">Type</th>
                            <th class="text-center">Position</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                    if ($users) {
                    foreach ($users as $user) {
                    ?>
                        <tr class="text-center">
                            <td class="text-center"><?php echo $user['username']; ?></td>
                            <td class="text-center"><?php echo $user['fname']; ?></td>
                            <td class="text-center"><?php echo $user['lname']; ?></td>
                            <td class="text-center"><?php echo $user['gender']; ?></td>
                            <td class="text-center"><?php echo $user['phone']; ?></td>
                            <td class="text-center"><?php echo $user['type']; ?></td>
                            <td class="text-center"><?php echo $user['position']; ?></td>
                            <td class="text-center">
                                 <div class="d-flex justify-content-center order-actions">
                                     <a href="#" class="btn btn-primary"
                                         onclick="edit_user('<?php echo $user['staff_id'];?>')"><i
                                             class="fa fa-edit"></i>
                                     </a>&nbsp;&nbsp;
                                     <a href="#" class="btn btn-warning"
                                         onclick="list_changepassword('<?php echo $user['staff_id'];?>', '<?php echo $user['username'];?>')"><i
                                             class="fa fa-key"></i></a>
                                 </div>
                             </td>
                        </tr>

                        <?php
                        }
                         } else {
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
<!--------------------------------------- ADD USER  MODAL ------------------------------------------->
<?php


$sql = "SELECT DISTINCT user_type_id, name FROM tbl_user_types";
$result = mysqli_query($db, $sql) or die ("Bad SQL: $sql");

$opt1 = "<select class='form-control' name='type' id = 'add_user_type_id'>";
$opt1 .= "<option value='' selected hidden>Select User Type</option>";
  while ($row = mysqli_fetch_assoc($result)) {
    $opt1 .= "<option value='".$row['user_type_id']."'>".$row['name']."</option>";
  }

$opt1 .= "</select>";


$query = "SELECT staff_position_id, position_name FROM tbl_staff_position";
$result = mysqli_query($db, $query) or die ("Bad SQL: $query");

$pos1 = "<select class='form-control' id = 'add_position'>";
$pos1 .= "<option value='' selected hidden> Select Position</option>";
  while ($row = mysqli_fetch_assoc($result)) {
    $pos1 .= "<option value='".$row['staff_position_id']."'>".$row['position_name']."</option>";
  }
$pos1 .= "</select>";


?>

<div class="modal fade" id="list_add_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h3 class="modal-title w-100 dark-grey-text font-weight-bold">Add New User</h3>
        <button type="button" class="close" data-bs-dismiss="modal" aria-lable="close">&times;</button>
      </div>
      <form id="form_insert">
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
            <label data-error="wrong" data-success="right">Phone</label>
            <input type="number" class="form-control validate" id="add_phone">
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">User Type <span class="text-danger">*</span></label>
           <?php echo $opt1;  ?>
          </div>
          <div class="md-form">
            <label data-error="wrong" data-success="right">Position<span class="text-danger">*</span></label>
           <?php echo $pos1;  ?>
          </div>

          <div class="md-form" id ="dept1">

          </div>
          <div class="text-center mt-3">
            <button type="submit" class="btn btn-primary btn-block z-depth-1a" id="btn_add">SUBMIT</button>
          </div>

        </div>
      </form>

    </div>
  </div>
</div>


<!--------------------------------------- EDIT USER  MODAL ------------------------------------------->
<?php

$sql = "SELECT DISTINCT user_type_id, name FROM tbl_user_types";
$result = mysqli_query($db, $sql) or die ("Bad SQL: $sql");

$opt = "<select class='form-control' name='type' id = 'edit_user_type_id'>";
$opt .= "<option value='' selected hidden>Select User Type</option>";
  while ($row = mysqli_fetch_assoc($result)) {
    $opt .= "<option value='".$row['user_type_id']."'>".$row['name']."</option>";
  }

$opt .= "</select>";


$sql = "SELECT DISTINCT staff_position_id, position_name FROM tbl_staff_position";
$result = mysqli_query($db, $sql) or die ("Bad SQL: $sql");

$pos2 = "<select class='form-control' name='type' id = 'edit_position'>";
$pos2 .= "<option value='' selected hidden>Select User Type</option>";
  while ($row = mysqli_fetch_assoc($result)) {
    $pos2 .= "<option value='".$row['staff_position_id']."'>".$row['position_name']."</option>";
  }

$pos2 .= "</select>";

?>

<div class="modal fade" id="list_edit_modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- username, lname, fname, gender, phone, user_type_id -->

      <div class="modal-header text-center">
        <h3 class="modal-title w-100 dark-grey-text font-weight-bold">Edit User</h3>
        <button type="button" class="close" data-bs-dismiss="modal" aria-lable="close">&times;</button>
      </div>

      <form id="form_update">
        <div class="modal-body mx-4">

          <input type="hidden" id="edit_user_id" readonly>

          <div class="md-form">
            <label data-error="wrong" data-success="right">Username <span class="text-danger">*</span></label>
            <input type="text" class="form-control validate" id="edit_username" readonly>
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">Last Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control validate" id="edit_lname">
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">First Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control validate" id="edit_fname">
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
            <label data-error="wrong" data-success="right">Phone</label>
            <input type="number" class="form-control validate" id="edit_phone">
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">User Type <span class="text-danger">*</span></label>
            <?php echo $opt; ?>
          </div>
          <div class="md-form">
            <label data-error="wrong" data-success="right">Position <span class="text-danger">*</span></label>
            <?php echo $pos2; ?>
          </div>
          <div class="text-center mt-3">
            <button type="submit" class="btn btn-primary btn-block z-depth-1a" id="btn_edit">SUBMIT</button>
          </div>

        </div>
      </form>

    </div>
  </div>
</div>

<!-------------------------------------------- Change Password modal ------------------------------------------------->
<div class="modal fade" id="changepassword_modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- username, lname, fname, gender, phone, user_type_id -->

      <div class="modal-header text-center">
        <h3 class="modal-title w-100 dark-grey-text font-weight-bold">Change Password</h3>
        <button type="button" class="close" data-bs-dismiss="modal" aria-lable="close">&times;</button>
      </div>

      <form id="d_form_cp">
        <div class="modal-body mx-4">

          <input type="hidden" id="cp_id" value="">

          <div class="md-form">
            <label data-error="wrong" data-success="right">Username</label>

            <input type="text" class="form-control validate" id="cp_username" readonly>
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">Enter New Password</label>
            <span class="text-danger">*</span></label>
            <input type="password" class="form-control validate" id="cp_new_password" required>
          </div>

          <div class="md-form">
            <label data-error="wrong" data-success="right">Re-enter New Password</label>
            <span class="text-danger">*</span></label>
            <input type="password" class="form-control validate" id="cp_re_new_password" required>
          </div>

          <div class="text-center mt-3">
            <button type="submit" class="btn btn-primary btn-block z-depth-1a" name="signupbtn">SUBMIT</button>
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

// -------------------------------EDIT USER --------------------------------//
function edit_user(staff_id) {

  $.ajax({
    url: 'users/user_edit.php',
    type: 'POST',
    data: {
      staff_id: staff_id
    },
    dataType: 'JSON',
    beforeSend: function () {
      $('#btn_edit').prop("disabled", true);
    }
  }).done(function (res) {

    let html = '';

    html += (res.gender == '1') ? '<option value="1" selected >Male</option>' : '<option value="1">Male</option>';
    html += (res.gender == '0') ? '<option value="0" selected >Female</option>' :'<option value="0">Female</option>';
    $("#edit_gender").val(res.gender);

    $("#edit_user_id").val(res.staff_id);
    $("#edit_username").val(res.username);
    $("#edit_lname").val(res.lname);
    $("#edit_fname").val(res.fname);
    $("#edit_phone").val(res.phone);
    $("#edit_position").val(res.position);
    $('#edit_user_type_id').val(res.user_type_id)
    $('#btn_edit').prop("disabled", false);
    $('#list_edit_modal').modal('show');

  })
  

}

  //------------------------------CHANGE PASSWORD----------------------------------//
  function list_changepassword(staff_id, username) {

$('#cp_id').val(staff_id);
$('#cp_username').val(username);
$('#cp_new_password').val('');
$('#cp_re_new_password').val('');
$('#changepassword_modal').modal('show');

}

    $(document).ready(function () {
// ONCHANGE INSTRUCTOR 
        $('#add_position').change(function(){
         
            let pvalue = this.value;

            if(pvalue == "5"){

                $('#dept1').html(`
                <?php
                    $sql = "SELECT department_id, dept_name FROM tbl_department";
                    $result = mysqli_query($db, $sql) or die ("Bad SQL: $sql");

                    $dept = "<select class='form-control' name='type' id = 'add_department'>";
                    $dept .= "<option value='' selected hidden>Department</option>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        $dept .= "<option value='".$row['department_id']."'>".$row['dept_name']."</option>";
                    }

                    $dept .= "</select>";
                    ?>
                  
                     <label data-error="wrong" data-success="right">Department<span class="text-danger">*</span></label>
                    <?php echo $dept; ?>
                `)
            }else{
                $('#dept1').html(`
                <input type="hidden" id="add_department" readonly>`);
            }
        })

      


         //-------------------------------------------- ADD USER SUMBIT ---------------------------------------//
         $('#form_insert').on('submit', function(e){
            e.preventDefault();

            let username      = $('#add_username').val();
            let lname         = $('#add_lname').val();
            let fname         = $('#add_fname').val();
            let gender        = $('#add_gender').val();
            let position      = $('#add_position').val();
            let phone         = $('#add_phone').val();
            let user_type_id  = $('#add_user_type_id').val();
            let dept          = $('#add_department').val();

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
            if (position == '') {
              errors.push('Position');
            }
            if (user_type_id == '') {
              errors.push('User Type');
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
              url           : 'users/user_add.php',
              type          :'POST',
              data          :{
                username     : username,
                fname        : fname,
                lname        : lname,
                gender       : gender,
                position     : position,
                phone        : phone,
                user_type_id : user_type_id,
                dept         : dept
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

             // ---------------------UPDATE edit user----------------------------------------//

  $('#form_update').on('submit', function (e) {
      e.preventDefault();

      let staff_id = $('#edit_user_id').val();
      let lname = $('#edit_lname').val();
      let fname = $('#edit_fname').val();
      let gender = $('#edit_gender').val();
      let phone = $('#edit_phone').val();
      let user_type_id = $('#edit_user_type_id').val();
      let position = $('#edit_position').val();

      let errors = [];
      let input = "Please Input";

      if (lname == '') {
        errors.push('Last Number')
      }
      if (fname == '') {
        errors.push('First Name')
      }
      if (phone == '') {
        errors.push('Phone Number')
      }
      if (user_type_id == '') {
        errors.push('user_type')
      }
      if (position == '') {
        errors.push('Position')
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

          url            : 'users/user_update.php',
          type           : 'POST',
          data           : {
            staff_id        : staff_id,
            lname           : lname,
            fname           : fname,
            gender          : gender,
            phone           : phone,
           user_type_id     : user_type_id,
            position        : position
          },
          dataType: 'JSON',
          beforeSend: function () {

          }
        }).done(function (res) {
          if (res.res_success == 1) {
            alert('Update Information')
            window.location.reload()
          } else {
            alert(res.res_message);
          }
        }).fail(function () {
          console.log('Fail!');
        });

  }


})

// -----------------------CHANGE PASSWORD AJAX----------------------------- //
$('#d_form_cp').on('submit', function (e) {
    e.preventDefault();

    let staff_id = $('#cp_id').val();
    let new_password = $('#cp_new_password').val()
    let re_new_password = $('#cp_re_new_password').val()

    if (new_password == '' || re_new_password == '') {
      alert('Please input Password')
    } else if (new_password != re_new_password) {
      alert('Password do not match!')

    } else if (new_password == re_new_password) {

      $.ajax({
        url: 'users/user_changepass.php',
        type: 'POST',
        data: {
          staff_id: staff_id,
          new_password: new_password,
          re_new_password: re_new_password,
        },
        dataType: 'JSON',
        beforeSend: function () {

        }
      }).done(function (res) {
        if (res.res_success == 1) {
          alert('Password Changed!');
          $('#changepassword_modal').modal('hide');
        } else {
          alert('Invalid Password!');

        }
      })

    }


  })

  //DOCUMENT READY

    })
</script>