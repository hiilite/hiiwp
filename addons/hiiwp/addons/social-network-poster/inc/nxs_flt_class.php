<?php

class nxs_Filters {
    public static $posts;
    public static $posts_types;
    public static $post_formats;
    public static $taxonomies;
        
    public function __construct() {
        // add_action( 'init',                  array( __CLASS__, 'create_filter' ) );
        // add_action( 'save_post',             array( __CLASS__, 'save_filter' ) );
        add_action( 'admin_head',            array( __CLASS__, 'init' ) ); 
        add_action( 'admin_enqueue_scripts', array( __CLASS__, 'enqueue' ) );
    }
    
    public static function init($od=false) { 
        if (function_exists('get_current_screen')) $screen = get_current_screen(); else $od=true; //prr($screen->id );// prr($screen); var_dump($od);        toplevel_page_NextScripts_SNAP-network
        
        if($od || ( !empty($screen) && ( $screen->id == 'toplevel_page_nxssnap' || $screen->id=='settings_page_NextScripts_SNAP' || $screen->id =='toplevel_page_NextScripts_SNAP-network' || $screen->id == 'snapautoposter_page_nxssnap-settings' || $screen->id == 'snap_page_nxssnap-reposter' || $screen->id == 'snapautoposter_page_nxssnap-reposter' || $screen->id == 'snapautoposter_page_nxssnap-accounts'))) { 
            $builtin_types     = get_post_types( array( 'public' => true, '_builtin' => true ) );
            $custom_types      = get_post_types( array( 'public' => true, '_builtin' => false ) );
            self::$posts_types = array_merge( $builtin_types, $custom_types ); natsort( self::$posts_types );
            
            $builtin_taxonomies       = get_taxonomies( array( 'public' => true, '_builtin' => true ) );
            $custom_taxonomies        = get_taxonomies( array( 'public' => true, '_builtin' => false ) );
            self::$taxonomies         = array_merge( $builtin_taxonomies, $custom_taxonomies ); natsort( self::$taxonomies );
            
            // self::$posts = get_posts( array( 'post_type' => self::$posts_types, 'numberposts' => -1, 'post_status' => 'any' ) ); prr(self::$posts); prr(self::$posts_types);  WTF?????? Retreiving all posts in init?????
            self::$post_formats = get_theme_support( 'post-formats' ); // prr(self::$post_formats);
        }
    }
    
    public static function showEdit($pg) {    
        add_meta_box( 'nxs_title_metabox', __( 'Title and Options', 'social-networks-auto-poster-facebook-twitter-g' ), array( __CLASS__, 'print_title_metabox' ), $pg, 'normal', 'high' );        
        add_meta_box( 'nxs_schedule_metabox', __( 'When to post (Schedule)', 'social-networks-auto-poster-facebook-twitter-g' ), array( __CLASS__, 'print_schedule_metabox' ), $pg, 'normal', 'high' );        
        add_meta_box( 'nxs_network_metabox', __( 'Where to post (Network Selection)', 'social-networks-auto-poster-facebook-twitter-g' ), array( __CLASS__, 'print_networks_metabox' ), $pg, 'normal', 'high' );
        add_meta_box( 'nxs_posts_metabox', __( 'What to post (Posts, Pages, etc.. selection)', 'social-networks-auto-poster-facebook-twitter-g' ), array( __CLASS__, 'print_posts_metabox' ), $pg, 'normal', 'high' );        
    }
    
    public static function enqueue() {
        if (function_exists('get_current_screen')) $screen = get_current_screen(); else return; // prr($screen->id);        
        if( $screen->id == 'nxs_filter' || $screen->id=='toplevel_page_nxssnap' || $screen->id == 'snapautoposter_page_nxssnap-accounts' || $screen->id =='toplevel_page_NextScripts_SNAP-network' || $screen->id == 'snapautoposter_page_nxssnap-settings' || $screen->id == 'snap_page_nxssnap-reposter' || $screen->id == 'snapautoposter_page_nxssnap-reposter') { 
            //## Push some data to JS //?? Check why we need it    
            $data = array( 
                'list_select_ids' => array(
                    'nxs_name_post',
                    'nxs_name_page',
                    'nxs_name_parent',
                    'nxs_post_status',
                    'nxs_post_type',
                    'nxs_post_formats',
                    'nxs_tags_names',
                    'nxs_cats_names',
                    'nxs_user_names',
                    'nxs_pagination',
                    'nxs_sticky_post',
                    'nxs_order',
                    'nxs_order_by',
                    'nxs_meta_value',
                    'nxs_meta_key',
                    'nxs_meta_operator',
                    'nxs_meta_type',
                    'nxs_permission',
                    'nxs_cache_results',
                    'nxs_cache_meta',
                    'nxs_cache_term',
                    'nxs_meta_relation',
                    'nxs_term_names',
                    'nxs_tax_names',
                    'nxs_term_operator',                    
                    'nxs_term_relation',                    
                    'nxs_term_children',
                    'nxs_types_starting_abs_period',
                    'nxs_types_end_abs_period' ),
                
                'list_input_ids' => array(
                    'nxs_starting_period',
                    'nxs_end_period'
                )
            );
            wp_localize_script( 'jquery', 'nxs', $data );
        }
    }
    
    public static function create_filter() { 
        $labels = array(
            'name'               => __( 'Filters',                    'social-networks-auto-poster-facebook-twitter-g' ), 
            'singular_name'      => __( 'Filter',                     'social-networks-auto-poster-facebook-twitter-g' ),
            'add_new'            => __( 'Add Filter',            'social-networks-auto-poster-facebook-twitter-g' ),
            'add_new_item'       => __( 'Add new Filter',      'social-networks-auto-poster-facebook-twitter-g' ),
            'edit_item'          => __( 'Edit Filter',       'social-networks-auto-poster-facebook-twitter-g' ),
            'new_item'           => __( 'New Filter',              'social-networks-auto-poster-facebook-twitter-g' ),
            'view_item'          => __( 'View Filter',           'social-networks-auto-poster-facebook-twitter-g' ),
            'search_items'       => __( 'Find Filters',             'social-networks-auto-poster-facebook-twitter-g' ),
            'not_found'          => __( 'Filter not found',           'social-networks-auto-poster-facebook-twitter-g' ),
            'not_found_in_trash' => __( 'Filter not found in trash', 'social-networks-auto-poster-facebook-twitter-g' ),
            'menu_name'          => __( 'Filters',                    'social-networks-auto-poster-facebook-twitter-g' )
        );
        
        $args = array(
            'labels'    => $labels,
            'show_ui'   => false,
            'menu_icon' => 'dashicons-forms',
            'supports'  => array( 'title' ),
            'show_in_menu' => 'admin.php?page=nxssnap-reposter2',
            'capabilities' => array(
          //       'create_posts' => false, // Removes support for the "Add New" function
            )
            
        );
        
        register_post_type( 'nxs_filter', $args );
    }

    public static function save_filter( $post_id ) {
        if ( !isset( $_POST['nxs_metabox_nonce'] ) || !wp_verify_nonce( $_POST['nxs_metabox_nonce'], basename( __FILE__ ) ) ) return $post_id;
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return $post_id;
        if ( !current_user_can( 'edit_post', $post_id ) ) return $post_id;
        
        //## Add New Cats and Tags        
        if (!empty($_POST['nxs_cats_names'])) { $toIns = array(); $nCats = array(); 
            $cats = get_categories(array('hide_empty'=>false));  if($cats) foreach($cats as $cat) $nCats[] = $cat->term_id;
            foreach ($_POST['nxs_cats_names'] as $ctp) { //prr($ctp);
                if (!in_array($ctp, $nCats)) { $ctp = wp_insert_term( $ctp, 'category'); if (!is_wp_error($ctp)) $ctp = $ctp['term_id']; else continue; } $toIns[] = $ctp;
            } $_POST['nxs_cats_names'] = $toIns;// prr($toIns);
        } 
        if (!empty($_POST['nxs_tags_names'])) { $nTags = array(); $toIns = array(); 
            $tags = get_tags( array( 'hide_empty' => false ) ); if($tags) foreach($tags as $tag) $nTags[] = $tag->term_id;
            foreach ($_POST['nxs_tags_names'] as $ctp) { // prr($ctp);
                if (!in_array($ctp, $nTags))  { $ctp = wp_insert_term( $ctp, 'post_tag'); if (!is_wp_error($ctp)) $ctp = $ctp['term_id']; else continue; } $toIns[] = $ctp;
            } $_POST['nxs_tags_names'] = $toIns; // prr($toIns);
        } 
        

        if ( get_post_type( $post_id ) === 'nxs_filter' ) {
            $count_compares          = intval( $_POST['nxs_count_meta_compares'] );
            $count_term_compares     = intval( $_POST['nxs_count_term_compares'] );
            $count_date_periods      = intval( $_POST['nxs_count_date_periods'] );
            $count_date_abs_periods  = intval( $_POST['nxs_count_date_abs_periods'] );
            
            $settings = array( 'name_post', 'name_page', 'name_parent', 'post_status', 'post_type', 'post_formats', 'ie_tags_names', 'ie_cats_names', 'tags_names', 'cats_names', 'user_names', 'search_keywords', 'pagination', 'post_per_page', 'sticky_post', 'paged', 'post_per_archive_page', 'offset', 'order', 'order_by', 'year', 'month', 'day', 'hour', 'minute', 'second', 'meta_key', 'meta_value', 'meta_operator', 'meta_type', 'permission', 'cache_results', 'cache_meta', 'cache_term', 'count_compares', 'meta_relation', 'term_children', 'term_operator', 'term_names', 'tax_names', 'term_relation', 'count_term_compares', 'starting_period', 'end_period', 'inclusive', 'count_date_periods', 'count_date_abs_periods', 'starting_abs_period', 'end_abs_period', 'types_starting_abs_period', 'types_end_abs_period', 'NPNts' );
            
            if( $count_compares > 1 ) {
                for( $i = 2; $i <= $count_compares; $i++ ) {
                    $settings[] = 'meta_key_' .$i; 
                    $settings[] = 'meta_value_' .$i; 
                    $settings[] = 'meta_operator_' .$i; 
                    $settings[] = 'meta_type_' .$i; 
                }
            }
            
            if( $count_term_compares > 1 ) {
                for( $j = 2; $j <= $count_term_compares; $j++ ) {
                    $settings[] = 'term_children_' .$j; 
                    $settings[] = 'term_operator_' .$j; 
                    $settings[] = 'term_names_' .$j; 
                    $settings[] = 'tax_names_' .$j; 
                }
            }
            
            if( $count_date_periods > 1 ) {
                for( $k = 2; $k <= $count_date_periods; $k++ ) {
                    $settings[] = 'starting_period_' .$k;
                    $settings[] = 'end_period_' .$k; 
                    $settings[] = 'inclusive_' .$k; 
                }
            }
            
            if( $count_date_abs_periods > 1 ) {
                for( $l = 2; $l <= $count_date_abs_periods; $l++ ) {
                    $settings[] = 'starting_abs_period_' .$l;
                    $settings[] = 'end_abs_period_' .$l;
                    $settings[] = 'types_starting_abs_period_' .$l;
                    $settings[] = 'types_end_abs_period_' .$l;
                }
            }
            // echo "-= 0 =-"; prr($_POST['nxsNPNts']);
            //##  
            $ntOpts = array(); foreach ($_POST['nxs_NPNts'] as $ntC){ $ntA = explode('--',$ntC); $ntOpts[$ntA[0]][$ntA[1]] = 1; }$_POST['nxs_NPNts'] = $ntOpts; //prr($ntOpts);
            //## Save reposter 
            $setToSave = array(); foreach( $settings as $setting ) { $full_setting_name = 'nxs_'. $setting; 
              // if( isset( $_POST[$full_setting_name] ) ) $setToSave[$full_setting_name] = $_POST[$full_setting_name]; else $setToSave[$full_setting_name] = '';
              if( !empty( $_POST[$full_setting_name] ) ) $setToSave[$full_setting_name] = $_POST[$full_setting_name];
            } self::save_meta( $post_id, 'nxs_rpstr_data', $setToSave ); //  echo "-= 1 =-";  prr($setToSave);
            
            /*
            
            foreach( $settings as $setting ) { 
                $full_setting_name = 'nxs_'. $setting; // echo " || ".$full_setting_name;
                if( isset( $_POST[$full_setting_name] ) )
                    self::save_meta( $post_id, $full_setting_name, $_POST[$full_setting_name] );
                else
                    self::save_meta( $post_id, $full_setting_name, '' );
            }       
            */ 
        }
        
        return $post_id;
    }
    
