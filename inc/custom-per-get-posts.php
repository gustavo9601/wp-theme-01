<?php

if (!function_exists('mawt_show_post_types_in_loop')):
    function mawt_show_post_types_in_loop($query)
    {
        # Importante decir que no sea admin, para que no retorne datos en el Back
        if (!is_admin() && $query->is_main_query()):
            # recibe el tipo , y luego la clasigicacion que seria el slug del post type creado
            $query->set('post_type', ['post', 'page', 'post_type_cuidados']);
        endif;
    }
endif;

add_action('pre_get_posts', 'mawt_show_post_types_in_loop');
