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
				<div class="login-block">
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

					<div class="d-flex justify-content-center align-items-center">
						<div style="max-width: 320px; width: 100%;">
							<form method="post" action="./login" name="loginform">
								<div class="form-group">
									<label for="Login">Login</label>
									<input type="text" class="form-control" id="Login" placeholder="Login" name="user_name" required>
								</div>
								<div class="form-group">
									<label for="Password">Password</label>
									<input type="password" class="form-control" id="Password" placeholder="Password" name="user_password" autocomplete="off" required>
								</div>

								<button type="submit" class="btn btn-primary" name="login">Login</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<?php include 'blocks/footer.php'; ?>
		
		<?php include 'blocks/scripts.php'; ?>
		
	</body>
</html>