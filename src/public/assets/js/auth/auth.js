function Auth() {

};

Auth.prototype.init = function(){
    const _this = this;
    $("#btn").on('click', function(e){
        e.preventDefault();
        _this.login();
    });
};

Auth.prototype.login = function(){
    let data = $('#loginForm').serialize();
    $.post({
        url: '/auth/login',
        data: data,
        success: function(data){
            var data = JSON.parse(data);
            if(typeof data['err'] !== "undefined") {
                var toastHTML = '<span>' + data.err + '</span>';
                M.toast({html: toastHTML});
            } else {
                location.replace("/ ");
            }
        }
    })
};

const auth = new Auth();
auth.init();