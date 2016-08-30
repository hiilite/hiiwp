<?php    
//## NextScripts Facebook Connection Class
$nxs_snapAvNts[] = array('code'=>'LJ', 'lcode'=>'lj', 'name'=>'LiveJournal');

if (!class_exists("nxs_snapClassLJ")) { class nxs_snapClassLJ {var $ntInfo = array('code'=>'LJ', 'lcode'=>'lj', 'name'=>'LiveJournal', 'defNName'=>'', 'tstReq' => false);
  //#### Show Common Settings
  function showGenNTSettings($ntOpts){  global $nxs_plurl; $ntInfo = array('code'=>'LJ', 'lcode'=>'lj', 'name'=>'LiveJournal', 'defNName'=>'', 'tstReq' => false); 
    $ntParams = array('ntInfo'=>$ntInfo, 'nxs_plurl'=>$nxs_plurl, 'ntOpts'=>$ntOpts, 'chkField'=>''); nxs_showListRow($ntParams);  
  }   
  //#### Show NEW Settings Page
  function showNewNTSettings($mgpo){ $options = array('nName'=>'', 'doLJ'=>'1', 'ljUName'=>'', 'ljPageID'=>'', 'inclTags'=>'1', 'ljAttch'=>'', 'ljPass'=>'', 'ljURL'=>''); $options['ntInfo']= array('lcode'=>'lj'); $this->showNTSettings($mgpo, $options, true);}
  //#### Show Unit  Settings
  function showNTSettings($ii, $options, $isNew=false){ global $nxs_plurl; $nt = $options['ntInfo']['lcode']; $ntU = strtoupper($nt); 
    if (!isset($options['nHrs'])) $options['nHrs'] = 0; if (!isset($options['nMin'])) $options['nMin'] = 0;   
    if (!isset($options['nDays'])) $options['nDays'] = 0; if (!isset($options['qTLng'])) $options['qTLng'] = ''; if (!isset($options['commID'])) $options['commID'] = ''; ?>
            <div id="doLJ<?php echo $ii; ?>Div" class="insOneDiv<?php if ($isNew) echo " clNewNTSets"; ?>">     <input type="hidden" name="apDoSLJ<?php echo $ii; ?>" value="0" id="apDoSLJ<?php echo $ii; ?>" />
            
            <div class="nsx_iconedTitle" style="float: right; background-image: url(<?php echo $nxs_plurl; ?>img/lj16.png);"><a style="font-size: 12px;" target="_blank"  href="http://www.nextscripts.com/setup-installation-livejournal-social-networks-auto-poster-for-wordpress/"><?php $nType="LiveJournal"; printf( __( 'Detailed %s Installation/Configuration Instructions', 'social-networks-auto-poster-facebook-twitter-g' ), $nType); ?></a></div>            
            <?php if ($isNew){ ?> <br/><?php _e('You can setup LiveJournal blog.', 'social-networks-auto-poster-facebook-twitter-g'); ?><br/><br/> <?php } ?> 
            
            <div style="width:100%;"><strong><?php _e('Account Nickname', 'social-networks-auto-poster-facebook-twitter-g'); ?>:</strong> <i><?php _e('Just so you can easily identify it', 'social-networks-auto-poster-facebook-twitter-g'); ?></i> </div><input name="lj[<?php echo $ii; ?>][nName]" id="ljnName<?php echo $ii; ?>" style="font-weight: bold; color: #005800; border: 1px solid #ACACAC; width: 40%;" value="<?php _e(apply_filters('format_to_edit', htmlentities($options['nName'], ENT_COMPAT, "UTF-8")), 'social-networks-auto-poster-facebook-twitter-g') ?>" /><br/>
            <?php echo nxs_addQTranslSel('lj', $ii, $options['qTLng']); ?>
            
              <br/>
    <ul class="nsx_tabs">
    <li><a href="#nsx<?php echo $nt.$ii ?>_tab1"><?php _e('Account Info', 'social-networks-auto-poster-facebook-twitter-g'); ?></a></li>    
    <?php if (!$isNew) { ?>  <li><a href="#nsx<?php echo $nt.$ii ?>_tab2"><?php _e('Advanced', 'social-networks-auto-poster-facebook-twitter-g'); ?></a></li>  <?php } ?>
    </ul>
    <div class="nsx_tab_container"><?php /* ######################## Account Tab ####################### */ ?>
    <div id="nsx<?php echo $nt.$ii ?>_tab1" class="nsx_tab_content" style="background-image: url(<?php echo $nxs_plurl; ?>img/<?php echo $nt; ?>-bg.png); background-repeat: no-repeat;  background-position:90% 10%;">
    
    
            <div style="width:100%;"><br/><strong>LiveJournal Username:</strong> </div><input name="lj[<?php echo $ii; ?>][apLJUName]" id="apLJUName" style="width: 30%;" value="<?php _e(apply_filters('format_to_edit', htmlentities($options['ljUName'], ENT_COMPAT, "UTF-8")), 'social-networks-auto-poster-facebook-twitter-g') ?>" />                
            <div style="width:100%;"><strong>LiveJournal Password:</strong> </div><input autocomplete="false" readonly onfocus="this.removeAttribute('readonly');" name="lj[<?php echo $ii; ?>][apLJPass]" id="apLJPass" type="password" style="width: 30%;" value="<?php _e(apply_filters('format_to_edit', htmlentities(substr($options['ljPass'], 0, 5)=='n5g9a'?nsx_doDecode(substr($options['ljPass'], 5)):$options['ljPass'], ENT_COMPAT, "UTF-8")), 'social-networks-auto-poster-facebook-twitter-g') ?>" />  <br/>                
            
            <div style="width:100%;"><br/><strong>Blog/Community URL or ID:</strong> Please specify the Blog or Community URL or ID. <i>Use this only if you are posting NOT to your own journal. </i></div> 
            <input name="lj[<?php echo $ii; ?>][commID]" id="commID" style="width: 30%;" value="<?php _e(apply_filters('format_to_edit', htmlentities($options['commID'], ENT_COMPAT, "UTF-8")), 'social-networks-auto-poster-facebook-twitter-g') ?>" />                
            
            <div style="width:100%;"><br/><strong>Website:</strong> Please select your website. <i>SNAP could also post to other LJ Engine Based sites like DreamWidth.org </i></div> 
            
            <select id="lj1delayHrs" name="lj[<?php echo $ii; ?>][ljSrv]"><option  <?php if ( !isset($options['ljSrv']) || $options['ljSrv']=='' || $options['ljSrv']=='LJ') {?> selected="selected" <?php } ?> value="LJ">LiveJournal.com</option>
      <option <?php if ( isset($options['ljSrv']) && $options['ljSrv']=='DW') {?> selected="selected" <?php } ?> value="DW">DreamWidth.org</option>
      </select>            
            
            <br/>
            
            <?php if ($isNew) { ?> <input type="hidden" name="lj[<?php echo $ii; ?>][apDoLJ]" value="1" id="apDoNewLJ<?php echo $ii; ?>" /> <?php } ?>
            
            <br/><strong id="altFormatText"><?php _e('Post Title and Post Text Formats', 'social-networks-auto-poster-facebook-twitter-g'); ?></strong>               
            <div id="altFormat" style="">
              <div style="width:100%;"><strong id="altFormatText"><?php _e('Post Title Format', 'social-networks-auto-poster-facebook-twitter-g'); ?></strong> (<a href="#" id="apLJMsgTFrmt<?php echo $ii; ?>HintInfo" onclick="mxs_showHideFrmtInfo('apLJMsgTFrmt<?php echo $ii; ?>'); return false;"><?php _e('Show format info', 'social-networks-auto-poster-facebook-twitter-g'); ?></a>)               
              </div><input name="lj[<?php echo $ii; ?>][apLJMsgTFrmt]" id="apLJMsgTFrmt<?php echo $ii; ?>" style="width: 50%;" value="<?php if ($isNew) echo "%TITLE%"; else _e(apply_filters('format_to_edit', htmlentities($options['ljMsgTFormat'], ENT_COMPAT, "UTF-8")), 'social-networks-auto-poster-facebook-twitter-g'); ?>"  onfocus="mxs_showFrmtInfo('apLJMsgTFrmt<?php echo $ii; ?>');" /><?php nxs_doShowHint("apLJMsgTFrmt".$ii); ?>
            </div>            
            <div id="altFormat" style="">
              <div style="width:100%;"><strong id="altFormatText"><?php _e('Post Text Format', 'social-networks-auto-poster-facebook-twitter-g'); ?></strong> (<a href="#" id="apLJMsgFrmt<?php echo $ii; ?>HintInfo" onclick="mxs_showHideFrmtInfo('apLJMsgFrmt<?php echo $ii; ?>'); return false;"><?php _e('Show format info', 'social-networks-auto-poster-facebook-twitter-g'); ?></a>)               
              </div>
              
               <textarea cols="150" rows="3" id="lj<?php echo $ii; ?>SNAPformat" name="lj[<?php echo $ii; ?>][apLJMsgFrmt]" style="width:51%;max-width: 650px;" onfocus="jQuery('#lj<?php echo $ii; ?>SNAPformat').attr('rows', 6); mxs_showFrmtInfo('apLJMsgFrmt<?php echo $ii; ?>');"><?php if ($isNew) echo "%FULLTEXT%"; else _e(apply_filters('format_to_edit', htmlentities($options['ljMsgFormat'], ENT_COMPAT, "UTF-8")), 'social-networks-auto-poster-facebook-twitter-g'); ?></textarea>
              
              <?php nxs_doShowHint("apLJMsgFrmt".$ii); ?>
            </div>
            <p style="margin-bottom: 20px;margin-top: 5px;"><input value="1"  id="ljInclTags<?php echo $ii; ?>" type="checkbox" name="lj[<?php echo $ii; ?>][inclTags]"  <?php if ((int)$options['inclTags'] == 1) echo "checked"; ?> /> 
              <strong><?php _e('Post with tags.', 'social-networks-auto-poster-facebook-twitter-g') ?></strong> <?php _e('Tags from the blogpost will be auto posted to LiveJournal', 'social-networks-auto-poster-facebook-twitter-g') ?>                                            
            </p><br/>                
            <?php if ($options['ljPass']!='') { ?>
            
            <b><?php _e('Test your settings', 'social-networks-auto-poster-facebook-twitter-g'); ?>:</b>&nbsp;&nbsp;&nbsp; <a href="#" class="NXSButton" onclick="testPost('LJ', '<?php echo $ii; ?>'); return false;"><?php printf( __( 'Submit Test Post to %s', 'social-networks-auto-poster-facebook-twitter-g' ), $nType); ?></a>           <?php } ?>
     </div>
            <?php /* ######################## Advanced Tab ####################### */ ?>
  <?php if (!$isNew) { ?>   <div id="nsx<?php echo $nt.$ii ?>_tab2" class="nsx_tab_content">
    
    <?php $options = nxs_FltrsV3toV4($options); nxs_showNTFilters($nt, $ii, $options); echo "<hr/>";
      nxs_addPostingDelaySelV3($nt, $ii, $options['nHrs'], $options['nMin'], $options['nDays']); 
      nxs_showRepostSettings($nt, $ii, $options); ?>
            
            
    </div>  <?php } ?> <?php /* #### End of Tab #### */ ?>
    </div><br/> <?php /* #### End of Tabs #### */ ?>
    
    <div class="submitX nxclear" style="padding-bottom: 0px;"><input type="submit" class="button-primary" name="update_NS_SNAutoPoster_settings" value="<?php _e('Update Settings', 'social-networks-auto-poster-facebook-twitter-g') ?>" /></div></div><?php
  }
  //#### Set Unit Settings from POST
  function setNTSettings($post, $options){ $code = 'LJ'; $lcode = 'lj'; 
    foreach ($post as $ii => $pval){       
      if (!empty($pval['apLJUName']) && !empty($pval['apLJPass'])){ if (!isset($options[$ii])) $options[$ii] = array();
        if (isset($pval['nName']))          $options[$ii]['nName'] = trim($pval['nName']);  
        if (isset($pval['ljSrv']))   $options[$ii]['ljSrv'] = trim($pval['ljSrv']); if ($options[$ii]['ljSrv']=='DW') $server = 'dreamwidth.org'; else $server = 'livejournal.com';      
        if (isset($pval['apLJUName']))   $options[$ii]['ljUName'] = trim($pval['apLJUName']);  $options[$ii]['ljURL'] = 'http://'.$options[$ii]['ljUName'].".".$server;
        if (isset($pval['apLJPass']))    $options[$ii]['ljPass'] = 'n5g9a'.nsx_doEncode($pval['apLJPass']); else $options[$ii]['ljPass'] = '';  
        if (isset($pval['apLJMsgFrmt'])) $options[$ii]['ljMsgFormat'] = trim($pval['apLJMsgFrmt']);                                                  
        if (isset($pval['apLJMsgTFrmt'])) $options[$ii]['ljMsgTFormat'] = trim($pval['apLJMsgTFrmt']);               
        
        if (isset($pval['inclTags'])) $options[$ii]['inclTags'] = $pval['inclTags']; else $options[$ii]['inclTags'] = 0;
        
        
        
        if (isset($pval['commID']))  {          
          if (stripos($pval['commID'], '.')!==false) $pval['commID'] = CutFromTo($pval['commID'], '://', '.');                                 
          $options[$ii]['commID'] = trim($pval['commID']);
        }                                           
        if (isset($pval['apDoLJ']))      $options[$ii]['doLJ'] = $pval['apDoLJ']; else $options[$ii]['doLJ'] = 0; 
        
        $options[$ii] = nxs_adjRpst($options[$ii], $pval);       $options[$ii] = nxs_adjFilters($pval, $options[$ii]);   
        
        if (isset($pval['delayDays'])) $options[$ii]['nDays'] = trim($pval['delayDays']);
        if (isset($pval['delayHrs'])) $options[$ii]['nHrs'] = trim($pval['delayHrs']); if (isset($pval['delayMin'])) $options[$ii]['nMin'] = trim($pval['delayMin']); 
        if (isset($pval['qTLng'])) $options[$ii]['qTLng'] = trim($pval['qTLng']); 
      } elseif ( count($pval)==1 ) if (isset($pval['apDo'.$code])) $options[$ii]['do'.$code] = $pval['apDo'.$code]; else $options[$ii]['do'.$code] = 0; 
    } return $options;
  }  
  //#### Show Post->Edit Meta Box Settings
  function showEdPostNTSettings($ntOpts, $post){ global $nxs_plurl; $post_id = $post->ID; $nt = 'lj'; $ntU = 'LJ';
     foreach($ntOpts as $ii=>$ntOpt)  { $pMeta = maybe_unserialize(get_post_meta($post_id, 'snapLJ', true));  if (is_array($pMeta)) $ntOpt = $this->adjMetaOpt($ntOpt, $pMeta[$ii]); 
        $isAvailLJ =  $ntOpt['ljUName']!='' && $ntOpt['ljPass']!=''; $ljMsgFormat = htmlentities($ntOpt['ljMsgFormat'], ENT_COMPAT, "UTF-8"); $ljMsgTFormat = htmlentities($ntOpt['ljMsgTFormat'], ENT_COMPAT, "UTF-8");       
      ?>  
      <tr><th style="text-align:left;" colspan="2">
      
      
      <?php if ($isAvailLJ) { $ntOpt = nxs_FltrsV3toV4($ntOpt); if (!isset($ntOpt['do'])) $ntOpt['do'] = $ntOpt['do'.$ntU]; ?>
      <?php  if ($post->post_status != "publish" && (int)$ntOpt['do']>0 && !empty($ntOpt['fltrsOn']) && $ntOpt['fltrsOn']=='1'){ ?>
       <input type="radio" id="rbtn<?php echo $ntU.$ii; ?>" value="2" name="<?php echo $nt; ?>[<?php echo $ii; ?>][do]" checked="checked" class="nxsGrpDoChb" /> <?php } 
      else { ?>
         <input class="nxsGrpDoChb" value="1" id="do<?php echo $ntU.$ii; ?>" <?php if ($post->post_status == "publish") echo 'disabled="disabled"';?> type="checkbox" name="<?php echo $nt; ?>[<?php echo $ii; ?>][do]" <?php if ((int)$ntOpt['do'] > 0) echo 'checked="checked" title="def"';  ?> /> 
      <?php }
      if ($post->post_status == "publish") { ?> <input type="hidden" name="<?php echo $nt; ?>[<?php echo $ii; ?>][do]" value="<?php echo $ntOpt['do'];?>"> <?php } ?> 
    <?php } ?>
      <div class="nsx_iconedTitle" style="display: inline; font-size: 13px; background-image: url(<?php echo $nxs_plurl; ?>img/lj16.png);">LiveJournal - <?php _e('publish to', 'social-networks-auto-poster-facebook-twitter-g') ?> (<i style="color: #005800;"><?php echo $ntOpt['nName']; ?></i>)</div></th> <td><?php //## Only show RePost button if the post is "published"
                    if ($post->post_status == "publish" && $isAvailLJ) { ?><?php $ntName = $this->ntInfo['name']; ?>
                    <input alt="<?php echo $ii; ?>" style="float: right;" onmouseout="hidePopShAtt('SV');" onmouseover="showPopShAtt('SV', event);" onclick="return false;" data-ntname="<?php echo $ntName; ?>" type="button" class="button manualPostBtn" name="<?php echo $nt."-".$post->ID; ?>" value="<?php _e('Post to ', 'social-networks-auto-poster-facebook-twitter-g'); echo $ntName; ?>" />
                    <?php } ?>
                    
                     <?php  if (is_array($pMeta) && is_array($pMeta[$ii]) && isset($pMeta[$ii]['pgID']) ) {                         
                        ?> <span id="pstdLJ<?php echo $ii; ?>" style="float: right;padding-top: 4px; padding-right: 10px;">
          <a style="font-size: 10px;" href="<?php echo $pMeta[$ii]['pgID']; ?>" target="_blank"><?php $nType="LiveJournal"; printf( __( 'Posted on', 'social-networks-auto-poster-facebook-twitter-g' ), $nType); ?>  <?php echo (isset($pMeta[$ii]['pDate']) && $pMeta[$ii]['pDate']!='')?(" (".$pMeta[$ii]['pDate'].")"):""; ?></a>
                    </span><?php } ?>
                    
                </td></tr>                
                
                <?php if (!$isAvailLJ) { ?><tr><th scope="row" style="text-align:right; width:150px; padding-top: 5px; padding-right:10px;"></th> <td><b>Setup your LiveJournal Account to AutoPost to LiveJournal</b>
                <?php } else { if ($post->post_status != "publish" && function_exists('nxs_doSMAS5') ) { $ntOpt['postTime'] = get_post_time('U', false, $post_id); nxs_doSMAS5($nt, $ii, $ntOpt); } ?>
                
                <?php if ($ntOpt['rpstOn']=='1') { ?> 
                
                <tr id="altFormat1" style=""><th scope="row" class="nxsTHRow">
                <input value="0"  type="hidden" name="<?php echo $nt; ?>[<?php echo $ii; ?>][rpstPostIncl]"/><input value="nxsi<?php echo $ii; ?>lj" type="checkbox" name="<?php echo $nt; ?>[<?php echo $ii; ?>][rpstPostIncl]"  <?php if (!empty($ntOpt['rpstPostIncl'])) echo "checked"; ?> />
                </th>
                <td> <?php _e('Include in "Auto-Reposting" to this network.', 'social-networks-auto-poster-facebook-twitter-g') ?>                
                </td></tr> <?php } ?> 
                                
                <tr id="altFormat1" style=""><th scope="row" style="vertical-align:top; padding-top: 6px; text-align:right; width:60px; padding-right:10px;"><?php _e('Title Format:', 'social-networks-auto-poster-facebook-twitter-g') ?></th>
                <td><input value="<?php echo $ljMsgTFormat ?>" type="text" name="lj[<?php echo $ii; ?>][SNAPformatT]"  style="width:60%;max-width: 610px;" onfocus="jQuery('.nxs_FRMTHint').hide();mxs_showFrmtInfo('apLJTMsgFrmt<?php echo $ii; ?>');"/><?php nxs_doShowHint("apLJTMsgFrmt".$ii); ?></td></tr>
                
                <tr id="altFormat1" style=""><th scope="row" style="vertical-align:top; padding-top: 6px; text-align:right; width:60px; padding-right:10px;"><?php _e('Text Format:', 'social-networks-auto-poster-facebook-twitter-g') ?></th>
                <td>                
                <textarea cols="150" rows="1" id="lj<?php echo $ii; ?>SNAPformat" name="lj[<?php echo $ii; ?>][SNAPformat]"  style="width:60%;max-width: 610px;" onfocus="jQuery('#lj<?php echo $ii; ?>SNAPformat').attr('rows', 4); jQuery('.nxs_FRMTHint').hide();mxs_showFrmtInfo('apLJMsgFrmt<?php echo $ii; ?>');"><?php echo $ljMsgFormat; ?></textarea>
                <?php nxs_doShowHint("apLJMsgFrmt".$ii); ?></td></tr>
  
  <?php } 
     }
  }
  //#### Save Meta Tags to the Post
  function adjMetaOpt($optMt, $pMeta){  if (isset($pMeta['isPosted'])) $optMt['isPosted'] = $pMeta['isPosted']; else $optMt['isPosted'] = '';
    if (isset($pMeta['SNAPformat'])) $optMt['ljMsgFormat'] = $pMeta['SNAPformat']; 
    if (isset($pMeta['SNAPformatT'])) $optMt['ljMsgTFormat'] = $pMeta['SNAPformatT'];  
    if (isset($pMeta['imgToUse'])) $optMt['imgToUse'] = $pMeta['imgToUse'];      
    if (isset($pMeta['timeToRun']))  $optMt['timeToRun'] = $pMeta['timeToRun'];  if (isset($pMeta['rpstPostIncl']))  $optMt['rpstPostIncl'] = $pMeta['rpstPostIncl'];    
    if (isset($pMeta['do'])) $optMt['do'] = $pMeta['do']; else $optMt['do'] = 0; if (isset($pMeta['doLJ'])) $optMt['doLJ'] = $pMeta['doLJ']; else { if (isset($pMeta['SNAPformat'])) $optMt['doLJ'] = 0; } 
    if (isset($pMeta['SNAPincludeLJ']) && $pMeta['SNAPincludeLJ'] == '1' ) $optMt['doLJ'] = 1;  
    return $optMt;
  }  
}}
if (!function_exists("nxs_rePostToLJ_ajax")) {
  function nxs_rePostToLJ_ajax() { check_ajax_referer('nxsSsPageWPN');  $postID = $_POST['id']; $options = get_option('NS_SNAutoPoster');  
    foreach ($options['lj'] as $ii=>$two) if ($ii==$_POST['nid']) {   $two['ii'] = $ii;  $two['pType'] = 'aj';//if ($two['gpPageID'].$two['gpUName']==$_POST['nid']) {  
      $gppo =  get_post_meta($postID, 'snapLJ', true); $gppo =  maybe_unserialize($gppo);// prr($gppo);
      if (is_array($gppo) && isset($gppo[$ii]) && is_array($gppo[$ii])){ $ntClInst = new nxs_snapClassLJ(); $two = $ntClInst->adjMetaOpt($two, $gppo[$ii]); }
      $result = nxs_doPublishToLJ($postID, $two); if ($result == 200) die("Successfully sent your post to LiveJournal."); else die($result);        
    }    
  }
}  

