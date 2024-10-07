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

        <div class="notification-container">
        <div class="noti-btn" id="notification-bell">
            <i class="fa-solid fa-bell bell-icon"></i>
            <div class="number-of-noti" id="notification-count">0</div>
        </div>
        <!-- Danh sách thông báo thả xuống -->
        <div id="notification-dropdown">
            <ul id="notification-list" style="list-style: none; padding: 0; margin: 0;">
            @if(Auth::user()->notifications)
            @foreach(Auth::user()->notifications as $noti)
                <div class="notification-item {{ !$noti->read_at ? 'unread' : '' }}" >
                    <span class="notification-title" style="font-weight: bold;">{{ $noti->data['title'] }}</span>
                    <p>{{$noti->data['message']}}</p>
                    <span class="notification-time" style="color: #d270d2; font-weight:bold">{{ $noti->created_atdiffForHumans() }}</span>
            </div>
            @endforeach
            @endif
            </ul>
        </div>
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
<meta name="csrf-token" content="{{ csrf_token() }}">
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const bell = document.getElementById('notification-bell');
    const countSpan = document.getElementById('notification-count');
    const dropdown = document.getElementById('notification-dropdown');
    const notificationList = document.getElementById('notification-list');
    let dropdownVisible = false; // Biến trạng thái cho dropdown

    function loadUnreadNotifications() {
        fetch('/notifications')
            .then(response => response.json())
            .then(data => {
                const unreadCount = data.length;
                countSpan.style.display = unreadCount > 0 ? 'block' : 'none';
                countSpan.textContent = unreadCount;

                // notificationList.innerHTML = '';
                // data.forEach(notification => {
                //     const li = document.createElement('li');
                //     li.style.padding = '10px';
                //     li.style.borderBottom = '1px solid #ccc';
                //     li.innerHTML = `<strong>${notification.data.title}</strong>: ${notification.data.message}`;
                //     notificationList.appendChild(li);
                // });
            });
    }

    bell.addEventListener('click', () => {
        dropdownVisible = !dropdownVisible; // Chuyển đổi trạng thái
        dropdown.style.display = dropdownVisible ? 'block' : 'none'; // Hiển thị hoặc ẩn dropdown

        if (!dropdownVisible) {
            fetch('/notifications/mark-as-read', { method: 'POST' })
                .then(() => loadUnreadNotifications());
        }
    });
  
    // Ẩn dropdown khi nhấp ra ngoài
    document.addEventListener('click', (event) => {
        if (!bell.contains(event.target) && !dropdown.contains(event.target)) {
            dropdown.style.display = 'none';
            loadUnreadNotifications();
            dropdownVisible = false; // Đặt trạng thái về false khi ẩn
        }
    });

    loadUnreadNotifications();
});

</script>
<script>
    // Đặt CSRF token vào các yêu cầu Fetch
    window.onload = function () {
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        window.fetch = (function (originalFetch) {
            return function (url, options = {}) {
                options.headers = options.headers || {};
                options.headers['X-CSRF-TOKEN'] = token;
                return originalFetch(url, options);
            };
        })(window.fetch);
    };
</script>
<script src="/js/home.js"></script>
<script src="/js/component.js"></script>
</body>
</html>