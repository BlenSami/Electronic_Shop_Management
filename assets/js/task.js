function fetchTask() {
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "../controller/TaskController.php/get-all-task", true);
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      var tasks = JSON.parse(xhr.responseText);
      renderTasks(tasks);
    }
  };
  xhr.send();
}

function renderTasks(tasks) {
  tasks.forEach((task) => {
    var taskItemDiv = document.createElement("div");
    taskItemDiv.classList.add("task-item");

    var heading = document.createElement("h3");
    heading.textContent = "Description";

    var paragraph = document.createElement("p");
    paragraph.textContent = task.description;

    taskItemDiv.appendChild(heading);
    taskItemDiv.appendChild(paragraph);

    var container = document.getElementById("task-container");
    container.appendChild(taskItemDiv);
  });
}

window.onload = function () {
  fetchTask();
};
