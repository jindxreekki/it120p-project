<?php
include './config/connection.php';
include './common_service/common_functions.php';

$message = '';

if(isset($_POST['save_DentalChart'])){
  $hiddenId = $_POST['hidden_id'];

  $t1 = trim($_POST['t1']);
  $t2 = trim($_POST['t2']);
  $t3 = trim($_POST['t3']);
  $t4 = trim($_POST['t4']);
  $t5 = trim($_POST['t5']);
  $t6 = trim($_POST['t6']);
  $t7 = trim($_POST['t7']);
  $t8 = trim($_POST['t8']);
  $t9 = trim($_POST['t9']);
  $t10 = trim($_POST['t10']);
  $t11 = trim($_POST['t11']);
  $t12 = trim($_POST['t12']);
  $t13 = trim($_POST['t13']);
  $t14 = trim($_POST['t14']);
  $t15 = trim($_POST['t15']);
  $t16 = trim($_POST['t16']);
  $t17 = trim($_POST['t17']);
  $t18 = trim($_POST['t18']);
  $t19 = trim($_POST['t19']);
  $t20 = trim($_POST['t20']);
  $t21 = trim($_POST['t21']);
  $t22 = trim($_POST['t22']);
  $t23 = trim($_POST['t23']);
  $t24 = trim($_POST['t24']);
  $t25 = trim($_POST['t25']);
  $t26 = trim($_POST['t26']);
  $t27 = trim($_POST['t27']);
  $t28 = trim($_POST['t28']);
  $t29 = trim($_POST['t29']);
  $t30 = trim($_POST['t30']);
  $t31 = trim($_POST['t31']);
  $t32 = trim($_POST['t32']);

  $query = "update `dentalchart`
  set `t1` = '$t1',
      `t2` = '$t2',
      `t3` = '$t3',
      `t4` = '$t4',
      `t6` = '$t6',
      `t7` = '$t7',
      `t8` = '$t8',
      `t9` = '$t9',
      `t10` = '$t10',
      `t11` = '$t11',
      `t12` = '$t12',
      `t13` = '$t13',
      `t14` = '$t14',
      `t15` = '$t15',
      `t16` = '$t16',
      `t17` = '$t17',
      `t18` = '$t18',
      `t19` = '$t19',
      `t20` = '$t10',
      `t21` = '$t21',
      `t22` = '$t22',
      `t23` = '$t23',
      `t24` = '$t24',
      `t25` = '$t25',
      `t26` = '$t26',
      `t27` = '$t27',
      `t28` = '$t28',
      `t29` = '$t29',
      `t30` = '$t30',
      `t31` = '$t31',
      `t32` = '$t32'

      where `patient_id` = $hiddenId;
  ";

  try {

          $con->beginTransaction();
        
        
          $stmtPatient = $con->prepare($query);
          $stmtPatient->execute();
        
          $con->commit();
        
          $message = 'Dental Chart Successfully Updated';
  
  } catch(PDOException $ex) {
    $con->rollback();
  
    echo $ex->getMessage();
    echo $ex->getTraceAsString();
    exit;
  }

  header("Location:congratulation.php?goto_page=patients.php&message=$message");
  exit;

}


if (isset($_POST['save_Patient'])) {
  
    $hiddenId = $_POST['hidden_id'];

    $patientName = trim($_POST['patient_name']);
    $address = trim($_POST['address']);
    $cnic = trim($_POST['cnic']);
    
    $dateBirth = trim($_POST['date_of_birth']);
    $dateArr = explode("/", $dateBirth);

    $dateBirth = $dateArr[2].'-'.$dateArr[0].'-'.$dateArr[1];

    $phoneNumber = trim($_POST['phone_number']);

    $patientName = ucwords(strtolower($patientName));
    $address = ucwords(strtolower($address));

    $gender = $_POST['gender'];
if ($patientName != '' && $address != '' && 
  $cnic != '' && $dateBirth != '' && $phoneNumber != '' && $gender != '') {
      $query = "update `patients` 
    set `patient_name` = '$patientName', 
    `address` = '$address', 
    `cnic` = '$cnic', 
    `date_of_birth` = '$dateBirth', 
    `phone_number` = '$phoneNumber', 
    `gender` = '$gender' 
where `id` = $hiddenId;";

try {

  $con->beginTransaction();
 

  $stmtPatient = $con->prepare($query);
  $stmtPatient->execute();

  $con->commit();

  $message = 'Patient updated successfully.';

} catch(PDOException $ex) {
  $con->rollback();

  echo $ex->getMessage();
  echo $ex->getTraceAsString();
  exit;
}
}
  header("Location:congratulation.php?goto_page=patients.php&message=$message");
  exit;
}



