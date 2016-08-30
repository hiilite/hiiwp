<?php    
//## NextScripts FriendFeed Connection Class
$nxs_snapAPINts[] = array('code'=>'SU', 'lcode'=>'su', 'name'=>'StumbleUpon');

if (!class_exists('nxsAPI_SU')){class nxsAPI_SU{ var $ck = array(); var $ckey=''; var $clid='';  var $debug = false; var $proxy = array();
    
    function headers($ref, $post=false, $xhr=true){ $hdrsArr = array(); 
      if ($xhr) $hdrsArr['X-Requested-With']='XMLHttpRequest'; 
      $hdrsArr['Connection']='keep-alive'; $hdrsArr['Referer']=$ref;
      $hdrsArr['User-Agent']='Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; WOW64; Trident/6.0)';
      if($post) $hdrsArr['Content-Type']='application/x-www-form-urlencoded'; 
      if ($xhr) $hdrsArr['Accept']='application/json, text/javascript, */*; q=0.01'; else $hdrsArr['Accept']='text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8';
      $hdrsArr['Origin']='http://www.stumbleupon.com';
      if (function_exists('gzdeflate')) $hdrsArr['Accept-Encoding']='gzip,deflate,sdch'; $hdrsArr['Accept-Language']='en-US,en;q=0.8'; $hdrsArr['Accept-Charset']='ISO-8859-1,utf-8;q=0.7,*;q=0.3'; return $hdrsArr;
    }    
    function check($u=''){ $ck = $this->ck; if ($this->debug) echo "[SU] Checking <br/>\r\n"; var_dump($ck); if (!empty($ck) && is_array($ck)) { $hdrsArr = $this->headers('https://www.stumbleupon.com/su'); 
        $hdrsArr = $this->headers('https://www.stumbleupon.com/submit', true); if (!empty($this->ckey)) $ckAccessTokenKey = $this->ckey; else $ckAccessTokenKey = nxs_getCKVal('su_accesstoken', $ck); 
        $hdrsArr['X-Su-AccessTokenKey'] = $ckAccessTokenKey; $hdrsArr['X-Su-ConsumerKey'] = '35774027dc2f2f64a280e63eafb018505c045655'; $hdrsArr['X-Su-ClientId'] = '8d4c2e85-9c65-995f-1351-762d3552472c';
        $advSet = nxs_mkRemOptsArr($hdrsArr, $ck, '', $this->proxy);  $response = wp_remote_get('https://www.stumbleupon.com/api/v2_0/user/ ', $advSet); if (is_wp_error($response)) return 'Connection ERROR: '.print_r($response, true);
        /*$response['body'] = htmlentities($response['body'], ENT_COMPAT, "UTF-8");  $response['body'] = htmlentities($response['body']); */ // prr($response); // die();
        if (isset($response['headers']['location']) && $response['headers']['location']=='/submit/visitor') return 'Bad Saved Login';  
        if ( $response['response']['code']=='200' && stripos($response['body'], '"_success":true,')!==false && stripos($response['body'], '"userid":')!==false){     
           if ($this->debug) echo "[SU] Saved login - IN...<br/>\r\n"; return true; 
        } else return false; } else return false;
      return false; 
    }    
    function connect($u,$p){ $badOut = 'Error: ';  $this->debug = true;
      //## Check if alrady IN
      if ($this->check($u)!==true){ if ($this->debug) echo "[SU] NO Saved Data; Logging in...<br/>\r\n"; $hdrsArr = $this->headers('https://www.stumbleupon.com/', false, false); //   echo "LOGGIN";
      $response = wp_remote_get('http://www.stumbleupon.com', array('headers' => $hdrsArr)); $p = substr($p, 0, 16); if (is_wp_error($response)) return 'Connection ERROR: '.print_r($response, true);
      $contents = $response['body']; $ckArr = $response['cookies']; //$response['body'] = htmlentities($response['body']);  prr($response);    die();       
      $flds  = array(); $flds['username'] = $u; $flds['password'] = $p; $hdrsArr = $this->headers('https://www.stumbleupon.com', true, true);  $advSet = nxs_mkRemOptsArr($hdrsArr, $ckArr, $flds, $this->proxy);
      $r2 = wp_remote_post( 'https://www.stumbleupon.com/api/v2_0/auth/login', $advSet);  //  prr($flds); prr($ckArr); prr($r2); prr($ckArr); //die();
      if (is_wp_error($r2)) return 'Connection ERROR 2: '.print_r($r2, true);
      if (stripos($r2['body'],',"_error":"Invalid username') !==false ) return "Invalid username or password";
      if (stripos($r2['body'],'"_success":true') !==false){  $this->ckey = CutFromTo($r2['body'],'","key":"','"'); $ckArr[] = new WP_Http_Cookie( array( 'name' => 'SU_REMEMBER', 'value' => urlencode(CutFromTo($r2['body'],'"},"su_remember":"','"')) ) );
        $ckArr[] = new WP_Http_Cookie( array( 'name' => 'seulepage', 'value' => 'oui') ); $ckArr[] = new WP_Http_Cookie( array( 'name' => 'su_accesstoken', 'value' => $this->ckey) );  $this->ck = $ckArr; return false;
      } else return 'Connection ERROR 3: '.print_r($r2, true);
    }}
    function post($msg, $lnk, $cat, $tags, $nsfw=false){ $ck = $this->ck; if ($this->debug) echo "[SU] Posting ...".$lnk."<br/>\r\n"; $badOut = '';  $msg = str_replace("\n",'\n', str_replace("\r",'', strip_tags($msg)));
      $r2 = wp_remote_get($lnk);  $hdrsArr = $this->headers('https://www.stumbleupon.com/submit', false, false); 
      $response = wp_remote_get('http://www.stumbleupon.com/submit?_nospa=true&_notoolbar=true&_notoolbar=true&_nospa=true', array( 'method' => 'GET', 'timeout' => 45, 'redirection' => 0,  'headers' => $hdrsArr, 'cookies' => $ck));   
      if (is_wp_error($response)) return "Connection ERROR. ".print_r($response, true);   $ckArr2 = nxsMergeArraysOV($ck, $response['cookies']); $contents = $response['body'];
      $hdrsArr = $this->headers('https://www.stumbleupon.com/submit', true); if (!empty($this->ckey)) $ckAccessTokenKey = $this->ckey; else $ckAccessTokenKey = nxs_getCKVal('su_accesstoken', $ck); 
      $hdrsArr['X-Su-AccessTokenKey'] = $ckAccessTokenKey; $hdrsArr['X-Su-ConsumerKey'] = '35774027dc2f2f64a280e63eafb018505c045655'; $hdrsArr['X-Su-ClientId'] = '8d4c2e85-9c65-995f-1351-762d3552472c';
      $frmTxt = CutFromTo($contents, '<form method="post" id="submit-form"','</form>'); $md = array(); $flds  = array(); $mids = ''; // prr($frmTxt);
      while (stripos($frmTxt, '<input')!==false){ $inpField = trim(CutFromTo($frmTxt,'<input', '>')); $name = trim(CutFromTo($inpField,'name="', '"'));
        if ( stripos($inpField, '"hidden"')!==false && $name!='' && !in_array($name, $md)) { $md[] = $name; $val = trim(CutFromTo($inpField,'value="', '"')); $flds[$name]= $val; $mids .= "&".$name."=".$val;}
        $frmTxt = substr($frmTxt, stripos($frmTxt, '<input')+8);
      } $flds['url'] = $lnk; $flds['review'] = $msg; $flds['tags'] = $cat; $flds['nsfw'] = $nsfw?'true':'false'; $flds['user-tags'] = $tags;  $flds['_output'] = 'Json';  $flds['_method'] = 'create';  $flds['language'] = 'EN';     
      $advSet = nxs_mkRemOptsArr($hdrsArr, $ck, $flds, $this->proxy); $r2 = wp_remote_post('https://www.stumbleupon.com/api/v2_0/submit', $advSet); 
      if (is_wp_error($r2)) return "Connection ERROR. ".print_r($r2, true);  $resp = json_decode($r2['body'], true); // prr($advSet); prr($r2);  
      if ( isset($resp['_reason']) && is_array($resp['_reason']) && count($resp['_reason'])>0 && stripos($resp['_reason'][0]['message'], 'Failed to add URL')!==false) { sleep(5);
        $r2 = wp_remote_post('https://www.stumbleupon.com/api/v2_0/submit', $advSet); if (is_wp_error($r2)) return "Connection ERROR. ".print_r($r2, true);$resp = json_decode($r2['body'], true);
      }  
      if (stripos($resp['_error'], 'Invalid token')!==false) { // In case we got the Wrong Cookies
        $advSet = nxs_mkRemOptsArr($hdrsArr, $ckArr2, $flds, $this->proxy); $r2 = wp_remote_post('https://www.stumbleupon.com/api/v2_0/submit', $advSet); 
        if (is_wp_error($r2)) return "Connection ERROR. ".print_r($r2, true); $resp = json_decode($r2['body'], true); // prr($resp);
    
        if (!empty($resp['_reason'][0]) && !empty($resp['_reason'][0]['message']) && stripos($resp['_reason'][0]['message'], 'Failed to add URL')!==false) { sleep(5); $r2 = wp_remote_post('https://www.stumbleupon.com/api/v2_0/submit', $advSet); 
          if (is_wp_error($r2)) return "Connection ERROR. ".print_r($r2, true); $resp = json_decode($r2['body'], true); // prr($flds);  prr($resp); //nxs_addToLogN('SU', 'E', '-=DBG=- '.print_r($resp, true)." - #####", $extInfo);
        }    
      } 
  
      if (isset($resp['discovery']['publicid'])) $pageID = $resp['discovery']['publicid']; elseif (isset($resp['discovery']['url']['publicid']))$pageID = $resp['discovery']['url']['publicid'];   
      if ($resp['_success']=='1') { $ck = nxsMergeArraysOV($ck, $r2['cookies']); return array('isPosted'=>'1', 'postID'=>$pageID, 'postURL'=>'http://www.stumbleupon.com/su/'.$pageID.'/comments', 'pDate'=>date('Y-m-d H:i:s'), 'ck'=>$ck); } 
        elseif (isset($resp['_reason'])) { $resp['_reason']['NXS_FIELDS'] = $flds; $resp['_reason']['NXS_RESP'] = $resp;  return $resp['_reason']; } else return "ERROR".print_r($resp, true);  
    }    
}}


