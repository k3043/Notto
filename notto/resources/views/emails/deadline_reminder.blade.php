<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Pending Tasks for Today</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .email-container {
            max-width: 600px;
            background-color: #ffffff;
            margin: 0 auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #333;
            text-align: center;
            border-bottom: 2px solid #4CAF50;
            padding-bottom: 10px;
        }
        p {
            color: #555;
            font-size: 16px;
            line-height: 1.6;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table th, table td {
            padding: 12px;
            text-align: left;
        }
        table th {
            background-color: #4CAF50;
            color: white;
        }
        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        table tr:hover {
            background-color: #ddd;
        }
        .footer {
            text-align: center;
            color: #888;
            font-size: 12px;
            margin-top: 30px;
        }
        .footer a {
            color: #4CAF50;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <h2>Hello {{ $tasks[0]->user->name }},</h2>

        <p>You have the following <strong>pending</strong> tasks for today ({{ \Carbon\Carbon::today()->format('d/m/Y') }}):</p>

        @if($tasks->isEmpty())
            <p style="text-align: center; color: #ff0000;">You currently have no pending tasks for today.</p>
        @else
            <table border="0">
                <thead>
                    <tr>
                        <th>Task Name</th>
                        <th>Deadline</th>
                       
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $task)
                        <tr>
                            <td>{{ $task->title }}</td>
                            <td>{{ \Carbon\Carbon::parse($task->deadline)->format('H:i d/m/Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <p style="text-align: center;">Best regards,<br>Your Task Management System</p>

        <div class="footer">
            <p>&copy; {{ date('Y') }} Task Management System. All rights reserved.</p>
            <p>If you no longer wish to receive these emails, you can <a href="#">unsubscribe here</a>.</p>
        </div>
    </div>
</body>
</html>
