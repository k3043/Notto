const tasks = [
    { title: "Task 1", dueTime: "10:25", day: 1 }, // Task cho Thứ 2
    { title: "Task 2", dueTime: "14:45", day: 2 }, // Task cho Thứ 3
    { title: "Task 4", dueTime: "10:00", day: 1 }, // Task cho Thứ 2
    { title: "Task 5645646 fsfdf  sfsf s  sfsdf ", dueTime: "7:00", day: 2 }, 
    { title: "Task 6", dueTime: "16:00", day: 2 }, 
  ];
  
  // time -> pixels
  function timeToPosition(time) {
    const [hours, minutes] = time.split(':').map(Number);
    const totalMinutes = hours * 60 + minutes;
    const pixelPerMinute = 2/3; 
    return totalMinutes * pixelPerMinute +19;
  }
  
  // render task
  function renderTasks() {
    for (let day = 1; day <= 7; day++) {
        const dayColumn = document.getElementById(`day-${day}`);
        
        for (let hour = 0; hour < 24; hour++) {
          const hourGrid = document.createElement('div');
          hourGrid.className = 'hour-grid';
          dayColumn.appendChild(hourGrid);
        }
      }
    tasks.forEach(task => {
      const dayColumn = document.getElementById(`day-${task.day}`);
      const taskElement = document.createElement('div');
      taskElement.className = 'task';
      taskElement.textContent = task.title;
      taskElement.style.top = `${timeToPosition(task.dueTime)}px`;
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

  window.onload = renderTasks;
  