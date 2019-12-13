import requestToServer from './index';

function authorization() {
    const form = document.getElementById('authorization__form');
    form.addEventListener('submit',(e)=>{
        e.preventDefault();
        const data = {
            login: form.authorization__login.value,
            password: form.authorization__password.value,
        };
        // Отправка формы на сервер 
        const request = requestToServer('/authorization/enter/',data,'POST');
        request.then(
            (ms)=>{
                console.log('login!',ms)
                DomMessage_authorization(ms,null,'alert-primary');
                e.target.reset();
            },
            (ms)=>{
                console.log('bad', ms)
                DomMessage_authorization('Ошибка при передачи данных на сервер!',ms,'alert-danger');
            }
        )

    });


    const DomMessage_authorization = (title,description=undefined,className) => {
        //console.log(document.querySelector('.add__message'))
        const block_message = document.querySelector('.authorization__message');
        
        block_message.classList.add(className);
        block_message.classList.add('o-1');

        block_message.querySelector('.authorization__title').innerHTML = title;
        if (description !== undefined) block_message.querySelector('.authorization__description').innerHTML = description;


        setTimeout(()=>{
            block_message.classList.remove('o-1');
        },4000)
    }
}


    authorization();
