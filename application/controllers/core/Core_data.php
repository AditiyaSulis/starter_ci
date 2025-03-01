<?php
class Core_data extends MY_Controller{

    function __construct()
    {
        parent::__construct();
        $this->load->model('M_employees');
        $this->load->model('M_piutang');
        $this->load->model('M_purchases');
        $this->load->model('M_purchase_piutang');
        $this->load->model('M_izin');
        $this->load->model('M_overtime');
        $this->load->model('M_leave');
        $this->load->model('M_day_off');
        $this->load->model('M_holyday');
        $this->load->model('M_payroll');
        $this->load->model('M_payroll_component');
        $this->load->model('M_schedule');
        $this->load->model('M_rekap');
        $this->load->model('M_attendance');
        $this->load->model('M_service_teknisi');
    }

	public function data_piutang()
	{
		$tenor = $this->input->post('tanggal_pelunasan');
		$type = $this->input->post('type');
		$status_piutang = $this->input->post('status_piutang');

		$list = $this->M_piutang->get_datatables();

		$data = [];
		$no = $this->input->post('start');

		foreach($list as $item) {

			$type_ten = '';
			if($item['type_tenor'] == 1) {
				$type_ten = 'Hari';
			} else if($item['type_tenor'] == 2) {
				$type_ten = 'Minggu';
			}else if($item['type_tenor'] == 3) {
				$type_ten = 'Bulan';
			}else if($item['type_tenor'] == 4) {
				$type_ten = 'Tahun';
			}
			$action = $status_piutang == 1 ?
						'   
                        <button 
                            class="btn btn-warning btn-sm mb-2 rounded-pill btn-pay-piutang" style="width : 70px"
                            data-bs-toggle="modal" 
                            data-bs-target="#logPiutangModal"
                            data-id_piutang="'.htmlspecialchars($item['id_piutang']).'"
                            data-name_log="'.htmlspecialchars($item['name']).'"
                            data-totals_log="'.htmlspecialchars($item['amount_piutang']).'"
                            data-paydate_log="'.htmlspecialchars($item['piutang_date']).'"
                            data-tgl_lunas_log="'.htmlspecialchars($item['tgl_lunas']).'">
                             LOG
                        </button>
                        <button class="btn gradient-btn-delete btn-sm mb-2 rounded-pill btn-delete-piutang" onclick="handleDeleteButton('.htmlspecialchars($item['id_piutang']).')" style="width : 70px">
                            DELETE
                        </button>
						'
						:
						'   
                        <button 
                            class="btn btn-warning btn-sm mb-2 rounded-pill btn-pay-piutang" style="width : 70px"
                            data-bs-toggle="modal" 
                            data-bs-target="#payPiutangModal"
                            data-id_piutang="'.htmlspecialchars($item['id_piutang']).'"
                            data-remaining_piutang="'.htmlspecialchars($item['remaining_piutang']).'"
                            data-tgl_lunas="'.htmlspecialchars($item['tgl_lunas']).'"
                            data-tenor_piutang="'.htmlspecialchars($item['tenor_piutang']).'"
                            data-angsuran="'.htmlspecialchars($item['angsuran']).'"
                            data-type_tenor="'.htmlspecialchars($item['type_tenor']).'">
                             PAY
                        </button>
                        <button class="btn gradient-btn-delete btn-sm mb-2 rounded-pill btn-delete-piutang" onclick="handleDeleteButton('.htmlspecialchars($item['id_piutang']).')" style="width : 70px">
                            DELETE
                        </button>
						';
						
			$status = $item['status_piutang'] == 2 ?
						'
						  <td>
							  <span class="badge gradient-btn-unpaid btn-sm " style="width : 50px">
								  Unpaid
							  </span>
						  </td>
					    '
						:
						'
						  <td>
							  <span class="badge gradient-btn-paid btn-sm " style="width : 50px">
								  Paid
							  </span>
						  </td>
					   ';

			$row = [];
			$row[] = ++$no;
			$row[] = date('d M Y', strtotime($item['piutang_date']));
			$row[] = $item['name'];
			$row[] = $item['type_piutang'] == '2' ? 'Kasbon' : 'Pinjaman';
			$row[] = $item['tenor_piutang'] . ' ' . $type_ten;
			$row[] = 'Tanggal '.$item['jatuh_tempo'];
			$row[] = date('d M Y', strtotime($item['tgl_lunas']));
			$row[] = 'Rp.'. number_format($item['amount_piutang'], 0 , ',', '.');
			$row[] = 'Rp.'. number_format($item['remaining_piutang'], 0 , ',', '.');
			$row[] = $status;
			$row[] = 'Rp.'. number_format($item['angsuran'], 0 , ',', '.');
			$row[] = $item['description_piutang'];
			$row[] = $action;
			$data[] = $row;
		}

		$output = [
			"draw" =>@$_POST['draw'],
			"recordsTotal" => $this->M_piutang->count_all(),
			"recordsFiltered" => $this->M_piutang->count_filtered(),
			"tenor" => $tenor,
			"type" => $type,
			"data" => $data,
		];

		echo json_encode($output);
	}


