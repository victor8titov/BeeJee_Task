<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="assets/css/main.css" />
	<title>Tasks BeeJee</title>
	<script>
		var flagAdmin=<?php echo isset( $data['login'] ) && $data['login']? "true" : "false";  ?>;
	</script>
</head>
<body class="bg-light">

	<!-- header -->
	<header class="header p-3  bg-secondary text-white">
		<div class="container clearfix">
			<a href="/" class=" text-white float-left"> Task manager</a>
			<?php if ($namePage === '' || $namePage === 'add'): ?>
				<?php if ( isset( $data['login'] ) && $data['login'] ): ?>
					<a href="/main/out" type="button" class="btn btn-light float-right mx-1 btn-sm">Logout</a>
				<? else: ?>
					<a href="/authorization" type="button" class="btn btn-light float-right mx-1 btn-sm">Login</a>
				<? endif; ?>
			<?php endif; ?>
			<?php if ($namePage === '' ) : ?>
				<a href="/add" type="button" class="btn btn-light float-right mx-1 btn-sm ">Add</a>
			<?php endif; ?>
			<?php if ($namePage !== '' ) : ?>
				<a href="/" type="button" class="btn btn-light float-right mx-1 btn-sm ">Main</a>
			<?php endif; ?>
		</div>
	</header>
	
	<!-- Main -->
	<section class="main">
		<div class="container main__container">
			<?php include 'application/views/'.$content_view; ?>
		</div>
	</section>
	
	<!-- Footer -->
	<footer class="footer p-3  bg-secondary text-white">
		<div class="container ">
			<span>
			Victor Titov created December 2019
			</span>
		</div>
	</footer>

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
</body>
</html>