@extends('layout.layout2')
<link rel="stylesheet" href="/css/profile.css"> 
<link rel="stylesheet" href="/css/component.css"> 
@section('content')
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
<div class="user-info">
    <div class="user-ava"> <img src="{{Auth::user()->avatar?Auth::user()->avatar:'/images/defaultava.jpg'}}" alt=""></div>
    <div class="wrap-text-info">
        <div class="name">{{$user->name}}</div>
        <div class="email">{{$user->email}}</div>
        <div class="id">ID: {{$user->id}}</div>
    </div>
    
</div>
<form action="/profile/update" method="post" class="edit-form">
        @csrf
       <h2>User name</h2>
        <input type="text" value='{{$user->name}}' name="name">
        
        <button type="submit">Save</button>
    </form>
@endsection