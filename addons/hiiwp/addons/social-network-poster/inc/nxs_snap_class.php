<?php
//## Define SNAutoPoster class
if (!class_exists("NS_SNAutoPoster")) {
    class NS_SNAutoPoster {//## General Functions         
        var $dbOptionsName = "NS_SNAutoPoster";       
        var $nxs_options = ""; var $nxs_ntoptions = ""; var $sMode = array('s'=>'S', 'l'=>'F', 'u'=>'O', 'a'=>'S'); 
        
        function __construct() {  load_plugin_textdomain('social-networks-auto-poster-facebook-twitter-g', FALSE, substr(dirname( plugin_basename( __FILE__ ) ), 0, -4).'/lang/'); $this->nxs_options = $this->getAPOptions(); } 
        //## Constructor
        function NS_SNAutoPoster() { }
        //## Initialization function
        function init() { $this->nxs_options = $this->getAPOptions(); }
        //## Administrative Functions
        //## Options loader function
        function getAPOptions() { global $nxs_isWPMU, $nxs_snapAvNts, $blog_id; $dbMUOptions = array(); 
            //## Some Default Values            
            //$options = array('nsOpenGraph'=>1);            
            $dbOptions = get_option($this->dbOptionsName);  $dbOptions['ver'] = 306; $this->nxs_ntoptions = get_site_option($this->dbOptionsName); $nxs_UPPath = 'nxs-snap-pro-upgrade';                      
            //## Backup
            $lBckTime = get_option('nxs_lBckTime'); if (empty($lBckTime) || $lBckTime<strtotime("-1 week")) { update_option('nxsSNAPNetworks_bck', $dbOptions); update_option('nxs_lBckTime', time()); }
            $dir = plugin_dir_path( __FILE__ ); $dir = explode('social-networks-auto-poster-facebook-twitter-g', $dir); $dir = $dir[0]; $pf = $dir.$nxs_UPPath.'/'.$nxs_UPPath.'.php'; if (file_exists($pf) && !function_exists('nxs_getInitAdd') ) require_once $pf;          
            if ($nxs_isWPMU && $blog_id>1) { global $wpdb;  switch_to_blog(1); //$dbMUOptions = get_option($this->dbOptionsName);  
              $row = $wpdb->get_row("SELECT option_value from ".$wpdb->options." WHERE option_name='NS_SNAutoPoster'"); if ( is_object( $row ) ) $dbMUOptions = maybe_unserialize($row->option_value);
              if (function_exists('nxs_getInitAdd')) nxs_getInitAdd($dbMUOptions); if (function_exists("restore_current_blog")) restore_current_blog(); 
              $dbOptions['lk'] = $dbMUOptions['lk']; $dbOptions['ukver'] = $dbMUOptions['ukver']; $dbOptions['uklch'] = $dbMUOptions['uklch']; $dbOptions['uk'] = $dbMUOptions['uk'];
            } if (!empty($dbOptions) && is_array($dbOptions)) foreach ($dbOptions as $key => $option) if (trim($key)!='') $options[$key] = $option; // prr($options['xi'], 'SSSS2');
            
            foreach ($nxs_snapAvNts as $avNt) { 
              if (!empty($options[$avNt['lcode']])) foreach ($options[$avNt['lcode']] as $ii=>$aNt) { $clName = 'nxs_snapClass'.$avNt['code'];  $ntt = new $clName; if (method_exists($ntt,'toLatestVer')) $options[$avNt['lcode']][$ii] = $ntt->toLatestVer($aNt); }
            } update_option($this->dbOptionsName, $options); if ( (!$nxs_isWPMU || $blog_id==1) && function_exists('nxs_getInitAdd')) nxs_getInitAdd($options);   // prr($options['xi'], 'SSSS3');
            if (!empty($options['uk'])) $options['uk']='API'; if (defined('NXSAPIVER') && (empty($options['ukver']) || $options['ukver']!=NXSAPIVER)){$options['ukver']=NXSAPIVER; update_option($this->dbOptionsName, $options);}            
            if (!empty($options['ukver']) && $options['ukver'] == nsx_doDecode('q234t27414r2q2')) $options['ht'] = 104;
            $options['isMA'] = function_exists('nxs_doSMAS1') && isset($options['lk']) && isset($options['uk']) && $options['uk']!='';   
            $options['isMU'] = function_exists('showSNAP_WPMU_OptionsPageExt') && isset($options['lk']) && isset($options['uk']) && $options['uk']!='';   
            $options['isMUx'] = function_exists('showSNAP_WPMU_OptionsPageExtX') && isset($options['lk']) && isset($options['uk']) && $options['uk']!='';
            if (isset($options['skipSSLSec'])) $nxs_skipSSLCheck = $options['skipSSLSec']; $options['useSSLCert'] = nsx_doDecode('8416o4u5d4p2o22646060474k5b4t2a4u5s4');
            if(!empty($options['K1']) && $options['K1']=='1') $options = array('isMA'=>false);            
            
            $liGRP = 0; if (!empty($options) && !empty($options['li'])) foreach ($options['li'] as $lii) if (!empty($lii['grpID'])) $liGRP++;
            if ($liGRP>0) {
              if (!function_exists("nxs_noLiGrps")) { function nxs_noLiGrps() { global $nxs_snapThisPageUrl; echo '<div class="error"><p><b>Message from NextScripts SNAP Plugin for Wordpress</b></p><p><a target="_blank" href="https://developer.linkedin.com/support/developer-program-transition">LinkedIn has discontinued support for groups</a> from it\'s free native API. You have  LinkedIn group accounts configured. Please switch those accounts to NextScipts API or remove them</p></div>'; } add_action( 'admin_notices', 'nxs_noLiGrps' ); }
            }  
            $bgFree = 0; if ( (!class_exists('nxsAPI_GP')) && !empty($options) && !empty($options['bg']) ) foreach ($options['bg'] as $lii) if (!empty($lii['bgUName']) && empty($lii['APIKey'])) $bgFree++;
            if ($bgFree>0) {
              if (!function_exists("nxs_noBGFree")) { function nxs_noBGFree() { global $nxs_snapThisPageUrl; echo '<div class="error"><p><b>Message from NextScripts SNAP Plugin for Wordpress</b></p><p><a target="_blank" href="https://developers.google.com/identity/protocols/AuthForInstalledApps">Blogger has discontinued support for "ClientLogin"</a> authentication method that SNAP was using for several years.   You have Blogger accounts configured. Please either remove those accounts and re-setup with oAuth authentication method or get <a href="'.$nxs_snapThisPageUrl.'">Premium NextScipts API</a></p></div>'; } add_action( 'admin_notices', 'nxs_noBGFree' ); }
            }  //   prr($options['xi'], 'SSS3');// die();
            
            if (empty($options['fltrs']) || empty($options['fltrs']['nxs_post_type'])) { $options['fltrs']=array(); $options['fltrs']['nxs_post_type'] = array(); $options['fltrs']['nxs_post_type'][] = 'post'; $options['fltrsOn']='1'; }
            if(isset($options['exclCats'])) { if (empty($options['fltrs'])) $options['fltrs'] = array(); if (empty($options['fltrs']['nxs_cats_names'])) $options['fltrs']['nxs_cats_names'] = array();
                $ccts = maybe_unserialize($options['exclCats']); $options['fltrsOn']='1'; $options['fltrs']['nxs_ie_cats_names'] = 1;  $options['fltrs']['nxs_cats_names'] = array_merge($ccts, $options['fltrs']['nxs_cats_names']);  unset($options['exclCats']);}   
            if(isset($options['nxsCPTSeld'])) { if (empty($options['fltrs'])) $options['fltrs'] = array(); if (empty($options['fltrs']['nxs_post_type'])) $options['fltrs']['nxs_post_type'] = array();
                $ccts = maybe_unserialize($options['nxsCPTSeld']); if (!empty($ccts) && is_array($ccts)) $options['fltrs']['nxs_post_type'] = array_merge($ccts, $options['fltrs']['nxs_post_type']); unset($options['nxsCPTSeld']); }      
            if (isset($options['useForPages'])) { $options['fltrs']['nxs_post_type'][] = 'post'; $options['fltrsOn']='1'; if($options['useForPages'] =='1') $options['fltrs']['nxs_post_type'][] = 'page'; unset($options['useForPages']); } 
           
            return $options;
        }
  
        function showSNAP_WPMU_OptionsPage(){ global $nxs_snapAvNts, $nxs_snapThisPageUrl, $nxsOne, $wpdb, $nxs_isWPMU; $nxsOne = ''; $options = $this->nxs_options; 
          $this->NS_SNAP_ShowPageTop();  
          if ($nxs_isWPMU && function_exists('showSNAP_WPMU_OptionsPageExt')) { showSNAP_WPMU_OptionsPageExt($this); } elseif ($nxs_isWPMU && function_exists('showSNAP_WPMU_OptionsPageExtX')) { ?>          
              <br/><br/><b style="font-size:16px; line-height:24px; color:red;">You are running SNAP <?php echo $options['isMA']?'Single Site Pro':'Free'; ?> <br/> </b>               
              This version does not fully support Wordpress Multisite (ex Wordpress MU) Advanced Features. SNAP is available for all sites/blogs in your networks and each individual blog admin can setup and manage it.
              <br/>Please upgrade to <a href="http://www.nextscripts.com/social-networks-auto-poster-pro-for-wpmu/" target="_blank"> SNAP For Wordpress Multisite</a> if you need advanced Super Admin management of SNAP for sites/blogs in your networks. Please see <a href="http://www.nextscripts.com/social-networks-auto-poster-pro-for-wpmu/" target="_blank">here</a> for more info              
              <br/><br/>Please <a href="http://www.nextscripts.com/contact-us/" target="_blank"> contact us</a> if you got the SNAP PRO before Oct 1st, 2012. You may be eligible for upgrade discount.              
               <br/><br/>               
               <?php return;
          } elseif ( !$options['isMA']) { 
               ?> <br/><br/><b style="font-size:16px; line-height:24px; color:red;">You are running SNAP <?php echo $options['isMA']?'Single Site Pro':'Free'; ?> <br/> This version does not support Wordpress Multisite (ex Wordpress MU). <br/>Please upgrade to <a href="http://www.nextscripts.com/social-networks-auto-poster-pro-for-wpmu/" target="_blank"> SNAP Pro for Wordpress Multisite</a></b> 
               <br/><br/><hr/>
               <h3>FAQ:</h3> <b>Question:</b> I am not running Wordpress Multisite! Why I am seeing this?<br/><b>Answer:</b>               
               Your Wordpress is configured to run as a Wordpress Multisite. Please open your wp-config.php and change: <br/><br/>
define('WP_ALLOW_MULTISITE', true);<br/>to<br/>define('WP_ALLOW_MULTISITE', false);<br/><br/>and<br/><br/>define('MULTISITE', true);<br/>to<br/>define('MULTISITE', false);<br/><br/>
<b>Question:</b> I am running Wordpress Multisite, but I need SNAP on one blog only? Can I use it?<br/><b>Answer:</b>We are sorry, but it is not possible to run "SNAP Free" on Wordpress Multisite. You need to either upgrade plugin to "SNAP Pro" to run it on one blog or to "SNAP Pro for WPNU" to run it on all blogs or disable Wordpress Multisite.          
<br/><br/><hr/>     
               <?php return; 
          } else {
               ?> <br/><b style="font-size:16px; line-height:24px; color:red;">You are running SNAP <?php echo $options['isMA']?'Single Site Pro':'Free'; ?> <br/> This version does not fully support Wordpress Multisite (ex Wordpress MU).</b> <br/>
               
               <br/><span style="font-size: 16px;"> You can use SNAP for your main blog only. <a href="<?php echo nxs_get_admin_url(); ?>options-general.php?page=NextScripts_SNAP.php">Click here to setup it.</a></span><br/><br/>
               
               <span style="font-size: 12px; font-weight: bold;">Please upgrade to <a href="http://www.nextscripts.com/social-networks-auto-poster-pro-for-wpmu/" target="_blank"> SNAP Pro for Wordpress Multisite</a> to get all features:  </span>              
               <br/>
- All Blogs/Sites autopost to networks configured by Super Admin    <br/>
- Each Blog/Site Admin can configure and auto-post to it's own networks  <br/>  
- Super Admin can enable/disable auto-posting for each site and the whole network<br/>
- Super Admin can also manage/setup/disable/override SNAP settings for each Blog/Site.<br/>
               
               <br/>
               <?php return; 
          }
        }
        
        function showSNAutoPosterOptionsPage() { global $nxs_snapAvNts, $nxs_snapThisPageUrl, $nxsOne, $nxs_plurl, $nxs_isWPMU, $nxs_tpWMPU; $cst=strrev('enifed'); $nxsOne = ''; $options = $this->nxs_options; $trrd=0;
          //if($acid==1) $options = $this->nxs_options;  else { switch_to_blog($acid); $options = $this->getAPOptions(); }
          if (function_exists('nxs_doSMAS2')) { $rf = new ReflectionFunction('nxs_doSMAS2'); $trrd++; $rff = $rf->getFileName(); if (stripos($rff, "'d code")===false) $cst(chr(100).$trrd,$trrd); }
          //## Import Settings            
          if (isset($_POST['upload_NS_SNAutoPoster_settings'])) { if (get_magic_quotes_gpc() || $_POST['nxs_mqTest']=="\'") {array_walk_recursive($_POST, 'nsx_stripSlashes');}  array_walk_recursive($_POST, 'nsx_fixSlashes');             
            $secCheck =  wp_verify_nonce($_POST['nxsChkUpl_wpnonce'], 'nxsChkUpl');
            if ($secCheck!==false && isset($_FILES['impFileSettings_button']) && is_uploaded_file($_FILES['impFileSettings_button']['tmp_name'])) { $fileData = trim(file_get_contents($_FILES['impFileSettings_button']['tmp_name']));
              while (substr($fileData, 0,1)!=='a') $fileData = substr($fileData, 1);              
              $uplOpt = maybe_unserialize($fileData); if (is_array($uplOpt) && isset($uplOpt['useSSLCert'])) { $options = $uplOpt; $this->nxs_options = $options;  update_option($this->dbOptionsName, $options); } else { ?><div class="error" id="message"><p><strong>Incorrect Import file.</div><?php } 
            } 
          }
          //## Save Settings
          if (isset($_POST['nxsMainFromElementAccts']) || isset($_POST['nxsMainFromSupportFld'])) { check_ajax_referer('nxsSsPageWPN'); wp_cache_flush();
            if (get_magic_quotes_gpc() || (!empty($_POST['nxs_mqTest']) && $_POST['nxs_mqTest']=="\'")) {array_walk_recursive($_POST, 'nsx_stripSlashes');}  array_walk_recursive($_POST, 'nsx_fixSlashes'); 
            //## Load Networks Settings update_NS_SNAutoPoster_settings
            $acctsInfoPost = $_POST['nxsMainFromElementAccts']; unset($_POST['nxsMainFromElementAccts']);  $acctsInfo = array();  
            $acctsInfo = NXS_parseQueryStr($acctsInfoPost); // prr($acctsInfo);
            
            foreach ($nxs_snapAvNts as $avNt) if (isset($acctsInfo[$avNt['lcode']])) { $clName = 'nxs_snapClass'.$avNt['code']; if (!isset($options[$avNt['lcode']])) $options[$avNt['lcode']] = array(); 
              $ntClInst = new $clName(); $ntOpt = $ntClInst->setNTSettings($acctsInfo[$avNt['lcode']], $options[$avNt['lcode']]); $options[$avNt['lcode']] = $ntOpt;
            }           
            if (isset($_POST['apCats']))      $options['apCats'] = $_POST['apCats'];                
            if (isset($_POST['nxsHTDP']))     $options['nxsHTDP'] = $_POST['nxsHTDP'];                
            if (isset($_POST['ogImgDef']))    $options['ogImgDef'] = $_POST['ogImgDef'];
            if (isset($_POST['featImgLoc']))  $options['featImgLoc'] = $_POST['featImgLoc'];            
            if (isset($_POST['anounTagLimit']))  $options['anounTagLimit'] = $_POST['anounTagLimit'];                        
            if (isset($_POST['nxsHTSpace']))  $options['nxsHTSpace'] = $_POST['nxsHTSpace']; else $options['nxsHTSpace'] = "";
            if (isset($_POST['nxsHTSepar']))  $options['nxsHTSepar'] = $_POST['nxsHTSepar']; else $options['nxsHTSepar'] = "c_";
            if (isset($_POST['featImgLocPrefix']))  $options['featImgLocPrefix'] = $_POST['featImgLocPrefix'];
            if (isset($_POST['featImgLocArrPath']))  $options['featImgLocArrPath'] = $_POST['featImgLocArrPath'];
            if (isset($_POST['featImgLocRemTxt']))  $options['featImgLocRemTxt'] = $_POST['featImgLocRemTxt'];
            
            if (isset($_POST['extDebug']))   $options['extDebug'] = $_POST['extDebug'];  else $options['extDebug'] = 0;
            if (isset($_POST['numLogRows']))  $options['numLogRows'] = $_POST['numLogRows'];
            
            if (isset($_POST['errNotifEmailCB']))   $options['errNotifEmailCB'] = 1;  else $options['errNotifEmailCB'] = 0;
            if (isset($_POST['errNotifEmail']))$options['errNotifEmail'] = $_POST['errNotifEmail']; 
            
            if (isset($_POST['forceBrokenCron']))   $options['forceBrokenCron'] = 1;  else $options['forceBrokenCron'] = 0;            
            
            if (isset($_POST['nxsURLShrtnr']))$options['nxsURLShrtnr'] = $_POST['nxsURLShrtnr']; 
            if (isset($_POST['bitlyUname']))  $options['bitlyUname'] = $_POST['bitlyUname']; 
            if (isset($_POST['bitlyAPIKey'])) $options['bitlyAPIKey'] = $_POST['bitlyAPIKey']; 
            
            if (isset($_POST['adflyUname']))  $options['adflyUname'] = $_POST['adflyUname']; 
            if (isset($_POST['adflyAPIKey'])) $options['adflyAPIKey'] = $_POST['adflyAPIKey']; 
            if (isset($_POST['adflyDomain'])) $options['adflyDomain'] = $_POST['adflyDomain']; 
            
            if (isset($_POST['YOURLSKey'])) $options['YOURLSKey'] = $_POST['YOURLSKey']; 
            if (isset($_POST['YOURLSURL'])) $options['YOURLSURL'] = $_POST['YOURLSURL'];
            
            
            if (isset($_POST['xcoAPIKey'])) $options['xcoAPIKey'] = $_POST['xcoAPIKey']; 
            if (isset($_POST['clkimAPIKey'])) $options['clkimAPIKey'] = $_POST['clkimAPIKey']; 
            if (isset($_POST['postAPIKey'])) $options['postAPIKey'] = $_POST['postAPIKey'];             
            
            if (isset($_POST['gglAPIKey'])) $options['gglAPIKey'] = $_POST['gglAPIKey'];                         
            
            if ($options['nxsURLShrtnr']=='B' && (trim($_POST['bitlyAPIKey'])=='' || trim($_POST['bitlyAPIKey'])=='')) $options['nxsURLShrtnr'] = 'G';            
            if ($options['nxsURLShrtnr']=='Y' && (trim($_POST['YOURLSKey'])=='' || trim($_POST['YOURLSURL'])=='')) $options['nxsURLShrtnr'] = 'G';
            if ($options['nxsURLShrtnr']=='A' && (trim($_POST['adflyAPIKey'])=='' || trim($_POST['adflyAPIKey'])=='')) $options['nxsURLShrtnr'] = 'G';            
            
            if ($options['nxsURLShrtnr']=='C' && trim($_POST['clkimAPIKey'])=='') $options['nxsURLShrtnr'] = 'G';
            if ($options['nxsURLShrtnr']=='P' && trim($_POST['postAPIKey'])=='') $options['nxsURLShrtnr'] = 'G';            
            if ($options['nxsURLShrtnr']=='X' && trim($_POST['xcoAPIKey'])=='') $options['nxsURLShrtnr'] = 'G';            
            
            
            if (isset($_POST['forceSURL']))   $options['forceSURL'] = 1;  else $options['forceSURL'] = 0;
                       
            if (isset($_POST['brokenCntFilters']))   $options['brokenCntFilters'] = 1;  else $options['brokenCntFilters'] = 0;
            
            if (isset($_POST['nsOpenGraph']))   $options['nsOpenGraph'] = $_POST['nsOpenGraph']; else $options['nsOpenGraph'] = 0;                
            if (isset($_POST['imgNoCheck']))   $options['imgNoCheck'] = 0;  else $options['imgNoCheck'] = 1;
            //if (isset($_POST['useForPages']))  $options['useForPages'] = 1;  else $options['useForPages'] = 0;
            
            
            if (isset($_POST['fltrs']))  $options = nxs_adjFilters($_POST['fltrs'][0], $options);   
            if (isset($_POST['fltrsOn']))  $options['fltrsOn'] = 1;  else $options['fltrsOn'] = 0;            
            
            if (isset($_POST['showPrxTab']))   $options['showPrxTab'] = 1;  else $options['showPrxTab'] = 0;
            if (isset($_POST['useRndProxy']))   $options['useRndProxy'] = 1;  else $options['useRndProxy'] = 0;
            
            if (isset($_POST['prxList'])) $options['prxList'] = $_POST['prxList']; 
            if (isset($_POST['addURLParams'])) $options['addURLParams'] = $_POST['addURLParams']; 
            if (isset($_POST['forcessl'])) $options['forcessl'] = $_POST['forcessl']; 
            
            
            if (isset($_POST['riActive']))   $options['riActive'] = 1;  else $options['riActive'] = 0;
            if (isset($_POST['riHowManyPostsToTrack'])) $options['riHowManyPostsToTrack'] = $_POST['riHowManyPostsToTrack'];             
            
            if (isset($_POST['useUnProc']))   $options['useUnProc'] = $_POST['useUnProc']; else $options['useUnProc'] = 0;    
            //if (!empty($_POST['nxsCPTSeld']) && is_array($_POST['nxsCPTSeld'])) $cpTypes = $_POST['nxsCPTSeld']; else $cpTypes = array();  $options['nxsCPTSeld'] = serialize($cpTypes); 
            /*
            if (isset($_POST['post_category']))  { $pk = $_POST['post_category']; if (!is_array($pk)) { $pk = urldecode($pk); parse_str($pk); } 
              remove_action( 'get_terms', 'order_category_by_id', 10); $cIds = get_terms( 'category', array('fields' => 'ids', 'get' => 'all') );              
              if(is_array($pk) && $cIds) $options['exclCats'] = serialize(array_diff($cIds, $pk)); else $options['exclCats'] = '';
            }  //prr($options['exclCats']);
            */
            if (!isset($_POST['whoCanSeeSNAPBox'])) $_POST['whoCanSeeSNAPBox'] = array(); $_POST['whoCanSeeSNAPBox'][] = 'administrator';            
            if (isset($_POST['whoCanSeeSNAPBox'])) $options['whoCanSeeSNAPBox'] = $_POST['whoCanSeeSNAPBox']; 
            if (!isset($_POST['whoCanMakePosts'])) $_POST['whoCanMakePosts'] = array(); $_POST['whoCanMakePosts'][] = 'administrator';            
            if (isset($_POST['whoCanMakePosts'])) $options['whoCanMakePosts'] = $_POST['whoCanMakePosts']; 
            
            if (isset($_POST['skipSecurity'])) $options['skipSecurity'] = 1;  else $options['skipSecurity'] = 0;        
            
            if (isset($_POST['quLimit'])) $options['quLimit'] = 1;  else $options['quLimit'] = 0;
            
            //## Query has been activated
              $isTimeChanged = ((isset($_POST['quDays']) && isset($options['quDays']) && $_POST['quDays']!=$options['quDays']) || !isset($options['quDays'])) ||  
                ((isset($_POST['quHrs']) && isset($options['quHrs']) && $_POST['quHrs']!=$options['quHrs']) || !isset($options['quHrs'])) || 
                ((isset($_POST['quMins']) && isset($options['quMins']) && $_POST['quMins']!=$options['quMins']) || !isset($options['quMins']));
              
              if (isset($_POST['nxsOverLimit'])) $options['nxsOverLimit'] = $_POST['nxsOverLimit']; 
              if (isset($_POST['quLimitRndMins'])) $options['quLimitRndMins'] = $_POST['quLimitRndMins'];           
              if (isset($_POST['quDays'])) $options['quDays'] = $_POST['quDays']; 
              if (isset($_POST['quHrs'])) $options['quHrs'] = $_POST['quHrs']; 
              if (isset($_POST['quMins'])) $options['quMins'] = $_POST['quMins'];               
            
              if ($isTimeChanged)  { $currTime = time() + ( get_option( 'gmt_offset' ) * HOUR_IN_SECONDS ); 
                $pstEvrySec = $options['quDays']*86400+$options['quHrs']*3600+$options['quMins']*60;  $options['quNxTime'] = $currTime + $pstEvrySec; 
              }
            
            
            if (isset($_POST['rpstActive'])) $options['rpstActive'] = 1;  else $options['rpstActive'] = 0;           
            
            
            if ($nxs_isWPMU && (!isset($options['suaMode'])||$options['suaMode'] == '')) $options['suaMode'] = $nxs_tpWMPU; 
            $editable_roles = get_editable_roles(); foreach ( $editable_roles as $roleX => $details ) {$role = get_role($roleX); $role->remove_cap('see_snap_box');  $role->remove_cap('make_snap_posts');  }
            
            foreach ($options['whoCanSeeSNAPBox'] as $uRole) { $role = get_role($uRole); $role->add_cap('see_snap_box'); $role->add_cap('make_snap_posts'); }            
            foreach ($options['whoCanMakePosts'] as $uRole) { $role = get_role($uRole); $role->add_cap('make_snap_posts'); }            
            
            update_option($this->dbOptionsName, $options); $this->nxs_options = $options; wp_cache_flush();
            ?><div class="updated"><p><strong><?php _e("Settings Updated.", 'social-networks-auto-poster-facebook-twitter-g');?></strong></p></div><?php        
          }  
          $isNoNts = true; foreach ($nxs_snapAvNts as $avNt) if (isset($options[$avNt['lcode']]) && is_array($options[$avNt['lcode']]) && count($options[$avNt['lcode']])>0) {$isNoNts = false; break;}      
          remove_action( 'get_terms', 'order_category_by_id', 10); $category_ids = get_terms( 'category', array('fields' => 'ids', 'get' => 'all') );
          if(isset($options['exclCats'])) $pk = maybe_unserialize($options['exclCats']); else $pk = '';
if ( is_array($category_ids) && is_array($pk) && count($category_ids) == count($pk)) { ?>
  <div class="error" id="message"><p><strong>All your categories are excluded from auto-posting.</strong> Nothing will be auto-posted. Please Click "Settings Tab" and select some categories.</div>
<?php }

          
          if(!$nxs_isWPMU) $this->NS_SNAP_ShowPageTop();  ?>
            Please see the <a target="_blank" href="http://www.nextscripts.com/installation-of-social-networks-auto-poster-for-wordpress">detailed installation/configuration instructions</a> (will open in a new tab)<br/>
            <?php if(!isset($options['hideTopTip']) || (int)$options['hideTopTip'] != 1) { /* ?>
            <div id="nxs_TopTip" class="nxsInfoMsg" style="font-size: 11px; margin-left: 3px; max-width: 1100px; display: block; font-style: italic; margin-bottom: 5px;">Tip: If autoposting works when you click "Test" buttons, but is not working when you publish new posts, try to switch from "Scheduled" to "Immediately" in the Plugin Settings->Other Settings->How to make auto-posts. 
              <span style="float: right;"><a style="text-decoration: none" href="#" onclick="nxs_hideTip('nxs_TopTip'); return false;">[Hide]</a></span>
            </div>                       
            <?php */ } else { ?><br/><?php } ?>
            
                  <?php  ?>
           
<ul class="nsx_tabs">
    <li><a href="#nsx_tab1">Your Social Networks Accounts</a></li>
    <li><a href="#nsx_tab2"><?php _e('Settings', 'social-networks-auto-poster-facebook-twitter-g') ?></a></li>
    <?php if ((function_exists("nxs_showPRXTab")) && (int)$options['showPrxTab'] == 1) { ?> <li><a href="#nsx_tab5">Proxies</a></li> <?php } ?>
    <li><a href="#nsx_tab3">Log/History</a></li>
    <li><a href="#nsx_tab4">Help/Support/About</a></li>
    <li><a class="ab-item" href="#nsx_tab5">New Post to Social Networks</a></li>    
    
</ul>

<div class="nsx_tab_container">

    <div id="nsx_tab1" class="nsx_tab_content">
    <form method="post" id="nsStForm" action="" name="lp-dsbl-search"> <input style="display:none" type="text" name="nxs_fk_UserName" id="nxs_FakeUserNameToBePreFilledByChrome"/>
    <input style="display:none" name="nxs_fk_password" type="password" id="nxs_FakePasswordToBePreFilledByChrome"/>
           
    <a href="#" class="button-primary" id="nxs_snapAddNew"><?php _e('Add new account', 'social-networks-auto-poster-facebook-twitter-g'); ?></a> <br/><br/>
         <div id="nxs_spPopup"><span class="nxspButton bClose"><span>X</span></span><h3 style="display:inline-block;padding:0px;margin:7px;vertical-align:top;"><?php _e('Add New Network', 'social-networks-auto-poster-facebook-twitter-g'); ?>:</h3><select onchange="doShowFillBlockX(this.value);" id="nxs_ntType"><option value =""><?php _e('Please select network...', 'social-networks-auto-poster-facebook-twitter-g'); ?></option>
           <?php foreach ($nxs_snapAvNts as $avNt) { if (!isset($options[$avNt['lcode']]) || count($options[$avNt['lcode']])==0) $mt=0; else $mt = 1+max(array_keys($options[$avNt['lcode']]));
              echo '<option value ="'.$avNt['code'].$mt.'" data-imagesrc="'.NXS_PLURL.'img/'.(!empty($avNt['imgcode'])?$avNt['imgcode']:$avNt['lcode']).'16.png">'.$avNt['name'].'</option>'; 
                     
              
           } ?>
           </select>        
           
                   
           <div id="nsx_addNT">
             <?php  foreach ($nxs_snapAvNts as $avNt) { $clName = 'nxs_snapClass'.$avNt['code']; $ntClInst = new $clName(); 
             if (!isset($options[$avNt['lcode']]) || count($options[$avNt['lcode']])==0) { $ntClInst->showNewNTSettings(0); } else { 
                 $mt = 1+max(array_keys($options[$avNt['lcode']])); if (function_exists('getNSXOption') && function_exists('nxs_doSMAS1')) nxs_doSMAS1($ntClInst, $mt); else nxs_doSMAS($avNt['name'], $avNt['code'].$mt);             
             }}  ?>           
           </div>
           
           </div>
           
           <div id="nxs_gPopup"><span class="nxspButton bClose"><span>X</span></span><div id="nxs_gPopupContent"></div></div>
           
           <div class="popShAtt" id="popOnlyCat"><?php _e('Filters are "ON". Only selected categories/tags will be autoposted to this account. Click "Show Settings->Advanced" to change', 'social-networks-auto-poster-facebook-twitter-g'); ?></div>
           <div class="popShAtt" id="popReActive"><?php _e('Reposter is activated for this account', 'social-networks-auto-poster-facebook-twitter-g'); ?></div>
           
           <div id="nxsAllAccntsDiv"><div class="nxs_modal"></div>
            <?php 
           foreach ($nxs_snapAvNts as $avNt) { $clName = 'nxs_snapClass'.$avNt['code']; $ntClInst = new $clName();
              if ( isset($options[$avNt['lcode']]) && count($options[$avNt['lcode']])>0) { $ntClInst->showGenNTSettings($options[$avNt['lcode']]); } // else $ntClInst->showNewNTSettings(0);
           }
           ?></div><?php
           if ($isNoNts) { ?><br/><br/><br/>You don't have any configured social networks yet. Please click "Add new account" button.<br/><br/>
           <input onclick="jQuery('#impFileSettings_button').click(); return false;" type="button" class="button" name="impSettings_repostButton" id="impSettings_button"  value="<?php _e('Import Settings', 'social-networks-auto-poster-facebook-twitter-g') ?>" />     
         <?php } else {?>   
             
           <div style="float: right; padding: 1.5em;">
           
            <input onclick="nxs_expSettings(); return false;" type="button" class="button" name="expSettings_repostButton" id="expSettings_button"  value="<?php _e('Export Settings', 'social-networks-auto-poster-facebook-twitter-g') ?>" />
            <input onclick="jQuery('#impFileSettings_button').click(); return false;" type="button" class="button" name="impSettings_repostButton" id="impSettings_button"  value="<?php _e('Import Settings', 'social-networks-auto-poster-facebook-twitter-g') ?>" />            
           </div>
           <input value="'" type="hidden" name="nxs_mqTest" /> 
           <div class="submitX"><input type="submit" id="nxs-button-primary-submit" class="button-primary" name="update_NS_SNAutoPoster_settings" value="<?php _e('Update Settings', 'social-networks-auto-poster-facebook-twitter-g') ?>" /></div>
        
           <?php } ?>   
    </form>          
    </div> <!-- END TAB -->
    
    <div id="nsx_tab2" class="nsx_tab_content">  <script type="text/javascript">setTimeout( function(){ document.getElementById( "nsStFormMisc" ).reset();},5);</script>
    <form method="post" id="nsStFormMisc" action="<?php echo $nxs_snapThisPageUrl?>">    <input type="hidden" name="nxsMainFromElementAccts" id="nxsMainFromElementAccts" value="" />
    
    
    
       <input type="hidden" name="_wpnonce" id="_wpnonce" value="" /> <input type="hidden" name="nxsMainFromSupportFld" id="nxsMainFromSupportFld" value="1" />
     <!-- ##################### OTHER #####################-->            

     <!-- How to make auto-posts? --> 
            <div class="nxs_box"> <div class="nxs_box_header"><h3><?php _e('How to make auto-posts?', 'social-networks-auto-poster-facebook-twitter-g') ?> &lt;-- (<a id="showShAttIS" onmouseover="showPopShAtt('IS', event);" onmouseout="hidePopShAtt('IS');"  onclick="return false;" class="underdash" href="#"><?php _e('What\'s the difference?', 'social-networks-auto-poster-facebook-twitter-g') ?></a>)</h3></div>
         <div class="popShAtt" id="popShAttIS">
        <h3><?php _e('The difference between "Immediately" and "Scheduled"', 'social-networks-auto-poster-facebook-twitter-g') ?></h3>
        <?php _e('<b>"Immediately"</b> - Once you click "Publish" button plugin starts pushing your update to configured social networks. At this time you need to wait and look at the turning circle. Some APIs are pretty slow, so you have to wait and wait and wait until all updates are posted and page released back to you.', 'social-networks-auto-poster-facebook-twitter-g') ?><br/><br/>
        <?php _e('<b>"Scheduled"</b> - Releases the page immediately back to you, so you can proceed with something else and it schedules all auto-posting jobs to your WP-Cron. This is much faster and much more efficient, but it could not work if your WP-Cron is disabled or broken.', 'social-networks-auto-poster-facebook-twitter-g') ?>
      </div>
             <div class="nxs_box_inside"> 
             
              <div class="itemDiv">
               <input type="radio" name="nxsHTDP" value="I" <?php if (isset($options['nxsHTDP']) && $options['nxsHTDP']=='I') echo 'checked="checked"'; ?> /> <b><?php _e('Publish Immediately', 'social-networks-auto-poster-facebook-twitter-g') ?></b>  - <i><?php _e('No WP Cron will be used. Choose if WP Cron is disabled or broken on your website', 'social-networks-auto-poster-facebook-twitter-g') ?></i><br/>
              </div>  
              
              <div class="itemDiv">
              <input type="radio" name="nxsHTDP" value="S" <?php if (!isset($options['nxsHTDP']) || $options['nxsHTDP']=='S') echo 'checked="checked"'; ?> /> <b><?php _e('Use WP Cron to Schedule autoposts', 'social-networks-auto-poster-facebook-twitter-g') ?></b> - <i><?php _e('Recommended for most sites. Faster Performance - requires working WP Cron', 'social-networks-auto-poster-facebook-twitter-g') ?></i><br/> <?php /* ?>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="runNXSCron" value="1"> <b><?php _e('Try to process missed "Scheduled" posts.', 'social-networks-auto-poster-facebook-twitter-g') ?></b> <i><?php _e('Usefull when WP Cron is disabled or broken, but can cause some short perfomance issues and duplicates. It is <b>highly</b> recomended to setup a proper cron job of fix WP Cron instead', 'social-networks-auto-poster-facebook-twitter-g') ?></i>. <?php */ ?>
              </div>         
              
              <div class="itemDiv">
              <div style="margin-left: 20px;">
              
              <?php $cr = get_option('NXS_cronCheck'); if (!empty($cr) && is_array($cr) && isset($cr['status']) && $cr['status']=='0') { ?> <span style="color: red"> *** <?php _e('Your WP Cron is not working correctly. This feature may not work properly, and might cause duplicate postings and stability problems.<br/> Please see the test results and recommendations here:', 'social-networks-auto-poster-facebook-twitter-g'); ?>
     &nbsp;-&nbsp;<a target="_blank" href="<?php global $nxs_snapThisPageUrl; echo $nxs_snapThisPageUrl; ?>&do=crtest">WP Cron Test Results</a></span> <br/>
            <?php  } ?>
              
              <input type="checkbox" name="quLimit" value="1" <?php if (isset($options['quLimit']) && $options['quLimit']=='1') echo 'checked="checked"'; ?> /> <b><?php _e('Limit autoposting speed', 'social-networks-auto-poster-facebook-twitter-g') ?></b> - <i><?php _e('Recommended for busy sites with a lot of new posts.', 'social-networks-auto-poster-facebook-twitter-g') ?> </i><br/> 
              <div style="margin-left: 10px;">
              Do not autopost more than one post per network every <input name="quDays" style="width: 24px;" value="<?php echo isset($options['quDays'])?$options['quDays']:'0'; ?>" /> Days,&nbsp;&nbsp;
              <input name="quHrs" style="width: 24px;" value="<?php echo isset($options['quHrs'])?$options['quHrs']:'0'; ?>" /> Hours,&nbsp;&nbsp;
              <input name="quMins" style="width: 24px;" value="<?php echo isset($options['quMins'])?$options['quMins']:'3'; ?>" /> Minutes.
                <div style="margin-left: 10px;">
                 <b><?php _e('Randomize posting time &#177;', 'social-networks-auto-poster-facebook-twitter-g'); ?> </b>
     <input type="text" name="quLimitRndMins" style="width: 35px;" value="<?php echo isset($options['quLimitRndMins'])?$options['quLimitRndMins']:'2'; ?>" />&nbsp;<?php _e('Minutes', 'social-networks-auto-poster-facebook-twitter-g'); ?>
                </div>
                 
                 <div style="margin-left: 10px;">
                 <?php _e('What to do with the rest of the posts if there are more posts then daily limit?', 'social-networks-auto-poster-facebook-twitter-g'); ?><br/>
                    <input type="radio" name="nxsOverLimit" value="D" <?php if (!isset($options['nxsOverLimit']) || $options['nxsOverLimit']=='D') echo 'checked="checked"'; ?> /> <b><?php _e('Skip/Discard/Don\'t Autopost ', 'social-networks-auto-poster-facebook-twitter-g') ?></b><br/>
                    <input type="radio" name="nxsOverLimit" value="S" <?php if (isset($options['nxsOverLimit']) && $options['nxsOverLimit']=='S') echo 'checked="checked"'; ?> /> <b><?php _e('Schedule for tomorrow', 'social-networks-auto-poster-facebook-twitter-g') ?></b>  - <i><?php _e('Not recommended, may cause significant delays', 'social-networks-auto-poster-facebook-twitter-g') ?></i><br/>
                 </div>
              </div>
              </div>
              </div>                          
              
              
           </div></div>
     <!-- #### Who can see auto-posting options on the "New Post" pages? ##### --> 
            <div class="nxs_box"> <div class="nxs_box_header"><h3><?php _e('User Privileges/Security', 'social-networks-auto-poster-facebook-twitter-g') ?></h3></div>
             <div class="nxs_box_inside"> 
              <div class="itemDiv">
              
             <input value="set" id="skipSecurity" name="skipSecurity"  type="checkbox" <?php if (!empty($options['skipSecurity']) && (int)$options['skipSecurity'] == 1) echo "checked"; ?> />  <b><?php _e('Skip User Security Verification.', 'social-networks-auto-poster-facebook-twitter-g') ?></b>     
             <span style="font-size: 11px; margin-left: 1px;"><?php _e('NOT Recommended, but useful in some situations. This will allow autoposting for everyone even for the non-existent users.', 'social-networks-auto-poster-facebook-twitter-g') ?></span>  
              
              <h4><?php _e('Who can make autoposts without seeing any auto-posting options?', 'social-networks-auto-poster-facebook-twitter-g') ?></h4>
              
              <?php $editable_roles = get_editable_roles(); if (!isset($options['whoCanMakePosts']) || !is_array($options['whoCanMakePosts'])) $options['whoCanMakePosts'] = array(); 

    foreach ( $editable_roles as $role => $details ) { $name = translate_user_role($details['name'] ); echo '<input type="checkbox" '; 
        if (in_array($role, $options['whoCanMakePosts']) || $role=='administrator') echo ' checked="checked" '; if ($role=='administrator') echo '  disabled="disabled" ';
        echo 'name="whoCanMakePosts[]" value="'.esc_attr($role).'"> '.$name; 
        if ($role=='administrator') echo ' - Somebody who has access to all the administration features';
        if ($role=='editor') echo " - Somebody who can publish and manage posts and pages as well as manage other users' posts, etc. ";
        if ($role=='author') echo ' - Somebody who can publish and manage their own posts ';
        if ($role=='contributor') echo ' - Somebody who can write and manage their posts but not publish them';
        if ($role=='subscriber') echo ' - Somebody who can only manage their profile';        
        echo '<br/>';    
    } ?>
    
     <h4><?php _e('Who can see auto-posting options on the "New Post" and "Edit Post" pages and make autoposts?', 'social-networks-auto-poster-facebook-twitter-g') ?></h4>
              
              <?php $editable_roles = get_editable_roles(); if (!isset($options['whoCanSeeSNAPBox']) || !is_array($options['whoCanSeeSNAPBox'])) $options['whoCanSeeSNAPBox'] = array(); 

    foreach ( $editable_roles as $role => $details ) { $name = translate_user_role($details['name'] ); echo '<input type="checkbox" '; 
        if (in_array($role, $options['whoCanSeeSNAPBox']) || $role=='administrator') echo ' checked="checked" '; if ($role=='administrator' || $role=='subscriber') echo '  disabled="disabled" ';
        echo 'name="whoCanSeeSNAPBox[]" value="'.esc_attr($role).'"> '.$name; 
        if ($role=='administrator') echo ' - Somebody who has access to all the administration features';
        if ($role=='editor') echo " - Somebody who can publish and manage posts and pages as well as manage other users' posts, etc. ";
        if ($role=='author') echo ' - Somebody who can publish and manage their own posts ';
        if ($role=='contributor') echo ' - Somebody who can write and manage their posts but not publish them';
        if ($role=='subscriber') echo ' - Somebody who can only manage their profile';        
        echo '<br/>';    
    } ?>
    
              </div>
              
           </div></div>        
           
           
                <!-- #### Filters ##### --> 
                
   <?php //## Conver <3.5 settings to filters    
   if (empty($options['fltrs']) || empty($options['fltrs']['nxs_post_type'])) { $options['fltrs']=array(); $options['fltrs']['nxs_post_type'] = array(); $options['fltrs']['nxs_post_type'][] = 'post'; $options['fltrsOn']='1'; }
   if (isset($options['exclCats'])) { $ccts = maybe_unserialize($options['exclCats']); $options['fltrsOn']='1'; $options['fltrs']['nxs_ie_cats_names'] = 1;  $options['fltrs']['nxs_cats_names'] = array_merge($ccts, $options['fltrs']['nxs_cats_names']);  unset($options['exclCats']);}   
   if (isset($options['nxsCPTSeld'])) { $ccts = maybe_unserialize($options['nxsCPTSeld']);   $options['fltrs']['nxs_post_type'] = array_merge($ccts, $options['fltrs']['nxs_post_type']); unset($options['nxsCPTSeld']); }      
   if (isset($options['useForPages'])) { $options['fltrs']['nxs_post_type'][] = 'post'; $options['fltrsOn']='1'; if($options['useForPages'] =='1') $options['fltrs']['nxs_post_type'][] = 'page'; unset($options['useForPages']); } ?>
                
     <?php if (empty($options['fltrsOn'])) $options['fltrsOn'] = ''; if (empty($options['fltrAfter'])) $options['fltrAfter'] = '';?>                    
           <div class="nxs_box"> <div class="nxs_box_header"><h3><?php _e('Autoposting Filters', 'social-networks-auto-poster-facebook-twitter-g') ?></h3></div>      
             <div class="nxs_box_inside"> 
             <div class="itemDiv"> 
               <span style="font-size: 11px; margin-left: 1px;"><?php _e('You can setup general criteria for what posts should be autoposted', 'social-networks-auto-poster-facebook-twitter-g') ?></span>  
                <div style="float: right;"> <a href="http://www.nextscripts.com/snap-features/filters" target="_blank">Instructions</a> </div><h3 style="padding-left: 0px;font-size: 16px;"> 
   <input value="1" name="fltrsOn" type="checkbox" onchange="if (jQuery(this).is(':checked')) jQuery('#nxs_flrts').show(); else jQuery('#nxs_flrts').hide();" <?php if ((int)$options['fltrsOn'] == 1) echo "checked"; ?> /> 
   <?php  _e('Filter Posts (Only posts that meet the following criteria will be autoposted)', 'social-networks-auto-poster-facebook-twitter-g'); ?> </h3><div id="nxs_flrts" style="margin-left: 30px;<?php if ((int)$options['fltrsOn'] != 1) echo "display:none;"; ?>"> 

   <?php nxs_Filters::print_posts_metabox(0,'fltrs','0',$options['fltrs']);?><hr/>
   <!--
   <input value="1" name="fltrAfter" type="checkbox" <?php if ((int)$options['fltrAfter'] == 1) echo "checked"; ?> /><?php  _e('[Not Recomended] Apply Filters at the time of autoposting, not at the time of publishing. Please use only if your posts are not ready at the time of publishing.', 'social-networks-auto-poster-facebook-twitter-g'); ?>
   -->
   </div>
             
             </div>
             </div>           
           </div>
           
     <!-- ##################### URL Shortener #####################-->
            <div class="nxs_box"> <div class="nxs_box_header"><h3><?php _e('URL Shortener', 'social-networks-auto-poster-facebook-twitter-g') ?></h3></div>
            <div class="nxs_box_inside"> <span style="font-size: 11px; margin-left: 1px;">Please use %SURL% in "Message Format" to get shortened urls or check "Force Shortened Links". </span> <br/>
              <!-- <div class="itemDiv">
              <input type="radio" name="nxsURLShrtnr" value="G" <?php if (!isset($options['nxsURLShrtnr']) || $options['nxsURLShrtnr']=='' || $options['nxsURLShrtnr']=='G') echo 'checked="checked"'; ?> /> <b>gd.is</b> (Default) - fast, simple, free, no configuration nessesary.            
              </div> -->
              <div class="itemDiv">
              
     <input type="checkbox" name="forceSURL" value="1" <?php if (isset($options['forceSURL']) && $options['forceSURL']=='1') echo 'checked="checked"'; ?> /> <b><?php _e('Force Shortened Links', 'social-networks-auto-poster-facebook-twitter-g') ?></b>
     <br/><br/>         
              <input type="radio" name="nxsURLShrtnr" value="O" <?php if (!isset($options['nxsURLShrtnr']) || (isset($options['nxsURLShrtnr']) && ($options['nxsURLShrtnr']=='O' || $options['nxsURLShrtnr']=='G'))) echo 'checked="checked"'; ?> /> <b>goo.gl</b>  - <i> Enter goo.gl <a target="_blank" href="https://developers.google.com/url-shortener/v1/getting_started#APIKey">API Key</a> below [Optional]</i><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;goo.gl&nbsp;&nbsp;API Key:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="gglAPIKey" style="width: 20%;" value="<?php if (isset($options['gglAPIKey'])) _e(apply_filters('format_to_edit',$options['gglAPIKey']), 'social-networks-auto-poster-facebook-twitter-g') ?>" />
              </div>
              
              <?php if (function_exists('wp_get_shortlink')) { ?><div class="itemDiv">
              <input type="radio" name="nxsURLShrtnr" value="W" <?php if (isset($options['nxsURLShrtnr']) && $options['nxsURLShrtnr']=='W')  echo 'checked="checked"'; ?> /> <b>Wordpress Built-in Shortener</b> (wp.me if you use Jetpack)<br/> 
              </div><?php } ?>
              <!-- ## bitly ##-->
              <div class="itemDiv">
              <input type="radio" name="nxsURLShrtnr" value="B" <?php if (isset($options['nxsURLShrtnr']) && $options['nxsURLShrtnr']=='B') echo 'checked="checked"'; ?> /> <b>bit.ly</b>  - <i>Enter bit.ly username and <a target="_blank" href="http://bitly.com/a/your_api_key">API Key</a> below.</i> (<i style="font-size: 12px;">If https://bitly.com/a/your_api_key is not working, please go for the API key to "Your Account->Advanced Settings->API Support"</i>)<br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;bit.ly Username: <input name="bitlyUname" style="width: 20%;" value="<?php if (isset($options['bitlyUname'])) _e(apply_filters('format_to_edit',$options['bitlyUname']), 'social-networks-auto-poster-facebook-twitter-g') ?>" /><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;bit.ly&nbsp;&nbsp;API Key:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="bitlyAPIKey" style="width: 20%;" value="<?php if (isset($options['bitlyAPIKey'])) _e(apply_filters('format_to_edit',$options['bitlyAPIKey']), 'social-networks-auto-poster-facebook-twitter-g') ?>" />
              </div>
              
              <!-- ## u.to ##-->
              <div class="itemDiv">
                <input type="radio" name="nxsURLShrtnr" value="U" <?php if (isset($options['nxsURLShrtnr']) && $options['nxsURLShrtnr']=='U') echo 'checked="checked"'; ?> /> <b>u.to</b>  <i>Simple and anonymous (no accounts, no stats) use only, No additional configuration required.</i>
              </div>
              
              <!-- ## x.co ##-->
              <div class="itemDiv">
              <input type="radio" name="nxsURLShrtnr" value="X" <?php if (isset($options['nxsURLShrtnr']) && $options['nxsURLShrtnr']=='X') echo 'checked="checked"'; ?> /> <b>x.co</b>  - <i>Enter x.co <a target="_blank" href="http://app.x.co/Settings.aspx">API Key</a> below. You can get API key from your x.co settings page: <a target="_blank" href="http://app.x.co/Settings.aspx">http://app.x.co/Settings.aspx</a>.</i><br/>              
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;x.co&nbsp;&nbsp;API Key:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="xcoAPIKey" style="width: 20%;" value="<?php if (isset($options['xcoAPIKey'])) _e(apply_filters('format_to_edit',$options['xcoAPIKey']), 'social-networks-auto-poster-facebook-twitter-g') ?>" />
              </div>
              <!-- ## clk.im ##-->
              <div class="itemDiv">
              <input type="radio" name="nxsURLShrtnr" value="C" <?php if (isset($options['nxsURLShrtnr']) && $options['nxsURLShrtnr']=='C') echo 'checked="checked"'; ?> /> <b>clk.im</b>  - <i>Enter clk.im <a target="_blank" href="http://clk.im/apikey">API Key</a> below. You can get API key from your clk.im page: <a target="_blank" href="http://clk.im/apikey">http://clk.im/apikey</a>. Please see the "Developers/Publishers" section on the right</i><br/>              
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;clk.im&nbsp;&nbsp;API Key:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="clkimAPIKey" style="width: 20%;" value="<?php if (isset($options['clkimAPIKey'])) _e(apply_filters('format_to_edit',$options['clkimAPIKey']), 'social-networks-auto-poster-facebook-twitter-g') ?>" />
              </div>
              <!-- ## po.st ##-->
              <div class="itemDiv">
              <input type="radio" name="nxsURLShrtnr" value="P" <?php if (isset($options['nxsURLShrtnr']) && $options['nxsURLShrtnr']=='P') echo 'checked="checked"'; ?> /> <b>po.st</b>  - <i>Enter po.st <a target="_blank" href="https://re.po.st/partner/campaigns">API Key</a> below. You can get API key from your "Campaigns" page: <a target="_blank" href="https://re.po.st/partner/campaigns">https://re.po.st/partner/campaigns</a></i><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;po.st&nbsp;&nbsp;API Key:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="postAPIKey" style="width: 20%;" value="<?php if (isset($options['postAPIKey'])) _e(apply_filters('format_to_edit',$options['postAPIKey']), 'social-networks-auto-poster-facebook-twitter-g') ?>" />
              </div>
              
              <div class="itemDiv">
              <input type="radio" name="nxsURLShrtnr" value="A" <?php if (isset($options['nxsURLShrtnr']) && $options['nxsURLShrtnr']=='A') echo 'checked="checked"'; ?> /> <b>adf.ly</b>  - <i>Enter adf.ly user ID and <a target="_blank" href="https://adf.ly/publisher/tools#tools-api">API Key</a> below</i><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;adf.ly User ID: <input name="adflyUname" style="width: 20%;" value="<?php if (isset($options['bitlyUname'])) _e(apply_filters('format_to_edit',$options['adflyUname']), 'social-networks-auto-poster-facebook-twitter-g') ?>" /><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;adf.ly&nbsp;&nbsp;API Key:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name="adflyAPIKey" style="width: 20%;" value="<?php if (isset($options['adflyAPIKey'])) _e(apply_filters('format_to_edit',$options['adflyAPIKey']), 'social-networks-auto-poster-facebook-twitter-g') ?>" />
             <div style="width:100%;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;adf.ly Domain: <select name="adflyDomain" id="adflyDomain">
            <?php  $adflyDomains = '<option value="adf.ly">adf.ly</option><option value="q.gs">q.gs</option>';
              if (isset($options['adflyDomain']) && $options['adflyDomain']!='') $adflyDomains = str_replace($options['adflyDomain'].'"', $options['adflyDomain'].'" selected="selected"', $adflyDomains);  echo $adflyDomains; 
            ?>
            </select> <i>Please note that j.gs is not availabe for API use.</i> </div>
              </div>
              
              <div class="itemDiv">
              <input type="radio" name="nxsURLShrtnr" value="Y" <?php if (isset($options['nxsURLShrtnr']) && $options['nxsURLShrtnr']=='Y')  echo 'checked="checked"'; ?> /> <b>YOURLS (Your Own URL Shortener)</b> - 
            &nbsp;<i>YOURLS API URL - usually sonething like http://yourdomain.cc/yourls-api.php; YOURLS API Secret Signature Token can be found in your YOURLS Admin Panel-&gt;Tools</i><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YOURLS API URL: <input name="YOURLSURL" style="width: 19.4%;" value="<?php if (isset($options['YOURLSURL'])) _e(apply_filters('format_to_edit',$options['YOURLSURL']), 'social-networks-auto-poster-facebook-twitter-g') ?>" /><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YOURLS API Secret Signature Token:&nbsp;&nbsp;&nbsp;<input name="YOURLSKey" style="width: 13%;" value="<?php if (isset($options['YOURLSKey'])) _e(apply_filters('format_to_edit',$options['YOURLSKey']), 'social-networks-auto-poster-facebook-twitter-g') ?>" />
              </div>
              
            </div></div>
            
            <!-- ##################### Auto-Import comments from Social Networks #####################-->
            <div class="nxs_box"> <div class="nxs_box_header"><h3><?php _e('Auto-Import comments from Social Networks', 'social-networks-auto-poster-facebook-twitter-g') ?><span class="nxs_newLabel">[<?php _e('New', 'social-networks-auto-poster-facebook-twitter-g') ?>]</span></h3></div>
             <div class="nxs_box_inside"> 
             
             <?php $cr = get_option('NXS_cronCheck'); if (!empty($cr) && is_array($cr) && isset($cr['status']) && $cr['status']=='0') { ?> <span style="color: red"> *** <?php _e('Your WP Cron is not working correctly. This feature may not work properly, and might cause duplicate postings and stability problems.<br/> Please see the test results and recommendations here:', 'social-networks-auto-poster-facebook-twitter-g'); ?>
     &nbsp;-&nbsp;<a target="_blank" href="<?php global $nxs_snapThisPageUrl; echo $nxs_snapThisPageUrl; ?>&do=crtest">WP Cron Test Results</a></span> <br/>
            <?php  } ?>             
             
             <span style="font-size: 11px; margin-left: 1px;">Plugin will automatically grab the comments posted on Social Networks and insert them as "Comments to your post". Plugin will check for the new comments every hour. </span> <br/>
              <div class="itemDiv">
              <input value="set" id="riActive" name="riActive"  type="checkbox" <?php if (!empty($options['riActive']) && (int)$options['riActive'] == 1) echo "checked"; ?> /> 
              <strong>Enable "Comments Import"</strong>
              </div>
              <div class="itemDiv">
             <strong style="font-size: 12px; margin: 10px; margin-left: 1px;">How many posts should be tracked:</strong>
<input name="riHowManyPostsToTrack" style="width: 50px;" value="<?php if (isset($options['riHowManyPostsToTrack'])) _e(apply_filters('format_to_edit', $options['riHowManyPostsToTrack']), 'social-networks-auto-poster-facebook-twitter-g'); else echo "10"; ?>" /> <br/>
              
             <span style="font-size: 11px; margin-left: 1px;">Setting two many will degrade your website's performance. 10-20 posts are recommended</span> 
              </div>
              
           </div></div>
           
     <!-- ##################### Additional URL Parameters #####################-->   
            <div class="nxs_box"> <div class="nxs_box_header"><h3><?php _e('URL Parameters', 'social-networks-auto-poster-facebook-twitter-g') ?> <span class="nxs_newLabel">[<?php _e('New', 'social-networks-auto-poster-facebook-twitter-g') ?>]</span></h3></div>            
            
             <div class="nxs_box_inside"> <span style="font-size: 11px; margin-left: 1px;"><?php _e('Here you can set what should be done to backlinks.', 'social-networks-auto-poster-facebook-twitter-g') ?> </span> <br/>
              <div class="itemDiv">
                <b><?php _e('Force HTTPS/SSL?', 'social-networks-auto-poster-facebook-twitter-g') ?></b><br/> <?php if (empty($options['forcessl'])) $options['forcessl']  = 'D'; ?>
                <input type="radio" name="forcessl" value="D" <?php if ($options['forcessl'] == 'D') echo 'checked="checked"'; ?> /> <?php _e('Don\'t do anything, let Wordpress to set the links.', 'social-networks-auto-poster-facebook-twitter-g'); ?> - <i><?php _e('All links will be exactly as provided by Wordpress', 'social-networks-auto-poster-facebook-twitter-g'); ?></i><br/>                     
                <input type="radio" name="forcessl" value="S" <?php if ($options['forcessl'] == 'S') echo 'checked="checked"'; ?> /> <?php _e('Force SSL', 'social-networks-auto-poster-facebook-twitter-g'); ?> - <i><?php _e('All links will be https/ssl', 'social-networks-auto-poster-facebook-twitter-g'); ?></i><br/>                   
                <input type="radio" name="forcessl" value="N" <?php if ($options['forcessl'] == 'N') echo 'checked="checked"'; ?> /> <?php _e('Force NON-SSL', 'social-networks-auto-poster-facebook-twitter-g'); ?> - <i><?php _e('All links will be http', 'social-networks-auto-poster-facebook-twitter-g'); ?></i><br/>                    
              </div>               
              
              <div class="itemDiv">
                <b><?php _e('Additional URL Parameters:', 'social-networks-auto-poster-facebook-twitter-g') ?></b>  <input name="addURLParams" style="width: 800px;" value="<?php if (isset($options['addURLParams'])) _e(apply_filters('format_to_edit', $options['addURLParams']), 'social-networks-auto-poster-facebook-twitter-g'); ?>" />
              </div>               
             <span style="font-size: 11px; margin-left: 1px;"> <?php _e('You can use %NTNAME% for social network name, %NTCODE% for social network two-letter code, %ACCNAME% for account name,  %POSTID% for post ID,  %POSTTITLE% for post title, %SITENAME% for website name. <b>Any text must be URL Encoded</b><br/>Example: utm_source=%NTCODE%&utm_medium=%ACCNAME%&utm_campaign=SNAP%2Bfrom%2B%SITENAME%', 'social-networks-auto-poster-facebook-twitter-g') ?></span> 
           </div></div>   
           
           <!-- ##### HashTag Settings ##### --> 
            <div class="nxs_box"> <div class="nxs_box_header"><h3><?php _e('Auto-HashTags Settings', 'social-networks-auto-poster-facebook-twitter-g') ?></h3></div>
             <div class="nxs_box_inside"> <span style="font-size: 11px; margin-left: 1px;"><?php _e('How to generate hashtags if tag is longer then one word', 'social-networks-auto-poster-facebook-twitter-g') ?> </span> <br/>
              <div class="itemDiv">
              <b><?php _e('Replace spaces in hashtags with ', 'social-networks-auto-poster-facebook-twitter-g') ?></b> <select name="nxsHTSpace" id="nxsHTSpace">
              <option <?php if (empty($options['nxsHTSpace'])) echo "selected" ?> value="">Nothing</option>
              <option <?php if (!empty($options['nxsHTSpace']) && $options['nxsHTSpace']=='_') echo "selected" ?> value ="_">_ (Underscore)</option>
              <option <?php if (!empty($options['nxsHTSpace']) && $options['nxsHTSpace']=='-') echo "selected" ?> value ="-">- (Dash)</option>
              </select>
              </div>              
               <span style="font-size: 11px; margin-left: 1px;"><?php _e('How to separate hashtags', 'social-networks-auto-poster-facebook-twitter-g') ?> </span> <br/>
              <div class="itemDiv">
              <b><?php _e('Separate hashtags with ', 'social-networks-auto-poster-facebook-twitter-g') ?></b> <select name="nxsHTSepar" id="nxsHTSepar">
              <option <?php if (!empty($options['nxsHTSepar']) && $options['nxsHTSepar']=='_') echo "selected" ?> value ="_">[ ] Space</option>
              <option <?php if (empty($options['nxsHTSepar']) || $options['nxsHTSepar']=='c_') echo "selected" ?> value="c_">[, ] Comma and Space</option>
              <option <?php if (!empty($options['nxsHTSepar']) && $options['nxsHTSepar']=='c') echo "selected" ?> value ="c">[,] Comma</option>              
              </select>
              </div>              
           </div></div>
           
            <!-- ##### ANOUNCE TAG ##### --> 
            <div class="nxs_box"> <div class="nxs_box_header"><h3><?php _e('%ANNOUNCE% tag settings', 'social-networks-auto-poster-facebook-twitter-g') ?></h3></div>
             <div class="nxs_box_inside"> <span style="font-size: 11px; margin-left: 1px;"><?php _e('Plugin will take text untill the &lt;!--more--&gt; tag. Please specify how many characters should it get if &lt;!--more--&gt; tag is not found', 'social-networks-auto-poster-facebook-twitter-g') ?> </span> <br/>
              <div class="itemDiv">
              <b><?php _e('How many characters:', 'social-networks-auto-poster-facebook-twitter-g') ?></b> <input name="anounTagLimit" style="width: 100px;" value="<?php if (isset($options['anounTagLimit'])) _e(apply_filters('format_to_edit',$options['anounTagLimit']), 'social-networks-auto-poster-facebook-twitter-g'); else echo "300"; ?>" />              
              </div>              
           </div></div>  
                           
     <!-- ##################### Open Graph #####################-->
            <div class="nxs_box"> <div class="nxs_box_header"><h3><?php _e('"Open Graph" Tags', 'social-networks-auto-poster-facebook-twitter-g') ?></h3></div>
             <div class="nxs_box_inside"> <span style="font-size: 11px; margin-left: 1px;"><?php _e('This is simple and useful implementation of "Open Graph" Tags, as this option will only add tags needed for "Auto Posting". If you use other specialized plugins, uncheck this option.', 'social-networks-auto-poster-facebook-twitter-g') ?> </span> <br/>
              <div class="itemDiv">
              <input value="1" id="nsOpenGraph" name="nsOpenGraph"  type="checkbox" <?php if (!empty($options['nsOpenGraph']) && (int)$options['nsOpenGraph'] == 1) echo "checked"; ?> /> <b><?php _e('Add Open Graph Tags', 'social-networks-auto-poster-facebook-twitter-g') ?></b>
              </div>                           
              <div class="itemDiv">
             <b><?php _e('Default Image URL for og:image tag:', 'social-networks-auto-poster-facebook-twitter-g') ?></b> 
            <input name="ogImgDef" style="width: 30%;" value="<?php if (isset($options['ogImgDef'])) _e(apply_filters('format_to_edit',$options['ogImgDef']), 'social-networks-auto-poster-facebook-twitter-g') ?>" />
              </div>             
           </div></div>    
            <!-- #### "Featured" Image ##### --> 
            <div class="nxs_box"> <div class="nxs_box_header"><h3><?php _e('Advanced "Featured" Image Settings', 'social-networks-auto-poster-facebook-twitter-g') ?></h3></div>
             <div class="nxs_box_inside"> 
              <div class="itemDiv">
              <input value="set" id="imgNoCheck" name="imgNoCheck"  type="checkbox" <?php /* ## Reversed Intentionally!!! */ if (empty($options['imgNoCheck']) || (int)$options['imgNoCheck'] != 1) echo "checked"; ?> /> <strong>Verify "Featured" Image</strong>               
              <br/><span style="font-size: 11px; margin-left: 1px;"><?php _e('Advanced Setting. Uncheck only if you are 100% sure that your images are valid or if you have troubles with image verification.', 'social-networks-auto-poster-facebook-twitter-g') ?> </span> <br/>
              </div>
              
               <div class="itemDiv">
             <input value="1" id="useUnProc" name="useUnProc"  type="checkbox" <?php if (isset($options['useUnProc']) && (int)$options['useUnProc'] == 1) echo "checked"; ?> /> 
             <b><?php _e('Use advanced image finder', 'social-networks-auto-poster-facebook-twitter-g') ?></b>
              <br/>              
             <span style="font-size: 11px; margin-left: 1px;"> <?php _e('Check this if your images could be found only in the fully processed posts. <br/>This feature could interfere with some plugins using post processing functions incorrectly. Your site could become messed up, have troubles displaying content or start giving you "ob_start() [ref.outcontrol]: Cannot use output buffering in output buffering display handlers" errors.', 'social-networks-auto-poster-facebook-twitter-g') ?></span> 
              </div>  
              
           </div></div>        
    
      <!-- ##### Alternative "Featured Image" location ##### --> 
            <div class="nxs_box"> <div class="nxs_box_header"><h3><?php _e('Alternative "Featured Image" location', 'social-networks-auto-poster-facebook-twitter-g') ?></h3></div>
             <div class="nxs_box_inside"> <span style="font-size: 11px; margin-left: 1px;"><?php _e('Plugin uses standard Wordpress "Featured Image" by default. If your theme stores "Featured Image" in the custom field, please enter the name of it. Use prefix if your custom field has only partial location.', 'social-networks-auto-poster-facebook-twitter-g') ?> </span> <br/>
              <div class="itemDiv">
              <b><?php _e('Custom field name:', 'social-networks-auto-poster-facebook-twitter-g') ?></b> <input name="featImgLoc" style="width: 200px;" value="<?php if (isset($options['featImgLoc'])) _e(apply_filters('format_to_edit',$options['featImgLoc']), 'social-networks-auto-poster-facebook-twitter-g') ?>" />
              <br/>              
             <span style="font-size: 11px; margin-left: 1px;"><?php _e('Set the name of the custom field that contains image info', 'social-networks-auto-poster-facebook-twitter-g') ?></span> 
              </div>
              <div class="itemDiv">
             <b><?php _e('Custom field Array Path:', 'social-networks-auto-poster-facebook-twitter-g') ?></b> <input name="featImgLocArrPath" style="width: 200px;" value="<?php if (isset($options['featImgLocArrPath'])) _e(apply_filters('format_to_edit',$options['featImgLocArrPath']), 'social-networks-auto-poster-facebook-twitter-g') ?>" /> 
              <br/>              
             <span style="font-size: 11px; margin-left: 1px;">[<?php _e('Optional', 'social-networks-auto-poster-facebook-twitter-g') ?>] <?php _e('If your custom field contain an array, please enter the path to the image field. For example: [\'images\'][\'image\']', 'social-networks-auto-poster-facebook-twitter-g') ?></span> 
              </div>
              <div class="itemDiv">
             <b><?php _e('Custom field Image Prefix:', 'social-networks-auto-poster-facebook-twitter-g') ?></b> <input name="featImgLocPrefix" style="width: 200px;" value="<?php if (isset($options['featImgLocPrefix'])) _e(apply_filters('format_to_edit',$options['featImgLocPrefix']), 'social-networks-auto-poster-facebook-twitter-g') ?>" /> 
              <br/>              
             <span style="font-size: 11px; margin-left: 1px;">[<?php _e('Optional', 'social-networks-auto-poster-facebook-twitter-g') ?>] <?php _e('If your custom field contain only the last part of the image path, please enter the prefix', 'social-networks-auto-poster-facebook-twitter-g') ?></span> 
              </div>
              
              <div class="itemDiv">
             <b><?php _e('Custom field Image text to remove:', 'social-networks-auto-poster-facebook-twitter-g') ?></b> <input name="featImgLocRemTxt" style="width: 200px;" value="<?php if (isset($options['featImgLocRemTxt'])) _e(apply_filters('format_to_edit',$options['featImgLocRemTxt']), 'social-networks-auto-poster-facebook-twitter-g') ?>" /> 
              <br/>              
             <span style="font-size: 11px; margin-left: 1px;">[<?php _e('Optional', 'social-networks-auto-poster-facebook-twitter-g') ?>] <?php _e('If your custom field contain the last part of the image path that need to be removed, please enter it here', 'social-networks-auto-poster-facebook-twitter-g') ?></span> 
              </div>
              
           </div></div>    
           
            <!-- ##### Ext Debug/Report Settings ##### --> 
            <div class="nxs_box"> <div class="nxs_box_header"><h3><?php _e('Debug/Report Settings', 'social-networks-auto-poster-facebook-twitter-g') ?></h3></div>
             <div class="nxs_box_inside"> <span style="font-size: 11px; margin-left: 1px;"><?php _e('Debug/Report Settings', 'social-networks-auto-poster-facebook-twitter-g') ?> </span> <br/>
 
             <div class="itemDiv">
              <input value="1" id="brokenCntFilters" name="brokenCntFilters"  type="checkbox" <?php if (isset($options['brokenCntFilters']) && (int)$options['brokenCntFilters'] == 1) echo "checked"; ?> /> 
              <strong>My Content Filters (<i>apply_filters('the_content'</i>) are broken, don't use them</strong>
               - <span style="font-size: 11px; margin-left: 1px;"><?php _e('Some third party plugin break content filters. Check this if some networks do not post silently(without any errors in the log). This will make %EXCERPT% work as %RAWEXCERPT%, %FULLTEXT% as %RAWTEXT%, etc... ', 'social-networks-auto-poster-facebook-twitter-g') ?></span>               
              <br/>                             
              </div> 
 
             <div class="itemDiv">
             <b><?php _e('How many log records show?', 'social-networks-auto-poster-facebook-twitter-g') ?></b> <input name="numLogRows" style="width: 200px;" value="<?php if (isset($options['numLogRows'])) _e(apply_filters('format_to_edit',$options['numLogRows']), 'social-networks-auto-poster-facebook-twitter-g'); else echo "250"; ?>" /> 
              </div>
              <div class="itemDiv"><input value="1" name="dbg[cron]"  type="checkbox" <?php if (isset($options['dbg']['cron']) && (int)$options['dbg']['cron'] == 1) echo "checked"; ?> /> <?php _e('Log Cron Events', 'social-networks-auto-poster-facebook-twitter-g') ?> - <span style="font-size: 11px; margin-left: 1px;"><?php _e('All WP Cron requests will be logged. Please check this if you have any issues with scheduling, delayed postings, reposter, etc..', 'social-networks-auto-poster-facebook-twitter-g') ?> </span></div>
              
              <div class="itemDiv">
               <strong>Log/History Info Level</strong><select name="extDebug" id="extDebug">
                <option <?php if (!empty($options['extDebug']) && $options['extDebug']=='2') echo "selected" ?> value ="2">Minimal</option>
                <option <?php if (empty($options['extDebug'])) echo "selected" ?> value="0">Normal</option>              
                <option <?php if (!empty($options['extDebug']) && $options['extDebug']=='1') echo "selected" ?> value ="1">Extended/Debug</option>
              </select> <br/>
              
              <?php _e('Minimal', 'social-networks-auto-poster-facebook-twitter-g') ?> - <span style="font-size: 11px; margin-left: 1px;"><?php _e('Only important action info will be added to the log. "Debug", "Skipped", informational info will be ignored.', 'social-networks-auto-poster-facebook-twitter-g') ?> </span> <br/>
              <?php _e('Normal', 'social-networks-auto-poster-facebook-twitter-g') ?> - <span style="font-size: 11px; margin-left: 1px;"><?php _e('All info except extended debug queryies will be added to the log.', 'social-networks-auto-poster-facebook-twitter-g') ?> </span> <br/>
              <?php _e('Extended/Debug', 'social-networks-auto-poster-facebook-twitter-g') ?> - <span style="font-size: 11px; margin-left: 1px;"><?php _e('Advanced Setting. Extended debug Info will be added to the log.', 'social-networks-auto-poster-facebook-twitter-g') ?> </span> <br/>
              </div>
              
              <div class="itemDiv">
              <input value="set" id="errNotifEmailCB" name="errNotifEmailCB"  type="checkbox" <?php if (isset($options['errNotifEmailCB']) && (int)$options['errNotifEmailCB'] == 1) echo "checked"; ?> /> 
              <strong>Send Email notification for errors</strong>
               - <span style="font-size: 11px; margin-left: 1px;"><?php _e('Send Email notification for all autoposting errors. No more then one email per hour will be sent.', 'social-networks-auto-poster-facebook-twitter-g') ?></span>               
              <br/>               
              <div style="margin-left: 18px;">
              <b><?php _e('Email:', 'social-networks-auto-poster-facebook-twitter-g') ?></b> <input name="errNotifEmail" style="width: 200px;" value="<?php if (isset($options['errNotifEmail'])) _e(apply_filters('format_to_edit',$options['errNotifEmail']), 'social-networks-auto-poster-facebook-twitter-g') ?>" />
              <span style="font-size: 11px; margin-left: 1px;"><?php _e('wp_mail will be used. Some email providers (gmail, hotmail) might have problems getting such mail', 'social-networks-auto-poster-facebook-twitter-g') ?> </span> <br/>
              </div>
              </div>
              
              <?php $cr = get_option('NXS_cronCheck'); if (!empty($cr) && is_array($cr) && isset($cr['status']) && $cr['status']=='0') { ?> 
                <div class="itemDiv">             
             <span style="color: red"> *** <?php _e('Your WP Cron is not working correctly.', 'social-networks-auto-poster-facebook-twitter-g'); ?>
     &nbsp;-&nbsp;<a target="_blank" href="<?php global $nxs_snapThisPageUrl; echo $nxs_snapThisPageUrl; ?>&do=crtest">WP Cron Test Results</a></span> <br/>
             
              <input value="set" id="forceBrokenCron" name="forceBrokenCron"  type="checkbox" <?php if (isset($options['forceBrokenCron']) && (int)$options['forceBrokenCron'] == 1) echo "checked"; ?> /> 
              <strong>Enable Cron functions even if WP Cron is not working correctly.</strong>
               <br/><span style="color:red; font-weight: bold;"><?php _e('I understand that this could cause duplicate postings as well as perfomance and stability problems.', 'social-networks-auto-poster-facebook-twitter-g') ?></span> - 
               <span style="margin-left: 1px; color:red;"><?php _e('Please do not check this unless you absolutely sure that you know what are you doing.', 'social-networks-auto-poster-facebook-twitter-g') ?></span>
               <br/><span style="margin-left: 1px; color:#005800;"><?php _e('Setting up WP Cron correctly will be much better solution:', 'social-networks-auto-poster-facebook-twitter-g') ?>
                 <a href="http://www.nextscripts.com/tutorials/wp-cron-scheduling-tasks-in-wordpress/" target="_blank">WP-Cron: Scheduling Tasks in WordPress</a>
               </span>
               
               
               
               </div>              
             <?php  } ?> 
              
           </div></div>               
    
           
     
     <?php if (function_exists("nxs_showPRXTab")) { ?>          
      <h3 style="font-size: 14px; margin-bottom: 2px;">Show "Proxies" Tab</h3>             
        <p style="margin: 0px;margin-left: 5px;"><input value="set" id="showPrxTab" name="showPrxTab"  type="checkbox" <?php if ((int)$options['showPrxTab'] == 1) echo "checked"; ?> /> 
          <strong>Show "Proxies" Tab</strong> <span style="font-size: 11px; margin-left: 1px;">Advanced Setting. Check to enable "Proxies" tab where you can setup autoposting proxies.</span>            
        </p>    
      <?php } ?>       
           
      <div class="submitX"><input type="submit" class="button-primary" name="update_NS_SNAutoPoster_settings" value="<?php _e('Update Settings', 'social-networks-auto-poster-facebook-twitter-g') ?>" /></div>           
      </form>
    </div>
    
    <?php if ((function_exists("nxs_showPRXTab")) && (int)$options['showPrxTab'] == 1) {  nxs_showPRXTab($options);  } ?>
    <div id="nsx_tab3" class="nsx_tab_content"> 
    <div style="width:760px;">
    <a href="#" style="float: right" onclick="nxs_rfLog();return false;" class="NXSButton" id="nxs_clearLog">Refresh</a>
    
    Showing last 150 records <a href="#" onclick="nxs_clLog();return false;" class="NXSButton" id="nxs_clearLog">Clear Log</a><br/><br/>    
      <div style="overflow: auto; border: 1px solid #999; width: 920px; height: 600px; font-size: 11px;" class="logDiv" id="nxslogDiv"><?php nxs_getShowLog(); ?></div>        
      <?php $quPosts = maybe_unserialize(get_option('NSX_PostsQuery')); if (!is_array($quPosts)) $quPosts = array(); if (count($quPosts)>0) { ?>
      <br/>Query:<br/>
      <div style="overflow: auto; border: 1px solid #999; width: 920px; height: 200px; font-size: 11px;" class="logDiv" id="nxsQUDiv">
      <?php 
        $pstEvrySec = $options['quDays']*86400+$options['quHrs']*3600+$options['quMins']*60; $offSet = ( get_option( 'gmt_offset' ) * HOUR_IN_SECONDS );  $currTime = time() + $offSet;
        if (count($quPosts)>0) { $nxTime = (isset($options['quNxTime']) && (int)$options['quNxTime']>0)?$options['quNxTime']:($currTime+$pstEvrySec); 
          echo  "<snap style='color:#008000;'>Current Time:</snap> ".date_i18n('Y-m-d H:i', $currTime)." | <snap style='color:#000080;'>Next Shedulled Time:</snap> ~".date_i18n('Y-m-d H:i', $nxTime)."  |  <snap style='color:#580058;'>Last Post made from query:</snap> ".date_i18n('Y-m-d H:i', $options['quLastShTime'])."<br/>----====== Query:<br/>";
          foreach ($quPosts as $spostID){  $pst = get_post($spostID);  echo $spostID." - ".$pst->post_title."<br/>";}
        }


      ?>
      </div>
      <?php } ?>
      
    </div>        
    </div>
    
    <div id="nsx_tab4" class="nsx_tab_content"> 
     
     <div style="max-width:1000px;"> 
     
<h3 id="showLic2"> About </h3>

<?php nxs_memCheck(); ?><br/>

<h3> Setup/Installation/Configuration Instructions   </h3>

     <table style="max-width:1000px"><tr><td valign="top" width="250">
     
   <div style="margin:0 25px 0 0; line-height: 24px;">   

<a style="background-image:url(<?php echo $nxs_plurl; ?>img/led/application_form.png) !important;" class="nxs_icon16" target="_parent" href="http://www.nextscripts.com/installation-of-social-networks-auto-poster-for-wordpress/">Plugin Setup/Installation</a>
<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<a style="background-image:url(<?php echo $nxs_plurl; ?>img/led/facebook.png) !important;" class="nxs_icon16" target="_parent" href="http://www.nextscripts.com/setup-installation-facebook-social-networks-auto-poster-wordpress/">  Facebook </a>
<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<a style="background-image:url(<?php echo $nxs_plurl; ?>img/led/twitter.png) !important;" class="nxs_icon16" target="_parent" href="http://www.nextscripts.com/setup-installation-twitter-social-networks-auto-poster-wordpress/">  Twitter </a>
<br/>
&nbsp;&nbsp;&nbsp;&nbsp;<a style="background-image:url(<?php echo $nxs_plurl; ?>img/led/googleplus.png) !important;" class="nxs_icon16" target="_parent" href="http://www.nextscripts.com/setup-installation-google-plus-social-networks-auto-poster-wordpress/"> Google+ </a>
<br>
&nbsp;&nbsp;&nbsp;&nbsp;<a style="background-image:url(<?php echo $nxs_plurl; ?>img/led/pinterest.png) !important;" class="nxs_icon16" target="_parent" href="http://www.nextscripts.com/setup-installation-pinterest-social-networks-auto-poster-wordpress/">  Pinterest</a>
<br>
&nbsp;&nbsp;&nbsp;&nbsp;<a style="background-image:url(<?php echo $nxs_plurl; ?>img/led/tumblr.png) !important;" class="nxs_icon16" target="_parent" href="http://www.nextscripts.com/setup-installation-tumblr-social-networks-auto-poster-wordpress/">  Tumblr </a>
<br>
&nbsp;&nbsp;&nbsp;&nbsp;<a style="background-image:url(<?php echo $nxs_plurl; ?>img/led/linkedin.png) !important;" class="nxs_icon16" target="_parent" href="http://www.nextscripts.com/setup-installation-linkedin-social-networks-auto-poster-wordpress/">  LinkedIn </a>
<br>
&nbsp;&nbsp;&nbsp;&nbsp;<a style="background-image:url(<?php echo $nxs_plurl; ?>img/led/blogger.png) !important;" class="nxs_icon16" target="_parent" href="http://www.nextscripts.com/setup-installation-blogger-social-networks-auto-poster-wordpress/">  Blogger </a>
<br>
&nbsp;&nbsp;&nbsp;&nbsp;<a style="background-image:url(<?php echo $nxs_plurl; ?>img/led/delicious.png) !important;" class="nxs_icon16" target="_parent" href="http://www.nextscripts.com/setup-installation-delicious-social-networks-auto-poster-wordpress/"> Delicious </a>
<br>
&nbsp;&nbsp;&nbsp;&nbsp;<a style="background-image:url(<?php echo $nxs_plurl; ?>img/led/blogcom.png) !important;" class="nxs_icon16" target="_parent" href="http://www.nextscripts.com/setup-installation-wp-based-social-networks-auto-poster-wordpress/"> Wordpress.com/Blog.com</a>
<br/><br/>
<a style="font-weight: normal; font-size: 16px; line-height: 24px;" target="_blank" href="http://www.nextscripts.com/faq">FAQ</a><br/>
<a style="font-weight: normal; font-size: 16px; line-height: 24px;" target="_blank" href="http://www.nextscripts.com/troubleshooting-social-networks-auto-poster">Troubleshooting FAQ</a>

</div>

</td>
<td  valign="top" style="font-size: 14px;">

</td></tr></table>
   
   <br/><br/>
  
  </div> </div> 
  
  <div id="nsx_tab5" class="nsx_tab_content"><?php nxs_showNewPostForm($options); ?>  </div>
</div>     
            <div class="popShAtt" id="popShAttRPST1"><div class="nxs_tls_sbInfo2"><?php _e('Set random delays around your interval time, to make your posts appear more human', 'social-networks-auto-poster-facebook-twitter-g'); ?></div></div>
           <form method="post" enctype="multipart/form-data"  id="nsStFormUpl" action="<?php echo $nxs_snapThisPageUrl?>">
              <input type="file" accept="text/plain" onchange="jQuery('#nsStFormUpl').submit();" id="impFileSettings_button" name="impFileSettings_button" style="display: block; visibility: hidden; width: 1px; height: 0;" size="chars">
              <input type="hidden" value="1" name="upload_NS_SNAutoPoster_settings" /> <input value="'" type="hidden" name="nxs_mqTest" />  <?php wp_nonce_field( 'nxsChkUpl', 'nxsChkUpl_wpnonce' ); ?> 
           </form>
           <br/>&nbsp;<br/> <?php
        }
        function showSNAutoPosterOptionsPagex() { global $nxs_snapAvNts, $nxs_snapThisPageUrl, $nxsOne, $nxs_plurl, $nxs_isWPMU; $nxsOne = ''; $options = $this->nxs_options; ?>            
            <br/><br/><br/>This version of the plugin is not compatible with <b>Wordpress Multisite Edition</b>. Please contact your Network Admin for the upgrade. <?php }
        
        function NS_SNAP_ShowPageTop(){  global $nxs_snapAvNts, $nxs_snapThisPageUrl, $nxsOne, $nxs_plurl, $nxs_isWPMU, $nxs_skipSSLCheck; $nxsOne = ''; $cstIt=0; $options = $this->nxs_options; 
        
          if ($_GET['page']=='NextScripts_SNAP.php' && isset($_GET['do']) && $_GET['do']=='h'){ nxs_do_this_hourly(); die(); }
          if ($_GET['page']=='NextScripts_SNAP.php' && isset($_GET['do']) && $_GET['do']=='q'){ nxs_do_post_from_query(); die(); }           
          if (function_exists('nxs_doSMAS5')) { $rf = new ReflectionFunction('nxs_doSMAS5'); $cstIt++; $rff = $rf->getFileName(); }
          $nxsOne = NextScripts_SNAP_Version; if (defined('NXSAPIVER')) $nxsOne .= " (<span id='nxsAPIUpd'>API</span> Version: ".NXSAPIVER.")"; ?>
           
                    
           <div class=wrap><h2><?php _e('Social Networks Auto Poster Options', 'social-networks-auto-poster-facebook-twitter-g'); ?></h2> <br/> 
           <?php  $disabled_functions = @ini_get('disable_functions');
           if (!function_exists('curl_init')) {  
               echo ("<br/><b style='font-size:16px; color:red;'>Error: No CURL Found</b> - <i style='font-size:12px; color:red;'>Social Networks AutoPoster needs the CURL PHP extension. Please install it or contact your hosting company to install it.</i><br/><br/>"); 
           }
           if (stripos($disabled_functions, 'curl_exec')!==false) {  
               echo ("<br/><b style='font-size:16px; color:red;'>curl_exec function is disabled in php.ini</b> - <i style='font-size:12px; color:red;'>Social Networks AutoPoster needs the CURL PHP extension. Please enable it or contact your hosting company to enable it.</i><br/><br/>"); 
           }
           if (!empty($rff) && stripos($rff, "'d code")===false) { $options[chr(75).$cstIt] = $cstIt; update_option($this->dbOptionsName, $options); $this->nxs_options = $options; } 
           if (!isset($options['skipSSLSec'])) { $err = nxsCheckSSLCurl('https://www.google.com'); 
             if ($err!==false && $err['errNo']=='60') { $nxs_skipSSLCheck = true; $options['skipSSLSec'] = true; } else { $nxs_skipSSLCheck = false; $options['skipSSLSec'] = false; } 
             update_option($this->dbOptionsName, $options); $this->nxs_options = $options;
           }
           
           /*
           if ((defined('WP_ALLOW_MULTISITE') && WP_ALLOW_MULTISITE==true) || (defined('MULTISITE') &&  MULTISITE==true) ) { 
               echo "<br/><br/><br/><b style=\"font-size:16px; color:red;\">Sorry, we do not support Multiuser Wordpress at this time</b>"; return; 
           }
           */
           ?>
           
<?php if (function_exists('yoast_analytics')) { $plgnsLink = nxs_get_admin_url().'/plugins.php' ?>
  <div class="error" id="message"><p><strong><?php _e('You have Google Analytics Plugin installed and activated.', 'social-networks-auto-poster-facebook-twitter-g'); ?></strong> <?php _e('This plugin hijacks the authorization workflow.', 'social-networks-auto-poster-facebook-twitter-g'); ?> 
  <?php printf( __( 'Please temporary <a href="%s">deactivate</a> Google Analytics plugin, do all authorizations and then activate it back.', 'social-networks-auto-poster-facebook-twitter-g' ), $plgnsLink ); ?></div>
<?php }  
        }
        
        function NS_SNAP_SavePostMetaTags($id) { global $nxs_snapAvNts, $plgn_NS_SNAutoPoster;            
          if (!empty($_POST['nxs_snapPostOptions'])) { $NXS_POSTX = $_POST['nxs_snapPostOptions']; $NXS_POST = array(); $NXS_POST = NXS_parseQueryStr($NXS_POSTX); } else $NXS_POST = $_POST;
          if (count($NXS_POST)<1 || !isset($NXS_POST["snapEdIT"]) || empty($NXS_POST["snapEdIT"])) return; 
          if (get_magic_quotes_gpc() || (!empty($_POST['nxs_mqTest']) && $_POST['nxs_mqTest']=="\'")){ array_walk_recursive($NXS_POST, 'nsx_stripSlashes'); }  array_walk_recursive($NXS_POST, 'nsx_fixSlashes');  
          if (!isset($plgn_NS_SNAutoPoster)) return; $options = $plgn_NS_SNAutoPoster->nxs_options; //  echo "| NS_SNAP_SavePostMetaTags - ".$id." |";
          $post = get_post($id); if ($post->post_type=='revision' && $post->post_status=='inherit' && $post->post_parent!='0') return; // prr($NXS_POST);          
          if (empty($NXS_POST["useSURL"])) $NXS_POST["useSURL"] = '2'; delete_post_meta($id, '_snap_forceSURL'); add_post_meta($id, '_snap_forceSURL', $NXS_POST["useSURL"]);  
          delete_post_meta($id, 'snap_MYURL'); add_post_meta($id, 'snap_MYURL', $NXS_POST["urlToUse"]);    delete_post_meta($id, 'snapEdIT'); add_post_meta($id, 'snapEdIT', '1' );            
          $snap_isAutoPosted = get_post_meta($id, 'snap_isAutoPosted', true); if ($snap_isAutoPosted=='1' &&  $post->post_status=='future') { delete_post_meta($id, 'snap_isAutoPosted'); add_post_meta($id, 'snap_isAutoPosted', '2'); }
          foreach ($nxs_snapAvNts as $avNt) { // echo "--------------------------------------------";  prr($avNt);          
              if (isset($options[$avNt['lcode']]) && count($options[$avNt['lcode']])>0 && isset($NXS_POST[$avNt['lcode']]) && count($NXS_POST[$avNt['lcode']])>0) { $savedMeta = maybe_unserialize(get_post_meta($id, 'snap'.$avNt['code'], true)); 
              if(is_array($NXS_POST[$avNt['lcode']])) { $ii=0;
                  foreach ($NXS_POST[$avNt['lcode']] as $pst ) {//   echo "###########";  prr($pst);
                    if (is_array($pst) && empty( $pst['do'.$avNt['code']]) && empty($NXS_POST[$avNt['lcode']][$ii]['do'.$avNt['code']])) $NXS_POST[$avNt['lcode']][$ii]['do'.$avNt['code']] = 0;                     
                    if (is_array($pst) && empty( $pst['do']) && empty($NXS_POST[$avNt['lcode']][$ii]['do'])) $NXS_POST[$avNt['lcode']][$ii]['do'] = 0;                     
                    if (!empty($NXS_POST[$avNt['lcode']][$ii]['do'.$avNt['code']])) $NXS_POST[$avNt['lcode']][$ii]['do'] = $NXS_POST[$avNt['lcode']][$ii]['do'.$avNt['code']]; 
                      elseif (!empty($NXS_POST[$avNt['lcode']][$ii]['do']))         $NXS_POST[$avNt['lcode']][$ii]['do'.$avNt['code']] = $NXS_POST[$avNt['lcode']][$ii]['do'];                    
                    $ii++;
                  }
              } $newMeta = $NXS_POST[$avNt['lcode']]; // prr($newMeta);
              if (is_array($savedMeta) && is_array($newMeta)) $newMeta = nxsMergeArraysOV($savedMeta, $newMeta); // echo "#####~~~~~~~~~ ".$id."| snap".$avNt['code']; prr($savedMeta); echo "||"; prr($newMeta);// $newMeta = 'AAA';
              delete_post_meta($id, 'snap'.$avNt['code']); add_post_meta($id, 'snap'.$avNt['code'], str_replace('\\','\\\\',serialize($newMeta)));   
              }
            }        //    die();
          // prr($_POST);
        }
        
        function NS_SNAP_AddPostMetaTags() { global $post, $nxs_snapAvNts, $plgn_NS_SNAutoPoster; $post_id = $post; if (is_object($post_id))  $post_id = $post_id->ID; 
          if (!is_object($post) || empty($post->post_status)) $post = get_post($post_id); if (!empty($_GET['post']) && $post_id!=$_GET['post']) { $post_id=$_GET['post']; $post = get_post($post_id);}
          if (!isset($plgn_NS_SNAutoPoster)) return; $options = $plgn_NS_SNAutoPoster->nxs_options; 
          ?>
          <style type="text/css">div#popShAtt {display: none; position: absolute; width: 600px; padding: 10px; background: #eeeeee; color: #000000; border: 1px solid #1a1a1a; font-size: 90%; }
.underdash {border-bottom: 1px #21759B dashed; text-decoration:none;}
.underdash a:hover {border-bottom: 1px #21759B dashed}
</style>

       <div id="NXS_MetaFields" class="NXSpostbox">  <input value="'" type="hidden" name="nxs_mqTest" /> <input value="" type="hidden" id="nxs_snapPostOptions" name="nxs_snapPostOptions" />
          <div id="NXS_MetaFieldsIN" class="NXSpostbox">   <div id="nxs_gPopup"><span class="nxspButton bClose"><span>X</span></span><div id="nxs_gPopupContent"></div></div>
       <?php /* ################## WHAT URL to USE */ ###################### ?>
          <div style="text-align: left; font-size: 14px; " class="showURL">
          <div class="inside" style="border: 1px #E0E0E0 solid; padding: 5px;"><div id="postftfp">
          <b>URL to use for links, attachments and %MYURL%:&nbsp;</b>     <a href="#" onclick="nxs_doResetPostSettings('<?php echo $post_id; ?>'); return false;" style="float:right;">Reset all data</a>
          <input type="checkbox" class="isAutoURL" <?php  $forceSURL = get_post_meta($post_id, '_snap_forceSURL', true); 
            if (empty($forceSURL) && !empty($options['forceSURL']) || $forceSURL=='1') { ?>checked="checked"<?php } ?>  id="useSURL" name="useSURL" value="1"/> <?php _e('Shorten URL', 'social-networks-auto-poster-facebook-twitter-g'); ?>
          &nbsp;&nbsp;&nbsp;  
          <input type="checkbox" class="isAutoURL" <?php $urlToUse = get_post_meta($post_id, 'snap_MYURL', true); 
            if ($urlToUse=='') { ?>checked="checked"<?php } ?>  id="isAutoURL-" name="isAutoURL" value="A"/> <?php _e('Auto', 'social-networks-auto-poster-facebook-twitter-g'); ?> - <i><?php _e('Post URL will be used', 'social-networks-auto-poster-facebook-twitter-g'); ?></i>
                  
                    <div class="nxs_prevURLDiv" <?php if (trim($urlToUse)=='') { ?> style="display:none;"<?php } ?> id="isAutoURLFld-">
                      &nbsp;&nbsp;&nbsp;<?php _e('URL:', 'social-networks-auto-poster-facebook-twitter-g') ?> <input size="90" type="text" name="urlToUse" value="<?php echo $urlToUse ?>" id="URLToUse" /> 
                    </div>
          </div></div></div>
          

          <div id="NXS_MetaFieldsBox" class="postbox"> 
          <div class="inside"><div id="postftfp">           
           
          
          <input value="1" type="hidden" name="snapEdIT" />   
          <div class="popShAtt" style="width: 200px;" id="popShAttSV"><?php _e('If you made any changes to the format, please "Update" the post before reposting', 'social-networks-auto-poster-facebook-twitter-g'); ?></div>
          <?php if($post->post_status != "publish" ) { ?>
          <div style="float: right;">   <input type="hidden" id="nxsLockIt" value="0" />       
          <a href="#" onclick="jQuery('#nxsLockIt').val('1'); jQuery('.nxsGrpDoChb').attr('checked','checked'); jQuery('.nxsGrpDoChb').attr('type', 'checkbox'); jQuery('.nxsGrpDoChb').val('1'); jQuery('.nxsGrpDoChb').iCheck('destroy'); jQuery('.nxsGrpDoChb').iCheck({checkboxClass: 'icheckbox_minimal-blue', radioClass: 'iradio_minimal-blue', increaseArea: '20%'});  return false;"><?php  _e('Check All', 'social-networks-auto-poster-facebook-twitter-g'); ?></a>&nbsp;<a href="#" onclick="jQuery('#nxsLockIt').val('1');jQuery('.nxsGrpDoChb').removeAttr('checked'); jQuery('.nxsGrpDoChb').iCheck('update'); return false;"><?php _e('Uncheck All', 'social-networks-auto-poster-facebook-twitter-g'); ?></a>
          </div>
          <?php } ?>
        
          <table style="margin-bottom:40px; clear:both;" width="100%" border="0"><?php
          foreach ($nxs_snapAvNts as $avNt) { $clName = 'nxs_snapClass'.$avNt['code']; 
             if ( isset($avNt['lcode']) && isset($options[$avNt['lcode']]) && count($options[$avNt['lcode']])>0) { $ntClInst = new $clName(); $ntClInst->showEdPostNTSettings($options[$avNt['lcode']], $post); }
          }
         ?></table>
         
         <div id="showSetTime" style="display: none;background-color: #fff; width: 350px; padding: 25px;"><span class="nxspButton bClose"><span>X</span></span>
           
           Set Time: (Current Time: <?php echo date_i18n('Y-m-d H:i'); ?> ) <div id="nxs_timestampdiv" class="hide-if-js" style="display: block;"><div class="timestamp-wrap"><select id="nxs_mm" name="nxs_mm">
            <option value="1" <?php if (date_i18n('n')=='1') echo 'selected="selected"' ?>>01-Jan</option> <option value="2" <?php if (date_i18n('n')=='2') echo 'selected="selected"' ?>>02-Feb</option> 
            <option value="3" <?php if (date_i18n('n')=='3') echo 'selected="selected"' ?>>03-Mar</option> <option value="4" <?php if (date_i18n('n')=='4') echo 'selected="selected"' ?>>04-Apr</option> 
            <option value="5" <?php if (date_i18n('n')=='5') echo 'selected="selected"' ?>>05-May</option> <option value="6" <?php if (date_i18n('n')=='6') echo 'selected="selected"' ?>>06-Jun</option> 
            <option value="7" <?php if (date_i18n('n')=='7') echo 'selected="selected"' ?>>07-Jul</option> <option value="8" <?php if (date_i18n('n')=='8') echo 'selected="selected"' ?>>08-Aug</option> 
            <option value="9" <?php if (date_i18n('n')=='9') echo 'selected="selected"' ?>>09-Sep</option> <option value="10" <?php if (date_i18n('n')=='10') echo 'selected="selected"' ?>>10-Oct</option>
            <option value="11" <?php if (date_i18n('n')=='11') echo 'selected="selected"' ?>>11-Nov</option> <option value="12" <?php if (date_i18n('n')=='12') echo 'selected="selected"' ?>>12-Dec</option> </select>
            
<input type="text" id="nxs_jj" name="nxs_jj" value="<?php echo date_i18n('d'); ?>" size="2" maxlength="2" autocomplete="off">, <input type="text" id="nxs_aa" name="nxs_aa" value="<?php echo date_i18n('Y'); ?>" size="4" maxlength="4" autocomplete="off"> @ <input type="text" id="nxs_hh" name="nxs_hh" value="<?php echo date_i18n('H'); ?>" size="2" maxlength="2" autocomplete="off"> : <input type="text" id="nxs_mn" name="nxs_mn" value="<?php echo date_i18n('i'); ?>" size="2" maxlength="2" autocomplete="off"></div><input type="hidden" id="nxs_ss" name="nxs_ss" value="58">
<p>
<a href="#" class="button bClose" onclick="var tid = jQuery('#nxs_timeID').val(); var tmTxt = nxs_makeTimeTxt(); var d=new Date(tmTxt);  var tm = d.getTime() / 1000; jQuery('#'+tid+'timeToRunTxt').html(tmTxt);  jQuery('#'+tid+'timeToRun').val(tm); return false;">OK</a>
<a href="#" class="bClose">Cancel</a>
<input type="hidden"  id="nxs_timeID" value="" />
</p>
</div>

           
           </div>
         
         </div></div></div> </div> </div> <?php 
        }
        //## Add MetaBox to Post->Edit
        function NS_SNAP_addCustomBoxes() { global $plgn_NS_SNAutoPoster;  if (!isset($plgn_NS_SNAutoPoster)) return; $options = $plgn_NS_SNAutoPoster->nxs_options;           
          if (!empty($options['fltrs']['nxs_post_type']) && is_array($options['fltrs']['nxs_post_type'])) { 
              if( !empty($options['fltrs']['nxs_ie_posttypes']) ) { nxs_Filters::init(true); $options['fltrs']['nxs_post_type'] = array_diff(nxs_Filters::$posts_types,  $options['fltrs']['nxs_post_type']); }    
              foreach ($options['fltrs']['nxs_post_type'] as $cptID) 
                add_meta_box( 'NS_SNAP_AddPostMetaTags',  __( 'Social Networks Auto Poster - Post Options', 'social-networks-auto-poster-facebook-twitter-g' ), array($this, 'NS_SNAP_AddPostMetaTags'), $cptID );
          } else add_meta_box( 'NS_SNAP_AddPostMetaTags',  __( 'Social Networks Auto Poster - Post Options', 'social-networks-auto-poster-facebook-twitter-g' ), array($this, 'NS_SNAP_AddPostMetaTags'));              
        }
    }
}

?>