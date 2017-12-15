<?php

function learn_widgets_init() {
  register_sidebar( array(
    'name'          => esc_html__( 'Course Sidebar', 'learn' ),
    'id'            => 'sidebar-course',        
    'description'   => esc_html__( 'Appears in the sidebar section of the courses.', 'learn' ),        
    'before_widget' => '<div id="%1$s" class="widget %2$s">',        
    'after_widget'  => '</div>',        
    'before_title'  => '<h4 class="widget_title">',        
    'after_title'   => '</h4>'
    ) );
  register_sidebar( array(
    'name'          => esc_html__( 'Lesson Widget', 'learn' ),
    'id'            => 'lesson-widget',        
    'description'   => esc_html__( 'Appears in the sidebar section of the courses.', 'learn' ),        
    'before_widget' => '<div id="%1$s" class="widget %2$s">',        
    'after_widget'  => '</div>',        
    'before_title'  => '<h4 class="widget_title">',        
    'after_title'   => '</h4>'
    ) ); 
}
add_action( 'widgets_init', 'learn_widgets_init' );

//Get search courses
function learn_template_chooser_course($template)   
{    
  global $wp_query;   
  $post_type = get_query_var('post_type');   
  if( $wp_query->is_search && $post_type == 'course' )   
  {
    return locate_template('course-search.php');  //  redirect to archive-search.php
  }   
  return $template;   
}
add_filter('template_include', 'learn_template_chooser_course');

/*Add extra fields for user*/
add_action( 'show_user_profile', 'learn_add_extra_social_links' );
add_action( 'edit_user_profile', 'learn_add_extra_social_links' );

function learn_add_extra_social_links( $user )
{
    ?>
        <h3><?php esc_html_e('Extra Info User', 'learn'); ?></h3>

        <table class="form-table">
            <tr>
                <th><label for="phone_profile"><?php esc_html_e('Phone Number', 'learn'); ?></label></th>
                <td><input type="text" name="phone_profile" value="<?php echo esc_attr(get_the_author_meta( 'phone_profile', $user->ID )); ?>" class="regular-text" /></td>
            </tr>
            <tr>
                <th><label for="facebook_profile"><?php esc_html_e('Facebook', 'learn'); ?></label></th>
                <td><input type="text" name="facebook_profile" value="<?php echo esc_attr(get_the_author_meta( 'facebook_profile', $user->ID )); ?>" class="regular-text" /></td>
            </tr>

            <tr>
                <th><label for="twitter_profile"><?php esc_html_e('Twitter', 'learn'); ?></label></th>
                <td><input type="text" name="twitter_profile" value="<?php echo esc_attr(get_the_author_meta( 'twitter_profile', $user->ID )); ?>" class="regular-text" /></td>
            </tr>

            <tr>
                <th><label for="google_profile"><?php esc_html_e('Google+', 'learn'); ?></label></th>
                <td><input type="text" name="google_profile" value="<?php echo esc_attr(get_the_author_meta( 'google_profile', $user->ID )); ?>" class="regular-text" /></td>
            </tr>
        </table>
    <?php
}

add_action( 'personal_options_update', 'learn_save_extra_social_links' );
add_action( 'edit_user_profile_update', 'learn_save_extra_social_links' );

function learn_save_extra_social_links( $user_id )
{
    update_user_meta( $user_id,'phone_profile', sanitize_text_field( $_POST['phone_profile'] ) );
    update_user_meta( $user_id,'facebook_profile', sanitize_text_field( $_POST['facebook_profile'] ) );
    update_user_meta( $user_id,'twitter_profile', sanitize_text_field( $_POST['twitter_profile'] ) );
    update_user_meta( $user_id,'google_profile', sanitize_text_field( $_POST['google_profile'] ) );
}


/** Custom theme option post excerpt **/
function learn_excerpt() {

  if(learn_theme_option('excerpt_length')){
    $limit = learn_theme_option('excerpt_length');
  }else{
    $limit = 15;
  }
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  }
  $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
  return $excerpt;
}

/** Excerpt Section Blog Post **/
function learn_blog_excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  }
  $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
  return $excerpt;
}


