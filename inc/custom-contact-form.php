<?php


#Funcion que consulta la BD, de la tabla nueva creada, para mostrar los contactos enviados por el front
if (!function_exists('mawt_contact_table')):
    function mawt_contact_table()
    {

        global $wpdb;
        global $contact_table_version;   # Definimos una variable para inicializar la version de la tabla

        $contact_table_version = '1.0.0';

        # devuelve el pregijo confiogurado al inicio de las tablas
        $table_name = $wpdb->prefix . 'contact_form_mawt';

        #Juego de cargarteres, lo tomamos de la configuracion inicial de WP
        $charset_collate_Table = $wpdb->get_charset_collate();

        # SQL de la tabla
        $sql = "CREATE TABLE {$table_name} (
            id mediumint(9) unsigned NOT NULL auto_increment,
            name LONGTEXT NOT NULL,
            email LONGTEXT NOT NULL,
            subject LONGTEXT NOT NULL,
            comments LONGTEXT NOT NULL,
            contact_date DATETIME NOT NULL,
            PRIMARY KEY  (id)
             ){$charset_collate_Table}";

        # requerimos el upgrade del core de wordpress
        # ABSPATH, retorna la ruta de instalacion de WP
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

        # Ejecuta el script sql, y recibe la sentencia como parametro
        dbDelta($sql, true);

        # Añade globalmente la version de la tabla
        add_action('contact_table_version', $contact_table_version);
    }
endif;

# Despues que carguen las opciones del menu
add_action('after_setup_theme', 'mawt_contact_table');

# Funcion que registra la o las pagginas en el menu
if (!function_exists('mawt_custom_contact_form_menu')):
    function mawt_custom_contact_form_menu()
    {
        #add_menu_page('Titulo de la pagina a agregar', 'Titulo en el menu', 'Rol que vera la opcion', 'slug de la pagina', 'funcion callback a ejecutar cuando se abra', 'icono', posicion de 5 en 5);
        add_menu_page('Formulario de contacto', 'Formulario de contacto', 'administrator', 'mawt_form_contact', 'mawt_custom_table_contact', 'dashicons-id-alt', 20);

        #add_submenu_page('slug del padre', 'Titulo de la pagina', 'Titulo del menu, 'rol que vera la opcion', 'slug', 'funcion calback para mostrar las opciones o vista de la pagina' );
        add_submenu_page('mawt_form_contact', 'Todos los contactos', 'Todos los contactos', 'administrator', 'mawt_form_contact_all', 'mawt_custom_table_contact');
    }
endif;

# Cuando cargue las opciones del menu
add_action('admin_menu', 'mawt_custom_contact_form_menu');

# Funcion que retornara las opciones o formulario para este caso la tabla de los envios
if (!function_exists('mawt_custom_table_contact')):
    function mawt_custom_table_contact()
    {
        ?>
        <div class="wrap">
            <h1><?php _e('Comentarios de la pagina de contacto', 'mawt') ?></h1>
            <table class="wp-list-table widefat striped">
                <thead>
                <tr>
                    <th class="manage-column"><?php _e('id', 'mawt'); ?></th>
                    <th class="manage-column"><?php _e('Nombre', 'mawt'); ?></th>
                    <th class="manage-column"><?php _e('Email', 'mawt'); ?></th>
                    <th class="manage-column"><?php _e('Asunto', 'mawt'); ?></th>
                    <th class="manage-column"><?php _e('Comentarios', 'mawt'); ?></th>
                    <th class="manage-column"><?php _e('Fecha', 'mawt'); ?></th>
                    <th class="manage-column"><?php _e('Eliminar', 'mawt'); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php
                global $wpdb;

                $table_name = $wpdb->prefix . 'contact_form_mawt';
                //Consultando la BD
                //get_results(query sql, Tipo de arreglo que quiero que retorne)
                //ARRAY_A => Array asociativo columna=>valor
                //ARRAY_N => Array posicional posicion=>valor
                $rows = $wpdb->get_results("SELECT * FROM $table_name", ARRAY_A);

                foreach ($rows as $row) {
                    echo '<tr>';
                    echo '<td>' . $row['id'] . '</td>';
                    echo '<td>' . $row['name'] . '</td>';
                    echo '<td>' . $row['email'] . '</td>';
                    echo '<td>' . $row['subject'] . '</td>';
                    echo '<td>' . $row['commets'] . '</td>';
                    echo '<td>' . $row['contact_date'] . '</td>';
                    echo '<td><a class="u-delete" href="#" data-contact-id="' . $row['id'] . '">Eliminar</a></td>';
                    echo '</tr>';
                }

                ?>

                </tbody>
            </table>
        </div>
        <?php

    }
endif;


# Funcion que mostrara un shortcode
if (!function_exists('mawt_conctact_form')):
    # si le ponemos parametors, se enviaran cuando se llame el shortcode desde el front
    function mawt_conctact_form($atts)
    {
        echo "<h1>Formulario de contacto - title=" . $atts['title'] . "</h1>";
        ?>

        <!--Automaticamente wordpress sabe a donde enviar el action-->
        <form method="post">
            <!--$atts['title']  variable parametro que se pasa desde el front-->
            <legend><?php echo $atts['title'] ?></legend>
            <input type="hidden" name="send_contact_form" value="1">
            <!--name="" debe ser igual a la columna agregada en la tabla, para que wp sepa donde insertar-->
            <input type="text" name="name" placeholder="Escribe tu nombre">
            <input type="email" name="email" placeholder="Escribe tu email">
            <input type="text" name="subject" placeholder="Asunto de tu emall">
            <br>
            <textarea name="comments" id="" cols="50" rows="5" placeholder="Tu comentario aqui"></textarea>
            <input type="submit" value="Guardar">
        </form>

        <?php
    }
