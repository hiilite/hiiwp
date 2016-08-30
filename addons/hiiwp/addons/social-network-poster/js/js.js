jQuery(document).ready(function() { 
  if (navigator.userAgent.toLowerCase().indexOf("chrome") >= 0) { //## Chrome Autofill is evil
    jQuery(window).load(function(){
        jQuery('input:-webkit-autofill').each(function(){ var text =jQuery(this).val(); var name = jQuery(this).attr('name'); jQuery(this).after(this.outerHTML).remove(); jQuery('input[name=' + name + ']').val(text);});
    });
  }    
  //## Submit Serialized Form - avoid Max.Vars limit.
  jQuery('#nsStFormMisc').submit(function() { var dataA = jQuery('#nsStForm').serialize(); jQuery('#nxsMainFromElementAccts').val(dataA); jQuery('#_wpnonce').val(jQuery('input#nxsSsPageWPN_wpnonce').val()); });
  jQuery('#nsStForm').submit(function() { jQuery('#nsStFormMisc').submit(); return false; });  
  var nxs_isPrevirew = false;   
  jQuery('#post-preview').click(function(event) { nxs_isPrevirew = true; });  
  jQuery('#post').submit(function(event) { if (nxs_isPrevirew == true) return;  jQuery('body').append('<form id="nxs_tempForm"></form>'); jQuery("#NXS_MetaFieldsIN").appendTo("#nxs_tempForm");  
      var nxsmf = jQuery('#nxs_tempForm').serialize();  jQuery( "#NXS_MetaFieldsIN" ).remove(); jQuery('#nxs_snapPostOptions').val(nxsmf); //alert(nxsmf);  alert(jQuery('#nxs_snapPostOptions').val()); return false; 
  });    
  jQuery('.nxs_postEditCtrl').on("change", function(e) { var psst = jQuery('#original_post_status').val(); if (psst=='auto-draft') return; var pid = jQuery('#post_ID').val();  var curr = jQuery(e.target); 
    jQuery.post(ajaxurl,{action: 'nxs_snap_aj',"nxsact":"svEdFlds", cname: curr.attr('name'), cval: curr.val(), pid: pid,  nxs_mqTest:"'", _wpnonce: jQuery('#nxsSsPageWPN_wpnonce').val()}, function(j){  
         console.log(j);          
    }, "html")
  });  
  jQuery('#nxs_ntType').ddslick({ width: 200, imagePosition: "left", selectText: "Select network", onSelected: function (data) {doShowFillBlockX(data.selectedData.value);}});  
  jQuery('.nxs_acctcb').iCheck({checkboxClass: 'icheckbox_minimal-blue', radioClass: 'iradio_minimal-blue', increaseArea: '20%'});
  jQuery('.nxsGrpDoChb').iCheck({checkboxClass: 'icheckbox_minimal-blue', radioClass: 'iradio_minimal-blue', increaseArea: '20%'});
  jQuery('.nxsGrpDoChb').on('ifClicked', function(event){ console.log("ifClickedX"); if (jQuery(this).attr('type')=='radio') {  jQuery(this).attr('type', 'checkbox'); jQuery(this).val('1'); jQuery(this).iCheck('destroy'); 
    jQuery(this).iCheck({checkboxClass: 'icheckbox_minimal-blue', radioClass: 'iradio_minimal-blue', increaseArea: '20%'}); 
    jQuery(this).attr('id', jQuery(this).attr('id').replace('rbtn','do'));
  } });
  //## End of jQuery(document).ready(function()
});

function nxs_showHideMetaBoxBlocks(){ console.log("nxs_showHideMetaBoxBlocks:");
    jQuery('.nxsGrpDoChb').each( function( i, e ) { console.log(":"+e.id+"|"); if (jQuery(this).is(":checked")) jQuery('.nxstbl'+e.id).show(); else jQuery('.nxstbl'+e.id).hide(); });
}
function nxs_hideMetaBoxBlocks(){ console.log("nxs_hideMetaBoxBlocks");
    jQuery('.nxsGrpDoChb').each( function( i, e ) { jQuery('.nxstbl'+e.id).hide(); });
}

(function($) {
  $(function() {
     jQuery('#nxs_snapAddNew').bind('click', function(e) { e.preventDefault(); jQuery('#nxs_spPopup').bPopup({ modalClose: false, appendTo: '#nsStForm', opacity: 0.6, follow: [false, false], position: [65, 50]}); });
     jQuery('#showLic').bind('click', function(e) { e.preventDefault(); jQuery('#showLicForm').bPopup({ modalClose: false, appendTo: '#nsStForm', opacity: 0.6, follow: [false, false]}); });                                 
     jQuery('#showLic2').bind('dblclick', function(e) { e.preventDefault(); jQuery('#showLicForm').bPopup({ modalClose: false, appendTo: '#wpbody', opacity: 0.6, follow: [false, false]}); });                                 
     
     jQuery('#nxs_resetSNAPInfoPosts').bind('click', function(e) { e.preventDefault(); var r = confirm("Are you sure?"); if (r == true) nxs_doAJXPopup('resetSNAPInfoPosts','','','Please wait....','')  });
     jQuery('#nxs_deleteAllSNAPInfo').bind('click', function(e) { e.preventDefault(); var r = confirm("Are you sure?"); if (r == true) nxs_doAJXPopup('deleteAllSNAPInfo','','','Please wait....','')  });
     
     jQuery('#nxs_restBackup').bind('click', function(e) { e.preventDefault(); var r = confirm("Are you sure?"); if (r == true) nxs_doAJXPopup('restBackup','','','Please wait....','')  });
     
     /* // Will move it here later for better compatibility
     jQuery('.button-primary[name="update_NS_SNAutoPoster_settings"]').bind('click', function(e) { var str = jQuery('input[name="post_category[]"]').serialize(); jQuery('div.categorydivInd').replaceWith('<input type="hidden" name="pcInd" value="" />'); 
       str = str.replace(/post_category/g, "pk"); jQuery('div.categorydiv').replaceWith('<input type="hidden" name="post_category" value="'+str+'" />');  
     });
     */
  });
})(jQuery);

function nxs_showNewPostFrom() { jQuery('#nxs_popupDiv').bPopup({ modalClose: false, speed: 450, transition: 'slideDown', contentContainer:'#nxs_popupDivCont', loadUrl: 'admin-ajax.php', 'loadData': { "action": "nxs_snap_aj", "nxsact":"getNewPostDlg", "_wpnonce":jQuery('input#nxsSsPageWPN_wpnonce').val() }, loadCallback: function(){ jQuery("#nxsNPLoader").hide();  }, onClose: function(){ jQuery("#nxsNPLoader").show(); }, opacity: 0.6, follow: [false, false]});  }

function nxs_doNP(){ jQuery("#nxsNPLoaderPost").show(); var mNts = []; jQuery('input[name=nxsNPNts]:checked').each(function(i){ mNts[i] = jQuery(this).val(); });
  jQuery.post(ajaxurl,{action: 'nxs_snap_aj',"nxsact":"doNewPost", mText: jQuery('#nxsNPText').val(), mTitle: jQuery('#nxsNPTitle').val(), mType: jQuery('input[name=nxsNPType]:checked').val(), mLink: jQuery('#nxsNPLink').val(), mImg: jQuery('#nxsNPImg').val(), mNts: mNts, nxs_mqTest:"'", _wpnonce: jQuery('#nxsSsPageWPN_wpnonce').val()}, function(j){  jQuery("#nxsNPResult").html(j); jQuery("#nxsNPLoaderPost").hide(); jQuery("#nxsNPCloseBt").val('Close'); }, "html")     
}

function nxs_updtRdBtn(idd){
    jQuery('#rbtn'+idd).attr('type', 'checkbox'); //alert('rbtn'+idd);
}

//## Functions
function nxs_doResetPostSettings(pid){    
  jQuery.post(ajaxurl,{action: 'nxs_delPostSettings', pid: pid, _wpnonce: jQuery('input#nxsSsPageWPN_wpnonce').val()}, function(j){  window.location = window.location.href.split("#")[0]; }, "html")     
}
function nxs_expSettings(){
  jQuery.generateFile({ filename: 'nx-snap-settings.txt', content: jQuery('input#nxsSsPageWPN_wpnonce').val(), script: 'admin-ajax.php'});
}
// AJAX Functions
function nxs_getPNBoards(u,p,ii){ jQuery("#pnLoadingImg"+ii).show();
  jQuery.post(ajaxurl,{u:u,p:p,ii:ii, nxs_mqTest:"'", action: 'getBoards', id: 0, _wpnonce: jQuery('input#nxsSsPageWPN_wpnonce').val()}, function(j){ 
    if (j.indexOf("option")<1) alert(j); else jQuery("select#apPNBoard"+ii).html(j); jQuery("#pnLoadingImg"+ii).hide();
  }, "html")
}
function getGPCats(u,p,ii,c){ jQuery("#gpLoadingImg"+ii).show();
  jQuery.post(ajaxurl,{u:u,p:p,c:c,ii:ii, nxs_mqTest:"'", action: 'getGPCats', id: 0, _wpnonce: jQuery('input#nxsSsPageWPN_wpnonce').val()}, function(j){ var options = '';
    jQuery("select#apGPCCats"+ii).html(j); jQuery("#gpLoadingImg"+ii).hide();
  }, "html")
}
function getWLBoards(u,p,ii){ jQuery("#wlLoadingImg"+ii).show();
  jQuery.post(ajaxurl,{u:u,p:p,ii:ii, nxs_mqTest:"'", action: 'getWLBoards', id: 0, _wpnonce: jQuery('input#nxsSsPageWPN_wpnonce').val()}, function(j){ var options = '';
    jQuery("select#apWLBoard"+ii).html(j); jQuery("#wlLoadingImg"+ii).hide();
  }, "html")
}
function nxs_getBrdsOrCats(u,p,ty,ii,fName){ jQuery("#"+ty+"LoadingImg"+ii).show();
  jQuery.post(ajaxurl,{u:u,p:p,ii:ii,ty:ty, nxs_mqTest:"'", action: 'nxs_getBrdsOrCats', id: 0, _wpnonce: jQuery('input#nxsSsPageWPN_wpnonce').val()}, function(j){ var options = '';
    jQuery("select#"+fName+ii).html(j); jQuery("#"+ty+"LoadingImg"+ii).hide();
  }, "html")
}