if (!class_exists("nxs_class_SNAP_SU")) { class nxs_class_SNAP_SU {
    
    var $ntCode = 'SU';
    var $ntLCode = 'su';     
    
    function doPostToNT($options, $message){ global $nxs_suCkArray; $badOut = array('pgID'=>'', 'isPosted'=>0, 'pDate'=>date('Y-m-d H:i:s'), 'Error'=>'');
      //## Check settings
      if (!is_array($options)) { $badOut['Error'] = 'No Options'; return $badOut; }      
      if (!isset($options['uName']) || trim($options['uPass'])=='') { $badOut['Error'] = 'Not Configured'; return $badOut; }            
      $pass = (substr($options['uPass'], 0, 5)=='g9c1a' || substr($options['uPass'], 0, 5)=='n5g9a')?nsx_doDecode(substr($options['uPass'], 5)):$options['uPass']; 
      //## Format
      if (!empty($message['pText'])) $msg = $message['pText']; else $msg = nxs_doFormatMsg($options['msgFormat'], $message);  $urlToGo = (!empty($message['url']))?$message['url']:''; $tags = $message['tags'];
      
      if (isset($options['ck'])) $ck = maybe_unserialize( $options['ck']); $loginError = true; 
      
      $nt = new nxsAPI_SU(); $nt->debug = true; if (!empty($ck)) $nt->ck = $ck;  $loginErr = $nt->connect($options['uName'], $pass);      
      if (!$loginErr) { $ret = $nt->post($msg, $urlToGo, $options['suCat'], $tags, $options['nsfw']=='1'); 
         if (function_exists('nxs_save_glbNtwrks')) nxs_save_glbNtwrks('su', $options['ii'], $nt->ck, 'ck');   
      } else { $badOut['Error'] .= 'Something went wrong - '.print_r($loginErr, true); $ret = $badOut; }      
      return $ret;
   }    
}}
?>