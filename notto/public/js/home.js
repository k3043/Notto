
  // Select all task elements
const tasks = document.querySelectorAll('.wrap-task');

// Loop through each task
tasks.forEach(task => {
    // Get the task ID from the modal's data attribute
    const taskId = task.querySelector('.modal').getAttribute('data-task-id');

    // Get the corresponding modal for this task
    const modalClass = `.task-details-${taskId}`;
    const taskDetails = document.querySelector(modalClass);

    // Close button functionality for the specific modal
    const closeButton = taskDetails.querySelector('.close');
    closeButton.addEventListener('click', function(e) {
        e.stopPropagation();
        taskDetails.style.display = 'none';
    });

    // Close the modal when clicking outside the modal content
    window.addEventListener('click', function(event) {
        if (event.target === taskDetails) {
            taskDetails.style.display = 'none';
        }
    });

    // When the task is clicked, show the corresponding modal
    task.addEventListener('click', function () {
        taskDetails.style.display = 'block';
    });
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


