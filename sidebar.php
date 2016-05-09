<div class="sidebar-inner">
    <?php include 'part/user-log-in-out.php'; ?>
    <?php if ( is_active_sidebar( 'family_right' ) ) : ?>
        <?php dynamic_sidebar( 'family_right' ); ?>
    <?php endif; ?>
</div>