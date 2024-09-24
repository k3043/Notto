<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/component.css">
    <link rel="stylesheet" href="/css/admin.css">
    <title>Admin</title>
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
<div class="container">
<table class="user-tbl">
    <tr>
        <th>Id</th>
        <th>User name</th>
        <th>Email</th>
        <th></th>
    </tr>
    @foreach($users as $user)
    <tr>
        <td>{{$user->id}}</td>
        <td>{{$user->name}}</td>
        <td>{{$user->email}}</td>
        <td class="role">
            <form action="/delete/{{$user->id}}" method='post'>@csrf <button style="color:red">Delete</button></form>
        </td>
    </tr>
    @endforeach
</table>
</div>
<script src="/js/component.js"></script>
</body>
</html>