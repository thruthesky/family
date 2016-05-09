<?php
/**
 *
 * @file user-log-in-out.php
 *
 *
 * @description Displays user login form or user info.
 *
 *
 *
 *
 *
 *
 *
 *
 */
?>

<?php if ( is_user_logged_in() ) : ?>
    <style>
        .login-info {
            margin-top: 1em;
            padding: 1em;
            background-color: #e3e0cf;
        }
    </style>
    <section class="login-info">
        <?php
        $user = wp_get_current_user();
        ?>
        Welcome, <?php echo $user->user_login?>.
        <a href="<?php echo wp_logout_url($_SERVER['REQUEST_URI'])?>">Logout</a>
    </section>
<?php else: ?>

    <style>
        .login-form {
            margin-top: 1em;
            padding: 1em;
            background-color: #e3e0cf;
        }
        .login-form .remember-me .text {
            float:left;
        }
    </style>

    <section class="login-form">
        <form action="<?php echo home_url('/forum/submit')?>" method="POST">
            <?php wp_nonce_field('log-in'); ?>
            <input type="hidden" name="do" value="login">
            <input type="hidden" name="return_uri" value="<?php echo $_SERVER['REQUEST_URI']?>">

            <fieldset class="form-group">
                <label class="caption" for="user_login">User ID</label>
                <div class="text"><input type="text" name="user_login" maxlength="64" id="user_login" tabindex="100"></div>
            </fieldset>

            <fieldset class="form-group">
                <label class="caption" for="user_pass">Password</label>
                <div class="text"><input type="password" name="user_pass" maxlength="64" id="user_pass" tabindex="101"></div>
            </fieldset>

            <fieldset class="form-group remember-me">
                <div class="text"><input type="checkbox" name="rememberme" id="rememberme" tabindex="101"></div>
                <label class="caption" for="rememberme">Keep me logged-in</label>
            </fieldset>


            <div class="line spinner" style="display:none;">
                <i class="fa fa-spinner fa-spin"></i> Connecting to server ...
            </div>

            <div class="line error" style="display:none;"></div>

            <input class="btn btn-primary" type="submit" value="Log In" tabindex="121">

        </form>
    </section>

<?php endif; ?>

