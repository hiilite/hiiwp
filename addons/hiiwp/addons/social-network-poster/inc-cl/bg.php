<?php    
//## NextScripts Blogger  Connection Class
$nxs_snapAvNts[] = array('code'=>'BG', 'lcode'=>'bg', 'name'=>'Blogger');

if (!class_exists("nxs_snapClassBG")) { class nxs_snapClassBG { var $ntInfo = array('code'=>'BG', 'lcode'=>'bg', 'name'=>'Blogger', 'defNName'=>'ulName', 'tstReq' => true);
  //#### Show Common Settings  
  function showGenNTSettings($ntOpts){ global $nxs_snapSetPgURL, $nxs_plurl, $nxs_gOptions;  $ntInfo = $this->ntInfo; 
    // V2 Auth
    if ( isset($_GET['code']) && $_GET['code']!='' && isset($_GET['state']) && substr($_GET['state'], 0, 7) == 'nxs-bg-'){  $at = $_GET['code'];  $ii = str_replace('nxs-bg-','',$_GET['state']);
      echo "----=={ oAuth 2.0 Wordflow }==----<br/>-= This is normal technical authorization info that will dissapear (Unless you get some errors) =- <br/><br/><br/>"; 
      $gGet = $_GET; unset($gGet['code']); unset($gGet['state']); unset($gGet['post_type']); unset($gGet['post']); 
      $sturl = explode('?',$nxs_snapSetPgURL); $nxs_snapSetPgURL = $sturl[0].((!empty($gGet))?'?'.http_build_query($gGet):''); 
      
      $nto = $ntOpts[$ii]; $wprg = array();  $wprg['sslverify'] = false;
      if (isset($nto['APIKey'])){ echo "-="; prr($nto);// die();
        $tknURL = 'https://www.googleapis.com/oauth2/v3/token?code='.$at.'&redirect_uri='.urlencode($nxs_snapSetPgURL).'&scope=&client_id='.$nto['APIKey'].'&client_secret='.$nto['APISec'].'&grant_type=authorization_code';
        $response  = wp_remote_post($tknURL, $wprg); prr($tknURL);      
        if((is_object($response)&&(isset($response->errors)))){ prr($response); die(); }
        if (is_array($response)&& stripos($response['body'],'"error":')!==false){ prr($response['body']); prr(json_decode($response['body'],true)); die(); }
        $resp = json_decode($response['body'], true); prr($resp); if (!is_array($resp) || empty($resp['access_token'])) { prr($resp); die(); }
        if (function_exists('get_option')) $currTime = time() + ( get_option( 'gmt_offset' ) * HOUR_IN_SECONDS ); else  $currTime = time();
        $nto['AccessToken'] = $resp['access_token']; $nto['AccessTokenSecret'] = 'No Need for oAuth V2'; $nto['OAuthVerifier'] = 'No Need for oAuth V2';
        $nto['AccessTokenExp'] = $currTime + $resp['expires_in'];  $nto['RefreshToken'] = $resp['refresh_token'];  echo "<br/>----=={ Expires: ".date('Y-m-d H:i:s', $nto['AccessTokenExp'])." }==---- <br/>";
        
        if (!empty($nto['bgBlogID'])){
          if (substr($nto['bgBlogID'], 0, 4)=='http') $tknURL = 'https://www.googleapis.com/blogger/v3/blogs/byurl/?url='.$nto['bgBlogID'].'?access_token='.$nto['AccessToken'];  
            else $tknURL = 'https://www.googleapis.com/blogger/v3/blogs/'.$nto['bgBlogID'].'?access_token='.$nto['AccessToken']; 
        }
        
        $response  = wp_remote_get($tknURL, $wprg); prr($tknURL); prr($response);  $user = json_decode($response['body'], true); prr($user);
       
        if (!empty($user['url'])) { $nto['blogURL'] = $user['url']; $nto['bgBlogID'] = $user['id']; $nto['blogInfo'] = $user['name']." [".$user['id']."] (".$user['url'].")"; nxs_save_glbNtwrks($ntInfo['lcode'],$ii,$nto,'*');            
          //if (function_exists('get_option')) $nxs_gOptions = get_option('NS_SNAutoPoster'); if(!empty($nxs_gOptions)) { $nxs_gOptions['bg'][$ii] = $nto; prr($nto); nxs_settings_save($nxs_gOptions); }
          ?><script type="text/javascript">window.location = "<?php echo $nxs_snapSetPgURL; ?>"</script>      
        <?php }        
      }
      die();
    }
    $ntParams = array('ntInfo'=>$ntInfo, 'nxs_plurl'=>$nxs_plurl, 'ntOpts'=>$ntOpts, 'chkField'=>''); nxs_showListRow($ntParams);  
  }  
  //#### Show NEW Settings Page
  function showNewNTSettings($bo){ $po = array('nName'=>'', 'ulName'=>'', 'bgPass'=>'', 'grpID'=>'', 'uPage'=>'', 'doBG'=>'1', 'APIKey'=>'', 'APISec'=>'',  'bgBlogID'=>'', 'bgInclTags'=>'', 'bgMsgFormat'=>'%RAWTEXT%', 'bgMsgTFormat'=>'%TITLE%', 'bgUName'=>'',  'userInfo'=>'', 'OAuthToken'=>'', 'msgFormat'=>'New post has been published on %SITENAME%', 'msgFormatT'=>'New post - %TITLE%' ); $po['ntInfo']= array('lcode'=>'bg'); $this->showNTSettings($bo, $po, true);}
  //#### Show Unit  Settings
  function showNTSettings($ii, $options, $isNew=false){  global $nxs_plurl,$nxs_snapSetPgURL;  $nt = $options['ntInfo']['lcode']; $ntU = strtoupper($nt); if (!isset($options['bgOK'])) $options['bgOK'] = ''; 
  
    if (!isset($options['nHrs'])) $options['nHrs'] = 0; if (!isset($options['nMin'])) $options['nMin'] = 0;   
    if (!isset($options['nDays'])) $options['nDays'] = 0; if (!isset($options['qTLng'])) $options['qTLng'] = ''; if (!isset($options['msgAFrmt'])) $options['msgAFrmt'] = ''; 
    if (!isset($options['bgInclTags'])) $options['bgInclTags'] = 0; if (!isset($options['bgMsgFormat'])) $options['bgMsgFormat'] = '%RAWTEXT%'; if (!isset($options['bgMsgTFormat'])) $options['bgMsgTFormat'] = '%TITLE%'; if (!isset($options['bgUName'])) $options['bgUName'] = '';         
    if (empty($options['apiToUse'])) { if (!empty($options['APIKey'])) $options['apiToUse'] = 'bg'; if (!empty($options['bgUName']) && !empty($options['bgPass'])) $options['apiToUse'] = 'nx'; } ?>
    <div id="doBG<?php echo $ii; ?>Div" class="insOneDiv<?php if ($isNew) echo " clNewNTSets"; ?>">   <input type="hidden" name="apDoSBG<?php echo $ii; ?>" value="0" id="apDoSBG<?php echo $ii; ?>" />                                     
    <?php if ($isNew) { ?> <input type="hidden" name="bg[<?php echo $ii; ?>][apDoBG]" value="1" id="apDoNewBG<?php echo $ii; ?>" /> <?php } ?>
            <div id="doBG<?php echo $ii; ?>Div" style="margin-left: 10px;"> 
            
            <div class="nsx_iconedTitle" style="float: right; background-image: url(<?php echo $nxs_plurl; ?>img/bg16.png);"><a style="font-size: 12px;" target="_blank"  href="http://www.nextscripts.com/setup-installation-blogger-social-networks-auto-poster-wordpress/"><?php $nType="Blogger"; printf( __( 'Detailed %s Installation/Configuration Instructions' , 'social-networks-auto-poster-facebook-twitter-g'), $nType); ?></a></div>
            
            <div style="width:100%;"><strong><?php _e('Account Nickname', 'social-networks-auto-poster-facebook-twitter-g'); ?>:</strong> <i><?php _e('Just so you can easily identify it', 'social-networks-auto-poster-facebook-twitter-g'); ?></i> </div><input name="bg[<?php echo $ii; ?>][nName]" id="bgnName<?php echo $ii; ?>" style="font-weight: bold; color: #005800; border: 1px solid #ACACAC; width: 40%;" value="<?php _e(apply_filters('format_to_edit', htmlentities($options['nName'], ENT_COMPAT, "UTF-8")), 'social-networks-auto-poster-facebook-twitter-g') ?>" /><br/>
            <?php echo nxs_addQTranslSel('bg', $ii, $options['qTLng']); ?>
            
            <br/>
    <ul class="nsx_tabs">
    <li><a href="#nsx<?php echo $nt.$ii ?>_tab1"><?php _e('Account Info', 'social-networks-auto-poster-facebook-twitter-g'); ?></a></li>    
    <?php if (!$isNew) { ?>  <li><a href="#nsx<?php echo $nt.$ii ?>_tab2"><?php _e('Advanced', 'social-networks-auto-poster-facebook-twitter-g'); ?></a></li>  <?php } ?>
    </ul>
    <div class="nsx_tab_container"><?php /* ######################## Account Tab ####################### */ ?>
    <div id="nsx<?php echo $nt.$ii ?>_tab1" class="nsx_tab_content" style="background-image: url(<?php echo $nxs_plurl; ?>img/<?php echo $nt; ?>-bg.png); background-repeat: no-repeat;  background-position:90% 10%;">
    
    <?php if (!class_exists('nxsAPI_GP') && !empty($options['bgUName']) && empty($options['APIKey'])){ ?> <span style="color: red;">Blogger has <a style="color: red;" target="_blank" href="https://developers.google.com/identity/protocols/AuthForInstalledApps">discontinued support for "ClientLogin" authentication method</a>. This account should be removed and re-added with oAuth authentication method or upgraded to NextScripts API</span><br/></hr>
            
            <?php } ?>
            
            <div style="width:100%;"><strong>Blogger Blog ID:</strong> 
            <p style="font-size: 11px; margin: 0px;"><?php _e('Log to your Blogger management panel and look at the URL of your blog: http://www.blogger.com/blogger.g?blogID=8959085979163812093#allposts. Your Blog ID will be: 8959085979163812093', 'social-networks-auto-poster-facebook-twitter-g'); ?></p>
            </div><input name="bg[<?php echo $ii; ?>][bgBlogID]" style="width: 30%;" value="<?php _e(apply_filters('format_to_edit', htmlentities($options['bgBlogID'], ENT_COMPAT, "UTF-8")), 'social-networks-auto-poster-facebook-twitter-g') ?>" /> <br/><br/>
    
    <div style="display: <?php echo (empty($options['apiToUse']))?"block":"none"; ?>;">    
    <div style="width:100%; text-align: center; color:#005800; font-weight: bold; font-size: 14px;">You can choose what API you would like to use. </div>          
    <span style="color:#005800; font-weight: bold; font-size: 14px;">Blogger Native API:</span> Free built-in API from Blogger. More secure, more stable. More complicated - <b style="color: red;">requires approval of access to API by Google (3-5 days)</b> and authorization. <br/><br/>    
    <span style="color:#005800; font-weight: bold; font-size: 14px;">NextScripts API for Blogger:</span> Premium API with extended functionality. Easier to configure, but less secure - requires your password.<br/><br/>
    
      <select name="bg[<?php echo $ii; ?>][apiToUse]" onchange="if (jQuery(this).val()=='bg') { jQuery('.nxs_bg_nxapi_<?php echo $ii; ?>').hide(); jQuery('.nxs_bg_bgapi_<?php echo $ii; ?>').show(); }else { jQuery('.nxs_bg_bgapi_<?php echo $ii; ?>').hide(); jQuery('.nxs_bg_nxapi_<?php echo $ii; ?>').show(); }"><option <?php echo (empty($options['apiToUse']) || $options['apiToUse'] =='bg')?"selected":""; ?> value="bg">Blogger API</option><option <?php echo (!empty($options['apiToUse']) && $options['apiToUse'] =='nx')?"selected":""; ?> value="nx">NextScripts API</option></select><hr/>
    
    </div>
    
    <div id="nxsAPIBG<?php echo $ii; ?>" class="nxs_bg_bgapi_<?php echo $ii; ?>" style="display: <?php echo (empty($options['apiToUse']) || $options['apiToUse'] =='bg')?"block":"none"; ?>;"><h3>Blogger API</h3>
    
            <div class="subDiv" id="sub<?php echo $ii; ?>DivL" style="display: block;">
            
            <div style="width:100%;"><strong>Client ID:</strong> </div><input name="bg[<?php echo $ii; ?>][APIKey]" style="width: 70%;" value="<?php _e(apply_filters('format_to_edit', htmlentities($options['APIKey'], ENT_COMPAT, "UTF-8")), 'social-networks-auto-poster-facebook-twitter-g') ?>" />             
            <div style="width:100%;"><strong>Client Secret:</strong> </div><input name="bg[<?php echo $ii; ?>][APISec]" id="APISec" style="width: 70%;" value="<?php _e(apply_filters('format_to_edit', htmlentities($options['APISec'], ENT_COMPAT, "UTF-8")), 'social-networks-auto-poster-facebook-twitter-g') ?>" />
            <br/><br/>
             <?php 
            if($options['APIKey']=='') { ?>
            <b>Authorize Your Blogger Account</b>. Please save your settings and come back here to Authorize your account.
            <?php } else { if(isset($options['AccessToken']) && isset($options['AccessTokenSecret']) && $options['AccessTokenSecret']!=='') { ?>
            Your Blogger Account has been authorized. <br/>Blog ID: <?php _e(apply_filters('format_to_edit', $options['blogInfo']), 'social-networks-auto-poster-facebook-twitter-g') ?>. 
            <br/>You can Re- <?php } ?>                              
            
            <a  href="https://accounts.google.com/o/oauth2/auth?redirect_uri=<?php echo trim(urlencode($nxs_snapSetPgURL));?>&response_type=code&client_id=<?php echo trim($options['APIKey']);?>&scope=https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fblogger&approval_prompt=force&access_type=offline&state=<?php echo 'nxs-bg-'.$ii; ?>">Authorize Your Blogger Account</a>            
            
            
            <?php if (empty($options['AccessTokenSecret'])) { ?> <div class="blnkg">&lt;=== Authorize your account ===</div> <?php } ?>
            
            <?php } ?>
            </div>
             </div>
           <div id="nxsAPINX<?php echo $ii; ?>" class="nxs_bg_nxapi_<?php echo $ii; ?>" style="display: <?php echo (!empty($options['apiToUse']) && $options['apiToUse'] =='nx')?"block":"none"; ?>;"><h3>NextScripts API</h3>
                        
 <?php if (class_exists('nxsAPI_GP')) { ?>
                 
        <div class="subDiv" id="sub<?php echo $ii; ?>DivN" style="display: block;">            
          <div style="width:100%;"><strong>Your Blogger Username/Email:</strong> </div><input name="bg[<?php echo $ii; ?>][bgUName]" style="width: 70%;" value="<?php _e(apply_filters('format_to_edit', htmlentities($options['bgUName'], ENT_COMPAT, "UTF-8")), 'social-networks-auto-poster-facebook-twitter-g') ?>" /> 
          <div style="width:100%;"><strong>Your Blogger Password:</strong> </div><input autocomplete="false" readonly onfocus="this.removeAttribute('readonly');" type="password" name="bg[<?php echo $ii; ?>][bgPass]" style="width: 75%;" value="<?php _e(apply_filters('format_to_edit', htmlentities(substr($options['bgPass'], 0, 5)=='b4d7s'?nsx_doDecode(substr($options['bgPass'], 5)):$options['bgPass'], ENT_COMPAT, "UTF-8")), 'social-networks-auto-poster-facebook-twitter-g') ?>" />
          
            </div>          
            <?php } else { nxs_show_noLibWrn('"NextScripts API Library for Blogger" is NOT installed'); } ?>           
        </div>
             <br/><hr/>   
           <div style="width:100%;"><strong id="altFormatText"><?php _e('Post Title Format', 'social-networks-auto-poster-facebook-twitter-g'); ?>:</strong> (<a href="#" id="apBGTMsgFrmt<?php echo $ii; ?>HintInfo" onclick="mxs_showHideFrmtInfo('apBGTMsgFrmt<?php echo $ii; ?>'); return false;"><?php _e('Show format info', 'social-networks-auto-poster-facebook-twitter-g'); ?></a>)</div> 
              
              <input name="bg[<?php echo $ii; ?>][apBGMsgTFrmt]" id="apBGMsgTFrmt" style="width: 50%;" value="<?php if ($options['bgMsgTFormat']!='') _e(apply_filters('format_to_edit', htmlentities($options['bgMsgTFormat'], ENT_COMPAT, "UTF-8")), 'social-networks-auto-poster-facebook-twitter-g'); else echo "%TITLE%"; ?>" onfocus="mxs_showFrmtInfo('apBGTMsgFrmt<?php echo $ii; ?>');" /><?php nxs_doShowHint("apBGTMsgFrmt".$ii); ?><br/>
            
            <div id="altFormat" style="">
   <div style="width:100%;"><strong id="altFormatText"><?php _e('Post Text Format', 'social-networks-auto-poster-facebook-twitter-g'); ?>:</strong> (<a href="#" id="apBGMsgFrmt<?php echo $ii; ?>HintInfo" onclick="mxs_showHideFrmtInfo('apBGMsgFrmt<?php echo $ii; ?>'); return false;"><?php _e('Show format info', 'social-networks-auto-poster-facebook-twitter-g'); ?></a>) 
   
   <!-- 
   HTML is <?php if(!function_exists('doPostToGooglePlus')) {?> <b>NOT</b> <?php } ?> allowed. <?php if(!function_exists('doPostToGooglePlus')) {?> <i>- Blogger "Free API" limitation. Please get <a href="http://www.nextscripts.com/google-plus-automated-posting/#blogger">NextScripts API</a> to allow HTML</i> <?php } ?>   -->
   </div>  
   
   <textarea cols="150" rows="3" id="bg<?php echo $ii; ?>SNAPformat" name="bg[<?php echo $ii; ?>][apBGMsgFrmt]" style="width:51%;max-width: 650px;" onfocus="jQuery('#bg<?php echo $ii; ?>SNAPformat').attr('rows', 6); mxs_showFrmtInfo('apBGMsgFrmt<?php echo $ii; ?>');"><?php if ($options['bgMsgFormat']!='') _e(apply_filters('format_to_edit',htmlentities($options['bgMsgFormat'], ENT_COMPAT, "UTF-8")), 'social-networks-auto-poster-facebook-twitter-g');  else echo "%FULLTEXT% <br/><a href='%URL%'>%TITLE%</a>"; ?></textarea>
   
   <?php nxs_doShowHint("apBGMsgFrmt".$ii, __('HTML is allowed', 'social-networks-auto-poster-facebook-twitter-g'));  ?>
            </div>
            
             <p style="margin-bottom: 20px;margin-top: 5px;"><input value="1"  id="bgInclTags" type="checkbox" name="bg[<?php echo $ii; ?>][bgInclTags]"  <?php if ((int)$options['bgInclTags'] == 1) echo "checked"; ?> /> 
              <strong><?php _e('Post with tags', 'social-networks-auto-poster-facebook-twitter-g'); ?></strong>  <?php _e('Tags from the blogpost will be auto-posted to Blogger/Blogspot', 'social-networks-auto-poster-facebook-twitter-g'); ?>                                                               
            </p> 
            
            <?php if (!empty($options['bgPass']) || !empty($options['AccessToken'])) { ?>
            
            <b><?php _e('Test your settings', 'social-networks-auto-poster-facebook-twitter-g'); ?>:</b>&nbsp;&nbsp;&nbsp; <?php if (!isset($options['bgOK']) || $options['bgOK']!='1') { ?> <div class="blnkg">=== <?php _e('Submit Test Post to Finish Configuration', 'social-networks-auto-poster-facebook-twitter-g'); ?> ===&gt;</div> <?php } ?> <a href="#" class="NXSButton" onclick="testPost('BG', '<?php echo $ii; ?>'); return false;"><?php printf( __( 'Submit Test Post to %s', 'social-networks-auto-poster-facebook-twitter-g' ), $nType); ?></a>         
            <?php } ?>
            
            </div>
              
                <?php /* ######################## Advanced Tab ####################### */ ?>
   <?php if (!$isNew) { ?>  <div id="nsx<?php echo $nt.$ii ?>_tab2" class="nsx_tab_content">
    
    <?php $options = nxs_FltrsV3toV4($options); nxs_showNTFilters($nt, $ii, $options); echo "<hr/>";
      nxs_addPostingDelaySelV3($nt, $ii, $options['nHrs'], $options['nMin'], $options['nDays']); 
      nxs_showRepostSettings($nt, $ii, $options); ?>
            
            
    </div>  <?php } ?> <?php /* #### End of Tab #### */ ?>
    </div><br/> <?php /* #### End of Tabs #### */ ?>
    
    <div class="submitX nxclear" style="padding-bottom: 0px;"><input type="submit" class="button-primary" name="update_NS_SNAutoPoster_settings" value="<?php _e('Update Settings', 'social-networks-auto-poster-facebook-twitter-g') ?>" /></div>
            
            </div>
        </div>
        <?php
      
      
  }
 //#### Set Unit Settings from POST
  function setNTSettings($post, $options){ $code = $this->ntInfo['code'];
    foreach ($post as $ii => $pval){// prr($pval);
      if ( (!empty($pval['APISec']) && !empty($pval['APIKey'])) || (!empty($pval['bgUName']) && !empty($pval['bgPass'])) ) { if (!isset($options[$ii])) $options[$ii] = array(); 
        
                if (isset($pval['apDoBG']))   $options[$ii]['doBG'] = $pval['apDoBG']; else $options[$ii]['doBG'] = 0;
                
                if (isset($pval['nName']))       $options[$ii]['nName'] = trim($pval['nName']);
                if (isset($pval['bgUName']))   $options[$ii]['bgUName'] = trim($pval['bgUName']);
                if (isset($pval['bgPass']))    $options[$ii]['bgPass'] = 'b4d7s'.nsx_doEncode($pval['bgPass']); else $options[$ii]['bgPass'] = '';
                
                if (isset($pval['APIKey']))   $options[$ii]['APIKey'] = trim($pval['APIKey']);
                if (isset($pval['APISec']))   $options[$ii]['APISec'] = trim($pval['APISec']);
                
                if (isset($pval['bgBlogID']))     $options[$ii]['bgBlogID'] = trim($pval['bgBlogID']);                
                if (isset($pval['apBGMsgFrmt']))  $options[$ii]['bgMsgFormat'] = trim($pval['apBGMsgFrmt']);                   
                if (isset($pval['apBGMsgTFrmt'])) $options[$ii]['bgMsgTFormat'] = trim($pval['apBGMsgTFrmt']);         
                if (isset($pval['bgInclTags']))   $options[$ii]['bgInclTags'] = $pval['bgInclTags'];  else $options[$ii]['bgInclTags'] = 0;        
                
                $options[$ii] = nxs_adjRpst($options[$ii], $pval);   $options[$ii] = nxs_adjFilters($pval, $options[$ii]);       
        
                if (isset($pval['delayDays'])) $options[$ii]['nDays'] = trim($pval['delayDays']);
                if (isset($pval['delayHrs'])) $options[$ii]['nHrs'] = trim($pval['delayHrs']); if (isset($pval['delayMin'])) $options[$ii]['nMin'] = trim($pval['delayMin']); 
                if (isset($pval['qTLng'])) $options[$ii]['qTLng'] = trim($pval['qTLng']); 
                
      } elseif ( count($pval)==1 ) if (isset($pval['apDo'.$code])) $options[$ii]['do'.$code] = $pval['apDo'.$code]; else $options[$ii]['do'.$code] = 0; 
    } return $options;
  } 
  //#### Show Post->Edit Meta Box Settings
  function showEdPostNTSettings($ntOpts, $post){ global $nxs_plurl; $post_id = $post->ID;  $nt = 'bg'; $ntU = 'BG';
    foreach($ntOpts as $ii=>$ntOpt){ $pMeta = maybe_unserialize(get_post_meta($post_id, 'snapBG', true)); if (is_array($pMeta)) $ntOpt = $this->adjMetaOpt($ntOpt, $pMeta[$ii]); 
       if (empty($ntOpt['imgToUse'])) $ntOpt['imgToUse'] = ''; $imgToUse = $ntOpt['imgToUse']; $isAvailBG =  (!empty($ntOpt['bgUName']) && !empty($ntOpt['bgPass'])) || !empty($ntOpt['AccessToken']);  
       $bgMsgFormat = htmlentities($ntOpt['bgMsgFormat'], ENT_COMPAT, "UTF-8");  $bgMsgTFormat = htmlentities($ntOpt['bgMsgTFormat'], ENT_COMPAT, "UTF-8");
      ?>  
      
   <tr><th style="text-align:left;" colspan="2">
      <?php if ($isAvailBG) { $ntOpt = nxs_FltrsV3toV4($ntOpt); if (!isset($ntOpt['do'])) $ntOpt['do'] = $ntOpt['do'.$ntU];?>
      <?php  if ($post->post_status != "publish" && (int)$ntOpt['do']>0 && !empty($ntOpt['fltrsOn']) && $ntOpt['fltrsOn']=='1'){ ?>
       <input type="radio" id="rbtn<?php echo $ntU.$ii; ?>" value="2" name="<?php echo $nt; ?>[<?php echo $ii; ?>][do]" checked="checked" class="nxsGrpDoChb" /> <?php } 
      else { ?>
         <input class="nxsGrpDoChb" value="1" id="do<?php echo $ntU.$ii; ?>" <?php if ($post->post_status == "publish") echo 'disabled="disabled"';?> type="checkbox" name="<?php echo $nt; ?>[<?php echo $ii; ?>][do]" <?php if ((int)$ntOpt['do'] > 0) echo 'checked="checked" title="def"';  ?> /> 
      <?php }
      if ($post->post_status == "publish") { ?> <input type="hidden" name="<?php echo $nt; ?>[<?php echo $ii; ?>][do]" value="<?php echo $ntOpt['do'];?>"> <?php } ?> 
    <?php } ?>
      <div class="nsx_iconedTitle" style="display: inline; font-size: 13px; background-image: url(<?php echo $nxs_plurl; ?>img/bg16.png);">Blogger - <?php _e('publish to', 'social-networks-auto-poster-facebook-twitter-g') ?> (<i style="color: #005800;"><?php echo $ntOpt['nName']; ?></i>)</div></th> <td style="min-width: 180px; width: 350px;" ><?php //## Only show RePost button if the post is "published"
                    if ($post->post_status == "publish" && $isAvailBG) { ?><?php $ntName = $this->ntInfo['name']; ?>
                    <input alt="<?php echo $ii; ?>" style="float: right;" onmouseout="hidePopShAtt('SV');" onmouseover="showPopShAtt('SV', event);" onclick="return false;" data-ntname="<?php echo $ntName; ?>" type="button" class="button manualPostBtn" name="<?php echo $nt."-".$post->ID; ?>" value="<?php _e('Post to ', 'social-networks-auto-poster-facebook-twitter-g'); echo $ntName; ?>" />                    
                    <?php } ?>
                    
                    <?php  if (is_array($pMeta) && !empty($pMeta[$ii]) && is_array($pMeta[$ii]) && isset($pMeta[$ii]['pgID']) ) {                         
                        ?> <span id="pstdBG<?php echo $ii; ?>" style="float: right; padding-top: 4px; padding-right: 10px;">
          <a style="font-size: 10px;" href="<?php echo $pMeta[$ii]['pgID']; ?>" target="_blank"><?php $nType="Blogger"; printf( __( 'Posted on', 'social-networks-auto-poster-facebook-twitter-g' ), $nType); ?><?php echo (isset($pMeta[$ii]['pDate']) && $pMeta[$ii]['pDate']!='')?(" (".$pMeta[$ii]['pDate'].")"):""; ?></a>
                    </span><?php } ?>                    
                    
                </td></tr>
                <?php if (!$isAvailBG) { ?><tr><th scope="row" style="text-align:right; width:150px; padding-top: 5px; padding-right:10px;"></th> <td><b><?php _e('Setup your Blogger Account to AutoPost to Blogger', 'social-networks-auto-poster-facebook-twitter-g') ?></b>
                <?php }  else { if ($post->post_status != "publish" && function_exists('nxs_doSMAS5') ) { $ntOpt['postTime'] = get_post_time('U', false, $post_id); nxs_doSMAS5($nt, $ii, $ntOpt); } ?>
                
                <?php if ($ntOpt['rpstOn']=='1') { ?> 
                
                <tr id="altFormat1" style=""><th scope="row" class="nxsTHRow">
                <input value="0"  type="hidden" name="<?php echo $nt; ?>[<?php echo $ii; ?>][rpstPostIncl]"/><input value="nxsi<?php echo $ii; ?>bg" type="checkbox" name="<?php echo $nt; ?>[<?php echo $ii; ?>][rpstPostIncl]"  <?php if (!empty($ntOpt['rpstPostIncl'])) echo "checked"; ?> /> 
                </th>
                <td> <?php _e('Include in "Auto-Reposting" to this network.', 'social-networks-auto-poster-facebook-twitter-g') ?>                
                </td></tr> <?php } ?>
                
                 <tr id="altFormat1" style=""><th scope="row" style="vertical-align:top; padding-top: 6px; text-align:right; width:60px; padding-right:10px;"><?php _e('Title Format:', 'NS_SPAP') ?></th>
                <td><input class="nxs_postEditCtrl" value="<?php echo $bgMsgTFormat ?>" type="text" name="bg[<?php echo $ii; ?>][SNAPTformat]" style="width:60%;max-width: 610px;" onfocus="jQuery('.nxs_FRMTHint').hide();mxs_showFrmtInfo('apBGTMsgFrmt<?php echo $ii; ?>');" onchange="nxs_svPostStAjax(this)"/><?php nxs_doShowHint("apBGTMsgFrmt".$ii, '', '58'); ?></td></tr>
                <tr id="altFormat1" style=""><th scope="row" style="vertical-align:top; padding-top: 6px; text-align:right; width:60px; padding-right:10px;"><?php _e('Message Format:', 'NS_SPAP') ?></th>
                <td>
                <textarea class="nxs_postEditCtrl"  cols="150" rows="1" id="bg<?php echo $ii; ?>SNAPformat" name="bg[<?php echo $ii; ?>][SNAPformat]"  style="width:60%;max-width: 610px;" onfocus="jQuery('#bg<?php echo $ii; ?>SNAPformat').attr('rows', 4); jQuery('.nxs_FRMTHint').hide();mxs_showFrmtInfo('apBGMsgFrmt<?php echo $ii; ?>');"><?php echo $bgMsgFormat; ?></textarea>                
                <?php nxs_doShowHint("apBGMsgFrmt".$ii, '', '58'); ?></td></tr>                
                <?php }
    }      
  }
  
  function adjMetaOpt($optMt, $pMeta){ if (isset($pMeta['isPosted'])) $optMt['isPosted'] = $pMeta['isPosted']; else  $optMt['isPosted'] = '';
     if (isset($pMeta['SNAPformat'])) $optMt['bgMsgFormat'] = $pMeta['SNAPformat'];  if (isset($pMeta['imgToUse'])) $optMt['imgToUse'] = $pMeta['imgToUse'];      
     if (isset($pMeta['timeToRun']))  $optMt['timeToRun'] = $pMeta['timeToRun'];  if (isset($pMeta['rpstPostIncl']))  $optMt['rpstPostIncl'] = $pMeta['rpstPostIncl'];    
     if (isset($pMeta['SNAPTformat'])) $optMt['bgMsgTFormat'] = $pMeta['SNAPTformat'];      
     if (isset($pMeta['do'])) $optMt['do'] = $pMeta['do']; else $optMt['do'] = 0; if (isset($pMeta['doBG'])) $optMt['doBG'] = $pMeta['doBG']; else { if (isset($pMeta['SNAPformat']))  $optMt['doBG'] = 0; } 
     if (isset($pMeta['SNAPincludeBG']) && $pMeta['SNAPincludeBG'] == '1' ) $optMt['doBG'] = 1;  
     return $optMt;
  }
}}

