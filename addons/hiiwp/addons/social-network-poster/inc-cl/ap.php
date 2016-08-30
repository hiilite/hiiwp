<?php    
//## NextScripts App.net Connection Class
$nxs_snapAvNts[] = array('code'=>'AP', 'lcode'=>'ap', 'name'=>'App.net');

if (!class_exists("nxs_snapClassAP")) { class nxs_snapClassAP { var $ntInfo = array('code'=>'AP', 'lcode'=>'ap', 'name'=>'App.Net', 'defNName'=>'', 'tstReq' => true);
  //#### Show Common Settings
  function showGenNTSettings($ntOpts){  global $nxs_plurl, $nxs_snapSetPgURL, $nxs_gOptions;  $ntInfo = $this->ntInfo;
    if ( isset($_GET['code']) && $_GET['code']!='' && (isset($_GET['state']) && stripos($_GET['state'], 'ap-')!==false) ){  $at = $_GET['code'];  $to = explode('-', $_GET['state']); $_GET['acc'] = $to[1];
     echo "-= This is normal technical authorization info that will dissapear (Unless you get some errors) =- <br/><br/><br/>";
     $fbo = $ntOpts[$_GET['acc']]; $wprg = array(); $response = wp_remote_get('https://graph.facebook.com/nextscripts', $wprg);
     echo $nxs_snapSetPgURL.'&auth=ap&acc='.$_GET['acc']."||"; if(stripos($nxs_snapSetPgURL, 'page=NextScripts_SNAP.php')===false) { $newURL = explode('?', $nxs_snapSetPgURL); $nxs_snapSetPgURL = $newURL[0]; }
     if( is_wp_error( $response) && isset($response->errors['http_request_failed']) && stripos($response->errors['http_request_failed'][0], 'SSL')!==false ) {  prr($response->errors); $wprg['sslverify'] = false; }
     if (isset($fbo['appID'])){ echo "-="; prr($fbo);
       $wprg['body'] = array('client_id'=>$fbo['appID'], 'client_secret'=>$fbo['appSec'], 'grant_type'=>'authorization_code', 'redirect_uri'=>$nxs_snapSetPgURL, 'state'=>'ap-'.$_GET['acc'], 'code'=>$at); prr($wprg);  
       $response = wp_remote_post('https://account.app.net/oauth/access_token', $wprg); 
       if ( (is_object($response) && (isset($response->errors))) || (is_array($response) && stripos($response['body'],'"error":')!==false )) { prr($response); die(); }  
       $params = json_decode($response['body'], true);  $fbo['apAppAuthToken'] = $params['access_token']; if ($params['user_id']>0) { $fbo['appAppUserID'] = $params['user_id']; $fbo['appAppUserName'] = $params['username'];  }
       if ($params['user_id']>0) { nxs_save_glbNtwrks($ntInfo['lcode'],$_GET['acc'],$fbo,'*');            
           //if (function_exists('get_option')) $nxs_gOptions = get_option('NS_SNAutoPoster'); if(!empty($nxs_gOptions)) { $nxs_gOptions['ap'][$_GET['acc']] = $fbo;  nxs_settings_save($nxs_gOptions); }            
         ?><script type="text/javascript">window.location = "<?php echo $nxs_snapSetPgURL; ?>"</script>      
       <?php } die(); }
    }  
    $ntParams = array('ntInfo'=>$ntInfo, 'nxs_plurl'=>$nxs_plurl, 'ntOpts'=>$ntOpts, 'chkField'=>'appAppUserID'); nxs_showListRow($ntParams);  
  }  
  //#### Show NEW Settings Page
  function showNewNTSettings($options){ $opts = array('nName'=>'', 'doAP'=>'1', 'apUName'=>'', 'apPageID'=>'', 'apCommID'=>'', 'postType'=>'A', 'apPass'=>''); $opts['ntInfo']= array('lcode'=>'ap'); $this->showNTSettings($options, $opts, true);}
  //#### Show Unit  Settings
  function showNTSettings($ii, $options, $isNew=false){  global $nxs_plurl, $nxs_snapSetPgURL; $nt = $options['ntInfo']['lcode']; $ntU = strtoupper($nt); 
    if (!isset($options['nHrs'])) $options['nHrs'] = 0; if (!isset($options['nMin'])) $options['nMin'] = 0;   
    if (!isset($options['nDays'])) $options['nDays'] = 0; if (!isset($options['qTLng'])) $options['qTLng'] = ''; if (!isset($options['attchImg'])) $options['attchImg'] = '';     
    if (!isset($options['appID'])) $options['appID'] = ''; if (!isset($options['appSec'])) $options['appSec'] = '';  ?>    
            <div id="doAP<?php echo $ii; ?>Div" class="insOneDiv<?php if ($isNew) echo " clNewNTSets"; ?>">     
            <input type="hidden" value="0" id="apDoS<?php echo $ntU.$ii; ?>" />
            <div class="nsx_iconedTitle" style="float: right; background-image: url(<?php echo $nxs_plurl; ?>img/ap16.png);"><a style="font-size: 12px;" target="_blank"  href="http://www.nextscripts.com/setup-installation/app-net-social-networks-auto-poster-wordpress/"><?php $nType="App.Net"; printf( __( 'Detailed %s Installation/Configuration Instructions', 'social-networks-auto-poster-facebook-twitter-g' ), $nType); ?></a></div>
            
            <div style="width:100%;"><strong><?php _e('Account Nickname', 'social-networks-auto-poster-facebook-twitter-g'); ?>:</strong> <i><?php _e('Just so you can easily identify it', 'social-networks-auto-poster-facebook-twitter-g'); ?></i> </div><input name="ap[<?php echo $ii; ?>][nName]" id="apnName<?php echo $ii; ?>" style="font-weight: bold; color: #005800; border: 1px solid #ACACAC; width: 40%;" value="<?php _e(apply_filters('format_to_edit', htmlentities($options['nName'], ENT_COMPAT, "UTF-8")), 'social-networks-auto-poster-facebook-twitter-g') ?>" /><br/>
            <?php echo nxs_addQTranslSel('ap', $ii, $options['qTLng']); ?>
            <br/>
                <ul class="nsx_tabs">
    <li><a href="#nsx<?php echo $nt.$ii ?>_tab1"><?php _e('Account Info', 'social-networks-auto-poster-facebook-twitter-g'); ?></a></li>    
    <?php if (!$isNew) { ?>  <li><a href="#nsx<?php echo $nt.$ii ?>_tab2"><?php _e('Advanced', 'social-networks-auto-poster-facebook-twitter-g'); ?></a></li>  <?php } ?>
    </ul>
    <div class="nsx_tab_container"><?php /* ######################## Account Tab ####################### */ ?>
    <div id="nsx<?php echo $nt.$ii ?>_tab1" class="nsx_tab_content" style="background-image: url(<?php echo $nxs_plurl; ?>img/<?php echo $nt; ?>-bg.png); background-repeat: no-repeat;  background-position:90% 10%;">
            
            <div style="width:100%;"><strong>App.Net Client ID:</strong> </div><input name="ap[<?php echo $ii; ?>][appID]" style="width: 30%;" value="<?php _e(apply_filters('format_to_edit', htmlentities($options['appID'], ENT_COMPAT, "UTF-8")), 'social-networks-auto-poster-facebook-twitter-g') ?>" />                
            <div style="width:100%;"><strong>App.Net Client Secret:</strong> </div><input name="ap[<?php echo $ii; ?>][appSec]"  style="width: 30%;" value="<?php _e(apply_filters('format_to_edit', htmlentities($options['appSec'], ENT_COMPAT, "UTF-8")), 'social-networks-auto-poster-facebook-twitter-g') ?>" />  <br/>                
              <br/>  
                      
            <div id="altFormat" style="margin-left: 0px;">
              <div style="width:100%;"><strong id="altFormatText"><?php _e('Text Format', 'social-networks-auto-poster-facebook-twitter-g'); ?>:</strong> (<a href="#" id="apTextFormat<?php echo $ii; ?>HintInfo" onclick="mxs_showHideFrmtInfo('apTextFormat<?php echo $ii; ?>'); return false;"><?php _e('Show format info', 'social-networks-auto-poster-facebook-twitter-g'); ?></a>)
              </div>
              
              <textarea cols="150" rows="3" id="ap<?php echo $ii; ?>SNAPformat" name="ap[<?php echo $ii; ?>][apTextFormat]" style="width:51%;max-width: 650px;" onfocus="jQuery('#ap<?php echo $ii; ?>SNAPformat').attr('rows', 6); mxs_showFrmtInfo('apAPMsgFrmt<?php echo $ii; ?>');"><?php if ($isNew) _e("New post (%TITLE%) has been published on %SITENAME% - %URL%", 'social-networks-auto-poster-facebook-twitter-g'); else _e(apply_filters('format_to_edit', htmlentities($options['apTextFormat'], ENT_COMPAT, "UTF-8")), 'social-networks-auto-poster-facebook-twitter-g'); ?></textarea>
              
              <?php nxs_doShowHint("apTextFormat".$ii); ?>
            </div>
            
    <p style="margin: 0px;"><input value="1"  id="apAPAttch" type="checkbox" name="ap[<?php echo $ii; ?>][attchImg]"  <?php if ((int)$options['attchImg'] == 1) echo "checked"; ?> /> <strong><?php _e('Attach Image to App.net Post', 'social-networks-auto-poster-facebook-twitter-g'); ?></strong></p>
            <br/><br/>
            <?php  if($options['appID']=='') { ?>
            <b><?php _e('Authorize Your App.Net Account', 'social-networks-auto-poster-facebook-twitter-g'); ?></b> <?php _e('Please click "Update Settings" to be able to Authorize your account.', 'social-networks-auto-poster-facebook-twitter-g'); ?>
            <?php } else { if(isset($options['appAppUserID']) && $options['appAppUserID']>0) { ?>
            <?php _e('Your App.Net Account has been authorized.', 'social-networks-auto-poster-facebook-twitter-g'); ?> User ID: <?php _e(apply_filters('format_to_edit', htmlentities($options['appAppUserID'].' - '.$options['appAppUserName'], ENT_COMPAT, "UTF-8")), 'social-networks-auto-poster-facebook-twitter-g') ?>.
            <?php _e('You can', 'social-networks-auto-poster-facebook-twitter-g'); ?> Re- <?php } ?>            
            <a href="https://account.app.net/oauth/authenticate?client_id=<?php echo trim($options['appID']);?>&response_type=code&redirect_uri=<?php echo trim(urlencode($nxs_snapSetPgURL).'&state=ap-'.$ii.'&scope=stream+write_post+follow+messages+update_profile+files');?>">Authorize Your App.Net Account</a> 
            <?php if (!isset($options['appAppUserID']) || $options['appAppUserID']<1) { ?> <div class="blnkg">&lt;=== <?php _e('Authorize your account', 'social-networks-auto-poster-facebook-twitter-g'); ?> ===</div> 
            <br/><br/><i> <?php _e('If you get App.Net message:', 'social-networks-auto-poster-facebook-twitter-g'); ?> <b>"Error. An error occurred. Please try again later."</b> or <b>"Error 191"</b>  <?php _e('please make sure that domain name in your App.Net App matches your website domain exactly. Please note that www. and non www. versions are different domains.', 'social-networks-auto-poster-facebook-twitter-g'); ?></i> <?php }?>
            <?php } ?>
            <br/>
            
            
            <?php if ($isNew) { ?> <input type="hidden" name="ap[<?php echo $ii; ?>][apDoAP]" value="1" id="apDoNewAP<?php echo $ii; ?>" /> <?php } ?>
            <?php if (isset($options['appAppUserID']) && $options['appAppUserID']>0) { ?>
            
            <b><?php _e('Test your settings', 'social-networks-auto-poster-facebook-twitter-g'); ?>:</b>&nbsp;&nbsp;&nbsp; <a href="#" class="NXSButton" onclick="testPost('AP', '<?php echo $ii; ?>'); return false;"><?php printf( __( 'Submit Test Post to %s', 'social-networks-auto-poster-facebook-twitter-g' ), $nType); ?></a>              <?php } 
            ?>
    
     </div>
      <?php /* ######################## Tools Tab ####################### */ ?>
    <?php if (!$isNew) { ?><div id="nsx<?php echo $nt.$ii ?>_tab2" class="nsx_tab_content">    
    <?php $options = nxs_FltrsV3toV4($options); nxs_showNTFilters($nt, $ii, $options); echo "<hr/>";
          nxs_addPostingDelaySelV3($nt, $ii, $options['nHrs'], $options['nMin'], $options['nDays']);
          nxs_showRepostSettings($nt, $ii, $options); ?>      
    </div> <?php } ?>       <?php /* #### End of Tab #### */ ?>
    </div><br/> <?php /* #### End of Tabs #### */ ?>
    
    <div class="submitX nxclear" style="padding-bottom: 0px;"><input type="submit" class="button-primary" name="update_NS_SNAutoPoster_settings" value="<?php _e('Update Settings', 'social-networks-auto-poster-facebook-twitter-g') ?>" /></div>
            
            
            </div><?php
  }
  //#### Set Unit Settings from POST
  function setNTSettings($post, $options){ $code = $this->ntInfo['code'];
    foreach ($post as $ii => $pval){ 
      if (isset($pval['appID']) && $pval['appID']!=''){ if (!isset($options[$ii])) $options[$ii] = array();
        if (isset($pval['nName']))          $options[$ii]['nName'] = trim($pval['nName']);  
        
        if (isset($pval['appID']))   $options[$ii]['appID'] = trim($pval['appID']);
        
        if (isset($pval['appSec']))   $options[$ii]['appSec'] = trim($pval['appSec']);
        if (isset($pval['apSubReddit']))    $options[$ii]['apSubReddit'] = trim($pval['apSubReddit']);          
        
        
                             
            
        if (isset($pval['attchImg'])) $options[$ii]['attchImg'] = $pval['attchImg']; else $options[$ii]['attchImg'] = 0;                
        if (isset($pval['apTextFormat'])) $options[$ii]['apTextFormat'] = trim($pval['apTextFormat']);        
        if (isset($pval['apDoAP']))      $options[$ii]['doAP'] = $pval['apDoAP']; else $options[$ii]['doAP'] = 0; 
        
        $options[$ii] = nxs_adjRpst($options[$ii], $pval);       $options[$ii] = nxs_adjFilters($pval, $options[$ii]);   
        
        if (isset($pval['delayDays'])) $options[$ii]['nDays'] = trim($pval['delayDays']);
        if (isset($pval['delayHrs'])) $options[$ii]['nHrs'] = trim($pval['delayHrs']); if (isset($pval['delayMin'])) $options[$ii]['nMin'] = trim($pval['delayMin']); 
        if (isset($pval['qTLng'])) $options[$ii]['qTLng'] = trim($pval['qTLng']); 
      } elseif ( count($pval)==1 ) if (isset($pval['apDo'.$code])) $options[$ii]['do'.$code] = $pval['apDo'.$code]; else $options[$ii]['do'.$code] = 0; 
    } return $options;
  }  
  //#### Show Post->Edit Meta Box Settings
  function showEdPostNTSettings($ntOpts, $post){ global $nxs_plurl; $post_id = $post->ID;  $nt = 'ap'; $ntU = 'AP'; 
     foreach($ntOpts as $ii=>$ntOpt)  { $pMeta = maybe_unserialize(get_post_meta($post_id, 'snapAP', true));  
        if (is_array($pMeta) && isset($pMeta[$ii]) && is_array($pMeta[$ii])) $ntOpt = $this->adjMetaOpt($ntOpt, $pMeta[$ii]);  if (empty($ntOpt['imgToUse'])) $ntOpt['imgToUse'] = ''; $imgToUse = $ntOpt['imgToUse'];  
        $isAvailAP =  $ntOpt['appID']!='' && $ntOpt['appSec']!='';   $apMsgFormat = htmlentities($ntOpt['apTextFormat'], ENT_COMPAT, "UTF-8");             
      ?>  
      <tr><th style="text-align:left;" colspan="2">
      
      
      <?php if ($isAvailAP) { $ntOpt = nxs_FltrsV3toV4($ntOpt); if (!isset($ntOpt['do'])) $ntOpt['do'] = $ntOpt['do'.$ntU]; ?>
      <?php  if ($post->post_status != "publish" && (int)$ntOpt['do']>0 && !empty($ntOpt['fltrsOn']) && $ntOpt['fltrsOn']=='1'){ ?>
       <input type="radio" id="rbtn<?php echo $ntU.$ii; ?>" value="2" name="<?php echo $nt; ?>[<?php echo $ii; ?>][do]" checked="checked" class="nxsGrpDoChb" /> <?php } 
      else { ?>
         <input class="nxsGrpDoChb" value="1" id="do<?php echo $ntU.$ii; ?>" <?php if ($post->post_status == "publish") echo 'disabled="disabled"';?> type="checkbox" name="<?php echo $nt; ?>[<?php echo $ii; ?>][do]" <?php if ((int)$ntOpt['do'] > 0) echo 'checked="checked" title="def"';  ?> /> 
      <?php }
      if ($post->post_status == "publish") { ?> <input type="hidden" name="<?php echo $nt; ?>[<?php echo $ii; ?>][do]" value="<?php echo $ntOpt['do'];?>"> <?php } ?> 
    <?php } ?> 
      <div class="nsx_iconedTitle" style="display: inline; font-size: 13px; background-image: url(<?php echo $nxs_plurl; ?>img/ap16.png);">App.Net - <?php _e('publish to', 'social-networks-auto-poster-facebook-twitter-g') ?> (<i style="color: #005800;"><?php echo $ntOpt['nName']; ?></i>)</div></th> <td><?php //## Only show RePost button if the post is "published"
                    if ($post->post_status == "publish" && $isAvailAP) { ?>
                    
                    
                    <?php $ntName = $this->ntInfo['name']; ?>
                    <input alt="<?php echo $ii; ?>" style="float: right;" onmouseout="hidePopShAtt('SV');" onmouseover="showPopShAtt('SV', event);" onclick="return false;" data-ntname="<?php echo $ntName; ?>" type="button" class="button manualPostBtn" name="<?php echo $nt."-".$post->ID; ?>" value="<?php _e('Post to ', 'social-networks-auto-poster-facebook-twitter-g'); echo $ntName; ?>" />
                    
                    <?php  } ?>
                    
                    <?php  if (is_array($pMeta) && is_array($pMeta[$ii]) && isset($pMeta[$ii]['pgID']) ) { 
                        
                        ?> <span id="pstdAP<?php echo $ii; ?>" style="float: right;padding-top: 4px; padding-right: 10px;">
                      <a style="font-size: 10px;" href="<?php echo $pMeta[$ii]['postURL']; ?>" target="_blank"><?php $nType="App.Net"; printf( __( 'Posted on', 'social-networks-auto-poster-facebook-twitter-g' ), $nType); ?>  <?php echo (isset($pMeta[$ii]['pDate']) && $pMeta[$ii]['pDate']!='')?(" (".$pMeta[$ii]['pDate'].")"):""; ?></a>
                    </span><?php } ?>
                    
                </td></tr>                
                
                <?php if (!$isAvailAP) { ?><tr><th scope="row" style="text-align:right; width:150px; padding-top: 5px; padding-right:10px;"></th> <td><b>Setup your App.Net Account to AutoPost to App.Net</b></td></tr>
                <?php }  else { if ($post->post_status != "publish" && function_exists('nxs_doSMAS5') ) { $ntOpt['postTime'] = get_post_time('U', false, $post_id); nxs_doSMAS5($nt, $ii, $ntOpt); } ?>
                
                <?php if ($ntOpt['rpstOn']=='1') { ?> 
                
                <tr id="altFormat1" style=""><th scope="row" class="nxsTHRow">
                <input value="0"  type="hidden" name="<?php echo $nt; ?>[<?php echo $ii; ?>][rpstPostIncl]"/><input value="nxsi<?php echo $ii; ?>ap" type="checkbox" name="<?php echo $nt; ?>[<?php echo $ii; ?>][rpstPostIncl]"  <?php if (!empty($ntOpt['rpstPostIncl'])) echo "checked"; ?> /> 
                </th>
                <td> <?php _e('Include in "Auto-Reposting" to this network.', 'social-networks-auto-poster-facebook-twitter-g') ?>
                </td></tr> <?php } ?>
                
     
                <tr id="altFormat1" style=""><th scope="row" style="vertical-align:top;  padding-top: 6px; text-align:right; width:60px; padding-right:10px;"><?php _e('Text Format:', 'social-networks-auto-poster-facebook-twitter-g') ?></th><td>                
                
                <textarea cols="150" rows="1" id="ap<?php echo $ii; ?>SNAPformat" name="ap[<?php echo $ii; ?>][SNAPformat]"  style="width:60%;max-width: 610px;" onfocus="jQuery('#ap<?php echo $ii; ?>SNAPformat').attr('rows', 4); jQuery('.nxs_FRMTHint').hide();mxs_showFrmtInfo('apAPMsgFrmt<?php echo $ii; ?>');"><?php echo $apMsgFormat ?></textarea>
                
                </td></tr>
                <tr><th scope="row" style="text-align:right; width:150px; vertical-align:top; padding-top: 5px; padding-right:10px;">
                 <input value="0"  type="hidden" name="ap[<?php echo $ii; ?>][attchImg]"/>
                 <input value="1" type="checkbox" name="ap[<?php echo $ii; ?>][attchImg]"  <?php if ((int)$ntOpt['attchImg'] == 1) echo "checked"; ?> /> </th><td><strong>Attach Image to App.net Post</strong></td> </tr>      
                 <?php /* ## Select Image & URL ## */ nxs_showImgToUseDlg($nt, $ii, $imgToUse);  ?>
               
                   
                             
       <?php } 

     }
  }
  //#### Save Meta Tags to the Post
  function adjMetaOpt($optMt, $pMeta){ if (isset($pMeta['isPosted'])) $optMt['isPosted'] = $pMeta['isPosted']; else  $optMt['isPosted'] = ''; 
    if (isset($pMeta['SNAPformat'])) $optMt['apTextFormat'] = $pMeta['SNAPformat'];   
    if (isset($pMeta['imgToUse'])) $optMt['imgToUse'] = $pMeta['imgToUse'];  if (isset($pMeta['urlToUse'])) $optMt['urlToUse'] = $pMeta['urlToUse'];  
    if (isset($pMeta['timeToRun']))  $optMt['timeToRun'] = $pMeta['timeToRun'];  if (isset($pMeta['rpstPostIncl']))  $optMt['rpstPostIncl'] = $pMeta['rpstPostIncl'];    
    if (isset($pMeta['attchImg'])) $optMt['attchImg'] = $pMeta['attchImg'] == 1?1:0; else { if (isset($pMeta['attchImg'])) $optMt['attchImg'] = 0; } 
    if (isset($pMeta['do'])) $optMt['do'] = $pMeta['do']; else $optMt['do'] = 0; if (isset($pMeta['doAP'])) $optMt['doAP'] = $pMeta['doAP']; else { if (isset($pMeta['SNAPformat'])) $optMt['doAP'] = 0; } 
    if (isset($pMeta['SNAPincludeAP']) && $pMeta['SNAPincludeAP'] == '1' ) $optMt['doAP'] = 1;  
    return $optMt;
  }  
}}
if (!function_exists("nxs_rePostToAP_ajax")) {
  function nxs_rePostToAP_ajax() { check_ajax_referer('nxsSsPageWPN');  $postID = $_POST['id']; global $plgn_NS_SNAutoPoster;  if (!isset($plgn_NS_SNAutoPoster)) return; $options = $plgn_NS_SNAutoPoster->nxs_options; 
    foreach ($options['ap'] as $ii=>$two) if ($ii==$_POST['nid']) {   $two['ii'] = $ii; $two['pType'] = 'aj'; //if ($two['apPageID'].$two['apUName']==$_POST['nid']) {  
      $appo =  get_post_meta($postID, 'snapAP', true); $appo =  maybe_unserialize($appo);// prr($appo);
      if (is_array($appo) && isset($appo[$ii]) && is_array($appo[$ii])){ $ntClInst = new nxs_snapClassAP(); $two = $ntClInst->adjMetaOpt($two, $appo[$ii]); } 
      $result = nxs_doPublishToAP($postID, $two); if ($result == 200) die("Successfully sent your post to App.Net."); else die($result);        
    }    
  }
}  
if (!function_exists("nxs_doPublishToAP")) { //## Post to AP. // V3 - imgToUse - Done, class_SNAP_AP - Done, New Format - Done
  function nxs_doPublishToAP($postID, $options){ $ntCd = 'AP'; $ntCdL = 'ap'; $ntNm = 'App.Net'; if (!is_array($options)) $options = maybe_unserialize(get_post_meta($postID, $options, true));
      $addParams = nxs_makeURLParams(array('NTNAME'=>$ntNm, 'NTCODE'=>$ntCd, 'POSTID'=>$postID, 'ACCNAME'=>$options['nName']));   
      if (empty($options['imgToUse'])) $options['imgToUse'] = ''; if (empty($options['imgSize'])) $options['imgSize'] = '';
      $ii = $options['ii']; if (!isset($options['pType'])) $options['pType'] = 'im'; if ($options['pType']=='sh') sleep(rand(1, 10)); 
      $logNT = '<span style="color:#800000">App.Net</span> - '.$options['nName'];      
      $snap_ap = get_post_meta($postID, 'snap'.$ntCd, true); $snap_ap = maybe_unserialize($snap_ap);     
      if ($options['pType']!='aj' && is_array($snap_ap) && (nxs_chArrVar($snap_ap[$ii], 'isPosted', '1') || nxs_chArrVar($snap_ap[$ii], 'isPrePosted', '1'))) {
        $snap_isAutoPosted = get_post_meta($postID, 'snap_isAutoPosted', true); if ($snap_isAutoPosted!='2') {  
           nxs_addToLogN('W', 'Notice', $logNT, '-=Duplicate=- Post ID:'.$postID, 'Already posted. No reason for posting duplicate'.' |'.$uqID); return;
        }
      }       
      $message = array('message'=>'', 'link'=>'', 'imageURL'=>'', 'videoURL'=>''); 
      
      if ($postID=='0') { echo "Testing ... <br/><br/>"; $message['description'] = 'Test Post, Description';  $message['title'] = 'Test Post - Title';  $message['url'] = home_url();    
      } else { nxs_metaMarkAsPosted($postID, $ntCd, $options['ii'], array('isPrePosted'=>'1'));  $post = get_post($postID); if(!$post) return; 
        $apAttchImg = $options['attchImg']; $options['apTextFormat'] = nsFormatMessage($options['apTextFormat'], $postID, $addParams);
        $extInfo = ' | PostID: '.$postID." - ".(isset($post) && is_object($post)?$post->post_title:''); 
        if ($options['attchImg']=='1') { if (trim($options['imgToUse'])!='') $imgURL = $options['imgToUse']; else $imgURL = nxs_getPostImage($postID); 
         if (preg_match("/noImg.\.png/i", $imgURL)) $imgURL = '';  if(trim($imgURL)=='') $options['attchImg'] = 0; 
        }        
        $message = array('imageURL'=>$imgURL);
      }            
      //## Actual Post
      $ntToPost = new nxs_class_SNAP_AP(); $ret = $ntToPost->doPostToNT($options, $message);
      //## Process Results
      if (!is_array($ret) || $ret['isPosted']!='1') { //## Error 
         if ($postID=='0') prr($ret); nxs_addToLogN('E', 'Error', $logNT, '-=ERROR=- '.print_r($ret, true), $extInfo); 
      } else {  // ## All Good - log it.
        if ($postID=='0')  { nxs_addToLogN('S', 'Test', $logNT, 'OK - TEST Message Posted '); echo _e('OK - Message Posted, please see your '.$logNT.' Page. ', 'social-networks-auto-poster-facebook-twitter-g'); } 
          else  { nxs_metaMarkAsPosted($postID, $ntCd, $options['ii'], array('isPosted'=>'1', 'pgID'=>$ret['postID'], 'postURL'=>$ret['postURL'], 'pDate'=>date('Y-m-d H:i:s'))); 
          $extInfo .= ' | <a href="'.$ret['postURL'].'" target="_blank">Post Link</a>'; nxs_addToLogN('S', 'Posted', $logNT, 'OK - Message Posted ', $extInfo); }
      }
      //## Return Result
      if ($ret['isPosted']=='1') return 200; else return print_r($ret, true);      
      
  } 
}  
?>