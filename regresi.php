<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="Chart.min.js"></script>    
	<style type="text/css">
		table.data{
			border-collapse: collapse;
			margin-bottom: 5px;
			width: 45%;
		}
		table.data td{
			padding: 3px 7px;

		}

		table.data td.textcenter{
			text-align: center;
			font-weight: bold;

		}
	</style>
</head>
<body>
	<table class="data" border="1">
	<tr>
		<th width="60px">No.</th>
		<th>X <br/> (Kecerdasan)</th>
		<th>Y <br/> (Produksi)</th>
		<th>XX</th>
		<th>YY</th>
		<th>XY</th>
	</tr>

	<?php
	include 'koneksi.php';

	$sql = mysqli_query($con, "SELECT * FROM produksi_kecerdasan") or die(mysqli_error($con));
	if(mysqli_num_rows($sql) > 0){
		$no = 0;
		$jumlah_x = 0;
		$jumlah_y = 0;
		$jumlah_xx = 0;
		$jumlah_xy = 0;
		$jumlah_yy = 0;
		while ($data = mysqli_fetch_array($sql)) {

			$jumlah_x += $data['x'];
			$jumlah_y += $data['y'];

			$jumlah_xx += ($data['x'] * $data['x']);
			$jumlah_yy += ($data['y'] * $data['y']);
			$jumlah_xy += ($data['x'] * $data['y']);


			echo '<tr><td class="textcenter">'.++$no.'</td>
			<td>'.$data['x'].'</td>
			<td>'.$data['y'].'</td>
			<td>'.($data['x'] * $data['x']).'</td>
			<td>'.($data['y'] * $data['y']).'</td>
			<td>'.($data['x'] * $data['y']).'</td>
			</tr>';
		}
	}
	
	echo '<tr><td>Jumlah</td>
	<td>'.round($jumlah_x, 2).'</td>
	<td>'.round($jumlah_y, 2).'</td>
	<td>'.round($jumlah_xx, 2).'</td>
	<td>'.round($jumlah_yy, 2).'</td>
	<td>'.round($jumlah_xy, 2).'</td>
	</tr>';

	$rata_x = $jumlah_x/$no;
	$rata_y = $jumlah_y/$no;
	$rata_xx = $jumlah_xx/$no;
	$rata_yy = $jumlah_yy/$no;
	$rata_xy = $jumlah_xy/$no;

	echo '<tr><td>Rata-rata</td>
	<td>'.round($rata_x, 2).'</td>
	<td>'.round($rata_y, 2).'</td>
	<td>'.round($rata_xx, 2).'</td>
	<td>'.round($rata_yy, 2).'</td>
	<td>'.round($rata_xy, 2).'</td>
	</tr>';

	$a = (($jumlah_xx*$jumlah_y)-($jumlah_x*$jumlah_xy))/(($no*$jumlah_xx)-($jumlah_x*$jumlah_x));
	$a = round($a, 2);
	echo '<tr><td colspan="2">Nilai A</td>
	<td colspan="4">'.$a.'</td>
	</tr>';

	$b = (($no*$jumlah_xy)-($jumlah_x*$jumlah_y))/(($no*$jumlah_xx)-($jumlah_x*$jumlah_x));
	$b = round($b, 2);
	echo '<tr><td colspan="2">Nilai B</td>
	<td colspan="4">'.$b.'</td>
	</tr>';

	$r = (($no*$jumlah_xy)-($jumlah_x*$jumlah_y))/sqrt((($no*$jumlah_xx)-($jumlah_x*$jumlah_x)) * (($no*$jumlah_yy)-($jumlah_y*$jumlah_y)));
	$r = round($r, 2);
	echo '<tr><td colspan="2">Nilai Korelasi (r)</td>
	<td colspan="4">'.$r.'</td>
	</tr>';

	if($r>0 && $r<0.5){
		$korelasi = 'Nilai 0 < r < 0.5 maka memiliki korelasi lemah positif, <br/>
					 berarti hubungan variabel bebas [X] dan variabel terikat [Y] dapat dikatakan lemah <br/>
					 yaitu pengaruhnya relatif kecil dan mempunyai arah perubahan yang sama atau searah';
	} 
	else if($r>0.51 && $r<1){
		$korelasi = 'Nilai 0.51 < r < 1 maka memiliki korelasi kuat positif, <br/>
					 berarti hubungan variabel bebas [X] dan variabel terikat [Y] dapat dikatakan sangat sensitif terhadap perubahan yang terjadi pada variabel bebas. Jika variabel bebas berubah maka variabel terikat juga akan segera berubah';
	}
	else if($r>-0.5 && $r<0){
		$korelasi = 'Nilai 0 < r < -0.5 maka memiliki korelasi lemah negatif, <br/>
					 berarti hubungan variabel bebas [X] dan variabel terikat [Y] dapat dikatakan tidak terlalu sensitif terhadap perubahan yang terjadi pada variabel bebas. Jika variabel bebas dinaikan maka variabel terikat malah akan mengalami penurunan';
	} 
	else if($r>-1 && $r<0){
		$korelasi = 'Nilai -1 < r < 0 maka memiliki korelasi kuat negatif, <br/>
					 berarti hubungan variabel bebas [X] dan variabel terikat [Y] dapat dikatakan sangat sensitif terhadap perubahan yang terjadi pada variabel bebas, namun perubahan itu saling berlawanan,<br/>. Jika variabel bebas dinaikan maka variabel terikat malah akan mengalami penurunan';
	}
	else if($r<0){
		$korelasi = 'Nilai r = 0 maka hubungan variabel bebas [X] tidak ada hubungan dengan variabel terikat [Y].';
	}

	echo '<tr><td colspan="2">Analisis</td>
	<td colspan="4">'.$korelasi.'</td>
	</tr>';

	?>	
	</table>

	<table>
	<form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
		<tr>
			<td>Rumus Regresi Linier (Y=A+BX)</td>
			<td>:</td>
			<td><?php echo '<b> Y = '.$a.'  + '.$b.'X</b>';?></td>
		</tr>
		<tr>
			<td>Lakukan Prediksi, Masukan Nilai X</td>
			<td>:</td>
			<td><input type="text" name="x" ></td>
		</tr>
		<tr>
			<td colspan="2"></td>
			<td><input type="submit" name="submit" value="Prediksi"></td>
		</tr>
		<?php
		if (isset($_POST['submit'])) {
			$x = $_POST['x'];
			$y = $a+$b*$x;

			echo '<tr><td colspan="3">Nilai Y hasil prediksi <b> Y = '.$a.' + '.$b.'X = '.$y.'</b></td>
			</tr>';
		}

		?>
	</form>
	
	</table>
	<canvas id="graph" width=500 height="150"></canvas>

<?php
	$sql = mysqli_query($con, "SELECT x,y FROM produksi_kecerdasan ORDER By x ASC") or die(mysqli_error($con));
	
	$array_x = array();
	$array_y = array();
	$array_y_prediksi = array();
	while ($data = mysqli_fetch_array($sql)) {
		array_push($array_x, $data['x']);
		array_push($array_y, $data['y']);

		$y = $a+$b*$data['x'];
		array_push($array_y_prediksi, $y);
	}
?>

<script>
    ctx = document.getElementById('graph');
    var chart = new Chart(ctx, {
        type : 'line',
        data: {
            labels: [<?=implode(",", $array_x)?>],
            datasets: [
                {
                label: 'Realisasi Hasil Produksi',
                data: [<?=implode(",", $array_y)?>],
                backgroundColor: 'rgba(12, 199, 132, 0.2)',
                borderWidth: 1
                },
                {
                label: 'Regresi Linier',
                data: [<?=implode(",", $array_y_prediksi)?>],
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderWidth: 1
                },
            ]
        }
    });
</script>

</body>
</html>