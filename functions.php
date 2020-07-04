<?php

//Evalua si la funcion pasada por parametro no exsite
if (!function_exists('mawt_scripts')):
    function mawt_scripts()
    {


        //Registrar una hoja de estilos
        wp_register_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap', [], '1.0.0', 'all');
        wp_register_style('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css', [], '1.0.0', 'all');
        wp_register_style('style', get_stylesheet_uri(), ['bootstrap', 'google-fonts'], '', 'all');


        //Ejecutando la hoja de estilos
        wp_enqueue_style('google-fonts');
        wp_enqueue_style('bootstrap');
        wp_enqueue_style('style');

        //Registrando scripts
        //get_template_directory_uri()  -> retorna el path hasta el directorio raiz del tema
        //true -> carga en el footer y false en el header
        wp_register_script('scripts_js', get_template_directory_uri() . '/script.js', ['jquery'], '1.0.0', true);


        //Ejecutando los scripts
        wp_enqueue_script('jquery'); //cargando jquery por default de wordpress
        wp_enqueue_script('scripts_js');
    }
endif;
//Invocando la funcion de estilos
add_action("wp_enqueue_scripts", 'mawt_scripts');


if (!function_exists("mawt_setup")):
    function mawt_setup()
    {
        //Activando los post thumnails imagenes destacadas desde el dashboard
        add_theme_support('post-thumbnails');

        //Activa las etiquetas de html5 que renderiza en la vista
        add_theme_support('html5', [
            'comment-list',
            'comment-form',
            'search-form',
            'gallery',
            'caption'
        ]);

        //Activa el soporte para poder personalizar el logo
        add_theme_support('custom-logo', [
            'height' => 100,
            'widht' => 100,
            'flex-height' => true,  # añade la opcion para que el usuario pueda personalizar el tamaño
            'flex-width' => true, # añade la opcion para que el usuario pueda personalizar el tamaño
        ]);


        //Activa el soporte para poder anañidr un fondo al sitio desde el personalizador
        add_theme_support('custom-background', [
            'default-color' => 'DDD',
            'default-image' => '', # path imagen
            'default-repeat' => 'repeat',
            'default-position-x' => '',
            'default-position-y' => '',
            'default-size' => '',
            'default-attachment' => 'fixed'
        ]);


        //Activa el soporte para mostrar desde el personalizador los widgets, y el refresh automatico
        add_theme_support('customize-selective-refresh-widgets');

        //Activa el soporte de traduccion (domain text, ruta donde estara el archivo de traduccion)
        load_theme_textdomain('mawt', get_template_directory_uri() . '/languages');

    }
endif;
//Agregando el hook de la funcion
add_action('after_setup_theme', 'mawt_setup');


//Activando los menus en el deashboard
if (!function_exists("mawt_menus")):
    function mawt_menus()
    {

        # register_nav_menu();  si es solo uno
        #['id_ubicacion_en_dashboard', 'text que aparecera como nombre del menu']
        register_nav_menus([
            'main_menu' => __('Menu Principal', 'mawt'),
            'social_menu' => __('Menu Redes sociales', 'mawt'),
        ]);
    }
endif;
// init es como el ready de jquery
add_action('init', 'mawt_menus');


//Activando los widgets en el dashboard
if (!function_exists("mawt_register_sidebars")):
    function mawt_register_sidebars()
    {
        register_sidebar([
            'name' => __('Sidebar Principal', 'mawt'), # Nombre que aparecera en el dashboard
            'id' => 'main_sidebar',  # id que se usara para seleccionar el codigo para mostrar
            'description' => __('Este es el sidebar princiapl', 'mawt'),
            'before_widget' => '<article id class="Widget %2$s" id="%1$s">', # etiqueta html que encerrara al widget  # %1$s contador propio de wordpress
            'after_widget' => '</article>',
            'before_title' => '<h3>',
            'after_title' => '</h3>'
        ]);

        register_sidebar([
            'name' => __('Sidebar de pie de pagina', 'mawt'),
            'id' => 'footer_sidebar',
            'description' => __('Este es el sidebar princiapl', 'mawt'),
            'before_widget' => '<article id class="Widget %2$s" id="%1$s">', # etiqueta html que encerrara al widget  # %1$s contador propio de wordpress
            'after_widget' => '</article>',
            'before_title' => '<h3>',
            'after_title' => '</h3>'
        ]);

    }
endif;
// init es como el ready de jquery
add_action('widgets_init', 'mawt_register_sidebars');

#personaliza la cebecera de contenido
require_once get_template_directory() .'/inc/custom-header.php';
# Personaliza la actualizacion en tiempo real de titulo y decripcion
require_once get_template_directory() .'/inc/customizer.php';
# personaliza el login de inicio de sesion
require_once get_template_directory() .'/inc/custom-login.php';
# personaliza el dashboard administrativo
require_once get_template_directory() .'/inc/custom-admin.php';



# administracion de post types
require_once get_template_directory() .'/inc/custom-post-types.php';

# administracion de taxonomies
require_once get_template_directory() .'/inc/custom-taxonomies.php';

# administacion de metaboxes
require_once get_template_directory() .'/inc/custom-metaboxes.php';

# Añade la funcion para poder visualizar en las consultas del front, los custom type creados y taxonomies
require_once get_template_directory() .'/inc/custom-per-get-posts.php';

# Customizacion y ajustes del tema
require_once  get_template_directory() . '/inc/custom-theme-options.php';

# Customiza el formulario de contacto, y lo almcena en una tabla nueva los registros enviados
require_once  get_template_directory() . '/inc/custom-contact-form.php';


?>



