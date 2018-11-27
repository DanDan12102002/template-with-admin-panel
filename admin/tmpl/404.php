<?php defined('_JEXEC') or die; ?>

<!DOCTYPE html>

<html>
	<head>
		<?php include 'blocks/head.php'; ?>
	</head>
	<body>
		<div class="page-404 d-flex justify-content-center align-items-center">
			<div class="info">
				<div class="t1">404</div>
				<div class="t2">Такой страницы не существует</div>
				<div class="t3">
					Перейти на <a href="<?php echo $this->baseurl; ?>">главную</a>
				</div>
			</div>
		</div>
		
		<?php include 'blocks/scripts.php'; ?>
	</body>
</html>