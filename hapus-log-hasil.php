<?php require_once('includes/init.php'); ?>
<?php cek_login($role = array(1)); ?>

<?php
$ada_error = false;
$result = '';


$log_hasil = (isset($_GET['log'])) ? trim($_GET['log']) : '';

if(!$log_hasil) {
	$ada_error = 'Maaf, data tidak dapat diproses.';
} else {
	$query = mysqli_query($koneksi,"SELECT * FROM hasil WHERE log_hasil = '$log_hasil'");
	$cek = mysqli_num_rows($query);
	
	if($cek <= 0) {
		$ada_error = 'Maaf, data tidak dapat diproses.';
	} else {
		mysqli_query($koneksi,"DELETE FROM hasil WHERE log_hasil = '$log_hasil';");
		redirect_to('hasil.php?status=sukses-hapus');
	}
}
?>

<?php
$page = "User";
require_once('template/header.php');
?>
	<?php if($ada_error): ?>
		<?php echo '<div class="alert alert-danger">'.$ada_error.'</div>'; ?>	
	<?php endif; ?>
<?php
require_once('template/footer.php');