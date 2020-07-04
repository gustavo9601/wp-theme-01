<section>
    <hr>
    <h1>Seccion del Loop con WP_Query</h1>
    <hr>
    <?php


    $wp_query = new WP_Query([
        'posts_per_page' => 4, # retornar solo 4 post por pagina
        'order_by' => 'rand' # genera el orden aleatorio
    ]);
    $contador = 1;
    ?>
    <?php if ($wp_query->have_posts()) : ?>
        <?php while ($wp_query->have_posts()): $wp_query->the_post(); ?>
            <h1>Contador #<?php echo $contador ?></h1>
            <?php $contador++; ?>
            <?php the_content(); ?>
        <?php endwhile; ?>
    <?php endif; ?>
    <!--Necesaria para limpiar las variables de entorno-->
    <?php wp_reset_postdata(); ?>
    <?php wp_reset_query(); ?>
    <hr>
</section>