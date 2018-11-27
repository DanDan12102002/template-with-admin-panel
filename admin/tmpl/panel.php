<?php defined('_JEXEC') or die; ?>

<?php
	# Получаем список полей
	$fieldsList = Fields::getFields();
?>
<div class="fields-list">
	<div class="container">
		<?php if ($fields->errors) : ?>
			<div class="alert alert-danger" role="alert">
				<?php
					foreach ($fields->errors as $error) :
						echo $error;
					endforeach;
				?>
			</div>
		<?php endif; ?>

		<?php if ($fields->messages) : ?>
			<div class="alert alert-primary" role="alert">
				<?php	
					foreach ($fields->messages as $message) :
						echo $message;
					endforeach;
				?>
			</div>
		<?php endif; ?>
	
		<form method="post" action="index.php?view=savefields" name="fieldsform">
			<div class="controls text-right">
				<button type="submit" class="btn btn-success" name="savefields" style="width: auto;">Save</button>
				
				<?php if ( $login->isUserAdmin() == true ) : ?>
				<div class="dropdown d-inline-block" style="width: auto;">
					<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Add Field
					</button>
					<div class="dropdown-menu dropdown-menu-right mt-2" aria-labelledby="dropdownMenuButton">
						<a class="dropdown-item add-field" data-type="text" href="#">Text Field</a>
						<a class="dropdown-item add-field" data-type="editor" href="#">WYSIWYG Editor</a>
					</div>
				</div>
				<?php endif; ?>
			</div>
			
			<div class="cards-list">
				<?php if ( count($fieldsList) ) : ?>
					<?php foreach( $fieldsList as $index => $item ) : ?>
						<?php
							include('fields/'.$item->type.'.php'); 
						?>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
			
			<div class="controls text-right">
				<button type="submit" class="btn btn-success" name="savefields" style="width: auto;">Save</button>
				
				<?php if ( $login->isUserAdmin() == true ) : ?>
				<div class="dropdown dropup d-inline-block" style="width: auto;">
					<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Add Field
					</button>
					<div class="dropdown-menu dropdown-menu-right mb-2" aria-labelledby="dropdownMenuButton">
						<a class="dropdown-item add-field" data-type="text" href="#">Text Field</a>
						<a class="dropdown-item add-field" data-type="editor" href="#">WYSIWYG Editor</a>
					</div>
				</div>
				<?php endif; ?>
			</div>
			
			<script>
				$(document).ready(function(){
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
						var actUrl = "<?php echo $app->baseurl; ?>/admin/tmpl/fields/" + type + ".php?index=" + index;
						
						jQuery.ajax({
							url: actUrl,
							type: 'get',
							dataType: 'html',
							success: function(data) {
								$('.cards-list').append(data);
							},
							error:	 function() {}
						});
					});
				});
			</script>
		</form>
	</div>
</div>
