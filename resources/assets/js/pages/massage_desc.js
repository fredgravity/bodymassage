$(document).ready(function () {
    $('#book-now').hide();
    $('.slides').click(function (e) {
        let id = e.target.getAttribute('data-slider-id');
        axios.get('/massages/'+id+'/description').then(function (res) {
            console.log(res.data);
            let desc = res.data.desc;
            let prod_name = res.data.prod_name;
            let prod_price = res.data.prod_price;
            let id = res.data.prod_id;

            $('#massage-description').text(desc);
            if(id === 12){
                $('#desc_name').text(prod_name);

            }else{
                $('#desc_name').text(prod_name+' - GHS '+prod_price);

            }

            if (res.data.prod_id === 12){
                $('#book-now').attr('href','/corporate').text('Request a Quote!');
            }else{
                $('#book-now').attr('href','/bookings').text('Book Now!');
            }

            booknow(2000);
        }).catch(function(err){
            console.log(err);
        });

        // alert(id);
        // console.log(e.target.getAttribute('data-slider-id'))
    });


    function booknow(secs) {
        setInterval(function () {
            $('#book-now').show();
        }, secs);
    }
});
