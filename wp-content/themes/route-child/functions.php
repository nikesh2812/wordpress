<?php
/*
	 =========================
	 Define Parent style file
	 =========================
*/
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
 
}

/*
	=========================
	    NEWS SHORTCODE
	=========================
*/
	add_shortcode('news_q', 'news_custom_shortcode_query');
    function news_custom_shortcode_query(){
    	global $wpdb;
		$querystr = "SELECT * 
	    FROM $wpdb->posts
	    WHERE $wpdb->posts.post_status = 'publish'
	    AND $wpdb->posts.post_type = 'newss'
	    ORDER BY $wpdb->posts.menu_order ASC";

	    $pageposts = $wpdb->get_results($querystr, OBJECT);
	   $count=count($pageposts);

	  $out = '';
	   if (qtranxf_getLanguage() == 'HI') {
		  	if($count>0){
	           foreach($pageposts as $pageData){
	           	   $new_banner = get_post_meta($pageData->ID,'wpcf-punjabi-news-banner',true);
	           	   if(!empty($new_banner)){
	           	   	 $new_banner_image = $new_banner;
	           	   }
	           	   else{
	           	   	$new_banner_image = get_post_meta($pageData->ID,'wpcf-news-banner',true);
	           	   }

	           	   $english_title = qtranxf_use_language('en',$pageData->post_title, false, true);
				    $hindi_title = qtranxf_use_language('HI',$pageData->post_title, false, true);

					if (!empty($hindi_title)) {
						$title = $hindi_title;
					}else{
						$title = $english_title ;
					}

					$english_content = qtranxf_use_language('en',$pageData->post_content, false, true);
				    $hindi_content = qtranxf_use_language('HI',$pageData->post_content, false, true);

					if (!empty($hindi_content)) {
						$content = $hindi_content;
					}else{
						$content = $english_content ;
					}

	               $out .='<div class="news-list">
					         <div class="col-sm-2 c-news-img">
							    <img src="'.$new_banner_image.'">
					          </div>
					          <div class="col-sm-10 c-news-content">
						          <h4>'.$title.'</h4>
						          <p>'.substr($content,0,135).'</p>
					            </div>';
				    $out .='</div><div class="clearfix"></div>';	
				
				} 
				$out .='</div><div><div class="cs-column-text btn-div"><p style="text-align: left;"><a class="c-view-link" href="'.site_url().'/news"><font style="font-size:100%" my="my">View All NEWS </font><i class="fa fa-caret-right"></i></a></p></div>';
	        }else{
		 
		       $out .="<div class='d-flex'><center class='middle-data'><i class='fa fa-info-circle'></i><br/>No News</center></div><style>.view-link{display:none;}</style>";
	        }
	    }
	    else{

	    	if($count>0){
	           foreach($pageposts as $pageData){
	           	  $new_banner = get_post_meta($pageData->ID,'wpcf-news-banner',true);
	           	  if(!empty($new_banner)){
	           	  	$new_banner_image = $new_banner;
	           	  }
	           	  else{
	           	  	$new_banner_image = get_post_meta($pageData->ID,'wpcf-punjabi-news-banner',true); 
	           	  }
	           	  $english_title = qtranxf_use_language('en',$pageData->post_title, false, true);
				    $hindi_title = qtranxf_use_language('HI',$pageData->post_title, false, true);

					if (!empty($english_title)) {
						$title = $english_title;
					}else{
						$title = $hindi_title ;
					}

					$english_content = qtranxf_use_language('en',$pageData->post_content, false, true);
				    $hindi_content = qtranxf_use_language('HI',$pageData->post_content, false, true);

					if (!empty($english_content)) {
						$content = $english_content;
					}else{
						$content = $hindi_content ;
					}
		
	               $out .='<div class="news-list">
					         <div class="col-sm-2 c-news-img">
							    <img src="'.$new_banner_image.'">
					          </div>
					          <div class="col-sm-10 c-news-content">
						          <h4>'.$title.'</h4>
						          <p>'.substr($content,0,135).'</p>
					            </div>';
				    $out .='</div><div class="clearfix"></div>';	
				
				} 
				$out .='</div><div><div class="cs-column-text btn-div"><p style="text-align: left;"><a class="c-view-link" href="'.site_url().'/news"><font style="font-size:100%" my="my">View All NEWS </font><i class="fa fa-caret-right"></i></a></p></div>';
        	}else{
	 
	       		$out .="<div class='d-flex'><center class='middle-data'><i class='fa fa-info-circle'></i><br/>No News</center></div><style>.view-link{display:none;}</style>";
        	}
	    }
      
       wp_reset_query();
       return html_entity_decode($out);
  
      
    }

/*
  ========================================
   News Shortcode
  ========================================
*/
	add_shortcode('latest_news', 'latest_news_shortcode_query');

	function latest_news_shortcode_query($atts, $content){
	  
	global $wpdb;
		$querystr = "SELECT * 
	    FROM $wpdb->posts
	    WHERE $wpdb->posts.post_status = 'publish'
	    AND $wpdb->posts.post_type = 'newss'
	    ORDER BY $wpdb->posts.menu_order ASC";

	$pageposts = $wpdb->get_results($querystr, OBJECT);

	 $out = '';
	 	if (qtranxf_getLanguage() == 'HI') {
			 foreach($pageposts as $pageData){
			 	$english_title = qtranxf_use_language('en',$pageData->post_title, false, true);
				$hindi_title = qtranxf_use_language('HI',$pageData->post_title, false, true);

				if (!empty($hindi_title)) {
					$title = $hindi_title;
				}else{
					$title = $english_title;
				}

			   $english_content = qtranxf_use_language('en',$pageData->post_content, false, true);
			   $hindi_content = qtranxf_use_language('HI',$pageData->post_content, false, true);
			   if (!empty($hindi_content)) {
					$post =  nl2br($hindi_content);
				}else{
					$post =  nl2br($english_content);
				}

			   $new_banner = get_post_meta($pageData->ID,'wpcf-punjabi-news-banner',true);

			   if (!empty($new_banner)) {
			   		$new_banner_image = $new_banner;
			   }
			   else{
			   	  $new_banner_image =  get_post_meta($pageData->ID,'wpcf-news-banner',true);
			   }

			    $out .='<div class="news-list location-box"><div class="col-sm-12 c-news-content">
			      <div class="news-image"><img src="'. $new_banner_image.'"></div>
			      <h4 class="location-title">'.$title.'</h4>
			          <p>'.$post.'</p>
			      </div></div>'; 
			  }
		}
		else{
			foreach($pageposts as $pageData){

			   $post = nl2br($pageData->post_content);
			   $new_banner = get_post_meta($pageData->ID,'wpcf-news-banner',true);

			    if (!empty($new_banner)) {
			   		$new_banner_image = $new_banner;
				}
				else{
				   	$new_banner_image =  get_post_meta($pageData->ID,'wpcf-punjabi-news-banner',true);
				}


			    $out .='<div class="news-list location-box"><div class="col-sm-12 c-news-content">
			      <div class="news-image"><img src="'. $new_banner_image.'"></div>
			      <h4 class="location-title">'.$pageData->post_title.'</h4>
			          <p>'.$post.'</p>
			      </div></div>'; 
			}
		} 
	      
	  wp_reset_query();
	  return html_entity_decode($out);

	} 



/*
	=========================
	    EVENTS SHORTCODE
	=========================
*/
	add_shortcode('event_q','events_custom_shortcode_api');
	function events_custom_shortcode_api(){
		global $wpdb;
		$querystr = "SELECT * 
	    FROM $wpdb->posts
	    WHERE $wpdb->posts.post_status = 'publish' 
	    AND $wpdb->posts.post_type = 'event'
	    ORDER BY $wpdb->posts.menu_order ASC";

	    $pageposts = $wpdb->get_results($querystr, OBJECT);
		$count=count($pageposts);
		$out = '';

		if (qtranxf_getLanguage() == 'HI') {
			if($count>0){
	 			foreach($pageposts as $pageData){
					$dateFrom = date("d M ", get_post_meta( $pageData->ID, 'wpcf-event-from', true ));
					$dateTo = date("d M ", get_post_meta( $pageData->ID, 'wpcf-event-to', true ));


					$english_title = qtranxf_use_language('en',$pageData->post_title, false, true);
				    $hindi_title = qtranxf_use_language('HI',$pageData->post_title, false, true);

					if (!empty($hindi_title)) {
						$title = $hindi_title;
					}else{
						$title = $english_title ;
					}

					$english_content = qtranxf_use_language('en',$pageData->post_content, false, true);
				    $hindi_content = qtranxf_use_language('HI',$pageData->post_content, false, true);

					if (!empty($hindi_content)) {
						$content = $hindi_content;
					}else{
						$content = $english_content ;
					}


					$out .='<div class="c-event-list">
					<div class="col-sm-2 e-date">
						<div class="e-date-bg">
							<span class="e-to-date">'.$dateTo.'</span>
							<span class="e-from-date">'.$dateFrom.'</span>
						</div>
					</div>
					<div class="col-sm-10 e-content">
						<h4>'.$title.'</h4>
						<p>'.substr($content,0,135).'</p>
					</div>';
					$out .='</div>';		
				} 
				$out .='</div><div><div class="cs-column-text btn-div"><p style="text-align: left;"><a class="c-view-link" href="'.site_url().'/events"><font style="font-size:100%" my="my">View All EVENTS </font><i class="fa fa-caret-right"></i></a></p>
				</div>';
			}else{
				$out .="<div class='d-flex'><center class='middle-data'><i class='fa fa-info-circle'></i><br/>No Events</center></div><style>.view-link{display:none;}</style>";
			}
		}
		else{
			if($count>0){
	 			foreach($pageposts as $pageData){

					$dateFrom = date("d M ", get_post_meta( $pageData->ID, 'wpcf-event-from', true ));
					$dateTo = date("d M ", get_post_meta( $pageData->ID, 'wpcf-event-to', true ));


					$english_title = qtranxf_use_language('en',$pageData->post_title, false, true);
				    $hindi_title = qtranxf_use_language('HI',$pageData->post_title, false, true);

					if (!empty($english_title)) {
						$title = $english_title;
					}else{
						$title = $hindi_title ;
					}

					$english_content = qtranxf_use_language('en',$pageData->post_content, false, true);
				    $hindi_content = qtranxf_use_language('HI',$pageData->post_content, false, true);

					if (!empty($english_content)) {
						$content = $english_content;
					}else{
						$content = $hindi_content ;
					}

					$out .='<div class="c-event-list">
					<div class="col-sm-2 e-date">
						<div class="e-date-bg">
							<span class="e-to-date">'.$dateTo.'</span>
							<span class="e-from-date">'.$dateFrom.'</span>
						</div>
					</div>
					<div class="col-sm-10 e-content">
						<h4>'.$title.'</h4>
						<p>'.substr($content,0,135).'</p>
					</div>';
					$out .='</div>';		
				} 
				$out .='</div><div><div class="cs-column-text btn-div"><p style="text-align: left;"><a class="c-view-link" href="'.site_url().'/events"><font style="font-size:100%" my="my">View All EVENTS </font><i class="fa fa-caret-right"></i></a></p>
				</div>';
			}else{
				$out .="<div class='d-flex'><center class='middle-data'><i class='fa fa-info-circle'></i><br/>No Events</center></div><style>.view-link{display:none;}</style>";
			}
		}
		wp_reset_query();
  		return html_entity_decode($out);
	}

	add_shortcode('event', 'events_shortcode_query');

	function events_shortcode_query($atts, $content){
	  
	  global $wpdb;
	  $querystr = "SELECT * FROM $wpdb->posts
	    WHERE $wpdb->posts.post_status = 'publish' 
	    AND $wpdb->posts.post_type = 'event'
	    ORDER BY $wpdb->posts.menu_order DESC ";

	  $out ='';

	  $pageposts = $wpdb->get_results($querystr, OBJECT);

	  	if (qtranxf_getLanguage() == 'HI') {
		  	foreach($pageposts as $pageData){
		  		   $dateFrom = date("d M ", get_post_meta( $pageData->ID, 'wpcf-event-from', true ));
					$dateTo = date("d M ", get_post_meta( $pageData->ID, 'wpcf-event-to', true ));


					$english_title = qtranxf_use_language('en',$pageData->post_title, false, true);
				    $hindi_title = qtranxf_use_language('HI',$pageData->post_title, false, true);

					if (!empty($hindi_title)) {
						$title = $hindi_title;
					}else{
						$title = $english_title ;
					}

					$english_content = qtranxf_use_language('en',$pageData->post_content, false, true);
				    $hindi_content = qtranxf_use_language('HI',$pageData->post_content, false, true);

					if (!empty($hindi_content)) {
						$content = $hindi_content;
					}else{
						$content = $english_content ;
					}

		     $out .='<div class="c-event-list"><div class="col-sm-2 e-date"><div class="e-date-bg"><span class="e-to-date">'.$dateTo.'</span>
		            <span class="e-from-date">'.$dateFrom .'</span></div></div>
		            <div class="col-sm-10 e-content">
		          <h4 class="location-title">'.$title.'</h4>
		          <p>'.nl2br($content).'</p>
		        </div></div>';
		  	}
	 	}
	 	else{
	 		foreach($pageposts as $pageData){
	 			    $dateFrom = date("d M ", get_post_meta( $pageData->ID, 'wpcf-event-from', true ));
					$dateTo = date("d M ", get_post_meta( $pageData->ID, 'wpcf-event-to', true ));

					$english_title = qtranxf_use_language('en',$pageData->post_title, false, true);
				    $hindi_title = qtranxf_use_language('HI',$pageData->post_title, false, true);

					if (!empty($english_title)) {
						$title = $english_title;
					}else{
						$title = $hindi_title ;
					}

					$english_content = qtranxf_use_language('en',$pageData->post_content, false, true);
				    $hindi_content = qtranxf_use_language('HI',$pageData->post_content, false, true);

					if (!empty($english_content)) {
						$content = $english_content;
					}else{
						$content = $hindi_content ;
					}

			     $out .='<div class="c-event-list"><div class="col-sm-2 e-date"><div class="e-date-bg"><span class="e-to-date">'.$dateTo.'</span>
			            <span class="e-from-date">'.$dateFrom .'</span></div></div>
			            <div class="col-sm-10 e-content">
			          <h4 class="location-title">'.$title.'</h4>
			          <p>'.nl2br($content).'</p>
			        </div></div>';
			}
	 	}

	  
	      
	  wp_reset_query();
	  return html_entity_decode($out);
	}

