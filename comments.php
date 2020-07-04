<aside class="Comments">
    <!--Retorna los comentarios que se tengan en la entrada-->
    <ol>
    <?php wp_list_comments(); ?>
    </ol>
    <!--Retorna el formulario con los campos para realizar un comentario-->
    <?php comment_form(); ?>
</aside>