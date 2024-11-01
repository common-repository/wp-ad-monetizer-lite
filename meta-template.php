<?php

	function wpadm_print_meta($meta_box){
	
		if(empty($meta_box['default'])) $meta_box['default'] = '';
		
		switch($meta_box['type']){
		
			case "open" : wpadm_print_meta_open_div($meta_box); break;
			case "close" : wpadm_print_meta_close_div($meta_box); break;
			case "header": wpadm_print_meta_header($meta_box); break;
			case "text": wpadm_print_meta_text($meta_box); break;
			case "doc_template": wpadm_print_meta_doc_template($meta_box); break;
			case "pro_avail_template": wpadm_print_meta_pro_avail_template($meta_box); break;
			
			
			
			case "description": print_description($meta_box); break;
			case "inputtext": wpadm_print_meta_input_text($meta_box); break;
			case "shortcodebox": wpadm_print_meta_shortcode_box($meta_box); break;
			case "imgupload": wpadm_print_meta_imgupload($meta_box); break;
			case "upload": wpadm_print_meta_upload($meta_box); break;
			case "textarea": wpadm_print_meta_input_textarea($meta_box); break;
			case "checkbox": wpadm_print_meta_input_checkbox($meta_box); break;
			case "combobox": wpadm_print_meta_input_combobox($meta_box); break;
			
			case "multi_select": wpadm_print_meta_input_multiselect($meta_box); break;
			
			case "radioenabled": wpadm_print_meta_input_radioenabled($meta_box); break;
			case "radio": wpadm_print_meta_input_radio($meta_box); break;
			case "imagepicker": print_image_picker($meta_box); break;

		}
		
	}
	
	// nonce Verification	
	function set_nonce(){
	
		wp_nonce_field( plugin_basename( __FILE__ ), 'myplugin_noncename');
		
	}
	
	// header => name, title
	function wpadm_print_meta_header($args){
	
		extract($args);
		$meta_id = (isset($meta_id))? $meta_id : '';
		
		?>	
			
			<div id="meta-header" class="<?php echo $meta_id; ?>">
				<h2><?php _e($title, 'gdl_back_office'); ?></h2>
			</div>
			
		<?php 
		
	}

	// text => name, text
	function wpadm_print_meta_text($args){
	
		extract($args); 
		
		?>
		
			<div class="meta-body">
				<div class="meta-title pb10">
					<?php _e($title, 'gdl_back_office'); ?>
				</div>
			</div>
			
		<?php 
		
	}
	
	
	function wpadm_print_meta_doc_template($args){
	
		extract($args); 
		
		?>
		<style type="text/css">
		#docTemp {
			
			color: #dbdbde;
			font-size: 25px;
			
		}
		#docTemp > h2 {
			font-size: 25px;
			background-color: #2f67cb;
			color: #dbdbde;
			padding: 10px;
		}
		#docTemp a {
			color: #ff4949;
			font-size: 26px;
			font-weight: bold;
			text-decoration: none;
		}
		</style>
			<div class="meta-body">
				
				<div id="docTemp">
					<h2>  <a href="http://mlxplugins.com/wp-ad-monetizer-pro/">WP Ad-Monetizer Pro </a>is also available online with full featured, instead of this lite version. </h2>
		
				</div>
				
			</div>
			
		<?php 
		
	}
	
	function wpadm_print_meta_pro_avail_template($args){
	
		extract($args); 
		
		?>
		<style type="text/css">
		#docTemp {
			
			color: #dbdbde;
			font-size: 25px;
			
		}
		#docTemp > h2 {
			font-size: 25px;
			background-color: #2f67cb;
			color: #dbdbde;
			padding: 10px;
		}
		#docTemp a {
			color: #ff4949;
			font-size: 26px;
			font-weight: bold;
			text-decoration: none;
		}
		</style>
			<div class="meta-body">
				
				<div id="docTemp">
					<h2>  
					This feature and lots of other features are available in Pro plugin 
					<a href="http://mlxplugins.com/wp-ad-monetizer-pro/">WP Ad-Monetizer Pro </a> is also available online with full featured, instead of this lite version. You can buy the plugin from here, <a href="http://codecanyon.net/item/wp-admonetizer/7930106">WP Ad-Monetizer Pro </a> </h2>
		
				</div>
				
			</div>
			
		<?php 
		
	}
	
	
	
	// text => name, title, value, default
	function wpadm_print_meta_input_text($args){
		extract($args);
		
		?>
		
			<div class="meta-body">
				<div class="meta-title">
					<label for="<?php echo $name; ?>" ><?php _e($title, 'gdl_back_office'); ?></label>
				</div>
				<div class="meta-input ttssts">
					<input type="text" name="<?php echo $name; ?>" id="<?php echo $name; ?>" 
					value="<?php echo ($value == '')? esc_html($default): esc_html($value);	?>" />
				
				<?php if(isset($description)){ ?>
				
					<div class="meta-description"> <?php echo $description; ?> </div>
					
				<?php } ?>
				</div>
				<br class=clear>
			</div>
			
		<?php
		
	}

	// text => name, title, value, default
	function print_description($args){
		extract($args);
		
		?>
		
			<div class="meta-body">
				<div class="meta-title">
					<label><?php _e($title, 'gdl_back_office'); ?></label>
				</div>
				<div class="only-description"> <?php echo $description; ?> </div>
				<br class=clear>
			</div>
			
		<?php
		
	}	
		
	// text => name, title, value
	function wpadm_print_meta_upload($args){
	
		extract($args);
		
		?>
		
			<div class="meta-body">
				<div class="meta-title">
					<label for="<?php echo $name; ?>" ><?php _e($title, 'gdl_back_office'); ?></label>
				</div>
				<div class="meta-input">	
					<div class="meta-input-example-image" id="meta-input-example-image">
					
					<?php 
					
						$image_src = '';
						
						if(!empty($value)){
						
							$image_src = wp_get_attachment_image_src( $value, 'full' );
							$thumb_src_preview = wp_get_attachment_image_src( $value, '150x150');
							echo '<img src="' . $thumb_src_preview[0] . '" />';
							
						} 
						
					?>		
					
					</div>
					<input name="<?php echo $name; ?>" type="hidden" id="upload_image_attachment_id" value="<?php 
												
						echo (empty($value))? esc_html($default): esc_html($value);
						
					?>" />
					<input id="upload_image_text_meta" class="upload_image_text_meta" type="text" value="<?php echo (empty($image_src[0]))? '': $image_src[0]; ?>" />
					<input class="upload_image_button_meta" type="button" value="Upload" />
				</div>
				
				<?php if(isset($description)){ ?>
				
					<div class="meta-description"><?php echo $description; ?></div>
					
				<?php } ?>
				
				<br class=clear>
			</div>
			
		<?php
		
	}
	
	// textarea => name, title, value, default
	function wpadm_print_meta_input_textarea($args){
	
		extract($args);
		
		?>
		
			<div class="meta-body <?php echo str_replace('[]','',$name); ?>-wrapper">
				<div class="meta-title">
					<label for="<?php echo $name; ?>"><?php _e($title, 'gdl_back_office'); ?></label>
				</div>
				<div class="meta-input">
					<textarea name="<?php echo $name; ?>" id="<?php echo $name; ?>" class="<?php echo str_replace('[]','',$name); ?>" rows="10" style="width:100%;"><?php
												
						echo ($value == '')? esc_html($default): esc_html($value);
						
					?></textarea>
				</div>
				
				<?php if(isset($description)){ ?>
				
					<div class="meta-description"><?php echo $description; ?></div>
					
				<?php } ?>
				
				<br class="clear">
			</div>
			
		<?php
		
	}
	
	// checkbox => name, title, value
	function wpadm_print_meta_input_multicheckbox($args){
		extract($args);
		$value = (empty($value))? $default: $value;
		?>
			<div class="meta-body">
				<div class="meta-title">
					<label for="<?php echo $name; ?>"><?php _e($title, 'gdl_back_office'); ?></label>
				</div>
				<div class="meta-input"> <input type="checkbox" value="1" 
					<?php if( $value){ ?> checked="checked" <?php } ?>
					name="<?php echo $name; ?>"  />
				</div>
				<?php if(isset($description)){ ?>
					<div class="meta-description"><?php echo $description; ?></div>
				<?php } ?>
				<br class=clear>
			</div>
		<?php
	}	
	
	// combobox => name, title, value, options[]
	function wpadm_print_meta_input_combobox($args){
	
		extract($args);
		
		 $value = (empty($value))? $default: $value;
		//print_r($args);
		
		?>
			
			<div class="meta-body">
				<div class="meta-title">
					<label for="<?php echo $name; ?>"><?php _e($title, 'gdl_back_office'); ?></label>
				</div>
				<div class="meta-input">	
					<div class="combobox">
						<select name="<?php echo $name; ?>" id="<?php echo str_replace('[]', '', $name); ?>">
						<!--<option value="-1">--</option>-->
							<?php foreach($options as $k=>$v){ ?>
							
								<option value="<?php echo $k; ?>" rel="<?php echo $v ; ?>" <?php if( $value == $k ){ echo 'selected="selected"'; }?> ><?php echo $v ; ?></option>
						
							<?php } ?>
							
						</select>
					</div>
				</div>
				
				<?php if(isset($description)){ ?>
				
					<div class="meta-description"><?php echo $description; ?></div>
					
				<?php } ?>
				
				<br class=clear>
			</div>
			
		<?php
		
	}
	
		function wpadm_print_meta_input_multiselect($args){
			extract($args);
			
			//echo "<pre>";
			//print_r($_POST);
			//print_r($args);
			$value = (empty($value))? $default: $value;
			//print_r($value);
			
			//exit;
		?>
			<div class="meta-body">
				<div class="meta-title">
					<label for="<?php echo $name; ?>"><?php _e($title, 'gdl_back_office'); ?></label>
				</div>
				<div class="meta-input">	
					<div class="combobox">
						<select name="<?php echo $name.'[]'; ?>" id="<?php echo str_replace('[]', '', $name); ?>" multiple="multiple"		 style="width:100%;" size="<?php if(count($options) <=10 ) echo count($options); else echo "10" ; ?>">
							<?php foreach($options as $k=>$v){ ?>
								<option value="<?php echo $k ; ?>" 
								<?php if(is_array($value) &&  in_array($k,$value) ){ echo 'selected'; }?> ><?php echo $v ; ?></option>
							<?php } ?>
						</select>
					</div>
				
				<?php if(isset($description)){ ?>
					<div class="meta-description"><?php echo $description; ?></div>
				<?php } ?>
				</div>
				<br class=clear>
			</div>
		<?php
	}	
	
		
	
	// radioenabled => name, title, value
	function wpadm_print_meta_input_radioenabled($args){
	
		extract($args);
		
		?>
		
			<div class="meta-body">
				<div class="meta-title">
					<label for="<?php echo $name; ?>"><?php _e($title, 'gdl_back_office'); ?></label>
				</div>
				<div class="meta-input">
					<input type="radio" name="<?php echo $name; ?>" value="enabled" <?php if($value=='enabled' || $value=='') echo 'checked'; ?>> Enable &nbsp&nbsp&nbsp
					<input type="radio" name="<?php echo $name; ?>" value="disable" <?php if($value=='disable') echo 'checked'; ?>> Disable
				</div>
				
				<?php if(isset($description)){ ?>
				
					<div class="meta-description"><?php echo $description; ?></div>
					
				<?php } ?>
				
				<br class=clear>
			</div>
			
		<?php
		
	}	

	
	// radioimage => name, title, type, value, option=>array(value, image)
	function wpadm_print_meta_input_radio($args){
	
		extract($args);
		
		?>
		
			<div class="meta-body">
				<div class="meta-title">
					<label><?php _e($title, 'gdl_back_office'); ?></label>
				</div>
				<div class="meta-input">
				
					<?php foreach( $options as $k => $v){ ?>
					
						<div class="show-inline">
							
							<input type="radio" name="<?php echo $name; ?>" value="<?php echo $k;?>" <?php 
								
								if($value == $k){
								
									echo 'checked';
									
								}else if($value == '' && $default == $k){
								
									echo 'checked';
									
								}
								
							?> id="<?php echo $k; ?>" class="<?php echo $name; ?>" > 
							<label for="<?php echo $k; ?>">
								<?php echo $v; ?> 
								<div id="check-list"></div>
							</label>
							
						</div>
						
					<?php } ?>
					<?php if(isset($description)){ ?>
						<div class="meta-description"><?php echo $description; ?></div>
					<?php } ?>
					
					<br class=clear>
				</div>
				<br class=clear>
			</div>
		<?php
	}	
	
	
	function wpadm_print_meta_imgupload($args){
		extract($args);
		
		?>
		
			<div class="meta-body">
				<div class="meta-title">
					<label for="<?php echo $name; ?>" ><?php _e($title, 'gdl_back_office'); ?></label>
				</div>
				<div class="meta-input">
					<input type="text" name="<?php echo $name; ?>" id="upload_image" value="<?php 
												
						echo ($value == '')? esc_html($default): esc_html($value);
						
						?>" />
					<input type="button" value="Upload" class="button" id="upload_image_button" name="upload_img">
					<input type="button" value="Remove" class="button" id="remove_img" name="remove_img">	
					
					
						
				</div>
				
				<?php if(isset($description)){ ?>
				
					<div class="meta-description"> <?php echo $description; ?> </div>
					
				<?php } ?>
				
				<br class=clear>
			</div>
			
		<?php
		
	}
	function wpadm_print_meta_shortcode_box($args){
		extract($args);
		//print_r($args);
		?>
		
			<div class="meta-body">
				<div class="meta-title">
					<label for="<?php echo $name; ?>" ><?php _e($title, 'gdl_back_office'); ?></label>
				</div>
				<div class="meta-input">
					<input type="text" name="<?php echo $name; ?>" id="<?php echo $name; ?>" value="<?php 
												
						echo ($value == '')? esc_html($default): esc_html($value);
						//echo $value;
						?>" readonly="readonly" />
				
				
				<?php if(isset($description)){ ?>
				
					<div class="meta-description"> <?php echo $description; ?> </div>
					
				<?php } ?>
				</div>
				<br class=clear>
			</div>
			
		<?php
		
	}

	// open => id
	function wpadm_print_meta_open_div($args){
	
		extract($args);
		
		?>
		
			<div id="<?php echo $id; ?>" class="<?php echo $id; ?>" >
		
		<?php
		
	}
	
	// close
	function wpadm_print_meta_close_div($args){
	
		?>
		
			</div>
			
		<?php
		
	}
	
	// save option function that trigger when saveing each post
	add_action('save_post','save_option_meta');
	function save_option_meta($post_id){
	
		// Verification
		if(defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE) return;
		if(!isset($_POST['myplugin_noncename'])) return;
		if(!wp_verify_nonce($_POST['myplugin_noncename'], plugin_basename( __FILE__ ))) return;
		
		// Save data of page
		if('page' == $_POST['post_type']){
		
			if(!current_user_can('edit_page', $post_id)) return;
			
			save_page_option_meta($post_id);
			
		// Save data of post
		}else if('post' == $_POST['post_type']){
		
			if(!current_user_can('edit_post', $post_id)) return;
			
			save_post_option_meta($post_id);
			
		}else if('board_directory' == $_POST['post_type']){
		
			if(!current_user_can('edit_post', $post_id)) return;
			
			save_board_directory_option_meta($post_id);
		}else if('online_test' == $_POST['post_type']){
		
			if(!current_user_can('edit_post', $post_id)) return;
			
			save_online_test_option_meta($post_id);
		}
	}
	
	function save_meta_data($post_id, $new_data, $old_data, $name){

		if($new_data == $old_data){
		
			add_post_meta($post_id, $name, $new_data, true);
			
		}else if($new_data != $old_data){

			update_post_meta($post_id, $name, $new_data, $old_data);
			
		}
	}
	
	
	
?>