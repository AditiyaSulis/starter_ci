<main>
    <h1>Purchases</h1>

	<!-- CARD JATUH TEMPO -->
	<div class="row g-4 mb-5 row-cols-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-5 mt-5" id="card-container1">

		<div class="col">
			<div class="card bg-body bg-light-warning bg-gradient">
				<div class="card-body py-4 ">
					<div class="row">
						<div class="col-md-6">
							<div class="text-gray-900 fw-bolder fs-2">
								<span class="text-success" data-category-id="<?= $total_jatuh_tempo?>">
									<?= $total_jatuh_tempo?>
								</span>

							</div>
							<span class="text-danger" style="font-weight: bold"><?= date("d M")?> - <?=date('d M', strtotime('+3 days'))?> </span>
						</div>

						<div class="col-md-6 d-flex justify-content-center align-items-center">
							<h1><i class="bi bi-bell-fill" style="color:orangered; font-size: 3rem;" ></i></h1>
						</div>
					</div>
				</div>

				<div class="bg-light-primary bg-gradient progress-bar-striped py-3 px-6 rounded-bottom-2">
					<div class="row align-items-center" >
						<div class="col-md-10">
								<span class="text-dark" style="font-weight: bold ">
									Cek piutang yang jatuh tempo
								</span>
						</div>
						<div class="col-md-2">
							<i class="bi bi-arrow-right-circle icon-check-piutang" onclick="showJatuhTempo()" style="font-size:2rem;" ></i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

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
                                        <p class="fw-bold mb-0 text-primary">Final Amount</p>
                                    </h3>
                                </div>
                                <div class="card-body px-5 pb-4 pt-0">
                                    <div class="d-flex flex-stack">
                                        <div class="text-gray-700 fw-semibold fs-6 me-2">
                                           Total:</div>
                                        <div class="d-flex align-items-senter">
                                            <span class=" fw-bold fs-6 text-success">
                                               Rp.<?=number_format($totalFinalAmount)?>
                                               
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
                                        <p class="fw-bold mb-0 text-primary">Payment Amount</p>
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
                                        <p class="fw-bold mb-0 text-primary">Remaining Amount</p>
                                    </h3>
                                </div>
                                <div class="card-body px-5 pb-4 pt-0">
                                    <div class="d-flex flex-stack">
                                        <div class="text-gray-700 fw-semibold fs-6 me-2">
                                           Total:</div>
                                        <div class="d-flex align-items-senter">
                                            <span class=" fw-bold fs-6 text-success">
                                               Rp.<?=number_format($totalRemainingAmount , 0, ',', '.')?>
                                               
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
        <i class="bi bi-plus-circle"></i>
        Add Purchases
    </button>
    
    <ul class="nav nav-tabs mt-8">
        <li class="nav-item">
            <a class="nav-link active text-info" aria-current="page" href="<?=base_url('admin/purchases/purchases_paid_page?status_purchases=1')?>">Paid</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-dark" href="<?=base_url('admin/purchases/purchases_unpaid_page?status_purchases=0')?>">Unpaid</a>
        </li>
    </ul>


	<?php $this->load->view($view_data);?>
	<?php $this->load->view($view_component);?>

    <!-- Modal Add Purchase -->
    <div class="modal fade" tabindex="-1" id="addProduct">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Add Purchase</h3>

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
									<span>Jatuh Tempo</span>
								</div>
								<div class="fv-row mb-8">
									<input type="date" class="form-control" id="jatuh_tempo" name="jatuh_tempo">
								</div>
                                <div class="fv-row ml-4 pl-5 mb-2 text-gray-900 fw-bolder">
                                    <span>Description</span>
                                </div>
                                <div class="fv-row mb-8">
                                    <textarea type="text" class="form-control" id="description" name="description"></textarea>
                                </div>
                                <div class="d-grid mb-10">
                                    <button type="submit" id="submit_product" class="btn btn-primary">
                                            <span class="indicator-label">
                                                    Add Purchase
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

	<!-- Modal datatables -->
	<div class="modal" id="jatuhTempoModal" tabindex="-1">
		<div class="modal-dialog modal-xl">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Jatuh Tempo</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="table-responsive">
						<table id="jatuhtempo_table" class="table table-bordered table-striped border-primary" style="width:100%">
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
								<th>Jatuh Tempo</th>
								<th>Deskripsi</th>
								<th>Action</th>
							</tr>
							</thead>
							<tbody>
							<?php foreach ($jatuh_tempo as $purchase): ?>
								<tr>
									<td><?= $no; ?></td>
									<td><?= date('d F Y', strtotime($purchase['input_at'])); ?></td>
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
									<td><?= date('d F Y', strtotime($purchase['jatuh_tempo']))?></td>
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
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

    <script>

        const base_url = $('meta[name="base_url"]').attr('content');

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

		//ALERT JATUH TEMPO
		$('#jatuhtempo_table').DataTable({
			responsive: true,
			scrollX: true,
			autoWidth: false,
			columnDefs: [
				{ width: '150px', targets: [2, 3, 4, 5] },
				{ className: "text-nowrap", targets: "_all" }
			]
		});

		function showJatuhTempo(){

			$("#jatuhTempoModal").modal("show");
		}



	</script>
</main>
