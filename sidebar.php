<aside class="Sidebar">
    <h2>Sidebar</h2>
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
</aside>