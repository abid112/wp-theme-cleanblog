

<?php

/*
Template Name: About Me


*/
?>


<?php get_header(); ?>

<?php $backgroundImg = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' ); ?>
  <?php 
  if($backgroundImg==null){

        $backgroundImg = get_template_directory_uri().'/img/post-bg.jpg'; ?>

        <header class="intro-header" style="background: url('<?php echo $backgroundImg; ?>') no-repeat 0 0/ 100% 100%;">
        <?php
  }
else{
    ?>
<header class="intro-header" style="background: url('<?php echo $backgroundImg[0]; ?>') no-repeat 0 0/ 100% 100%;">
<?php
}

  ?>
 

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

