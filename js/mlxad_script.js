jQuery(document).ready(function(){
       
	   var uploadID          = '';  
	   
		jQuery('#upload_image_button').click(function() {
			 
			 window.send_to_editor = newSendToEditor;  
			 uploadID = jQuery(this).prev('input');
			 tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
			 return false;
		});
 		
		storeSendToEditor = window.send_to_editor;  
            newSendToEditor   = function(html) {  
			imgurl = jQuery('img',html).attr('src');  
			uploadID.val(imgurl);
			tb_remove();
			window.send_to_editor = storeSendToEditor;  
		};  
		
		jQuery('#remove_img').click(function() { 
			jQuery('#upload_image').val('');
		});
		
		
		
		function mlx_ad_type_checked(){
			if(jQuery(this).val() == 'image_ad')
			{
				jQuery('.meta-body').has('#upload_image').fadeIn();	
				jQuery('.meta-body').has('#mlx_ad_w').fadeIn();	
				jQuery('.meta-body').has('#mlx_ad_h').fadeIn();	
				
				jQuery('.meta-body').has('#mlx_ad_content').fadeOut();	
				
				jQuery('.meta-body').has('#mlx_ad_anchor_link').fadeIn();	
				jQuery('.meta-body').has('.mlx_ad_anchor_target').fadeIn();	
				
			}
			
			if(jQuery(this).val() == 'link_ad')
			{
				jQuery('.meta-body').has('#upload_image').fadeOut();	
				jQuery('.meta-body').has('#mlx_ad_w').fadeOut();	
				jQuery('.meta-body').has('#mlx_ad_h').fadeOut();	
				
				jQuery('.meta-body').has('#mlx_ad_content').fadeIn();	
				
				jQuery('.meta-body').has('#mlx_ad_anchor_link').fadeOut();	
				jQuery('.meta-body').has('.mlx_ad_anchor_target').fadeOut();	
			}	
		}
		
		// Show on All posts / Selected Posts
		if(jQuery("input[name=spec-ads-post-type]:radio").is(':checked'))
		{
			if(jQuery("input[name=spec-ads-post-type]:radio:checked").val()  == 'all_posts')
			{	jQuery('.meta-body').has('#spec-ads-posts').hide();		}
			
			if(jQuery("input[name=spec-ads-post-type]:radio:checked").val()  == 'selected_posts')
			{	jQuery('.meta-body').has('#spec-ads-posts').fadeIn();	}
		}
		else
		{	jQuery('.meta-body').has('#spec-ads-posts').hide();			}
		
		
		jQuery("input[name=spec-ads-post-type]:radio").on("change",function (){
			//alert(jQuery(this).val());
			if(jQuery(this).val() == 'all_posts')
			{	jQuery('.meta-body').has('#spec-ads-posts').fadeOut(); 
			}
			if(jQuery(this).val() == 'selected_posts')
			{	 jQuery('.meta-body').has('#spec-ads-posts').fadeIn();		}
		});

		// Slider Autoplay Yes/No and autoplay after seconds
		if(jQuery("input[name=slider_autoplay]:radio").is(':checked'))
		{
			if(jQuery("input[name=slider_autoplay]:radio:checked").val()  == 'false')
			{	jQuery('.meta-body').has('#slider_autoplay_after').hide();		}
			
			if(jQuery("input[name=slider_autoplay]:radio:checked").val()  == 'true')
			{	jQuery('.meta-body').has('#slider_autoplay_after').fadeIn();	}
		}
		else
		{	jQuery('.meta-body').has('#slider_autoplay_after').hide();			}
		
		
		jQuery("input[name=slider_autoplay]:radio").on("change",function (){
			//alert(jQuery(this).val());
			
			if(jQuery(this).val() == 'false')
			{	jQuery('.meta-body').has('#slider_autoplay_after').fadeOut(); 
			}
			if(jQuery(this).val() == 'true')
			{	 jQuery('.meta-body').has('#slider_autoplay_after').fadeIn();		}
		});



		// Slide Settings Single-slide or multiple slide
		if(jQuery("input[name=spec-ad-slides]:radio").is(':checked'))
		{
			if(jQuery("input[name=spec-ad-slides]:radio:checked").val()  == 'single_slide')
			{	jQuery('.meta-body').has('#slider_no_of_ads').hide();		
				jQuery('.meta-body').has('.slider_stop_on_hover').hide();		
				jQuery('.meta-body').has('.slider_autoplay').hide();		
				jQuery('.meta-body').has('#slider_autoplay_after').hide();		
				jQuery('.meta-body').has('.slider_pagination').hide();		
				jQuery('.meta-body').has('#slider_transition').hide();		
				//jQuery('.meta-body').has('#slider_no_of_ads').hide();		
			}
			
			if(jQuery("input[name=spec-ad-slides]:radio:checked").val()  == 'multiple_slide')
			{	jQuery('.meta-body').has('#slider_no_of_ads').fadeIn();	
				jQuery('.meta-body').has('.slider_stop_on_hover').fadeIn();	
				jQuery('.meta-body').has('.slider_autoplay').fadeIn();	
				jQuery('.meta-body').has('#slider_autoplay_after').fadeIn();	
				jQuery('.meta-body').has('.slider_pagination').fadeIn();	
				jQuery('.meta-body').has('#slider_transition').fadeIn();	
				//jQuery('.meta-body').has('#slider_no_of_ads').fadeIn();	
			}
		}
		else
		{	jQuery('.meta-body').has('#slider_no_of_ads').hide();		
			jQuery('.meta-body').has('.slider_stop_on_hover').hide();		
			jQuery('.meta-body').has('.slider_autoplay').hide();		
			jQuery('.meta-body').has('#slider_autoplay_after').hide();		
			jQuery('.meta-body').has('.slider_pagination').hide();		
			jQuery('.meta-body').has('#slider_transition').hide();		
			//jQuery('.meta-body').has('#slider_no_of_ads').hide();		
		}
		
		
		jQuery("input[name=spec-ad-slides]:radio").on("change",function (){
			//alert(jQuery(this).val());
			if(jQuery(this).val() == 'single_slide')
			{	jQuery('.meta-body').has('#slider_no_of_ads').fadeOut();
				jQuery('.meta-body').has('.slider_stop_on_hover').fadeOut();
				jQuery('.meta-body').has('.slider_autoplay').fadeOut();
				jQuery('.meta-body').has('#slider_autoplay_after').fadeOut();
				jQuery('.meta-body').has('.slider_pagination').fadeOut();
				jQuery('.meta-body').has('#slider_transition').fadeOut();
				
			}
			if(jQuery(this).val() == 'multiple_slide')
			{	jQuery('.meta-body').has('#slider_no_of_ads').fadeIn();
				jQuery('.meta-body').has('.slider_stop_on_hover').fadeIn();
				jQuery('.meta-body').has('.slider_autoplay').fadeIn();
				jQuery('.meta-body').has('#slider_autoplay_after').fadeIn();
				jQuery('.meta-body').has('.slider_pagination').fadeIn();
				jQuery('.meta-body').has('#slider_transition').fadeIn();
				
			}
		});



		// Show on All pages / Selected Pages
		if(jQuery("input[name=spec-ads-page-type]:radio").is(':checked'))
		{
			if(jQuery("input[name=spec-ads-page-type]:radio:checked").val()  == 'all_pages')
			{	jQuery('.meta-body').has('#spec-ads-pages').hide();		}
			
			if(jQuery("input[name=spec-ads-page-type]:radio:checked").val()  == 'selected_pages')
			{	jQuery('.meta-body').has('#spec-ads-pages').fadeIn();	}
		}
		else
		{	jQuery('.meta-body').has('#spec-ads-pages').hide();			}
		
		
		jQuery("input[name=spec-ads-page-type]:radio").on("change",function (){
			//alert(jQuery(this).val());
			if(jQuery(this).val() == 'all_pages')
			{	jQuery('.meta-body').has('#spec-ads-pages').fadeOut(); 
			}
			if(jQuery(this).val() == 'selected_pages')
			{	 jQuery('.meta-body').has('#spec-ads-pages').fadeIn();		}
		});
		
		// Show on All category pages / Selected category Pages
		if(jQuery("input[name=spec-ads-cat-type]:radio").is(':checked'))
		{
			if(jQuery("input[name=spec-ads-cat-type]:radio:checked").val()  == 'all_cats')
			{	jQuery('.meta-body').has('#spec-ads-categories').hide();		}
			
			if(jQuery("input[name=spec-ads-cat-type]:radio:checked").val()  == 'selected_cats')
			{	jQuery('.meta-body').has('#spec-ads-categories').fadeIn();	}
		}
		else
		{	jQuery('.meta-body').has('#spec-ads-categories').hide();			}
		
		
		jQuery("input[name=spec-ads-cat-type]:radio").on("change",function (){
			//alert(jQuery(this).val());
			if(jQuery(this).val() == 'all_cats')
			{	jQuery('.meta-body').has('#spec-ads-categories').fadeOut(); 
			}
			if(jQuery(this).val() == 'selected_cats')
			{	 jQuery('.meta-body').has('#spec-ads-categories').fadeIn();		}
		});

		// Show on All category pages / Selected category Pages
		if(jQuery("input[name=spec-ads-otherpage-type]:radio").is(':checked'))
		{
			if(jQuery("input[name=spec-ads-otherpage-type]:radio:checked").val()  == 'all_otherpages')
			{	jQuery('.meta-body').has('#spec-ads-otherpages').hide();		}
			
			if(jQuery("input[name=spec-ads-otherpage-type]:radio:checked").val()  == 'selected_otherpages')
			{	jQuery('.meta-body').has('#spec-ads-otherpages').fadeIn();	}
		}
		else
		{	jQuery('.meta-body').has('#spec-ads-otherpages').hide();			}
		
		
		jQuery("input[name=spec-ads-otherpage-type]:radio").on("change",function (){
			//alert(jQuery(this).val());
			if(jQuery(this).val() == 'all_otherpages')
			{	jQuery('.meta-body').has('#spec-ads-otherpages').fadeOut(); 
			}
			if(jQuery(this).val() == 'selected_otherpages')
			{	 jQuery('.meta-body').has('#spec-ads-otherpages').fadeIn();		}
		});

		// Show on All Countries / Selected Countries
		if(jQuery("input[name=spec-ads-countries]:radio").is(':checked'))
		{
			if(jQuery("input[name=spec-ads-countries]:radio:checked").val()  == 'all_countries')
			{	jQuery('.meta-body').has('#spec-ads-countries-list').hide();		}
			
			if(jQuery("input[name=spec-ads-countries]:radio:checked").val()  == 'selected_countries')
			{	jQuery('.meta-body').has('#spec-ads-countries-list').fadeIn();	}
		}
		else
		{	jQuery('.meta-body').has('#spec-ads-countries-list').hide();			}
		
		
		jQuery("input[name=spec-ads-countries]:radio").on("change",function (){
			//alert(jQuery(this).val());
			if(jQuery(this).val() == 'all_countries')
			{	jQuery('.meta-body').has('#spec-ads-countries-list').fadeOut(); 
			}
			if(jQuery(this).val() == 'selected_countries')
			{	 jQuery('.meta-body').has('#spec-ads-countries-list').fadeIn();		}
		});




		//if(jQuery('#mlx_ad_type').is(':checked'))
		if(jQuery("input[name=mlx_ad_type]:radio").is(':checked'))
		{	
			//alert('here');
			//alert(jQuery('#mlx_ad_type').val());
			//alert(jQuery("input[name=mlx_ad_type]:radio:checked").val());
			if(jQuery("input[name=mlx_ad_type]:radio:checked").val()  == 'image_ad')
			{
				jQuery('.meta-body').has('#upload_image').fadeIn();	
				jQuery('.meta-body').has('#mlx_ad_w').fadeIn();	
				jQuery('.meta-body').has('#mlx_ad_h').fadeIn();	
				
				jQuery('.meta-body').has('#mlx_ad_content').fadeOut();	
				
				jQuery('.meta-body').has('#mlx_ad_anchor_link').fadeIn();	
				jQuery('.meta-body').has('.mlx_ad_anchor_target').fadeIn();	
				
			}
				
				if(jQuery("input[name=mlx_ad_type]:radio:checked").val()  == 'link_ad')
				{
					jQuery('.meta-body').has('#upload_image').fadeOut();	
					jQuery('.meta-body').has('#mlx_ad_w').fadeOut();	
					jQuery('.meta-body').has('#mlx_ad_h').fadeOut();	
					
					jQuery('.meta-body').has('#mlx_ad_content').fadeIn();	
					
					jQuery('.meta-body').has('#mlx_ad_anchor_link').fadeOut();	
					jQuery('.meta-body').has('.mlx_ad_anchor_target').fadeOut();	
				}
				
		}
		else
		{
			jQuery('.meta-body').has('#upload_image').hide();	
			jQuery('.meta-body').has('#mlx_ad_w').hide();	
			jQuery('.meta-body').has('#mlx_ad_h').hide();	
			
			jQuery('.meta-body').has('#mlx_ad_content').hide();	
			
			jQuery('.meta-body').has('#mlx_ad_anchor_link').hide();	
			jQuery('.meta-body').has('.mlx_ad_anchor_target').hide();	
		}
		
		jQuery('.mlx_ad_type').each(function(i) { 
			//alert(i);								 	
			jQuery(this).change(function (){
				//alert(jQuery(this).val());
				if(jQuery(this).val() == 'image_ad')
				{
					jQuery('.meta-body').has('#upload_image').fadeIn();	
					jQuery('.meta-body').has('#mlx_ad_w').fadeIn();	
					jQuery('.meta-body').has('#mlx_ad_h').fadeIn();	
					
					jQuery('.meta-body').has('#mlx_ad_content').hide();	
					
					jQuery('.meta-body').has('#mlx_ad_anchor_link').fadeIn();	
					jQuery('.meta-body').has('.mlx_ad_anchor_target').fadeIn();	
					
				}
				
				if(jQuery(this).val() == 'link_ad')
				{
					jQuery('.meta-body').has('#upload_image').hide();	
					jQuery('.meta-body').has('#mlx_ad_w').hide();	
					jQuery('.meta-body').has('#mlx_ad_h').hide();	
					
					jQuery('.meta-body').has('#mlx_ad_content').fadeIn();	
					
					jQuery('.meta-body').has('#mlx_ad_anchor_link').hide();	
					jQuery('.meta-body').has('.mlx_ad_anchor_target').hide();	
				}
				
				
			});
											 
		});									 
		
		
		
});