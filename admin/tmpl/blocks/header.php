<?php
	defined('_JEXEC') or die;
	
	global $app;
?>

<nav class="navbar navbar-dark bg-primary navbar-expand-md justify-content-between">
    <a class="navbar-brand" href="<?php echo $app->baseurl; ?>">Dan's Food Admin</a>
    
	<div>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
			<i class="fa fa-bars" aria-hidden="true"></i>
		</button>

		<div class="collapse navbar-collapse" id="navbarNavDropdown">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" href="<?php echo $app->baseurl; ?>">Панель</a>
				</li>
				
				<?php if ( $app->isUserLoggedIn ) : ?>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo $app->baseurl; ?>/fields">Настройки</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo $app->baseurl; ?>/media/filemanager/dialog.php" target="_blank">Файл менеджер</a>
				</li>
				
				<?php if ( $app->isUserAdmin ) : ?>
					<li class="nav-item">
						<a class="nav-link" href="./registration">Add User</a>
					</li>
				<?php endif; ?>
				
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="fa fa-user-circle-o" aria-hidden="true"></i>
					</a>
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
						<h3 class="dropdown-header"><?php echo $_SESSION['user_name']; ?></h3>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="./logout">Logout</a>
					</div>
				</li>
				<?php endif; ?>
				
				<li class="nav-item ml-2 pl-2" style="border-left: 1px solid rgba(255,255,255,.5);">
					<a class="nav-link" href="<?php echo $app->siteurl; ?>" target="_blank">Главная</a>
				</li>
			</ul>
		</div>
	</div>
	
</nav>