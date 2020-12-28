const clear = document.querySelector(".clear");
const dateElement = document.getElementById("date");
const list = document.getElementById("list");
const input = document.getElementById("input");
const enter = document.getElementById("enter")

//classes
const check = "fa-check-circle";
const uncheck = "fa-circle-thin";
const lineThrough = "lineThrough";//this lives in the css file

//variables
let LIST =[], id=0;
//show today's date
const options = {weekday:"long", month:"short", day:"numeric"};
const today = new Date();
dateElement.innerHTML = today.toLocaleDateString("en-US", options)

//add to do funtion
function addToDo(toDo, id, done, trash){

    if(trash){ return; }
    
    const DONE = done ? check : uncheck;
    const LINE = done ? lineThrough : "";
    const item = `<div>
              <li id="item">
                <i class="fa ${DONE}" job="complete" id="${id}"></i>
                <p class="text ${LINE}">${toDo}</p>
                <i class="fa fa-trash" job="delete" id="${id}"></i>
              </li>
              </div>
            `;
     const position = "beforeend";
     list.insertAdjacentHTML(position, item);
}; 
//add an item to the list using the enter key
document.addEventListener("keyup", function(event){
    if(event.keyCode == 13){
        const toDo = input.value;
        //if the input isn't empty
        if(toDo){
        addToDo(toDo, id, false, false);
        LIST.push({
            name:toDo,
            id:id,
            done:false,
            trash:false
        });
        id++;
        };
        input.value = "";
    };
});

//complete to do
function completeToDo(element){
    element.classList.toggle(check);
    element.classList.toggle(uncheck);
    element.parentNode.querySelector(".text").classList.toggle(lineThrough)

    LIST[element.id].done = LIST[element.id].done ? false : true
}

//remove to do
function removeToDo(element){
    element.parentNode.parentNode.removeChild(element.parentNode); 
    LIST[element.id].trash = true;
}

//target the items created dynamically
list.addEventListener("click", function(event){
    const element = event.target;
    const elementJob = element.attributes.job.value;

    if(elementJob == "complete"){
        completeToDo(element);
    }
    else if(elementJob == "delete"){
        removeToDo(element);

    }

    }
)
//entering the values of the input using the plus icon
enter.addEventListener("click", function(event){
    const toDo = input.value;
        //if the input isn't empty
        if(toDo){
        addToDo(toDo, id, false, false);
        LIST.push({
            name:toDo,
            id:id,
            done:false,
            trash:false
        });
        id++;
        };
        input.value = "";
});


