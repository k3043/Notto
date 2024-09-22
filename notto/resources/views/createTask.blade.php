
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create task</title>
    <link rel="stylesheet" href="./css/createTask.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <a href='/' class="back"><i class="fa-solid fa-arrow-left"></i></a>
<div class="container">
    <h1>Create a new task</h1>
    <form action="/tasks/store" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" required>
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

</body>
</html>
