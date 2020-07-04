<?php
get_header();

echo '<h1>Pagina no encontrada</h1>';
echo '<p>Vuelve al inicio <a href="' . esc_url(home_url('/')) . '">Ir</a></p>';
get_footer();
?>