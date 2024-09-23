@extends('layout.layout')
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

<div class="scroll-view">
            <div class="timetable-container">
                <div class="weekdays">
                    <div class="time-label"></div> 
                    <?php foreach ($weekdays as $weekday): ?>
                        <div class="day-label">
                            <div class="day-name"><?php echo $weekday['name']; ?></div>
                            <div class="day-date"><?php echo $weekday['date']; ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
              
                <div class="timetable" id="timetable">
                  <!-- Cột thời gian từ 0h đến 23h -->
                  <div class="time-column">
                    <div class="time">00:00</div>
                    <div class="time">01:00</div>
                    <div class="time">02:00</div>
                    <div class="time">03:00</div>
                    <div class="time">04:00</div>
                    <div class="time">05:00</div>
                    <div class="time">06:00</div>
                    <div class="time">07:00</div>
                    <div class="time">08:00</div>
                    <div class="time">09:00</div>
                    <div class="time">10:00</div>
                    <div class="time">11:00</div>
                    <div class="time">12:00</div>
                    <div class="time">13:00</div>
                    <div class="time">14:00</div>
                    <div class="time">15:00</div>
                    <div class="time">16:00</div>
                    <div class="time">17:00</div>
                    <div class="time">18:00</div>
                    <div class="time">19:00</div>
                    <div class="time">20:00</div>
                    <div class="time">21:00</div>
                    <div class="time">22:00</div>
                    <div class="time">23:00</div>
                    <div class="time"></div>
                  </div>
              
                  <div class="days-grid">
    @foreach($weekdays as $weekday)
        @php
            // Ensure that Sunday (day-0) is placed first
            $dayIndex = $weekday['name'] === 'Sun' ? 0 : $loop->index + 1;
        @endphp
        <div class="day-column" id="day-{{ $dayIndex }}">
            <div class="day-tasks">
                @for($hour = 0; $hour < 24; $hour++)
                    <div class="hour-grid"></div>
                @endfor
                
                @if(isset($tasks[$weekday['fullDate']]))
                    @foreach($tasks[$weekday['fullDate']] as $task)
                    <div id="task-details" class="modal">
                            <div class="modal-content">
                                <span class="close">&times;</span>
                                <h2 id="task-title">{{$task->title}}</h2>
                                <p id="task-description">{{$task->description}}</p>
                                <p id="task-deadline">{{$task->deadline}}</p>
                                @if($task->isFinished())
                                    <form action="/tasks/markAsUnfinished/{{ $task->id}}" method="POST" style="display:inline">
                                        @csrf
                                        <button type="submit" class="mark-done"><i class="fa-solid fa-circle-check"></i></button>
                                    </form>
                                @else
                                    <form action="/tasks/markAsDone/{{ $task->id}}" method="POST" style="display:inline">
                                        @csrf
                                        <button type="submit" class="mark-done"><i class="fa-regular fa-circle-check"></i></button>
                                    </form>
                                @endif
                                <div class="btns-group">    
                                    <a href="/tasks/edit/{{$task->id}}"  class="edit-task" id="edit-task">Edit</a>
                                    <a href="/tasks/delete/{{$task->id}}" class="delete-task" id="delete-task">Delete</a>
                                </div>
                            </div>
                        </div>
                        @php
                            $deadline = \Carbon\Carbon::parse($task->deadline);
                            $position = ($deadline->hour * 60 + $deadline->minute)*2/3 +19; // Position based on time
                        @endphp
                        <!-- <?php  $color = 'gray' ?>
                        @if ($task->status == 'pending') $color = 'gray'
                        @elif ($task->status == 'completed') $color = 'green'
                        @else $color = 'red'
                        @endif -->
                        <div class="task {{$task->status}}" style="top: {{ $position }}px">
                       
                            {{$task->title}}, {{ $deadline->format('H:i') }}
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    @endforeach
</div>

              </div>
        </div>
@endsection