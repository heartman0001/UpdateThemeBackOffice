<?php
$menu_keyid = "900003";
include("../lib/session.php");
include("../lib/config.php");
include("../lib/connect.php");
include("../lib/function.php");
include("../lib/checkMember.php");
include("../lib/checkMemberSA.php");
include("../core/incLang.php");

$valClassNav=2;
$valNav1=$langTxt["nav:home2"];
$valLinkNav1="../core/index.php";
$valNav2=$langTxt["nav:perManage2"];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="robots" content="noindex, nofollow">
<meta name="googlebot" content="noindex, nofollow">

<link href="../css/theme.css" rel="stylesheet"/>

<title><?php echo $core_name_title?></title>
<script language="JavaScript"  type="text/javascript" src="../js/scriptCoreWeweb.js"></script>
<script language="JavaScript" type="text/javascript">
function executeSubmit() {
		genDataAdmin();
		document.myForm.Permission.value="";

	with(document.myForm) {
		if(inputaccess.value==0) { 
			inputaccess.focus();
			jQuery("#inputaccess").addClass("formInputContantTbAlertY"); 
			return false; 
		}else{ 
			jQuery("#inputaccess").removeClass("formInputContantTbAlertY"); 
		}
		
		if(isBlank(inputnamegroup)) {
			inputnamegroup.focus();
			jQuery("#inputnamegroup").addClass("formInputContantTbAlertY"); 
			return false; 
		}else{ 
			jQuery("#inputnamegroup").removeClass("formInputContantTbAlertY"); 
		}

	}
	
	insertContactNew('../core/insertPr.php');
	
}

jQuery(document).ready(function(){

  jQuery('#myForm').keypress(function(e) {
    if (e.which == 13) {
		//e.preventDefault();
		executeSubmit();
		return false; 
    }
  });
});



</script>
</head>

<body>
<form action="?" method="get" name="myForm" id="myForm">
    <input name="execute" type="hidden" id="execute" value="insert" />
    <input name="masterkey" type="hidden" id="masterkey" value="<?php echo $_REQUEST['masterkey']?>" />
    <input name="menukeyid" type="hidden" id="menukeyid" value="<?php echo $_REQUEST['menukeyid']?>" />
    <input name="inputSearch" type="hidden" id="inputSearch" value="<?php echo $_REQUEST['inputSearch']?>" />
    <input name="module_pageshow" type="hidden" id="module_pageshow" value="<?php echo $_REQUEST['module_pageshow']?>" />
    <input name="module_pagesize" type="hidden" id="module_pagesize" value="<?php echo $_REQUEST['module_pagesize']?>" />
    <input name="module_orderby" type="hidden" id="module_orderby" value="<?php echo $_REQUEST['module_orderby']?>" />
    <input name="inputGh" type="hidden" id="inputGh" value="<?php echo $_REQUEST['inputGh']?>" />
    <input name="PermissionAdmin" type="hidden" id="PermissionAdmin" value="" />
    <input name="Permission" type="hidden" id="Permission" value="" />
    
					<div class="divRightNav">
                        <table width="96%" border="0" cellspacing="0" cellpadding="0"  align="center" >
                        <tr>
                        <td  class="divRightNavTb" align="left"  id="defTop" ><span class="fontContantTbNav"><a href="<?php echo $valLinkNav1?>" target="_self"><?php echo $valNav1?></a> <img src="../img/btn/nav.png" align="absmiddle" vspace="5" /> <a  href="javascript:void(0)"  onclick="btnBackPage('../core/permisManage.php')" target="_self"><?php echo $valNav2?></a> <img src="../img/btn/nav.png" align="absmiddle" vspace="5" /> <?php echo $langTxt["pr:crepermis"]?></span></td>
                        <td  class="divRightNavTb" align="right">
                        

                        
                        </td>
                        </tr>
                        </table>
					</div>
                            <div class="divRightHead">
                                <table width="96%" border="0" cellspacing="0" cellpadding="0" class="borderBottom" align="center" >
                                  <tr>
                                    <td height="77" align="left"><span class="fontHeadRight"><?php echo $langTxt["pr:crepermis"]?></span></td>
                                    <td align="left">
                                            <table  border="0" cellspacing="0" cellpadding="0" align="right">
                                                <tr>
                                                    <td align="right">
                                                        <div  class="btnSave" title="<?php echo $langTxt["btn:save"]?>" onclick="executeSubmit();"></div>
                                                        <div  class="btnBack" title="<?php echo $langTxt["btn:back"]?>" onclick="btnBackPage('../core/permisManage.php')"></div>
                                                    </td>
                                                </tr>
                                            </table>
                                    </td>
                                  </tr>
                                </table>
                            </div>
                             <div class="divRightMain" >
    <br />
    <table width="96%" border="0" cellspacing="0" cellpadding="0" align="center" class="tbBoxViewBorder ">
  <tr >
    <td colspan="7" align="left"  valign="middle" class="formTileTxt tbBoxViewBorderBottom">
    <span class="formFontSubjectTxt"><?php echo $langTxt["pr:title"]?></span><br/>
    <span class="formFontTileTxt"><?php echo $langTxt["pr:titleDe"]?></span>    </td>
    </tr>
     <tr >
        <td colspan="7" align="right"  valign="top"   height="15" ></td>
    </tr>
  <tr >
    <td width="18%" align="right"  valign="top"  class="formLeftContantTb" ><?php echo $langTxt["pr:pretype"]?><span class="fontContantAlert">*</span></td>
    <td width="82%" colspan="6" align="left"  valign="top"  class="formRightContantTb" >
    <select name="inputaccess"  id="inputaccess"class="formSelectContantTb">
        <option value="0"><?php echo $langTxt["pr:select"]?></option>
        <option value="admin" <?php if($_REQUEST['inputGh']=="admin"){?>selected="selected" <?php }?>><?php echo $langTxt["pr:select1"]?></option>
        <option value="staff" <?php if($_REQUEST['inputGh']=="staff"){?>selected="selected" <?php }?>><?php echo $langTxt["pr:select2"]?></option>
    </select></td>
  </tr>
    <tr >
    <td width="18%" align="right"  valign="top"  class="formLeftContantTb" ><?php echo $langTxt["pr:pername"]?><span class="fontContantAlert">*</span></td>
    <td width="82%" colspan="6" align="left"  valign="top"  class="formRightContantTb" ><input name="inputnamegroup" id="inputnamegroup" type="text"  class="formInputContantTb"/></td>
  </tr>
  </table>
