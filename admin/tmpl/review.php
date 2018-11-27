<?php defined('_JEXEC') or die; ?>
<?php
	$itemUrl = 'review';
	$itemsUrl = 'reviews';
	$itemAddText = 'Добавить отзыв';
?>

<!DOCTYPE html>
<html>
	<head>
		<?php include 'blocks/head.php'; ?>
	</head>
	<body>
		<?php include 'blocks/header.php'; ?>
		
		<div class="mainbody">
			<div class="container">			
				<div class="hotel-block">
					<?php if ($this->errors) : ?>
						<div class="alert alert-danger" role="alert">
							<?php
								foreach ($this->errors as $error) :
									echo $error;
								endforeach;
							?>
						</div>
					<?php endif; ?>

					<?php if ($this->messages) : ?>
						<div class="alert alert-primary" role="alert">
							<?php	
								foreach ($this->messages as $message) :
									echo $message;
								endforeach;
							?>
						</div>
					<?php endif; ?>
					
					<?php
						global $app;
						$item = $this->item;
						$fields = $item['fields'];
						
						if ( $item['id'] ) :
							$action = $app->baseurl.'/'.$itemUrl.'/'.$item['id'];
						else :
							$action = $app->baseurl.'/'.$itemUrl;
						endif;
					?>
				
					<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
						<div class="form-group text-right">
							<a href="<?php echo $app->baseurl; ?>/<?php echo $itemsUrl; ?>" class="btn btn-primary btn-sm">Назад</a>
							<button class="btn btn-success" style="width: auto;">Сохранить</button>
						</div>
						
						<div class="form-group">
							<input type="text" class="form-control" name="fieds[title]" value="<?php echo $fields['title']; ?>" placeholder="Имя">
						</div>
						
						<div class="form-group">
							<label>Отзыв</label>
							
							<textarea class="editor-intro" placeholder="Описание" name="fieds[intro]"><?php echo $fields['intro']; ?></textarea>
						</div>
						
						
						<div class="form-group">
							<label>Status</label>
							<select class="form-control" name="state">
								<option <?php echo ( $item['state'] == 1 ) ? 'selected' : ''; ?> value="1">Published</option>
								<option <?php echo ( $item['state'] == 0 ) ? 'selected' : ''; ?> value="0">Unpublished</option>
							</select>
						</div>
						
						<?php if ( $item['id'] ) : ?>
							<input type="hidden" name="id" value="<?php echo $item['id']; ?>">
						<?php endif; ?>
						
						<div class="form-group">
							<input type="text" class="form-control" name="order" value="<?php echo $item['order']; ?>" placeholder="Order">
						</div>
					</form>
				</div>
			</div>
		</div>
		
		<?php include 'blocks/footer.php'; ?>
		
		<?php include 'blocks/scripts.php'; ?>
		
		<script>
			var iconSelect;
			var selectedText;
			var selectedIndex = 0;
			
			$(document).ready(function(){
				/* ************************* */
				selectedText = document.getElementById('speak-photo');

				document.getElementById('photo-icon-select').addEventListener('changed', function(e){
					selectedText.value = iconSelect.getSelectedValue();
				});

				iconSelect = new IconSelect("photo-icon-select", {
					'selectedIconWidth':100,
					'selectedIconHeight':100,
					'selectedBoxPadding':2,
					'iconsWidth':100,
					'iconsHeight':100,
					'boxIconSpace':2,
					'vectoralIconNumber':2,
					'horizontalIconNumber':2
				});

				var icons = [];
				
				<?php foreach ( $photos as $index => $image ) : ?>
				<?php if ( $image == $fields['photo-1'] ) : ?>
					selectedIndex = <?php echo $index; ?>;
				<?php endif; ?>
				icons.push({'iconFilePath':'<?php echo $app->baseurl.'/'.$image; ?>', 'iconValue':'<?php echo $image; ?>'});
				
				<?php endforeach; ?>

				iconSelect.refresh(icons);
				iconSelect.setSelectedIndex(selectedIndex);
				/* ************************* */
				
			});
			
			$.trumbowyg.svgPath = '<?php echo $app->baseurl; ?>/assets/plugins/trumbowyg/ui/icons.svg';
			
			$('.editor-intro').trumbowyg({
				btns: [
					['viewHTML'],
					['formatting'],
					['strong', 'em', 'del'],
					['link'],
					['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
					['unorderedList', 'orderedList'],
					['removeformat'],
					['fullscreen']
				]
			});
			
			$('.editor-full').trumbowyg({
				btns: [
					['viewHTML'],
					['formatting'],
					['strong', 'em', 'del'],
					['link'],
					['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
					['unorderedList', 'orderedList'],
					['removeformat'],
					['fullscreen']
				]
			});
		</script>
		
	</body>
</html>