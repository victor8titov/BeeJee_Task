
<section class="main__tasks col-12 d-flex flex-wrap align-items-start justify-content-center my-1">
    <?php if ( count($data['tasks']) !== 0 ):  
      $count = 1;
      ?>
        <?php foreach( $data['tasks'] as $value) : ?>
            <div class="task card m-2 <? if ($count > 3 ) echo "d-none";?> <?php if ($data['login']) echo ' create';?>"  id="<? echo $value['id']; ?>">
                <div class="card-body ">
                    <h5 class="card-title task__name"><?php echo $value['name']; ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted task__email"><?php echo $value['email']; ?></h6>
                    <p class="card-text task__task" ><?php echo $value['task']; ?></p>
                    <hr>

                    <p class="card-status task__status"><span class="font-weight-bold ">Статус: </span><?php echo $value['status'] === 'true' ? 'Выполнено' : 'Не выполнено'; ?></p>
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



