<br>
    <div id="apname"></div>
    <br> 
<script src="https://code.highcharts.com/highcharts.js"></script>

<script type="text/javascript">
    let getAPname = <?php echo json_encode($apname)?>;
    let apa = getAPname.map(function(obj){
                return obj.apname;
            })
    let apb = getAPname.map(function(obj){
                return obj.co;
            })
    let apname = [];
    for(let j=0;j<apa.length;j++){
        let obj = new Object();
        obj.name = apa[j];
        obj.y  = apb[j];
        apname.push(obj);
    }
    console.log(apname)

    Highcharts.chart('apname', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Top 10 most test by AP name'
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
            name: 'APname',
            data: apname
        }]
    });
</script>