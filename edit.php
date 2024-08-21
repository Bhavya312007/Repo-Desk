<?php
  $page_title = 'Edit Report';
  require_once('includes/load.php');
  // Check what level user has permission to view this page
  page_require_level(3);
  if(isset($_POST['id'])) $report= find_by_id('report',$_POST['id']);
  else $report= find_by_id('report',$_GET['id']);
    if(!$report){
      $session->msg("d","Missing report id.");
      redirect('view.php');
    }
  if(isset($_POST['id'])){
    // List of required fields
    $req_fields = array('enrol', 'examDate', 'issueDate', 'name', 'sem', 'sgpa', 'cgpa', 'SheetSrNo', 'passFail', 'ex', 'mobile');
    validate_fields($req_fields);
    
    if(empty($errors)){
      $id = $_POST['id'];
      $r_enrol  = ucwords(strtoUpper(remove_junk($db->escape($_POST['enrol']))));
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
      $query  = "UPDATE report SET ";
      $query .= "enrol='{$r_enrol}', examDate='{$r_exam}-01', issueDate='{$r_issue}', name='{$r_name}', sem='{$r_sem}', sgpa='{$r_sgpa}', cgpa='{$r_cgpa}', SheetSrNo='{$r_srno}', passFail='{$r_pf}', ex='{$r_ex}', mobile='{$r_mobile}' ";
      $query .= "WHERE id=".$id." ;";
      
      if($db->query($query)){
        $session->msg('s', "Report added ");
        redirect('view.php', false);
      } else {
        $session->msg('d', 'Sorry, failed to add report!');
        redirect('view.php', false);
      }
    } else {
      $session->msg("d", $errors); 
      redirect('view.php', false);
    }
  }
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
</div>
<div class="row">
  <div class="col-md-8">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Add New Report</span>
        </strong>
      </div>
      <div class="panel-body">
        <div class="col-md-12">
          <form method="post" action="edit.php" class="clearfix">
          <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                    <Label>Issue Date</Label>
                    <input type="date" class="form-control" name="issueDate" value= "<?php echo remove_junk($report['issueDate']); ?>" required>
                </div>
                <div class="col-md-6">
                  <Label>Exam Date</Label>
                  <input type="month" class="form-control" name="examDate" value= "<?php echo substr(remove_junk($report['examDate']),0,-3); ?>" placeholder="Exam Date" required>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <input type="text" class="form-control" name="enrol" placeholder="Enrollment No" maxlength=12  required value= "<?php echo remove_junk($report['enrol']); ?>">
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="name" placeholder="Name" value= "<?php echo remove_junk($report['name']); ?>" maxlength required>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">                
                <div class="col-md-6">
                    <select class="form-control" name="sem" id="category"  required >
                      <option value="">Your Semester</option>
                      <?php
                        for($i=1;$i<=8;$i++){
                          echo "<option value =\"".$i."\" ";
                          if($report['sem']==$i) echo "selected";
                          echo ">".$i;
                          if($i==1) echo "st";
                          else if($i==2) echo "nd";
                          else if($i==3) echo "rd";
                          else  echo "th";
                          echo "</option>";
                        }
                      ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <input type="number" class="form-control" name="SheetSrNo" placeholder="SheetSrNo" min=100000 max=9999999  required value= "<?php echo remove_junk($report['SheetSrNo']); ?>">
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-6 ">
                  <input type="number" step="0.01" class="form-control" name="sgpa" placeholder="SGPA" min=0 max=10  required  value= "<?php echo remove_junk($report['sgpa']); ?>">
                </div>
                <div class="col-md-6">
                  <input type="number" step="0.01" class="form-control" name="cgpa" placeholder="CGPA" min=0 max=10  required  value= "<?php echo remove_junk($report['cgpa']); ?>">
                </div>
              </div>
            </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                      <input type="number" class="form-control" name="mobile" placeholder="Mobile" min=1000000000 max=9999999999 value= "<?php echo remove_junk($report['mobile']); ?>" required>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                      <label class="radio-inline">
                        <input type="radio" name="passFail" value="1"   <?php if($report['passFail']) echo "checked"; ?>>Pass
                      </label>
                      <label class="radio-inline">
                        <input type="radio" name="passFail" value="0" <?php if(!$report['passFail']) echo "checked"; ?>>Fail
                      </label>
                  </div>
                  <div class="col-md-6">
                      <label class="radio-inline">
                        <input type="radio" name="ex" value="0"  required <?php if(!$report['ex']) echo "checked"; ?>>Regular
                      </label>
                      <label class="radio-inline">
                        <input type="radio" name="ex" value="1" <?php if($report['ex']) echo "checked"; ?>>Ex
                      </label>
                  </div>
                </div>
            </div>

            <button type="submit" name="id" value ="<?php if(isset($_POST['id'])) echo $_POST['id'];else echo $_GET['id']; ?>" class="btn btn-danger">Update</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include_once('layouts/footer.php'); ?>
