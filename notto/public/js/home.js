// const tasks = [
//     { title: "Task 1", dueTime: "10:25", day: 1 }, // Task cho Thứ 2
//     { title: "Task 2", dueTime: "14:45", day: 2 }, // Task cho Thứ 3
//     { title: "Task 4", dueTime: "10:00", day: 1 }, // Task cho Thứ 2
//     { title: "Task 5645646 fsfdf  sfsf s  sfsdf ", dueTime: "7:00", day: 2 }, 
//     { title: "Task 6", dueTime: "16:00", day: 2 }, 
//   ];
const tasksData = document.getElementById('tasks-data').textContent;
const tasks = JSON.parse(tasksData);
console.log(tasks);
  // time -> pixels
  function timeToPosition(deadline) {
    if (!deadline) {
        console.error('Invalid deadline:', deadline);
        return 0; // Trả về giá trị mặc định khi không có thời gian hợp lệ
    }

    // Chuyển đổi deadline thành đối tượng Date
    const date = new Date(deadline);
    
    // Lấy giờ và phút
    const hours = date.getHours();
    const minutes = date.getMinutes();

    const totalMinutes = hours * 60 + minutes;
    const pixelPerMinute = 2 / 3;
    return totalMinutes * pixelPerMinute + 19;
}
  
  // render task
  function renderTasks() {
    for (let day = 0; day <= 6; day++) {
        const dayColumn = document.getElementById(`day-${day}`);
        
        for (let hour = 0; hour < 24; hour++) {
          const hourGrid = document.createElement('div');
          hourGrid.className = 'hour-grid';
          dayColumn.appendChild(hourGrid);
        }
      }
    tasks.forEach(task => {
        console.log('Rendering task:', task);

        // Chuyển đổi deadline thành đối tượng Date
        const date = new Date(task.deadline);
        
        // Lấy ngày trong tuần (0 - Chủ nhật, 1 - Thứ hai, ..., 6 - Thứ bảy)
        const taskDay = date.getDay(); // taskDay sẽ là số từ 0 đến 6

        const dayColumn = document.getElementById(`day-${taskDay}`);
        if (!dayColumn) {
            console.error('Day column not found for day:', taskDay);
            return; // Ngừng xử lý nếu không tìm thấy cột ngày
        }
      const taskElement = document.createElement('div');
      taskElement.className = 'task';
      taskElement.textContent = task.title;
      taskElement.style.top = `${timeToPosition(task.deadline)}px`;
      taskElement.style.height = '30px'; 
  
      // Thêm task vào cột ngày tương ứng
      dayColumn.appendChild(taskElement);
    });
  }
  const showhideBtn = document.querySelector('.show-hide-btn')
  const navBar = document.querySelector('.navbar');
  const createText = document.getElementById('createText');
  showhideBtn.onclick = function() {
    createText.classList.toggle('hideText');
    navBar.classList.toggle('hide');
};

const createBtn = document.querySelector('.create-btn');
const options = document.querySelector('.create-options');
createBtn.onclick = function (){
    options.classList.toggle('showOption');
}
// Hàm để cập nhật ngày trong tuần


// Gọi hàm để cập nhật khi trang được tải
  window.onload = renderTasks;
  