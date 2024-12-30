<main>
    <h1 class="mb-4">Finance Record</h1>

    <div class="container mt-4 p-4" style="border-radius: 10px; background-color: #f8f9fa;">
        <div class="row justify-content-start" id="card-container">
        
             <?php foreach($totals_amount as $amount) : ?>
                <div class="col-auto">
                    <div class="card shadow-sm" id="totalsAmountCard" style="width: 200px; margin-bottom: 20px; border-radius: 10px;">
                        <div class="card-body">
                            <h5 class="card-title text-primary"><?= $amount['name_kategori']?></h5>
                            <ul class="list-unstyled mt-3">
                                <li>
                                    <strong>Total :</strong> 
                                    <span class="text-success">Rp.<?= number_format($amount['total_amount'], 0, ',', '.')?></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php endforeach;?>
        </div>
    </div>
    <!-- <div class="row justify-content-start" id="card-container">
    
        <?php foreach ($totals_amount as $category): ?>
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm" style="border-radius: 10px; width: 200px;">
                    <div class="card-body">
                        <h5 class="card-title text-primary"><?= $category['name_kategori']; ?></h5>
                        <ul class="list-unstyled mt-3">
                            <li>
                                <strong>Total:</strong>
                                <span class="text-muted"><?= $category['total_amount']; ?></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div> -->


    <!-- <div class="container mt-4 p-4" style="border-radius: 10px; background-color: #f8f9fa;">
        <div class="row justify-content-start">
           
            <div class="col-auto">
                <div class="card shadow-sm" style="width: 200px; margin-bottom: 20px; border-radius: 10px;">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Nama Product</h5>
                        <ul class="list-unstyled mt-3">
                            <li>
                                <strong>Assets:</strong> 
                                <span class="text-muted">-</span>
                            </li>
                            <li>
                                <strong>Expenses:</strong> 
                                <span class="text-muted">-</span>
                            </li>
                            <li>
                                <strong>Equity:</strong> 
                                <span class="text-muted">-</span>
                            </li>
                            <li>
                                <strong>Income:</strong> 
                                <span class="text-muted">-</span>
                            </li>
                            <li>
                                <strong>Liabilities:</strong> 
                                <span class="text-muted">-</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-auto">
                <div class="card shadow-sm" style="width: 200px; margin-bottom: 20px; border-radius: 10px;">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Nama Product</h5>
                        <ul class="list-unstyled mt-3">
                            <li>
                                <strong>Assets:</strong> 
                                <span class="text-muted">-</span>
                            </li>
                            <li>
                                <strong>Expenses:</strong> 
                                <span class="text-muted">-</span>
                            </li>
                            <li>
                                <strong>Equity:</strong> 
                                <span class="text-muted">-</span>
                            </li>
                            <li>
                                <strong>Income:</strong> 
                                <span class="text-muted">-</span>
                            </li>
                            <li>
                                <strong>Liabilities:</strong> 
                                <span class="text-muted">-</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- <div class="row" id="cardContainer">
  
    </div> -->


    <div class="d-flex justify-content-between flex-wrap">
        <button type="button" class="btn btn-primary rounded-pill mt-3" data-bs-toggle="modal" data-bs-target="#addProduct"> 
            <i class="ti ti-plus"></i> Add Finance Record
        </button>
    </div>

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
    </div>
  
    <div class="table-responsive mt-4">
        <table id="finances_table" class="table table-bordered table-striped w-100">
            <thead>
                <tr>
                    <th>Created At</th>
                    <th>Record Date</th>
                    <th>Type</th>
                    <th>Product</th>
                    <th>Amount</th>
                    <th>Code</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>
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
                    <h3 class="modal-title">Add finance</h3>

                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="menu-icon">
							<span class="svg-icon svg-icon-2">
								<i class="ti ti-minus"></i>
							</span>
                        </span>
                    </div>
                </div>

                <div class="modal-body">
                            <form class="form w-100" id="addproduct" data-action="<?= site_url('admin/finance_record/add_finance') ?>" enctype="multipart/form-data">
                                <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                    <span>Record Date</span>
                                </div>
                                <div class="fv-row mb-8">
                                     <input type="datetime-local"  value="<?= date('Y-m-d H:i') ?>" name="record_date" autocomplete="off" class="form-control bg-transparent"/> 
                                </div>
                                <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                    <span>Type</span>
                                </div>
                                <div class="fv-row mb-8">
                                    <select id="categories" class="form-select" aria-label="Default select example" name="type_record">
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
                                        <?php foreach($products as $product): ?>
                                        <option value="<?= $product['id_product'] ?>"><?= $product['name_product'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                    <span>Amount</span>
                                </div>
                                <div class="fv-row mb-8">
                                    <input type="number" placeholder="Amount" name="amount" autocomplete="off" class="form-control bg-transparent"/> 
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
                                    <input type="text" placeholder="Description" name="description" autocomplete="off" class="form-control bg-transparent"/> 
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

                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close" tabindex="-1" aria-labelledby="editFinanceModalLabel" aria-hidden="true">
                            <span class="svg-icon svg-icon-2">
								<i class="ti ti-minus"></i>
							</span>
                    </div>
                </div>

                <div class="modal-body">
                            <form class="form w-100" id="editfinanceForm" enctype="multipart/form-data">
                                    <input type="hidden" name="id_record" id="id_record">
                                    <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                    <span>Type</span>
                                    </div>
                                    <div class="fv-row mb-8">
                                        <select class="form-select" aria-label="Default select example" id="kategori" name="type_record">
                                            <?php foreach($categories as $ct): ?>
                                            <option value="<?= $ct['id_kategori'] ?>"><?= $ct['name_kategori']?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                    <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                        <span>Product</span>
                                    </div>
                                    <div class="fv-row mb-8">
                                        <select class="form-select" aria-label="Default select example" id="product_id" name="product_id">
                                            <?php foreach($products as $product): ?>
                                            <option value="<?= $product['id_product'] ?>"><?= $product['name_product'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                        <span>Amount</span>
                                    </div>
                                    <div class="fv-row mb-8">
                                        <input type="number" placeholder="Amount"  id="amount" name="amount" autocomplete="off" class="form-control bg-transparent"/> 
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
                                        <input type="text" placeholder="Description" id="description" name="description" autocomplete="off" class="form-control bg-transparent"/> 
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

		
        let table;
        let option = 'this_month';
        let startDate = '';
        let endDate = '';

        let product = '';
        let code = '';
        let type = '';


        let accVAL = ''; 
        let accID  = '';

        $(document).ready(function() {
            
            $('#categories').on('change', function() {
                const categoryId = $(this).val(); 
                const accountSelect = $('#account');
                accID   = 'account';
                accVAL  = '';


                accountSelect.html('<option value="" selected disabled>-select account-</option>');

                if (categoryId) {
                    getAccount(categoryId)

                }
            });
        });

        function getAccount(categoryId){
            $.ajax({
                url: base + 'admin/finance_record/option_acc',
                type: 'POST',
                data: { category_id: categoryId }, 
                dataType: 'json',
                success: function(response) {
                    if(response.status){
                        const accountSelect = $('#'+accID);
                        $.each(response.data, function(index, account) {
                            const selected = accVAL == account.id_code ? 'selected' : '';
						    accountSelect.append(`<option value="${account.id_code}" ${selected}>${account.code} - ${account.name_code}</option>`);

                        });
                    }else{
                        console.log('gagal');
                    }

                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        }
        
        function editFinanceBtn(element){
            let $element = $(element);

            $("#id_record").val($element.data('id'));
            $("#kategori").val($element.data('kategori')).trigger("change");
            $("#product_id").val($element.data('product'));
            $("#amount").val($element.data('amount'));
            $("#description").val($element.data('description'));

            $("#id_code").html('<option value="" selected disabled>- Pilih ID Code -</option>');
            if ($element.data('kategori')) {
                accID   = 'id_code';
                accVAL  = $element.data('id_code');
                getAccount($element.data('kategori'));
            }

            $("#editfinanceModal").modal("show");
        }

       // ------------EDIT FINANCE
        $(document).ready(function () {
            const base_url = $('meta[name="base_url"]').attr('content');

            $("#kategori").on("change", function () {
                const categoryId = $(this).val();
                $("#id_code").html('<option value="" selected disabled>- Pilih ID Code -</option>');
                if (categoryId) {
                    getAccount(categoryId);
                }
            });


            $("#editfinanceForm").on("submit", function (e) {
                e.preventDefault();
                $.ajax({
                    url: base_url + "admin/finance_record/update",
                    type: "POST",
                    data: $(this).serialize(),
                    dataType: "json",
                    success: function (response) {
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
                    error: function (xhr, status, error) {
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
                        data: { id: id }, 
                        success: function (response) {
                            var res = JSON.parse(response);
                            if (res.status) {
                                swallMssg_s(res.message, false, 1500)
                                .then(() =>  {
                                    location.reload();
                                 });
                             } else {
                                swallMssg_e(res.message, true, 0);
                            }
                        },
                        error: function (xhr, status, error) {
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


        //-----------------------DATATABLE
        //--------TEST FILTER

        function callDT(){
            table = $('#finances_table').DataTable({
                responsive: false,
                autoWidth: false,
                "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    "url": base + 'admin/finance_record/dtSideServer',
                    "type": "POST",
                    data: function(d) {
                        d.option = option;
                        d.startDate = startDate;
                        d.endDate = endDate;
                        d.product = product;
                        d.code = code;
                        d.type = type;

                        console.log('Filter Data:', { option, startDate, endDate, product, code, type }); 
                    }
                },
                columnDefs: [{
                    "targets": "_all",
                    orderable: false
                },
                    {
                        "targets": 0,
                        "className": "text-start"
                    }]
            });
        }

        callDT();

        //---------- FILTER DATE
        $('#filterSelect').on('change', function () {
            option = $(this).val(); 
            const base_url = $('meta[name="base_url"]').attr('content');

            if (option === 'custom') {
                $('#customDateModal').modal('show');
            } else {
                // loadCardsByCategoryAndProduct(option);
                table.ajax.reload(); 
            }

            $.ajax({
                url: base_url + 'admin/finance_record/get_total_amount_by_category',
                type: 'POST',
                data: { option: option },
                dataType: 'json',
                success: function (response) {
                    if (response.status) {
                        updateCards(response.data);
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching totals:', error);
                }
            });

            
        });

        function formatRupiah(number) {
            return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(number);
        }

        // function loadCardsByCategoryAndProduct(filterOption) {
        //     const base_url = $('meta[name="base_url"]').attr('content');
        //     $.ajax({
        //         url: base_url + 'admin/finance_record/get_total_amount_by_category_and_product',
        //         type: 'POST',
        //         data: { option: filterOption },
        //         dataType: 'json',
        //         success: function(response) {
        //             if (response.status) {
        //                 const data = response.data;
        //                 const cardContainer = $('#cardContainer'); // Pastikan ID container card sesuai
        //                 cardContainer.empty(); // Kosongkan card sebelumnya

        //                 data.forEach(item => {
        //                     const formattedAmount = formatRupiah(item.total_amount); // Format Rupiah
        //                     cardContainer.append(`
        //                         <div class="col-md-4 mb-3">
        //                             <div class="card shadow-sm" style="border-radius: 10px;">
        //                                 <div class="card-body">
        //                                     <h5 class="card-title text-primary">${item.name_kategori} - ${item.name_product}</h5>
        //                                     <ul class="list-unstyled mt-3">
        //                                         <li>
        //                                             <strong>Total:</strong>
        //                                             <span class="text-muted">${formattedAmount}</span>
        //                                         </li>
        //                                     </ul>
        //                                 </div>
        //                             </div>
        //                         </div>
        //                     `);
        //                 });
        //             }
        //         },
        //         error: function(xhr, status, error) {
        //             console.error('Error: ' + error);
        //         }
        //     });
        // }


        function updateCards(data) {
            const cardContainer = $('#card-container');
            cardContainer.empty(); // Clear old cards

            data.forEach(category => {
                const formattedAmount = formatRupiah(category.total_amount); // Format angka ke Rupiah
                cardContainer.append(`
                    <div class="col-auto">
                            <div class="card shadow-sm" id="totalsAmountCard" style="width: 200px; margin-bottom: 20px; border-radius: 10px;">
                            <div class="card-body">
                                <h5 class="card-title text-primary">${category.name_kategori}</h5>
                                <ul class="list-unstyled mt-3">
                                    <li>
                                        <strong>Total :</strong> 
                                        <span class="text-success">${formattedAmount}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>  
                `);
            });
        }


        $('#applyCustomDate').on('click', function () {
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
        });

        // --------- FILTER CATEGORY
        $('#filterCategory').on('change', function() {
            type = $(this).val(); 
            const accountSelect = $('#filterCode');
            accID   = 'filterCode';
            accVAL  = '';
            
            if (type) {
                accountSelect.html('<option value="" selected>-</option>');
                getAccount(type)
    
                }
                
            if(type == ""){
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

            table.ajax.reload();
        });
	</script>
</main>