if (!function_exists("nxs_doPublishToLJ")) { //## Second Function to Post to LJ
  function nxs_doPublishToLJ($postID, $options){ $ntCd = 'LJ'; $ntCdL = 'lj'; $ntNm = 'LJ Based Blog';   if (!is_array($options)) $options = maybe_unserialize(get_post_meta($postID, $options, true));
      //if (isset($options['timeToRun'])) wp_unschedule_event( $options['timeToRun'], 'nxs_doPublishToLJ',  array($postID, $options));        
      $blogTitle = htmlspecialchars_decode(get_bloginfo('name'), ENT_QUOTES); if ($blogTitle=='') $blogTitle = home_url();     
      $addParams = nxs_makeURLParams(array('NTNAME'=>$ntNm, 'NTCODE'=>$ntCd, 'ACCNAME'=>$options['nName'], 'POSTID'=>$postID));
      $ii = $options['ii']; if (!isset($options['pType'])) $options['pType'] = 'im'; if ($options['pType']=='sh') sleep(rand(1, 10)); 
      $logNT = '<span style="color:#2097EE">LJ</span> - '.$options['nName'];
      $snap_ap = get_post_meta($postID, 'snap'.$ntCd, true); $snap_ap = maybe_unserialize($snap_ap);     
      if ($options['pType']!='aj' && is_array($snap_ap) && (nxs_chArrVar($snap_ap[$ii], 'isPosted', '1') || nxs_chArrVar($snap_ap[$ii], 'isPrePosted', '1'))) {
        $snap_isAutoPosted = get_post_meta($postID, 'snap_isAutoPosted', true); if ($snap_isAutoPosted!='2') { 
         nxs_addToLogN('W', 'Notice', $logNT, '-=Duplicate=- Post ID:'.$postID, 'Already posted. No reason for posting duplicate'.' |'.$uqID); return;
        }
      } 
      //$imgURL = nxs_getPostImage($postID);
      $email = $options['ljUName'];  $pass = substr($options['ljPass'], 0, 5)=='n5g9a'?nsx_doDecode(substr($options['ljPass'], 5)):$options['ljPass'];      
      if ($postID=='0') { echo "Testing ... <br/><br/>"; $options['ljMsgTFormat'] = 'Test Link from '. home_url(); $options['ljMsgFormat'] = 'Test post please ignore'; } else { $post = get_post($postID); if(!$post) return; 
        $options['ljMsgFormat'] = nsFormatMessage($options['ljMsgFormat'], $postID, $addParams); $options['ljMsgTFormat'] = nsFormatMessage($options['ljMsgTFormat'], $postID, $addParams);      
        nxs_metaMarkAsPosted($postID, $ntCd, $options['ii'], array('isPrePosted'=>'1')); 
      } //prr($msg); prr($msgFormat);
      $extInfo = ' | PostID: '.$postID." - ".(isset($post) && is_object($post)?$post->post_title:'');
      //## Post         
      $t = wp_get_post_tags($postID); $tggs = array(); foreach ($t as $tagA) {$tggs[] = $tagA->name;} $tags = implode(',', $tggs);
      $message = array('siteName'=>$blogTitle, 'tags'=>$tags);// prr($message);
      //## Actual Post
      $ntToPost = new nxs_class_SNAP_LJ(); $ret = $ntToPost->doPostToNT($options, $message);
      //## Process Results
      if (!is_array($ret) || $ret['isPosted']!='1') { //## Error 
        if ($postID=='0') prr($ret); nxs_addToLogN('E', 'Error', $logNT, '-=ERROR=- '.print_r($ret, true), $extInfo); 
      } else {  // ## All Good - log it.
        if ($postID=='0')  { nxs_addToLogN('S', 'Test', $logNT, 'OK - TEST Message Posted '); echo _e('OK - Message Posted, please see your '.$logNT.' Page. ', 'social-networks-auto-poster-facebook-twitter-g'); } 
          else  { nxs_metaMarkAsPosted($postID, $ntCd, $options['ii'], array('isPosted'=>'1', 'pgID'=>$ret['postID'], 'pDate'=>date('Y-m-d H:i:s'))); nxs_addToLogN('S', 'Posted', $logNT, 'OK - Message Posted ', $extInfo); }
      }
      //## Return Result
      if ($ret['isPosted']=='1') return 200; else return print_r($ret, true); 
  }
}  
?>