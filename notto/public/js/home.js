
// const tasksData = document.getElementById('tasks-data').textContent;
// const tasks = JSON.parse(tasksData);

  // time -> pixels
//   function timeToPosition(deadline) {
//     if (!deadline) {
//         console.error('Invalid deadline:', deadline);
//         return 0; 
//     }

//     // Chuyển đổi deadline thành đối tượng Date
//     const date = new Date(deadline);
    
//     const hours = date.getHours();
//     const minutes = date.getMinutes();

//     const totalMinutes = hours * 60 + minutes;
//     const pixelPerMinute = 2 / 3;
//     return totalMinutes * pixelPerMinute + 19;
// }
  
  // // render task
  // function renderTasks() {
  //   for (let day = 0; day <= 6; day++) {
  //       const dayColumn = document.getElementById(`day-${day}`);
        
  //       for (let hour = 0; hour < 24; hour++) {
  //         const hourGrid = document.createElement('div');
  //         hourGrid.className = 'hour-grid';
  //         dayColumn.appendChild(hourGrid);
  //       }
  //     }
  //   tasks.forEach(task => {

  //       // Chuyển đổi deadline thành đối tượng Date
  //       const date = new Date(task.deadline);

  //       const taskDay = date.getDay(); 

  //       const dayColumn = document.getElementById(`day-${taskDay}`);
  //       if (!dayColumn) {
  //           console.error('Day column not found for day:', taskDay);
  //           return;
  //       }
  //     const taskElement = document.createElement('div');
  //     taskElement.className = 'task';
  //     let deadlineDate = new Date(task.deadline);
  //     let hours = deadlineDate.getHours().toString().padStart(2, '0');
  //     let minutes = deadlineDate.getMinutes().toString().padStart(2, '0');
  //     taskElement.textContent = task.title + ', ' + hours + 'h' + minutes;
  //     taskElement.style.top = `${timeToPosition(task.deadline)}px`;
  
  //     // Thêm task vào cột ngày tương ứng
  //     dayColumn.appendChild(taskElement);
  //     taskElement.addEventListener('click', function() {
  //         // Hiển thị thông tin trong modal
  //         document.getElementById('task-title').textContent = task.title;
  //         document.getElementById('task-description').textContent = task.description;
  //         document.getElementById('task-deadline').textContent = 'Deadline: ' + task.deadline;
  
  //         // Hiển thị modal
  //         document.getElementById('task-details').style.display = 'block';
          
  //         document.getElementById('delete-task').addEventListener('click', function() {
  //           console.log(document.getElementById('delete-task'));
  //           window.location.href = `/tasks/delete/${task.id}`;
  //         });
  //         document.getElementById('edit-task').addEventListener('click', function() {
  //           window.location.href = `/tasks/edit/${task.id}`; 
  //         });
  //     });
  //   });
  // }
  const tasks =  document.querySelectorAll('.task');
  tasks.forEach(task => {
    task.onclick = function (){ 
      document.getElementById('task-details').style.display = 'block';
    }
  });
  const showhideBtn = document.querySelector('.show-hide-btn');
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
  // window.onload = renderTasks;

// Đóng modal khi nhấn vào nút "x"
document.querySelector('.close').addEventListener('click', function() {
    document.getElementById('task-details').style.display = 'none';
});

// Đóng modal khi nhấn ra ngoài modal
window.addEventListener('click', function(event) {
    const modal = document.getElementById('task-details');
    if (event.target == modal) {
        modal.style.display = 'none';
    }
});