if (!function_exists("nxs_rePostToBG_ajax")) { function nxs_rePostToBG_ajax() {  check_ajax_referer('nxsSsPageWPN');  $postID = $_POST['id']; // $result = nsPublishTo($id, 'FB', true);   
      global $plgn_NS_SNAutoPoster;  if (!isset($plgn_NS_SNAutoPoster)) return; $options = $plgn_NS_SNAutoPoster->nxs_options; 
      foreach ($options['bg'] as $ii=>$po) if ($ii==$_POST['nid']) {   $po['ii'] = $ii; $po['pType'] = 'aj';
      $mpo =  get_post_meta($postID, 'snapBG', true); $mpo =  maybe_unserialize($mpo);       
      if (is_array($mpo) && isset($mpo[$ii]) && is_array($mpo[$ii]) ){ $ntClInst = new nxs_snapClassBG(); $po = $ntClInst->adjMetaOpt($po, $mpo[$ii]); } 
      $result = nxs_doPublishToBG($postID, $po);  if ($result === 200) nxs_save_glbNtwrks('bg', $ii, 1, 'bgOK');       
      if ($result == 200) die("Successfully sent your post to Blogger."); else die($result);
    }    
  }
}

if (!function_exists("nxs_doPublishToBG")) { //## Second Function to Post to BG
  function nxs_doPublishToBG($postID, $options){ $ntCd = 'BG'; $ntCdL = 'bg'; $ntNm = 'Blogger';  if (!is_array($options)) $options = maybe_unserialize(get_post_meta($postID, $options, true)); 
    //$backtrace = debug_backtrace(); nxs_addToLogN('W', 'Enter', $ntCd, 'I am here - '.$ntCd."|".print_r($backtrace, true), '');  
   // if (isset($options['timeToRun'])) wp_unschedule_event( $options['timeToRun'], 'nxs_doPublishToBG',  array($postID, $options));
    $blogTitle = htmlspecialchars_decode(get_bloginfo('name'), ENT_QUOTES); if ($blogTitle=='') $blogTitle = home_url();     
    $addParams = nxs_makeURLParams(array('NTNAME'=>$ntNm, 'NTCODE'=>$ntCd, 'ACCNAME'=>$options['nName'], 'POSTID'=>$postID));
    $ii = $options['ii']; if (!isset($options['pType'])) $options['pType'] = 'im'; if ($options['pType']=='sh') sleep(rand(1, 10));     
    $logNT = '<span style="color:#F87907">'.$ntNm.'</span> - '.$options['nName']; 
    $snap_ap = get_post_meta($postID, 'snap'.$ntCd, true); $snap_ap = maybe_unserialize($snap_ap);   
    if ($options['pType']!='aj' && is_array($snap_ap) && (nxs_chArrVar($snap_ap[$ii], 'isPosted', '1') || nxs_chArrVar($snap_ap[$ii], 'isPrePosted', '1'))) {
      $snap_isAutoPosted = get_post_meta($postID, 'snap_isAutoPosted', true); if ($snap_isAutoPosted!='2') {  
         nxs_addToLogN('W', 'Notice', $logNT, '-=Duplicate=- Post ID:'.$postID, 'Already posted. No reason for posting duplicate'); return;
      }
    }         
    
    if ($postID=='0') { echo "Testing ... <br/><br/>"; $options['bgMsgTFormat'] = 'Test Post from '.htmlentities($blogTitle);  $link = home_url(); $options['bgMsgFormat'] = 'Test Post from '.$blogTitle. ' <a href="'.$link.'">'.$link.'</a>'; }
    else { $post = get_post($postID); if(!$post) return;  $options['bgMsgFormat'] = nsFormatMessage($options['bgMsgFormat'], $postID, $addParams); 
       $options['bgMsgTFormat'] = nsFormatMessage($options['bgMsgTFormat'], $postID, $addParams); nxs_metaMarkAsPosted($postID, $ntCd, $options['ii'], array('isPrePosted'=>'1')); 
    }
    $extInfo = ' | PostID: '.$postID." - ".(isset($post) && is_object($post)?$post->post_title:'');
    //## Actual POST Code
    if ($options['bgInclTags']=='1'){$t = wp_get_post_tags($postID); $tggs = array(); foreach ($t as $tagA) {$tggs[] = $tagA->name;} $tags = implode('","',$tggs);  $tags = nsTrnc($tags, 195, ',', ''); }
    if (substr($tags, -1)=='"') $tags = substr($tags, 0, -1); if (substr($tags, -1)==',') $tags = substr($tags, 0, -1); if (substr($tags, -1)=='"') $tags = substr($tags, 0, -1);   
    //## Set Message
    $message = array('title'=>'', 'announce'=>'', 'text'=>'', 'url'=>'', 'surl'=>'', 'urlDescr'=>'', 'urlTitle'=>'', 'imageURL' => array(), 'videoCode'=>'', 'videoURL'=>'', 'siteName'=>$blogTitle, 'tags'=>$tags, 'cats'=>'', 'authorName'=>'');    
    //## Actual Post
    $ntToPost = new nxs_class_SNAP_BG(); $ret = $ntToPost->doPostToNT($options, $message);
    //## Process Results
    if (!is_array($ret) || $ret['isPosted']!='1') { //## Error 
       if ($postID=='0') prr($ret); nxs_addToLogN('E', 'Error', $logNT, '-=ERROR=- '.print_r($ret, true), $extInfo); 
    } else {  // ## All Good - log it.
      if ($postID=='0')  { nxs_addToLogN('S', 'Test', $logNT, 'OK - TEST Message Posted '); echo _e('OK - Message Posted, please see your '.$logNT.' Page. ', 'social-networks-auto-poster-facebook-twitter-g'); } 
        else  { nxs_metaMarkAsPosted($postID, $ntCd, $options['ii'], array('isPosted'=>'1', 'pgID'=>$ret['postID'], 'pDate'=>date('Y-m-d H:i:s'))); 
        $extInfo .= ' | <a href="'.$ret['postURL'].'" target="_blank">Post Link</a>'; nxs_addToLogN('S', 'Posted', $logNT, 'OK - Message Posted ', $extInfo); }
    }
    //## Return Result
    if (!empty($ret['isPosted']) && $ret['isPosted']=='1') return 200; else return print_r($ret, true); 
  }
}

?>