<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Login | ABP System</title>

  <link rel="shortcut icon" href="<?php echo e(asset('abp.jpg')); ?>" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
<link href="<?php echo e(asset('/')); ?>/css/roboto.css?family=Roboto:400,500" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?php echo e(url('/')); ?>/css/reset.min.css">  
      <link rel="stylesheet" href="<?php echo e(asset('css/style_login.css')); ?>">

</head>
<body>

  <div class="login-container">
  <section class="login" id="login">
    <header>
    <small style="font-size: 8px!important;float: right;margin: 0px;padding: 0px;">Current Version 2.5 Stable</small>
    <small style="font-size: 8px!important;float: left;margin: 0px;padding: 0px;">Last Update At 03:20 PM , 30 Juni 2019</small>
      <h2>PT. Alamjaya Bara Pratama </h2>
      <h4>Login</h4>
    </header>
    <form class="login-form" action="<?php echo e(url('/login/v1')); ?>" method="post">
      <?php echo e(csrf_field()); ?>

      <input type="text" class="login-input" name="username" placeholder="User" required autofocus/>
      <input type="password" class="login-input" name="password" placeholder="Password" required/>
      <div class="submit-container">
        <button type="submit" class="login-button">SIGN IN</button>
      </div>
    </form>
  </section>
  <p style="width: 100%">
    <span style="float: left;">&copy;2018 - <a href="https://misit.xyz" target="_blank">MISIT </a></span>
    <span style="float: right;"><a href="//abpjobsite.com">PT. Alamjaya Bara Pratama </a></span>
  </p>
</div>
<button id="e1" style="display: none;">Login error!</button>
    <script  src="<?php echo e(asset('js/index_login.js')); ?>"></script>
<?php if(session('failed')): ?>
<script>
  error_1();
</script>
<?php endif; ?>
<?php if(session('disable')): ?>
<script>
  error_3();
</script>
<?php endif; ?>
</body>

</html>
