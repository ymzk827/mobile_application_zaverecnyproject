<?php 
namespace data;

require_once('database.php');
require_once('sendmail.php');

use PDO;
use PDOException;
use Database;
use mailSender;


class userManager extends Database {
    public $confirmation = FALSE;

    public function generateCode($length = 5) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomCode = '';
        
        for ($i = 0; $i < $length; $i++) {
            $randomCode .= $characters[rand(0, $charactersLength - 1)];
        }
        
        return $randomCode;
    }

    public function register($login, $email, $heslo, $rola = 'user', $act){  
        try{
            $hashed_password = password_hash($heslo, PASSWORD_BCRYPT);
            $sql = 'SELECT * from user WHERE (login = ? or email = ?) LIMIT 1';
            $statement = $this->conn->prepare($sql);
            $statement->bindParam(1, $login);
            $statement->bindParam(2, $email);
            $statement->execute();
            $existingUser = $statement->fetch();

            $regcode = $this->generateCode();
            $MS = new \data\mailSender();

            if($existingUser){
                throw new \Exception("User already exists.");
            }

            $sql = 'INSERT INTO user (login, email, heslo, rola, regcode, act_status) VALUES (?, ?, ?, ?, ?, ?)';
            $statement = $this->conn->prepare($sql);
            $statement->bindParam(1, $login);
            $statement->bindParam(2, $email);
            $statement->bindParam(3, $hashed_password);
            $statement->bindParam(4, $rola);
            $statement->bindParam(5, $regcode);
            $statement->bindParam(6, $act);
            $statement->execute();
            $MS->sendMail($email, $login, $regcode);
            echo '<script>alert("Register succeful");</script>';
            echo '<script type="text/javascript">',
                    'window.location.replace("http://127.0.0.1/edsa-project/confirmation.php");',
                '</script>';

            
        } catch (Exception $e){
            echo "Chyba pri vkladani dát do DB: " . $e->getMessage();
        } finally {
            $this->conn = null;
        }
    }

    public function login($email, $heslo){  
            $hashed_password = password_hash($heslo, PASSWORD_BCRYPT);
            $sql = 'SELECT * from user WHERE login = ?';
            $statement = $this->conn->prepare($sql);
            $statement->bindParam(1, $email);
            $statement->execute();
            $user = $statement->fetch();

            if(!$user){
                echo "❌ User doesnt exist";
                return;
            }

            if ($user['act_status'] !== 'true') {
                echo "❌ Account not activated! Please check your e-mail and follow the instructions";
                return;
            }

            $storedPass = $user['heslo'];

            if(!password_verify($heslo, $storedPass)){
                echo "❌ Wrong password";
                return;
            }

            session_start();
            $_SESSION['user_id'] = $user["id"];
            $_SESSION['login'] = $user["login"];
            $_SESSION['rola'] = $user["rola"];
            echo '<script type="text/javascript">',
                    'window.location.replace("http://127.0.0.1/edsa-project/");',
                '</script>';

        } 

        //funkcia ktora vytvorena na uverenie učtu použivateľov.
        public function activate($email, $code){  
            $sql = "SELECT * FROM user WHERE email = ? AND regcode = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(1, $email);
            $stmt->bindParam(2, $code);
            $stmt->execute();
            $user = $stmt->fetch();
        
            if ($user) {
                $update = "UPDATE user SET act_status = 'true' WHERE email = ?";
                $stmt = $this->conn->prepare($update);
                $stmt->bindParam(1, $email);
                $stmt->execute();
        
                echo "✅ Účet bol úspešne aktivovaný!";
                $MS = new \data\mailSender();
                $MS->sendMailConfirmed($email);
                echo '<script>setTimeout(function(){ window.location.href = "loginpage.php"; }, 3000);</script>';
            } else {
                echo "❌ Invalid mail/expired code";
            } 

    }}

?>