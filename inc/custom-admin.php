<?php
//Evalua si la funcion pasada por parametro no exsite
if (!function_exists('mawt_admin_scripts')):
    function mawt_admin_scripts()
    {
//Registrar una hoja de estilos
        wp_register_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap', [], '1.0.0', 'all');
        wp_register_style('style_admin', get_template_directory_uri() . '/css/admin_page.css', ['google-fonts'], '', 'all');

//Ejecutando la hoja de estilos
        wp_enqueue_style('google-fonts');
        wp_enqueue_style('style_admin');

//Registrando scripts
//get_template_directory_uri()  -> retorna el path hasta el directorio raiz del tema
//true -> carga en el footer y false en el header
        wp_register_script('script_admin', get_template_directory_uri() . '/js/admin_page.js', ['jquery'], '1.0.0', true);

//Ejecutando los scripts
        wp_enqueue_script('jquery'); //cargando jquery por default de wordpress
        wp_enqueue_script('script_admin');
    }
endif;
//Invocando la funcion para registrar e insertar en el login
add_action("admin_enqueue_scripts", 'mawt_admin_scripts');


# Editando la visualizacion del editor por default de wordpress
if (!function_exists('mawt_add_editor_styles')):
    function mawt_add_editor_styles(){
    # inyecta las hojas de estilo en el editor
        add_editor_style('https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap');
        add_editor_style('/css/admin_page.css');
    }
endif;

add_action('admin_init', 'mawt_add_editor_styles');


# Funcion para remover o modificar el menu del dashboard
if (!function_exists('mawt_admin_menu')):
    function mawt_admin_menu(){
        # remove_menu_page( 'index.php' );                  //Dashboard
        # remove_menu_page( 'jetpack' );                    //Jetpack*
        # remove_menu_page( 'edit.php' );                   //Posts
        # remove_menu_page( 'upload.php' );                 //Media
        # remove_menu_page( 'edit.php?post_type=page' );    //Pages
        # remove_menu_page( 'edit-comments.php' );          //Comments
        # remove_menu_page( 'themes.php' );                 //Appearance
        # remove_menu_page( 'plugins.php' );                //Plugins
        # remove_menu_page( 'users.php' );                  //Users
        # remove_menu_page( 'tools.php' );                  //Tools
        # remove_menu_page( 'options-general.php' );        //Settings
    }
endif;
add_action( 'admin_menu', 'mawt_admin_menu' );

#Eliminar de la barra de menu superior alguna opcion
if (!function_exists('mawt_before_admin_bar')):
    function mawt_before_admin_bar(){
        global $wp_admin_bar;
        # eliminara las opciones pasadas por parametro
        $wp_admin_bar->remove_menu('wp-logo');
        #$wp_admin_bar->remove_menu('new-content');
        $wp_admin_bar->remove_menu('comments');
        $wp_admin_bar->remove_menu('update-core');
    }
endif;

add_action('wp_before_admin_bar_render', 'mawt_before_admin_bar');



# Crear nuevas barras de menu en el dashboard

if (!function_exists('mawt_new_options_bar_menu')):
    function mawt_new_options_bar_menu(){
        global $wp_admin_bar;

        $wp_admin_bar->add_menu([
           'id' => 'mi_menu',
           'title' => __('Mi menu', 'mawt'),
           'href' => false # hace que no redireccione a ninguna lado
        ]);

        $wp_admin_bar->add_menu([
            'parent' => 'mi_menu', # se define de cual hereda, su padre
            'id' => 'link-gm',
            'title' => __('Gustavo Marquez', 'mawt'),
            'href' => 'https://gustavo9601.github.io/curriculum/'
        ]);

        $wp_admin_bar->add_menu([
            'parent' => 'mi_menu', # se define de cual hereda, su padre
            'id' => 'link-facebook-gm',
            'title' => __('Facebook', 'mawt'),
            'href' => 'https://www.facebook.com/gustavo.marquezp',
            'meta' => [
                'class' => 'menu_facebook',  # añadiendo clase personalizada
            ],
        ]);
    }
endif;

add_action('admin_bar_menu', 'mawt_new_options_bar_menu');


# Agregando opciones a la opcion de administracion del perfil de usuario
if (!function_exists('mawt_user_contact_methods')):
    #$data_user recibe la palabra reservada $data_user
    function mawt_user_contact_methods($data_user){
        $data_user['facebook'] = __('Facebook');
        $data_user['twitter'] = __('Twiter');

        return $data_user;
    }
endif;
add_filter('user_contactmethods', 'mawt_user_contact_methods');

# cambiando el texto del footer de wordpress, donde da los creditos a wordpress
if (!function_exists('mawt_admin_footer_text')):
    function mawt_admin_footer_text(){
        return "
            <span>Powered By Gustavo Marquez P | <a href='https://gustavo9601.github.io/curriculum/'>Visita mi CV</a></span>
        ";
    }
endif;
add_filter('admin_footer_text', 'mawt_admin_footer_text');


# remover del dashboard escriotio, los metaboxes, campos de inicio de sesion primer pagina
if (!function_exists('mawt_wp_dashboard_setup')):
    function mawt_wp_dashboard_setup(){
    # remueve actividad
        remove_meta_box('dashboard_activity', 'dashboard', 'normal');

        remove_meta_box('dashboard_right_now', 'dashboard', 'normal');   // Right Now
        remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal'); // Recent Comments
        remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');  // Incoming Links
        remove_meta_box('dashboard_plugins', 'dashboard', 'normal');   // Plugins
        remove_meta_box('dashboard_quick_press', 'dashboard', 'side');  // Quick Press
        remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side');  // Recent Drafts
        remove_meta_box('dashboard_primary', 'dashboard', 'side');   // WordPress blog
        remove_meta_box('dashboard_secondary', 'dashboard', 'side');   // Other WordPress News
        // use 'dashboard-network' as the second parameter to remove widgets from a network dashbo
    }
endif;
add_action('wp_dashboard_setup', 'mawt_wp_dashboard_setup');
