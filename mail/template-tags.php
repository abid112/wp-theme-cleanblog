<?php
//----------------------------------------------------------------------
// Comment form
//----------------------------------------------------------------------

if ( ! function_exists( 'cleanblog_comment_form' ) ) :

    function cleanblog_comment_form( $args = array(), $post_id = NULL ) {
        if ( NULL === $post_id ) {
            $post_id = get_the_ID();
        } else {
            $id = $post_id;
        }

        $commenter     = wp_get_current_commenter();
        $user          = wp_get_current_user();
        $user_identity = $user->exists() ? $user->display_name : '';

        if ( ! isset( $args[ 'format' ] ) ) {
            $args[ 'format' ] = current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : 'xhtml';
        }

        $req      = get_option( 'require_name_email' );
        $aria_req = ( $req ? " aria-required='true'" : '' );
        $html5    = 'html5' === $args[ 'format' ];
        $fields   = array(
            'author' => '
                    <div class="row">
                    <div class="col-md-4 comment-form-author">
                        <div class="input-field">
                            <label for="author">' . esc_html__( '', 'cleanblog' ) . '</label>
                            <input   class="form-control"  id="author" name="author" type="text" placeholder="NAME"
                            value="' . esc_attr( $commenter[ 'comment_author' ] ) . '" ' . $aria_req . ' />
                        </div>
                    </div>',
            'email'  => '<div class="col-md-4 comment-form-email">
                    <div class="input-field">
                        <label for="email">'. esc_html__( '', 'cleanblog' ) . '</label>
                        <input id="email" class="form-control" name="email" placeholder="EMAIL"' . ( $html5 ? 'type="email"' : 'type="text"' ) . '
                        value="' . esc_attr( $commenter[ 'comment_author_email' ] ) . '" ' . $aria_req . ' />
                    </div>
                </div>',
            'url'    => '<div class="col-md-4 comment-form-url">
                    <div class="input-field">
                        <label for="url">' . esc_html__( '', 'cleanblog' ) . '</label>
                        <input  class="form-control" id="url" name="url" placeholder="WEBSITE" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter[ 'comment_author_url' ] ) . '"  />
                    </div>
                </div></div>'
        );

        $required_text = sprintf( ' ' . esc_html__( 'Required fields are marked %s', 'cleanblog' ), '<span class="required">*</span>' );
        $defaults      = array(
            'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
            'comment_field'        => '
                <div class="row comment-form-comment">
                    <div class="col-md-12">
                        <div class="input-field">
                            <label for="comment">' . esc_html__( 'Comment *', 'cleanblog' ) . '</label>
                            <textarea class="form-control" id="comment" name="comment" rows="8" aria-required="true"></textarea>
                        </div>
                    </div>
                </div>',
            'must_log_in'          => '
                <div class="alert alert-danger must-log-in">' .

                sprintf( wp_kses( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'cleanblog' ), array( 'a' => array( 'href' => array() ) ) ), wp_login_url( apply_filters( 'the_permalink', esc_url( get_permalink( $post_id ) ) ) ) ) . '</div>',
            'logged_in_as'         => '<div class="alert alert-info logged-in-as">' . sprintf( wp_kses( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'cleanblog' ), array( 'a' => array( 'href' => array() ) ) ), get_edit_user_link(), $user_identity, wp_logout_url( apply_filters( 'the_permalink', esc_url( get_permalink( $post_id ) ) ) ) ) . '</div>',
            
        
            'id_form'              => 'commentform',
            'id_submit'            => 'submit',
            'title_reply'          => esc_html__( 'Leave a Comment', 'cleanblog' ),
            'title_reply_to'       => esc_html__( 'Leave a Reply to %s', 'cleanblog' ),
            'cancel_reply_link'    => esc_html__( 'Cancel reply', 'cleanblog' ),
            'label_submit'         => esc_html__( 'SUBMIT', 'cleanblog' ),
            'format'               => 'xhtml',
        );

        $args = wp_parse_args( $args, apply_filters( 'comment_form_defaults', $defaults ) );

        if ( comments_open( $post_id ) ) {
            ?>
            <?php do_action( 'comment_form_before' ); ?>
            <div id="respond" class="comment-respond">
                <h2 id="reply-title" class="comment-reply-title">
                    <?php comment_form_title( $args[ 'title_reply' ], $args[ 'title_reply_to' ] ); ?>
                    <small><?php cancel_comment_reply_link( $args[ 'cancel_reply_link' ] ); ?></small>
                </h2>

                <?php if ( get_option( 'comment_registration' ) && ! is_user_logged_in() ) { ?>
                    <?php echo $args[ 'must_log_in' ]; ?>
                    <?php do_action( 'comment_form_must_log_in_after' ); ?>
                <?php } else { ?>
                    <form action="<?php echo esc_url( site_url( '/wp-comments-post.php' ) ); ?>" method="post"
                          id="<?php echo esc_attr( $args[ 'id_form' ] ); ?>"
                          class="form-horizontal comment-form"<?php echo ( $html5 ) ? ' novalidate' : ''; ?>>
                        <?php do_action( 'comment_form_top' ); ?>
                        <?php if ( is_user_logged_in() ) { ?>
                            <?php echo apply_filters( 'comment_form_logged_in', $args[ 'logged_in_as' ], $commenter, $user_identity ); ?>
                            <?php do_action( 'comment_form_logged_in_after', $commenter, $user_identity );
                            echo apply_filters( 'comment_form_field_comment', $args[ 'comment_field' ] ); ?>
                        <?php } else { ?>
                            
                            <?php
                            do_action( 'comment_form_before_fields' );
                            echo apply_filters( 'comment_form_field_comment', $args[ 'comment_field' ] );
                            foreach ( (array) $args[ 'fields' ] as $name => $field ) {
                                echo apply_filters( "comment_form_field_{$name}", $field ) . "\n";
                            }
                            do_action( 'comment_form_after_fields' );
                        }
                       ?>
                       <br>
                         <div class="form-submit">
                            <input class="btn btn-primary btn-lg" name="submit" type="submit"
                                   id="<?php echo esc_attr( $args[ 'id_submit' ] ); ?>"
                                   value="<?php echo esc_attr( $args[ 'label_submit' ] ); ?>"/>
                            <?php comment_id_fields( $post_id ); ?>
                        </div> 
                        <br>
                        <?php do_action( 'comment_form', $post_id ); ?>
                    </form>
                <?php } ?>
            </div><!-- #respond -->
            <?php do_action( 'comment_form_after' ); ?>
        <?php } else { ?>
            <?php do_action( 'comment_form_comments_closed' ); ?>
        <?php } ?>
        <?php
    }