    public static function save_schinfo( $post_id ) {  
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return $post_id;  if ( !current_user_can( 'edit_post', $post_id ) ) return $post_id;        
        $optionsii = maybe_unserialize(get_post_meta( $post_id, 'nxs_rpstr', true )); $pval = $_POST['nxs_rpstr'];
    
        if (empty($optionsii['rpstDays'])) $optionsii['rpstDays'] = 0; if (empty($optionsii['rpstHrs'])) $optionsii['rpstHrs'] = 0; if (empty($optionsii['rpstMins'])) $optionsii['rpstMins'] = 0;
        $rpstEvrySecEx = $optionsii['rpstDays']*86400+$optionsii['rpstHrs']*3600+$optionsii['rpstMins']*60; $isRpstWasOn = isset($optionsii['rpstOn']) && $optionsii['rpstOn']=='1';
    
        if (isset($pval['rpstOn']))    $optionsii['rpstOn'] = $pval['rpstOn']; else $optionsii['rpstOn'] = 0;
    
        if (isset($pval['rpstDays']))  $optionsii['rpstDays'] = trim($pval['rpstDays']);       
        if (isset($pval['rpstHrs']))   $optionsii['rpstHrs'] = trim($pval['rpstHrs']);     if ((int)$optionsii['rpstHrs']>23) $optionsii['rpstHrs'] = 23;
        if (isset($pval['rpstMins']))  $optionsii['rpstMins'] = trim($pval['rpstMins']);   if ((int)$optionsii['rpstMins']>59) $optionsii['rpstMins'] = 59;    
        if (isset($pval['rpstRndMins']))  $optionsii['rpstRndMins'] = trim($pval['rpstRndMins']);       
        if (isset($pval['rpstPostIncl']))  $optionsii['rpstPostIncl'] = trim($pval['rpstPostIncl']);     
    
        if (isset($pval['rpstStop']))  $optionsii['rpstStop'] = trim($pval['rpstStop']); else $optionsii['rpstStop'] = 'O';           
    
        $rpstEvrySecNew = $optionsii['rpstDays']*86400+$optionsii['rpstHrs']*3600+$optionsii['rpstMins']*60;
        $rpstRNDSecs = isset($optionsii['rpstRndMins'])?$optionsii['rpstRndMins']*60:0; if ($rpstRNDSecs>$rpstEvrySecNew) $optionsii['rpstRndMins'] = 0;
    
        if ($optionsii['rpstOn']=='1' && ($rpstEvrySecNew!=$rpstEvrySecEx || !$isRpstWasOn)) { global $wpdb; 
            $currTime = time() + ( get_option( 'gmt_offset' ) * HOUR_IN_SECONDS ); $optionsii['rpstNxTime'] = $currTime + $rpstEvrySecNew; 
            $dbItem = array('datecreated'=>date_i18n('Y-m-d H:i:s'), 'type'=>'R', 'postid'=>$post_id, 'nttype'=>'', 'refid'=>'', 'timetorun'=> date_i18n('Y-m-d H:i:s',$optionsii['rpstNxTime']), 'extInfo'=>'', 'descr'=> 'Reposter ID:('.$post_id.')'); 
            $wpdb->delete( $wpdb->prefix . "nxs_query", array( 'postid' => $post_id ) );
            $nxDB = $wpdb->insert( $wpdb->prefix . "nxs_query", $dbItem );  $lid = $wpdb->insert_id;    //       prr($lid); die();  
        }
        if (empty($optionsii['rpstOn'])) { global $wpdb; $wpdb->delete( $wpdb->prefix . "nxs_query", array( 'postid' => $post_id ) );}
        
        if (isset($pval['rpstType']))  $optionsii['rpstType'] = trim($pval['rpstType']);       
        if (isset($pval['rpstTimeType']))  $optionsii['rpstTimeType'] = trim($pval['rpstTimeType']);       
        if (isset($pval['rpstFromTime']))  $optionsii['rpstFromTime'] = trim($pval['rpstFromTime']);       
        if (isset($pval['rpstToTime']))  $optionsii['rpstToTime'] = trim($pval['rpstToTime']);       
        if (isset($pval['rpstOLDays']))  $optionsii['rpstOLDays'] = trim($pval['rpstOLDays']);       
        if (isset($pval['rpstNWDays']))  $optionsii['rpstNWDays'] = trim($pval['rpstNWDays']);       
        if (isset($pval['rpstOnlyPUP']))  $optionsii['rpstOnlyPUP'] = trim($pval['rpstOnlyPUP']); else $optionsii['rpstOnlyPUP'] = 0;        
        
        self::save_meta( $post_id, 'nxs_rpstr', $optionsii );        
       
    }

    
    public static function print_title_metabox( $current_post ) {  
      $grOptions = (!empty($current_post))?maybe_unserialize(get_post_meta( $current_post->ID, 'nxs_rpstr_data', true )):''; 
      if (!empty($grOptions)) { $ids = get_posts_ids_by_filter($grOptions); $pCnt = count($ids); }
      $options = (!empty($current_post))?maybe_unserialize(get_post_meta( $current_post->ID, 'nxs_rpstr', true )):''; 
      
    if (!empty($grOptions)) { ?> <h3 style="float: right; margin: 0px; text-align: right; color: #0A3A96"><?php _e('Total posts included in this Reposter:', 'social-networks-auto-poster-facebook-twitter-g'); ?> <?php echo $pCnt; ?></h3> <?php } ?> 
    
    <input value="1"  id="riC<?php echo $ii; ?>" <?php if (isset($options['rpstOn']) && trim($options['rpstOn'])=='1') echo "checked"; ?> type="checkbox" name="nxs_rpstr[rpstOn]"/> 
       <b><?php _e('Activate this Reposter Action', 'social-networks-auto-poster-facebook-twitter-g'); ?> </b> <br />
    <br />
    
    
    <h4 style=" margin: 0px;float: left;"> <?php _e( 'Reposter Action Title:', 'social-networks-auto-poster-facebook-twitter-g' ); ?></h4> 
    
    
    
    <div id="titlediv"><div id="titlewrap"><label class="screen-reader-text" id="title-prompt-text" for="title">Enter title here</label>
      <input type="text" name="post_title" size="30" value="<?php echo (!empty($current_post))?$current_post->post_title:''; ?>" id="title" autocomplete="off">
    </div></div><br/>
    
    
    
    <b style="font-size: 15px;vertical-align: middle;"><?php _e('Get posts:', 'social-networks-auto-poster-facebook-twitter-g'); ?></b>
       <select id="riS<?php echo $nt; ?><?php echo $ii; ?>" name="nxs_rpstr[rpstType]" onchange="nxs_actDeActTurnOff(jQuery(this).attr('id'));"><?php if (function_exists('nxs_doSMAS42')) nxs_doSMAS42($options); ?>        
        <option value="2" <?php  if (isset($options['rpstType']) && $options['rpstType']=='2') echo 'selected="selected"' ?>>One By One - Old to New</option><option value="3" <?php if (isset($options['rpstType']) && $options['rpstType']=='3') echo 'selected="selected"' ?>>One By One - New to Old</option>
        </select> 
      
      
      <input value="1"  id="riOC<?php echo $ii; ?>" <?php if (isset($options['rpstOnlyPUP']) && trim($options['rpstOnlyPUP'])=='1') echo "checked"; ?> type="checkbox" name="nxs_rpstr[rpstOnlyPUP]"/> 
       <b><?php _e('Repost ONLY previously unautoposted posts', 'social-networks-auto-poster-facebook-twitter-g'); ?></b> <br/>
       
    
      <?php if (!empty($current_post)) { ?> 
        <div style="margin-top: 15px"> <input type="button" id="svBtn" onclick="nxs_svRep('<?php echo $current_post->ID; ?>')" class="button-primary" value="Save Reposter" /> </div> 
      <?php } ?>
      
    <?php } 
    public static function print_schedule_metabox( $current_post ) { ?>
   
   <?php $cr = get_option('NXS_cronCheck'); if (!empty($cr) && is_array($cr) && isset($cr['status']) && $cr['status']=='0') { 
      global $nxs_SNAP; if (!isset($nxs_SNAP)) return; $gOptions = $nxs_SNAP->nxs_options; 
       if (isset($gOptions['forceBrokenCron']) && $gOptions['forceBrokenCron'] =='1') { ?> 
         <span style="color: red"> <?php _e('Your WP Cron is not working correctly. Auto Reposting service is active by force. <br/> This might cause problems. Please see the test results and recommendations', 'social-networks-auto-poster-facebook-twitter-g'); ?>
         &nbsp;-&nbsp;<a target="_blank" href="<?php global $nxs_snapThisPageUrl; echo $nxs_snapThisPageUrl; ?>&do=crtest">WP Cron Test Results</a></span>
        <?php } else { ?> <span style="color: red"> <?php _e('Auto Reposting service is Disabled. Your WP Cron is not working correctly. Please see the test results and recommendations', 'social-networks-auto-poster-facebook-twitter-g'); ?>
     &nbsp;-&nbsp;<a target="_blank" href="<?php global $nxs_snapThisPageUrl; echo $nxs_snapThisPageUrl; ?>&do=crtest">WP Cron Test Results</a></span>
   <?php return; } } ?>
   
   <?php $options = (!empty($current_post))?maybe_unserialize(get_post_meta( $current_post->ID, 'nxs_rpstr', true )):'';  ?>
   
   <div class="nxs_tls_bdX">          
       <b><?php _e('Repost existing post every:', 'social-networks-auto-poster-facebook-twitter-g'); ?> </b>               
     <input type="text" name="nxs_rpstr[rpstDays]" style="width: 35px;" value="<?php echo isset($options['rpstDays'])?$options['rpstDays']:'0'; ?>" />&nbsp;<?php _e('Days', 'social-networks-auto-poster-facebook-twitter-g'); ?>&nbsp;&nbsp;
     <input type="text" name="nxs_rpstr[rpstHrs]" style="width: 35px;" value="<?php echo isset($options['rpstHrs'])?$options['rpstHrs']:'2'; ?>" />&nbsp;<?php _e('Hours', 'social-networks-auto-poster-facebook-twitter-g'); ?>&nbsp;&nbsp;
     <input type="text" name="nxs_rpstr[rpstMins]" style="width: 35px;" value="<?php echo isset($options['rpstMins'])?$options['rpstMins']:'0'; ?>" />&nbsp;<?php _e('Minutes', 'social-networks-auto-poster-facebook-twitter-g'); ?>     
     
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
     <b><?php _e('Randomize posting time: &#177;', 'social-networks-auto-poster-facebook-twitter-g'); ?> </b>
     <input type="text" name="nxs_rpstr[rpstRndMins]" style="width: 35px;" value="<?php echo isset($options['rpstRndMins'])?$options['rpstRndMins']:'15'; ?>" onmouseout="hidePopShAtt('RPST1');" onmouseover="showPopShAtt('RPST1', event);" />&nbsp;<?php _e('Minutes', 'social-networks-auto-poster-facebook-twitter-g'); ?>
     <br/>         
     <?php if (function_exists('nxs_v4doSMAS41')) nxs_v4doSMAS41($options); 
     
     
     
     ?>     
     
      <div id="riS<?php echo $nt; ?><?php echo $ii; ?>xd"  style="padding-top: 5px; padding-left: 0px;<?php if (isset($options['rpstType']) && $options['rpstType']=='1') echo "display:none;"; ?>"><b><?php _e('Total Posts', 'social-networks-auto-poster-facebook-twitter-g'); ?>:</b> <?php echo $ii; ?>&nbsp;|&nbsp;<b><?php _e('Posted', 'social-networks-auto-poster-facebook-twitter-g'); ?>:</b> <?php echo $ii; ?>&nbsp;|&nbsp;<b><?php _e('To be Posted', 'social-networks-auto-poster-facebook-twitter-g'); ?>:</b> <?php echo $ii; ?>
      
      
      <b><?php _e('Start/Next Post:', 'social-networks-auto-poster-facebook-twitter-g'); ?> </b> <?php _e('You can set the specific time for the first/next post', 'social-networks-auto-poster-facebook-twitter-g'); ?>&nbsp;(<?php _e('Current server time is: ', 'social-networks-auto-poster-facebook-twitter-g'); echo date_i18n('Y-m-d H:i'); ?>)
     <div style="padding-left: 15px;">
     
     </div>
             
         
     <div id="riS<?php echo $nt; ?><?php echo $ii; ?>xd"  style="padding-top: 5px; padding-left: 0px;<?php if (isset($options['rpstType']) && $options['rpstType']=='1') echo "display:none;"; ?>"><b><?php _e('When finished', 'social-networks-auto-poster-facebook-twitter-g'); ?>:</b>       
         <input type="radio" name="nxs_rpstr[rpstStop]" value="O" <?php if (empty($options['rpstStop']) || (isset($options['rpstStop']) && trim($options['rpstStop'])=='O')) echo "checked"; ?>  /> <?php _e('Auto Turn Reposting Off', 'social-networks-auto-poster-facebook-twitter-g') ?>
         &nbsp;&nbsp;&nbsp;
         <input type="radio" name="nxs_rpstr[rpstStop]" value="W" <?php if (isset($options['rpstStop']) && trim($options['rpstStop'])=='W') echo 'checked="cheXcked"'; ?> /> <?php _e('Wait for new posts', 'social-networks-auto-poster-facebook-twitter-g') ?>
         &nbsp;&nbsp;&nbsp;
         <input type="radio" name="nxs_rpstr[rpstStop]" value="R" <?php if (isset($options['rpstStop']) && trim($options['rpstStop'])=='R') echo 'checked="cheTcked"'; ?> /> <?php _e('Loop it. Reset and Start from the begining', 'social-networks-auto-poster-facebook-twitter-g'); ?>
         </div>
     
     
      
      <?php 
      
      if (!empty($options)) {
      
         $currTime = time() + ( get_option( 'gmt_offset' ) * HOUR_IN_SECONDS );
      
        
      
      ?>
      <hr/> <?php _e('Current Wordpress Time:', 'social-networks-auto-poster-facebook-twitter-g'); ?> <?php echo date_i18n('Y-m-d H:i', $currTime); ?><br/>
      
      <?php if (!empty($options['rpstLastShTime']) && $options['rpstLastShTime']>0) { ?>
      <b><?php _e('Last post', 'social-networks-auto-poster-facebook-twitter-g'); ?></b>&nbsp;(ID:&nbsp;<?php echo !empty($options['rpstLastPostID'])?$options['rpstLastPostID']:''; ?>)&nbsp;<b><?php _e('was reposted on:', 'social-networks-auto-poster-facebook-twitter-g'); ?></b>&nbsp;<?php echo $options['rpstLastShTime']>0?date_i18n('Y-m-d H:i', $options['rpstLastShTime']):'Never'; 
      } ?>
        <b><?php _e('Next post will be ~', 'social-networks-auto-poster-facebook-twitter-g'); ?></b>&nbsp;<?php echo $options['rpstNxTime']>0?date_i18n('Y-m-d H:i', $options['rpstNxTime']):'Never'; ?> &lt;==
        <span class="nxsInstrSpan"><a href="#" onclick="nxs_setRpstAll('<?php echo $nt; ?>','X','<?php echo $ii; ?>'); return false;"><?php _e('[Reset to "Now"]', 'social-networks-auto-poster-facebook-twitter-g'); ?></a> </span>
     <br/>
     <b><?php _e('Set "Last reposted post ID" to:', 'social-networks-auto-poster-facebook-twitter-g'); ?>&nbsp;<input type="text" id="<?php echo $nt; ?><?php echo $ii; ?>SetLPID" style="width: 65px;" value="<?php echo !empty($options['rpstLastPostID'])?$options['rpstLastPostID']:''; ?>" />
     &nbsp;&nbsp;<span class="nxsInstrSpan"><a href="#" onclick="nxs_setRpstAll('<?php echo $nt; ?>','L','<?php echo $ii; ?>'); return false;"><?php _e('[Set]', 'social-networks-auto-poster-facebook-twitter-g'); ?></a> </span></b>
      
      <?php }?>
         
   </div>      
    <?php  }
    
