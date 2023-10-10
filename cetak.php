<?php
require_once('includes/init.php');

$user_role = get_role();
if($user_role == 'admin' || $user_role == 'user') {
?>	

<html>
	<head>
		<title>Sistem Pendukung Keputusan Metode SAW</title>
	</head>
<!-- <body onload="window.print();"> -->
<body>
<div style="width:100%;margin:0 auto;text-align:center;">
	<h4>Hasil Akhir Perankingan SAW</h4>
	<br/>
	<table width="100%" cellspacing="0" cellpadding="5" border="1">
		<thead>
			<tr align="center">
				<th>Nama Alternatif</th>
				<th>Nilai</th>
				<th>Status</th>
				<th>Rank</th>
			</tr>
		</thead>
		<tbody>
			<?php 
				$no=0;
				$log = $_GET["log"];
				$query = mysqli_query($koneksi,"SELECT * FROM hasil JOIN alternatif ON hasil.id_alternatif=alternatif.id_alternatif WHERE log_hasil = '$log' ORDER BY hasil.nilai DESC");
				while($data = mysqli_fetch_array($query)){
				$no++;
			?>
			<tr align="center">
				<td align="left"><?= $data['nama'] ?></td>
				<td><?= $data['nilai'] ?></td>
				<?php
					if($data['nilai'] > 0.37) {
						$status = "Diterima";
					}else{
						$status = "Ditolak";
					}
				?>
			    <td><?php echo $status ?></td>
				<td><?= $no; ?></td>
			</tr>
			<?php
				}
			?>
		</tbody>
	</table>
</div>

<script type="text/javascript">
	window.print();
    window.onafterprint = back;

    function back() {
        window.location.href = "hasil.php";
    }
</script>

</body>
</html>

<?php
}
else {
	header('Location: login.php');
}
?>