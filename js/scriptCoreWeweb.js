// JavaScript Document
// ####################################### Start Setting ################################################# //

function Paging_CheckAll(objCheckHeader, txtCheckBoxFirstName, intTotalItems) {
  if (intTotalItems > 0){
    for (i = 1; i <= intTotalItems; i++){
      if (document.getElementById(txtCheckBoxFirstName + i) !== null) {
        document.getElementById(txtCheckBoxFirstName + i).checked = objCheckHeader.checked;
      }
    }
  }
  return true;
}

function Paging_CheckAllHandle(
  objCheckHeader,
  txtCheckBoxFirstName,
  intTotalItems
) {
  var isCheckedAll = true;
  if (intTotalItems > 0){
    for (i = 1; i <= intTotalItems; i++){
      if (document.getElementById(txtCheckBoxFirstName + i) !== null && !document.getElementById(txtCheckBoxFirstName + i).checked){
        isCheckedAll = false;
      }
    }
  }
  objCheckHeader.checked = isCheckedAll;
  return true;
}

function Paging_CountChecked(txtCheckBoxFirstName, intTotalItems) {
  var intChecked = 0;
  if (intTotalItems > 0){
    for (i = 1; i <= intTotalItems; i++){
      if (document.getElementById(txtCheckBoxFirstName + i) !== null && document.getElementById(txtCheckBoxFirstName + i).checked){
        intChecked++;
      }
    }
  }
  return intChecked;
}

function Paging_CheckedThisItem(
  objCheckHeader,
  indexing,
  txtCheckBoxFirstName,
  intTotalItems
) {
  if (intTotalItems > 0){
    for (i = 1; i <= intTotalItems; i++){
      if (i == indexing && document.getElementById(txtCheckBoxFirstName + i) !== null) {
        document.getElementById(txtCheckBoxFirstName + i).checked = true;
      } else if (document.getElementById(txtCheckBoxFirstName + i) !== null){
        document.getElementById(txtCheckBoxFirstName + i).checked = false;
      }
    }
  }
  objCheckHeader.checked = false;
  return true;
}

function popup(pname, purl, w, h, s) {
  LeftPosition = screen.width ? (screen.width - w - 8) / 2 : 0;
  TopPosition = screen.height ? (screen.height - h - 50) / 2 : 0;
  myWinName = window.open(
    purl,
    pname,
    "width=" +
      w +
      ",height=" +
      h +
      ",top=" +
      TopPosition +
      ",left=" +
      LeftPosition +
      ",resizable=yes,scrollbars=" +
      s
  );
  if (parseInt(navigator.appVersion) >= 4) {
    myWinName.window.focus();
  }
  return myWinName;
}

function setImageSelected(myPath) {
  window.opener.document.LibraryIconSample.src = myPath;
  window.opener.document.myForm.inputIconName.value = myPath;
  window.close();
}

function isBlank(myObj) {
  if (myObj.value == "") {
    return true;
  }
  return false;
}

function isNumber(myObj) {
  return !isNaN(myObj.value * 1);
}

// ####################################### End Setting ################################################# //
// ####################################### Start Login ################################################# //

function checkLoginUser() {
  jQuery.blockUI({
    message: jQuery("#tallContent"),
    css: {
      border: "none",
      padding: "35px",
      backgroundColor: "#000",
      "-webkit-border-radius": "10px",
      "-moz-border-radius": "10px",
      opacity: 0.9,
      color: "#fff",
    },
  });

  var TYPE = "POST";
  var URL = "core/login.php";

  var dataSet = jQuery("#myFormLogin").serialize();
  jQuery.ajax({
    type: TYPE,
    url: URL,
    data: dataSet,
    success: function (html) {
      jQuery("#loadCheckComplete").show();
      jQuery("#loadCheckComplete").html(html);
      setTimeout(jQuery.unblockUI, 200);
    },
  });
}

function checkLogoutUser() {
  jQuery.blockUI({
    message: jQuery("#tallContent"),
    css: {
      border: "none",
      padding: "35px",
      backgroundColor: "#000",
      "-webkit-border-radius": "10px",
      "-moz-border-radius": "10px",
      opacity: 0.9,
      color: "#fff",
    },
  });

  var TYPE = "POST";
  var URL = "../core/logout.php";

  var dataSet = {};
  jQuery.ajax({
    type: TYPE,
    url: URL,
    data: dataSet,
    success: function (html) {
      jQuery("#loadCheckComplete").show();
      jQuery("#loadCheckComplete").html(html);
      setTimeout(jQuery.unblockUI, 200);
    },
  });
}

// ####################################### End Login ################################################# //
// ####################################### Start Top Menu ################################################# //
function clickInSubMenuTop() {
  var divSubMenu = jQuery("#divSubMenuTop");
  divSubMenu.show();
  divSubMenu.animate({ height: "40px" }, 400);
  jQuery("#showSubMenuTop").attr("onclick", "clickOutSubMenuTop()");
}

function clickOutSubMenuTop() {
  var divSubMenu = jQuery("#divSubMenuTop");
  divSubMenu.animate({ height: "0px" }, 400);
  divSubMenu.hide(0);
  jQuery("#showSubMenuTop").attr("onclick", "clickInSubMenuTop()");
}
// ####################################### End Top Menu ################################################# //
// ####################################### Start Left Menu ################################################# //
function clickInSubMenuLeft(boxMenu, boxMenuLeft, valHeight) {
  var divSubMenuL = jQuery("#" + boxMenuLeft);
  divSubMenuL.show();
  divSubMenuL.animate({ height: valHeight + "px" }, 500);
  jQuery("#" + boxMenu).attr(
    "onclick",
    "clickOutSubMenuLeft('" +
      boxMenu +
      "','" +
      boxMenuLeft +
      "','" +
      valHeight +
      "')"
  );
}

function clickOutSubMenuLeft(boxMenu, boxMenuLeft, valHeight) {
  var divSubMenuL = jQuery("#" + boxMenuLeft);
  divSubMenuL.animate({ height: "0px" }, 500);
  divSubMenuL.hide(0);
  jQuery("#" + boxMenu).attr(
    "onclick",
    "clickInSubMenuLeft('" +
      boxMenu +
      "','" +
      boxMenuLeft +
      "','" +
      valHeight +
      "')"
  );
}
// ####################################### End Left Menu ################################################# //
// ####################################### Start Home ################################################# //

function boxContantLoad(fileAc) {
  jQuery("#boxWaittingContant").show();

  var TYPE = "POST";
  var URL = fileAc;

  var dataSet = jQuery("#myFormHome").serialize();
  jQuery.ajax({
    type: TYPE,
    url: URL,
    data: dataSet,
    success: function (html) {
      jQuery("#boxContantLoad").show();
      jQuery("#boxContantLoad").html(html);
      jQuery("#boxWaittingContant").hide();
    },
  });
}

function addContactNew(fileAc) {
  document.myFormHome.action = fileAc;
  document.myFormHome.submit();
}

function editContactNew(fileAc, id) {
  document.myFormHome.action = fileAc;
  document.myFormHome.submit();
}

function sortContactNew(fileAc) {
  document.myFormHome.action = fileAc;
  document.myFormHome.submit();
}

function insertContactNew(fileAc) {
  jQuery.blockUI({
    message: jQuery("#tallContent"),
    css: {
      border: "none",
      padding: "35px",
      backgroundColor: "#000",
      "-webkit-border-radius": "10px",
      "-moz-border-radius": "10px",
      opacity: 0.9,
      color: "#fff",
    },
  });

  var TYPE = "POST";
  var URL = fileAc;

  var hour = jQuery("#myForm")
    .find("#sHourInput option:disabled")
    .removeAttr("disabled");
  var min = jQuery("#myForm")
    .find("#sMinInput option:disabled")
    .removeAttr("disabled");
  var dataSet = jQuery("#myForm").serialize();
  hour.attr("disabled", "disabled");
  min.attr("disabled", "disabled");
  // console.log("sHourInput = " + hour.attr());
  // console.log("sMinInput = " + min.attr());
  // console.log(dataSet);
  // return false;

  jQuery.ajax({
    type: TYPE,
    url: URL,
    data: dataSet,
    success: function (html) {
      jQuery("#loadCheckComplete").show();
      jQuery("#loadCheckComplete").html(html);
      setTimeout(jQuery.unblockUI, 200);
    },
  });
}

