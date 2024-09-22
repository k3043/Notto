@extends('layout.layout')
@section('content')
@if (session('success'))
        <div class="alert autodis3s success top-right shadow0">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert autodis3s success top-right shadow0">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert autodis3s success top-right shadow0">
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
                  <script id="tasks-data" type="application/json">
                        {!! json_encode($tasks) !!}
                    </script>
                    <div class="day-column" id="day-1"></div>
                    <div class="day-column" id="day-2"></div>
                    <div class="day-column" id="day-3"></div>
                    <div class="day-column" id="day-4"></div>
                    <div class="day-column" id="day-5"></div>
                    <div class="day-column" id="day-6"></div>
                    <div class="day-column" id="day-0"></div>
                  </div>
                </div>     
              </div>
        </div>
@endsection