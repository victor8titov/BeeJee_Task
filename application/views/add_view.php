<form class="pt-5" id="add__form" name="add__form" action="/addform" method="POST">
    <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="name" name="name" placeholder="Name" autofocus required>
        </div>
    </div>
    <div class="form-group row">
        <label for="email" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required pattern= "^(\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,6})">
        </div>
    </div>
    <div class="form-group row">
        <label for="task" class="col-sm-2 col-form-label">Task</label>
        <div class="col-sm-10">
            <textarea class="form-control" id="task" name="task" placeholder="Your task" required></textarea>
        </div>
    </div>
        
    <div class="form-group row">
        <div class="col-sm-12 mt-3">
            <button type="submit" class="btn btn-secondary mr-3 " id="submit">Добавить</button>
            <a href="/" class="btn btn-secondary" id="cancle">Отмена</a>
        </div>
  </div>
</form>
<div class="alert add__message" role="alert" >
  <h4 class="alert-heading add__title"></h4>
  <p class="add__description"></p>
  <hr>
  <a href="/" type="button" class="btn btn-light mx-1 btn-sm">Вернуться к заметкам</a>
</div>
<script src="assets/js/addform.js" defer ></script>