function loadDownloadSelectMl(gID, masterkey, tID) {
  //alert('test');
  jQuery("#loadWaitingCategory").show();

  var TYPE = "POST";
  var URL = "../mod_downloadml/load_selectType.php";
  var dataSet = {
    gID: gID,
    masterkey: masterkey,
    tID: tID,
  };

  jQuery.ajax({
    type: TYPE,
    url: URL,
    data: dataSet,
    success: function (html) {
      jQuery("#loadLevelTypeID").show();
      jQuery("#loadLevelTypeID").html(html);
      jQuery("#loadWaitingCategory").hide();
    },
  });
}

function loadDownloadSelectGroup(gID, masterkey, tID) {
  // alert('test');
  jQuery("#loadWaitingCategory").show();

  var TYPE = "POST";
  var URL = "../mod_cmsgml/load_selectGroup.php";
  var dataSet = {
    gID: gID,
    masterkey: masterkey,
    tID: tID,
  };

  jQuery.ajax({
    type: TYPE,
    url: URL,
    data: dataSet,
    success: function (html) {
      jQuery("#loadLevelGroupID").show();
      jQuery("#loadLevelGroupID").html(html);
      jQuery("#loadWaitingCategory").hide();
    },
  });
}

function loadWeblinkSelectMl(gID, masterkey, tID) {
  //alert('test');
  jQuery("#loadWaitingCategory").show();

  var TYPE = "POST";
  var URL = "../mod_weblink_minipro/load_selectType.php";
  var dataSet = {
    gID: gID,
    masterkey: masterkey,
    tID: tID,
  };

  jQuery.ajax({
    type: TYPE,
    url: URL,
    data: dataSet,
    success: function (html) {
      jQuery("#loadLevelTypeID").show();
      jQuery("#loadLevelTypeID").html(html);
      jQuery("#loadWaitingCategory").hide();
    },
  });
}

function updateContactNew(fileAc) {
  jQuery.blockUI({
    message: jQuery("#tallContent"),
    css: {
      border: "none",
      padding: "35px",
      backgroundColor: "#000",
      "-webkit-border-radius": "10px",
      "-moz-border-radius": "10px",
      opacity: 0.9,
      color: "#fff",
    },
  });

  var TYPE = "POST";
  var URL = fileAc;

  var hour = jQuery("#myForm")
    .find("#sHourInput option:disabled")
    .removeAttr("disabled");
  var min = jQuery("#myForm")
    .find("#sMinInput option:disabled")
    .removeAttr("disabled");
  var dataSet = jQuery("#myForm").serialize();
  hour.attr("disabled", "disabled");
  min.attr("disabled", "disabled");
  // console.log("sHourInput = " + hour.attr());
  // console.log("sMinInput = " + min.attr());
  // console.log(dataSet);
  // return false;

  jQuery.ajax({
    type: TYPE,
    url: URL,
    data: dataSet,
    success: function (html) {
      jQuery("#loadCheckComplete").show();
      jQuery("#loadCheckComplete").html(html);
      setTimeout(jQuery.unblockUI, 200);
    },
  });
}

function syncContactNew(fileAc) {
  jQuery.blockUI({
    message: jQuery("#tallContent"),
    css: {
      border: "none",
      padding: "35px",
      backgroundColor: "#000",
      "-webkit-border-radius": "10px",
      "-moz-border-radius": "10px",
      opacity: 0.9,
      color: "#fff",
    },
  });

  var TYPE = "POST";
  var URL = fileAc;

  var dataSet = jQuery("#myForm").serialize();

  jQuery.ajax({
    type: TYPE,
    url: URL,
    data: dataSet,
    success: function (html) {
      jQuery("#loadCheckComplete").show();
      jQuery("#loadCheckComplete").html(html);
      setTimeout(jQuery.unblockUI, 200);
    },
  });
}

function delContactNew(fileAc) {
  jQuery.blockUI({
    message: jQuery("#tallContent"),
    css: {
      border: "none",
      padding: "35px",
      backgroundColor: "#000",
      "-webkit-border-radius": "10px",
      "-moz-border-radius": "10px",
      opacity: 0.9,
      color: "#fff",
    },
  });

  var TYPE = "POST";
  var URL = fileAc;

  var dataSet = jQuery("#myForm").serialize();

  jQuery.ajax({
    type: TYPE,
    url: URL,
    data: dataSet,
    success: function (html) {
      jQuery("#loadCheckComplete").show();
      jQuery("#loadCheckComplete").html(html);
      setTimeout(jQuery.unblockUI, 200);
    },
  });
}

function viewContactNew(fileAc) {
  jQuery.blockUI({
    message: jQuery("#tallContent"),
    css: {
      border: "none",
      padding: "35px",
      backgroundColor: "#000",
      "-webkit-border-radius": "10px",
      "-moz-border-radius": "10px",
      opacity: 0.9,
      color: "#fff",
    },
  });

  var TYPE = "POST";
  var URL = fileAc;

  var dataSet = jQuery("#myFormHome").serialize();

  jQuery.ajax({
    type: TYPE,
    url: URL,
    data: dataSet,
    success: function (html) {
      jQuery("#boxContantLoad").show();
      jQuery("#boxContantLoad").html(html);
      setTimeout(jQuery.unblockUI, 200);
    },
  });
}

function changeStatus(
  loaddder,
  tablename,
  statusname,
  statusid,
  loadderstatus,
  fileAc
) {
  jQuery("#" + loaddder + "").show();

  var TYPE = "POST";
  var URL = fileAc;
  var dataSet = {
    Valueloaddder: loaddder,
    Valuetablename: tablename,
    Valuestatusname: statusname,
    Valuestatusid: statusid,
    Valueloadderstatus: loadderstatus,
    Valuefilestatus: fileAc,
  };

  jQuery.ajax({
    type: TYPE,
    url: URL,
    data: dataSet,
    success: function (html) {
      jQuery("#" + loadderstatus + "").show();
      jQuery("#" + loadderstatus + "").html(html);
      jQuery("#" + loaddder + "").hide();
    },
  });
}

// function changeRibbon(tablename, statusname, statusid, fileAc) {

//     jQuery("#" + loaddder + "").show();

//     var TYPE = "POST";
//     var URL = fileAc;
//     var dataSet = {
//         Valuetablename: tablename,
//         Valuestatusname: statusname,
//         Valuestatusid: statusid,
//         Valuefilestatus: fileAc
//     };

//     jQuery.ajax({type: TYPE, url: URL, data: dataSet,
//         success: function (html) {

//             jQuery("#" + loadderstatus + "").show();
//             jQuery("#" + loadderstatus + "").html(html)
//             jQuery("#" + loaddder + "").hide();
//         }
//     });
// }

function sortingContactNew(fileAc) {
  jQuery.blockUI({
    message: jQuery("#tallContent"),
    css: {
      border: "none",
      padding: "35px",
      backgroundColor: "#000",
      "-webkit-border-radius": "10px",
      "-moz-border-radius": "10px",
      opacity: 0.9,
      color: "#fff",
    },
  });

  var TYPE = "POST";
  var URL = fileAc;
  var dataSet = jQuery("#myForm").serialize();
  //alert(dataSet);
  jQuery.ajax({
    type: TYPE,
    url: URL,
    data: dataSet,
    success: function (html) {
      jQuery("#loadCheckComplete").show();
      jQuery("#loadCheckComplete").html(html);
      setTimeout(jQuery.unblockUI, 200);
    },
  });
}

function btnBackPage(fileAc) {
  document.myFormHome.action = fileAc;
  document.myFormHome.submit();
}

function checkUsermember(username) {
  jQuery.blockUI({
    message: jQuery("#tallContent"),
    css: {
      border: "none",
      padding: "35px",
      backgroundColor: "#000",
      "-webkit-border-radius": "10px",
      "-moz-border-radius": "10px",
      opacity: 0.9,
      color: "#fff",
    },
  });

  var TYPE = "POST";
  var URL = "../core/checkUser.php";
  var dataSet = jQuery("#myForm").serialize();

  jQuery.ajax({
    type: TYPE,
    url: URL,
    data: dataSet,
    success: function (html) {
      jQuery("#loadCheckComplete").show();
      jQuery("#loadCheckComplete").html(html);
      setTimeout(jQuery.unblockUI, 200);
    },
  });
}

