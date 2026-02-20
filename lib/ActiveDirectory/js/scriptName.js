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

$(function() {
    // ######################################################################################### Start  ##################################################################################################
    //alert('name');
    var PATH_CALL_NAME = '/api/v1/callName';
    var PATH_CALL_NAME_SUB = '/api/v1/callNameSub';
    var URL_GET_ONE_ACCOUNT = "https://www.dmcr.go.th/api/putApiOneAccount.php";
    var URL_ONE_ACCOUNT = '';
    (async () => {
        const data_get_url_oneaccount = await get_url_oneaccount();
        if (data_get_url_oneaccount.Result == true) {
            
            URL_ONE_ACCOUNT = data_get_url_oneaccount.data[0].url;

            if ($('form input[name="execute"]').val() == 'insert') {
              
                const data_get_call_name = await getCallName();
                 
                $('#showFixID').html(data_get_call_name);
               
            }else{
            
                var edit_id = await $('#showFixID').data('id');
                const data_get_call_name = await getCallName(edit_id);
                $('#showFixID').html(data_get_call_name);
                if (typeof edit_id !== "undefined") {
                    // const data_get_call_name_sub = await getCallNameSub(edit_id);
                    // $('#showFixIDSub').html(data_get_call_name_sub);
                    if (edit_id > 0) {
                        var edit_id_sub = await $('#showFixIDSub').data('id');
                        const data_get_call_name_sub = await getCallNameSub(edit_id, edit_id_sub);
                        $('#showFixIDSub').html(data_get_call_name_sub);   
                    }else{
                        // const data_get_call_name_sub = await getCallNameSub(edit_id);
                        // $('#showFixIDSub').html(data_get_call_name_sub);   
                    }
                }
            }

            $("select").select2();


            
        }
    })().catch(() => {});

    async function get_url_oneaccount() {  
        const settings = {
            "url": URL_GET_ONE_ACCOUNT,
            "async": "false",
        };
        const result = await $.ajax(settings);
        return result;
    }

    async function getCallName(id) {  
        if (typeof id === "undefined") {
            id = null;
        }
        const settings = {
            "url": URL_ONE_ACCOUNT + PATH_CALL_NAME,
            "method": "POST",
            "data": {
                "id": id
            },
        };
        const result = await $.ajax(settings);
        return result;
    }

    $(document).on('change', 'select[name="inputFixid"]', function() {
        var id = $(this).val();
        if (id > 0) {
            (async () => {
                const data_get_call_name_sub = await getCallNameSub(id);
                $('#showFixIDSub').html(data_get_call_name_sub);
                $("select").select2();
            })().catch(() => {});
        }
    });

    async function getCallNameSub(gid, id) {  
        if (typeof id === "undefined") {
            id = null;
        }
        const settings = {
            "url": URL_ONE_ACCOUNT + PATH_CALL_NAME_SUB,
            "method": "POST",
            "data": {
                "gid": gid,
                "id": id
            },
        };
        const result = await $.ajax(settings);
        return result;
    }


    // ######################################################################################### End ##################################################################################################



});