/*
  ===========================================
  Downloads Shortcode
  ===========================================
*/
	add_shortcode('download','downloadss_shortcode_query');

	function downloadss_shortcode_query($atts, $content){
	  
	global $wpdb;
	$deptdata=array();
	$postid=array();
	$querystr = "
	    SELECT * FROM $wpdb->posts
	    WHERE $wpdb->posts.post_status = 'publish' 
	    AND $wpdb->posts.post_type = 'download'
	    ORDER BY $wpdb->posts.menu_order ASC";

	$pageposts = $wpdb->get_results($querystr, OBJECT);

	$out = '';
	if (qtranxf_getLanguage() == 'HI') {

		  foreach($pageposts as $pageData){
		    $department =   get_post_meta( $pageData->ID, 'wpcf-punjabi-department-name', true );
		    if (!empty($department)) {
		    	$departName = $department;
		    }else{
		    	$departName = get_post_meta( $pageData->ID, 'wpcf-department-name', true );
		    }
		    if(!in_array($departName,$deptdata)){
		      array_push($deptdata,$departName);
		    }
		    array_push($postid,$pageData->ID); 
		  }
		  $count_cat=count($deptdata);
		  for($i=0;$i<$count_cat;$i++){
		    $out .='<div class="col-sm-12"><h4 class="download-cat">'. $deptdata[$i].'</h4>';
		    foreach($postid as  $post){
		      $downloadU =   get_post_meta( $post, 'wpcf-punjabi-enter-url-here', true );
		      $downloadD =   get_post_meta( $post, 'wpcf-punjabi-upload-your-document', true );
		      $departmnt =   get_post_meta( $post, 'wpcf-punjabi-department-name', true );

		      if (!empty($downloadU)) {
		      	$downloadUrl = $downloadU;
		      }else{
                 $downloadUrl =   get_post_meta( $post, 'wpcf-enter-url-here', true );
		      }
		      if (!empty($downloadD)) {
		      	$downloadDoc = $downloadD;
		      }else{
                $downloadDoc =   get_post_meta( $post, 'wpcf-upload-your-document', true );
		      }
		      if (!empty($departmnt)) {
		      	$depart = $departmnt;
		      }else{
                 $depart =   get_post_meta( $post, 'wpcf-department-name', true );
		      }

		      $post_data = get_post( $post );
		            $english_title = qtranxf_use_language('en',$post_data->post_title, false, true);
				    $hindi_title = qtranxf_use_language('HI',$post_data->post_title, false, true);

					if (!empty($hindi_title)) {
						$title = $hindi_title;
					}else{
						$title = $english_title ;
					} 

		      if(!$downloadUrl && $downloadDoc ){
		        $querystr1 = "SELECT * FROM $wpdb->postmeta
		        WHERE $wpdb->postmeta.post_id = '".$post."' AND  $wpdb->postmeta.meta_key = '".$downloadDoc."' ORDER BY $wpdb->postmeta.meta_id DESC";
		        $pageposts1 = $wpdb->get_results($querystr1, OBJECT);
		        $links = '';

		        foreach($pageposts1 as $metaVal){
		          $urls = explode("/", $metaVal->meta_value);
		          $ct = count($urls);
		          $name = $urls[$ct-1];
		          $name_img = explode('.', $name);
		          $str_rep = str_replace('-',' ',$name_img[0]);

		          $links .= '<label style="font-weight: bold;text-transform: uppercase;" class="col-md-10">'.$str_rep.'</label><div class="col-md-2" style="margin-bottom:15px;"><a class="btn-download" href="'.$metaVal->meta_value.'" target="_blank"><font style="font-size:100%" my="my">Upload Your Document</font></a></div>';
		        }
		      }else{
		        $links = '<label style="font-weight: bold;text-transform: uppercase;" class="col-md-10"></label><div class="col-md-12" style="margin-bottom:15px;"><button class="d-btn disable" disabled="disabled" style="-webkit-filter: grayscale(100%); /* Safari 6.0 - 9.0 */ filter:grayscale(100%);cursor:pointer;">Upload Your Document</button></div>';
		      }
		      if($depart==$deptdata[$i]){
		        $content = nl2br($post_data->post_content);

		        $out .= '<div class="download-form-container test" id="'.$post.'"><div class="col-xs-12 col-sm-12"><p class="form-title">'. $title.'</p><label style="font-weight: bold;text-transform: uppercase;" class="col-md-10"></label><div class="download-cotent">'.$links.'</div></div></div>';

		      }
		    }
		     $out .= '</div>';
		   }
		}
		else{
			 	foreach($pageposts as $pageData){
				    $department =   get_post_meta( $pageData->ID, 'wpcf-department-name', true );
				    if (!empty($department)) {
				    	$departName = $department;
				    }else{
				    	$departName = get_post_meta( $pageData->ID, 'wpcf-punjabi-department-name', true );
				    }
				    if(!in_array($departName,$deptdata)){
				      array_push($deptdata,$departName);
				    }
			    	array_push($postid,$pageData->ID); 
		  		}
		  		$count_cat=count($deptdata);
		  		for($i=0;$i<$count_cat;$i++){
		    		$out .='<div class="col-sm-12"><h4 class="download-cat">'. $deptdata[$i].'</h4>';
				    foreach($postid as  $post){
				      $downloadU =   get_post_meta( $post, 'wpcf-enter-url-here', true );
				      $downloadDoc =   get_post_meta( $post, 'wpcf-upload-your-document', true );
				      $department =   get_post_meta( $post, 'wpcf-department-name', true );

				      if (!empty($downloadU)) {
				      	$downloadUrl = $downloadU ;
				      }else{
				      	$downloadUrl = get_post_meta( $post, 'wpcf-punjabi-enter-url-here', true );
				      }

				      if (!empty($downloadD)) {
				      	$downloadDoc = $downloadD ;
				      }else{
				      	$downloadDoc = get_post_meta( $post, 'wpcf-punjabi-upload-your-document', true );
				      }

				      if (!empty($department)) {
				      	$depart = $department;
				      }else{
				      	$depart = get_post_meta( $post, 'wpcf-punjabi-department-name', true );
				      }

				      $post_data = get_post( $post ); 
				      
				       $english_title = qtranxf_use_language('en',$post_data->post_title, false, true);
				    $hindi_title = qtranxf_use_language('HI',$post_data->post_title, false, true);

					if (!empty($english_title)) {
						$title = $english_title;
					}else{
						$title = $hindi_title ;
					}

		      if(!$downloadUrl && $downloadDoc ){
		        $querystr1 = "SELECT * FROM $wpdb->postmeta
		        WHERE $wpdb->postmeta.post_id = '".$post."' AND  $wpdb->postmeta.meta_key = '".$downloadDoc."' ORDER BY $wpdb->postmeta.meta_id DESC";
		        $pageposts1 = $wpdb->get_results($querystr1, OBJECT);
		        $links = '';

		        foreach($pageposts1 as $metaVal){
		          $urls = explode("/", $metaVal->meta_value);
		          $ct = count($urls);
		          $name = $urls[$ct-1];
		          $name_img = explode('.', $name);
		          $str_rep = str_replace('-',' ',$name_img[0]);

		          $links .= '<label style="font-weight: bold;text-transform: uppercase;" class="col-md-10">'.$str_rep.'</label><div class="col-md-2" style="margin-bottom:15px;"><a class="btn-download" href="'.$metaVal->meta_value.'" target="_blank"><font style="font-size:100%" my="my">Upload Your Document</font></a></div>';
		        }
		      }else{
		        $links = '<label style="font-weight: bold;text-transform: uppercase;" class="col-md-10"></label><div class="col-md-12" style="margin-bottom:15px;"><button class="d-btn disable" disabled="disabled" style="-webkit-filter: grayscale(100%); /* Safari 6.0 - 9.0 */ filter:grayscale(100%);cursor:pointer;">Upload Your Document</button></div>';
		      }
		      if($depart==$deptdata[$i]){
		        $content = nl2br($post_data->post_content);

		        $out .= '<div class="download-form-container test" id="'.$post.'"><div class="col-xs-12 col-sm-12"><p class="form-title">'. $title.'</p><label style="font-weight: bold;text-transform: uppercase;" class="col-md-10"></label><div class="download-cotent">'.$links.'</div></div></div>';

		      }
		    }
		     $out .= '</div>';
		   }
		}     
	  wp_reset_query();
	  return html_entity_decode($out);
	} 

/*
	=========================
	    ABOUT SHORTCODE
	=========================
*/
	add_shortcode('about_q', 'about_custom_shortcode_query');
	function about_custom_shortcode_query($atts, $content){
		global $wpdb;
		$querystr = "SELECT * 
	    FROM $wpdb->posts
	    WHERE $wpdb->posts.post_status = 'publish' 
	    AND $wpdb->posts.post_type = 'about'
	    ORDER BY $wpdb->posts.menu_order ASC";

		$pageposts = $wpdb->get_results($querystr, OBJECT);
 		$out = '';
 		foreach($pageposts as $pageData){
 			        $english_content = qtranxf_use_language('en',$pageData->post_content, false, true);
				    $hindi_content   = qtranxf_use_language('HI',$pageData->post_content, false, true);


					if (qtranxf_getLanguage() == 'HI') {

						if (!empty($hindi_content)) {
							$content = $hindi_content ;
						}else{
							$content = $english_content ;
						}

				    }else{
				    	if (!empty($english_content)) {
							$content = $english_content;
						}else{
							$content = $hindi_content ;
						}

				    }
			$out .='<div class="row"><div class="col-md-12" style="padding:15px;"><p>'.nl2br($content).'</p></div></div>'; 
		}
		wp_reset_query();
  		return html_entity_decode($out); 
	}

/*
	=========================
	    MAYOR SHORTCODE
	=========================
*/
	add_shortcode('mayor_q', 'mayor_custom_shortcode_query');
	function mayor_custom_shortcode_query($atts, $content){
		global $wpdb;
		$out='';
		 $querystr = "
		    SELECT * FROM $wpdb->posts
		    WHERE $wpdb->posts.post_status = 'publish' 
		    AND $wpdb->posts.post_type = 'mayor-president'
		    ORDER BY $wpdb->posts.menu_order ASC";
		$pageposts = $wpdb->get_results($querystr, OBJECT);

		if (qtranxf_getLanguage() == 'HI') {
			foreach($pageposts as $pageData){

				$name       =     get_post_meta( $pageData->ID, 'wpcf-punjabi-mp-name', true );
				$designation    =     get_post_meta( $pageData->ID, 'wpcf-punjabi-mp-designation', true );
				$title_p   =     get_post_meta( $pageData->ID, 'wpcf-punjabi-mp-title', true );
				$profile_p    =     get_post_meta( $pageData->ID, 'wpcf-punjabi-mp-profile', true );
				$citizenMsg_p    =     get_post_meta( $pageData->ID, 'wpcf-punjabi-mp-message-to-citizen', true );
				$image    =     get_post_meta( $pageData->ID, 'wpcf-profile-images', true );

				if (!empty($name)) {
					 $Name  = $name;
				}else{
                    $Name  =  get_post_meta( $pageData->ID, 'wpcf-names', true );
				}

				if (!empty($designation)) {
					 $Designation  = $designation;
				}else{
                    $Designation =  get_post_meta( $pageData->ID, 'wpcf-designation-s', true );
				}

				if (!empty($title_p)) {
					 $title  = $title_p;
				}else{
				   $title   =     get_post_meta( $pageData->ID, 'wpcf-titles', true );
				}

				if (!empty($profile_p)) {
					 $profile  = $profile_p;
				}else{
				   $profile = get_post_meta( $pageData->ID, 'wpcf-profiles', true );
				}

				if (!empty($citizenMsg_p)) {
					 $citizenMsg  = $citizenMsg_p;
				}else{
				   $citizenMsg  =  get_post_meta( $pageData->ID, 'wpcf-message-to-citizens', true );
				}

				$out .= '<div class="row">
				         <div class="col-md-3">
				         	<img class="cstm-circle" src="'.$image.'">
				         </div>
				         <div class="col-md-9">
				         	<h3 class="author-name"><font style="font-size:100%" my="my">'.$Name.'</font></h3>
				         	<p class="designation"><font style="font-size:100%" my="my">'.$Designation.'</font></p>
				         </div>
						</div>
						<p><font style="font-size:100%" my="my">'.$citizenMsg.'</font></p>';
			}
		}
		else{
			foreach($pageposts as $pageData){

				$Name_p       =     get_post_meta( $pageData->ID, 'wpcf-names', true );
				$Designation_p    =     get_post_meta( $pageData->ID, 'wpcf-designation-s', true );
				$title_p   =     get_post_meta( $pageData->ID, 'wpcf-titles', true );
				$profile_p    =     get_post_meta( $pageData->ID, 'wpcf-profiles', true );
				$citizenMsg_p    =     get_post_meta( $pageData->ID, 'wpcf-message-to-citizens', true );
				$image    =     get_post_meta( $pageData->ID, 'wpcf-profile-images', true );

				if (!empty($Name_p)) {
					 $Name = $Name_p;
				}else{
                    $Name       =     get_post_meta( $pageData->ID, 'wpcf-punjabi-mp-name', true );
				}

				if (!empty($Designation_p)) {
					 $designation = $Designation_p;
				}else{
                    $designation    =     get_post_meta( $pageData->ID, 'wpcf-punjabi-mp-designation', true );
				}

				if (!empty($title_p)) {
					 $title = $title_p;
				}else{
                    $title   =     get_post_meta( $pageData->ID, 'wpcf-punjabi-mp-title', true );
				}

				if (!empty($profile_p)) {
					 $profile = $profile_p;
				}else{
                    $profile    =     get_post_meta( $pageData->ID, 'wpcf-punjabi-mp-profile', true );
				}

				if (!empty($citizenMsg_p)) {
					 $citizenMsg = $citizenMsg_p;
				}else{
                    $citizenMsg   =     get_post_meta( $pageData->ID, 'wpcf-punjabi-mp-message-to-citizen', true );
				}


				$out .= '<div class="row">
				         <div class="col-md-3">
				         	<img class="cstm-circle" src="'.$image.'">
				         </div>
				         <div class="col-md-9">
				         	<h3 class="author-name"><font style="font-size:100%" my="my">'.$Name.'</font></h3>
				         	<p class="designation"><font style="font-size:100%" my="my">'.$designation.'</font></p>
				         </div>
						</div>
						<p><font style="font-size:100%" my="my">'.$citizenMsg.'</font></p>';
			}

		}
		wp_reset_query();
  		return html_entity_decode($out); 
	}

/*
	=========================
	 COMMISSIONER SHORTCODE
	=========================
*/
	add_shortcode('commissioner_q', 'commissioner_custom_shortcode_query');
	function commissioner_custom_shortcode_query($atts, $content){
		global $wpdb;
		$out='';
		 $querystr = "
		    SELECT * FROM $wpdb->posts
		    WHERE $wpdb->posts.post_status = 'publish' 
		    AND $wpdb->posts.post_type = 'commissioner'
		    ORDER BY $wpdb->posts.menu_order ASC";

		$pageposts = $wpdb->get_results($querystr, OBJECT);

		if (qtranxf_getLanguage() == 'HI') {

			foreach($pageposts as $pageData){

				$Name_p       =     get_post_meta( $pageData->ID, 'wpcf-punjabi-name', true );
				$designation_p    =     get_post_meta( $pageData->ID, 'wpcf-punjab-designation', true );
				$title_p   =     get_post_meta( $pageData->ID, 'wpcf-punjabi-title', true );
				$profile_p    =     get_post_meta( $pageData->ID, 'wpcf-punjabi-profile', true );
				$citizenMsg_p    =     get_post_meta( $pageData->ID, 'wpcf-punjabi-message-to-citizen', true );
				$image    =     get_post_meta( $pageData->ID, 'wpcf-profile-image', true );

				if (!empty($Name_p)) {
					 $Name = $Name_p;
				}else{
                    $Name       =     get_post_meta( $pageData->ID, 'wpcf-name', true );
				}

				if (!empty($designation_p)) {
					 $Designation = $designation_p;
				}else{
                    $Designation    =     get_post_meta( $pageData->ID, 'wpcf-designations', true );
				}

				if (!empty($title_p)) {
					 $title = $title_p;
				}else{
                    $title   =     get_post_meta( $pageData->ID, 'wpcf-title', true );
				}

				if (!empty( $profile_p)) {
					  $profile =  $profile_p;
				}else{
                    $profile    =     get_post_meta( $pageData->ID, 'wpcf-profile', true );
				}

				if (!empty($citizenMsg_p)) {
					 $citizenMsg = $citizenMsg_p;
				}else{
                   $citizenMsg    =     get_post_meta( $pageData->ID, 'wpcf-message-to-citizen', true );
				}


				$out .= '<div class="row">
					<div class="col-md-3"><img class="cstm-circle" src="'.$image.'"></div>
					<div class="col-md-9">
					<h3 class="author-name"><font style="font-size:100%" my="my">'.$Name.'</font></h3>
					<p class="designation"><font style="font-size:100%" my="my">'.$Designation.'</font></p>
					</div>
					</div>
					<p><font style="font-size:100%" my="my">'.$citizenMsg.'</font></p>';
			}
		}
		else{
			foreach($pageposts as $pageData){

				$Name_e       =     get_post_meta( $pageData->ID, 'wpcf-name', true );
				$Designation_e    =     get_post_meta( $pageData->ID, 'wpcf-designations', true );
				$title_e   =     get_post_meta( $pageData->ID, 'wpcf-title', true );
				$profile_e    =     get_post_meta( $pageData->ID, 'wpcf-profile', true );
				$citizenMsg_e    =     get_post_meta( $pageData->ID, 'wpcf-message-to-citizen', true );
				 $image    =     get_post_meta( $pageData->ID, 'wpcf-profile-image', true );

				if (!empty($Name_e)) {
					 $Name = $Name_e;
				}else{
                    $Name  =     get_post_meta( $pageData->ID, 'wpcf-punjabi-name', true );
				}

				if (!empty($Designation_e)) {
					 $Designation = $Designation_e;
				}else{
                   $Designation    = get_post_meta( $pageData->ID, 'wpcf-punjab-designation', true );
				}

				if (!empty($title_e)) {
					 $title = $title_e;
				}else{
                    $title  =     get_post_meta( $pageData->ID, 'wpcf-punjabi-title', true );
				}

				if (!empty( $profile_e)) {
					  $profile =  $profile_e;
				}else{
                    $profile    =     get_post_meta( $pageData->ID, 'wpcf-punjabi-profile', true );
				}

				if (!empty($citizenMsg_e)) {
					 $citizenMsg = $citizenMsg_e;
				}else{
                   $citizenMsg   =     get_post_meta( $pageData->ID, 'wpcf-punjabi-message-to-citizen', true );
				}

				$out .= '<div class="row">
					<div class="col-md-3"><img class="cstm-circle" src="'.$image.'"></div>
					<div class="col-md-9">
					<h3 class="author-name"><font style="font-size:100%" my="my">'.$Name.'</font></h3>
					<p class="designation"><font style="font-size:100%" my="my">'.$Designation.'</font></p>
					</div>
					</div>
					<p><font style="font-size:100%" my="my">'.$citizenMsg.'</font></p>';
			}
		}
		wp_reset_query();
        return html_entity_decode($out);
	}

