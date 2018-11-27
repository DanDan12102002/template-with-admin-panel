<?php
	$index = ( $index ) ? $index : $this->index;
?>
<div class="card my-4" data-index="<?php echo $index; ?>">
	<div class="card-body">
		<div class="row">
			<div class="col-md-3">
				<input type="text" class="form-control" placeholder="System name" name="fieds[<?php echo $index; ?>][name]" value="<?php echo ( $item['name'] ) ? $item['name'] : 'field-'.$index; ?>">
			</div>
			<div class="col-md-8">
				<input type="text" class="form-control" placeholder="Значение" name="fieds[<?php echo $index; ?>][value]" value="<?php echo $item['value']; ?>">
			</div>
			<div class="col-md-1">
				<button type="button" class="btn btn-danger remove-field">
					<i class="fa fa-trash-o" aria-hidden="true"></i>
				</button>
			</div>
		</div>
		<input type="hidden" name="fieds[<?php echo $index; ?>][type]" value="text">
	</div>
</div>