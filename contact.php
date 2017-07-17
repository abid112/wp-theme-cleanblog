
<?php

/*
Template Name: Contract Us
*/
?>

<?php get_header(); ?>
<?php $backgroundImg = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' ); ?>

<!-- Page Header -->
<!-- Set your background image for this header on the line below. -->
 <header class="intro-header" style="background: url('<?php echo $backgroundImg[0]; ?>') no-repeat 0 0/ 100% 100%;">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <div class="page-heading">
                    <h1><?php echo get_post_meta($post->ID,'page_title',true) ?></h1>
                        <hr class="small">
                        <span class="subheading"><?php echo get_post_meta($post->ID,'desc', true) ?></span>
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