function nxs_getItFromNT(nt,ii,outElemID,fName,params){ jQuery("#"+nt+"LoadingImg"+ii).show();
  jQuery.post(ajaxurl,{nt:nt,ii:ii,fName:fName,params:params, nxs_mqTest:"'", action: 'nxs_snap_aj', "nxsact":"getItFromNT", id: 0, _wpnonce: jQuery('input#nxsSsPageWPN_wpnonce').val()}, function(j){ var options = '';
    jQuery("#"+outElemID).html(j); jQuery("#"+nt+"LoadingImg"+ii).hide();
  }, "html")
}


function nxs_setRpstAll(t,ed,ii){ jQuery("#nxsLoadingImg"+t+ii).show(); var lpid = jQuery('#'+t+ii+'SetLPID').val();
  jQuery.post(ajaxurl,{t:t,ed:ed,ii:ii, nxs_mqTest:"'", action: 'SetRpstAll', id: 0, lpid:lpid, _wpnonce: jQuery('input#nxsSsPageWPN_wpnonce').val()}, function(j){ var options = '';
    alert('OK. Done.'); jQuery("#nxsLoadingImg"+t+ii).hide();
  }, "html")
}

function nxs_fillTime(dd){ var d=new Date(dd); jQuery('#nxs_aa').val(d.getFullYear()); jQuery('#nxs_mm').val(d.getMonth()+1); jQuery('#nxs_jj').val(d.getDate()); jQuery('#nxs_hh').val(d.getHours()); jQuery('#nxs_mn').val(d.getMinutes()); }
function nxs_makeTimeTxt(){ var m=new Array();m[0]="January";m[1]="February";m[2]="March";m[3]="April";m[4]="May";m[5]="June";m[6]="July";m[7]="August";m[8]="September";m[9]="October";m[10]="November";m[11]="December";  
    return m[jQuery('#nxs_mm').val()-1]+', '+jQuery('#nxs_jj').val()+' '+jQuery('#nxs_aa').val()+' '+jQuery('#nxs_hh').val()+':'+jQuery('#nxs_mn').val()+':00'; 
}

//## Select/Unselect Categories
function nxs_chAllCatsL(ch, divID){ jQuery("#"+divID+" input:checkbox[name='post_category[]']").attr('checked', ch==1); }

function nxs_showPopUpInfo(pid, e){ if (!jQuery('div#'+pid).is(":visible")) jQuery('div#'+pid).show().css('top', e.pageY+5).css('left', e.pageX+25).appendTo('body'); }
function nxs_hidePopUpInfo(pid){ jQuery('div#'+pid).hide(); }

function showPopShAtt(imid, e){ if (!jQuery('div#popShAtt'+imid).is(":visible")) jQuery('div#popShAtt'+imid).show().css('top', e.pageY+5).css('left', e.pageX+25).appendTo('body'); }
function hidePopShAtt(imid){ jQuery('div#popShAtt'+imid).hide(); }
function doSwitchShAtt(att, idNum){
  if (att==1) { if (jQuery('#apFBAttch'+idNum).is(":checked")) {jQuery('#apFBAttchShare'+idNum).prop('checked', false);}} else {if( jQuery('#apFBAttchShare'+idNum).is(":checked")) jQuery('#apFBAttch'+idNum).prop('checked', false);}
}      
      
function doShowHideAltFormat(){ if (jQuery('#NS_SNAutoPosterAttachPost').is(':checked')) { 
  jQuery('#altFormat').css('margin-left', '20px'); jQuery('#altFormatText').html('Post Announce Text:'); } else {jQuery('#altFormat').css('margin-left', '0px'); jQuery('#altFormatText').html('Post Text Format:');}
}
function doShowHideBlocks(blID){ /* alert('#do'+blID+'Div'); */ if (jQuery('#apDo'+blID).is(':checked')) jQuery('#do'+blID+'Div').show(); else jQuery('#do'+blID+'Div').hide();}
function doShowHideBlocks1(blID, shhd){ if (shhd==1) jQuery('#do'+blID+'Div').show(); else jQuery('#do'+blID+'Div').hide();}            
function doShowHideBlocks2(blID){ if (jQuery('#apDoS'+blID).val()=='0') { jQuery('#do'+blID+'Div').show(); jQuery('#do'+blID+'A').text('[Hide Settings]'); jQuery('#apDoS'+blID).val('1'); } 
  else { jQuery('#do'+blID+'Div').hide(); jQuery('#do'+blID+'A').text('[Show Settings]'); jQuery('#apDoS'+blID).val('0'); }
}

function doGetHideNTBlock(bl,ii){ if (jQuery('#apDoS'+bl+ii).length<1 || jQuery('#apDoS'+bl+ii).val()=='0') { 
    if (jQuery('#do'+bl+ii+'Div').length<1) {  jQuery("#"+bl+ii+"LoadingImg").show();
      jQuery.post(ajaxurl,{nxsact:'getNTset',nt:bl,ii:ii,action:'nxs_snap_aj', _wpnonce: jQuery('input#nxsSsPageWPN_wpnonce').val()}, function(j){ var options = '';
        //## Show data
        jQuery('#nxsNTSetDiv'+bl+ii).html(j); nxs_doTabsInd('#nxsNTSetDiv'+bl+ii); nxs_V4_filter_mainJS(jQuery);
        jQuery("#"+bl+ii+"LoadingImg").hide(); jQuery('#do'+bl+ii+'Div').show(); jQuery('#do'+bl+ii+'AG').text('[Hide Settings]'); jQuery('#apDoS'+bl+ii).val('1');        
        if (jQuery('#rbtn'+bl.toLowerCase()+ii).attr('type') != 'checkbox') { jQuery('#rbtn'+bl.toLowerCase()+ii).attr('type', 'checkbox');          
        jQuery('#rbtn'+bl.toLowerCase()+ii).iCheck('destroy'); jQuery('#rbtn'+bl.toLowerCase()+ii).iCheck({checkboxClass: 'icheckbox_minimal-blue', radioClass: 'iradio_minimal-blue', increaseArea: '20%'});}
      }, "html")
    } else { jQuery('#do'+bl+ii+'Div').show(); jQuery('#do'+bl+ii+'AG').text('[Hide Settings]'); jQuery('#apDoS'+bl+ii).val('1'); }
  } else { jQuery('#do'+bl+ii+'Div').hide(); jQuery('#do'+bl+ii+'AG').text('[Show Settings]'); jQuery('#apDoS'+bl+ii).val('0'); }
}

function nxs_showHideBlock(iid, iclass){jQuery('.'+iclass).hide(); jQuery('#'+iid).show();}
            
function doShowFillBlock(blIDTo, blIDFrm){ jQuery('#'+blIDTo).html(jQuery('#do'+blIDFrm+'Div').html());}
function doCleanFillBlock(blIDFrm){ jQuery('#do'+blIDFrm+'Div').html('');}
            
function doShowFillBlockX(blIDFrm){ jQuery('.clNewNTSets').hide(); jQuery('#do'+blIDFrm+'Div').show(); }
            
function doDelAcct(nt, blID, blName){  var answer = confirm("Remove "+blName+" account?");
  if (answer){ var data = { action: 'nsDN', id: 0, nt: nt, id: blID, _wpnonce: jQuery('input#nxsSsPageWPN_wpnonce').val()}; 
    jQuery.post(ajaxurl, data, function(response) {  window.location = window.location.href.split("#")[0];  });
  }           
}      

function callAjSNAP(data, label) { 
  var style = "position: fixed; display: none; z-index: 1000; top: 50%; left: 50%; background-color: #E8E8E8; border: 1px solid #555; padding: 15px; width: 350px; min-height: 80px; margin-left: -175px; margin-top: -40px; text-align: center; vertical-align: middle;";
  jQuery('body').append("<div id='test_results' style='" + style + "'></div>");
  jQuery('#test_results').html("<p>Sending update to "+label+"</p>" + "<p><img src='http://gtln.us/img/misc/ajax-loader-med.gif' /></p>");
  jQuery('#test_results').show();            
  jQuery.post(ajaxurl, data, function(response) { if (response=='') response = 'Message Posted';
    jQuery('#test_results').html('<p> ' + response + '</p>' +'<input type="button" class="button" name="results_ok_button" id="results_ok_button" value="OK" />');
    jQuery('#results_ok_button').click(remove_results);
  });            
}
function remove_results() { jQuery("#results_ok_button").unbind("click"); jQuery("#test_results").remove();
  if (typeof document.body.style.maxHeight == "undefined") { jQuery("body","html").css({height: "auto", width: "auto"}); jQuery("html").css("overflow","");}
  document.onkeydown = "";document.onkeyup = "";  return false;
}

