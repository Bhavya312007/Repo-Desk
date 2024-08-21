<?php $user = current_user(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title><?php if (!empty($page_title))
            echo remove_junk($page_title);
          elseif (!empty($user))
            echo ucfirst($user['name']);
          else echo "ReportDesk"; ?>
  </title>
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" /> -->
  <link rel="stylesheet" href="libs/css/bootstrap.css" />
  <link rel="stylesheet" href="libs/css/bootstrap.css.map" />
  <link rel="stylesheet" href="libs/css/bootstrap.min.css" />
  <link rel="stylesheet" href="libs/css/bootstrap-theme.css" />
  <link rel="stylesheet" href="libs/css/bootstrap-theme.css.map" />
  <!-- <link rel="stylesheet" href="libs/css/bootstrap-theme.min.map" /> -->
  <link rel="stylesheet" href="libs/css/datepicker3.min.css" />
  <link rel="stylesheet" href="libs/css/main.css" />
  <link rel="icon" href="ibs/images/i1.svg" type="image/icon type">
</head>
<style>
  /* Styling for the modal overlay */
  .overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.1);
      z-index: 9999;
    }

    /* Styling for the error window */
    .errorWindow {
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      padding: 30px;
      background-color: white;
      border: 2px solid rgba(0, 0, 0, 0.3);
      border-radius:10px;
      color: black;
      font-family: Arial, sans-serif;
      font-size: 16px;
      z-index: 1000;
    }
    @font-face {
            font-family: 'Gang of Three';
            src: url('libs/fonts/go3v2.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
        }
</style>

<script>
  function float_window(message,buttons,functions){
    //remove previous
    pre=document.querySelector('.overlay');
    if(pre!=null) pre.remove();
    //background
    background=document.createElement('div');
    background.classList.add('overlay');
    
    //floating window div
    div=document.createElement('div');
    div.classList.add('errorWindow');
    div.innerHTML=message;
    
    //buttondiv
    buttonsdiv=document.createElement('div');
    buttonsdiv.style.display='flex';
    buttonsdiv.style.marginTop='10px';
    buttonsdiv.style.justifyContent='flex-end';
    
    //buttons
    for(let j=0;j<buttons.length;j++){
        button=document.createElement('button');
        if(j>0) button.style.marginLeft='5px';
        button.type="button";
        button.innerHTML=buttons[j];
        button.classList.add('btn','btn-dark');
        button.addEventListener('click',()=>{
            functions[j]();
            background.remove();
        })
        buttonsdiv.append(button);
    }

    div.append(buttonsdiv);
    background.append(div);
    document.querySelector('body').append(background);
}
</script>
<body>
  <header id="header"style="padding-left:40px;padding-right:60px;">
    <div class="header-content" style="display:grid;grid-template-columns:17vw 68vw 15vw;">
      <!-- <img class="pull-left" src=".\libs\images\bsf.png" style="width:4%;height:auto;margin-top: 5px;"> -->
        <!-- <img src=".\libs\images\bsfacademy.png" style="width:4%;height:auto;"> -->
        <!-- <div class="header-date pull-left"> -->
        <h3 style="font-family:Gang of Three;">RepoDesk</h3>

        <?php if ($session->isUserLoggedIn(true)) : ?>
        <div class=" "style="margin:auto;margin-left:0px;display:grid;grid-template-columns:70px 7px;">
          <div style="" >
            <a href="add.php" class="btn btn-primary">Add</a>
          </div>
          <div>
            <a href="view.php" class="btn btn-primary">View</a>
          </div>
        </div>
        <?php else: ?>
          <div></div>
        <?php endif;?>

        <div class="pull-right clearfix">
          <ul class="info-menu list-inline list-unstyled"  >
            <li class="profile" style="margin-top:10px;">
              <a href="#" data-toggle="dropdown" class="toggle" aria-expanded="false">
                <?php if ($session->isUserLoggedIn(true)) : ?>
                  <img src="uploads/users/<?php echo $user['image']; ?>" alt="user-image" class="img-circle img-inline">
                  <span><?php echo remove_junk(ucfirst($user['name'])); ?> <i class="caret"></i></span>
                  <?php else :?>
                    <i class="glyphicon glyphicon-cog" style='font-size:25px;color:black;'></i>
              <?php endif;?>
              </a>
              <ul class="dropdown-menu">
                <?php if ($session->isUserLoggedIn(true)) : ?>
                <li>
                  <a href="change_password.php" title="Change your password">
                    <i class="glyphicon glyphicon-cog"></i>
                    edit pass
                  </a>
                </li>
                <li class="last">
                  <a href="partials/logout.php"title='logout'>
                    <i class="glyphicon glyphicon-log-out"></i>
                    Logout
                  </a>
                </li>
                <?php else : ?>
                <li class="last">
                  <a href="login.php">
                    <i class="glyphicon glyphicon-log-in"></i>
                    Login
                  </a>
                </li>
                <?php endif;?>
              </ul>
            </li>
          </ul>
        </div>
         

        </div>
        
      </div>
    </header>
   
  <div class="page">
    <div class="container-fluid">
      