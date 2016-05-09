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
            background-color: #d8ded7;
        }
        .login-form .remember-me .text {
            float:left;
        }
    </style>
    <script>
        jQuery( function( $ ) {
            var $log_in_form = $('section.log-in form');
            $log_in_form.submit ( function (e) {
                e.preventDefault();
                on_submit();
                var $form = $(this);
                var url = $form.prop('action') + '?' + $form.serialize();
                console.log(url);
                $.post(url, function(re) {
                    on_result(re);
                });
            });
            function on_submit() {
                $log_in_form.find('.line.spinner').show();
                $log_in_form.find('.line.submit').hide();
                $log_in_form.find('.line.error').hide();
            }
            function on_result(re) {
                var $error = $('.line.error');
                setTimeout(function(){
                    $('.line.spinner').hide();
                    if ( re['success'] == false ) {
                        $('.line.submit').show();
                        $error.html( '<i class="fa fa-exclamation-triangle"></i> ' + re['message'] );
                        $error.show();
                    }
                    else if ( typeof re['success'] == 'undefined' ) {
                        $('.line.submit').show();
                        $error.html( '<i class="fa fa-exclamation-triangle"></i> Server Internal Error ...');
                        $error.show();
                    }
                    else {
                        location.reload();
                    }
                }, 500);
            }

        });
    </script>

    <section class="login-form">
        <form action="<?php echo home_url('/forum/submit')?>" method="POST">
            <input type="hidden" name="do" value="login">
            <?php wp_nonce_field('log-in'); ?>

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

