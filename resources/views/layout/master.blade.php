<!DOCTYPE html>
<html>
<head>
<script data-ad-client="ca-pub-5972533139163141" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<title>@yield('title')</title>
	<link rel="shortcut icon" href="{{asset('abp.png')}}">
  	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
	<link rel="stylesheet" type="text/css" href="{{asset('/css/app.css')}}">
	<meta name="csrf-token" content="{{csrf_token()}}">
    <script src="{{asset('/js/app.js')}}"></script>
    @yield('css')
</head>
@yield('content')

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
<script src="{{asset('/js/bootstrap-notify.js')}}"></script>
@yield('js')
<script>

    function refreshSession(){
                $.ajax({
                    type:"GET",
                    url:"{{'/test/node'}}",
                    success:function(res){
                        if(res=='null'){
                            alert("Login Anda Kadaluarsa, Silahkan Login Kembali!");

                            window.location.reload();
                        }
                    }

                });
                console.log("{{date('d F Y , H:i:s')}}")
            }
    setInterval(refreshSession, 3600000); 
</script>

</body>
</html>