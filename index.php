<!DOCTYPE html>
<?php
	require_once 'CLASSES/db_register.php';
	$u = new User();
?>

<html>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="CSS/estilo.css">    
</head>

<body>
<div id="form-card">
    <form method="POST">    
        <h1>Login</h1>
        <label>E-mail:</label><input type="email" name="email" id="email" required>
        <label>Password:</label><input type="password" name="psw" id="psw" minlength="6" maxlength="8" required><br>
        <input type="submit" value="Login" id="login" name="login">
        <a href="register.php">Aren't you registered yet? <strong>Register now!</strong></a>
    </form>
</div>

<?php
if(isset($_POST['email'])){
	$email = addslashes($_POST['email']);
	$psw = addslashes($_POST['psw']);
	
	if(!empty($email) && !empty($psw)){
		$u->conct("YOUR_DATABASE_NAME","HOST_IP","MySQL_USER","PASSWORD"); //fill with your database configuration
		if($msgErr == ""){
			if($u->login($email,$psw)){
				header("location: private.php");
			}else{
				?>
				<div class="msg-err">
					<p>E-mail or password is wrong.</p>
				</div>
				<?php
			}
		}else{
			?>
			<div class="msg-err">
				<?php echo "Error: ".$msgErr; ?>
			</div>
			<?php
		}
	}else{
		?>
		<div class="msg-err">
			<p>Fill all the login information.</p>
		</div>
		<?php
	}
}
?>
</body>
</html>