    public static function print_networks_metabox( $cp ) { global $nxs_snapAvNts, $nxs_SNAP;  if (!isset($nxs_SNAP)) return; $networks = $nxs_SNAP->nxs_accts;  ?>
      <div style="float: right; font-size: 12px;" >
        <a href="#" onclick="jQuery('.nxsNPDoChb').attr('checked','checked'); return false;"><?php  _e('Check All', 'social-networks-auto-poster-facebook-twitter-g'); ?></a>&nbsp;<a href="#" onclick="jQuery('.nxsNPDoChb').removeAttr('checked'); return false;"><?php _e('Uncheck All', 'social-networks-auto-poster-facebook-twitter-g'); ?></a>
      </div>
      <div class="nxsNPRow" style="font-size: 12px;"> <?php 
        foreach ($nxs_snapAvNts as $avNt) { $clName = 'nxs_snapClass'.$avNt['code']; $ntClInst = new $clName();
          if ( isset($networks[$avNt['lcode']]) && count($networks[$avNt['lcode']])>0) { ?>                
            <div class="">
            <div class="nsx_iconedTitle" style="margin-bottom:1px;background-image:url(<?php echo NXS_PLURL;?>img/<?php echo $avNt['lcode']; ?>16.png);"><?php echo $avNt['name']; ?></div>
            <?php $ntOpts = $networks[$avNt['lcode']]; foreach ($ntOpts as $indx=>$pbo){                
              $savedMeta = (!empty($cp))?maybe_unserialize(get_post_meta( $cp->ID, 'nxs_rpstr_data', true )):''; //prr($savedMeta['nxs_NPNts']);
              if (!empty($cp) && !empty($savedMeta)){ $svdNTs=$savedMeta['nxs_NPNts']; $isCh=!empty($svdNTs)&&!empty($svdNTs[strtolower($avNt['code'])])&&(int)$svdNTs[strtolower($avNt['code'])] == 1; } 
                  else $isCh = (int)$pbo['do'.$avNt['code']] == 1;                  
              ?> 
              <div style="font-size: 12px; padding-left: 16px;" >
                <input class="nxsNPDoChb" value="<?php echo $avNt['lcode']; ?>--<?php echo $indx; ?>" name="nxs_NPNts[]" type="checkbox" <?php if ($isCh) echo "checked"; ?> />               
                <?php echo $avNt['name']; ?> <i style="color: #005800;"><?php if($pbo['nName']!='') echo "(".$pbo['nName'].")"; ?></i>
              </div>              
            <?php } ?></div><?php  
        } } ?> 
      </div>
    <?php }
    
    public static function print_posts_metabox( $current_post, $nt='', $ii='', $metaSettings='' ) { if (is_array($nt)) $nt = ''; $ntN = $nt.$ii;
        if (empty($ntN)) wp_nonce_field( basename( __FILE__ ), 'nxs_metabox_nonce' );
        
        //## Get saved Settinsg
        if (empty($metaSettings) && !empty( $current_post->ID)) $metaSettings = maybe_unserialize(get_post_meta( $current_post->ID, 'nxs_rpstr_data', true )); 
        /*
        echo '<h2>'. __( 'How to get posts', self::$plugin_name ) .'</h2><div class="nxsLftPad"></div>'; 
          
         ?> <span style="font-size: 13px;">&nbsp;&nbsp;&nbsp;<?php _e('Please note: All criterias are connected with "AND"', 'social-networks-auto-poster-facebook-twitter-g'); ?></span>           
        <?php     */
        //## Print Filter sections
        ?><div id="addCriNewPool"><?php        
             self::print_catsTags_section($current_post, $metaSettings, $nt, $ii);
             if (empty($ntN) && empty($metaSettings['fltrsOn'])){
               self::print_timeframe_section($current_post, $metaSettings, $nt, $ii);
               self::print_dates_section($current_post, $metaSettings, $nt, $ii);
             }
             
             self::print_types_section($current_post, $metaSettings, $nt, $ii);
             self::print_author_section($current_post, $metaSettings, $nt, $ii);
             if (empty($ntN) && empty($metaSettings['fltrsOn'])) self::print_postsPages_section($current_post, $metaSettings, $nt, $ii);
             if (function_exists('nxs_doSMAS7')) {
               self::print_search_section($current_post, $metaSettings, $nt, $ii);
               self::print_meta_section($current_post, $metaSettings, $nt, $ii);
               self::print_taxonomies_section($current_post, $metaSettings, $nt, $ii);
             } else { ?>
                 <div style="border: 2px dashed #ddd; border-radius: 3px; text-align: center; padding: 10px; margin-left: 40px; margin-right: 40px;"> <a href="http://www.nextscripts.com/social-networks-auto-poster-for-wp-multiple-accounts" target="_blank">SNAP Pro version</a> can also filter by Custom Fields, Custom Taxonomies, and Searches. Please see more here: <a href="http://www.nextscripts.com/snap-features/filters" target="_blank">Filters</a></div>
             <?php }
        ?></div><?php
    }   
    
