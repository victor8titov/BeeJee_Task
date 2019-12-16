import requestToServer from './requestToServer';

const admin = {
    buffer: undefined,
    currentTask: undefined,
    add() {
        if (!flagAdmin) return;
        if (!this.card.target) this.init(); 
        this.cleaningBuffer();
        
        document.querySelectorAll('.task').forEach((elm)=>elm.addEventListener('click',this.EventClickTask));
        
    }, // end add();
    remove() {
        document.querySelectorAll('.task').forEach((elm)=>elm.removeEventListener('click',this.EventClickTask));
        this.hiddenAdminMenu();
    },
    init() {
        this.card.init();
        this.addEvents();
    },
    showAdminMenu() {
        const classList = document.querySelector('.admin-menu').classList;
        classList.remove('d-none');
        classList.add('d-flex');
    },
    hiddenAdminMenu() {
        const classList = document.querySelector('.admin-menu').classList;
        classList.remove('d-flex');
        classList.add('d-none');
    },
    addEvents() {
        this.EventClickTask = this.EventClickTask.bind(this);
        this.EventCancel = this.EventCancel.bind(this);
        this.EventSave = this.EventSave.bind(this);
        this.EventChange = this.EventChange.bind(this);
        this.EventDeleteTask = this.EventDeleteTask.bind(this);
        this.EventSaveToServer = this.EventSaveToServer.bind(this);
        //this.EventCancelSaveToServer = this.EventCancelSaveToServer.bind(this);

        this.card.target.querySelector('#create-task__button-cancel').addEventListener('click',this.EventCancel);
        this.card.target.querySelector('#create-task__button-save').addEventListener('click',this.EventSave);
        this.card.target.querySelector('#create-task__button-delete').addEventListener('click',this.EventDeleteTask);
        this.card.target.querySelectorAll('#create-task__name, #create-task__email, #create-task__task, #create-task__status').forEach((e)=>e.addEventListener('change',this.EventChange));

        document.querySelector('#admin-menu__button-save').addEventListener('click',this.EventSaveToServer);
        document.querySelector('#admin-menu__button-cancel').addEventListener('click',this.EventCancelSaveToServer);
    },
    EventClickTask(e) {
            this.currentTask = e.currentTarget;
            const regExp = /Выполнено/;
            const data = {
                name: this.currentTask.querySelector('.task__name').innerText,
                email: this.currentTask.querySelector('.task__email').innerText,
                task: this.currentTask.querySelector('.task__task').innerText,
                status: regExp.test( this.currentTask.querySelector('.task__status').innerText),
                id: this.currentTask.id,
                admin_create: undefined,
            };
            this.card.show(data);
    },
    EventSaveToServer (e) {
        const promise = requestToServer('/main/savetoserver/',this.buffer,'post',true);
        promise.then(
            (tasks)=>{
                this.insertTasks(tasks);
            },
            (ms)=>{
                console.log(ms);
            }
        )
    },
    EventCancelSaveToServer (e) {},
    EventSave (e) {
        const id = this.card.cardData.id;
        const cardData = this.card.cardData;
        const inputData = this.card.inputData;

        for (let prop  in cardData) {
            if (prop === 'id') continue;

            if (inputData[prop] !== cardData[prop]) {
                if (!this.buffer.hasOwnProperty(id) ) this.buffer[id]={};
                this.buffer[id][prop] = cardData[prop];
                
                if (prop === 'name' || prop ==='email' || prop ==='task' ) {
                    let selector = '.task__'+prop;
                    this.currentTask.querySelector(selector).innerText = cardData[prop];
                }

                if (prop === 'status') {
                    
                    let ms = cardData[prop] ? 'Выполнено' : 'Не выполнено';
                    this.currentTask.querySelector('.task__status').innerHTML = `<span class="font-weight-bold ">Статус: </span>${ms}</p>`
                }

                this.buffer[id].admin_create = true;
                
            }
        }
        this.card.hidden();
    },
    EventCancel (e) {
        this.card.hidden();
    },
    EventDeleteTask (e) {
        const id = this.card.cardData.id;
        if (!this.buffer.hasOwnProperty(id) ) this.buffer[id]={};
        this.buffer[id].delete = true;
        this.currentTask.classList.add('delete');
        this.card.hidden();
        
    },
    EventChange (e) {
        name = e.target.name;
        if (name === 'status') {
            this.card.cardData[name] = e.target.checked; 
            return
        }
        this.card.cardData[name] = e.target.value;
    },
    
    card: {
        target: undefined,
        cardData: undefined,
        inputData: undefined,
        init() { this.target=document.querySelector('.create-task'); },
        show(data) {
            this.target.classList.add('d-block');
            this.inputData = data;
            this.cardData = Object.assign({},data);
            this.addData();
        },
        hidden() {
            this.cleaningCard();
            this.target.classList.remove('d-block');
            admin.currentTask = undefined;

            if ( Object.keys(admin.buffer).length ) admin.showAdminMenu();
            console.log(admin.buffer);

        },
        addData(){
            const data = this.cardData;
            this.target.querySelector('#create-task__name').value = data.name;
            this.target.querySelector('#create-task__email').value = data.email;
            this.target.querySelector('#create-task__task').value = data.task;
            this.target.querySelector('#create-task__status').checked = data.status;
        },
        cleaningCard() {
            this.target.querySelector('#create-task__name').value = '';
            this.target.querySelector('#create-task__email').value = '';
            this.target.querySelector('#create-task__task').value = '';
            this.target.querySelector('#create-task__status').checked = false;

            this.cardData = undefined;
            this.inputData = undefined;
        }
    },
    cleaningBuffer() {
        this.buffer = {};
    }

    




}
export default admin;