<br />
<table width="96%" border="0" cellspacing="0" cellpadding="0" align="center" class="tbBoxViewBorder card-permis">

  <tr >
    <td colspan="7" align="left"  valign="middle" class="formTileTxt tbBoxViewBorderBottom">
    <span class="formFontSubjectTxt"><?php echo $langTxt["pr:titlePer"]?></span><br/>
    <span class="formFontTileTxt"><?php echo $langTxt["pr:titlePerDe"]?></span>    </td>
    </tr>
  
   <tr >
    <td colspan="7" align="left"  valign="top" class="formTileTxt table-responsive list-responsive">
    
    <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
   <tr ><td align="left"  valign="middle"  class="tbRightTitleTbL" >
       <span class="fontTitlTbRight"><?php echo $langTxt["mg:subject"]?>
        </span></td>

    <td width="18%"  class="tbRightTitleTb"  valign="middle"  align="center"><span onclick="checkAllAdmin('AdminR');"  style="cursor:pointer;color:#FFCC00;"  class="fontTitlTbRight" ><?php echo $langTxt["pr:all"]?></span></td>
    <td width="18%"  class="tbRightTitleTb"  valign="middle"  align="center"><span onclick="checkAllAdmin('AdminRW');"  style="cursor:pointer;color:#00CC00;"  class="fontTitlTbRight"><?php echo $langTxt["pr:all"]?></span></td>
    <td width="18%"  class="tbRightTitleTbR"  valign="middle"  align="center"><span onclick="checkAllAdmin('AdminNA');"  style="cursor:pointer;color:#FF0000;"  class="fontTitlTbRight"><?php echo $langTxt["pr:all"]?></span></td>
  </tr>
   <?php
	// Admin
	$Field=$core_tb_menu;
	$sqlTopic="SELECT * FROM ".$core_tb_menu." WHERE  ".$core_tb_menu."_parentID = '0' AND ".$core_tb_menu."_status = 'Enable'     ORDER BY ".$Field."_order";
	$QueryTopic=wewebQueryDB($coreLanguageSQL,$sqlTopic) ;

	if(wewebNumRowsDB($coreLanguageSQL,$QueryTopic)<=0){
	?>
     <tr >
    <td colspan="4" align="center"  valign="middle"  class="divRightContantTbRL" style="padding-top:150px; padding-bottom:150px;" ><?php echo $langTxt["mg:nodate"]?></td>
    </tr>
    <?php }else{
			$topicIndex=0;	
			while($topic1=wewebFetchArrayDB($coreLanguageSQL,$QueryTopic)){
			$dataArrAdmin[$topicIndex][0]=$topic1[$Field."_id"];
			$dataArrAdmin[$topicIndex][1]=$topic1[$Field."_id"];
			
			if($_SESSION[$valSiteManage.'core_session_language']=="Thai"){
				$row_namelv1=$topic1[$Field."_namethai"];
			}else if($_SESSION[$valSiteManage.'core_session_language']=="Eng"){
				$row_namelv1=$topic1[$Field."_nameeng"];
			}
			
			$topicIndex+=1;
			
	?>
 
  <tr class="divOverTb" >
     <td  class="divRightContantOverTbL"  valign="top" align="left"  style="padding-left:15px;">
     <?php if($topic1[$Field."_icon"]){?><img src="<?php echo $topic1[$Field."_icon"]?>" border="0" align="absmiddle"  hspace="10" /><?php } else{ ?> - <?php } ?><?php echo $row_namelv1?>
        </td>
    <td  class="divRightContantOverTb"   valign="top" align="center" >
    <div  style="width:125px; margin:0 auto; text-align:center;">
    <label>
    <div class="formDivRadioL">
    <input name="Admin<?php echo $topic1[$Field."_id"]?>" id="AdminR<?php echo $topic1[$Field."_id"]?>" type="radio" class="formRadioContantTb" value="R" onclick="checkInSubAdmin('AdminR',<?php echo $topic1[$Field."_id"]?>)" /></div>
    <div class="formDivRadioR" style="color:#FFCC00;"><?php echo $langTxt["pr:read"]?></div>
    </label>
    </div>
    </td>
    <td  class="divRightContantOverTb"  valign="top"  align="center">
    <div  style="width:118px; margin:0 auto; text-align:center;">
    <label>
    <div class="formDivRadioL">
    <input name="Admin<?php echo $topic1[$Field."_id"]?>"  id="AdminRW<?php echo $topic1[$Field."_id"]?>"type="radio" class="formRadioContantTb"  value="RW" onclick="checkInSubAdmin('AdminRW',<?php echo $topic1[$Field."_id"]?>)" /></div>
    <div class="formDivRadioR"  style="color:#00CC00;"><?php echo $langTxt["pr:manage"]?></div>
    </label>
    </div>
    
    </td>
    
    <td  class="divRightContantOverTbR"  valign="top"  align="center">
  <div  style="width:145px; margin:0 auto; text-align:center;">
    <label>
    <div class="formDivRadioL">
    <input name="Admin<?php echo $topic1[$Field."_id"]?>" id="AdminNA<?php echo $topic1[$Field."_id"]?>" type="radio" class="formRadioContantTb" value="NA" onclick="checkInSubAdmin('AdminNA',<?php echo $topic1[$Field."_id"]?>)" /></div>
    <div class="formDivRadioR" style="color:#FF0000;"><?php echo $langTxt["pr:noaccess"]?></div>
    </label>
    </div>   </td>
    
  </tr>
  <?php
			$sqlSub="SELECT * FROM ".$core_tb_menu." WHERE   ".$core_tb_menu."_parentID = '".$topic1[$Field."_id"]."'   AND ".$core_tb_menu."_status = 'Enable'    ORDER BY ".$Field."_order";
			$QuerySub=wewebQueryDB($coreLanguageSQL,$sqlSub);
			if(wewebNumRowsDB($coreLanguageSQL,$QuerySub)>=1){
				while($subtopic1=wewebFetchArrayDB($coreLanguageSQL,$QuerySub)){
				$dataArrAdmin[$topicIndex][0]=$subtopic1[$Field."_id"];
				$dataArrAdmin[$topicIndex][1]=$subtopic1[$Field."_id"];
				
				if($_SESSION[$valSiteManage.'core_session_language']=="Thai"){
					$row_namelv2=$subtopic1[$Field."_namethai"];
				}else if($_SESSION[$valSiteManage.'core_session_language']=="Eng"){
					$row_namelv2=$subtopic1[$Field."_nameeng"];
				}
		
					$topicIndex+=1;
			?>
            
            <tr class="divSubOverTb" >
     <td  class="divRightContantTbL"  valign="top" align="left"  style="padding-left:35px;"    >
     <?php if($subtopic1[$Field."_icon"]){?><img src="<?php echo $subtopic1[$Field."_icon"]?>" border="0" align="absmiddle"   hspace="10"/><?php } else{ ?> - <?php } ?><?php echo $row_namelv2?>
        </td>
    <td  class="divRightContantTb"   valign="top" align="center" >
    <div  style="width:auto; margin:0 auto; text-align:center;">
    <label>
    <div class="formDivRadioL">
    <input name="Admin<?php echo $subtopic1[$Field."_id"]?>" id="AdminR<?php echo $subtopic1[$Field."_id"]?>" type="radio" class="formRadioContantTb" value="R" onclick="checkInSub('R',<?php echo $subtopic1[$Field."_id"]?>)" /></div>
    <div class="formDivRadioR" style="color:#FFCC00;"><span for="R<?php echo $subtopic1[$Field."_id"]?>"><?php echo $langTxt["pr:read"]?></span></div>
    </label>
    </div>
    </td>
    <td  class="divRightContantTb"  valign="top"  align="center">
    <div  style="width:auto; margin:0 auto; text-align:center;">
    <label>
    <div class="formDivRadioL">
    <input name="Admin<?php echo $subtopic1[$Field."_id"]?>"  id="AdminRW<?php echo $subtopic1[$Field."_id"]?>"type="radio" class="formRadioContantTb"  value="RW" onclick="checkInSub('RW',<?php echo $subtopic1[$Field."_id"]?>)" /></div>
    <div class="formDivRadioR"  style="color:#00CC00;"><span for="RW<?php echo $subtopic[$Field."_id"]?>"><?php echo $langTxt["pr:manage"]?></span></div>
    </label>
    </div>
    
    </td>
    
    <td  class="divRightContantTbR"  valign="top"  align="center">
  <div  style="width:auto; margin:0 auto; text-align:center;">
    <label>
    <div class="formDivRadioL">
    <input name="Admin<?php echo $subtopic1[$Field."_id"]?>" id="AdminNA<?php echo $subtopic1[$Field."_id"]?>" type="radio" class="formRadioContantTb" value="NA" onclick="checkInSub('NA',<?php echo $subtopic1[$Field."_id"]?>)" /></div>
    <div class="formDivRadioR" style="color:#FF0000;"><span for="NA<?php echo $subtopic1[$Field."_id"]?>"><?php echo $langTxt["pr:noaccess"]?></span></div>
    </label>
    </div>   </td>
    
  </tr>
            <?php
				}
			} ?>
     <?php 
	 
		 }
	 }
	 
	 ?>
  </table>
    </td>
    </tr>
  
  </table>
