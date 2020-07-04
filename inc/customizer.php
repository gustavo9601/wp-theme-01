<?php

if (!function_exists('mawt_customize_register')):

    #$wp_customize  variable global
    function mawt_customize_register($wp_customize)
    {
        # obtiene los valores de la variable global, y los envia al personalizador con trasnport='postMessage'
        $wp_customize->get_setting('blogname')->transport = 'postMessage';
        $wp_customize->get_setting('blogdescription')->transport = 'postMessage';
        # si esta activo en el function widgets refresh
        if (isset($wp_customize->selective_refresh)) {
            # añade la funcionalidad para enviar eb ek oersibakuzador el cambio automatico
            $wp_customize->selective_refresh->add_partial('blogname', [
                'selector' => '.WP-Header-title',  # selector que contiene el texto dinamicamente en el html
                'render_callback' => 'mawt_customize_blogname',  # llamara la funcion como callback
            ]);
            $wp_customize->selective_refresh->add_partial('blogdescription', [
                'selector' => '.WP-Header-description',  # selector que contiene el texto dinamicamente en el html
                'render_callback' => 'mawt_customize_blogdescription',  # llamara la funcion como callback
            ]);
        }
    }
endif;

/*
 * Funciones callback que imprimen informacion editada
 * */
if (!function_exists('mawt_customize_blogname')):
    function mawt_customize_blogname(){
        bloginfo('name');
    }
endif;

if (!function_exists('mawt_customize_blogdescription')):
    function mawt_customize_blogdescription(){
        bloginfo('description');
    }
endif;