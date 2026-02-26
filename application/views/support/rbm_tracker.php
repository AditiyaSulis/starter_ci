
<?php
$badge = [
    'Belum'   => 'badge-light-warning',
    'Diskusi' => 'badge-light-info',
    'Proses'  => 'badge-light-primary',
    'Selesai' => 'badge-light-success',
];
?>
<main>
    <h1 class="mb-4">RBM Feature Tracker</h1>

    <div class="d-flex justify-content-between flex-wrap mt-5">
		<button type="button" class="btn  rounded-pill btn-flex gradient-btn mt-3" data-bs-toggle="modal"
				data-bs-target="#addProduct">
			<i class="bi bi-plus-circle"></i> Tambah Request
		</button>
	</div> 

	<div class="row mt-5 g-5">

    <!-- Status Tracker -->
    <div class="col-auto">
        <div class="card bg-light-primary card-xl-stretch w-350px">
            <div class="card-body">
                <div class="fs-4 fw-bold text-gray-900 mb-5">
                    Status
                </div>

                <?php foreach ($list_count as $status => $total): ?>
                    <div class="d-flex justify-content-between mb-4">
                        <span class="text-gray-800 fw-semibold">
                            <?= $status ?>
                        </span>
                        <span class="fs-4 fw-bold text-primary">
                            <?= $total ?>
                        </span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    
    <div class="col-auto">
        <div class="card bg-light-success card-xl-stretch w-350px">
            <div class="card-body">

                <div class="fs-4 fw-bold text-gray-900 mb-5">
                    Sumber
                </div>

                <?php foreach ($sumber_count as $judul => $nilai): ?>
                    <div class="d-flex justify-content-between mb-4">
                        <span class="text-gray-800 fw-semibold">
                            <?= $judul ?>
                        </span>
                        <span class="fs-4 fw-bold text-primary">
                            <?= $nilai ?>
                        </span>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>
    </div> 

	<div class="col-auto">
        <div class="card bg-light-danger card-xl-stretch w-350px">
            <div class="card-body">

                <div class="fs-4 fw-bold text-gray-900 mb-5">
                    Prioritas
                </div>

                <?php foreach ($prioritas_count as $judul => $nilai): ?>
                    <div class="d-flex justify-content-between mb-4">
                        <span class="text-gray-800 fw-semibold">
                            <?= $judul ?>
                        </span>
                        <span class="fs-4 fw-bold text-primary">
                            <?= $nilai ?>
                        </span>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>
    </div>



	<div class=" mt-12  shadow-lg" style="border: 2px; padding: 20px; border-radius: 10px; background-color: rgba(229,244,250,0.06);">
		<div class="row g-3 align-items-center mt-4">
			<div class="col-6 col-md-auto">
				<label class="form-label">Tanggal:</label>
				<select id="filterSelect" class="form-select form-select-sm">
					<option value="">All</option>
					<option value="today">Today</option>
					<option value="yesterday">Yesterday</option>
					<option value="this_week">This Week</option>
					<option value="last_week">Last Week</option>
					<option value="this_month" >This Month</option>
					<option value="last_month">Last Month</option>
					<option value="this_year">This Year</option>
					<option value="last_year">Last Year</option>
					<option value="custom">Custom Range</option>
				</select>
			</div> 

            <div class="col-6 col-md-auto">
				<label class="form-label">Prioritas:</label>
				<select id="filterPriority" class="form-select form-select-sm">
					<option value="">All</option>
					<option value="Low">Low</option>
					<option value="Medium">Medium</option>
					<option value="High">High</option>
					<option value="Done">Done</option>
				</select>
			</div>

		</div>

		<div class="table-responsive mt-4">
			<table id="tracker_table" class="table table-bordered table-striped w-100">
				<thead class="table-primary">
				<tr>
					<th>Tanggal</th>
					<th>Fitur</th>
					<th>Sumber</th>
					<th>Dampak</th>
					<th>Status</th>
					<th>Prioritas</th>
					<th>Catatan</th>
					<th>Action</th>
				</tr>
				</thead>
				<tbody>

				</tbody>
			</table>
		</div>
	</div>

    <!-- Modal Add Product -->
	<div class="modal fade" tabindex="-1" id="addProduct">
		<div class="modal-dialog modal-xl">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title">Tambah Request</h3>

					<div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
						 aria-label="Close">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-2">
                                <i class="ti ti-minus"></i>
                            </span>
                        </span>
					</div>
				</div>

				<div class="modal-body">
					<form class="form w-100" id="addproduct" data-action="<?= site_url('support/Rbm_tracker/add_rbm_tracker') ?>" enctype="multipart/form-data">
					
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Fitur</span>
						</div>
						<div class="fv-row mb-8">
							<input type="text"  name="fitur" autocomplete="off" class="form-control bg-transparent" />
						</div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Prioritas</span>
						</div>
						<div class="fv-row mb-8">
							<select id="prioritas" class="form-select" aria-label="Default select example" name="prioritas">
								<option value="" selected>-Pilih prioritas-</option>
                                <option value="Low">Low</option>
                                <option value="Medium">Medium</option>
                                <option value="High">High</option>
                                <option value="Done">Done</option>
							</select>
						</div> 
                        <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Status</span>
						</div>
						<div class="fv-row mb-8">
							<select id="status" class="form-select" aria-label="Default select example" name="status">
								<option value="" selected>-Pilih status-</option>
                                <option value="Belum">Belum</option>
                                <option value="Diskusi">Diskusi</option>
                                <option value="Proses">Proses</option>
                                <option value="Selesai">Selesai</option>
							</select>
						</div> 
                        <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Dampak</span>
						</div>
						<div class="fv-row mb-8">
							<select id="dampak" class="form-select" aria-label="Default select example" name="dampak">
								<option value="" selected>-Pilih dampak-</option>
                                <option value="Rendah">Rendah</option>
                                <option value="Medium">Medium</option>
                                <option value="Tinggi">Tinggi</option>
							</select>
						</div> 
                        <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Sumber</span>
						</div>
						<div class="fv-row mb-8">
							<select id="sumber" class="form-select" aria-label="Default select example" name="sumber">
								<option value="" selected>-Pilih sumber-</option>
                                <option value="User">User</option>
                                <option value="CS">CS</option>
                                <option value="Reseller">Reseller</option> 
                                <option value="Internal">Internal</option> 
							</select>
						</div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Catatan</span>
						</div>
						<div class="fv-row mb-8">
                            <textarea type="text" placeholder="catatan" name="catatan" autocomplete="off" class="form-control bg-transparent" style="height: 200px"></textarea>
						</div>
						<div class="d-grid mb-10">
							<button type="submit" id="submit_product" class="btn btn-primary">
                                <span class="indicator-label">
                                    Tambah
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

    <!-- Modal Edit -->
	<div class="modal fade" id="editRbmTrackerModal" tabindex="-1">
		<div class="modal-dialog modal-xl">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title">Edit Request/h3>

					<div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
						 aria-label="Close" tabindex="-1" aria-labelledby="editFinanceModalLabel" aria-hidden="true">
                        <span class="svg-icon svg-icon-2">
                            <i class="ti ti-minus"></i>
                        </span>
					</div>
				</div>

				<div class="modal-body">
					<form class="form w-100" id="editRbmTrackerForm" enctype="multipart/form-data">
						<input type="hidden" name="id_rbm_tracker" id="edit_id_rbm_tracker">
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Fitur</span>
						</div>
						<div class="fv-row mb-8">
							<input type="text"  name="fitur" id="edit_fitur" autocomplete="off" class="form-control bg-transparent" />
						</div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Prioritas</span>
						</div>
						<div class="fv-row mb-8">
							<select id="edit_prioritas" class="form-select" aria-label="Default select example" name="prioritas">
								<option value="" selected>-Pilih prioritas-</option>
                                <option value="Low">Low</option>
                                <option value="Medium">Medium</option>
                                <option value="High">High</option>
                                <option value="Done">Done</option>
							</select>
						</div> 
                        <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Status</span>
						</div>
						<div class="fv-row mb-8">
							<select id="edit_status" class="form-select" aria-label="Default select example" name="status">
								<option value="" selected>-Pilih status-</option>
                                <option value="Belum">Belum</option>
                                <option value="Diskusi">Diskusi</option>
                                <option value="Proses">Proses</option>
                                <option value="Selesai">Selesai</option>
							</select>
						</div> 
                        <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Dampak</span>
						</div>
						<div class="fv-row mb-8">
							<select id="edit_dampak" class="form-select" aria-label="Default select example" name="dampak">
								<option value="" selected>-Pilih dampak-</option>
                                <option value="Rendah">Rendah</option>
                                <option value="Medium">Medium</option>
                                <option value="Tinggi">Tinggi</option>
							</select>
						</div> 
                        <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Sumber</span>
						</div>
						<div class="fv-row mb-8">
							<select id="edit_sumber" class="form-select" aria-label="Default select example" name="sumber">
								<option value="" selected>-Pilih sumber-</option>
                                <option value="User">User</option>
                                <option value="CS">CS</option>
                                <option value="Reseller">Reseller</option> 
                                <option value="Internal">Internal</option> 
							</select>
						</div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Catatan</span>
						</div>
						<div class="fv-row mb-8">
                            <textarea type="text" id="edit_catatan" placeholder="catatan" name="catatan" autocomplete="off" class="form-control bg-transparent" style="height: 200px"></textarea>
						</div>
						<div class="d-grid mb-10 mt-10">
							<button type="submit" class="btn btn-primary"><span class="indicator-label">
                                    Save Changes
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


	<!-- Modal untuk Custom Date -->
	<div id="customDateModal" class="modal" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Select Date Range</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>
				<div class="modal-body">
					<form id="customDateForm">
						<div class="mb-3">
							<label for="startDate" class="form-label">Start Date</label>
							<input type="date" id="startDate" name="start_date" class="form-control">
						</div>
						<div class="mb-3">
							<label for="endDate" class="form-label">End Date</label>
							<input type="date" id="endDate" name="end_date" class="form-control">
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" id="applyCustomDate">Apply</button>
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
				</div>
			</div>
		</div>
	</div> 

    <!-- Modal Ubah Status -->
    <div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="statusModalLabel">
                        <i class="bi bi-arrow-repeat me-2"></i>
                        Ubah Status
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formUbahStatus" action="<?= base_url('support/Rbm_tracker/ubah_status') ?>" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="id_rbm_tracker" id="modal_id_pengaduan">
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Fitur</label>
                            <p id="modal_judul" class="text-gray-800 bg-light p-3 rounded"></p>
                        </div>
                        
                        <div class="mb-3">
                            <label for="status_progress_tracker" class="form-label fw-bold">
                                <i class="bi bi-tag me-1"></i> Pilih Status Baru
                            </label>
                            <select class="form-select form-select-lg" name="status_progress" id="status_progress_tracker" required>
                                <option value="">-- Pilih Status --</option>
                                <option value="Belum" class="text-warning">
                                    <i class="bi bi-clock-history me-2"></i> Belum
                                </option>
                                <option value="Diskusi" class="text-primary">
                                    <i class="bi bi-arrow-repeat me-2"></i> Diskusi
                                </option>
                                <option value="Proses" class="text-success">
                                    <i class="bi bi-check2-circle me-2"></i> Proses
                                </option>
                                <option value="Selesai" class="text-danger">
                                    <i class="bi bi-x-circle me-2"></i> Selesai
                                </option>
                            </select>
                        </div>
                        
                    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                            <i class="bi bi-x-lg me-1"></i> Batal
                        </button>
                        <button type="submit" class="btn btn-warning" id="btnSimpanStatus">
                            <i class="bi bi-check-lg me-1"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


	<script>
		let base = '<?= base_url()?>';
		const base_url = $('meta[name="base_url"]').attr('content');

		let table;
		let option = '';
		let startDate = '';
		let endDate = '';
		let priority = '';

		//-----------------------DATATABLE
		//--------TEST FILTER

		function callDT() {
			table = $('#tracker_table').DataTable({
				responsive: false,
				autoWidth: false,
				processing: true,
				serverSide: true,
				order: [],
				ajax: {
					url: base + 'support/Rbm_tracker/dtSideServer',
					type: "POST",
					data: function (d) {
						d.option = option;
						d.startDate = startDate;
						d.endDate = endDate;
						d.prioritas = priority;
					},
				},
				dom: '<"d-flex justify-content-between mb-3"<"length-menu"l><"search-box"f>>rtip',
				columnDefs: [
					{ targets: "_all", orderable: false },
					{ targets: 0, className: "text-start" },
				],
			});
		}

		callDT();

		// ---------- FILTER DATE
		$('#filterSelect').on('change', function() {
			option = $(this).val();

			if (option === 'custom') {
				$('#customDateModal').modal('show');
			} else {
				table.ajax.reload();

			}


		}); 


		$('#applyCustomDate').on('click', function() {
			startDate = $('#startDate').val();
			endDate = $('#endDate').val();

			if (!startDate || !endDate) {
				Swal.fire({
					icon: "error",
					title: "Error",
					text: "Masukan tanggal dengan benar"
				});
				return;
			}

			$('#customDateModal').modal('hide');
			option = 'custom';
			table.ajax.reload();
			updateCards(option, startDate, endDate);
		}); 


        $('#filterPriority').on('change', function() {
			priority = $(this).val();
            table.ajax.reload();
		});


        $(document).ready(function() {
            // Ketika tombol ubah status diklik
            $('.btn-change-status').on('click', function() {
                var id = $(this).data('id');
                var status = $(this).data('status');
                var judul = $(this).data('judul');
                
                // Set data ke modal
                $('#modal_id_pengaduan').val(id);
                $('#modal_judul').text(judul);
                $('#status_progress_tracker').val(status);
            });
            
            // Handle form submit dengan AJAX
            $('#formUbahStatus').on('submit', function(e) {
                e.preventDefault();
                
                var form = $(this);
                var url = form.attr('action');
                var data = form.serialize();
                var btnSubmit = $('#btnSimpanStatus');
                var originalText = btnSubmit.html();
                
                // Disable button dan tampilkan loading
                btnSubmit.prop('disabled', true);
                btnSubmit.html('<span class="spinner-border spinner-border-sm me-1"></span> Menyimpan...');
                
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: data,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            // Tutup modal
                            $('#statusModal').modal('hide');
                            
                            // Tampilkan notifikasi sukses
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: response.message,
                                timer: 2000,
                                showConfirmButton: false
                            });
                            
                            // Reload DataTable
                            table.ajax.reload(null, false);
                            
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: response.message
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Terjadi kesalahan pada server. Silakan coba lagi.'
                        });
                    },
                    complete: function() {
                        // Kembalikan button ke kondisi normal
                        btnSubmit.prop('disabled', false);
                        btnSubmit.html(originalText);
                    }
                });
            });
            
            // Reset form ketika modal ditutup
            $('#statusModal').on('hidden.bs.modal', function() {
                $('#formUbahStatus')[0].reset();
                $('#modal_judul').text('');
            });
        }); 


        function editRbmTracker(element) {
			let $element = $(element);

			$("#edit_id_rbm_tracker").val($element.data('id_rbm_tracker'));
			$("#edit_sumber").val($element.data('sumber'));
			$("#edit_fitur").val($element.data('fitur'));
			$("#edit_prioritas").val($element.data('prioritas'));
			$("#edit_dampak").val($element.data('dampak'));
			$("#edit_catatan").val($element.data('catatan'));
			$("#edit_status").val($element.data('status'));



			//console.log($element.data('mulai_posting'));
			$("#editRbmTrackerModal").modal("show");
		}


		$(document).ready(function() {

			$("#editRbmTrackerForm").on("submit", function(e) {
				e.preventDefault();
				$.ajax({
					url: base_url + "support/Rbm_tracker/update",
					type: "POST",
					data: $(this).serialize(),
					dataType: "json",
					success: function(response) {
						if (response.status) {
							Swal.fire({
								icon: "success",
								title: "Berhasil",
								text: response.message,
								timer: 1500,
								showConfirmButton: false
							}).then(() => location.reload());
						} else {
							Swal.fire({
								icon: "error",
								title: "Gagal",
								text: response.message
							});
						}
					},
					error: function(xhr, status, error) {
						Swal.fire({
							icon: "error",
							title: "Error",
							text: "Terjadi kesalahan, silahkan coba lagi."
						});
					}
				});
			});
		}); 

        function handleDeleteRbmTrackerButton(id) {
			console.log(id)
			Swal.fire({
				title: 'Apakah Anda yakin?',
				text: "Data yang dihapus tidak dapat dikembalikan!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#d33',
				cancelButtonColor: '#3085d6',
				confirmButtonText: 'Ya, Hapus',
				cancelButtonText: 'Batal',
			}).then((result) => {
				if (result.isConfirmed) {
			
					$.ajax({
						url: base_url + 'support/Rbm_tracker/delete',
						type: 'POST',
						data: {
							id: id
						},
						success: function(response) {
							var res = JSON.parse(response);
							if (res.status) {
								swallMssg_s(res.message, false, 1500)
									.then(() => {
										location.reload();
									});
							} else {
								swallMssg_e(res.message, true, 0);
							}
						},
						error: function(xhr, status, error) {
							Swal.fire(
								'Kesalahan!',
								'Terjadi kesalahan: Silakan coba lagi.',
								'error'
							);
						},
					});
				}
			});
		}


	</script>

</main>
