<div class="chart pb-5">
    <div class="search">
        @livewire('search-component',[
            'total'=>$total,
            'totalsearchdate'=>$totalsearchdate,
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
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-12">
                <canvas id="myStackedBarChart"></canvas>
            </div>
        </div>
    </div>
    <div class="statuses mx-4 mt-5">
        @livewire('cjmain-component')
        @livewire('cjtest-component')
        <div class="row">
            <div class="col-md-3">
                @livewire('cloud-flare-stat')
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            @if ($freshdate != [])
                <div class="col-xl-6 my-4">
                    <canvas id="myFreshCoinsChart"></canvas>
                </div>
            @endif
            @if ($monthlydate != [])
                <div class="col-xl-6 my-4">
                    <canvas id="myMonthyVolumes"></canvas>
                </div>
            @endif
            <div class="col-xl-6 my-4">
                <canvas id="AvgRemixCount"></canvas>
            </div>
            @if ($monthlyjoindate != [])
            <div class="col-xl-6 my-4">
                <canvas id="myMonthyCoinJoins"></canvas>
            </div>
            @endif
            <div class="col-xl-6 my-4">
                <canvas id="NeverMixed"></canvas>
            </div>
            <div class="col-xl-6 my-4">
                <canvas id="PostmixConsolidation"></canvas>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-trendline"></script>
<script>
    setInterval(() => {
        Livewire.emit('refreshCoinJoinsMainNetComponent')
    }, 1000);
</script>
<script>
    setInterval(() => {
        Livewire.emit('refreshCoinJoinsTestNetComponent')
    }, 1000);
</script>
<script>
    setInterval(() => {
        Livewire.emit('refreshCloudFlareComponent')
    }, 10*60*1000);
</script>
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
                    'rgba(119, 198, 0, 0.2)'
                ],
                borderColor: [
                    'rgba(119, 198, 0, 1)'
                ],
                trendlineLinear: {
	            	style: "rgba(255,105,180, .8)",
	            	lineStyle: "solid",
	            	width: 1,
	            },
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
                        color:'rgba(255,255,255,0.5)',
                        lineWidth:0.2
                    },
                    ticks: {
                        color: 'white'
                    },
                    beginAtZero: true,
                },
                x: {
                    grid:{
                        color:'rgba(255,255,255,0.5)',
                        lineWidth:0.2
                    },
                    ticks: {
                        color: 'white'
                    },
                    beginAtZero: true,
                }
            }
        }
    });
