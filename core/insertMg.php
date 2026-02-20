<?php	
$menu_keyid = "900002";
include("../lib/session.php");
include("../lib/config.php");
include("../lib/connect.php");
include("../lib/function.php");
include("../lib/checkMember.php");

	if($_REQUEST['execute']=="insert"){
		$inputModuleName='Module';
			
		if($_REQUEST['inputMenu_LinkType']==0) { 
			$inputModuleName="Link"; 
			$inputlinkpath=changeQuot($_REQUEST['inputmenuurl']);
		}
		if($_REQUEST['inputMenu_LinkType']==2) { 
			$inputModuleName="Group"; 
		}
		
		if($_REQUEST['myParentID']<=0){
			$valMyParentID=0;
		}else{
			$valMyParentID=$_REQUEST['myParentID'];
		}
		
		
		$sql = "SELECT MAX(".$core_tb_menu."_order) FROM ".$core_tb_menu;
		$Query=wewebQueryDB($coreLanguageSQL,$sql);
		$Row=wewebFetchArrayDB($coreLanguageSQL,$Query);
		$maxOrder = $Row[0]+1;
		
		$insert[$core_tb_menu."_namethai"] = "'".changeQuot($_REQUEST['inputmenuname'])."'";
		$insert[$core_tb_menu."_nameeng"] = "'".changeQuot($_REQUEST['inputmenunameen'])."'";
		$insert[$core_tb_menu."_linkpath"] = "'".$inputlinkpath."'";
		$insert[$core_tb_menu."_icon"] = "'".changeQuot($_REQUEST['inputIconName'])."'";
		$insert[$core_tb_menu."_order"] = "'".$maxOrder."'";
		$insert[$core_tb_menu."_status"] = "'Enable'";
		$insert[$core_tb_menu."_masterkey"] = "'".changeQuot($_REQUEST['inputmasterkey'])."'";
		$insert[$core_tb_menu."_moduletype"] = "'".$inputModuleName."'";
		$insert[$core_tb_menu."_ismodule"] = "'".changeQuot($_REQUEST['inputMenu_LinkType'])."'";
		$insert[$core_tb_menu."_target"] = "'".changeQuot($_REQUEST['inputmenutarget'])."'";
		$insert[$core_tb_menu."_parentid"] = "'".$valMyParentID."'";
		$insert[$core_tb_menu."_language"] = "'".$core_session_language."'";
		$insert[$core_tb_menu."_credate"] = "".wewebNow($coreLanguageSQL)."";
		$insert[$core_tb_menu . "_icontype"] = "'" . changeQuot($_REQUEST['inputIconType']) . "'";
		$insert[$core_tb_menu . "_classname"] = "'" . changeQuot($_REQUEST['inputClassIcon']) . "'";
		
		  $sql="INSERT INTO ".$core_tb_menu."(".implode(",",array_keys($insert)).") VALUES (".implode(",",array_values($insert)).")";
		$Query=wewebQueryDB($coreLanguageSQL,$sql);		
		
		 } ?>
<?php include("../lib/disconnect.php");?>
<form action="../core/menuManage.php" method="post" name="myFormAction" id="myFormAction">
    <input name="masterkey" type="hidden" id="masterkey" value="<?php echo $_REQUEST['masterkey']?>" />
    <input name="menukeyid" type="hidden" id="menukeyid" value="<?php echo $_REQUEST['menukeyid']?>" />
    <input name="inputSearch" type="hidden" id="inputSearch" value="<?php echo $_REQUEST['inputSearch']?>" />
</form>            
<script language="JavaScript" type="text/javascript">document.myFormAction.submit(); </script>
