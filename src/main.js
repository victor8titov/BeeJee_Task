import requestToServer from './index';

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
        if (n) n.parentNode.removeChild(n);
        document.querySelector('.main__filter').insertAdjacentHTML('afterend',tasks);
    }

    requestTasks();
}


main();

