<form id="main__filter" class="main__filter pt-5 pb-1 col-12 border-bottom">
  <div class="row">
        <div class="col-12 ">
                <h5>Фильтр задач:</h5>
        </div>
        <div class="col-2">
            <select class="form-control form-control-sm" id="inputGroupSelect01">
                <option value="none">Тип </option>
                <option value="name">Имя</option>
                <option value="email">Email</option>
            </select>
        </div>
        <div class="col-3">        
            <select class="form-control form-control-sm" id="inputGroupSelect01">
                <option value="none">Направление</option>
                <option value="name">по возрастанию</option>
                <option value="email">по убыванию</option>
            </select>
        </div>
        <div class="col-2 custom-control custom-checkbox">
            <input class="custom-control-input" type="checkbox" value="" id="defaultCheck1">
            <label class="custom-control-label" for="defaultCheck1">
            Выполнено
            </label>
        </div>
        <div class="col-3 custom-control custom-checkbox">
            <input class="custom-control-input" type="checkbox" value="" id="defaultCheck2">
            <label class="custom-control-label" for="defaultCheck2">
            Отредактировано администратором
            </label>
        </div>
        <div class="col-2">
            <button type="submit" class="btn btn-outline-dark " id="submit">Применить</button>
        </div>  
    </div>
</form>

<section class="main__cards col-12 d-flex flex-wrap align-items-start justify-content-center my-3">
    <?php if ( count($data) !== 0 ):  ?>
        <?php foreach( $data as $value) : ?>
            <div class="card mx-2" style="width: 230px">
            <div class="card-body">
                <h5 class="card-title"><?php echo $value['name']; ?></h5>
                <h6 class="card-subtitle mb-2 text-muted"><?php echo $value['email']; ?></h6>
                <p class="card-text"><?php echo $value['task']; ?></p>
                <hr>
                <p ><span class="font-weight-bold ">Статус: </span><?php echo $value['status'] ? 'Выполнено' : 'Не выполнено'; ?></p>
                <?php echo $value['admin_create'] ? '<p class="font-italic">Отредактировано администратором </p>' : ''; ?>
            </div>
            </div>
        <?php endforeach; ?>
    
    <? else: ?>
        <h3>Список задач пуст</h3>
    <? endif; ?>

</section>
<nav class="main__pagination col-12 d-flex justify-content-center">
  <ul class="pagination">
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    <li class="page-item active"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>