	public function data_purchases()
	{
		$option = $this->input->post('option');
		$startDate = $this->input->post('startDate');
		$endDate = $this->input->post('endDate');
		$status = $this->input->post('status_purchases');

		$list = $this->M_purchases->get_datatables();

		$data = [];
		$no = $this->input->post('start');

		foreach($list as $item) {
			$action = $status == 1 ?
					'   
                        <button 
                            class="btn btn-warning btn-sm mb-2 rounded-pill btn-pay-piutang" style="width : 70px"
                            data-bs-toggle="modal" 
                            data-bs-target="#logModal"
                            data-id-supplier="'.htmlspecialchars($item['id_purchases']).'"
                            data-final-amount="'.htmlspecialchars($item['final_amount']).'"
                            data-remaining-amount="'.htmlspecialchars($item['remaining_amount']).'">
                            LOG
                        </button>
                        <button class="btn gradient-btn-delete btn-sm mb-2 rounded-pill btn-delete-pc" onclick="handleDeletePurchaseButton('.htmlspecialchars($item['id_purchases']).')" style="width : 70px">
                            DELETE
                        </button>
                     '
					:
					'   
                        <button 
                            class="btn btn-warning btn-sm mb-2 rounded-pill btn-pay-piutang" style="width : 70px"
                            data-bs-toggle="modal" 
                            data-bs-target="#payModal"
                            data-id-supplier="'.htmlspecialchars($item['id_purchases']).'"
                            data-final-amount="'.htmlspecialchars($item['final_amount']).'"
                            data-remaining-amount="'.htmlspecialchars($item['remaining_amount']).'">
                             PAY
                        </button>
                        <button class="btn gradient-btn-delete btn-sm mb-2 rounded-pill btn-delete-pc" onclick="handleDeletePurchaseButton('.htmlspecialchars($item['id_purchases']).')" style="width : 70px">
                            DELETE
                        </button>
                     ';

			$status = $item['status_purchases'] == 0 ?
							'
                              <td>
                                  <span class="badge gradient-btn-unpaid btn-sm " style="width : 50px">
                                      Unpaid
                                  </span>
                              </td>
                           '
							:
							'
                              <td>
                                  <span class="badge gradient-btn-paid btn-sm " style="width : 50px">
                                      Paid
                                  </span>
                              </td>
                           ';

			$type = $item['payment_type'] == 1 ?
							'
                              <td>
                                 <span class="badge gradient-btn-debit btn-sm" style="width:50px">
                                 	Debit
                           		 </span>
                              </td>
                           	'
							:
							'
                              <td>
                                  <span class="badge gradient-btn-kredit btn-sm" style="width:50px">
                                 	Kredit
                            	  </span>
                              </td>
                           ';

			$row = [];
			$row[] = ++$no;
			$row[] = date('d M Y', strtotime($item['input_at']));
			$row[] = $item['name_supplier'];
			$row[] = 'Rp.'. number_format($item['total_amount'], 0 , ',', '.');
			$row[] = 'Rp.'. number_format($item['pot_amount'], 0 , ',', '.');
			$row[] = 'Rp.'. number_format($item['final_amount'], 0 , ',', '.');
			$row[] = 'Rp.'. number_format($item['remaining_amount'], 0 , ',', '.');
			$row[] = $status;
			$row[] = $type;
			$row[] = date('d M Y', strtotime($item['jatuh_tempo']));
			$row[] = $item['description'];
			$row[] = $action;
			$data[] = $row;
		}

		$output = [
			"draw" =>@$_POST['draw'],
			"recordsTotal" => $this->M_purchases->count_all(),
			"recordsFiltered" => $this->M_purchases->count_filtered(),
			"option" => $option,
			"startDate" => $startDate,
			"endDate" => $endDate,
			"data" => $data,
		];

		echo json_encode($output);
	}


