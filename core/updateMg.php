<?php	
$menu_keyid = "900002";
include("../lib/session.php");
include("../lib/config.php");
include("../lib/connect.php");
include("../lib/function.php");
include("../lib/checkMember.php");

	if($_REQUEST['execute']=="update"){
		$inputModuleName='Module';
			
		if($_REQUEST['inputMenu_LinkType']==0) { 
			$inputModuleName="Link"; 
			$inputlinkpath=changeQuot($_REQUEST['inputmenuurl']);
		}
		if($_REQUEST['inputMenu_LinkType']==2) { 
			$inputModuleName="Group"; 
		}
		
		
		$update = array();
		$update[]=$core_tb_menu."_target  	='".changeQuot($_REQUEST['inputmenutarget'])."'";
		$update[]=$core_tb_menu."_icon  	='".changeQuot($_REQUEST['inputIconName'])."'";
		$update[]=$core_tb_menu."_namethai  ='".changeQuot($_REQUEST['inputmenuname'])."'";
		$update[]=$core_tb_menu."_nameeng  	='".changeQuot($_REQUEST['inputmenunameen'])."'";
		$update[]=$core_tb_menu."_ismodule  	='".changeQuot($_REQUEST['inputMenu_LinkType'])."'";
		$update[]=$core_tb_menu."_moduletype  	='".$inputModuleName."'";
		$update[]=$core_tb_menu."_masterkey  	='".changeQuot($_REQUEST['inputmasterkey'])."'";
		$update[]=$core_tb_menu."_linkpath  	='".$inputlinkpath."'";
		$update[] = $core_tb_menu . "_icontype  	='" . changeQuot($_REQUEST['inputIconType']) . "'";
		$update[] = $core_tb_menu . "_classname  	='" . changeQuot($_REQUEST['inputClassIcon']) . "'";
	
		$sql="UPDATE ".$core_tb_menu." SET ".implode(",",$update)." WHERE ".$core_tb_menu."_id='".$_REQUEST["valEditID"]."' ";
		$Query=wewebQueryDB($coreLanguageSQL,$sql);		
		
		 } ?>
<?php include("../lib/disconnect.php");?>
<form action="../core/menuManage.php" method="post" name="myFormAction" id="myFormAction">
    <input name="masterkey" type="hidden" id="masterkey" value="<?php echo $_REQUEST['masterkey']?>" />
    <input name="menukeyid" type="hidden" id="menukeyid" value="<?php echo $_REQUEST['menukeyid']?>" />
    <input name="inputSearch" type="hidden" id="inputSearch" value="<?php echo $_REQUEST['inputSearch']?>" />
</form>            
<script language="JavaScript" type="text/javascript"> document.myFormAction.submit(); </script>
