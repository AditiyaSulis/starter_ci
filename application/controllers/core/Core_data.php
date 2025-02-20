<?php
class Core_data extends MY_Controller{

    function __construct()
    {
        parent::__construct();
        $this->load->model('m_Employees');
        $this->load->model('m_Piutang');
        $this->load->model('m_Purchases');
        $this->load->model('m_Purchase_piutang');
        $this->load->model('m_Izin');
        $this->load->model('m_Overtime');
        $this->load->model('m_Leave');
        $this->load->model('m_Day_off');
        $this->load->model('m_Holyday');
        $this->load->model('m_Payroll');
        $this->load->model('m_Payroll_component');
        $this->load->model('m_Schedule');
        $this->load->model('m_Rekap');
        $this->load->model('m_Attendance');
    }

	public function data_piutang()
	{
		$tenor = $this->input->post('tanggal_pelunasan');
		$type = $this->input->post('type');
		$status_piutang = $this->input->post('status_piutang');

		$list = $this->m_Piutang->get_datatables();

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
			"recordsTotal" => $this->m_Piutang->count_all(),
			"recordsFiltered" => $this->m_Piutang->count_filtered(),
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

		$list = $this->m_Purchases->get_datatables();

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
			"recordsTotal" => $this->m_Purchases->count_all(),
			"recordsFiltered" => $this->m_Purchases->count_filtered(),
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


		$list = $this->m_Izin->get_datatables();

		$data = [];
		$no = $this->input->post('start');

		foreach($list as $item) {
			$action = $employee == '' ?
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

			if($item['status'] == 1 && $employee == ''){
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
			else if($item['status'] == 2 && $employee == ''){
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
			else if ($item['status'] == 3 && $employee == '') {
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
			else if($item['status'] == 1 && $employee != ''){
				$status =
					' 	
							<td>
							   <button class="btn btn-danger btn-sm rounded-pill btn-stts" style="width : 140px" disabled >
									<i class="ti ti-check"></i> Disapproval
								</button>
							</td>
						  ';
			}
			else if($item['status'] == 2 && $employee != ''){
				$status =  '
                             <td>
							   <button class="btn btn-primary btn-sm rounded-pill btn-stts" style="width : 120px" disabled >
									<i class="ti ti-check"></i> Approval
								</button>
							</td>
                           ';
			}
			else if ($item['status'] == 3 && $employee != '') {
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
			$row[] = date('d M Y', strtotime($item['tanggal_izin']));;
			$row[] = $bukti;
			$row[] = $status;
			$row[] = $item['description'];
			$row[] = $action;
			$data[] = $row;
		}

		$output = [
			"draw" =>@$_POST['draw'],
			"recordsTotal" => $this->m_Izin->count_all(),
			"recordsFiltered" => $this->m_Izin->count_filtered(),
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


		$list = $this->m_Overtime->get_datatables();

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

			if($item['status'] == 1 && $is !=3 && $employee == ''){
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
			else if($item['status'] == 2 && $is !=3 && $employee == ''){
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
			else if ($item['status'] == 3 && $is !=3 && $employee == '') {
				$status =  '
                             <td>
							   <a a href="javascript:void(0)" onclick="setStatusOvertime(this)" class="btn btn-info btn-sm rounded-pill btn-stts" style="width : 120px"
								data-id_overtime="'. $item['id_overtime'].'"
								data-status="'. $item['status'].'">
									<i class="ti ti-check"></i> Pending
								</a>
							</td>
                           ';
			}
			else if($item['status'] == 1 && $is ==3 && $employee != ''){
				$status =
					' 	
							<td>
							   <button  class="btn btn-danger btn-sm rounded-pill btn-stts" style="width : 140px" disabled>
									<i class="ti ti-check"></i> Disapproval
								</button>
							</td>
						  ';
			}
			else if($item['status'] == 2 &&  $is ==3 && $employee != ''){
				$status =  '
                             <td>
							   <button class="btn btn-primary btn-sm rounded-pill btn-stts" style="width : 120px" disabled>
									<i class="ti ti-check"></i> Approval
								</button>
							</td>
                           ';
			}
			else if ($item['status'] == 3 &&  $is ==3 && $employee != '') {
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
			"recordsTotal" => $this->m_Overtime->count_all(),
			"recordsFiltered" => $this->m_Overtime->count_filtered(),
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



		$list = $this->m_Leave->get_datatables();

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
			if($item['status'] == 1 && $is !=3 && $employee == ''){
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
			else if($item['status'] == 2 && $is !=3 && $employee == ''){
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
			else if ($item['status'] == 3 && $is !=3 && $employee == '') {
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
			else if($item['status'] == 1 && $is ==3 && $employee != ''){
				$status =
						' 	
							<td>
							   <button class="btn btn-danger btn-sm rounded-pill btn-stts" style="width : 140px" disabled>
									<i class="ti ti-check"></i> Disapproval
								</button>
							</td>
						  ';
			}
			else if($item['status'] == 2 && $is ==3 && $employee != ''){
				$status =  '
                             <td>
							   <button class="btn btn-primary btn-sm rounded-pill btn-stts" style="width : 120px" disabled>
									<i class="ti ti-check"></i> Approval
								</button>
							</td>
                           ';
			}
			else if ($item['status'] == 3 && $is ==3 && $employee != '') {
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
			"recordsTotal" => $this->m_Leave->count_all(),
			"recordsFiltered" => $this->m_Leave->count_filtered(),
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

		$list = $this->m_Day_off->get_datatables();

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


			if($item['status'] == 1 && $id == '' && $is !=3){
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
			else if($item['status'] == 2 &&  $id == ''  && $is !=3){
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
			else if ($item['status'] == 3 &&  $id == ''  && $is !=3) {
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
			else if($item['status'] == 1 &&  $id != ''  && $is ==3){
				$status =
					' 	
							<td>
							   <button class="btn btn-danger btn-sm rounded-pill btn-stts" style="width : 140px" disabled="">
									<i class="ti ti-check"></i> Disapproval
								</button>
							</td>
						  ';
			}
			else if($item['status'] == 2 && $id != '' && $is ==3){
				$status =  '
                             <td>
							   <button class="btn btn-primary btn-sm rounded-pill btn-stts" style="width : 120px">
									<i class="ti ti-check"></i> Approval
								</button>
							</td>
                           ';
			}
			else if ($item['status'] == 3 && $id != '' && $is ==3) {
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
			"recordsTotal" => $this->m_Day_off->count_all(),
			"recordsFiltered" => $this->m_Day_off->count_filtered(),
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


		$list = $this->m_Holyday->get_datatables();

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
			"recordsTotal" => $this->m_Holyday->count_all(),
			"recordsFiltered" => $this->m_Holyday->count_filtered(),
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


		$list = $this->m_Schedule->get_datatables();

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
			"recordsTotal" => $this->m_Schedule->count_all(),
			"recordsFiltered" => $this->m_Schedule->count_filtered(),
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

		$list = $this->m_Payroll->get_datatables();

		$data = [];
		$no = $this->input->post('start');

		foreach($list as $item) {
			$action =
					'   
                      <button 
						class="btn btn-warning btn-sm mb-2 rounded-pill btn-pay-piutang" 
						style="width : 70px"
						data-bs-toggle="modal" 
						data-bs-target="#detailModal"
						data-id-payroll="'. htmlspecialchars($item['id_payroll']) .'"
						data-code-payroll="'. htmlspecialchars($item['code_payroll']) .'">
						DETAIL
					  </button>
                        <button class="btn gradient-btn-delete btn-sm mb-2 rounded-pill btn-delete-payroll" onclick="handleDeletePayrollButton('.htmlspecialchars($item['id_payroll']).')" style="width : 70px">
                            DELETE
                        </button>
                     ';


			$row = [];
			$row[] = ++$no;
			$row[] = date('d M Y', strtotime($item['input_at']));
			$row[] = $item['code_payroll'];
			$row[] = $item['total_salary'];
			$row[] = $item['total_employee'];
			$row[] = date('d M Y', strtotime($item['tanggal_gajian']));
			$row[] = $action;
			$data[] = $row;
		}

		$output = [
			"draw" =>@$_POST['draw'],
			"recordsTotal" => $this->m_Payroll->count_all(),
			"recordsFiltered" => $this->m_Payroll->count_filtered(),
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
		$list = $this->m_Payroll_component->get_datatables();

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
			$row[] = $item['basic_salary'];
			$row[] = $item['uang_makan'];
			$row[] = $item['bonus'];
			$row[] = $item['total_izin'];
			$row[] = $item['total_dayoff'];
			$row[] = $item['total_cuti'];
			$row[] = $item['total_overtime'] . ' Jam';
			$row[] = $item['total'];
			$row[] = $item['description'];
			$row[] = $action;
			$data[] = $row;
		}

		$output = [
			"draw" =>@$_POST['draw'],
			"recordsTotal" => $this->m_Payroll_component->count_all(),
			"recordsFiltered" => $this->m_Payroll_component->count_filtered(),
			"data" => $data,
		];

		echo json_encode($output);
	}

	public function data_attendance()
	{
		$startDate = $this->input->post('startDate', true);
		$endDate = $this->input->post('endDate', true);
		$employee = $this->input->post('employee', true);

		if(!empty($employee)){
			$data = [];
			$no = $this->input->post('start');
			$list = $this->m_Employees->get_datatables(null);

			foreach ($list as $item) {

				$totalAbsent = $this->m_Schedule->totalAttendance($employee, $item['date_in'], date('Y-m-d'));
				$totalDayOff = $this->m_Day_off->totalAttendance($employee, $item['date_in'], date('Y-m-d'));
				$totalIzin = $this->m_Izin->totalAttendance($employee, $item['date_in'], date('Y-m-d'));
				$totalCuti = $this->m_Leave->totalAttendance($employee, $item['date_in'], date('Y-m-d'));


				$row = [];
				$row[] = $no++;
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
				"recordsTotal" => $this->m_Employees->count_all(),
				"recordsFiltered" => $this->m_Employees->count_filtered(),
				"startDate" => $startDate,
				"endDate" => $endDate,
				"data" => $data,
			];

			echo json_encode($output);
			return;

		}


		if(empty($employee)) {
			$list = $this->m_Rekap->get_datatables();

			$data = [];
			$no = $this->input->post('start');

			foreach ($list as $item) {

				$totalAbsent = $this->m_Schedule->totalAttendance($item['id_employee'], $startDate, $endDate);
				$totalDayOff = $this->m_Day_off->totalAttendance($item['id_employee'], $startDate, $endDate);
				$totalIzin = $this->m_Izin->totalAttendance($item['id_employee'], $startDate, $endDate);
				$totalCuti = $this->m_Leave->totalAttendance($item['id_employee'], $startDate, $endDate);


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
				"recordsTotal" => $this->m_Rekap->count_all(),
				"recordsFiltered" => $this->m_Rekap->count_filtered(),
				"startDate" => $startDate,
				"endDate" => $endDate,
				"data" => $data,
			];

			echo json_encode($output);
		}
	}

	public function data_log_attendance()
	{
		$startDate = $this->input->post('startDate', true);
		$endDate = $this->input->post('endDate', true);

		$list = $this->m_Attendance->get_datatables();

		$data = [];
		$no = $this->input->post('start');

		foreach ($list as $item) {
			$row = [];
			$row[] = ++$no;
			$row[] = $item['name'];
			$row[] = $item['name_product'];
			$row[] = $item['name_workshift'];
			$row[] = $item['clock_in'];
			$row[] = $item['jam_masuk'];
			$row[] =  date('d M Y', strtotime($item['tanggal_masuk']));
			$data[] = $row;
		}

		$output = [
			"draw" => @$_POST['draw'],
			"recordsTotal" => $this->m_Attendance->count_all(),
			"recordsFiltered" => $this->m_Attendance->count_filtered(),
			"startDate" => $startDate,
			"endDate" => $endDate,
			"data" => $data,
		];

		echo json_encode($output);

	}

}
