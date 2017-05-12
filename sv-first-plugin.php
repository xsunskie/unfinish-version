<?php
/*
   Plugin Name: sv-first-plugin
   Plugin URI: 
   Description: Starskie Villanueva first plugin
   Version: 0.1
   Author: Starskie Villanueva
   Author URI: 
   License: GPL2
*/

// using class dribbles for cleaner look and easy to read
class sv_first_plugin
{
	// start with construct and assign call backs 
	public function __construct() 
	{
		// call back for custom post types 
		add_action( 'init', array($this, 'custom_post_type_callback' ) );
					
		// call back for meta box
		add_action( 'add_meta_boxes', array($this, 'post_meta_boxes' ));
		
		// call back for saving post
		//add_action( 'save_post', array($this, 'save_posts_meta' ) ); // not done
		
		// a fiter that will include template wp
		//add_filter( 'template_include', 'GetTemplate') );	//not done		
	}	
	
	// callback action for custom post my type
	public function custom_post_type_callback() 
	{
    	register_post_type( 'podcast',
        	array(
            'labels' => array(
                'name' => 'Podcast',
                'singular_name' => 'Podcast Review',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Podcast Review',
                'edit' => 'Edit',
                'edit_item' => 'Edit Podcast Review',
                'new_item' => 'New Podcast Review',
                'view' => 'View',
                'view_item' => 'View Podcast Review',
                'search_items' => 'Search Podcast Reviews',
                'not_found' => 'No Podcast Reviews found',
                'not_found_in_trash' => 'No Podcast Reviews found in Trash',
                'parent' => 'Parent Podcast Review'
           		), 
            	'public' => true,
            	'menu_position' => 15,
            	'menu_icon' => 'dashicons-microphone',
            	'has_archive' => true
        	));
	}
	//call back action for creating metabox
	public function post_meta_boxes() {
		add_meta_box( 
		        'custom_meta_box', 
		        __( "Meta box", 'podcast' ),
		        array( $this, 'custom_meta_box' ),
		        ''
		        );
		  	}
	// for displaying meta box
	public function custom_meta_box( $post, $metabox) {
		_e("", 'podcast');
		
		//condition for the value of audio and episode that in post so it will shown in metabox if its !empty
		$dx_audio_input = '';
		$dx_episode_input = '';
		if ( !empty ( $post ) ) {
		$dx_audio_input = get_post_meta( $post->ID, 'dx_audio_input', true );
		$dx_episode_input = get_post_meta( $post->ID, 'dx_episode_input', true );
		}
	?>
    		<p>
     		 <label for="dx-test-input">Audio Input</label>
     		 <br/>
     		 <input type="text" name="dx_audio_input" value="<?php echo $dx_audio_input; ?>" />
    		</p>
  			<p>
    		<label for="dx-test-input">Episode Notes</label>
    		<br/>	
     		<textarea name="dx_episode_input" cols="100" rows="3"><?php echo $dx_episode_input; ?></textarea>	
    		<?php
	  }	

}
$sv_first_plugin = new sv_first_plugin();
?>