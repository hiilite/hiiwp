<?php    
//## NextScripts Facebook Connection Class
$nxs_snapAvNts[] = array('code'=>'YT', 'lcode'=>'yt', 'name'=>'YouTube');

if (!class_exists("nxs_snapClassYT")) { class nxs_snapClassYT { var $ntInfo = array('code'=>'YT', 'lcode'=>'yt', 'name'=>'YouTube', 'defNName'=>'ytUName', 'tstReq' => false);
  //#### Show Common Settings
  function showGenNTSettings($ntOpts){  global $nxs_plurl; $ntInfo = array('code'=>'YT', 'lcode'=>'yt', 'name'=>'YouTube', 'defNName'=>'ytUName', 'tstReq' => false); 
    $ntParams = array('ntInfo'=>$ntInfo, 'nxs_plurl'=>$nxs_plurl, 'ntOpts'=>$ntOpts, 'chkField'=>''); nxs_showListRow($ntParams);  
  }  
  //#### Show NEW Settings Page
  function showNewNTSettings($myto){ $options = array('nName'=>'', 'doYT'=>'1', 'ytUName'=>'', 'ytPageID'=>'', 'ytGPPageID'=>'', 'postType'=>'A', 'ytPass'=>''); $options['ntInfo']= array('lcode'=>'yt'); $this->showNTSettings($myto, $options, true);}
  //#### Show Unit  Settings
  function showNTSettings($ii, $options, $isNew=false){  global $nxs_plurl; $nt = $options['ntInfo']['lcode']; $ntU = strtoupper($nt); 
    if (!isset($options['nHrs'])) $options['nHrs'] = 0; if (!isset($options['nMin'])) $options['nMin'] = 0;   
    if (!isset($options['nDays'])) $options['nDays'] = 0; if (!isset($options['qTLng'])) $options['qTLng'] = ''; if (!isset($options['ytGPPageID'])) $options['ytGPPageID'] = '';  ?>
            <div id="doYT<?php echo $ii; ?>Div" class="insOneDiv<?php if ($isNew) echo " clNewNTSets"; ?>">     <input type="hidden" name="apDoSYT<?php echo $ii; ?>" value="0" id="apDoSYT<?php echo $ii; ?>" />            
            <?php if(!class_exists('nxsAPI_GP') ) {                
                 nxs_show_noLibWrn('YouTube API Library module NOT found.<br/><br/><span style="color:black;">YouTube does not have a free native API for automated posts yet.</span><br/><br/><span style="font-size: 12px;color:black;">You need to have a special API Library Module to be able to publish your content to YouTube.</span>'); echo "</div>"; return; }; ?>            
            <div class="nsx_iconedTitle" style="float: right; background-image: url(<?php echo $nxs_plurl; ?>img/yt16.png);"><a style="font-size: 12px;" target="_blank"  href="http://www.nextscripts.com/instructions/youtube-social-networks-auto-poster-wordpress-setup-installation/"><?php $nType="YouTube"; printf( __( 'Detailed %s Installation/Configuration Instructions', 'social-networks-auto-poster-facebook-twitter-g' ), $nType); ?></a></div>
            
            <div style="width:100%;"><strong><?php _e('Account Nickname', 'social-networks-auto-poster-facebook-twitter-g'); ?>:</strong> <i><?php _e('Just so you can easily identify it', 'social-networks-auto-poster-facebook-twitter-g'); ?></i> </div><input name="yt[<?php echo $ii; ?>][nName]" id="ytnName<?php echo $ii; ?>" style="font-weight: bold; color: #005800; border: 1px solid #ACACAC; width: 40%;" value="<?php _e(apply_filters('format_to_edit', htmlentities($options['nName'], ENT_COMPAT, "UTF-8")), 'social-networks-auto-poster-facebook-twitter-g') ?>" /><br/>
            <?php echo nxs_addQTranslSel('yt', $ii, $options['qTLng']); ?>
            
              <br/>
    <ul class="nsx_tabs">
    <li><a href="#nsx<?php echo $nt.$ii ?>_tab1"><?php _e('Account Info', 'social-networks-auto-poster-facebook-twitter-g'); ?></a></li>    
    <?php if (!$isNew) { ?>  <li><a href="#nsx<?php echo $nt.$ii ?>_tab2"><?php _e('Advanced', 'social-networks-auto-poster-facebook-twitter-g'); ?></a></li>  <?php } ?>
    </ul>
    <div class="nsx_tab_container"><?php /* ######################## Account Tab ####################### */ ?>
    <div id="nsx<?php echo $nt.$ii ?>_tab1" class="nsx_tab_content" style="background-image: url(<?php echo $nxs_plurl; ?>img/<?php echo $nt; ?>-bg.png); background-repeat: no-repeat;  background-position:90% 10%;">
    
            
            <div style="width:100%;"><strong>YouTube(Google) Username:</strong> </div><input name="yt[<?php echo $ii; ?>][apYTUName]" id="apYTUName" style="width: 30%;" value="<?php _e(apply_filters('format_to_edit', htmlentities($options['ytUName'], ENT_COMPAT, "UTF-8")), 'social-networks-auto-poster-facebook-twitter-g') ?>" />                
            <div style="width:100%;"><strong>YouTube(Google) Password:</strong> </div><input autocomplete="false" readonly onfocus="this.removeAttribute('readonly');" name="yt[<?php echo $ii; ?>][apYTPass]" id="apYTPass" type="password" style="width: 30%;" value="<?php _e(apply_filters('format_to_edit', htmlentities(substr($options['ytPass'], 0, 5)=='n5g9a'?nsx_doDecode(substr($options['ytPass'], 5)):$options['ytPass'], ENT_COMPAT, "UTF-8")), 'social-networks-auto-poster-facebook-twitter-g') ?>" />  <br/>                
            <p><div style="width:100%;"><strong>YouTube Channel Page URL:</strong> 
            
            </div><input name="yt[<?php echo $ii; ?>][apYTPage]" id="apYTPage" style="width: 30%;" value="<?php _e(apply_filters('format_to_edit', htmlentities($options['ytPageID'], ENT_COMPAT, "UTF-8")), 'social-networks-auto-poster-facebook-twitter-g') ?>" /> 
            <br/><br/>
            
            <p><div style="width:100%;"><i style="color: gray;"><strong >Google+ Page ID:</strong>&nbsp;Fill this only if you are posting to youTube as your Google+ page. Please leave this empty otherwise.</i>
            
            </div><input name="yt[<?php echo $ii; ?>][ytGPPageID]" id="ytGPPageID" style="width: 30%;" value="<?php _e(apply_filters('format_to_edit', htmlentities($options['ytGPPageID'], ENT_COMPAT, "UTF-8")), 'social-networks-auto-poster-facebook-twitter-g') ?>" /> 
            <br/><br/>
            
            <div id="altFormat" style="">
              <div style="width:100%;"><strong id="altFormatText"><?php _e('Message text Format', 'social-networks-auto-poster-facebook-twitter-g'); ?>:</strong> (<a href="#" id="apYTMsgFrmt<?php echo $ii; ?>HintInfo" onclick="mxs_showHideFrmtInfo('apYTMsgFrmt<?php echo $ii; ?>'); return false;"><?php _e('Show format info', 'social-networks-auto-poster-facebook-twitter-g'); ?></a>)
              </div>
              
              <textarea cols="150" rows="3" id="yt<?php echo $ii; ?>SNAPformat" name="yt[<?php echo $ii; ?>][apYTMsgFrmt]" style="width:51%;max-width: 650px;" onfocus="jQuery('#yt<?php echo $ii; ?>SNAPformat').attr('rows', 6); mxs_showFrmtInfo('apYTMsgFrmt<?php echo $ii; ?>');"><?php if ($isNew) _e("New post: %TITLE% - %URL%", 'social-networks-auto-poster-facebook-twitter-g'); else _e(apply_filters('format_to_edit', htmlentities($options['ytMsgFormat'], ENT_COMPAT, "UTF-8")), 'social-networks-auto-poster-facebook-twitter-g'); ?></textarea>
              
              <?php nxs_doShowHint("apYTMsgFrmt".$ii); ?>
            </div><br/>          
          
            <?php if ($isNew) { ?> <input type="hidden" name="yt[<?php echo $ii; ?>][apDoYT]" value="1" id="apDoNewYT<?php echo $ii; ?>" /> <?php } ?>
            <?php if ($options['ytPass']!='') { ?>
            
            <b><?php _e('Test your settings', 'social-networks-auto-poster-facebook-twitter-g'); ?>:</b>&nbsp;&nbsp;&nbsp; <a href="#" class="NXSButton" onclick="testPost('YT', '<?php echo $ii; ?>'); return false;"><?php printf( __( 'Submit Test Post to %s', 'social-networks-auto-poster-facebook-twitter-g' ), $nType); ?></a>              <?php } 
            ?></div>
            <?php /* ######################## Advanced Tab ####################### */ ?>
   <?php if (!$isNew) { ?>   <div id="nsx<?php echo $nt.$ii ?>_tab2" class="nsx_tab_content">
    
   <?php $options = nxs_FltrsV3toV4($options); nxs_showNTFilters($nt, $ii, $options); echo "<hr/>";
      nxs_addPostingDelaySelV3($nt, $ii, $options['nHrs'], $options['nMin'], $options['nDays']); 
      nxs_showRepostSettings($nt, $ii, $options); ?>
            
            
    </div>     <?php } ?> <?php /* #### End of Tab #### */ ?>
    </div><br/> <?php /* #### End of Tabs #### */ ?>
    
    <div class="submitX nxclear" style="padding-bottom: 0px;"><input type="submit" class="button-primary" name="update_NS_SNAutoPoster_settings" value="<?php _e('Update Settings', 'social-networks-auto-poster-facebook-twitter-g') ?>" /></div></div><?php
  }
  //#### Set Unit Settings from POST
  function setNTSettings($post, $options){ $code = 'YT'; $lcode = 'yt'; 
    foreach ($post as $ii => $pval){       
      if (!empty($pval['apYTUName']) && !empty($pval['apYTPass'])){ if (!isset($options[$ii])) $options[$ii] = array();
        if (isset($pval['apYTUName']))   $options[$ii]['ytUName'] = trim($pval['apYTUName']);
        if (isset($pval['nName']))          $options[$ii]['nName'] = trim($pval['nName']);
        if (isset($pval['apYTPass']))    $options[$ii]['ytPass'] = 'n5g9a'.nsx_doEncode($pval['apYTPass']); else $options[$ii]['ytPass'] = '';  
        if (isset($pval['apYTPage']))    $options[$ii]['ytPageID'] = trim($pval['apYTPage']);  
        if (isset($pval['ytGPPageID']))    $options[$ii]['ytGPPageID'] = trim($pval['ytGPPageID']);  
        
        
        
                      
        if (isset($pval['postType']))   $options[$ii]['postType'] = $pval['postType'];         
        if (isset($pval['apYTMsgFrmt'])) $options[$ii]['ytMsgFormat'] = trim($pval['apYTMsgFrmt']);                                                  
        if (isset($pval['apDoYT']))      $options[$ii]['doYT'] = $pval['apDoYT']; else $options[$ii]['doYT'] = 0; 
        
        $options[$ii] = nxs_adjRpst($options[$ii], $pval);       $options[$ii] = nxs_adjFilters($pval, $options[$ii]);   
        
        if (isset($pval['delayDays'])) $options[$ii]['nDays'] = trim($pval['delayDays']);
        if (isset($pval['delayHrs'])) $options[$ii]['nHrs'] = trim($pval['delayHrs']); if (isset($pval['delayMin'])) $options[$ii]['nMin'] = trim($pval['delayMin']); 
        if (isset($pval['qTLng'])) $options[$ii]['qTLng'] = trim($pval['qTLng']); 
      } elseif ( count($pval)==1 ) if (isset($pval['apDo'.$code])) $options[$ii]['do'.$code] = $pval['apDo'.$code]; else $options[$ii]['do'.$code] = 0; 
    } return $options;
  }  
  //#### Show Post->Edit Meta Box Settings
  function showEdPostNTSettings($ntOpts, $post){ global $nxs_plurl; $post_id = $post->ID; $nt = 'yt'; $ntU = 'YT';
     foreach($ntOpts as $ii=>$ntOpt)  { $pMeta = maybe_unserialize(get_post_meta($post_id, 'snapYT', true));  if (is_array($pMeta)) $ntOpt = $this->adjMetaOpt($ntOpt, $pMeta[$ii]); 
        $isAvailYT =  $ntOpt['ytUName']!='' && $ntOpt['ytPass']!='';   $ytMsgFormat = htmlentities($ntOpt['ytMsgFormat'], ENT_COMPAT, "UTF-8");              
      ?>  
      <tr><th style="text-align:left;" colspan="2">
      
      
      <?php if ($isAvailYT) { $ntOpt = nxs_FltrsV3toV4($ntOpt); if (!isset($ntOpt['do'])) $ntOpt['do'] = $ntOpt['do'.$ntU]; ?>
      <?php  if ($post->post_status != "publish" && (int)$ntOpt['do']>0 && !empty($ntOpt['fltrsOn']) && $ntOpt['fltrsOn']=='1'){ ?>
       <input type="radio" id="rbtn<?php echo $ntU.$ii; ?>" value="2" name="<?php echo $nt; ?>[<?php echo $ii; ?>][do]" checked="checked" class="nxsGrpDoChb" /> <?php } 
      else { ?>
         <input class="nxsGrpDoChb" value="1" id="do<?php echo $ntU.$ii; ?>" <?php if ($post->post_status == "publish") echo 'disabled="disabled"';?> type="checkbox" name="<?php echo $nt; ?>[<?php echo $ii; ?>][do]" <?php if ((int)$ntOpt['do'] > 0) echo 'checked="checked" title="def"';  ?> /> 
      <?php }
      if ($post->post_status == "publish") { ?> <input type="hidden" name="<?php echo $nt; ?>[<?php echo $ii; ?>][do]" value="<?php echo $ntOpt['do'];?>"> <?php } ?> 
    <?php } ?>
      <div class="nsx_iconedTitle" style="display: inline; font-size: 13px; background-image: url(<?php echo $nxs_plurl; ?>img/yt16.png);">YouTube - <?php _e('publish to', 'social-networks-auto-poster-facebook-twitter-g') ?> (<i style="color: #005800;"><?php echo $ntOpt['nName']; ?></i>)</div></th> <td><?php //## Only show RePost button if the post is "published"
                    if ($post->post_status == "publish" && $isAvailYT) { ?><?php $ntName = $this->ntInfo['name']; ?>
                    <input alt="<?php echo $ii; ?>" style="float: right;" onmouseout="hidePopShAtt('SV');" onmouseover="showPopShAtt('SV', event);" onclick="return false;" data-ntname="<?php echo $ntName; ?>" type="button" class="button manualPostBtn" name="<?php echo $nt."-".$post->ID; ?>" value="<?php _e('Post to ', 'social-networks-auto-poster-facebook-twitter-g'); echo $ntName; ?>" />
                    <?php } ?>
                    
                    <?php  if (is_array($pMeta) && is_array($pMeta[$ii]) && isset($pMeta[$ii]['pgID']) ) { 
                        
                        ?> <span id="pstdYT<?php echo $ii; ?>" style="float: right;padding-top: 4px; padding-right: 10px;">
                      <a style="font-size: 10px;" href="<?php echo $ntOpt['ytPageID']; ?>" target="_blank"><?php $nType="YouTube"; printf( __( 'Posted on', 'social-networks-auto-poster-facebook-twitter-g' ), $nType); ?>  <?php echo (isset($pMeta[$ii]['pDate']) && $pMeta[$ii]['pDate']!='')?(" (".$pMeta[$ii]['pDate'].")"):""; ?></a>
                    </span><?php } ?>
                    
                </td></tr>                
                
                <?php if (!$isAvailYT) { ?><tr><th scope="row" style="text-align:right; width:150px; padding-top: 5px; padding-right:10px;"></th> <td><b>Setup your YouTube Account to AutoPost to YouTube</b>
                <?php } else { if ($post->post_status != "publish" && function_exists('nxs_doSMAS5') ) { nxs_doSMAS5($nt, $ii, $ntOpt); } ?>
                
                <?php if ($ntOpt['rpstOn']=='1') { ?> 
                
                <tr id="altFormat1" style=""><th scope="row" class="nxsTHRow">
                <input value="0"  type="hidden" name="<?php echo $nt; ?>[<?php echo $ii; ?>][rpstPostIncl]"/><input value="nxsi<?php echo $ii; ?>yt" type="checkbox" name="<?php echo $nt; ?>[<?php echo $ii; ?>][rpstPostIncl]"  <?php if (!empty($ntOpt['rpstPostIncl'])) echo "checked"; ?> />
                </th>
                <td> <?php _e('Include in "Auto-Reposting" to this network.', 'social-networks-auto-poster-facebook-twitter-g') ?>                
                </td></tr> <?php } ?>
                
                
                <tr id="altFormat1" style=""><th scope="row" style="vertical-align:top;  padding-top: 6px; text-align:right; width:60px; padding-right:10px;"><?php _e('Message Format:', 'social-networks-auto-poster-facebook-twitter-g') ?></th>
                <td>
                
                 <?php if (1==1) { ?>
                <textarea cols="150" rows="1" id="yt<?php echo $ii; ?>SNAPformat" name="yt[<?php echo $ii; ?>][SNAPformat]"  style="width:60%;max-width: 610px;" onfocus="jQuery('#yt<?php echo $ii; ?>SNAPformat').attr('rows', 4); jQuery('.nxs_FRMTHint').hide();mxs_showFrmtInfo('apYTMsgFrmt<?php echo $ii; ?>');"><?php echo $ytMsgFormat ?></textarea>
                <?php } else { ?>
                <input value="<?php echo $ytMsgFormat ?>" type="text" name="yt[<?php echo $ii; ?>][SNAPformat]"  style="width:60%;max-width: 610px;" onfocus="jQuery('.nxs_FRMTHint').hide();mxs_showFrmtInfo('apYTMsgFrmt<?php echo $ii; ?>');"/><?php nxs_doShowHint("apYTMsgFrmt".$ii); ?>
                <?php } ?>
                
                
                </td></tr>
           <?php } 
     }
  }
  //#### Save Meta Tags to the Post
  function adjMetaOpt($optMt, $pMeta){ if (isset($pMeta['isPosted'])) $optMt['isPosted'] = $pMeta['isPosted']; else  $optMt['isPosted'] = ''; 
    if (isset($pMeta['SNAPformat'])) $optMt['ytMsgFormat'] = $pMeta['SNAPformat'];
    if (isset($pMeta['imgToUse'])) $optMt['imgToUse'] = $pMeta['imgToUse'];      
    if (isset($pMeta['timeToRun']))  $optMt['timeToRun'] = $pMeta['timeToRun'];  if (isset($pMeta['rpstPostIncl']))  $optMt['rpstPostIncl'] = $pMeta['rpstPostIncl'];       
    if (isset($pMeta['postType'])) $optMt['postType'] = $pMeta['postType'];
    if (isset($pMeta['do'])) $optMt['do'] = $pMeta['do']; else $optMt['do'] = 0; if (isset($pMeta['doYT'])) $optMt['doYT'] = $pMeta['doYT']; else { if (isset($pMeta['SNAPformat'])) $optMt['doYT'] = 0; } 
    if (isset($pMeta['SNAPincludeYT']) && $pMeta['SNAPincludeYT'] == '1' ) $optMt['doYT'] = 1;  
    return $optMt;
  }  
}}
if (!function_exists("nxs_rePostToYT_ajax")) {
  function nxs_rePostToYT_ajax() { check_ajax_referer('nxsSsPageWPN');  $postID = $_POST['id']; global $plgn_NS_SNAutoPoster;  if (!isset($plgn_NS_SNAutoPoster)) return; $options = $plgn_NS_SNAutoPoster->nxs_options; 
    foreach ($options['yt'] as $ii=>$two) if ($ii==$_POST['nid']) {   $two['ii'] = $ii; $two['pType'] = 'aj'; //if ($two['ytPageID'].$two['ytUName']==$_POST['nid']) {  
      $ytpo =  get_post_meta($postID, 'snapYT', true); $ytpo =  maybe_unserialize($ytpo);// prr($ytpo);
      if (is_array($ytpo) && isset($ytpo[$ii]) && is_array($ytpo[$ii])){ $ntClInst = new nxs_snapClassYT(); $two = $ntClInst->adjMetaOpt($two, $ytpo[$ii]); } 
      $result = nxs_doPublishToYT($postID, $two); if ($result === 200) die("Successfully sent your post to YouTube."); else die($result);        
    }    
  }
}  

