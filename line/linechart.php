<?php
include('koneksi.php');
$negara = mysqli_query($koneksi,"select * from tb_negara");
while($row = mysqli_fetch_array($negara)){
	$nama_negara[] = $row['nama_negara'];
	
	$query = mysqli_query($koneksi,"select total_case from tb_allcase where id_negara='".$row['id_negara']."'");
	$row = $query->fetch_array();
	$total_case[] = $row['total_case'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Grafik Total  Case</title>
	<script type="text/javascript" src="Chart.js"></script>
</head>
<body>
	<div style="width: 800px;height: 800px">
		<canvas id="demobar"></canvas>
	</div>
 
 
	<script>
		var ctx = document.getElementById("demobar").getContext("2d");
		 var myBarChart = new Chart(ctx, {
    	    type: 'line',
			data: {
				labels: <?php echo json_encode($nama_negara); ?>,
				datasets: [{
					label: 'Total Case',
					
					fill: false,
                    lineTension: 0.1,
                    backgroundColor: "rgba(59, 100, 222, 1)",
                    borderColor: "rgba(59, 100, 222, 1)",
                    pointHoverBackgroundColor: "rgba(59, 100, 222, 1)",
					pointHoverBorderColor: "rgba(59, 100, 222, 1)", 
					data: [<?php while ($p = mysqli_fetch_array($total_case)) { echo '"' . $p['total_case'] . '",';}?>]
				}]
			},
			  options: {
    	            barValueSpacing: 20,
    	            scales: {
    	              yAxes: [{
    	                  ticks: {
    	                      min: 0,
    	                  }
    	              }],
    	              xAxes: [{
    	                          gridLines: {
    	                              color: "rgba(0, 0, 0, 0)",
    	                          }
    	                      }]
    	              }
    	          }
    	          
		});
	</script>
</body>
</html>