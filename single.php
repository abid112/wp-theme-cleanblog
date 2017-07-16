<?php get_header(); ?>
<!-- Set your background image for this header on the line below. -->
 <header class="intro-header" style="background-image: url('<?php echo get_template_directory_uri(); ?>/img/post-bg.jpg')">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <div class="post-heading">

                    <h1><?php the_title(); ?></h1>
                    
                    <span class="meta">Posted <?php the_author() ?> on <?php the_time ('F-j-Y'); ?></span>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Post Content -->
<article>
    <div class="container">
        <?php while(have_posts() ) : the_post();  ?> 
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <p> <?php the_content(); ?> </p>

                    
                </div>
            </div>
        </div>
    <?php endwhile; ?>
</article>

<?php get_footer(); ?>