<br />
<table width="96%" border="0" cellspacing="0" cellpadding="0" align="center" >

   <tr >
      <td colspan="7" align="right"  valign="top" height="20"></td>
      </tr>
    <tr >
    <td colspan="7" align="right"  valign="middle" class="formEndContantTb"><a href="#defTop"  title="<?php echo $langTxt["btn:gototop"]?>"><?php echo $langTxt["btn:gototop"]?> <img src="../img/btn/top.png"  align="absmiddle"/></a></td>
    </tr>
  </table>
  </div>
</form>  
<script language="JavaScript" type="text/javascript">
 		  var	 idArrAdmin=new Array(<?php echo $topicIndex?>);
		  for(i=0;i<<?php echo $topicIndex?>;i++){
		  	 idArrAdmin[i]=new Array(2);
		  }
		<?php	for($i=0;$i<$topicIndex;$i++){
							echo  "idArrAdmin[".$i."][0]=".$dataArrAdmin[$i][0].";";
							echo  "idArrAdmin[".$i."][1]=".$dataArrAdmin[$i][1].";";
			}			
		?>		
		function  checkAllAdmin(type){
			for(i=0;i<<?php echo $topicIndex?>;i++){
					document.getElementById(type+idArrAdmin[i][0]).checked=true;
			}
		}
		
		function  checkInSubAdmin(type,topicId){
			for(i=0;i<<?php echo $topicIndex?>;i++){
					if(idArrAdmin[i][1]==topicId){
						document.getElementById(type+idArrAdmin[i][0]).checked=true;
					}
			}
		}
		
		function genDataAdmin(){
			var genStrAdmin="";
			for(i=0;i<<?php echo $topicIndex?>;i++){
			
						if(document.getElementById("AdminR"+idArrAdmin[i][0]).checked==true) {
							 genStrAdmin+=idArrAdmin[i][0]+":R"; 
						} else if(document.getElementById("AdminRW"+idArrAdmin[i][0]).checked==true) { 
							genStrAdmin+=idArrAdmin[i][0]+":RW"; 
						}else{
							genStrAdmin+=idArrAdmin[i][0]+":NA"; 
						}
						
						if(i!=<?php echo $topicIndex-1?>){
							genStrAdmin+=",";
						}
			}
		document.myForm.PermissionAdmin.value=genStrAdmin;
		}		



  </script>   
  <?php include("../lib/disconnect.php");?>

</body>
</html>
