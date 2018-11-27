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
						$menu = $item['menu'];
						
						if ( $item['id'] ) :
							$action = $app->baseurl.'/menu/'.$item['id'];
						else :
							$action = $app->baseurl.'/menu';
						endif;
					?>
				
					<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
						<div class="form-group text-right">
							<a href="<?php echo $app->baseurl; ?>/menus" class="btn btn-primary btn-sm">Назад</a>
							<button class="btn btn-success" style="width: auto;">Сохранить</button>
						</div>
						
						<div class="form-group">
							<input type="text" class="form-control" name="fieds[title]" value="<?php echo $fields['title']; ?>" placeholder="Название">
						</div>
						
						<div class="form-group">
							<label>Описание</label>
							
							<textarea class="editor-intro" placeholder="Описание" name="fieds[intro]"><?php echo $fields['intro']; ?></textarea>
						</div>
						
						<div class="form-group">
							<?php
								$photos = glob('media/source/Menu/*');
							?>
							
							<label>Фото</label>
							<div id="photo-icon-select">Выберите фото</div>
							<input type="hidden" name="fieds[photo-1]" value="<?php echo $item['photo-1']; ?>" id="speak-photo">
						</div>
						
						<div class="form-group">
							<label>Список блюд</label>
							
							<div class="menu-list">
								<div class="row head mb-3">
									<div class="col-md-6">Название</div>
									<div class="col-md-3">Вес, г</div>
									<div class="col-md-3">Цена, грн</div>
								</div>
								
								<?php for ( $i = 1; $i < 10; $i++ ) : ?>
								<div class="row mb-3">
									<div class="col-md-6">
										<input type="text" class="form-control" name="menu[<?php echo $i; ?>][name]" value="<?php echo $menu[$i]['name']; ?>">
									</div>
									<div class="col-md-3">
										<input type="text" class="form-control" name="menu[<?php echo $i; ?>][weight]" value="<?php echo $menu[$i]['weight']; ?>">
									</div>
									<div class="col-md-3">
										<input type="text" class="form-control" name="menu[<?php echo $i; ?>][price]" value="<?php echo $menu[$i]['price']; ?>">
									</div>
									<div class="col-md-12 mt-2">
										<input type="text" class="form-control" name="menu[<?php echo $i; ?>][composition]" value="<?php echo $menu[$i]['composition']; ?>" placeholder="Состав">
									</div>
								</div>
								<?php endfor; ?>
							</div>
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
					'selectedIconWidth':150,
					'selectedIconHeight':100,
					'selectedBoxPadding':2,
					'iconsWidth':150,
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
				
				/* ************************* */
				selectedText2 = document.getElementById('speak-photo-2');

				document.getElementById('photo-icon-select-2').addEventListener('changed', function(e){
					selectedText2.value = iconSelect2.getSelectedValue();
				});

				iconSelect2 = new IconSelect("photo-icon-select-2", {
					'selectedIconWidth':150,
					'selectedIconHeight':100,
					'selectedBoxPadding':2,
					'iconsWidth':150,
					'iconsHeight':100,
					'boxIconSpace':2,
					'vectoralIconNumber':2,
					'horizontalIconNumber':2
				});

				var icons2 = [];
				
				<?php foreach ( $photos as $index => $image ) : ?>
				<?php if ( $image == $fields['photo-2'] ) : ?>
					selectedIndex2 = <?php echo $index; ?>;
				<?php endif; ?>
				icons2.push({'iconFilePath':'<?php echo $app->baseurl.'/'.$image; ?>', 'iconValue':'<?php echo $image; ?>'});
				
				<?php endforeach; ?>

				iconSelect2.refresh(icons2);
				iconSelect2.setSelectedIndex(selectedIndex2);
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