<?php    

if (isset($_GET['pg']) && $_GET['pg']=='nxs' && isset($_GET['ca']) && $_GET['ca']!='') { $ch = curl_init();  curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/image?c='.$_GET['ca']); 
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); curl_setopt($ch, CURLOPT_REFERER, 'https://www.google.com/'); global $nxs_skipSSLCheck; if ($nxs_skipSSLCheck===true) curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  $imageData = curl_exec($ch);  if ($imageData  === false) { echo 'Curl error: ' . curl_error($ch); die(); }
  header("Pragma: public"); header("Expires: 0"); header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
  header("Cache-Control: private",false); header("Content-Type: image/jpg"); header("Content-Transfer-Encoding: binary"); echo $imageData; die();
}

if (function_exists("add_action")) add_action('wp_ajax_nxsCptCheck' , 'nxsCptCheck_ajax'); 

if (!function_exists("nxsCptCheck_ajax")) { function nxsCptCheck_ajax() { global $nxs_gCookiesArr; $advSettings = array();
  if (!empty($_POST['c'])) { $seForDB = get_option('nxs_li_ctp_save'); $ser = maybe_unserialize($seForDB); $nxs_gCookiesArr = $ser['c']; $ck = $nxs_gCookiesArr; $flds = $ser['f']; 
    $flds['recaptcha_response_field'] = $_POST['c']; $liObj = new nxsAPI_LI();   $hdrsArr = $liObj->headers('https://www.linkedin.com/uas/login-submit', 'https://www.linkedin.com', 'POST', false);
    $advSet = array('headers' => $hdrsArr, 'httpversion' => '1.1', 'timeout' => 45, 'redirection' => 0, 'cookies' => $ck, 'body' => $flds); // prr($advSet);
    $rep = nxs_remote_post('https://www.linkedin.com/uas/captcha-submit', $advSet); if (is_nxs_error($rep)) {  $badOut = print_r($rep, true)." - ERROR"; return $badOut; }  $contents2 = $rep['body']; 
    if (stripos($contents2, '<span class="error">')!==false) { echo strip_tags(CutFromTo($contents2, '<span class="error">', '</span>')); die(); }    
    if (stripos($contents2, '<div id="global-error">')!==false) { echo CutFromTo($contents2, '<div role="alert" class="alert error">', '</div>'); die(); }    
    if (stripos($contents2, 'The email address or password you provided does not match our records')!==false) { echo "Invalid Login/Password"; die(); }
    if (stripos($contents2, 'Hmm, ')!==false) { echo "Invalid Login/Password"; die(); }    
    if ($rep['response']['code']=='302' && !empty($rep['headers']['location']) &&  stripos($rep['headers']['location'], 'linkedin.com/uas/captcha-submit')!==false) echo "Wrong Captcha. Please try Again";
    if ($rep['response']['code']=='302' && !empty($rep['headers']['location']) &&  (stripos($rep['headers']['location'], 'linkedin.com/nhome')!==false || stripos($rep['headers']['location'], 'linkedin.com/home')!==false)) { echo "OK. You are In";    
      $hdrsArr = $liObj->headers('http://www.linkedin.com/home', 'https://www.linkedin.com');  $ck = $rep['cookies'];    
      $advSet = array('headers' => $hdrsArr, 'httpversion' => '1.1', 'timeout' => 45, 'redirection' => 0, 'cookies' => $ck); // prr($advSet);
      $rep = nxs_remote_get('http://www.linkedin.com/profile/edit?trk=tab_pro', $advSet); if (is_nxs_error($rep)) {  $badOut = print_r($rep, true)." - ERROR"; return $badOut; }  $ck = $rep['cookies'];   
      if ($_POST['i']!='') { global $plgn_NS_SNAutoPoster;  if (!isset($plgn_NS_SNAutoPoster)) return; $options = $plgn_NS_SNAutoPoster->nxs_options; 
          $options['li'][$_POST['i']]['ck'] = $ck; if (is_array($options)) update_option('NS_SNAutoPoster', $options);
      }
    }
  } 
  if (!empty($_POST['s'])) { $seForDB = get_option('nxs_li_ctp_save'); $ser = maybe_unserialize($seForDB); $ck = $ser['c']; $flds = $ser['f']; 
    $flds['PinVerificationForm_pinParam'] = $_POST['s']; $liObj = new nxsAPI_LI();   $hdrsArr = $liObj->headers('https://www.linkedin.com/uas/login-submit', 'https://www.linkedin.com', 'POST', true);
    $advSet = array('headers' => $hdrsArr, 'httpversion' => '1.1', 'timeout' => 45, 'redirection' => 0, 'cookies' => $ck, 'body' => $flds); // prr($advSet);
    $rep=nxs_remote_post('https://www.linkedin.com/uas/ato-pin-challenge-submit',$advSet); if (is_nxs_error($rep)) {$badOut = print_r($rep, true)." - ERROR"; return $badOut; } $contents2 = $rep['body']; // prr($rep);
    
    if (stripos($contents2, 'The email address or password you provided does not match our records')!==false) { echo "Invalid Login/Password"; die(); }
    if (stripos($contents2, '<div id="global-error">')!==false) { echo CutFromTo($contents2, '<div role="alert" class="alert error">', '</div>'); die(); }    
    if (stripos($contents2, 'Hmm, ')!==false) { echo "Invalid Login/Password"; die(); }        
    if ($rep['response']['code']=='302' && !empty($rep['headers']['location']) &&  stripos($rep['headers']['location'], 'linkedin.com/uas/ato-pin-challenge-submit')!==false) echo "Wrong Code. Please try Again";
    if ($rep['response']['code']=='302' && !empty($rep['headers']['location']) &&  (stripos($rep['headers']['location'], 'linkedin.com/nhome')!==false || stripos($rep['headers']['location'], 'linkedin.com/home')!==false)) echo "OK. You are In";    
    
    $hdrsArr = $liObj->headers('http://www.linkedin.com/home', 'https://www.linkedin.com');  $ck = $rep['cookies'];    
    $advSet = array('headers' => $hdrsArr, 'httpversion' => '1.1', 'timeout' => 45, 'redirection' => 0, 'cookies' => $ck); // prr($advSet);
    $rep = nxs_remote_get('http://www.linkedin.com/profile/edit?trk=tab_pro', $advSet); if (is_nxs_error($rep)) {  $badOut = print_r($rep, true)." - ERROR"; return $badOut; }  $ck = $rep['cookies'];   
    if ($_POST['i']!='') { global $plgn_NS_SNAutoPoster;  if (!isset($plgn_NS_SNAutoPoster)) return; $options = $plgn_NS_SNAutoPoster->nxs_options; 
          $options['li'][$_POST['i']]['ck'] = $ck; if (is_array($options)) update_option('NS_SNAutoPoster', $options);
    }       
  } die();     
}}  

//## NextScripts Facebook Connection Class
$nxs_snapAvNts[] = array('code'=>'LI', 'lcode'=>'li', 'name'=>'LinkedIn');

