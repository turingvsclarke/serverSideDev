import tasks from 'server.js';

let tasksContainer=document.getElementById('task-list');

tasks.forEach(x=>{
    tasksContainer.innerHTML+="<li>"+x+"</li>";
})