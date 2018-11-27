<?php defined('_JEXEC') or die; ?>

<div class="edit-block">
	<?php if (!isset($editProfile)) die(); ?>

	<?php if ($editProfile->errors) : ?>
		<div class="alert alert-danger" role="alert">
			<?php
				foreach ($editProfile->errors as $error) :
					echo $error;
				endforeach;
			?>
		</div>
	<?php endif; ?>

	<?php if ($editProfile->messages) : ?>
		<div class="alert alert-primary" role="alert">
			<?php	
				foreach ($editProfile->messages as $message) :
					echo $message;
				endforeach;
			?>
		</div>
	<?php endif; ?>
	
	<div class="d-flex justify-content-center align-items-center">
		<div style="max-width: 320px; width: 100%;">
			<form method="post" action="index.php?view=editpass" name="editform">
				<div class="form-group">
					<label for="OldPassword">Текущий пароль</label>
					<input type="password" class="form-control" id="OldPassword" placeholder="Минимум 6 знаков" pattern=".{6,}" name="old_password" required>
				</div>
				<div class="form-group">
					<label for="Password">Новый Пароль</label>
					<input type="password" class="form-control" id="Password" placeholder="Минимум 6 знаков" name="user_password_new" pattern=".{6,}" required autocomplete="off">
				</div>
				<div class="form-group">
					<label for="Password">Повторите Новый Пароль</label>
					<input type="password" class="form-control" id="Password" placeholder="Минимум 6 знаков" name="user_password_repeat" pattern=".{6,}" required autocomplete="off">
				</div>

				<button type="submit" class="btn btn-primary" name="editpass">Сменить пароль</button>
			</form>

			<div class="mt-3">
				<a href="index.php">Назад на Главную</a>
			</div>
		</div>
	</div>
</div>