function mxs_showHideFrmtInfo(hid){
  if(!jQuery('#'+hid+'Hint').is(':visible')) mxs_showFrmtInfo(hid); else {jQuery('#'+hid+'Hint').hide(); jQuery('#'+hid+'HintInfo').html('Show format info');}
}
function mxs_showFrmtInfo(hid){
  jQuery('#'+hid+'Hint').show(); jQuery('#'+hid+'HintInfo').html('Hide format info'); 
}
function nxs_clLog(){
  jQuery.post(ajaxurl,{action: 'nxs_clLgo', id: 0, _wpnonce: jQuery('input#nxsSsPageWPN_wpnonce').val()}, function(j){ var options = '';                    
    jQuery("#nxslogDiv").html('');
  }, "html")
}
function nxs_rfLog(){
  jQuery.post(ajaxurl,{action: 'nxs_rfLgo', id: 0, _wpnonce: jQuery('input#nxsSsPageWPN_wpnonce').val()}, function(j){ var options = '';                    
    jQuery("#nxslogDiv").html(j);
  }, "html")
}
function nxs_prxTest(){  jQuery('#nxs_pchAjax').show();
  jQuery.post(ajaxurl,{action: 'nxs_prxTest', id: 0, _wpnonce: jQuery('input#nxsSsPageWPN_wpnonce').val()}, function(j){ var options = '';                    
    jQuery('#nxs_pchAjax').hide(); jQuery("#prxList").html(j);  
  }, "html")
}
function nxs_prxGet(){  jQuery('#nxs_pchAjax').show();
  jQuery.post(ajaxurl,{action: 'nxs_prxGet', id: 0, _wpnonce: jQuery('input#nxsSsPageWPN_wpnonce').val()}, function(j){ var options = '';                    
    jQuery('#nxs_pchAjax').hide(); jQuery("#prxList").html(j);  
  }, "html")
}
function nxs_TRSetEnable(ptype, ii){
  if (ptype=='I'){ jQuery('#apTRMsgTFrmt'+ii).attr('disabled', 'disabled'); jQuery('#apTRDefImg'+ii).removeAttr('disabled'); } 
    else { jQuery('#apTRDefImg'+ii).attr('disabled', 'disabled');  jQuery('#apTRMsgTFrmt'+ii).removeAttr('disabled'); }                
}
function nxsTRURLVal(ii){ var val = jQuery('#apTRURL'+ii).val(); var srch = val.toLowerCase().indexOf('http://www.tumblr.com/blog/');
  if (srch>-1) { jQuery('#apTRURL'+ii).css({"background-color":"#FFC0C0"}); jQuery('#apTRURLerr'+ii).html('<br/>Incorrect URL: Please note that URL of your Tumblr Blog should be your public URL. (i.e. like http://nextscripts.tumblr.com/, not http://www.tumblr.com/blog/nextscripts'); } else { jQuery('#apTRURL'+ii).css({"background-color":"#ffffff"}); jQuery('#apTRURLerr'+ii).text(''); }            
}

function nxs_hideTip(id){  
  jQuery.post(ajaxurl,{action: 'nxs_hideTip', id: id, _wpnonce: jQuery('input#nxsSsPageWPN_wpnonce').val()}, function(j){ var options = '';                    
     jQuery('#'+id).hide(); 
  }, "html")
}

function nxs_actDeActTurnOff(objId){ if (jQuery('#'+objId).val()!='1') jQuery('#'+objId+'xd').show(); else jQuery('#'+objId+'xd').hide();}

//## V4 Port
function nxs_svSetAdv(nt,ii,divIn,divOut,loc,isModal){ jQuery(':focus').blur();
    //## jQuery clone fix for empty textareas
    (function (original) { jQuery.fn.clone = function () { var result = original.apply(this, arguments),
      my_textareas = this.find('textarea').add(this.filter('textarea')), result_textareas = result.find('textarea').add(result.filter('textarea')), 
      my_selects = this.find('select').add(this.filter('select')), result_selects = result.find('select').add(result.filter('select'));
      for (var i = 0, l = my_textareas.length; i < l; ++i) jQuery(result_textareas[i]).val( jQuery(my_textareas[i]).val() );    
      for (var i = 0, l = my_selects.length; i < l; ++i) for (var j = 0, m = my_selects[i].options.length; j < m; ++j) if (my_selects[i].options[j].selected === true) result_selects[i].options[j].selected = true;    
      return result;
    }; }) (jQuery.fn.clone); 
    //## /END jQuery clone fix for empty textareas
    if (isModal=='1') { jQuery("#"+divIn).addClass("loading");  jQuery("#nxsSaveLoadingImg"+nt+ii).show(); } else { jQuery("#"+nt+ii+"ldImg").show(); jQuery("#"+nt+ii+"rfrshImg").hide();   }
    if (divIn=='nxsAllAccntsDiv' && jQuery("#nxsAllAccntsDiv").length && jQuery("#nxsSettingsDiv").length) jQuery("#nxsSettingsDiv").appendTo("#nxsAllAccntsDiv");
    
    var isOut=''; if (typeof(divOut)!='undefined' && divOut!='') isOut = '<input type="hidden" name="isOut" value="1" />';
    
    frmTxt = '<div id="nxs_tmpDiv_'+nt+ii+'" style="display:none;"><form id="nxs_tmpFrm_'+nt+ii+'"><input name="action" value="nxs_snap_aj" type="hidden" /><input name="nxsact" value="setNTset" type="hidden" /><input name="nxs_mqTest" value="\'" type="hidden" /><input type="hidden" name="_wp_http_referer" value="'+jQuery("input[name='_wp_http_referer']").val()+'" /><input type="hidden" name="_wpnonce" value="'+jQuery('#nxsSsPageWPN_wpnonce').val()+'" />'+isOut+'</form></div>';
    jQuery("body").append(frmTxt); jQuery("#"+divIn).clone(true).appendTo("#nxs_tmpFrm_"+nt+ii); var serTxt = jQuery("#nxs_tmpFrm_"+nt+ii).serialize(); jQuery("#nxs_tmpDiv_"+nt+ii).remove();// alert(serTxt);
    jQuery.ajax({ type: "POST", url: ajaxurl, data: serTxt, 
      success: function(data){ if (isModal=='1') jQuery("#nxsAllAccntsDiv").removeClass("loading"); else {  jQuery("#"+nt+ii+"rfrshImg").show(); jQuery("#"+nt+ii+"ldImg").hide(); }
      if(typeof(divOut)!='undefined' && divOut!='') jQuery('#'+divOut).html(data); 
      if (isModal=='1') {  jQuery("#nxsSaveLoadingImg"+nt+ii).hide(); jQuery("#doneMsg"+nt+ii).show(); jQuery("#doneMsg"+nt+ii).delay(600).fadeOut(3200); }
        if (loc!='') { if (loc!='r') window.location = loc; else window.location = jQuery(location).attr('href'); } 
      }
    });
    
}

function nxs_showHideFrmtInfo(hid){
  if(!jQuery('#'+hid+'Hint').is(':visible')) nxs_showFrmtInfo(hid); else {jQuery('#'+hid+'Hint').hide(); jQuery('#'+hid+'HintInfo').html('Show format info');}
}
function nxs_showFrmtInfo(hid){
  jQuery('#'+hid+'Hint').show(); jQuery('#'+hid+'HintInfo').html('Hide format info'); 
}
//## /V4 Port

//## Export File
(function(jQuery){ jQuery.generateFile = function(options){ options = options || {};
        if(!options.script || !options.filename || !options.content){
            throw new Error("Please enter all the required config options!");
        }
        var iframe = jQuery('<iframe>',{ width:1, height:1, frameborder:0, css:{ display:'none' } }).appendTo('body');
        var formHTML = '<form action="" method="post"><input type="hidden" name="filename" /><input type="hidden" name="_wpnonce" /><input type="hidden" name="action" value="nxs_getExpSettings" /></form>';
        setTimeout(function(){
            var body = (iframe.prop('contentDocument') !== undefined) ? iframe.prop('contentDocument').body : iframe.prop('document').body;    // IE
            body = jQuery(body); body.html(formHTML); var form = body.find('form');
            form.attr('action',options.script);
            form.find('input[name=filename]').val(options.filename);            
            form.find('input[name=_wpnonce]').val(options.content);
            form.submit();
        },50);
    };
})(jQuery);

