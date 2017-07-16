<?

add_theme_support('title-tag');
add_theme_support( 'custom-background');
register_nav_menu('mainmenubar', 'Main Menu');
register_nav_menu('footermen', 'footer Menu');
add_theme_support('post-thumbnails');


function cleanblog_style() {



	wp_enqueue_style('cleanblog-bootstrap', get_template_directory_uri(). '/vendor/bootstrap/css/bootstrap.min.css');
	wp_enqueue_style( 'cleanblog-style', get_template_directory_uri() . '/css/styles.css');
	
	


	wp_enqueue_style('cleanblog-fontawesome', get_template_directory_uri(). '/vendor/font-awesome/css/font-awesome.css');

	wp_enqueue_style('cleanblog-fontawesome2', get_template_directory_uri(). '/vendor/font-awesome/css/font-awesome.min.css');
	wp_enqueue_style('fontsupportcdn', 'https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic');
	wp_enqueue_style('fontsupportcdn2', 'https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800');






	wp_enqueue_script( 'cleanblog-javasc2', get_template_directory_uri() . '/vendor/jquery/jquery.min.js', array(), '20150803', true );
	wp_enqueue_script( 'cleanblog-javasc3', get_template_directory_uri() . '/vendor/bootstrap/js/bootstrap.min.js', array(), '20150803', true );
	wp_enqueue_script( 'cleanblog-bootstrap', get_template_directory_uri() . '/js/jqBootstrapValidation.js', array(), '20150803', true );
	wp_enqueue_script( 'cleanblog-jquery', get_template_directory_uri() . '/js/contact_me.js', array(), '20150803', true );
	
	wp_enqueue_script( 'cleanblog-javascript', get_template_directory_uri() . '/js/clean-blog.min.js', array(), '20150803', true );

	


	


	wp_enqueue_script( 'cleanblog-javasc3', get_template_directory_uri() . '/js/clean-blog.min.js', array(), '20150803', true );




}
add_action( 'wp_enqueue_scripts', 'cleanblog_style' );



$defaults = array(
	'default-image'  => get_template_directory_uri().'/img/home-bg.jpg',
	
	);

add_theme_support( 'custom-header', $defaults );

#Footer-->
function footersidebar(){
	register_sidebar(array(

		'name'=>'Copyright Information',
		'id'=>'footer_sidebar1',
		'before_widget'=>' ',
		'after_widget'=>'',
		'description'=>'Drag and Drop Text Field from Left Side and Add your Copyright Text',
		));

}

add_action('widgets_init','footersidebar');


function themename_custom_logo_setup() {
    $defaults = array(
        'height'      => 45,
        'width'       => 151,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array( 'site-title', 'site-description' ),
    );
    add_theme_support( 'custom-logo', $defaults );
}
add_action( 'after_setup_theme', 'themename_custom_logo_setup' );





#For Adding Header Imgage and title Every Page

function cd_meta_box_add()
{
    add_meta_box( 'my-title-id', 'Title meta box', 'cd_meta_box_cb', 'page', 'normal', 'high' );
     add_meta_box( 'my-desc-id', 'Description Meta Box', 'cd_meta_box_desc_cb', 'page', 'normal', 'high' );
      add_meta_box( 'my-img-id', 'Images Meta Box', 'cd_meta_box_img_cb', 'page', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'cd_meta_box_add' );
/*outpur value*/
function cd_meta_box_cb($post)
{ 
    ?>

<label for="title">Page Title</label>
<input type="text" name="page_title" class="widefat" id="title" value="<?php echo get_post_meta($post->ID,'page_title',true) ?>"  >
<?php
}
/*Update value*/
function  title_update($post_id){
    update_post_meta($post_id,'page_title',$_POST['page_title']);
}
add_action('save_post','title_update');
function cd_meta_box_desc_cb($post)
{
    ?>

<label for="desc"></label>
<input type="text" name="desc" class="widefat" value="<?php echo get_post_meta($post->ID,'desc', true) ?>"  >
     
<?php
}
function des_output($post_id){
    update_post_meta($post_id,'desc',$_POST['desc']);
}
add_action('save_post','des_output');
function cd_meta_box_img_cb()
{ ?>

<label>Upload Header image</label>



    <?php
}


?>