/*
	=========================
	TOURISTLOCATION SHORTCODE
	=========================
*/
	add_shortcode('touristLocation_q', 'touristLocation_custom_shortcode_query');
	function touristLocation_custom_shortcode_query($atts, $content){
		global $wpdb;
		$querystr = "
		    SELECT * FROM $wpdb->posts
		    WHERE $wpdb->posts.post_status = 'publish' 
		    AND $wpdb->posts.post_type = 'touristlocation'
		    ORDER BY $wpdb->posts.menu_order ASC";

		$pageposts = $wpdb->get_results($querystr, OBJECT);
		$out = '';
		
		if (qtranxf_getLanguage() == 'HI') {
			foreach($pageposts as $pageData){

				$serviceName_p       =     get_post_meta( $pageData->ID, 'wpcf-punjabi-location-name', true );
				$serviceAddress_p    =     get_post_meta( $pageData->ID, 'wpcf-punjabi-tourist-address', true );
				$serviceLocality_p   =     get_post_meta( $pageData->ID, 'wpcf-punjabi-tourist-locality', true );
				$serviceImage_p    =     get_post_meta( $pageData->ID, 'wpcf-punjabi-upload-image', true );
				$serviceDescription_p    =     get_post_meta( $pageData->ID, 'wpcf-punjabi-tourist-location-address', true );

				if(!empty($serviceName_p)){
                    $serviceName = $serviceName_p;
				}else{
				   $serviceName       =     get_post_meta( $pageData->ID, 'wpcf-location-name', true );      
				}

				if(!empty($serviceAddress_p)){
                    $serviceAddress = $serviceAddress_p;
				}else{
				   $serviceAddress    =     get_post_meta( $pageData->ID, 'wpcf-tourist-location-address', true );   
				}

				if(!empty($serviceLocality_p)){
                     $serviceLocality = $serviceLocality_p;
				}else{
				   $serviceLocality   =     get_post_meta( $pageData->ID, 'wpcf-tourist-locality', true );   
				}

				if(!empty($serviceImage_p)){
                    $serviceImage = $serviceImage_p;
				}else{
				   $serviceImage    =     get_post_meta( $pageData->ID, 'wpcf-upload-image', true );      
				}

				$english_content = qtranxf_use_language('en',$pageData->post_content, false, true);
				    $hindi_content = qtranxf_use_language('HI',$pageData->post_content, false, true);

					if (!empty($hindi_content)) {
						$content = $hindi_content;
					}else{
						$content = $english_content ;
					}

				
			
				$out .= '<div class="row location-box">
					        <div class="col-sm-5 npl npr" style="padding-left:20px !important;">
							   <img class="img-responsive cstm-width" src="'.$serviceImage.'" style="width: 300px !important;height: 200px !important;">
					        </div>
					        <div class="col-sm-7 npr">
						      <h4 for="location name" class="location-title">'.$serviceName.'</h4>
						      <h5 class="fw">Description</h5>
							  <p for="address">'.$content.'</p>
							  <h5 class="fw">Location</h5>
							  <p for="address">'.$serviceAddress.'</p>
							  <h5 class="fw">Locality</h5>
							  <p for="locality" class="mb-20">'.$serviceLocality.'</p>
					        </div>
					    </div>';
			}
		}
		else{
			foreach($pageposts as $pageData){

				$serviceName_e       =     get_post_meta( $pageData->ID, 'wpcf-location-name', true );
				$serviceAddress_e    =     get_post_meta( $pageData->ID, 'wpcf-tourist-location-address', true );
				$serviceLocality_e   =     get_post_meta( $pageData->ID, 'wpcf-tourist-locality', true );
				$serviceImage_e    =     get_post_meta( $pageData->ID, 'wpcf-upload-image', true );
				$serviceDescription_e    =     get_post_meta( $pageData->ID, 'wpcf-tourist-address', true );


				if(!empty($serviceName_e)){
                    $serviceName = $serviceName_e;
				}else{
				   $serviceName       =     get_post_meta( $pageData->ID, 'wpcf-punjabi-location-name', true );      
				}

				if(!empty($serviceAddress_e)){	
                    $serviceAddress = $serviceAddress_e;
				}else{
				   $serviceAddress    =    get_post_meta( $pageData->ID, 'wpcf-punjabi-tourist-address', true );  
				}

				if(!empty($serviceLocality_e)){
                     $serviceLocality = $serviceLocality_e;
				}else{
				   $serviceLocality   =   get_post_meta( $pageData->ID, 'wpcf-punjabi-tourist-locality', true );  
				}

				if(!empty($serviceImage_e)){
                    $serviceImage = $serviceImage_e;
				}else{
				   $serviceImage    =     get_post_meta( $pageData->ID, 'wpcf-punjabi-upload-image', true );      
				}

				$english_content = qtranxf_use_language('en',$pageData->post_content, false, true);
				    $hindi_content = qtranxf_use_language('HI',$pageData->post_content, false, true);

					if (!empty($english_content)) {
						$content = $english_content;
					}else{
						$content = $hindi_content ;
					}

				

			
				$out .= '<div class="row location-box">
					        <div class="col-sm-5 npl npr" style="padding-left:20px !important;">
							   <img class="img-responsive cstm-width" src="'.$serviceImage.'" style="width: 300px !important;height: 200px !important;">
					        </div>
					        <div class="col-sm-7 npr">
						      <h4 for="location name" class="location-title">'.$serviceName.'</h4>
						      <h5 class="fw">Description</h5>
							  <p for="address">'.$content.'</p>
							  <h5 class="fw">Location</h5>
							  <p for="address">'.$serviceAddress.'</p>
							  <h5 class="fw">Locality</h5>
							  <p for="locality" class="mb-20">'.$serviceLocality.'</p>
					        </div>
					    </div>';
			}

		} 
		wp_reset_query();
        return html_entity_decode($out);
	}

/*
	=========================
	 PUBLICUTILITY SHORTCODE
	=========================
*/
	add_shortcode('publicutility_q', 'publicutility_custom_shortcode_query');
	function publicutility_custom_shortcode_query($atts, $content){
		global $wpdb;
		 $querystr = "SELECT * FROM $wpdb->posts
		    WHERE $wpdb->posts.post_status = 'publish' 
		    AND $wpdb->posts.post_type = 'utility-service'
		    ORDER BY $wpdb->posts.menu_order ASC";

		$pageposts = $wpdb->get_results($querystr, OBJECT);
		$out = '';
		if (qtranxf_getLanguage() == 'HI') {
			foreach($pageposts as $pageData){
				
				$serviceName_p       =     get_post_meta( $pageData->ID, 'wpcf-punjabi-service-name', true );
				$serviceAddress_p    =     get_post_meta( $pageData->ID, 'wpcf-punjabi-enter-description', true );
				$serviceLocality_p   =     get_post_meta( $pageData->ID, 'wpcf-punjabi-locality', true );
				$serviceImage_p      =      get_post_meta( $pageData->ID, 'wpcf-punjabi-punlic-upload-photo', true );
				$serviceDescription_p    =      get_post_meta( $pageData->ID, 'wpcf-punjabi-public-address', true );

				if (!empty($serviceName_p)) {
					$serviceName=$serviceName_p ;
				}else{
					$serviceName = get_post_meta( $pageData->ID, 'wpcf-public-service-name', true );
				}

				if (!empty($serviceAddress_p)) {
					$serviceAddress=$serviceAddress_p ;
				}else{
					$serviceAddress = get_post_meta( $pageData->ID, 'wpcf-public-address', true );
				}

				if (!empty($serviceLocality_p)) {
					$serviceLocality=$serviceLocality_p ;
				}else{
					$serviceLocality = get_post_meta( $pageData->ID, 'wpcf-locality', true );
				}

				if (!empty($serviceImage_p)) {
					$serviceImage=$serviceImage_p ;
				}else{
					$serviceImage = get_post_meta( $pageData->ID, 'wpcf-upload-photo', true );
				}

				if (!empty($serviceDescription_p)) {
					$serviceDescription =$serviceDescription_p ;
				}else{
					$serviceDescription = get_post_meta( $pageData->ID, 'wpcf-enter-description', true );
				}

				$out .= '<div class="row location-box" style="margin-bottom:8px;padding:10px;">
						<div class="col-sm-5 npl npr">
								<img class="img-responsive cstm-width" src="'.$serviceImage.'">
						</div>
						<div class="col-sm-7 npr">
							<h4 for="location name" class="location-title">'.$serviceName.'</h4>
							<h5 class="fw">Description</h5>
							<p for="address public-description">'.$serviceDescription.'</p>
							<h5 class="fw">Location</h5>
							<p for="address">'.$serviceAddress.'</p>
							<h5 class="fw">Locality</h5>
							<p for="locality" class="mb-20">'.$serviceLocality.'</p>
						</div></div>';	
			}
		}
		else{
			foreach($pageposts as $pageData){
				
				$serviceName_e       =     get_post_meta( $pageData->ID, 'wpcf-public-service-name', true );
				$serviceAddress_e    =     get_post_meta( $pageData->ID, 'wpcf-public-address', true );
				$serviceLocality_e   =     get_post_meta( $pageData->ID, 'wpcf-locality', true );
				$serviceImage_e      =      get_post_meta( $pageData->ID, 'wpcf-upload-photo', true );
				$serviceDescription_e    =      get_post_meta( $pageData->ID, 'wpcf-enter-description', true );

				if (!empty($serviceName_e)) {
					$serviceName=$serviceName_e ;
				}else{
					$serviceName = get_post_meta( $pageData->ID, 'wpcf-punjabi-service-name', true );
				}

				if (!empty($serviceAddress_e)) {
					$serviceAddress=$serviceAddress_e;
				}else{
					$serviceAddress = get_post_meta( $pageData->ID, 'wpcf-punjabi-enter-description', true );
				}

				if (!empty($serviceLocality_e)) {
					$serviceLocality=$serviceLocality_e ;
				}else{
					$serviceLocality = get_post_meta( $pageData->ID, 'wpcf-punjabi-locality', true );
				}

				if (!empty($serviceImage_e)) {
					$serviceImage=$serviceImage_e ;
				}else{
					$serviceImage = get_post_meta( $pageData->ID, 'wpcf-punjabi-punlic-upload-photo', true );
				}

				if (!empty($serviceDescription_e)) {
					$serviceDescription =$serviceDescription_e ;
				}else{
					$serviceDescription = get_post_meta( $pageData->ID, 'wpcf-punjabi-public-address', true );
				}

				$out .= '<div class="row location-box" style="margin-bottom:8px;padding:10px;">
						<div class="col-sm-5 npl npr">
								<img class="img-responsive cstm-width" src="'.$serviceImage.'">
						</div>
						<div class="col-sm-7 npr">
							<h4 for="location name" class="location-title">'.$serviceName.'</h4>
							<h5 class="fw">Description</h5>
							<p for="address public-description">'.$serviceDescription.'</p>
							<h5 class="fw">Location</h5>
							<p for="address">'.$serviceAddress.'</p>
							<h5 class="fw">Locality</h5>
							<p for="locality" class="mb-20">'.$serviceLocality.'</p>
						</div></div>';	
			}

		} 
		wp_reset_query();
        return html_entity_decode($out);
	}

/*
	=========================
	    CITYMAP SHORTCODE
	=========================
*/
	add_shortcode('citymap_q', 'citymap_custom_shortcode_query');
	function citymap_custom_shortcode_query($atts, $content){
		global $wpdb;
		$querystr = "SELECT * FROM $wpdb->posts
		    WHERE $wpdb->posts.post_status = 'publish' 
		    AND $wpdb->posts.post_type = 'city-maps'
		    ORDER BY $wpdb->posts.menu_order ASC";

		$pageposts = $wpdb->get_results($querystr, OBJECT);
		$out = '';

 		if (qtranxf_getLanguage() == 'HI') {
	 		foreach($pageposts as $pageData){

				$cityText_p     =     get_post_meta( $pageData->ID, 'wpcf-punjabi-citymap', true );
				$cityImage_p    =     get_post_meta( $pageData->ID, 'wpcf-punjabi-upload-city-map', true );

				if(!empty($cityText_p)){
					$cityText = $cityText_p;

				}else{
                   $cityText =  get_post_meta( $pageData->ID, 'wpcf-citymap', true );
				}

				if(!empty($cityImage_p)){
					$cityImage = $cityImage_p ;

				}else{
                   $cityImage = get_post_meta( $pageData->ID, 'wpcf-upload-city-map', true );
				}

				$out .='<div class="inner-wrap">
							<p>'.$cityText.'</p>
							<div class="city-map">		
								<img class="img-responsive cstm-width" src="'.$cityImage.'">
							</div>
						</div>';			
			}
		}
		else{
			foreach($pageposts as $pageData){

				$cityText_e     =     get_post_meta( $pageData->ID, 'wpcf-citymap', true );
				$cityImage_e    =     get_post_meta( $pageData->ID, 'wpcf-upload-city-map', true );

				if(!empty($cityText_e)){
					$cityText = $cityText_e;

				}else{
                   $cityText =  get_post_meta( $pageData->ID, 'wpcf-punjabi-citymap', true );
				}

				if(!empty($cityImage_e)){
					$cityImage = $cityImage_e ;

				}else{
                   $cityImage = get_post_meta( $pageData->ID, 'wpcf-punjabi-upload-city-map', true );
				}

				$out .='<div class="inner-wrap">
							<p>'.$cityText.'</p>
							<div class="city-map">		
								<img class="img-responsive cstm-width" src="'.$cityImage.'">
							</div>
						</div>';			
			}
		} 
		wp_reset_query();
  		return html_entity_decode($out);
	}

/*
	=========================
	  CITY INTRO SHORTCODE
	=========================
*/
	add_shortcode('city_intd_q', 'city_intd_custom_shortcode_query');
	function city_intd_custom_shortcode_query($atts, $content){
		global $wpdb;
		 $querystr = "SELECT * 
		    FROM $wpdb->posts
		    WHERE $wpdb->posts.post_status = 'publish' 
		    AND $wpdb->posts.post_type = 'citys-text'
		    ORDER BY $wpdb->posts.menu_order ASC";

		$pageposts = $wpdb->get_results($querystr, OBJECT);

		$out = '<div class="inner-wrap">';

		foreach($pageposts as $pageData){

					$english_content = qtranxf_use_language('en',$pageData->post_content, false, true);
				    $hindi_content = qtranxf_use_language('HI',$pageData->post_content, false, true);

				    if (qtranxf_getLanguage() == 'HI') {

						if (!empty($hindi_content)) {
							$content = $hindi_content ;
						}else{
							$content = $english_content ;
						}
				    }else{
				    	if (!empty($english_content)) {
							$content = $english_content;
						}else{
							$content = $hindi_content ;
						}

				    }


			$out .='<div class="row location-box city-intro"><div class="col-md-12" style="padding:15px;"><div class="city-description"><p>'.nl2br($content).'</p></div></div></div>';			
		}
		$out .= '</div>';
		wp_reset_query();
  		return html_entity_decode($out); 
	}

