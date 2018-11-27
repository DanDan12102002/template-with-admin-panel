<?php defined('_JEXEC') or die; ?>

<div class="registration-block">
	<?php if (!isset($registration)) die(); ?>

	<?php if ($registration->errors) : ?>
		<div class="alert alert-danger" role="alert">
			<?php
				foreach ($registration->errors as $error) :
					echo $error;
				endforeach;
			?>
		</div>
	<?php endif; ?>

	<?php if ($registration->messages) : ?>
		<div class="alert alert-primary" role="alert">
			<?php	
				foreach ($registration->messages as $message) :
					echo $message;
				endforeach;
			?>
		</div>
	<?php endif; ?>

	<div class="d-flex justify-content-center align-items-center">
		<div style="max-width: 320px; width: 100%;">
			<form method="post" action="index.php?view=registration" name="registerform">
				<div class="form-group">
					<label for="Login">Логин</label>
					<input type="text" class="form-control" id="Login" placeholder="буквы и цифры, от 2 до 64 знаков" pattern="[a-zA-Z0-9]{2,64}" name="user_name" required>
				</div>
				<div class="form-group">
					<label for="Password">Пароль</label>
					<input type="password" class="form-control" id="Password" placeholder="Минимум 6 знаков" name="user_password_new" pattern=".{6,}" required autocomplete="off">
				</div>
				<div class="form-group">
					<label for="Password">Повторите Пароль</label>
					<input type="password" class="form-control" id="Password" placeholder="Минимум 6 знаков" name="user_password_repeat" pattern=".{6,}" required autocomplete="off">
				</div>

				<button type="submit" class="btn btn-primary" name="register">Зарегистрироваться</button>
			</form>

			<div class="mt-3">
				<a href="index.php">Назад на Главную</a>
			</div>
		</div>
	</div>
</div>