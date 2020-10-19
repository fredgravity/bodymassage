
ARTISAO.home.animate = function () {
'use strict';

$(document).ready(function () {
    // let latitude ='';
    // let longitude = '';
    //
    //
    // function showLocation(position) {
    //      latitude = position.coords.latitude;
    //      longitude = position.coords.longitude;
    //     alert("Latitude : " + latitude + " Longitude: " + longitude);
    // }
    //
    //
    //
    // function getLocation() {
    //
    //     if(navigator.geolocation) {
    //
    //         // timeout at 60000 milliseconds (60 seconds)
    //         let options = {timeout:300};
    //         navigator.geolocation.getCurrentPosition(showLocation, errorHandler, options);
    //     } else {
    //         alert("Sorry, browser does not support geolocation!");
    //     }
    // }
    //
    // function errorHandler(error) {
    //     console.log(error);
    //     switch(error.code) {
    //         case error.PERMISSION_DENIED:
    //             alert( "User denied the request for Geolocation.");
    //             break;
    //         case error.POSITION_UNAVAILABLE:
    //             alert("Location information is unavailable.");
    //             break;
    //         case error.TIMEOUT:
    //             alert("The request to get user location timed out.");
    //             break;
    //         case error.UNKNOWN_ERROR:
    //             alert("An unknown error occurred.");
    //             break;
    //     }
    // }
    //
    // getLocation();
//     $('#anim').click(function () {
//         $.dialog({
//             title: 'Text content!',
//             content: 'Simple modal!',
//             useBootstrap:false,
//             containerFluid:false,
//             boxWidth:'50%'
//         });
//     });
//

    // $('#anim3').click(function () {
    //     $.confirm({
    //         useBootstrap:false,
    //         containerFluid:false,
    //         boxWidth:'50%',
    //         content: function(){
    //             var self = this;
    //             self.setContent('Checking callback flow');
    //             return $.ajax({
    //                 url: 'bower.json',
    //                 dataType: 'json',
    //                 method: 'get'
    //             }).done(function (response) {
    //                 self.setContentAppend('<div>Done!</div>');
    //             }).fail(function(){
    //                 self.setContentAppend('<div>Fail!</div>');
    //             }).always(function(){
    //                 self.setContentAppend('<div>Always!</div>');
    //             });
    //         },
    //         contentLoaded: function(data, status, xhr){
    //             self.setContentAppend('<div>Content loaded!</div>');
    //         },
    //         onContentReady: function(){
    //             this.setContentAppend('<div>Content ready!</div>');
    //         }
    //     });
    // });





});


};