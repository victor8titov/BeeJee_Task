<form id="main__filter" class="main__filter pt-5 pb-1 col-12 border-bottom mb-5">
  <div class="row">
        <div class="col-12 pl-0 pl-md-3">
                <h5>Фильтр задач:</h5>
        </div>
        <div class="col-md-2 col-sm-6 mb-2 mb-sm-0 pl-0 pl-md-3">
            <select class="form-control form-control-sm" id="type" name="type">
                <option value="undefined">Тип </option>
                <option value="name">Имя</option>
                <option value="email">Email</option>
            </select>
        </div>
        <div class="col-md-3 col-sm-6 mb-2 pl-0">        
            <select class="form-control form-control-sm" id="direction" name="direction">
                <option value="on_increase">по возрастанию</option>
                <option value="on_decrease">по убыванию</option>
            </select>
        </div>
        <div class="col-md-2 col-sm-6 mb-2 custom-control custom-checkbox">
            <input class="custom-control-input" type="checkbox" value="" id="status" name="status">
            <label class="custom-control-label" for="status">
            Выполнено
            </label>
        </div>
        <div class="col-md-3 col-sm-6 mb-2 custom-control custom-checkbox">
            <input class="custom-control-input" type="checkbox" value="" id="admin_create" name="admin_create">
            <label class="custom-control-label" for="admin_create">
            Отредактировано администратором
            </label>
        </div>
        <div class="col-md-2 pl-0 mb-3 text-md-right">
            <button type="submit" class="btn btn-outline-dark " id="submit">Применить</button>
        </div>  
    </div>
</form>
<div class="admin-menu d-none justify-content-center mb-3">
    <button type="button" class="btn btn-primary mx-2" id="admin-menu__button-save">Save to server</button>
    <button type="button" class="btn btn-secondary mx-2" id="admin-menu__button-cancel">Cancel</button>
</div>
<nav class="main__pagination col-12 justify-content-center d-none">
  <ul class="pagination">
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Previous" id="pagination__previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Next" id="pagination__next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>
<script src="assets/js/main.js" defer></script>

