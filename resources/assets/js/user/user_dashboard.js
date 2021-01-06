
'use strict';
ARTISAO.user.dashboard = function () {
    charts();
    setInterval(charts, 7000);
};


function  charts() {
    //GET CANVAS
    let revenueCanvas = $('#monthly-revenue');
    let orderCanvas = $('#monthly-order');
    let yearlyOrderCanvas = $('#yearly-orders');

    //CREATE LABELS FOR THE CHART
    let revenueLabelDate = [];
    let orderLabelDate = [];
    let orderCount = [];
    let revenueSummed = [];

    //YEARLY ORDERS
    let monthOrderObj = [];
    let monthName = [
                    'January',
                    'Febraury',
                    'March',
                    'April',
                    'May',
                    'June',
                    'July',
                    'August',
                    'September',
                    'October',
                    'November',
                    'December',];
    let orderMonthCount = [];

    //YEARLY REVENUE
    let monthRevenueObj = [];
    let revenueMonthName = [
        'January',
        'Febraury',
        'March',
        'April',
        'May',
        'June',
        'July',
        'August',
        'September',
        'October',
        'November',
        'December',];
    let revenueMonthSummed = [];

    axios.get('/user/charts').then(function (response) {

        //GET DATA FROM ORDERS LOOP THROUGH THEM AND ADD TO THE ORDER COUNT ARRAY AND GET THE DATE FOR THE LABEL
        response.data.orders.forEach(function (monthly) {
            orderCount.push(monthly.count); //count id of a user
            orderLabelDate.push(monthly.new_date);// in a particular month
            monthOrderObj[monthly.month_name] = monthly.count; //in a particular month name

        });

        //GET DATA FROM REVENUE, LOOP THROUGH THEM AND ADD TO THE REVENUE SUM ARRAY AND GET THE DATE FOR THE LABEL
        response.data.revenues.forEach(function (monthly) {
            revenueSummed.push(monthly.amount);// add the amount of a user
            revenueLabelDate.push(monthly.new_date); //in a particular month
            monthRevenueObj[monthly.month_name] = monthly.amount; //in a particular month name
            // console.log(revenueSummed);
        });

        //YEARLY ORDERS
        monthName.forEach(function (data) {
            let obj = Object.keys(monthOrderObj);
            // console.log(obj);
            if (obj.includes(data)){
                orderMonthCount.push(monthOrderObj[data]);
            }else{
                orderMonthCount.push(0);
            }
        });

        //YEARLY REVENUE
        revenueMonthName.forEach(function (data) {
            let obj = Object.keys(monthRevenueObj);
            // console.log(obj);
            if (obj.includes(data)){
                revenueMonthSummed.push(monthRevenueObj[data]);
            }else{
                revenueMonthSummed.push(0);
            }
        });


            // console.log(revenueMonthCount);
            // console.log(x);



        //CALL THE CHART JS CLASS
        new Chart(revenueCanvas, {
            type: 'bar',
            data: {
                labels: revenueLabelDate,
                datasets: [
                    {
                        label: '# Revenue',
                        data: revenueSummed,
                        backgroundColor: [
                            '#0578F1',
                            '#FF0000',
                            '#800000',
                            '#FFFF00',
                            '#808000',
                            '#00FF00',
                            '#008000',
                            '#00FFFF',
                            '#008080',
                            '#0000FF',
                            '#000080',
                            '#FF00FF',
                            '#800080'
                        ]
                    }
                ]
            }
        });


        new Chart(orderCanvas, {
            type: 'line',
            data: {
                labels: orderLabelDate,
                datasets: [
                    {
                        label: '# Orders',
                        data: orderCount,
                        backgroundColor: ['#0578F1']
                    }
                ]
            }
        });

        let dataFirst = {
            label: "Orders",
            data: orderMonthCount,
            // lineTension: 0,
            // fill: false,
            borderColor: 'red'
        };

        let dataSecond = {
            label: "Revenue",
            data: revenueMonthSummed,
            // lineTension: 0,
            // fill: false,
            borderColor: 'blue'
        };

        let multiData = {
            labels: monthName,
            datasets: [dataFirst, dataSecond]
        };

        new Chart(yearlyOrderCanvas, {
            type: 'line',
            data: multiData,
        });


    });



}