function nxs_V4_filter_mainJS($){
    var selectized_terms;
    var selectized_metas;
    
    $.datepicker.regional['en'] = {
        closeText: 'Done',
        prevText: 'Prev',
        nextText: 'Next',
        currentText: 'Today',
        monthNames: ['January','February','March','April','May','June','July','August','September','October','November','December'],
        monthNamesShort: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun','Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        dayNames: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
        dayNamesShort: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
        dayNamesMin: ['Su','Mo','Tu','We','Th','Fr','Sa'],
        weekHeader: 'Wk',
        dateFormat: 'mm/dd/yy',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''};
    $.datepicker.setDefaults($.datepicker.regional['en']);
    
    
    // jQuery(".nxsSelIt").not(".selectized").selectize( { create: true,  persist: false, plugins:  ['remove_button'] } );
    
    //jQuery('select[class="nxsSelIt"]:not(".selectized")').selectize( { create: true,  persist: false, plugins:  ['remove_button'] } );
    
    
    jQuery('select[class="nxsSelItAjxAdd"]:not(".tokenize")').tokenize({ datas: "json.php", displayDropdownOnFocus: true });
    jQuery('select[class="nxsSelItAjx"]:not(".tokenize")').tokenize({ datas: "json.php", displayDropdownOnFocus: true, newElements:false });
    jQuery('select[class="nxsSelIt"]:not(".tokenize")').tokenize({displayDropdownOnFocus: true, newElements:false });
    /*
    jQuery('select[class="nxs_term_names"]:not(".selectized")').selectize( { create: true,  persist: false, valueField: 'value', labelField: 'title', sortField:  'title',  plugins:  ['remove_button'] } );
    jQuery('select[class="nxs_term_names"]:not(".selectized")').selectize( { create: true,  persist: false, valueField: 'value', labelField: 'title', sortField:  'title',  plugins:  ['remove_button'] } );
    jQuery('select[class="nxs_tax_names"]:not(".selectized")').selectize( { valueField: 'value', labelField: 'title', sortField:  'title', plugins:  ['remove_button'],
      onChange: function( item ) { console.log( "===" ); console.log( this.$input[0].id ); console.log( "=X="); filter_select( item, '#'+this.$input[0].id.replace("tax_names", "term_names") ); }
    });
    
    //console.log( jQuery('select[class^="nxs_tax_names"]').length );
    
    jQuery('select[class^="nxs_tax_names"]:not(".selinitialized")').each( function( i, e ) {  
        if (jQuery(e).prop('tagName')=='SELECT' && jQuery(e)[0].selectize.items.length) { jQuery(e).addClass('selinitialized'); //  console.log( "==**" ); console.log( jQuery(e).prop('id') ); console.log( "##==" ); 
           var termID = e.id.replace("tax_names", "term_names");   filter_select( jQuery(e)[0].selectize.items[0],  '#'+termID, true );
        }         
     });
    
      */
    
    //## Change values when taxonimy changed
    $( '.nxs_tax_names' ).on( 'change', function() { var tgtID =  $(this).attr('id').replace('_tax_','_term_'); $('#'+tgtID).attr('data-type', $(this).val()); $('#'+tgtID).val(''); $('#'+tgtID).tokenize().remap(); } );  
    //## Add new meta set
    $( '.nxs_add_meta_compare' ).on( 'click', function(e) { e.preventDefault(); var ii = $( this ).attr( "data-ii" ); var nt = $( this ).attr( "data-nt" );  var count_compares = +$( '#nxs_count_meta_'+nt+ii ).val( function( ii, val ) { return ( + val + 1 ); } ).val(); 
       
       var clone = jQuery('#nxs_meta_namesDiv'+nt+ii).clone();              
       var clo = jQuery('#nxs_meta_namesDiv'+nt+ii);
       
       jQuery(clone).find("#nxs"+nt+ii+"_meta_key").attr('name', nt+'['+ii+'][nxs_meta_key'+'_'+count_compares+']');     
       jQuery(clone).find("#nxs"+nt+ii+"_meta_key").attr('id', 'nxs'+nt+ii+'_meta_key'+'_'+count_compares);
       jQuery(clone).find("#nxs"+nt+ii+"_meta_operator").attr('name', nt+'['+ii+'][nxs_meta_operator'+'_'+count_compares+']');     
       jQuery(clone).find("#nxs"+nt+ii+"_meta_operator").attr('id', 'nxs'+nt+ii+'_meta_operator'+'_'+count_compares);
       
       jQuery(clone).find("#nxs"+nt+ii+"_meta_value").attr('name', nt+'['+ii+'][nxs_meta_value'+'_'+count_compares+'][]');     
       jQuery(clone).find("#nxs"+nt+ii+"_meta_value").attr('id', 'nxs'+nt+ii+'_meta_value'+'_'+count_compares);    // tg[0][nxs_meta_names][]
       
       jQuery(clone).find("#nxs"+nt+ii+"_meta_relation").attr('name', nt+'['+ii+'][nxs_meta_relation'+'_'+count_compares+']');
       jQuery(clone).find("#nxs"+nt+ii+"_meta_relation").attr('id', 'nxs'+nt+ii+'_meta_relation'+'_'+count_compares);       
       
       jQuery(clone).find("#nxs"+nt+ii+"_meta_names"+'_'+count_compares).find('option').remove().end();       
       clone.appendTo('#nxs_meta_namesTopDiv'+nt+ii); jQuery('#nxs_meta_namesCond'+nt+ii).show();        
       
       jQuery(clone).find(".nxs_metas_leftPanel").attr('style','display:inline-block;');       
        
       return false;
        
    } );
    
    
    $( '.nxs_remove_term_compare' ).on( 'click', function() {
        jQuery(this).parent().parent().remove();
    } );
    $( '.nxs_remove_meta_compare' ).on( 'click', function() {
        jQuery(this).parent().parent().remove();
    } );
    
    //## Filters - Taxonomies : Add More Button 
    $( '.nxs_add_term_compare' ).on( 'click', function(e) { e.preventDefault(); var ii = $( this ).attr( "data-ii" ); var nt = $( this ).attr( "data-nt" );  var count_compares = +$( '#nxs_count_term_'+nt+ii ).val( function( ii, val ) { return ( + val + 1 ); } ).val(); 
       
       var clone = jQuery('#nxs_term_namesDiv'+nt+ii).clone();              
       var clo = jQuery('#nxs_term_namesDiv'+nt+ii);
       
       jQuery(clone).find("#nxs"+nt+ii+"_tax_names").attr('name', nt+'['+ii+'][nxs_tax_names'+'_'+count_compares+']');     
       jQuery(clone).find("#nxs"+nt+ii+"_tax_names").attr('id', 'nxs'+nt+ii+'_tax_names'+'_'+count_compares);
       jQuery(clone).find("#nxs"+nt+ii+"_term_operator").attr('name', nt+'['+ii+'][nxs_term_operator'+'_'+count_compares+']');     
       jQuery(clone).find("#nxs"+nt+ii+"_term_operator").attr('id', 'nxs'+nt+ii+'_term_operator'+'_'+count_compares);
       jQuery(clone).find("#nxs"+nt+ii+"_term_children").attr('name', nt+'['+ii+'][nxs_term_children'+'_'+count_compares+']');     
       jQuery(clone).find("#nxs"+nt+ii+"_term_children").attr('id', 'nxs'+nt+ii+'_term_children'+'_'+count_compares);       
       jQuery(clone).find(".Tokenize").remove();              
       jQuery(clone).find("#nxs"+nt+ii+"_term_names").attr('name', nt+'['+ii+'][nxs_term_names'+'_'+count_compares+'][]');     
       jQuery(clone).find("#nxs"+nt+ii+"_term_names").attr('id', 'nxs'+nt+ii+'_term_names'+'_'+count_compares);    // tg[0][nxs_term_names][]
       
       jQuery(clone).find("#nxs"+nt+ii+"_term_relation").attr('name', nt+'['+ii+'][nxs_term_relation'+'_'+count_compares+']');     
       jQuery(clone).find("#nxs"+nt+ii+"_term_relation").attr('id', 'nxs'+nt+ii+'_term_relation'+'_'+count_compares);       
       
       jQuery(clone).find("#nxs"+nt+ii+"_term_names"+'_'+count_compares).find('option').remove().end();       
       clone.appendTo('#nxs_term_namesTopDiv'+nt+ii); jQuery('#nxs_term_namesCond'+nt+ii).show();        
       
       jQuery("#nxs"+nt+ii+"_term_names"+'_'+count_compares).tokenize({ datas: "json.php", displayDropdownOnFocus: true });
       
       jQuery(clone).find(".nxs_terms_leftPanel").attr('style','display:inline-block;');       
       $( '.nxs_tax_names' ).on( 'change', function() { var tgtID =  $(this).attr('id').replace('_tax_','_term_'); $('#'+tgtID).attr('data-type', $(this).val()); $('#'+tgtID).val(''); $('#'+tgtID).tokenize().remap(); } );  
        
       return false;
        
    } );
    
    $( '#nxs_add_date_period' ).on( 'click', function() {        
        
        var count_periods = +$( '#nxsDivWrap #nxs_count_date_periods' ).val( function( i, val ) {
            return ( + val + 1 );
        } ).val();
        var rel     = 'nxs_date_period_' + count_periods;
        
        var html = '<hr>';
        
        html += '<div class="nxs_short_field" rel="' + rel + '">';
        html += '<label class="field_title">[Timeframe] from:</label>';
        html += '<input type="text" id="nxs_starting_period_' + count_periods + '" name="nxs_starting_period_' + count_periods + '" class="selectize-input datepicker" placeholder="2012-01-01" value="">';
        html += '</div>';
        
        html += '<div class="nxs_short_field" rel="' + rel + '">';
        html += '<label class="field_title">[Timeframe] to:</label>';
        html += '<input type="text" id="nxs_end_period_' + count_periods + '" name="nxs_end_period_' + count_periods + '" class="selectize-input datepicker" placeholder="2014-01-01" value="">';
        html += '</div>';
        
        html += '<div class="nxs_small_field nxs_checkbox_field" rel="' + rel + '">';
        html += '<input type="checkbox" name="nxs_inclusive_' + count_periods + '" id="nxs_inclusive_' + count_periods + '" class="nxs-checkbox selectize-input">';
        html += 'Include';
        html += '</div>';
        
        html += '<div class="nxs_small_field" rel="' + rel + '">';
        html += '<button class="nxs_remove_date_period">Delete</button>';
        html += '</div>';
        
        $( this )
            .prev( 'hr' )
            .before( html )
            .prevAll( 'div [rel=' + rel + ']' )
            .children( '.nxs_remove_date_period' )
            .on( 'click', function() {
                remove_compare( this );
            } );
        
        $( '#nxs_starting_period_' + count_periods ).datepicker();
        
        $( '#nxs_end_period_' + count_periods ).datepicker();
        
        return false;
        
    } );
    
    $( '#nxs_add_date_abs_period' ).on( 'click', function() {        
        
        var count_periods = +$( '#nxsDivWrap #nxs_count_date_abs_periods' ).val( function( i, val ) {
            return ( + val + 1 );
        } ).val();
        var rel     = 'nxs_date_abs_period_' + count_periods;
        
        var html = '<hr>';
        
        html += '<div class="nxs_small_field" rel="' + rel + '">';
        html += '<label class="field_title">Posts after:</label>';
        html += '<input type="text" id="nxs_starting_abs_period_' + count_periods + '" name="nxs_starting_abs_period_' + count_periods + '" class="selectize-input" placeholder="Please enter the number" value="">';
        html += '<p class="description">Select Posts after...</p>';
        html += '</div>';
        
        html += '<div class="nxs_small_field" rel="' + rel + '">';
        html += '<label class="field_title">Period Type:</label>';
        html += get_select( 'nxs_types_starting_abs_period', count_periods );
        html += '<p class="description">Period Type: Day, Month, Year</p>';
        html += '</div>';
        
        html += '<div class="nxs_small_field" rel="' + rel + '">';
        html += '<label class="field_title">Posts earlier then:</label>';
        html += '<input type="text" id="nxs_end_abs_period_' + count_periods + '" name="nxs_end_abs_period_' + count_periods + '" class="selectize-input" placeholder="Please enter the number" value="">';
        html += '<p class="description">Select Posts earlier then</p>';
        html += '</div>';
        
        html += '<div class="nxs_small_field" rel="' + rel + '">';
        html += '<label class="field_title">Period Type:</label>';
        html += get_select( 'nxs_types_end_abs_period', count_periods );
        html += '<p class="description">Period Type: Day, Month, Year</p>';
        html += '</div>';
        
        html += '<div class="nxs_small_field" rel="' + rel + '">';
        html += '<button class="nxs_remove_date_abs_period">Delete</button>';
        html += '</div>';
        
        $( this )
            .prev( 'hr' )
            .before( html )
            .prevAll( 'div [rel=' + rel + ']' )
            .children( '.nxs_remove_date_abs_period' )
            .on( 'click', function() {
                remove_compare( this );
            } );
        
        $( '#nxs_types_end_abs_period_' + count_periods ).selectize( {
            valueField: 'value',
            labelField: 'title'
        } );
        
        $( '#nxs_types_starting_abs_period_' + count_periods ).selectize( {
            valueField: 'value',
            labelField: 'title'
        } );
        
        return false;        
    } )
    
    $( '.nxs_remove_meta_compare' ).on( 'click', function() {
        remove_compare( this );
    } );
    
    
    
    $( '.nxs_remove_date_period' ).on( 'click', function() {
        remove_compare( this );
    } );
    
    $( '.nxs_remove_date_abs_period' ).on( 'click', function() {
        remove_compare( this );
    } );
    
    function remove_compare( button ) {
        var selector = '';
        switch( $( button ).attr( 'class' ) ) {
            case 'nxs_remove_meta_compare': 
                selector = 'nxs_count_meta_compares';
                break;
            case 'nxs_remove_term_compare': 
                selector = 'nxs_count_term_compares';
                break;
            case 'nxs_remove_date_period': 
                selector = 'nxs_count_date_periods';
                break;
            case 'nxs_remove_date_abs_period': 
                selector = 'nxs_count_date_abs_periods';
                break;
        }
        
        $( '#' + selector ).val( function( i, val ) {
            return ( + val - 1 );
        } )
        
        var rel = $( button ).closest( 'div' ).attr( 'rel' );
        
        set_attributes_next_elements( button );    
        
        $( button ).closest( 'div' ).prevAll( 'div[rel=' + rel + ']' ).remove();
        $( button ).closest( 'div' ).prev( 'hr' ).remove();
        $( button ).closest( 'div' ).remove();
        
        return false;
    }
    
    function get_select( name, count, nt, ii ){ //alert(name); console.log( JSON.stringify( selectized_terms ) );
        if( name == 'nxs_term_names' )
            var select = selectized_terms;
        else if( name == 'nxs_meta_value' )
            var select = selectized_metas;
        // else  var select = $( 'select#' + name ).tokenize().toArray();
        
        var current_name = name + '_' + count; 
        
        if(typeof(nt)!='undefined') current_nameX = nt+'['+ii+']['+name + '_' + count+']'; else current_nameX = current_name;
         
         //console.log( JSON.stringify( jQuery(this).prop('tagName') ) );
         
        var multiple     = ( $( '#' + name ).attr( 'multiple' ) ? 'multiple="multiple"' : '' );
        
        var output = '<select name="' + ( multiple != '' ? current_nameX + '[]' : current_nameX ) + '" id="' + current_name + '" placeholder="Select from the list..." ' + multiple + '>';
        output += '<option value="">Select from the list...</option>';
        $.each( select, function( i, e ) {
            output += '<option value="' + e.value + '">' + e.title + '</option>';
        } );     
        output += '</select>';
        
        return output;
    }
    
    function set_attributes_next_elements( elem ) {
        var selector = $( elem ).hasClass( 'nxs_remove_date_period' ) ? 'div [rel^=nxs_date_period]' : 'div [rel]';
        
        $( elem ).closest( 'div' ).nextAll( selector ).each( function( i, e ) {            
            set_attrribute( $( e ), 'rel' );
            set_attrribute( $( e ).children( 'input, select' ), 'id' );
            set_attrribute( $( e ).children( 'input, select' ), 'name' );                                    
        } );    
    }
    
    function set_attrribute ( element, attribute ) {
        if( element.length > 0 ) {
            $( element ).attr( attribute, function( index, value ) {
                var multiple = ~value.indexOf( '[]' ) ? '[]' : '';
                var position = value.lastIndexOf( '_' ) + 1;
                return ( value.slice( 0, position ) + ( parseInt( value.slice( position ) ) - 1 ) + multiple );
            } );
        }
    }
    
    function filter_select ( item, selector, saveItems ) {   console.log( '~!!-' ); console.log( selector );  console.log( $(selector)[0]  );
        var terms      = $( selector )[0].selectize;   console.log( '~~~' ); 
        var items      = terms.items;  console.log( '~1~~' ); 
        var newOptions = []; console.log( '~2~~' ); 
        
        if(typeof(selectized_terms)=='undefined' && typeof($( selector )[0])!='undefined') selectized_terms = $( selector )[0].selectize.options; 
        
        console.log( '~3~~' ); 
        
         console.log( selectized_terms );
        
        
        if( ~selector.indexOf( '_term_names' ) ) var options = selectized_terms; else if( ~selector.indexOf( '_meta_value' ) ) var options = selectized_metas; else var options = terms.options;
        
        
        $.each( options, function() { 
            var delimiter = this.value.indexOf( '||' );
            if( this.value.slice( 0, delimiter ) == item ) {
                newOptions.push( {  
                    value: this.value,
                    title: this.title
                } );
            }
        } );
        
        terms.clearOptions();
        terms.addOption( newOptions );
        if( saveItems ) {
            terms.addItems( items );
        }
    }
}

