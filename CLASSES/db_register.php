<?php
Class User{

    public function conct($dbname, $host, $user, $psw){
        global $pdo;
        global $msgErr;

        try{
        $pdo = new PDO("mysql:dbname=".$dbname.";host=".$host, $user, $psw);
        } catch (PDOException $e){
            $msgErr = $e->getMessage();
            throw new PDOException($e);
        }
    }

    public function register($name, $dtbirth, $tel, $email, $psw){
        global $pdo;

        $sql = $pdo->prepare("SELECT email FROM users WHERE email = :e");
        $sql->bindValue(":e", $email);
        $sql->execute();
            
        if($sql->rowCount() > 0){
            return false;
        }else{
            $sql = $pdo->prepare("INSERT INTO users (name, dtbirth, tel, email, password) VALUES (:n, :d, :t, :e, :p)");
            $sql->bindValue(":n", $name);
            $sql->bindValue(":d", $dtbirth);
            $sql->bindValue(":t", $tel);
            $sql->bindValue(":e", $email);
            $sql->bindValue(":p",md5($psw)); //md5 to encrypt the password 
            $sql->execute();

            return true;   
        }
    } 

    public function login($email, $psw){
        global $pdo;
		$sql = $pdo->prepare("SELECT id FROM users WHERE email = :e AND value = :p");
		$sql->bindValue(":u",$email);
		$sql->bindValue(":s",md5($psw)); //md5 again to read the encrypted password 
		$sql->execute();
		if($sql->rowCount() > 0){
			$data = $sql->fetch();
			session_start();
            $_SESSION['id'] = $data['id'];
			return true;
		}else{
			return false;
		}
	}
}
?>
