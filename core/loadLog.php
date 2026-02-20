<?php
include("../lib/session.php");
include("../lib/config.php");
include("../lib/connect.php");
include("../lib/function.php");
include("../lib/checkMember.php");
include("../lib/checkMemberSA.php");
include("../core/incLang.php");
 
// Value SQL SELECT #########################
$sqlSelect = "".$core_tb_log."_action, ".$core_tb_log."_sessid, ".$core_tb_log."_sid, ".$core_tb_log."_sname, ".$core_tb_log."_ip, ".$core_tb_log."_time, ".$core_tb_log."_type, ".$core_tb_log."_actiontype 	, ".$core_tb_log."_url, ".$core_tb_log."_key, ".$core_tb_log."_menuid";

	if($coreLanguageSQL=="mssql"){
	$valLimitTop ="TOP (10)";
	$valLimitMysql ="";
	}else{
	$valLimitTop ="";
	$valLimitMysql =" LIMIT 0,10";
	}
	$sqlLogs="SELECT ".$valLimitTop." ".$sqlSelect."    FROM ".$core_tb_log." WHERE   ".$core_tb_log."_id 	>=1 ORDER BY ".$core_tb_log."_time DESC  ".$valLimitMysql."";
	
	$queryLogs=wewebQueryDB($coreLanguageSQL,$sqlLogs);
	$countLogs=wewebNumRowsDB($coreLanguageSQL,$queryLogs);
	if($countLogs>=1){
	$indexLog=0;
	?>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" >

  
<tr>
    <td  class="divRightTrHomeLog"  style="padding-left:20px;" valign="top"><b><?php echo $langTxt["mg:subject"]?></b></td>
    <td width="15%" height="30" align="center"  class="divRightTrHomeLog" valign="top"><b><?php echo $langTxt["home:access"]?></b></td>
    <td width="15%" align="center"  class="divRightTrHomeLog" valign="top"><b><?php echo $langTxt["us:creby"]?></b></td>
    <td width="23%"  align="center"  class="divRightTrHomeLog" valign="top"><b><?php echo $langTxt["home:date"]?></b></td>
  </tr>

    <?php
	while($rowLogs=wewebFetchArrayDB($coreLanguageSQL,$queryLogs)) {
	$indexLog++;
		$valAction=$rowLogs[0];
		$valSessid=$rowLogs[1];
		$valSid=$rowLogs[2];
		$valSname=$rowLogs[3];
		$valip=$rowLogs[4];
		$valTime=DateFormat($rowLogs[5]);
		$valType=$rowLogs[6];
		$valActiontype=$rowLogs[7];
		
		$valUrl=$rowLogs[8];
		$valKey=$rowLogs[9];
		$valMenuid=$rowLogs[10];

		if($valActiontype==1){
			$valNameMenu=$langTxt["home:login"];
		}else if($valActiontype==2){
			$valNameMenu=$langTxt["nav:userManage2"];
		}else if($valActiontype==3){
			$valNameMenu=getNameMenu($valMenuid);
		}else if($valActiontype==4){
			$valNameMenu=$langTxt["nav:perManage2"];
		}
		
		if($_SESSION[$valSiteManage.'core_session_language']=="Thai"){
			$valNameUser= getUserThai($valSid);
		}else if($_SESSION[$valSiteManage.'core_session_language']=="Eng"){
			$valNameUser= getUserEng($valSid);
		}

	if($indexLog<$countLogs){
		 $valClassTrLog="divRightTrHomeLog";
	}else{
		 $valClassTrLog="";
	}
   ?>
     <!-- <tr>
		<td  class="<?php echo $valClassTrLog?>" style="padding-left:20px;"><?php echo $valNameMenu?></td>
		<td height="35"  align="center"  class="<?php echo $valClassTrLog?>"><?php echo $valAction?></td>
		<td align="center"  class="<?php echo $valClassTrLog?>"><?php echo $valNameUser?></td>
		<td align="center"  class="<?php echo $valClassTrLog?>"><?php echo $valTime?></td>
	</tr> -->
	<tr>
		<td data-label="<?=$langTxt["mg:subject"]?>" class="<?=$valClassTrLog?>" style="padding-left:20px;"><?=$valNameMenu?></td>
		<td data-label="<?=$langTxt["home:access"]?>" height="35"  align="center"  class="<?=$valClassTrLog?>"><?=$valAction?></td>
		<td data-label="<?=$langTxt["us:creby"]?>" align="center"  class="<?=$valClassTrLog?>"><?=$valNameUser?></td>
		<td data-label="<?=$langTxt["home:date"]?>" align="center"  class="<?=$valClassTrLog?>"><?=$valTime?></td>
	</tr>
   <?php }?>
   </table>
   <?php  }?>
<?php include("../lib/disconnect.php");?>
