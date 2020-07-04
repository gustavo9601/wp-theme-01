<?php

if (!function_exists('add_a_metaboxes')):
    function add_a_metaboxes(){
        add_meta_box('metabox_id_1', __('Metabox title', 'mawt'), 'callback_metaboxes', ['post', 'page'], 'normal', 'high', null);
    }
endif;

function callback_metaboxes(){
    echo "<h1>Customizando los metaboxes desde el backend</h1>";
}

add_action('add_meta_boxes', 'add_a_metaboxes');
