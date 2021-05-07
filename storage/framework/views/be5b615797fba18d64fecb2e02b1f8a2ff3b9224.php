<!DOCTYPE html>
<html>
<head>
<script data-ad-client="ca-pub-5972533139163141" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<title><?php echo $__env->yieldContent('title'); ?></title>
	<link rel="shortcut icon" href="<?php echo e(asset('abp.png')); ?>">
  	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/css/app.css')); ?>">
	<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <script src="<?php echo e(asset('/js/app.js')); ?>"></script>
    <?php echo $__env->yieldContent('css'); ?>
</head>
<?php echo $__env->yieldContent('content'); ?>

<script>
	$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
	var csrfToken = $('[name="csrf_token"]').attr('content');

            setInterval(refreshToken, 3600000); // 1 hour 

            function refreshToken(){
                $.get('refresh-csrf').done(function(data){
                    csrfToken = data; // the new token
                });
                console.log(csrfToken);
            }

            setInterval(refreshToken, 3600000);
</script>
<script src="<?php echo e(asset('/js/bootstrap-notify.js')); ?>"></script>
<?php echo $__env->yieldContent('js'); ?>
<script>

    function refreshSession(){
                $.ajax({
                    type:"GET",
                    url:"<?php echo e('/test/node'); ?>",
                    success:function(res){
                        if(res=='null'){
                            alert("Login Anda Kadaluarsa, Silahkan Login Kembali!");

                            window.location.reload();
                        }
                    }

                });
                console.log("<?php echo e(date('d F Y , H:i:s')); ?>")
            }
    setInterval(refreshSession, 3600000); 
</script>

</body>
</html>