/*
	=========================
	    CONTACT SHORTCODE
	=========================
*/
	add_shortcode('contact_q', 'contact_custom_shortcode_query');
	function contact_custom_shortcode_query($atts, $content){
		global $wpdb;
		 $querystr = "SELECT * 
		    FROM $wpdb->posts
		    WHERE $wpdb->posts.post_status = 'publish' 
		    AND $wpdb->posts.post_type = 'contact'
		    ORDER BY $wpdb->posts.menu_order ASC";

		$pageposts = $wpdb->get_results($querystr, OBJECT);
		$out = '';
		if (qtranxf_getLanguage() == 'HI') {
			foreach($pageposts as $pageData){
				$contAddress_p     =  get_post_meta( $pageData->ID, 'wpcf-address', true );
				$contMuncipality_p     =     get_post_meta( $pageData->ID, 'wpcf-punjabi-muncipality-name', true );
				$contName_p     =     get_post_meta( $pageData->ID, 'wpcf-punjabi-contact-name', true );
				$contDept_p     =     get_post_meta( $pageData->ID, 'wpcf-punjab-department-name', true );
				$contDesgn_p     =     get_post_meta( $pageData->ID, 'wpcf-punjabi-designation', true );
				$contEmail_p     =     get_post_meta( $pageData->ID, 'wpcf-punjabi-email-address', true );
				$contMobile_p     =     get_post_meta( $pageData->ID, 'wpcf-punjabi-mobile-no', true );
				$contOption_p     =     get_post_meta( $pageData->ID, 'wpcf-punjabi-primary-or-secondary', true );

				if (!empty($contAddress_p)) {
					$contAddress=strip_tags($contAddress_p);
				}else{
					$contAddress     =  strip_tags(get_post_meta( $pageData->ID, 'wpcf-address', true ));
				}

				if (!empty($contMuncipality_p)) {
					$contMuncipality=strip_tags($contMuncipality_p);
				}else{
					$contMuncipality     =     strip_tags(get_post_meta( $pageData->ID, 'wpcf-muncipality-name', true ));
				}

				if (!empty($contName_p)) {
					$contName=strip_tags($contName_p);
				}else{
					$contName     =     strip_tags(get_post_meta( $pageData->ID, 'wpcf-contact-name', true ));
				}

				if (!empty($contDept_p)) {
					$contDept=strip_tags($contDept_p);
				}else{
					$contDept     =     strip_tags(get_post_meta( $pageData->ID, 'wpcf-department-name', true ));
				}

				if (!empty($contDesgn_p)) {
					$contDesgn=strip_tags($contDesgn_p);
				}else{
					$contDesgn     =     strip_tags(get_post_meta( $pageData->ID, 'wpcf-designation', true ));
				}

				if (!empty($contEmail_p)) {
					$contEmail=strip_tags($contEmail_p);
				}else{
					$contEmail     =     strip_tags(get_post_meta( $pageData->ID, 'wpcf-email-address', true ));
				}

				if (!empty($contMobile_p)) {
					$contMobile=strip_tags($contMobile_p);
				}else{
					$contMobile     =     strip_tags(get_post_meta( $pageData->ID, 'wpcf-mobile-no', true ));
				}

				if (!empty($contOption_p)) {
					$contOption=strip_tags($contOption_p);
				}else{
					$contOption     =     strip_tags(get_post_meta( $pageData->ID, 'wpcf-primary-or-secondary', true ));
				}

				$out .='<h2 style="font-size: 14px;color: #ffffff;line-height: 24px;text-align: left" class="vc_custom_heading orange-title vc_custom_1509703151802"><font style="font-size:100%" my="my">Contact Us</font></h2>
					<div class="inner-wrap">
						<div class="input-group">
							<h4>Address</h4>
							<p>'.$contAddress.'</p>
						</div>
						<div class="input-group">
							<h4>Muncipality Name</h4>					
							<p>'.$contMuncipality.'</p>
						</div>	
						<div class="input-group">
							<h4>Contact Name</h4>
							<p>'.$contName.'</p>
						</div>
						<div class="input-group">
							<h4>Department</h4>
							<p>'.$contDept.'</p>
						</div>
						<div class="input-group">
							<h4>Designation</h4>
							<p>'.$contDesgn.'</p>
						</div>
						<div class="input-group">
							<h4>Email Address</h4>
							<p>'.$contEmail.'</p>
						</div>
						<div class="input-group">
							<h4>Phone No.</h4>
							<p>'.$contMobile.'</p>
						</div>
					</div>';			
			}
		}
		else{
			foreach($pageposts as $pageData){
				$contAddress_e     =  get_post_meta( $pageData->ID, 'wpcf-address', true );
				$contMuncipality_e     =     get_post_meta( $pageData->ID, 'wpcf-muncipality-name', true );
				$contName_e     =     get_post_meta( $pageData->ID, 'wpcf-contact-name', true );
				$contDept_e     =     get_post_meta( $pageData->ID, 'wpcf-department-name', true );
				$contDesgn_e     =     get_post_meta( $pageData->ID, 'wpcf-designation', true );
				$contEmail_e     =     get_post_meta( $pageData->ID, 'wpcf-email-address', true );
				$contMobile_e     =     get_post_meta( $pageData->ID, 'wpcf-mobile-no', true );
				$contOption_e     =     get_post_meta( $pageData->ID, 'wpcf-primary-or-secondary', true );

				if (!empty($contAddress_e)) {
					$contAddress=strip_tags($contAddress_e);
				}else{
					$contAddress     =  strip_tags(get_post_meta( $pageData->ID, 'wpcf-address', true ));
				}

				if (!empty($contMuncipality_e)) {
					$contMuncipality=strip_tags($contMuncipality_e);
				}else{
					$contMuncipality     =     strip_tags(get_post_meta( $pageData->ID, 'wpcf-punjabi-muncipality-name', true ));
				}

				if (!empty($contName_e)) {
					$contName=strip_tags($contName_e);
				}else{
					$contName     =     strip_tags(get_post_meta( $pageData->ID, 'wpcf-punjabi-contact-name', true ));
				}

				if (!empty($contDept_e)) {
					$contDept=strip_tags($contDept_e);
				}else{
					$contDept     =      strip_tags(get_post_meta( $pageData->ID, 'wpcf-punjab-department-name', true ));
				}

				if (!empty($contDesgn_e)) {
					$contDesgn=strip_tags($contDesgn_e);
				}else{
					$contDesgn     =     strip_tags(get_post_meta( $pageData->ID, 'wpcf-punjabi-designation', true ));
				}

				if (!empty($contEmail_e)) {
					$contEmail=strip_tags($contEmail_e);
				}else{
					$contEmail     =     strip_tags(get_post_meta( $pageData->ID, 'wpcf-punjabi-email-address', true ));
				}

				if (!empty($contMobile_e)) {
					$contMobile=strip_tags($contMobile_e);
				}else{
					$contMobile     =     strip_tags(get_post_meta( $pageData->ID, 'wpcf-punjabi-mobile-no', true ));
				}

				if (!empty($contOption_p)) {
					$contOption=strip_tags($contOption_p);
				}else{
					$contOption     =     strip_tags(get_post_meta( $pageData->ID, 'wpcf-punjabi-primary-or-secondary', true ));
				}

				$out .='<h2 style="font-size: 14px;color: #ffffff;line-height: 24px;text-align: left" class="vc_custom_heading orange-title vc_custom_1509703151802"><font style="font-size:100%" my="my">Contact Us</font></h2>
					<div class="inner-wrap">
						<div class="input-group">
							<h4>Address</h4>
							<p>'.$contAddress.'</p>
						</div>
						<div class="input-group">
							<h4>Muncipality Name</h4>					
							<p>'.$contMuncipality.'</p>
						</div>	
						<div class="input-group">
							<h4>Contact Name</h4>
							<p>'.$contName.'</p>
						</div>
						<div class="input-group">
							<h4>Department</h4>
							<p>'.$contDept.'</p>
						</div>
						<div class="input-group">
							<h4>Designation</h4>
							<p>'.$contDesgn.'</p>
						</div>
						<div class="input-group">
							<h4>Email Address</h4>
							<p>'.$contEmail.'</p>
						</div>
						<div class="input-group">
							<h4>Phone No.</h4>
							<p>'.$contMobile.'</p>
						</div>
					</div>';			
			}

		} 
		wp_reset_query();
  		return html_entity_decode($out);
	}

/*
	=========================
	   PROJECT SHORTCODE
	=========================
*/
	add_shortcode('project_q', 'project_custom_shortcode_query');
	function project_custom_shortcode_query($atts, $content){
		global $wpdb;
		 $querystr = "SELECT * 
		    FROM $wpdb->posts
		    WHERE $wpdb->posts.post_status = 'publish' 
		    AND $wpdb->posts.post_type = 'project'
		    ORDER BY $wpdb->posts.menu_order ASC";

		$pageposts = $wpdb->get_results($querystr, OBJECT);
		$out = '';

		if (qtranxf_getLanguage() == 'HI') {
			foreach($pageposts as $pageData){
		 
				$postid=$pageData->ID;
				$proj_url_p =   get_post_meta( $postid, 'wpcf-punjabi-upload-project', true );
				$proj_upload_p  =  get_post_meta( $postid, 'wpcf-punjabi-project-banner', true );

				if (!empty($proj_url_p)) {
					 $proj_url = $proj_url_p ;
				}else{
                    $proj_url =   get_post_meta( $postid, 'wpcf-projects-upload-project', true );
				}

				if (!empty($proj_upload_p)) {
					$proj_upload = $proj_upload_p ;
				}else{
                    $proj_upload  =  get_post_meta( $postid, 'wpcf-project-banner', true );
				}
				$english_content = qtranxf_use_language('en',$pageData->post_content, false, true);
				$hindi_content = qtranxf_use_language('HI',$pageData->post_content, false, true);

				if (!empty($hindi_content)) {
					$content = $hindi_content;
				}else{
					$content = $english_content ;
				}

				$english_title = qtranxf_use_language('en',$pageData->post_title, false, true);
				$hindi_title = qtranxf_use_language('HI',$pageData->post_title, false, true);

				if (!empty($hindi_title)) {
					$title = $hindi_title;
				}else{
					$title = $english_title ;
				}

				$out .='<div class="row" style="padding: 15px; margin-bottom: 0px;" id="'.$postid.'"><div class="col-sm-12" style="background:#F5F5F5;padding: 15px;"><div class="project-list input-group col-sm-12"><div class="proj-banner"><img src="'.$proj_upload.'" alt="banner" class="img-responsive"></div>
					<h4>'.$title.'</h4><p>'.$content.'</p><p><b>Project Progress</b></p>';
				if (!empty($proj_url)):
				 	$out .= '<a class="d-btn" href="'.$proj_url.'">Download</a>';
				else:
					$out .= '<button class="d-btn disable" disabled="disabled" style="-webkit-filter: grayscale(100%); /* Safari 6.0 - 9.0 */ filter:grayscale(100%);"><font style="font-size:100%" my="my"> DOWNLOAD</font></button>';
				endif;

				$out .= '</div></div></div>';
			}
		}
		else{
			foreach($pageposts as $pageData){

		 
				$postid=$pageData->ID;
				$proj_url_e =   get_post_meta( $postid, 'wpcf-projects-upload-project', true );
				$proj_upload_e  =  get_post_meta( $postid, 'wpcf-project-banner', true );

				if (!empty($proj_url_e)) {
					 $proj_url = $proj_url_e ;
				}else{
                    $proj_url =   get_post_meta( $postid, 'wpcf-punjabi-upload-project', true );
				}

				if (!empty($proj_upload_e)) {
					$proj_upload = $proj_upload_e ;
				}else{
                    $proj_upload  = get_post_meta( $postid, 'wpcf-punjabi-project-banner', true );
				}

				$english_content = qtranxf_use_language('en',$pageData->post_content, false, true);
				$hindi_content = qtranxf_use_language('HI',$pageData->post_content, false, true);

				if (!empty($english_content)) {
					$content = $english_content;
				}else{
					$content = $hindi_content ;
				}

				$english_title = qtranxf_use_language('en',$pageData->post_title, false, true);
				$hindi_title = qtranxf_use_language('HI',$pageData->post_title, false, true);

				if (!empty($english_title)) {
					$title = $english_title;
				}else{
					$title = $hindi_title ;
				}
		
				$out .='<div class="row" style="padding: 15px; margin-bottom: 0px;" id="'.$postid.'"><div class="col-sm-12" style="background:#F5F5F5;padding: 15px;"><div class="project-list input-group col-sm-12"><div class="proj-banner"><img src="'.$proj_upload.'" alt="banner" class="img-responsive"></div>
					<h4>'.$title.'</h4><p>'.$content.'</p><p><b>Project Progress</b></p>';
				if (!empty($proj_url)):
				 	$out .= '<a class="d-btn" href="'.$proj_url.'">Download</a>';
				else:
					$out .= '<button class="d-btn disable" disabled="disabled" style="-webkit-filter: grayscale(100%); /* Safari 6.0 - 9.0 */ filter:grayscale(100%);"><font style="font-size:100%" my="my"> DOWNLOAD</font></button>';
				endif;

				$out .= '</div></div></div>';
			}
		} 
		wp_reset_query();
  		return html_entity_decode($out);
	}

/*
	=========================
	    FAQ'S SHORTCODE
	=========================
*/
	add_shortcode('faq_q', 'faq_custom_shortcode_query');
    function faq_custom_shortcode_query($atts, $content){
    	global $wpdb;
		 $querystr = "SELECT * 
		    FROM $wpdb->posts
		    WHERE $wpdb->posts.post_status = 'publish' 
		    AND $wpdb->posts.post_type = 'faqs'
		    ORDER BY $wpdb->posts.menu_order ASC";

		$pageposts = $wpdb->get_results($querystr, OBJECT);
		$out = '';
		if (qtranxf_getLanguage() == 'HI') {
			foreach($pageposts as $pageData){
				$faqQues_p     =     get_post_meta( $pageData->ID, 'wpcf-punjabi-question', true );
				$faqAns_p   =     get_post_meta( $pageData->ID, 'wpcf-punjabi-answer', true );

				if(!empty($faqQues_p)){
                    $faqQues = $faqQues_p;
				}else{
                    $faqQues     =     get_post_meta( $pageData->ID, 'wpcf-questions', true );
				}
				if(!empty($faqAns_p)){
                    $faqAns = $faqAns_p;
				}else{
                    $faqAns    =     get_post_meta( $pageData->ID, 'wpcf-answers', true );
				}

						$out .='<div class="faq-list input-group">
						<h4>'.$faqQues.'</h4><p>'.$faqAns.'</p>
						</div>'; 
			}
		}
		else{
			foreach($pageposts as $pageData){
				$faqQues_e     =     get_post_meta( $pageData->ID, 'wpcf-questions', true );
				$faqAns_e    =     get_post_meta( $pageData->ID, 'wpcf-answers', true );

				if(!empty($faqQues_e)){
                    $faqQues = $faqQues_e;
				}else{
                    $faqQues     =     get_post_meta( $pageData->ID, 'wpcf-punjabi-question', true );
				}
				if(!empty($faqAns_e)){
                    $faqAns = $faqAns_e;
				}else{
                    $faqAns    =     get_post_meta( $pageData->ID, 'wpcf-punjabi-answer', true );
				}

						$out .='<div class="faq-list input-group">
						<h4>'.$faqQues.'</h4><p>'.$faqAns.'</p>
						</div>'; 
			}
		} 
		wp_reset_query();
  		return html_entity_decode($out);
    }

/*
	=========================
	    TENDER SHORTCODE
	=========================
*/
	add_shortcode('tenders', 'tender_custom_shortcode_query');
    function tender_custom_shortcode_query($atts, $content){
    	global $wpdb;
		 $querystr = "SELECT * 
		    FROM $wpdb->posts
		    WHERE $wpdb->posts.post_status = 'publish' 
		    AND $wpdb->posts.post_type = 'tender'
		    ORDER BY $wpdb->posts.menu_order ASC";

		$pageposts = $wpdb->get_results($querystr, OBJECT);
		$count=count($pageposts);
		$out = '';

		if (qtranxf_getLanguage() == 'HI') {
			if($count>0){
	 			foreach($pageposts as $postdata){
					$postid=$postdata->ID;
					$tenderDept_p     =     get_post_meta( $postid, 'wpcf-punjabi-tender-department-name', true );
					$t_disc_p  =  get_post_meta( $postid, 'wpcf-punjabi-description-of-work', true );

                    if (!empty($tenderDept_p)) {
                    	$tenderDept = $tenderDept_p ;
                    }else{
                    	$tenderDept     =     get_post_meta( $postid, 'wpcf-tender-department-name', true );
                    }

                    if (!empty($t_disc_p)) {
                    	$t_disc = $t_disc_p;
                    }else{
                    	$t_disc  =  get_post_meta( $postid, 'wpcf-description-of-work', true );
                    }

					$out .='<div class="project-list input-group"><a href="'.site_url().'/tender-details/?t_id='.$postid.'" target="_blank">'.$tenderDept.'</a><p>'.substr($t_disc ,0,30).'</p></div>'; 
				} 
				$out.='</div><div><div class="cs-column-text btn-div"><p><a class="view-link" href="'.site_url().'/tenders"><font style="font-size:100%" my="my">View All </font><i class="fa fa-caret-right"></i></a></p></div>';
				}
			else{
				$out .="<div class='d-flex'><center class='middle-data'><i class='fa fa-info-circle'></i><br/>No Tenders</center></div><style>.view-link{display:none;}</style>";
			}
		}
		else{
			if($count>0){
	 			foreach($pageposts as $postdata){
					$postid=$postdata->ID;
					$tenderDept_e     =     get_post_meta( $postid, 'wpcf-tender-department-name', true );
					$t_disc_e  =  get_post_meta( $postid, 'wpcf-description-of-work', true );

					if (!empty($tenderDept_e)) {
						$tenderDept = $tenderDept_e;
					}else{
					$tenderDept     =     get_post_meta( $postid, 'wpcf-punjabi-tender-department-name', true );
					}

					if (!empty($t_disc_e)) {
						$t_disc = $t_disc_e;
					}else{
					$t_disc  =  get_post_meta( $postid, 'wpcf-punjabi-description-of-work', true );
					}

					$out .='<div class="project-list input-group"><a href="'.site_url().'/tender-details/?t_id='.$postid.'" target="_blank">'.$tenderDept.'</a><p>'.substr($t_disc ,0,30).'</p></div>'; 
				} 
				$out.='</div><div><div class="cs-column-text btn-div"><p><a class="view-link" href="'.site_url().'/tenders"><font style="font-size:100%" my="my">View All </font><i class="fa fa-caret-right"></i></a></p></div>';
				}
			else{
				$out .="<div class='d-flex'><center class='middle-data'><i class='fa fa-info-circle'></i><br/>No Tenders</center></div><style>.view-link{display:none;}</style>";
			}
		}
		wp_reset_query();
  		return html_entity_decode($out); 
    }

    add_shortcode('tender_q', 'tender_shortcode_query');

	function tender_shortcode_query($atts, $content){
	  
	global $wpdb;
	 $querystr = "SELECT * 
	    FROM $wpdb->posts
	    WHERE $wpdb->posts.post_status = 'publish' 
	    AND $wpdb->posts.post_type = 'tender'
	    ORDER BY $wpdb->posts.menu_order ASC";

	$pageposts = $wpdb->get_results($querystr, OBJECT);
	 $out = '';
	if (qtranxf_getLanguage() == 'HI') {
	   foreach($pageposts as $postdata){
			$postid=$postdata->ID;  
			$tenderDept_p     =     get_post_meta( $postid, 'wpcf-punjabi-tender-department-name', true );
			if (!empty($tenderDept_p)) {
				$tenderDept = $tenderDept_p;
			}else{
				$tenderDept     =     get_post_meta( $postid, 'wpcf-tender-department-name', true );
			}
		    $out .='<div class="project-list input-group"><a href="'.site_url().'/tender-details/?t_id='.$postid.'" target="_blank">
				<h4>'.$tenderDept.'</h4></a></div>'; 
	    }
	}
	else{
		foreach($pageposts as $postdata){
			$postid=$postdata->ID;
			$tenderDept_e     =     get_post_meta( $postid, 'wpcf-tender-department-name', true );

			if (!empty($tenderDept_e)) {
				$tenderDept = $tenderDept_e;
			}else{
				$tenderDept     =     get_post_meta( $postid, 'wpcf-punjabi-tender-department-name', true );
			}

		    $out .='<div class="project-list input-group"><a href="'.site_url().'/tender-details/?t_id='.$postid.'" target="_blank">
				<h4>'.$tenderDept.'</h4></a></div>'; 
	    }

	} 
	  wp_reset_query();
	  return html_entity_decode($out);
	}

