<?php get_header(); ?>

<?php get_template_part( 'parts/breadcrumbs' ); ?>

<div class="notfound">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1>404</h1>
                <h2>Pagina niet gevonden</h2>
                <p>De pagina die u probeerde te bereiken bestaat helaas niet. Controleer de opgegeven URL en probeer het nogmaals.</p>
                <a href="/" class="notfound-return"><i class="far fa-long-arrow-left padding-right"></i>Terug naar home</a>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>