jQuery( document ).ready( function( $ ) {
    if (typeof($.datepicker)!='undefined') nxs_V4_filter_mainJS($);
} );


/*================================================================================
 * @name: bPopup * @author: (c)Bjoern Klinggaard (twitter@bklinggaard) * @version: 0.11.0.min
 ================================================================================*/
  (function(c){c.fn.bPopup=function(A,E){function L(){a.contentContainer=c(a.contentContainer||b);switch(a.content){case "iframe":var d=c('<iframe class="b-iframe" '+a.iframeAttr+"></iframe>");d.appendTo(a.contentContainer);t=b.outerHeight(!0);u=b.outerWidth(!0);B();d.attr("src",a.loadUrl);l(a.loadCallback);break;case "image":B();c("<img />").load(function(){l(a.loadCallback);F(c(this))}).attr("src",a.loadUrl).hide().appendTo(a.contentContainer);break;default:B(),c('<div class="b-ajax-wrapper"></div>').load(a.loadUrl,a.loadData,function(d,b,e){l(a.loadCallback,b);F(c(this))}).hide().appendTo(a.contentContainer)}}function B(){a.modal&&c('<div class="b-modal '+e+'"></div>').css({backgroundColor:a.modalColor,position:"fixed",top:0,right:0,bottom:0,left:0,opacity:0,zIndex:a.zIndex+v}).appendTo(a.appendTo).fadeTo(a.speed,a.opacity);C();b.data("bPopup",a).data("id",e).css({left:"slideIn"==a.transition||"slideBack"==a.transition?"slideBack"==a.transition?f.scrollLeft()+w:-1*(x+u):m(!(!a.follow[0]&&n||g)),position:a.positionStyle||"absolute",top:"slideDown"==a.transition||"slideUp"==a.transition?"slideUp"==a.transition?f.scrollTop()+y:z+-1*t:p(!(!a.follow[1]&&q||g)),"z-index":a.zIndex+v+1}).each(function(){a.appending&&c(this).appendTo(a.appendTo)});G(!0)}function r(){a.modal&&c(".b-modal."+b.data("id")).fadeTo(a.speed,0,function(){c(this).remove()});a.scrollBar||c("html").css("overflow","auto");c(".b-modal."+e).unbind("click");f.unbind("keydown."+e);k.unbind("."+e).data("bPopup",0<k.data("bPopup")-1?k.data("bPopup")-1:null);b.undelegate(".bClose, ."+a.closeClass,"click."+e,r).data("bPopup",null);clearTimeout(H);G();return!1}function I(d){y=k.height();w=k.width();h=D();if(h.x||h.y)clearTimeout(J),J=setTimeout(function(){C();d=d||a.followSpeed;var e={};h.x&&(e.left=a.follow[0]?m(!0):"auto");h.y&&(e.top=a.follow[1]?p(!0):"auto");b.dequeue().each(function(){g?c(this).css({left:x,top:z}):c(this).animate(e,d,a.followEasing)})},50)}function F(d){var c=d.width(),e=d.height(),f={};a.contentContainer.css({height:e,width:c});e>=b.height()&&(f.height=b.height());c>=b.width()&&(f.width=b.width());t=b.outerHeight(!0);u=b.outerWidth(!0);C();a.contentContainer.css({height:"auto",width:"auto"});f.left=m(!(!a.follow[0]&&n||g));f.top=p(!(!a.follow[1]&&q||g));b.animate(f,250,function(){d.show();h=D()})}function M(){k.data("bPopup",v);b.delegate(".bClose, ."+a.closeClass,"click."+e,r);a.modalClose&&c(".b-modal."+e).css("cursor","pointer").bind("click",r);N||!a.follow[0]&&!a.follow[1]||k.bind("scroll."+e,function(){if(h.x||h.y){var d={};h.x&&(d.left=a.follow[0]?m(!g):"auto");h.y&&(d.top=a.follow[1]?p(!g):"auto");b.dequeue().animate(d,a.followSpeed,a.followEasing)}}).bind("resize."+e,function(){I()});a.escClose&&f.bind("keydown."+e,function(a){27==a.which&&r()})}function G(d){function c(e){b.css({display:"block",opacity:1}).animate(e,a.speed,a.easing,function(){K(d)})}switch(d?a.transition:a.transitionClose||a.transition){case "slideIn":c({left:d?m(!(!a.follow[0]&&n||g)):f.scrollLeft()-(u||b.outerWidth(!0))-200});break;case "slideBack":c({left:d?m(!(!a.follow[0]&&n||g)):f.scrollLeft()+w+200});break;case "slideDown":c({top:d?p(!(!a.follow[1]&&q||g)):f.scrollTop()-(t||b.outerHeight(!0))-200});break;case "slideUp":c({top:d?p(!(!a.follow[1]&&q||g)):f.scrollTop()+y+200});break;default:b.stop().fadeTo(a.speed,d?1:0,function(){K(d)})}}function K(d){d?(M(),l(E),a.autoClose&&(H=setTimeout(r,a.autoClose))):(b.hide(),l(a.onClose),a.loadUrl&&(a.contentContainer.empty(),b.css({height:"auto",width:"auto"})))}function m(a){return a?x+f.scrollLeft():x}function p(a){return a?z+f.scrollTop():z}function l(a,e){c.isFunction(a)&&a.call(b,e)}function C(){z=q?a.position[1]:Math.max(0,(y-b.outerHeight(!0))/2-a.amsl);x=n?a.position[0]:(w-b.outerWidth(!0))/2;h=D()}function D(){return{x:w>b.outerWidth(!0),y:y>b.outerHeight(!0)}}c.isFunction(A)&&(E=A,A=null);var a=c.extend({},c.fn.bPopup.defaults,A);a.scrollBar||c("html").css("overflow","hidden");var b=this,f=c(document),k=c(window),y=k.height(),w=k.width(),N=/OS 6(_\d)+/i.test(navigator.userAgent),v=0,e,h,q,n,g,z,x,t,u,J,H;b.close=function(){r()};b.reposition=function(a){I(a)};return b.each(function(){c(this).data("bPopup")||(l(a.onOpen),v=(k.data("bPopup")||0)+1,e="__b-popup"+v+"__",q="auto"!==a.position[1],n="auto"!==a.position[0],g="fixed"===a.positionStyle,t=b.outerHeight(!0),u=b.outerWidth(!0),a.loadUrl?L():B())})};c.fn.bPopup.defaults={amsl:50,appending:!0,appendTo:"body",autoClose:!1,closeClass:"b-close",content:"ajax",contentContainer:!1,easing:"swing",escClose:!0,follow:[!0,!0],followEasing:"swing",followSpeed:500,iframeAttr:'scrolling="no" frameborder="0"',loadCallback:!1,loadData:!1,loadUrl:!1,modal:!0,modalClose:!0,modalColor:"#000",onClose:!1,onOpen:!1,opacity:.7,position:["auto","auto"],positionStyle:"absolute",scrollBar:!0,speed:250,transition:"fadeIn",transitionClose:!1,zIndex:9997}})(jQuery);
  
   /*! iCheck v1.0.2 by Damir Sultanov, http://git.io/arlzeA, MIT Licensed */
