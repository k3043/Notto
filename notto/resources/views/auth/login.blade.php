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
    <title>Lib</title>
</head>
<body> 
@if (session('success'))
        <div class="alert autodis3s success top-right shadow0">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert autodis3s success top-right shadow0">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert autodis3s success top-right shadow0">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="/login" method="post" class="login-form">
    @csrf
        <p class="login-title">Welcome!</p>
        <input type="text" name = 'email' class="email" placeholder="Email">
        <input type="password" name = 'password' class="password" placeholder="Password">
        <div class="wrap-btn">
            <button type="submit" class="login-btn btn">Login</button>
            <button class="login-btn google-login-btn btn">Login with  <i class="fa-brands fa-google"></i></button>
        </div>
        <div class="regist-area">
            <p>Forgot password?</p>
            <a href=""><p class="create-new">Create new account</p></a>
        </div>
    </form>  

    <script src="/js/component.js"></script>
</body>
</html>