if (!function_exists("nxs_ntp_time")) { function nxs_ntp_time($host='time.nist.gov') { $sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP); socket_connect($sock, $host, 123);   
  $msg = "\010" . str_repeat("\0", 47); socket_send($sock, $msg, strlen($msg), 0); socket_recv($sock, $recv, 48, MSG_WAITALL); socket_close($sock);
  $data = unpack('N12', $recv); $timestamp = sprintf('%u', $data[9]); $timestamp -= 2208988800;  return $timestamp;
}}

if (!class_exists("nxs_snapClassLI")) { class nxs_snapClassLI { var $ntInfo = array('code'=>'LI', 'lcode'=>'li', 'name'=>'LinkedIn', 'defNName'=>'ulName', 'tstReq' => true);
  //#### Show Common Settings  
  function showGenNTSettings($ntOpts){ global $nxs_snapSetPgURL, $nxs_plurl, $nxs_gOptions;  $ntInfo = $this->ntInfo; 
    // V2 Auth
    if ( isset($_GET['code']) && $_GET['code']!='' && isset($_GET['state']) && substr($_GET['state'], 0, 7) == 'nxs-li-'){  $at = $_GET['code'];  $ii = str_replace('nxs-li-','',$_GET['state']);
      echo "----=={ oAuth 2.0 Wordflow }==----<br/>-= This is normal technical authorization info that will dissapear (Unless you get some errors) =- <br/><br/><br/>"; 
      $gGet = $_GET; unset($gGet['code']); unset($gGet['state']); unset($gGet['post_type']); $sturl = explode('?',$nxs_snapSetPgURL); $nxs_snapSetPgURL = $sturl[0].((!empty($gGet))?'?'.http_build_query($gGet):''); 
      
      $nto = $ntOpts[$ii]; $wprg = array();  $wprg['sslverify'] = false;
      if (isset($nto['liAPIKey'])){ echo "-="; prr($nto);// die();
        $tknURL = 'https://www.linkedin.com/uas/oauth2/accessToken?grant_type=authorization_code&code='.$at.'&redirect_uri='.urlencode($nxs_snapSetPgURL).'&client_id='.$nto['liAPIKey'].'&client_secret='.$nto['liAPISec']; 
        $response  = wp_remote_post($tknURL, $wprg); prr($tknURL);      
        if((is_object($response)&&(isset($response->errors)))){ prr($response); die(); }
        if (is_array($response)&& stripos($response['body'],'"error":')!==false){ prr($response['body']); prr(json_decode($response['body'],true)); die(); }
        $resp = json_decode($response['body'], true); prr($resp); if (!is_array($resp) || empty($resp['access_token'])) { prr($resp); die(); }
        if (function_exists('get_option')) $currTime = time() + ( get_option( 'gmt_offset' ) * HOUR_IN_SECONDS ); else  $currTime = time();
        $nto['liAccessToken'] = $resp['access_token']; $nto['liAccessTokenSecret'] = 'No Need for oAuth V2'; $nto['liOAuthVerifier'] = 'No Need for oAuth V2';
        $nto['liAccessTokenExp'] = $currTime + $resp['expires_in'];    echo "<br/>----=={ Expires: ".date('Y-m-d H:i:s', $nto['liAccessTokenExp'])." }==---- <br/>";
        $tknURL = 'https://api.linkedin.com/v1/people/~:(id,first-name,last-name)?format=json&oauth2_access_token='.$nto['liAccessToken'];
        $response  = wp_remote_get($tknURL, $wprg); prr($tknURL); prr($response);  $user = json_decode($response['body'], true);
       
        if (!empty($user['id'])) { $nto['liUserID'] = $user['id'];  $nto['liUserInfo'] = $user['firstName'].$user['lastName'].(!empty($user['id'])?" (".$user['id'].")":'');  $nto['isV2'] = true;
          if (function_exists('get_option')) $nxs_gOptions = get_option('NS_SNAutoPoster'); if(!empty($nxs_gOptions)) { $nxs_gOptions['li'][$ii] = $nto; prr($nto); nxs_settings_save($nxs_gOptions); }
          nxs_save_glbNtwrks($ntInfo['lcode'],$ii,$nto,'*');
          ?><script type="text/javascript">window.location = "<?php echo $nxs_snapSetPgURL; ?>"</script>      
        <?php }        
      }
      die();
    }
    // V1 Auth
    if ( isset($_GET['auth']) && $_GET['auth']=='li'){ require_once('apis/liOAuth.php'); $options = $ntOpts[$_GET['acc']];
              
              $api_key = $options['liAPIKey']; $api_secret = $options['liAPISec'];
              $callback_url = $nxs_snapSetPgURL."&auth=lia&acc=".$_GET['acc'];
              $li_oauth = new nsx_LinkedIn($api_key, $api_secret, $callback_url); 
              $request_token = $li_oauth->getRequestToken(); //echo "####"; prr($request_token); die();
              if (!is_object($request_token)) { echo "### LinkedIn Authorization Error:"; prr($request_token);
                if (is_string($request_token) && stripos($request_token, 'timestamp')!==false) { echo "Your Server Time: ".date('m/d/Y h:i:s a'); echo " Correct Time: ".date('m/d/Y h:i:s a', nxs_ntp_time('t1.timegps.net')); } die();
              }
              $options['liOAuthToken'] = $request_token->key;
              $options['liOAuthTokenSecret'] = $request_token->secret; // prr($li_oauth);
              switch ($li_oauth->http_code) { case 200: $url = $li_oauth->generateAuthorizeUrl();   
                $optionsG = get_option('NS_SNAutoPoster'); $optionsG['li'][$_GET['acc']] = $options;  update_option('NS_SNAutoPoster', $optionsG);
                echo '<script type="text/javascript">window.location = "'.$url.'"</script>'; break; 
                default: echo '<br/><b style="color:red">Could not connect to LinkedIn. Refresh the page or try again later.</b>'; die();
              }die();
            }
    if ( isset($_GET['auth']) && $_GET['auth']=='lia'){ require_once('apis/liOAuth.php');  $options = $ntOpts[$_GET['acc']]; $api_key = $options['liAPIKey']; $api_secret = $options['liAPISec'];
              $li_oauth = new nsx_LinkedIn($api_key, $api_secret); $li_oauth->request_token = new nsx_trOAuthConsumer($options['liOAuthToken'], $options['liOAuthTokenSecret'], 1);              
              $li_oauth->oauth_verifier = $_REQUEST['oauth_verifier'];  $li_oauth->getAccessToken($_REQUEST['oauth_verifier']); $options['liOAuthVerifier'] = $_REQUEST['oauth_verifier'];
              $options['liAccessToken'] = $li_oauth->access_token->key; $options['liAccessTokenSecret'] = $li_oauth->access_token->secret;                            
              try{$xml_response = $li_oauth->getProfile("~:(id,first-name,last-name)");} catch (Exception $o){prr($o); die("<span style='color:red;'>ERROR: Authorization Error</span>");}
              if (stripos($xml_response,'<first-name>')!==false) $userinfo =  CutFromTo($xml_response, '<id>','</id>')." - ".CutFromTo($xml_response, '<first-name>','</first-name>')." ".CutFromTo($xml_response, '<last-name>','</last-name>'); else $userinfo='';              
              if ($userinfo!='') {  $options['liUserInfo'] = $userinfo; $optionsG = get_option('NS_SNAutoPoster'); $optionsG['li'][$_GET['acc']] = $options;  update_option('NS_SNAutoPoster', $optionsG); 
                  echo '<script type="text/javascript">window.location = "'.$nxs_snapSetPgURL.'"</script>'; die();
              } prr($xml_response); die("<span style='color:red;'>ERROR: Something is Wrong with your LinkedIn account</span>");
            } $ntParams = array('ntInfo'=>$ntInfo, 'nxs_plurl'=>$nxs_plurl, 'ntOpts'=>$ntOpts, 'chkField'=>'fbAppAuthUser'); nxs_showListRow($ntParams); 
  }  
  //#### Show NEW Settings Page
  function showNewNTSettings($bo){ $po = array('nName'=>'', 'ulName'=>'', 'uPass'=>'', 'grpID'=>'', 'uPage'=>'', 'doLI'=>'1', 'liAPIKey'=>'', 'liAPISec'=>'', 'liUserInfo'=>'', 'liOAuthToken'=>'', 'liMsgFormat'=>'New post has been published on %SITENAME%', 'liMsgFormatT'=>'New post - %TITLE%', 'proxy'=>'', 'proxyup'=>''); $po['ntInfo']= array('lcode'=>'li'); $this->showNTSettings($bo, $po, true);}
  //#### Show Unit  Settings
  function showNTSettings($ii, $options, $isNew=false){  global $nxs_plurl,$nxs_snapSetPgURL;  $nt = $options['ntInfo']['lcode']; $ntU = strtoupper($nt); if (!isset($options['liOK'])) $options['liOK'] = ''; 
  
    if (!isset($options['nHrs'])) $options['nHrs'] = 0; if (!isset($options['nMin'])) $options['nMin'] = 0;   
    if (!isset($options['nDays'])) $options['nDays'] = 0; if (!isset($options['qTLng'])) $options['qTLng'] = ''; if (!isset($options['liMsgAFrmt'])) $options['liMsgAFrmt'] = ''; 
    if (empty($options['apiToUse'])) { if (!empty($options['liAPIKey'])) $options['apiToUse'] = 'li'; if (!empty($options['ulName']) && !empty($options['uPass'])) $options['apiToUse'] = 'nx'; } ?>
    <div id="doLI<?php echo $ii; ?>Div" class="insOneDiv<?php if ($isNew) echo " clNewNTSets"; ?>">   <input type="hidden" name="apDoSLI<?php echo $ii; ?>" value="0" id="apDoSLI<?php echo $ii; ?>" />                                     
    <?php if ($isNew) { ?> <input type="hidden" name="li[<?php echo $ii; ?>][apDoLI]" value="1" id="apDoNewLI<?php echo $ii; ?>" /> <?php } ?>
            <div id="doLI<?php echo $ii; ?>Div" style="margin-left: 10px;"> 
            
            <div class="nsx_iconedTitle" style="float: right; background-image: url(<?php echo $nxs_plurl; ?>img/li16.png);"><a style="font-size: 12px;" target="_blank"  href="http://www.nextscripts.com/setup-installation-linkedin-social-networks-auto-poster-wordpress/"><?php $nType="LinkedIn"; printf( __( 'Detailed %s Installation/Configuration Instructions' , 'social-networks-auto-poster-facebook-twitter-g'), $nType); ?></a></div>
            
            <div style="width:100%;"><strong><?php _e('Account Nickname', 'social-networks-auto-poster-facebook-twitter-g'); ?>:</strong> <i><?php _e('Just so you can easily identify it', 'social-networks-auto-poster-facebook-twitter-g'); ?></i> </div><input name="li[<?php echo $ii; ?>][nName]" id="linName<?php echo $ii; ?>" style="font-weight: bold; color: #005800; border: 1px solid #ACACAC; width: 40%;" value="<?php _e(apply_filters('format_to_edit', htmlentities($options['nName'], ENT_COMPAT, "UTF-8")), 'social-networks-auto-poster-facebook-twitter-g') ?>" /><br/>
            <?php echo nxs_addQTranslSel('li', $ii, $options['qTLng']); ?>
            
            <br/>
    <ul class="nsx_tabs">
    <li><a href="#nsx<?php echo $nt.$ii ?>_tab1"><?php _e('Account Info', 'social-networks-auto-poster-facebook-twitter-g'); ?></a></li>    
    <?php if (!$isNew) { ?>  <li><a href="#nsx<?php echo $nt.$ii ?>_tab2"><?php _e('Advanced', 'social-networks-auto-poster-facebook-twitter-g'); ?></a></li>  <?php } ?>
    </ul>
    <div class="nsx_tab_container"><?php /* ######################## Account Tab ####################### */ ?>
    <div id="nsx<?php echo $nt.$ii ?>_tab1" class="nsx_tab_content" style="background-image: url(<?php echo $nxs_plurl; ?>img/<?php echo $nt; ?>-bg.png); background-repeat: no-repeat;  background-position:90% 10%;">
    
    <div style="display: <?php echo (empty($options['apiToUse']))?"block":"none"; ?>;">
    
    <div style="width:100%; text-align: center; color:#005800; font-weight: bold; font-size: 14px;">You can choose what API you would like to use. </div>      
    
    <span style="color:#005800; font-weight: bold; font-size: 14px;">LinkedIn Native API:</span> Free built-in API from LinkedIn. Can be used for posting to your profile. More secure, more stable. More complicated - requires LinkedIn App and authorization. <br/><br/>
    
    <span style="color:#005800; font-weight: bold; font-size: 14px;">NextScripts API for LinkedIn:</span> Premium API with extended functionality. Can be used for posting to your profile, <b>group page</b> or <b>company page</b>. Easier to configure, but less secure - requires your password.<br/><br/>
    
    <select name="li[<?php echo $ii; ?>][apiToUse]" onchange="if (jQuery(this).val()=='li') { jQuery('.nxs_li_nxapi_<?php echo $ii; ?>').hide(); jQuery('.nxs_li_liapi_<?php echo $ii; ?>').show(); }else { jQuery('.nxs_li_liapi_<?php echo $ii; ?>').hide(); jQuery('.nxs_li_nxapi_<?php echo $ii; ?>').show(); }"><option <?php echo (empty($options['apiToUse']) || $options['apiToUse'] =='li')?"selected":""; ?> value="li">LinkedIn API</option><option <?php echo (!empty($options['apiToUse']) && $options['apiToUse'] =='nx')?"selected":""; ?> value="nx">NextScripts API</option></select><hr/>
    
    </div>
    
    <div id="nxsAPILI<?php echo $ii; ?>" class="nxs_li_liapi_<?php echo $ii; ?>" style="display: <?php echo (empty($options['apiToUse']) || $options['apiToUse'] =='li')?"block":"none"; ?>;"><h3>LinkedIn API</h3>
    
            <div class="subDiv" id="sub<?php echo $ii; ?>DivL" style="display: block;">
            
            <?php if (!empty($options['grpID'])) { ?> <span style="color: red;">LinkedIn has <a style="color: red;" target="_blank" href="https://developer.linkedin.com/support/developer-program-transition">discontinued support for groups</a> from it's free native API. This account should be removed or switched to NextScripts API</span> <br/>
            <br/><a onclick="jQuery('#nxsAPILI<?php echo $ii; ?>').hide(); jQuery('#nxsAPINX<?php echo $ii; ?>').show();  jQuery('#liuPage<?php echo $ii; ?>').val('https://www.linkedin.com/groups/?gid=<?php echo $options['grpID']; ?>'); jQuery('#sub<?php echo $ii; ?>DivL').append('<input type=hidden name=li[<?php echo $ii; ?>][apiToUse] value=nx />'); return false;" style="font-size: 16px;" href="#">&gt;&gt;&gt;&nbsp;Switch to NextScripts API Now&nbsp;&lt;&lt;&lt;</a><br/><br/></hr>
            
            <?php } ?>
            
            <div style="width:100%;"><strong>LinkedIn Client ID:</strong> </div><input name="li[<?php echo $ii; ?>][apLIAPIKey]" id="apLIAPIKey" style="width: 70%;" value="<?php _e(apply_filters('format_to_edit', htmlentities($options['liAPIKey'], ENT_COMPAT, "UTF-8")), 'social-networks-auto-poster-facebook-twitter-g') ?>" />             
            <div style="width:100%;"><strong>LinkedIn Client Secret:</strong> </div><input name="li[<?php echo $ii; ?>][apLIAPISec]" id="apLIAPISec" style="width: 70%;" value="<?php _e(apply_filters('format_to_edit', htmlentities($options['liAPISec'], ENT_COMPAT, "UTF-8")), 'social-networks-auto-poster-facebook-twitter-g') ?>" />
            <br/>
             <?php 
            if($options['liAPIKey']=='') { ?>
            <b>Authorize Your LinkedIn Account</b>. Please save your settings and come back here to Authorize your account.
            <?php } else { if(isset($options['liAccessToken']) && isset($options['liAccessTokenSecret']) && $options['liAccessTokenSecret']!=='') { ?>
            Your LinkedIn Account has been authorized. <br/>User ID: <?php _e(apply_filters('format_to_edit', $options['liUserInfo']), 'social-networks-auto-poster-facebook-twitter-g') ?>. 
            <br/>You can Re- <?php } ?>                              
            
            <?php if (class_exists("cl_nxsAutoPostToSN")) { ?><a  href="https://www.linkedin.com/uas/oauth2/authorization?response_type=code&client_id=<?php echo trim($options['liAPIKey']);?>&scope=r_basicprofile+r_emailaddress+w_share&state=<?php echo 'nxs-li-'.$ii; ?>&redirect_uri=<?php echo trim(urlencode($nxs_snapSetPgURL));?>">Authorize Your LinkedIn Account</a>            
            <?php } else { ?><a  href="<?php echo $nxs_snapSetPgURL; ?>&auth=li&acc=<?php echo $ii; ?>">Authorize Your LinkedIn Account</a> <?php }  ?>
            
            <?php if (!isset($options['liAccessTokenSecret']) || $options['liAccessTokenSecret']=='') { ?> <div class="blnkg">&lt;=== Authorize your account ===</div> <?php } ?>
            
            <?php } ?>
            </div>
             </div>
           <div id="nxsAPINX<?php echo $ii; ?>" class="nxs_li_nxapi_<?php echo $ii; ?>" style="display: <?php echo (!empty($options['apiToUse']) && $options['apiToUse'] =='nx')?"block":"none"; ?>;"><h3>NextScripts API</h3>
                        
 <?php if(class_exists('nxsAPI_LI')) { ?>
                 
        <div class="subDiv" id="sub<?php echo $ii; ?>DivN" style="display: block;">  
          <div style="width:100%;"><strong>Your LinkedIn Page URL:</strong> Could be your company page or group page. Leave empty to post to your own profile.</div><input name="li[<?php echo $ii; ?>][uPage]" id="liuPage<?php echo $ii; ?>" style="width: 90%;" value="<?php _e(apply_filters('format_to_edit', htmlentities($options['uPage'], ENT_COMPAT, "UTF-8")), 'social-networks-auto-poster-facebook-twitter-g') ?>" />
          <br/>
          <div style="width:100%;"><strong>Your LinkedIn Username/Email:</strong> </div><input name="li[<?php echo $ii; ?>][ulName]" id="liulName" style="width: 70%;" value="<?php _e(apply_filters('format_to_edit', htmlentities($options['ulName'], ENT_COMPAT, "UTF-8")), 'social-networks-auto-poster-facebook-twitter-g') ?>" /> 
          <div style="width:100%;"><strong>Your LinkedIn Password:</strong> </div><input type="password" name="li[<?php echo $ii; ?>][uPass]" id="liuPass" style="width: 75%;" value="<?php _e(apply_filters('format_to_edit', htmlentities($options['uPass'], ENT_COMPAT, "UTF-8")), 'social-networks-auto-poster-facebook-twitter-g') ?>" />
          
            </div>          
            <?php } else { nxs_show_noLibWrn('NextScripts API Library for LinkedIn module NOT found'); } ?>           
        </div>
          
             <br/><hr/>   
  
            <div id="altFormat">
              <div style="width:100%;"><strong id="altFormatText"><?php _e('Message text Format', 'social-networks-auto-poster-facebook-twitter-g'); ?>:</strong> </div>
              <textarea cols="150" rows="3" id="li<?php echo $ii; ?>SNAPformat" name="li[<?php echo $ii; ?>][apLIMsgFrmt]" style="width:51%;max-width: 650px;" onfocus="jQuery('#li<?php echo $ii; ?>SNAPformat').attr('rows', 6); mxs_showFrmtInfo('apLIMsgFrmt<?php echo $ii; ?>');"><?php _e(apply_filters('format_to_edit',htmlentities($options['liMsgFormat'], ENT_COMPAT, "UTF-8")), 'social-networks-auto-poster-facebook-twitter-g') ?></textarea>              
              <?php nxs_doShowHint("apIPMsgFrmt".$ii); ?>              
            </div>              
            
            <div style="width:100%;"><strong id="altFormatText">Post Type:</strong> </div>                      
            <div style="margin-left: 10px;">
        <?php if(empty($options['postType'])) {if (( !empty($options['liAttch']) && (int)$options['liAttch'] == 1) || $isNew) $options['postType'] = 'A';} ?>
        <input type="radio" name="li[<?php echo $ii; ?>][postType]" value="T" <?php if ($options['postType'] == 'T') echo 'checked="checked"'; ?> /> <?php _e('Text Post', 'social-networks-auto-poster-facebook-twitter-g'); ?> - <i><?php _e('just text message', 'social-networks-auto-poster-facebook-twitter-g'); ?></i><br/>                    
        <span class="nxs_li_nxapi_<?php echo $ii; ?>" style="display: <?php echo (!empty($options['apiToUse']) && $options['apiToUse'] =='nx')?"block":"none"; ?>;">
        <input type="radio" name="li[<?php echo $ii; ?>][postType]" value="I" <?php if ($options['postType'] == 'I') echo 'checked="checked"'; ?> /> <?php _e('Image Post', 'social-networks-auto-poster-facebook-twitter-g'); ?> - <i><?php _e('big image with text message (Profiles and Company pages only)', 'social-networks-auto-poster-facebook-twitter-g'); ?></i><br/>  </span> 
        <input type="radio" name="li[<?php echo $ii; ?>][postType]" value="A" <?php if ( !isset($options['postType']) || $options['postType'] == '' || $options['postType'] == 'A') echo 'checked="checked"'; ?> /> <?php _e('Add blogpost to LinkedIn message as an attachment', 'social-networks-auto-poster-facebook-twitter-g'); ?><br/>
        
         <div style="margin-left: 10px;">            
            <strong><?php _e('Attachment Text Format', 'social-networks-auto-poster-facebook-twitter-g'); ?>:</strong><br/> 
      <input value="1"  id="apLIMsgAFrmtA<?php echo $ii; ?>" <?php if (trim($options['liMsgAFrmt'])=='') echo "checked"; ?> onchange="if (jQuery(this).is(':checked')) { jQuery('#apLIMsgAFrmtDiv<?php echo $ii; ?>').hide(); jQuery('#apLIMsgAFrmt<?php echo $ii; ?>').val(''); }else jQuery('#apLIMsgAFrmtDiv<?php echo $ii; ?>').show();" type="checkbox" name="li[<?php echo $ii; ?>][apLIMsgAFrmtA]"/> <strong><?php _e('Auto', 'social-networks-auto-poster-facebook-twitter-g'); ?></strong>
      <i> - <?php _e('Recommended. Info from SEO Plugins will be used, then post excerpt, then post text', 'social-networks-auto-poster-facebook-twitter-g'); ?> </i><br/>
      <div id="apLIMsgAFrmtDiv<?php echo $ii; ?>" style="<?php if ($options['liMsgAFrmt']=='') echo "display:none;"; ?>" >&nbsp;&nbsp;&nbsp; <?php _e('Set your own format', 'social-networks-auto-poster-facebook-twitter-g'); ?>:<input name="li[<?php echo $ii; ?>][apLIMsgAFrmt]" id="apLIMsgAFrmt<?php echo $ii; ?>" style="width: 30%;" value="<?php _e(apply_filters('format_to_edit', htmlentities($options['liMsgAFrmt'], ENT_COMPAT, "UTF-8")), 'social-networks-auto-poster-facebook-twitter-g') ?>" /><br/></div>
            
            </div>
        
   </div><br/>          
            
            <br/>
            <div id="altFormat" style="display: <?php echo (!empty($options['apiToUse']) && $options['apiToUse'] =='nx')?"block":"none"; ?>;">
              <div style="width:100%;"><strong id="altFormatText"><?php _e('Message title Format (Groups Only)', 'social-networks-auto-poster-facebook-twitter-g'); ?>:</strong> </div>
              
              <input name="li[<?php echo $ii; ?>][liMsgFormatT]" id="li<?php echo $ii; ?>SNAPformatT" style="width: 50%;" value="<?php if ($isNew) echo "New Post - %TITLE%"; else _e(apply_filters('format_to_edit',htmlentities($options['liMsgFormatT'], ENT_COMPAT, "UTF-8")), 'social-networks-auto-poster-facebook-twitter-g'); ?>" onfocus="mxs_showFrmtInfo('apLIMsgFrmtT<?php echo $ii; ?>');" /><?php nxs_doShowHint("apIPMsgFrmt".$ii); ?>
                         
            </div>              
                        
            <br/>    
            
            <?php if($options['liAPIKey']!='' || (isset($options['uPass']) && $options['uPass']!='')) { ?>
            
            <br/><b><?php _e('Test your settings', 'social-networks-auto-poster-facebook-twitter-g'); ?>:</b>&nbsp;&nbsp;&nbsp; <a href="#" class="NXSButton" onclick="testPost('LI', '<?php echo $ii; ?>'); return false;"><?php printf( __( 'Submit Test Post to %s', 'social-networks-auto-poster-facebook-twitter-g' ), $nType); ?></a>
            
            <?php if (!isset($options['liOK']) || $options['liOK']=='') { ?> <div class="blnkg">&lt;=== Click "Test" to finish setup ===</div> <?php } ?>
            
              <br/><?php }?>
              </div>
              
                <?php /* ######################## Advanced Tab ####################### */ ?>
   <?php if (!$isNew) { ?>  <div id="nsx<?php echo $nt.$ii ?>_tab2" class="nsx_tab_content">
    
    <?php $options = nxs_FltrsV3toV4($options); nxs_showNTFilters($nt, $ii, $options); echo "<hr/>";
      nxs_addPostingDelaySelV3($nt, $ii, $options['nHrs'], $options['nMin'], $options['nDays']); $ntClInst = new nxs_snapClassNT(); $ntClInst->showProxies($nt, $ii, $options);
      nxs_showRepostSettings($nt, $ii, $options); ?>
            
            
    </div>  <?php } ?> <?php /* #### End of Tab #### */ ?>
    </div><br/> <?php /* #### End of Tabs #### */ ?>
    
    <div class="submitX nxclear" style="padding-bottom: 0px;"><input type="submit" class="button-primary" name="update_NS_SNAutoPoster_settings" value="<?php _e('Update Settings', 'social-networks-auto-poster-facebook-twitter-g') ?>" /></div>
            
            </div>
        </div>
        <?php
      
      
  }
  //#### Set Unit Settings from POST
  function setNTSettings($post, $options){  $code = $this->ntInfo['code'];
    foreach ($post as $ii => $pval){ // prr($ii); prr($pval);
      if ( (isset($pval['apLIAPIKey']) && $pval['apLIAPISec']!='') || (isset($pval['uPass']) && $pval['uPass']!='') ) { if (!isset($options[$ii])) $options[$ii] = array();  $options[$ii]['ii'] = $ii;        
        if (isset($pval['apDoLI']))    $options[$ii]['doLI'] = $pval['apDoLI']; else $options[$ii]['doLI'] = 0;
        if (isset($pval['nName']))     $options[$ii]['nName'] = trim($pval['nName']);
        
        if (isset($pval['apiToUse'])) $options[$ii]['apiToUse'] = trim($pval['apiToUse']);                                
        
        if (isset($options[$ii]['grpID']) && isset($pval['apiToUse']) && ($pval['apiToUse'])=='nx') unset($options[$ii]['grpID']); //## Switch/Upgrade
        
        if (isset($pval['apLIAPIKey']))$options[$ii]['liAPIKey'] = trim($pval['apLIAPIKey']);                                
        if (isset($pval['apLIAPISec']))$options[$ii]['liAPISec'] = trim($pval['apLIAPISec']);                
        if (isset($pval['postType']))     $options[$ii]['postType'] = trim($pval['postType']);      
        
        if (isset($pval['apiToUse']) && $pval['apiToUse']=='li' && ($options[$ii]['postType']=='I')) $options[$ii]['postType'] = 'T';
        
        
        
        
        if (isset($pval['ulName']))     $options[$ii]['ulName'] = trim($pval['ulName']);        
        if (isset($pval['uPass']))     $options[$ii]['uPass'] = trim($pval['uPass']);        
        if (isset($pval['grpID']))     $options[$ii]['grpID'] = trim($pval['grpID']);                
        if (isset($pval['uPage']))     $options[$ii]['uPage'] = trim($pval['uPage']);                
        if (isset($pval['apLIMsgFrmt'])) $options[$ii]['liMsgFormat'] = trim($pval['apLIMsgFrmt']); 
        if (isset($pval['liMsgFormatT'])) $options[$ii]['liMsgFormatT'] = trim($pval['liMsgFormatT']); 
        if (isset($pval['apLIMsgAFrmt']))    $options[$ii]['liMsgAFrmt'] = trim($pval['apLIMsgAFrmt']); 
        
        $options[$ii] = nxs_adjRpst($options[$ii], $pval);  $options[$ii] = nxs_adjFilters($pval, $options[$ii]);        
        
        if (isset($pval['delayDays'])) $options[$ii]['nDays'] = trim($pval['delayDays']);
        if (isset($pval['delayHrs'])) $options[$ii]['nHrs'] = trim($pval['delayHrs']); if (isset($pval['delayMin'])) $options[$ii]['nMin'] = trim($pval['delayMin']); 
        if (isset($pval['qTLng'])) $options[$ii]['qTLng'] = trim($pval['qTLng']); 
      }  elseif ( count($pval)==1 ) if (isset($pval['apDo'.$code])) $options[$ii]['do'.$code] = $pval['apDo'.$code]; else $options[$ii]['do'.$code] = 0; 
    } return $options;
  } 
  //#### Show Post->Edit Meta Box Settings
  function showEdPostNTSettings($ntOpts, $post){ global $nxs_plurl; $post_id = $post->ID;  $nt = 'li'; $ntU = 'LI';
    foreach($ntOpts as $ii=>$ntOpt)  { $pMeta = maybe_unserialize(get_post_meta($post_id, 'snapLI', true));  if (is_array($pMeta) && isset($pMeta[$ii])) $ntOpt = $this->adjMetaOpt($ntOpt, $pMeta[$ii]); 
      if (empty($ntOpt['imgToUse'])) $ntOpt['imgToUse'] = '';  if (empty($ntOpt['urlToUse'])) $ntOpt['urlToUse'] = '';  $imgToUse = $ntOpt['imgToUse'];  $urlToUse = $ntOpt['urlToUse']; 
      $isAvailLI =  (isset($ntOpt['liOAuthVerifier']) && $ntOpt['liOAuthVerifier']!='' && $ntOpt['liAccessTokenSecret']!='' && $ntOpt['liAccessToken']!='' && $ntOpt['liAPIKey']!='') || ($ntOpt['ulName']!=='' && $ntOpt['uPass']!=='');
      $liMsgFormat = htmlentities($ntOpt['liMsgFormat'], ENT_COMPAT, "UTF-8"); $liMsgFormatT = htmlentities($ntOpt['liMsgFormatT'], ENT_COMPAT, "UTF-8"); 
      ?>  
      
<tr><th style="text-align:left;" colspan="2">

      
      <?php if ($isAvailLI) {$ntOpt = nxs_FltrsV3toV4($ntOpt); if (!isset($ntOpt['do'])) $ntOpt['do'] = $ntOpt['do'.$ntU];  ?>      
      <?php if ($post->post_status != "publish" && (int)$ntOpt['do']>0 && !empty($ntOpt['fltrsOn']) && $ntOpt['fltrsOn']=='1'){ ?>
        <input type="radio" id="rbtn<?php echo $ntU.$ii; ?>" value="2" name="<?php echo $nt; ?>[<?php echo $ii; ?>][do]" checked="checked" class="nxsGrpDoChb" /> <?php } 
      else { ?>
         <input class="nxsGrpDoChb" value="1" id="do<?php echo $ntU.$ii; ?>" <?php if ($post->post_status == "publish") echo 'disabled="disabled"';?> type="checkbox" name="<?php echo $nt; ?>[<?php echo $ii; ?>][do]" <?php if ((int)$ntOpt['do'] > 0) echo 'checked="checked" title="def"';  ?> /> 
      <?php }
      if ($post->post_status == "publish") { ?> <input type="hidden" name="<?php echo $nt; ?>[<?php echo $ii; ?>][do]" value="<?php echo $ntOpt['do'];?>"> <?php } ?> 
    <?php } ?>
      <div class="nsx_iconedTitle" style="display: inline; font-size: 13px; background-image: url(<?php echo $nxs_plurl; ?>img/li16.png);">LinkedIn - <?php _e('publish to', 'social-networks-auto-poster-facebook-twitter-g') ?> (<i style="color: #005800;"><?php echo $ntOpt['nName']; ?></i>)</div></th><td><?php //## Only show RePost button if the post is "published"
                    if ($post->post_status == "publish" && $isAvailLI) { ?><?php $ntName = $this->ntInfo['name']; ?>
                    <input alt="<?php echo $ii; ?>" style="float: right;" onmouseout="hidePopShAtt('SV');" onmouseover="showPopShAtt('SV', event);" onclick="return false;" data-ntname="<?php echo $ntName; ?>" type="button" class="button manualPostBtn" name="<?php echo $nt."-".$post->ID; ?>" value="<?php _e('Post to ', 'social-networks-auto-poster-facebook-twitter-g'); echo $ntName; ?>" />
                    <?php } ?>
                    
                    <?php if (is_array($pMeta) && isset($pMeta[$ii]) && is_array($pMeta[$ii]) && isset($pMeta[$ii]['pgID']) ) {  // prr($pMeta[$ii]);                       
                        ?> <span id="pstdLI<?php echo $ii; ?>" style="float: right;padding-top: 4px; padding-right: 10px;">
                      <a style="font-size: 10px;" href="<?php if ( $pMeta[$ii]['postURL']!='')  echo $pMeta[$ii]['postURL']; elseif ($ntOpt['uPage']!='') echo $ntOpt['uPage']; else { } ?>" target="_blank"><?php $nType="LinkedIn"; printf( __( 'Posted on', 'social-networks-auto-poster-facebook-twitter-g' ), $nType); ?>  <?php echo (isset($pMeta[$ii]['pDate']) && $pMeta[$ii]['pDate']!='')?(" (".$pMeta[$ii]['pDate'].")"):""; ?></a>
                    </span><?php } ?>
                    
                </td></tr>
                <?php if (!$isAvailLI) { ?><tr><th scope="row" style="text-align:right; width:150px; padding-top: 5px; padding-right:10px;"></th> <td><b>Setup your LinkedIn Account to AutoPost to LinkedIn</b>
                <?php } else { if ($post->post_status != "publish" && function_exists('nxs_doSMAS5') ) { $ntOpt['postTime'] = get_post_time('U', false, $post_id); nxs_doSMAS5($nt, $ii, $ntOpt); } ?>
                
                <?php if ($ntOpt['rpstOn']=='1') { ?> 
                
                <tr id="altFormat1" style=""><th scope="row" class="nxsTHRow">
                <input value="0"  type="hidden" name="<?php echo $nt; ?>[<?php echo $ii; ?>][rpstPostIncl]"/><input value="nxsi<?php echo $ii; ?>li" type="checkbox" name="<?php echo $nt; ?>[<?php echo $ii; ?>][rpstPostIncl]"  <?php if (!empty($ntOpt['rpstPostIncl'])) echo "checked"; ?> />
                </th>
                <td> <?php _e('Include in "Auto-Reposting" to this network.', 'social-networks-auto-poster-facebook-twitter-g') ?>               
                </td></tr> <?php } ?>
                
                <tr><th scope="row" style="text-align:right; width:150px; vertical-align:top; padding-top: 0px; padding-right:10px;"> <?php _e('Post Type:', 'social-networks-auto-poster-facebook-twitter-g') ?> 
                </th><td>     
        
        <input type="radio" name="li[<?php echo $ii; ?>][postType]" value="T" <?php if ($ntOpt['postType'] == 'T') echo 'checked="checked"'; ?> /><?php _e('Text Post', 'social-networks-auto-poster-facebook-twitter-g') ?>  - <i><?php _e('just text message', 'social-networks-auto-poster-facebook-twitter-g') ?></i><br/>       
        <span class="nxs_li_nxapi_<?php echo $ii; ?>" style="display: <?php echo (!empty($ntOpt['apiToUse']) && $ntOpt['apiToUse'] =='nx')?"block":"none"; ?>;">
        <input type="radio" name="li[<?php echo $ii; ?>][postType]" value="I" <?php if ($ntOpt['postType'] == 'I') echo 'checked="checked"'; ?> onchange="jQuery('#altFormatIMG<?php echo $nt.$ii;?>').show();" /> <?php _e('Post to LinkedIn as "Image post"', 'social-networks-auto-poster-facebook-twitter-g') ?> - <i><?php _e('big image with text message', 'social-networks-auto-poster-facebook-twitter-g') ?></i><br/> </span>            
        <input type="radio" name="li[<?php echo $ii; ?>][postType]" value="A" <?php if ( !isset($ntOpt['postType']) || $ntOpt['postType'] == '' || $ntOpt['postType'] == 'A') echo 'checked="checked"'; ?> onchange="jQuery('#altFormatIMG<?php echo $nt.$ii;?>').hide();" /><?php _e('Text Post with "attached" blogpost', 'social-networks-auto-poster-facebook-twitter-g') ?>        
     </td></tr>
                
                <tr id="altFormat1" style=""><th scope="row" style="vertical-align:top; padding-top: 6px; text-align:right; width:60px; padding-right:10px;"><?php _e('Message Format:', 'social-networks-auto-poster-facebook-twitter-g') ?></th>
                <td>                
                <textarea cols="150" rows="1" id="li<?php echo $ii; ?>SNAPformat" name="li[<?php echo $ii; ?>][SNAPformat]"  style="width:60%;max-width: 610px;" onfocus="jQuery('#li<?php echo $ii; ?>SNAPformat').attr('rows', 4); jQuery('.nxs_FRMTHint').hide();mxs_showFrmtInfo('apLIMsgFrmt<?php echo $ii; ?>');"><?php echo $liMsgFormat; ?></textarea>
                <?php nxs_doShowHint("apLIMsgFrmt".$ii); ?></td></tr>
                
                <tr id="altFormat1" style=""><th scope="row" style="vertical-align:top; padding-top: 6px; text-align:right; width:60px; padding-right:10px;"><?php _e('Title Format (Groups Only):', 'social-networks-auto-poster-facebook-twitter-g') ?></th>
                <td><input value="<?php echo $liMsgFormatT ?>" type="text" name="li[<?php echo $ii; ?>][liMsgFormatT]"  style="width:60%;max-width: 610px;" onfocus="jQuery('.nxs_FRMTHint').hide();mxs_showFrmtInfo('apLIMsgFrmtT<?php echo $ii; ?>');"/><?php nxs_doShowHint("apLIMsgFrmtT".$ii, '', '58'); ?></td></tr>                
                <?php /* ## Select Image & URL ## */ nxs_showImgToUseDlg($nt, $ii, $imgToUse); nxs_showURLToUseDlg($nt, $ii, $urlToUse); ?>

                <?php } 
    }      
  }
  
  function adjMetaOpt($optMt, $pMeta){ if (isset($pMeta['isPosted'])) $optMt['isPosted'] = $pMeta['isPosted']; else  $optMt['isPosted'] = '';
     if (isset($pMeta['SNAPformat'])) $optMt['liMsgFormat'] = $pMeta['SNAPformat']; if (trim($optMt['liMsgFormat'])=='') $optMt['liMsgFormat'] = ' ';     
     if (isset($pMeta['liMsgFormatT'])) $optMt['liMsgFormatT'] = $pMeta['liMsgFormatT']; if (trim($optMt['liMsgFormatT'])=='') $optMt['liMsgFormatT'] = ' ';
     if (isset($pMeta['imgToUse'])) $optMt['imgToUse'] = $pMeta['imgToUse']; if (isset($pMeta['urlToUse'])) $optMt['urlToUse'] = $pMeta['urlToUse']; 
     if (isset($pMeta['postType'])) $optMt['postType'] = $pMeta['postType'];
     if (isset($pMeta['timeToRun']))  $optMt['timeToRun'] = $pMeta['timeToRun'];  if (isset($pMeta['rpstPostIncl']))  $optMt['rpstPostIncl'] = $pMeta['rpstPostIncl'];         
     if (isset($pMeta['do'])) $optMt['do'] = $pMeta['do']; else $optMt['do'] = 0; if (isset($pMeta['doLI'])) $optMt['doLI'] = $pMeta['doLI']; else { if (isset($pMeta['SNAPformat'])) $optMt['doLI'] = 0; } 
     if (isset($pMeta['SNAPincludeLI']) && $pMeta['SNAPincludeLI'] == '1' ) $optMt['doLI'] = 1; 
     return $optMt;
  }
}}

