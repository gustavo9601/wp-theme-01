</main>
<footer>
    <?php
    if (has_nav_menu('social_menu')):
        wp_nav_menu([
            'theme_location' => 'social_menu',  # Ubicacion del menu
            'container' => 'nav', # elemento contenedor'
            'container_class' => 'SocialMedia'  # clase a aplicar al contenedor
        ]);
    endif;
    ?>

    <?php
    if (get_option('mawt_footer_text') !== ''):
        echo '<p><small>Esta es la opcion desde el administrador : mawt_footer_text' . esc_html(get_option('mawt_footer_text')) . '</small></p>';
    else:
        echo '<p><small>&copy; ' . date('Y') . 'Developed by @gustavomp</small></p>';
    endif;
    ?>

</footer>
<?php wp_footer(); ?>
</body>
</html>