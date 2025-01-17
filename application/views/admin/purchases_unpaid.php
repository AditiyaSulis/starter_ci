<main>
    <h1>Purchases</h1>

    <h4 class="mt-10">Status Summary</h4>
    <div class="row g-4 mb-5 row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-5" id="card-container1">
        <div class="col">
            <div class="card bg-body ">
                <div class="card-body py-4 ">
                    <div class="text-gray-900 fw-bolder fs-2">
                        <span class="text-success">
                            Total : <?=$total_paid?>
                        </span>
                    </div>
                    <div class="fw-bold text-gray-800">
                        Paid Purchases </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card bg-body ">
                <div class="card-body py-4 ">
                    <div class="text-gray-900 fw-bolder fs-2">
                        <span class="text-success">
                        Total : <?=$total_unpaid?>
                        </span>
                    </div>
                    <div class="fw-bold text-gray-800">
                        Unpaid Purchases </div>
                </div>
            </div>
        </div>
        
    </div>

    <div class="accordion" id="kt_accordion_1">
        <div class="accordion-item">
            <h2 class="accordion-header" id="kt_accordion_1_header_1">
                <button class="accordion-button fs-4 fw-semibold collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#kt_accordion_1_body_1" aria-expanded="false" aria-controls="kt_accordion_1_body_1">
                    <span class="fw-bolder">Cash Flow</span>
                </button>
            </h2>
            <div id="kt_accordion_1_body_1" class="accordion-collapse collapse"
                aria-labelledby="kt_accordion_1_header_1" data-bs-parent="#kt_accordion_1">
                <div class="accordion-body">
                    <div class="row g-4 row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-5" id="cardContainer1">
                        
                        <div class="col">
                            <div class="card card-flush h-lg-100 ">
                                <div class="card-header px-5 mb-0" style="min-height:55px !important">
                                    <h3 class="card-title align-items-start flex-column mb-0">
                                        <p class="fw-bold mb-0 text-primary">Final Amount</sp>
                                    </h3>
                                </div>
                                <div class="card-body px-5 pb-4 pt-0">
                                    <div class="d-flex flex-stack">
                                        <div class="text-gray-700 fw-semibold fs-6 me-2">
                                           Total:</div>
                                        <div class="d-flex align-items-senter">
                                            <span class=" fw-bold fs-6 text-success">
                                               Rp.<?=number_format($totalFinalAmount, 0, ',', '.')?>
                                               
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                        <div class="col">
                            <div class="card card-flush h-lg-100 ">
                                <div class="card-header px-5 mb-0" style="min-height:55px !important">
                                    <h3 class="card-title align-items-start flex-column mb-0">
                                        <p class="fw-bold mb-0 text-primary">Payment Amount</sp>
                                    </h3>
                                </div>
                                <div class="card-body px-5 pb-4 pt-0">
                                    <div class="d-flex flex-stack">
                                        <div class="text-gray-700 fw-semibold fs-6 me-2">
                                           Total:</div>
                                        <div class="d-flex align-items-senter">
                                            <span class=" fw-bold fs-6 text-success">
                                               Rp.<?=number_format($totalPaymentAmount, 0, ',', '.')?>
                                               
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col">
                            <div class="card card-flush h-lg-100 ">
                                <div class="card-header px-5 mb-0" style="min-height:55px !important">
                                    <h3 class="card-title align-items-start flex-column mb-0">
                                        <p class="fw-bold mb-0 text-primary">Remaining Amount</sp>
                                    </h3>
                                </div>
                                <div class="card-body px-5 pb-4 pt-0">
                                    <div class="d-flex flex-stack">
                                        <div class="text-gray-700 fw-semibold fs-6 me-2">
                                           Total:</div>
                                        <div class="d-flex align-items-senter">
                                            <span class=" fw-bold fs-6 text-success">
                                               Rp.<?=number_format($totalRemainingAmount, 0, ',', '.')?>
                                               
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <button type="button" class="btn gradient-btn rounded-pill mt-10" data-bs-toggle="modal" data-bs-target="#addProduct">
        <i class="ti ti-plus"></i>
        Add Purchases
    </button>
    
    <ul class="nav nav-tabs mt-8">
        <li class="nav-item">
            <a class="nav-link text-dark" aria-current="page" href="<?=base_url('admin/purchases/purchases_paid_page')?>">Paid</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active text-info" href="<?=base_url('admin/purchases/purchases_unpaid_page')?>">Unpaid</a>
        </li>
    </ul>

    <div class="mt-6">
        <table id="purchases_unpaid_table" class="table table-bordered table-striped" style="width:100%">
            <thead>
                <?php $no = 1 ?>
                <tr>
                    <th>No</th>
                    <th>Tanggal Input</th>
                    <th>Supplier</th>
                    <th>Total</th>
                    <th>Potongan</th>
                    <th>Final</th>
                    <th>Sisa</th>
                    <th>Status</th>
                    <th>Type</th>
                    <th>Deskripsi</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($purchases as $purchase): ?>
                <tr>
                    <td><?= $no; ?></td>
                    <td><?=  date('d F Y', strtotime($purchase['input_at'])); ?></td>
                    <td><?= $purchase['name_supplier']; ?></td>
                    <td>Rp.<?= number_format($purchase['total_amount'], 0 , ',', '.'); ?></td>
                    <td>Rp.<?= number_format($purchase['pot_amount'], 0, ',','.' ); ?></td>
                    <td>Rp.<?= number_format($purchase['final_amount'], 0,',', '.'); ?></td>
                    <td>Rp.<?= number_format($purchase['remaining_amount'], 0, ',', '.'); ?></td>
                    <td>
                        <span class="badge gradient-btn-unpaid">Unpaid</span>
                    </td>
                    <td>
                        <?php if($purchase['payment_type'] == 1):?>
                            <span class="badge gradient-btn-debit btn-sm" style="width:50px">
                                 Debit
                            </span>
                        <?php else:?> 
                            <span class="badge gradient-btn-kredit btn-sm" style="width:50px">
                                 Kredit
                            </span>
                        <?php endif; ?>
                    </td>
                    <td><?= $purchase['description']; ?></td>
                    <td>
                        <button 
                            class="btn gradient-btn-edit btn-sm mb-2 rounded-pill btn-pay" style="width : 70px"
                            data-bs-toggle="modal" 
                            data-bs-target="#payModal"
                            data-id-supplier="<?= $purchase['id_purchases']; ?>" 
                            data-final-amount="<?= $purchase['final_amount']; ?>" 
                            data-remaining-amount="<?= $purchase['remaining_amount']; ?>" >
                            PAY
                        </button>
                        <button class="btn gradient-btn-delete mb-2 btn-sm rounded-pill btn-delete-pc" data-id_purchases="<?= $purchase['id_purchases']; ?>" style="width : 70px">
                            DELETE
                        </button>
                    </td>
                </tr>
                <?php $no++?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal Add Supplier -->
    <div class="modal fade" tabindex="-1" id="addProduct">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Add Product</h3>

                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="menu-icon">
							<span class="svg-icon svg-icon-2">
								<i class="ti ti-minus"></i>
							</span>
                        </span>
                    </div>
                </div>

                <div class="modal-body">
                            <form class="form w-100" id="addproduct" data-action="<?= site_url('admin/purchases/add_purchases') ?>" enctype="multipart/form-data">
                                <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                    <span>Supplier</span>
                                </div>
                                <div class="fv-row mb-8">
                                    <select class="form-select" aria-label="Default select example" name="id_supplier">
                                        <option selected>-Supplier-</option>
                                        <?php foreach($suppliers as $supplier):?>
                                            <option value="<?=$supplier['id_supplier']?>"><?=$supplier['name_supplier']?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                    <span>Tanggal Input</span>
                                </div>
                                <div class="fv-row mb-8">
                                    <input type="date" value="<?= date('Y-m-d') ?>" name="input_at"
                                        autocomplete="off" class="form-control bg-transparent" />
                                </div>
                                <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                    <span>Total Amount</span>
                                </div>
                                <div class="fv-row mb-8">
                                    <input type="number" class="form-control" id="total_amount" name="total_amount" placeholder="Enter Total Amount">
                                </div>
                                 <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                    <span>Potongan</span>
                                </div>
                                <div class="fv-row mb-8">
                                    <input type="number" class="form-control" id="pot_amount" name="pot_amount" placeholder="Enter Pot Amount">
                                </div>
                                 <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                    <span>Final</span>
                                </div>
                                <div class="fv-row mb-8">
                                    <input type="number" class="form-control" id="final_amount" name="final_amount" disabled>
                                </div>
                                 <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                    <span>Sisa</span>
                                </div>
                                <div class="fv-row mb-8">
                                    <input type="number" class="form-control" id="remaining_amount" name="remaining_amount" disabled>
                                </div>
                                <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                    <span>Payment Type</span>
                                </div>
                                <div class="fv-row mb-8">
                                    <select class="form-select" aria-label="Default select example" name="payment_type" id="payment_type">
                                        <option selected>-Type-</option>
                                        <option value="1">Debit</option>
                                        <option value="2">Kredit</option>
                                    </select>
                                </div>
                                <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                    <span>Deskripsi</span>
                                </div>
                                <div class="fv-row mb-8">
                                    <textarea type="text" class="form-control" id="description" name="description"></textarea>
                                </div>
                                <div class="d-grid mb-10">
                                    <button type="submit" id="submit_product" class="btn btn-primary">
                                            <span class="indicator-label">
                                                    Add Supplier
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
    <div class="modal fade" id="payModal" tabindex="-1" aria-labelledby="payModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg"> 
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Transaction Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <span>Sisa: <span id="remaining_amount_display" class="text-success"></span></span>
                            </div>
                            <form id="payForm">
                                <input type="hidden" id="edit_id" name="id_purchases">
                                <div class="mb-3">
                                    <label for="form_date" class="form-label">Tanggal</label>
                                    <input type="datetime-local" value="<?= date('Y-m-d\TH:i') ?>" name="payment_date" class="form-control" id="pay_date" required>
                                </div>
                                <div class="mb-3">
                                    <label for="form_text1" class="form-label">Amount</label>
                                    <input type="number" class="form-control" id="pay_amount" placeholder="Rp.1xxxx" name="payment_amount" required>
                                </div>
                                <div class="mb-3">
                                    <label for="form_text2" class="form-label">Deskripsi</label>
                                    <textarea type="text" class="form-control" id="pay_description" placeholder="Enter text" name="description" required> </textarea>
                                </div>
                                <div class="d-grid mb-10 mt-10">
                                    <button type="submit" class="btn btn-primary">
                                        <span class="indicator-label">
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

                        <div class="col-md-6 col-sm">
                            <div class="mb-3">
                                <span>Total: <span id="final_amount_display" class="text-success"></span></span>
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

    <script>
		$('#purchases_unpaid_table').DataTable();


        const base_url = $('meta[name="base_url"]').attr('content');


        //NILAI FORM REMAINING DAN FINAL AMOUNT
        document.addEventListener("DOMContentLoaded", function () {
            const totalAmountInput = document.getElementById("total_amount");
            const potAmountInput = document.getElementById("pot_amount");
            const finalAmountInput = document.getElementById("final_amount");
            const remainingAmountInput = document.getElementById("remaining_amount");
            const paymentTypeSelect = document.getElementById("payment_type"); 

            function calculateAmounts() {
                const totalAmount = parseFloat(totalAmountInput.value) || 0;
                const potAmount = parseFloat(potAmountInput.value) || 0;

                const finalAmount = totalAmount - potAmount;

                const paymentType = paymentTypeSelect.value; 
                const remainingAmount = paymentType === "1" ? 0 : finalAmount;

                finalAmountInput.value = finalAmount; 
                remainingAmountInput.value = remainingAmount;
            }

            totalAmountInput.addEventListener("input", calculateAmounts);
            potAmountInput.addEventListener("input", calculateAmounts);
            paymentTypeSelect.addEventListener("change", calculateAmounts); 
        });


        //ADD PAY 
        const exampleModal = document.getElementById('payModal');
        exampleModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id-supplier');
            const finalAmount = button.getAttribute('data-final-amount');
            const remainingAmount = button.getAttribute('data-remaining-amount');

            console.log("Final Amount:", finalAmount);
            console.log("Remaining Amount:", remainingAmount);
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

            $('#final_amount_display').text(formatToRupiah(finalAmount));
            $('#remaining_amount_display').text(formatToRupiah(remainingAmount));
            $("#edit_id").val(id);

            $.ajax({
                url: base_url + 'admin/purchases/pay_logs',
                method: 'POST',
                data: { id: id },
                dataType: 'json',
                success: function (response) {
                    const logList = $('#log_list');
                    logList.empty();
                    if (response.logs && response.logs.length > 0) {
                        response.logs.forEach(log => {
                            const formattedDate = formatDate(log.payment_date);
                            const formattedAmount = formatToRupiah(log.payment_amount);
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

            
            $("#payForm").on("submit", function (e) {
                e.preventDefault();

                const submitButton = $("#payForm button[type=submit]");
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
                            url: base_url + "admin/purchases/add_pay",
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

        function preventMultipleSubmit(form) {
            const submitButton = form.querySelector('button[type="submit"]');
            if (submitButton) {
                submitButton.disabled = true; 
                submitButton.textContent = 'Submitting...'; 
            }
            return true; 
        }

	</script>
</main>