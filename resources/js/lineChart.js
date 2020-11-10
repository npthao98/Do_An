$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    window.onload = function () {
        $.ajax({
            url: '/admin',
            type: 'GET',

            success: function(data) {
                Chart.defaults.global.defaultFontColor = '#000000';
                Chart.defaults.global.defaultFontFamily = 'Arial';
                var lineChart = document.getElementById('line-chart');
                var myChart = new Chart(lineChart, {
                    type: 'bar',
                    data: {
                        labels: data[1],
                        datasets: [
                            {
                                label: data[0][0],
                                data: data[2],
                                backgroundColor: 'rgba(0, 128, 128, 0.3)',
                                borderColor: 'rgba(0, 128, 128, 0.7)',
                                borderWidth: 1
                            },
                            {
                                label: data[0][1],
                                data: data[3],
                                backgroundColor: 'rgba(0, 128, 128, 0.7)',
                                borderColor: 'rgba(0, 128, 128, 1)',
                                borderWidth: 1
                            }
                        ]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero:true
                                }
                            }]
                        },
                    }
                });
            },
        });
    };
});
