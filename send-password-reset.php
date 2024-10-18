<?php
require_once __DIR__ . '/inc/all.php';

$email = $_POST['email'];

$token = bin2hex(random_bytes(16));

$token_hash = hash("sha256", $token);

$expiry = date('Y-m-d H:i:s', time() + 60 * 30);


try {
  $stmt = $pdo->prepare('UPDATE users SET 
                        reset_token_hash = :token_hash,
                        reset_token_expires_at = :expiry
                        WHERE email = :email');
  $stmt->bindValue('token_hash', $token_hash);
  $stmt->bindValue('expiry', $expiry);
  $stmt->bindValue('email', $email);

  $stmt->execute();
  $affectedRows = $stmt->rowCount();
    if ($affectedRows > 0) {
      $mail = require __DIR__ . "/mailer.php";

      $mail->setFrom("jan.bihl@gmx.de");
      $mail->addAddress($email);
      $mail->Subject = "Password Reset";
      $mail->Body = <<<END
  
      Click <a href="http://localhost/PHP/php_projekte_Jan/241015_Login/reset-password.php?token=$token">here</a> 
      to reset your password.
  
      END;
  
      try {
  
          $mail->send();
  
      } catch (Exception $e) {
  
          echo "Message could not be sent. Mailer error: {$mail->ErrorInfo}";
  
      }
    } else {
        echo "Email nicht registriert!";
    }
  
} catch (PDOException $e) {
  error_log("Error: " . $e->getMessage());
  var_dump("Error: Datenbank nicht erreichbar!");
}