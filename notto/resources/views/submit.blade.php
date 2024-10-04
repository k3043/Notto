<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submission</title>
    <link rel="stylesheet" href="/css/taskForOthers.css"> 
</head>
<body>
<div class="container">
    <h2>Submission</h2>
    <form action="/submit/{{$task->id}}" method="POST">
        @csrf
        <div id="link-container">
            <div class="form-group">
                <label for="link-1">Link #1</label>
                <input type="text" name="links[]" id="link-1" placeholder="Enter link...">
                <button style="margin-left: 10px;" type="button" id="add-link">+</button>
            </div>
        </div>
        <div class="form-group">
            <button type="submit">Submit</button>
        </div>
    </form>
</div>

<script>
    // Thêm nút để thêm nhiều trường link
    document.getElementById('add-link').addEventListener('click', function() {
        const linkContainer = document.getElementById('link-container');
        const linkCount = linkContainer.querySelectorAll('.form-group').length;

        // Tạo div mới cho một link mới
        const newDiv = document.createElement('div');
        newDiv.classList.add('form-group');

        // Tạo nhãn cho link mới
        const newLabel = document.createElement('label');
        newLabel.setAttribute('for', `link-${linkCount + 1}`);
        newLabel.textContent = `Link #${linkCount + 1}`;

        // Tạo input cho link mới
        const newInput = document.createElement('input');
        newInput.setAttribute('type', 'text');
        newInput.setAttribute('name', 'links[]');
        newInput.setAttribute('id', `link-${linkCount + 1}`);
        newInput.setAttribute('placeholder', 'Enter link...');

        // Tạo nút xóa để xóa link mới
        const removeButton = document.createElement('button');
        removeButton.textContent = 'X';
        removeButton.classList.add('remove-button');
        removeButton.type = 'button';

        // Gán sự kiện xóa cho nút xóa
        removeButton.addEventListener('click', function() {
            linkContainer.removeChild(newDiv);
        });

        // Thêm nhãn, input và nút xóa vào div mới
        newDiv.appendChild(newLabel);
        newDiv.appendChild(newInput);
        newDiv.appendChild(removeButton);

        // Thêm div mới vào container
        linkContainer.appendChild(newDiv);
    });
</script>

</body>
</html>
