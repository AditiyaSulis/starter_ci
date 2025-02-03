<main>
    <h1>Piutang</h1>

    <button type="button" class="btn gradient-btn rounded-pill mt-10" data-bs-toggle="modal" data-bs-target="#addProduct">
        <i class="bi bi-plus-circle"></i>
        Add Piutang
    </button>

    <ul class="nav nav-tabs mt-8">
        <li class="nav-item">
            <a class="nav-link active text-info" aria-current="page" href="<?=base_url('admin/piutang/piutang_paid_page_v2')?>">Paid</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-dark" href="<?=base_url('admin/piutang/piutang_page_v2')?>">Unpaid</a>
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
    </div>

    <div class="mt-6">
        <table id="piutangpaid_table" class="table table-bordered table-striped border-primary" style="width:100%">
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

                        <div id="tenor-form" style="display: none;">
                            <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                <span>Tenor</span>
                            </div>
                            <div class="fv-row mb-8">
                                <select class="form-select" name="tenor_piutang">
                                    <option selected>-Tenor-</option>
                                    <option value="2">2 Bulan</option>
                                    <option value="3">3 Bulan</option>
                                    <option value="4">4 Bulan</option>
                                    <option value="5">5 Bulan</option>
                                    <option value="6">6 Bulan</option>
                                </select>
                            </div>
                        </div>

                        <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                            <span>Amount</span>
                        </div>
                        <div class="fv-row mb-8">
                            <input type="number" name="amount_piutang" autocomplete="off" class="form-control bg-transparent" />
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

     <!-- Modal Pay -->
     <div class="modal fade" id="payPiutangModal" tabindex="-1" aria-labelledby="payModalLabel" aria-hidden="true">
        <div class="modal-dialog"> 
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Piutang Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 col-sm">
                            <div class="mb-3">
                                <!-- <span>Total: <span id="final_amount_display" class="text-success"></span></span> -->
                            </div>
                            <div class="card p-4 shadow">
                                <div class="mb-3">
                                    <h6>Log:</h6>
                                    <ul id="log_list" class="list-group">
                                        
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
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

        
        let type = 'All'; 

        function callDT() 
        {
            var table = $('#piutangpaid_table').DataTable({
                responsive:{
                    details: {
                        type: 'column',
                        target: 'tr',
                    }
                },
                processing: true,
                serverSide: true,
                ajax: {
                    url: base_url + 'admin/piutang/dtSideServer_paid_v2',  
                    type: 'POST',
                    data: function(d) {
                        type = $('#filter-type').val();  
               
                        d.type = type; 
                
                    }
                },
                columnDefs: [
                    { targets: "_all", orderable: false },  
                    { targets: 0, className: "text-center" }, 
                    { targets: [1, 2, 3, 4], responsivePriority: 1 }, 
                    { targets: -1, responsivePriority: 2 }, 
                ],
                
            });

            $('#filter-type').change(function() {
                table.ajax.reload();  
            });
        }
        
        callDT();

        const exampleModal = document.getElementById('payPiutangModal');
        exampleModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id_piutang');

            console.log("ID:", id);

            // Format angka menjadi Rupiah
            function formatToRupiah(number) {
                return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(number);
            }

            // Format tanggal menjadi tanggal-bulan-tahun
            function formatDate(dateString) {
                const options = { day: '2-digit', month: '2-digit', year: 'numeric' };
                return new Date(dateString).toLocaleDateString('id-ID', options);
            }

            // $('#final_amount_display').text(formatToRupiah(finalAmount));
            // $('#remaining_amount_display').text(formatToRupiah(remainingAmount));
            $("#edit_id").val(id);

            $.ajax({
                url: base_url + 'admin/piutang/pay_logs',
                method: 'POST',
                data: { id_piutang: id },
                dataType: 'json',
                success: function (response) {
                    const logList = $('#log_list');
                    logList.empty();
                    if (response.logs && response.logs.length > 0) {
                        response.logs.forEach(log => {
                            const formattedDate = formatDate(log.pay_date);
                            const formattedAmount = formatToRupiah(log.pay_amount);
                            logList.append(`<li class="list-group-item text-info"><i class="ti ti-credit-card"></i> - ${formattedDate} sebesar ${formattedAmount}</li>`);
                        });
                    } else {
                        
                        logList.append(`<li class="list-group-item text-danger">Tidak ada riwayat pembayaran untuk transaksi ini.</li>`);
                    }
                },
                error: function () {
                    $('#log_list').html('<li class="list-group-item text-danger">Gagal memuat riwayat pembayaran.</li>');
                }
            });

            
            $("#payPiutangForm").on("submit", function (e) {
                e.preventDefault();

                const submitButton = $("#payPiutangForm button[type=submit]");
                submitButton.prop("disabled", true).text("Processing...");

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Pembayaran tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Bayar',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                

                        $.ajax({
                            url: base_url + "admin/piutang/add_pay",
                            type: "POST",
                            data: $(this).serialize(),
                            dataType: "json",
                            success: function (response) {
                                if (response.status) {
                                    swallMssg_s(response.message, false, 1500)
                                    .then(() => {
                                        location.reload();
                                    });
                                } else {
                                    swallMssg_e(response.message, true, 0);
                                    submitButton.prop("disabled", false).text("Submit");
                                }
                            },
                            error: function (xhr, status, error) {
                                swallMssg_e('Terjadi kesalahan: ' + error, true, 0)
                                .then(() => {
                                    location.reload();
                                });
                                submitButton.prop("disabled", false).text("Submit");
                            }
                        });
                    }
                });
            });
            
        });


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

        //PRINT
        document.addEventListener('DOMContentLoaded', function () {
            // Tambahkan event listener untuk tombol print
            const printButtons = document.querySelectorAll('.btn-print');
            printButtons.forEach(button => {
                button.addEventListener('click', function () {
                    // Ambil data dari atribut tombol
                    const nameEmployee = this.getAttribute('data-id_employee');
                    const position = this.getAttribute('data-id_position');
                    const nip = this.getAttribute('data-nip');
                    const amountPiutang = this.getAttribute('data-amount_piutang');
                    const descriptionPiutang = this.getAttribute('data-description_piutang');
                    const tglLunas = this.getAttribute('data-tgl_lunas');
                    const piutangDate = this.getAttribute('data-piutang_date');

                    // Masukkan data ke elemen HTML
                    document.getElementById('nama_employee_print').textContent = nameEmployee;
                    document.getElementById('position_print').textContent = position;
                    document.getElementById('nip_print').textContent = nip;
                    document.getElementById('amount_piutang').textContent = amountPiutang;
                    document.getElementById('description_piutang_print').textContent = descriptionPiutang;
                    document.getElementById('tgl_lunas').textContent = tglLunas;
                    document.getElementById('piutang_date').textContent = piutangDate;
                    document.getElementById('name_karyawan_ttd_print').textContent = nameEmployee;

                    // Tampilkan elemen yang sebelumnya disembunyikan
                    const printContent = document.querySelector('.yang-print');
                    printContent.style.display = 'block';

                    // Cetak dokumen
                    window.print();

                    // Sembunyikan kembali elemen setelah mencetak
                    printContent.style.display = 'none';
                });
            });
        });


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


    



	</script>
</main>

    
