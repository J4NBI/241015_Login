<h1 style="text-align: center">Reset Password</h1>
<p><?php ?></p>

    <form method="post" action="process-reset-password.php">

        <input type="hidden" name="token" value="<?= htmlspecialchars($token_hash) ?>">

        <label for="password">New password</label>
        <input type="password" id="password" name="password">

        <label for="password_confirmation">Repeat password</label>
        <input type="password" id="password_confirmation"
               name="password_confirmation">

        <button>Send</button>
    </form>
    