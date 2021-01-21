<!DOCTYPE html>
<?php
	require_once 'CLASSES/db_register.php';
	$u = new User();
?>

<html lang="pt-br">
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="CSS/estilo.css">    
</head>
<body>
    <div id="form-card">
        <form method="POST">
            <h1>Register</h1>
            <label>Name:</label><input type="text" name="name" id="name" maxlength="40" required>
            <label>Date of Birth:</label><input type="date" name="dtbirth" id="dtbirth" format="Y-m-d" maxlength="8" required> <!-- the Y-m-d is the default date format for SQL database -->
            <label>Phone Number:</label><input type="tel" name="tel" id="tel" required>
            <label>E-mail:</label><input type="email" name="email" id="email" maxlength="40" required>
            <label>Password (between 6-8 characters):</label><input type="password" name="psw" id="psw" maxlength="8" minlength="6" required>
            <label>Confirm Your Password:</label><input type="password" name="confpsw" id="confpsw" maxlength="8" minlength="6" required>
            <input type="submit" value="Register" id="register" name="register"><br>
        </form>
    </div>

<?php
if(isset($_POST['name'])){
	$name = addslashes($_POST['name']);
	$dtbirth = addslashes($_POST['dtbirth']);
    $tel = addslashes($_POST['tel']);
    $email = addslashes($_POST['email']);
	$psw = addslashes($_POST['psw']);
	$confpsw = addslashes($_POST['confpsw']);
	

    if(!empty($name) && !empty($dtbirth) && !empty($tel) && !empty($email) && !empty($psw) && !empty($confpsw)){
		$u->conct("YOUR_DATABASE_NAME","HOST_IP","MySQL_USER","PASSWORD"); //fill with your database configuration
		if($u->msgErr == ""){
            if($psw == $confpsw){   
                if($u->register($name, $dtbirth, $tel, $email, $psw)){
                    ?>
                    <div id="msg-success">
                        <p>Successfully registered.</p>
                    </div>
                    <?php
                }else{
                    ?>
                    <div class="msg-err">
                        <p>This e-mail is already registered.</p>
                    </div>
                    <?php
                }
            }else{
                ?>
                <div class="msg-err">
                    <p>Password and Confirm Your Password are not the same.<p>
                </div>
                <?php
            }
        }else{
			?>
			<div class="msg-err">
				<p><?php echo "Error: ".$msgErr; ?></p>
			</div>
			<?php
		}
	}else{
		?>
		<div class="msg-err">
			<p>Fill all the information required.</p>
		</div>
		<?php
	}
}
?>
</body>
</html>
