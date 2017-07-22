
<?php get_header(); ?>
<!-- Page Header -->
<!-- Set your background image for this header on the line below. -->
<header class="intro-header" style="background-image: url( '<?php header_image(); ?>' )">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <div class="site-heading">
                    <h1><?php bloginfo('title');?> </h1>
                    <hr class="small">
                    <span class="subheading"><?php bloginfo('description') ?></span>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Slide Show -->
<div id="owl-demo" class="owl-theme">
 
  <div class="item"><img src="<?php echo get_template_directory_uri(); ?>/img/home-bg.jpg" width="" height="" alt="" /></div>
  <div class="item"><img src="assets/fullimage2.jpg" alt="GTA V"></div>
  <div class="item"><img src="assets/fullimage3.jpg" alt="Mirror Edge"></div>
 
</div>



<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">

            <div class="post-preview">
                <?php while(have_posts() ) : the_post();  ?>
                    <a href="<?php the_permalink();?>">
                        <h2 class="post-title">
                            <?php the_title(); ?>
                        </h2>
                        <h3 class="post-subtitle">
                            <?php the_excerpt(); ?>
                        </h3>
                    </a>
                    <p class="post-meta">Posted by <?php the_author() ?> on <?php the_time ('F-j-Y'); ?> </p>
                <?php endwhile; ?>
            </div>
            <hr>
            
            
            <hr>
            <!-- Pager -->
            <ul class="pager">
                <li class="next">
                    <?php posts_nav_link('', 'Newer Posts', 'Older Posts') ?>
                </li>
            </ul>
        </div>

    </div>
</div>

<hr>
<?php get_footer(); ?>


</body>

</html>