	public function data_izin()
	{
		$option = $this->input->post('option');
		$startDate = $this->input->post('startDate');
		$endDate = $this->input->post('endDate');
		$employee = $this->input->post('employee');


		$list = $this->M_izin->get_datatables();

		$data = [];
		$no = $this->input->post('start');

		foreach($list as $item) {
			$action = $employee == 'false' ?
				     '     
                        <a href="javascript:void(0)" onclick="updateBukti(this)" class="btn btn-success btn-sm rounded-pill btn-stts mb-2" style="width : 90px"
								data-id_izin="'. $item['id_izin'].'"
								data-bukti_surat_sakit="'. $item['bukti_surat_sakit'].'">
								 ADD SKD
						</a>
                        <button class="btn gradient-btn-delete btn-sm mb-2 rounded-pill btn-delete-izin" onclick="handleDeleteIzinButton('.htmlspecialchars($item['id_izin']).')" style="width : 90px">
                            DELETE
                        </button>
                     ':
					'     
					<a href="javascript:void(0)" onclick="updateBukti(this)" class="btn btn-success btn-sm rounded-pill btn-stts mb-2" style="width : 90px"
							data-id_izin="'. $item['id_izin'].'"
							data-bukti_surat_sakit="'. $item['bukti_surat_sakit'].'">
							 ADD SKD
					</a>
					';

			if($item['status'] == 1 && $employee == 'false'){
				$status =
						  ' 	
							<td>
							   <a href="javascript:void(0)" onclick="setStatusIzin(this)" class="btn btn-danger btn-sm rounded-pill btn-stts" style="width : 140px"
								data-id_izin="'. $item['id_izin'].'"
								data-id_employee="'. $item['id_employee'].'"
								data-tanggal_izin="'. $item['tanggal_izin'].'"
								data-status="'. $item['status'].'">
									<i class="ti ti-check"></i> Disapproval
								</a>
							</td>
						  ';
			}
			else if($item['status'] == 2 && $employee == 'false'){
				$status =  '
                             <td>
							   <a href="javascript:void(0)" onclick="setStatusIzin(this)" class="btn btn-primary btn-sm rounded-pill btn-stts" style="width : 120px"
								data-id_izin="'. $item['id_izin'].'"
								data-id_employee="'. $item['id_employee'].'"
								data-tanggal_izin="'. $item['tanggal_izin'].'"
								data-status="'. $item['status'].'">
									<i class="ti ti-check"></i> Approval
								</a>
							</td>
                           ';
			}
			else if ($item['status'] == 3 && $employee == 'false') {
				$status =  '
                             <td>
							   <a a href="javascript:void(0)" onclick="setStatusIzin(this)" class="btn btn-info btn-sm rounded-pill btn-stts" style="width : 120px"
								data-id_izin="'. $item['id_izin'].'"
								data-id_employee="'. $item['id_employee'].'"
								data-tanggal_izin="'. $item['tanggal_izin'].'"
								data-status="'. $item['status'].'">
									<i class="ti ti-check"></i> Pending
								</a>
							</td>
                           ';
			}
			else if($item['status'] == 1 && $employee != 'false'){
				$status =
					' 	
							<td>
							   <button class="btn btn-danger btn-sm rounded-pill btn-stts" style="width : 140px" disabled >
									<i class="ti ti-check"></i> Disapproval
								</button>
							</td>
						  ';
			}
			else if($item['status'] == 2 && $employee != 'false'){
				$status =  '
                             <td>
							   <button class="btn btn-primary btn-sm rounded-pill btn-stts" style="width : 120px" disabled >
									<i class="ti ti-check"></i> Approval
								</button>
							</td>
                           ';
			}
			else if ($item['status'] == 3 && $employee != 'false') {
				$status =  '
                             <td>
							   <button  class="btn btn-info btn-sm rounded-pill btn-stts" style="width : 120px" disabled >
									<i class="ti ti-check"></i> Pending
								</button>
							</td>
                           ';
			}

			$bukti = $item['bukti_surat_sakit'] == '-' ? '<td>
															<span> - </span>
															</td>
															':
															'<td>
																<img src="' . base_url('uploads/bukti/compressed/' . $item['bukti_surat_sakit']) . '"  alt="Logo" width="50" style="cursor: pointer;"  onclick="showImageModal(\'' . base_url('uploads/bukti/compressed/' . $item['bukti_surat_sakit']) . '\')">
															</td>';

			$row = [];
			$row[] = ++$no;
			$row[] = date('d M Y', strtotime($item['input_at']));
			$row[] = $item['name'];
			$row[] = $item['name_product'];
			$row[] = $item['name_division'];
			$row[] = date('d M Y', strtotime($item['tanggal_izin']));
			$row[] = $item['alasan_izin'];
			$row[] = $bukti;
			$row[] = $status;
			$row[] = $item['description'];
			$row[] = $action;
			$data[] = $row;
		}

		$output = [
			"draw" =>@$_POST['draw'],
			"recordsTotal" => $this->M_izin->count_all(),
			"recordsFiltered" => $this->M_izin->count_filtered(),
			"option" => $option,
			"startDate" => $startDate,
			"endDate" => $endDate,
			"data" => $data,
		];

		echo json_encode($output);
	}


	public function data_overtime()
	{
		$option = $this->input->post('option');
		$startDate = $this->input->post('startDate');
		$endDate = $this->input->post('endDate');
		$is = $this->input->post('is');
		$employee = $this->input->post('employee');


		$list = $this->M_overtime->get_datatables();

		$status ='';

		$data = [];
		$no = $this->input->post('start');

		foreach($list as $item) {
			$action = $is == 1 || $is == 2 ?
					'  
                        <button class="btn gradient-btn-delete btn-sm mb-2 rounded-pill btn-delete-overtime" onclick="handleDeleteOvertimeButton('.htmlspecialchars($item['id_overtime']).')" style="width : 70px">
                            DELETE
                        </button>
                     ':
					'';

			if($item['status'] == 1 && $is !=3 && $employee == 'false'){
				$status =
					' 	
							<td>
							   <a href="javascript:void(0)" onclick="setStatusOvertime(this)" class="btn btn-danger btn-sm rounded-pill btn-stts" style="width : 140px"
								data-id_overtime="'. $item['id_overtime'].'"
								data-status="'. $item['status'].'">
									<i class="ti ti-check"></i> Disapproval
								</a>
							</td>
						  ';
			}
			else if($item['status'] == 2 && $is !=3 && $employee == 'false'){
				$status =  '
                             <td>
							   <a href="javascript:void(0)" onclick="setStatusOvertime(this)" class="btn btn-primary btn-sm rounded-pill btn-stts" style="width : 120px"
								data-id_overtime="'. $item['id_overtime'].'"
								data-status="'. $item['status'].'">
									<i class="ti ti-check"></i> Approval
								</a>
							</td>
                           ';
			}
			else if ($item['status'] == 3 && $is !=3 && $employee == 'false') {
				$status =  '
                             <td>
							   <a href="javascript:void(0)" onclick="setStatusOvertime(this)" class="btn btn-info btn-sm rounded-pill btn-stts" style="width : 120px"
								data-id_overtime="'. $item['id_overtime'].'"
								data-status="'. $item['status'].'">
									<i class="ti ti-check"></i> Pending
								</a>
							</td>
                           ';
			}
			else if($item['status'] == 1 && $is ==3 && $employee != 'false'){
				$status =
					' 	
							<td>
							   <button  class="btn btn-danger btn-sm rounded-pill btn-stts" style="width : 140px" disabled>
									<i class="ti ti-check"></i> Disapproval
								</button>
							</td>
						  ';
			}
			else if($item['status'] == 2 &&  $is ==3 && $employee != 'false'){
				$status =  '
                             <td>
							   <button class="btn btn-primary btn-sm rounded-pill btn-stts" style="width : 120px" disabled>
									<i class="ti ti-check"></i> Approval
								</button>
							</td>
                           ';
			}
			else if ($item['status'] == 3 &&  $is ==3 && $employee != 'false') {
				$status =  '
                             <td>
							   <button class="btn btn-info btn-sm rounded-pill btn-stts" style="width : 120px" disabled>
									<i class="ti ti-check"></i> Pending
								</button>
							</td>
                           ';
			}



			$row = [];
			$row[] = ++$no;
			$row[] = date('d M Y', strtotime($item['input_at']));
			$row[] = $item['name'];
			$row[] = $item['name_product'];
			$row[] = $item['name_division'];
			$row[] = date('d M Y', strtotime($item['tanggal']));;
			$row[] = $item['start'];
			$row[] = $item['end'];
			$row[] =  number_format($item['time_spend'], 0 , ',', '.') .' Jam';
			$row[] =  'Rp.'.number_format($item['pay'], 0 , ',', '.');
			$row[] = $status;
			$row[] = $item['description'];
			$row[] = $action;
			$data[] = $row;
		}

		$output = [
			"draw" =>@$_POST['draw'],
			"recordsTotal" => $this->M_overtime->count_all(),
			"recordsFiltered" => $this->M_overtime->count_filtered(),
			"option" => $option,
			"startDate" => $startDate,
			"endDate" => $endDate,
			"data" => $data,
		];

		echo json_encode($output);
	}


