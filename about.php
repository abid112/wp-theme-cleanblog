

<?php

/*
Template Name: About Me
*/
?>
    

    <?php get_header(); ?>

    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <header class="intro-header" style="background-image: url('get_template_directory_uri().'/img/about-bg.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="page-heading">
                        <h1>About Me</h1>
                        <hr class="small">
                        <span class="subheading">This is what I do.</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <div class="row">
        <?php while(have_posts() ) : the_post();  ?> 
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <p><?php the_content(); ?></p>

            </div>
        </div>
        <?php endwhile; ?>
    </div>

    <hr>

    

</body>
<?php get_footer(); ?>
