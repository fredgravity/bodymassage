ARTISAO.home.register = function () {

$(document).ready(function () {
    captcha();

});


function captcha() {
    $('#register-btn').click(function (e) {
        e.preventDefault();
        $('.load-spinner').show();
        grecaptcha.ready(function() {
            grecaptcha.execute('6LfVQgEVAAAAAJAa6hy8bWyfU0cTl2kikz_vQMhA', {action: 'register'}).then(function(token) {
                // $('#login-form').prepend('<input type="hidden" name="recaptcha" value="' + token + '">');
                // let action = $('#login-form').attr('action');
                // console.log(postDate);
                let postData = $.param({token:token});
                axios.post('/recaptcha', postData).then(function (res) {
                    // console.log(res.data);
                    if (res.data.success){
                        $('#register-form').submit();
                    }else{
                        $.dialog({
                            title: 'Failed to Register!',
                            content: 'Invalid form Recaptcha token. Please try again',
                            useBootstrap:false,
                            containerFluid:false,
                            boxWidth:'50%',
                            type: 'red'
                        });
                    }
                }).catch(function (err) {
                    console.log(err);
                })

                // Add your logic to submit to your backend server here.
            });
        });
    });
}

};