(function(f){function A(a,b,d){var c=a[0],g=/er/.test(d)?_indeterminate:/bl/.test(d)?n:k,e=d==_update?{checked:c[k],disabled:c[n],indeterminate:"true"==a.attr(_indeterminate)||"false"==a.attr(_determinate)}:c[g];if(/^(ch|di|in)/.test(d)&&!e)x(a,g);else if(/^(un|en|de)/.test(d)&&e)q(a,g);else if(d==_update)for(var f in e)e[f]?x(a,f,!0):q(a,f,!0);else if(!b||"toggle"==d){if(!b)a[_callback]("ifClicked");e?c[_type]!==r&&q(a,g):x(a,g)}}function x(a,b,d){var c=a[0],g=a.parent(),e=b==k,u=b==_indeterminate,
v=b==n,s=u?_determinate:e?y:"enabled",F=l(a,s+t(c[_type])),B=l(a,b+t(c[_type]));if(!0!==c[b]){if(!d&&b==k&&c[_type]==r&&c.name){var w=a.closest("form"),p='input[name="'+c.name+'"]',p=w.length?w.find(p):f(p);p.each(function(){this!==c&&f(this).data(m)&&q(f(this),b)})}u?(c[b]=!0,c[k]&&q(a,k,"force")):(d||(c[b]=!0),e&&c[_indeterminate]&&q(a,_indeterminate,!1));D(a,e,b,d)}c[n]&&l(a,_cursor,!0)&&g.find("."+C).css(_cursor,"default");g[_add](B||l(a,b)||"");g.attr("role")&&!u&&g.attr("aria-"+(v?n:k),"true");
g[_remove](F||l(a,s)||"")}function q(a,b,d){var c=a[0],g=a.parent(),e=b==k,f=b==_indeterminate,m=b==n,s=f?_determinate:e?y:"enabled",q=l(a,s+t(c[_type])),r=l(a,b+t(c[_type]));if(!1!==c[b]){if(f||!d||"force"==d)c[b]=!1;D(a,e,s,d)}!c[n]&&l(a,_cursor,!0)&&g.find("."+C).css(_cursor,"pointer");g[_remove](r||l(a,b)||"");g.attr("role")&&!f&&g.attr("aria-"+(m?n:k),"false");g[_add](q||l(a,s)||"")}function E(a,b){if(a.data(m)){a.parent().html(a.attr("style",a.data(m).s||""));if(b)a[_callback](b);a.off(".i").unwrap();
f(_label+'[for="'+a[0].id+'"]').add(a.closest(_label)).off(".i")}}function l(a,b,f){if(a.data(m))return a.data(m).o[b+(f?"":"Class")]}function t(a){return a.charAt(0).toUpperCase()+a.slice(1)}function D(a,b,f,c){if(!c){if(b)a[_callback]("ifToggled");a[_callback]("ifChanged")[_callback]("if"+t(f))}}var m="iCheck",C=m+"-helper",r="radio",k="checked",y="un"+k,n="disabled";_determinate="determinate";_indeterminate="in"+_determinate;_update="update";_type="type";_click="click";_touch="touchbegin.i touchend.i";
_add="addClass";_remove="removeClass";_callback="trigger";_label="label";_cursor="cursor";_mobile=/ipad|iphone|ipod|android|blackberry|windows phone|opera mini|silk/i.test(navigator.userAgent);f.fn[m]=function(a,b){var d='input[type="checkbox"], input[type="'+r+'"]',c=f(),g=function(a){a.each(function(){var a=f(this);c=a.is(d)?c.add(a):c.add(a.find(d))})};if(/^(check|uncheck|toggle|indeterminate|determinate|disable|enable|update|destroy)$/i.test(a))return a=a.toLowerCase(),g(this),c.each(function(){var c=
f(this);"destroy"==a?E(c,"ifDestroyed"):A(c,!0,a);f.isFunction(b)&&b()});if("object"!=typeof a&&a)return this;var e=f.extend({checkedClass:k,disabledClass:n,indeterminateClass:_indeterminate,labelHover:!0},a),l=e.handle,v=e.hoverClass||"hover",s=e.focusClass||"focus",t=e.activeClass||"active",B=!!e.labelHover,w=e.labelHoverClass||"hover",p=(""+e.increaseArea).replace("%","")|0;if("checkbox"==l||l==r)d='input[type="'+l+'"]';-50>p&&(p=-50);g(this);return c.each(function(){var a=f(this);E(a);var c=this,
b=c.id,g=-p+"%",d=100+2*p+"%",d={position:"absolute",top:g,left:g,display:"block",width:d,height:d,margin:0,padding:0,background:"#fff",border:0,opacity:0},g=_mobile?{position:"absolute",visibility:"hidden"}:p?d:{position:"absolute",opacity:0},l="checkbox"==c[_type]?e.checkboxClass||"icheckbox":e.radioClass||"i"+r,z=f(_label+'[for="'+b+'"]').add(a.closest(_label)),u=!!e.aria,y=m+"-"+Math.random().toString(36).substr(2,6),h='<div class="'+l+'" '+(u?'role="'+c[_type]+'" ':"");u&&z.each(function(){h+=
'aria-labelledby="';this.id?h+=this.id:(this.id=y,h+=y);h+='"'});h=a.wrap(h+"/>")[_callback]("ifCreated").parent().append(e.insert);d=f('<ins class="'+C+'"/>').css(d).appendTo(h);a.data(m,{o:e,s:a.attr("style")}).css(g);e.inheritClass&&h[_add](c.className||"");e.inheritID&&b&&h.attr("id",m+"-"+b);"static"==h.css("position")&&h.css("position","relative");A(a,!0,_update);if(z.length)z.on(_click+".i mouseover.i mouseout.i "+_touch,function(b){var d=b[_type],e=f(this);if(!c[n]){if(d==_click){if(f(b.target).is("a"))return;
A(a,!1,!0)}else B&&(/ut|nd/.test(d)?(h[_remove](v),e[_remove](w)):(h[_add](v),e[_add](w)));if(_mobile)b.stopPropagation();else return!1}});a.on(_click+".i focus.i blur.i keyup.i keydown.i keypress.i",function(b){var d=b[_type];b=b.keyCode;if(d==_click)return!1;if("keydown"==d&&32==b)return c[_type]==r&&c[k]||(c[k]?q(a,k):x(a,k)),!1;if("keyup"==d&&c[_type]==r)!c[k]&&x(a,k);else if(/us|ur/.test(d))h["blur"==d?_remove:_add](s)});d.on(_click+" mousedown mouseup mouseover mouseout "+_touch,function(b){var d=
b[_type],e=/wn|up/.test(d)?t:v;if(!c[n]){if(d==_click)A(a,!1,!0);else{if(/wn|er|in/.test(d))h[_add](e);else h[_remove](e+" "+t);if(z.length&&B&&e==v)z[/ut|nd/.test(d)?_remove:_add](w)}if(_mobile)b.stopPropagation();else return!1}})})}})(window.jQuery||window.Zepto);
  
  /*! ddslick v2 http://designwithpc.com/Plugins/ddSlick, MIT Licensed */
