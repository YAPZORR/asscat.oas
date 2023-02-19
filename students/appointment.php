<?php
include('../header.php');
include('appointment/appointment.php');
?>

<div class="page-heading">
     <h3>Appointments</h3>
 </div>

  <div style="flex: 1;"></div>
  <button class="btn btn-large btn-rasied btn-primary " data-bs-toggle="modal" data-bs-target="#add_appointment_modal"><i class="fa fa-plus"></i> Request Appointment</button>
<br><br>

 <div class="page-content">
     <div class="card shadow mb-4">
         <div class="card-body">
             <div class="table-responsive">
                 <table class="table " id="dataTable" width="100%" cellspacing="0">

                     <thead>

                         <tr>
                     
                             <th class="text-center">Status</th>
                             <th class="text-center">Location</th>
                             <th class="text-center">Office/Instructor</th>
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
                             <td class="text-center"><?php echo $req['status']; ?></td>
                             <td class="text-center"><?php echo $req['location']; ?></td>
                             <td class="text-center"><?php echo $req['office'];  ?></td>
                             <td class="text-center"><?php echo $req['appointed_date']; ?></td>
                             <td class="text-center"><?php echo $req['appointed_time']; ?></td>
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
                                </tr>

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


 
<!------------------------------------- Request Appointment -------------------------------------------------->

<?php
$sql = "SELECT DISTINCT campus_id, campus_name FROM tbl_campus";
$result = mysqli_query($db, $sql) or die ("Bad SQL: $sql");

$opt = "<select class='form-control' name='type' id = 'campus1'>";
$opt .= "<option value='' selected hidden>Select Campus</option>";
$opt .= "<option value='Bunawan Campus'>Bunawan Campus</option>";
$opt .= "<option value='Trento Campus'>Trento Campus</option>";
  while ($row = mysqli_fetch_assoc($result)) {
    $opt .= "<option value='".$row['campus_id']."'>".$row['campus_name']."</option>";
  }

$opt .= "</select>";


$sql = "SELECT staff_position_id, position_name FROM tbl_staff_position";
                    $result = mysqli_query($db, $sql) or die ("Bad SQL: $sql");

                    $office1 = "<select class='form-control' name='type' id = 'add_offices2'>";
                    $office1 .= "<option value='' selected hidden>Offices</option>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        $office1 .= "<option value='".$row['staff_position_id']."'>".$row['position_name']."</option>";
                    }

                    $office1 .= "</select>";
?>
<div class="modal fade" id="add_appointment_modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h5 class="modal-title" id="exampleModalLabel">Add Appointment</h5>
                <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="delete_form">
                <div class="modal-body">

          
                <div class="md-form mb-4">
            <label data-error="wrong" style="font-weight: bolder;"  data-success="right">Campus<span class="text-danger">*</span></label>
            <?php echo $opt; ?>
          </div>
<!--
          <div class="md-form mb-4" id="date">
          <label data-error="wrong" data-success="right">Select Available Dates<span class="text-danger">*</span></label>
                    <select class="form-control" name="" id="">
                        <option class="form-control" value="">--Select Dates--</option>
                        <option class="form-control" value="">01/02/2023</option>
                        <option class="form-control" value="">01/03/2023</option>
                        <option class="form-control" value="">01/04/2023</option>
                        
                    </select>
          </div>
          
          <div class="md-form mb-4" id="time">
          <label data-error="wrong" data-success="right">Select Available Time<span class="text-danger">*</span></label>
                    <select class="form-control" name="" id="">
                        <option class="form-control" value="">--Select Time--</option>
                        <option class="form-control" value="">7:00 am</option>
                        <option class="form-control" value="">8:00 am</option>
                        <option class="form-control" value="">9:00 am</option>
                        
                    </select>
          </div>-->

          <div class="md-form mb-4" id="offices1">
          <label data-error="wrong"  data-success="right"> <span style="font-weight: bolder;"> Offices</span></span></label>
                    <?php echo $office1; ?>
                    <span style="font-weight: bolder;"></span><span class="text-danger">* <span class="text-danger"><em>Note that if you are going to set appointment on registrar, there are documents like <span style="font-weight: bolder;">COR</span> that needs to be payed first in cashier's office.</em></span></span>
          </div>

          <div class="md-form" id="dept1">
          
          </div>
          <div class="md-form" id="instructor1">
          
          </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>

    </div>
</div>

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


<?php
include('../footer.php');
?>

<script>

$(document).ready(function(){
    
// CHANGE OFFICES
$('#add_offices2').change(function(e){
        e.preventDefault();

    let dvalue  = this.value;
    if(dvalue == '5'){
        $('#dept1').html(`
                     <label data-error="wrong" data-success="right">Department<span class="text-danger">*</span></label>
                    <?php echo $dept; ?>
        `)

    }else{
        $('#dept1').html(`
                <input type="hidden" id="add_department" readonly>`);

    }

})

// CHANGE department
$('#add_department').change(function(e){
        e.preventDefault();

    let dvalue  = this.value;

    if(dvalue == '5'){

        $('#instructor1').html(`
                     <label data-error="wrong" data-success="right">Department<span class="text-danger">*</span></label>
                    <?php echo $dept; ?>
        `)

    }else{
        $('#instructor1').html(`
                <input type="hidden" id="add_department" readonly>`);

    }

})

//document Ready
})

</script>