    public static function makeInputName($name, $nt='', $ii='') { $name = 'nxs'.$name; $ntN = $nt.$ii;
        if (!empty($ntN)) return $nt.'['.$ii.']['.$name.']'; else return $name;
    }
    //## Sections
    public static function print_catsTags_section( $current_post, $metaSettings, $nt='', $ii='' ) { $ntN = $nt.$ii; // ## Categories and Tags        
        $isVis =  !empty($metaSettings['nxs_tags_names']) || !empty($metaSettings['nxs_cats_names']); //prr($metaSettings);
        echo '<h4 onclick="jQuery(\'#nxs_sec_catsTags'.$ntN.'\').toggle();"; style="cursor:pointer; background-image: url(\''.NXS_PLURL.'img/icons/tag24.png\');background-repeat: no-repeat; padding-top: 2px; padding-left: 28px; height:24px;" >'. 
          __( 'Categories and Tags', 'social-networks-auto-poster-facebook-twitter-g' ) .'&nbsp;&nbsp;&gt;&gt; </h4><div id="nxs_sec_catsTags'.$ntN.'" class="nxsLftPad" style="display:'.($isVis?'block':'none').';">';
        //## Get Tags and Cats from DB
        $cat_names = array(); $tags_names = array();  $tagsCnt = wp_count_terms('post_tag'); $catsCnt = wp_count_terms('category');
        if (empty($metaSettings['nxs_tags_names'])) $metaSettings['nxs_tags_names'] = array(); if (empty($metaSettings['nxs_cats_names'])) $metaSettings['nxs_cats_names'] = array(); 
        $tags = !empty($metaSettings["nxs_tags_names"])?get_tags( array( 'hide_empty' => false, 'include'=>implode(',',$metaSettings["nxs_tags_names"]), 'number'=>500 ) ):''; 
        $categories = !empty($metaSettings["nxs_cats_names"])?get_categories( array( 'hide_empty' => false, 'include'=>implode(',',$metaSettings["nxs_cats_names"]), 'number'=>500 ) ):''; 
        if( $tags ) foreach( $tags as $tag ) $tags_names[$tag->term_id] = $tag->name; natsort( $tags_names ); 
        if( $categories ) foreach( $categories as $category ) $cat_names[$category->term_id] = $category->name;  natsort( $cat_names );
        //## Checkboxes        
        $selTI = empty($metaSettings['nxs_ie_tags_names']) ? 'checked="checked"' : '';  $selCI = empty($metaSettings['nxs_ie_cats_names']) ? 'checked="checked"' : '';
        $selTE = $selTI=='' ? 'checked="checked"' : ''; $selCE = $selCI=='' ? 'checked="checked"' : '';
        
        //echo '<div><label class="field_title">'. __( 'Categories', 'social-networks-auto-poster-facebook-twitter-g' ) . '('.$catsCnt.'):</label>';
        echo '<div><label class="field_title">'. __( 'Categories', 'social-networks-auto-poster-facebook-twitter-g' ) . ':</label>';
        echo '&nbsp;<input type="radio" '.$selCI.' name="'.self::makeInputName('_ie_cats_names', $nt, $ii).'" value="0">Include (Post only with..)&nbsp;&nbsp;<input type="radio" '.$selCE.' name="'.self::makeInputName('_ie_cats_names', $nt, $ii).'" value="1">Exclude (Do not post ...)<br/>';
        self::print_select( (!empty( $current_post->ID))?$current_post->ID:0, $cat_names, 'nxs_cats_names'.$ntN, !empty($metaSettings['nxs_cats_names'])?$metaSettings['nxs_cats_names']:'', true, true, self::makeInputName('_cats_names', $nt, $ii),'nxsSelItAjx', 'category' ); echo '</div>';
        
        //echo '<div><label class="field_title">'. __( 'Tags', 'social-networks-auto-poster-facebook-twitter-g' ) . '('.$tagsCnt.'):</label>';            
        echo '<div><label class="field_title">'. __( 'Tags', 'social-networks-auto-poster-facebook-twitter-g' ) . ':</label>';            
        echo '&nbsp;<input type="radio" '.$selTI.' name="'.self::makeInputName('_ie_tags_names', $nt, $ii).'" value="0">Include&nbsp;&nbsp;<input type="radio" '.$selTE.' name="'.self::makeInputName('_ie_tags_names', $nt, $ii).'" value="1">Exclude<br/>';          
        self::print_select( (!empty( $current_post->ID))?$current_post->ID:0, $tags_names, 'nxs_tags_names'.$ntN, !empty($metaSettings['nxs_tags_names'])?$metaSettings['nxs_tags_names']:'', true, true, self::makeInputName('_tags_names', $nt, $ii), 'nxsSelItAjxAdd', 'post_tag' ); echo '</div>';

        
        echo "</div>";
}
    public static function print_timeframe_section( $current_post, $metaSettings, $nt='', $ii='' ) { 
    // ## Dates
        
        $count_periods     = (!empty( $current_post->ID))?$metaSettings['nxs_count_date_periods']:'';
        $count_abs_periods = (!empty( $current_post->ID))?$metaSettings['nxs_count_date_abs_periods']:'';
        $types_abs_periods = array(
            'days'   => __( 'Days', 'social-networks-auto-poster-facebook-twitter-g' ),
            'weeks'  => __( 'Weeks', 'social-networks-auto-poster-facebook-twitter-g' ),
            'months' => __( 'Months', 'social-networks-auto-poster-facebook-twitter-g' ),
            'years'  => __( 'Years', 'social-networks-auto-poster-facebook-twitter-g' )
        );
                
        $isVis =  !empty($metaSettings["nxs_inclusive_0"]);
        if( empty( $count_periods ) ) $count_periods = 1;            
        if( empty( $count_abs_periods ) ) $count_abs_periods = 1;            
        echo '<h4 onclick="jQuery(\'#nxs_sec_timeframe\').toggle();"; style="cursor:pointer; background-image: url(\''.NXS_PLURL.'img/icons/time24.png\');background-repeat: no-repeat; padding-top: 2px; padding-left: 28px; height:24px;">'. 
          __( 'Timeframes (Exact Dates)', 'social-networks-auto-poster-facebook-twitter-g' ) .'&nbsp;&nbsp;&gt;&gt; </h4><div id="nxs_sec_timeframe" class="nxsLftPad" style="display:'.($isVis?'block':'none').';">';
        
        for( $i = 1; $i <= $count_periods; $i++ ) {
            $postfix = $i == 1 ? '' : '_'. $i;
            $rel     = $i == 1 ? '' : 'nxs_date_period_'. $i;            
            $check_inclusive = (!empty( $current_post->ID))?$metaSettings["nxs_inclusive$postfix"]:'';
                        
            if( $i > 1 ) echo '<hr>';            
            echo '<div class="'. 'nxs_short_field" rel="'. $rel .'">';
            echo '<label class="field_title">'. __( '[Timeframe] From', 'social-networks-auto-poster-facebook-twitter-g' ) .':</label>';
            echo '<input type="text" id="'. 'nxs_starting_period'. $postfix. '" name="'. 'nxs_starting_period'. $postfix. '" class="selectize-input datepicker" placeholder="'. __( '2012-01-01', 'social-networks-auto-poster-facebook-twitter-g' ) .'" value="'. ((!empty( $current_post->ID))?$metaSettings["nxs_starting_period$postfix"]:'') .'">';
            echo '</div>';
            
            echo '<div class="'. 'nxs_short_field" rel="'. $rel .'">';
            echo '<label class="field_title">'. __( '[Timeframe] To', 'social-networks-auto-poster-facebook-twitter-g' ) .':</label>';
            echo '<input type="text" id="'. 'nxs_end_period'. $postfix. '" name="'. 'nxs_end_period'. $postfix. '" class="selectize-input datepicker" placeholder="'. __( '2014-01-01', 'social-networks-auto-poster-facebook-twitter-g' ) .'" value="'. ((!empty( $current_post->ID))?$metaSettings["nxs_end_period$postfix"]:'') .'">';
            echo '<input type="hidden" name="'. 'nxs_inclusive'. $postfix. '" id="'. 'nxs_inclusive'. $postfix. '"  value="1">';
            echo '</div>';
            
            
            if( $i > 1 ) {
                echo '<div class="'. 'nxs_small_field" rel="'. $rel .'">';
                echo '<button class="'. 'nxs_remove_date_period">'. __( 'Remove', 'social-networks-auto-poster-facebook-twitter-g' ) .'</button>';
                echo '</div>';                
            }
        }
        
        echo '<hr>';
        
        echo '<button id="'. 'nxs_add_date_period">'. __( 'Add More', 'social-networks-auto-poster-facebook-twitter-g' ) .'...</button>';
        echo '<input type="hidden" id="'. 'nxs_count_date_periods" name="'. 'nxs_count_date_periods" value="'. $count_periods .'">';
        echo "</div>";
        
}
    public static function print_dates_section( $current_post, $metaSettings, $nt='', $ii='') { $isVis =  !empty($metaSettings['nxs_tags_names']) || !empty($metaSettings['nxs_cats_names']);
        echo '<h4 onclick="jQuery(\'#nxs_sec_dates\').toggle();"; style="cursor:pointer; background-image: url(\''.NXS_PLURL.'img/icons/time24.png\');background-repeat: no-repeat; padding-top: 2px; padding-left: 28px; height:24px;">'. 
          __( 'Dates - Older/Newer', 'social-networks-auto-poster-facebook-twitter-g' ) .'&nbsp;&nbsp;&gt;&gt; </h4><div id="nxs_sec_dates" class="nxsLftPad" style="display:'.($isVis?'block':'none').';">';
        
        for( $j = 1; $j <= $count_abs_periods; $j++ ) {  $postfix = $j == 1 ? '' : '_'. $j;  $rel = $j == 1 ? '' : 'nxs_date_abs_period_'. $j;
                        
            if( $j > 1 ) echo '<hr>';            
            echo '<div class="'. 'nxs_small_field" rel="'. $rel .'">';
            echo '<label class="field_title">'. __( 'Postes newer then', 'social-networks-auto-poster-facebook-twitter-g' ) .':</label>';
            echo '<input type="text" id="'. 'nxs_starting_abs_period'. $postfix. '" name="'. 'nxs_starting_abs_period'. $postfix. '" class="selectize-input" placeholder="'. __( 'Please enter the number', 'social-networks-auto-poster-facebook-twitter-g' ) .'" value="'. ((!empty( $current_post->ID))?$metaSettings["nxs_starting_abs_period$postfix"]:'') .'">';
            echo '<p class="description">'. __( 'Postes created after...', 'social-networks-auto-poster-facebook-twitter-g' ) .'</p>';
            echo '</div>';
            
            echo '<div class="'. 'nxs_small_field" rel="'. $rel .'">';
            echo '<label class="field_title">'. __( 'Period Type', 'social-networks-auto-poster-facebook-twitter-g' ) .':</label>';
            self::print_select( (!empty( $current_post->ID))?$current_post->ID:0, $types_abs_periods, "nxs_types_starting_abs_period$postfix", $metaSettings, true, false );
            echo '<p class="description">'. __( 'Days, Weeks, Months, Yeasr', 'social-networks-auto-poster-facebook-twitter-g' ) .'</p>';
            echo '</div>';
            
            echo '<div class="'. 'nxs_small_field" rel="'. $rel .'">';
            echo '<label class="field_title">'. __( 'Postes older then', 'social-networks-auto-poster-facebook-twitter-g' ) .':</label>';
            echo '<input type="text" id="'. 'nxs_end_abs_period'. $postfix. '" name="'. 'nxs_end_abs_period'. $postfix. '" class="selectize-input" placeholder="'. __( 'Please enter the number', 'social-networks-auto-poster-facebook-twitter-g' ) .'" value="'. ((!empty( $current_post->ID))?$metaSettings["nxs_end_abs_period$postfix"]:'') .'">';
            echo '<p class="description">'. __( 'Postes created before..', 'social-networks-auto-poster-facebook-twitter-g' ) .'</p>';
            echo '</div>';
            
            echo '<div class="'. 'nxs_small_field" rel="'. $rel .'">';
            echo '<label class="field_title">'. __( 'Period Type', 'social-networks-auto-poster-facebook-twitter-g' ) .':</label>';
            self::print_select( (!empty( $current_post->ID))?$current_post->ID:0, $types_abs_periods, "nxs_types_end_abs_period$postfix", $metaSettings, true, false );
            echo '<p class="description">'. __( 'Days, Weeks, Months, Years', 'social-networks-auto-poster-facebook-twitter-g' ) .'</p>';
            echo '</div>';
            
            if( $j > 1 ) {
                echo '<div class="'. 'nxs_small_field" rel="'. $rel .'">';
                echo '<button class="'. 'nxs_remove_date_abs_period">'. __( '???????', 'social-networks-auto-poster-facebook-twitter-g' ) .'</button>';
                echo '</div>';                
            }
        }
        
        echo '<hr>';
        
        echo '<button id="'. 'nxs_add_date_abs_period">'. __( 'Add more', 'social-networks-auto-poster-facebook-twitter-g' ) .'...</button>';
        echo '<input type="hidden" id="'. 'nxs_count_date_abs_periods" name="'. 'nxs_count_date_abs_periods" value="'. $count_abs_periods .'">';
        echo "</div>";
}
    public static function print_types_section( $current_post, $metaSettings, $nt='', $ii='' ) {   $ntN = $nt.$ii;
        $isVis = !empty($metaSettings['nxs_post_status']) || !empty($metaSettings['nxs_post_type']) || !empty($metaSettings['nxs_post_formats']); // prr(self::$post_formats);
        //## Type, Status, Format
        echo '<h4 onclick="jQuery(\'#nxs_sec_types'.$ntN.'\').toggle();"; style="cursor:pointer; background-image: url(\''.NXS_PLURL.'img/icons/type24.png\');background-repeat: no-repeat; padding-top: 2px; padding-left: 28px; height:24px;">'. 
          __( 'Post Type, Post Format', 'social-networks-auto-poster-facebook-twitter-g' ) .'&nbsp;&nbsp;&gt;&gt; </h4><div id="nxs_sec_types'.$ntN.'" class="nxsLftPad" style="display:'.($isVis?'block':'none').';">';
        
        
        $formats = array();    
        if( is_array( self::$post_formats ) ) { foreach( self::$post_formats[0] as $format ) $formats['post-format-'. $format] = $format; $formats['standard'] = 'Standard'; }
        
        
        $selCI = empty($metaSettings['nxs_ie_posttypes']) ? 'checked="checked"' : ''; $selCE = $selCI=='' ? 'checked="checked"' : '';
        /*
        $posts_statuses = get_post_stati( 0, 'object');
        if( !empty( $posts_statuses ) ) { $translated_statuses = array(); foreach( $posts_statuses as $status ) $translated_statuses[$status->name] = $status->label;                        
            $translated_statuses['protected'] = __( 'Password Protected', self::$plugin_name ); natsort( $translated_statuses );            
            echo '<div><label class="field_title">'. __( 'Status', self::$plugin_name ) . ':</label>&nbsp;&nbsp;<span class="description">'. __( 'Select posts by status' ) .'</span>';
            self::print_select( (!empty( $current_post->ID))?$current_post->ID:0, $translated_statuses, 'nxs_post_status', !empty($metaSettings['nxs_post_status'])?$metaSettings['nxs_post_status']:'', true, true, self::makeInputName('_post_status', $nt, $ii) ); echo '</div>';
        }     
        */   
        if( !empty( self::$posts_types ) ) {
            echo '<div><label class="field_title">'. __( 'Post Types (Posts, Pages, Custom Post Types)', 'social-networks-auto-poster-facebook-twitter-g' ) . ':</label>';
            echo '&nbsp;<input type="radio" '.$selCI.' name="'.self::makeInputName('_ie_posttypes', $nt, $ii).'" value="0">Include (Post only ...)&nbsp;&nbsp;<input type="radio" '.$selCE.' name="'.self::makeInputName('_ie_posttypes', $nt, $ii).'" value="1">Exclude (Do not post ...)<br/>';
            self::print_select( (!empty( $current_post->ID))?$current_post->ID:0, self::$posts_types, 'nxs_post_type', !empty($metaSettings['nxs_post_type'])?$metaSettings['nxs_post_type']:'', false, true, self::makeInputName('_post_type', $nt, $ii)); echo '</div>';
        }        
        if( !empty( $formats ) ) {
            echo '<div><label class="field_title">'. __( 'Formats', 'social-networks-auto-poster-facebook-twitter-g' ) . ':</label>&nbsp;&nbsp;<span class="description">'. __( 'Standard Blogpost, Image, Audio, Video, Status, Quote, etc..' ) .'</span><br/>';
            self::print_select( (!empty( $current_post->ID))?$current_post->ID:0, $formats, 'nxs_post_formats', !empty($metaSettings['nxs_post_formats'])?$metaSettings['nxs_post_formats']:'', true, true, self::makeInputName('_post_formats', $nt, $ii) ); echo '</div>';
        } echo "</div>";
    }
    public static function print_author_section( $current_post, $metaSettings, $nt='', $ii='' ) { $isVis = !empty($metaSettings['nxs_user_names']); $ntN = $nt.$ii;
    // ## Author    
        echo '<h4 onclick="jQuery(\'#nxs_sec_author'.$ntN.'\').toggle();"; style="cursor:pointer; background-image: url(\''.NXS_PLURL.'img/icons/user24.png\');background-repeat: no-repeat; padding-top: 2px; padding-left: 28px; height:24px;">'. 
          __( 'Author', 'social-networks-auto-poster-facebook-twitter-g' ) .'&nbsp;&nbsp;&gt;&gt; </h4><div id="nxs_sec_author'.$ntN.'" class="nxsLftPad" style="display:'.($isVis?'block':'none').';">';
        
        $user_names = array(); //$users = get_users();     //   prr($users); //## Not Good when we have a lot of subscribers.
        global $wpdb; $users = $wpdb->get_results("SELECT ID, user_login, display_name FROM $wpdb->users WHERE 1=1 AND {$wpdb->users}.ID IN (SELECT {$wpdb->usermeta}.user_id FROM $wpdb->usermeta WHERE {$wpdb->usermeta}.meta_key = '{$wpdb->prefix}capabilities' AND {$wpdb->usermeta}.meta_value NOT LIKE '%subscriber%') ORDER BY display_name ASC"); //prr($users);
        
        if( $users ) foreach( $users as $user )  $user_names[$user->ID] = $user->display_name." (".$user->user_login.")";
        if( !empty( $user_names ) ) {            
            echo '<div><label class="field_title" for="'. 'nxs_user_names">'. __( 'Author', 'social-networks-auto-poster-facebook-twitter-g' ) . ':</label>&nbsp;&nbsp;<span class="description">'. __( 'Author' ) .'</span><br/>';
            self::print_select( (!empty( $current_post->ID))?$current_post->ID:0, $user_names, 'nxs_user_names', !empty($metaSettings['nxs_user_names'])?$metaSettings['nxs_user_names']:'', true, true, self::makeInputName('_user_names', $nt, $ii) ); echo '</div>';
        }
        echo "</div>";
}
    public static function print_postsPages_section( $current_post, $metaSettings, $nt='', $ii='' ) {   $isVis = !empty($metaSettings['nxs_name_post']) || !empty($metaSettings['nxs_name_page']) || !empty($metaSettings['nxs_name_parent']);
    // ## Exact Posts and Pages
       echo '<h4 onclick="jQuery(\'#nxs_sec_postsPages\').toggle();"; style="cursor:pointer; background-image: url(\''.NXS_PLURL.'img/icons/post24.png\');background-repeat: no-repeat; padding-top: 2px; padding-left: 28px; height:24px;">'. 
         __( 'Exact Posts and Pages', 'social-networks-auto-poster-facebook-twitter-g' ) .'&nbsp;&nbsp;&gt;&gt; </h4><div id="nxs_sec_postsPages" class="nxsLftPad" style="display:'.($isVis?'block':'none').';">';
        
        $posts_names = array(); $posts_parents = array(); $pages_names = array();
        
        if (!empty(self::$posts)) foreach( self::$posts as $post ) {
            if ( in_array( $post->post_type, self::$posts_types ) && $post->post_type != 'nxs_filter' ) {
                if( !empty( $post->post_title ) && $post->post_type == 'page' )
                    $pages_names[$post->ID] = $post->post_title;
                
                if( !empty( $post->post_title ) && $post->post_type != 'page' && $post->post_type != 'attachment' )
                    $posts_names[$post->ID] = $post->post_title;
                
                if( !empty( $post->post_parent ) && self::search_post_by_id( $post->post_parent ) )
                    $posts_parents[$post->post_parent] = self::search_post_by_id( $post->post_parent );
            }    
        }
        
        if( !empty( $posts_names ) ) {
            echo '<div><label class="field_title">'. __( 'Post Name', 'social-networks-auto-poster-facebook-twitter-g' ) . ':</label>&nbsp;&nbsp;<span class="description">'. __( 'Select post by name' ) .'</span>';
            self::print_select( (!empty( $current_post->ID))?$current_post->ID:0, $posts_names, 'nxs_name_post', !empty($metaSettings['nxs_name_post'])?$metaSettings['nxs_name_post']:'', true ); echo '</div>';
        }
        
        if( !empty( $pages_names ) ) {
            echo '<div><label class="field_title">'. __( 'Page Name', 'social-networks-auto-poster-facebook-twitter-g' ) . ':</label>&nbsp;&nbsp;<span class="description">'. __( 'Select page by name' ) .'</span>';
            self::print_select( (!empty( $current_post->ID))?$current_post->ID:0, $pages_names, 'nxs_name_page', !empty($metaSettings['nxs_name_page'])?$metaSettings['nxs_name_page']:'', true ); echo '</div>';
        }
        
        if( !empty( $posts_parents ) ) {
            echo '<div><label class="field_title">'. __( 'Page/Post Parent Name', 'social-networks-auto-poster-facebook-twitter-g' ) . ':</label>&nbsp;&nbsp;<span class="description">'. __( 'Select Page/Post by Parent Name' ) .'</span>';
            self::print_select( (!empty( $current_post->ID))?$current_post->ID:0, $posts_parents, 'nxs_name_parent', !empty($metaSettings['nxs_name_parent'])?$metaSettings['nxs_name_parent']:'', true ); echo '</div>';
        }  
        echo "</div>";
}
    public static function print_search_section( $current_post, $metaSettings, $nt='', $ii='' ) {   $isVis = !empty($metaSettings['nxs_search_keywords']);
    // ## Search 
        echo '<h4 onclick="jQuery(\'#nxs_sec_search'.$nt.$ii.'\').toggle();"; style="cursor:pointer; background-image: url(\''.NXS_PLURL.'img/icons/search24.png\');background-repeat: no-repeat; padding-top: 2px; padding-left: 28px; height:24px;">'. 
          __( 'Search', 'social-networks-auto-poster-facebook-twitter-g' ) .'&nbsp;&nbsp;&gt;&gt; </h4><div id="nxs_sec_search'.$nt.$ii.'" class="nxsLftPad" style="display:'.($isVis?'block':'none').';">';
        ?>
        <div>
            <label class="field_title"><?php _e( 'Search', 'social-networks-auto-poster-facebook-twitter-g' ); ?>:</label>&nbsp;&nbsp;<span class="description"><?php _e( 'Please enter the search query' ) ?></span> <br/>           
            <input type="text" name="<?php echo self::makeInputName('_search_keywords', $nt, $ii); ?>" class="selectize-input" autocomplete="off" placeholder="Please enter the search query..." value="<?php echo ($isVis)?$metaSettings['nxs_search_keywords']:''; ?>">            
        </div> <?php
        echo "</div>";   
}
    public static function print_meta_section( $current_post, $metaSettings, $nt='', $ii='' ) { $isVis = !empty($metaSettings['nxs_meta_key']); $ntN = $nt.$ii;
        echo '<h4 onclick="jQuery(\'#nxs_sec_meta'.$nt.$ii.'\').toggle();"; style="cursor:pointer; background-image: url(\''.NXS_PLURL.'img/icons/meta24.png\');background-repeat: no-repeat; padding-top: 2px; padding-left: 28px; height:24px;">'. 
          __( 'Custom Fields', 'social-networks-auto-poster-facebook-twitter-g' ) .'&nbsp;&nbsp;&gt;&gt; </h4><div id="nxs_sec_meta'.$nt.$ii.'" class="nxsLftPad" style="display:'.($isVis?'block':'none').';">';
        $post_meta_keys   = array(); $post_meta_values = array(); $type_options = array('NUMERIC', 'BINARY', 'DATE', 'CHAR', 'DATETIME', 'DECIMAL', 'SIGNED', 'TIME', 'UNSIGNED');
        //$count_compares   = (!empty( $current_post->ID))?$metaSettings['nxs_count_meta_compares']:'';        
        $count_compares = !empty( $metaSettings['nxs_count_meta_compares'])?$metaSettings['nxs_count_meta_compares']:'';  if(empty($count_compares)) $count_compares = 1; $relation_options = array( 'AND', 'OR' );        
        $compare_options  = array('='=>'=', '!='=>'!=', 'gt'=>'>', 'gt='=>'>=', 'lt'=>'<', 'lt='=>'<=', 'LIKE'=>'LIKE', 'NOT LIKE'=>'NOT LIKE', 'IN'=>'IN', 'NOT IN'=>'NOT IN', 'BETWEEN'=>'BETWEEN', 'NOT BETWEEN'=>'NOT BETWEEN', 'EXISTS'=>'EXISTS');
        echo '<div id="nxs_meta_namesTopDiv'.$nt.$ii.'">';
        
        for( $i = 1; $i <= $count_compares; $i++ ) { $postfix = $i == 1 ? '' : '_'. $i;    $rel = $i == 1 ? '' : 'nxs_meta_compare_'. $i;      if ($i>1 && empty($metaSettings["nxs_meta_key$postfix"])) continue;   
          echo '<div class="nxs_metas_panel"  id="nxs_meta_namesDiv'.$nt.$ii.$postfix.'"><hr/>';             
          echo '<div class="nxs_metas_leftPanel" style="display:'.(($i>1)?'inline-block':'none').';">';                 
          echo '<div class="nxs_short_field" id="nxs_meta_namesCond'.$nt.$ii.'" style="'.(($i < 1)?'display:none;':'').'">';
          echo '<label class="field_title">'. __( 'Condition', 'social-networks-auto-poster-facebook-twitter-g' ) . ':</label>';
          //self::print_select( (!empty( $current_post->ID))?$current_post->ID:0, $relation_options, "nxs".$nt.$ii."_meta_relation", !empty($metaSettings["nxs_meta_relation$postfix"])?$metaSettings["nxs_meta_relation$postfix"]:'', false, false, self::makeInputName("_meta_relation$postfix", $nt, $ii ), 'hiu');                  
          self::printSelect( "nxs".$nt.$ii."_meta_relation", self::makeInputName("_meta_relation$postfix", $nt, $ii ), false, $relation_options, !empty($metaSettings["nxs_meta_relation$postfix"])?$metaSettings["nxs_meta_relation$postfix"]:'', !empty($current_post->ID)?$current_post->ID:0, false, 'notTknz');
          echo '</div>'; echo '<button class="nxs_remove_meta_compare">'. __( 'Remove', 'social-networks-auto-poster-facebook-twitter-g' ) .'</button>';
          echo '</div><div class="nxs_metas_rightPanel">';        
        ?>
        <div class="">
          <div class="">
            <div class="nxs_medium_field_txn"> <label class="field_title"> <?php _e( 'Custom Field Name', 'social-networks-auto-poster-facebook-twitter-g' ); ?>:</label><br/>
               <input name="<?php echo self::makeInputName("_meta_key$postfix", $nt, $ii); ?>" id="nxs<?php echo $nt.$ii; ?>_meta_key<?php echo $postfix; ?>" style="font-weight: bold; color: #005800; border: 1px solid #ACACAC; width: 95%;" value="<?php echo !empty($metaSettings["nxs_meta_key$postfix"])?$metaSettings["nxs_meta_key$postfix"]:'';?>"/>
            </div>
            <div class="nxs_shortXL_field"><?php
            echo '<div class="'. 'nxs_short_field" rel="'. $rel .'">';
            echo '<label class="field_title">'. __( 'Operator', 'social-networks-auto-poster-facebook-twitter-g' ) . ':</label><br/>';
            self::print_select( (!empty( $current_post->ID))?$current_post->ID:0, $compare_options, "nxs".$nt.$ii."_meta_operator$postfix", !empty($metaSettings["nxs_meta_operator$postfix"])?$metaSettings["nxs_meta_operator$postfix"]:'', false, false, self::makeInputName("_meta_operator$postfix", $nt, $ii),'hui' ); echo '</div>';
            ?></div>
            <div class="nxs_mediumXL_field_txn"><label class="field_title"> <?php _e( 'Custom Field Value', 'social-networks-auto-poster-facebook-twitter-g' ); ?>:</label><br/>
                <input name="<?php echo self::makeInputName("_meta_value$postfix", $nt, $ii); ?>[]" id="nxs<?php echo $nt.$ii; ?>_meta_value<?php echo $postfix; ?>" style="font-weight: bold; color: #005800; border: 1px solid #ACACAC; width: 95%;" value="<?php echo !empty($metaSettings["nxs_meta_value$postfix"])?$metaSettings["nxs_meta_value$postfix"][0]:'';?>"/>
            </div>        
          </div>
          <div class="">
          </div>
        </div>
</div>    
    </div>
        <?php }
        
        echo '</div>';        
        
        echo '<button data-ii="'.$ii.'" data-nt="'.$nt.'" class="nxs_add_meta_compare">'. __( 'Add More', 'social-networks-auto-poster-facebook-twitter-g' ) .'...</button>';
        echo '<input type="hidden" id="nxs_count_meta_'.$nt.$ii.'" name="'.self::makeInputName('_count_meta_compares', $nt, $ii).'" value="'. $count_compares .'">';
        
        echo "</div>";
    }
    public static function print_meta_sectionX( $current_post, $metaSettings, $nt='', $ii='' ) { $isVis = !empty($metaSettings['nxs_count_meta_compares']); $ntN = $nt.$ii;
    // ## Meta
        echo '<h4 onclick="jQuery(\'#nxs_sec_meta'.$nt.$ii.'\').toggle();"; style="cursor:pointer; background-image: url(\''.NXS_PLURL.'img/icons/meta24.png\');background-repeat: no-repeat; padding-top: 2px; padding-left: 28px; height:24px;">'. 
          __( 'Meta', 'social-networks-auto-poster-facebook-twitter-g' ) .'&nbsp;&nbsp;&gt;&gt; </h4><div id="nxs_sec_meta'.$nt.$ii.'" class="nxsLftPad" style="display:'.($isVis?'block':'none').';">';
        $post_meta_keys   = array(); $post_meta_values = array(); $type_options = array('NUMERIC', 'BINARY', 'DATE', 'CHAR', 'DATETIME', 'DECIMAL', 'SIGNED', 'TIME', 'UNSIGNED');
        $count_compares   = (!empty( $current_post->ID))?$metaSettings['nxs_count_meta_compares']:''; if(empty($count_compares)) $count_compares = 1; $relation_options = array( 'AND', 'OR' );
        $compare_options  = array('='=>'=', '!='=>'!=', 'gt'=>'>', 'gt='=>'>=', 'lt'=>'<', 'lt='=>'<=', 'LIKE'=>'LIKE', 'NOT LIKE'=>'NOT LIKE', 'IN'=>'IN', 'NOT IN'=>'NOT IN', 'BETWEEN'=>'BETWEEN', 'NOT BETWEEN'=>'NOT BETWEEN', 'EXISTS'=>'EXISTS');
        if (!empty(self::$posts)) foreach( self::$posts as $post ) {
          if( $post->post_type != 'nxs_filter' ) { $post_meta = get_post_custom( $post->ID );
            foreach( $post_meta as $key => $values ) { if( !in_array( $key, $post_meta_keys ) ) $post_meta_keys[] = $key;
              foreach( $values as $value ) { $item = mb_strlen( $value ) > 80 ? mb_substr( $value, 0, 80 ) .'...' : $value; $finded_keys = array_keys( $post_meta_values, $item );
                if( empty( $finded_keys ) ) $post_meta_values[$key .'||'. $post->ID] = $item; 
                  else { foreach( $finded_keys as $finded_key ) { if( $key == mb_substr( $finded_key, 0, mb_strrpos( $finded_key, '||' ) ) )  continue 2; } $post_meta_values[$key .'||'. $post->ID] = $item; }
              }
            }
          }
        } natsort( $post_meta_keys ); natsort( $post_meta_values );
        
        for( $i = 1; $i <= $count_compares; $i++ ) { $postfix = $i == 1 ? '' : '_'. $i; $rel = $i == 1 ? '' : 'nxs_meta_compare_'. $i;            
            if( $i > 1 ) echo '<hr>';
            
            echo '<div class="'. 'nxs_medium_field" rel="'. $rel .'">';
            echo '<label class="field_title">'. __( 'Key', 'social-networks-auto-poster-facebook-twitter-g' ) . ':</label>&nbsp;&nbsp;<span class="description">'. __( 'Post Meta Key' ) .'</span>';
            //self::print_select( (!empty( $current_post->ID))?$current_post->ID:0, $post_meta_keys, "nxs_meta_key$postfix", $metaSettings, false, false ); echo '</div> <br/>';
            self::print_select( (!empty( $current_post->ID))?$current_post->ID:0, $post_meta_keys, 'nxs_meta_key'.$ntN, !empty($metaSettings['nxs_meta_key'])?$metaSettings['nxs_meta_key']:'', true, false, self::makeInputName('_meta_key', $nt, $ii), 'nxsSelItAjxAdd', 'nxs_meta_key' ); echo '</div>';
            
            echo '<div class="'. 'nxs_short_field" rel="'. $rel .'">';
            echo '<label class="field_title">'. __( 'Operator', 'social-networks-auto-poster-facebook-twitter-g' ) . ':</label><br/>';
            self::print_select( (!empty( $current_post->ID))?$current_post->ID:0, $compare_options, "nxs".$nt.$ii."_meta_operator$postfix", !empty($metaSettings["nxs_meta_operator$postfix"])?$metaSettings["nxs_meta_operator$postfix"]:'', false, false, self::makeInputName("_meta_operator$postfix", $nt, $ii),'hui' ); echo '</div>';
                       
                       
            echo '<br/><div class="nxs_medium_field_txnNL" rel="'. $rel .'">';
            echo '<label class="field_title">'. __( 'Value', 'social-networks-auto-poster-facebook-twitter-g' ) . ':</label>&nbsp;&nbsp;<span class="description">'. __( 'Select Value' ) .'</span>';
            self::print_select( (!empty( $current_post->ID))?$current_post->ID:0, $post_meta_values, 'nxs'.$nt.$ii."_meta_value$postfix", !empty($metaSettings["nxs_meta_value$postfix"])?$metaSettings["nxs_meta_value$postfix"]:'', true, true, self::makeInputName("_meta_value$postfix", $nt, $ii), 'nxsSelItAjxAdd', !empty($metaSettings["nxs_tax_names$postfix"])?$metaSettings["nxs_tax_names$postfix"]:'' );
                       
            
            echo '<div class="'. 'nxs_medium_field" rel="'. $rel .'">';
            echo '<label class="field_title">'. __( 'Value', 'social-networks-auto-poster-facebook-twitter-g' ) . ':</label>&nbsp;&nbsp;<span class="description">'. __( 'Post Meta Value' ) .'</span>';
            self::print_select( (!empty( $current_post->ID))?$current_post->ID:0, $post_meta_values, "nxs_meta_value$postfix", $metaSettings, true ); echo '</div>';
            
            /*
            echo '<div class="'. 'nxs_short_field" rel="'. $rel .'">';
            echo '<label class="field_title">'. __( 'Type', 'social-networks-auto-poster-facebook-twitter-g' ) . ':</label>&nbsp;&nbsp;<span class="description">'. __( 'Post Meta Type' ) .'</span>';
            self::print_select( (!empty( $current_post->ID))?$current_post->ID:0, $type_options, "nxs_meta_type$postfix", false, false ); echo '</div>';
            */
            
            if( $i > 1 ) { //## Remove button
              echo '<div class="'. 'nxs_short_field" rel="'. $rel .'"><button class="'. 'nxs_remove_meta_compare">'. __( 'Remove', 'social-networks-auto-poster-facebook-twitter-g' ) .'</button></div>';
            }
        } echo '<hr>';
        
        echo '<div class="'. 'nxs_short_field">';
        echo '<label class="field_title">'. __( 'Relation', 'social-networks-auto-poster-facebook-twitter-g' ) . ':</label>&nbsp;&nbsp;<span class="description">'. __( 'Post Meta Relation' ) .'</span>';
        self::print_select( (!empty( $current_post->ID))?$current_post->ID:0, $relation_options, "nxs_meta_relation", $metaSettings, false, false ); echo '</div>';
        
        echo '<button id="'. 'nxs_add_meta_compare">'. __( 'Add more', 'social-networks-auto-poster-facebook-twitter-g' ) .'...</button>';
        echo '<input type="hidden" id="'. 'nxs_count_meta_compares" name="'. 'nxs_count_meta_compares" value="'. $count_compares .'">';   
        
         echo "</div>";   
}
        
