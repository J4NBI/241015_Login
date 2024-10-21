<h1 style="text-align: center">Reset Password</h1>
<?php if (isset($message)) : ?>
      <p class="message-error"><?php echo e($message) ?></p>
<?php endif ?>

    <form method="post" action="process-reset-password.php">

        <input type="hidden" name="token" value="<?= htmlspecialchars($token_hash) ?>">
        <input type="hidden" name="send" value="1">

        <label for="password">New password</label>
        <input type="password" id="password" name="password">

        <label for="password_confirmation">Repeat password</label>
        <input type="password" id="password_confirmation"
               name="password_confirmation">

        <button>Send</button>
    </form>
    