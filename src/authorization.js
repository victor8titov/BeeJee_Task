import  requestToServer from './index';


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
                if (ms) {
                    console.log(ms)
                    DomMessage_authorization('Ошибка авторизации',ms,'alert-danger');
                    return;
                }
                window.location.href="/";
            },
            (ms)=>{
                console.log(ms)
                DomMessage_authorization('Ошибка при передачи данных на сервер!',ms,'alert-danger');
            }
        )

    });


    const DomMessage_authorization = (title,description=undefined,className) => {
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
