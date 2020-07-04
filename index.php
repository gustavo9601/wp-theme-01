
<!--Obtenemos el archivo header.php-->
<?php get_header(); ?>

<?php
if (is_home()){
    echo "<mark>Estoy en el home</mark>";
}else if(is_category()){
    echo "<mark>Estoy en las categorias</mark>";
}else if(is_category('pequenos')){
    echo "<mark>Estoy en la categorua pequenos</mark>";
}else if(is_tag()){
    echo "<mark>Estoy mostrando etiquetas</mark>";
}else if (is_page()){
    echo "<mark>Estoy en la pagina</mark>";
}else if (is_single()){
    echo "<mark>Estoy mostrando una entrada</mark>";
}else if (is_author()){
    echo "<mark>Estoy en el autor</mark>";
}else{
    echo "<mark>Error 404</mark>";
}
?>

<!--Archivo que contiene loops modificados con Wp_query-->
<?php get_template_part('loop-wp-query'); ?>

<!--Obteniendo otro archivo php como include-->
<?php get_template_part('content'); ?>

<!--Obteniendo el archivo sidebar.php-->
<?php get_sidebar(); ?>


<!--Obteniendo el sidebar-->
<?php get_sidebar(); ?>

<!--Obteniendo el footer-->
<?php get_footer(); ?>





