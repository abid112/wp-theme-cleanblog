
<?php

/*
Template Name: Contract Us
*/
?>

<?php get_header(); ?>

    
    <header class="intro-header" style="background-image: url(get_template_directory_uri().'/img/contact-bg.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="page-heading">
                        <h1>Contact Me</h1>
                        <hr class="small">
                        <span class="subheading">Have questions? I have answers (maybe).</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <?php while(have_posts() ) : the_post();  ?>
                        
                        <h2 class="post-title">
                            <?php the_title(); ?>
                        </h2>
                        <h3 class="post-subtitle">
                            <?php the_content(); ?>
                        </h3>
                    </a>
                    
                    <?php endwhile; ?>
                
            </div>
        </div>
    </div>

    <hr>

    <!-- Footer -->
    
</body>

<?php get_footer(); ?>