    public static function print_taxonomies_section( $current_post, $metaSettings, $nt='', $ii='' ) { $isVis = !empty($metaSettings['nxs_term_names']); 
        //## Taxonomies         
         echo '<h4 onclick="jQuery(\'#nxs_sec_taxonomies'.$nt.$ii.'\').toggle();"; style="cursor:pointer; background-image: url(\''.NXS_PLURL.'img/icons/tag24.png\');background-repeat: no-repeat; padding-top: 2px; padding-left: 28px; height:24px;" >'. 
           __( 'Taxonomies', 'social-networks-auto-poster-facebook-twitter-g' ) .'&nbsp;&nbsp;&gt;&gt; </h4><div id="nxs_sec_taxonomies'.$nt.$ii.'" class="nxsLftPad" style="display:'.($isVis?'block':'none').';">';
        $taxs_names = self::$taxonomies; $relation_options = array( 'AND', 'OR' ); $compare_options  = array( 'IN', 'NOT IN', 'AND' );
        $children_options = array('no' => __( 'No', 'social-networks-auto-poster-facebook-twitter-g'), 'yes' => __( 'Yes', 'social-networks-auto-poster-facebook-twitter-g')); 
        $count_compares = !empty( $metaSettings['nxs_count_term_compares'])?$metaSettings['nxs_count_term_compares']:'';// prr($metaSettings);
        unset( $taxs_names['post_format'] );  $terms_names = array();
        
        if( empty( $count_compares ) ) $count_compares = 1;        
        echo '<div id="nxs_term_namesTopDiv'.$nt.$ii.'">';
        
        for( $i = 1; $i <= $count_compares; $i++ ) { $postfix = $i == 1 ? '' : '_'. $i;    $rel = $i == 1 ? '' : 'nxs_term_compare_'. $i; if ($i>1 && empty($metaSettings["nxs_term_names$postfix"])) continue;
             echo '<div class="nxs_terms_panel"  id="nxs_term_namesDiv'.$nt.$ii.$postfix.'"><hr/>'; 
            
                echo '<div class="nxs_terms_leftPanel" style="display:'.(($i>1)?'inline-block':'none').';">'; 
                
                 echo '<div class="nxs_short_field" id="nxs_term_namesCond'.$nt.$ii.'" style="'.(($i < 1)?'display:none;':'').'">';
                 echo '<label class="field_title">'. __( 'Condition', 'social-networks-auto-poster-facebook-twitter-g' ) . ':</label>';
                 //self::print_select( (!empty( $current_post->ID))?$current_post->ID:0, $relation_options, "nxs".$nt.$ii."_term_relation", !empty($metaSettings["nxs_term_relation$postfix"])?$metaSettings["nxs_term_relation$postfix"]:'', false, false, self::makeInputName("_term_relation$postfix", $nt, $ii ), 'hiu'); 
                 
                 self::printSelect( "nxs".$nt.$ii."_term_relation", self::makeInputName("_term_relation$postfix", $nt, $ii ), false, $relation_options, !empty($metaSettings["nxs_term_relation$postfix"])?$metaSettings["nxs_term_relation$postfix"]:'', !empty($current_post->ID)?$current_post->ID:0, false, 'notTknz');
                 echo '</div>';
                
                echo '<button class="nxs_remove_term_compare">'. __( 'Remove', 'social-networks-auto-poster-facebook-twitter-g' ) .'</button>';
                echo '</div><div class="nxs_terms_rightPanel">';
            
            
            echo '<div>';
            //## Get already selected terms
            if (!empty($metaSettings["nxs_tax_names$postfix"])){ $terms_names = array(); 
              $terms = !empty($metaSettings["nxs_term_names$postfix"])?get_terms( $metaSettings["nxs_tax_names$postfix"], array( 'hide_empty' => false, 'include'=>implode(',',$metaSettings["nxs_term_names$postfix"]), 'number'=>500)):'';            
              if (!empty($terms)) { foreach( $terms as $term ) $terms_names[$term->term_id] = $term->name; natsort( $terms_names ); } else $terms_names = array();
            }
            echo '<div class="nxs_medium_field_txn" rel="'. $rel .'">';
            echo '<label class="field_title">'. __( 'Taxonomy', 'social-networks-auto-poster-facebook-twitter-g' ) . ':</label><br/>';
            self::print_select( (!empty( $current_post->ID))?$current_post->ID:0, $taxs_names, "nxs".$nt.$ii."_tax_names$postfix", !empty($metaSettings["nxs_tax_names$postfix"])?$metaSettings["nxs_tax_names$postfix"]:'', true, false, self::makeInputName("_tax_names$postfix", $nt, $ii), 'nxs_tax_names' );echo '</div>';
            
            echo '<div class="'. 'nxs_short_field" rel="'. $rel .'">';
            echo '<label class="field_title">'. __( 'Operator', 'social-networks-auto-poster-facebook-twitter-g' ) . ':</label><br/>';
            self::print_select( (!empty( $current_post->ID))?$current_post->ID:0, $compare_options, "nxs".$nt.$ii."_term_operator$postfix", !empty($metaSettings["nxs_term_operator$postfix"])?$metaSettings["nxs_term_operator$postfix"]:'', false, false, self::makeInputName("_term_operator$postfix", $nt, $ii),'hui' ); echo '</div>';
            
            echo '<div class="'. 'nxs_short_field" rel="'. $rel .'">';
            echo '<label class="field_title">'. __( 'Child Terms', 'social-networks-auto-poster-facebook-twitter-g' ) . ':</label>';
            self::print_select( (!empty( $current_post->ID))?$current_post->ID:0, $children_options, "nxs".$nt.$ii."_term_children$postfix", !empty($metaSettings["nxs_term_children$postfix"])?$metaSettings["nxs_term_children$postfix"]:'', true, false, self::makeInputName("_term_children$postfix", $nt, $ii), 'hiu' ); echo '</div>';
          
            echo '<br/><div class="nxs_medium_field_txnNL" rel="'. $rel .'">';
            echo '<label class="field_title">'. __( 'Terms', 'social-networks-auto-poster-facebook-twitter-g' ) . ':</label>&nbsp;&nbsp;<span class="description">'. __( 'Select Terms' ) .'</span>';
            self::print_select( (!empty( $current_post->ID))?$current_post->ID:0, $terms_names, 'nxs'.$nt.$ii."_term_names$postfix", !empty($metaSettings["nxs_term_names$postfix"])?$metaSettings["nxs_term_names$postfix"]:'', true, true, self::makeInputName("_term_names$postfix", $nt, $ii), 'nxsSelItAjxAdd', !empty($metaSettings["nxs_tax_names$postfix"])?$metaSettings["nxs_tax_names$postfix"]:'' );
            echo '</div></div></div></div>';
        }
        
        echo '</div>';        
        
        echo '<button data-ii="'.$ii.'" data-nt="'.$nt.'" class="nxs_add_term_compare">'. __( 'Add More', 'social-networks-auto-poster-facebook-twitter-g' ) .'...</button>';
        echo '<input type="hidden" id="nxs_count_term_'.$nt.$ii.'" name="'.self::makeInputName('_count_term_compares', $nt, $ii).'" value="'. $count_compares .'">';
        
        echo "</div>";
}
        
