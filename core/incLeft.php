<div class="row no-gutters align-items-center">
  <div class="col">
    <div class="logo">
      <a href="../core/index.php">
        <img src="../img/new-brand.png" alt="">
        <!-- <img src="<?= $core_pathname_crupload ?>/<?= $valPicSystem ?>" alt=""> -->
        <div class="title">
          <?= $valNameSystem ?>
          <small><?= $valTitleSystem ?></small>
        </div>
      </a>
    </div>
  </div>
  <div class="col-auto">
    <div class="divLogin dropdown">
      <div class="divLogin-name">
        <?php echo  $_SESSION[$valSiteManage . "core_session_name"] ?>
      </div>
      <a href="javascript:void(0)" data-toggle="dropdown" title="<?php echo  $langTxt["menu:topmenu"] ?>">
        <div class="divLogin-img">
          <?php
          $valPicProfileTop = load_picmemberBack($_SESSION[$valSiteManage . "core_session_id"]);
          if (is_file($valPicProfileTop)) {
            $valPicProfileTop = $valPicProfileTop;
          } else {
            $valPicProfileTop = "../img/btn/nouser.jpg";
          }

          if ($_SESSION[$valSiteManage . "core_session_level"] == "SuperAdmin") {
            $valLinkViewUser = "#";
          } else {
            $valLinkViewUser = "../core/userView.php";
          }
          ?>
          <div style="background:url(<?php echo  $valPicProfileTop ?>) center no-repeat; background-size: cover; background-repeat: no-repeat;"></div>
        </div>
      </a>

      <ul class="dropdown-menu dropdown-menu-right">
        <li><a href="<?php echo  $valLinkViewUser ?>" title="ข้อมูลผู้ใช้งาน">ข้อมูลผู้ใช้งาน</a></li>
        <?php if ($_SESSION[$valSiteManage . "core_session_level"] == "SuperAdmin" || $_SESSION[$valSiteManage . "core_session_level"] == "admin") { ?>
          <li><a href="../core/userManage.php" title="<?php echo  $langTxt["nav:userManage2"] ?>"><?php echo  $langTxt["nav:userManage2"] ?></a></li>
          <li><a href="../core/permisManage.php" title="<?php echo  $langTxt["nav:perManage2"] ?>"><?php echo  $langTxt["nav:perManage2"] ?></a></li><?php } ?>
        <?php if ($_SESSION[$valSiteManage . "core_session_level"] == "SuperAdmin") { ?>
          <li><a href="../core/menuManage.php" title="<?php echo  $langTxt["nav:menuManage2"] ?>"><?php echo  $langTxt["nav:menuManage2"] ?></a></li>
          <li><a href="../core/setting.php" title="<?php echo  $langTxt["nav:setting"] ?>"><?php echo  $langTxt["nav:setting"] ?></a></li><?php } ?>
        <li class="logout"><a href="javascript:void(0)" onclick="checkLogoutUser();" title="<?php echo  $langTxt["menu:logout"] ?>"><?php echo  $langTxt["menu:logout"] ?></a></li>
      </ul>
    </div>
  </div>
  <div class="col-auto">
    <div class="divBtn-menu">
      <a href="javascript:void(0);" title="เมนู">
        <span class="feather icon-menu"></span>
      </a>
    </div>
  </div>
