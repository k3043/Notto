<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/component.css">
    <link rel="stylesheet" href="/css/admin.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css'>
    <title>Admin Panel</title>
</head>
<body>
@if (session('success'))
    <div class="alert autodis3s success bottom-right shadow0">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert autodis3s error bottom-right shadow0">
        {{ session('error') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert autodis3s error bottom-right shadow0">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="header">
    <div class="admin-info">
        <!-- <span class="admin-name">{{ Auth::user()->name }}</span> -->
        <img src="/images/adminava.png" alt="Admin Avatar"> 
    </div>
    <form action="/logout" method="POST">
        @csrf
        <button type="submit" class="logout-btn">Logout</button>
    </form>
</div>

<div class="container">
    <h1>User Management</h1>
    <table class="user-tbl">
        <tr>
            <th>Id</th>
            <th>User Name</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
        @foreach($users as $user)
        <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td class="role">
                <button type="button" class="open-noti" uid="{{$user->id}}">Delete</button>
            </td>
        </tr>
        @endforeach
    </table>
</div>

<script src='/js/noti.js'></script>
<script src="/js/component.js"></script>
</body>
</html>
