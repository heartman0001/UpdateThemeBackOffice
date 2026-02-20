<?
include("../lib/session.php");
include("../lib/config.php");
include("../lib/connect.php");
include("../lib/function.php");
include("../lib/checkMember.php");
include("../lib/checkMemberSA.php");
include("../core/incLang.php");
include("../core/config.php");

$valClassNav=2;
$valNav1=$langTxt["nav:home2"];
$valLinkNav1="../core/index.php";
$valNav2=$langTxt["nav:userManage2"];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="robots" content="noindex, nofollow">
<meta name="googlebot" content="noindex, nofollow">
<link href="../css/theme.css" rel="stylesheet"/>

<title><?=$core_name_title?></title>
<script language="JavaScript"  type="text/javascript" src="../lib/ActiveDirectory/js/scriptName.js<?php echo $lastModify ?>"></script>
<script language="JavaScript"  type="text/javascript" src="../js/scriptCoreWeweb.js<?php echo $lastModify ?>"></script>
<script language="JavaScript"  type="text/javascript" src="../js/validate-password/script-validate-form.js<?php echo $lastModify ?>"></script>
<script language="JavaScript"  type="text/javascript" src="../js/validate-password/script.js<?php echo $lastModify ?>"></script>
<script language="JavaScript" type="text/javascript">
function executeSubmit() {
	with(document.myForm) {
		if(inputgroupid.value==0) { 
			inputgroupid.focus();
			jQuery("#inputgroupid").addClass("formInputContantTbAlertY"); 
			return false; 
		}else{ 
			jQuery("#inputgroupid").removeClass("formInputContantTbAlertY"); 
		}
		
    // if(inputTypeUser.value==0) { 
    //   inputTypeUser.focus();
    //   jQuery("#inputTypeUser").addClass("formInputContantTbAlertY"); 
    //   return false; 
    // }else{ 
    //   jQuery("#inputTypeUser").removeClass("formInputContantTbAlertY"); 
    // }
	/*	if(inputUnitID.value==0) { 
			inputUnitID.focus();
			jQuery("#inputUnitID").addClass("formInputContantTbAlertY"); 
			return false; 
		}else{ 
			jQuery("#inputUnitID").removeClass("formInputContantTbAlertY"); 
		}
		*/
		
		if(isBlank(inputUserName)) {
			inputUserName.focus();
			jQuery("#inputUserName").addClass("formInputContantTbAlertY"); 
			return false; 
		}else{ 
			jQuery("#inputUserName").removeClass("formInputContantTbAlertY"); 
		}
		
    if (inputTypeUser.value==1) {
  		if(isBlank(inputPassword)) {
  			inputPassword.focus();
  			jQuery("#inputPassword").addClass("formInputContantTbAlertY"); 
  			return false; 
  		}else{ 
  			jQuery("#inputPassword").removeClass("formInputContantTbAlertY"); 
  		}
  		
          // Check case condition password 
        if (!password_status1) {
          inputPassword.focus();
          jQuery("#inputPassword").addClass("formInputContantTbAlertY");
          return false;

        } else {
          jQuery("#inputPassword").removeClass("formInputContantTbAlertY");
        }
  		if(isBlank(inputPassword1)) {
  			inputPassword1.focus();
  			jQuery("#inputPassword1").addClass("formInputContantTbAlertY"); 
  			return false; 
  		}else{ 
  			jQuery("#inputPassword1").removeClass("formInputContantTbAlertY"); 
  		}

  		if (inputPassword.value!=inputPassword1.value) {	
  			inputPassword1.focus(); 
  			jQuery("#inputPassword").addClass("formInputContantTbAlertY"); 
  			jQuery("#inputPassword1").addClass("formInputContantTbAlertY"); 
  			return false;
  		}else{
  			jQuery("#inputPassword").removeClass("formInputContantTbAlertY"); 
  			jQuery("#inputPassword1").removeClass("formInputContantTbAlertY"); 
  		}

      if(isBlank(inputFixid)) {
  			inputFixid.focus();
  			jQuery("#inputFixid").addClass("formInputContantTbAlertY"); 
  			return false; 
  		}else{ 
  			jQuery("#inputFixid").removeClass("formInputContantTbAlertY"); 
  		}

  		if(isBlank(inputfnamethai)) {
  			inputfnamethai.focus();
  			jQuery("#inputfnamethai").addClass("formInputContantTbAlertY"); 
  			return false; 
  		}else{ 
  			jQuery("#inputfnamethai").removeClass("formInputContantTbAlertY"); 
  		}

  		
  		if(isBlank(inputlnamethai)) {
  			inputlnamethai.focus();
  			jQuery("#inputlnamethai").addClass("formInputContantTbAlertY"); 
  			return false; 
  		}else{ 
  			jQuery("#inputlnamethai").removeClass("formInputContantTbAlertY"); 
  		}

  		
  		if(isBlank(inputfnameeng)) {
  			inputfnameeng.focus();
  			jQuery("#inputfnameeng").addClass("formInputContantTbAlertY"); 
  			return false; 
  		}else{ 
  			jQuery("#inputfnameeng").removeClass("formInputContantTbAlertY"); 
  		}

  		
  		if(isBlank(inputlnameeng)) {
  			inputlnameeng.focus();
  			jQuery("#inputlnameeng").addClass("formInputContantTbAlertY"); 
  			return false; 
  		}else{ 
  			jQuery("#inputlnameeng").removeClass("formInputContantTbAlertY"); 
  		}

  		
  		/*if(isBlank(inputemail)) {
  			inputemail.focus();
  			jQuery("#inputemail").addClass("formInputContantTbAlertY"); 
  			return false; 
  		}else{ 
  			jQuery("#inputemail").removeClass("formInputContantTbAlertY"); 
  		}

  		
  		if (!isEmail(inputemail.value)) {
  			inputemail.focus();
  			jQuery("#inputemail").addClass("formInputContantTbAlertY"); 
  			return false; 
  		}else{ 
  			jQuery("#inputemail").removeClass("formInputContantTbAlertY"); 
  		}*/
    }

	}
	
	insertContactNew('../core/insertUs.php');
	
}


