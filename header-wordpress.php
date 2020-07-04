<header class="WP-header">
    <?php
    # pregunta si se configuro alguna imagen para el custom header
    if (has_custom_header()){
        the_custom_header_markup();
    }
    ?>
    <div class="WP-Header-branding">
        <h1 class="WP-header-title">
            <a href="<?php home_url('/'); ?>"><?php bloginfo('name'); ?></a>
        </h1>
        <p class="WP-Header-description">
            <?php bloginfo('description'); ?>
        </p>
    </div>
</header>