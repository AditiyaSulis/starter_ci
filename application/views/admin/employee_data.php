<main>
	<h1>Employee</h1>

	<div class="card shadow mt-5">
		<div class="card-header">
			<div class="card-title fs-3 fw-bold">Data Karyawan</div>
		</div>

		<div class="row">
			<div class="col-lg-1 col-md-1 ms-10 me-10 mt-14">
				<div class="image-input image-input-outline shadow" data-kt-image-input="true">
					<div class="image-input-wrapper w-125px h-125px bgi-position-center" style="background-size: 95%; background-image: url('<?=base_url('asset/media/background/bg_blue_sea.jpg')?>')"></div>
				</div>
			</div>
			<div class="col-lg-3 col-md-3 ms-6 px-10 py-lg-10 py-md-10">
				<div class="mb-3">
					<label for="nama" class="form-label small">Nama :</label>
					<input type="text" class="form-control form-control-sm" id="nama">
				</div>

				<div class="mb-4">
					<label for="tempat_lahir" class="form-label small">Tempat & tanggal lahir :</label>
					<input type="text" class="form-control form-control-sm" id="tempat_lahir">
				</div>

				<div class="mb-4">
					<label for="gender" class="form-label small">Gender :</label>
					<input type="text" class="form-control form-control-sm" id="gender">
				</div>
				<div class="mb-4">
					<label for="product" class="form-label small">Product :</label>
					<input type="text" class="form-control form-control-sm" id="product">
				</div>
			</div>
			<div class="col-lg-3 col-md-3 ms-6 px-10 py-md-10 py-lg-10">
				<div class="mb-4">
					<label for="tanggal_masuk" class="form-label small">Tanggal Masuk :</label>
					<input type="text" class="form-control form-control-sm" id="tanggal_masak">
				</div>

				<div class="mb-4">
					<label for="nip" class="form-label small">NIP :</label>
					<input type="text" class="form-control form-control-sm" id="nip">
				</div>

				<div class="mb-4">
					<label for="divisi" class="form-label small">Divisi :</label>
					<input type="text" class="form-control form-control-sm" id="divisi">
				</div>
				<div class="mb-4">
					<label for="posisi" class="form-label small">Posisi :</label>
					<input type="text" class="form-control form-control-sm" id="posisi">
				</div>
			</div>
			<div class="col-lg-3 col-md-3 ms-6 px-10 py-md-10 py-lg-10">
				<div class="mb-4">
					<label for="tanggal_masuk" class="form-label small">Type:</label>
					<input type="text" class="form-control form-control-sm" id="type">
				</div>

				<div class="mb-4">
					<label for="nip" class="form-label small">Contract :</label>
					<input type="text" class="form-control form-control-sm" id="nip">
				</div>

				<div class="mb-4">
					<label for="gender" class="form-label small">Gaji :</label>
					<input type="text" class="form-control form-control-sm" id="gender">
				</div>
				<div class="mb-4">
					<label for="uang_makan" class="form-label small">Uang Makan :</label>
					<input type="text" class="form-control form-control-sm" id="uang_makan">
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
					<input type="text" class="form-control form-control-sm" id="kabupaten_asal">
				</div>

				<div class="mb-4">
					<label for="kecamatan_asal" class="form-label small">Kecamatan :</label>
					<input type="text" class="form-control form-control-sm" id="kecamatan_asal">
				</div>

				<div class="mb-4">
					<label for="desa" class="form-label small">Desa :</label>
					<input type="text" class="form-control form-control-sm" id="desa">
				</div>
				<div class="mb-4">
					<label for="blok" class="form-label small">Blok :</label>
					<input type="text" class="form-control form-control-sm" id="blok">
				</div>
			</div>
			<div class="col-md-5 col-lg-5 ms-6 px-2 pb-md-5 pb-lg-5">
				<div class="mb-3">
					<label for="nama" class="form-label small">Kode Pos :</label>
					<input type="text" class="form-control form-control-sm" id="type">
				</div>

				<div class="mb-4">
					<label for="contract" class="form-label small">Alamat Lengkap :</label>
					<textarea class="form-control form-control-sm" id="spesifik" style="height: 100px" > </textarea>
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
					<input type="text" class="form-control form-control-sm" id="kabupaten_domisili">
				</div>

				<div class="mb-4">
					<label for="kecamatan_asal" class="form-label small">Kecamatan :</label>
					<input type="text" class="form-control form-control-sm" id="kecamatan_domisili">
				</div>

				<div class="mb-4">
					<label for="desa" class="form-label small">Desa :</label>
					<input type="text" class="form-control form-control-sm" id="desadomisili">
				</div>
				<div class="mb-4">
					<label for="blok" class="form-label small">Blok :</label>
					<input type="text" class="form-control form-control-sm" id="blokdomisili">
				</div>
			</div>
			<div class="col-md-5 col-lg-5 ms-6 px-2 pb-md-5 pb-lg-5">
				<div class="mb-3">
					<label for="nama" class="form-label small">Kode Pos :</label>
					<input type="text" class="form-control form-control-sm" id="kodeposdomisili">
				</div>

				<div class="mb-4">
					<label for="contract" class="form-label small">Alamat Lengkap :</label>
					<textarea class="form-control form-control-sm" id="spesifik" style="height: 100px" > </textarea>
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
					<input type="text" class="form-control form-control-sm" id="no_hp">
				</div>
				<div class="mb-4">
					<label for="kecamatan_asal" class="form-label small">Email :</label>
					<input type="text" class="form-control form-control-sm" id="email">
				</div>
				<div class="mb-4">
					<label for="desa" class="form-label small">BPJS :</label>
					<input type="text" class="form-control form-control-sm" id="BPJS">
				</div>
				<div class="mb-4">
					<label for="blok" class="form-label small">Jenis PPH :</label>
					<input type="text" class="form-control form-control-sm" id="jenis_pph">
				</div>
			</div>
			<div class="col-md-5 col-lg-5 ms-6 px-2 pb-md-5 pb-lg-5">
				<div class="mb-3">
					<label for="nama" class="form-label small">NIK :</label>
					<input type="text" class="form-control form-control-sm" id="NIK">
				</div>
				<div class="mb-4">
					<label for="contract" class="form-label small">NPWP :</label>
					<input type="text" class="form-control form-control-sm" id="NPWWP">
				</div>
			</div>
		</div>


	</div>

	<script>
		//EDIT COMPANY PROFILE

	</script>



</main><?php