function checkUsermemberOA(username) {
  // jQuery.blockUI({
  //     message: jQuery('#tallContent'),
  //     css: {border: 'none', padding: '35px', backgroundColor: '#000', '-webkit-border-radius': '10px', '-moz-border-radius': '10px', opacity: .9, color: '#fff'
  //     }
  // });

  var TYPE = "POST";
  var URL = "../lib/ActiveDirectory/checkUser.php";
  var dataSet = jQuery("#myForm").serialize();

  jQuery.ajax({type: TYPE, url: URL, data: dataSet, dataType: "json",
      success: function (result) {
              jQuery("#loadCheckComplete").show();
              console.log(result);
              if (result.status == true) {
                  jQuery("#inputUserName").removeClass("formInputContantTbAlertY");
              }else{
                  jQuery("#inputUserName").addClass("formInputContantTbAlertY");
                  document.myForm.inputUserName.value = ''
                  document.myForm.inputUserName.focus();
              }
          // jQuery("#loadCheckComplete").show();
          // jQuery("#loadCheckComplete").html(html);
          // setTimeout(jQuery.unblockUI, 200);
      }
  });
}

function checkUsermemberEdit(userid, username) {
  jQuery.blockUI({
    message: jQuery("#tallContent"),
    css: {
      border: "none",
      padding: "35px",
      backgroundColor: "#000",
      "-webkit-border-radius": "10px",
      "-moz-border-radius": "10px",
      opacity: 0.9,
      color: "#fff",
    },
  });

  var TYPE = "POST";
  var URL = "../core/checkUserEdit.php";
  var dataSet = {
    Valueuserid: userid,
    Valueusername: username,
  };

  jQuery.ajax({
    type: TYPE,
    url: URL,
    data: dataSet,
    success: function (html) {
      jQuery("#loadCheckComplete").show();
      jQuery("#loadCheckComplete").html(html);
      setTimeout(jQuery.unblockUI, 200);
    },
  });
}

function sortingContactHome(fileAc) {
  jQuery.blockUI({
    message: jQuery("#tallContent"),
    css: {
      border: "none",
      padding: "35px",
      backgroundColor: "#000",
      "-webkit-border-radius": "10px",
      "-moz-border-radius": "10px",
      opacity: 0.9,
      color: "#fff",
    },
  });

  var TYPE = "POST";
  var URL = fileAc;
  var dataSet = jQuery("#myFormSort").serialize();
  //alert(dataSet);
  jQuery.ajax({
    type: TYPE,
    url: URL,
    data: dataSet,
    success: function (html) {
      jQuery("#loadCheckComplete").show();
      jQuery("#loadCheckComplete").html(html);
      setTimeout(jQuery.unblockUI, 200);
    },
  });
}

function loadContantHome(fileAc, divAc, masterkey, menukeyid) {
  var TYPE = "POST";
  var URL = fileAc;
  var dataSet = { masterkey: masterkey, menukeyid: menukeyid };
  //alert(dataSet);
  jQuery.ajax({
    type: TYPE,
    url: URL,
    data: dataSet,
    success: function (html) {
      jQuery("#" + divAc).show();
      jQuery("#" + divAc).html(html);
    },
  });
}

function delContactHome(fileAc, delID, divAc) {
  jQuery.blockUI({
    message: jQuery("#tallContent"),
    css: {
      border: "none",
      padding: "35px",
      backgroundColor: "#000",
      "-webkit-border-radius": "10px",
      "-moz-border-radius": "10px",
      opacity: 0.9,
      color: "#fff",
    },
  });

  var TYPE = "POST";
  var URL = fileAc;
  var dataSet = { delID: delID };
  //alert(dataSet);
  jQuery.ajax({
    type: TYPE,
    url: URL,
    data: dataSet,
    success: function (html) {
      jQuery("#loadCheckComplete").show();
      jQuery("#loadCheckComplete").html(html);
      jQuery("#" + divAc).remove();
      setTimeout(jQuery.unblockUI, 200);
    },
  });
}

function addContactBox(fileAc, delID, divHide, divShow) {
  jQuery.blockUI({
    message: jQuery("#tallContent"),
    css: {
      border: "none",
      padding: "35px",
      backgroundColor: "#000",
      "-webkit-border-radius": "10px",
      "-moz-border-radius": "10px",
      opacity: 0.9,
      color: "#fff",
    },
  });

  var TYPE = "POST";
  var URL = fileAc;

  var dataSet = { delID: delID, divShow: divShow };

  jQuery.ajax({
    type: TYPE,
    url: URL,
    data: dataSet,
    success: function (html) {
      jQuery("#loadCheckComplete").show();
      jQuery("#loadCheckComplete").html(html);
      jQuery("#" + divHide).hide();
      jQuery("#" + divShow).show();
      setTimeout(jQuery.unblockUI, 200);
    },
  });
}

function delContactBox(fileAc, delID, divHide, divShow) {
  jQuery.blockUI({
    message: jQuery("#tallContent"),
    css: {
      border: "none",
      padding: "35px",
      backgroundColor: "#000",
      "-webkit-border-radius": "10px",
      "-moz-border-radius": "10px",
      opacity: 0.9,
      color: "#fff",
    },
  });

  var TYPE = "POST";
  var URL = fileAc;

  var dataSet = { delID: delID };

  jQuery.ajax({
    type: TYPE,
    url: URL,
    data: dataSet,
    success: function (html) {
      jQuery("#loadCheckComplete").show();
      jQuery("#loadCheckComplete").html(html);
      jQuery("#" + divHide).hide();
      jQuery("#" + divShow).show();
      setTimeout(jQuery.unblockUI, 200);
    },
  });
}

function loadContantLogHome(fileAc) {
  var TYPE = "POST";
  var URL = fileAc;
  var dataSet = {};
  //alert(dataSet);
  jQuery.ajax({
    type: TYPE,
    url: URL,
    data: dataSet,
    success: function (html) {
      jQuery("#loadContantLogHome").show();
      jQuery("#loadContantLogHome").html(html);
    },
  });
}

function delFileUpload(fileAc) {
  jQuery.blockUI({
    message: jQuery("#tallContent"),
    css: {
      border: "none",
      padding: "35px",
      backgroundColor: "#000",
      "-webkit-border-radius": "10px",
      "-moz-border-radius": "10px",
      opacity: 0.9,
      color: "#fff",
    },
  });

  var TYPE = "POST";
  var URL = fileAc;

  var dataSet = jQuery("#myForm").serialize();

  jQuery.ajax({
    type: TYPE,
    url: URL,
    data: dataSet,
    success: function (html) {
      jQuery("#boxFileNew").show();
      jQuery("#boxFileNew").html(html);
      setTimeout(jQuery.unblockUI, 200);
    },
  });
}

function delFileUploadUp(fileAc) {
  jQuery.blockUI({
    message: jQuery("#tallContent"),
    css: {
      border: "none",
      padding: "35px",
      backgroundColor: "#000",
      "-webkit-border-radius": "10px",
      "-moz-border-radius": "10px",
      opacity: 0.9,
      color: "#fff",
    },
  });

  var TYPE = "POST";
  var URL = fileAc;

  var dataSet = jQuery("#myForm").serialize();

  jQuery.ajax({
    type: TYPE,
    url: URL,
    data: dataSet,
    success: function (html) {
      jQuery("#boxFileNewUp").show();
      jQuery("#boxFileNewUp").html(html);
      setTimeout(jQuery.unblockUI, 200);
    },
  });
}

function delFileUploadAlone(fileAc) {
  jQuery.blockUI({
    message: jQuery("#tallContent"),
    css: {
      border: "none",
      padding: "35px",
      backgroundColor: "#000",
      "-webkit-border-radius": "10px",
      "-moz-border-radius": "10px",
      opacity: 0.9,
      color: "#fff",
    },
  });

  var TYPE = "POST";
  var URL = fileAc;

  var dataSet = jQuery("#myForm").serialize();

  jQuery.ajax({
    type: TYPE,
    url: URL,
    data: dataSet,
    success: function (html) {
      jQuery("#boxFileNewAlone").show();
      jQuery("#boxFileNewAlone").html(html);
      setTimeout(jQuery.unblockUI, 200);
    },
  });
}

function delFileUploadB(fileAc) {
  jQuery.blockUI({
    message: jQuery("#tallContent"),
    css: {
      border: "none",
      padding: "35px",
      backgroundColor: "#000",
      "-webkit-border-radius": "10px",
      "-moz-border-radius": "10px",
      opacity: 0.9,
      color: "#fff",
    },
  });

  var TYPE = "POST";
  var URL = fileAc;

  var dataSet = jQuery("#myForm").serialize();

  jQuery.ajax({
    type: TYPE,
    url: URL,
    data: dataSet,
    success: function (html) {
      jQuery("#boxFileNewBook").show();
      jQuery("#boxFileNewBook").html(html);
      setTimeout(jQuery.unblockUI, 200);
    },
  });
}

