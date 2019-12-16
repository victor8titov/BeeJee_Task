import requestToServer from './functions/requestToServer';
import admin from './functions/admin';
import pagination from './functions/pagination';

main();

function main() {
    const filter = document.getElementById('main__filter');
    filter.addEventListener('submit',(e)=>{
        e.preventDefault();
        const config = {
            type: filter.type.value,
            direction: filter.direction.value,
            status: filter.status.checked,
            admin_create: filter.admin_create.checked
        }
        requestTasks(config);
    });

    function requestTasks(config) {
        config = config || {
                                type: 'undefined',
                                direction: 'on_increase',
                                status: false,
                                admin_create: false
                            };
        
        // запрашиваю задачи с настройками фильтра
        console.log('запрашиваем main/tasks')
        const promise = requestToServer('/main/tasks/',config);
        promise.then(
            (tasks)=>{
                insertTasks(tasks);
            },
            (ms)=>{
                console.log(ms);
            }
        )
    }

    function insertTasks(tasks) {
        const n = document.querySelector('.main__tasks');
        if (n) { pagination.remove(); admin.remove(); n.parentNode.removeChild(n); }
        
        document.querySelector('.main__filter').insertAdjacentHTML('afterend',tasks);
        pagination.add();
        admin.add();
    }
    
    admin.EventCancelSaveToServer = requestTasks;
    admin.insertTasks = insertTasks;
    requestTasks();
}



