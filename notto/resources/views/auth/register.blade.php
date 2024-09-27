<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400..900&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css'>
    <link rel="stylesheet" href="./css/component.css">
    <title>Register</title>
</head>
<body> 
@if (session('success'))
        <div class="alert autodis3s success top-right shadow0">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert autodis3s error top-right shadow0">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert autodis3s error top-right shadow0">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="/register" method="post" class="login-form">
    @csrf
        <div class="login-logo"></div>
        <p class="login-title">Register</p>
        <input type="text" name = 'name' class="name" placeholder="Username">
        <input type="text" name = 'email' class="email" placeholder="Email">
        <input type="password" name = 'password' class="password" placeholder="Password">
        <input type="password" name = 'password_confirmation' class="password" placeholder="Confirm password">
        <div class="wrap-btn">
        <a href="/login"><button type="button" class="login-btn btn">Back to Login </i></button></a>
            <button type="submit" class="login-btn btn google-login-btn">Register</button>
           
        </div>
    </form>  

    <script src="/js/component.js"></script>
</body>
</html>