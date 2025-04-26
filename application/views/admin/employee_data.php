<?php 

	switch($employees['type_employee']){
		case 1: 
			$empType = 'Kontrak';
			break;
		case 2:
			$empType = 'Magang';
			break;
		case 3: 
			$empType ='Permanent';
			break;
		default:
			$empType = 'Tidak diketahui';
			break;
	}
	switch($employees['type_uang_makan']){
		case 1: 
			$empUangMakanType = 'Hari';
			break;
		case 2:
			$empUangMakanType = 'Minggu';
			break;
		case 3: 
			$empUangMakanType ='Bulan';
			break;
		default:
			$empUangMakanType = 'Tidak diketahui';
			break;
	}

	$avatar = $employees['avatar'] =='' || empty($employees['avatar']) ? '20fa8f15cecb411184ecb29b07b84a83.jpg' : $employees['avatar'];

?>

<main>
	<h1>Employee</h1>

	<div class="card shadow mt-5">
		<div class="card-header">
			<div class="card-title fs-3 fw-bold">Data Karyawan</div>
		</div>

		<div class="row">
			<div class="col-lg-1 col-md-1 ms-10 me-10 mt-14">
				<div class="image-input image-input-outline shadow" data-kt-image-input="true">
					<div class="image-input-wrapper w-125px h-125px bgi-position-center" style="background-size: 95%; background-image: url('<?=base_url('uploads/avatar/'.$avatar)?>')"></div>
				</div>
			</div>
			<div class="col-lg-3 col-md-3 ms-6 px-10 py-lg-10 py-md-10">
				<div class="mb-3">
					<label for="nama" class="form-label small">Nama :</label>
					<input type="text" value="<?=$employees['name']?>" disabled class="form-control form-control-sm" id="nama" >
				</div>

				<div class="mb-4">
					<label for="tempat_lahir" class="form-label small">Tempat & tanggal lahir :</label>
					<input type="text" value="<?=$employees['place_of_birth'].' '.date('d M Y', strtotime($employees['date_of_birth']));?>" disabled class="form-control form-control-sm" id="tempat_lahir">
				</div>

				<div class="mb-4">
					<label for="gender" class="form-label small">Gender :</label>
					<input type="text" value="<?= $employees['gender'] == 'L'? 'Pria' : 'Wanita' ?>" disabled class="form-control form-control-sm" id="gender">
				</div>
				<div class="mb-4">
					<label for="product" class="form-label small">Product :</label>
					<input type="text" value="<?=$employees['name_product']?>" disabled class="form-control form-control-sm" id="product">
				</div>
			</div>
			<div class="col-lg-3 col-md-3 ms-6 px-10 py-md-10 py-lg-10">
				<div class="mb-4">
					<label for="tanggal_masuk" class="form-label small">Tanggal Masuk :</label>
					<input type="text" value="<?= $employees['date_in'] ==null? '-' : $employees['date_in'] ?>" disabled class="form-control form-control-sm" id="tanggal_masak">
				</div>

				<div class="mb-4">
					<label for="nip" class="form-label small">NIP :</label>
					<input type="text" value="<?= $employees['nip'] ==null? '-' : $employees['nip'] ?>" disabled class="form-control form-control-sm" id="nip">
				</div>

				<div class="mb-4">
					<label for="divisi" class="form-label small">Divisi :</label>
					<input type="text" value="<?= $employees['name_division'] ==null? '-' : $employees['name_division'] ?>" disabled class="form-control form-control-sm" id="divisi">
				</div>
				<div class="mb-4">
					<label for="posisi" class="form-label small">Posisi :</label>
					<input type="text" value="<?= $employees['name_position'] ==null? '-' : $employees['name_position'] ?>" disabled class="form-control form-control-sm" id="posisi">
				</div>
			</div>
			<div class="col-lg-3 col-md-3 ms-6 px-10 py-md-10 py-lg-10">
				<div class="mb-4">
					<label for="type" class="form-label small">Type:</label>
					<input type="text"  value="<?= $empType ?>" class="form-control form-control-sm" id="type">
				</div>
				<div class="mb-4">
					<label for="nip" class="form-label small">Contract :</label>
					<input type="text" value="<?= $employees['contract_expired'] ==null? '-' : $employees['contract_expired'] ?>" class="form-control form-control-sm" id="nip">
				</div>
				<div class="mb-4">
					<label for="gender" class="form-label small">Gaji :</label>
					<input type="text" value="Rp.<?= $employees['basic_salary'] ==null? '-' : number_format($employees['basic_salary'], 0 , ',', '.') ?>"  class="form-control form-control-sm" id="basic_salary">
				</div>
				<div class="mb-4">
					<label for="uang_makan" class="form-label small">Uang Makan :</label>
					<input type="text" value="Rp.<?= $employees['uang_makan'] ==null? '-' : number_format($employees['uang_makan'], 0 , ',', '.') ?>/<?=$empUangMakanType?>"  class="form-control form-control-sm" id="uang_makan">
				</div>
			</div>
		</div>
		<div class="ms-10">
			<h4>Tempat Asal</h4>
			<hr style="width: 100%; border: 2px solid; margin-top: 0.2rem;">
		</div>

		<div class="row me-10 ">
			<div class="col-md-5 col-lg-5 ms-6 px-10 pb-md-5 pb-lg-5">
				<div class="mb-3">
					<label for="kabupaten_asal" class="form-label small">Kabupaten/Kota :</label>
					<input type="text" value="<?= $employees['kabupaten'] ==null? '-' : $employees['kabupaten'] ?>"  class="form-control form-control-sm" id="kabupaten_asal">
				</div>

				<div class="mb-4">
					<label for="kecamatan_asal" class="form-label small">Kecamatan :</label>
					<input type="text" value="<?= $employees['kecamatan'] ==null? '-' : $employees['kecamatan'] ?>" class="form-control form-control-sm" id= "kecamatan_asal">
				</div>

				<div class="mb-4">
					<label for="desa" class="form-label small">Desa :</label>
					<input type="text" value="<?= $employees['desa'] ==null? '-' : $employees['desa'] ?>"   class="form-control form-control-sm" id="desa">
				</div>
				<div class="mb-4">
					<label for="blok" class="form-label small">Blok :</label>
					<input type="text" value="<?= $employees['blok'] ==null? '-' : $employees['blok'] ?>" class="form-control form-control-sm" id="blok">
				</div>
			</div>
			<div class="col-md-5 col-lg-5 ms-6 px-2 pb-md-5 pb-lg-5">
				<div class="mb-3">
					<label for="nama" class="form-label small">Kode Pos :</label>
					<input type="text" value="<?= $employees['kode_pos'] ==null? '-' : $employees['kode_pos'] ?>" class="form-control form-control-sm" id="type">
				</div>

				<div class="mb-4">
					<label for="contract" class="form-label small">Alamat Lengkap :</label>
					<textarea class="form-control form-control-sm" id="spesifik" style="height: 100px" ><?= $employees['spesifik'] ==null? '-' : $employees['spesifik'] ?></textarea>
				</div>

			</div>
		</div>

		<div class="ms-10">
			<h4>Domisili</h4>
			<hr style="width: 100%; border: 2px solid; margin-top: 0.2rem;">
		</div>

		<div class="row me-10 ">
			<div class="col-md-5 col-lg-5 ms-6 px-10 pb-md-5 pb-lg-5">
				<div class="mb-3">
					<label for="kabupaten_asal" class="form-label small">Kabupaten/Kota :</label>
					<input type="text" value="<?= $employees['kabupaten_domisili'] ==null? '-' : $employees['kabupaten_domisili'] ?>" class="form-control form-control-sm" id="kabupaten_domisili">
				</div>

				<div class="mb-4">
					<label for="kecamatan_asal" class="form-label small">Kecamatan :</label>
					<input type="text" value="<?= $employees['kecamatan_domisili'] ==null? '-' : $employees['kecamatan_domisili'] ?>" class="form-control form-control-sm" id="kecamatan_domisili">
				</div>

				<div class="mb-4">
					<label for="desa" class="form-label small">Desa :</label>
					<input type="text" value="<?= $employees['desa_domisili'] ==null? '-' : $employees['desa_domisili'] ?>" class="form-control form-control-sm" id="desadomisili">
				</div>
				<div class="mb-4">
					<label for="blok" class="form-label small">Blok :</label>
					<input type="text" value="<?= $employees['blok_domisili'] ==null? '-' : $employees['blok_domisili'] ?>" class="form-control form-control-sm" id="blokdomisili">
				</div>
			</div>
			<div class="col-md-5 col-lg-5 ms-6 px-2 pb-md-5 pb-lg-5">
				<div class="mb-3">
					<label for="nama" class="form-label small">Kode Pos :</label>
					<input type="text" value="<?= $employees['kode_pos_domisili'] ==null? '-' : $employees['kode_pos_domisili'] ?>" class="form-control form-control-sm" id="kodeposdomisili">
				</div>

				<div class="mb-4">
					<label for="contract" class="form-label small">Alamat Lengkap :</label>
					<textarea class="form-control form-control-sm" id="spesifik" style="height: 100px" > <?= $employees['spesifik_domisili'] ==null? '-' : $employees['spesifik_domisili'] ?> </textarea>
				</div>

			</div>
		</div>

		<div class="ms-10">
			<h4>Kontak dan Data Lainnya</h4>
			<hr style="width: 100%; border: 2px solid; margin-top: 0.2rem;">
		</div>

		<div class="row me-10 ">
			<div class="col-md-5 col-lg-5 ms-6 px-10 pb-md-5 pb-lg-5">
				<div class="mb-3">
					<label for="kabupaten_asal" class="form-label small">No.Hp:</label>
					<input type="text" value="<?= $employees['no_hp'] ==null? '-' : $employees['no_hp'] ?>" class="form-control form-control-sm" id="no_hp">
				</div>
				<div class="mb-4">
					<label for="kecamatan_asal" class="form-label small">Email :</label>
					<input type="text" value="<?= $employees['email'] ==null? '-' : $employees['email'] ?>" class="form-control form-control-sm" id="email">
				</div>
				<div class="mb-4">
					<label for="desa" class="form-label small">BPJS :</label>
					<input type="text"  value="<?= $employees['no_bpjs'] ==null? '-' : $employees['no_bpjs'] ?>" class="form-control form-control-sm" id="BPJS">
				</div>
				<div class="mb-4">
					<label for="blok" class="form-label small">Jenis PPH :</label>
					<input type="text"  value="<?= $employees['code_ptkp'] ==null? '-' : $employees['code_ptkp'] ?> - <?= $employees['keterangan_ptkp'] ==null? '-' : $employees['keterangan_ptkp'] ?>" class="form-control form-control-sm" id="jenis_pph">
				</div> 
			</div>
			<div class="col-md-5 col-lg-5 ms-6 px-2 pb-md-5 pb-lg-5">
				<div class="mb-3">
					<label for="nama" class="form-label small">NIK :</label>
					<input type="text" value="<?= $employees['nik'] ==null? '-' : $employees['nik'] ?>" class="form-control form-control-sm" id="NIK">
				</div>
				<div class="mb-4">
					<label for="contract" class="form-label small">NPWP :</label>
					<input type="text" value="<?= $employees['npwp'] ==null? '-' : $employees['no_bpjs'] ?>" class="form-control form-control-sm" id="NPWWP">
				</div>
			</div>
		</div>




	</div>

	<script>
		//EDIT COMPANY PROFILE

	</script>



</main><?php
