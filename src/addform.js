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
        const request = requestToServer('/addform',data,'POST');
        request.then(
            (ms)=>{
                console.log('good request',ms)
                DomMessage(ms,null,'alert-primary');
                e.target.reset();
            },
            (ms)=>{
                console.log('bad request ', ms)
                DomMessage('Ошибка при передачи данных на сервер!',ms,'alert-danger');
            }
        )

    });


    const DomMessage = (title,description=undefined,className) => {
        //console.log(document.querySelector('.add__message'))
        const block_message = document.querySelector('.add__message');
        
        block_message.classList.add(className);
        block_message.classList.add('o-1');

        block_message.querySelector('.add__title').innerHTML = title;
        if (description !== undefined) block_message.querySelector('.add__description').innerHTML = description;


        setTimeout(()=>{
            block_message.classList.remove('o-1');
        },4000)
    }
}


    addForm();