	public function data_leave()
	{
		$option = $this->input->post('option');
		$startDate = $this->input->post('startDate');
		$endDate = $this->input->post('endDate');
		$is = $this->input->post('is');
		$employee = $this->input->post('employee');

		$status = '';

		$list = $this->M_leave->get_datatables();

		$data = [];
		$no = $this->input->post('start');

		foreach($list as $item) {
			$action = $is == 1 || $is == 2  ?
					'   
                        <button class="btn gradient-btn-delete btn-sm mb-2 rounded-pill btn-delete-leave" onclick="handleDeleteLeaveButton('.htmlspecialchars($item['id_cuti']).')" style="width : 70px">
                            DELETE
                        </button>
                     ':
					'-';

			$endDay = $item['end_day'] == null ? '-' :  date('d M Y', strtotime($item['end_day']));
			if($item['status'] == 1 && $is !=3 && $employee == 'false'){
				$status =
					' 	
							<td>
							   <a href="javascript:void(0)" onclick="setStatusLeave(this)" class="btn btn-danger btn-sm rounded-pill btn-stts" style="width : 140px"
								data-id_cuti="'. $item['id_cuti'].'"
								data-type="'. $item['type'].'"
								data-id_employee="'. $item['id_employee'].'"
								data-start_day="'. $item['start_day'].'"
								data-end_day="'. $endDay.'"
								data-status="'. $item['status'].'">
									<i class="ti ti-check"></i> Disapproval
								</a>
							</td>
						  ';
			}
			else if($item['status'] == 2 && $is !=3 && $employee == 'false'){
				$status =  '
                             <td>
							   <a href="javascript:void(0)" onclick="setStatusLeave(this)" class="btn btn-primary btn-sm rounded-pill btn-stts" style="width : 120px"
								data-id_cuti="'. $item['id_cuti'].'"
								data-type="'. $item['type'].'"
								data-id_employee="'. $item['id_employee'].'"
								data-start_day="'. $item['start_day'].'"
								data-end_day="'. $endDay.'"
								data-status="'. $item['status'].'">
									<i class="ti ti-check"></i> Approval
								</a>
							</td>
                           ';
			}
			else if ($item['status'] == 3 && $is !=3 && $employee == 'false') {
				$status =  '
                             <td>
							   <a a href="javascript:void(0)" onclick="setStatusLeave(this)" class="btn btn-info btn-sm rounded-pill btn-stts" style="width : 120px"
								data-id_cuti="'. $item['id_cuti'].'"
								data-type="'. $item['type'].'"
								data-id_employee="'. $item['id_employee'].'"
								data-start_day="'. $item['start_day'].'"
								data-end_day="'. $endDay.'"
								data-status="'. $item['status'].'">
									<i class="ti ti-check"></i> Pending
								</a>
							</td>
                           ';
			}
			else if($item['status'] == 1 && $is ==3 && $employee != 'false'){
				$status =
						' 	
							<td>
							   <button class="btn btn-danger btn-sm rounded-pill btn-stts" style="width : 140px" disabled>
									<i class="ti ti-check"></i> Disapproval
								</button>
							</td>
						  ';
			}
			else if($item['status'] == 2 && $is ==3 && $employee != 'false'){
				$status =  '
                             <td>
							   <button class="btn btn-primary btn-sm rounded-pill btn-stts" style="width : 120px" disabled>
									<i class="ti ti-check"></i> Approval
								</button>
							</td>
                           ';
			}
			else if ($item['status'] == 3 && $is ==3 && $employee != 'false') {
				$status =  '
                             <td>
							   <button class="btn btn-info btn-sm rounded-pill btn-stts" style="width : 120px" disabled>
									<i class="ti ti-check"></i> Pending
								</button>
							</td>
                           ';
			}



			$row = [];
			$row[] = ++$no;
			$row[] = date('d M Y', strtotime($item['input_at']));
			$row[] = $item['name'];
			$row[] = $item['name_product'];
			$row[] = $item['name_division'];
			$row[] = $item['type'] == 1 ? 'Single Day' : 'Multiple Days';
			$row[] = $item['total_days'] . ' Hari' ;
			$row[] =  date('d M Y', strtotime($item['start_day']));
			$row[] =  $endDay;
			$row[] = $item['description'];
			$row[] = $status;
			$row[] = $action;
			$data[] = $row;
		}

		$output = [
			"draw" =>@$_POST['draw'],
			"recordsTotal" => $this->M_leave->count_all(),
			"recordsFiltered" => $this->M_leave->count_filtered(),
			"option" => $option,
			"startDate" => $startDate,
			"endDate" => $endDate,
			"data" => $data,
		];

		echo json_encode($output);
	}