try {

$id = $_GET['id'];
$query = "SELECT `id`, `patient_name`, `address`, 
`cnic`, date_format(`date_of_birth`, '%m/%d/%Y') as `date_of_birth`,  `phone_number`, `gender` 
FROM `patients` where `id` = $id;";

  $stmtPatient1 = $con->prepare($query);
  $stmtPatient1->execute();
  $row = $stmtPatient1->fetch(PDO::FETCH_ASSOC);

  $gender = $row['gender'];

$dob = $row['date_of_birth']; 


///////////////////////////// Getting the Dental Chart 


$query2 = "SELECT `id`, `patient_id`, `t1`,`t2`,`t3`,`t4`,`t5`,`t6`,`t7`,`t8`,`t9`,`t10`,`t11`,`t12`,`t13`,
`t14`,`t15`,`t16`,`t17`,`t18`,`t19`,`t20`,`t21`,`t22`,`t23`,`t24`,`t25`,`t26`,`t27`,`t28`, `t29`, `t30`, `t31`, `t32`
FROM `dentalchart` where `patient_id` = $id;";

  $stmtPatient2 = $con->prepare($query2);
  $stmtPatient2->execute();
  $row2 = $stmtPatient2->fetch(PDO::FETCH_ASSOC);


} catch(PDOException $ex) {

  echo $ex->getMessage();
  echo $ex->getTraceAsString();
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <?php include './config/site_css_links.php';?>

 <?php include './config/data_tables_css.php';?>

  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <title>Update Pateint Details - Clinic's Patient Management System in PHP</title>

  <style>
@import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@100&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

.content{
  margin:1.5em;
  margin-left:0;
}
.componentTitle{

  font-family: 'Poppins', sans-serif;
  color:#0049B3;
  font-weight:900;
  text-transform: uppercase;

}

label{
  color:#0049B3;
}

th,.bg-btn{
  background-color: #0049B3;
  color:white;
}
.bg-line{
  border-top: 4px solid #0049B3;
 
  margin:1.5em;
}
</style>


</head>
<body class="hold-transition sidebar-mini light-mode layout-fixed layout-navbar-fixed">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
 <?php include './config/header.php';
include './config/sidebar.php';?>  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="componentTitle">Patients</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
     <div class="card card-outline  rounded-0 shadow bg-line">
        <div class="card-header">
          <h3 class="card-title">Update Patient</h3>
          
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            
          </div>
        </div>
        <div class="card-body">
          <form method="post">
            <input type="hidden" name="hidden_id" 
            value="<?php echo $row['id'];?>">
            <div class="row">
              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-10">
              <label>Patient Name</label>
              <input type="text" id="patient_name" name="patient_name" required="required"
                class="form-control form-control-sm rounded-0" value="<?php echo $row['patient_name'];?>" />
              </div>
              <br>
              <br>
              <br>
              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-10">
                <label>Address</label> 
                <input type="text" id="address" name="address" required="required"
                class="form-control form-control-sm rounded-0" value="<?php echo $row['address'];?>" />
              </div>
              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-10">
                <label>Email</label>
                <input type="text" id="cnic" name="cnic" required="required"
                class="form-control form-control-sm rounded-0" value="<?php echo $row['cnic'];?>" />
              </div>
              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-10">
                <div class="form-group">
                  <label>Date of Birth</label>
                    <div class="input-group date" 
                    id="date_of_birth" 
                    data-target-input="nearest">
                        <input type="text" class="form-control form-control-sm rounded-0 datetimepicker-input" data-target="#date_of_birth" name="date_of_birth" 
                        value="<?php echo $dob;?>" />
                        <div class="input-group-append" 
                        data-target="#date_of_birth" 
                        data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
              
              </div>
              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-10">
                <label>Phone Number</label>
                <input type="text" id="phone_number" name="phone_number" required="required"
                class="form-control form-control-sm rounded-0" value="<?php echo $row['phone_number'];?>" />
              </div>
              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-10">
              <label>Gender</label>
                <!-- $gender -->

                <select class="form-control form-control-sm rounded-0" id="gender" 
                name="gender">
                 <?php echo getGender($gender);?>
                </select>
                
              </div>
              </div>
              
              <div class="clearfix">&nbsp;</div>
              <div class="row">
                <div class="col-lg-11 col-md-10 col-sm-10">&nbsp;</div>
              <div class="col-lg-1 col-md-2 col-sm-2 col-xs-2">
                <button type="submit" id="save_Patient" 
                name="save_Patient" class="btn bg-btn btn-sm btn-flat btn-block">Save</button>
              </div>
            </div>
          </form>
        </div>
        
      </div>



      <div class="card card-outline  rounded-0 shadow bg-line">
        <div class="card-header">
          <h3 class="card-title">Update Patient's Dental Chart</h3>
          
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            
          </div>
        </div>
        <div class="card-body">
          <form method="post">
            <input type="hidden" name="hidden_id" 
            value="<?php echo $row['id'];?>">

            <div class="row">

              <div class="col-lg-1 col-md-1 col-sm-1 col-xs-5">
              <label>T1</label>
              <input type="text" id="t1" name="t1" 
                class="form-control form-control-sm rounded-0" value="<?php echo $row2['t1'];?>" />
              </div>

              <div class="col-lg-1 col-md-1 col-sm-1 col-xs-5">
              <label>T2</label>
              <input type="text" id="t2" name="t2" 
                class="form-control form-control-sm rounded-0" value="<?php echo $row2['t2'];?>" />
              </div>
              
              <div class="col-lg-1 col-md-1 col-sm-1 col-xs-5">
              <label>T3</label>
              <input type="text" id="t3" name="t3"
                class="form-control form-control-sm rounded-0" value="<?php echo $row2['t3'];?>" />
              </div>

              <div class="col-lg-1 col-md-1 col-sm-1 col-xs-5">
              <label>T4</label>
              <input type="text" id="t4" name="t4"
                class="form-control form-control-sm rounded-0" value="<?php echo $row2['t4'];?>" />
              </div>

              <div class="col-lg-1 col-md-1 col-sm-1 col-xs-5">
              <label>T5</label>
              <input type="text" id="t5" name="t5"
                class="form-control form-control-sm rounded-0" value="<?php echo $row2['t5'];?>" />
              </div>

              <div class="col-lg-1 col-md-1 col-sm-1 col-xs-5">
              <label>T6</label>
              <input type="text" id="t6" name="t6" 
                class="form-control form-control-sm rounded-0" value="<?php echo $row2['t6'];?>" />
              </div>

              <div class="col-lg-1 col-md-1 col-sm-1 col-xs-5">
              <label>T7</label>
              <input type="text" id="t7" name="t7" 
                class="form-control form-control-sm rounded-0" value="<?php echo $row2['t7'];?>" />
              </div>

              <div class="col-lg-1 col-md-1 col-sm-1 col-xs-5">
              <label>T8</label>
              <input type="text" id="t8" name="t8"
                class="form-control form-control-sm rounded-0" value="<?php echo $row2['t8'];?>" />
              </div>

              <div class="col-lg-1 col-md-1 col-sm-1 col-xs-5">
              <label>T9</label>
              <input type="text" id="t9" name="t9" 
                class="form-control form-control-sm rounded-0" value="<?php echo $row2['t9'];?>" />
              </div>
              
              
              <div class="col-lg-1 col-md-1 col-sm-1 col-xs-5">
              <label>T10</label>
              <input type="text" id="t10" name="t10" 
                class="form-control form-control-sm rounded-0" value="<?php echo $row2['t10'];?>" />
              </div>

              <div class="col-lg-1 col-md-1 col-sm-1 col-xs-5">
              <label>T11</label>
              <input type="text" id="t11" name="t11"
                class="form-control form-control-sm rounded-0" value="<?php echo $row2['t11'];?>" />
              </div>

              <div class="col-lg-1 col-md-1 col-sm-1 col-xs-5">
              <label>T12</label>
              <input type="text" id="t12" name="t12"
                class="form-control form-control-sm rounded-0" value="<?php echo $row2['t12'];?>" />
              </div>
            
              </div>

              
              <div class="row">

<div class="col-lg-1 col-md-1 col-sm-1 col-xs-5">
<label>T13</label>
<input type="text" id="t13" name="t13" 
  class="form-control form-control-sm rounded-0" value="<?php echo $row2['t13'];?>" />
</div>

<div class="col-lg-1 col-md-1 col-sm-1 col-xs-5">
<label>T14</label>
<input type="text" id="t14" name="t14" 
  class="form-control form-control-sm rounded-0" value="<?php echo $row2['t14'];?>" />
</div>

<div class="col-lg-1 col-md-1 col-sm-1 col-xs-5">
<label>T15</label>
<input type="text" id="t15" name="t15" 
  class="form-control form-control-sm rounded-0" value="<?php echo $row2['t15'];?>" />
</div>

<div class="col-lg-1 col-md-1 col-sm-1 col-xs-5">
<label>T16</label>
<input type="text" id="t16" name="t16"
  class="form-control form-control-sm rounded-0" value="<?php echo $row2['t16'];?>" />
</div>

<div class="col-lg-1 col-md-1 col-sm-1 col-xs-5">
<label>T17</label>
<input type="text" id="t17" name="t17" 
  class="form-control form-control-sm rounded-0" value="<?php echo $row2['t17'];?>" />
</div>

<div class="col-lg-1 col-md-1 col-sm-1 col-xs-5">
<label>T18</label>
<input type="text" id="t18" name="t18" 
  class="form-control form-control-sm rounded-0" value="<?php echo $row2['t18'];?>" />
</div>

<div class="col-lg-1 col-md-1 col-sm-1 col-xs-5">
<label>T19</label>
<input type="text" id="t19" name="t19" 
  class="form-control form-control-sm rounded-0" value="<?php echo $row2['t19'];?>" />
</div>

<div class="col-lg-1 col-md-1 col-sm-1 col-xs-5">
<label>T20</label>
<input type="text" id="t20'" name="t20'" 
  class="form-control form-control-sm rounded-0" value="<?php echo $row2['t20'];?>" />
</div>

<div class="col-lg-1 col-md-1 col-sm-1 col-xs-5">
<label>T21</label>
<input type="text" id="t21" name="t21" 
  class="form-control form-control-sm rounded-0" value="<?php echo $row2['t21'];?>" />
</div>


<div class="col-lg-1 col-md-1 col-sm-1 col-xs-5">
<label>T22</label>
<input type="text" id="t22" name="t22" 
  class="form-control form-control-sm rounded-0" value="<?php echo $row2['t22'];?>" />
</div>

<div class="col-lg-1 col-md-1 col-sm-1 col-xs-5">
<label>T23</label>
<input type="text" id="t23" name="t23"
  class="form-control form-control-sm rounded-0" value="<?php echo $row2['t23'];?>" />
</div>

<div class="col-lg-1 col-md-1 col-sm-1 col-xs-5">
<label>T24</label>
<input type="text" id="t24" name="t24" 
  class="form-control form-control-sm rounded-0" value="<?php echo $row2['t24'];?>" />
</div>

</div>


<div class="row">

<div class="col-lg-1 col-md-1 col-sm-1 col-xs-5">
<label>T25</label>
<input type="text" id="t25" name="t25"
  class="form-control form-control-sm rounded-0" value="<?php echo $row2['t25'];?>" />
</div>

<div class="col-lg-1 col-md-1 col-sm-1 col-xs-5">
<label>T26</label>
<input type="text" id="t26" name="t26" 
  class="form-control form-control-sm rounded-0" value="<?php echo $row2['t26'];?>" />
</div>

<div class="col-lg-1 col-md-1 col-sm-1 col-xs-5">
<label>T27</label>
<input type="text" id="t27" name="t27" 
  class="form-control form-control-sm rounded-0" value="<?php echo $row2['t27'];?>" />
</div>

<div class="col-lg-1 col-md-1 col-sm-1 col-xs-5">
<label>T28</label>
<input type="text" id="t28" name="t28" 
  class="form-control form-control-sm rounded-0" value="<?php echo $row2['t28'];?>" />
</div>

<div class="col-lg-1 col-md-1 col-sm-1 col-xs-5">
<label>T29</label>
<input type="text" id="t29" name="t29" 
  class="form-control form-control-sm rounded-0" value="<?php echo $row2['t29'];?>" />
</div>

<div class="col-lg-1 col-md-1 col-sm-1 col-xs-5">
<label>T30</label>
<input type="text" id="t30" name="t30" 
  class="form-control form-control-sm rounded-0" value="<?php echo $row2['t30'];?>" />
</div>

<div class="col-lg-1 col-md-1 col-sm-1 col-xs-5">
<label>T31</label>
<input type="text" id="t31" name="t31" 
  class="form-control form-control-sm rounded-0" value="<?php echo $row2['t31'];?>" />
</div>

<div class="col-lg-1 col-md-1 col-sm-1 col-xs-5">
<label>T32</label>
<input type="text" id="t32" name="t32" 
  class="form-control form-control-sm rounded-0" value="<?php echo $row2['t32'];?>" />
</div>


</div>

<br><br>
              
              <div class="row">
                <div class="col-lg-11 col-md-10 col-sm-10">&nbsp;</div>
              <div class="col-lg-1 col-md-2 col-sm-2 col-xs-2">
                <button type="submit" id="save_DentalChart" 
                name="save_DentalChart" class="btn bg-btn btn-sm btn-flat btn-block">Save</button>
              </div>
            </div>
          </form>
        </div>
        
      </div>
      
    </section>
     <br/>
     <br/>
     <br/>

 
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php 
 include './config/footer.php';

  $message = '';
  if(isset($_GET['message'])) {
    $message = $_GET['message'];
  }
?>  
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?php include './config/site_js_links.php'; ?>
<?php include './config/data_tables_js.php'; ?>


<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

<script>
  showMenuSelected("#mnu_patients", "#mi_patients");

  var message = '<?php echo $message;?>';

  if(message !== '') {
    showCustomMessage(message);
  }
  $('#date_of_birth').datetimepicker({
        format: 'L'
    });
      
    
   $(function () {
    $("#all_patients").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#all_patients_wrapper .col-md-6:eq(0)');
    
  });

</script>
</body>
</html>