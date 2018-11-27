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
				<div class="hotels-block">

					<table class="table">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col-8">Название</th>
								<th scope="col">Порядок</th>
								<th scope="col">
									<a href="./menu" class="btn btn-success" style="width: auto;">Добавить меню</a>
								</th>
							</tr>
						</thead>
						<tbody>
							
							<?php if ( count($this->items) ) : ?>
								<div class="hotels-list row">
									<?php foreach ($this->items as $key => $item) : ?>
										<tr>
											<th scope="row"><?php echo $key+1; ?></th>
											<td>
												<a href="./menu/<?php echo $item['id']; ?>">
													<?php echo $item['fields']['title']; ?>
												</a>
											</td>
											<td><?php echo $item['order']; ?></td>
											<td>
												<a href="./menu/<?php echo $item['id']; ?>" class="btn btn-primary btn-sm">Править</a>
												<a href="./menu-delete/<?php echo $item['id']; ?>" class="btn btn-danger btn-sm">Удалить</a>
											</td>
										</tr>
									<?php endforeach; ?>
								</div>
							<?php endif; ?>

						</tbody>
					</table>
				</div>
			</div>
		</div>
		
		<?php include 'blocks/footer.php'; ?>
		
		<?php include 'blocks/scripts.php'; ?>
		
	</body>
</html>