    public static function printSelect( $sID, $sName, $isMultiple, $optnsList, $values, $postID, $useKeyAsValue = false, $sClass = 'nxsSelIt', $txnType='') { $ph = __('Please select from the list...', 'social-networks-auto-poster-facebook-twitter-g');
      ?> <select name="<?php echo ( ($isMultiple ? $sName .'[]' : $sName) ); ?>" id="<?php echo $sID; ?>" <?php echo ( $isMultiple ? 'multiple="multiple"' : '' ); ?> class="<?php echo $sClass; ?>" data-type="<?php echo $txnType; ?>" placeholder="<?php echo $ph; ?>">                 
      <?php
        foreach( $optnsList as $key => $optionName ) { $value = $useKeyAsValue ? $key : $optionName; $selected = self::search_value_in_filter_meta( $postID, $meta_name, $value, $values ) ? 'selected="selected"' : '';            
          echo '<option value="'. esc_attr( $value ) .'" '. $selected .'>'. esc_attr( $optionName ) .'</option>';
        } ?></select><?php
    }    
    public static function search_value_in_filter_meta( $post_id, $meta_name, $needle, $meta_value='' ) {
        if ( !empty($post_id) && (empty($meta_value)||(!is_array($meta_value)))) $meta_value = get_post_meta($post_id, $meta_name, true);                
        // if( is_array( $meta_value ) ) return in_array( (string)$needle, $meta_value, true ); //>?? WHY use strict and (string)???
        if( is_array( $meta_value ) ) return in_array( $needle, $meta_value);
        return $meta_value == $needle ? true : false;
    }
    
    
    public static function print_select( $post_id, $values, $meta_name, $meta='', $print_key = false, $multiple = true, $name='', $class = 'nxsSelIt', $txnType='' ) { $ph = __('Please select from the list...', 'social-networks-auto-poster-facebook-twitter-g');
      ?> <select name="<?php echo ( ($multiple ? $name .'[]' : $name) ); ?>" id="<?php echo $meta_name; ?>" <?php echo ( $multiple ? 'multiple="multiple"' : '' ); ?> class="<?php echo $class; ?>" data-type="<?php echo $txnType; ?>" placeholder="<?php echo $ph; ?>">           
      
      <?php // prr($values, "KKKK");
        foreach( $values as $key => $option_item ) {
            $value = $print_key ? $key : $option_item; //prr($meta_name); prr($value); prr($meta);
            $selected = self::search_value_in_filter_meta( $post_id, $meta_name, $value, $meta ) ? 'selected="selected"' : '';
            echo '<option value="'. esc_attr( $value ) .'" '. $selected .'>'. esc_attr( $option_item ) .'</option>';
        }
      ?></select><?php
    }
    
