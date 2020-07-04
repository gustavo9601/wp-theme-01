<?php

if (!function_exists('mawt_custom_header')):
    function mawt_custom_header()
    {
        /*Activa cabecera configurable*/
        # apply_filters  se le pasa uina funcion callback
        add_theme_support('custom-header', apply_filters('mawt_custom_header_args', [
            'default-image' => '',
            'default-text-color' => 'F60',
            'height' => 1200,
            'width' => 720,
            'flex-height' => true,
            'flex-width' => true,
            'video' => true,
            'wp-head-callback' => 'mawt_wp_header_style'  # funcion que permitira imprimir la configuracion en el persoalizador del dashboard
        ]));
    }
endif;

# Añadiendo la funcion al hook
add_action('after_setup_theme', 'mawt_custom_header');

if (!function_exists('mawt_wp_header_style')):
    function mawt_wp_header_style()
    {
        $header_text_color = get_header_textcolor();  # captura el color por default definido en la funcion de arriba, o el color que se configure desde el personalizador
        ?>
        <style>
            .WP-Header-branding * {
                /*esc_attr($header_text_color)  escapea los estilos*/
                color: <?php echo '#' . esc_attr($header_text_color); ?>;
            }
        </style>
        <?php
    }
endif;
?>