if (!function_exists("nxs_doPublishToYT")) { //## Second Function to Post to G+
  function nxs_doPublishToYT($postID, $options){ $ntCd = 'YT'; $ntCdL = 'yt'; $ntNm = 'YouTube'; $post = '';  global $nxs_gCookiesArr; $vUrl = '';
      if (!is_array($options)) $options = maybe_unserialize(get_post_meta($postID, $options, true));
      // $backtrace = debug_backtrace(); nxs_addToLogN('W', 'Enter', $ntCd, 'I am here - '.$ntCd."|".print_r($backtrace, true), ''); 
      //if (isset($options['timeToRun'])) wp_unschedule_event( $options['timeToRun'], 'nxs_doPublishToYT',  array($postID, $options));
      $addParams = nxs_makeURLParams(array('NTNAME'=>$ntNm, 'NTCODE'=>$ntCd, 'POSTID'=>$postID, 'ACCNAME'=>$options['nName'])); 
      $blogTitle = htmlspecialchars_decode(get_bloginfo('name'), ENT_QUOTES); if ($blogTitle=='') $blogTitle = home_url(); 
      if (empty($options['ytGPPageID'])) $options['ytGPPageID'] = ''; // if (empty($options['imgSize'])) $options['imgSize'] = '';
      if(!function_exists('doConnectToGooglePlus2') || !function_exists('doPostToGooglePlus2')) { nxs_addToLogN('E', 'Error', $ntCd, '-=ERROR=- No G+ API Lib Detected', ''); return "No G+ API Lib Detected";}
      $ii = $options['ii']; if (!isset($options['pType'])) $options['pType'] = 'im'; if ($options['pType']=='sh') sleep(rand(1, 10)); 
      $logNT = '<span style="color:#800000">YouTube</span> - '.$options['nName'];      
      $snap_ap = get_post_meta($postID, 'snap'.$ntCd, true); $snap_ap = maybe_unserialize($snap_ap);     
      if ($options['pType']!='aj' && is_array($snap_ap) && (nxs_chArrVar($snap_ap[$ii], 'isPosted', '1') || nxs_chArrVar($snap_ap[$ii], 'isPrePosted', '1'))) {
        $snap_isAutoPosted = get_post_meta($postID, 'snap_isAutoPosted', true); if ($snap_isAutoPosted!='2') {  sleep(5);
           nxs_addToLogN('W', 'Notice', $logNT, '-=Duplicate=- Post ID:'.$postID, 'Already posted. No reason for posting duplicate'.' |'.$uqID); return;
        }
      }         
      if ($postID=='0') $options['ytMsgFormat'] = 'Test Post, Please Ignore';  else { nxs_metaMarkAsPosted($postID, $ntCd, $options['ii'], array('isPrePosted'=>'1'));  $post = get_post($postID); if(!$post) return;
        $options['ytMsgFormat'] = nsFormatMessage($options['ytMsgFormat'], $postID, $addParams);// prr($msg); echo $postID;
      }
      $extInfo = ' | PostID: '.$postID." - ".(is_object($post)?$post->post_title:'');
      
      //## Message & Format                 
      $vids = nsFindVidsInPost($post); if (count($vids)>0) $vUrl = $vids[0];
      $message = array('siteName'=>$blogTitle, 'videoURL'=>$vUrl);    
      //## Actual Post
      $ntToPost = new nxs_class_SNAP_YT(); $ret = $ntToPost->doPostToNT($options, $message);
      //## Process Results
      if (!is_array($ret) || $ret['isPosted']!='1') { //## Error 
        if ($postID=='0') prr($ret); nxs_addToLogN('E', 'Error', $logNT, '-=ERROR=- '.print_r($ret, true), $extInfo); 
      } else {  // ## All Good - log it.
        if ($postID=='0')  { nxs_addToLogN('S', 'Test', $logNT, 'OK - TEST Message Posted '); echo _e('OK - Message Posted, please see your '.$logNT.' Page. ', 'social-networks-auto-poster-facebook-twitter-g'); } 
          else  { nxs_metaMarkAsPosted($postID, $ntCd, $options['ii'], array('isPosted'=>'1', 'pgID'=>$ret['postID'], 'pDate'=>date('Y-m-d H:i:s'))); nxs_addToLogN('S', 'Posted', $logNT, 'OK - Message Posted ', $extInfo); }
      } 
      //## Return Result
      if (is_array($ret) && !empty($ret['isPosted']) && $ret['isPosted']=='1') return 200; else return print_r($ret, true);       
  } 
}  
?>