function delFileUploadD(fileAc) {
  jQuery.blockUI({
    message: jQuery("#tallContent"),
    css: {
      border: "none",
      padding: "35px",
      backgroundColor: "#000",
      "-webkit-border-radius": "10px",
      "-moz-border-radius": "10px",
      opacity: 0.9,
      color: "#fff",
    },
  });

  var TYPE = "POST";
  var URL = fileAc;

  var dataSet = jQuery("#myForm").serialize();

  jQuery.ajax({
    type: TYPE,
    url: URL,
    data: dataSet,
    success: function (html) {
      jQuery("#boxFileNew").show();
      jQuery("#boxFileNew").html(html);
      setTimeout(jQuery.unblockUI, 200);
    },
  });
}

function delPicUpload(fileAc) {
  jQuery.blockUI({
    message: jQuery("#tallContent"),
    css: {
      border: "none",
      padding: "35px",
      backgroundColor: "#000",
      "-webkit-border-radius": "10px",
      "-moz-border-radius": "10px",
      opacity: 0.9,
      color: "#fff",
    },
  });

  var TYPE = "POST";
  var URL = fileAc;

  var dataSet = jQuery("#myForm").serialize();

  jQuery.ajax({
    type: TYPE,
    url: URL,
    data: dataSet,
    success: function (html) {
      jQuery("#boxPicNew").show();
      jQuery("#boxPicNew").html(html);
      setTimeout(jQuery.unblockUI, 200);
    },
  });
}

/* function modDeleteFileUpdateEnews(downloadNewID,menuid,contantNewid) {
 
 jQuery("#load_contantfile").show();
 
 var TYPE="POST";
 var URL="../mod_enews/deletefileupdate.php";
 var dataSet={ 
 downloadNewID : downloadNewID,
 menuid : menuid,
 contantNewid : contantNewid
 
 };
 jQuery.ajax({type:TYPE,url:URL,data:dataSet,
 success:function(html){
 
 jQuery("#load_filenew").show();
 jQuery("#load_filenew").html(html)
 jQuery("#load_contantfile").hide();
 }
 }); 
 }*/

function modDeleteFileUpdateEnews(downloadNewID, menuid, contantNewid) {
  /*jQuery.blockUI({
     message: jQuery('#tallContent'),
     css: {border: 'none', padding: '35px', backgroundColor: '#000', '-webkit-border-radius': '10px', '-moz-border-radius': '10px', opacity: .9, color: '#fff'
     }
     });*/

  // alert(downloadNewID+' : '+ menuid +' '+contantNewid);

  // jQuery("#load_contantfile").show();

  var TYPE = "POST";
  var URL = "../mod_enews/deletefileupdate.php";
  var dataSet = {
    downloadNewID: downloadNewID,
    menuid: menuid,
    contantNewid: contantNewid,
  };
  jQuery.ajax({
    type: TYPE,
    url: URL,
    data: dataSet,
    success: function (html) {
      jQuery("#boxFileNew").show();
      jQuery("#boxFileNew").html(html);
      //jQuery("#load_contantfile").hide();
    },
  });
}

function delPicUploadVote1(fileAc) {
  jQuery.blockUI({
    message: jQuery("#tallContent"),
    css: {
      border: "none",
      padding: "35px",
      backgroundColor: "#000",
      "-webkit-border-radius": "10px",
      "-moz-border-radius": "10px",
      opacity: 0.9,
      color: "#fff",
    },
  });

  var TYPE = "POST";
  var URL = fileAc;

  var dataSet = jQuery("#myForm").serialize();

  jQuery.ajax({
    type: TYPE,
    url: URL,
    data: dataSet,
    success: function (html) {
      jQuery("#boxVotePicNew1").show();
      jQuery("#boxVotePicNew1").html(html);
      setTimeout(jQuery.unblockUI, 200);
    },
  });
}

function delPicUploadVote2(fileAc) {
  jQuery.blockUI({
    message: jQuery("#tallContent"),
    css: {
      border: "none",
      padding: "35px",
      backgroundColor: "#000",
      "-webkit-border-radius": "10px",
      "-moz-border-radius": "10px",
      opacity: 0.9,
      color: "#fff",
    },
  });

  var TYPE = "POST";
  var URL = fileAc;

  var dataSet = jQuery("#myForm").serialize();

  jQuery.ajax({
    type: TYPE,
    url: URL,
    data: dataSet,
    success: function (html) {
      jQuery("#boxVotePicNew2").show();
      jQuery("#boxVotePicNew2").html(html);
      setTimeout(jQuery.unblockUI, 200);
    },
  });
}

function delPicUploadVote3(fileAc) {
  jQuery.blockUI({
    message: jQuery("#tallContent"),
    css: {
      border: "none",
      padding: "35px",
      backgroundColor: "#000",
      "-webkit-border-radius": "10px",
      "-moz-border-radius": "10px",
      opacity: 0.9,
      color: "#fff",
    },
  });

  var TYPE = "POST";
  var URL = fileAc;

  var dataSet = jQuery("#myForm").serialize();

  jQuery.ajax({
    type: TYPE,
    url: URL,
    data: dataSet,
    success: function (html) {
      jQuery("#boxVotePicNew3").show();
      jQuery("#boxVotePicNew3").html(html);
      setTimeout(jQuery.unblockUI, 200);
    },
  });
}

function delPicUploadVote4(fileAc) {
  jQuery.blockUI({
    message: jQuery("#tallContent"),
    css: {
      border: "none",
      padding: "35px",
      backgroundColor: "#000",
      "-webkit-border-radius": "10px",
      "-moz-border-radius": "10px",
      opacity: 0.9,
      color: "#fff",
    },
  });

  var TYPE = "POST";
  var URL = fileAc;

  var dataSet = jQuery("#myForm").serialize();

  jQuery.ajax({
    type: TYPE,
    url: URL,
    data: dataSet,
    success: function (html) {
      jQuery("#boxVotePicNew4").show();
      jQuery("#boxVotePicNew4").html(html);
      setTimeout(jQuery.unblockUI, 200);
    },
  });
}

function delPicUploadIcon(fileAc) {
  jQuery.blockUI({
    message: jQuery("#tallContent"),
    css: {
      border: "none",
      padding: "35px",
      backgroundColor: "#000",
      "-webkit-border-radius": "10px",
      "-moz-border-radius": "10px",
      opacity: 0.9,
      color: "#fff",
    },
  });

  var TYPE = "POST";
  var URL = fileAc;

  var dataSet = jQuery("#myForm").serialize();

  jQuery.ajax({
    type: TYPE,
    url: URL,
    data: dataSet,
    success: function (html) {
      jQuery("#boxPicIcon").show();
      jQuery("#boxPicIcon").html(html);
      setTimeout(jQuery.unblockUI, 200);
    },
  });
}

function delPicUploadSite(fileAc, box) {
  jQuery.blockUI({
    message: jQuery("#tallContent"),
    css: {
      border: "none",
      padding: "35px",
      backgroundColor: "#000",
      "-webkit-border-radius": "10px",
      "-moz-border-radius": "10px",
      opacity: 0.9,
      color: "#fff",
    },
  });

  var TYPE = "POST";
  var URL = fileAc;

  var dataSet = jQuery("#myForm").serialize();

  jQuery.ajax({
    type: TYPE,
    url: URL,
    data: dataSet,
    success: function (html) {
      jQuery("#" + box).show();
      jQuery("#" + box).html(html);
      setTimeout(jQuery.unblockUI, 200);
    },
  });
}

function delPicUploadTicket(fileAc) {
  jQuery.blockUI({
    message: jQuery("#tallContent"),
    css: {
      border: "none",
      padding: "35px",
      backgroundColor: "#000",
      "-webkit-border-radius": "10px",
      "-moz-border-radius": "10px",
      opacity: 0.9,
      color: "#fff",
    },
  });

  var TYPE = "POST";
  var URL = fileAc;

  var dataSet = jQuery("#myForm").serialize();

  jQuery.ajax({
    type: TYPE,
    url: URL,
    data: dataSet,
    success: function (html) {
      jQuery("#boxPicNewTicket").show();
      jQuery("#boxPicNewTicket").html(html);
      setTimeout(jQuery.unblockUI, 200);
    },
  });
}

