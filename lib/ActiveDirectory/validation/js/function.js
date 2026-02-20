const check_user_in_db = async (username, password) => {
    const settings = {
        "url": `./lib/ActiveDirectory/validation/check_user.php`,
        "method": "POST",
        "timeout": 0,
        "data": {
            "inputUser": username,
            "inputPass": password
        },
    };

    const result = await $.ajax(settings);
    return result;
}

const check_user_oneaccount = async (service_api, inputUser) => {
    const settings = {
        "url": `${service_api.config.URL_SITE}/revert_proxy`,
        "method": "POST",
        "timeout": 0,
        "headers": {
            "Content-Type": `application/json`,
            "Authorization": `Bearer ${service_api.getToken()}`
        },
        "data": JSON.stringify({
            "app_url": `${service_api.config.URL_API}/service-api/oneaccount/user`,
            "method": "check_user",
            "username": inputUser
        }),
    };

    const result = await $.ajax(settings);
    if (result?.code === 1001) {
        if (!result?.user_info[0]?.timeout) {
            return true;
        }else{
            return false;
        }
    } else {
        console.log('API check user fail.');
        return false;
    }
}

// return response
var response;
function getResponse(data) {
    response = data;
}