/*
	=========================
	    CITIZEN SHORTCODE
	=========================
*/
	add_shortcode('cit_char_q', 'citizen_charter_custom_shortcode_query');
	function citizen_charter_custom_shortcode_query($atts, $content){
		global $wpdb;
		 $querystr = "SELECT * 
		    FROM $wpdb->posts
		    WHERE $wpdb->posts.post_status = 'publish' 
		    AND $wpdb->posts.post_type = 'citizen_charter'
		    ORDER BY $wpdb->posts.menu_order ASC";

		$pageposts = $wpdb->get_results($querystr, OBJECT);
		$out = '';
        
        if (qtranxf_getLanguage() == 'HI') {
			foreach($pageposts as $pageData){
				$english_title = qtranxf_use_language('en',$pageData->post_title, false, true);
				$hindi_title = qtranxf_use_language('HI',$pageData->post_title, false, true);

				if (!empty($hindi_title)) {
					$title = $hindi_title;
				}else{
					$title = $english_title;
				}

				$up_document = get_post_meta( $postid, 'wpcf-punjabi-choose-file', true );
				if (!empty($up_document)) {
				 	$doc = 'wpcf-punjabi-choose-file';
				 }else{
				 	$doc = 'wpcf-choose-file';
				 }

				$querystr1 = "SELECT * 
			    FROM $wpdb->postmeta
			    WHERE $wpdb->postmeta.post_id = '".$pageData->ID."' AND  $wpdb->postmeta.meta_key = '".$doc."'
			    ORDER BY $wpdb->postmeta.meta_id DESC";
				$pageposts1 = $wpdb->get_results($querystr1, OBJECT);

				$out .='<div class="download-form-container"><div class="col-md-12">
				<h4>'.$title.'</h4><div class="mt-20">';
				foreach($pageposts1 as $metaVal){
				   $urls = explode("/", $metaVal->meta_value);
				   $ct = count($urls);
				   $name = $urls[$ct-1];
				   $name_img = explode('.', $name);
	   
					$out .='<label style="font-weight: bold;text-transform: uppercase;" class="col-md-3">'.$name_img[0].'</label><div class="col-md-8" style="margin-bottom:15px;"><a class="btn-download" href="'.$metaVal->meta_value.'" target="_blank"><font style="font-size:100%" my="my"> DOWNLOAD</font></a></div><br>'; 
				}
					$out.='</div></div>
					</div>';
			}
		}
		else{
			foreach($pageposts as $pageData){
				$english_title = qtranxf_use_language('en',$pageData->post_title, false, true);
				$hindi_title = qtranxf_use_language('HI',$pageData->post_title, false, true);

				if (!empty($hindi_title)) {
					$title = $hindi_title;
				}else{
					$title = $english_title;
				}

				$up_document = get_post_meta( $pageData->ID, 'wpcf-choose-file', true );
				if (!empty($up_document)) {
				 	$doc = 'wpcf-choose-file';
				 }else{
				 	$doc = 'wpcf-punjabi-choose-file';
				 }
				$querystr1 = "SELECT * 
			    FROM $wpdb->postmeta
			    WHERE $wpdb->postmeta.post_id = '".$pageData->ID."' AND  $wpdb->postmeta.meta_key = '".$doc."'
			    ORDER BY $wpdb->postmeta.meta_id DESC";
				$pageposts1 = $wpdb->get_results($querystr1, OBJECT);
				$out .='<div class="download-form-container"><div class="col-md-12">
				<h4>'.$title.'</h4><div class="mt-20">';
				foreach($pageposts1 as $metaVal){
				   $urls = explode("/", $metaVal->meta_value);
				   $ct = count($urls);
				   $name = $urls[$ct-1];
				   $name_img = explode('.', $name);
	   
					$out .='<label style="font-weight: bold;text-transform: uppercase;" class="col-md-3">'.$name_img[0].'</label><div class="col-md-8" style="margin-bottom:15px;"><a class="btn-download" href="'.$metaVal->meta_value.'" target="_blank"><font style="font-size:100%" my="my"> DOWNLOAD</font></a></div><br>'; 
				}
					$out.='</div></div>
					</div>';
			}
		}
		wp_reset_query();
  		return html_entity_decode($out); 
	}

/*
	=========================
	    RTI SHORTCODE
	=========================
*/
	add_shortcode('rti_q', 'rti_custom_shortcode_query');
	function rti_custom_shortcode_query($atts, $content){
		global $wpdb;
  $querystr = "SELECT * FROM $wpdb->posts
    WHERE $wpdb->posts.post_status = 'publish' 
    AND $wpdb->posts.post_type = 'rti'
    ORDER BY $wpdb->posts.menu_order DESC";

  $pageposts = $wpdb->get_results($querystr, OBJECT);
  $count=count($pageposts);
  $out = '';

   if (qtranxf_getLanguage() == 'HI') {
	  if($count>0){
	    foreach($pageposts as $pageData){
	      $postid=$pageData->ID;
	      $querystr1 = "SELECT * FROM $wpdb->postmeta
	      WHERE $wpdb->postmeta.post_id = '".$pageData->ID."' AND  $wpdb->postmeta.meta_key = 'wpcf-punjabi-choose-file-rti' ORDER BY $wpdb->postmeta.meta_id DESC";
	      $pageposts1 = $wpdb->get_results($querystr1, OBJECT);

	        $english_title = qtranxf_use_language('en',$pageData->post_title, false, true);
			$hindi_title = qtranxf_use_language('HI',$pageData->post_title, false, true);

			if (!empty($hindi_title)) {
				$title = $hindi_title;
			}else{
				$title = $english_title ;
			}

	      $out .= '<div class="download-form-container"><div class="col-md-12">
	              <h4>'.$title.'</h4><div class="mt-20">';
	            foreach($pageposts1 as $metaVal){
	              $urls = explode("/", $metaVal->meta_value);
	              $ct = count($urls);
	              $name = $urls[$ct-1];
	              $name_img = explode('.', $name);
	              $download_link = $metaVal->meta_value;

	              
	              $out .='<label style="font-weight: bold;text-transform: uppercase;" class="col-md-3">'.$name_img[0].'</label><div class="col-md-8" style="margin-bottom:15px;">';
	             if (! $download_link=='') {
	             	$out.= '<a class="btn-download" href="'.$download_link.'" target="_blank"><font style="font-size:100%" my="my"> DOWNLOAD</font></a>';
	             }
	             else{
	             	$out.= '<a class="btn-download d-btn disable" href="'.$download_link.'" target="_blank" disabled="disabled" style="-webkit-filter: grayscale(100%); /* Safari 6.0 - 9.0 */ filter:grayscale(100%);"><font style="font-size:100%" my="my"> DOWNLOAD</font></a>';
	             }
	             $out.= '</div><br>';
	            }
	          $out .='</div></div></div>';
	    }
	  }
	}
	else{
		if($count>0){
	    foreach($pageposts as $pageData){
	      $postid=$pageData->ID;
	      $querystr1 = "SELECT * FROM $wpdb->postmeta
	      WHERE $wpdb->postmeta.post_id = '".$pageData->ID."' AND  $wpdb->postmeta.meta_key = 'wpcf-choose-file-rti' ORDER BY $wpdb->postmeta.meta_id DESC";
	      $pageposts1 = $wpdb->get_results($querystr1, OBJECT);

	       $english_title = qtranxf_use_language('en',$pageData->post_title, false, true);
			$hindi_title = qtranxf_use_language('HI',$pageData->post_title, false, true);

			if (!empty($english_title)) {
				$title = $english_title;
			}else{
				$title = $hindi_title ;
			}

	      $out .= '<div class="download-form-container"><div class="col-md-12">
	              <h4>'.$title.'</h4><div class="mt-20">';
	            foreach($pageposts1 as $metaVal){
	              $urls = explode("/", $metaVal->meta_value);
	              $ct = count($urls);
	              $name = $urls[$ct-1];
	              $name_img = explode('.', $name);
	              $download_link = $metaVal->meta_value;

	              
	              $out .='<label style="font-weight: bold;text-transform: uppercase;" class="col-md-3">'.$name_img[0].'</label><div class="col-md-8" style="margin-bottom:15px;">';
	             if (! $download_link=='') {
	             	$out.= '<a class="btn-download" href="'.$download_link.'" target="_blank"><font style="font-size:100%" my="my"> DOWNLOAD</font></a>';
	             }
	             else{
	             	$out.= '<a class="btn-download d-btn disable" href="'.$download_link.'" target="_blank" disabled="disabled" style="-webkit-filter: grayscale(100%); /* Safari 6.0 - 9.0 */ filter:grayscale(100%);"><font style="font-size:100%" my="my"> DOWNLOAD</font></a>';
	             }
	             $out.= '</div><br>';
	            }
	          $out .='</div></div></div>';
	    }
	  }

	}   
  wp_reset_query();
  return html_entity_decode($out);	
	}

/*
	=========================
	  RECRUITMENT SHORTCODE
	=========================
*/
	add_shortcode('recruitments_q', 'recruitments_custom_shortcode_query');
    function recruitments_custom_shortcode_query($atts, $content){
    	global $wpdb;
		 $querystr = "
		    SELECT * FROM $wpdb->posts
		    WHERE $wpdb->posts.post_status = 'publish' 
		    AND $wpdb->posts.post_type = 'recruitments'
		    ORDER BY $wpdb->posts.menu_order ASC";
		$pageposts = $wpdb->get_results($querystr, OBJECT);
  		$out = '';

 		if (qtranxf_getLanguage() == 'HI') {
	 		foreach($pageposts as $pageData){
	  			$postid=$pageData->ID;
				$rec_url_p =   get_post_meta( $postid, 'wpcf-add-recruitment-url', true );
				$rec_upload_p  =  get_post_meta( $postid, 'wpcf-punjabi-upload-recruitment-file', true );

				if (!empty($rec_url_p)) {
					$rec_url = $rec_url_p;
				}else{
					$rec_url =   get_post_meta( $postid, 'wpcf-add-recruitment-url', true );
				}

				if (!empty($rec_upload_p)) {
					$rec_upload = $rec_upload_p;
				}else{
				    $rec_upload  =  get_post_meta( $postid, 'wpcf-punjabi-upload-recruitment-file', true );
				}

				$english_title = qtranxf_use_language('en',$pageData->post_title, false, true);
				$hindi_title = qtranxf_use_language('HI',$pageData->post_title, false, true);

				if (!empty($hindi_title)) {
					$title = $hindi_title;
				}else{
					$title = $english_title;
				}

				if($rec_upload){
					$link  = $rec_upload;
					$text  = "Download";
				}else{
					$link  = $rec_url;
					$text  = "View Details";
				}
				
				$content_post = get_post($postid);
				$english_content = qtranxf_use_language('en',$content_post->post_content, false, true);
				$hindi_content = qtranxf_use_language('HI',$content_post->post_content, false, true);

				if (!empty($hindi_content)) {
					$content = $hindi_content;
				}else{
					$content = $english_content ;
				}
				$content = apply_filters('the_content', $content);
				$content = str_replace(']]>', ']]&gt;', $content);
				$out .= '<div class="download-form-container">
					        <div class="col-xs-12 col-sm-10">
						      <p class="form-title">'.$title.'</p>
						      <p class="form-des">'.$content.'</p>
					        </div>
							<div class="col-xs-12 col-sm-2">
								<div class="dis-tbl">
									<div class="dis-tbl-cell">
										<a class="btn-download" href="'.$link.'" target="_blank">'. $text.'</a>
									</div>
								</div>
							</div>
							<div class="clear"></div>
						</div>';
		 	}
		}
		else{
			foreach($pageposts as $pageData){
	  			$postid=$pageData->ID;
				$rec_url_e =   get_post_meta( $postid, 'wpcf-add-recruitment-url', true );
				$rec_upload_e  =  get_post_meta( $postid, 'wpcf-upload-recruitment-file', true );
				if (!empty($rec_url_e)) {
					$rec_url = $rec_url_e;
				}else{
				   $rec_url =   get_post_meta( $postid, 'wpcf-add-recruitment-url', true );
				}
				if (!empty($rec_upload_e)) {
					$rec_upload = $rec_upload_e;
				}else{
					$rec_upload  =  get_post_meta( $postid, 'wpcf-punjabi-upload-recruitment-file', true );

				}

				$english_title = qtranxf_use_language('en',$pageData->post_title, false, true);
				    $hindi_title = qtranxf_use_language('HI',$pageData->post_title, false, true);

					if (!empty($english_title)) {
						$title = $english_title;
					}else{
						$title = $hindi_title ;
					}

				if($rec_upload){
					$link  = $rec_upload;
					$text  = "Download";
				}else{
					$link  = $rec_url;
					$text  = "View Details";
				}
				$content_post = get_post($postid);
				$english_content = qtranxf_use_language('en',$content_post->post_content, false, true);
				$hindi_content = qtranxf_use_language('HI',$content_post->post_content, false, true);

				if (!empty($english_content)) {
					$content = $english_content;
				}else{
					$content = $hindi_content ;
				}
				$content = apply_filters('the_content', $content);
				$content = str_replace(']]>', ']]&gt;', $content);
				$out .= '<div class="download-form-container">
					        <div class="col-xs-12 col-sm-10">
						      <p class="form-title">'.$title.'</p>
						      <p class="form-des">'.$content.'</p>
					        </div>
							<div class="col-xs-12 col-sm-2">
								<div class="dis-tbl">
									<div class="dis-tbl-cell">
										<a class="btn-download" href="'.$link.'" target="_blank">'. $text.'</a>
									</div>
								</div>
							</div>
							<div class="clear"></div>
						</div>';
		 	}
		} 
	 	wp_reset_query();
  		return html_entity_decode($out);
    }

/*
	=========================
	  PROJECT SHORTCODE
	=========================
*/

    add_shortcode('projectshort_q', 'projectshort_custom_shortcode_query');
    function projectshort_custom_shortcode_query($atts, $content){
    	global $wpdb;
        $querystr = "SELECT * FROM $wpdb->posts
    	 WHERE $wpdb->posts.post_status = 'publish' 
    	 AND $wpdb->posts.post_type = 'project'
    	 ORDER BY $wpdb->posts.menu_order ASC";

    	$pageposts = $wpdb->get_results($querystr, OBJECT);
  		$out = '';
		$count=count($pageposts);
		if (qtranxf_getLanguage() == 'HI') {
	 		if($count>0){
	 			foreach($pageposts as $pageData){
				  	$postid=$pageData->ID;
					$proj_url_p =   get_post_meta( $postid, 'wpcf-punjabi-upload-project', true );
				    $proj_upload_p  =  get_post_meta( $postid, 'wpcf-punjabi-project-banner', true );

				    $english_title = qtranxf_use_language('en',$pageData->post_title, false, true);
				    $hindi_title = qtranxf_use_language('HI',$pageData->post_title, false, true);

					if (!empty( $hindi_title)) {
						$title =  $hindi_title;
					}else{
						$title = $english_title;
					}
                	
                	if (!empty($proj_url_p)) {
                		$proj_url = $proj_url_p ;
                	}else{
                		$proj_url =   get_post_meta( $postid, 'wpcf-upload-project', true );
                	}
                	if (!empty($proj_upload_p)) {
                		$proj_upload = $proj_upload_p;
                	}else{
                		$proj_upload  =  get_post_meta( $postid, 'wpcf-project-banner', true );
                	}

					$content_post = get_post($pageData->ID);
					$english_content = qtranxf_use_language('en',$content_post->post_content, false, true);
				    $hindi_content = qtranxf_use_language('HI',$content_post->post_content, false, true);

					if (!empty($hindi_content)) {
						$content = $hindi_content;
					}else{
						$content = $english_content ;
					}
					
					$content = apply_filters('the_content', $content);
					$content = str_replace(']]>', ']]&gt;', $content);
		 			$content=substr($content,0,60);
					$out .= '<div style="width:100%; float:left;margin-bottom: 20px;"><img src="'.$proj_upload.'" style="height:65px; width:65px; margin-right:8px; float:left;"><a href="'.site_url().'/projects/#'.$postid.'" target="_blank" style="font-weight:bold;">'.$title.'</a>'.$content.'</div><div class="clearfix"></div>';
		 		}
		 		$out.='</div><div><div class="cs-column-text btn-div"><p><a class="view-link" href="'.site_url().'/projects"><font style="font-size:100%" my="my">View All </font><i class="fa fa-caret-right"></i></a></p></div>';
		 	}
		 	else{
				$out .="<div class='d-flex'><center class='middle-data'><i class='fa fa-info-circle'></i><br/>No Projects</center></div><style>.view-link{display:none;}</style>";
			}
		}
		else{
			if($count>0){
	 			foreach($pageposts as $pageData){
				  	$postid=$pageData->ID;
					$proj_url_e =   get_post_meta( $postid, 'wpcf-upload-project', true );
				    $proj_upload_e  =  get_post_meta( $postid, 'wpcf-project-banner', true );

				    if (!empty($proj_url_e)) {
                		$proj_url = $proj_url_e ;
                	}else{
                		$proj_url =   get_post_meta( $postid, 'wpcf-punjabi-upload-project', true );
                	}
                	if (!empty($proj_upload_e)) {
                		$proj_upload = $proj_upload_e;
                	}else{
                		$proj_upload  =  get_post_meta( $postid, 'wpcf-punjabi-project-banner', true );
                	}

                	$english_title = qtranxf_use_language('en',$pageData->post_title, false, true);
				    $hindi_title = qtranxf_use_language('HI',$pageData->post_title, false, true);

					if (!empty($english_title)) {
						$title = $english_title;
					}else{
						$title = $hindi_title ;
					}

					$content_post = get_post($pageData->ID);
					$english_content = qtranxf_use_language('en',$content_post->post_content, false, true);
				    $hindi_content = qtranxf_use_language('HI',$content_post->post_content, false, true);

					if (!empty($english_content)) {
						$content = $english_content;
					}else{
						$content = $hindi_content ;
					}
					$content = apply_filters('the_content', $content);
					$content = str_replace(']]>', ']]&gt;', $content);
		 			$content=substr($content,0,60);
					$out .= '<div style="width:100%; float:left;margin-bottom: 20px;"><img src="'.$proj_upload.'" style="height:65px; width:65px; margin-right:8px; float:left;"><a href="'.site_url().'/projects/#'.$postid.'" target="_blank" style="font-weight:bold;">'.$title.'</a>'.$content.'</div><div class="clearfix"></div>';
		 		}
		 		$out.='</div><div><div class="cs-column-text btn-div"><p><a class="view-link" href="'.site_url().'/projects"><font style="font-size:100%" my="my">View All </font><i class="fa fa-caret-right"></i></a></p></div>';
		 	}
		 	else{
				$out .="<div class='d-flex'><center class='middle-data'><i class='fa fa-info-circle'></i><br/>No Projects</center></div><style>.view-link{display:none;}</style>";
			}

		}
		wp_reset_query();
        return html_entity_decode($out); 
    }