/*Breadcrumbs*/
function learn_breadcrumbs() {
    $text['home']     = esc_html__('Home', 'learn'); // text for the 'Home' link
    $text['category'] = '%s'; // text for a category page
    $text['tax']      = '%s'; // text for a taxonomy page
    $text['search']   = '%s'; // text for a search results page
    $text['tag']      = '%s'; // text for a tag page
    $text['author']   = '%s'; // text for an author page
    $text['404']      = '404'; // text for the 404 page
 
    $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
    $showOnHome  = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
    $delimiter   = ''; // delimiter between crumbs
    $before      = '<li class="active">'; // tag before the current crumb
    $after       = '</li>'; // tag after the current crumb
    
 
    global $post;
    $homeLink = home_url('/') . '';
    $linkBefore = '<li>';
    $linkAfter = '</li>';
    $linkAttr = ' rel="v:url" property="v:title"';
    $link = $linkBefore . '<a' . $linkAttr . ' href="%1$s">%2$s</a>' . $linkAfter;
 
    if (is_home() || is_front_page()) {
 
        if ($showOnHome == 1) echo '<div id="crumbs"><a href="' . esc_url($homeLink) . '">' . $text['home'] . '</a></div>';
 
    } else {
 
        echo '<ol class="breadcrumb">' . sprintf($link, esc_url($homeLink), $text['home']) . $delimiter;
 
        
        if ( is_category() ) {
            $thisCat = get_category(get_query_var('cat'), false);
            if ($thisCat->parent != 0) {
                $cats = get_category_parents($thisCat->parent, TRUE, $delimiter);
                $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
                $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
                echo htmlspecialchars_decode( $cats );
            }
            echo htmlspecialchars_decode( $before ) . sprintf($text['category'], single_cat_title('', false)) . htmlspecialchars_decode( $after );
 
        } elseif( is_tax() ){
            $thisCat = get_category(get_query_var('cat'), false);
            if ($thisCat->parent != 0) {
                $cats = get_category_parents($thisCat->parent, TRUE, $delimiter);
                $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
                $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
                echo htmlspecialchars_decode( $cats );
            }
            echo htmlspecialchars_decode( $before ) . sprintf($text['tax'], single_cat_title('', false)) . htmlspecialchars_decode( $after );
        
        }elseif ( is_search() ) {
            echo htmlspecialchars_decode( $before ) . sprintf($text['search'], get_search_query()) . htmlspecialchars_decode( $after );
 
        } elseif ( is_day() ) {
            echo sprintf($link, esc_url(get_year_link(get_the_time('Y'))), get_the_time('Y')) . $delimiter;
            echo sprintf($link, esc_url(get_month_link(get_the_time('Y'),get_the_time('m'))), get_the_time('F')) . $delimiter;
            echo htmlspecialchars_decode( $before ) . get_the_time('d') . htmlspecialchars_decode( $after );
 
        } elseif ( is_month() ) {
            echo sprintf($link, esc_url(get_year_link(get_the_time('Y'))), get_the_time('Y')) . $delimiter;
            echo htmlspecialchars_decode( $before ) . get_the_time('F') . htmlspecialchars_decode( $after );
 
        } elseif ( is_year() ) {
            echo htmlspecialchars_decode( $before ) . get_the_time('Y') . htmlspecialchars_decode( $after );
 
        } elseif ( is_single() && !is_attachment() ) {
            if ( get_post_type() != 'post' ) {
                $post_type = get_post_type_object(get_post_type());
                $slug = $post_type->rewrite;
                if ( get_post_type() == 'course' || get_post_type() == 'lesson' ) {
                 printf(''); //Translate breadcrumb.
             }else{
              printf($link, esc_url($homeLink) . '/' . $slug['slug'] . '/', $post_type->labels->singular_name);
             }
                if ($showCurrent == 1) echo htmlspecialchars_decode( $delimiter ) . $before . get_the_title() . $after;
            } else {
                $cat = get_the_category(); $cat = $cat[0];
                $cats = get_category_parents($cat, TRUE, $delimiter);
                if ($showCurrent == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
                $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
                $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
                echo htmlspecialchars_decode( $cats );
                if ($showCurrent == 1) echo htmlspecialchars_decode( $before ) . get_the_title() . $after;
            }
 
        } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
            $post_type = get_post_type_object(get_post_type());
            echo htmlspecialchars_decode( $before ) . $post_type->labels->singular_name . htmlspecialchars_decode( $after );
 
        } elseif ( is_attachment() ) {
            $parent = get_post($post->post_parent);
            $cat = get_the_category($parent->ID); $cat = $cat[0];
            $cats = get_category_parents($cat, TRUE, $delimiter);
            $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
            $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
            echo htmlspecialchars_decode( $cats );
            printf($link, esc_url(get_permalink($parent)), $parent->post_title);
            if ($showCurrent == 1) echo htmlspecialchars_decode( $delimiter ) . $before . get_the_title() . $after;
 
        } elseif ( is_page() && !$post->post_parent ) {
            if ($showCurrent == 1) echo htmlspecialchars_decode( $before ) . get_the_title() . $after;
 
        } elseif ( is_page() && $post->post_parent ) {
            $parent_id  = $post->post_parent;
            $breadcrumbs = array();
            while ($parent_id) {
                $page = get_page($parent_id);
                $breadcrumbs[] = sprintf($link, esc_url(get_permalink($page->ID)), get_the_title($page->ID));
                $parent_id  = $page->post_parent;
            }
            $breadcrumbs = array_reverse($breadcrumbs);
            for ($i = 0; $i < count($breadcrumbs); $i++) {
                echo htmlspecialchars_decode( $breadcrumbs[$i] );
                if ($i != count($breadcrumbs)-1) echo htmlspecialchars_decode( $delimiter );
            }
            if ($showCurrent == 1) echo htmlspecialchars_decode( $delimiter ) . $before . get_the_title() . $after;
 
        } elseif ( is_tag() ) {
            echo htmlspecialchars_decode( $before ) . sprintf($text['tag'], single_tag_title('', false)) . $after;
 
        } elseif ( is_author() ) {
             global $author;
            $userdata = get_userdata($author);
            echo htmlspecialchars_decode( $before ) . sprintf($text['author'], $userdata->display_name) . $after;
 
        } elseif ( is_404() ) {
            echo htmlspecialchars_decode( $before ) . $text['404'] . $after;
        }
 
        if ( get_query_var('paged') ) {
            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() );
            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() );
        }
 
        echo '</ol>';
 
    }
}

