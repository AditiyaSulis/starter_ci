
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script> 


<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>


<style>
	/* Select2 custom style biar mirip Bootstrap 5 */
	.select2-container .select2-selection--single {
		height: calc(2.5rem + 10px); /* Tinggi seperti form-control */
		padding: 0.375rem 0.75rem;
		font-size: 1rem;
		line-height: 1.5;
		color: #212529;
		background-color: #fff;
		border: 1px solid #ced4da;
		border-radius: 0.375rem;
	}

	.select2-container--default .select2-selection--single .select2-selection__rendered {
		color: #212529;
		line-height: 2.4rem;
	}

	.select2-container--default .select2-selection--single .select2-selection__arrow {
		height: 100%;
		right: 10px;
	}

    .gradient-btn-edit-admin {
        background: linear-gradient(to right,rgb(180, 197, 22), rgb(239, 63, 251));
        border: none;
        color: white;
    }

    .gradient-btn-edit-admin:hover {
        background: linear-gradient(to right,rgb(161, 24, 147),rgb(183, 97, 174));
    }

    .gradient-btn-delete-admin {
        background: linear-gradient(to right,rgb(97, 6, 6),rgb(244, 49, 221));
        border: none;
        color: white;
    }

    .gradient-btn-delete-admin:hover {
        background: linear-gradient(to right,rgb(244, 49, 221),rgb(97, 6, 6));
    }


    .gradient-btn-add-admin {
        background: linear-gradient(to right,rgb(23, 14, 205), rgb(251, 66, 186));
        border: none;
        color: white;
    }

    .gradient-btn-add-admin:hover {
        background: linear-gradient(to right,rgb(251, 66, 186),rgb(110, 103, 232));
    } 

    .gradient-btn-clear-admin {
        background: linear-gradient(to right,rgb(139, 4, 212), rgb(251, 66, 186));
        border: none;
        color: white;
    }

    .gradient-btn-clear-admin:hover {
        background: linear-gradient(to right,rgb(251, 66, 186),rgb(189, 101, 237));
    }

	.limited-width {
		max-width: 200px; /* ubah sesuai kebutuhan */
		white-space: normal !important;
		word-wrap: break-word;
		word-break: break-word;
	}
</style>