/*
	=========================
	ELECTED REPRESENTATIVE SHORTCODE
	=========================
*/
	add_shortcode('representativeshort_q', 'representative_shortcode_query');
    function representative_shortcode_query($atts, $content){
    	global $wpdb;
		$querystr = "
		    SELECT * FROM $wpdb->posts
		    WHERE $wpdb->posts.post_status = 'publish' 
		    AND $wpdb->posts.post_type = 'representative'
		    ORDER BY $wpdb->posts.menu_order ASC";

		$pageposts = $wpdb->get_results($querystr, OBJECT);

  		$out = '';
		$count=count($pageposts);
 		$out = '';
 		if (qtranxf_getLanguage() == 'HI') {
	 		if($count>0){
	 			foreach($pageposts as $pageData){

	  				$postid=$pageData->ID;
					$img_url =   get_post_meta( $postid, 'wpcf-representative-image', true );
					$position_p  =  get_post_meta( $postid, 'wpcf-punjabi-representative-position', true );

					if (!empty($position_p)) {
						$position = $position_p;
					}else{
						$position  =  get_post_meta( $postid, 'wpcf-representative-position', true );
					}

		 			
		 			$english_title = qtranxf_use_language('en',$pageData->post_title, false, true);
				    $hindi_title = qtranxf_use_language('HI',$pageData->post_title, false, true);

					if (!empty($hindi_title)) {
						$title = $hindi_title;
					}else{
						$title = $english_title ;
					}

		 			$out .= '<div class="col-md-12 col-sm-6" style="padding: 0;">
								<div class="minister-details">
									<div style="padding: 0;" class="col-md-3 col-sm-6">
										<img src="'.$img_url.'" class="img-responsive" alt="">
									</div>	
									<div style="padding: 0;" class="col-md-9 col-sm-6">
										<h3 style="text-align: center;"><font style="font-size:100%" my="my">'.$title.'</font></h3>
										<p style="text-align: center;"><font style="font-size:100%" my="my">('.$position.')</font></p>	
									</div>						
								</div>	
							</div>';
		 		}
		 	} 
		}
		else{
			if($count>0){
	 			foreach($pageposts as $pageData){
	  				$postid=$pageData->ID;
					$img_url =   get_post_meta( $postid, 'wpcf-representative-image', true );
					$position_e =  get_post_meta( $postid, 'wpcf-representative-position', true );

					if (!empty($position_e)) {
						$position = $position_e;
					}else{
						$position  =  get_post_meta( $postid, 'wpcf-punjabi-representative-position', true );
					}


		 			$english_title = qtranxf_use_language('en',$pageData->post_title, false, true);
				    $hindi_title = qtranxf_use_language('HI',$pageData->post_title, false, true);

					if (!empty($english_title)) {
						$title = $english_title;
					}else{
						$title = $hindi_title ;
					}

		 			$out .= '<div class="col-md-12 col-sm-6" style="padding: 0;">
								<div class="minister-details">
									<div style="padding: 0;" class="col-md-3 col-sm-6">
										<img src="'.$img_url.'" class="img-responsive" alt="">
									</div>	
									<div style="padding: 0;" class="col-md-9 col-sm-6">
										<h3 style="text-align: center;"><font style="font-size:100%" my="my">'.$title.'</font></h3>
										<p style="text-align: center;"><font style="font-size:100%" my="my">('.$position.')</font></p>	
									</div>						
								</div>	
							</div>';
		 		}
		 	} 

		}
	 	wp_reset_query();
        return html_entity_decode($out);
    }

/*
	=========================
	ELECTED REPRESENTATIVE SHORTCODE
	=========================
*/
	add_shortcode('administrative_representative', 'administrative_representative_shortcode_query');
    function administrative_representative_shortcode_query($atts, $content){
    	global $wpdb;
		$querystr = "
		    SELECT * FROM $wpdb->posts
		    WHERE $wpdb->posts.post_status = 'publish' 
		    AND $wpdb->posts.post_type = 'administrative-repre'
		    ORDER BY $wpdb->posts.menu_order ASC";

		$pageposts = $wpdb->get_results($querystr, OBJECT);

  		$out = '';
		$count=count($pageposts);
 		$out = '';
 		if (qtranxf_getLanguage() == 'HI') {
	 		if($count>0){
	 			foreach($pageposts as $pageData){
	 				$postid=$pageData->ID;
					$img_url =   get_post_meta( $postid, 'wpcf-representative-image', true );
					$position_p  =  get_post_meta( $postid, 'wpcf-punjabi-representative-position', true );
					
					if (!empty($position_p)) {
						$position = $position_p;
					}else{
						$position  =  get_post_meta( $postid, 'wpcf-representative-position', true );
					}

		 			$english_title = qtranxf_use_language('en',$pageData->post_title, false, true);
				    $hindi_title = qtranxf_use_language('HI',$pageData->post_title, false, true);

					if (!empty($hindi_title)) {
						$title = $hindi_title;
					}else{
						$title = $english_title ;
					}

		 			$out .= '<div class="col-md-12 col-sm-6" style="padding: 0;">
								<div class="minister-details">
									<div style="padding: 0;" class="col-md-3 col-sm-6">
										<img src="'.$img_url.'" class="img-responsive" alt="Responsive image">
									</div>	
									<div style="padding: 0;" class="col-md-9 col-sm-6">
										<h3 style="text-align: center;"><font style="font-size:100%" my="my">'.$title.'</font></h3>
										<p style="text-align: center;"><font style="font-size:100%" my="my">'.$position.'</font></p>	
									</div>						
								</div>	
							</div>';
		 		}
		 	}
		}
		else{
			if($count>0){
	 			foreach($pageposts as $pageData){
	  				$postid=$pageData->ID;
					$img_url =   get_post_meta( $postid, 'wpcf-representative-image', true );
					$position_e =  get_post_meta( $postid, 'wpcf-representative-position', true );

					if (!empty($position_e)) {
						$position = $position_e;
					}else{
						$position  =  get_post_meta( $postid, 'wpcf-punjabi-representative-position', true );
					}

		 			$english_title = qtranxf_use_language('en',$pageData->post_title, false, true);
				    $hindi_title = qtranxf_use_language('HI',$pageData->post_title, false, true);

					if (!empty($english_title)) {
						$title = $english_title;
					}else{
						$title = $hindi_title ;
					}

		 			$out .= '<div class="col-md-12 col-sm-6" style="padding: 0;">
								<div class="minister-details">
									<div style="padding: 0;" class="col-md-3 col-sm-6">
										<img src="'.$img_url.'" class="img-responsive" alt="Responsive image">
									</div>	
									<div style="padding: 0;" class="col-md-9 col-sm-6">
										<h3 style="text-align: center;"><font style="font-size:100%" my="my">'.$title.'</font></h3>
										<p style="text-align: center;"><font style="font-size:100%" my="my">'.$position.'</font></p>	
									</div>						
								</div>	
							</div>';
		 		}
		 	}

		} 
	 	wp_reset_query();
        return html_entity_decode($out);
    }

/*
	=========================
	     ULBs SHORTCODE
	=========================
*/
	add_shortcode('ulb_q', 'ulb_shortcode_query');
    function ulb_shortcode_query($atts, $content){
    	global $wpdb;
		 $querystr = "SELECT * 
		    FROM $wpdb->posts
		    WHERE $wpdb->posts.post_status = 'publish' 
		    AND $wpdb->posts.post_type = 'ulbs'
		    ORDER BY $wpdb->posts.menu_order ASC
		    LIMIT 0,8";
		$pageposts = $wpdb->get_results($querystr, OBJECT);
 		$out = '';
 		foreach($pageposts as $pageData){
			$ulbName =   get_post_meta( $pageData->ID, 'wpcf-ulbs-name', true );
			$ulbUrl =   get_post_meta( $pageData->ID, 'wpcf-ulbs-url', true );
		    $out .='<span class="down-li"><a target="_blank" href="'.$ulbUrl.'">'.$ulbName.'</a></span>'; 
		}
		wp_reset_query();
        return html_entity_decode($out);
    }

/*
	=========================
	     TITLE SHORTCODE
	=========================
*/
	add_shortcode( 'page_title', 'mysite_title' );	
	function mysite_title( ){
   		return get_option( 'blogname' );
	}

/*
	=====================================
	SITE URL FOR VIEW ALL LINKS SHORTCODE
	=====================================
*/
	add_shortcode( 'site_url', 'myurl_title' );
	function myurl_title( ){
   		return get_option( 'siteurl' );
	}

/*
	=====================================
	   DYNAMIC COLOR CHANGER SHORTCODE
	=====================================
*/
	function tcx_register_theme_customizer( $wp_customize ) {
 
	    $wp_customize->add_setting(
	        'tcx_link_color',
	        array(
	            'default'     => '#000000'
	        )
	    );
	    $wp_customize->add_control(
	        new WP_Customize_Color_Control(
	            $wp_customize,
	            'link_color',
	            array(
	                'label'      => __( 'Custom-background', 'tcx' ),
	                'section'    => 'colors',
	                'settings'   => 'tcx_link_color'
	            )
	        )
	    ); 
    }
    add_action( 'customize_register', 'tcx_register_theme_customizer' );

    add_filter( 'tiny_mce_before_init', 'wpex_mce_google_fonts_array' );
	function wpex_mce_google_fonts_array( $initArray ) {
	  
	    $theme_advanced_fonts = 'Asees=Asees;';
	    $theme_advanced_fonts .= 'GurbaniWebThick=GurbaniWebThick;';
	    $theme_advanced_fonts .= 'Lato=Lato;';
	    $theme_advanced_fonts .= 'Paytone One=Paytone One';
	    $initArray['font_formats'] = $theme_advanced_fonts;
	    return $initArray;
	}

	add_action('admin_head-post.php', function() {
	    ?>
	    <style>
		   @font-face {
			  font-family: 'Asees';
			  src: url('http://punjab-portal-beta.egovernments.org/wp-content/uploads/sites/122/fonts/Asees.eot?#iefix') format('embedded-opentype'),
			       url('http://punjab-portal-beta.egovernments.org/wp-content/uploads/sites/122/fonts/Asees.woff') format('woff'),
				   url('http://punjab-portal-beta.egovernments.org/wp-content/uploads/sites/122/fonts/Asees.ttf')  format('truetype'),
				   url('http://punjab-portal-beta.egovernments.org/wp-content/uploads/sites/122/fonts/Asees.svg#Asees') format('svg');
			  font-weight: normal;
			  font-style: normal;
			}
			@font-face {
			  font-family: 'GurbaniWebThick';
			  src: url('http://punjab-portal-beta.egovernments.org/wp-content/uploads/sites/122/fonts/GurbaniWebThick.eot?#iefix') format('embedded-opentype'),
			       url('http://punjab-portal-beta.egovernments.org/wp-content/uploads/sites/122/fonts/GurbaniWebThick.woff') format('woff'),
				   url('http://punjab-portal-beta.egovernments.org/wp-content/uploads/sites/122/fonts/GurbaniWebThick.ttf')  format('truetype'),
				   url('http://punjab-portal-beta.egovernments.org/wp-content/uploads/sites/122/fonts/GurbaniWebThick.svg#GurbaniWebThick') format('svg');
			  font-weight: normal;
			  font-style: normal;
			}
        </style>
       <?php
    });

/*
  ========================================
   ADMINISTRATIVE REPRESENTIVES SHORTCODE
  ========================================
*/
	add_shortcode('admin_representativeshort', 'admin_representative_shortcode_query');

	function admin_representative_shortcode_query($atts, $content){

		global $wpdb;
		 $querystr = "
		    SELECT * FROM $wpdb->posts
		    WHERE $wpdb->posts.post_status = 'publish' 
		    AND $wpdb->posts.post_type = 'administrative'
		    ORDER BY $wpdb->posts.menu_order ASC";

		$pageposts = $wpdb->get_results($querystr, OBJECT);
		  $out = '';
		$count=count($pageposts);
		 $out = '';
		if (qtranxf_getLanguage() == 'HI') {
			 if($count>0){
		 		foreach($pageposts as $pageData){
		  			$postid=$pageData->ID;
		    		$img_url_p =   get_post_meta( $postid, 'wpcf-punjabi-representative-image', true );
					$position_p  =  get_post_meta( $postid, 'wpcf-punjabi-representative-position', true );

					if (!empty($img_url_p)) {
						$img_url = $img_url_p;
					}else{
		    		$img_url =   get_post_meta( $postid, 'wpcf-representative-image', true );
					}
					if (!empty($position_p)) {
						$position = $position_p;
					}else{
					$position  =  get_post_meta( $postid, 'wpcf-representative-position', true );
					}

		   			 $english_title = qtranxf_use_language('en',$pageData->post_title, false, true);
					$hindi_title = qtranxf_use_language('HI',$pageData->post_title, false, true);

					if (!empty($hindi_title)) {
						$title = $hindi_title;
					}else{
						$title = $english_title;
					}
				    $out .= '<div class="col-md-12 col-sm-6" style="padding: 0;">
				                <div class="minister-details">
				                    <div style="padding: 0;" class="col-md-3 col-sm-6">
				                      <img src="'.$img_url.'" class="img-responsive" alt="Responsive image">
				                    </div>  
									<div style="padding: 0;" class="col-md-9 col-sm-6">
		    							<h3 style="text-align: center;"><font style="font-size:100%" my="my">'.$title.'</font></h3>
		    							<p style="text-align: center;"><font style="font-size:100%" my="my">('.$position.')</font></p>  
		  							</div>  
		  						</div>  
							</div>';
		   		} 
			}
        }
        else{
        	if($count>0){
		 		foreach($pageposts as $pageData){
		  			$postid=$pageData->ID;
		    		$img_url_e =   get_post_meta( $postid, 'wpcf-representative-image', true );
					$position_e =  get_post_meta( $postid, 'wpcf-representative-position', true );

					if (!empty($img_url_e)) {
						$img_url = $img_url_e;
					}else{
		    		$img_url =   get_post_meta( $postid, 'wpcf-punjabi-representative-image', true );
					}
					if (!empty($position_e)) {
						$position = $position_e;
					}else{
					$position  =  get_post_meta( $postid, 'wpcf-punjabi-representative-position', true );
					}
		   			$english_title = qtranxf_use_language('en',$pageData->post_title, false, true);
				    $hindi_title = qtranxf_use_language('HI',$pageData->post_title, false, true);

					if (!empty($english_title)) {
						$title = $english_title;
					}else{
						$title = $hindi_title ;
					}
				    $out .= '<div class="col-md-12 col-sm-6" style="padding: 0;">
				                <div class="minister-details">
				                    <div style="padding: 0;" class="col-md-3 col-sm-6">
				                      <img src="'.$img_url.'" class="img-responsive" alt="Responsive image">
				                    </div>  
									<div style="padding: 0;" class="col-md-9 col-sm-6">
		    							<h3 style="text-align: center;"><font style="font-size:100%" my="my">'.$title.'</font></h3>
		    							<p style="text-align: center;"><font style="font-size:100%" my="my">('.$position.')</font></p>  
		  							</div>  
		  						</div>  
							</div>';
		   		} 
			}

        }
		wp_reset_query();
		return html_entity_decode($out);
	}

/*
  ========================================
     Government Resolution Shortcode
  ========================================
*/
add_shortcode('download_gov_res', 'download_gov_res_shortcode_query');