//pagination
function learn_pagination($prev = '<i class="fa fa-angle-double-left"></i>', $next = '<i class="fa fa-angle-double-right"></i>', $pages='') {
    global $wp_query, $wp_rewrite;
    $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
    if($pages==''){
        global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
    }
    $pagination = array(
      'base'      => str_replace( 999999999, '%#%', get_pagenum_link( 999999999 ) ),
      'format'    => '',
      'current'   => max( 1, get_query_var('paged') ),
      'total'     => $pages,		
      'type'      => 'list',
      'prev_text' => $prev,
      'next_text' => $next,
      'end_size'  => 3,
      'mid_size'  => 3
    );
    $return =  paginate_links( $pagination );
	echo str_replace( "<ul class='page-numbers'>", '', $return );
}

/* Custom comment List: */
function learn_theme_comment($comment, $args, $depth) {    
   $GLOBALS['comment'] = $comment; 
   $rate               = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) ); ?>
    <li>
      <div class="comment-body" id="comment-<?php comment_ID(); ?>">

        <div><?php echo get_avatar($comment,$size='80',$default='http://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536' ); ?></div>
        <div class="comment_right clearfix">
          <div class="comment_info">
            <?php printf(esc_html__('%s','learn'), get_comment_author()) ?><span>|</span> <?php the_time( get_option( 'date_format' ) ); ?> <span>|</span><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
            <?php if ( is_singular( 'course' ) ) {  ?>
            <?php if($rate) { ?>
            <div class="rating">
              <?php
              for ( $i = 1; $i <= 5; $i ++ ) {
               if ( $i <= $rate ) {
                echo '<i class="fa fa-star"></i>';
               } else {
                echo '<i class="fa fa-star-o"></i>';
               }
              }
              ?>
            </div><!-- end rating -->
            <?php } } ?>
          </div>          
          <?php if ($comment->comment_approved == '0'){ ?>
              <p><em><?php esc_html_e('Your comment is awaiting moderation.','learn') ?></em></p>
          <?php }else{ ?>
              <?php comment_text() ?>
          <?php } ?>
        </div>
        
      </div>
    </li>
   
<?php
}


function learn_lesson_length(){
	
    global $post;
    $course_id = $post->ID;
   	$course_lessons = Sensei()->course->course_lessons( $course_id );
   	$lesson_length = 0;
	if (count($course_lessons) > 0) {

        foreach ($course_lessons as $lesson) {
            $lesson_length += intval(get_post_meta( $lesson->ID, '_lesson_length', true ));
  		}
    }
    return $lesson_length;
}

