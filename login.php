<?php
require_once('load.php');
?>
<style>
            /* .img-logo::before{
            content:url("./libs/images/bsf.png");
            width: 80px;height:auto;}
            .img-logo::after{
              width: 80px;height:auto;
            content:url("./libs/images/bsf.png");} */

            @font-face {
            font-family: 'Gang of Three';
            src: url('libs/fonts/go3v2.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
        }
        </style>
<?php include_once('header.php'); ?>

<div class="login-page" style="width: 500px;border:1px solid purple;">
  <!-- <div class="text-center">
    <h1>Login Panel</h1>
    <div class="row" style="display: flex; align-items: center; margin-left: 7px;">
      <img src=".\libs\images\bsf.png" style="width: 80px;height:auto;">
      <h3 style="font-family:Gang of Three">RustamJi Institue Of Technology</h3>
      <img src=".\libs\images\bsfacademy.png" style="width: 80px;height:auto;">
    </div>
  </div> -->

  <!-- <div class="login-page" >
  <div class="text-center">
    <h1>Login Panel</h1>
      <h3 >MT BSF Academy</h3>
      <img src=".\libs\images\bsf.png" style="width: 80px;height:auto;">
      <img src=".\libs\images\bsfacademy.png" style="width: 80px;height:auto;">
    </div> -->
 
  <div class="col-md-12" style='position:fixed;bottom:10px;left:0px;z-index:98;'>
    <?php echo display_msg($msg); ?>
  </div>
  <form method="post" action="partials/auth.php" class="clearfix" style="padding-top:30px;">
    <div class="form-group">
      <!-- <label for="username" class="control-label">Username</label> -->
      <input type="name" class="form-control" name="username" placeholder="Username" value='Admin' readonly>
    </div>
    <div class="form-group">
      <!-- <label for="Password" class="control-label">Password</label> -->
      <input type="password" name="password" class="form-control" placeholder="Password">
    </div>
    <div class="form-group">
      <button type="submit" class="btn btn-danger" style="border-radius:0%">Login</button>
    </div>
  </form>
</div>
<?php include_once('footer.php'); ?>