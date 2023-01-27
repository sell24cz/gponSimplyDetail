$(function() 
{
    let refresh = 10000;
    let tmpData = [];
    let config = {"type":"line","options":{"animation":{"easing":"easeOutCubic","duration":700},"responsive":true,"legend":{"position":"bottom","display":true},"hover":{"mode":"dataset"},"scales":{"xAxes":[{"gridLines":{"zeroLineWidth":1,"zeroLineColor":"rgba(0,0,0,0.3)","color":"rgba(0, 0, 0, 0.05)","lineWidth":1},"display":true,"scaleLabel":{"display":true,"labelString":"Time","fontSize":11,"fontStyle":"normal"},"ticks":{"fontSize":10}}],"yAxes":[{"gridLines":{"zeroLineWidth":1,"zeroLineColor":"rgba(0,0,0,0.3)","color":"rgba(0, 0, 0, 0.05)","lineWidth":1},"display":true,"scaleLabel":{"display":true,"labelString":"Wartość","fontSize":11,"fontStyle":"normal"},"ticks":{"fontSize":10,"min":-40,"max":0}}]},"title":{"display":true,"text":"GPON Signal"}},"data":{"labels":[],"datasets":[{"label":"dBm","data":[],"backgroundColor":"rgba(236,115,87, 0.1)","borderColor":"rgba(236,115,87, 1)","pointBorderColor":"rgba(236,115,87, 1)","borderWidth":1,"fill":false,"pointRadius":2,"pointBorderWidth":1,"pointBackgroundColor":"rgba(255,255,255,1)","pointHoverRadius":2,"pointHoverBorderWidth":1,"pointHoverBackgroundColor":"rgba(255,255,255,1)","pointHoverBorderColor":"rgba(236,115,87, 1)"}]}};
    let ctx = document.getElementById("myChart").getContext("2d");
    chart = new Chart(ctx, config);


    const maxscale = 40;
    let getLabels = function ( RemoteData )
    {
	let labels = [];
	let tmpsize = tmpData.length;
	let tmpDataset = [];
//      alert(JSON.stringify(tmpData));
	if ( tmpsize > 59) 
	{
	    let tmpData2 = [];
	    for ( let itmp = 0; itmp < 50; itmp++ )
	    {
		tmpData2.push( tmpData[itmp+10]);
		tmpDataset.push(tmpData[itmp].values['dBm']);
	    }
	    tmpData = tmpData2;
	    tmpsize = tmpData.length;
	    chart.data.datasets[0].data = tmpDataset;
	}
	if( chart.data.datasets[0].data.length > 0 )
	{
	    labels[0] = tmpData[0].name;
	    for ( let i = 1; i < 60; i++ )
	    {	
		if( tmpsize >= i && ( i == 9 || i == 19 || i == 29 || i == 39 || i == 49 ))
		{
		    labels[i-1] = tmpData[i-1].name;
		}
		if( i > 1 && i == tmpsize )
		{
		    labels[i-1]= tmpData[i-1].name;
		}
		else
		{
		    labels.push('.');
		}
	    }
	}
	else 
	{
	    labels.push(RemoteData.name);
	    for ( let i = 0; i < 59; i++ )
	    {
		if( tmpsize >= i && ( i == 9 || i == 19 || i == 29 || i == 39 || i == 49 ))
		{
		    labels.push(tmpData[i].name);
		}
		else
		{
		    labels.push('.');
		}
	    }
	}
	return labels;
    }

    let getData = function() 
    {
	let deffer = $.Deferred();
	var ip  = document.getElementById("ipolt").value;
	var marker  = document.getElementById("marker").value;
	var model  = document.getElementById("modelolt").value;
	chart.options.title.text = "GPON Signal SN: " + document.getElementById("sn").value;
	$.ajax({
	    type: 'POST',
    	    url: 'getdata.php',
	    data: { dsnw: '', ipolt: ip, marker: marker, modelolt: model},
	    dataType: 'json',
            cache: false,
            success: function(ret) { return deffer.resolve(ret); },
            error: function(error) { return deffer.reject(error); }
        });
	return deffer;
    }

    let chartUpdate = function()
    {
	$.when(getData()).then(function(ret) 
	{
	    tmpData.push(ret);
	    chart.data.labels = getLabels(ret);
	    chart.data.datasets.forEach((dataset) => {
    		dataset.data.push(ret.values['dBm']);
		});
	    chart.update();
	}, 
	function(err) 
	{
    	    console.warn('Error receive data: ', err);
    	});
	setTimeout(chartUpdate, refresh);
    }
    
    let init = function() 
    {
        $.when(getData()).then(function(ret) 
	{
	    tmpData.push(ret);
	    chart.data.labels = getLabels(ret);
    	    chart.data.datasets.forEach((dataset) => {
    		dataset.data.push(ret.values['dBm']);
		});
	    chart.update();

    	}, 
	function(err) 
	{
    	    console.warn('Error receive data: ', err);
    	});
        setTimeout(chartUpdate, refresh);
    }
    init();
})();

