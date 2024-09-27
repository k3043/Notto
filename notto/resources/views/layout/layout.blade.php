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
            <div class="logo-name">
                <i class="logo fa-solid fa-note-sticky"></i>
                <div class="name">Note</div>
            </div>
        </div>
        <div class="topbar-date">
            <a href="/" class="topbar-day">Hôm nay</a>
            <div class="topbar-buttons">
                <a  href="/?date=<?php echo $currentDate->copy()->subWeek()->format('Y-m-d H:i:s'); ?>" class="topbar-btn-left topbar-btn"><i class="fa-solid fa-angle-left"></i></a>
                <a  href="/?date=<?php echo $currentDate->copy()->addWeek()->format('Y-m-d H:i:s'); ?>" class="topbar-btn-right topbar-btn"><i class="fa-solid fa-angle-right"></i></a>
            </div>
            <div class="topbar-month-year">Tháng {{$currentDate->month}}, {{$currentDate->year}}</div>
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
            <a href="/createAppointment"><div class="create-option">Appointment</div></a>
        </div>
    </div>

        <div class="status-menu">
    <div class="status-title">Status</div>
    <div class="status-option1 status-option" style="color:rgb(202, 210, 214)">
        <input type="checkbox" name="status" value="pending" id="status-pending"> pending
    </div>
    <div class="status-option2 status-option" style="color:#8dce8f">
        <input type="checkbox" name="status" value="completed" id="status-completed"> completed
    </div>
    <div class="status-option3 status-option" style="color:rgb(221, 65, 65);">
        <input type="checkbox" name="status" value="overdue" id="status-overdue"> overdue
    </div>
    <div class="status-option4 status-option" style="color:rgb(228, 168, 27)">
        <input type="checkbox" name="status" value="late" id="status-late"> late
    </div>
</div>
        <!-- <div class="line"></div> -->
        <div class="nav">
            <a href="/tasks" class="tasks">Task list</a>
            <a href="" class="profile">Profile</a>
            <a href="" class="stats">Statistics</a>
        </div>
        <!-- <div class="notes">
            <div class="note"><div class="shape completed"></div> completed</div>
            
            <div class="note"><div class="shape pending"></div> pending</div>
            <div class="note"><div class="shape late"></div> late</div>
            <div class="note"><div class="shape overdue"></div> overdue</div>
        </div> -->
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