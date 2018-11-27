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
				<div class="t2">This page does not exist</div>
				<div class="t3">
					Go to <a href="<?php echo $this->baseurl; ?>">mainpage</a>
				</div>
			</div>
		</div>
		
		<?php include 'blocks/scripts.php'; ?>
	</body>
</html>