function delPicUploadT(fileAc) {
  jQuery.blockUI({
    message: jQuery("#tallContent"),
    css: {
      border: "none",
      padding: "35px",
      backgroundColor: "#000",
      "-webkit-border-radius": "10px",
      "-moz-border-radius": "10px",
      opacity: 0.9,
      color: "#fff",
    },
  });

  var TYPE = "POST";
  var URL = fileAc;

  var dataSet = jQuery("#myForm").serialize();

  jQuery.ajax({
    type: TYPE,
    url: URL,
    data: dataSet,
    success: function (html) {
      jQuery("#boxPicNewT").show();
      jQuery("#boxPicNewT").html(html);
      setTimeout(jQuery.unblockUI, 200);
    },
  });
}

function delPicUploadMap(fileAc) {
  jQuery.blockUI({
    message: jQuery("#tallContent"),
    css: {
      border: "none",
      padding: "35px",
      backgroundColor: "#000",
      "-webkit-border-radius": "10px",
      "-moz-border-radius": "10px",
      opacity: 0.9,
      color: "#fff",
    },
  });

  var TYPE = "POST";
  var URL = fileAc;

  var dataSet = jQuery("#myForm").serialize();

  jQuery.ajax({
    type: TYPE,
    url: URL,
    data: dataSet,
    success: function (html) {
      jQuery("#boxPicNewMap").show();
      jQuery("#boxPicNewMap").html(html);
      setTimeout(jQuery.unblockUI, 200);
    },
  });
}

function delPicUploadC(fileAc) {
  jQuery.blockUI({
    message: jQuery("#tallContent"),
    css: {
      border: "none",
      padding: "35px",
      backgroundColor: "#000",
      "-webkit-border-radius": "10px",
      "-moz-border-radius": "10px",
      opacity: 0.9,
      color: "#fff",
    },
  });

  var TYPE = "POST";
  var URL = fileAc;

  var dataSet = jQuery("#myForm").serialize();

  jQuery.ajax({
    type: TYPE,
    url: URL,
    data: dataSet,
    success: function (html) {
      jQuery("#boxPicNewPic").show();
      jQuery("#boxPicNewPic").html(html);
      setTimeout(jQuery.unblockUI, 200);
    },
  });
}

function delPicUploadHead(fileAc) {
  jQuery.blockUI({
    message: jQuery("#tallContent"),
    css: {
      border: "none",
      padding: "35px",
      backgroundColor: "#000",
      "-webkit-border-radius": "10px",
      "-moz-border-radius": "10px",
      opacity: 0.9,
      color: "#fff",
    },
  });

  var TYPE = "POST";
  var URL = fileAc;

  var dataSet = jQuery("#myForm").serialize();

  jQuery.ajax({
    type: TYPE,
    url: URL,
    data: dataSet,
    success: function (html) {
      jQuery("#boxPicNewHead").show();
      jQuery("#boxPicNewHead").html(html);
      setTimeout(jQuery.unblockUI, 200);
    },
  });
}

function delAlbumUpload(fileAc) {
  jQuery.blockUI({
    message: jQuery("#tallContent"),
    css: {
      border: "none",
      padding: "35px",
      backgroundColor: "#000",
      "-webkit-border-radius": "10px",
      "-moz-border-radius": "10px",
      opacity: 0.9,
      color: "#fff",
    },
  });

  var TYPE = "POST";
  var URL = fileAc;

  var dataSet = jQuery("#myForm").serialize();

  jQuery.ajax({
    type: TYPE,
    url: URL,
    data: dataSet,
    success: function (html) {
      jQuery("#boxAlbumNew").show();
      jQuery("#boxAlbumNew").html(html);
      setTimeout(jQuery.unblockUI, 200);
    },
  });
}

function delVideoUpload(fileAc) {
  jQuery.blockUI({
    message: jQuery("#tallContent"),
    css: {
      border: "none",
      padding: "35px",
      backgroundColor: "#000",
      "-webkit-border-radius": "10px",
      "-moz-border-radius": "10px",
      opacity: 0.9,
      color: "#fff",
    },
  });

  var TYPE = "POST";
  var URL = fileAc;

  var dataSet = jQuery("#myForm").serialize();

  jQuery.ajax({
    type: TYPE,
    url: URL,
    data: dataSet,
    success: function (html) {
      jQuery("#boxVideoNew").show();
      jQuery("#boxVideoNew").html(html);
      setTimeout(jQuery.unblockUI, 200);
    },
  });
}

function delColUpload(fileAc) {
  jQuery.blockUI({
    message: jQuery("#tallContent"),
    css: {
      border: "none",
      padding: "35px",
      backgroundColor: "#000",
      "-webkit-border-radius": "10px",
      "-moz-border-radius": "10px",
      opacity: 0.9,
      color: "#fff",
    },
  });

  var TYPE = "POST";
  var URL = fileAc;

  var dataSet = jQuery("#myForm").serialize();

  jQuery.ajax({
    type: TYPE,
    url: URL,
    data: dataSet,
    success: function (html) {
      jQuery("#boxLoadColorShow").show();
      jQuery("#boxLoadColorShow").html(html);
      setTimeout(jQuery.unblockUI, 200);
    },
  });
}

function delAlbumUploadIn(fileAc) {
  jQuery.blockUI({
    message: jQuery("#tallContent"),
    css: {
      border: "none",
      padding: "35px",
      backgroundColor: "#000",
      "-webkit-border-radius": "10px",
      "-moz-border-radius": "10px",
      opacity: 0.9,
      color: "#fff",
    },
  });

  var TYPE = "POST";
  var URL = fileAc;

  var dataSet = jQuery("#myForm").serialize();

  jQuery.ajax({
    type: TYPE,
    url: URL,
    data: dataSet,
    success: function (html) {
      jQuery("#boxAlbumNewIn").show();
      jQuery("#boxAlbumNewIn").html(html);
      setTimeout(jQuery.unblockUI, 200);
    },
  });
}

function delAlbumUploadOut(fileAc) {
  jQuery.blockUI({
    message: jQuery("#tallContent"),
    css: {
      border: "none",
      padding: "35px",
      backgroundColor: "#000",
      "-webkit-border-radius": "10px",
      "-moz-border-radius": "10px",
      opacity: 0.9,
      color: "#fff",
    },
  });

  var TYPE = "POST";
  var URL = fileAc;

  var dataSet = jQuery("#myForm").serialize();

  jQuery.ajax({
    type: TYPE,
    url: URL,
    data: dataSet,
    success: function (html) {
      jQuery("#boxAlbumNewOut").show();
      jQuery("#boxAlbumNewOut").html(html);
      setTimeout(jQuery.unblockUI, 200);
    },
  });
}

// ####################################### End Home ################################################# //
// ####################################### Start FCK ################################################# //
function onLoadFCK() {
  if (!CKEDITOR.env.ie || CKEDITOR.env.version > 7)
    CKEDITOR.env.isCompatible = true;
  // var roxyFileman = '/mnre/fileman/index.html';
  var roxyFileman = "/fileman/index.html";
  //CKEDITOR.config.forcePasteAsPlainText = true;
  // Enable CKEditor in all environments except IE7 and below.
  //if (!CKEDITOR.env.ie || CKEDITOR.env.version > 7) {
  //    CKEDITOR.env.isCompatible = true;
  //}
  CKEDITOR.replace("editDetail", {
    //filebrowserUploadUrl: "../../ckeditor/ckupload.php",
    filebrowserUploadUrl: "../../ckeditor/ckupload.php",
    filebrowserBrowseUrl: roxyFileman,
    filebrowserImageBrowseUrl: roxyFileman + "?type=image",
    extraPlugins: "tableresize,tabletools,quicktable",
    removeDialogTabs: "link:upload;image:upload",
    toolbar: [
      {
        name: "document",
        groups: ["mode", "document", "doctools"],
        items: ["Source", "-", "-", "-", "-", "-", "-", "-"],
      },
      {
        name: "clipboard",
        groups: ["clipboard", "undo"],
        items: [
          "Cut",
          "Copy",
          "Paste",
          "PasteText",
          "PasteFromWord",
          "-",
          "Undo",
          "Redo",
          "RemoveFormat",
        ],
      },
      {
        name: "editing",
        groups: ["find", "selection", "spellchecker"],
        items: ["Find", "Replace", "-", "SelectAll", "-", "Scayt"],
      },
      {
        name: "forms",
        items: [
          "Form",
          "Checkbox",
          "Radio",
          "TextField",
          "Textarea",
          "Select",
          "Button",
          "ImageButton",
          "HiddenField",
        ],
      },
      "/",
      {
        name: "basicstyles",
        groups: ["basicstyles", "cleanup"],
        items: [
          "Bold",
          "Italic",
          "Underline",
          "Strike",
          "Subscript",
          "Superscript",
          "-",
          "RemoveFormat",
        ],
      },
      {
        name: "paragraph",
        groups: ["list", "indent", "blocks", "align", "bidi"],
        items: [
          "NumberedList",
          "BulletedList",
          "-",
          "Outdent",
          "Indent",
          "-",
          "Blockquote",
          "CreateDiv",
          "-",
          "JustifyLeft",
          "JustifyCenter",
          "JustifyRight",
          "JustifyBlock",
          "-",
          "BidiLtr",
          "BidiRtl",
          "Language",
        ],
      },
      { name: "links", items: ["Link", "Unlink", "Anchor"] },
      {
        name: "insert",
        items: [
          "Image",
          "-",
          "Table",
          "HorizontalRule",
          "Smiley",
          "SpecialChar",
          "PageBreak",
          "Iframe",
        ],
      },
      "/",
      { name: "styles", items: ["Font", "FontSize"] },
      { name: "colors", items: ["TextColor", "BGColor"] },
      { name: "tools", items: ["Maximize", "-"] },
      { name: "others", items: ["-"] },
      { name: "about", items: ["-"] },
    ],
  });
}

