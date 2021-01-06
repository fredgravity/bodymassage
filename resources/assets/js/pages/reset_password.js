ARTISAO.home.reset_password = function () {

$(document).ready(function () {
    captcha();

    // alert('hi');
});


function captcha() {
    $('#reset-password-btn').click(function (e) {
        e.preventDefault();
        $('.load-spinner').show();
        grecaptcha.ready(function() {
            grecaptcha.execute('6LfVQgEVAAAAAJAa6hy8bWyfU0cTl2kikz_vQMhA', {action: 'reset_password'}).then(function(token) {
                // $('#login-form').prepend('<input type="hidden" name="recaptcha" value="' + token + '">');
                // let action = $('#login-form').attr('action');
                // console.log(postDate);
                let postData = $.param({token:token});
                axios.post('/recaptcha', postData).then(function (res) {
                    // console.log(res.data);
                    if (res.data.success){
                        $('#reset_password-form').submit();
                    }else{
                        $.dialog({
                            title: 'Failed to Login!',
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