endif;

//----------------------------------------------------------------------
// Comments list
//----------------------------------------------------------------------

if ( ! function_exists( "cleanblog_comments_list" ) ) :

    function cleanblog_comments_list( $comment, $args, $depth ) {

        $GLOBALS[ 'comment' ] = $comment;
        switch ( $comment->comment_type ) {

            // Display trackbacks differently than normal comments.
            case 'pingback' :
            case 'trackback' :
                ?>

                <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
                <p><?php esc_html_e( 'Pingback:', 'cleanblog' ); ?><?php comment_author_link(); ?><?php edit_comment_link( esc_html__( '(Edit)', 'cleanblog' ), '<span class="edit-link">', '</span>' ); ?></p>

                <?php
                break;

            default :
                // Proceed with normal comments.
                global $post;
                ?>
            <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
                <div id="comment-<?php comment_ID(); ?>" class="comment media">
                    <div class="comment-author clearfix">
                        <?php
                        $get_avatar = get_avatar( $comment, apply_filters( 'cleanblog_post_comment_avatar_size', 80 ) );
                        $avatar_img = cleanblog_get_avatar_url( $get_avatar );
                        //Comment author avatar
                        ?>
                        <div class="media-left">
                            <img class="avatar" src="<?php echo esc_url( $avatar_img ) ?>" alt="">
                        </div>
                        <div class="media-body">
                            <div class="comment-meta media-heading">
                                <div>
                                        <span class="author-name">
                                            <?php echo get_comment_author(); ?>
                                        </span>
                                    <span class="comment-time"><?php echo human_time_diff(get_comment_time('U'), current_time('timestamp')) . " " . __('ago');?></span>
                                    
                                <span class="comment-meta"> 
                                    <?php edit_comment_link( esc_html__( 'Edit', 'cleanblog' ), '<span class="edit-link">', '</span>' ); //edit link?>
                                </span>
                                </div>
                            </div>


                            <div class="comment-content">

                                <?php comment_text(); //Comment text
                                ?>

                                <ul class="list-inline">
                                    <li>

                                <?php comment_reply_link( array_merge( $args, array(
                                        'reply_text' => '<span class="fa fa-reply reply-icon">' . esc_html__( '', 'cleanblog' ) . '</span>',
                                        'depth'      => $depth,
                                        'max_depth'  => $args[ 'max_depth' ]
                                    ) ) ); ?>
                                    </li>

                                    <li>


                                <?php

                                //echo getCommentLikeLink(get_the_ID());?>

                                    </li>
                                </ul>
                            </div>
                            <!-- .comment-content -->


                        </div>
                    </div>
                </div>
                <!-- #comment-## -->
                <?php
                break;
        } // end comment_type check

    }

endif;

//----------------------------------------------------------------------
// Fetching Avatar URL
//----------------------------------------------------------------------

if ( ! function_exists( 'cleanblog_get_avatar_url' ) ) :

    function cleanblog_get_avatar_url( $get_avatar ) {
        preg_match( "/src='(.*?)'/i", $get_avatar, $matches );

        return esc_url( $matches[ 1 ] );
    }
endif;
?>