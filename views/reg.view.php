<div class="reg-div">
  <form action="submit.php" method="POST" class="reg-form">
    <h2>Erstelle ein neues Konto</h2>
    <p class="header-p">Es geht ganz schnell und einfach.</p>
    <?php if (isset($message)) : ?>
      <p class="message-error"><?php echo e($message) ?></p>
    <?php endif ?>
    <hr>
    <div class="div-namen">
      <label for="vorname"></label>
      <input id="vorname" type="text" id="vorname" name="vorname" placeholder="Vorname" required 
      <?php if (isset($vorname) && !empty($vorname)) : ?>
              value="<?php echo $vorname ?>"
              <?php endif ?>>
      <label for="nachname"></label>
      <input type="text" id="nachname" name="nachname" placeholder="Nachname" required
      <?php if (isset($nachname) && !empty($nachname)) : ?>
              value="<?php echo e($nachname) ?>"
              <?php endif ?>>
    </div>
    
    <label for="email"></label>
    <input type="email" id="email" name="email" placeholder="Email" required
    <?php if (isset($email) && !empty($email)) : ?>
              value=" <?php echo e($email) ?>"
              <?php endif ?>>
    <label for="passwort"></label>
    <input type="password" id="passwort" name="passwort" placeholder="Passwort" required>
    <p class="p-pass"> 8 Zeichen, Groß-/Kleinbuchstabe(n) + Zahl(en)  + Sonderzeichen</p>
    <label for="passwort2"></label>
    <input type="password" id="passwort2" name="passwort2" placeholder="Passwort wiederholen" required>
    <div class="btns">
      <button type="Reset"><i class="fa fa-refresh" aria-hidden="true"></i> Reset</button>
      <button type="Submit"><i class="fa fa-paper-plane" aria-hidden="true"></i> Registrieren</button>
    </div>
    <a class="anker" href="index.php">Du  hast  bereits ein Konto?</a>
  </form>
</div>