	public function data_day_off()
	{
		$option = $this->input->post('option');
		$startDate = $this->input->post('startDate');
		$endDate = $this->input->post('endDate');
		$is = $this->input->post('is');
		$id = $this->input->post('employee');

		$list = $this->M_day_off->get_datatables();
		$status  = '';

		$data = [];
		$no = $this->input->post('start');

		foreach($list as $item) {
			$action = $is == 1 || $is == 2 ?
					 '   
                        <button class="btn gradient-btn-delete btn-sm mb-2 rounded-pill btn-delete-day_off" onclick="handleDeleteDayoffButton('.htmlspecialchars($item['id_day_off']).')" style="width : 70px">
                            DELETE
                        </button>
                     ':
					'-';


			if($item['status'] == 1 && $id == 'false' && $is !=3){
				$status =
					' 	
							<td>
							   <a href="javascript:void(0)" onclick="setStatusDayoff(this)" class="btn btn-danger btn-sm rounded-pill btn-stts" style="width : 140px"
								data-id_day_off="'. $item['id_day_off'].'"
								data-id_employee="'. $item['id_employee'].'"
								data-tgl_day_off="'. $item['tgl_day_off'].'"
								data-status="'. $item['status'].'">
									<i class="ti ti-check"></i> Disapproval
								</a>
							</td>
						  ';
			}
			else if($item['status'] == 2 &&  $id == 'false'  && $is !=3){
				$status =  '
                             <td>
							   <a href="javascript:void(0)" onclick="setStatusDayoff(this)" class="btn btn-primary btn-sm rounded-pill btn-stts" style="width : 120px"
								data-id_day_off="'. $item['id_day_off'].'"
								data-id_employee="'. $item['id_employee'].'"
								data-tgl_day_off="'. $item['tgl_day_off'].'"
								data-status="'. $item['status'].'">
									<i class="ti ti-check"></i> Approval
								</a>
							</td>
                           ';
			}
			else if ($item['status'] == 3 &&  $id == 'false'  && $is !=3) {
				$status =  '
                             <td>
							   <a a href="javascript:void(0)" onclick="setStatusDayoff(this)" class="btn btn-info btn-sm rounded-pill btn-stts" style="width : 120px"
								data-id_day_off="'. $item['id_day_off'].'"
								data-id_employee="'. $item['id_employee'].'"
								data-tgl_day_off="'. $item['tgl_day_off'].'"
								data-status="'. $item['status'].'">
									<i class="ti ti-check"></i> Pending
								</a>
							</td>
                           ';
			}
			else if($item['status'] == 1 &&  $id != 'false'  && $is ==3){
				$status =
					' 	
							<td>
							   <button class="btn btn-danger btn-sm rounded-pill btn-stts" style="width : 140px" disabled="">
									<i class="ti ti-check"></i> Disapproval
								</button>
							</td>
						  ';
			}
			else if($item['status'] == 2 && $id != 'false' && $is ==3){
				$status =  '
                             <td>
							   <button class="btn btn-primary btn-sm rounded-pill btn-stts" style="width : 120px">
									<i class="ti ti-check"></i> Approval
								</button>
							</td>
                           ';
			}
			else if ($item['status'] == 3 && $id != 'false' && $is ==3) {
				$status =  '
                             <td>
							   <button class="btn btn-info btn-sm rounded-pill btn-stts" style="width : 120px" disabled>
									<i class="ti ti-check"></i> Pending
								</button>
							</td>
                           ';
			}



			$row = [];
			$row[] = ++$no;
			$row[] = date('d M Y', strtotime($item['input_at']));
			$row[] = $item['name'];
			$row[] = $item['name_product'];
			$row[] = $item['name_division'];
			$row[] = date('d M Y', strtotime($item['tgl_day_off']));
			$row[] = $item['description'];
			$row[] = $status;
			$row[] = $action;
			$data[] = $row;
		}

		$output = [
			"draw" =>@$_POST['draw'],
			"recordsTotal" => $this->M_day_off->count_all(),
			"recordsFiltered" => $this->M_day_off->count_filtered(),
			"option" => $option,
			"startDate" => $startDate,
			"endDate" => $endDate,
			"data" => $data,
		];

		echo json_encode($output);
	}


