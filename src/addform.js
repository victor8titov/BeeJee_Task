import requestToServer from './functions/requestToServer';

function addForm() {
    const form = document.getElementById('add__form');
    form.addEventListener('submit',(e)=>{
        e.preventDefault();
        const data = {
            name: form.name.value,
            email: form.email.value,
            task: form.task.value,
            status: 'false',
            admincreate: 'false'
        };
        // Отправка формы на сервер 
        const request = requestToServer('/add/addtask',data,'POST');
        request.then(
            (ms)=>{
                console.log(ms);
                DomMessage(ms,null,'alert-primary');
                e.target.reset();
            },
            (ms)=>{
                console.log(ms);
                DomMessage('Ошибка при передачи данных на сервер!',ms,'alert-danger');
            }
        )

    });

    const DomMessage = (title,description=undefined,className) => {
        const block_message = document.querySelector('.add-message');
        
        block_message.classList.add(className);
        block_message.classList.add('o-1');

        block_message.querySelector('.add-message__title').innerHTML = title;
        if (description !== undefined) block_message.querySelector('.add-message__description').innerHTML = description;

        setTimeout(()=>{
            block_message.classList.remove('o-1');
        },10000)
    }
}


    addForm();

