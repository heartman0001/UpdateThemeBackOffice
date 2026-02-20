// $(document).ready(function(){
// (async () => {
//         const data_get_url_oneaccount = await get_url_oneaccount();
//         if (data_get_url_oneaccount.Result == true) {
//             URL_ONE_ACCOUNT = data_get_url_oneaccount.data[0].url;

//             var edit_id = await $('#showFixID').data('id');
//             const data_get_call_name = await getCallName(edit_id);
//             $('#showFixID').html(data_get_call_name);
//             if (typeof edit_id !== "undefined") {
//                 const data_get_call_name_sub = await getCallNameSub(edit_id);
//                 $('#showFixIDSub').html(data_get_call_name_sub);
//                 if (edit_id > 0) {
//                     var edit_id_sub = await $('#showFixIDSub').data('id');
//                     const data_get_call_name_sub = await getCallNameSub(edit_id, edit_id_sub);
//                     $('#showFixIDSub').html(data_get_call_name_sub);
//                 }else{
//                     const data_get_call_name_sub = await getCallNameSub(edit_id);
//                     $('#showFixIDSub').html(data_get_call_name_sub);
//                 }
//             }
//         }
//     })().catch(() => {});

// });
// $(window).load(function(){
//     // ######################################################################################### Start  ##################################################################################################

//     var PATH_CALL_NAME = '/api/v1/callNamePage';
//     var URL_GET_ONE_ACCOUNT = "https://www.dmcr.go.th/api/putApiOneAccount.php";
//     var URL_ONE_ACCOUNT = '';
//     (async () => {
//         const data_get_url_oneaccount = await get_url_oneaccount();
//         if (data_get_url_oneaccount.Result == true) {
//             URL_ONE_ACCOUNT = await data_get_url_oneaccount.data[0].url;
//             var id = await $('#showFixID').data('id');
//              const data_get_call_name = await getCallName();
//             $('#showFixID').html(data_get_call_name);
//             $('#showFixID select').val(id);

//         }
//     })().catch(() => {});

//     async function get_url_oneaccount() {
//         const settings = {
//             "url": URL_GET_ONE_ACCOUNT,
//             "async": "false",
//         };
//         const result = await $.ajax(settings);
//         return result;
//     }

//     async function getCallName(id) {
//         if (typeof id === "undefined") {
//             id = null;
//         }
//         const settings = {
//             "url": URL_ONE_ACCOUNT + PATH_CALL_NAME,
//             "method": "POST",
//             "data": {
//                 "id": id
//             },
//         };
//         const result = await $.ajax(settings);
//         return result;
//     }

// ######################################################################################### End ##################################################################################################

//});