	public function data_holyday()
	{
		$option = $this->input->post('option');
		$startDate = $this->input->post('startDate');
		$endDate = $this->input->post('endDate');


		$list = $this->M_holyday->get_datatables();

		$data = [];
		$no = $this->input->post('start');

		foreach($list as $item) {
			$action =
					'   
                        <button class="btn gradient-btn-delete btn-sm mb-2 rounded-pill btn-delete-holyday" onclick="handleDeleteHolydayButton('.htmlspecialchars($item['id_holyday']).')" style="width : 70px">
                            DELETE
                        </button>
                     ';

			$type_day =  $item['type_day'] == 1 ? 'Single Day' : 'Multiple Days';
			$end_day =  $item['type_day'] == 1 ? '-' : date('d M Y', strtotime($item['end_day']));

			$row = [];
			$row[] = ++$no;
			$row[] = $item['code_holyday'];
			$row[] = $item['name_product'];
			$row[] = $item['name_division'];
			$row[] = $type_day;
			$row[] = date('d M Y', strtotime($item['date']));
			$row[] = $action;
			$data[] = $row;
		}

		$output = [
			"draw" =>@$_POST['draw'],
			"recordsTotal" => $this->M_holyday->count_all(),
			"recordsFiltered" => $this->M_holyday->count_filtered(),
			"option" => $option,
			"startDate" => $startDate,
			"endDate" => $endDate,
			"data" => $data,
		];

		echo json_encode($output);
	}


	public function data_schedule()
	{
		$option = $this->input->post('option');
		$startDate = $this->input->post('startDate');
		$endDate = $this->input->post('endDate');


		$list = $this->M_schedule->get_datatables();

		$data = [];
		$no = $this->input->post('start');

		foreach($list as $item) {
			$action =
				'   
                        <button class="btn gradient-btn-delete btn-sm mb-2 rounded-pill btn-delete-schedule" onclick="handleDeleteScheduleButton('.htmlspecialchars($item['id_schedule']).')" style="width : 70px">
                            DELETE
                        </button>
                     ';


			$row = [];
			$row[] = ++$no;
			$row[] = $item['name_workshift'];
			$row[] = $item['name'];
			$row[] = $item['status'];
			$row[] = date('d M Y', strtotime($item['waktu']));
			$row[] = $action;
			$data[] = $row;
		}

		$output = [
			"draw" =>@$_POST['draw'],
			"recordsTotal" => $this->M_schedule->count_all(),
			"recordsFiltered" => $this->M_schedule->count_filtered(),
			"option" => $option,
			"startDate" => $startDate,
			"endDate" => $endDate,
			"data" => $data,
		];

		echo json_encode($output);
	}


	public function data_payroll()
	{
		$option = $this->input->post('option');
		$startDate = $this->input->post('startDate');
		$endDate = $this->input->post('endDate');

		$list = $this->M_payroll->get_datatables();

		$data = [];
		$no = $this->input->post('start');


		foreach($list as $item) {
			$action =
					'   
                      <a href="'. base_url('admin/payroll/detail_payroll?payroll='.$item['id_payroll']) .'" 
						   class="btn btn-warning btn-sm rounded-pill mb-1" 
						   style="width: 100px;">
						   DETAIL
						</a>
                         <button class="btn  gradient-btn-delete btn-sm rounded-pill" 
								onclick="handleDeletePayrollButton('. htmlspecialchars($item['id_payroll']) .')" 
								style="width: 100px;">
							DELETE
						</button>
                     ';

			$piutang = $item['include_piutang'] == 1 ? 'Yes' : 'No';
			$finance_record = $item['include_finance_record'] == 1 ? 'Yes' : 'No';
			$holiday = $item['include_holiday'] == 1 ? 'Yes' : 'No';
			$cuti = $item['include_cuti'] == 1 ? 'Yes' : 'No';
			$telat = $item['include_potongan_telat'] == 1 ? 'Yes' : 'No';

			$row = [];
			$row[] = ++$no;
			$row[] = date('d M Y', strtotime($item['input_at']));
			$row[] = $item['code_payroll'];
			$row[] = $piutang;
			$row[] = $finance_record;
			$row[] = $holiday;
			$row[] = $cuti;
			$row[] = $telat;
			$row[] = date('d M Y', strtotime($item['tanggal_gajian']));
			$row[] = $action;
			$data[] = $row;
		}

		$output = [
			"draw" =>@$_POST['draw'],
			"recordsTotal" => $this->M_payroll->count_all(),
			"recordsFiltered" => $this->M_payroll->count_filtered(),
			"option" => $option,
			"startDate" => $startDate,
			"endDate" => $endDate,
			"data" => $data,
		];

		echo json_encode($output);
	}