/*Add progress course*/
function learn_add_progress_actions(){

	if( empty( $course_id ) ){
        global $post;
        $course_id = $post->ID;
    }

    if( empty( $user_id ) ){
        $user_id = get_current_user_id();
    }

    echo '<span class="progress statement  course-completion-rate">' . Sensei()->course->get_progress_statement( $course_id, $user_id  ) . '</span>';

	if( 'course' != get_post_type( $course_id ) || ! get_userdata( $user_id )
	    || ! WooThemes_Sensei_Utils::user_started_course( $course_id ,$user_id ) ){
	    return;
	}
	$percentage_completed = Sensei()->course->get_completion_percentage( $course_id, $user_id );

	echo Sensei()->course->get_progress_meter( $percentage_completed ).'<i class="icon-trophy"></i><hr>';
}

add_action( 'learn_course_single_meta', 'learn_add_progress_actions', 20 );

/*Add button cart*/
function learn_add_btncart_actions(){

	Sensei_Templates::get_template( 'woocommerce/add-to-cart.php' );
}

add_action( 'learn_course_single_btncart', 'learn_add_btncart_actions', 20 );


/**
 * Enables the comments in Course edit screen.
 */
function learn_add_comments_support_for_course() {
	add_post_type_support( 'course', 'comments' );
}
add_action( 'init', 'learn_add_comments_support_for_course' );


/**
 * Rating field for comments.
 *
 * @param int $comment_id
 */
function learn_add_comment_rating( $comment_id ) {
 if ( isset( $_POST['rating'] ) && 'course' === get_post_type( $_POST['comment_post_ID'] ) ) {
  if ( ! $_POST['rating'] || $_POST['rating'] > 5 || $_POST['rating'] < 0 ) {
   return;
  }
  add_comment_meta( $comment_id, 'rating', (int) esc_attr( $_POST['rating'] ), true );
 }
}

add_action( 'comment_post', 'learn_add_comment_rating', 1 );


/**
 * Custom fields comment form
 *
 * @since  1.0
 *
 * @return  array  $fields
 */

add_filter( 'comment_form_logged_in', 'learn_comment_form_logged_in', 10, 3 );

function learn_comment_form_logged_in( $logged_in_as, $commenter, $user_identity ) {
	if ( is_singular( 'course' ) ) {
		$commenter['rating'] = '<p class="comment-form-rating">' .
							   '<span class="stars"><a class="star-1" href="#">1</a><a class="star-2" href="#">2</a><a class="star-3" href="#">3</a><a class="star-4" href="#">4</a><a class="star-5" href="#">5</a></span>' .
							   '<select name="rating" id="rating" style="display: none;">' .
							   '<option value="">' . esc_html__( 'Rate...', 'learn' ) . '</option>' .
							   '<option value="5">' . esc_html__( 'Perfect', 'learn' ) . '</option>' .
							   '<option value="4">' . esc_html__( 'Good', 'learn' ) . '</option>' .
							   '<option value="3">' . esc_html__( 'Average', 'learn' ) . '</option>' .
							   '<option value="2">' . esc_html__( 'Not that bad', 'learn' ) . '</option>' .
							   '<option value="1">' . esc_html__( 'Very poor', 'learn' ) . '</option>' .
							   '</select></p>';
						   
		return $logged_in_as . $commenter['rating'];
	}else{
		return $logged_in_as;
	}
}


/**
 * Retrieves related product terms
 *
 * @param string $term
 * @return array
 */
function learn_get_related_terms($term, $post_id = null) {
 $post_id = $post_id ? $post_id : get_the_ID();
 $terms_array = array(0);

 $terms = wp_get_post_terms($post_id, $term);
 foreach( $terms as $term ) {
  $terms_array[] = $term->term_id;
 }

 return array_map('absint', $terms_array);
}

function learn_get_rating_course($post_id = null) {
 $post_id = $post_id ? $post_id : get_the_ID();

 $args = array(
 		'status' => 'approve',
		'post_id' => $post_id, // use post_id, not post_ID
	);
	$comments = get_comments($args);
	if($comments){
		$i=0;
		$rate = 0;
		foreach($comments as $comment){
			$rate += intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );
			if($rate > 0){
				$i++;
			}
		}
	}
	if( isset( $rate ) ){
		if($rate > 0){ $rates = $rate/$i; }
			     						
		$rates2 = $rates + 0.5;
		$rates3 = $rates + 0.25;
		for ( $j = 1; $j <= 5; $j ++ ) {
			if ( $j <= $rates || $j <= $rates3 ) {
				echo '<i class="icon-star"></i>';
				}elseif( $j <= $rates2 ) {
				echo '<i class="icon-star-half-alt"></i>';
				} else {
				echo '<i class="icon-star-empty"></i>';
			}
		}
	}

}
?>