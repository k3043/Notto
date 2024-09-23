<!DOCTYPE html>
<html>
<head>
    <title>Deadline Reminder</title>
</head>
<body>
    <h1>Reminder for Task: {{ $task->title }}</h1>
    <p>Your task is due on {{ $task->deadline }}.</p>
</body>
</html>
