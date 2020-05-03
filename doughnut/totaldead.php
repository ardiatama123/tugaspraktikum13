<?php
include('koneksi.php');
$negara = mysqli_query($koneksi,"select * from tb_negara");
while($row = mysqli_fetch_array($negara)){
	$nama_negara[] = $row['nama_negara'];
	
	$query = mysqli_query($koneksi,"select total_dead from tb_allcase where id_negara='".$row['id_negara']."'");
	$row = $query->fetch_array();
	$total_case[] = $row['total_dead'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Angka Penderita Covid-19</title>
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
	<h1>Total Death di 10 Negara</h1>

	<div style="width: 800px;height: 800px">
		<canvas id="myChart"></canvas>
	</div>
 
 
	<script>
		var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'doughnut',
			data: {
				labels: <?php echo json_encode($nama_negara); ?>,
				datasets: [{
					label: 'New Case',
					data: <?php echo json_encode($total_case); ?>,
					backgroundColor: ['rgba(255, 99, 132, 1)',
					'rgba(255, 255, 255, 1)',
					'rgba(75, 192, 192, 1)',
					'rgba(355, 102, 0, 1)',
					'rgba(102, 51, 0, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(102, 0, 102, 1)',
					'rgba(255, 153, 255, 1)',
					'rgba(0, 0, 0, 1)',
					'rgba(0, 102, 51, 1)'],
					borderColor: ['rgba(255,99,132,1)',
					'rgba(255,99,132,1)',
					'rgba(75, 192, 192, 1)',
					'rgba(355, 102, 0, 1)',
					'rgba(102, 51, 0, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(102, 0, 102, 1)',
					'rgba(255, 153, 255, 1)',
					'rgba(0, 0, 0, 1)',
					'rgba(0, 102, 51, 1)'],
					borderWidth: 1
				},]
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
	</script>
	</center>
</body>
</html>