// ####################################### End FCK ################################################# //

function changeStatusSlae(cID, valueID, filestatus) {
  jQuery.blockUI({
    message: jQuery("#tallContent"),
    css: {
      border: "none",
      padding: "35px",
      backgroundColor: "#000",
      "-webkit-border-radius": "10px",
      "-moz-border-radius": "10px",
      opacity: 0.9,
      color: "#fff",
    },
  });

  var TYPE = "POST";
  var URL = "../" + filestatus + "";

  var dataSet = {
    cID: cID,
    valueID: valueID,
  };
  jQuery.ajax({
    type: TYPE,
    url: URL,
    data: dataSet,
    success: function (html) {
      jQuery("#loadCheckComplete").show();
      jQuery("#loadCheckComplete").html(html);
      setTimeout(jQuery.unblockUI, 200);
    },
  });
}

function loadShowPhotoUpdate(fileAc, boxLoad) {
  jQuery.blockUI({
    message: jQuery("#tallContent"),
    css: {
      border: "none",
      padding: "35px",
      backgroundColor: "#000",
      "-webkit-border-radius": "10px",
      "-moz-border-radius": "10px",
      opacity: 0.9,
      color: "#fff",
    },
  });

  var TYPE = "POST";
  var URL = fileAc;

  var dataSet = jQuery("#myForm").serialize();
  // alert(dataSet);
  // alert(URL);
  jQuery.ajax({
    type: TYPE,
    url: URL,
    data: dataSet,
    success: function (html) {
      // alert(html);
      jQuery("#" + boxLoad).show();
      jQuery("#" + boxLoad).html(html);

      setTimeout(jQuery.unblockUI, 200);
    },
  });
}

function delFileImportUpload(fileAc) {
  jQuery.blockUI({
    message: jQuery("#tallContent"),
    css: {
      border: "none",
      padding: "35px",
      backgroundColor: "#000",
      "-webkit-border-radius": "10px",
      "-moz-border-radius": "10px",
      opacity: 0.9,
      color: "#fff",
    },
  });

  var TYPE = "POST";
  var URL = fileAc;

  var dataSet = jQuery("#myForm").serialize();

  jQuery.ajax({
    type: TYPE,
    url: URL,
    data: dataSet,
    success: function (html) {
      jQuery("#boxAlbumNew").show();
      jQuery("#boxAlbumNew").html(html);
      setTimeout(jQuery.unblockUI, 200);
    },
  });
}

function getValueFileShow(valFileInPic, boxInputPics) {
  jQuery("#" + boxInputPics).html(valFileInPic);
}

function cancelWebservicesBooking(fileAc) {
  jQuery.blockUI({
    message: jQuery("#tallContent"),
    css: {
      border: "none",
      padding: "35px",
      backgroundColor: "#000",
      "-webkit-border-radius": "10px",
      "-moz-border-radius": "10px",
      opacity: 0.9,
      color: "#fff",
    },
  });

  var TYPE = "POST";
  var URL = "../" + fileAc + "";

  var dataSet = jQuery("#myForm").serialize();
  jQuery.ajax({
    type: TYPE,
    url: URL,
    data: dataSet,
    success: function (html) {
      jQuery("#loadCheckComplete").show();
      jQuery("#loadCheckComplete").html(html);
      setTimeout(jQuery.unblockUI, 200);
    },
  });
}

function changeStatusApprove(fileAc, loadderstatus) {
  jQuery.blockUI({
    message: jQuery("#tallContent"),
    css: {
      border: "none",
      padding: "35px",
      backgroundColor: "#000",
      "-webkit-border-radius": "10px",
      "-moz-border-radius": "10px",
      opacity: 0.9,
      color: "#fff",
    },
  });

  var TYPE = "POST";
  var URL = "../" + fileAc + "";
  //alert(URL);
  var dataSet = jQuery("#myFormHome").serialize();

  jQuery.ajax({
    type: TYPE,
    url: URL,
    data: dataSet,
    success: function (html) {
      jQuery("#" + loadderstatus + "").show();
      jQuery("#" + loadderstatus + "").html(html);
      setTimeout(jQuery.unblockUI, 200);
    },
  });
}

function showPartManre() {
  jQuery.blockUI({
    message: jQuery("#tallContent"),
    css: {
      border: "none",
      padding: "35px",
      backgroundColor: "#000",
      "-webkit-border-radius": "10px",
      "-moz-border-radius": "10px",
      opacity: 0.9,
      color: "#fff",
    },
  });

  var TYPE = "POST";
  var URL = "loadSelectPart.php";

  var dataSet = jQuery("#myForm").serialize();
  jQuery.ajax({
    type: TYPE,
    url: URL,
    data: dataSet,
    success: function (html) {
      jQuery("#boxPart").show();
      jQuery("#boxPart").html(html);
      setTimeout(jQuery.unblockUI, 200);
    },
  });
}

// ####################################### Start Price ################################################# //
function getPriceCountry(id, fileAc) {
  jQuery.blockUI({
    message: jQuery("#tallContent"),
    css: {
      border: "none",
      padding: "35px",
      backgroundColor: "#000",
      "-webkit-border-radius": "10px",
      "-moz-border-radius": "10px",
      opacity: 0.9,
      color: "#fff",
    },
  });
  var TYPE = "POST";
  var URL = "../" + fileAc + "";

  var dataSet = { id: id };
  jQuery.ajax({
    type: TYPE,
    url: URL,
    data: dataSet,
    success: function (html) {
      if (html) {
        jQuery("#loadPriceNew").html(html);
      } else {
        jQuery("#loadPriceNew").html(" - ");
      }
      setTimeout(jQuery.unblockUI, 200);
    },
  });
}

// ####################################### End Price ################################################# //

function number_format(number, decimals, dec_point, thousands_sep) {
  var exponent = "";
  var numberstr = number.toString();
  var eindex = numberstr.indexOf("e");
  if (eindex > -1) {
    exponent = numberstr.substring(eindex);
    number = parseFloat(numberstr.substring(0, eindex));
  }
  if (decimals != null) {
    var temp = Math.pow(10, decimals);
    number = Math.round(number * temp) / temp;
  }
  var sign = number < 0 ? "-" : "";
  var integer = (
    number > 0 ? Math.floor(number) : Math.abs(Math.ceil(number))
  ).toString();
  var fractional = number.toString().substring(integer.length + sign.length);
  dec_point = dec_point != null ? dec_point : ".";
  fractional =
    (decimals != null && decimals > 0) || fractional.length > 1
      ? dec_point + fractional.substring(1)
      : "";
  if (decimals != null && decimals > 0) {
    for (i = fractional.length - 1, z = decimals; i < z; ++i) {
      fractional += "0";
    }
  }
  thousands_sep =
    thousands_sep != dec_point || fractional.length == 0 ? thousands_sep : null;
  if (thousands_sep != null && thousands_sep != "") {
    for (i = integer.length - 3; i > 0; i -= 3) {
      integer = integer.substring(0, i) + thousands_sep + integer.substring(i);
    }
  }
  return sign + integer + fractional + exponent;
}

