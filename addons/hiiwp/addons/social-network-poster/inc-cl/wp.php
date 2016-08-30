<?php    
//## NextScripts Facebook Connection Class
$nxs_snapAvNts[] = array('code'=>'WP', 'lcode'=>'wp', 'name'=>'WP Based Blog');

if (!class_exists("nxs_snapClassWP")) { class nxs_snapClassWP {var $ntInfo = array('code'=>'WP', 'lcode'=>'wp', 'name'=>'WP Based Blog', 'defNName'=>'dlUName', 'tstReq' => false);
  //#### Show Common Settings
  function showGenNTSettings($ntOpts){  global $nxs_plurl; $ntInfo = array('code'=>'WP', 'lcode'=>'wp', 'name'=>'WP Based Blog', 'defNName'=>'dlUName', 'tstReq' => false); 
    $ntParams = array('ntInfo'=>$ntInfo, 'nxs_plurl'=>$nxs_plurl, 'ntOpts'=>$ntOpts, 'chkField'=>''); nxs_showListRow($ntParams);  
  }   
  //#### Show NEW Settings Page
  function showNewNTSettings($mgpo){ $options = array('nName'=>'', 'doWP'=>'1', 'wpUName'=>'', 'wpPageID'=>'', 'wpAttch'=>'', 'wpPass'=>'', 'wpURL'=>''); $options['ntInfo']= array('lcode'=>'wp'); $this->showNTSettings($mgpo, $options, true);}
  //#### Show Unit  Settings
  function showNTSettings($ii, $options, $isNew=false){ global $nxs_plurl; $nt = $options['ntInfo']['lcode']; $ntU = strtoupper($nt); 
    if (!isset($options['nHrs'])) $options['nHrs'] = 0; if (!isset($options['nMin'])) $options['nMin'] = 0;   
    if (!isset($options['nDays'])) $options['nDays'] = 0; if (!isset($options['qTLng'])) $options['qTLng'] = '';  ?>
            <div id="doWP<?php echo $ii; ?>Div" class="insOneDiv<?php if ($isNew) echo " clNewNTSets"; ?>">     <input type="hidden" name="apDoSWP<?php echo $ii; ?>" value="0" id="apDoSWP<?php echo $ii; ?>" />
            
            <div class="nsx_iconedTitle" style="float: right; background-image: url(<?php echo $nxs_plurl; ?>img/wp16.png);"><a style="font-size: 12px;" target="_blank"  href="http://www.nextscripts.com/setup-installation-wp-based-social-networks-auto-poster-wordpress/"><?php $nType="Wordpress"; printf( __( 'Detailed %s Installation/Configuration Instructions', 'social-networks-auto-poster-facebook-twitter-g' ), $nType); ?></a></div>
            
            <?php if ($isNew){ ?> <br/>You can setup any Wordpress based blog with activated XML-RPC support (WP Admin->Settimgs->Writing->Remote Publishing->Check XML-RPC). Wordpress.com and Blog.com supported as well.<br/><br/> <?php } ?> 
            
            <div style="width:100%;"><strong><?php _e('Account Nickname', 'social-networks-auto-poster-facebook-twitter-g'); ?>:</strong> <i><?php _e('Just so you can easily identify it', 'social-networks-auto-poster-facebook-twitter-g'); ?></i> </div><input name="wp[<?php echo $ii; ?>][nName]" id="wpnName<?php echo $ii; ?>" style="font-weight: bold; color: #005800; border: 1px solid #ACACAC; width: 40%;" value="<?php _e(apply_filters('format_to_edit', htmlentities($options['nName'], ENT_COMPAT, "UTF-8")), 'social-networks-auto-poster-facebook-twitter-g') ?>" /><br/>
            <?php echo nxs_addQTranslSel('wp', $ii, $options['qTLng']); ?> 
            
             <br/>
    <ul class="nsx_tabs">
    <li><a href="#nsx<?php echo $nt.$ii ?>_tab1"><?php _e('Account Info', 'social-networks-auto-poster-facebook-twitter-g'); ?></a></li>    
    <?php if (!$isNew) { ?>  <li><a href="#nsx<?php echo $nt.$ii ?>_tab2"><?php _e('Advanced', 'social-networks-auto-poster-facebook-twitter-g'); ?></a></li>  <?php } ?>
    </ul>
    <div class="nsx_tab_container"><?php /* ######################## Account Tab ####################### */ ?>
    <div id="nsx<?php echo $nt.$ii ?>_tab1" class="nsx_tab_content" style="background-image: url(<?php echo $nxs_plurl; ?>img/<?php echo $nt; ?>-bg.png); background-repeat: no-repeat;  background-position:90% 10%;">
    
            
            <div style="width:100%;"><strong>XMLRPC URL:</strong> </div><input name="wp[<?php echo $ii; ?>][apWPURL]" id="apWPURL" style="width: 50%;" value="<?php _e(apply_filters('format_to_edit', htmlentities($options['wpURL'], ENT_COMPAT, "UTF-8")), 'social-networks-auto-poster-facebook-twitter-g') ?>" />
            <p style="font-size: 11px; margin: 0px;">Usually its a URL of your Wordpress installation with /xmlrpc.php at the end.<br/> Please use <b style="color: #005800;">https://YourUserName.wordpress.com/xmlrpc.php</b> (replace YourUserName with your user name - for example <i style="color: #005800;">https://nextscripts.wordpress.com/xmlrpc.php</i>) for Wordpress.com blogs. <br/> Please  use <b style="color: #005800;">http://YourUserName.blog.com/xmlrpc.php</b> (replace YourUserName with your user name - for example <i style="color: #005800;">http://nextscripts.blog.com/xmlrpc.php</i> for Blog.com blogs</p>
            
            <div style="width:100%;"><br/><strong>Blog Username:</strong> </div><input name="wp[<?php echo $ii; ?>][apWPUName]" id="apWPUName" style="width: 30%;" value="<?php _e(apply_filters('format_to_edit', htmlentities($options['wpUName'], ENT_COMPAT, "UTF-8")), 'social-networks-auto-poster-facebook-twitter-g') ?>" />                
            <div style="width:100%;"><strong>Blog Password:</strong> </div><input name="wp[<?php echo $ii; ?>][apWPPass]" id="apWPPass" type="password" style="width: 30%;" value="<?php _e(apply_filters('format_to_edit', htmlentities(substr($options['wpPass'], 0, 5)=='n5g9a'?nsx_doDecode(substr($options['wpPass'], 5)):$options['wpPass'], ENT_COMPAT, "UTF-8")), 'social-networks-auto-poster-facebook-twitter-g') ?>" />  <br/>                
            
            <?php if ($isNew) { ?> <input type="hidden" name="wp[<?php echo $ii; ?>][apDoWP]" value="1" id="apDoNewWP<?php echo $ii; ?>" /> <?php } ?>
            
            <br/>
              
            <div id="altFormat" style="">
              <div style="width:100%;"><strong id="altFormatText"><?php _e('Post Title Format', 'social-networks-auto-poster-facebook-twitter-g'); ?></strong>               
(<a href="#" id="apWPMsgTFrmt<?php echo $ii; ?>HintInfo" onclick="mxs_showHideFrmtInfo('apWPMsgTFrmt<?php echo $ii; ?>'); return false;"><?php _e('Show format info', 'social-networks-auto-poster-facebook-twitter-g'); ?></a>)              
              </div>
  <input name="wp[<?php echo $ii; ?>][apWPMsgTFrmt]" id="apWPMsgTFrmt" style="width: 50%;"  onfocus="mxs_showFrmtInfo('apWPMsgTFrmt<?php echo $ii; ?>');"  value="<?php if ($isNew) echo "%TITLE%"; else _e(apply_filters('format_to_edit', htmlentities($options['wpMsgTFormat'], ENT_COMPAT, "UTF-8")), 'social-networks-auto-poster-facebook-twitter-g'); ?>" /> <?php nxs_doShowHint("apWPMsgTFrmt".$ii); ?>
  
            </div>            
            <div id="altFormat" style="">
              <div style="width:100%;"><strong id="altFormatText"><?php _e('Post Text Format', 'social-networks-auto-poster-facebook-twitter-g'); ?></strong>               
              (<a href="#" id="apWPMsgFrmt<?php echo $ii; ?>HintInfo" onclick="mxs_showHideFrmtInfo('apWPMsgFrmt<?php echo $ii; ?>'); return false;"><?php _e('Show format info', 'social-networks-auto-poster-facebook-twitter-g'); ?></a>)
              </div>
              
    
  <textarea cols="150" rows="3" id="wp<?php echo $ii; ?>SNAPformat" name="wp[<?php echo $ii; ?>][apWPMsgFrmt]" style="width:51%;max-width: 650px;" onfocus="jQuery('#wp<?php echo $ii; ?>SNAPformat').attr('rows', 6); mxs_showFrmtInfo('apWPMsgFrmt<?php echo $ii; ?>');"><?php if ($isNew) echo "%EXCERPT%"; else _e(apply_filters('format_to_edit', htmlentities($options['wpMsgFormat'], ENT_COMPAT, "UTF-8")), 'social-networks-auto-poster-facebook-twitter-g'); ?></textarea>
  <?php nxs_doShowHint("apWPMsgFrmt".$ii); ?>
  
            </div><br/>    
            
            <?php if ($options['wpPass']!='') { ?>
            
            <b><?php _e('Test your settings', 'social-networks-auto-poster-facebook-twitter-g'); ?>:</b>&nbsp;&nbsp;&nbsp; <a href="#" class="NXSButton" onclick="testPost('WP', '<?php echo $ii; ?>'); return false;"><?php printf( __( 'Submit Test Post to %s', 'social-networks-auto-poster-facebook-twitter-g' ), $nType); ?></a>      
               
            <?php } 
            
            ?></div>
            <?php /* ######################## Advanced Tab ####################### */ ?>
  <?php if (!$isNew) { ?>  <div id="nsx<?php echo $nt.$ii ?>_tab2" class="nsx_tab_content">
    
    <?php $options = nxs_FltrsV3toV4($options); nxs_showNTFilters($nt, $ii, $options); echo "<hr/>";
      nxs_addPostingDelaySelV3($nt, $ii, $options['nHrs'], $options['nMin'], $options['nDays']); 
      nxs_showRepostSettings($nt, $ii, $options); ?>
            
            
    </div>  <?php } ?> <?php /* #### End of Tab #### */ ?>
    </div><br/> <?php /* #### End of Tabs #### */ ?>
    
    <div class="submitX nxclear" style="padding-bottom: 0px;"><input type="submit" class="button-primary" name="update_NS_SNAutoPoster_settings" value="<?php _e('Update Settings', 'social-networks-auto-poster-facebook-twitter-g') ?>" /></div></div><?php
  }
  //#### Set Unit Settings from POST
  function setNTSettings($post, $options){ $code = 'WP'; $lcode = 'wp'; 
    foreach ($post as $ii => $pval){ 
      if (isset($pval['apWPUName']) && $pval['apWPUName']!=''){ if (!isset($options[$ii])) $options[$ii] = array();
        if (isset($pval['apWPURL']))   $options[$ii]['wpURL'] = trim($pval['apWPURL']);   if ( substr($options[$ii]['wpURL'], 0, 4)!='http' )  $options[$ii]['wpURL'] = 'http://'.$options[$ii]['wpURL'];
        if (isset($pval['nName']))          $options[$ii]['nName'] = trim($pval['nName']);
        if (isset($pval['apWPUName']))   $options[$ii]['wpUName'] = trim($pval['apWPUName']);
        if (isset($pval['apWPPass']))    $options[$ii]['wpPass'] = 'n5g9a'.nsx_doEncode($pval['apWPPass']); else $options[$ii]['wpPass'] = '';  
        if (isset($pval['apWPMsgFrmt'])) $options[$ii]['wpMsgFormat'] = trim($pval['apWPMsgFrmt']);                                                  
        if (isset($pval['apWPMsgTFrmt'])) $options[$ii]['wpMsgTFormat'] = trim($pval['apWPMsgTFrmt']);               
        
        
        
                                           
        if (isset($pval['apDoWP']))      $options[$ii]['doWP'] = $pval['apDoWP']; else $options[$ii]['doWP'] = 0; 
        
        $options[$ii] = nxs_adjRpst($options[$ii], $pval);       $options[$ii] = nxs_adjFilters($pval, $options[$ii]);   
        
        if (isset($pval['delayDays'])) $options[$ii]['nDays'] = trim($pval['delayDays']);
        if (isset($pval['delayHrs'])) $options[$ii]['nHrs'] = trim($pval['delayHrs']); if (isset($pval['delayMin'])) $options[$ii]['nMin'] = trim($pval['delayMin']); 
        if (isset($pval['qTLng'])) $options[$ii]['qTLng'] = trim($pval['qTLng']); 
      } elseif ( count($pval)==1 ) if (isset($pval['apDo'.$code])) $options[$ii]['do'.$code] = $pval['apDo'.$code]; else $options[$ii]['do'.$code] = 0; 
    } return $options;
  }  
  //#### Show Post->Edit Meta Box Settings
  function showEdPostNTSettings($ntOpts, $post){ global $nxs_plurl; $post_id = $post->ID; $nt = 'wp'; $ntU = 'WP';
     foreach($ntOpts as $ii=>$ntOpt)  { $pMeta = maybe_unserialize(get_post_meta($post_id, 'snapWP', true));  if (!empty($pMeta) && is_array($pMeta)) $ntOpt = $this->adjMetaOpt($ntOpt, $pMeta[$ii]); 
        if (empty($ntOpt['imgToUse'])) $ntOpt['imgToUse'] = ''; if (empty($ntOpt['urlToUse'])) $ntOpt['urlToUse'] = ''; $imgToUse = $ntOpt['imgToUse'];
        $isAvailWP =  $ntOpt['wpUName']!='' && $ntOpt['wpPass']!=''; $wpMsgFormat = htmlentities($ntOpt['wpMsgFormat'], ENT_COMPAT, "UTF-8"); $wpMsgTFormat = htmlentities($ntOpt['wpMsgTFormat'], ENT_COMPAT, "UTF-8");      
      ?>  
      <tr><th style="text-align:left;" colspan="2">
      
      
      <?php if ($isAvailWP) { $ntOpt = nxs_FltrsV3toV4($ntOpt); if (!isset($ntOpt['do'])) $ntOpt['do'] = $ntOpt['do'.$ntU]; ?>
      <?php  if ($post->post_status != "publish" && (int)$ntOpt['do']>0 && !empty($ntOpt['fltrsOn']) && $ntOpt['fltrsOn']=='1'){ ?>
       <input type="radio" id="rbtn<?php echo $ntU.$ii; ?>" value="2" name="<?php echo $nt; ?>[<?php echo $ii; ?>][do]" checked="checked" class="nxsGrpDoChb" /> <?php } 
      else { ?>
         <input class="nxsGrpDoChb" value="1" id="do<?php echo $ntU.$ii; ?>" <?php if ($post->post_status == "publish") echo 'disabled="disabled"';?> type="checkbox" name="<?php echo $nt; ?>[<?php echo $ii; ?>][do]" <?php if ((int)$ntOpt['do'] > 0) echo 'checked="checked" title="def"';  ?> /> 
      <?php }
      if ($post->post_status == "publish") { ?> <input type="hidden" name="<?php echo $nt; ?>[<?php echo $ii; ?>][do]" value="<?php echo $ntOpt['do'];?>"> <?php } ?> 
    <?php } ?>
      <div class="nsx_iconedTitle" style="display: inline; font-size: 13px; background-image: url(<?php echo $nxs_plurl; ?>img/wp16.png);">WP Blog - <?php _e('publish to', 'social-networks-auto-poster-facebook-twitter-g') ?> (<i style="color: #005800;"><?php echo $ntOpt['nName']; ?></i>)</div></th> <td><?php //## Only show RePost button if the post is "published"
                    if ($post->post_status == "publish" && $isAvailWP) { ?><?php $ntName = $this->ntInfo['name']; ?>
                    <input alt="<?php echo $ii; ?>" style="float: right;" onmouseout="hidePopShAtt('SV');" onmouseover="showPopShAtt('SV', event);" onclick="return false;" data-ntname="<?php echo $ntName; ?>" type="button" class="button manualPostBtn" name="<?php echo $nt."-".$post->ID; ?>" value="<?php _e('Post to ', 'social-networks-auto-poster-facebook-twitter-g'); echo $ntName; ?>" />
                    <?php } ?>
                    
                     <?php  if (is_array($pMeta) && is_array($pMeta[$ii]) && isset($pMeta[$ii]['pgID']) ) { $wpURL = str_ireplace('/xmlrpc.php', '', $ntOpt['wpURL']);
                        if (substr($wpURL, -1)=='/') $wpURL = substr($wpURL, 0, -1);  $wpURL = $wpURL."/";
                        ?> <span id="pstdWP<?php echo $ii; ?>" style="float: right;padding-top: 4px; padding-right: 10px;">
          <a style="font-size: 10px;" href="<?php echo $wpURL; ?>?p=<?php echo $pMeta[$ii]['pgID']; ?>" target="_blank"><?php $nType="Wordpress Blog"; printf( __( 'Posted on', 'social-networks-auto-poster-facebook-twitter-g' ), $nType); ?> <?php echo (isset($pMeta[$ii]['pDate']) && $pMeta[$ii]['pDate']!='')?(" (".$pMeta[$ii]['pDate'].")"):""; ?></a>
                    </span><?php } ?>
                    
                </td></tr>                
                
                <?php if (!$isAvailWP) { ?><tr><th scope="row" style="text-align:right; width:150px; padding-top: 5px; padding-right:10px;"></th> <td><b>Setup your WP Blog Account to AutoPost to WP Blogs</b>
                <?php } else { if ($post->post_status != "publish" && function_exists('nxs_doSMAS5') ) { $ntOpt['postTime'] = get_post_time('U', false, $post_id); nxs_doSMAS5($nt, $ii, $ntOpt); } ?>
                
                <?php if ($ntOpt['rpstOn']=='1') { ?> 
                
                <tr id="altFormat1" style=""><th scope="row" class="nxsTHRow">
                <input value="0"  type="hidden" name="<?php echo $nt; ?>[<?php echo $ii; ?>][rpstPostIncl]"/><input value="nxsi<?php echo $ii; ?>wp" type="checkbox" name="<?php echo $nt; ?>[<?php echo $ii; ?>][rpstPostIncl]"  <?php if (!empty($ntOpt['rpstPostIncl'])) echo "checked"; ?> />
                </th>
                <td> <?php _e('Include in "Auto-Reposting" to this network.', 'social-networks-auto-poster-facebook-twitter-g') ?>                
                </td></tr> <?php } ?>
                                
                <tr id="altFormat1" style=""><th scope="row" class="nxsTHRow"><?php _e('Title Format:', 'social-networks-auto-poster-facebook-twitter-g') ?></th>
                <td><input value="<?php echo $wpMsgTFormat ?>" type="text" name="wp[<?php echo $ii; ?>][SNAPformatT]"  style="width:60%;max-width: 610px;" onfocus="jQuery('.nxs_FRMTHint').hide();mxs_showFrmtInfo('apWPTMsgFrmt<?php echo $ii; ?>');"/><?php nxs_doShowHint("apWPTMsgFrmt".$ii); ?></td></tr>
                
                <tr id="altFormat1" style=""><th scope="row" class="nxsTHRow"><?php _e('Text Format:', 'social-networks-auto-poster-facebook-twitter-g') ?></th>
                <td>               
                <textarea cols="150" rows="1" id="wp<?php echo $ii; ?>SNAPformat" name="wp[<?php echo $ii; ?>][SNAPformat]"  style="width:60%;max-width: 610px;" onfocus="jQuery('#wp<?php echo $ii; ?>SNAPformat').attr('rows', 4); jQuery('.nxs_FRMTHint').hide();mxs_showFrmtInfo('apWPMsgFrmt<?php echo $ii; ?>');"><?php echo $wpMsgFormat; ?></textarea>
                <?php nxs_doShowHint("apWPMsgFrmt".$ii); ?></td></tr>
                <?php /* ## Select Image & URL ## */ nxs_showImgToUseDlg($nt, $ii, $imgToUse); ?>
  
  <?php } 
     }
  }
  //#### Save Meta Tags to the Post
  function adjMetaOpt($optMt, $pMeta){  if (isset($pMeta['isPosted'])) $optMt['isPosted'] = $pMeta['isPosted']; else $optMt['isPosted'] = '';
    if (isset($pMeta['SNAPformat'])) $optMt['wpMsgFormat'] = $pMeta['SNAPformat']; 
    if (isset($pMeta['SNAPformatT'])) $optMt['wpMsgTFormat'] = $pMeta['SNAPformatT'];  
    if (isset($pMeta['imgToUse'])) $optMt['imgToUse'] = $pMeta['imgToUse'];      
    if (isset($pMeta['timeToRun']))  $optMt['timeToRun'] = $pMeta['timeToRun'];  if (isset($pMeta['rpstPostIncl']))  $optMt['rpstPostIncl'] = $pMeta['rpstPostIncl'];    
    if (isset($pMeta['do'])) $optMt['do'] = $pMeta['do']; else $optMt['do'] = 0; if (isset($pMeta['doWP'])) $optMt['doWP'] = $pMeta['doWP']; else { if (isset($pMeta['SNAPformat'])) $optMt['doWP'] = 0; } 
    if (isset($pMeta['SNAPincludeWP']) && $pMeta['SNAPincludeWP'] == '1' ) $optMt['doWP'] = 1;  
    return $optMt;
  }  
}}
if (!function_exists("nxs_rePostToWP_ajax")) {
  function nxs_rePostToWP_ajax() { check_ajax_referer('nxsSsPageWPN');  $postID = $_POST['id']; $options = get_option('NS_SNAutoPoster');  
    foreach ($options['wp'] as $ii=>$two) if ($ii==$_POST['nid']) {   $two['ii'] = $ii;  $two['pType'] = 'aj';//if ($two['gpPageID'].$two['gpUName']==$_POST['nid']) {  
      $gppo =  get_post_meta($postID, 'snapWP', true); $gppo =  maybe_unserialize($gppo);// prr($gppo);
      if (is_array($gppo) && isset($gppo[$ii]) && is_array($gppo[$ii])){ $ntClInst = new nxs_snapClassWP(); $two = $ntClInst->adjMetaOpt($two, $gppo[$ii]); }
      $result = nxs_doPublishToWP($postID, $two); if ($result == 200) die("Successfully sent your post to WP Blog."); else die($result);        
    }    
  }
}  

