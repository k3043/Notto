@extends('layout.layout2')
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
<link rel="stylesheet" href="./css/createTask.css">
<style>
    .container{
        transform: translateY(0%);
    }
</style>
<div class="container">
    <h1>Create a new task for others</h1>
    <form action="/assignTask" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="title">Task assignee email</label>
            <input type="email" id="title" name="email" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" rows="4" required></textarea>
        </div>
        <div class="form-group">
            <label for="deadline">Deadline</label>
            <input type="datetime-local" id="deadline" name="deadline" required>
        </div>
        <div class="form-group">
            <button type="submit">Create task</button>
        </div>
    </form>
</div>
@endsection