<main>
    <h1>Finance Record</h1>

    <button type="button" class="btn btn-primary mt-10" data-bs-toggle="modal" data-bs-target="#addProduct">
    Add Finance Record
    </button>

    <div class="mt-6">
        <table id="finances_table" class="table table-bordered table-striped" style="width:100%">
            <thead>
                <?php $no = 1 ?>
                <tr>
                    <th>No</th>
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
                <?php foreach ($finance_records as $finance): ?>
                <tr>
                    <td><?= $no; ?></td>
                    <td><?= $finance['created_at']; ?></td>
                    <td><?= $finance['record_date']; ?></td>
                    <td><?= $finance['name_kategori']; ?></td>
                    <td><?= $finance['name_product']; ?></td>
                    <td>Rp.<?=number_format($finance['amount']); ?></td>
                    <td><?= $finance['name_code']; ?></td>
                    <td><?= $finance['description']; ?></td>
                    <td>
                        <button class="btn btn-warning mb-2 btn-sm rounded-pill btn-edit-finrec" 
                                data-id="<?= $finance['id_record']; ?>"
                                data-id_code="<?= $finance['id_code']; ?>"
                                data-product="<?= $finance['product_id']; ?>"
                                data-kategori="<?= $finance['id_kategori']; ?>"
                                data-amount="<?= $finance['amount']; ?>"
                                data-code="<?= $finance['id_code']; ?>"
                                data-description="<?= $finance['description']; ?>">
                            Edit
                        </button>

                        <button class="btn btn-danger btn-sm mb-2 rounded-pill btn-delete-finrec" data-id="<?= $finance['id_record']; ?>">
                            DELETE
                        </button>
                    </td>
                </tr>
                <?php $no++?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal Add Product -->
    <div class="modal fade" tabindex="-1" id="addProduct">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Add finance</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="menu-icon">
							<span class="svg-icon svg-icon-2">
								<i class="ti ti-minus"></i>
							</span>
                        </span>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">
                            <form class="form w-100" id="addproduct" data-action="<?= site_url('admin/finance_record/add_finance') ?>" enctype="multipart/form-data">
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
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editfinanceModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Edit finance</h3>

                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="path1"></span><span class="path2">X</span>
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
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
		$('#finances_table').DataTable();

        let base = '<?= base_url()?>';
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


        $(document).ready(function () {
            const base_url = $('meta[name="base_url"]').attr('content');


            $(".btn-edit-finrec").on("click", function () {
                const data = $(this).data();
                console.log("Kategori:", data.kategori); 
                
                
                $("#id_record").val(data.id);
                $("#kategori").val(data.kategori).trigger("change");
                $("#product_id").val(data.product);
                $("#amount").val(data.amount);
                $("#description").val(data.description);

                $("#id_code").html('<option value="" selected disabled>- Pilih ID Code -</option>');
                if (data.kategori) {
                    accID   = 'id_code';
                    accVAL  = data.id_code;
                    getAccount(data.kategori);
                }

                $("#editfinanceModal").modal("show");
            });

            // Ketika kategori berubah
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

	</script>
</main>