function loadCheckUser() {
  with(document.myForm) {
    var inputValuename =document.myForm.inputUserName.value;
    var inputValueTypeUser =document.myForm.inputTypeUser.value;
    }
    

    if( inputValuename!=''){
      checkUsermember(inputValuename);
    }

    if(inputValueTypeUser == 2){
      checkUsermemberOA(inputValuename);
    }
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
    <input name="masterkey" type="hidden" id="masterkey" value="<?=$_REQUEST['masterkey']?>" />
    <input name="menukeyid" type="hidden" id="menukeyid" value="<?=$_REQUEST['menukeyid']?>" />
    <input name="inputSearch" type="hidden" id="inputSearch" value="<?=$_REQUEST['inputSearch']?>" />
    <input name="module_pageshow" type="hidden" id="module_pageshow" value="<?=$_REQUEST['module_pageshow']?>" />
    <input name="module_pagesize" type="hidden" id="module_pagesize" value="<?=$_REQUEST['module_pagesize']?>" />
    <input name="module_orderby" type="hidden" id="module_orderby" value="<?=$_REQUEST['module_orderby']?>" />
     <? include("./inc-input-us-array.php");?> 

					<div class="divRightNav">
                        <table width="96%" border="0" cellspacing="0" cellpadding="0"  align="center" >
                        <tr>
                        <td  class="divRightNavTb" align="left"  id="defTop" ><span class="fontContantTbNav"><a href="<?=$valLinkNav1?>" target="_self"><?=$valNav1?></a> <img src="../img/btn/nav.png" align="absmiddle" vspace="5" /> <a  href="javascript:void(0)"  onclick="btnBackPage('../core/userManage.php')" target="_self"><?=$valNav2?></a> <img src="../img/btn/nav.png" align="absmiddle" vspace="5" /> <?=$langTxt["us:crepermis"]?></span></td>
                        <td  class="divRightNavTb" align="right">
                        

                        
                        </td>
                        </tr>
                        </table>
					</div>
                            <div class="divRightHead">
                                <table width="96%" border="0" cellspacing="0" cellpadding="0" class="borderBottom" align="center" >
                                  <tr>
                                    <td height="77" align="left"><span class="fontHeadRight"><?=$langTxt["us:crepermis"]?></span></td>
                                    <td align="left">
                                            <table  border="0" cellspacing="0" cellpadding="0" align="right">
                                                <tr>
                                                    <td align="right">
                                                        <div  class="btnSave" title="<?=$langTxt["btn:save"]?>" onclick="executeSubmit();"></div>
                                                        <div  class="btnBack" title="<?=$langTxt["btn:back"]?>" onclick="btnBackPage('../core/userManage.php')"></div>
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
    <span class="formFontSubjectTxt"><?=$langTxt["us:titleuser"]?></span><br/>
    <span class="formFontTileTxt"><?=$langTxt["us:titleuserDe"]?></span>    </td>
    </tr>
     <tr >
        <td colspan="7" align="right"  valign="top"   height="15" ></td>
    </tr>
     <tr >
    <td width="18%" align="right"  valign="top"  class="formLeftContantTb" ><?=$langTxt["us:permission"]?><span class="fontContantAlert">*</span></td>
    <td width="82%" colspan="6" align="left"  valign="top"  class="formRightContantTb" >
    <select name="inputgroupid"  id="inputgroupid"class="formSelectContantTb">
        <option value="0"><?=$langTxt["us:selectpermission"]?> </option>
        <? 
	$sql_group = "SELECT ".$core_tb_group."_id,".$core_tb_group."_name  FROM ".$core_tb_group." WHERE ".$core_tb_group."_status='Enable' ORDER BY ".$core_tb_group."_order DESC ";
		$query_group=wewebQueryDB($coreLanguageSQL,$sql_group);
		while($row_group=wewebFetchArrayDB($coreLanguageSQL,$query_group)) {
		$row_groupid=$row_group[0];
		$row_groupname=$row_group[1];
		
		?>
        <option value="<?=$row_groupid?>"  <?php if($_REQUEST['inputGh'] == $row_groupid){?>selected<?php }?>><?=$row_groupname?></option>
        <? }?>
    </select></td>
  </tr>
  
   
  <tr >
    <td width="18%" align="right"  valign="top"  class="formLeftContantTb" ><?=$langTxt["txt:typeuser"]?><span class="fontContantAlert">*</span></td>
    <td width="82%" colspan="6" align="left"  valign="top"  class="formRightContantTb" >
        <?php
        foreach ($arrTypeUser as $key => $value) {
        ?>
        <label>
          <div class="formDivRadioL"><input name="inputTypeUser" id="inputTypeUser" type="radio" class="formRadioContantTb" <?  if($_REQUEST['inputUT']==$key || $key == 1){ ?> checked="checked" <?  }?> value="<?=$key?>" /></div>
          <div class="formDivRadioR"><?=$value?></div>
        </label>
        <? }?>
    </td>
  </tr>
    <tr  style="display:none;">
    <td width="18%" align="right"  valign="top"  class="formLeftContantTb" ><?=$langTxt["us:part"]?><span class="fontContantAlert"></span></td>
    <td width="82%" colspan="6" align="left"  valign="top"  class="formRightContantTb" ><input name="inputPart" id="inputPart" type="text"  class="formInputContantTb"  /></td>
  </tr>
  <tr >
    <td width="18%" align="right"  valign="top"  class="formLeftContantTb" ><?=$langTxt["us:nameuser"]?><span class="fontContantAlert">*</span></td>
    <td width="82%" colspan="6" align="left"  valign="top"  class="formRightContantTb" ><input name="inputUserName" id="inputUserName" type="text"  class="formInputContantTb" onblur="loadCheckUser()" /></td>
  </tr>
    <tr class="typePrivate" <?  if($_REQUEST['inputUT']== 2){ ?> style="display:none;" <?  }?> >
    <td width="18%" align="right"  valign="top"  class="formLeftContantTb" ><?=$langTxt["us:pass"]?><span class="fontContantAlert">*</span></td>
    <td width="82%" colspan="6" align="left"  valign="top"  class="formRightContantTb" >

      <div class="control-group-password">
        <input name="inputPassword" id="inputPassword" type="password"  class="formInputContantTbShot"/>
        <button type="button" id="togglePassword" data-toggle="password" data-target="inputPassword" class="feather icon-eye-off"></button>

      </div>

<!-- Condition check password  -->
<div class="password-progress pt-2" id="popover-password">

<ul class="list-unstyled">
  <li class="check">
    <span class="-notify one-number">
      <i class="feather error icon-x" aria-hidden="true"></i>
    </span>
    &nbsp;ประกอบด้วยตัวเลข (0-9)
  </li>
  <li class="check">
    <span class="-notify low-case">
      <i class="feather error icon-x" aria-hidden="true"></i>
    </span>
    &nbsp;ประกอบด้วยตัวอักษรตัวพิมพ์เล็ก
  </li>
  <li class="check">
    <span class="-notify upper-case">
      <i class="feather error icon-x" aria-hidden="true"></i>
    </span>
    &nbsp;ประกอบด้วยตัวอักษรตัวพิมพ์ใหญ่
  </li>
  <li class="check">
    <span class="-notify one-special-char">
      <i class="feather error icon-x" aria-hidden="true"></i>
    </span>
    &nbsp;ประกอบด้วยตัวอักษรพิเศษ (!@#$%^&amp;*)
  </li>
  <li class="check">
    <span class="-notify eight-character">
      <i class="feather error icon-x" aria-hidden="true"></i>
    </span>
    &nbsp;ประกอบด้วยตัวอักษรอย่างน้อย 8 ตัวอักษร
  </li>
</ul>
</div>
<!-- End condition  -->

    </td>
  </tr>
  <tr class="typePrivate" <?  if($_REQUEST['inputUT']== 2){ ?> style="display:none;" <?  }?> >
    <td width="18%" align="right"  valign="top"  class="formLeftContantTb" ><?=$langTxt["us:repass"]?><span class="fontContantAlert">*</span></td>
    <td width="82%" colspan="6" align="left"  valign="top"  class="formRightContantTb" >
      <div class="control-group-password">
        <input name="inputPassword1" id="inputPassword1" type="password"  class="formInputContantTbShot"/>
        <button type="button" id="togglePasswordII" data-toggle="password" data-target="inputPassword1" class="feather icon-eye-off"></button>

      </div>

      <div class="password-progress error-password-same" style="display: none;" id="error-password-same">
      <ul class="list-unstyled">
        <li class="check" style="color: red; margin-top: 10px;">
          <i class="feather error icon-alert-circle" aria-hidden="true"></i>
          &nbsp;รหัสผ่านจะต้องเหมือนกัน
        </li>
      </ul>
    </div>
    </td>
  </tr>
  </table>
  <br />
<table width="96%" border="0" cellspacing="0" cellpadding="0" align="center" class="tbBoxViewBorder typePrivate"  <?  if($_REQUEST['inputUT']== 2){ ?> style="display:none;" <?  }?> >

  <tr >
    <td colspan="7" align="left"  valign="middle" class="formTileTxt tbBoxViewBorderBottom">
    <span class="formFontSubjectTxt"><?=$langTxt["us:titlesystem"]?></span><br/>
    <span class="formFontTileTxt"><?=$langTxt["us:titlesystemDe"]?></span>    </td>
    </tr>
  <tr >
        <td colspan="7" align="right"  valign="top"   height="15" ></td>
    </tr>
  <tr>
    <td width="18%" align="right"  valign="top"  class="formLeftContantTb" ><?=$langTxt["us:unitMain"]?><span class="fontContantAlert">*</span></td>
    <td width="82%" colspan="6" align="left"  valign="top"  class="formRightContantTb" id="showFixID">
    <select name="inputFixid"  id="inputFixid"class="formSelectContantTb">
        <option value="0"><?=$langTxt["us:selectUnitMain"]?> </option>
        <?
         //$sql_fix = "SELECT ";
         //$sql_fix .= "  " . $core_tb_fix . "_id," . $core_tb_fix . "_subject";
         //$sql_fix .= "  FROM " . $core_tb_fix . " WHERE  " . $core_tb_fix . "_masterkey ='" . $core_tb_fix_masterkey . "'     AND  ".$core_tb_fix."_status !='Disable' ORDER BY " . $core_tb_fix . "_order DESC ";
         //$query_fix = wewebQueryDB($coreLanguageSQL,$sql_fix);
         //while ($row_fix = wewebFetchArrayDB($coreLanguageSQL,$query_fix)) {
          //    $row_fixid = $row_fix[0];
          //    $row_fixname = $row_fix[1];
              ?>
              <!-- <option value="<?= $row_fixid ?>" <? if ($_REQUEST['inputFixid'] == $row_fixid) { ?> selected="selected" <? } ?>><?= $row_fixname ?></option> -->
          <? // } ?>
    </select></td>
  </tr>
  <tr>
    <td width="18%" align="right"  valign="top"  class="formLeftContantTb" ><?=$langTxt["us:unitSub"]?><span class="fontContantAlert"></span></td>
    <td width="82%" colspan="6" align="left"  valign="top"  class="formRightContantTb" id="showFixIDSub">
    <select name="inputFixSubid"  id="inputFixSubid" class="formSelectContantTb" >
        <option value="0"><?=$langTxt["us:selectUnitSub"]?> </option>
    </select></td>
  </tr>

  <tr >
    <td width="18%" align="right"  valign="top"  class="formLeftContantTb" ><?=$langTxt["us:antecedent"]?><span class="fontContantAlert">*</span></td>
    <td width="82%" colspan="6" align="left"  valign="top"  class="formRightContantTb" >
     <label>
    <div class="formDivRadioL"><input name="inputPrefix" id="inputPrefix" type="radio" class="formRadioContantTb" checked="checked" value="Mr." onclick="
document.myForm.inputGender[0].checked=true
    " /></div>
    <div class="formDivRadioR"><?=$langTxt["us:mr"]?></div>
    </label>
  
    <label>
    <div class="formDivRadioL"><input name="inputPrefix" id="inputPrefix" type="radio" class="formRadioContantTb"  value="Miss"  onclick="
document.myForm.inputGender[1].checked=true " /></div>
    <div class="formDivRadioR"><?=$langTxt["us:miss"]?></div>
    </label>
      <label>
    <div class="formDivRadioL"><input name="inputPrefix" id="inputPrefix" type="radio" class="formRadioContantTb" value="Mrs." onclick="
document.myForm.inputGender[1].checked=true    " /></div>
    <div class="formDivRadioR"><?=$langTxt["us:mrs"]?></div>
    </label>   </td>
  </tr>
  <tr >
    <td width="18%" align="right"  valign="top"  class="formLeftContantTb" ><?=$langTxt["us:sex"]?><span class="fontContantAlert">*</span></td>
    <td width="82%" colspan="6" align="left"  valign="top"  class="formRightContantTb" >
     <label>
    <div class="formDivRadioL"><input name="inputGender" id="inputGender" type="radio" class="formRadioContantTb" checked="checked" 
    onclick="document.myForm.inputPrefix[0].checked=true" value="Male"  /></div>
    <div class="formDivRadioR"><?=$langTxt["us:male"]?></div>
    </label>
  
    
      <label>
    <div class="formDivRadioL"><input name="inputGender" id="inputGender" type="radio" class="formRadioContantTb"  onclick="document.myForm.inputPrefix[1].checked=true" value="Female"  /></div>
    <div class="formDivRadioR"><?=$langTxt["us:female"]?></div>
    </label>   </td>
  </tr>
      <tr >
    <td width="18%" align="right"  valign="top"  class="formLeftContantTb" ><?=$langTxt["us:firstnamet"]?><span class="fontContantAlert">*</span></td>
    <td width="82%" colspan="6" align="left"  valign="top"  class="formRightContantTb" ><input name="inputfnamethai" id="inputfnamethai" type="text"  class="formInputContantTb"/></td>
  </tr>
    <tr >
    <td width="18%" align="right"  valign="top"  class="formLeftContantTb" ><?=$langTxt["us:lastnamet"]?><span class="fontContantAlert">*</span></td>
    <td width="82%" colspan="6" align="left"  valign="top"  class="formRightContantTb" ><input name="inputlnamethai" id="inputlnamethai" type="text"  class="formInputContantTb"/></td>
  </tr>
    <tr >
    <td width="18%" align="right"  valign="top"  class="formLeftContantTb" ><?=$langTxt["us:firstnamete"]?><span class="fontContantAlert">*</span></td>
    <td width="82%" colspan="6" align="left"  valign="top"  class="formRightContantTb" ><input name="inputfnameeng" id="inputfnameeng" type="text"  class="formInputContantTb"/></td>
  </tr>
    <tr >
    <td width="18%" align="right"  valign="top"  class="formLeftContantTb" ><?=$langTxt["us:lastnamee"]?><span class="fontContantAlert">*</span></td>
    <td width="82%" colspan="6" align="left"  valign="top"  class="formRightContantTb" ><input name="inputlnameeng" id="inputlnameeng" type="text"  class="formInputContantTb"/></td>
  </tr>
   <tr >
    <td width="18%" align="right"  valign="top"  class="formLeftContantTb" ><?=$langTxt["set:position"]?><span class="fontContantAlert"></span></td>
    <td width="82%" colspan="6" align="left"  valign="top"  class="formRightContantTb" ><input name="inputPosirionUser" id="inputPosirionUser" type="text"  class="formInputContantTb"/></td>
  </tr>
    <tr >
    <td width="18%" align="right"  valign="top"  class="formLeftContantTb" ><?=$langTxt["us:email"]?><span class="fontContantAlert"></span></td>
    <td width="82%" colspan="6" align="left"  valign="top"  class="formRightContantTb" ><input name="inputemail" id="inputemail" type="text"  class="formInputContantTb"/></td>
  </tr>
     <!--  <tr >
    <td width="18%" align="right"  valign="top"  class="formLeftContantTb" ><?=$langTxt["us:position"]?><span class="fontContantAlert"></span></td>
    <td width="82%" colspan="6" align="left"  valign="top"  class="formRightContantTb" ><input name="inputPosition" id="inputPosition" type="text"  class="formInputContantTb"/></td>
  </tr> -->
    <tr >
    <td width="18%" align="right"  valign="top"  class="formLeftContantTb" ><?=$langTxt["us:address"]?></td>
    <td width="82%" colspan="6" align="left"  valign="top"  class="formRightContantTb" >
    <textarea name="inputlocation"  id="inputlocation" cols="20" rows="5" class="formTextareaContantTb"></textarea>    </td>
  </tr>
    <tr >
    <td width="18%" align="right"  valign="top"  class="formLeftContantTb" ><?=$langTxt["us:tel"]?></td>
    <td width="82%" colspan="6" align="left"  valign="top"  class="formRightContantTb" ><input name="inputtelephone" id="inputtelephone" type="text"  class="formInputContantTb"/></td>
  </tr>
    <tr >
    <td width="18%" align="right"  valign="top"  class="formLeftContantTb" ><?=$langTxt["us:mobile"]?></td>
    <td width="82%" colspan="6" align="left"  valign="top"  class="formRightContantTb" ><input name="inputmobile" id="inputmobile" type="text"  class="formInputContantTb"/></td>
  </tr>
  <tr >
    <td width="18%" align="right"  valign="top"  class="formLeftContantTb" ><?=$langTxt["us:other"]?></td>
    <td width="82%" colspan="6" align="left"  valign="top"  class="formRightContantTb" ><input name="inputother" id="inputother" type="text"  class="formInputContantTb"/></td>
  </tr>
   
</table>
<br />
<table width="96%" border="0" cellspacing="0" cellpadding="0" align="center">

   <tr >
      <td colspan="7" align="right"  valign="top" height="20"></td>
      </tr>
    <tr >
    <td colspan="7" align="right"  valign="middle" class="formEndContantTb"><a href="#defTop"  title="<?=$langTxt["btn:gototop"]?>"><?=$langTxt["btn:gototop"]?> <img src="../img/btn/top.png"  align="absmiddle"/></a></td>
    </tr>
  </table>
  </div>
</form>     
<? include("../lib/disconnect.php");?>

<script>
$(document).on('click','#inputTypeUser', function(){
  if($('#inputTypeUser:checked').val() == 2){
    $('.typePrivate').hide();
    loadCheckUser();
  }else{
    $('.typePrivate').show();
  }
});
</script>
</body>
</html>
