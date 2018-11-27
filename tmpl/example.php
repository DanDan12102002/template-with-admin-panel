<?php defined('_JEXEC') or die; ?>
<?php
	global $app;
	
	require_once('admin/library/Models/Article.php');
	
	$ArticleModel = new ArticleModel();
	$ArticleItems = json_decode( file_get_contents('admin/data/articles.txt'), 1 );
	$articles = $ArticleModel->sortItems( $ArticleItems );
	
	# Отримуємо з роутера ІД статті
	$artid = $this->route['values']['page'];
	
	# Знаходимо статтю
	$article = false;
	foreach( $articles as $key => $art ) :
		if ( ($key + 1) == $artid ) :
			$article = $art;
		endif;
	endforeach;
	
	# Якщо такої статті нема
	if ( !$article ) :
		header('Location: '.$app->baseurl.'/blog');
		die();
	endif;
?>
	<!DOCTYPE html>
	<html>

	<head>
		<?php include 'blocks/head.php'; ?>
	</head>

	<body class="blog-content">
		<?php include 'blocks/scripts.php'; ?>

		<?php include 'blocks/header-black.php'; ?>

		<div class="blog-content-section-1">
			<div class="container">
				<div class="t1">
					<div class="p1">
						БЛОГ
					</div>
				</div>
				<div class="decor">
					<img src="./assets/images/main/decor.png" alt="">
				</div>
				<div class="t2">
					<div class="p1">
						Вся інформація та історії з нашого блогу допоможуть вам скуштувати найкращі страви.
					</div>
				</div>
			</div>
		</div>



		<div class="blog-content-section-2">
			<div class="container">
				<div class="row r1">
					<?php 
					$date = $article['fields']['date']; 
					setlocale(LC_ALL, 'uk_UA.utf8');
					$_monthsList = array(
					"1"=>"Січня","2"=>"Лютого","3"=>"Березня",
					"4"=>"Квітня","5"=>"Травня", "6"=>"Червня",
					"7"=>"Липня","8"=>"Серпня","9"=>"Вересня",
					"10"=>"Жовтня","11"=>"Листопада","12"=>"Грудня");

					$month = $_monthsList[date("n")];


				?>
					<div class="col-sm-12 col-lg-10">
						<div class="blog-box">
							<div class="white d-flex d-sm-none align-self-center">
								<div class="flex">
									<div class="post-by fl">
										<div class="p1">
											Опублікував <span class="orange"><?php echo $article['fields']['author']; ?></span>
										</div>
									</div>
								</div>
								<div class="t d-none d-sm-block">
									<div class="p1">
										<?php echo $article['fields']['title']; ?>
									</div>
								</div>
							</div>
							<div class="img-blog">
								<img src="<?php echo $app->baseurl; ?>/admin/<?php echo $article['fields']['photo-1']; ?>" alt="">
							</div>
							<div class="titles">
								<div class="media">
									<div class="when">
										<div class="p1">
											<span class="num">
												<?php echo date("d", strtotime($date)); ?>
											</span> <br>
											<?php  echo date("$month", strtotime($date)); ?>
										</div>
									</div>
									<div class="media-body d-none d-sm-block align-self-center">
										<div class="flex">
											<div class="post-by fl">
												<div class="p1">
													Опублікував <span class="orange"><?php echo $article['fields']['author']; ?></span>
												</div>
											</div>
										</div>
										<div class="t d-none d-sm-block">
											<div class="p1">
												<?php echo $article['fields']['title']; ?>
											</div>
										</div>
									</div>

								</div>
								<div class="t d-block d-sm-none">
									<div class="p1">
										<?php echo $article['fields']['title']; ?>
									</div>
								</div>
							</div>
							<div class="text">
								<div class="p1">
									<?php echo $article['fields']['full']; ?>
								</div>
							</div>
						</div>

						<div class="t1">
							<div class="p1">
								Залиш свій коментар
							</div>
						</div>
						<div class="line">
							<img src="<?php echo $app->baseurl; ?>/assets/images/main/contact-line.png" alt="">
						</div>

						<div class="comentar">
							<div class="blog-box coment-box">
								<div id="fb-root"></div>
								<script>(function(d, s, id) {
									var js, fjs = d.getElementsByTagName(s)[0];
									if (d.getElementById(id)) return;
									js = d.createElement(s); js.id = id;
									js.src = 'https://connect.facebook.net/uk_UA/sdk.js#xfbml=1&version=v3.0';
									fjs.parentNode.insertBefore(js, fjs);
								}(document, 'script', 'facebook-jssdk'));</script>
								<div class="fb-comments" data-href="https://dev.colin990.tech/danya/blog" data-width="100%" data-numposts="5"></div>
							</div>
						</div>
					</div>


				</div>
			</div>
		</div>
		</div>
		<div class="up go-to-block" data-target=".blog-content"><i class="fas fa-angle-double-up"></i></div>
		<?php include 'blocks/footer.php'; ?>
		<?php include 'blocks/modals.php'; ?>

	</body>

	</html>