function addonname(typeticket, idticket, type, num = 1) {
  if (type == "new") {
    var html = '<div class="tickets-list ticketId-' + idticket + '">';
    html += '<div class="tickets-list-title">';
    html += "Name in Ticket - " + typeticket;
    html += "</div>";
    html += "<hr>";

    html += '<div class="row listPeople-' + idticket + '">';

    html += '<div class="col-md-12 listpeopleadd">';
    html += '<div class="input-group">';
    html +=
      '<input value="" class="form-control" name="ticket[' +
      idticket +
      '][nameaddon][]" id="" placeholder="Name" type="text">';
    html += '<div class="input-group-addon">';
    html += '    <i class="fa fa-user faaddon" aria-hidden="true"></i>';
    html += "</div>";
    html += "</div>";
    html += "</div>";

    if (num > 1) {
      html += addonname(typeticket, idticket, "add", num - 1);
    }

    html += " </div>";
    html += " </div>";
    html += " </div>";
  } else {
    var html = "";

    for (var i = 0; i < num; i++) {
      html += '<div class="col-md-12 listpeopleadd">';
      html += '<div class="input-group">';
      html +=
        '<input value="" class="form-control" name="ticket[' +
        idticket +
        '][nameaddon][]" id="" placeholder="Name" type="text">';
      html += '<div class="input-group-addon">';
      html += '    <i class="fa fa-user faaddon" aria-hidden="true"></i>';
      html += "</div>";
      html += "</div>";
      html += "</div>";
    }
  }
  return html;
}

function boxContantLoadPlan(fileAc) {
  jQuery("#boxWaittingContant").show();

  var TYPE = "POST";
  var URL = fileAc;

  var dataSet = jQuery("#myForm").serialize();
  jQuery.ajax({
    type: TYPE,
    url: URL,
    data: dataSet,
    success: function (html) {
      jQuery("#boxContantLoadPlan").show();
      jQuery("#boxContantLoadPlan").html(html);
      jQuery("#boxWaittingContant").hide();
    },
  });
}

function boxContantLoadBanner(fileAc) {
  jQuery("#boxWaittingContant").show();

  var TYPE = "POST";
  var URL = fileAc;

  var dataSet = jQuery("#myForm").serialize();
  jQuery.ajax({
    type: TYPE,
    url: URL,
    data: dataSet,
    success: function (html) {
      jQuery("#boxContantLoadBanner").show();
      jQuery("#boxContantLoadBanner").html(html);
      jQuery("#boxWaittingContant").hide();
    },
  });
}

function boxContantLoadContact(fileAc) {
  jQuery("#boxWaittingContant").show();

  var TYPE = "POST";
  var URL = fileAc;

  var dataSet = jQuery("#myForm").serialize();
  jQuery.ajax({
    type: TYPE,
    url: URL,
    data: dataSet,
    success: function (html) {
      jQuery("#boxContantLoadContact").show();
      jQuery("#boxContantLoadContact").html(html);
      jQuery("#boxWaittingContant").hide();
    },
  });
}

//boxContantLoadinfo

function boxContantLoadInfo(fileAc) {
  jQuery("#boxWaittingContant").show();

  var TYPE = "POST";
  var URL = fileAc;

  var dataSet = jQuery("#myForm").serialize();
  jQuery.ajax({
    type: TYPE,
    url: URL,
    data: dataSet,
    success: function (html) {
      jQuery("#boxContantLoadinfo").show();
      jQuery("#boxContantLoadinfo").html(html);
      jQuery("#boxWaittingContant").hide();
    },
  });
}

function changeStatusShow(
  loaddder,
  tablename,
  statusname,
  statusid,
  loadderstatus,
  fileAc
) {
  jQuery("#" + loaddder + "").show();

  var TYPE = "POST";
  var URL = fileAc;
  var dataSet = {
    Valueloaddder: loaddder,
    Valuetablename: tablename,
    Valuestatusname: statusname,
    Valuestatusid: statusid,
    Valueloadderstatus: loadderstatus,
    Valuefilestatus: fileAc,
  };

  jQuery.ajax({
    type: TYPE,
    url: URL,
    data: dataSet,
    success: function (html) {
      jQuery("#" + loadderstatus + "").show();
      jQuery("#" + loadderstatus + "").html(html);
      jQuery("#" + loaddder + "").hide();
    },
  });
}

function changeStatusBooking(contactid, waitid, groupid) {
  jQuery("#" + waitid + "").show();

  var TYPE = "POST";

  var URL = "../mod_calendar/load_changeGroup.php";
  var dataSet = {
    contactid: contactid,
    groupid: groupid,
  };

  jQuery.ajax({
    type: TYPE,
    url: URL,
    data: dataSet,
    success: function (html) {
      jQuery("#errorID").show();
      jQuery("#errorID").html(html);
      jQuery("#" + waitid + "").hide();
    },
  });
}

function loadGroupSelect(gID, masterkey, tID) {
  // alert("cccc");

  jQuery("#loadWaitingCategory").show();

  var TYPE = "POST";
  var URL = "../mod_name/openSelectSub.php";
  var dataSet = {
    gID: gID,
    masterkey: masterkey,
    tID: tID,
  };

  jQuery.ajax({
    type: TYPE,
    url: URL,
    data: dataSet,
    success: function (html) {
      jQuery("#loadLevelTypeID").show();
      jQuery("#loadLevelTypeID").html(html);
      jQuery("#loadWaitingCategory").hide();
    },
  });
}

function randomString() {
  var chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz";
  var string_length = 8;
  var randomstring = "";
  for (var i = 0; i < string_length; i++) {
    var rnum = Math.floor(Math.random() * chars.length);
    randomstring += chars.substring(rnum, rnum + 1);
  }
  return randomstring;
}

function insertCommentBlog() {
  jQuery("#loadWaitComment").show();

  var TYPE = "POST";
  var URL = "../mod_blog/blogComment.php";

  var dataSet = jQuery("#myForm").serialize();

  jQuery.ajax({
    type: TYPE,
    url: URL,
    data: dataSet,
    success: function (html) {
      jQuery("#boxMailContact").show();
      jQuery("#boxMailContact").html(html);
      jQuery("#loadWaitComment").hide();
    },
  });
}

//boxMailContact

function loadBoxCommentAll(cID, masterkey) {
  jQuery("#loadWaitComment").show();

  var TYPE = "POST";
  var URL = "../mod_blog/loadComment.php";

  var dataSet = {
    cID: cID,
    masterkey: masterkey,
  };

  jQuery.ajax({
    type: TYPE,
    url: URL,
    data: dataSet,
    success: function (html) {
      jQuery("#boxMailContact").show();
      jQuery("#boxMailContact").html(html);
      jQuery("#loadWaitComment").hide();
    },
  });
}

function modDeleteComment(commentid, filehide, qid) {
  jQuery("#loadWaitComment").show();

  var TYPE = "POST";
  var URL = "../mod_blog/deleteComment.php";
  var dataSet = {
    commentid: commentid,
    qid: qid,
  };

  jQuery.ajax({
    type: TYPE,
    url: URL,
    data: dataSet,
    success: function (html) {
      jQuery("#" + filehide).hide();
      jQuery("#boxMailContact").show();
      jQuery("#boxMailContact").html(html);
      jQuery("#loadWaitComment").hide();
    },
  });
}

function modDeleteComment1(commentid, filehide, qid) {
  jQuery("#loadWaitComment").show();

  var TYPE = "POST";
  var URL = "../mod_vdoGroup/deleteComment.php";
  var dataSet = {
    commentid: commentid,
    qid: qid,
  };

  jQuery.ajax({
    type: TYPE,
    url: URL,
    data: dataSet,
    success: function (html) {
      jQuery("#" + filehide).hide();
      jQuery("#boxMailContact").show();
      jQuery("#boxMailContact").html(html);
      jQuery("#loadWaitComment").hide();
    },
  });
}

function loadBoxCommentAll1(cID, masterkey) {
  jQuery("#loadWaitComment").show();

  var TYPE = "POST";
  var URL = "../mod_vdoGroup/loadComment.php";

  var dataSet = {
    cID: cID,
    masterkey: masterkey,
  };

  jQuery.ajax({
    type: TYPE,
    url: URL,
    data: dataSet,
    success: function (html) {
      jQuery("#boxMailContact").show();
      jQuery("#boxMailContact").html(html);
      jQuery("#loadWaitComment").hide();
    },
  });
}

function insertCommentBlog1() {
  jQuery("#loadWaitComment").show();

  var TYPE = "POST";
  var URL = "../mod_vdoGroup/blogComment.php";

  var dataSet = jQuery("#myForm").serialize();

  jQuery.ajax({
    type: TYPE,
    url: URL,
    data: dataSet,
    success: function (html) {
      jQuery("#boxMailContact").show();
      jQuery("#boxMailContact").html(html);
      jQuery("#loadWaitComment").hide();
    },
  });
}

