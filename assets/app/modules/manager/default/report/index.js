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

            var chartData = {
                labels: ["10日", "11日", "12日", "13日", "14日", "15日", "16日", "17日"],
                datasets: [{
                    label: '过去7日实收金额统计',
                    data: [12, 19, 3, 5, 2, 3, 33, 88],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            };

            var options = {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            };

            var ctx = new Chart($('#chartOrder'), {
                type: 'bar',
                data: chartData,
                options: options
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

            var chartData = {
                labels: ["10日", "11日", "12日", "13日", "14日", "15日", "16日", "17日"],
                datasets: [
                    {
                        label: '过去7日应消费数量',
                        data: [50, 80, 60, 58, 25, 53, 53, 68],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    },
                    {
                        label: '过去7日已消费数量',
                        data: [40, 100, 30, 38, 46, 73, 33, 88],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }
                ]
            };

            var options = {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            };

            var ctx = new Chart($('#chartReserve'), {
                type: 'bar',
                data: chartData,
                options: options
            });
        }, 'json');
}