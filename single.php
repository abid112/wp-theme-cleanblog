<?php get_header(); ?>
   <?php
              setPostViews(get_the_ID());
    ?>
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

<?php comments_template(); ?>

<?php get_footer(); ?>