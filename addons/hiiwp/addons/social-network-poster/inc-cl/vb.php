<?php   
//## NextScripts Facebook Connection Class
$nxs_snapAvNts[] = array('code'=>'VB', 'lcode'=>'vb', 'name'=>'vBulletin');

if (!class_exists("nxs_snapClassVB")) { class nxs_snapClassVB {var $ntInfo = array('code'=>'VB', 'lcode'=>'vb', 'name'=>'vBulletin', 'defNName'=>'vbUName', 'tstReq' => false);
  //#### Show Common Settings
  function showGenNTSettings($ntOpts){  global $nxs_plurl; $ntInfo = array('code'=>'VB', 'lcode'=>'vb', 'name'=>'vBulletin', 'defNName'=>'vbUName', 'tstReq' => false); 
    $ntParams = array('ntInfo'=>$ntInfo, 'nxs_plurl'=>$nxs_plurl, 'ntOpts'=>$ntOpts, 'chkField'=>''); nxs_showListRow($ntParams);  
  }  
  //#### Show NEW Settings Page
  function showNewNTSettings($mgpo){ $options = array('nName'=>'', 'doVB'=>'1', 'vbUName'=>'', 'vbInclTags'=>'1', 'vbAttch'=>'', 'vbURL'=>'', 'vbPass'=>''); $options['ntInfo']= array('lcode'=>'vb'); $this->showNTSettings($mgpo, $options, true);}
  
  
  //#### Show Unit  Settings
  function showNTSettings($ii, $options, $isNew=false){  global $nxs_plurl; $nt = $options['ntInfo']['lcode']; $ntU = strtoupper($nt); 
    if (!isset($options['nHrs'])) $options['nHrs'] = 0; if (!isset($options['nMin'])) $options['nMin'] = 0;   
    if (!isset($options['nDays'])) $options['nDays'] = 0; if (!isset($options['qTLng'])) $options['qTLng'] = '';  ?>
            <div id="doVB<?php echo $ii; ?>Div" class="insOneDiv<?php if ($isNew) echo " clNewNTSets"; ?>">     <input type="hidden" name="apDoSVB<?php echo $ii; ?>" value="0" id="apDoSVB<?php echo $ii; ?>" />          
            
             <div class="nsx_iconedTitle" style="float: right; background-image: url(<?php echo $nxs_plurl; ?>img/vb16.png);"><a style="font-size: 12px;" target="_blank"  href="http://www.nextscripts.com/setup-installation-vbulletin-social-networks-auto-poster-wordpress/"><?php $nType="vBulletin"; printf( __( 'Detailed %s Installation/Configuration Instructions', 'social-networks-auto-poster-facebook-twitter-g' ), $nType); ?></a></div>
            
            <div style="width:100%;"><strong><?php _e('Account Nickname', 'social-networks-auto-poster-facebook-twitter-g'); ?>:</strong> <i><?php _e('Just so you can easily identify it', 'social-networks-auto-poster-facebook-twitter-g'); ?></i> </div><input name="vb[<?php echo $ii; ?>][nName]" id="vbnName<?php echo $ii; ?>" style="font-weight: bold; color: #005800; border: 1px solid #ACACAC; width: 40%;" value="<?php _e(apply_filters('format_to_edit', htmlentities($options['nName'], ENT_COMPAT, "UTF-8")), 'social-networks-auto-poster-facebook-twitter-g') ?>" /><br/>
            <?php echo nxs_addQTranslSel('vb', $ii, $options['qTLng']); ?>
            
              <br/>
    <ul class="nsx_tabs">
    <li><a href="#nsx<?php echo $nt.$ii ?>_tab1"><?php _e('Account Info', 'social-networks-auto-poster-facebook-twitter-g'); ?></a></li>    
    <?php if (!$isNew) { ?>  <li><a href="#nsx<?php echo $nt.$ii ?>_tab2"><?php _e('Advanced', 'social-networks-auto-poster-facebook-twitter-g'); ?></a></li>  <?php } ?>
    </ul>
    <div class="nsx_tab_container"><?php /* ######################## Account Tab ####################### */ ?>
    <div id="nsx<?php echo $nt.$ii ?>_tab1" class="nsx_tab_content" style="background-image: url(<?php echo $nxs_plurl; ?>img/<?php echo $nt; ?>-bg.png); background-repeat: no-repeat;  background-position:90% 10%;">
    
            
            <div id="altFormat" style="">
  <div style="width:100%;"><strong id="altFormatText">vBulletin URL:</strong> <span style="font-size: 11px; margin: 0px;">Could be Forum URL or Thread URL. Either new thread of new post will be created.</span></div>
                <input name="vb[<?php echo $ii; ?>][apVBURL]" id="apVBURL" style="width: 60%;" value="<?php _e(apply_filters('format_to_edit', htmlentities($options['vbURL'], ENT_COMPAT, "UTF-8")), 'social-networks-auto-poster-facebook-twitter-g') ?>" />  <br/> 
            
            </div>   
            
            <div style="width:100%;"><strong>vBulletin Username:</strong> </div><input name="vb[<?php echo $ii; ?>][apVBUName]" id="apVBUName" style="width: 30%;" value="<?php _e(apply_filters('format_to_edit', htmlentities($options['vbUName'], ENT_COMPAT, "UTF-8")), 'social-networks-auto-poster-facebook-twitter-g') ?>" />                
            <div style="width:100%;"><strong>vBulletin Password:</strong> </div><input autocomplete="false" readonly onfocus="this.removeAttribute('readonly');" name="vb[<?php echo $ii; ?>][apVBPass]" id="apVBPass" type="password" style="width: 30%;" value="<?php _e(apply_filters('format_to_edit', htmlentities(substr($options['vbPass'], 0, 5)=='n5g9a'?nsx_doDecode(substr($options['vbPass'], 5)):$options['vbPass'], ENT_COMPAT, "UTF-8")), 'social-networks-auto-poster-facebook-twitter-g') ?>" />  <br/>                
            
            <?php if ($isNew) { ?> <input type="hidden" name="vb[<?php echo $ii; ?>][apDoVB]" value="1" id="apDoNewVB<?php echo $ii; ?>" /> <?php } ?>
            <br/>            
            
            
            
            <p style="margin-bottom: 20px;margin-top: 5px;"><input value="1"  id="vbInclTags" type="checkbox" name="vb[<?php echo $ii; ?>][vbInclTags]"  <?php if ((int)$options['vbInclTags'] == 1) echo "checked"; ?> /> 
              <strong>Post with tags</strong> Tags from the blogpost will be auto posted to vBulletin                                
            </p>
            
            <div id="altFormat" style="">
  <div style="width:100%;"><strong id="altFormatText"><?php _e('Post Title Format', 'social-networks-auto-poster-facebook-twitter-g'); ?></strong> (<a href="#" id="apVBMsgTFrmt<?php echo $ii; ?>HintInfo" onclick="mxs_showHideFrmtInfo('apVBMsgTFrmt<?php echo $ii; ?>'); return false;"><?php _e('Show format info', 'social-networks-auto-poster-facebook-twitter-g'); ?></a>)</div>
                           
              <textarea cols="150" rows="3" id="vb<?php echo $ii; ?>SNAPformat" name="vb[<?php echo $ii; ?>][apVBMsgTFrmt]" style="width:51%;max-width: 650px;" onfocus="jQuery('#vb<?php echo $ii; ?>SNAPformat').attr('rows', 6); mxs_showFrmtInfo('apVBMsgTFrmt<?php echo $ii; ?>');"><?php if ($isNew) echo "%TITLE%"; else _e(apply_filters('format_to_edit', htmlentities($options['vbMsgTFormat'], ENT_COMPAT, "UTF-8")), 'social-networks-auto-poster-facebook-twitter-g'); ?></textarea>                            
              
              <?php nxs_doShowHint("apVBMsgTFrmt".$ii); ?>
              </div><br/> 
            
            <div id="altFormat" style="">
  <div style="width:100%;"><strong id="altFormatText"><?php _e('Post Text Format', 'social-networks-auto-poster-facebook-twitter-g'); ?></strong> (<a href="#" id="apVBMsgFrmt<?php echo $ii; ?>HintInfo" onclick="mxs_showHideFrmtInfo('apVBMsgFrmt<?php echo $ii; ?>'); return false;"><?php _e('Show format info', 'social-networks-auto-poster-facebook-twitter-g'); ?></a>)</div>
              <input name="vb[<?php echo $ii; ?>][apVBMsgFrmt]" id="apVBMsgFrmt" style="width: 50%;" value="<?php if ($isNew) echo "%EXCERPT%"; else _e(apply_filters('format_to_edit', htmlentities($options['vbMsgFormat'], ENT_COMPAT, "UTF-8")), 'social-networks-auto-poster-facebook-twitter-g'); ?>"  onfocus="mxs_showFrmtInfo('apVBMsgFrmt<?php echo $ii; ?>');" /><?php nxs_doShowHint("apVBMsgFrmt".$ii); ?>
            </div><br/>    
            
            <?php if ($options['vbPass']!='') { ?>
            
            <b><?php _e('Test your settings', 'social-networks-auto-poster-facebook-twitter-g'); ?>:</b>&nbsp;&nbsp;&nbsp; <a href="#" class="NXSButton" onclick="testPost('VB', '<?php echo $ii; ?>'); return false;"><?php printf( __( 'Submit Test Post to %s', 'social-networks-auto-poster-facebook-twitter-g' ), $nType); ?></a>      
               
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
  function setNTSettings($post, $options){ $code = 'VB'; $lcode = 'vb'; 
    foreach ($post as $ii => $pval){       
      if (!empty($pval['apVBUName']) && !empty($pval['apVBPass'])){ if (!isset($options[$ii])) $options[$ii] = array();
        if (isset($pval['apVBUName']))   $options[$ii]['vbUName'] = trim($pval['apVBUName']);
        if (isset($pval['nName']))          $options[$ii]['nName'] = trim($pval['nName']);
        if (isset($pval['apVBPass']))    $options[$ii]['vbPass'] = 'n5g9a'.nsx_doEncode($pval['apVBPass']); else $options[$ii]['vbPass'] = '';  
        if (isset($pval['apVBURL'])) $options[$ii]['vbURL'] = trim($pval['apVBURL']);                                                  
        
        if (isset($pval['vbInclTags']))     $options[$ii]['vbInclTags'] = $pval['vbInclTags']; else $options[$ii]['vbInclTags'] = 0;
        if (isset($pval['apVBMsgTFrmt'])) $options[$ii]['vbMsgTFormat'] = trim($pval['apVBMsgTFrmt']);
        if (isset($pval['apVBMsgFrmt'])) $options[$ii]['vbMsgFormat'] = trim($pval['apVBMsgFrmt']);
        
        
        
        
        if (isset($pval['apDoVB']))      $options[$ii]['doVB'] = $pval['apDoVB']; else $options[$ii]['doVB'] = 0; 
        
        $options[$ii] = nxs_adjRpst($options[$ii], $pval);       $options[$ii] = nxs_adjFilters($pval, $options[$ii]);   
        
        if (isset($pval['delayDays'])) $options[$ii]['nDays'] = trim($pval['delayDays']);
        if (isset($pval['delayHrs'])) $options[$ii]['nHrs'] = trim($pval['delayHrs']); if (isset($pval['delayMin'])) $options[$ii]['nMin'] = trim($pval['delayMin']); 
        if (isset($pval['qTLng'])) $options[$ii]['qTLng'] = trim($pval['qTLng']); 
      } elseif ( count($pval)==1 ) if (isset($pval['apDo'.$code])) $options[$ii]['do'.$code] = $pval['apDo'.$code]; else $options[$ii]['do'.$code] = 0; 
    } return $options;
  }  
  //#### Show Post->Edit Meta Box Settings
  function showEdPostNTSettings($ntOpts, $post){ global $nxs_plurl; $post_id = $post->ID; $nt = 'vb'; $ntU = 'VB';
     foreach($ntOpts as $ii=>$ntOpt)  { $pMeta = maybe_unserialize(get_post_meta($post_id, 'snapVB', true));   if (is_array($pMeta)) $ntOpt = $this->adjMetaOpt($ntOpt, $pMeta[$ii]); 
        $isAvailVB =  $ntOpt['vbUName']!='' && $ntOpt['vbPass']!=''; $vbMsgFormat = htmlentities($ntOpt['vbMsgFormat'], ENT_COMPAT, "UTF-8"); $vbMsgTFormat = htmlentities($ntOpt['vbMsgTFormat'], ENT_COMPAT, "UTF-8");      
      ?>  
      <tr><th style="text-align:left;" colspan="2">
      
      
      <?php if ($isAvailVB) { $ntOpt = nxs_FltrsV3toV4($ntOpt); if (!isset($ntOpt['do'])) $ntOpt['do'] = $ntOpt['do'.$ntU]; ?>
      <?php  if ($post->post_status != "publish" && (int)$ntOpt['do']>0 && !empty($ntOpt['fltrsOn']) && $ntOpt['fltrsOn']=='1'){ ?>
       <input type="radio" id="rbtn<?php echo $ntU.$ii; ?>" value="2" name="<?php echo $nt; ?>[<?php echo $ii; ?>][do]" checked="checked" class="nxsGrpDoChb" /> <?php } 
      else { ?>
         <input class="nxsGrpDoChb" value="1" id="do<?php echo $ntU.$ii; ?>" <?php if ($post->post_status == "publish") echo 'disabled="disabled"';?> type="checkbox" name="<?php echo $nt; ?>[<?php echo $ii; ?>][do]" <?php if ((int)$ntOpt['do'] > 0) echo 'checked="checked" title="def"';  ?> /> 
      <?php }
      if ($post->post_status == "publish") { ?> <input type="hidden" name="<?php echo $nt; ?>[<?php echo $ii; ?>][do]" value="<?php echo $ntOpt['do'];?>"> <?php } ?> 
    <?php } ?>
      <div class="nsx_iconedTitle" style="display: inline; font-size: 13px; background-image: url(<?php echo $nxs_plurl; ?>img/vb16.png);">vBulletin - <?php _e('publish to', 'social-networks-auto-poster-facebook-twitter-g') ?> (<i style="color: #005800;"><?php echo $ntOpt['nName']; ?></i>)</div></th> <td><?php //## Only show RePost button if the post is "published"
                    if ($post->post_status == "publish" && $isAvailVB) { ?><?php $ntName = $this->ntInfo['name']; ?>
                    <input alt="<?php echo $ii; ?>" style="float: right;" onmouseout="hidePopShAtt('SV');" onmouseover="showPopShAtt('SV', event);" onclick="return false;" data-ntname="<?php echo $ntName; ?>" type="button" class="button manualPostBtn" name="<?php echo $nt."-".$post->ID; ?>" value="<?php _e('Post to ', 'social-networks-auto-poster-facebook-twitter-g'); echo $ntName; ?>" />
                    <?php } ?>
                    
                    <?php  if (is_array($pMeta) && is_array($pMeta[$ii]) && isset($pMeta[$ii]['pgID']) ) { $wpURL = str_ireplace('/xmlrpc.php', '', $ntOpt['vbURL']);
                        if (substr($wpURL, -1)=='/') $wpURL = substr($wpURL, 0, -1);  $wpURL = $wpURL."/";
                        ?> <span id="pstdVB<?php echo $ii; ?>" style="float: right;padding-top: 4px; padding-right: 10px;">
          <a style="font-size: 10px;" href="<?php echo $pMeta[$ii]['pgID']; ?>" target="_blank"><?php $nType="vBulletin"; printf( __( 'Posted on', 'social-networks-auto-poster-facebook-twitter-g' ), $nType); ?>  <?php echo (isset($pMeta[$ii]['pDate']) && $pMeta[$ii]['pDate']!='')?(" (".$pMeta[$ii]['pDate'].")"):""; ?></a>
                    </span><?php } ?>
                    
                </td></tr>                
                
                <?php if (!$isAvailVB) { ?><tr><th scope="row" style="text-align:right; width:150px; padding-top: 5px; padding-right:10px;"></th> <td><b>Setup your vBulletin Account to AutoPost to vBulletin</b>
                <?php } else { if ($post->post_status != "publish" && function_exists('nxs_doSMAS5') ) { $ntOpt['postTime'] = get_post_time('U', false, $post_id); nxs_doSMAS5($nt, $ii, $ntOpt); } ?>
                
                <?php if ($ntOpt['rpstOn']=='1') { ?> 
                
                <tr id="altFormat1" style=""><th scope="row" class="nxsTHRow">
                <input value="0"  type="hidden" name="<?php echo $nt; ?>[<?php echo $ii; ?>][rpstPostIncl]"/><input value="nxsi<?php echo $ii; ?>vb" type="checkbox" name="<?php echo $nt; ?>[<?php echo $ii; ?>][rpstPostIncl]"  <?php if (!empty($ntOpt['rpstPostIncl'])) echo "checked"; ?> />
                </th>
                <td> <?php _e('Include in "Auto-Reposting" to this network.', 'social-networks-auto-poster-facebook-twitter-g') ?>                
                </td></tr> <?php } ?>
               
       <tr id="altFormat1" style=""><th scope="row" class="nxsTHRow"><?php _e('Text Format:', 'social-networks-auto-poster-facebook-twitter-g') ?></th>
        <td><input value="<?php echo $vbMsgTFormat ?>" type="text" name="vb[<?php echo $ii; ?>][SNAPformatT]"  style="width:60%;max-width: 610px;" onfocus="jQuery('.nxs_FRMTHint').hide();mxs_showFrmtInfo('apVBMsgTFrmt<?php echo $ii; ?>');"/><?php nxs_doShowHint("apVBMsgTFrmt".$ii); ?></td></tr>
                
      <tr id="altFormat1" style=""><th scope="row" class="nxsTHRow"><?php _e('Text Format:', 'social-networks-auto-poster-facebook-twitter-g') ?></th>
        <td>        
        <textarea cols="150" rows="1" id="vb<?php echo $ii; ?>SNAPformat" name="vb[<?php echo $ii; ?>][SNAPformat]"  style="width:60%;max-width: 610px;" onfocus="jQuery('#vb<?php echo $ii; ?>SNAPformat').attr('rows', 4); jQuery('.nxs_FRMTHint').hide();mxs_showFrmtInfo('apVBMsgFrmt<?php echo $ii; ?>');"><?php echo $vbMsgFormat; ?></textarea>
        <?php nxs_doShowHint("apVBMsgFrmt".$ii); ?></td></tr>
                <?php } 
     }
  }
  //#### Save Meta Tags to the Post
  function adjMetaOpt($optMt, $pMeta){  if (isset($pMeta['isPosted'])) $optMt['isPosted'] = $pMeta['isPosted']; else  $optMt['isPosted'] = '';
     if (isset($pMeta['SNAPformat'])) $optMt['vbMsgFormat'] = $pMeta['SNAPformat']; 
     if (isset($pMeta['SNAPformatT'])) $optMt['vbMsgTFormat'] = $pMeta['SNAPformatT'];
     if (isset($pMeta['imgToUse'])) $optMt['imgToUse'] = $pMeta['imgToUse'];      
     if (isset($pMeta['timeToRun']))  $optMt['timeToRun'] = $pMeta['timeToRun'];  if (isset($pMeta['rpstPostIncl']))  $optMt['rpstPostIncl'] = $pMeta['rpstPostIncl'];    
     if (isset($pMeta['do'])) $optMt['do'] = $pMeta['do']; else $optMt['do'] = 0; if (isset($pMeta['doVB'])) $optMt['doVB'] = $pMeta['doVB']; else { if (isset($pMeta['SNAPformat'])) $optMt['doVB'] = 0; } 
     if (isset($pMeta['SNAPincludeVB']) && $pMeta['SNAPincludeVB'] == '1' ) $optMt['doVB'] = 1;  
     return $optMt;
  }  
}}
if (!function_exists("nxs_rePostToVB_ajax")) {
  function nxs_rePostToVB_ajax() { check_ajax_referer('nxsSsPageWPN');  $postID = $_POST['id']; $options = get_option('NS_SNAutoPoster');  
    foreach ($options['vb'] as $ii=>$two) if ($ii==$_POST['nid']) {   $two['ii'] = $ii; $two['pType'] = 'aj'; //if ($two['gpPageID'].$two['gpUName']==$_POST['nid']) {  
      $gppo =  get_post_meta($postID, 'snapVB', true); $gppo =  maybe_unserialize($gppo);// prr($gppo);
      if (is_array($gppo) && isset($gppo[$ii]) && is_array($gppo[$ii])){ $ntClInst = new nxs_snapClassVB(); $two = $ntClInst->adjMetaOpt($two, $gppo[$ii]); }
      $result = nxs_doPublishToVB($postID, $two); if ($result == 200) die("Successfully sent your post to vBulletin."); else die($result);        
    }    
  }
}  

if (!function_exists("nxs_doPublishToVB")) { //## Second Function to Post to VB
  function nxs_doPublishToVB($postID, $options){ global $nxs_vbCkArray, $plgn_NS_SNAutoPoster; $ntCd = 'VB'; $ntCdL = 'vb'; $ntNm = 'vBulletin';
    if (!is_array($options)) $options = maybe_unserialize(get_post_meta($postID, $options, true));
    //if (isset($options['timeToRun'])) wp_unschedule_event( $options['timeToRun'], 'nxs_doPublishToVB',  array($postID, $options));  
    $blogTitle = htmlspecialchars_decode(get_bloginfo('name'), ENT_QUOTES); if ($blogTitle=='') $blogTitle = home_url(); 
    $addParams = nxs_makeURLParams(array('NTNAME'=>$ntNm, 'NTCODE'=>$ntCd, 'POSTID'=>$postID, 'ACCNAME'=>$options['nName']));
    
    $ii = $options['ii']; if (!isset($options['pType'])) $options['pType'] = 'im'; if ($options['pType']=='sh') sleep(rand(1, 10)); 
    $logNT = '<span style="color:#000080">vBulletin</span> - '.$options['nName'];      
    $snap_ap = get_post_meta($postID, 'snap'.$ntCd, true); $snap_ap = maybe_unserialize($snap_ap);     
    if ($options['pType']!='aj' && is_array($snap_ap) && (nxs_chArrVar($snap_ap[$ii], 'isPosted', '1') || nxs_chArrVar($snap_ap[$ii], 'isPrePosted', '1'))) {
        $snap_isAutoPosted = get_post_meta($postID, 'snap_isAutoPosted', true); if ($snap_isAutoPosted!='2') {  sleep(5);
         nxs_addToLogN('W', 'Notice', $logNT, '-=Duplicate=- Post ID:'.$postID, 'Already posted. No reason for posting duplicate'.' |'.$uqID); return;
        }
    } 
  
      
      if ($postID=='0') { echo "Testing ... <br/><br/>"; $urlToGo = home_url(); $options['vbMsgFormat'] = 'Test Message from '.$urlToGo;  $options['vbMsgTFormat'] = 'Test Link from '.$urlToGo; } 
        else { $post = get_post($postID); nxs_metaMarkAsPosted($postID, $ntCd, $options['ii'], array('isPrePosted'=>'1')); 
          $options['vbMsgFormat'] = nsFormatMessage($options['vbMsgFormat'], $postID, $addParams); $options['vbMsgTFormat'] = nsFormatMessage($options['vbMsgTFormat'], $postID, $addParams);
          //## MyURL - URLToGo code
          if (!isset($options['urlToUse']) || trim($options['urlToUse'])=='') $myurl =  trim(get_post_meta($postID, 'snap_MYURL', true)); if ($myurl!='') $options['urlToUse'] = $myurl;
          if (isset($options['urlToUse']) && trim($options['urlToUse'])!='') { $urlToGo = $options['urlToUse']; $options['useFBGURLInfo'] = true; } else $urlToGo = get_permalink($postID);      
          $gOptions = $plgn_NS_SNAutoPoster->nxs_options; $addURLParams = trim($gOptions['addURLParams']);  if($addURLParams!='') $urlToGo .= (strpos($urlToGo,'?')!==false?'&':'?').$addURLParams;
      }
      $dusername = $options['vbUName']; //$link = urlencode($link); $desc = urlencode(substr($msg, 0, 500));      
      $extInfo = ' | PostID: '.$postID." - ".(!empty($post) && is_object($post)?$post->post_title:'');
      
      //## Message & Format                 
      if ($options['vbInclTags']=='1') { $t = wp_get_post_tags($postID); $tggs = array(); foreach ($t as $tagA) {$tggs[] = $tagA->name;} $tags = (implode(', ',$tggs)); /* $tags = str_replace(' ','+',$tags); */ } else $tags = '';
      $message = array('siteName'=>$blogTitle, 'tags'=>$tags);    
      //## Actual Post
      $ntToPost = new nxs_class_SNAP_VB(); $ret = $ntToPost->doPostToNT($options, $message);
      //## Save Session
      if (empty($options['vkSvC']) || serialize($nxs_vbCkArray)!=$options['vbSvC']) { global $plgn_NS_SNAutoPoster;  $gOptions = $plgn_NS_SNAutoPoster->nxs_options;
        if (isset($options['ii']) && $options['ii']!=='')  { $gOptions['vb'][$options['ii']]['vbSvC'] = serialize($nxs_vbCkArray); update_option('NS_SNAutoPoster', $gOptions);  }
        else foreach ($gOptions['vb'] as $ii=>$gpn) { $result = array_diff($options, $gpn); 
          if (!is_array($result) || count($result)<1) { $gOptions['vb'][$ii]['vbSvC'] = serialize($nxs_vbCkArray); update_option('NS_SNAutoPoster', $gOptions); break; }
        }        
      }
      //## Process Results
      if (!is_array($ret) || $ret['isPosted']!='1') { //## Error 
        if ($postID=='0') prr($ret); nxs_addToLogN('E', 'Error', $logNT, '-=ERROR=- '.print_r($ret, true), $extInfo); 
      } else {  // ## All Good - log it.
        if ($postID=='0')  { nxs_addToLogN('S', 'Test', $logNT, 'OK - TEST Message Posted '); echo _e('OK - Message Posted, please see your '.$logNT.' Page. ', 'social-networks-auto-poster-facebook-twitter-g'); } 
          else  { nxs_metaMarkAsPosted($postID, $ntCd, $options['ii'], array('isPosted'=>'1', 'pgID'=>$ret['postID'], 'pDate'=>date('Y-m-d H:i:s'))); nxs_addToLogN('S', 'Posted', $logNT, 'OK - Message Posted ', $extInfo); }
      }
      //## Return Result
      if (!empty($ret['isPosted']) && $ret['isPosted']=='1') return 200; else return print_r($ret, true); 
  }
}  
?>