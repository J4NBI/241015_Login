<div class="reg-div">
  <form action="index.php" method="POST" class="reg-form">
    <h2>Anmelden</h2>
    <p class="header-p">Hier bitte  einloggen! </p>
    <?php if (isset($messageIndex)) : ?>
      <p class="message-error"><?php echo e($messageIndex) ?></p>
    <?php endif ?>
    
    <label for="email"></label>
    <input type="email" id="email" name="email" placeholder="Email"  required>
    <label for="passwort"></label>
    <input type="password" id="passwort" name="passwort" placeholder="Passwort" minlength="8" required>
    <div class="btns">
      <button type="Submit"><i class="fa fa-paper-plane" aria-hidden="true"></i> Anmelden</button>
    </div>
    <a class="anker" href="reg.php">Ich bin noch nicht registriert</a>
    <a class="anker" href="passreset.php">Passwort vergessen</a>
  </form>
</div>