</div>
<div class="navControl">
  <div class="overflow-y">
    <div class="divBtnmenu-close">
      <span class="feather icon-chevron-right"></span>
    </div>
    <div class="<?php if ($menukeyid == '') { ?>divLeftMenuOver<?php } else { ?>divLeftMenu<?php } ?>">
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="divLeftMenuTb">
        <tr>
          <!-- <td width="31"  align="left" valign="top">
                      <img src="../img/iconmenu/1283582620_045.png" width="16" height="16" />
                  </td> -->
          <td align="left" valign="top">
            <a href="../core/index.php" title="<?php echo  $langTxt["nav:home2"] ?>">
              <span class="material-symbols-outlined ">
                home
              </span>
              <?php echo  $langTxt["nav:home2"] ?>
            </a>
          </td>
        </tr>
      </table>
    </div>

    <?php
    $sql_open = "SELECT  " . $core_tb_menu . "_parentid FROM " . $core_tb_menu . " WHERE " . $core_tb_menu . "_id='" . $menukeyid . "' AND " . $core_tb_menu . "_status='Enable'  AND ( " . $core_tb_menu . "_hidden!='Disable' or " . $core_tb_menu . "_hidden is null ) ORDER BY " . $core_tb_menu . "_order ASC ";
    $Query_open = wewebQueryDB($coreLanguageSQL, $sql_open);
    $Row_open = wewebFetchArrayDB($coreLanguageSQL, $Query_open);
    $status_open = $Row_open[0];

    $sql = "SELECT * FROM " . $core_tb_menu . " WHERE " . $core_tb_menu . "_parentid='0'  AND " . $core_tb_menu . "_status='Enable'  AND ( " . $core_tb_menu . "_hidden!='Disable' or " . $core_tb_menu . "_hidden is null )  ORDER BY " . $core_tb_menu . "_order ASC ";
    $Query = wewebQueryDB($coreLanguageSQL, $sql);
    $RecordCount = wewebNumRowsDB($coreLanguageSQL, $Query);

    // print_pre($RecordCount);

    if ($RecordCount >= 1) {

      while ($RowMenu = wewebFetchArrayDB($coreLanguageSQL, $Query)) {
        // print_pre($RowMenu);
        $masterkeyName = $RowMenu[$core_tb_menu . "_masterkey"];
        $myUserID = $_SESSION[$valSiteManage . "core_session_groupid"];
        $myMenuID = $RowMenu[$core_tb_menu . "_id"];
        $permissionID = getUserPermissionOnMenu($myUserID, $myMenuID);

        if ($RowMenu[$core_tb_menu . "_moduletype"] == "Module") {
          $linkFileTo = $RowMenu[$core_tb_menu . "_linkpath"] . "?masterkey=" . $masterkeyName . "&amp;menukeyid=" . $myMenuID;
          $linkTaget = "_self";
        } else if ($RowMenu[$core_tb_menu . "_moduletype"] == "Link") {
          $linkFileTo = $RowMenu[$core_tb_menu . "_linkpath"];
          $linkTaget = "_blank";
        }
        // print_pre($_SESSION[$valSiteManage . "core_session_level"]);
        if ($permissionID != "NA" || $_SESSION[$valSiteManage . "core_session_level"] == "SuperAdmin") {
          if ($_SESSION[$valSiteManage . 'core_session_language'] == "Thai") {
            $txt_menu_lan = $RowMenu[$core_tb_menu . "_namethai"];
          } else if ($_SESSION[$valSiteManage . 'core_session_language'] == "Eng") {
            $txt_menu_lan = $RowMenu[$core_tb_menu . "_nameeng"];
          }

          if ($RowMenu[$core_tb_menu . "_moduletype"] == "Group") {
            $ParentID = $RowMenu[$core_tb_menu . "_id"];

            $sql2 = "SELECT * FROM " . $core_tb_menu . " INNER JOIN " . $core_tb_permission . " ON " . $core_tb_menu . "." . $core_tb_menu . "_id =" . $core_tb_permission . "." . $core_tb_permission . "_menuid  WHERE " . $core_tb_menu . "_parentid='" . $ParentID . "'   AND " . $core_tb_menu . "_status='Enable'  AND ( " . $core_tb_menu . "_hidden!='Disable' or " . $core_tb_menu . "_hidden is null )  AND " . $core_tb_permission . "_perid='" . $_SESSION[$valSiteManage . 'core_session_groupid'] . "' AND " . $core_tb_permission . "_permission!='NA' ORDER BY " . $core_tb_menu . "_order ASC ";
            $Query2 = wewebQueryDB($coreLanguageSQL, $sql2);

            $RecordCountSub = wewebNumRowsDB($coreLanguageSQL, $Query2);
            $valHeightSub = $core_height_leftmenu * $RecordCountSub;
            if ($status_open == $myMenuID) {
              $valOpenNewMenu = "divLeftMenuOverNew";
              $valNavImgNew = "../img/btn/navOpen.png";
            } else {
              $valOpenNewMenu = "divLeftMenu";
              $valNavImgNew = "../img/btn/nav.png";
            }
    ?>
            <div class="<?php echo  $valOpenNewMenu ?>" id="boxMenuLeftShow<?php echo  $ParentID ?>" <?php if ($status_open == $ParentID) { ?>onclick="clickOutSubMenuLeft('boxMenuLeftShow<?php echo  $ParentID ?>', 'boxSubMenuLeftShow<?php echo  $ParentID ?>', '<?php echo  $valHeightSub ?>')" <?php } else { ?>onclick="clickInSubMenuLeft('boxMenuLeftShow<?php echo  $ParentID ?>', 'boxSubMenuLeftShow<?php echo  $ParentID ?>', '<?php echo  $valHeightSub ?>')" <?php } ?> style="cursor:pointer; width: 100%;">
              <table width="100%" border="0" cellspacing="0" cellpadding="0" class="divLeftMenuTb">
                <tr>
                  <!-- <td width="31"  align="left" valign="top">
                                      <?php if ($RowMenu[$core_tb_menu . "_icon"]) { ?><img src="<?php echo  $RowMenu[$core_tb_menu . "_icon"] ?>" border="0" align="absmiddle" /><?php
                                                                                                                                                                                } else {
                                                                                                                                                                                  echo " - ";
                                                                                                                                                                                }
                                                                                                                                                                                  ?>
                                  </td> -->
                  <td align="left" valign="top">
                    <a href="javascript:void(0)" class="<?php if ($status_open == $myMenuID) { ?>fontContantB<?php } else { ?><?php } ?>">
                      <?php if ($RowMenu[$core_tb_menu . "_icontype"] == 1  || $RowMenu[$core_tb_menu . "_icontype"] == 0) { ?>
                        <span class="fa">
                          <?php if ($RowMenu[$core_tb_menu . "_icon"]) { ?><img src="<?php echo  $RowMenu[$core_tb_menu . "_icon"] ?>" border="0" align="absmiddle" />
                          <?php
                          } else {
                            echo " - ";
                          }
                          ?>
                        </span>
                      <?php } else { ?>
                        <span class="material-symbols-outlined "><?php echo $RowMenu[$core_tb_menu . "_classname"]; ?></span>
                      <?php } ?>
                      <?php echo  $txt_menu_lan ?>
                      <span class="fa angle fa-angle-down"></span>
                    </a>
                    <!-- <div style="float:right"><img src="<?php echo  $valNavImgNew ?>" /></div> -->
                  </td>
                </tr>
              </table>
            </div>
            <div class="clearAll"></div>
            <?php
            if ($_SESSION[$valSiteManage . "core_session_groupid"] == '11') {
              $valStyMiniUser = '';
            } else {
              $valStyMiniUser = 'style="height:0px;display:none;"';
            }

            ?>
            <div <?php if ($status_open == $ParentID) { ?><?php } else { ?><?php echo $valStyMiniUser ?><?php } ?> id="boxSubMenuLeftShow<?php echo  $ParentID ?>" class="divmenu">
              <?php
              if ($RecordCountSub >= 1) {
              ?>
                <!--                    <div class="divLeftSubMenuEnd"></div>
                              --> <?php
                                  while ($RowSub = wewebFetchArrayDB($coreLanguageSQL, $Query2)) {

                                    $masterkeyName = $RowSub[$core_tb_menu . "_masterkey"];
                                    $myUserID = $_SESSION[$valSiteManage . "core_session_groupid"];
                                    $myMenuID = $RowSub[$core_tb_menu . "_id"];
                                    $permissionID = getUserPermissionOnMenu($myUserID, $myMenuID);

                                    if ($RowSub[$core_tb_menu . "_moduletype"] == "Module") {
                                      $linkFileTo = $RowSub[$core_tb_menu . "_linkpath"] . "?masterkey=" . $masterkeyName . "&amp;menukeyid=" . $myMenuID;
                                      $linkTaget = "_self";
                                    } else if ($RowSub[$core_tb_menu . "_moduletype"] == "Link") {
                                      $linkFileTo = $RowSub[$core_tb_menu . "_linkpath"];
                                      $linkTaget = "_blank";
                                    }


                                    if ($_SESSION[$valSiteManage . 'core_session_language'] == "Thai") {
                                      $txt_menu_sublan = $RowSub[$core_tb_menu . "_namethai"];
                                    } else if ($_SESSION[$valSiteManage . 'core_session_language'] == "Eng") {
                                      $txt_menu_sublan = $RowSub[$core_tb_menu . "_nameeng"];
                                    }

                                    if ($permissionID != "NA" || $_SESSION[$valSiteManage . "core_session_level"] == "SuperAdmin") {
                                  ?>
                                    <div class="<?php if ($menukeyid == $myMenuID) { ?>divLeftSubMenuOver<?php } else { ?>divLeftSubMenu<?php } ?>">
                                      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="divLeftSubMenuTb">
                                        <tr>
                                          <td align="left" valign="top">
                                            <a href="<?php echo  $linkFileTo ?>" target="<?php echo  $linkTaget ?>" class="<?php if ($menukeyid == $myMenuID) { ?>fontContantSubMenu<?php } else { ?><?php } ?>" >
                                              <?php if ($RowSub[$core_tb_menu . "_icontype"] == 1  || $RowSub[$core_tb_menu . "_icontype"] == 0) { ?>
                                                <span class="fa">
                                                  <?php if ($RowSub[$core_tb_menu . "_icon"]) { ?><img src="<?php echo  $RowSub[$core_tb_menu . "_icon"] ?>" border="0" align="absmiddle" />
                                                  <?php
                                                  } else {
                                                    echo " - ";
                                                  }
                                                  ?>
                                                </span>
                                              <?php } else { ?>
                                                <span class="material-symbols-outlined">
                                                  <?php echo $RowSub[$core_tb_menu . "_classname"]; ?>
                                                </span>
                                              <?php } ?>
                                              <span class="submenu_txt">
                                                <?php echo  $txt_menu_sublan ?>
                                              </span>
                                              
                                            </a>
                                        </td>
                                        </tr>
                                      </table>
                                    </div>
                                    <div class="clearAll"></div>
              <?php
                                    } // End if permission Sub Group
                                  } //End  while  Sub Group
                                }  // End else Sub Group 
              ?>
            </div>
            <div class="clearAll"></div>

          <?php } else { ?>
            <div class="<?php if ($menukeyid == $myMenuID) { ?>divLeftMenuOver<?php } else { ?>divLeftMenu<?php } ?>">
              <table width="100%" border="0" cellspacing="0" cellpadding="0" class="<?php if ($menukeyid == $myMenuID) { ?><?php } else { ?>divLeftMenuTb<?php } ?>">
                <tr>
                  <!-- <td width="31"  align="left" valign="top">
                                      <?php if ($RowMenu[$core_tb_menu . "_icon"]) { ?><img src="<?php echo  $RowMenu[$core_tb_menu . "_icon"] ?>" border="0" align="absmiddle"  /><?php
                                                                                                                                                                                  } else {
                                                                                                                                                                                    echo " - ";
                                                                                                                                                                                  }
                                                                                                                                                                                    ?>      
                                  </td> -->
                  <td align="left" valign="top">
                    <a href="<?php echo  $linkFileTo ?>" target="<?php echo  $linkTaget ?>" class="<?php if ($menukeyid == $myMenuID) { ?>fontContantB<?php } else { ?><?php } ?>">
                      <?php if ($RowMenu[$core_tb_menu . "_icontype"] == 1  || $RowMenu[$core_tb_menu . "_icontype"] == 0) { ?>
                        <span class="fa">
                          <?php if ($RowMenu[$core_tb_menu . "_icon"]) { ?><img src="<?php echo  $RowMenu[$core_tb_menu . "_icon"] ?>" border="0" align="absmiddle" />
                          <?php
                          } else {
                            echo " - ";
                          }
                          ?>
                        </span>
                      <?php } else { ?>
                        <span class="material-symbols-outlined">
                          <?php echo $RowMenu[$core_tb_menu . "_classname"]; ?>
                        </span>
                      <?php } ?>
                      <?php echo  $txt_menu_lan ?>
                    </a>
                  </td>
                </tr>
              </table>
            </div>
            <div class="clearAll"></div>
    <?php
          } // End else Group
        } // End if permission
      } // End  while 
    } // End if >=1
    ?>
  
    <div class="divLogOut-Area">
      <div class="divLeftMenu -LogOut">
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="divLeftMenuTb ">
          <tr>
            <!-- <td width="31"  align="left" valign="top">
                        <img src="../img/iconmenu/1283582582_150.png" width="16" height="16" />
                    </td> -->
            <td align="left" valign="top">
              <a href="javascript:void(0)" onclick="checkLogoutUser();" title="<?php echo  $langTxt["menu:logout"] ?>">
                <!-- <span class="fa"><img src="../img/iconmenu/1283582582_150.png" /></span> -->
                <span class="material-symbols-outlined">
                  logout
                </span>
                <?php echo  $langTxt["menu:logout"] ?>
              </a>
            </td>
          </tr>
        </table>
      </div>
    </div>
  </div>
  <div class="clearAll"></div>
  <div style="height:100px;"></div>
</div>
<div class="navControl-overlay"></div>