$(window).on("load", function() {
    $('[data-toggle="password"]').click(function() {
        let passwordInput = $(`#${$(this).data('target')}`);
        let passStatus = document.getElementById(this.id);
        if ($(passwordInput).attr('type') == 'password') {
            $(passwordInput).attr('type', 'text');
            passStatus.className = 'feather icon-eye';
        } else {
            $(passwordInput).attr('type', 'password');
            passStatus.className = 'feather icon-eye-off';
        }
    });
});