	public function data_payroll_component()
	{
		$payroll = $this->input->post('payroll', true);
		$list = $this->M_payroll_component->get_datatables();

		$data = [];
		$no = $this->input->post('start');

		foreach($list as $item) {
			$action =
					'    <button 
                            class="btn btn-warning btn-sm mb-2 rounded-pill btn-rincian-gaji" style="width : 90px"
                            data-bs-toggle="modal" 
                            data-bs-target="#rincianModal"
                            data-id="'.htmlspecialchars($item['id_payroll_component']).'"
                            data-total-izin="'.htmlspecialchars($item['total_izin']).'"
                            data-total-cuti="'.htmlspecialchars($item['total_cuti']).'"
                            data-total-absent="'.htmlspecialchars($item['total_absen']).'"
                            data-total-lembur="'.htmlspecialchars($item['total_overtime']).'"
                            data-basic-salary="'.htmlspecialchars($item['basic_salary']).'"
                            data-total-dayoff="'.htmlspecialchars($item['total_dayoff']).'"
                            data-uang-makan="'.htmlspecialchars($item['uang_makan']).'"
                            data-nip="'.htmlspecialchars($item['nip']).'"
                            data-name="'.htmlspecialchars($item['name']).'"
                            data-product="'.htmlspecialchars($item['name_product']).'"
                            data-divisi="'.htmlspecialchars($item['name_division']).'"
                            data-position="'.htmlspecialchars($item['name_position']).'"
                            data-tanggal-gajian="'.htmlspecialchars($item['tanggal_gajian']).'"
                            data-potongan-absen="'.htmlspecialchars($item['potongan_absen']).'"
                            data-potongan-izin="'.htmlspecialchars($item['potongan_izin']).'"
                            data-absen-hari="'.htmlspecialchars($item['absen_hari']).'"
                            data-izin-hari="'.htmlspecialchars($item['izin_hari']).'"
                            data-total-potongan="'.htmlspecialchars($item['total_potongan']).'"
                            data-gaji-bersih="'.htmlspecialchars($item['total']).'"
                            data-piutang="'.htmlspecialchars($item['piutang']).'"
                            data-periode-gajian="'.htmlspecialchars($item['periode_gajian']).'"
                            data-potongan-libur-nasional="'.htmlspecialchars($item['potongan_libur_nasional']).'"
                            data-total-libur-nasional="'.htmlspecialchars($item['total_libur_nasional']).'"
                            data-libur-nasional-hari="'.htmlspecialchars($item['libur_nasional_hari']).'"
                            data-total-potongan-telat="'.htmlspecialchars($item['total_potongan_telat']).'"
                            data-potongan-cuti="'.htmlspecialchars($item['potongan_cuti']).'"
                            data-cuti-hari="'.htmlspecialchars($item['cuti_hari']).'"
                            data-bonus="'.htmlspecialchars($item['bonus']).'">
                            RINCIAN
                        </button>
                        <button class="btn gradient-btn-delete btn-sm mb-2 rounded-pill btn-delete-payroll-component" onclick="handleDeletePayrollButton('.htmlspecialchars($item['id_payroll_component']).')" style="width : 70px">
                            DELETE
                        </button>
                     ';


			$row = [];
			$row[] = ++$no;
			$row[] = date('d M Y', strtotime($item['tanggal_gajian']));
			$row[] = $item['name'];
			$row[] = 'Rp.'.number_format($item['basic_salary'], 0 , ',', '.');
			$row[] = 'Rp.'.number_format($item['uang_makan'], 0 , ',', '.');
			$row[] = 'Rp.'.number_format($item['bonus'], 0 , ',', '.');
			$row[] = $item['total_izin'];
			$row[] = $item['total_dayoff'];
			$row[] = $item['total_cuti'];
			$row[] = $item['total_absen'];
			$row[] = 'Rp.'.number_format($item['total_overtime'], 0 , ',', '.');
			$row[] = 'Rp.'.number_format($item['total'], 0 , ',', '.');
			$row[] = $item['description'];
			$row[] = $action;
			$data[] = $row;
		}

		$output = [
			"draw" =>@$_POST['draw'],
			"recordsTotal" => $this->M_payroll_component->count_all(),
			"recordsFiltered" => $this->M_payroll_component->count_filtered(),
			"data" => $data,
		];

		echo json_encode($output);
	}


	public function data_attendance()
	{
		$startDate = $this->input->post('startDate', true);
		$endDate = $this->input->post('endDate', true);


			$list = $this->M_rekap->get_datatables();

			$data = [];
			$no = $this->input->post('start');

			foreach ($list as $item) {

				$totalAbsent = $this->M_schedule->totalAttendance($item['id_employee'], $startDate, $endDate);
				$totalDayOff = $this->M_day_off->totalAttendance($item['id_employee'], $startDate, $endDate);
				$totalIzin = $this->M_izin->totalAttendance($item['id_employee'], $startDate, $endDate);
				$totalCuti = $this->M_leave->totalAttendance($item['id_employee'], $startDate, $endDate);


				$action =
					'   
                        <button class="btn gradient-btn-delete btn-sm mb-2 rounded-pill btn-delete-schedule" onclick="handleDeleteScheduleButton(' . htmlspecialchars($item['id_employee']) . ')" style="width : 70px">
                            DELETE
                        </button>
                     ';


				$row = [];
				$row[] = ++$no;
				$row[] = $item['name'];
				$row[] = $item['name_product'];
				$row[] = $item['name_division'];
				$row[] = $totalAbsent;
				$row[] = $totalDayOff;
				$row[] = $totalIzin;
				$row[] = $totalCuti;
				$data[] = $row;
			}

			$output = [
				"draw" => @$_POST['draw'],
				"recordsTotal" => $this->M_rekap->count_all(),
				"recordsFiltered" => $this->M_rekap->count_filtered(),
				"startDate" => $startDate,
				"endDate" => $endDate,
				"data" => $data,
			];

			echo json_encode($output);

	}


	public function data_log_attendance()
	{
		$startDate = $this->input->post('startDate', true);
		$endDate = $this->input->post('endDate', true);
		$employee = $this->input->post('employee', true);

		$list = $this->M_attendance->get_datatables();

		$data = [];
		$no = $this->input->post('start');

		foreach ($list as $item) {

			$action = '-';
			if($item['time_management'] == false && $employee == 'false'){
				$action = ' <a href="javascript:void(0)" onclick="setPotonganTelat(this)" class="btn btn-info btn-sm rounded-pill btn-ptng-telat" style="width : 120px"
								data-id_attendance="'. $item['id_attendance'].'"
								data-potongan_telat="'. $item['potongan_telat'].'">
									Potong
							</a>
								 ';
			}

			$time_management = $item['time_management'] == true ? 'On time' : 'Telat masuk';

			$row = [];
			$row[] = ++$no;
			$row[] = $item['name'];
			$row[] = $item['name_product'];
			$row[] = $item['name_workshift'];
			$row[] = $item['clock_in'];
			$row[] = $item['jam_masuk'];
			$row[] = $time_management;
			$row[] = 'Rp.'.number_format($item['potongan_telat'], 0 , ',', '.');
			$row[] =  date('d M Y', strtotime($item['tanggal_masuk']));
			$row[] = $action;
			$data[] = $row;
		}

		$output = [
			"draw" => @$_POST['draw'],
			"recordsTotal" => $this->M_attendance->count_all(),
			"recordsFiltered" => $this->M_attendance->count_filtered(),
			"startDate" => $startDate,
			"endDate" => $endDate,
			"data" => $data,
		];

		echo json_encode($output);

	}