(function (a) { function g(a, b) { var c = a.data("ddslick"); var d = a.find(".dd-selected"), e = d.siblings(".dd-selected-value"), f = a.find(".dd-options"), g = d.siblings(".dd-pointer"), h = a.find(".dd-option").eq(b), k = h.closest("li"), l = c.settings, m = c.settings.data[b]; a.find(".dd-option").removeClass("dd-option-selected"); h.addClass("dd-option-selected"); c.selectedIndex = b; c.selectedItem = k; c.selectedData = m; if (l.showSelectedHTML) { d.html((m.imageSrc ? '<img class="dd-selected-image' + (l.imagePosition == "right" ? " dd-image-right" : "") + '" src="' + m.imageSrc + '" />' : "") + (m.text ? '<label class="dd-selected-text">' + m.text + "</label>" : "") + (m.description ? '<small class="dd-selected-description dd-desc' + (l.truncateDescription ? " dd-selected-description-truncated" : "") + '" >' + m.description + "</small>" : "")) } else d.html(m.text); e.val(m.value); c.original.val(m.value); a.data("ddslick", c); i(a); /* j(a); */ if (typeof l.onSelected == "function") { l.onSelected.call(this, c) } } function h(b) { var c = b.find(".dd-select"), d = c.siblings(".dd-options"), e = c.find(".dd-pointer"), f = d.is(":visible"); a(".dd-click-off-close").not(d).slideUp(50); a(".dd-pointer").removeClass("dd-pointer-up"); if (f) { d.slideUp("fast"); e.removeClass("dd-pointer-up") } else { d.slideDown("fast"); e.addClass("dd-pointer-up") } k(b) } function i(a) { a.find(".dd-options").slideUp(50); a.find(".dd-pointer").removeClass("dd-pointer-up").removeClass("dd-pointer-up") } function j(a) { var b = a.find(".dd-select").css("height"); var c = a.find(".dd-selected-description"); var d = a.find(".dd-selected-image"); if (c.length <= 0 && d.length > 0) { a.find(".dd-selected-text").css("lineHeight", b) } } function k(b) { b.find(".dd-option").each(function () { var c = a(this); var d = c.css("height"); var e = c.find(".dd-option-description"); var f = b.find(".dd-option-image"); if (e.length <= 0 && f.length > 0) { c.find(".dd-option-text").css("lineHeight", d) } }) } a.fn.ddslick = function (c) { if (b[c]) { return b[c].apply(this, Array.prototype.slice.call(arguments, 1)) } else if (typeof c === "object" || !c) { return b.init.apply(this, arguments) } else { a.error("Method " + c + " does not exists.") } }; var b = {}, c = { data: [], keepJSONItemsOnTop: false, width: 260, height: null, background: "#eee", selectText: "", defaultSelectedIndex: null, truncateDescription: true, imagePosition: "left", showSelectedHTML: true, clickOffToClose: true, onSelected: function () { } }, d = '<div class="dd-select"><input class="dd-selected-value" type="hidden" /><a class="dd-selected"></a><span class="dd-pointer dd-pointer-down"></span></div>', e = '<ul class="dd-options"></ul>', f = '<style id="css-ddslick" type="text/css">' + ".dd-select{ border-radius:2px; border:solid 1px #ccc; position:relative; cursor:pointer;}" + ".dd-desc { color:#aaa; display:block; overflow: hidden; font-weight:normal; line-height: 1.4em; }" + ".dd-selected{ overflow:hidden; display:block; padding:5px; font-weight:bold;}" + ".dd-pointer{ width:0; height:0; position:absolute; right:10px; top:50%; margin-top:-3px;}" + ".dd-pointer-down{ border:solid 5px transparent; border-top:solid 5px #000; }" + ".dd-pointer-up{border:solid 5px transparent !important; border-bottom:solid 5px #000 !important; margin-top:-8px;}" + ".dd-options{ border:solid 1px #ccc; border-top:none; list-style:none; box-shadow:0px 1px 5px #ddd; display:none; position:absolute; z-index:2000; margin:0; padding:0;background:#fff; overflow:auto;}" + ".dd-option{ padding:5px; display:block; border-bottom:solid 1px #ddd; overflow:hidden; text-decoration:none; color:#333; cursor:pointer;-webkit-transition: all 0.25s ease-in-out; -moz-transition: all 0.25s ease-in-out;-o-transition: all 0.25s ease-in-out;-ms-transition: all 0.25s ease-in-out; }" + ".dd-options > li:last-child > .dd-option{ border-bottom:none;}" + ".dd-option:hover{ background:#f3f3f3; color:#000;}" + ".dd-selected-description-truncated { text-overflow: ellipsis; white-space:nowrap; }" + ".dd-option-selected { background:#f6f6f6; }" + ".dd-option-image, .dd-selected-image { vertical-align:middle; float:left; margin-right:5px; max-width:64px;}" + ".dd-image-right { float:right; margin-right:15px; margin-left:5px;}" + ".dd-container{ position:relative;}​ .dd-selected-text { font-weight:bold}​</style>"; if (a("#css-ddslick").length <= 0) { a(f).appendTo("head") } b.init = function (b) { var b = a.extend({}, c, b); return this.each(function () { var c = a(this), f = c.data("ddslick"); if (!f) { var i = [], j = b.data; c.find("option").each(function () { var b = a(this), c = b.data(); i.push({ text: a.trim(b.text()), value: b.val(), selected: b.is(":selected"), description: c.description, imageSrc: c.imagesrc }) }); if (b.keepJSONItemsOnTop) a.merge(b.data, i); else b.data = a.merge(i, b.data); var k = c, l = a('<div id="' + c.attr("id") + '"></div>'); c.replaceWith(l); c = l; c.addClass("dd-container").append(d).append(e); var i = c.find(".dd-select"), m = c.find(".dd-options"); m.css({ width: b.width }); i.css({ width: b.width, background: b.background }); c.css({ width: b.width }); if (b.height != null) m.css({ height: b.height, overflow: "auto" }); a.each(b.data, function (a, c) { if (c.selected) b.defaultSelectedIndex = a; m.append("<li>" + '<a class="dd-option">' + (c.value ? ' <input class="dd-option-value" type="hidden" value="' + c.value + '" />' : "") + (c.imageSrc ? ' <img class="dd-option-image' + (b.imagePosition == "right" ? " dd-image-right" : "") + '" src="' + c.imageSrc + '" />' : "") + (c.text ? ' <label class="dd-option-text">' + c.text + "</label>" : "") + (c.description ? ' <small class="dd-option-description dd-desc">' + c.description + "</small>" : "") + "</a>" + "</li>") }); var n = { settings: b, original: k, selectedIndex: -1, selectedItem: null, selectedData: null }; c.data("ddslick", n); if (b.selectText.length > 0 && b.defaultSelectedIndex == null) { c.find(".dd-selected").html(b.selectText) } else { var o = b.defaultSelectedIndex != null && b.defaultSelectedIndex >= 0 && b.defaultSelectedIndex < b.data.length ? b.defaultSelectedIndex : 0; g(c, o) } c.find(".dd-select").on("click.ddslick", function () { h(c) }); c.find(".dd-option").on("click.ddslick", function () { g(c, a(this).closest("li").index()) }); if (b.clickOffToClose) { m.addClass("dd-click-off-close"); c.on("click.ddslick", function (a) { a.stopPropagation() }); a("body").on("click", function () { a(".dd-click-off-close").slideUp(50).siblings(".dd-select").find(".dd-pointer").removeClass("dd-pointer-up") }) } } }) }; b.select = function (b) { return this.each(function () { if (b.index) g(a(this), b.index) }) }; b.open = function () { return this.each(function () { var b = a(this), c = b.data("ddslick"); if (c) h(b) }) }; b.close = function () { return this.each(function () { var b = a(this), c = b.data("ddslick"); if (c) i(b) }) }; b.destroy = function () { return this.each(function () { var b = a(this), c = b.data("ddslick"); if (c) { var d = c.original; b.removeData("ddslick").unbind(".ddslick").replaceWith(d) } }) } })(jQuery)

