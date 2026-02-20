<?php

include("lib/session.php");
if ($_SESSION[$valSiteManage . "core_session_language"] == "") {
    $_SESSION[$valSiteManage . "core_session_language"] = "Thai";
}

include("lib/config.php");
include("lib/connect.php");

$_SESSION[$valSiteManage . "core_session_id"] = 0;
$_SESSION[$valSiteManage . "core_session_name"] = "";
$_SESSION[$valSiteManage . "core_session_level"] = "";
$_SESSION[$valSiteManage . "core_session_language"] = "Thai";
$_SESSION[$valSiteManage . "core_session_groupid"] = 0;
$_SESSION[$valSiteManage . "core_session_permission"] = "";
$_SESSION[$valSiteManage . "core_session_logout"] = "";


include("core/incLang.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <meta name="googlebot" content="noindex, nofollow">
    <link href="css/theme.css" rel="stylesheet" />
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/bootstrap-theme.min.css" rel="stylesheet" />
    <link href="css/font-awesome.min.css" rel="stylesheet" />

    <!-- start: sso btn -->
    <link href="./lib/ActiveOAuth2/assets/css/sso-btn.css" rel="stylesheet" />
    <!-- end: sso btn -->

    <title><?php echo  $core_name_title ?></title>

    <script language="JavaScript" type="text/javascript" src="js/jquery-1.9.0.js"></script>
    <script language="JavaScript" type="text/javascript" src="js/jquery.blockUI.js"></script>
    <script language="JavaScript" type="text/javascript" src="js/scriptCoreWeweb.js"></script>

    <script language="JavaScript" type="text/javascript" src="https://oneaccount.dmcr.go.th/cdn/js/validation.js<?php echo $lastModify ?>"></script>
    <script language="JavaScript" type="text/javascript" src="https://oneaccount.dmcr.go.th/cdn/js/cookie.js<?php echo $lastModify ?>"></script>
    <script language="JavaScript" type="text/javascript" src="https://oneaccount.dmcr.go.th/cdn/js/controller.api.js<?php echo $lastModify ?>"></script>
    <script language="JavaScript" type="text/javascript" src="lib/ActiveDirectory/validation/js/controller.url.js<?php echo $lastModify ?>"></script>
    <script language="JavaScript" type="text/javascript" src="lib/ActiveDirectory/validation/js/function.js<?php echo $lastModify ?>"></script>
    <script language="JavaScript" type="text/javascript" src="https://oneaccount.dmcr.go.th/cdn/js/sweetalert2.js<?php echo $lastModify ?>"></script>

    <script language="JavaScript" type="text/javascript">
        function myShowPassword() {
            var x = document.getElementById("inputPass");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
        jQuery(function() {
            // CDN JS from oneaccount.dmcr.go.th
            const service_api = new controller_api(controller_url.init().url);
            jQuery('form#myFormLogin').submit(function() {
                with(document.myFormLogin) {
                    if (inputUser.value == '') {
                        inputUser.focus();
                        return false;
                    }
                    if (inputPass.value == '') {
                        inputPass.focus();
                        return false;
                    }
                }
                // check login 2024
                (async () => {

                    // check authentication API 
                    // if (!service_api.init.status) {
                    //     alert(service_api.init.msg);
                    //     return false;
                    // }

                    // check user in db
                    const check_users = await check_user_in_db(inputUser.value, inputPass.value);
                    if (check_users?.status) {
                        if (check_users?.type == 2) {
                            // validation password
                            // length less than 8 charecter and user type is domain oneaccount
                            let validation_checklength = validation.checklength(inputPass.value);
                            // check case validate password
                            let validation_incase = validation.incase(inputPass.value);
                            // get case
                            let validator = validation.validation(validation_incase);
                            if (!validator.status || !validation_checklength) {
                                // redirect to reset password
                                Swal.fire({
                                    title: service_api?.config?.msg?.reset_password?.title,
                                    text: service_api?.config?.msg?.reset_password?.msg,
                                    icon: service_api?.config?.msg?.reset_password?.icon,
                                    confirmButtonColor: "#0058c6",
                                    confirmButtonText: "ตกลง",
                                    showCancelButton: true,
                                    cancelButtonColor: "#d33",
                                    cancelButtonText: "ยกเลิก",
                                    allowOutsideClick: false
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        let url =
                                            `https://oneaccount.dmcr.go.th/change-password?username=${inputUser.value}`;
                                        window.open(url, '_blank');
                                    }
                                });
                            } else {
                                // check password time out (3 month)
                                const check_user_oneaccounts = await check_user_oneaccount(service_api, inputUser.value);
                                if (!check_user_oneaccounts) {
                                    // password time out
                                    Swal.fire({
                                        title: service_api?.config?.msg?.timeout_password
                                            ?.title,
                                        text: service_api?.config?.msg?.timeout_password
                                            ?.msg,
                                        icon: service_api?.config?.msg?.timeout_password
                                            ?.icon,
                                        confirmButtonColor: "#fc9803",
                                        confirmButtonText: "อัพเดทรหัสผ่าน",
                                        showCancelButton: true,
                                        cancelButtonColor: "#0058c6",
                                        cancelButtonText: "ข้าม",
                                        allowOutsideClick: false
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            let url =
                                                `https://oneaccount.dmcr.go.th/change-password?username=${inputUser.value}`;
                                            window.open(url, '_blank');
                                        } else {
                                            checkLoginUser();
                                        }
                                    });
                                } else {
                                    // password not time out
                                    checkLoginUser();
                                }
                            }
                        } else {
                            // private user
                            checkLoginUser();
                        }
                    } else {
                        // error login
                        checkLoginUser();
                    }
                })();
                return false;
            });
        });
    </script>

    <?php include('newtheme/load-NewTheme-login.php'); ?>
