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
            <a href="/" class="topbar-day">Today</a>
            <div class="topbar-buttons">
                <a  href="/?date=<?php echo $currentDate->copy()->subWeek()->format('Y-m-d H:i:s'); ?>" class="topbar-btn-left topbar-btn"><i class="fa-solid fa-angle-left"></i></a>
                <a  href="/?date=<?php echo $currentDate->copy()->addWeek()->format('Y-m-d H:i:s'); ?>" class="topbar-btn-right topbar-btn"><i class="fa-solid fa-angle-right"></i></a>
            </div>
            <div class="topbar-month-year"> {{$currentDate->month}}, {{$currentDate->year}}</div>
        </div>

        <div class="wrap-search">
            <form action="/search" method = "post">@csrf
            <div class="wrap2">
                <input type="text" class="search" placeholder="search..." name = "keyword">  
                <button type="submit" class="search-icon"><i class="fa fa-search"></i></button> 
            </div>
            </form>
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
            <a href="/profile/{{Auth::user()->id}}" class="profile">Profile</a>
            <a href="/statistics" class="stats">Statistics</a>
        </div>
        <!-- <div class="notes">
            <div class="note"><div class="shape completed"></div> completed</div>
            
            <div class="note"><div class="shape pending"></div> pending</div>
            <div class="note"><div class="shape late"></div> late</div>
            <div class="note"><div class="shape overdue"></div> overdue</div>
        </div> -->
    </div>
    @if(session('result'))
    <div class="search-result-container">
        <i class="close-button fa-solid fa-xmark"></i>
        <h2 class="text">Result for "{{ session('keyword')}}"</h2>
         
        <div class="search-result"> 
            @if(count(session('result')) == 0)
                <p style="margin-top: 10px;">Task not found !</p>
            @else
                @foreach(session('result') as $task)
                    <div class="task-result">
                    <div class="button-container">
                    @if($task->isFinished())
                        <form action="/tasks/markAsUnfinished/{{ $task->id }}" method="POST" style="display:inline" class='mark-done2'>
                            @csrf
                            <button type="submit" >
                                <i class="fa-solid fa-circle-check" style="color:#8dce8f;"></i>
                            </button>
                        </form>
                    @else
                    <form action="/tasks/markAsDone/{{ $task->id }}" method="POST" style="display:inline" class='mark-done2'>
                            @csrf
                            <button type="submit" >
                                <i style="color:#8dce8f;" class="fa-regular fa-circle-check"></i>
                            </button>
                        </form>
                    @endif

                    <form action="/tasks/delete/{{ $task->id }}" method="POST" style="display:inline" class='delete-task'>
                        @csrf
                        @method('DELETE')
                        <button type="submit" >
                            <i style="color:#e57373;" class="fa-solid fa-trash"></i>
                        </button>
                    </form>

                    <form action="/tasks/edit/{{ $task->id }}" method="GET" style="display:inline" class='edit-task'>
                        @csrf
                        <button type="submit" >
                            <i style="color:#2196F3;" class="fa-solid fa-pencil-alt"></i>
                        </button>
                    </form>
                </div>

                         
                        <h3 class="title">{{$task->title}}</h3>
                        <div class="deadline">Deadline: {{$task->deadline}}</div>
                        <div class="status">""{{$task->status}}""</div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <script>
        const close = document.querySelector('.close-button');
        const frame = document.querySelector('.search-result-container');
        close.onclick = function (){
            frame.style.display = 'none'
        }
    </script>
    @endif
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