<?php

/*Template name: Page Full Width*/

get_header();
?>

<?php if (have_posts()) :?>
    <?php while (have_posts()): the_post(); ?>

        <section><?php the_content(); ?></section>
        <hr>
        <?php comments_template(); ?>

    <?php endwhile;?>
<?php endif;?>

<?php
if (is_active_sidebar('main_sidebar')):
    dynamic_sidebar('main_sidebar'); /*Imprime los widgets*/
else:
    ?>
    <article class="Widget">
        <h3><?php _e('Buscar', 'mawt') ?></h3>
        <?php get_search_form(); ?>  <!--Retorna un formulario de busqueda-->
    </article>
<?php endif; ?>


<?php get_footer(); ?>

