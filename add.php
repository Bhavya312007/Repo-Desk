<?php
  $page_title = 'Add Record';
  require_once('includes/load.php');
  // Check what level user has permission to view this page
   
  if(isset($_POST['new'])){
    // List of required fields
    $req_fields = array('enrol', 'examDate', 'issueDate', 'name', 'sem', 'sgpa', 'cgpa', 'SheetSrNo', 'passFail', 'ex', 'mobile');
    validate_fields($req_fields);
    
    if(empty($errors)){
      $r_enrol  = ucwords(strtoupper(remove_junk($db->escape($_POST['enrol']))));
      $r_exam   = remove_junk($db->escape($_POST['examDate']));
      $r_issue   = remove_junk($db->escape($_POST['issueDate']));
      $r_name   = ucwords(strtolower(remove_junk($db->escape($_POST['name']))));
      $r_sem   = remove_junk($db->escape($_POST['sem']));
      $r_sgpa   = remove_junk($db->escape($_POST['sgpa']));
      $r_cgpa   = remove_junk($db->escape($_POST['cgpa']));
      $r_srno   = remove_junk($db->escape($_POST['SheetSrNo']));
      $r_pf   = remove_junk($db->escape($_POST['passFail']));
      $r_ex   = remove_junk($db->escape($_POST['ex']));
      $r_mobile   = remove_junk($db->escape($_POST['mobile']));
     
      $date    = make_date();
      $query  = "INSERT INTO report (enrol, examDate, issueDate, name, sem, sgpa, cgpa, SheetSrNo, passFail, ex, mobile) VALUES (";
      $query .= "'{$r_enrol}', '{$r_exam}-01', '{$r_issue}', '{$r_name}', '{$r_sem}', '{$r_sgpa}', '{$r_cgpa}', '{$r_srno}', '{$r_pf}', '{$r_ex}', {$r_mobile})";
      
      // echo $query;
      if($db->query($query)){
        $session->msg('s', "Report added ");
        redirect('add.php', false);
      } else {
        $session->msg('d', 'Sorry, failed to add report!');
        redirect('add.php', false);
      }
    } else {
      $session->msg("d", $errors); 
      redirect('add.php', false);
    }
  }
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <!-- <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div> -->
  <div class="col-md-12" style='position:fixed;bottom:10px;left:0px;z-index:98;'>
      <?php echo display_msg($msg); ?>
    </div>
</div>

<div class="row">
  <div class="col-md-8">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Add New Record</span>
        </strong>
      </div>
      <div class="panel-body">
        <div class="col-md-12">
          <form method="post" action="add.php" class="clearfix">
            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                    <Label>Issue Date</Label>
                    <input type="date" class="form-control" name="issueDate" value="<?php echo date('Y-m-d');?>" required>
                </div>
                <div class="col-md-6">
                  <Label>Exam Date</Label>
                  <input type="month" class="form-control" name="examDate" placeholder="Exam Date" required>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <input type="text" class="form-control" name="enrol" placeholder="Enrollment No" maxlength=12 required>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="name" placeholder="Name" maxlength=40 required>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">                
                <div class="col-md-6">
                    <select class="form-control" name="sem" id="category"  required >
                      <option value="">Your Semester</option>
                      <option value="1">1st</option>
                      <option value="2">2nd</option>
                      <option value="3">3rd</option>
                      <option value="4">4th</option>
                      <option value="5">5th</option>
                      <option value="6">6th</option>
                      <option value="7">7th</option>
                      <option value="8">8th</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <input type="number" class="form-control" name="SheetSrNo" placeholder="SheetSrNo" min=100000 max=9999999  required>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-6 ">
                  <input type="number" step="0.01" class="form-control" name="sgpa" placeholder="SGPA" min=0 max=10  required>
                </div>
                <div class="col-md-6">
                  <input type="number" step="0.01" class="form-control" name="cgpa" placeholder="CGPA" min=0 max=10  required>
                </div>
              </div>
            </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                      <input type="number" class="form-control" name="mobile" placeholder="Mobile" min=1000000000 max=9999999999  required>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                      <label class="radio-inline">
                        <input type="radio" name="passFail" value="1" required>Pass
                      </label>
                      <label class="radio-inline">
                        <input type="radio" name="passFail" value="0">Fail
                      </label>
                  </div>
                  <div class="col-md-6">
                      <label class="radio-inline">
                        <input type="radio" name="ex" value="0"  required>Regular
                      </label>
                      <label class="radio-inline">
                        <input type="radio" name="ex" value="1">Ex
                      </label>
                  </div>
                </div>
              </div>
            </div>
            <button type="submit" name="new" class="btn btn-danger">Add Record</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include_once('layouts/footer.php'); ?>
