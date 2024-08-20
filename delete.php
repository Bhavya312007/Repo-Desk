<?php
  require_once('../includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
?>
<?php
  $report = find_by_id('report',$_GET['id']);
  echo $report;
  if(!$report){
    $session->msg("d","Missing report id.");
    redirect('view.php');
  }
?>
<?php
  $delete_id = delete_by_id('report',$report['id']);
  if($delete_id){
      $session->msg("s","Report deleted.");
      redirect('../view.php');
  } else {
      $session->msg("d","Report deletion failed.");
      redirect('../view.php');
  }
?>
