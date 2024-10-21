<div class="reg-div">
  <form action="send-password-reset.php" method="POST" class="reg-form">
    <h2>Passwort  zurück  setzen</h2>
    <p class="header-p">Wir senden dir eine Email</p>
    <?php if (isset($message)) : ?>
      <p class="message-error"><?php echo e($message) ?></p>
    <?php endif ?>
    
    <label for="email"></label>
    <input type="email" id="email" name="email" placeholder="Email"  required>
    <button type="Submit"><i class="fa fa-paper-plane" aria-hidden="true"></i> Senden</button>

    <a class="anker" href="reg.php">Ich bin noch nicht registriert!</a>
    <a class="anker" href="index.php">Zum Login</a>
    
  </form>
</div>