function download_gov_res_shortcode_query($atts, $content){
  
	global $wpdb;
	$deptdata=array();
	$postid=array();
	$querystr = "SELECT * FROM $wpdb->posts
	    WHERE $wpdb->posts.post_status = 'publish' 
	    AND $wpdb->posts.post_type = 'govt-resolutions'
	    ORDER BY $wpdb->posts.menu_order DESC";
	$pageposts = $wpdb->get_results($querystr, OBJECT);

 	$out = '';
 	if (qtranxf_getLanguage() == 'HI'){
		foreach($pageposts as $pageData){

		   $departName_p =   get_post_meta( $pageData->ID, 'wpcf-punjabii-department-name', true );
		   if (!empty($departName_p)) {
		   	$departName = $departName_p ;
		   }else{
               $departName =   get_post_meta( $pageData->ID, 'wpcf-departments-name', true );
		   }

		   if(!in_array($departName,$deptdata)){
		    array_push($deptdata,$departName);
		    }
		    array_push($postid,$pageData->ID);
		}

  		$count_cat=count($deptdata);
  		for($i=0;$i<$count_cat;$i++){

    		$out .= '<div class="col-sm-12"><h4 class="download-cat">'.$deptdata[$i].'</h4>';
            foreach($postid as  $post){
                $grDate =   get_post_meta( $post, 'wpcf-gr-date', true );
                $uniqueCode_p =   get_post_meta( $post, 'wpcf-punjabi-unique-code', true );
                $depart_p =   get_post_meta( $post, 'wpcf-punjabii-department-name', true );

                if (!empty($uniqueCode_p)) {
                	$uniqueCode = $uniqueCode_p;
                }else{
                	$uniqueCode =   get_post_meta( $post, 'wpcf-unique-code', true );
                }
                if (!empty($depart_p)) {
                	$depart = $depart_p ;
                }else{
                	$depart =   get_post_meta( $post, 'wpcf-departments-name', true );
                }


                $post_data = get_post( $post ); 
               
                 $english_title = qtranxf_use_language('en',$post_data->post_title, false, true);
				    $hindi_title = qtranxf_use_language('HI',$post_data->post_title, false, true);

					if (!empty($hindi_title)) {
						$title = $hindi_title;
					}else{
						$title = $english_title ;
					}

                if (!empty(get_post_meta($post, 'wpcf-punjabii-choose-file', true))) {
                	$file_punjabi = 'wpcf-punjabii-choose-file';
                }
                else{
                	$file_punjabi = 'wpcf-choose-files';
                }

                $querystr1 = "SELECT * FROM $wpdb->postmeta
                WHERE $wpdb->postmeta.post_id = '".$post."' AND  $wpdb->postmeta.meta_key = '".$file_punjabi."'
                  ORDER BY $wpdb->postmeta.meta_id DESC";
                $pageposts1 = $wpdb->get_results($querystr1, OBJECT);

                if($depart==$deptdata[$i]){
                  $out .= '<div class="download-form-container"><div class="col-xs-12 col-sm-12">
                     <p class="form-title">'.$title.'</p>
                    <h5>Unique Code: '.$uniqueCode.'</h5>
                    <h5>GR date: '.date('Y-m-d',$grDate).'</h5>
                    <div class="">';
                    foreach($pageposts1 as $metaVal){
	                    $urls = explode("/", $metaVal->meta_value);
	                    $ct = count($urls);
	                    $name = $urls[$ct-1];
	                    $name_img = explode('.', $name);
	                    $btn_link = $metaVal->meta_value;

                    	$out .='<label style="font-weight: bold;text-transform: uppercase;" class="col-md-3">'.$name_img[0].'</label>';
	                    if (!$btn_link=='') {
	                      $out .= '<div class="col-md-8" style="margin-bottom:15px;"><a class="btn-download" href="'.$btn_link.'" target="_blank"><font style="font-size:100%" my="my"> DOWNLOAD</font></a></div>';
	                    }
	                    else{
	                      $out .= '<div class="col-md-8" style="margin-bottom:15px;"><button class="d-btn disable" disabled="disabled" style="-webkit-filter: grayscale(100%); /* Safari 6.0 - 9.0 */ filter:grayscale(100%);"><font style="font-size:100%" my="my"> DOWNLOAD</font></button></div>';
	                    }
                  	}
                  	$out .='</div></div></div>';
                }
            }
            $out .='</div>';
        }
    }
    else{
		foreach($pageposts as $pageData){

		   $departName_e =   get_post_meta( $pageData->ID, 'wpcf-departments-name', true );

		   if (!empty($departName_e)) {
		   	$departName = $departName_e ;
		   }else{
               $departName =   get_post_meta( $pageData->ID, 'wpcf-punjabii-department-name', true );
		   }

		   if(!in_array($departName,$deptdata)){
		    array_push($deptdata,$departName);
		    }
		    array_push($postid,$pageData->ID);
		}

  		$count_cat=count($deptdata);
  		for($i=0;$i<$count_cat;$i++){

    		$out .= '<div class="col-sm-12"><h4 class="download-cat">'.$deptdata[$i].'</h4>';
            foreach($postid as  $post){
                $grDate =   get_post_meta( $post, 'wpcf-gr-date', true );
                $uniqueCode_e =   get_post_meta( $post, 'wpcf-unique-code', true );
                $depart_e =   get_post_meta( $post, 'wpcf-departments-name', true );

                if (!empty($uniqueCode_e)) {
                	$uniqueCode = $uniqueCode_e;
                }else{
                	$uniqueCode =   get_post_meta( $post, 'wpcf-punjabi-unique-code', true );
                }
                if (!empty($depart_e)) {
                	$depart = $depart_e ;
                }else{
                	$depart =   get_post_meta( $post, 'wpcf-punjabii-department-name', true );
                }

                $post_data = get_post( $post ); 
               
                 $english_title = qtranxf_use_language('en',$post_data->post_title, false, true);
				    $hindi_title = qtranxf_use_language('HI',$post_data->post_title, false, true);

					if (!empty($english_title)) {
						$title = $english_title;
					}else{
						$title = $hindi_title ;
					}

               if (!empty(get_post_meta($post, 'wpcf-choose-files', true))) {
                	$file_english = 'wpcf-choose-files';
                }
                else{
                	$file_english = 'wpcf-punjabii-choose-file';
                }

                $querystr1 = "SELECT * FROM $wpdb->postmeta
                WHERE $wpdb->postmeta.post_id = '".$post."' AND  $wpdb->postmeta.meta_key = '".$file_english ."'
                  ORDER BY $wpdb->postmeta.meta_id DESC";
                $pageposts1 = $wpdb->get_results($querystr1, OBJECT);

                if($depart==$deptdata[$i]){
                  $out .= '<div class="download-form-container"><div class="col-xs-12 col-sm-12">
                     <p class="form-title">'.$title.'</p>
                    <h5>Unique Code: '.$uniqueCode.'</h5>
                    <h5>GR date: '.date('Y-m-d',$grDate).'</h5>
                    <div class="">';
                    foreach($pageposts1 as $metaVal){
	                    $urls = explode("/", $metaVal->meta_value);
	                    $ct = count($urls);
	                    $name = $urls[$ct-1];
	                    $name_img = explode('.', $name);
	                    $btn_link = $metaVal->meta_value;

                    	$out .='<label style="font-weight: bold;text-transform: uppercase;" class="col-md-3">'.$name_img[0].'</label>';
	                    if (!$btn_link=='') {
	                      $out .= '<div class="col-md-8" style="margin-bottom:15px;"><a class="btn-download" href="'.$btn_link.'" target="_blank"><font style="font-size:100%" my="my"> DOWNLOAD</font></a></div>';
	                    }
	                    else{
	                      $out .= '<div class="col-md-8" style="margin-bottom:15px;"><button class="d-btn disable" disabled="disabled" style="-webkit-filter: grayscale(100%); /* Safari 6.0 - 9.0 */ filter:grayscale(100%);"><font style="font-size:100%" my="my"> DOWNLOAD</font></button></div>';
	                    }
                  	}
                  	$out .='</div></div></div>';
                }
            }
            $out .='</div>';
        }
    }  
      
	wp_reset_query();
    return html_entity_decode($out);
}

/*
  ===========================================
      Notifications/Circulars Shortcode
  ===========================================
*/
	add_shortcode('download_notification', 'download_notification_shortcode_query');

	function download_notification_shortcode_query($atts, $content){
	  
	global $wpdb;
	$deptdata=array();
	$postid=array();
	 $querystr = "
	    SELECT * FROM $wpdb->posts
	    WHERE $wpdb->posts.post_status = 'publish' 
	    AND $wpdb->posts.post_type = 'public-notice'
	    ORDER BY $wpdb->posts.menu_order DESC
	 ";

	$pageposts = $wpdb->get_results($querystr, OBJECT);

	 $out = '';
	 	if (qtranxf_getLanguage() == 'HI') {
		   foreach($pageposts as $pageData){
			    $departName_p =   get_post_meta( $pageData->ID, 'wpcf-punjabi-public-department-name', true );
			    if (!empty($departName_p)) {
			    	$departName =  $departName_p ;
			    }else{
			    	$departName =   get_post_meta( $pageData->ID, 'wpcf-public-department-name', true );
			    }

			    if(!in_array($departName,$deptdata)){
			      array_push($deptdata,$departName);
			    }
			    array_push($postid,$pageData->ID); 
		    }
		    $count_cat=count($deptdata);
		   for($i=0;$i<$count_cat;$i++){
		       $out .='<div class="col-sm-12"><h4 class="download-cat">'. $deptdata[$i].'</h4>';
			    foreach($postid as  $post){
			      $pulishNotice_p =   get_post_meta( $post, 'wpcf-punjabi-publisher', true );
			      $docUpload_p =   get_post_meta( $post, 'wpcf-punjabi-public-upload-document', true );
			      $depart_p =   get_post_meta( $post, 'wpcf-punjabi-public-department-name', true );
			      $issueDate =   get_post_meta( $post, 'wpcf-notification-issue-date', true );
			      $validDate =   get_post_meta( $post, 'wpcf-valid-date', true );

			      if (!empty($pulishNotice_p)) {
			      	$pulishNotice = $pulishNotice_p ;
			      }else{
			      	$pulishNotice =   get_post_meta( $post, 'wpcf-publish', true );
			      }

			      if (!empty($docUpload_p)) {
			      	$docUpload = $docUpload_p;
			      }else{
			      	$docUpload =   get_post_meta( $post, 'wpcf-upload-document', true );
			      }

			      if (!empty($depart_p)) {
			      	$depart = $depart_p;
			      }else{
			      	$depart =   get_post_meta( $post, 'wpcf-public-department-name', true );
			      }


			      $post_data = get_post( $post );

			        $english_content = qtranxf_use_language('en',$post_data->post_content, false, true);
				    $hindi_content = qtranxf_use_language('HI',$post_data->post_content, false, true);

					if (!empty($hindi_content)) {
						$desc = $hindi_content;
					}else{
						$desc = $english_content ;
					}

			      if($depart==$deptdata[$i]){

			        $out .= '<div class="download-form-container"><div class="col-xs-12 col-sm-12"><p class="form-title">'.$pulishNotice.'</p><h5>Issue Date: <span class="issue-date">'.date('Y-m-d',$issueDate).'</span></h5><h5>Validty Date: <span class="validty-date">'. date('Y-m-d',$validDate).'</span></h5><p class="description">'.nl2br($desc).'</p><div>';
			        if (!$docUpload=='') {
			          $out .= '<a class="btn-download" href="'.$docUpload.'" target="_blank">DOWNLOAD</a>';
			        }
			        else{
			          $out .= '<button class="d-btn disable" disabled="disabled" style="-webkit-filter: grayscale(100%); /* Safari 6.0 - 9.0 */ filter:grayscale(100%);">DOWNLOAD</button>';
			        }
			              
			          $out .='</div></div></div>';
			      }
			    }
		       $out .= '</div>';
		    }
		}
		else{
		   foreach($pageposts as $pageData){
			    $departName_e =   get_post_meta( $pageData->ID, 'wpcf-public-department-name', true );

			    if (!empty($departName_e)) {
			    	$departName =  $departName_e;
			    }else{
			    	$departName =   get_post_meta( $pageData->ID, 'wpcf-punjabi-public-department-name', true );
			    }

			    if(!in_array($departName,$deptdata)){
			      array_push($deptdata,$departName);
			    }
			    array_push($postid,$pageData->ID); 
		    }
		    $count_cat=count($deptdata);
		   for($i=0;$i<$count_cat;$i++){
		       $out .='<div class="col-sm-12"><h4 class="download-cat">'. $deptdata[$i].'</h4>';
			    foreach($postid as  $post){
			      $pulishNotice_e =   get_post_meta( $post, 'wpcf-publish', true );
			      $issueDate_e =   get_post_meta( $post, 'wpcf-notification-issue-date', true );
			      $validDate_e =   get_post_meta( $post, 'wpcf-valid-date', true );
			      $docUpload_e =   get_post_meta( $post, 'wpcf-upload-document', true );
			      $depart_e =   get_post_meta( $post, 'wpcf-public-department-name', true );

			      if (!empty($pulishNotice_e)) {
			      	$pulishNotice = $pulishNotice_e ;
			      }else{
			      	$pulishNotice =   get_post_meta( $post, 'wpcf-punjabi-publisher', true );
			      }


			      if (!empty($docUpload_e)) {
			      	$docUpload = $docUpload_e;
			      }else{
			      	$docUpload =    get_post_meta( $post, 'wpcf-punjabi-public-upload-document', true );
			      }

			      if (!empty($depart_e)) {
			      	$depart = $depart_e;
			      }else{
			      	$depart =    get_post_meta( $post, 'wpcf-punjabi-public-department-name', true );
			      }


			      $post_data = get_post( $post );
			      
			      $english_content = qtranxf_use_language('en',$post_data->post_content, false, true);
				    $hindi_content = qtranxf_use_language('HI',$post_data->post_content, false, true);

					if (!empty($english_content)) {
						 $desc = $english_content;
					}else{
						 $desc = $hindi_content ;
					}
			      if($depart==$deptdata[$i]){

			        $out .= '<div class="download-form-container"><div class="col-xs-12 col-sm-12"><p class="form-title">'.$pulishNotice.'</p><h5>Issue Date: <span class="issue-date">'.date('Y-m-d',$issueDate).'</span></h5><h5>Validty Date: <span class="validty-date">'. date('Y-m-d',$validDate).'</span></h5><p class="description">'.nl2br($desc).'</p><div>';
			        if (!$docUpload=='') {
			          $out .= '<a class="btn-download" href="'.$docUpload.'" target="_blank">DOWNLOAD</a>';
			        }
			        else{
			          $out .= '<button class="d-btn disable" disabled="disabled" style="-webkit-filter: grayscale(100%); /* Safari 6.0 - 9.0 */ filter:grayscale(100%);">DOWNLOAD</button>';
			        }
			              
			          $out .='</div></div></div>';
			      }
			    }
		       $out .= '</div>';
		    }
		}     
	  wp_reset_query();
	  return html_entity_decode($out);

	}  



	add_shortcode('download_q', 'download_shortcode_query');

	function download_shortcode_query($atts, $content){
	  
	global $wpdb;
	 $querystr = "SELECT * 
	    FROM $wpdb->posts
	    WHERE $wpdb->posts.post_status = 'publish' 
	    AND $wpdb->posts.post_type = 'download'
	    ORDER BY $wpdb->posts.menu_order DESC";

	$pageposts = $wpdb->get_results($querystr, OBJECT);
	$out = '';
	if (qtranxf_getLanguage() == 'HI') {
		foreach($pageposts as $pageData){

			$downloadUrl_p =   get_post_meta( $pageData->ID, 'wpcf-punjabi-enter-url-here', true );
			$downloadDoc_p  =  get_post_meta( $pageData->ID, 'wpcf-punjabi-upload-your-document', true );

			if (!empty($downloadUrl_p)) {
				$downloadUrl = $downloadUrl_p ;
			}else{
				$downloadUrl =   get_post_meta( $pageData->ID, 'wpcf-enter-url-here', true );
			}

			if (!empty($downloadDoc_p)) {
				$downloadDoc = $downloadDoc_p;
			}else{
			$downloadDoc  =  get_post_meta( $pageData->ID, 'wpcf-upload-your-document', true );
			}

			$english_title = qtranxf_use_language('en',$pageData->post_title, false, true);
			$hindi_title = qtranxf_use_language('HI',$pageData->post_title, false, true);

			if (!empty($hindi_title)) {
				$title = $hindi_title;
			}else{
			    $title = $english_title;
			}



			$out .='<span class="down-li"><a target="_blank" href="'.$downloadDoc.'">'.$title.'</a></span>'; 
		}
	}
	else{
		foreach($pageposts as $pageData){

			$downloadUrl_e =   get_post_meta( $pageData->ID, 'wpcf-enter-url-here', true );
			$downloadDoc_e  =  get_post_meta( $pageData->ID, 'wpcf-upload-your-document', true );

			if (!empty($downloadUrl_e)) {
				$downloadUrl = $downloadUrl_e;
			}else{
				$downloadUrl =   get_post_meta( $pageData->ID, 'wpcf-punjabi-enter-url-here', true );
			}

			if (!empty($downloadDoc_e)) {
				$downloadDoc = $downloadDoc_e;
			}else{
				$downloadDoc  =  get_post_meta( $pageData->ID, 'wpcf-punjabi-upload-your-document', true );
			}

			$english_title = qtranxf_use_language('en',$pageData->post_title, false, true);
			$hindi_title = qtranxf_use_language('HI',$pageData->post_title, false, true);

			if (!empty($english_title)) {
				$title = $english_title;
			}else{
			    $title = $hindi_title;
			}

			$out .='<span class="down-li"><a target="_blank" href="'.$downloadDoc.'">'.$title.'</a></span>'; 
		}

	} 
	  wp_reset_query();
	  return html_entity_decode($out);
	}

