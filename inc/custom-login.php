<?php
//Evalua si la funcion pasada por parametro no exsite
if (!function_exists('mawt_login_scripts')):
    function mawt_login_scripts()
    {
//Registrar una hoja de estilos
        wp_register_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap', [], '1.0.0', 'all');
        wp_register_style('style_login', get_template_directory_uri() . '/css/login_page.css', ['google-fonts'], '', 'all');

//Ejecutando la hoja de estilos
        wp_enqueue_style('google-fonts');
        wp_enqueue_style('style_login');

//Registrando scripts
//get_template_directory_uri()  -> retorna el path hasta el directorio raiz del tema
//true -> carga en el footer y false en el header
        wp_register_script('script_login', get_template_directory_uri() . '/js/login_page.js', ['jquery'], '1.0.0', true);

//Ejecutando los scripts
        wp_enqueue_script('jquery'); //cargando jquery por default de wordpress
        wp_enqueue_script('script_login');
    }
endif;
//Invocando la funcion para registrar e insertar en el login
add_action("login_enqueue_scripts", 'mawt_login_scripts');

#Modificando el enlace que lleva por defecto el logo de inicio de sesion
if (!function_exists('mawt_login_logo_url')):
    function mawt_login_logo_url()
    {
        # retornado el url que llevara el enlace
        return home_url();
    }
endif;

# añade el hook para cargarlo
add_filter('login_headerurl', 'mawt_login_logo_url');


#Modificando el title que lleva el enlace de iniciar sesion
if (!function_exists('mawt_login_logo_url_title')):
    function mawt_login_logo_url_title()
    {
        # retornado el valor que llevara el title del enlace
        return get_bloginfo('title') . ' | ' . get_bloginfo('description');
    }
endif;

# añade el hook para cargarlo
add_filter('login_headertitle', 'mawt_login_logo_url_title');