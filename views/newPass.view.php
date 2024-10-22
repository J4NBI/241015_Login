<h1 style="text-align: center">Reset Password</h1>


    <form method="post" action="process-reset-password.php">

        <?php if (isset($message)) : ?>
        <p class="message-error"><?php echo e($message) ?></p>
        <?php endif ?>

        <input type="hidden" name="token_hash" value="<?= htmlspecialchars($token_hash) ?>">
        <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

        <label for="password">New password</label>
        <input type="password" id="password" name="password" required minlength="8">
        <p class="p-pass">&nbsp 8 Zeichen, Groß-/Kleinbuchstabe(n) + Zahl(en)  + Sonderzeichen</p>

        <label for="password_confirmation">Repeat password</label>
        <input type="password" id="password_confirmation"
               name="password_confirmation" required minlength="8">

        <button>Send</button>
    </form>
    