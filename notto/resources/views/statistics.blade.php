@extends('layout.layout2')
@section('content')
<head>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        wrap-charts {
            font-family: Arial, sans-serif;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: end;
            gap: 30px;
        }
        .chart-container1 {
            flex: 2;
        }
        .chart-container2 {
            flex: 3;
        }
    </style>
</head>
<h1 align = 'center'>Statistics</h1>
<wrap-charts>
    
    <!-- Biểu đồ tròn -->
    <div class="chart-container chart-container1">
        <h3 align = 'center'>Task status</h3>
        <canvas id="pieChart"></canvas>
    </div>

    <!-- Biểu đồ cột -->
    <div class="chart-container chart-container2">
        <h3 align = 'center'>Task status category</h3>
        <canvas id="barChart"></canvas>
    </div>
        <div id="data" total = {{$total}} lated = {{$lated}} completed = {{$completed}} overdue = {{$overdue}} ontime = {{$ontime}} pending = {{$pending}} ></div>
    <script>
        // Dữ liệu giả lập cho biểu đồ
        const data = document.getElementById('data');
        
        const totalTasks = data.getAttribute('total');// Tổng số task
        const completedTasks = data.getAttribute('completed'); // Task đã hoàn thành
        const pendingTasks = data.getAttribute('pending');
        const uncompletedTasks = totalTasks - completedTasks; // Task chưa hoàn thành

        const completedOnTime = data.getAttribute('ontime'); // Task hoàn thành đúng hạn
        const completedLate = data.getAttribute('lated'); // Task hoàn thành trễ
        const overdueTasks = data.getAttribute('overdue'); // Task đã quá hạn
        const notStartedTasks = pendingTasks; // Task chưa hoàn thành

        // Biểu đồ tròn - Tình trạng công việc
        const pieCtx = document.getElementById('pieChart').getContext('2d');
        new Chart(pieCtx, {
            type: 'pie',
            data: {
                labels: ['Completed', 'Incompleted'],
                datasets: [{
                    label: 'Task status',
                    data: [completedTasks, uncompletedTasks],
                    backgroundColor: ['#36A2EB', '#FF6384'],
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                const percentage = (tooltipItem.raw / totalTasks * 100).toFixed(2);
                                return `${tooltipItem.label}: ${tooltipItem.raw} (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        });

        // Biểu đồ cột - Chi tiết hoàn thành công việc
        const barCtx = document.getElementById('barChart').getContext('2d');
        new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: ['Completed on time', 'Lated', 'Pending', 'Overdue'],
                datasets: [{
                    label: 'Number of tasks',
                    data: [completedOnTime, completedLate, notStartedTasks, overdueTasks],
                    backgroundColor: ['#8dce8f', '#e4a81b', '#cad2d6', '#dd4141'],
                    borderColor: ['#8dce8f', '#e4a81b', '#cad2d6', '#dd4141'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return `${tooltipItem.label}: ${tooltipItem.raw} tasks`;
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Statuses'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Number of tasks'
                        }
                    }
                }
            }
        });
    </script>
</wrap-charts>
<div class="note" style="margin-left:40%; padding-bottom:100px"><span style="font-size: 18px; font-weight: bold; color:orange">NOTE</span>&bull; Incompleted = Pending + Overdue <br>&bull; Completed = Lated + Completed on time</div>
@endsection