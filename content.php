<article class="Content">
    <h1>Entradas de post</h1>
    <hr>
    <!--Verificamos que hallan publicaciones-->
    <?php if (have_posts()): ?>

        <!--Inicializams el loop-->
        <?php while (have_posts()) : the_post(); ?>

            <!--Imprimiendo el titulo-->
            <h4><?php the_title(); ?></h4>
            <!--Obteniendo el titulo y usando echo-->
            <h5><?php echo get_the_title(); ?></h5>
            <!--Imprimiendo un resumen-->
            <?php the_excerpt(); ?>
            <!--Imprimiendo las categorias-->
            <?php the_category(); ?>

            <?php /*$categorias = get_categories();
            echo '<pre>';
                var_dump($categorias);
            echo '</pre>';
            */ ?>

            <!--Imprimiendo las etiquetas-->
            <?php the_tags(); ?><br>
            <!--Imprimiendo la fecha-->
            <!--Imprimira la fecha una sola vez si varios post se crearaon el mismo dia-->
            <?php the_date(); ?> <br>
            <!--Imprimiendo el tiempo-->
            <?php the_time(); ?><br>
            <!--Imprimiendo la fecha con la funcion time-->
            <?php the_time('d-M-Y') ?><br>
            <!--Imprimiendo la fecha, con la fucnion get_option configurada desde el dashboard-->
            <!--Link del post-->
            <?php the_time(get_option('date_format')); ?><br>
            <!--Imprimiendo el autor-->
            <?php the_author(); ?> <br>
            <!--Imprimiendo el autor con enlace-->
            <?php the_author_posts_link(); ?><br>
            <!--Imprimiendo el contenido-->
            <?php the_content(); ?><br>
            <!--Imprimiendo la imagen destacada como imagen html-->
            <?php the_post_thumbnail(); ?><br>
            <!--Imprimiendo el url de la imagen thumbnail-->
            Url de la imagen : <?php echo get_the_post_thumbnail_url(); ?>

            <br>


            <!--Custom Fields-->
            <!-- the_meta()  imprime linealmente todos los custom fields creados -->
             <?php the_meta(); ?>

            <!--
            get_post_meta(get_the_ID(), 'custom-field-test', true)
            get_the_ID()  # retorna el id del post o pagina  iterada
            'custom-field-test'  # es el id definido como custom field
            true  # siempre debe ir en true para que resuleva datos
            -->
            <h2>custom-field-test: <?php echo get_post_meta(get_the_ID(), 'custom-field-test', true) ?></h2>


        <!--
        the_field('id_campo')  # generala funcion al instalar ACF, e imprime  el valor almacenado
        get_field('id_campo0)  # obtieien el valor
        -->
            <h3>ACF: <?php the_field('texto-ideal-para'); ?></h3>
            <!-- Imprime la url del post-->
            Ver <a href="<?php the_permalink(); ?>">post</a><br>


        <?php endwhile; ?>


        <!--Url de home-->
        <!--Sanitizamos la url por si vienen caracteres especiales esc_url()-->
        <a href="<?php echo esc_url(home_url('/')); ?>">Ir a home</a>
        <hr>

    <?php else : ?>
        <p>El contenido solicitado no existe</p>
    <?php endif; ?>
    <?php wp_reset_postdata(); ?>
    <?php wp_reset_query(); ?>
</article>

<section class="Pagination">
    <!--Mostrara el link para ir atras en la paginacion-->
    <?php previous_post_link(); ?><br>


    <!--Mostrara el link para ir siguiente en la paginacion-->
    <?php next_post_link(); ?><br>

    <hr>

    <!--Paginacion con numeros back/after-->
    <!--No pueden existir los anteriores links para que se muestre paginate-->
    <?php echo paginate_links(); ?>
</section>

