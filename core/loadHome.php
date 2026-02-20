<?
include("../lib/session.php");
include("../lib/config.php");
include("../lib/connect.php");
include("../lib/function.php");
include("../lib/checkMember.php");
include("../core/incLang.php");
include("../lib/oneaccount/oneaccount_token.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="robots" content="noindex, nofollow">
        <meta name="googlebot" content="noindex, nofollow">
        <link href="../css/theme.css" rel="stylesheet"/>
        <title><?= $core_name_title ?></title>
        <script language="JavaScript"  type="text/javascript" src="../js/scriptCoreWeweb.js"></script>
        <script language="JavaScript"  type="text/javascript">
            var countArrSort = '';
            jQuery(function () {

                jQuery("#boxHomeSort").sortable({
                    update: function () {
                        var order = jQuery('#boxHomeSort').sortable('serialize');
                        countArrSort = order;
                        jQuery("#inputSort").val(countArrSort);
                        sortingContactHome('../core/sortingHome.php')
                    }
                });

                jQuery("#boxHomeSort").disableSelection();

            });
        </script>
    </head>
                    <!-- <div class="divRightNav">
                        <table width="96%" border="0" cellspacing="0" cellpadding="0"  align="center" >
                            <tr>
                                <td  class="divRightNavTb" align="left"   id="defTop"><span class="fontContantTbNav"><?= $langTxt["nav:home1"] ?></span></td>
                                <td  class="divRightNavTb" align="right"><?= DateFormat(date('Y-m-d H:i:s')) ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="divRightHead">
                        <table width="96%" border="0" cellspacing="0" cellpadding="0" class="borderBottom" align="center" >
                            <tr>
                                <td height="77" align="left"><span class="fontHeadRight"><?= $langTxt["nav:home2"] ?></span></td>
                                <td align="left">
                                    <table  border="0" cellspacing="0" cellpadding="0" align="right">
                                        <tr>
                                            <td align="right">
                                                <div  class="btnAdd" title="Add" onclick="window.open('box.php', '_self');"></div>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </div> -->
                    
    <div class="divRightHome" >
                        <div class="divRightInnerHome">
                            <div class="divRightInnerHome-topic">
                                <div class="title"><?= $langTxt["nav:home1"] ?></div>
                                <div class="date"><span class="feather icon-calendar"></span> <?= DateFormat(date('Y-m-d H:i:s')) ?></div>
                            </div>
                           
                                <div class="divDashboard-widget">
                                    <div  class="divRightInnerTopBoxHome">
                                        <?
                                        $sql_pic = "SELECT " . $core_tb_staff . "_picture, " . $core_tb_staff . "_logdate, " . $core_tb_staff . "_email, " . $core_tb_staff . "_groupid   FROM " . $core_tb_staff . " WHERE   " . $core_tb_staff . "_id     ='" . $_SESSION[$valSiteManage . "core_session_id"] . "'";
                                        $query_pic = wewebQueryDB($coreLanguageSQL, $sql_pic);
                                        $row_pic = wewebFetchArrayDB($coreLanguageSQL, $query_pic);
                                        $txt_pic_funtion = "../../upload/core/50/" . $row_pic[0];

                                        $valPicProfileTop = $txt_pic_funtion;
                                        if (is_file($valPicProfileTop)) {
                                            $valPicProfileTop = $valPicProfileTop;
                                        } else {
                                            $valPicProfileTop = "../img/btn/nouserHome.jpg";
                                        }

                                        $valLoginProfileTop = DateFormat($row_pic[1]);
                                        $valEmail = $row_pic[2];
                                        $valGroupid = $row_pic[3];
                                        ?>
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td width="8%" align="left">
                                                    <div class="cycle1Login"><span class="feather icon-user"></span></div>
                                                    <!-- <div style="width:52px; height:52px;  background:url(<?= $valPicProfileTop ?>) center no-repeat; border:#ffffff solid 1px;  background-size: cover;background-repeat: no-repeat;   "><img src="../img/home/cycle.png" /></div> -->
                                                </td>
                                                <td width="84%" style="padding-left:10px;" align="left">
                                                    <?
                                                    if ($_SESSION[$valSiteManage . "core_session_level"] == "SuperAdmin") {
                                                        $valLinkViewUser = "#";
                                                    } else {
                                                        $valLinkViewUser = "../core/userView.php";
                                                    }
                                                    ?>
                                                    <a href="<?= $valLinkViewUser ?>"><span class="fontTitlTbHome"><?= $_SESSION[$valSiteManage . "core_session_name"] ?></span></a></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" height="15"></td>
                                            </tr>
                                            <tr>
                                                <td height="20" colspan="2" align="left" >

                                                    <? if ($_SESSION[$valSiteManage . "core_session_level"] == "SuperAdmin") { ?>
                                                        <span class="fontContantTbHome"><?= $langTxt["us:permission"] ?>:&nbsp;-</span><br />
                                                        <span class="fontContantTbHome"><?= $langTxt["us:email"] ?>:&nbsp;-</span><br />
                                                        <span class="fontContantTbHome"><?= $langTxt["home:login"] ?>:&nbsp;-</span>
                                                    <? } else { ?>
                                                        <span class="fontContantTbHome"><?= $langTxt["us:permission"] ?>:&nbsp;<?
                                                $sql_group = "SELECT " . $core_tb_group . "_id," . $core_tb_group . "_name  FROM " . $core_tb_group . " WHERE " . $core_tb_group . "_id='" . $valGroupid . "'   ORDER BY " . $core_tb_group . "_order DESC ";
                                                $query_group = wewebQueryDB($coreLanguageSQL, $sql_group);
                                                $row_group = wewebFetchArrayDB($coreLanguageSQL, $query_group);
                                                $row_groupid = $row_group[0];
                                                $row_groupname = $row_group[1];
                                                echo $row_groupname;
                                                        ?></span><br />
                                                        <span class="fontContantTbHome"><?= $langTxt["us:email"] ?>:&nbsp;<?= $valEmail ?></span><br />
                                                        <span class="fontContantTbHome"><?= $langTxt["home:login"] ?>:&nbsp;<?= $valLoginProfileTop ?></span>
                                                    <? } ?></td>
                                            </tr>
                                            <!-- <tr>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                            </tr> -->
                                        </table>
                                    </div>
                                     <? if ($_SESSION[$valSiteManage . "core_session_level"] == "SuperAdmin" || $_SESSION[$valSiteManage . "core_session_level"] == "admin") {
                                ?>
                                    <div  class="divRightInnerTopBoxHome">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td width="8%" align="left"><div class="cycle1Login cycle-bg-2"><span class="feather icon-users"></span></div></td>
                                                <td width="84%" style="padding-left:10px;" align="left"><a href="../core/userManage.php" title="<?= $langTxt["nav:userManage2"] ?>"><span class="fontTitlTbHome"><?= $langTxt["nav:userManage2"] ?></span></a></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" height="15"></td>
                                            </tr>
                                            <tr>
                                                <td height="20" colspan="2" align="left" ><span class="fontContantTbHome"><?= $langTxt["home:userDe"] ?></span></td>
                                            </tr>
                                            <!-- <tr>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                            </tr> -->
                                        </table>
                                    </div>
                                    <div  class="divRightInnerTopBoxHome">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td width="8%" align="left"><div class="cycle4Login cycle-bg-3"><span class="feather icon-align-justify"></span></div></td>
                                                <td width="84%" style="padding-left:10px;" align="left"><a href="../core/permisManage.php" title="<?= $langTxt["nav:perManage2"] ?>"><span class="fontTitlTbHome"><?= $langTxt["nav:perManage2"] ?></span></a></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" height="15"></td>
                                            </tr>
                                            <tr>
                                                <td height="20" colspan="2" align="left" ><span class="fontContantTbHome"><?= $langTxt["home:premisDe"] ?></span></td>
                                            </tr>
                                            <!-- <tr>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                            </tr> -->
                                        </table>
                                    </div>
                                    <? } ?>
                                </div>
                                <div class="clearAll"></div>
                            
                    
                            <div class="add-app">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0" >
                                    <tr>
                                        <td align="center"><?= $langTxt["home:app"] ?> <img src="../img/btn/add.png" align="absmiddle" hspace="10"  onclick="window.open('box.php', '_self');"/> <?= $langTxt["home:appLast"] ?></td>
                                    </tr>
                                </table>
                            </div>
                            <?
                            $sql = "SELECT
" . $core_tb_sort . "_id,
" . $core_tb_menu . "_masterkey,
" . $core_tb_menu . "_moduletype,
" . $core_tb_menu . "_linkpath,
" . $core_tb_menu . "_namethai,
" . $core_tb_menu . "_nameeng,
" . $core_tb_menu . "_icon ,
" . $core_tb_menu . "_id,
" . $core_tb_menu . "_target

FROM " . $core_tb_menu . "
INNER JOIN " . $core_tb_sort . "
ON  " . $core_tb_menu . "." . $core_tb_menu . "_id = " . $core_tb_sort . "." . $core_tb_sort . "_menuID
WHERE  " . $core_tb_menu . "_status='Enable' AND  " . $core_tb_sort . "_memberID='" . $_SESSION[$valSiteManage . 'core_session_id'] . "'   ";
                            $sql .= "GROUP BY " . $core_tb_sort . "_order,
  " . $core_tb_sort . "_id,
" . $core_tb_menu . "_masterkey,
" . $core_tb_menu . "_moduletype,
" . $core_tb_menu . "_linkpath,
" . $core_tb_menu . "_namethai,
" . $core_tb_menu . "_nameeng,
" . $core_tb_menu . "_icon ,
" . $core_tb_menu . "_id,
" . $core_tb_menu . "_target ";
                            $sql .= "ORDER BY " . $core_tb_sort . "_order DESC  ";
                            $Query = wewebQueryDB($coreLanguageSQL, $sql);
                            $RecordCount = wewebNumRowsDB($coreLanguageSQL, $Query);
                            if ($RecordCount >= 1) {
                                ?> <form action="?" method="get" name="myFormSort" id="myFormSort">
                                    <input name="execute" type="hidden" id="execute" value="insert" />
                                    <input name="masterkey" type="hidden" id="masterkey" value="<?= $_REQUEST['masterkey'] ?>" />
                                    <input name="menukeyid" type="hidden" id="menukeyid" value="<?= $_REQUEST['menukeyid'] ?>" />
                                    <input name="inputSort" type="hidden" id="inputSort" value="" />

                                    <ul id="boxHomeSort"  >
    <?
    while ($RowMenu = wewebFetchArrayDB($coreLanguageSQL, $Query)) {
        $txtMenuID = $RowMenu[0];
        $txtModuleCode = $RowMenu[1];
        $txtModuleType = $RowMenu[2];
        $valMenuID = $RowMenu[7];
        $valIDAll = $RowMenu[7];
        if ($txtModuleType == "Group") {
            $sqlPath = "SELECT " . $core_tb_menu . "_linkpath," . $core_tb_menu . "_masterkey," . $core_tb_menu . "_id FROM " . $core_tb_menu . " WHERE " . $core_tb_menu . "_parentid='" . $valMenuID . "' ";
            $sqlPath = $sqlPath . " ORDER BY " . $core_tb_menu . "_order DESC ";
            $queryPath = wewebQueryDB($coreLanguageSQL, $sqlPath);
            $rowPath = wewebFetchArrayDB($coreLanguageSQL, $queryPath);
            $txtNameLinkpath = $rowPath[0];
            $txt_menu_modType = explode("/", $txtNameLinkpath);
            $txtPathMod = $txt_menu_modType[1];
            $txtPathModFile = $txt_menu_modType[2];
            $txtModuleCode = $rowPath[1];
            $valMenuID = $rowPath[2];
        } else {
            $txtNameLinkpath = $RowMenu[3];
            $txt_menu_modType = explode("/", $txtNameLinkpath);
            $txtPathMod = $txt_menu_modType[1];
            $txtPathModFile = $txt_menu_modType[2];
        }

        $txtNameMenuTh = $RowMenu[4];
        $txtNameMenuEn = $RowMenu[5];
        if ($_SESSION[$valSiteManage . 'core_session_language'] == "Thai") {
            $txtNameMenu = $txtNameMenuTh;
        } else {
            $txtNameMenu = $txtNameMenuEn;
        }

        $txtNameIcon = $RowMenu[6];
        $txtTagetName = $RowMenu[8];

        $permissionID = getUserPermissionOnMenu($_SESSION[$valSiteManage . "core_session_groupid"], $valIDAll);
        if ($permissionID != "NA" || $_SESSION[$valSiteManage . "core_session_level"] == "SuperAdmin") {

            if ($txtPathMod == "mod_name") {
                if ($txtPathModFile == "name.php") {
                    $valCellFile = "loadBoxName";
                } else if ($txtPathModFile == "boss.php") {
                    $valCellFile = "loadBoxBoss";
                } else if ($txtPathModFile == "part.php") {
                    $valCellFile = "loadBoxPart";
                } else if ($txtPathModFile == "group.php") {
                    $valCellFile = "loadBoxGroup";
                } else {
                    $valCellFile = "loadBoxHome";
                }
            } else {
                $valCellFile = "loadBoxHome";
            }
            ?>
                                                <li class="boxHomeSortli"  id="listItem_<?= $txtMenuID ?>" >
                                                    <div  class="divRightInnerBoxHome">
                                                        <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center"  class="divRightTitleHomeBoxAll"  >
                                                            <tr >
                                                                <td width="3%"  class="divRightTitleHome"  valign="middle" align="left">
                                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0" >
                                                                        <tr>
                                                                            <td align="center" width="31" style="cursor:move;"><? if ($txtNameIcon) { ?><img src="<?= $txtNameIcon ?>" border="0" align="absmiddle" /><? } else {
                                        echo " - ";
                                    } ?></td>
                                                                            <td align="left" style="cursor:move; font-weight: bold;"><?= $txtNameMenu ?></td>
                                                                            <td align="center" width="31"><a href="javascript:void(0)" onclick="delContactHome('../core/deleteHome.php', '<?= $txtMenuID ?>', 'listItem_<?= $txtMenuID ?>');"   title="<?= $langTxt["btn:close"] ?>"><span class="feather icon-x"></span></a></td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                            <tr >
                                                                <td class="divRightTrHome" align="center" bgcolor="#FFFFFF"  id="loadContantHome<?= $txtMenuID ?>" valign="top">
                                                                    <img src="../img/loader/ajax-loaderHome.gif" style="padding-top:40px;"  />
                                                                    <script language="JavaScript"  type="text/javascript">
                                                                        jQuery(function () {
                                                                            loadContantHome('../<?= $txtPathMod ?>/<?= $valCellFile ?>.php', 'loadContantHome<?= $txtMenuID ?>', '<?= $txtModuleCode ?>',<?= $valMenuID ?>);
                                                                        });
                                                                    </script>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </li>
        <? }
    } ?>
                                    </ul>
                                </form>
                            <? } else { ?>
                                <div class="clearAll"></div>
                                <!-- <div>
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0" >
                                        <tr>
                                            <td height="250" align="center"  ><?= $langTxt["home:app"] ?> <img src="../img/btn/add.png" align="absmiddle" hspace="10"  onclick="window.open('box.php', '_self');" style="cursor:pointer;"/> <?= $langTxt["home:appLast"] ?></td>
                                        </tr>
                                    </table>
                                </div> -->
                            <? } ?>

                            <? if ($_SESSION[$valSiteManage . "core_session_level"] == "SuperAdmin" || $_SESSION[$valSiteManage . "core_session_level"] == "admin") {
                                ?>
                                <!-- ########## Start Box Big ##########-->
                                <div  class="divRightInnerBigBoxHome mb-0 mt-4">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center"   class="divRightTitleHomeBoxAll"  >
                                        <tr>
                                            <td width="3%"  class="divRightTitleHome"  valign="middle" align="left" >
                                                <table width="100%" border="0" cellspacing="0" cellpadding="0" >
                                                    <tr>
                                                        <td align="left"><span class="fontTitlTbHome" style=" margin-left: -7px; ">&nbsp;&nbsp;<?= $langTxt["home:used"] ?></span></td>
                                                        <td align="right"><a href="../core/exportLog.php" class="btn-export" title="<?= $langTxt["btn:export"] ?>"><img src="../img/iconfile/3.png" width="25" border="0" /></a></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="divRightTrHome" id="loadContantLogHome" align="center" valign="top">
                                                <img src="../img/loader/ajax-loaderHome.gif" style="padding-top:40px;"  />
                                                <script language="JavaScript"  type="text/javascript">
                                                    jQuery(function () {
                                                        loadContantLogHome('../core/loadLog.php');
                                                    });
                                                </script>
                                            </td>
                                        </tr>
                                    </table>
                                    
                                </div>
                                <!-- ########## End Box Big ##########-->
                                <div class="clearAll"></div>
                            <? } ?>

                            <div class="clearAll"></div>

                        </div>
                        <?
                        if ($RecordCount >= 1) {
                            ?>
                            <!-- <table width="96%" border="0" cellspacing="0" cellpadding="0" align="center">
                                <tr >
                                    <td align="right"  valign="middle" class="formEndContantTb"><a href="#defTop" title="<?= $langTxt["btn:gototop"] ?>"><?= $langTxt["btn:gototop"] ?> <img src="../img/btn/top.png"  align="absmiddle"/></a></td>
                                </tr>
                            </table> -->
                        <? } ?>

                    </div>
                    <? include("../lib/disconnect.php"); ?>
