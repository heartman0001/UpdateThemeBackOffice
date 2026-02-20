$(document).ready(function(){
    // ######################################################################################### Start  ##################################################################################################

    var PATH_CALL_NAME_VIEW = '/api/v1/viewName';
    var URL_GET_ONE_ACCOUNT = "https://www.dmcr.go.th/api/putApiOneAccount.php";
    var URL_ONE_ACCOUNT = '';
    (async () => {
        const data_get_url_oneaccount = await get_url_oneaccount();
        if (data_get_url_oneaccount.Result == true) {
            URL_ONE_ACCOUNT = data_get_url_oneaccount.data[0].url;
            var edit_id = await $('#showFixID').data('id');
            var edit_id_sub = await $('#showFixIDSub').data('id');
            const data_get_call_name_view = await getCallNameView(edit_id, edit_id_sub);
            if (data_get_call_name_view.statuscode == 200 || data_get_call_name_view.statuscode == 201) {
                $('#showFixID .formDivView').html(data_get_call_name_view.data.name);
                $('#showFixIDSub .formDivView').html(data_get_call_name_view.data.name_sub);
            }
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

    async function getCallNameView(gid, id) {  
        if (typeof id === "undefined") {
            id = null;
        }
        const settings = {
            "url": URL_ONE_ACCOUNT + PATH_CALL_NAME_VIEW,
            "method": "POST",
            "data": {
                "gid": gid,
                "id": id
            },
        };
        const result = await $.ajax(settings);
        return JSON.parse(result);
    }


    // ######################################################################################### End ##################################################################################################



});