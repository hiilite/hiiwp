<?php    
//## NextScripts XING Connection Class
$nxs_snapAvNts[] = array('code'=>'XI', 'lcode'=>'xi', 'name'=>'XING');

if (!class_exists("nxs_snapClassXI")) { class nxs_snapClassXI extends nxs_snapClassNT { 
  var $ntInfo = array('code'=>'XI', 'lcode'=>'xi', 'name'=>'XING', 'defNName'=>'', 'tstReq' => true, 'instrURL'=>'http://www.nextscripts.com/instructions/setup-installation-xing-social-networks-auto-poster/');  
  
  function toLatestVer($ntOpts){ if (!empty($ntOpts['v'])) $v = $ntOpts['v']; else $v = 340; $ntOptsOut = '';  switch ($v) {
      case 340: $ntOptsOut = $this->toLatestVerNTGen($ntOpts); $ntOptsOut['do'] = $ntOpts['do'.$this->ntInfo['code']]; $ntOptsOut['nName'] = $ntOpts['nName']; $ntOptsOut['appKey'] = $ntOpts['appKey']; $ntOptsOut['appSec'] = $ntOpts['appSec']; $ntOptsOut['inclTags'] = $ntOpts['inclTags'];
        $ntOptsOut['postType'] = $ntOpts['postType']; $ntOptsOut['msgFormat'] = $ntOpts['msgFrmt']; $ntOptsOut['appAppUserID'] = $ntOpts['appAppUserID'];  $ntOptsOut['appAppUserName'] = $ntOpts['appAppUserName'];   $ntOptsOut['appPGUserName'] = $ntOpts['appPGUserName'];
        $ntOptsOut['oAuthToken'] = $ntOpts['oAuthToken']; $ntOptsOut['oAuthTokenSecret'] = $ntOpts['oAuthTokenSecret']; $ntOptsOut['accessToken'] = $ntOpts['accessToken']; $ntOptsOut['accessTokenSec'] = $ntOpts['accessTokenSec'];         
      break;
    } return !empty($ntOptsOut)?$ntOptsOut:$ntOpts; 
  }   
  //#### Show Common Settings
  function showGenNTSettings($ntOpts){ $this->nt = $ntOpts;  $this->showNTGroup(); }  
  //#### Show NEW Settings Page
  function showNewNTSettings($ii){ $defO = array('nName'=>'', 'do'=>'1', 'appKey'=>'', 'appSec'=>'', 'inclTags'=>'1', 'postType'=>'A', 'msgFormat'=>"%EXCERPT%\r\n\r\n%URL%"); $this->showGNewNTSettings($ii, $defO); }
  //#### Show Unit  Settings  
  function checkIfSetupFinished($options) { return !empty($options['appAppUserID']) && !empty($options['accessToken']); }
  public function doAuth() { $ntInfo = $this->ntInfo; global $nxs_snapSetPgURL; if (isset($_GET['acc'])) $options = $this->nt[$_GET['acc']];
    if ( isset($_GET['auth']) && $_GET['auth']==$ntInfo['lcode']){
      $consumer_key = $options['appKey']; $consumer_secret = $options['appSec']; $callback_url = $nxs_snapSetPgURL."&auth=".$ntInfo['lcode']."a&acc=".$_GET['acc'];
      $tum_oauth = new nxs_OAuthBaseCl($consumer_key, $consumer_secret); $tum_oauth->baseURL = 'https://api.xing.com'; $tum_oauth->request_token_path = '/v1/request_token';
      $request_token = $tum_oauth->getReqToken($callback_url); $options['oAuthToken'] = $request_token['oauth_token']; $options['oAuthTokenSecret'] = $request_token['oauth_token_secret']; 
      prr($tum_oauth); prr($options);               
      switch ($tum_oauth->http_code) { case 201: case 200: $url = 'https://api.xing.com/v1/authorize?oauth_token='.$options['oAuthToken']; nxs_save_glbNtwrks($ntInfo['lcode'],$_GET['acc'],$options,'*'); 
        echo '<br/><br/>All good?! Redirecting ..... <script type="text/javascript">window.location = "'.$url.'"</script>'; break; 
        default: echo '<br/><b style="color:red">Could not connect to XING. Refresh the page or try again later.</b>'; die();
      } die();
    }
    if ( isset($_GET['auth']) && $_GET['auth']==$ntInfo['lcode'].'a'){ $consumer_key = $options['appKey']; $consumer_secret = $options['appSec']; 
      $tum_oauth = new nxs_OAuthBaseCl($consumer_key, $consumer_secret, $options['oAuthToken'], $options['oAuthTokenSecret']); //prr($tum_oauth);
      $tum_oauth->baseURL = 'https://api.xing.com'; $tum_oauth->access_token_path = '/v1/access_token'; $access_token = $tum_oauth->getAccToken($_GET['oauth_verifier']); prr($access_token);
      $options['accessToken'] = $access_token['oauth_token'];  $options['accessTokenSec'] = $access_token['oauth_token_secret'];  
      $tum_oauth = new nxs_OAuthBaseCl($consumer_key, $consumer_secret, $options['accessToken'], $options['accessTokenSec']);               
      $uinfo = $tum_oauth->makeReq('https://api.xing.com/v1/users/me', ''); prr($uinfo);
      if (is_array($uinfo) && isset($uinfo['users']) && isset($uinfo['users'][0]) && is_array($uinfo['users'][0])) { $uinfo = $uinfo['users'][0]; $options['appPGUserName'] = $uinfo['page_name'];
        $options['appAppUserName'] = $uinfo['display_name']."(".$uinfo['page_name'].")"; $options['appAppUserID'] = $uinfo['id'];                         
      }  nxs_save_glbNtwrks($ntInfo['lcode'],$_GET['acc'],$options,'*');  //prr($options); die();
      if (!empty($options['appAppUserID'])) {  echo '<br/><br/>All good?! Redirecting ..... <script type="text/javascript">window.location = "'.$nxs_snapSetPgURL.'"</script>';  die();}
        else die("<span style='color:red;'>ERROR: Authorization Error: <span style='color:darkred; font-weight: bold;'>".print_r($uinfo, true)."</span></span>");              
    }
  }
  function accTab($ii, $options, $isNew=false){ global $nxs_snapSetPgURL; $ntInfo = $this->ntInfo; $nt = $ntInfo['lcode']; $this->elemKeySecret($ii,'XING Consumer Key','XING Consumer Secret', $options['appKey'], $options['appSec']); ?>
    <br/><?php $this->elemMsgFormat($ii,'Message Text Format','msgFormat',$options['msgFormat']); ?>
    <div style="margin-bottom: 20px;margin-top: 5px;"><input value="1" type="checkbox" name="<?php echo $nt; ?>[<?php echo $ii; ?>][inclTags]"  <?php if ((int)$options['inclTags'] == 1) echo "checked"; ?> /> 
      <strong><?php _e('Post with tags', 'social-networks-auto-poster-facebook-twitter-g'); ?></strong>  <?php _e('Tags from the blogpost will be auto-posted to '.$ntInfo['name'], 'social-networks-auto-poster-facebook-twitter-g'); ?>                                                               
    </div>
    <div style="width:100%;"><strong id="altFormatText">Post Type:</strong></div>
    <div style="margin-left: 10px;">
      <input type="radio" name="<?php echo $nt; ?>[<?php echo $ii; ?>][postType]" value="T" <?php if ($options['postType'] == 'T') echo 'checked="checked"'; ?> /> <?php _e('Text Post', 'social-networks-auto-poster-facebook-twitter-g'); ?> - <i><?php _e('just text message', 'social-networks-auto-poster-facebook-twitter-g'); ?></i><br/>                                  
     <input type="radio" name="<?php echo $nt; ?>[<?php echo $ii; ?>][postType]" value="A" <?php if ( !isset($options['postType']) || $options['postType'] == '' || $options['postType'] == 'A') echo 'checked="checked"'; ?> /> <?php _e('Post link to the blogpost', 'social-networks-auto-poster-facebook-twitter-g'); ?><br/>
    </div><br/><br/>
    <?php  if($options['appKey']=='') { ?>
      <b><?php _e('Authorize Your '.$ntInfo['name'].' Account', 'social-networks-auto-poster-facebook-twitter-g'); ?></b> <?php _e('Please click "Update Settings" to be able to Authorize your account.', 'social-networks-auto-poster-facebook-twitter-g');  
    } else { if(isset($options['appAppUserID']) && $options['appAppUserID']>0) { 
      _e('Your '.$ntInfo['name'].' Account has been authorized.', 'social-networks-auto-poster-facebook-twitter-g'); ?> User ID: <?php _e(apply_filters('format_to_edit', htmlentities($options['appAppUserID'].' - '.$options['appAppUserName'], ENT_COMPAT, "UTF-8")), 'social-networks-auto-poster-facebook-twitter-g') ?>.
      <?php _e('You can', 'social-networks-auto-poster-facebook-twitter-g'); ?> Re- <?php } ?>            
      <a href="<?php echo $nxs_snapSetPgURL;?>&auth=<?php echo $nt; ?>&acc=<?php echo $ii; ?>">Authorize Your <?php echo $ntInfo['name']; ?> Account</a>            
      <?php if (!isset($options['appAppUserID']) || $options['appAppUserID']<1) { ?> <div class="blnkg">&lt;=== <?php _e('Authorize your account', 'social-networks-auto-poster-facebook-twitter-g'); ?> ===</div> <?php } 
    } ?><br/><br/> <?php
  }
  function advTab($ii, $options){}
  //#### Set Unit Settings from POST
  function setNTSettings($post, $options){ 
    foreach ($post as $ii => $pval){       
      if (!empty($pval['appKey']) && !empty($pval['appKey'])){ if (!isset($options[$ii])) $options[$ii] = array(); $options[$ii] = $this->saveCommonNTSettings($pval,$options[$ii]);
        //## Uniqe Items        
        if (isset($pval['inclTags'])) $options[$ii]['inclTags'] = trim($pval['inclTags']); else $options[$ii]['inclTags'] = 0;                       
      } elseif ( count($pval)==1 ) if (isset($pval['do'])) $options[$ii]['do'] = $pval['do']; else $options[$ii]['do'] = 0; 
    } return $options;
  }
    
  //#### Show Post->Edit Meta Box Settings
  
  function showEdPostNTSettings($ntOpts, $post){ $post_id = $post->ID; $nt = $this->ntInfo['lcode']; $ntU = $this->ntInfo['code'];
      foreach($ntOpts as $ii=>$ntOpt)  { $isFin = $this->checkIfSetupFinished($ntOpt); if (!$isFin) continue; 
        $pMeta = maybe_unserialize(get_post_meta($post_id, 'snap'.$ntU, true)); if (is_array($pMeta) && !empty($pMeta[$ii])) $ntOpt = $this->adjMetaOpt($ntOpt, $pMeta[$ii]);         
        
        if (empty($ntOpt['imgToUse'])) $ntOpt['imgToUse'] = ''; if (empty($ntOpt['urlToUse'])) $ntOpt['urlToUse'] = ''; $postType = isset($ntOpt['postType'])?$ntOpt['postType']:'';
        $msgFormat = !empty($ntOpt['msgFormat'])?htmlentities($ntOpt['msgFormat'], ENT_COMPAT, "UTF-8"):''; $msgTFormat = !empty($ntOpt['msgTFormat'])?htmlentities($ntOpt['msgTFormat'], ENT_COMPAT, "UTF-8"):'';
        $imgToUse = $ntOpt['imgToUse'];  $urlToUse = $ntOpt['urlToUse']; $ntOpt['ii']=$ii;
        
        $this->nxs_tmpltAddPostMeta($post, $ntOpt, $pMeta); ?> 
        
        <tr class="<?php echo 'nxstbldo'.strtoupper($nt).$ii; ?>"><th scope="row" style="text-align:right; width:150px; vertical-align:top; padding-top: 0px; padding-right:10px;"> <?php _e('Post Type:', 'social-networks-auto-poster-facebook-twitter-g') ?> <br/></th><td>     
        <input type="radio" name="<?php echo $nt; ?>[<?php echo $ii; ?>][postType]" value="T" <?php if ($postType == 'T') echo 'checked="checked"'; ?> /> <?php _e('Text Post', 'social-networks-auto-poster-facebook-twitter-g') ?>  - <i><?php _e('just text message', 'social-networks-auto-poster-facebook-twitter-g') ?></i><br/>
        <input type="radio" name="<?php echo $nt; ?>[<?php echo $ii; ?>][postType]" value="A" <?php if ( !isset($postType) || $postType == '' || $postType == 'A') echo 'checked="checked"'; ?> /><?php _e('Text Post with "attached" blogpost', 'social-networks-auto-poster-facebook-twitter-g') ?>
     </td></tr><?php $this->elemEdMsgFormat($ii, __('Message Format:', 'social-networks-auto-poster-facebook-twitter-g'),$msgFormat); 
       /* ## Select Image & URL ## */  nxs_showURLToUseDlg($nt, $ii, $urlToUse); $this->nxs_tmpltAddPostMetaEnd($ii);     
     }
  }
  
  //#### Save Meta Tags to the Post
  function adjMetaOpt($optMt, $pMeta){ $optMt = $this->adjMetaOptG($optMt, $pMeta);     
    //if (!empty($pMeta['tgBoard'])) $optMt['tgBoard'] = $pMeta['tgBoard'];       
    return $optMt;
  }
  
  function adjPublishWP(&$options, &$message, $postID){ //prr($message); prr($options);
    if (!empty($postID)) { $postType = $options['postType'];
      if ($postType=='A') if (trim($options['imgToUse'])!='') $imgURL = $options['imgToUse']; else $imgURL = nxs_getPostImage($postID, 'medium');  
      if ($postType=='I') if (trim($options['imgToUse'])!='') $imgURL = $options['imgToUse']; else $imgURL = nxs_getPostImage($postID, 'full');
      if (preg_match("/noImg.\.png/i", $imgURL)) { $imgURL = ''; $isNoImg = true; }
      $message['imageURL'] = $imgURL;
    }
  }   
  
}}

if (!function_exists("nxs_doPublishToXI")) { function nxs_doPublishToXI($postID, $options){ if (!is_array($options)) $options = maybe_unserialize(get_post_meta($postID, $options, true)); $cl = new nxs_snapClassXI(); $cl->nt[$options['ii']] = $options; return $cl->publishWP($options['ii'], $postID); }} 

?>