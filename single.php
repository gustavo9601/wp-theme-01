<?php
//Muestra la info unitaria del post

get_header();
?>

<?php if (have_posts()) :?>
    <?php while (have_posts()): the_post(); ?>
        <section><?php the_content(); ?></section>
        <hr>
        <?php comments_template(); ?>
    <?php endwhile;?>
<?php endif;?>

<?php get_footer(); ?>

