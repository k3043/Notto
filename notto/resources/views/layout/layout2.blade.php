<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="./css/component.css">
    <link rel="stylesheet" href="/css/home.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css'>
</head>
<body>

<div class="wrap">
    <div class="topbar">
        <div class="topbar-left">
            <i class="show-hide-btn fa-solid fa-bars"></i>
            <a href="/"><div class="logo-name">
                <i class="logo fa-solid fa-note-sticky"></i>
                <div class="name">Note</div>
            </div></a>
        </div>
        <div class="wrap-search">
            <!-- <div class="wrap2">
                <input type="text" class="search" placeholder="search...">  
                <button type="button" class="search-icon"><i class="fa fa-search"></i></button> 
            </div> -->
            
        </div>

        <div class="noti-btn">
            <i class="fa-solid fa-bell bell-icon"></i>
            <div class="number-of-noti">2</div>
        </div>
        <div class="wrap-user">
            <div class="avatar"> <img src="{{Auth::user()->avatar?Auth::user()->avatar:'/images/defaultava.jpg'}}" alt=""></div>
            <form action="/logout" method = 'post'>@csrf <button><i class=" logout-btn fa-solid fa-right-from-bracket"></i></button></form>  
        </div>
        
    </div>

    <div class="wrap-content">

    <!-- left navbar -->
    <div class="navbar">
        <div class="wrap-btn-options">
            
        
        <div  class="create-btn"><i class="fa fa-add"></i><p id="createText">Create</p></div>
        <div class="create-options">
            <a href="/createTask"><div class="create-option">Task</div></a>
            <a href="/createEvent"><div class="create-option">Event</div></a>
            <a href="/assignTask"><div class="create-option">Task for others</div></a>
        </div>
    </div>

        <!-- <div class="status-menu">
            <div class="status-title">Status</div>
            <div class="status-option1 status-option"><input type="checkbox" name="" id=""> option 1</div>
            <div class="status-option2 status-option"><input type="checkbox" name="" id=""> option 2</div>
        </div> -->
        <!-- <div class="line"></div> -->
        <div class="nav">
            <a href="/tasks" class="tasks">Task list</a>
            <a href="/profile/{{Auth::user()->id}}" class="profile">Profile</a>
            <a href="/statistics" class="stats">Statistics</a>
        </div>
    </div>
<!-- main -->
    <div class="main">
        @yield('content')
    </div>
</div>
</div>

<script src="/js/home.js"></script>
<script src="/js/component.js"></script>
</body>
</html>