</script>
<script>
    const ctxFresh = document.getElementById('myFreshCoinsChart').getContext('2d');
    var datawasabi = @json($freshwasabi);
    var datawasabi2 = @json($freshwasabi2);
    var datasamuri = @json($freshsamuri);
    var dataotheri = @json($freshotheri);
    const myFreshChart = new Chart(ctxFresh, {
        type: 'line',
        data: {
            labels: @json($freshdate),
            datasets: [
                {
                    label: 'Wasabi 1.0',
                    data:datawasabi,
                    fontColor:['white','black'],
                    backgroundColor: [
                        'rgba(255, 119, 0, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 119, 0, 1)'
                    ],
                    borderWidth: 2
                },
                {
                    label: 'Wasabi 2.0',
                    data:datawasabi2,
                    fontColor:['white','black'],
                    backgroundColor: [
                        'rgba(119, 198, 0, 0.2)'
                    ],
                    borderColor: [
                        'rgba(119, 198, 0, 1)'
                    ],
                    borderWidth: 2
                }
                /*{
                    label: 'Samuri',
                    data:datasamuri,
                    fontColor:['white','black'],
                    backgroundColor: [
                        'rgba(238, 20, 24, 0.2)'
                    ],
                    borderColor: [
                        'rgba(238, 20, 24, 1)'
                    ],
                    borderWidth: 2,
                    hidden: true
                },
                {
                    label: 'Otheri',
                    data:dataotheri,
                    fontColor:['white','black'],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 2,
                    hidden: true
                }*/
            ]
        },
        options: {
            plugins:{
                title: {
                    display: true,
                    text: 'Fresh Volume',
                    color:'white',
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
                        color:'rgba(255,255,255,0.5)',
                        lineWidth:0.2
                    },
                    ticks: {
                        color: 'white'
                    },
                    beginAtZero: true,
                },
                x: {
                    grid:{
                        color:'rgba(255,255,255,0.5)',
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
    const ctMonthly = document.getElementById('myMonthyVolumes').getContext('2d');
    var datawasabim = @json($monthlywasabi);
    var datawasabim2 = @json($monthlywasabi2);
    var datasamurim = @json($monthlysamuri);
    var dataotherim = @json($monthlyotheri);
    const myMonthlyValuesChart = new Chart(ctMonthly, {
        type: 'line',
        data: {
            labels: @json($monthlydate),
            datasets: [
                {
                    label: 'Wasabi 1.0',
                    data:datawasabim,
                    fontColor:['white','black'],
                    backgroundColor: [
                        'rgba(255, 119, 0, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 119, 0, 1)'
                    ],
                    borderWidth: 2
                },
                {
                    label: 'Wasabi 2.0',
                    data:datawasabim2,
                    fontColor:['white','black'],
                    backgroundColor: [
                        'rgba(119, 198, 0, 0.2)'
                    ],
                    borderColor: [
                        'rgba(119, 198, 0, 1)'
                    ],
                    borderWidth: 2
                }
                /*{
                    label: 'Samuri',
                    data:datasamurim,
                    fontColor:['white','black'],
                    backgroundColor: [
                        'rgba(238, 20, 24, 0.2)'
                    ],
                    borderColor: [
                        'rgba(238, 20, 24, 1)'
                    ],
                    borderWidth: 2,
                    hidden: true
                },
                {
                    label: 'Otheri',
                    data:dataotherim,
                    fontColor:['white','black'],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 2,
                    hidden: true
                }*/
            ]
        },
        options: {
            plugins:{
                title: {
                    display: true,
                    text: 'Total CoinJoin Volumes',
                    color:'white',
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
                        color:'rgba(255,255,255,0.5)',
                        lineWidth:0.2
                    },
                    ticks: {
                        color: 'white'
                    },
                    beginAtZero: true,
                },
                x: {
                    grid:{
                        color:'rgba(255,255,255,0.5)',
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
    const ctAvgRemixCount = document.getElementById('AvgRemixCount').getContext('2d');
    var avgwasabi = @json($avgwasabi);
    var avgwasabi2 = @json($avgwasabi2);
    var avgsamuri = @json($avgsamuri);
    var avgotheri = @json($avgotheri);

    const AvgRemixCountChart = new Chart(ctAvgRemixCount, {
        type: 'line',
        data: {
            labels: @json($avgdate),
            datasets: [
                {
                    label: 'Wasabi 1.0',
                    data:avgwasabi,
                    fontColor:['white','black'],
                    backgroundColor: [
                        'rgba(255, 119, 0, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 119, 0, 1)'
                    ],
                    borderWidth: 2
                },
                {
                    label: 'Wasabi 2.0',
                    data:avgwasabi2,
                    fontColor:['white','black'],
                    backgroundColor: [
                        'rgba(119, 198, 0, 0.2)'
                    ],
                    borderColor: [
                        'rgba(119, 198, 0, 1)'
                    ],
                    borderWidth: 2
                }
                /*{
                    label: 'Samuri',
                    data:avgsamuri,
                    fontColor:['white','black'],
                    backgroundColor: [
                        'rgba(238, 20, 24, 0.2)'
                    ],
                    borderColor: [
                        'rgba(238, 20, 24, 1)'
                    ],
                    borderWidth: 2,
                    hidden: true
                },
                {
                    label: 'Otheri',
                    data:avgotheri,
                    fontColor:['white','black'],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 2,
                    hidden: true
                }*/
            ]
        },
        options: {
            plugins:{
                title: {
                    display: true,
                    text: 'Avarage Remix Count',
                    color:'white',
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
                        color:'rgba(255,255,255,0.5)',
                        lineWidth:0.2
                    },
                    ticks: {
                        color: 'white'
                    },
                    beginAtZero: true,
                },
                x: {
                    grid:{
                        color:'rgba(255,255,255,0.5)',
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
    const ctMonthlyJoins = document.getElementById('myMonthyCoinJoins').getContext('2d');
    var datawasabij = @json($monthlyjoinwasabi);
    var datawasabij2 = @json($monthlyjoinwasabi2);
    var datasamurij = @json($monthlyjoinsamuri);
    const myMonthlyJoinChart = new Chart(ctMonthlyJoins, {
        type: 'line',
        data: {
            labels: @json($monthlyjoindate),
            datasets: [
                {
                    label: 'Wasabi 1.0',
                    data:datawasabij,
                    fontColor:['white','black'],
                    backgroundColor: [
                        'rgba(255, 119, 0, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 119, 0, 1)'
                    ],
                    borderWidth: 2
                },
                {
                    label: 'Wasabi 2.0',
                    data:datawasabij2,
                    fontColor:['white','black'],
                    backgroundColor: [
                        'rgba(119, 198, 0, 0.2)'
                    ],
                    borderColor: [
                        'rgba(119, 198, 0, 1)'
                    ],
                    borderWidth: 2
                }
                /*{
                    label: 'Samuri',
                    data:datasamurij,
                    fontColor:['white','black'],
                    backgroundColor: [
                        'rgba(238, 20, 24, 0.2)'
                    ],
                    borderColor: [
                        'rgba(238, 20, 24, 1)'
                    ],
                    borderWidth: 2
                }*/
            ]
        },
        options: {
            plugins:{
                title: {
                    display: true,
                    text: 'Number of CoinJoins',
                    color: 'white'
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
                        color:'rgba(255,255,255,0.5)',
                        lineWidth:0.2
                    },
                    ticks: {
                        color: 'white'
                    },
                    beginAtZero: true,
                },
                x: {
                    grid:{
                        color:'rgba(255,255,255,0.5)',
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
    const ctNeverMixed = document.getElementById('NeverMixed').getContext('2d');
    var nevermixedwasabi = @json($nevermixedwasabi);
    var nevermixedwasabi2 = @json($nevermixedwasabi2);
    var nevermixedsamuri = @json($nevermixedsamuri);
    var nevermixedotheri = @json($nevermixedotheri);
    const myNeverMixedChart = new Chart(ctNeverMixed, {
        type: 'line',
        data: {
            labels: @json($nevermixeddate),
            datasets: [
                {
                    label: 'Wasabi 1.0',
                    data:nevermixedwasabi,
                    fontColor:['white','black'],
                    backgroundColor: [
                        'rgba(255, 119, 0, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 119, 0, 1)'
                    ],
                    borderWidth: 2
                },
                {
                    label: 'Wasabi 2.0',
                    data:nevermixedwasabi2,
                    fontColor:['white','black'],
                    backgroundColor: [
                        'rgba(119, 198, 0, 0.2)'
                    ],
                    borderColor: [
                        'rgba(119, 198, 0, 1)'
                    ],
                    borderWidth: 2
                }
                /*{
                    label: 'Samuri',
                    data:nevermixedsamuri,
                    fontColor:['white','black'],
                    backgroundColor: [
                        'rgba(238, 20, 24, 0.2)'
                    ],
                    borderColor: [
                        'rgba(238, 20, 24, 1)'
                    ],
                    borderWidth: 2,
                    hidden: true
                },
                {
                    label: 'Otheri',
                    data:nevermixedotheri,
                    fontColor:['white','black'],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 2,
                    hidden: true
                }*/
            ]
        },
        options: {
            plugins:{
                title: {
                    display: true,
                    text: 'Never Mixed',
                    color:'white',
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
                        color:'rgba(255,255,255,0.5)',
                        lineWidth:0.2
                    },
                    ticks: {
                        color: 'white'
                    },
                    beginAtZero: true,
                },
                x: {
                    grid:{
                        color:'rgba(255,255,255,0.5)',
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
    const ctPostmixConsolidation = document.getElementById('PostmixConsolidation').getContext('2d');
    var postmixedwasabi = @json($postmixedwasabi);
    var postmixedwasabi2 = @json($postmixedwasabi2);
    var postmixedsamuri = @json($postmixedsamuri);
    var postmixedotheri = @json($postmixedotheri);
    const myPostmixConsolidationChart = new Chart(ctPostmixConsolidation, {
        type: 'line',
        data: {
            labels: @json($postmixeddate),
            datasets: [
                {
                    label: 'Wasabi 1.0',
                    data:postmixedwasabi,
                    fontColor:['white','black'],
                    backgroundColor: [
                        'rgba(255, 119, 0, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 119, 0, 1)'
                    ],
                    borderWidth: 2
                },
                {
                    label: 'Wasabi 2.0',
                    data:postmixedwasabi2,
                    fontColor:['white','black'],
                    backgroundColor: [
                        'rgba(119, 198, 0, 0.2)'
                    ],
                    borderColor: [
                        'rgba(119, 198, 0, 1)'
                    ],
                    borderWidth: 2
                }
                /*{
                    label: 'Samuri',
                    data:postmixedsamuri,
                    fontColor:['white','black'],
                    backgroundColor: [
                        'rgba(238, 20, 24, 0.2)'
                    ],
                    borderColor: [
                        'rgba(238, 20, 24, 1)'
                    ],
                    borderWidth: 2,
                    hidden: true
                },
                {
                    label: 'Otheri',
                    data:postmixedotheri,
                    fontColor:['white','black'],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 2,
                    hidden: true
                }*/
            ]
        },
        options: {
            plugins:{
                title: {
                    display: true,
                    text: 'Postmix Consolidation',
                    color:'white',
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
                        color:'rgba(255,255,255,0.5)',
                        lineWidth:0.2
                    },
                    ticks: {
                        color: 'white'
                    },
                    beginAtZero: true,
                },
                x: {
                    grid:{
                        color:'rgba(255,255,255,0.5)',
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
                    'rgba(119, 198, 0, 0.2)'
                ],
                borderColor: [
                    'rgba(119, 198, 0, 1)'
                ],
                trendlineLinear: {
	            	style: "rgba(255,105,180, .8)",
	            	lineStyle: "solid",
	            	width: 1,
	            },
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
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
                        color:'rgba(255,255,255,0.5)',
                        lineWidth:0.2
                    },
                    ticks: {
                        color: 'white'
                    },
                    beginAtZero: true,
                },
                x: {
                    display:false,
                    grid:{
                        color:'rgba(255,255,255,0.5)',
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
    const ctxstackedbar = document.getElementById('myStackedBarChart').getContext('2d');
    var daydata = @json($stackeddaydata);
    var weekdata = @json($stackedweekdatashow);
    const myStackedBarChart = new Chart(ctxstackedbar, {
        type: 'bar',
        data: {
            labels: @json($stackedname),
            datasets: [{
                label: '1st day data',
                data:daydata,
                fontColor:['white','black'],
                backgroundColor: [
                    'rgba(119, 198, 0, 0.2)'
                ],
                borderColor: [
                    'rgba(119, 198, 0, 1)'
                ],
                trendlineLinear: {
	            	style: "rgba(119,198,0, 1)",
	            	lineStyle: "solid",
	            	width: 1,
	            },
                borderWidth: 2
            },{
                label: '1st week data',
                data:weekdata,
                fontColor:['white','black'],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)'
                ],
                trendlineLinear: {
	            	style: "rgba(255,105,180, .8)",
	            	lineStyle: "solid",
	            	width: 1,
	            },
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins:{
                tooltip: {
                callbacks: {
                    label: function(tooltipItem) {
                        let daylabel =  ['Download 1st day: '+ @json($stackeddaydata)[tooltipItem.dataIndex]
                        , 'Download 1st week: '+ @json($stackedweekdata)[tooltipItem.dataIndex]
                        , 'Published: '
                        + @json($stackedpublished)[tooltipItem.dataIndex]]
                        return daylabel;
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
                    stacked: true,
                    grid:{
                        color:'rgba(255,255,255,0.5)',
                        lineWidth:0.2
                    },
                    ticks: {
                        color: 'white'
                    },
                    beginAtZero: true,
                },
                x: {
                    stacked: true,
                    display:false,
                    grid:{
                        color:'rgba(255,255,255,0.5)',
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