/*
  ========================================
    Help Documents Shortcode
  ========================================
*/
	add_shortcode('help_docu', 'help_docum_shortcode_query');

	function help_docum_shortcode_query($atts, $content){
	  
	  global $wpdb;
	  $deptdata=array();
	  $postid=array();
	  $querystr = "SELECT * FROM $wpdb->posts WHERE $wpdb->posts.post_status = 'publish' AND $wpdb->posts.post_type = 'help-document' ORDER BY $wpdb->posts.menu_order DESC ";
	  $out = '';

	  $pageposts = $wpdb->get_results($querystr, OBJECT);

	   if (qtranxf_getLanguage() == 'HI') {
		   foreach($pageposts as $pageData){
			    $departName_p =   get_post_meta( $pageData->ID, 'wpcf-punjabi-hd-department-name', true );
			    if (!empty($departName_p)) {
			    	$departName = $departName_p;
			    }else{
			    	$departName = get_post_meta( $pageData->ID, 'wpcf-departments-names', true ); 
			    }
			   
			    if(!in_array($departName,$deptdata)){
			    array_push($deptdata,$departName);
			    }
			    array_push($postid,$pageData->ID);
		    }
		    $count_cat=count($deptdata);
		    for($i=0;$i<$count_cat;$i++){
		      $out .='<div class="col-sm-12"><h4 class="download-cat">'.$deptdata[$i].'</h4>';
			    foreach($postid as  $post){
			      $servName_p =   get_post_meta( $post, 'wpcf-punjabi-hd-service-name', true );
			      $docMarathi_p =   get_post_meta( $post, 'wpcf-punjabi-hd-upload-document-punjabi', true );
			      $docEng_p =   get_post_meta( $post, 'wpcf-punjabi-hd-upload-document-english', true );
			      $depart_p =   get_post_meta( $post, 'wpcf-punjabi-hd-department-name', true );

			      if (!empty($servName_p)) {
			      	$servName = $servName_p;
			      }else{
 					$servName =   get_post_meta( $post, 'wpcf-service-name', true );
			      }

			      if (!empty($docMarathi_p)) {
			      	$docMarathi = $docMarathi_p;
			      }else{
			      	$docMarathi =   get_post_meta( $post, 'wpcf-upload-document-punjabi', true );
			      }

			      if (!empty($docEng_p)) {
			      	$docEng = $docEng_p;
			      }else{
			      	$docEng =   get_post_meta( $post, 'wpcf-upload-document-english', true );
			      }

			      if (!empty($depart_p)) {
			      	$depart = $depart_p;
			      }else{
			      	$depart =   get_post_meta( $post, 'wpcf-departments-names', true );
			      }


			      if($depart==$deptdata[$i]){
			        
			        $out .='<div class="download-form-container"><div class="col-md-8"><p class="form-title">'.$servName.'</p>
			          </div><div class="col-md-4">';
			        if (!$docEng=='') {
			          $out.= '<a class="btn-download" href="'.$docEng.'" target="_blank" style="float:right;">DOWNLOAD ENGLISH</a><br/><br/>';
			        }
			        else{
			          $out.= '<button class="d-btn disable" disabled="disabled" style="-webkit-filter: grayscale(100%); /* Safari 6.0 - 9.0 */ filter:grayscale(100%);float:right;">DOWNLOAD ENGLISH</button>';
			        }
			        if (!$docMarathi=='') {
			          $out.= '<a class="btn-download" href="'.$docMarathi.'" target="_blank" style="float:right;">DOWNLOAD PUNJABI</a>';
			        }
			        else{
			          $out.= '<button class="d-btn disable" disabled="disabled" style="-webkit-filter: grayscale(100%); /* Safari 6.0 - 9.0 */ filter:grayscale(100%);float:right;">DOWNLOAD PUNJABI</button>';
			        }
			        $out.='</div></div>';
			      }
			    }
		    	$out .='</div>';
		  	}
		}
		else{
			foreach($pageposts as $pageData){
			    $departName_e =   get_post_meta( $pageData->ID, 'wpcf-departments-names', true );

			    if (!empty($departName_e)) {
			    	$departName = $departName_e;
			    }else{
			    	$departName = get_post_meta( $pageData->ID, 'wpcf-punjabi-hd-department-name', true ); 
			    }
			   
			    if(!in_array($departName,$deptdata)){
			    array_push($deptdata,$departName);
			    }
			    array_push($postid,$pageData->ID);
		    }
		    $count_cat=count($deptdata);
		    for($i=0;$i<$count_cat;$i++){
		      $out .='<div class="col-sm-12"><h4 class="download-cat">'.$deptdata[$i].'</h4>';
			    foreach($postid as  $post){
			      $servName_e =   get_post_meta( $post, 'wpcf-service-name', true );
			      $docMarathi_e =   get_post_meta( $post, 'wpcf-upload-document-punjabi', true );
			      $docEng_e =   get_post_meta( $post, 'wpcf-upload-document-english', true );
			      $depart_e =   get_post_meta( $post, 'wpcf-departments-names', true );

			      if (!empty($servName_e)) {
			      	$servName = $servName_e;
			      }else{
 					$servName =   get_post_meta( $post, 'wpcf-punjabi-hd-service-name', true );
			      }

			      if (!empty($docMarathi_e)) {
			      	$docMarathi = $docMarathi_e;
			      }else{
			      	$docMarathi =  get_post_meta( $post, 'wpcf-punjabi-hd-upload-document-punjabi', true );
			      }

			      if (!empty($docEng_e)) {
			      	$docEng = $docEng_e;
			      }else{
			      	$docEng =   get_post_meta( $post, 'wpcf-punjabi-hd-upload-document-english', true );
			      }

			      if (!empty($depart_e)) {
			      	$depart = $depart_e;
			      }else{
			      	$depart =    get_post_meta( $post, 'wpcf-punjabi-hd-department-name', true );
			      }


			      if($depart==$deptdata[$i]){
			        
			        $out .='<div class="download-form-container"><div class="col-md-8"><p class="form-title">'.$servName.'</p>
			          </div><div class="col-md-4">';
			        if (!$docEng=='') {
			          $out.= '<a class="btn-download" href="'.$docEng.'" target="_blank" style="float:right;">DOWNLOAD ENGLISH</a><br/><br/>';
			        }
			        else{
			          $out.= '<button class="d-btn disable" disabled="disabled" style="-webkit-filter: grayscale(100%); /* Safari 6.0 - 9.0 */ filter:grayscale(100%);float:right;">DOWNLOAD ENGLISH</button>';
			        }
			        if (!$docMarathi=='') {
			          $out.= '<a class="btn-download" href="'.$docMarathi.'" target="_blank" style="float:right;">DOWNLOAD PUNJABI</a>';
			        }
			        else{
			          $out.= '<button class="d-btn disable" disabled="disabled" style="-webkit-filter: grayscale(100%); /* Safari 6.0 - 9.0 */ filter:grayscale(100%);float:right;">DOWNLOAD PUNJABI</button>';
			        }
			        $out.='</div></div>';
			      }
			    }
		    	$out .='</div>';
		  	}
		}     
	   wp_reset_query();
	   return html_entity_decode($out);
	} 


/*
	=========================
	    GALLERY SHORTCODE
	=========================
*/
	add_shortcode('gallery_custom_post_shortcode','gallery_post_type_shortcode');
	function gallery_post_type_shortcode($atts, $content){
		global $wpdb;
		$querystr = "SELECT * FROM $wpdb->posts WHERE $wpdb->posts.post_status = 'publish' AND $wpdb->posts.post_type = 'photo-gallery' ORDER BY $wpdb->posts.menu_order DESC ";
		$out = '';

	    $pageposts = $wpdb->get_results($querystr, OBJECT);
	    $i=1;
	    if (qtranxf_getLanguage() == 'HI') {
	    	
		    foreach($pageposts as $pageData){
		    	$post_id = $pageData->ID;
		    	$image_url_p =   get_post_meta( $post_id, 'wpcf-punjabi-gallery-image', true );
		    	if (!empty($image_url_p)) {
		    		$image_url = $image_url_p;
		    	}else{
		    		$image_url =   get_post_meta( $post_id, 'wpcf-gallery-image', true );
		    	}

		    	$english_title = qtranxf_use_language('en',$pageData->post_title, false, true);
				$hindi_title = qtranxf_use_language('HI',$pageData->post_title, false, true);

					if (!empty($hindi_title)) {
						$title = strip_tags($hindi_title);
					}else{
						$title = strip_tags($english_title);
					}

		    	$out .= '<div class="column col-md-4" style="margin-top:10px;">
	                        <img src="'.$image_url.'" style="width:100%" onclick="openModal();currentSlide('.$i.')" class="hover-shadow cursor">
	  	                    <div class="col-xs-12 col-sm-12 gallery-title">
	  						    <p class="form-title">'.$title.'</p>
	  						</div>
	  					    <div class="clear"></div>
	                    </div>';

	            $i++;

		    }
		    $out .= '<div id="myModal" class="modal" style="background: #0000008a;"><span class="close cursor" onclick="closeModal()">&times;</span><div class="modal-content">';
		    $pageposts1 = $wpdb->get_results($querystr, OBJECT);
		    $count=count($pageposts1);
		     $i=1;
		    foreach($pageposts1 as $postdata){
		    	$post_id = $postdata->ID;
		    	$images_url_p =   get_post_meta( $post_id, 'wpcf-punjabi-gallery-image', true );
		    	if (!empty($images_url_p)) {
		    		$images_url = $images_url_p ;
		    	}else{
		    		$images_url =   get_post_meta( $post_id, 'wpcf-gallery-image', true );
		    	}

		    	$out .= '<div class="mySlides">
		    	           <div class="numbertext">'.$i.' / '.$count.'</div>
		    	           <img src="'.$images_url.'" style="width:100%">
		    	        </div>';
		    	$i++;
		    }
		    $out.= '<button class="prev" onclick="plusSlides(-1)" style="background:#332f2fc2;border: none;">&#10094;</button>
	                <button class="next" onclick="plusSlides(1)" style="background:#332f2fc2;border: none;">&#10095;</button>
				    <div class="caption-container">
				      <p id="caption"></p>
				    </div>';
		}
		else{
			foreach($pageposts as $pageData){
		    	$post_id = $pageData->ID;
		    	$image_url_e =   get_post_meta( $post_id, 'wpcf-gallery-image', true );
		    	 
		    	if (!empty($image_url_e)) {
		    		$image_url = $image_url_e;
		    	}else{
		    		$image_url =   get_post_meta( $post_id, 'wpcf-punjabi-gallery-image', true );
		    	}

		    	$english_title = qtranxf_use_language('en',$pageData->post_title, false, true);
				    $hindi_title = qtranxf_use_language('HI',$pageData->post_title, false, true);

					if (!empty($english_title)) {
						$title = strip_tags($english_title);
					}else{
						$title = strip_tags($hindi_title);
					}

		    	$out .= '<div class="column col-md-4" style="margin-top:10px;">
	                        <img src="'.$image_url.'" style="width:100%" onclick="openModal();currentSlide('.$i.')" class="hover-shadow cursor">
	  	                    <div class="col-xs-12 col-sm-12 gallery-title">
	  						    <p class="form-title">'.$title.'</p>
	  						</div>
	  					    <div class="clear"></div>
	                    </div>';

	            $i++;

		    }
		    $out .= '<div id="myModal" class="modal" style="background: #0000008a;"><span class="close cursor" onclick="closeModal()">&times;</span><div class="modal-content">';
		    $pageposts1 = $wpdb->get_results($querystr, OBJECT);
		    $count=count($pageposts1);
		     $i=1;
		    foreach($pageposts1 as $postdata){
		    	$post_id = $postdata->ID;
		    	$images_url_e =   get_post_meta( $post_id, 'wpcf-gallery-image', true );
 
		    	if (!empty($images_url_e)) {
		    		$images_url = $images_url_e ;
		    	}else{
		    		$images_url =   get_post_meta( $post_id, 'wpcf-punjabi-gallery-image', true );
		    	}

		    	$out .= '<div class="mySlides">
		    	           <div class="numbertext">'.$i.' / '.$count.'</div>
		    	           <img src="'.$images_url.'" style="width:100%">
		    	        </div>';
		    	$i++;
		    }
		    $out.= '<button class="prev" onclick="plusSlides(-1)" style="background:#332f2fc2;border: none;">&#10094;</button>
	                <button class="next" onclick="plusSlides(1)" style="background:#332f2fc2;border: none;">&#10095;</button>
				    <div class="caption-container">
				      <p id="caption"></p>
				    </div>';
		}



	     wp_reset_query();
	     return html_entity_decode($out);    
	}

	

	add_action('wp_footer','gallery_script');
	function gallery_script(){
		if(is_page('gallery')){
			echo "<script>function openModal() {
                  document.getElementById('myModal').style.display = 'block';
                }

function closeModal() {

  document.getElementById('myModal').style.display = 'none';
}

var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName('mySlides');
  var dots = document.getElementsByClassName('demo');
  var captionText = document.getElementById('caption');
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = 'none';
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace('active', '');
  }
  slides[slideIndex-1].style.display = 'block';
  dots[slideIndex-1].className += 'active';
  captionText.innerHTML = dots[slideIndex-1].alt;
}</script>";
		}
	}



/*
	==============================
	Recent Announcements SHORTCODE
	==============================
*/
	add_shortcode('recent_announcement', 'recent_announcement_custom_shortcode_query');
    function recent_announcement_custom_shortcode_query($atts, $content){
    	global $wpdb;
		 $querystr = "
		    SELECT * FROM $wpdb->posts
		    WHERE $wpdb->posts.post_status = 'publish' 
		    AND $wpdb->posts.post_type = 'recent-announcement'
		    ORDER BY $wpdb->posts.menu_order ASC";
		$pageposts = $wpdb->get_results($querystr, OBJECT);
  		$out = '';

 		if (qtranxf_getLanguage() == 'HI') {
	 		foreach($pageposts as $pageData){
	 			$recanmntUpload_file    =     get_post_meta( $pageData->ID, 'wpcf-punjabi-upload-doc', true );
	 			if (!empty($recanmntUpload_file)) {
	 				$recanmntUpload = $recanmntUpload_file;
	 			}else{
	 				$recanmntUpload    =     get_post_meta( $pageData->ID, 'wpcf-upload-doc', true );
	 			}
	 			    $english_title = qtranxf_use_language('en',$pageData->post_title, false, true);
				    $hindi_title = qtranxf_use_language('HI',$pageData->post_title, false, true);

					if (!empty($hindi_title)) {
						$title = nl2br($hindi_title);
					}else{
						$title = nl2br($english_title) ;
					}

	 			$out .= '<div class="download-form-container">
							<div class="col-md-12">
								<h4>'.$title.'</h4>
								<div class="mt-20">
									<a class="btn-download" href="'.$recanmntUpload.'" target="_blank"><font style="font-size:100%" my="my">DOWNLOAD</font></a>
								</div>
							</div>
						</div>';
	  			
	  		}
		}
		else{
			foreach($pageposts as $pageData){
	  			$recanmntUpload_file    =     get_post_meta( $pageData->ID, 'wpcf-upload-doc', true );
	 			if (!empty($recanmntUpload_file)) {
	 				$recanmntUpload = $recanmntUpload_file;
	 			}else{
	 				$recanmntUpload    =     get_post_meta( $pageData->ID, 'wpcf-punjabi-upload-doc', true );
	 			}
	 			    $english_title = qtranxf_use_language('en',$pageData->post_title, false, true);
				    $hindi_content = qtranxf_use_language('HI',$pageData->post_title, false, true);

					if (!empty($english_title)) {
						$title = nl2br($english_title);
					}else{
						$title = nl2br($hindi_title) ;
					}

	 			$out .= '<div class="download-form-container">
							<div class="col-md-12">
								<h4>'.$title.'</h4>
								<div class="mt-20">
									<a class="btn-download" href="'.$recanmntUpload.'" target="_blank"><font style="font-size:100%" my="my">DOWNLOAD</font></a>
								</div>
							</div>
						</div>';
		 	}
		} 
	 	wp_reset_query();
  		return html_entity_decode($out);
    }

// Right Site Logo

   add_shortcode('right-logo', 'custom_right_logo');
    function custom_right_logo(){
    	global $wpdb;
		 $querystr = "
		    SELECT * FROM $wpdb->posts
		    WHERE $wpdb->posts.post_status = 'publish' 
		    AND $wpdb->posts.post_type = 'right-sidebar-logo'
		    ORDER BY $wpdb->posts.menu_order ASC";
		$pageposts = $wpdb->get_results($querystr, OBJECT);
		foreach ($pageposts as $key => $data) {
			$id = $data->ID;
			return get_post_meta($id,'wpcf-header-right-side-logo',true);
		}
	}



//Login error message modify
function login_error_message(){
   return "<strong>One or Both invalid credenals</strong>";
}
add_filter('login_errors', 'login_error_message');

// wp-admin session time out after 15 mnt
function custom_cookie_expiration( $expiration, $user_id, $remember ) {
    return $remember ? $expiration : 900;
}
add_filter( 'auth_cookie_expiration', 'custom_cookie_expiration', 99, 3 );


add_action( 'wp_logout', 'ur_redirect_after_logout');

function ur_redirect_after_logout(){
         wp_redirect( site_url()."/wp-admin/");
         exit();
}


add_action( 'login_footer', 'remove_post_back_button' );

function remove_post_back_button() {
   
	echo "<script>
    history.pushState(null, null, null);
    window.addEventListener('popstate', function () {
        history.pushState(null, null, null);
    });
</script>";
  echo '<script
			  src="https://code.jquery.com/jquery-3.4.1.min.js"
			  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
			  crossorigin="anonymous"></script>';
   echo "<script>jQuery(document).ready(function(){
   	jQuery('#user_login').attr('autocomplete','off');
   	jQuery('#user_login').attr('autofill','off');
   });</script>";

}

function filter_handler( $data , $postarr ) {
  // do something with the post data
  return preg_replace('#<script(.*?)>(.*?)</script>#is', '', $data);
}
add_filter( 'wp_insert_post_data', 'filter_handler', '99', 2 );