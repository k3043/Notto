@extends('layout.layout2')
<link rel="stylesheet" href="/css/tasks.css"> 
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
<div class="wrap-options">
    <p class="type1 task-type">All tasks</p>
    <p class="type2 task-type">Completed tasks</p>
    <p class="type3 task-type">Incompleted tasks</p>
    <p class="type4 task-type">Overdue Tasks</p>
</div>
<div class="wrap-tbl">
    <table id="table1" class="task-tbl1 task-tbl">
    <tr>
        <th style="width:50%;border-right: 1px solid grey;">Task</th>
        <th>Due date</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>
    @foreach($tasks as $task)
    <tr  class="task-line">
        <td class="td-taskname">{{ $task->title }}</td>
        <td>{{ $task->deadline?$task->deadline:"no due date" }}</td>
        <td>{{ $task->status }}</td>
        <td>
            
        
            <a href="/tasks/edit/{{$task->id}}"><i class="fa-solid fa-edit"></i></a>
                <form action="/tasks/delete/{{ $task->id}}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"><i class="fa-solid fa-trash-can"></i></button>
                </form>
            
            @if($task->isFinished())
                <form action="/tasks/markAsUnfinished/{{ $task->id}}" method="POST" style="display:inline">
                    @csrf
                    <button type="submit" class="mark"><i class="fa-solid fa-circle-check"  style="color:#8dce8f"></i></button>
                </form>
            @else
                <form action="/tasks/markAsDone/{{ $task->id}}" method="POST" style="display:inline">
                    @csrf
                    <button type="submit" class="mark"><i class="fa-regular fa-circle-check"  style="color:#8dce8f"></i></button>
                </form>
            @endif
            
            <div class="task-details">
                <p class="task-details-title">{{$task->title}} - Description</p>
                <p class="task-details-des">{{$task->description}}</p>
                <div class="close-btn"><i class="fa-solid fa-xmark"></i></div>
            </div>
        </td>
    </tr>
    @endforeach
    </table >
    <table id="table2" class="task-tbl2 task-tbl">
    <tr>
        <th style="width:50%;border-right: 1px solid grey;">Task</th>
        <th>Due date</th>
        <th>Completed at</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    @foreach($completedTasks as $task)
    <tr  class="task-line">
        <td class="td-taskname" style="color: {{$task->status == 'late'?'red':'black'}}">{{ $task->title }}</td>
        <td style="color: {{$task->status == 'late'?'red':'black'}}">{{ $task->deadline}}</td>
        <td style="color: {{$task->status == 'late'?'red':'black'}}">{{ $task->updated_at }}</td>
        <td style="color: {{$task->status == 'late'?'red':'black'}}">{{ $task->status }}</td>
        <td>
         
            <a href="/tasks/edit/{{$task->id}}"><i class="fa-solid fa-edit"></i></a>
                <form action="/tasks/delete/{{ $task->id}}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"><i class="fa-solid fa-trash-can"></i></button>
                </form>
    
            @if($task->isFinished())
                <form action="/tasks/markAsUnfinished/{{ $task->id}}" method="POST" style="display:inline">
                    @csrf
                    <button type="submit" class="mark"><i class="fa-solid fa-circle-check" style="color:#8dce8f"></i></button>
                </form>
            @else
                <form action="/tasks/markAsDone/{{ $task->id}}" method="POST" style="display:inline">
                    @csrf
                    <button type="submit" class="mark"><i class="fa-regular fa-circle-check" style="color:#8dce8f"></i></button>
                </form>
            @endif
            
            <div class="task-details">
                <p class="task-details-title">{{$task->title}} - Description</p>
                <p class="task-details-des">{{$task->description}}</p>
                <div class="close-btn"><i class="fa-solid fa-xmark"></i></div>
            </div>
        </td>
    </tr>
    @endforeach
    </table >
    <table id="table3" class="task-tbl3 task-tbl">
    <tr>
        <th style="width:50%;border-right: 1px solid grey;">Task</th>
        <th>Due date</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    @foreach($incompletedTasks as $task)
    <tr  class="task-line">
        <td class="td-taskname">{{ $task->title }}</td>
        <td>{{ $task->deadline?$task->deadline:"no due date" }}</td>
        <td>{{ $task->status }}</td>
        <td>
            
          
            <a href="/tasks/edit/{{$task->id}}"><i class="fa-solid fa-edit"></i></a>
                <form action="/tasks/delete/{{ $task->id}}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"><i class="fa-solid fa-trash-can"></i></button>
                </form>
           
            @if($task->isFinished())
                <form action="/tasks/markAsUnfinished/{{ $task->id}}" method="POST" style="display:inline">
                    @csrf
                    <button type="submit" class="mark"><i class="fa-solid fa-circle-check" style="color:#8dce8f" ></i></button>
                </form>
            @else
                <form action="/tasks/markAsDone/{{ $task->id}}" method="POST" style="display:inline">
                    @csrf
                    <button type="submit" class="mark"><i class="fa-regular fa-circle-check" style="color:#8dce8f" ></i></button>
                </form>
            @endif
            
            <div class="task-details">
                <p class="task-details-title">{{$task->title}} - Description</p>
                <p class="task-details-des">{{$task->description}}</p>
                <div class="close-btn"><i class="fa-solid fa-xmark"></i></div>
            </div>
        </td>
    </tr>
    @endforeach
    </table >
    <table id="table4" class="task-tbl4 task-tbl">
    <tr>
        <th style="width:50%;border-right: 1px solid grey;">Task</th>
        <th>Due date</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    @foreach($overdueTasks as $task)
    <tr  class="task-line">
        <td class="td-taskname">{{ $task->title }}</td>
        <td>{{ $task->deadline?$task->deadline :"no due date" }}</td>
        <td>{{ $task->status }}</td>
        <td>
            
           
            <a href="/tasks/edit/{{$task->id}}"><i class="fa-solid fa-edit"></i></a>
                <form action="/tasks/delete/{{ $task->id}}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"><i class="fa-solid fa-trash-can"></i></button>
                </form>
           
            @if($task->isFinished())
                <form action="/tasks/markAsUnfinished/{{ $task->id}}" method="POST" style="display:inline">
                    @csrf
                    <button type="submit" class="mark"><i class="fa-solid fa-circle-check" style="color:#8dce8f" ></i></button>
                </form>
            @else
                <form action="/tasks/markAsDone/{{ $task->id}}" method="POST" style="display:inline">
                    @csrf
                    <button type="submit" class="mark"><i class="fa-regular fa-circle-check" style="color:#8dce8f" ></i></button>
                </form>
            @endif
            
            <div class="task-details">
                <p class="task-details-title">{{$task->title}} - Description</p>
                <p class="task-details-des">{{$task->description}}</p>
                <div class="close-btn"><i class="fa-solid fa-xmark"></i></div>
            </div>
        </td>
    </tr>
    @endforeach
    </table >


</div>

<script src="/js/tasks.js"></script>
@endsection