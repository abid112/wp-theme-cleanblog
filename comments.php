<?php

if ( post_password_required() ) {
    return;
}
?>


<?php
function add_custom_comment_field( $comment_id ) {

    add_comment_meta( $comment_id, 'my_custom_comment_field', $_POST['my_custom_comment_field'] );

}
add_action( 'comment_post', 'add_custom_comment_field' );

?>



<div id="comments" class="comments-area">
    
    <?php if ( have_comments() ) : ?>

    <div class="left-hr"><hr/></div>
    <div class="right-hr"><hr/></div>

        <div class="comments-title"><?php echo __("<h3>COMMENTS</h3>");?></>

        </div>

        <ul class="comment-list">
            <?php
            wp_list_comments(
                array(
                    'style'       => 'li',
                    'short_ping'  => TRUE,
                    'avatar_size' => 80,
                    'callback'    => 'cleanblog_comments_list'
                ) );
            ?>
        </ul><!-- .comment-list -->
        <?php
    endif; // have_comments() ?>

    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
        <nav class="navigation comment-navigation">
            <h3 class="screen-reader-text section-heading"><?php esc_html_e( 'Comment navigation', 'cleanblog' ); ?></h3>
            <ul class="pager comment-navigation">
                <li class="previous"><?php previous_comments_link( '<i class="fa fa-angle-double-left"></i> ' . esc_html__( 'Older Comments', 'cleanblog' ) ); ?></li>
                <li class="next"><?php next_comments_link( esc_html__( 'Newer Comments', 'cleanblog' ) . '<i class="fa fa-angle-double-right"></i>' ); ?></li>
            </ul>
        </nav><!-- .comment-navigation -->
    <?php endif;  // Check for comment navigation   ?>

    <?php if ( ! comments_open() && get_comments_number() ) : ?>
        <div class="alert alert-warning no-comments"><?php esc_html_e( 'Comments are closed.', 'clenablog' ); ?></div>
    <?php else :
        cleanblog_comment_form('');
    endif;
    ?>
</div><!-- .comments-area -->