<?php defined('_JEXEC') or die; ?>
<?php global $app; ?>
<!DOCTYPE html>

<html>
	<head>
		<?php include 'blocks/head.php'; ?>
	</head>
	<body>
		<?php include 'blocks/header.php'; ?>
		
		<div class="mainbody">
			<div class="container">			
				<div class="fields-list">
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
				
					<form method="post" action="<?php echo $app->baseurl; ?>/fields" name="fieldsform">
						<div class="controls text-right">
							<button type="submit" class="btn btn-success" name="savefields" style="width: auto;">Save</button>
							
							<div class="dropdown d-inline-block" style="width: auto;">
								<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Add Field
								</button>
								<div class="dropdown-menu dropdown-menu-right mt-2" aria-labelledby="dropdownMenuButton">
									<a class="dropdown-item add-field" data-type="text" href="#">Text Field</a>
									<a class="dropdown-item add-field" data-type="editor" href="#">WYSIWYG Editor</a>
								</div>
							</div>
						</div>
						
						<div class="cards-list">
							<?php if ( count($this->items) ) : ?>
								<?php foreach( $this->items as $index => $item ) : ?>
									<?php
										include('fields/'.$item['type'].'.php'); 
									?>
								<?php endforeach; ?>
							<?php endif; ?>
						</div>
						
						<div class="controls text-right">
							<button type="submit" class="btn btn-success" name="savefields" style="width: auto;">Save</button>
							
							<div class="dropdown dropup d-inline-block" style="width: auto;">
								<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Add Field
								</button>
								<div class="dropdown-menu dropdown-menu-right mb-2" aria-labelledby="dropdownMenuButton">
									<a class="dropdown-item add-field" data-type="text" href="#">Text Field</a>
									<a class="dropdown-item add-field" data-type="editor" href="#">WYSIWYG Editor</a>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		
		<?php include 'blocks/footer.php'; ?>
		
		<?php include 'blocks/scripts.php'; ?>
		
		<script>
			$(document).ready(function(){
				$.trumbowyg.svgPath = '<?php echo $app->baseurl; ?>/assets/plugins/trumbowyg/ui/icons.svg';
				
				$(document).on( 'click', '.remove-field', function() {
					$card = $(this).closest('.card').remove();
				});
				
				$('.add-field').click(function(){
					var index = 0;
					$('.card').each(function(){
						var cardIndex = parseInt( $(this).data('index') );
						
						if ( cardIndex > index ) {
							index = cardIndex;
						}
					});
					
					index++;
					
					var type = $(this).data('type');
					var actUrl = "<?php echo $app->baseurl; ?>/getfield/" + type + "/" + index;
					
					jQuery.ajax({
						url: actUrl,
						type: 'get',
						dataType: 'html',
						success: function(data) {
							$('.cards-list').append(data);
							
							if ( $('.ws-editor').length ) {
								$('.ws-editor').trumbowyg({
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
							}
						},
						error:	 function() {}
					});
				});
				
				if ( $('.ws-editor').length ) {
					$('.ws-editor').trumbowyg({
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
				}
			});
		</script>
		
	</body>
</html>