//######################## JUMPPAGE
$(".divRightMain.showJumpPage table tbody tr:last").append(
  '<td width="10" align="center" style="padding-right:5px;padding-left:5px;"><input class="formInputContantTbShotJumppage" type="number" min="0" step="1" id="pagination_jumppage" name="pagination_jumppage" value="" placeholder="ไปหน้า"></td>'
);
$('input[name="pagination_jumppage"]').keyup(function (e) {
  if (e.keyCode == 13) {
    var pagination_jumppage = $(this).val();
    if ($.isNumeric(pagination_jumppage) && pagination_jumppage > 0) {
      $('#myForm input[name="module_pageshow"]').val(pagination_jumppage);
      $("#myForm").submit();
    }
  }
});

$(function () {
  var var_conf_select2 = $("#input_conf_select2").val();
  if (var_conf_select2 == 1) {
  } else {
    if ($("select").length > 0) {
      $("select").select2();
      //alert('select');
    }
  }
});

// tooltip header
$(".divLogin > a").each(function () {
  strHTML = `
    <span class="fontContantTbManage" style="display:none;">${$(this).attr(
      "title"
    )}</span>
  `;
  $(this).append(strHTML);
});

$(".divBtn-menu > a").each(function () {
  strHTML = `
    <span class="fontContantTbManage" style="display:none;">${$(this).attr(
      "title"
    )}</span>
  `;
  $(this).append(strHTML);
});

// script addon

// tooltip all
$(".divRightHead .borderBottom tr")
.children()
.eq(1)
.find("table tr td div")
.each(function () {
  strHTML = `
  <span class="fontContantTbManage" style="display:none;">${$(this).attr(
    "title"
  )}</span>
`;
  $(this).append(strHTML);
});

////////////

  // $('.divRightHeadSearch .bottonSearch').addClass('buttonSearchStyle');
$('.divRightHeadSearch td .formSelectSearchStyle').closest('td').addClass('td-select2');
$('.divRightHeadSearch td .btnSearch').closest('td').addClass('buttonSearchStyle');
$('.tabchart').closest('.tbBoxViewBorder ').addClass('row-position');
$('.tbBoxViewBorder tr:nth-child(2) .formTileTxt').removeClass('formTileTxt');
$('.tbBoxViewBorder tr:nth-child(2) td .viewEditorTileTxt').addClass('m-0');
// $('.tbBoxViewBorder tr:nth-child(2) .formTileTxt').addClass('formRightContantTb');
// $('.tbBoxViewBorder tr:nth-child(2) .formRightContantTb').addClass('pb-0');
// $('.tbBoxViewBorder tr:nth-child(2) .formRightContantTb .viewEditorTileTxt').addClass('mb-0');
$('#inputaccess').closest('.formRightContantTb').addClass('formRightContantTbAddon');

$('.formInputContantTbShot.izzyColor').addClass('input-short');
$('#sdateInput.formInputContantTbShot').addClass('input-short');
$('#edateInput.formInputContantTbShot').addClass('input-short');


// select2 append

var jsSelect2 = document.createElement("script");
jsSelect2.type = "text/javascript";
jsSelect2.src = "../js/select2/js/select2.js";
$(".divRightHeadSearch").append(jsSelect2); 
$(".divRightHeadSearch").append("<script> jQuery(document).ready(function() { $('.formSelectSearchStyle').select2(); }); </script>")
$(".divRightNav").append(jsSelect2); 
$(".divRightNav").append("<script> jQuery(document).ready(function() { $('.formSelectSearch').select2(); }); </script>")
$(".formRightContantTb > .tabchart").append(jsSelect2); 
$(".formRightContantTb > .tabchart").append("<script> jQuery(document).ready(function() { $('.formSelectSearchStyle').select2(); }); </script>")

$(".formRightContantTbAddon").append(jsSelect2); 
$(".formRightContantTbAddon").append("<script> jQuery(document).ready(function() { $('.formSelectContantTb').select2(); }); </script>")

$(".divRightMain .formRightContantTb").append(jsSelect2); 
$(".divRightMain .formRightContantTb").append("<script> jQuery(document).ready(function() { $('.formSelectContantTb').select2(); }); </script>")

var cssSelect2 = document.createElement("link");
cssSelect2.href = "../js/select2/css/select2.css";
$(".divRightHeadSearch").append(cssSelect2); 
$(".formRightContantTb > .tabchart").append(cssSelect2); 
$(".formRightContantTbAddon").append(cssSelect2); 
$(".divRightMain .formRightContantTb").append(cssSelect2); 


// $(".divRightHeadSearch td").removeAttr("style");

$("#myForm .divRightMain").addClass("table-responsive");

$('.formEndContantTb a[href="#defTop"]').closest("table").addClass("d-none");

// check if an HTML element is empty using jQuery
function isEmpty(el) {
return !$.trim(el.html());
}
$(document).ready(function () {
var tdsortEmpty = $(
  ".divRightMain.table-responsive > table > tbody > tr > td > ul.ui-sortable"
);
tdsortEmpty.closest("table").removeClass("d-none");
});
var windowSize = $(window).width();
if (windowSize <= 767) {
// console.log("screen width is less than 768");
// $(".list-responsive").removeClass("divRightMain");

$(".divRightNav ~ .divRightHeadSearch ~ .divRightHead ~ .divRightMain").each(function() {
  $(this).addClass("list-responsive").removeClass("divRightMain");
});

// $("form[method='post'] .divRightNav ~ .divRightHead ~ .divRightMain, input[value='sy_stf_order'] ~ .divRightNav ~ .divRightHead ~ .divRightMain, input[value='sy_grp_order'] ~ .divRightNav ~ .divRightHead ~ .divRightMain").each(function() {
//   $(this).addClass("list-responsive").removeClass("divRightMain");
// });  
$("form[method='post'] .divRightNav ~ .divRightHead ~ .divRightMain").each(function() {
  $(this).addClass("list-responsive").removeClass("divRightMain");
});                    


var currentUrl = window.location.href;
if (currentUrl.includes('setting.php')) {
    $(".list-responsive").each(function() {
        $(this).addClass("list-setting");
    });
}


var tdEmpty = $(
  '.divRightMain.table-responsive > table > tbody > tr > td[height="15"]'
);
if (isEmpty(tdEmpty)) {
  tdEmpty.closest("tr").addClass("d-none");
}
var tdsortEmpty = $(
  ".divRightMain.table-responsive > table > tbody > tr > td > ul.ui-sortable"
);
tdsortEmpty.closest("table").removeClass("d-none");
}

// Topic Responsive
var hasCheckbox = $(
".list-responsive .divRightContantOverTbL .formCheckboxList"
);

var topicArray = $(".list-responsive .fontTitlTbRight")
.map(function () {
  return $.trim($(this).text());
})
.get();

if (hasCheckbox.length > 0) {
// If the List has the formCheckboxList class, add an empty value at the beginning of the array to topicArray.
topicArray.unshift("");
}

$(".tbBoxListwBorder > tbody > tr[class]").each(function () {
$(this)
  .children("td")
  .each(function (index) {
    $(this).attr("data-label", topicArray[index]);
  });
});

setTimeout(EnableSorting, 300);

function EnableSorting() {
var sorting = $("#boxPermissionSort").length;
if (sorting > 0) {
  $(".divRightMain  > table").removeClass("d-none");
}
}


$(window).on( "load", function() {
$('.divRightInnerHome .ui-sortable').addClass('sortablePosition');
} );

$('.list-responsive > table > tbody > tr .divRightContantOverTb td:nth-child(1)').addClass('displayTdImg');
$('.list-responsive > table > tbody > tr .divRightContantOverTb td:nth-child(1) > div').addClass('displayClickImg');
$('.displayTdImg > a').closest('.displayTdImg').addClass('displayTdText');
$('.izzyColor').closest('.formRightContantTb').addClass('select-color');
$('.fontContantTbNavPage').closest('.divRightContantTbRL').addClass('bg-nav');
$('#boxPermissionSort').closest('.formTileTxt').addClass('ui-sortableControl');

$('.divLeftMenuTb a .material-symbols-outlined').closest('.divLeftMenu').addClass('newMenu');

$(".tableEditPermis > tbody > tr[class]").each(function () {
$(this)
  .children("td")
  .each(function (index) {
    $(this).attr("data-label", topicArray[index]);
  });
});

// $('td[colspan="7" align="right" valign="top" height="15"]').addClass('d-none')

if (windowSize <= 767) {
  $('td[colspan="7" align="right" valign="top" height="15"]').addClass('d-none')
}

// $('html').addClass('bo-layout-2'); 