    //## Operations    
    public static function search_post_by_id( $post_id, $field = 'post_title' ) {
        foreach( self::$posts as $key => $value ) {
            if( isset( $value->ID ) && $value->ID == $post_id )
                return self::$posts[$key]->$field;
        }
        return NULL;
    } 
    public static function sanitize_data( $data ) {
         if( is_array( $data ) ) return  array_map( array( __CLASS__, 'sanitize_data' ), $data ); else  return esc_attr( strip_tags( $data ) );
    }    
    public static function save_meta( $post_id, $key, $data ) { //echo "<br/> = ".$post_id." ~ ".$key; prr($data);
        if( is_array( $data ) )
            $sanitized_data = array_map( array( __CLASS__, 'sanitize_data' ), $data );
        else
            $sanitized_data = self::sanitize_data( $data );
                                                            //   echo "-= 4 =-";  prr($sanitized_data);
        update_post_meta( $post_id, $key, $sanitized_data );
    }
    
    
}

function nxs_get_normalize_parameter( $param ) {
   // return mb_substr( $param, mb_strpos( $param, '||' ) + 2 ); 
   return $param;
}

function get_posts_ids_by_filter( $filter ) { $args = array(); //prr($filter);
    if( !empty( $filter['nxs_postID'] ) ) $args['p'] = $filter['nxs_postID'];
    if( !empty( $filter['nxs_user_names'] ) ) $args['author__in'] = $filter['nxs_user_names'];    
    if( !empty( $filter['nxs_cats_names'] ) ) { if (empty($filter['nxs_ie_cats_names'])) $args['category__in'] = $filter['nxs_cats_names']; else $args['category__not_in'] = $filter['nxs_cats_names'];} 
    if( !empty( $filter['nxs_tags_names'] ) ) { if (empty($filter['nxs_ie_tags_names'])) $args['tag__in'] = $filter['nxs_tags_names']; else $args['tag__not_in'] = $filter['nxs_tags_names'];}
    if( !empty( $filter['nxs_name_page'] ) ) $args['page_id'] = $filter['nxs_name_page'];    
    if( !empty( $filter['nxs_name_post'] ) ) $args['post__in'] = $filter['nxs_name_post'];
    if( !empty( $filter['nxs_name_parent'] ) ) $args['post_parent__in'] = $filter['nxs_name_parent'];        
    if (empty( $filter['nxs_post_type'] )) { $filter['nxs_post_type'][] = 'NiHuyaSebeType'; $filter['nxs_ie_posttypes'] = 1;}    
    if( !empty($filter['nxs_ie_posttypes']) ) { nxs_Filters::init(true); $filter['nxs_post_type'] = array_diff(nxs_Filters::$posts_types,  $filter['nxs_post_type']); }    
    if( !empty( $filter['nxs_post_type'] ) ) $args['post_type'] = $filter['nxs_post_type'];    
    if( !empty( $filter['nxs_search_keywords'] ) ) $args['s'] = $filter['nxs_search_keywords'];    
    if( !empty( $filter['nxs_sticky_post'] ) ) $args['ignore_sticky_posts'] = $filter['nxs_sticky_post'] == 'no' ? true : false;        
    //  if( !empty( $filter['nxs_tags_names'] ) )         $args['second'] = $filter['nxs_second'];   -  ################### CHto ETO??????????
    //## Custom Taxonomies & Custom fields
    
    if (function_exists('nxs_doSMAS7')) $args = nxs_doSMAS7($args, $filter);    
    
    //## Post formats
    if( !empty( $filter['nxs_post_formats'] ) ) { $post_formats  = $filter['nxs_post_formats']; $formats_query = array( 'taxonomy' => 'post_format', 'terms' => $post_formats, 'field' => 'slug' );        
        $args['tax_query'][]   = $formats_query;
        if ( in_array( 'standard', $post_formats ) ) { $reg_formats = get_theme_support( 'post-formats' );   if( is_array( $reg_formats ) && is_array( $reg_formats[0] ) ) $reg_formats = $reg_formats[0]; 
            if( is_array( $reg_formats ) ) { $formats = array(); foreach( $reg_formats as $format ) $formats[] = 'post-format-'. $format;                    
                $args['tax_query'][] = array( 'taxonomy' => 'post_format', 'terms' => $formats, 'field' => 'slug', 'operator' => 'NOT IN' );
                $args['tax_query']['relation'] = 'OR';
            }            
        }
    }    
   
    
    if( isset( $filter['nxs_count_date_periods'] ) && ( !empty( $filter['nxs_starting_period'] ) || !empty( $filter['nxs_end_period'] ) ) ) {        
        $date_compares = array(); $count_compares = $filter['nxs_count_date_periods']; $date_compares['relation'] = 'OR';        
        for( $i = 1; $i <= $count_compares; $i++ ) { $postfix = $i > 1 ? '_'. $i : ''; $new_compare = array();            
            if( !empty( $filter["nxs_starting_period$postfix"] ) ) $new_compare['after'] = $filter["nxs_starting_period$postfix"];            
            if( !empty( $filter["nxs_end_period$postfix"] ) ) $new_compare['before'] = $filter["nxs_end_period$postfix"];                
            $new_compare['inclusive'] = $filter["nxs_inclusive$postfix"] == 'on' ? true : false ;                
            if( !empty( $new_compare ) ) $date_compares[] = $new_compare;                
        } $args['date_query'] = $date_compares;    
    }
    
    if( ( !empty( $filter['nxs_starting_abs_period'] ) && !empty( $filter['nxs_types_starting_abs_period'] ) ) || ( !empty( $filter['nxs_end_abs_period'] ) && !empty( $filter['nxs_types_end_abs_period'] ) ) ) {        
        $abs_date_compares = array(); $abs_count_compares = $filter['nxs_count_date_abs_periods'];
        for( $i = 1; $i <= $abs_count_compares; $i++ ) { $postfix = $i > 1 ? '_'. $i : ''; $new_abs_compare = array();            
            if( !empty( $filter["nxs_starting_abs_period$postfix"] ) && !empty( $filter["nxs_types_starting_abs_period$postfix"] ) ) {
                $new_abs_compare['after'] = intval( $filter["nxs_starting_abs_period$postfix"] ) .' '. $filter["nxs_types_starting_abs_period$postfix"] .' ago';
            }            
            if( !empty( $filter["nxs_end_abs_period$postfix"] ) && !empty( $filter["nxs_types_end_abs_period$postfix"] ) ) {
                $new_abs_compare['before'] = intval( $filter["nxs_end_abs_period$postfix"] ) .' '. $filter["nxs_types_end_abs_period$postfix"] .' ago';
            }                
            if( !empty( $new_abs_compare ) ) $abs_date_compares[] = $new_abs_compare;                
        }        
        if( !empty( $abs_date_compares ) ) {
          if( empty( $args['date_query'] ) ) $args['date_query']   = $abs_date_compares; else  foreach( $abs_date_compares as $abs_date_compare ) $args['date_query'][] = $abs_date_compare;            
        }            
    }    
    if( !empty( $filter['nxs_permission'] ) ) $args['perm'] = $filter['nxs_permission'];
    //$args['p'] = array('ID'=>'1200', 'compare'=>'<');        
    $args['numberposts'] = -1;  $args['post_status'] = array('publish');
    //$args['post_status'] = array('publish', 'pending', 'draft', 'auto-draft', 'future', 'private', 'inherit', 'trash');
    if( !empty( $filter['nxs_post_status'] ) ) $post_status = $filter['nxs_post_status'];        
    //## SORT    
    if( !empty( $filter['orderby'] ) ) $args['orderby'] = $filter['orderby'];    
    if( !empty( $filter['order'] ) ) $args['order'] = $filter['order'];
    if( !empty( $filter['posts_per_page'] ) ) $args['posts_per_page'] = $filter['posts_per_page'];
        //prr($args); // Summary column Info
    $args['suppress_filters'] = true;  $postsRet = nxs_get_posts( $args ); $posts = $postsRet['p']; $qu = $postsRet['q'];  //prr($postsRet);  // Summary column Info
        
    $post_ids = array();
    
    foreach( $posts as $post) {
        if( !empty( $post_status ) ) {
            if( !empty( $post->post_password ) ) if ( in_array( 'protected', $post_status ) ) $post_ids[] = $post->ID; else continue; else if ( in_array( $post->post_status, $post_status ) ) $post_ids[] = $post->ID; else continue;
        } else $post_ids[] = $post->ID;
    }   // prr($qu); prr($args);
    if (!empty($filter['fullreturn'])) return array('p'=>$post_ids, 'q'=>$qu, 'a'=>$args); else return $post_ids;    
}


