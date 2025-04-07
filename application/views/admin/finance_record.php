<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>

<main>
    <h1 class="mb-4">Finance Record</h1>

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
                    <span class="fw-bolder">Summary Total Amount By Category</span>
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

    <div class="d-flex justify-content-between flex-wrap mt-5">
        <button type="button" class="btn  rounded-pill btn-flex gradient-btn mt-3" data-bs-toggle="modal"
            data-bs-target="#addProduct">
            <i class="bi bi-plus-circle"></i> Add Finance Record
        </button>
    </div>

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
					<?php foreach($categories as $ct): ?>
					<option value="<?= $ct['id_kategori'] ?>"><?= $ct['name_kategori']?></option>
					<?php endforeach; ?>
				</select>
			</div>

			<div class="col-12 col-md-auto">
				<label class="form-label">Code:</label>
				<select id="filterCode" class="form-select form-select-sm">
					<option value="" selected>-</option>
				</select>
			</div>

			<div class="col-12 col-md-auto mt-8">
				<button id="clearFilter" type="button" class="btn btn-info btn-sm rounded-pill mt-3">
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
			<table id="finances_table" class="table table-bordered table-striped w-100">
				<thead class="table-primary">
					<tr>
						<th class="no-print">Created At</th>
						<th>Record Date</th>
						<th>Type</th>
						<th>Product</th>
						<th>Amount</th>
						<th>Code</th>
						<th>Description</th>
						<th class="no-print">Action</th>
					</tr>
				</thead>
				<tbody>

				</tbody>
			</table>
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

    <!-- Modal Add Product -->
    <div class="modal fade" tabindex="-1" id="addProduct">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Add Finance</h3>

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
                    <form class="form w-100" id="addproduct"
                        data-action="<?= site_url('admin/finance_record/add_finance') ?>" enctype="multipart/form-data">
                        <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                            <span>Record Date</span>
                        </div>
                        <div class="fv-row mb-8">
                            <input type="datetime-local" value="<?= date('Y-m-d H:i') ?>" name="record_date"
                                autocomplete="off" class="form-control bg-transparent" />
                        </div>
                        <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                            <span>Type</span>
                        </div>
                        <div class="fv-row mb-8">
                            <select id="categories" class="form-select" aria-label="Default select example"
                                name="type_record">
                                <option selected>-Pilih Type-</option>
                                <?php foreach ($categories as $ctg): ?>
                                <option value="<?= $ctg['id_kategori'] ?>"><?= $ctg['name_kategori'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                            <span>Product</span>
                        </div>
                        <div class="fv-row mb-8">
                            <select class="form-select" aria-label="Default select example" name="product_id">
                                <option selected>Pilih Product</option>
                                <?php foreach($products_show as $product): ?>
                                <option value="<?= $product['id_product'] ?>"><?= $product['name_product'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                            <span>Amount</span>
                        </div>
                        <div class="fv-row mb-8">
                            <input type="text" placeholder="Amount" name="amount" autocomplete="off"
                                class="form-control bg-transparent" oninput="rupiahCurrency(this)" />
                        </div>
                        <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                            <span>Code</span>
                        </div>
                        <div class="fv-row mb-8">
                            <select class="form-select" id="account" aria-label="Default select example" name="id_code">
                                <option selected>-Pilih Code-</option>

                            </select>
                        </div>
                        <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                            <span>Description</span>
                        </div>
                        <div class="fv-row mb-8">
                            <textarea type="text" placeholder="Description" name="description" autocomplete="off"
                                class="form-control bg-transparent"></textarea>
                        </div>
                        <div class="d-grid mb-10">
                            <button type="submit" id="submit_product" class="btn btn-primary">
                                <span class="indicator-label">
                                    Add finance
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
    <div class="modal fade" id="editfinanceModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Edit Finance</h3>

                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close" tabindex="-1" aria-labelledby="editFinanceModalLabel" aria-hidden="true">
                        <span class="svg-icon svg-icon-2">
                            <i class="ti ti-minus"></i>
                        </span>
                    </div>
                </div>

                <div class="modal-body">
                    <form class="form w-100" id="editfinanceForm" enctype="multipart/form-data">
                        <input type="hidden" name="id_record" id="id_record">
                        <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                            <span>Record Date</span>
                        </div>
                        <div class="fv-row mb-8">
                            <input type="datetime-local" id ="record_date" name="record_date"
                                autocomplete="off" class="form-control bg-transparent" />
                        </div>
                        <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                            <span>Type</span>
                        </div>
                        <div class="fv-row mb-8">
                            <select class="form-select" aria-label="Default select example" id="kategori"
                                name="type_record">
                                <?php foreach($categories as $ct): ?>
                                <option value="<?= $ct['id_kategori'] ?>"><?= $ct['name_kategori']?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                            <span>Product</span>
                        </div>
                        <div class="fv-row mb-8">
                            <select class="form-select" aria-label="Default select example" id="product_id"
                                name="product_id">
                                <?php foreach($products as $product): ?>
                                <option value="<?= $product['id_product'] ?>"><?= $product['name_product'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                            <span>Amount</span>
                        </div>
                        <div class="fv-row mb-8">
                            <input type="text" placeholder="Amount" id="amount" name="amount" autocomplete="off"
                                class="form-control bg-transparent" oninput="rupiahCurrency(this)" />
                        </div>
                        <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                            <span>Code</span>
                        </div>
                        <div class="fv-row mb-8">
                            <select class="form-select" aria-label="Default select example" id="id_code" name="id_code">

                            </select>
                        </div>
                        <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                            <span>Description</span>
                        </div>
                        <div class="fv-row mb-8">
                            <textarea type="text" placeholder="Description" id="description" name="description"
                                autocomplete="off" class="form-control bg-transparent"></textarea>
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
                url: base_url + 'admin/finance_record/getFilteredSummary',
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


        // ------------EDIT FINANCE
        function editFinanceBtn(element) {
            let $element = $(element);

            $("#id_record").val($element.data('id'));
            $("#kategori").val($element.data('kategori')).trigger("change");
            $("#product_id").val($element.data('product'));
            $("#amount").val($element.data('amount'));
            $("#description").val($element.data('description'));
            $("#record_date").val($element.data('record_date'));

            $("#id_code").html('<option value="" selected disabled>- Pilih ID Code -</option>');
            if ($element.data('kategori')) {
                accID = 'id_code';
                accVAL = $element.data('id_code');
                getAccount($element.data('kategori'));
            }

            $("#editfinanceModal").modal("show");
        }

        
        $(document).ready(function() {
            const base_url = $('meta[name="base_url"]').attr('content');

            $("#kategori").on("change", function() {
                const categoryId = $(this).val();
                $("#id_code").html('<option value="" selected disabled>- Pilih ID Code -</option>');
                if (categoryId) {
                    getAccount(categoryId);
                }
            });


            $("#editfinanceForm").on("submit", function(e) {
                e.preventDefault();
                $.ajax({
                    url: base_url + "admin/finance_record/update",
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
        

        //------------DELETE FINANCE
        function handleDeleteButton(id) {
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
                        url: base_url + 'admin/finance_record/delete',
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

        

        // Fungsi untuk format mata uang Rupiah
        function formatRupiah(angka) {
            var number_string = angka.toString().replace(/[^,\d]/g, ''),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return 'Rp. ' + rupiah;
        }

        //-----------------------DATATABLE
        //--------TEST FILTER

        function callDT() {
            table = $('#finances_table').DataTable({
                responsive: false,
                autoWidth: false,
                processing: true,
                serverSide: true,
                order: [],
                ajax: {
                    url: base + 'admin/finance_record/dtSideServer',
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
                        title: 'Finance Report',
                        className: 'd-none',
                        exportOptions: {
                            columns: ':not(.no-print)',
                        },

                        customize: function (doc) {

                            doc.styles.tableHeader.fontSize = 10;
                            doc.styles.tableBodyOdd.fontSize = 8;
                            doc.styles.tableBodyEven.fontSize = 8;
                            doc.content[1].margin = [10, 15, 10, 10];


                            let currentDate = new Date();
                            let titleDate = '';

                            if (option === 'this_month') {
                                titleDate = new Intl.DateTimeFormat('id-ID', { month: 'long', year: 'numeric' }).format(currentDate);
                            } else if (option === 'last_month') {
                                currentDate.setMonth(currentDate.getMonth() - 1);
                                titleDate = new Intl.DateTimeFormat('id-ID', { month: 'long', year: 'numeric' }).format(currentDate);
                            } else if (option === 'this_year') {
                                titleDate = `Tahun ${currentDate.getFullYear()}`;
                            } else if (option === 'last_year') {
                                titleDate = `Tahun ${currentDate.getFullYear() - 1}`;
                            } else if (option === 'today') {
                                titleDate = new Intl.DateTimeFormat('id-ID', { day: '2-digit', month: 'long', year: 'numeric' }).format(currentDate);
                            } else if (option === 'yesterday') {
                                currentDate.setDate(currentDate.getDate() - 1);
                                titleDate = new Intl.DateTimeFormat('id-ID', { day: '2-digit', month: 'long', year: 'numeric' }).format(currentDate);
                            } else if (option === 'this_week') {
                                titleDate = `Minggu ini (${startDate} - ${endDate})`;
                            } else if (option === 'last_week') {
                                titleDate = `Minggu lalu (${startDate} - ${endDate})`;
                            } else if (option === 'custom' && startDate && endDate) {
                                titleDate = `${startDate} - ${endDate}`;
                            }

                            doc.content.unshift({
                                text: titleDate,
                                alignment: 'right',
                                margin: [0, 0, 10, 20], 
                                style: 'subheader',
                            });

                            var totalsByProduct = { income: {}, expenses: {} };
                            var totalIncome = 0;
                            var totalExpenses = 0;

                            table.rows({ page: 'current' }).data().each(function (row) {
                                var product = row[3]; 
                                var amount = row[4].replace(/[^0-9,-]+/g, ''); 
                                var type = row[2]; 

                                amount = parseFloat(amount.replace(',', ''));

                                if (type === 'Income') {
                                    if (totalsByProduct.income[product]) {
                                        totalsByProduct.income[product] += amount;
                                    } else {
                                        totalsByProduct.income[product] = amount;
                                    }
                                    totalIncome += amount;
                                } else if (type === 'Expenses') {
                                    if (totalsByProduct.expenses[product]) {
                                        totalsByProduct.expenses[product] += amount;
                                    } else {
                                        totalsByProduct.expenses[product] = amount;
                                    }
                                    totalExpenses += amount;
                                }
                            });

                            var totalAmountTable = [
                                [
                                    { text: 'Product Type', style: 'tableHeader', alignment: 'left', fontSize: '10' },
                                    { text: 'Product', style: 'tableHeader', alignment: 'left', fontSize: '10' },
                                    { text: 'Total Amount', style: 'tableHeader', alignment: 'left', fontSize: '10' },
                                ]
                            ];

                            Object.keys(totalsByProduct.income).forEach(function (product) {
                                totalAmountTable.push([
                                    { text: 'Income', style: 'tableBody', alignment: 'left', fontSize: '8' },
                                    { text: product, style: 'tableBody', alignment: 'left', fontSize: '8' },
                                    { text: 'Rp. ' + totalsByProduct.income[product].toLocaleString('id-ID'), style: 'tableBody', alignment: 'left', fontSize: '8' },
                                ]);
                            });

                            Object.keys(totalsByProduct.expenses).forEach(function (product) {
                                totalAmountTable.push([
                                    { text: 'Expenses', style: 'tableBody', alignment: 'left', fontSize: '8' },
                                    { text: product, style: 'tableBody', alignment: 'left', fontSize: '8' },
                                    { text: 'Rp. ' + totalsByProduct.expenses[product].toLocaleString('id-ID'), style: 'tableBody', alignment: 'left', fontSize: '8' },
                                ]);
                            });

                            totalAmountTable.push([
                                { text: 'Overall Income', style: 'tableHeader', alignment: 'left', fontSize: '8' },
                                { text: '', style: 'tableHeader', alignment: 'left', fontSize: '8' },
                                { text: 'Rp. ' + totalIncome.toLocaleString('id-ID'), style: 'tableHeader', alignment: 'left', fontSize: '8' },
                            ]);

                            totalAmountTable.push([
                                { text: 'Overall Expenses', style: 'tableHeader', alignment: 'left', fontSize: '8' },
                                { text: '', style: 'tableHeader', alignment: 'left', fontSize: '8' },
                                { text: 'Rp. ' + totalExpenses.toLocaleString('id-ID'), style: 'tableHeader', alignment: 'left', fontSize: '8' },
                            ]);

                            totalAmountTable.push([
                                { text: 'Net Total (Income - Expenses)', style: 'tableHeader', alignment: 'left', fontSize: '8' },
                                { text: '', style: 'tableHeader', alignment: 'left', fontSize: '8' },
                                { text: 'Rp. ' + (totalIncome - totalExpenses).toLocaleString('id-ID'), style: 'tableHeader', alignment: 'left', fontSize: '8' },
                            ]);

                            doc.content.push({
                                text: 'Summary of Total Amount',
                                style: 'header',
                                margin: [10, 20, 0, 0],
                            });

                            doc.content.push({
                                table: {
                                    widths: ['25%', '25%', '20%'],
                                    body: totalAmountTable,
                                },
                                layout: 'lightHorizontalLines',
                                margin: [10, 5, 0, 10],
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
            updateCards(option)
            table.ajax.reload();
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

		document.getElementById("addproduct").addEventListener("submit", function() {
			let input = document.querySelector("input[name='amount']");
			if (input.value !== "") {
				input.value = input.value.replace(/\./g, ""); // Hapus semua titik sebelum submit
			}
		});


    </script>

</main>
