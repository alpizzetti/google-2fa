<?php
class userClass
{
     /* Login do Usuário */
     public function userLogin($usernameEmail, $password, $secret)
     {

          $db = getDB();
          $hash_password = hash('sha256', $password);
          $stmt = $db->prepare("SELECT uid FROM users WHERE (email=:usernameEmail) AND password=:hash_password");
          $stmt->bindParam("usernameEmail", $usernameEmail, PDO::PARAM_STR);
          $stmt->bindParam("hash_password", $hash_password, PDO::PARAM_STR);
          $stmt->execute();
          $count = $stmt->rowCount();
          $data = $stmt->fetch(PDO::FETCH_OBJ);
          $db = null;
          if ($count) {
               $_SESSION['uid'] = $data->uid;
               $_SESSION['google_auth_code'] = $google_auth_code;
               return true;
          } else {
               return false;
          }
     }

     /* Registro do Usuário */
     public function userRegistration($password, $email, $name, $secret)
     {
          try {
               $db = getDB();
               $st = $db->prepare("SELECT uid FROM users WHERE email=:email");
               $st->bindParam("email", $email, PDO::PARAM_STR);
               $st->execute();
               $count = $st->rowCount();
               if ($count < 1) {
                    $stmt = $db->prepare("INSERT INTO users(password,email,name,google_auth_code) VALUES (:hash_password,:email,:name,:google_auth_code)");
                    $hash_password = hash('sha256', $password);
                    $stmt->bindParam("hash_password", $hash_password, PDO::PARAM_STR);
                    $stmt->bindParam("email", $email, PDO::PARAM_STR);
                    $stmt->bindParam("name", $name, PDO::PARAM_STR);
                    $stmt->bindParam("google_auth_code", $secret, PDO::PARAM_STR);
                    $stmt->execute();
                    $uid = $db->lastInsertId();
                    $db = null;
                    $_SESSION['uid'] = $uid;
                    return true;
               } else {
                    $db = null;
                    return false;
               }
          } catch (PDOException $e) {
               echo '{"error":{"text":' . $e->getMessage() . '}}';
          }
     }

     /* Detalhes do Usuário */
     public function userDetails($uid)
     {
          try {
               $db = getDB();
               $stmt = $db->prepare("SELECT email,name,google_auth_code FROM users WHERE uid=:uid");
               $stmt->bindParam("uid", $uid, PDO::PARAM_INT);
               $stmt->execute();
               $data = $stmt->fetch(PDO::FETCH_OBJ);
               return $data;
          } catch (PDOException $e) {
               echo '{"error":{"text":' . $e->getMessage() . '}}';
          }
     }
}
