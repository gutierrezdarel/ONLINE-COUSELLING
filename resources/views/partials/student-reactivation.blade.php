

<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
    crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>
<body>
    
    <p class="text-capitalize">Hi {{$name}},</p>

    <p>Greetings from UB Online Counseling</p>
    <p>Please be informed that your account has been reactivated.</p> 
    {{-- <p>link: <a href="{{ url('invitaton/'.$token) }}">clieck here</a>  </p> --}}

    <br>
    <p>
        Cheers, <br>
        System Administrator
    </p>
    
    
</body>
  
</html>