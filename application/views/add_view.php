<form class="pt-5" id="add-form" name="add-form" action="/addform" method="POST">
    <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="name" name="name" placeholder="Name">
        </div>
    </div>
    <div class="form-group row">
        <label for="email" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
            <input type="email" class="form-control" id="email" name="email" placeholder="Email">
        </div>
    </div>
    <div class="form-group row">
        <label for="task" class="col-sm-2 col-form-label">Task</label>
        <div class="col-sm-10">
            <textarea class="form-control" id="task" name="task" placeholder="Your task"></textarea>
        </div>
    </div>
        
    <div class="form-group row">
        <div class="col-sm-12 mt-3">
            <button type="submit" class="btn btn-secondary mr-3">Add</button>
            <a href="/" class="btn btn-secondary">Cancle</a>
        </div>
  </div>
</form>
<script src="assets/js/addform.js" defer ></script>

