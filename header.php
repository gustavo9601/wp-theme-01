<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo wp_title('|', true, 'right'); ?></title>

    <?php wp_head(); ?>

</head>
<body>

<!--Llamando la otra cabecera-->
<?php get_template_part('header-wordpress'); ?>


<header class="Header">
    <div class="Logo">
        <a href="<?php echo esc_url(home_url('/')); ?>">
            <?php
            # pregunta hay logo ajustado en el dashboard
            if (has_custom_logo()){
                # imprime el logo
                the_custom_logo();
            }else{
                bloginfo('name');
            }
            ?>

        </a>
    </div>

    <div class="Menu">

        <?php
        if (has_nav_menu('main_menu')):
            wp_nav_menu([
                'theme_location' => 'main_menu',  # Ubicacion del menu
                'container' => 'nav', # elemento contenedor'
                'container_class' => 'Menu menu'  # clase a aplicar al contenedor
            ]);
        else: ?>
            <nav class="Menu">
                <?php wp_list_pages('title_li'); ?>
            </nav>
        <?php
        endif;
        ?>
    </div>

</header>
<main class="Main">