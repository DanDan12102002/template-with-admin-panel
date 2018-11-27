<?php defined('_JEXEC') or die; ?>

<!DOCTYPE html>

<html>
	<head>
		<?php include 'blocks/head.php'; ?>
	</head>
	<body>
		<?php include 'blocks/header.php'; ?>
		
		<div class="mainbody">
			<div class="container">

				<div class="row">
					<div class="col-sm-3 mb-4">
						<div class="card">
							<div class="card-body text-center">
								<h5 class="card-title">Файл менеджер</h5>
								<a href="<?php echo $app->baseurl; ?>/media/filemanager/dialog.php" target="_blank" class="btn btn-primary">Перейти</a>
							</div>
						</div>
					</div>
					<div class="col-sm-3 mb-4">
						<div class="card">
							<div class="card-body text-center">
								<h5 class="card-title">Настройки</h5>
								<a href="<?php echo $app->baseurl; ?>/fields" class="btn btn-primary">Перейти</a>
							</div>
						</div>
					</div>
					<div class="col-sm-3 mb-4">
						<div class="card">
							<div class="card-body text-center">
								<h5 class="card-title">Меню</h5>
								<a href="<?php echo $app->baseurl; ?>/menus" class="btn btn-primary">Перейти</a>
							</div>
						</div>
					</div>
					<div class="col-sm-3 mb-4">
						<div class="card">
							<div class="card-body text-center">
								<h5 class="card-title">Блог</h5>
								<a href="<?php echo $app->baseurl; ?>/articles" class="btn btn-primary">Перейти</a>
							</div>
						</div>
					</div>
					<div class="col-sm-3 mb-4">
						<div class="card">
							<div class="card-body text-center">
								<h5 class="card-title">Отзывы</h5>
								<a href="<?php echo $app->baseurl; ?>/reviews" class="btn btn-primary">Перейти</a>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
		
		<?php include 'blocks/footer.php'; ?>
		
		<?php include 'blocks/scripts.php'; ?>
		
	</body>
</html>