//## WP Function but returns the Query too (for log).
if (!function_exists("nxs_get_posts")) { function nxs_get_posts( $args = null ) { 
    $defaults = array( 'numberposts' => 5, 'offset' => 0, 'category' => 0, 'orderby' => 'date', 'order' => 'DESC', 
      'include' => array(), 'exclude' => array(), 'meta_key' => '', 'meta_value' =>'', 'post_type' => 'post', 'suppress_filters' => true
    ); $r = wp_parse_args( $args, $defaults );
    if ( empty( $r['post_status'] ) ) $r['post_status'] = ( 'attachment' == $r['post_type'] ) ? 'inherit' : 'publish';
    if ( ! empty($r['numberposts']) && empty($r['posts_per_page']) ) $r['posts_per_page'] = $r['numberposts'];
    if ( ! empty($r['category']) ) $r['cat'] = $r['category'];
    if ( ! empty($r['include']) ) { $incposts = wp_parse_id_list( $r['include'] ); $r['posts_per_page'] = count($incposts);  $r['post__in'] = $incposts; } 
      elseif ( ! empty($r['exclude']) ) $r['post__not_in'] = wp_parse_id_list( $r['exclude'] );
    $r['ignore_sticky_posts'] = true; $r['no_found_rows'] = true;
    $get_posts = new WP_Query; $posts = $get_posts->query($r); $qu = $get_posts->request; return array('p'=>$posts, 'q'=>$qu);
}}

?>