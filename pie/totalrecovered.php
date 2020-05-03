<?php
include('koneksi.php');
$negara = mysqli_query($koneksi,"select * from tb_negara");
while($row = mysqli_fetch_array($negara)){
	$nama_negara[] = $row['nama_negara'];
	
	$query = mysqli_query($koneksi,"select total_recovered from tb_allcase where id_negara ='".$row['id_negara']."'");
	$row = $query->fetch_array();
	$total_case[] = $row['total_recovered'];
}
?>
<!doctype html>
<html>
 
<head>
	<title>Pie Chart Total Recovered Covid 19</title>
	<script type="text/javascript" src="Chart.js"></script>
</head>
 
<body>
	<center>

	<a href="totalcase.php"><input type="button" name="" value="Total Case"></a></input>
	<a href="newcase.php"><input type="button" name="" value="New Case"></a></input>
	<a href="totaldead.php"><input type="button" name="" value="Total Death"></a></input>
	<a href="newdead.php"><input type="button" name="" value="New Death"></a></input>
	<a href="totalrecovered.php"><input type="button" name="" value="Total Recovered"></a></input>
	<a href="activecase.php"><input type="button" name="" value="Active Case"></a></input>

	<h1>Total Recovered 10 Negara</h1>


	<div id="canvas-holder" style="width:50%">
		<canvas id="chart-area"></canvas>
	</div>
	<script>
		var config = {
			type: 'pie',
			data: {
				datasets: [{
					data:<?php echo json_encode($total_case); ?>,
					backgroundColor: [
					'rgba(255, 99, 132, 1)',
					'rgba(255, 255, 255, 1)',
					'rgba(75, 192, 192, 1)',
					'rgba(355, 102, 0, 1)',
					'rgba(102, 51, 0, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(102, 0, 102, 1)',
					'rgba(255, 153, 255, 1)',
					'rgba(0, 0, 0, 1)',
					'rgba(0, 102, 51, 1)'
					],
					borderColor: [
					'rgba(255, 99, 132, 1)',
					'rgba(255, 99, 132, 1)',
					'rgba(75, 192, 192, 1)',
					'rgba(355, 102, 0, 1)',
					'rgba(102, 51, 0, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(102, 0, 102, 1)',
					'rgba(255, 153, 255, 1)',
					'rgba(0, 0, 0, 1)',
					'rgba(0, 152, 51, 1)'
					],
					label: 'Total Case'
				}],
				labels: <?php echo json_encode($nama_negara); ?>},
			options: {
				responsive: true
			}
		};
 
		window.onload = function() {
			var ctx = document.getElementById('chart-area').getContext('2d');
			window.myPie = new Chart(ctx, config);
		};
 
		document.getElementById('randomizeData').addEventListener('click', function() {
			config.data.datasets.forEach(function(dataset) {
				dataset.data = dataset.data.map(function() {
					return randomScalingFactor();
				});
			});
 
			window.myPie.update();
		});
 
		var colorNames = Object.keys(window.chartColors);
		document.getElementById('addDataset').addEventListener('click', function() {
			var newDataset = {
				backgroundColor: [],
				data: [],
				label: 'New dataset ' + config.data.datasets.length,
			};
 
			for (var index = 0; index < config.data.labels.length; ++index) {
				newDataset.data.push(randomScalingFactor());
 
				var colorName = colorNames[index % colorNames.length];
				var newColor = window.chartColors[colorName];
				newDataset.backgroundColor.push(newColor);
			}
 
			config.data.datasets.push(newDataset);
			window.myPie.update();
		});
 
		document.getElementById('removeDataset').addEventListener('click', function() {
			config.data.datasets.splice(0, 1);
			window.myPie.update();
		});
	</script>
	</center>
</body>
 
</html>