if (!function_exists("nxs_doPublishToWP")) { //## Second Function to Post to WP
  function nxs_doPublishToWP($postID, $options){ $ntCd = 'WP'; $ntCdL = 'wp'; $ntNm = 'WP Based Blog'; global $plgn_NS_SNAutoPoster;
    if (!is_array($options)) $options = maybe_unserialize(get_post_meta($postID, $options, true));
    //if (isset($options['timeToRun'])) wp_unschedule_event( $options['timeToRun'], 'nxs_doPublishToWP',  array($postID, $options));      
    $blogTitle = htmlspecialchars_decode(get_bloginfo('name'), ENT_QUOTES); if ($blogTitle=='') $blogTitle = home_url(); 
    $addParams = nxs_makeURLParams(array('NTNAME'=>$ntNm, 'NTCODE'=>$ntCd, 'POSTID'=>$postID, 'ACCNAME'=>$options['nName']));
    if (empty($options['imgToUse'])) $options['imgToUse'] = ''; if (empty($options['imgSize'])) $options['imgSize'] = '';
    
    $ii = $options['ii']; if (!isset($options['pType'])) $options['pType'] = 'im'; if ($options['pType']=='sh') sleep(rand(1, 10)); 
    $logNT = '<span style="color:#1A9EE6">WP</span> - '.$options['nName'];
    $snap_ap = get_post_meta($postID, 'snap'.$ntCd, true); $snap_ap = maybe_unserialize($snap_ap);     
    if ($options['pType']!='aj' && is_array($snap_ap) && (nxs_chArrVar($snap_ap[$ii], 'isPosted', '1') || nxs_chArrVar($snap_ap[$ii], 'isPrePosted', '1'))) {
        $snap_isAutoPosted = get_post_meta($postID, 'snap_isAutoPosted', true); if ($snap_isAutoPosted!='2') {  sleep(5);
         nxs_addToLogN('W', 'Notice', $logNT, '-=Duplicate=- Post ID:'.$postID, 'Already posted. No reason for posting duplicate'.' |'.$uqID); return;
        }
    } 
      
      if ($postID=='0') { 
          echo "Testing ... <br/><br/>";  $urlToGo = home_url(); $options['wpMsgTFormat'] = 'Test Link from '.$urlToGo; $options['wpMsgFormat'] = 'Test post please ignore'; 
      } else { $post = get_post($postID); if(!$post) return; $link = get_permalink($postID); 
        $options['wpMsgFormat'] = nsFormatMessage($options['wpMsgFormat'], $postID);  $options['wpMsgTFormat'] = nsFormatMessage($options['wpMsgTFormat'], $postID);              
         //## MyURL - URLToGo code
        if (!isset($options['urlToUse']) || trim($options['urlToUse'])=='') $myurl =  trim(get_post_meta($postID, 'snap_MYURL', true)); if ($myurl!='') $options['urlToUse'] = $myurl;
        if (isset($options['urlToUse']) && trim($options['urlToUse'])!='') { $urlToGo = $options['urlToUse']; $options['useFBGURLInfo'] = true; } else $urlToGo = get_permalink($postID);      
        $gOptions = $plgn_NS_SNAutoPoster->nxs_options; $addURLParams = trim($gOptions['addURLParams']);  if($addURLParams!='') $urlToGo .= (strpos($urlToGo,'?')!==false?'&':'?').$addURLParams;         
        nxs_metaMarkAsPosted($postID, $ntCd, $options['ii'], array('isPrePosted'=>'1')); 
      }
      
      $t = wp_get_post_tags($postID); $tggs = array(); foreach ($t as $tagA) {$tggs[] = $tagA->name;} $tags = implode(',',$tggs);      
      $postCats = wp_get_post_categories($postID); $cats = array();  foreach($postCats as $c){ $cat = get_category($c); $cats[] = str_ireplace('&','&amp;',$cat->name); } // $cats = implode(',',$catsA);
            
      $extInfo = ' | PostID: '.$postID." - ".(!empty($post) && is_object($post)?$post->post_title:'');
      
      //## Message & Format           
      if (trim($options['imgToUse'])!='') $imgURL = $options['imgToUse']; else $imgURL = nxs_getPostImage($postID, 'full'); 
      $message = array('siteName'=>$blogTitle, 'url'=>$urlToGo, 'imageURL'=>$imgURL, 'tags'=>$tags, 'cats'=>$cats, 'authorName'=>'', 'orID'=>$postID);    
      //## Actual Post
      $ntToPost = new nxs_class_SNAP_WP(); $ret = $ntToPost->doPostToNT($options, $message);
      //## Process Results
      if (!is_array($ret) || $ret['isPosted']!='1') { //## Error 
        if ($postID=='0') prr($ret); nxs_addToLogN('E', 'Error', $logNT, '-=ERROR=- '.print_r($ret, true), $extInfo); 
      } else {  // ## All Good - log it.
        if ($postID=='0')  { nxs_addToLogN('S', 'Test', $logNT, 'OK - TEST Message Posted '); echo _e('OK - Message Posted, please see your '.$logNT.' Page. ', 'social-networks-auto-poster-facebook-twitter-g'); } 
          else  { do_action('nxs_actOnWP', array('postID'=>$postID, 'pgID'=>$ret['postID'], 'wpURL'=>$options['wpURL'], 'ii'=>$ii)); 
            nxs_metaMarkAsPosted($postID, $ntCd, $options['ii'], array('isPosted'=>'1', 'pgID'=>$ret['postID'], 'pDate'=>date('Y-m-d H:i:s'))); nxs_addToLogN('S', 'Posted', $logNT, 'OK - Message Posted ', $extInfo); 
          }
      }
      //## Return Result
      if ($ret['isPosted']=='1') return 200; else return print_r($ret, true); 
  }
}  
?>