if (!function_exists("nxs_rePostToLI_ajax")) { function nxs_rePostToLI_ajax() {  check_ajax_referer('nxsSsPageWPN');  $postID = $_POST['id']; // $result = nsPublishTo($id, 'FB', true);   
      global $plgn_NS_SNAutoPoster;  if (!isset($plgn_NS_SNAutoPoster)) return; $options = $plgn_NS_SNAutoPoster->nxs_options; 
      foreach ($options['li'] as $ii=>$po) if ($ii==$_POST['nid']) {  $po['ii'] = $ii; $po['pType'] = 'aj';
      $mpo =  get_post_meta($postID, 'snapLI', true); $mpo =  maybe_unserialize($mpo);
      if (is_array($mpo) && isset($mpo[$ii]) && is_array($mpo[$ii]) ){ $ntClInst = new nxs_snapClassLI(); $po = $ntClInst->adjMetaOpt($po, $mpo[$ii]); } 
      $result = nxs_doPublishToLI($postID, $po);  
      if ($result == 200 && ($postID=='0') && (!isset($options['li'][$ii]['liOK']) || $options['li'][$ii]['liOK']!='1')) { $options['li'][$ii]['liOK']=1;  update_option('NS_SNAutoPoster', $options); }
      if ($result == 200) die("Successfully sent your post to LinkedIn."); else die($result);
    }    
  }
}

