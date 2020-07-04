<?php

if (!function_exists('mawt_custom_theme_options_menu')):
    function mawt_custom_theme_options_menu()
    {

        #add_menu_page('Titulo de la pagina a agregar', 'Titulo en el menu', 'Rol que vera la opcion', 'slug de la pagina', 'funcion callback a ejecutar cuando se abra', 'icono', posicion de 5 en 5);
        add_menu_page('Ajustes del tema MAWT', 'Ajustes del tema', 'administrator', 'mawt_settings', 'mawt_custom_theme_options_form', 'dashicons-admin-generic', 20);
    }
endif;

# Cuando cargue las opciones del menu
add_action('admin_menu', 'mawt_custom_theme_options_menu');

# Funcion que retornara las opciones o formulario
if (!function_exists('mawt_custom_theme_options_form')):
    function mawt_custom_theme_options_form()
    {
        ?>
        <!--Html del formulario u opciones para la pagina del de ajustes-->
        <div class="wrap">
            <h1><?php _e('Ajustes y opciones del tema MAWT', 'mawt') ?></h1>
            <!--Se debe enviar al options.php-->
            <form action="options.php" method="post">
                <?php
                # Agregando la agrupacion de los campos (creada en la funcion de abajo)
                settings_fields('mawt_options_group');
                # ejecutando cuando se realice el submit y realiza el redirect a la misma pagina
                do_settings_sections('mawt_options_group');
                ?>
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row">
                            Texto del footer
                        </th>
                        <td>
                            <!--Para que muestre de nuevo el valor almacenado
                            esc_attr() escapea los valores
                            get_option('name del input enviado')
                            -->
                            <input type="text" name="mawt_footer_text" value="<?php echo esc_attr(get_option('mawt_footer_text')); ?>">
                        </td>
                    </tr>
                </table>
                <!--Pinta un boton de envio-->
                <?php submit_button(); ?>
            </form>
        </div>
<?php

    }
endif;


# Funcion que registra el campo y se pueda almacenar la opcion
if (!function_exists('mawt_custom_theme_options_register')):
    function mawt_custom_theme_options_register()
    {

        //Un registro por opcion del tema,
        #register_setting('nombre de agrupacion de todas las funciones', 'name del input de la opcion agregada');
        register_setting('mawt_options_group', 'mawt_footer_text');
    }
endif;

# Cuando cargue las opciones del menu
add_action('admin_init', 'mawt_custom_theme_options_register');