<main>
	<h1>Kas</h1>


    <div class="row g-4 mb-5 row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-5 mt-3" id="card-container1">
        <?php foreach ($categories as $category): ?>
        <div class="col">
            <div class="card bg-body ">
                 <div class="card-body py-4 ">
                    <div class="text-gray-900 fw-bolder fs-2">
                        <span class="text-success" data-category-id="<?= $category['id_kategori'] ?>">
                            Rp.<?= isset($category['total_amount']) ? number_format($category['total_amount'], 0, ',', '.') : '0' ?>
                        </span>
                    </div>
                    <div class="fw-bold text-gray-800">
                        Total <?= $category['name_kategori'] ?></div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!--begin::Accordion-->
    <div class="accordion" id="kt_accordion_1">
        <div class="accordion-item">
            <h2 class="accordion-header" id="kt_accordion_1_header_1">
                <button class="accordion-button fs-4 fw-semibold collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#kt_accordion_1_body_1" aria-expanded="false" aria-controls="kt_accordion_1_body_1">
                    <span class="fw-bolder">Ringkasan Penghasilan dan Pengeluaran Tiap Produk</span>
                </button>
            </h2>
            <div id="kt_accordion_1_body_1" class="accordion-collapse collapse"
                aria-labelledby="kt_accordion_1_header_1" data-bs-parent="#kt_accordion_1">
                <div class="accordion-body">
                    <div class="row g-4 row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-5" id="cardContainer1">
                        <?php foreach ($products as $product): ?>
                        <div class="col">
                            <div class="card card-flush h-lg-100 ">
                                <div class="card-header px-5 mb-0" style="min-height:55px !important">
                                    <h3 class="card-title align-items-start flex-column mb-0">
                                        <p class="fw-bold mb-0 text-primary"><?= $product['name_product'] ?></p>
                                    </h3>
                                </div>
                                <div class="card-body px-5 pb-4 pt-0">
                                    <?php foreach ($categories as $category): ?>
                                    <div class="d-flex flex-stack">
                                        <div class="text-gray-700 fw-semibold fs-6 me-2">
                                            <?= $category['name_kategori'] ?>:</div>
                                        <div class="d-flex align-items-senter">
                                            <span class=" fw-bold fs-6 text-success"
                                                data-product-id="<?= $product['id_product'] ?>"
                                                data-category-id="<?= $category['id_kategori'] ?>">Rp.<?= number_format(0, 0, ',', '.') ?>
                                            </span>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

	<button type="button" class="btn gradient-btn-add-admin rounded-pill mt-10" data-bs-toggle="modal" data-bs-target="#addFinanceModal">
		<i class="bi bi-plus-circle"></i>
		Tambah Kas
	</button>

	<div class=" mt-12  shadow-lg" style="border: 2px; padding: 20px; border-radius: 10px; background-color: rgba(229,244,250,0.06);">
		<div class="row g-3 align-items-center mt-4">
			<div class="col-12 col-md-auto">
				<label class="form-label">Date:</label>
				<select id="filterSelect" class="form-select form-select-sm">
					<option value="today">Today</option>
					<option value="yesterday">Yesterday</option>
					<option value="this_week">This Week</option>
					<option value="last_week">Last Week</option>
					<option value="this_month" selected>This Month</option>
					<option value="last_month">Last Month</option>
					<option value="this_year">This Year</option>
					<option value="last_year">Last Year</option>
					<option value="custom">Custom Range</option>
				</select>
			</div>

			<div class="col-12 col-md-auto">
				<label class="form-label">Product:</label>
				<select id="filterProduct" class="form-select form-select-sm">
					<option value="" selected>-</option>
					<?php foreach($products as $product): ?>
					<option value="<?= $product['id_product'] ?>"><?= $product['name_product'] ?></option>
					<?php endforeach; ?>
				</select>
			</div>

			<div class="col-12 col-md-auto">
				<label class="form-label">Type:</label>
				<select id="filterCategory" class="form-select form-select-sm">
					<option value="" selected>-</option>
					<option value="1">Penghasilan</option>
					<option value="2">Pengeluaran</option>
				</select>
			</div>

			<div class="col-12 col-md-auto">
				<label class="form-label">Code:</label>
				<select id="filterCode" class="form-select form-select-sm">
					<option value="" selected>-</option>
				</select>
			</div>

			<div class="col-12 col-md-auto mt-8">
				<button id="clearFilter" type="button" class="btn gradient-btn-clear-admin btn-sm rounded-pill mt-3">
					<i class="ti ti-reload"></i> Clear Filter
				</button>
			</div>
			<div id="custom-button-container" class="col-12 col-md-auto mt-8">
				<button id="exportPDF" type="button" class="btn btn-info btn-sm rounded-pill mt-3">
					<i class="ti ti-download"></i> Export to PDF
				</button>
			</div>

		</div>

		<div class="table-responsive mt-4">
			<table id="kas_table" class="table table-bordered table-striped w-100">
				<thead class="table-primary">
					<tr>
						<th class="no-print">Kode</th>
						<th>Tanggal</th>
						<th>Kode</th>
						<th>Produk</th>
						<th>Keterangan</th>
						<th>Penghasilan</th>
						<th>Pengeluaran</th>
						<th>Catatan</th>
						<th class="no-print">Action</th>
					</tr>
				</thead>
				<tbody>

				</tbody>
			</table>
		</div>
	</div>
	
	
	<!-- Modal  Kas -->
	<div class="modal fade" tabindex="-1" id="addFinanceModal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title"> Tambah Kas</h3>
					<div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
							<span class="menu-icon">
								<span class="svg-icon svg-icon-2">
									<i class="ti ti-minus"></i>
								</span>
							</span>
					</div>
				</div>

				
				<div class="modal-body">
					<form class="form w-100" id="addFinanceForm" data-action="<?= site_url('admin/Cashflow/add_cashflow') ?>" enctype="multipart/form-data">
						
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Tanggal Input</span>
						</div>
						<div class="fv-row mb-8">
							<input type="date" value="<?= date('Y-m-d') ?>" name="tgl_cash_flow" autocomplete="off" class="form-control bg-transparent" />
						</div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                            <span>Type</span>
                        </div>
                        <div class="fv-row mb-8">
                            <select id="categories" class="form-select" aria-label="Default select example"
                                name="type_record">
                                <option selected>-Pilih Type-</option>
                                <option value="1">Penghasilan</option>
                                <option value="2">Pengeluaran</option>
                            </select>
                        </div>
						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Account</span>
						</div>
						<div class="fv-row mb-8">
							<div class="input-group">
								<select class="form-control bg-transparent" id="account" name="id_code">
									<option selected>-Pilih Account-</option>
								</select>
							</div>
						</div>

						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Product</span>
						</div>
						<div class="fv-row mb-8">
							<select class="form-select" aria-label="Default select example" name="id_product" id="id_product">
								<option selected>-pilih product-</option>
								<?php foreach($products as $product):?>
									<option value="<?=$product['id_product'];?>"><?=$product['name_product'];?></option>
								<?php endforeach;?>
							</select>
						</div>

						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Jumlah</span>
						</div>
						<div class="fv-row mb-8">
							<input type="text" name="jumlah" value="0" autocomplete="off" class="form-control bg-transparent" oninput="rupiahCurrency(this)" />
						</div>

						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Deskripsi</span>
						</div>
						<div class="fv-row mb-8">
							<textarea type="text" class="form-control" id="description" name="description"></textarea>
						</div>

                        <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Catatan</span>
						</div>
						<div class="fv-row mb-8">
							<textarea type="text" class="form-control" id="catatan" name="catatan"></textarea>
						</div>

						<div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
							<span>Finance Record</span>
						</div>
						<div class="fv-row mb-8">
							<select class="form-select" aria-label="Default select example" name="auto_finance_record" id="finance_record">
									<option value="1" selected>Auto Insert</option>
									<option value="2">Manual Insert</option>
							</select>
						</div>
						<div class="d-grid mb-10">
							<button type="submit" id="submit_finance" class="btn btn-primary">
								<span class="indicator-label">Insert Kas</span>
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


	<script>
		let base = '<?= base_url()?>';
		const base_url = $('meta[name="base_url"]').attr('content');
		let table;
        let option = 'this_month';
        let startDate = '';
        let endDate = '';

        let product = '';
        let code = '';
        let type = '';

        let accVAL = '';
        let accID = '';


        //MENAMPILKAN DATA KE CARD
        function updateCards(filter, startdate, enddate) {
            $.ajax({
                url: base_url + 'admin/Cashflow/getFilteredSummary',
                type: 'POST',
                data: {
                    option: filter,
                    startDate: startdate,
                    endDate: enddate
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status) {

                        $('#card-container1 span').text('Rp.0');

                        response.categories.forEach(category => {
                            const span = $(`[data-category-id="${category.id_kategori}"]`);
                            if (span.length) {
                                span.text(`Rp.${(category.total_amount || 0).toLocaleString('id-ID')}`);
                            }
                        });

                        $('#cardContainer1 span').text('Rp.0');

                        // Perbarui produk untuk setiap kategori
                        response.products.forEach(product => {
                            const span = $(
                                `[data-product-id="${product.id_product}"][data-category-id="${product.id_kategori}"]`
                            );
                            if (span.length) {
                                span.text(`Rp.${(product.total_amount || 0).toLocaleString('id-ID')}`);
                            }
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', error, 'XHR:', xhr);
                }
            });
        }

        //INISIALISASI NILAI AWAL CARD
        updateCards('this_month', null, null);

        ///DELETE 
         function handleDeleteKasButton(id) {
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
                    const base_url = $('meta[name="base_url"]').attr('content');
                    $.ajax({
                        url: base_url + 'admin/Cashflow/delete',
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

        //END DELETE

		$(document).ready(function() {
			$('#categories').on('change', function() {
				const categoryId = $(this).val();
				const accountSelect = $('#account');
				accID = 'account';
				accVAL = '';


				accountSelect.html('<option value="" selected disabled>-select account-</option>');

				if (categoryId) {
					getAccount(categoryId)

				}
			});
		});
		 //KATEGORY TO ACCOUNT
		 function getAccount(categoryId) {
            $.ajax({
                url: base + 'admin/finance_record/option_acc',
                type: 'POST',
                data: {
                    category_id: categoryId
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status) {
                        const accountSelect = $('#' + accID);
                        $.each(response.data, function(index, account) {
                            const selected = accVAL == account.id_code ? 'selected' : '';
                            accountSelect.append(
                                `<option value="${account.id_code}" ${selected}>${account.code} - ${account.name_code}</option>`
                            );

                        });
                    } else {
                        console.log('gagal');
                    }

                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        } 

		 // ---------- FILTER DATE
		 $('#filterSelect').on('change', function() {
            option = $(this).val();

            if (option === 'custom') {
                $('#customDateModal').modal('show');
            } else {
                table.ajax.reload();

                updateCards(option)
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


        // --------- FILTER CATEGORY
        $('#filterCategory').on('change', function() {
            type = $(this).val();
            const accountSelect = $('#filterCode');
            accID = 'filterCode';
            accVAL = '';

            if (type) {
                accountSelect.html('<option value="" selected>-</option>');
                getAccount(type)

            }

            if (type == "") {
                accountSelect.html('<option value="" selected>-</option>');
            }
            table.ajax.reload();
        });


		function callDT() {
            table = $('#kas_table').DataTable({
                responsive: false,
                autoWidth: false,
                processing: true,
                serverSide: true,
				lengthMenu: [[10, 25, 50, 100, -1], [10, 25,50,100, 'All']],
                order: [],
                ajax: {
                    url: base + 'admin/Cashflow/dtSideServer',
                    type: "POST",
                    data: function (d) {
                        d.option = option;
                        d.startDate = startDate;
                        d.endDate = endDate;
                        d.product = product;
                        d.code = code;
                        d.type = type;
                    },
                },
                dom: '<"d-flex justify-content-between mb-3"<"length-menu"l><"search-box"f>>rtip',
                buttons: [
                    {
                        extend: 'pdfHtml5',
                        text: 'Export',
                        title: 'Kas Kecil',
                        className: 'd-none',
                        exportOptions: {
                            columns: ':not(.no-print)',
                        },
                        customize: function (doc) {
                            doc.styles.tableHeader.fontSize = 8;
                            doc.styles.tableBodyOdd.fontSize = 8;
                            doc.styles.tableBodyEven.fontSize = 8;
                            doc.content[1].margin = [10, 15, 10, 10];

                            // Format tabel dengan garis
                            doc.content[1].layout = {
								hLineWidth: function(i, node) { return 0.8; },
								vLineWidth: function(i, node) { return 0.8; },
								hLineColor: function(i, node) { return '#000000'; },
								vLineColor: function(i, node) { return '#000000'; },
								paddingTop: function(i, node) { return 6; },
								paddingBottom: function(i, node) { return 6; }
							};
							if (doc.content[1].table) {
								doc.content[1].table.widths = ['11%', '13%', '15%', '20%', '13%', '13%', '20%']; // Contoh: kolom ke-4 (index 3) 20%
							}

                            // Tambahkan periode
                            let currentDate = new Date();
                            const formatDate = (date) => new Intl.DateTimeFormat('id-ID', {
                                day: '2-digit',
                                month: 'long',
                                year: 'numeric'
                            }).format(date);

                            let end = new Date();
                            let start = new Date();
                            let titleDate = '';

                            switch (option) {
                                case 'this_month':
                                    start = new Date();
                                    end = new Date();
                                    start.setMonth(start.getMonth() - 1);
                                    titleDate = `${formatDate(start)} - ${formatDate(end)}`;
                                    break;
                                case 'last_month':
                                    end = new Date();
                                    end.setMonth(end.getMonth() - 1);
                                    start = new Date(end);
                                    start.setMonth(end.getMonth() - 1);
                                    titleDate = `${formatDate(start)} - ${formatDate(end)}`;
                                    break;
                                case 'this_year':
                                    start = new Date(end.getFullYear(), 0, 1);
                                    titleDate = `${formatDate(start)} - ${formatDate(end)}`;
                                    break;
                                case 'last_year':
                                    const lastYear = end.getFullYear() - 1;
                                    start = new Date(lastYear, 0, 1);
                                    end = new Date(lastYear, 11, 31);
                                    titleDate = `${formatDate(start)} - ${formatDate(end)}`;
                                    break;
                                case 'today':
                                    titleDate = formatDate(end);
                                    break;
                                case 'yesterday':
                                    end.setDate(end.getDate() - 1);
                                    titleDate = formatDate(end);
                                    break;
                                case 'this_week':
                                    start = new Date(end);
                                    start.setDate(end.getDate() - end.getDay() + 1);
                                    titleDate = `${formatDate(start)} - ${formatDate(end)}`;
                                    break;
                                case 'last_week':
                                    end.setDate(end.getDate() - 7);
                                    start = new Date(end);
                                    start.setDate(end.getDate() - end.getDay() + 1);
                                    titleDate = `${formatDate(start)} - ${formatDate(end)}`;
                                    break;
                                case 'custom':
                                    if (startDate && endDate) {
                                        titleDate = `${startDate} - ${endDate}`;
                                    } else {
                                        titleDate = 'Rentang tidak ditentukan';
                                    }
                                    break;
                                default:
                                    titleDate = 'Periode Tidak Dikenal';
                            }

                            doc.content.unshift({
                                text: 'Periode : ' + titleDate,
                                alignment: 'right',
                                margin: [0, 0, 10, 20],
                                style: 'subheader',
                            });

                            // Mulai ambil data untuk Ringkasan Kas
                            var totalsByProduct = {};

                            table.rows({ page: 'current' }).data().each(function (row) {
                                var product = row[3];
                                var income = parseFloat(row[5].replace(/[^0-9,-]+/g, '').replace(',', '')) || 0;
                                var expense = parseFloat(row[6].replace(/[^0-9,-]+/g, '').replace(',', '')) || 0;

                                if (!totalsByProduct[product]) {
                                    totalsByProduct[product] = { income: 0, expense: 0 };
                                }
                                totalsByProduct[product].income += income;
                                totalsByProduct[product].expense += expense;
                            });

                            var totalAmountTable = [
                                [
                                    { text: 'Product', style: 'tableHeader', alignment: 'left', fontSize: 10 },
                                    { text: 'Total Penghasilan', style: 'tableHeader', alignment: 'center', fontSize: 10 },
                                    { text: 'Total Pengeluaran', style: 'tableHeader', alignment: 'center', fontSize: 10 },
                                    { text: 'Net Total', style: 'tableHeader', alignment: 'center', fontSize: 10 }
                                ]
                            ];

                            var grandIncome = 0;
                            var grandExpense = 0;

                            Object.keys(totalsByProduct).forEach(function (product) {
                                var income = totalsByProduct[product].income;
                                var expense = totalsByProduct[product].expense;
                                var netTotal = income - expense;

                                grandIncome += income;
                                grandExpense += expense;

                                totalAmountTable.push([
                                    { text: product, fontSize: 9, alignment: 'left' },
                                    { text: 'Rp. ' + income.toLocaleString('id-ID'), fontSize: 9, color: 'green', alignment: 'right' },
                                    { text: 'Rp. ' + expense.toLocaleString('id-ID'), fontSize: 9, color: 'red', alignment: 'right' },
                                    { text: 'Rp. ' + netTotal.toLocaleString('id-ID'), fontSize: 9, alignment: 'right' }
                                ]);
                            });

                            totalAmountTable.push([
                                { text: 'Grand Total', style: 'tableHeader', alignment: 'left', fontSize: 10 },
                                { text: 'Rp. ' + grandIncome.toLocaleString('id-ID'), style: 'tableHeader', fontSize: 9, alignment: 'right' },
                                { text: 'Rp. ' + grandExpense.toLocaleString('id-ID'), style: 'tableHeader', fontSize: 9, alignment: 'right' },
                                { text: 'Rp. ' + (grandIncome - grandExpense).toLocaleString('id-ID'), style: 'tableHeader', fontSize: 9, alignment: 'right' }
                            ]);

                            // Tambahkan tabel ringkasan
                            doc.content.push({
                                text: 'Ringkasan Kas Per Product',
                                style: 'header',
                                margin: [10, 20, 0, 10]
                            });

                            doc.content.push({
                                table: {
                                    headerRows: 1,
                                    widths: ['30%', '20%', '20%', '20%'],
                                    body: totalAmountTable
                                },
                                layout: 'lightHorizontalLines',
                                margin: [10, 5, 0, 10]
                            });

                            // Tambahkan tanda tangan
                            doc.content.push({
                                columns: [
                                    { width: '50%', text: '\n\n\nDisetujui oleh,\nPimpinan', alignment: 'center', margin: [0, 40, 0, 0] },
                                    { width: '50%', text: '\n\n\nDibuat oleh,\nBagian Keuangan', alignment: 'center', margin: [0, 40, 0, 0] }
                                ]
                            });

                            doc.content.push({
                                columns: [
                                    { width: '50%', text: '\n\n( Ari Hermawan )', alignment: 'center', margin: [0, 60, 0, 0] },
                                    { width: '50%', text: '\n\n( Amelia Gita Rahayu )', alignment: 'center', margin: [0, 60, 0, 0] }
                                ]
                            });
                        }
                    },
                ],
                initComplete: function () {
                    table.buttons().container().appendTo('#custom-button-container');
                },
                columnDefs: [
                    { targets: "_all", orderable: false },
                    { targets: 0, className: "text-start" },
                    { targets: 4, className: "limited-width" },
                    { targets: 7, className: "limited-width" },
                ],
            });
        }

        callDT();

		
        //------------ FILTER PRODUCT
        $('#filterProduct').on('change', function() {
            product = $(this).val();
            table.ajax.reload();
        });


        //------------ FILTER CODE
        $('#filterCode').on('change', function() {
            code = $(this).val();
            table.ajax.reload();
        });


        //------------ CLEAR FILTER
        $('#clearFilter').on('click', function() {
            code = "";
            type = "";
            product = "";
            option = "this_month";
            startDate = "";
            endDate = "";

            $('#filterSelect').val('this_month');
            $('#filterProduct').val('');
            $('#filterCategory').val('');
            $('#filterCode').html('<option value="" selected>-</option>');
           
            table.ajax.reload();
            updateCards(option)
        });


        //EVENT LISTENER tombol export PDF DataTables
        $('#exportPDF').on('click', function () {
            table.button('.buttons-pdf').trigger(); 
        });


		

		//convert currency
		function rupiahCurrency(input) {
			let value = input.value.replace(/[^0-9]/g, ""); // Hanya angka
			if (value === "") {
				input.value = "";
				return;
			}

			let formatted = new Intl.NumberFormat("id-ID").format(value);
			input.value = formatted;
		}


        $('#account').select2({
			placeholder: "-pilih code-",
			allowClear: true,
			width: '100%',
			dropdownParent: $('#addFinanceForm') // atau parent lain yang sesuai
		}); 
 

        //add
        $(document).ready(function () {
            $("#addFinanceForm").on("submit", function (e) {
                e.preventDefault();

                let input = document.querySelector("input[name='jumlah']");
                if (input.value !== "") {
                    input.value = input.value.replace(/\./g, ""); // Hapus semua titik sebelum submit
                }

                var formElement = this;
                var formData = new FormData(formElement);

                $("#submit_finance").prop("disabled", true);
                $("#submit_finance .indicator-label").hide();
                $("#submit_finance .indicator-progress").show();

                $.ajax({
                    url: $(formElement).data("action"),
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    success: function (response) {
                        $("#submit_finance").prop("disabled", false);
                        $("#submit_finance .indicator-label").show();
                        $("#submit_finance .indicator-progress").hide();

                        if (response.status) {
                            swallMssg_s(response.message, false, 1500)
                                .then(() =>  {
                                    location.reload();
                                });
                        } else {
                            swallMssg_e(response.message, true, 0);
                        }
                    },
                    error: function (xhr) {
                        $("#submit_finance").prop("disabled", false);
                        $("#submit_finance .indicator-label").show();
                        $("#submit_finance .indicator-progress").hide();

                        swallMssg_e('Terjadi kesalahan: ', true, 0)
                            .then(() => {
                                location.reload();
                            });
                    },
                });
            });
        });

        
	</script>
</main>
