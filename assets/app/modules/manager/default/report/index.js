var backgroundColors = [
    'rgba(255, 99, 132, 0.2)',
    'rgba(54, 162, 235, 0.2)',
    'rgba(255, 206, 86, 0.2)',
    'rgba(75, 192, 192, 0.2)',
    'rgba(153, 102, 255, 0.2)',
    'rgba(255, 159, 64, 0.2)',
    'rgba(255, 159, 64, 0.2)',
    'rgba(255, 159, 64, 0.2)'
];

var borderColors = [
    'rgba(255,99,132,1)',
    'rgba(54, 162, 235, 1)',
    'rgba(255, 206, 86, 1)',
    'rgba(75, 192, 192, 1)',
    'rgba(153, 102, 255, 1)',
    'rgba(255, 159, 64, 1)',
    'rgba(255, 159, 64, 1)',
    'rgba(255, 159, 64, 1)'
];

$(function () {

    loadOrder();

    loadReserve();
});

function loadOrder() {
    $.get('/api/order/statistics_group_date.json?seller_id=' + _seller_id,
        function (data) {
            if(data.status == 'err'){
                alert(data.msg);
                return;
            }

            var items = data.data;

            var datasets = [{
                label: '过去7日实收金额统计',
                data: [],
                backgroundColor: [],
                borderColor: [],
                borderWidth: 1
            }];


            var labels = [];
            for (var i = 0; i < items.length; i ++){
                labels[labels.length] = items[i].date;
                datasets[datasets.length].data[datasets[datasets.length].data.length] = items[i].total_fee;
                datasets[datasets.length].backgroundColor[datasets[datasets.length].backgroundColor.length] = backgroundColors[datasets[datasets.length].backgroundColor.length];
                datasets[datasets.length].borderColor[datasets[datasets.length].borderColor.length] = borderColors[datasets[datasets.length].backgroundColor.length];
            }

            var ctx = new Chart($('#chartOrder'), {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: datasets
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });

        }, 'json');
}

function loadReserve() {
    $.get('/api/room/reserve/statistics_count_date.json?seller_id=' + _seller_id,
        function (data) {
            if(data.status == 'err'){
                alert(data.msg);
                return;
            }

            var items = data.data;

            var datasets = [{
                label: '过去7日包间预订数量统计',
                data: [],
                backgroundColor: [],
                borderColor: [],
                borderWidth: 1
            }];


            var labels = [];
            for (var i = 0; i < items.length; i ++){
                labels[labels.length] = items[i].date;
                datasets[datasets.length].data[datasets[datasets.length].data.length] = items[i].count;
                datasets[datasets.length].backgroundColor[datasets[datasets.length].backgroundColor.length] = backgroundColors[datasets[datasets.length].backgroundColor.length];
                datasets[datasets.length].borderColor[datasets[datasets.length].borderColor.length] = borderColors[datasets[datasets.length].backgroundColor.length];
            }

            var ctx = new Chart($('#chartReserve'), {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: datasets
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });
        }, 'json');
}