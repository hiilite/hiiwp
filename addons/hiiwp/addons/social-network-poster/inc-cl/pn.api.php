<?php    
//## NextScripts FriendFeed Connection Class
$nxs_snapAPINts[] = array('code'=>'PN', 'lcode'=>'pn', 'name'=>'Pinterest');

if (!class_exists("nxs_class_SNAP_PN")) { class nxs_class_SNAP_PN {
    
    var $ntCode = 'PN';
    var $ntLCode = 'pn';     
    
    function doPost($options, $message){ if (!is_array($options)) return false; $out = array();
      foreach ($options as $ii=>$ntOpts) $out[$ii] = $this->doPostToNT($ntOpts, $message);
      return $out;
    }    
    function doPostToNT($options, $message){ global $nxs_gCookiesArr; $badOut = array('pgID'=>'', 'isPosted'=>0, 'pDate'=>date('Y-m-d H:i:s'), 'Error'=>'');
      //## Check settings
      if (!is_array($options)) { $badOut['Error'] = 'No Options'; return $badOut; }      
      if (!isset($options['pnUName']) || trim($options['pnPass'])=='') { $badOut['Error'] = 'Not Configured'; return $badOut; }            
      $pass = substr($options['pnPass'], 0, 5)=='g9c1a'?nsx_doDecode(substr($options['pnPass'], 5)):$options['pnPass'];
      if (empty($options['imgSize'])) $options['imgSize'] = '';
      //## Format
      if (!empty($message['pText'])) $msg = $message['pText']; else $msg = nxs_doFormatMsg($options['pnMsgFormat'], $message); $boardID = $options['pnBoard'];  // prr($boardID); prr($_POST); die();    
      if (isset($message['imageURL'])) $imgURL = trim(nxs_getImgfrOpt($message['imageURL'], $options['imgSize'])); else $imgURL = ''; if ($imgURL=='') $badOut['Error'] .= 'NO Image.';
      $urlToGo = (!empty($message['url']))?$message['url']:'';
            
      $uname = $options['pnUName']; $ck = !empty($options['ck'])?maybe_unserialize(base64_decode($options['ck'])):''; 
      $nt = new nxsAPI_PN(); $nt->debug = false; if (!empty($ck)) $nt->ck = $ck; if (!empty($options['proxy'])&&!empty($options['proxyOn'])){ $nt->proxy['proxy'] = $options['proxy']['proxy']; if (!empty($options['proxy']['up'])) $nt->proxy['up'] = $options['proxy']['up'];};
      
      $loginErr = $nt->connect($uname, $pass); if ($loginErr) { $badOut['Error'] .= 'Can\'t Connect - '.print_r($loginErr, true); return $badOut; } $options['ck'] = $nt->ck; if (function_exists('nxs_save_glbNtwrks')) nxs_save_glbNtwrks('pn', $options['ii'], $nt->ck, 'ck');         
      
      if (preg_match ( '/\$(\d+\.\d+)/', $msg, $matches )) $price = $matches[0];  else $price = '';
      
      if (isset($options['cImgURL']) && $options['cImgURL']=='S' ) $urlToGo = nxs_mkShortURL($urlToGo); elseif (isset($options['cImgURL']) && $options['cImgURL']=='N' ) $urlToGo = '';      
      if (!empty($nt->ck['chkPnt3'])) unset($nt->ck['chkPnt3']);  $ret = $nt->post($msg, $imgURL, $urlToGo, $boardID, 'T', $price, $urlToGo);
      
      return $ret;
   }    
}}
?>