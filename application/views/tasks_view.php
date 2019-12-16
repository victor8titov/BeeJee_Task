
<section class="main__tasks col-12 d-flex flex-wrap align-items-start justify-content-center my-1">
    <?php if ( count($data['tasks']) !== 0 ):  
      $count = 1;
      ?>
        <?php foreach( $data['tasks'] as $value) : ?>
            <div class="task card m-2 <? if ($count > 3 ) echo "d-none";?> <?php if ($data['login']) echo ' create';?>" style="width: 200px" id="<? echo $value['id']; ?>">
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

<?php if ($data['login']): ?>
<div class="modal create-task" >
    <div class="modal-dialog" >
        <div class="modal-content">
            <div class="modal-header">  
                <!-- name email -->
                <div class="form-group">
                    <label for="create-task__name">Name:</label>
                    <input type="text" class="form-control" id="create-task__name" name="name" value="" >
                </div>
                <div class="form-group">
                    <label for="create-task__email">Email:</label>
                    <input type="email" class="form-control" id="create-task__email" name="email" value="">
                </div>
            </div>
            <!-- task / check -->
            <div class="modal-body ">
                <div class="form-group">
                    <label for="create-task__task">Task:</label>
                    <textarea class="form-control" id="create-task__task" name="task" rows="8"></textarea>
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="create-task__status" name="status">
                    <label class="form-check-label" for="create-task__status" >Выполнено</label>
                </div>
            </div>
            <!-- button  -->
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="create-task__button-save">Save</button>
                <button type="button" class="btn btn-secondary" id="create-task__button-cancel">Cancel</button>
                <button type="button" class="btn btn-danger" id="create-task__button-delete">Delete task</button>
            </div>
        </div>
    </div>
</div>
<? endif; ?>