</head>

<body class="new_login">
    <!-- loginNew start -->
    <div class="loginNew-wrapper">
        <div class="collumn col-left d-flex flex-lg-row-fluid">
            <address><?php echo  $langTxt["login:footecopy"] ?></address>
        </div>
        <div class="collumn col-right d-flex flex-lg-row-fluid">
            <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                <div class="login-form">
                    <div class="body">
                        <div class="brand"><img src="img/new-brand.png" alt="<?= $valNameSystem ?>"></div>
                        <div class="title">
                            <strong>ยินดีต้อนรับเข้าสู่ระบบ</strong>
                            <br>
                            <small>
                                <?= $valNameSystem ?>
                                <br>
                                กรมทรัพยากรทางทะเลและชายฝั่ง
                            </small>
                        </div>
                        <form class="form-default" action="index.php" method="post" name="myFormLogin" id="myFormLogin">
                            <input id="inputUrl" name="inputUrl" type="hidden" value="<?php echo  $uID ?>">
                            <div class="form-group">
                                <label class="control-label">ชื่อผู้ใช้งาน</label>
                                <div class="control-group">
                                    <span class="feather icon-user"></span>
                                    <input class="form-control" type="text" name="inputUser" id="inputUser" placeholder="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">รหัสผ่าน</label>
                                <div class="control-group">
                                    <span class="feather icon-unlock"></span>
                                    <input class="form-control" type="password" name="inputPass" id="inputPass" placeholder="">
                                    <button type="button" id="Pass" data-toggle="password" data-target="inputPass" class="feather icon-eye-off"></button>
                                </div>
                            </div>
                            <div style="display:none;" id="loadAlertLogin">
                                <img src="img/btn/error.png"> <?php echo  $langTxt["login:alert"] ?>
                            </div>
                            <div style="display:none;margin-top: 15px;" id="loadAlertLoginOA"></div>
                            <div class="form-btn">
                                <input class="btn btn-primary" name="input" type="submit" value="<?= $langTxt["login:btn"] ?>" />
                            </div>
                            <!-- start: sso btn -->
                            <!-- หากนำ class show ออก ค่าเริ่มต้นของ form-btn-sso จะปิดการแสดงผล -->
                            <div class="form-btn-sso show">
                                <div class="form-hr">
                                <p>หรือ</p>
                                </div>
                                <div class="form-btn mt-0">
                                <a href="<?php echo $core_full_path . '/weadmin/lib/ActiveOAuth2' ?>" class="btn btn-primary btn-sso-login" type="button">
                                    <span><?php echo "เข้าสู่ระบบโดย SSO" ?></span>
                                    <span class="icon-sso -default">
                                    <img src="./lib/ActiveOAuth2/assets/img/sso-default.png" alt="sso-default">
                                    </span>
                                    <span class="icon-sso -hover">
                                    <img src="./lib/ActiveOAuth2/assets/img/sso-hover.png" alt="sso-hover">
                                    </span>
                                </a>
                                </div>
                            </div>
                            <!-- end: sso btn -->
                        </form>
                    </div>
                </div>
                <div class="copy-rights"><?php echo  $langTxt["login:footecontact"] ?></div>
                <i class="version"><?php echo 'Current PHP Version: ' . phpversion(); ?></i>
            </div>
        </div>
    </div>
    <!-- loginNew end -->
        
    <div id="loadCheckComplete"></div>
    <div id="tallContent" style="display:none">
        <span style="font-size:18px;">Please waiting..</span>
        <div style="height:10px;"></div>
        <img src="img/loader/login.gif" />
    </div>
    <?php wewebDisconnect($coreLanguageSQL); ?>
</body>

</html>