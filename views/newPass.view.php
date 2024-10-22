<h1 style="text-align: center">Reset Password</h1>

<form method="post" action="process-reset-password.php">

    <?php if (isset($message)) : ?>
    <p class="message-error"><?php echo e($message) ?></p>
    <?php endif ?>

    <input type="hidden" name="token_hash" value="<?= htmlspecialchars($token_hash) ?>">
    <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

    
    <div class="password-field">
        <label class="label-pw" for="password">New password</label>
        <div class="password-content">
            <input type="password" id="password" name="password" required minlength="8">
            <span class="password-toggle">
                <i class="fa fa-eye" aria-hidden="true"></i>
            </span>
        </div>
        <p class="p-pass">&nbsp 8 Zeichen, Groß-/Kleinbuchstabe(n) + Zahl(en)  + Sonderzeichen</p>
    </div>
    

    <div class="password-field">
        <label class="label-pw" for="password_confirmation">Repeat password</label>
        <div class="password-content">
            <input type="password" id="password_confirmation" name="password_confirmation" required minlength="8">
            <span class="password-confirmation-toggle">
                <i class="fa fa-eye" aria-hidden="true"></i>
            </span>
        </div>

    <button>Send</button>
</form>

<script>
    
    const passwordField = document.getElementById('password');
    const passwordToggle = document.querySelector('.password-toggle i');
    const passwordConField = document.getElementById('password_confirmation');
    const passwordConToggle = document.querySelector('.password-confirmation-toggle i');

    //Eventlistener Icon Passwort
    passwordToggle.addEventListener('click', () => {
        
        // Switch 
        if (passwordField.type === 'password') {
            
            passwordField.type = 'text';
            
            passwordToggle.classList.remove('fa-eye');
            passwordToggle.classList.add('fa-eye-slash');
        } else {
            
            passwordField.type = 'password';
           
            passwordToggle.classList.remove('fa-eye-slash');
            passwordToggle.classList.add('fa-eye');
        }
    });

    //Eventlistener Icon Passwort Confirmatiom
    passwordConToggle.addEventListener('click', () => {
        
        // Switch 
        if (passwordConField.type === 'password') {
            
            passwordConField.type = 'text';
            
            passwordConToggle.classList.remove('fa-eye');
            passwordConToggle.classList.add('fa-eye-slash');
        } else {
            
            passwordConField.type = 'password';
           
            passwordConToggle.classList.remove('fa-eye-slash');
            passwordConToggle.classList.add('fa-eye');
        }
    });
</script>