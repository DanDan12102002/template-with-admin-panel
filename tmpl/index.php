<?php defined('_JEXEC') or die; ?>
<?php
	global $app;
	
	require_once('admin/library/Models/Review.php');
	require_once('admin/library/Models/Menu.php');
	require_once('admin/library/Models/Article.php');

	$ReviewModel = new ReviewModel();
	$ReviewItems = json_decode( file_get_contents('admin/data/reviews.txt'), 1 );
	$reviews = $ReviewModel->sortItems( $ReviewItems );

	$MenuModel = new MenuModel();
	$MenuItems = json_decode( file_get_contents('admin/data/menu.txt'), 1 );
	$menus = $MenuModel->sortItems( $MenuItems );

	$ArticleModel = new ArticleModel();
	$ArticleItems = json_decode( file_get_contents('admin/data/articles.txt'), 1 );
	$articles = $ArticleModel->sortItems( $ArticleItems );
	
	$options = json_decode( file_get_contents('admin/data/fields.txt'), 1 );
?>
	<!DOCTYPE html>
	<html>

	<head>
		<?php include 'blocks/head.php'; ?>
	</head>

	<body class="home">
		<?php include 'blocks/scripts.php'; ?>
		<div class="section-1">
			<?php include 'blocks/header.php'; ?>
			<div class="container">
				
			</div>
		</div>

		<?php
				$photos = glob('admin/media/source/Gallery/*');
			?>

			<?php
				$photos = glob('admin/media/source/Blog/*');
			?>

				<?php include 'blocks/footer.php'; ?>
				<?php include 'blocks/modals.php'; ?>

	</body>

	</html>