endif;
#(etiqueta que sera usado desde el front para invocar)

#En el front se colocaria [contact_form title="valor"] e imprimira la funcion
add_shortcode('contact_form', 'mawt_conctact_form');


if (!function_exists('mawt_contact_form_front_scripts')):
    function mawt_contact_form_front_scripts()
    {
        //Condicionamos a que solo se cargue en la pagina de contacto
        // le pasamos el slug de la pagina
        if (is_page('pagina-de-contacto')):
            wp_register_script('contact_form_front_js', get_template_directory_uri() . '/js/contact_form.js', [], '1.0.0', true);
            wp_register_script('contact_form_back_js', get_template_directory_uri() . '/js/contact_form_admin.js', [], '1.0.0', true);


            wp_enqueue_script('contact_form_front_js');
            wp_enqueue_script('contact_form_back_js');
        endif;
    }
endif;
//Invocando la funcion de estilos en el front
add_action("wp_enqueue_scripts", 'mawt_contact_form_front_scripts');

if (!function_exists('mawt_contact_form_back_scripts')):
    function mawt_contact_form_back_scripts()
    {

        //Registrando scripts
        //true -> carga en el footer y false en el header
        wp_register_script('contact_form_back_js', get_template_directory_uri() . '/js/contact_form_admin.js', ['jquery'], '1.0.0', true);

        wp_enqueue_script('jquery');
        wp_enqueue_script('contact_form_back_js');


        //Funcion que permite enviar desde PHP a un Archivo JS}
        // wp_localize_script('nombre escript registradpo', 'nombre del objeto en el archivo JS con el cual se accedera', [arreglo asociativo de datos])
        //admin_url('admin-ajax.php')  retorna la url del archivo pasado por paremtro
        //admin-ajax.php // archivo que controla las peticiones ajax
        wp_localize_script('contact_form_back_js', 'contact_form_object_js',
            ['name' => 'Modulo de comentarios', 'ajax_url' => admin_url('admin-ajax.php')]
        );

    }
endif;
//Invocando la funcion de estilos en el back
add_action("admin_enqueue_scripts", 'mawt_contact_form_back_scripts');


#Funcion que recibira el formulario desde el front y almacenara los registros
if (!function_exists('mawt_contact_form_save')):
    function mawt_contact_form_save()
    {
        //Validacion vacia que recibe el envio
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['send_contact_form'])) {
            global $wpdb;

            //sanitize_text_field(valor) sanitiza de posbile inyeccion sql o js scription
            $name = sanitize_text_field($_POST['name']);
            $email = sanitize_text_field($_POST['email']);
            $subject = sanitize_text_field($_POST['subject']);
            $comments = sanitize_text_field($_POST['comments']);

            //Los indices deben concidir con las columnas de la tabla
            $form_data = [
                'name' => $name,
                'email' => $email,
                'subject' => $subject,
                'comments' => $comments,
                'contact_date' => date('Y-m-d H:m:s')
            ];

            //El arreglo debe ser acorde  a la posicion del form_data
            //%s  significa que debe ser un string
            //%d  numeros
            $form_validates = [
                '%s',
                '%s',
                '%s',
                '%s',
                '%s'
            ];

            $table_name = $wpdb->prefix . 'contact_form_mawt';

            //Insertar registro
            //insert(nombre_tabla, array_de_datos_columna_valor, array_de_validaciones_de_tipo_de_datos)
            $wpdb->insert($table_name, $form_data, $form_validates);

            //Reidirgimos hacia otra pagina cuando se inserte
            // recibe el slug de la pagina como parametro
            $url = get_page_by_path('gracias-por-tus-comentarios');  //retorna un arreglo asosiativo con informacion de la pagina

            //wp_redirect(url)
            //get_permalink(ID de pagina u objeto)
            wp_redirect(get_permalink($url->ID));
            exit(); //Cancelar cualquier ejeucion

        }
    }
endif;
# Cuando inicie wordpres cargara esta funcion
add_action('init', 'mawt_contact_form_save');


# Funcion que recibira por ajax, la peticion de eliminar
if (!function_exists('mawt_contact_form_delete')):
    function mawt_contact_form_delete()
    {

        //Validando el valor enviado por post
        if (isset($_POST['id'])):
            global $wpdb;

            $table_name = $wpdb->prefix . 'contact_form_mawt';

            //delete(nombre_tabla, arreglo de valores a buscar (columna => valor), validaciones de tipado)
            $delete_row = $wpdb->delete($table_name, ['id' => $_POST['id']], ['%d']);

            //Devolvemos si se ejecuto correctamente
            if ($delete_row) {
                $response = [
                    'status' => true,
                    'message' => 'Se elimino correctamente con el ID ' . $_POST['id']
                ];
            } else {
                $response = [
                    'status' => false,
                    'message' => 'No se elimino el registro con el ID ' . $_POST['id']
                ];
            }
            //La respuesta de la peticion se devuelve encodeada en el die() para que no continue otra ejecucion
            die(json_encode($response));
        else:
            $response = [
                'status' => false,
                'message' => 'No se elimino el registro'
            ];
            die(json_encode($response));
        endif;
    }
endif;
# prefijo = wp_ajax_   se le cocatena el nombre de la funcion, y tambien la recibe por parametro
add_action('wp_ajax_mawt_contact_form_delete', 'mawt_contact_form_delete');


