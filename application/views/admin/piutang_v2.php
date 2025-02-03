<main>
    <h1>Piutang</h1>

    <button type="button" class="btn gradient-btn rounded-pill mt-10" data-bs-toggle="modal" data-bs-target="#addProduct">
        <i class="bi bi-plus-circle"></i>
        Add Piutang
    </button>

    <ul class="nav nav-tabs mt-8">
        <li class="nav-item">
            <a class="nav-link text-dark" aria-current="page" href="<?=base_url('admin/piutang/piutang_paid_page_v2')?>">Paid</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active text-info " href="<?=base_url('admin/piutang/piutang_page_v2')?>">Unpaid</a>
        </li>
    </ul>

    <div class="row g-3 align-items-center mt-4">
        <div class="col-12 col-md-auto">
            <label class="form-label">Type Piutang :</label>
            <select id="filter-type" class="form-select form-select-sm">
                <option value="All" selected>All</option>
                    <option value="2">Kasbon</option>
                    <option value="1">Pinjaman</option>
            </select>
        </div>
        <div class="col-12 col-md-auto">
            <label class="form-label">Pelunasan :</label>
            <select id="filter-tenor" class="form-select form-select-sm">
                <option value="All" selected>All</option>
                    <option value="this_month">This month</option>
                    <option value="next_month">Next month</option>
            </select>
        </div>
    </div>

    <div class="mt-6">
        <table id="piutang_table" class="table table-bordered table-striped border-primary" style="width:100%">
            <thead>
                <?php $no = 1 ?>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Karyawan</th>
                    <th>Type</th>
                    <th>Tenor</th>
                    <th>Pelunasan</th>
                    <th>Amount</th>
                    <th>Remaining</th>
                    <th>Angsuran</th>
                    <th>Status</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>
    </div>

   <!-- Modal Add Product -->
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
                    <form class="form w-100" id="addproduct" data-action="<?= site_url('admin/piutang/add_piutang_v2') ?>" enctype="multipart/form-data">
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
                                <option value="2">Kasbon</option>
                                <option value="1">Pinjaman</option>
                            </select>
                        </div>


                            <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                <span>Type Tenor</span>
                            </div>
                            <div class="fv-row mb-8">
                                <select class="form-select" name="type_tenor">
                                    <option selected>-Type Tenor-</option>
                                    <option value="1">Harian</option>
                                    <option value="2">Mingguan</option>
                                    <option value="3">Bulanan</option>
                                    <option value="4">Tahunan</option>
                                </select>
                            </div>

                        
                        <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                            <span>Tenor</span>
                        </div>
                        <div class="fv-row mb-8">
                            <input type="number" name="tenor_piutang" autocomplete="off" class="form-control bg-transparent" />
                        </div>


                        <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                            <span>Amount</span>
                        </div>
                        <div class="fv-row mb-8">
                            <input type="number" name="amount_piutang" autocomplete="off" class="form-control bg-transparent" />
                        </div>

                        <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                            <span>Angsuran</span>
                        </div>
                        <div class="fv-row mb-8">
                            <input type="number" name="angsuran" autocomplete="off" class="form-control bg-transparent" readonly />
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

    <!-- Modal Detail -->
    <div class="modal fade" id="payPiutangModal" tabindex="-1" aria-labelledby="payModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Piutang Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-4">
                        <span>
                            <strong>Tanggal Pelunasan:</strong> 
                            <span id="tgl_lunas_display" class="text-success">-</span>
                        </span>
                    </div>
                    <!-- Container untuk Cards -->
                    <div class="d-flex justify-content-center">
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
                            <!-- Card Piutang -->
                            <div class="col">
                                <div class="card p-4 shadow h-100">
                                    <div class="text-center mb-3">
                                        <span class="badge gradient-btn-unpaid btn-sm" style="width: 100px;">BELUM LUNAS</span>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col">
                                            <span>Test</span>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <span>Rp.11,000</span>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <button class="btn btn-primary btn-sm">
                                            Bayar
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- Tambahkan card lainnya dengan struktur yang sama -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Pay -->
    <div class="modal fade" id="addPayPiutangModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Add Payment</h3>

                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                <span class="svg-icon svg-icon-2">
                                    <i class="ti ti-minus"></i>
                                </span>
                        </div>

                    </div>

                    <div class="modal-body">
                                <form class="form w-100" id="addPayForm" enctype="multipart/form-data">
                                    <input type="hidden" id="edit_id" name="id_piutang">
                                    <input type="hidden" id="edit_angsuran" name="angsuran">
                                    <input type="hidden" id="edit_purchase_piutang" name="id_purchase_piutang">
                                    <div class="mb-3">
                                        <label for="form_date" class="form-label">Tanggal</label>
                                        <input type="datetime-local" value="<?= date('Y-m-d\TH:i') ?>" name="pay_date" class="form-control" id="pay_date" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="form_text1" class="form-label">Amount</label>
                                        <input type="number" class="form-control" id="pay_amount" placeholder="Rp.1xxxx" name="pay_amount" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="form_text2" class="form-label">Deskripsi</label>
                                        <textarea type="text" class="form-control" id="pay_description" placeholder="Enter text" name="description" required> </textarea>
                                    </div>
                                        <div class="d-grid mb-10 mt-10">
                                            <button type="submit" id="pay_submit" class="btn btn-primary"><span class="indicator-label">
                                                        Pay
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

    <!-- MODAL SET PROGRESS -->
    <div class="modal fade" tabindex="-1" id="setProgressModal">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Set Progress</h4>

          
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="menu-icon">
							<span class="svg-icon svg-icon-2">
								<i class="ti ti-minus"></i>
							</span>
                        </span>
                    </div>
      
                </div>

                <div class="modal-body">
                            <form class="form w-100" id="setProgressForm" enctype="multipart/form-data">
                            <input type="hidden" id="id_piutang_progress" name="id_piutang">   
                            <div class="fv-row mb-8">
                                    <select class="form-select" aria-label="Default select example" id="progress" name="progress_piutang">
                                        <option value="2">On Process</option>
                                        <option value="1">Completed</option>
                                    </select>
                                </div>
                                <div class="d-grid mb-10">
                                    <button type="submit" id="submit_progress" class="btn btn-primary">
                                            <span class="indicator-label">
                                                    Save changes
                                            </span>
                                            <span class="indicator-progress">
                                                     Please wait...    
                                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                            </span>
                                    </button>
                                </div>
                            </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        const base_url = $('meta[name="base_url"]').attr('content');  

        let tenor = 'All'; 
        let type = 'All'; 

        function callDT() 
        {
            var table = $('#piutang_table').DataTable({
                responsive:{
                    details: {
                        type: 'column',
                        target: 'tr',
                    }
                },
                processing: true,
                serverSide: true,
                ajax: {
                    url: base_url + 'admin/piutang/dtSideServerV2',  
                    type: 'POST',
                    data: function(d) {
                        type = $('#filter-type').val();  
                        tenor = $('#filter-tenor').val();  
                        d.type = type; 
                        d.tanggal_pelunasan = tenor; 
                    }
                },
                columnDefs: [
                    { targets: "_all", orderable: false },  
                    { targets: 0, className: "text-center" }, 
                    { targets: [1, 2, 3, 4], responsivePriority: 1 }, 
                    { targets: -1, responsivePriority: 2 }, 
                ],
                
            });

            $('#filter-tenor').change(function() {
                table.ajax.reload();  
            });
            $('#filter-type').change(function() {
                table.ajax.reload();  
            });
        }
        
        callDT();


        // SET PROGRESS PIUTANG
        function setProgress(element) {
           
            let $element = $(element)


                $("#id_piutang_progress"). val($element.data('id_piutang'));
                $("#progress").val($element.data('progress_piutang'));



                $("#setProgressModal").modal("show");
        }

        $(document).ready(function() {

            $("#setProgressForm").on("submit", function (e) {
                e.preventDefault();
                var base_url = $('meta[name="base_url"]').attr('content');

                var formElement = this; 
                var formData = new FormData(formElement); 

                $.ajax({
                    url: base_url +"admin/piutang/set_progress",
                    type: "POST",
                    data: formData,
                    contentType: false, 
                    processData: false, 
                    dataType: "json",
                    success: function (response) {
                        if (response.status) {
                            swallMssg_s(response.message, false, 1500)
                            .then(() =>  {
                                location.reload();
                            });
                        } else {
                            swallMssg_e(response.message, true, 0);
                        }
                    },
                    error: function (xhr, status, error) {
                        swallMssg_e('Terjadi kesalahan: Silahkan login menggunakan akun super user untuk mengedit data ' + error, true, 0).
                        then(() =>  {
                            location.reload();
                        }); 
                    }
                });
            });
        });


        //------------DELETE piutang
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
                                url: base_url + 'admin/piutang/delete',
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

        //MODAL DETAIL AND PAY
        $(document).ready(function () {
    
            $(document).on('click', '.btn-pay-piutang', function () {
                const idPiutang = $(this).data('id_piutang');
                const remainingPiutang = $(this).data('remaining_piutang');
                const tglLunas = $(this).data('tgl_lunas');
                const tenorPiutang = $(this).data('tenor_piutang');

                $('#payPiutangModal #tgl_lunas_display').text(formatDate(tglLunas) || 'Belum Ditentukan');
                $('#payPiutangModal #pay_amount').val(remainingPiutang || 0);

                $.ajax({
                    url: "<?= site_url('admin/piutang/pay_logs_v2') ?>", 
                    method: "POST",
                    data: { id_piutang: idPiutang },
                    dataType: "json",
                    success: function (response) {
                        if (response.status && response.data) {
                            let html = '';
                            response.data.forEach(item => {
                                if(item.status == 1) {
                                    html += `
                                        <div class="card p-4 shadow m-2" style="max-width: 100%; width: 200px; height: auto;">
                                            <div class="mb-3">
                                                <div class="row justify-content-center mb-3">
                                                    <span class="badge gradient-btn-unpaid btn-sm" style="width: 100px;">
                                                        BELUM LUNAS
                                                    </span>
                                                </div>
                                                <div class="row text-center">
                                                    <div class="col-md"><span>${formatDate(item.jatuh_tempo)}</span></div>
                                                </div>
                                                <div class="row mb-3 text-center">
                                                    <div class="col-md"><span>${formatRupiah(item.angsuran)}</span></div>
                                                </div>
                                                <div class="row justify-content-center mx-3 mt-3">
                                                    <button class="btn btn-primary btn-sm btn-pay" 
                                                        data-id="${item.id_piutang}" 
                                                        data-id_purchase_piutang="${item.id_purchase_piutang}" 
                                                        data-angsuran="${item.angsuran}" 
                                                        data-amount="${item.amount}">
                                                        Bayar
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    `;
                                } else {
                                    html += `
                                        <div class="card p-4 shadow m-2" style="max-width: 100%; width: 200px; height: auto;">
                                            <div class="mb-3">
                                                <div class="row justify-content-center mb-3">
                                                    <span class="badge badge-success btn-sm" style="width: 100px;">
                                                        LUNAS
                                                    </span>
                                                </div>
                                                <div class="row text-center">
                                                    <div class="col-md"><span>${formatDate(item.jatuh_tempo)}</span></div>
                                                </div>
                                                <div class="row mb-3 text-center">
                                                    <div class="col-md"><span>${formatRupiah(item.angsuran)}</span></div>
                                                </div>
                                                <div class="row justify-content-center mx-3 mt-3">
                                                    <span class="badge btn-success btn-sm" style="width: 100px;">
                                                        ${formatRupiah(item.pay_date)}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    `;
                                }
                            });
                            $('#payPiutangModal .modal-body .row').html(html);
                        } else {
                            $('#payPiutangModal .modal-body .row').html('<p class="text-center">No unpaid debts found.</p>');
                        }
                    },
                    error: function () {
                        alert('Gagal memuat data piutang.');
                    }
                });
            });

            $(document).on('click', '.btn-pay', function () {
                const idPiutang = $(this).data('id'); 
                const angsuran = $(this).data('angsuran'); 
                const id_purchase_piutang = $(this).data('id_purchase_piutang'); 

                console.log('id pp : ' + id_purchase_piutang);


                $('#addPayPiutangModal #edit_id').val(idPiutang);
                $('#addPayPiutangModal #edit_angsuran').val(angsuran);
                $('#addPayPiutangModal #edit_purchase_piutang').val(id_purchase_piutang);

                $('#addPayPiutangModal').modal('show');

                $("#addPayForm").on("submit", function (e) {
                    e.preventDefault();

                    $("#pay_submit").prop("disabled", true); 

                    $.ajax({
                        url: base_url + "admin/piutang/add_pay_v2",
                        type: "POST",
                        data: $(this).serialize(),
                        dataType: "json",
                        success: function (response) {

                            $("#pay_submit").prop("disabled", false);

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

                            $("#pay_submit").prop("disabled", false);

                            Swal.fire({
                                icon: "error",
                                title: "Error",
                                text: "Terjadi kesalahan, silahkan coba lagi."
                            });
                        }
                    });
                });
            });
        });


        // Fungsi untuk format tanggal
        function formatDate(dateString) {
            const date = new Date(dateString);
            const day = date.getDate().toString().padStart(2, '0');
            const month = (date.getMonth() + 1).toString().padStart(2, '0');
            const year = date.getFullYear();
            return `${day}-${month}-${year}`;
        }

        // Fungsi untuk format nilai uang
        function formatRupiah(amount) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(amount);
        }

        document.addEventListener("DOMContentLoaded", function () {
            const amountInput = document.querySelector("input[name='amount_piutang']");
            const tenorInput = document.querySelector("input[name='tenor_piutang']");
            const angsuranInput = document.querySelector("input[name='angsuran']");

            const calculateAngsuran = () => {
                const amount = parseFloat(amountInput.value) || 0; 
                const tenor = parseFloat(tenorInput.value) || 0; 

                if (tenor > 0) {
                    angsuranInput.value = (amount / tenor).toFixed(2); 
                } else {
                    angsuranInput.value = ""; 
                }
            };

            amountInput.addEventListener("input", calculateAngsuran);
            tenorInput.addEventListener("input", calculateAngsuran);
        });



	</script>
</main>
