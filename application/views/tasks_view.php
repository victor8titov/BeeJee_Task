
<section class="main__tasks col-12 d-flex flex-wrap align-items-start justify-content-center my-1">
    <?php if ( count($data) !== 0 ):  
      $count = 1;
      ?>
        <?php foreach( $data as $value) : ?>
            <div class="card m-2 <? if ($count > 3 ) echo "d-none"; ?>" style="width: 200px" id="<? echo $value['id']; ?>">
            <div class="card-body">
                <h5 class="card-title"><?php echo $value['name']; ?></h5>
                <h6 class="card-subtitle mb-2 text-muted"><?php echo $value['email']; ?></h6>
                <p class="card-text"><?php echo $value['task']; ?></p>
                <hr>
                <p class="card-status"><span class="font-weight-bold ">Статус: </span><?php echo $value['status'] === 'true' ? 'Выполнено' : 'Не выполнено'; ?></p>
                <?php echo $value['admin_create']==='true' ? '<p class="font-italic">Отредактировано администратором </p>' : ''; ?>
            </div>
            </div>
		<?php 
			++$count;
			endforeach; ?>
    
    <? else: ?>
        <h3 class="m-5">Список задач пуст</h3>
    <? endif; ?>
</section>