/* jquery.quickselect.min.js - https://github.com/dcparker/jquery_plugins/tree/master/quickselect */
function object(d){var s=function(){};s.prototype=d;return new s();}var QuickSelect;(function($){QuickSelect=function(d,f){var self=this;d=$(d);d.attr('autocomplete','off');self.options=f;self.AllItems={};var g=false,h=-1,j=false,k,l,m,n=false,o,p;if(/MSIE (\d+\.\d+);/.test(navigator.userAgent)){if(Number(RegExp.$1)<=7)n=true;}o=$('<div class="'+f.resultsClass+'" style="display:block;position:absolute;z-index:9999;"></div>').hide();p=$('<iframe />');p.css({border:'none',position:'absolute'});if(f.width>0){o.css("width",f.width);p.css("width",f.width);}$('body').append(o);o.hide();if(n)$('body').append(p);self.getLabel=function(A){return A.label||(typeof(A)==='string'?A:A[0])||'';};var r=function(A){return A.values||(A.value?[A.value]:(typeof(A)==='string'?[A]:A))||[];};var t=function(A){var B=$('li',o);if(!B)return;if(typeof(A)==="number")h=h+A;else h=B.index(A);if(h<0)h=0;else if(h>=B.size())h=B.size()-1;B.removeClass(f.selectedClass);$(B[h]).addClass(f.selectedClass);if(f.autoFill&&self.last_keyCode!=8){d.val(l+$(B[h]).text().substring(l.length));var C=l.length,D=d.val().length,E=d.get(0);if(E.createTextRange){var F=E.createTextRange();F.collapse(true);F.moveStart("character",C);F.moveEnd("character",D);F.select();}else if(E.setSelectionRange){E.setSelectionRange(C,D);}else if(E.selectionStart){E.selectionStart=C;E.selectionEnd=D;}E.focus();}};var u=function(){if(m){clearTimeout(m);}d.removeClass(f.loadingClass);if(o.is(":visible"))o.hide();if(p.is(":visible"))p.hide();h=-1;};self.selectItem=function(A,B){if(!A){A=document.createElement("li");A.item='';}var C=self.getLabel(A.item),D=r(A.item);d.lastSelected=C;d.val(C);l=C;o.empty();$(f.additionalFields).each(function(i,E){$(E).val(D[i+1]);});if(!B)u();if(f.onItemSelect)setTimeout(function(){f.onItemSelect(A);},1);return true;};var v=function(){var A=$("li."+f.selectedClass,o).get(0);if(A){return self.selectItem(A);}else{if(f.exactMatch){d.val('');$(f.additionalFields).each(function(i,B){$(B).val('');});}return false;}};var w=function(A){o.empty();if(!j||A===null||A.length===0)return u();var B=document.createElement("ul"),C=A.length,D=function(){t(this);},E=function(){},F=function(e){e.preventDefault();e.stopPropagation();self.selectItem(this);};o.append(B);if(f.maxVisibleItems>0&&f.maxVisibleItems<C)C=f.maxVisibleItems;for(var i=0;i<C;i++){var G=A[i],H=document.createElement("li");o.append(H);$(H).text(f.formatItem?f.formatItem(G,i,C):self.getLabel(G));H.item=G;if(G.className)H.className=G.className;B.appendChild(H);$(H).hover(D,E).click(F);}d.removeClass(f.loadingClass);return true;};var x=function(q,A){f.finderFunction.apply(self,[q,function(B){w(f.matchMethod.apply(self,[q,B]));A();}]);};var y=function(){var A=d.offset(),B=(f.width>0?f.width:d.width()),C=$('li',o);o.css({width:parseInt(B,10)+"px",top:A.top+d.height()+5+"px",left:A.left+"px"});if(n){p.css({width:parseInt(B,10)-2+"px",top:A.top+d.height()+6+"px",left:A.left+1+"px",height:o.height()-2+'px'}).show();}o.show();if(f.autoSelectFirst||(f.selectSingleMatch&&C.length==1))t(C.get(0));};var z=function(){if(k>=9&&k<=45){return;}var q=d.val();if(q==l)return;l=q;if(q.length>=f.minChars){d.addClass(f.loadingClass);x(q,y);}else{if(q.length===0&&(f.onBlank?f.onBlank():true))$(f.additionalFields).each(function(i,A){A.value='';});d.removeClass(f.loadingClass);o.hide();p.hide();}};o.mousedown(function(e){if(e.srcElement)g=e.srcElement.tagName!='DIV';});d.keydown(function(e){k=e.keyCode;switch(e.keyCode){case 38:e.preventDefault();t(-1);break;case 40:e.preventDefault();if(!o.is(":visible")){y();t(0);}else{t(1);}break;case 13:if(v()){e.preventDefault();d.select();}break;case 9:break;case 27:if(h>-1&&f.exactMatch&&d.val()!=$($('li',o).get(h)).text()){h=-1;}$('li',o).removeClass(f.selectedClass);u();e.preventDefault();break;default:if(m){clearTimeout(m);}m=setTimeout(z,f.delay);break;}}).focus(function(){j=true;}).blur(function(e){if(h>-1){v();}j=false;if(m){clearTimeout(m);}m=setTimeout(function(){u();if(f.exactMatch&&d.val()!=d.lastSelected){self.selectItem(null,true);}},200);});};QuickSelect.matchers={quicksilver:function(q,d){var f,g,self=this;f=(self.options.matchCase?q:q.toLowerCase());self.AllItems[f]=[];for(var i=0;i<d.length;i++){g=(self.options.matchCase?self.getLabel(d[i]):self.getLabel(d[i]).toLowerCase());if(g.score(f)>0){self.AllItems[f].push(d[i]);}}return self.AllItems[f].sort(function(a,b){a=(self.options.matchCase?self.getLabel(a):self.getLabel(a).toLowerCase());b=(self.options.matchCase?self.getLabel(b):self.getLabel(b).toLowerCase());a=a.score(f);b=b.score(f);return(a>b?-1:(b>a?1:0));});},contains:function(q,d){var f,g,self=this;f=(self.options.matchCase?q:q.toLowerCase());self.AllItems[f]=[];for(var i=0;i<d.length;i++){g=(self.options.matchCase?self.getLabel(d[i]):self.getLabel(d[i]).toLowerCase());if(g.indexOf(f)>-1){self.AllItems[f].push(d[i]);}}return self.AllItems[f].sort(function(a,b){a=(self.options.matchCase?self.getLabel(a):self.getLabel(a).toLowerCase());b=(self.options.matchCase?self.getLabel(b):self.getLabel(b).toLowerCase());var h=a.indexOf(f);var j=b.indexOf(f);return(h>j?-1:(h<j?1:(a>b?-1:(b>a?1:0))));});},startsWith:function(q,d){var f,g,self=this;f=(self.options.matchCase?q:q.toLowerCase());self.AllItems[f]=[];for(var i=0;i<d.length;i++){g=(self.options.matchCase?self.getLabel(d[i]):self.getLabel(d[i]).toLowerCase());if(g.indexOf(f)===0){self.AllItems[f].push(d[i]);}}return self.AllItems[f].sort(function(a,b){a=(self.options.matchCase?self.getLabel(a):self.getLabel(a).toLowerCase());b=(self.options.matchCase?self.getLabel(b):self.getLabel(b).toLowerCase());return(a>b?-1:(b>a?1:0));});}};QuickSelect.finders={data:function(q,d){d(this.options.data);},ajax:function(q,d){var f=this.options.ajax+"?q="+encodeURI(q);for(var i in this.options.ajaxParams){if(this.options.ajaxParams.hasOwnProperty(i)){f+="\x26"+i+"\x3d"+encodeURI(this.options.ajaxParams[i]);}}$.getJSON(f,d);}};$.fn.quickselect=function(d,f){if(d=='instance'&&$(this).data('quickselect'))return $(this).data('quickselect');d=d||{};d.data=(typeof(d.data)==="object"&&d.data.constructor==Array)?d.data:undefined;d.ajaxParams=d.ajaxParams||{};d.delay=d.delay||400;if(!d.delay)d.delay=(!d.ajax?400:10);d.minChars=d.minChars||1;d.cssFlavor=d.cssFlavor||'quickselect';d.inputClass=d.inputClass||d.cssFlavor+"_input";d.loadingClass=d.loadingClass||d.cssFlavor+"_loading";d.resultsClass=d.resultsClass||d.cssFlavor+"_results";d.selectedClass=d.selectedClass||d.cssFlavor+"_selected";d.finderFunction=d.finderFunction||QuickSelect.finders[!d.data?'ajax':'data'];if(d.finderFunction==='data'||d.finderFunction==='ajax')d.finderFunction=QuickSelect.finders[d.finderFunction];d.matchMethod=d.matchMethod||QuickSelect.matchers[(typeof(''.score)==='function'&&'\x6c'.score('\x6c')==1?'quicksilver':'contains')];if(d.matchMethod==='quicksilver'||d.matchMethod==='contains'||d.matchMethod==='startsWith')d.matchMethod=QuickSelect.matchers[d.matchMethod];if(d.matchCase===undefined)d.matchCase=false;if(d.exactMatch===undefined)d.exactMatch=false;if(d.autoSelectFirst===undefined)d.autoSelectFirst=true;if(d.selectSingleMatch===undefined)d.selectSingleMatch=true;if(d.additionalFields===undefined)d.additionalFields=$('nothing');d.maxVisibleItems=d.maxVisibleItems||-1;if(d.autoFill===undefined||d.matchMethod!='startsWith'){d.autoFill=false;}d.width=parseInt(d.width,10)||0;return this.each(function(){var g=this,h=object(d);if(g.tagName=='INPUT'){var j=new QuickSelect(g,h);$(g).data('quickselect',j);}else if(g.tagName=='SELECT'){h.delay=h.delay||10;h.finderFunction='data';var name=g.name,k=g.id,l=g.className,m=$(g).attr('accesskey'),n=$(g).attr('tabindex'),o=$("option:selected",g).get(0);h.data=[];$('option',g).each(function(i,t){h.data.push({label:$(t).text(),values:[t.value,t.value],className:t.className});});var p=$("<input type='text' class='"+l+"' id='"+k+"_quickselect' accesskey='"+m+"' tabindex='"+n+"' />");if(o){p.val($(o).text());}var r=$("<input type='hidden' id='"+k+"' name='"+g.name+"' />");if(o){r.val(o.value);}h.additionalFields=r;$(g).after(p).after(r).remove();p.quickselect(h);}});};})(jQuery);

// String Scoring Algorithm 0.1.22 | (c) 2009-2015 Joshaven Potter <yourtech@gmail.com>
// MIT License: http://opensource.org/licenses/MIT | https://github.com/joshaven/string_score
String.prototype.score=function(e,f){if(this===e)return 1;if(""===e)return 0;var d=0,a,g=this.toLowerCase(),n=this.length,h=e.toLowerCase(),k=e.length,b;a=0;var l=1,m,c;f&&(m=1-f);if(f)for(c=0;c<k;c+=1)b=g.indexOf(h[c],a),-1===b?l+=m:(a===b?a=.7:(a=.1," "===this[b-1]&&(a+=.8)),this[b]===e[c]&&(a+=.1),d+=a,a=b+1);else for(c=0;c<k;c+=1){b=g.indexOf(h[c],a);if(-1===b)return 0;a===b?a=.7:(a=.1," "===this[b-1]&&(a+=.8));this[b]===e[c]&&(a+=.1);d+=a;a=b+1}d=.5*(d/n+d/k)/l;h[0]===g[0]&&.85>d&&(d+=.15);return d};