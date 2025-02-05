<main>
    <h1>Piutang</h1>

    <button type="button" class="btn gradient-btn rounded-pill mt-10" data-bs-toggle="modal" data-bs-target="#addProduct">
        <i class="bi bi-plus-circle"></i>
        Add Piutang
    </button>

    <ul class="nav nav-tabs mt-8">
        <li class="nav-item">
            <a class="nav-link text-dark" aria-current="page" href="<?=base_url('admin/piutang/piutang_paid_page?status_piutang=1')?>">Paid</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active text-info " href="<?=base_url('admin/piutang/piutang_page?status_piutang=2')?>">Unpaid</a>
        </li>
    </ul>

	<?php $this->load->view($view_data);?>

   	<!-- Modal Add Piutang -->
	<div class="modal fade" tabindex="-1" id="addProduct">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Add Piutang</h3>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-2">
                                <i class="ti ti-minus"></i>
                            </span>
                        </span>
                    </div>
                </div>

                <div class="modal-body">
                    <form class="form w-100" id="addproduct" data-action="<?= site_url('admin/piutang/add_piutang') ?>" enctype="multipart/form-data">
                        <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                            <span>Karyawan</span>
                        </div>
                        <div class="fv-row mb-8">
                            <select class="form-select" aria-label="Default select example" name="id_employee">
                                <option selected>-Karyawan-</option>
                                <?php foreach($employee as $emp):?>
                                    <option value="<?=$emp['id_employee']?>"><?=$emp['name']?></option>
                                <?php endforeach;?>
                            </select>
                        </div>

                        <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                            <span>Tanggal Input</span>
                        </div>
                        <div class="fv-row mb-8">
                            <input type="date" value="<?= date('Y-m-d') ?>" name="piutang_date" autocomplete="off" class="form-control bg-transparent" />
                        </div>

                        <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                            <span>Type Piutang</span>
                        </div>
                        <div class="fv-row mb-8">
                            <select class="form-select" aria-label="Default select example" name="type_piutang" id="type_piutang">
                                <option selected>-Type-</option>
                                <option value="2" selected>Kasbon</option>
                                <option value="1">Pinjaman</option>
                            </select>
                        </div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Amount</span>
						</div>
						<div class="fv-row mb-8">
							<input type="number" name="amount_piutang" autocomplete="off" class="form-control bg-transparent" />
						</div>
                        <div id="tenor-form" style="display: none;">
                            <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                <span>Jangka Piutang</span>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text">Satuan</span>
                                <input type="number" class="form-control" min="1" name="tenor_piutang" placeholder="" value="1" aria-label="Username">
                                <span class="input-group-text">Type</span>
								<select class="form-select" aria-label="Default select example" name="type_tenor" id="type_tenor">
									<option value="1">Hari</option>
									<option value="2">Minggu</option>
									<option value="3" selected>Bulan</option>
									<option value="4">Tahun</option>
								</select>
                            </div>
							<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
								<span>Angsuran</span>
							</div>
							<div class="fv-row mb-8">
								<input type="number" name="angsuran" autocomplete="off" class="form-control bg-transparent" />
							</div>
                        </div>
                        <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                            <span>Jatuh Tempo (Tanggal)</span>
                        </div>
                        <div class="fv-row mb-8">
							<input type="number" id="jatuh_tempo" name="jatuh_tempo" autocomplete="off" class="form-control bg-transparent" />
                        </div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                            <span>Tanggal Lunas</span>
                        </div>
                        <div class="fv-row mb-8">
							<input type="date" id="tgl_lunas" value="<?= date("Y-m-d") ?>" name="tgl_lunas" autocomplete="off" class="form-control bg-transparent" />
                        </div>

                        <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                            <span>Deskripsi</span>
                        </div>
                        <div class="fv-row mb-8">
                            <textarea type="text" class="form-control" id="description" name="description_piutang"></textarea>
                        </div>

                        <div class="d-grid mb-10">
                            <button type="submit" id="submit_product" class="btn btn-primary">
                                <span class="indicator-label">
                                    Add Piutang
                                </span>
                                <span class="indicator-progress">
                                    Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

	<!-- Modal Pay-->
	<?php $this->load->view($view_components);?>

    <script>
        const base_url = $('meta[name="base_url"]').attr('content');

        //TENOR FORM
        document.addEventListener('DOMContentLoaded', function () {
            const typePiutangSelect = document.getElementById('type_piutang');
            const additionalForm = document.getElementById('tenor-form');

            
            typePiutangSelect.addEventListener('change', function () {
                if (this.value === '1') { 
                    additionalForm.style.display = 'block'; 
                } else {
                    additionalForm.style.display = 'none';
                }
            });
        });

		document.addEventListener("DOMContentLoaded", function () {
			const amountInput = document.querySelector("input[name='amount_piutang']");
			const tenorInput = document.querySelector("input[name='tenor_piutang']");
			const angsuranInput = document.querySelector("input[name='angsuran']");
			const type = document.querySelector("input[name='type_tenor']");
			console.log('tenor_type : ' + type);

			const jatuhTempoInput = document.getElementById("jatuh_tempo");
			const typeTenorSelect = document.getElementById("type_tenor");
			const tglLunasInput = document.getElementById("tgl_lunas");


			const calculateAngsuran = () => {
				const amount = parseFloat(amountInput.value) || 0;
				const tenor = parseFloat(tenorInput.value) || 0;
				// const tenor_type = parseFloat(type.value) || 0;



				if (tenor > 0 ) {
					angsuranInput.value = (amount / tenor).toFixed(2);
				} else {
					angsuranInput.value = "";
				}
			};

			function calculateTanggalLunas() {
				//const jatuhTempo = parseInt(jatuhTempoInput.value, 10) || 0;
				const tenor = parseInt(tenorInput.value, 10) || 0;
				const typeTenor = parseInt(typeTenorSelect.value, 10);

				let totalDays = 0;

				switch (typeTenor) {
					case 1:
						totalDays += tenor;
						break;
					case 2:
						totalDays += tenor * 7;
						break;
					case 3:
						totalDays += tenor * 30;
						break;
					case 4:
						totalDays += tenor * 365;
						break;
					default:
						break;
				}
				const currentDate = new Date();
				currentDate.setDate(currentDate.getDate() + totalDays);
				const year = currentDate.getFullYear();
				const month = String(currentDate.getMonth() + 1).padStart(2, '0');
				const day = String(currentDate.getDate()).padStart(2, '0');

				tglLunasInput.value = `${year}-${month}-${day}`;
			}

			//jatuhTempoInput.addEventListener("input", calculateTanggalLunas);
			tenorInput.addEventListener("input", calculateTanggalLunas);
			typeTenorSelect.addEventListener("change", calculateTanggalLunas);


			amountInput.addEventListener("input", calculateAngsuran);
			tenorInput.addEventListener("input", calculateAngsuran);
		});

	</script>
</main>


