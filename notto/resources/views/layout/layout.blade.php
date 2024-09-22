<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="/css/home.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css'>
</head>
<body>
    
<!-- topbar -->
<div class="wrap">
    <div class="topbar">
        <div class="topbar-left">
            <i class="show-hide-btn fa-solid fa-bars"></i>
            <div class="logo-name">
                <i class="logo fa-solid fa-note-sticky"></i>
                <div class="name">Note</div>
            </div>
        </div>

        <div class="topbar-date">
            <div class="topbar-day">Hôm nay</div>
            <div class="topbar-buttons">
                <div class="topbar-btn-left topbar-btn"><i class="fa-solid fa-angle-left"></i></div>
                <div class="topbar-btn-right topbar-btn"><i class="fa-solid fa-angle-right"></i></div>
            </div>
            <div class="topbar-month-year">Tháng 09, 2024</div>
        </div>

        <div class="wrap-search">
            <div class="wrap2">
                <input type="text" class="search" placeholder="search...">  
                <button type="button" class="search-icon"><i class="fa fa-search"></i></button> 
            </div>
            
        </div>

        <div class="noti-btn">
            <i class="fa-solid fa-bell bell-icon"></i>
            <div class="number-of-noti">2</div>
        </div>
        <div class="avatar"></div>
    </div>

    <div class="wrap-content">

    <!-- left navbar -->
    <div class="navbar">
        <div class="wrap-btn-options">
            
        
        <div  class="create-btn"><i class="fa fa-add"></i><p id="createText">Create</p></div>
        <div class="create-options">
            <div class="create-option">Event</div>
            <div class="create-option">Task</div>
            <div class="create-option">Appointment</div>
        </div>
    </div>

        <div class="status-menu">
            <div class="status-title">Status</div>
            <div class="status-option1 status-option"><input type="checkbox" name="" id=""> option 1</div>
            <div class="status-option2 status-option"><input type="checkbox" name="" id=""> option 2</div>
        </div>
        <!-- <div class="line"></div> -->
        <div class="nav">
            <a href="" class="tasks">Task list</a>
            <a href="" class="profile">Profile</a>
            <a href="" class="stats">Statistics</a>
        </div>
    </div>
<!-- main -->
    <div class="main">
        @yield('content')
    </div>
</div>
</div>

<script src="/js/home.js"></script>
</body>
</html>