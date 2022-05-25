    <br>
    <div id="subnet"></div>
    <br> 
<script src="https://code.highcharts.com/highcharts.js"></script>

<script type="text/javascript">
    let getSubnet = <?php echo json_encode($subnet)?>;
    let suba = getSubnet.map(function(obj){
                return obj.subnet;
            })
    let subb = getSubnet.map(function(obj){
                return obj.co;
            })
    let subnet = [];
    for(let j=0;j<suba.length;j++){
        let obj = new Object();
        obj.name = suba[j];
        obj.y  = subb[j];
        subnet.push(obj);
    }
    console.log(subnet)


    Highcharts.setOptions({
        colors: Highcharts.map(Highcharts.getOptions().colors, function (color) {
            return {
                radialGradient: {
                    cx: 0.5,
                    cy: 0.3,
                    r: 0.7
                },
                stops: [
                    [0, color],
                    [1, Highcharts.color(color).brighten(-0.3).get('rgb')] // darken
                ]
            };
        })
    });

    Highcharts.chart('subnet', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Top 10 most test by subnet'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    connectorColor: 'silver'
                }
            }
        },
        series: [{
            name: 'Subnet',
            data: subnet
        }]
    });
</script>