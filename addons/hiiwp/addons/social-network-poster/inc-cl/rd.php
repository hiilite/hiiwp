<?php    
//## NextScripts Reddit Connection Class
$nxs_snapAvNts[] = array('code'=>'RD', 'lcode'=>'rd', 'name'=>'Reddit');

if (!class_exists("nxs_snapClassRD")) { class nxs_snapClassRD { var  $ntInfo = array('code'=>'RD', 'lcode'=>'rd', 'name'=>'Reddit', 'defNName'=>'rdUName', 'tstReq' => false);
  //#### Show Common Settings
  function showGenNTSettings($ntOpts){  global $nxs_plurl; $ntInfo = array('code'=>'RD', 'lcode'=>'rd', 'name'=>'Reddit', 'defNName'=>'rdUName', 'tstReq' => false); 
    $ntParams = array('ntInfo'=>$ntInfo, 'nxs_plurl'=>$nxs_plurl, 'ntOpts'=>$ntOpts, 'chkField'=>''); nxs_showListRow($ntParams);  
  }  
  //#### Show NEW Settings Page
  function showNewNTSettings($mrdo){ $rdo = array('nName'=>'', 'doRD'=>'1', 'rdUName'=>'', 'rdPageID'=>'', 'rdCommID'=>'', 'postType'=>'A', 'rdPass'=>''); $rdo['ntInfo']= array('lcode'=>'rd'); $this->showNTSettings($mrdo, $rdo, true);}
  //#### Show Unit  Settings
  function showNTSettings($ii, $options, $isNew=false){  global $nxs_plurl; $nt = $options['ntInfo']['lcode']; $ntU = strtoupper($nt); 
    if (!isset($options['nHrs'])) $options['nHrs'] = 0; if (!isset($options['nMin'])) $options['nMin'] = 0;   
    if (!isset($options['nDays'])) $options['nDays'] = 0; if (!isset($options['qTLng'])) $options['qTLng'] = ''; if (!isset($options['rdSubReddit'])) $options['rdSubReddit'] = ''; ?>
            <div id="doRD<?php echo $ii; ?>Div" class="insOneDiv<?php if ($isNew) echo " clNewNTSets"; ?>">     <input type="hidden" name="apDoSRD<?php echo $ii; ?>" value="0" id="apDoSRD<?php echo $ii; ?>" />      
            
            <?php if(!function_exists('doConnectToRD')) {                
                 nxs_show_noLibWrn('Reddit API Library module NOT found.<br/><br/><span style="color:black;">Reddit does not have a free native API for automated posts yet.</span><br/><br/><span style="font-size: 12px;color:black;">You need to have a special API Library Module to be able to publish your content to Reddit.</span>'); echo "</div>"; return; }; ?>              
                               
            <div class="nsx_iconedTitle" style="float: right; background-image: url(<?php echo $nxs_plurl; ?>img/rd16.png);"><a style="font-size: 12px;" target="_blank"  href="http://www.nextscripts.com/setup-installation-reddit-social-networks-auto-poster-wordpress/"><?php $nType="Reddit"; printf( __( 'Detailed %s Installation/Configuration Instructions', 'social-networks-auto-poster-facebook-twitter-g' ), $nType); ?></a></div>
            
            <div style="width:100%;"><strong><?php _e('Account Nickname', 'social-networks-auto-poster-facebook-twitter-g'); ?>:</strong> <i><?php _e('Just so you can easily identify it', 'social-networks-auto-poster-facebook-twitter-g'); ?></i> </div><input name="rd[<?php echo $ii; ?>][nName]" id="rdnName<?php echo $ii; ?>" style="font-weight: bold; color: #005800; border: 1px solid #ACACAC; width: 40%;" value="<?php _e(apply_filters('format_to_edit', htmlentities($options['nName'], ENT_COMPAT, "UTF-8")), 'social-networks-auto-poster-facebook-twitter-g') ?>" /><br/>
            <?php echo nxs_addQTranslSel('rd', $ii, $options['qTLng']); ?>
            
            
          <br/>
    <ul class="nsx_tabs">
    <li><a href="#nsx<?php echo $nt.$ii ?>_tab1"><?php _e('Account Info', 'social-networks-auto-poster-facebook-twitter-g'); ?></a></li>    
    <?php if (!$isNew) { ?>  <li><a href="#nsx<?php echo $nt.$ii ?>_tab2"><?php _e('Advanced', 'social-networks-auto-poster-facebook-twitter-g'); ?></a></li>  <?php } ?>
    </ul>
    <div class="nsx_tab_container"><?php /* ######################## Account Tab ####################### */ ?>
    <div id="nsx<?php echo $nt.$ii ?>_tab1" class="nsx_tab_content" style="background-image: url(<?php echo $nxs_plurl; ?>img/<?php echo $nt; ?>-bg.png); background-repeat: no-repeat;  background-position:90% 10%;">
      
            
            <div style="width:100%;"><strong>Reddit Username:</strong> </div><input name="rd[<?php echo $ii; ?>][uName]" id="apRDUName<?php echo $ii; ?>" style="width: 30%;" value="<?php _e(apply_filters('format_to_edit', htmlentities($options['rdUName'], ENT_COMPAT, "UTF-8")), 'social-networks-auto-poster-facebook-twitter-g') ?>" />                
            <div style="width:100%;"><strong>Reddit Password:</strong> </div><input autocomplete="false" readonly onfocus="this.removeAttribute('readonly');" name="rd[<?php echo $ii; ?>][uPass]" id="apRDPass<?php echo $ii; ?>" type="password" style="width: 30%;" value="<?php _e(apply_filters('format_to_edit', htmlentities(substr($options['rdPass'], 0, 5)=='n5g9a'?nsx_doDecode(substr($options['rdPass'], 5)):$options['rdPass'], ENT_COMPAT, "UTF-8")), 'social-networks-auto-poster-facebook-twitter-g') ?>" />  <br/>                
            
            <div style="width:100%;"><strong>Subreddit ID:</strong>                         
            Please <a href="#" onclick="nxs_getBrdsOrCats(jQuery('<?php if ($isNew) echo "#nsx_addNT "; ?>#apRDUName<?php echo $ii; ?>').val(),jQuery('<?php if ($isNew) echo "#nsx_addNT "; ?>#apRDPass<?php echo $ii; ?>').val(), 'rd' , '<?php echo $ii; ?>', 'rdSubReddit'); return false;">click here to retrieve your subreddits</a>
            </div>
            <img id="rdLoadingImg<?php echo $ii; ?>" style="display: none;" src='<?php echo $nxs_plurl; ?>img/ajax-loader-sm.gif' /> 
            <select name="rd[<?php echo $ii; ?>][rdSubReddit]" id="rdSubReddit<?php echo $ii; ?>">
            <?php if (!empty($options['rdSubRedditsList'])){ $gBoards = $options['rdSubRedditsList']; if ( base64_encode(base64_decode($gBoards)) === $gBoards) $gBoards = base64_decode($gBoards); 
              if ($options['rdSubReddit']!='') $gBoards = str_replace($options['rdSubReddit'].'"', $options['rdSubReddit'].'" selected="selected"', $gBoards);  echo $gBoards;} else { ?>
              <option value="0">None(Click above to retrieve your subreddits)</option>
            <?php } ?>
            </select>
            
            <br/><br/>              
            <?php /* <input name="rd[<?php echo $ii; ?>][rdSubReddit]" id="apRDPage" style="width: 30%;" value="<?php _e(apply_filters('format_to_edit', htmlentities($options['rdSubReddit'], ENT_COMPAT, "UTF-8")), 'social-networks-auto-poster-facebook-twitter-g') ?>" />  */ ?>
            <i style="color: #580000;">Please do not try to post to subredits that you do not own. Reddit is very serious about it's policy that prohibits sharing your own links. You will loose posting privileges and you account will be <b>banned</b> if you post to public subreddits. </i>
            <br/>  <br/>  
            
            <div id="altFormat" style="">
  <div style="width:100%;"><strong id="altFormatText"><?php _e('Post Title Format', 'social-networks-auto-poster-facebook-twitter-g'); ?></strong> (<a href="#" id="rdTitleFormat<?php echo $ii; ?>HintInfo" onclick="mxs_showHideFrmtInfo('rdTitleFormat<?php echo $ii; ?>'); return false;"><?php _e('Show format info', 'social-networks-auto-poster-facebook-twitter-g'); ?></a>)</div>
              <input name="rd[<?php echo $ii; ?>][rdTitleFormat]" id="rdTitleFormat<?php echo $ii; ?>" style="width: 50%;" value="<?php if ($isNew) echo "%TITLE%"; else _e(apply_filters('format_to_edit', htmlentities($options['rdTitleFormat'], ENT_COMPAT, "UTF-8")), 'social-networks-auto-poster-facebook-twitter-g'); ?>"  onfocus="mxs_showFrmtInfo('rdTitleFormat<?php echo $ii; ?>');" /><?php nxs_doShowHint("rdTitleFormat".$ii); ?>
            </div><br/> 
            
     <div style="width:100%;"><strong id="altFormatText">Post Type:</strong></div>                      
      <div style="margin-left: 10px;">
        <input type="radio" name="rd[<?php echo $ii; ?>][postType]" value="A" <?php if ( !isset($options['postType']) || $options['postType'] == '' || $options['postType'] == 'A') echo 'checked="checked"'; ?> /> <?php _e('Link Post', 'social-networks-auto-poster-facebook-twitter-g'); ?>
        <br/>
        <input type="radio" name="rd[<?php echo $ii; ?>][postType]" value="T" <?php if ($options['postType'] == 'T') echo 'checked="checked"'; ?> /> <?php _e('Text Post', 'social-networks-auto-poster-facebook-twitter-g'); ?> - <i><?php _e('set the text format below', 'social-networks-auto-poster-facebook-twitter-g'); ?></i>
     </div><br/>
                      
            <div id="altFormat" style="margin-left: 20px;">
              <div style="width:100%;"><strong id="altFormatText"><?php _e('Text Format', 'social-networks-auto-poster-facebook-twitter-g'); ?>:</strong> (<a href="#" id="rdTextFormat<?php echo $ii; ?>HintInfo" onclick="mxs_showHideFrmtInfo('rdTextFormat<?php echo $ii; ?>'); return false;"><?php _e('Show format info', 'social-networks-auto-poster-facebook-twitter-g'); ?></a>)
              </div>
              
              <textarea cols="150" rows="3" id="rd<?php echo $ii; ?>SNAPformat" name="rd[<?php echo $ii; ?>][rdTextFormat]" style="width:51%;max-width: 650px;" onfocus="jQuery('#rd<?php echo $ii; ?>SNAPformat').attr('rows', 6); mxs_showFrmtInfo('apRDMsgFrmt<?php echo $ii; ?>');"><?php if ($isNew) _e("New post (%TITLE%) has been published on %SITENAME%", 'social-networks-auto-poster-facebook-twitter-g'); else _e(apply_filters('format_to_edit', htmlentities($options['rdTextFormat'], ENT_COMPAT, "UTF-8")), 'social-networks-auto-poster-facebook-twitter-g'); ?></textarea>
              
              <?php nxs_doShowHint("rdTextFormat".$ii); ?>
            </div><br/>          
            
            
            <?php if ($isNew) { ?> <input type="hidden" name="rd[<?php echo $ii; ?>][apDoRD]" value="1" id="apDoNewRD<?php echo $ii; ?>" /> <?php } ?>
            <?php if ($options['rdPass']!='') { ?>
            
            <b><?php _e('Test your settings', 'social-networks-auto-poster-facebook-twitter-g'); ?>:</b>&nbsp;&nbsp;&nbsp; <a href="#" class="NXSButton" onclick="testPost('RD', '<?php echo $ii; ?>'); return false;"><?php printf( __( 'Submit Test Post to %s', 'social-networks-auto-poster-facebook-twitter-g' ), $nType); ?></a>              <?php } 
            ?>
            </div>
            
            <?php /* ######################## Advanced Tab ####################### */ ?>
    <?php if (!$isNew) { ?>  <div id="nsx<?php echo $nt.$ii ?>_tab2" class="nsx_tab_content">
    
   <?php $options = nxs_FltrsV3toV4($options); nxs_showNTFilters($nt, $ii, $options); echo "<hr/>"; 
      nxs_addPostingDelaySelV3($nt, $ii, $options['nHrs'], $options['nMin'], $options['nDays']); 
    ?>
            
            
    </div>  <?php } ?> <?php /* #### End of Tab #### */ ?>
    </div><br/> <?php /* #### End of Tabs #### */ ?>
    
    <div class="submitX nxclear" style="padding-bottom: 0px;"><input type="submit" class="button-primary" name="update_NS_SNAutoPoster_settings" value="<?php _e('Update Settings', 'social-networks-auto-poster-facebook-twitter-g') ?>" /></div>
            
            </div><?php
  }
  //#### Set Unit Settings from POST
  function setNTSettings($post, $options){ $code = 'RD'; $lcode = 'rd'; 
    foreach ($post as $ii => $pval){     
      if (!empty($pval['uName']) && !empty($pval['uPass'])){ if (!isset($options[$ii])) $options[$ii] = array();      
        if (isset($pval['uName']))   $options[$ii]['rdUName'] = trim($pval['uName']);
        if (isset($pval['nName']))          $options[$ii]['nName'] = trim($pval['nName']);
        if (isset($pval['uPass']))    $options[$ii]['rdPass'] = 'n5g9a'.nsx_doEncode($pval['uPass']); else $options[$ii]['rdPass'] = '';  
        
        if (empty($options[$ii]['rdSubRedditsList'])) { $pass = substr($options[$ii]['rdPass'], 0, 5)=='n5g9a'?nsx_doDecode(substr($options[$ii]['rdPass'], 5)):$options[$ii]['rdPass'];
           $loginInfo = doConnectToRD($options[$ii]['rdUName'], $pass); if (is_array($loginInfo))  { 
               $options[$ii]['rdSubRedditsList'] = doGetSubredditsFromRD();
           }  
        }
        if (isset($pval['rdSubReddit'])) $options[$ii]['rdSubReddit'] = trim($pval['rdSubReddit']);          
        if (isset($pval['postType']))   $options[$ii]['postType'] = $pval['postType'];         
        if (isset($pval['rdTitleFormat'])) $options[$ii]['rdTitleFormat'] = trim($pval['rdTitleFormat']);
        if (isset($pval['rdTextFormat'])) $options[$ii]['rdTextFormat'] = trim($pval['rdTextFormat']);
        
        if (isset($pval['apDoRD']))      $options[$ii]['doRD'] = $pval['apDoRD']; else $options[$ii]['doRD'] = 0; 
        
        $options[$ii] = nxs_adjRpst($options[$ii], $pval);    $options[$ii] = nxs_adjFilters($pval, $options[$ii]);            
        
        if (isset($pval['delayDays'])) $options[$ii]['nDays'] = trim($pval['delayDays']);
        if (isset($pval['delayHrs'])) $options[$ii]['nHrs'] = trim($pval['delayHrs']); if (isset($pval['delayMin'])) $options[$ii]['nMin'] = trim($pval['delayMin']); 
        if (isset($pval['qTLng'])) $options[$ii]['qTLng'] = trim($pval['qTLng']); 
      } elseif ( count($pval)==1 ) if (isset($pval['apDo'.$code])) $options[$ii]['do'.$code] = $pval['apDo'.$code]; else $options[$ii]['do'.$code] = 0; 
    } return $options;
  }  
  //#### Show Post->Edit Meta Box Settings
  function showEdPostNTSettings($ntOpts, $post){global $nxs_plurl; $post_id = $post->ID; $nt = 'rd'; $ntU = 'RD'; 
     foreach($ntOpts as $ii=>$ntOpt)  { $pMeta = maybe_unserialize(get_post_meta($post_id, 'snapRD', true));  if (!empty($pMeta) && is_array($pMeta)) $ntOpt = $this->adjMetaOpt($ntOpt, $pMeta[$ii]); 
        $isAvailRD =  $ntOpt['rdUName']!='' && $ntOpt['rdPass']!=''; $rdMsgFormat = htmlentities($ntOpt['rdTextFormat'], ENT_COMPAT, "UTF-8"); $rdMsgTFormat = htmlentities($ntOpt['rdTitleFormat'], ENT_COMPAT, "UTF-8"); $rdPostType = $ntOpt['postType'];
      ?>  
      <tr><th style="text-align:left;" colspan="2">
      
      
      <?php if ($isAvailRD) { $ntOpt = nxs_FltrsV3toV4($ntOpt); if (!isset($ntOpt['do'])) $ntOpt['do'] = $ntOpt['do'.$ntU]; ?>
      <?php  if ($post->post_status != "publish" && (int)$ntOpt['do']>0 && !empty($ntOpt['fltrsOn']) && $ntOpt['fltrsOn']=='1'){ ?>
       <input type="radio" id="rbtn<?php echo $ntU.$ii; ?>" value="2" name="<?php echo $nt; ?>[<?php echo $ii; ?>][do]" checked="checked" class="nxsGrpDoChb" /> <?php } 
      else { ?>
         <input class="nxsGrpDoChb" value="1" id="do<?php echo $ntU.$ii; ?>" <?php if ($post->post_status == "publish") echo 'disabled="disabled"';?> type="checkbox" name="<?php echo $nt; ?>[<?php echo $ii; ?>][do]" <?php if ((int)$ntOpt['do'] > 0) echo 'checked="checked" title="def"';  ?> /> 
      <?php }
      if ($post->post_status == "publish") { ?> <input type="hidden" name="<?php echo $nt; ?>[<?php echo $ii; ?>][do]" value="<?php echo $ntOpt['do'];?>"> <?php } ?> 
    <?php } ?>
      <div class="nsx_iconedTitle" style="display: inline; font-size: 13px; background-image: url(<?php echo $nxs_plurl; ?>img/rd16.png);">Reddit - <?php _e('publish to', 'social-networks-auto-poster-facebook-twitter-g') ?> (<i style="color: #005800;"><?php echo $ntOpt['nName']; ?></i>)</div></th> <td><?php //## Only show RePost button if the post is "published"
                    if ($post->post_status == "publish" && $isAvailRD) { ?><?php $ntName = $this->ntInfo['name']; ?>
                    <input alt="<?php echo $ii; ?>" style="float: right;" onmouseout="hidePopShAtt('SV');" onmouseover="showPopShAtt('SV', event);" onclick="return false;" data-ntname="<?php echo $ntName; ?>" type="button" class="button manualPostBtn" name="<?php echo $nt."-".$post->ID; ?>" value="<?php _e('Post to ', 'social-networks-auto-poster-facebook-twitter-g'); echo $ntName; ?>" />
                    <?php } ?>
                    
                    <?php  if (is_array($pMeta) && is_array($pMeta[$ii]) && isset($pMeta[$ii]['pgID']) ) { 
                        
                        ?> <span id="pstdRD<?php echo $ii; ?>" style="float: right;padding-top: 4px; padding-right: 10px;">
                      <a style="font-size: 10px;" href="<?php echo $pMeta[$ii]['pgID']; ?>" target="_blank"><?php $nType="Reddit"; printf( __( 'Posted on', 'social-networks-auto-poster-facebook-twitter-g' ), $nType); ?>  <?php echo (isset($pMeta[$ii]['pDate']) && $pMeta[$ii]['pDate']!='')?(" (".$pMeta[$ii]['pDate'].")"):""; ?></a>
                    </span><?php } ?>
                    
                </td></tr>                
                
                <?php if (!$isAvailRD) { ?><tr><th scope="row" style="text-align:right; width:150px; padding-top: 5px; padding-right:10px;"></th> <td><b>Setup your Reddit Account to AutoPost to Reddit</b></td></tr>
                <?php } else { if ($post->post_status != "publish" && function_exists('nxs_doSMAS5') ) { $ntOpt['postTime'] = get_post_time('U', false, $post_id); nxs_doSMAS5($nt, $ii, $ntOpt); } ?>
                
                <?php if ($ntOpt['rpstOn']=='1') { ?> 
                
                <tr id="altFormat1" style=""><th scope="row" class="nxsTHRow">
                <input value="0"  type="hidden" name="<?php echo $nt; ?>[<?php echo $ii; ?>][rpstPostIncl]"/><input value="nxsi<?php echo $ii; ?>rd" type="checkbox" name="<?php echo $nt; ?>[<?php echo $ii; ?>][rpstPostIncl]"  <?php if (!empty($ntOpt['rpstPostIncl'])) echo "checked"; ?> />
                </th>
                <td> <?php _e('Include in "Auto-Reposting" to this network.', 'social-networks-auto-poster-facebook-twitter-g') ?>                
                </td></tr> <?php } ?>
                
                
       <tr id="altFormat1" style=""><th scope="row" style="vertical-align:top; padding-top: 6px; text-align:right; width:60px; padding-right:10px;"><?php _e('Title Format:', 'social-networks-auto-poster-facebook-twitter-g') ?></th>
        <td><input value="<?php echo $rdMsgTFormat ?>" type="text" name="rd[<?php echo $ii; ?>][SNAPformatT]" style="width:60%;max-width: 610px;" onfocus="jQuery('.nxs_FRMTHint').hide();mxs_showFrmtInfo('apRDMsgTFrmt<?php echo $ii; ?>');"/><?php nxs_doShowHint("apRDMsgTFrmt".$ii, '', '58'); ?></td></tr>  
                
       <tr><th scope="row" style="text-align:right; width:150px; vertical-align:top; padding-top: 0px; padding-right:10px;"> <?php _e('Post Type:', 'social-networks-auto-poster-facebook-twitter-g') ?> </th><td>             
        <input type="radio" name="rd[<?php echo $ii; ?>][postType]" value="A" <?php if ( !isset($rdPostType) || $rdPostType == '' || $rdPostType == 'A') echo 'checked="checked"'; ?> /><?php _e('Link Post', 'social-networks-auto-poster-facebook-twitter-g') ?>
        <br/>
      <input type="radio" name="rd[<?php echo $ii; ?>][postType]" value="T" <?php if ($rdPostType == 'T') echo 'checked="checked"'; ?> /> <?php _e('Text Post', 'social-networks-auto-poster-facebook-twitter-g') ?><br/>               
     </td></tr>
     
                <tr id="altFormat1" style=""><th scope="row" style="vertical-align:top;  padding-top: 6px; text-align:right; width:60px; padding-right:10px;"><?php _e('Text Format:', 'social-networks-auto-poster-facebook-twitter-g') ?></th><td>                
                
                <textarea cols="150" rows="1" id="rd<?php echo $ii; ?>SNAPformat" name="rd[<?php echo $ii; ?>][SNAPformat]"  style="width:60%;max-width: 610px;" onfocus="jQuery('#rd<?php echo $ii; ?>SNAPformat').attr('rows', 4); jQuery('.nxs_FRMTHint').hide();mxs_showFrmtInfo('apRDMsgFrmt<?php echo $ii; ?>');"><?php echo $rdMsgFormat ?></textarea>                
                
                </td></tr>
           <?php } 
     }
  }
  //#### Save Meta Tags to the Post
  function adjMetaOpt($optMt, $pMeta){ if (isset($pMeta['isPosted'])) $optMt['isPosted'] = $pMeta['isPosted']; else  $optMt['isPosted'] = ''; 
    if (isset($pMeta['SNAPformat'])) $optMt['rdTextFormat'] = $pMeta['SNAPformat'];  if (isset($pMeta['SNAPformatT'])) $optMt['rdTitleFormat'] = $pMeta['SNAPformatT'];  
    if (isset($pMeta['imgToUse'])) $optMt['imgToUse'] = $pMeta['imgToUse']; 
    if (isset($pMeta['timeToRun']))  $optMt['timeToRun'] = $pMeta['timeToRun'];  if (isset($pMeta['rpstPostIncl']))  $optMt['rpstPostIncl'] = $pMeta['rpstPostIncl'];    
    if (isset($pMeta['postType'])) $optMt['postType'] = $pMeta['postType'];
    if (isset($pMeta['do'])) $optMt['do'] = $pMeta['do']; else $optMt['do'] = 0; if (isset($pMeta['doRD'])) $optMt['doRD'] = $pMeta['doRD']; else { if (isset($pMeta['SNAPformat'])) $optMt['doRD'] = 0; } 
    if (isset($pMeta['SNAPincludeRD']) && $pMeta['SNAPincludeRD'] == '1' ) $optMt['doRD'] = 1;  
    return $optMt;
  }  
}}
if (!function_exists("nxs_rePostToRD_ajax")) {
  function nxs_rePostToRD_ajax() { check_ajax_referer('nxsSsPageWPN');  $postID = $_POST['id']; global $plgn_NS_SNAutoPoster;  if (!isset($plgn_NS_SNAutoPoster)) return; $options = $plgn_NS_SNAutoPoster->nxs_options; 
    foreach ($options['rd'] as $ii=>$two) if ($ii==$_POST['nid']) {   $two['ii'] = $ii; $two['pType'] = 'aj'; //if ($two['rdPageID'].$two['rdUName']==$_POST['nid']) {  
      $rdpo =  get_post_meta($postID, 'snapRD', true); $rdpo =  maybe_unserialize($rdpo);// prr($rdpo);
      if (is_array($rdpo) && isset($rdpo[$ii]) && is_array($rdpo[$ii])){ $ntClInst = new nxs_snapClassRD(); $two = $ntClInst->adjMetaOpt($two, $rdpo[$ii]); } 
      $result = nxs_doPublishToRD($postID, $two); if ($result == 200) die("Successfully sent your post to Reddit."); else die($result);        
    }    
  }
}  
if (!function_exists("nxs_doPublishToRD")) { //## Second Function to Post to RD
  function nxs_doPublishToRD($postID, $options){ $ntCd = 'RD'; $ntCdL = 'rd'; $ntNm = 'Reddit'; if (!is_array($options)) $options = maybe_unserialize(get_post_meta($postID, $options, true));       
      $ii = $options['ii']; if (!isset($options['pType'])) $options['pType'] = 'im'; if ($options['pType']=='sh') sleep(rand(1, 10)); 
      $logNT = '<span style="color:#800000">Reddit</span> - '.$options['nName'];      
      $snap_ap = get_post_meta($postID, 'snap'.$ntCd, true); $snap_ap = maybe_unserialize($snap_ap);     
      $addParams = nxs_makeURLParams(array('NTNAME'=>$ntNm, 'NTCODE'=>$ntCd, 'POSTID'=>$postID, 'ACCNAME'=>$options['nName'])); 
      if ($options['pType']!='aj' && is_array($snap_ap) && (nxs_chArrVar($snap_ap[$ii], 'isPosted', '1') || nxs_chArrVar($snap_ap[$ii], 'isPrePosted', '1'))) {
        $snap_isAutoPosted = get_post_meta($postID, 'snap_isAutoPosted', true); if ($snap_isAutoPosted!='2') {  
           nxs_addToLogN('W', 'Notice', $logNT, '-=Duplicate=- Post ID:'.$postID, 'Already posted. No reason for posting duplicate'.' |'); return;
        }
      }       
      $message = array('message'=>'', 'link'=>'', 'imageURL'=>'', 'videoURL'=>''); 
      
      if ($postID=='0') { echo "Testing ... <br/><br/>"; $message['description'] = 'Test Post, Description';  $message['title'] = 'Test Post - Title';  $message['url'] = home_url();    
      } else { nxs_metaMarkAsPosted($postID, $ntCd, $options['ii'], array('isPrePosted'=>'1'));  $post = get_post($postID); if(!$post) return; 
        $rdPostType = $options['postType']; 
        $options['rdTitleFormat'] = nsFormatMessage($options['rdTitleFormat'], $postID);  $options['rdTextFormat'] = nsFormatMessage($options['rdTextFormat'], $postID); // prr($msg); echo $postID;
        $extInfo = ' | PostID: '.$postID." - ".$post->post_title; $options['forceSURL'] = '';
        $options = nxs_getURL($options, $postID, $addParams); $urlToGo = $options['urlToUse'];     
        $message = array('message'=>$options['rdTextFormat'], 'url'=>$urlToGo, 'title'=>$options['rdTitleFormat']);
      }            
      //## Actual Post
      $ntToPost = new nxs_class_SNAP_RD(); $ret = $ntToPost->doPostToNT($options, $message); // echo "~~~"; prr($ret); echo "+++";
      //## Process Results
      if (!is_array($ret) || $ret['isPosted']!='1') { //## Error 
         if ($postID=='0') prr($ret); nxs_addToLogN('E', 'Error', $logNT, '-=ERROR=- '.print_r($ret, true), $extInfo); 
      } else {  // ## All Good - log it.
        if ($postID=='0')  { nxs_addToLogN('S', 'Test', $logNT, 'OK - TEST Message Posted '); echo _e('OK - Message Posted, please see your '.$logNT.' Page. ', 'social-networks-auto-poster-facebook-twitter-g'); } 
          else  { nxs_metaMarkAsPosted($postID, $ntCd, $options['ii'], array('isPosted'=>'1', 'pgID'=>$ret['postID'], 'pDate'=>date('Y-m-d H:i:s'))); 
          $extInfo .= ' | <a href="'.$ret['postURL'].'" target="_blank">Post Link</a>'; nxs_addToLogN('S', 'Posted', $logNT, 'OK - Message Posted ', $extInfo); }
      }
      //## Return Result
      if ($ret['isPosted']=='1') return 200; else return print_r($ret, true);      
      
  } 
}  
?>