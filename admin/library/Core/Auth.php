<?php
class Auth {
	
	public function Login() {
		if ( !empty($_POST['user_name']) && !empty($_POST['user_password']) ) {
			
			session_start();
			
			$login = $_POST['user_name'];
			
			# Check if user exist
			# Get Data from file
			$file = 'data/users.txt';
			$currentData = json_decode( file_get_contents($file) );
			
			# If data has info
			if ( count($currentData) ) :
				foreach ( $currentData as $key => $user ) :
					# if user exist
					if ( $login == $user->login ) :
						// using PHP 5.5's password_verify() function to check if the provided password fits
						// the hash of that user's password
						if ( password_verify( $_POST['user_password'], $user->password ) ) {

							// write user data into PHP SESSION (a file on your server)
							$_SESSION['user_name'] = $login;
							$_SESSION['user_access'] = $user->access;
							$_SESSION['user_login_status'] = 1;
							
						}
					endif;
				endforeach;
			endif;
			
			global $app;
			
			header('Location: '.$app->baseurl);
			die();
			
		} else {
			$this->errors[] = "Enter correct login and password";
			
			$view = new View();
			return $view->render( $this, 'tmpl/login.php');
		}
	}
	

    public function Logout()
    {
		session_start();
		
        // delete the session of the user
        $_SESSION = array();
        session_destroy();
		
		global $app;
		
		header('Location: '.$app->baseurl.'/login');
		die();

    }
	
	public static function isUserLoggedIn() {
		session_start();
		
        if (isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] == 1) {
            return true;
        }

        return false;
	}
	
	public static function isUserAdmin()
    {
		session_start();
		
        if ( isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] == 1 AND $_SESSION['user_access'] == 9 ) {
            return true;
        }

        return false;
    }
	
	public function Registration() {

		# Если это не пост запрос на регистрацию
		if ( !isset($_POST["register"]) ) {
			
			$view = new View();
			
			return $view->render( $this, 'tmpl/registration.php');
		
		# Если это пост запрос на регистрацию юзера
		} else {
			
			if (empty($_POST['user_name'])) {
				$this->errors[] = "Empty Username";
			} elseif (empty($_POST['user_password_new']) || empty($_POST['user_password_repeat'])) {
				$this->errors[] = "Empty Password";
			} elseif ($_POST['user_password_new'] !== $_POST['user_password_repeat']) {
				$this->errors[] = "Password and password repeat are not the same";
			} elseif (strlen($_POST['user_password_new']) < 6) {
				$this->errors[] = "Password has a minimum length of 6 characters";
			} elseif (strlen($_POST['user_name']) > 64 || strlen($_POST['user_name']) < 2) {
				$this->errors[] = "Username cannot be shorter than 2 or longer than 64 characters";
			} elseif (!preg_match('/^[a-z\d]{2,64}$/i', $_POST['user_name'])) {
				$this->errors[] = "Username does not fit the name scheme: only a-Z and numbers are allowed, 2 to 64 characters";
			} elseif (!empty($_POST['user_name'])
				&& strlen($_POST['user_name']) <= 64
				&& strlen($_POST['user_name']) >= 2
				&& preg_match('/^[a-z\d]{2,64}$/i', $_POST['user_name'])
				&& !empty($_POST['user_password_new'])
				&& !empty($_POST['user_password_repeat'])
				&& ($_POST['user_password_new'] === $_POST['user_password_repeat'])
			) {
			
				$login = strip_tags($_POST['user_name'], ENT_QUOTES);			
				$password = $_POST['user_password_new'];

				# crypt the user's password with PHP 5.5's password_hash() function, results in a 60 character
				# hash string. the PASSWORD_DEFAULT constant is defined by the PHP 5.5, or if you are using
				# PHP 5.3/5.4, by the password hashing compatibility library
				$passwordHash = password_hash($password, PASSWORD_DEFAULT);
				
				# Check if user exist
				# Get Data from file
				$file = 'data/users.txt';
				$currentData = json_decode( file_get_contents($file) );
				
				# If data has info
				if ( count($currentData) ) :
					foreach ( $currentData as $key => $user ) :
						# if user exist
						if ( $login == $user->login ) :
							$this->errors[] = "This user already exists";
							return;
						endif;
					endforeach;
				endif;
				
				# If data not empty (clear file)
				if ( $currentData ) :
					$currentData[] = [
						'login' => $login,
						'password' => $passwordHash,
						'access' => '1'
					];
					
					$data = $currentData;
				else :
					$data = [
						[
							'login' => $login,
							'password' => $passwordHash,
							'access' => '1'
						]
					];
				endif;
				
				$dataJson = json_encode($data);
				
				# Save Data to file
				file_put_contents($file, $dataJson);
				
				$this->messages[] = 'You have successfully registered, now you can enter the admin panel: <a href="index.php">enter</a>';
			} else {
				$this->errors[] = "Sorry, an error occurred";
			}
			
			$view = new View();
			return $view->render( $this, 'tmpl/registration.php');
			
		}
	}
	
	public function EditProfile() {
		return 'EditProfile';
	}
}
