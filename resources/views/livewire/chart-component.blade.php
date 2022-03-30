<div class="chart">
    <div class="search">
        @livewire('search-component',[
            'total'=>$total,
            'daily'=>$daily,
            'id'=>$category_id,
            'from_date'=> $from_date,
            'to_date'=>$to_date
            ])
    </div>
    @if (isset($nodata))
        <div class="text-center my-3 text-danger alert alert-danger">
            {{$nodata}}
        </div>
    @endif
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <canvas id="myChart"></canvas>
            </div>
            <div class="col-md-4">
                <canvas id="myPieChart"></canvas>
            </div>
        </div>
    </div>
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-12">
                <canvas id="myBarChart"></canvas>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
<script>
    const ctx = document.getElementById('myChart').getContext('2d');
    var data = @json($dats);
    const myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($labes),
            datasets: [{
                label: @json($name),
                data:data,
                fontColor:['white','black'],
                backgroundColor: [
                    //'rgba(255, 99, 132, 0.2)',
                    'rgba(119, 198, 0, 0.2)',
                    /*'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'*/
                ],
                borderColor: [
                    //'rgba(255, 99, 132, 1)',
                    'rgba(119, 198, 0, 1)',
                    /*'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'*/
                ],
                borderWidth: 2
            }]
        },
        options: {
            plugins:{
                legend: {
                  labels: {
                     color: 'white'
                  },
                }
            },
            scales: {
                y: {
                    grid:{
                        color:'rgba(255,255,255,1)',
                        lineWidth:0.2
                    },
                    ticks: {
                        color: 'white'
                    },
                    beginAtZero: true,
                },
                x: {
                    grid:{
                        color:'rgba(255,255,255,1)',
                        lineWidth:0.2
                    },
                    ticks: {
                        color: 'white'
                    },
                    beginAtZero: true,
                }
            }
        },
    });
</script>
<script>
    const ctxbar = document.getElementById('myBarChart').getContext('2d');
    var data = @json($bardata);
    const myBarChart = new Chart(ctxbar, {
        type: 'bar',
        data: {
            labels: @json($barname),
            datasets: [{
                label: 'All download data / versions:',
                data:data,
                fontColor:['white','black'],
                backgroundColor: [
                    //'rgba(255, 99, 132, 0.2)',
                    'rgba(119, 198, 0, 0.2)',
                    /*'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'*/
                ],
                borderColor: [
                    //'rgba(255, 99, 132, 1)',
                    'rgba(119, 198, 0, 1)',
                    /*'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'*/
                ],
                borderWidth: 2
            }]
        },
        options: {
            plugins:{
                tooltip: {
                callbacks: {
                    label: function(tooltipItem) {
                        let label =  'Download: '+@json($bardata)[tooltipItem.dataIndex]
                        + ', Published: '
                        + @json($barpublished)[tooltipItem.dataIndex]
                        return label;
                    }
                }
            },
                legend: {
                  labels: {
                     color: 'white'
                  },
                }
            },
            scales: {
                y: {
                    grid:{
                        color:'rgba(255,255,255,1)',
                        lineWidth:0.2
                    },
                    ticks: {
                        color: 'white'
                    },
                    beginAtZero: true,
                },
                x: {
                    grid:{
                        color:'rgba(255,255,255,1)',
                        lineWidth:0.2
                    },
                    ticks: {
                        color: 'white'
                    },
                    beginAtZero: true,
                }
            }
        },
    });
</script>

<script>

    const ctxPie = document.getElementById('myPieChart').getContext('2d');
    const myPieChart = new Chart(ctxPie, {
        type: 'pie',
        data: {
            labels: @json($piename),
            datasets: [{
                //label: '',
                data: @json($piedata),
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(19, 143, 226, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(189, 6, 158, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(35, 140, 240, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(19, 143, 226, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(189, 6, 158, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(35, 140, 240, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
          responsive: true,
          plugins: {
            tooltip: {
                callbacks: {
                    label: function(tooltipItem) {
                        let label =  myPieChart.data.labels[tooltipItem.dataIndex]
                        return label;
                    }
                }
            },
            legend: {
              position: 'top',
              labels: {
                 color: 'white',
              },
            },
            title: {
              display: true,
              text: @json($name),
              color: 'white'
            }
          }
        },
    });
</script>
<script>
    function refresh(){
       var now = new Date();
       var h = now.getHours();
       var m = now.getMinutes();
       var s = now.getSeconds();

       var out = h+" : "+m+" : "+s;
       var trig = setTimeout(refresh,800);

       if(h==23 && m==59 && s==0){
           location.reload();
       }else if(h==06 && m==10 && s==0){
           location.reload();
       }
       }
    refresh();
</script>
@endpush