	public function data_service_teknisi()
	{
		$option = $this->input->post('option');
		$startDate = $this->input->post('startDate');
		$endDate = $this->input->post('endDate');
		$is = $this->input->post('is');
		$id = $this->input->post('employee');

		$list = $this->M_service_teknisi->get_datatables();
		$status  = '';

		$data = [];
		$no = $this->input->post('start');

		foreach($list as $item) {
			$action = $is == 1 || $is == 2 ?
				'   
                        <button class="btn gradient-btn-delete btn-sm mb-2 rounded-pill btn-delete-service_teknisi" onclick="handleDeleteServiceTeknisiButton('.htmlspecialchars($item['id_service_teknisi']).')" style="width : 70px">
                            DELETE
                        </button>
                     ':
				'-';


			if($item['status'] == 1 && $id == 'false' && $is !=3){
				$status =
					' 	
							<td>
							   <a href="javascript:void(0)" onclick="setStatusServiceTeknisi(this)" class="btn btn-danger btn-sm rounded-pill btn-stts" style="width : 140px"
								data-id_service_teknisi="'. $item['id_service_teknisi'].'"
								data-id_employee="'. $item['id_employee'].'"
								data-total_service="'. $item['total_service'].'"
								data-tgl_service_teknisi="'. $item['tanggal_service'].'"
								data-status="'. $item['status'].'">
									<i class="ti ti-check"></i> Disapproval
								</a>
							</td>
						  ';
			}
			else if($item['status'] == 2 &&  $id == 'false'  && $is !=3){
				$status =  '
                             <td>
							   <a href="javascript:void(0)" onclick="setStatusServiceTeknisi(this)" class="btn btn-primary btn-sm rounded-pill btn-stts" style="width : 120px"
								data-id_service_teknisi="'. $item['id_service_teknisi'].'"
								data-id_employee="'. $item['id_employee'].'"
								data-total_service="'. $item['total_service'].'"
								data-tgl_service_teknisi="'. $item['tanggal_service'].'"
								data-status="'. $item['status'].'">
									<i class="ti ti-check"></i> Approval
								</a>
							</td>
                           ';
			}
			else if ($item['status'] == 3 &&  $id == 'false'  && $is !=3) {
				$status =  '
                             <td>
							   <a a href="javascript:void(0)" onclick="setStatusServiceTeknisi(this)" class="btn btn-info btn-sm rounded-pill btn-stts" style="width : 120px"
								data-id_service_teknisi="'. $item['id_service_teknisi'].'"
								data-total_service="'. $item['total_service'].'"

								data-id_employee="'. $item['id_employee'].'"
								data-tgl_service_teknisi="'. $item['tanggal_service'].'"
								data-status="'. $item['status'].'">
									<i class="ti ti-check"></i> Pending
								</a>
							</td>
                           ';
			}
			else if($item['status'] == 1 &&  $id != 'false'  && $is ==3){
				$status =
					' 	
							<td>
							   <button class="btn btn-danger btn-sm rounded-pill btn-stts" style="width : 140px" disabled="">
									<i class="ti ti-check"></i> Disapproval
								</button>
							</td>
						  ';
			}
			else if($item['status'] == 2 && $id != 'false' && $is ==3){
				$status =  '
                             <td>
							   <button class="btn btn-primary btn-sm rounded-pill btn-stts" style="width : 120px">
									<i class="ti ti-check"></i> Approval
								</button>
							</td>
                           ';
			}
			else if ($item['status'] == 3 && $id != 'false' && $is ==3) {
				$status =  '
                             <td>
							   <button class="btn btn-info btn-sm rounded-pill btn-stts" style="width : 120px" disabled>
									<i class="ti ti-check"></i> Pending
								</button>
							</td>
                           ';
			}


			$upah = $item['total_service'] == null ? 0 : $item['total_service'];

			$row = [];
			$row[] = ++$no;
			$row[] = date('d M Y', strtotime($item['input_at']));
			$row[] = $item['name'];
			$row[] = $item['name_product'];
			$row[] = $item['name_division'];
			$row[] = $item['type_service'];
			$row[] = 'Rp.'. number_format($item['pendapatan_service'], 0 , ',', '.');
			$row[] = 'Rp.'. number_format($upah , 0 , ',', '.');
			$row[] = date('d M Y', strtotime($item['tanggal_service']));
			$row[] = $item['description'];
			$row[] = $status;
			$row[] = $action;
			$data[] = $row;
		}

		$output = [
			"draw" =>@$_POST['draw'],
			"recordsTotal" => $this->M_service_teknisi->count_all(),
			"recordsFiltered" => $this->M_service_teknisi->count_filtered(),
			"option" => $option,
			"startDate" => $startDate,
			"endDate" => $endDate,
			"data" => $data,
		];

		echo json_encode($output);
	}


}
