
const pagination =  {
    target: document.querySelector('.main__pagination'),
    previous: document.getElementById('pagination__previous'),
    next: document.getElementById('pagination__next'),
    domTasks: '',
    domDigitalA: '',
    currentList: 1,
    countList: '',
    add(){
        this.domTasks = document.querySelectorAll('.main__tasks .card');
        this.countList = parseInt( this.domTasks.length/3 ,10);
        if (this.domTasks.length%3 !== 0) ++this.countList;
        if (this.countList <= 1) return;

        this.generateDigitLine();
        this.addEvents();
        this.target.classList.remove('d-none');
        this.target.classList.add('d-flex');
    },
    
    remove(){
        this.removeEvents();
        this.removeDigitalLine();
        this.target.classList.remove('d-flex');
        this.target.classList.add('d-none');
        this.currentList = 1;
    },

    addEvents() {
        this.EventClickPrevious = this.EventClickPrevious.bind(this);
        this.EventClickNext = this.EventClickNext.bind(this);
        this.EventClickDigit = this.EventClickDigit.bind(this);

        this.previous.addEventListener('click',this.EventClickPrevious);
        this.next.addEventListener('click',this.EventClickNext);
        this.domDigitalA = document.querySelectorAll('#digit_a').forEach((elm)=>elm.addEventListener('click',this.EventClickDigit));
    },

    removeEvents() {
        this.previous.removeEventListener('click',this.EventClickPrevious);
        this.next.removeEventListener('click',this.EventClickNext);
        this.domDigitalA = document.querySelectorAll('#digit_a').forEach((elm)=>elm.removeEventListener('click',this.EventClickDigit));
    },

    generateDigitLine() {
        for (let i=1; i<=this.countList; i++) {
            let li = document.createElement('li');
            li.className= this.currentList==i ? "page-item active":"page-item";
            li.id = "digit_li";
            let a = document.createElement('a');
            a.href = "#";
            a.className="page-link";
            a.id="digit_a";
            a.innerText=i;
            li.append(a);
            document.querySelector('.page-item:last-of-type').insertAdjacentElement('beforebegin',li);
        }
    },
  
    removeDigitalLine(){
        document.querySelectorAll('#digit_li').forEach((n)=> n.parentNode.removeChild(n));
    },

    EventClickPrevious(e){
        e.preventDefault();
        if (this.currentList < 2) return;
        this.hiddenAllTasks();
        this.removeActiveClass();

        --this.currentList;
        this.showCurrentListTasks();
        this.instActiveClass();
    },

    EventClickNext(e){
        e.preventDefault();
        if (this.currentList >= this.countList) return;
        this.hiddenAllTasks();
        this.removeActiveClass();

        ++this.currentList;
        this.showCurrentListTasks();
        this.instActiveClass();
    },

    EventClickDigit(e){
        e.preventDefault();
        this.hiddenAllTasks();
        this.removeActiveClass();

        this.currentList = parseInt(e.target.innerText,10);
        this.showCurrentListTasks();
        this.instActiveClass();
    },

    hiddenAllTasks(){
        this.domTasks.forEach((elm)=>elm.classList.add('d-none'));
    },

    removeActiveClass(){
        document.querySelectorAll('#digit_li')[this.currentList-1].classList.remove('active');
    },

    instActiveClass(){
        document.querySelectorAll('#digit_li')[this.currentList-1].classList.add('active');
    },

    showCurrentListTasks() {
        this.domTasks.forEach((elm,id)=>{
            if (id+1 >= (this.currentList*3)-2 && id+1 <= this.currentList*3 ) elm.classList.remove('d-none');
        });
    }
}

export default pagination;