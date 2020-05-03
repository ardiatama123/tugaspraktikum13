<?php
include('koneksi.php');
$negara = mysqli_query($koneksi,"select * from tb_negara");
while($row = mysqli_fetch_array($negara)){
	$nama_negara[] = $row['nama_negara'];
	
	$query = mysqli_query($koneksi,"select total_case,new_case,total_dead,new_dead,total_recovered,active_case from tb_allcase where id_negara='".$row['id_negara']."'");
	$row = $query->fetch_array();
	$total_case[] = $row['total_case'];
	$new_case[] = $row['new_case'];
	$total_dead[] = $row['total_dead'];
	$new_dead[] = $row['new_dead'];
	$total_recovered[] = $row['total_recovered'];
	$active_case[] = $row['active_case'];

}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Grafik Total  Case</title>
	<script type="text/javascript" src="Chart.js"></script>
</head>
<body>
	<center>
	<h1>Angka Penderita Covid-19</h1>
	<div style="width: 800px;height: 800px">
		<canvas id="myChart"></canvas>
	</div>
 
 
	<script>
		var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'line',
			data: {
				labels: <?php echo json_encode($nama_negara); ?>,
				datasets: [{
					label: 'Total Case',
					fill : false,
					data: <?php echo json_encode($total_case); ?>,
					backgroundColor: 'rgba(255, 99, 132, 1)',
					borderColor: 'rgba(255,99,132,1)',
					borderWidth: 1
				},
				{
					label: 'New Case',
					fill : false,
					data: <?php echo json_encode($new_case); ?>,
					backgroundColor: 'rgba(255, 206, 86, 1)',
					borderColor: 'rgba(255, 206, 86, 1)',
					borderWidth: 1
				},
				{
					label: 'Total Death',
					fill : false,
					data: <?php echo json_encode($total_dead); ?>,
					backgroundColor: 'rgba(0, 0, 0, 1)',
					borderColor: 'rgba(0, 0, 0, 1)',
					borderWidth: 1
				},
				{
					label: 'New Death',
					fill : false,
					data: <?php echo json_encode($new_dead); ?>,
					backgroundColor: 'rgba(255, 192, 192, 1)',
					borderColor:  'rgba(255, 192, 192, 1)',
					borderWidth: 1
				},
				{
					label: 'Total Recovered',
					fill : false,
					data: <?php echo json_encode($total_recovered); ?>,
					backgroundColor: 'rgba(255, 153, 255, 1)',
					borderColor: 'rgba(255, 153, 255, 1)',
					borderWidth: 1
				},
				{
					label: 'Active Case',
					fill : false,
					data: <?php echo json_encode($active_case); ?>,
					backgroundColor: 'rgba(0, 102, 51, 1)',
					borderColor: 'rgba(0, 102, 51, 1)',
					borderWidth: 1
				}]
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
		})	;
	</script>
	
</center>
</body>
</html>