if (!function_exists("nxs_doPublishToLI")) { //## Second Function to Post to LI
  function nxs_doPublishToLI($postID, $options){ global $nxs_gCookiesArr; $ntCd = 'LI'; $ntCdL = 'li'; $ntNm = 'LinkedIn';   $urlDescr = ''; $myurl = '';
    if (!is_array($options)) $options = maybe_unserialize(get_post_meta($postID, $options, true));
    //if (isset($options['timeToRun'])) wp_unschedule_event( $options['timeToRun'], 'nxs_doPublishToLI',  array($postID, $options));  
    $addParams = nxs_makeURLParams(array('NTNAME'=>$ntNm, 'NTCODE'=>$ntCd, 'POSTID'=>$postID, 'ACCNAME'=>$options['nName']));
    if (empty($options['imgToUse'])) $options['imgToUse'] = ''; if (empty($options['imgSize'])) $options['imgSize'] = '';
    $ii = $options['ii']; if (!isset($options['pType'])) $options['pType'] = 'im'; if ($options['pType']=='sh') sleep(rand(1, 10)); 
    $logNT = '<span style="color:#000058">LinkedIn</span> - '.$options['nName'];
    $snap_ap = get_post_meta($postID, 'snap'.$ntCd, true); $snap_ap = maybe_unserialize($snap_ap);     
    if ($options['pType']!='aj' && is_array($snap_ap) && (nxs_chArrVar($snap_ap[$ii], 'isPosted', '1') || nxs_chArrVar($snap_ap[$ii], 'isPrePosted', '1'))) {
        $snap_isAutoPosted = get_post_meta($postID, 'snap_isAutoPosted', true); if ($snap_isAutoPosted!='2') {  sleep(5);
         nxs_addToLogN('W', 'Notice', $logNT, '-=Duplicate=- Post ID:'.$postID, 'Already posted. No reason for posting duplicate'.' |'.$uqID); return;
        }
    }
  
    $blogTitle = htmlspecialchars_decode(get_bloginfo('name'), ENT_QUOTES); if ($blogTitle=='') $blogTitle = home_url();  $imgURL=''; // prr($options);
    if ($postID=='0') { echo "Testing ... <br/><br/>"; $options['liMsgFormatT'] = 'Test Post from '.$blogTitle;  $urlToGo = home_url(); $options['liMsgFormat'] = 'Test Post from '.$blogTitle. " ".$urlToGo; $title = $blogTitle; }
      else { $post = get_post($postID); if(!$post) return;   
        $options['liMsgFormat'] = nsFormatMessage($options['liMsgFormat'], $postID, $addParams);  $options['liMsgFormatT'] = nsTrnc(nsFormatMessage($options['liMsgFormatT'], $postID, $addParams), 200); 
        //## MyURL - URLToGo code
        $options = nxs_getURL($options, $postID, $addParams); $urlToGo = $options['urlToUse'];     
        $title = nsTrnc($post->post_title, 200); nxs_metaMarkAsPosted($postID, $ntCd, $options['ii'], array('isPrePosted'=>'1')); 
                
      if(empty($options['postType'])) { if ((int)$options['liAttch'] == 1 || $isNew) $options['postType'] = 'A';}        
      if ($options['postType'] == 'A' || $options['postType'] == 'I') { 
        if (trim($options['liMsgAFrmt'])!='') { $urlDescr = nsFormatMessage($options['liMsgAFrmt'], $postID, $addParams); } else { 
            $urlDescr = trim(apply_filters('the_content', $post->post_excerpt)); if ($urlDescr=='') $urlDescr = apply_filters('the_content', $post->post_content);  
        } if (trim($options['imgToUse'])!='') $imgURL = $options['imgToUse']; else $imgURL = nxs_getPostImage($postID, 'full'); 
        if (preg_match("/noImg.\.png/i", $imgURL)) $imgURL = '';          
        $urlDescr = strip_tags($urlDescr); $urlDescr = nxs_decodeEntitiesFull($urlDescr); $urlDescr = nxs_html_to_utf8($urlDescr);  $urlDescr = nsTrnc($urlDescr, 300);                
      }  
    }
    $extInfo = ' | PostID: '.$postID." - ".(isset($post) && is_object($post)?$post->post_title:''); 
    //$images = array(nxs_getPostImage($postID, 'thumb'), nxs_getPostImage($postID, 'medium'), nxs_getPostImage($postID, 'full'), nxs_getPostImage($postID, 'original')); 
    $message = array('url'=>$urlToGo, 'surl'=>$urlToGo, 'urlDescr'=>$urlDescr, 'urlTitle'=>$title, 'title'=>$title, 'imageURL' => $imgURL, 'videoCode'=>'', 'videoURL'=>'', 'siteName'=>$blogTitle, 'cats'=>'', 'authorName'=>'');   
    //## Actual Post
    $ntToPost = new nxs_class_SNAP_LI(); $ret = $ntToPost->doPostToNT($options, $message);
    //## Process Results
    if (!is_array($ret) || $ret['isPosted']!='1') { //## Error 
      if ($postID=='0') prr($ret); nxs_addToLogN('E', 'Error', $logNT, '-=ERROR=- '.print_r($ret, true), $extInfo); 
    } else {  $extInfo .= ' | '.$ret['postID']; // ## All Good - log it.
      if ($postID=='0')  { nxs_addToLogN('S', 'Test', $logNT, 'OK - TEST Message Posted '); echo _e('OK - Message Posted, please see your '.$logNT.' Page. ', 'social-networks-auto-poster-facebook-twitter-g'); } 
        else  { nxs_metaMarkAsPosted($postID, $ntCd, $options['ii'], array('isPosted'=>'1', 'postID'=>$ret['postID'], 'postURL'=>$ret['postURL'], 'pgID'=>$ret['postID'], 'pDate'=>date('Y-m-d H:i:s'))); 
        if (!empty($ret['postURL'])) $extInfo .= ' | <a href="'.$ret['postURL'].'" target="_blank">Post Link</a>'; nxs_addToLogN('S', 'Posted', $logNT, 'OK - Message Posted ', $extInfo); }
    }
    //## Return Result
    if ($ret['isPosted']=='1') return 200; else return print_r($ret, true);     
  }
}

?>