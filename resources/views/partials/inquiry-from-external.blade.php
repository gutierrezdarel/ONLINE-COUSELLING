

<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
    crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>
<body>
    
    <p class="text-capitalize">Hi Receiver,</p>
    <p>You have new inquiry from the website UB Online Counseling. See below sender details</p>
    <p>
        Name: {{$name}} <br>
        Email: {{$email}} <br>
        Section: {{$section}}<br>
        Contact: {{$number}} <br>
        Message: {{$content}} <br>
    </p>
    <p>
        Cheers, <br>
        System Administrator
    </p>
    
    
</body>
  
</html>