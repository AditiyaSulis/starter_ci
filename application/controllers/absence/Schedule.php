<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule extends MY_Controller{

	function __construct()
	{
		parent::__construct();
		$this->load->model('M_schedule');
		$this->load->model('M_employees');
		$this->load->model('m_Workshift');
		$this->load->model('m_Products');
		$this->load->model('m_Division');
		$this->load->model('m_Day_off');
		$this->load->model('m_Izin');
		$this->load->model('m_Leave');
		$this->load->model('m_Holyday');

		$this->load->helper('date');
	}

	public function employee_schedule()
	{
		$idEmployee = $this->input->post('id_employee', true);
		$year = date('Y');
		$month = date('m');

		$schedule = $this->M_schedule->findByEmployeeIdAndTimeSpecific_get($idEmployee, $year, $month);

		$jadwal = [];

		if (!empty($schedule)) {
			foreach ($schedule as $schedules) {
				$tanggal = date('j', strtotime($schedules['waktu']));
				$event = '';

				switch ($schedules['status']) {
					case 1: $event = '<a href="javascript:void(0)" onclick="setStatusSchedule(this)" data-id_schedule="'.$schedules['id_schedule'].'" data-status="'.$schedules['status'].'"><div class="jadwal">'.date("H:i", strtotime($schedules['clock_in'])).' - '.date("H:i", strtotime($schedules['clock_out'])).'</div></a>'; break;
					case 2: $event = '<a href="javascript:void(0)" onclick="setStatusSchedule(this)" data-id_schedule="'.$schedules['id_schedule'].'" data-status="'.$schedules['status'].'"><div class="dayoff">Day Off</div></a>'; break;
					case 3: $event = '<a href="javascript:void(0)" onclick="setStatusSchedule(this)" data-id_schedule="'.$schedules['id_schedule'].'" data-status="'.$schedules['status'].'"><div class="tanggal_merah">Tanggal Merah</div></a>'; break;
					case 4: $event = '<a href="javascript:void(0)" onclick="setStatusSchedule(this)" data-id_schedule="'.$schedules['id_schedule'].'" data-status="'.$schedules['status'].'"><div class="cuti">Cuti</div></a>'; break;
					case 5: $event = '<a href="javascript:void(0)" onclick="setStatusSchedule(this)" data-id_schedule="'.$schedules['id_schedule'].'" data-status="'.$schedules['status'].'"><div class="izin">Izin</div></a>'; break;
					case 6: $event = '<a href="javascript:void(0)" onclick="setStatusSchedule(this)" data-id_schedule="'.$schedules['id_schedule'].'" data-status="'.$schedules['status'].'"><div class="hadir">Hadir</div></a>'; break;
					case 7: $event = '<a href="javascript:void(0)" onclick="setStatusSchedule(this)" data-id_schedule="'.$schedules['id_schedule'].'" data-status="'.$schedules['status'].'"><div class="absen">Tidak Hadir</div></a>'; break;
					case 8: $event = '<a href="javascript:void(0)" onclick="setStatusSchedule(this)" data-id_schedule="'.$schedules['id_schedule'].'" data-status="'.$schedules['status'].'"><div class="minggu">Hari Minggu</div></a>'; break;
					default: $event = '<div class="nothing">Tidak ada jadwal</div>';
				}

				$jadwal[$tanggal] = $event;
			}
		}


		$prefs = array(
			'show_next_prev'  => TRUE,
			'next_prev_url'   => base_url('absence/schedule/load_calendar_by_ajax/'),
			'day_type'        => 'long',
		);

		$prefs['template'] = '
        {table_open}<table class="calendar">{/table_open}

        {heading_row_start}<tr class="calendar-header">{/heading_row_start}
        {heading_previous_cell}<th><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
        {heading_title_cell}<th colspan="{colspan}">{heading}</th>{/heading_title_cell}
        {heading_next_cell}<th><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}
        {heading_row_end}</tr>{/heading_row_end}

        {week_row_start}<tr class="week-days">{/week_row_start}
        {week_day_cell}<td>{week_day}</td>{/week_day_cell}
        {week_row_end}</tr>{/week_row_end}

        {cal_row_start}<tr class="days">{/cal_row_start}
        {cal_cell_start}<td class="day">{/cal_cell_start}
        {cal_cell_start_today}<td class="today">{/cal_cell_start_today}

        {cal_cell_content}<div class="event">{day}<br>{content}</div>{/cal_cell_content}
        {cal_cell_content_today}<div class="event today">{day}<br>{content}</div>{/cal_cell_content_today}
        {cal_cell_no_content}{day}{/cal_cell_no_content}
        {cal_cell_no_content_today}<strong class="today">{day}</strong>{/cal_cell_no_content_today}

        {cal_cell_end}</td>{/cal_cell_end}
        {cal_cell_end_today}</td>{/cal_cell_end_today}
        {cal_row_end}</tr>{/cal_row_end}

        {table_close}</table>{/table_close}
    	';

		$this->load->library('calendar', $prefs);
		$calendar = $this->calendar->generate($year, $month, $jadwal);


		echo json_encode([
			'status' => true,
			'calendar' => $calendar
		]);
	}

	public function option_employee()
	{
		$idProduct = $this->input->post('id_product', true);
		$idDivision = $this->input->post('id_division', true);

		$employee = $this->M_employees->findByProductNDivisionId_get($idProduct, $idDivision);

		if(empty($employee)){
			echo json_encode([
				'status' => false,
				'message' =>  'Data tidak ditemukan'
			]);
			return false;
		}

		$response = [
			'status' => true,
			'data' => $employee
		];

		echo json_encode($response);

	}

	public function schedule_page($year = NULL, $month = NULL)
	{

		$this->_ONLYSELECTED([3]);
		$data = $this->_basicData();

		$data['title'] = 'Schedule';
		$data['view_name'] = 'absence/schedule';
		$data['breadcrumb'] = 'Schedule';
		$data['menu'] = 'Data';


		$id = $this->M_employees->findByEmail_get($data['user']['email']);
		$idEmployee = $id['id_employee'];

		$year = $year ?? date('Y');
		$month = $month ?? date('m');

		$schedule = $this->M_schedule->findByEmployeeIdAndTimeSpecific_get($idEmployee, $year, $month);
		$jadwal = [];


		if (!empty($schedule)) {
			foreach ($schedule as $schedules) {
				$tanggal = date('j', strtotime($schedules['waktu']));
				$event = '';

				switch ($schedules['status']) {
					case 1: $event = '<div class="jadwal">'.date("H:i", strtotime($schedules['clock_in'])).' - '.date("H:i", strtotime($schedules['clock_out'])).'</div>'; break;
					case 2: $event = '<div class="dayoff">Day Off</div>'; break;
					case 3: $event = '<div class="tanggal_merah">Tanggal Merah</div>'; break;
					case 4: $event = '<div class="cuti">Cuti</div>'; break;
					case 5: $event = '<div class="izin">Izin</div>'; break;
					case 6: $event = '<div class="hadir">Hadir</div>'; break;
					case 7: $event = '<div class="absen">Tidak Hadir</div>'; break;
					case 8: $event = '<div class="minggu">Hari Minggu</div>'; break;
					default: $event = '<div class="nothing">Tidak ada jadwal</div>';
				}

				$jadwal[$tanggal] = $event;
			}
		}


		$prefs = array(
			'show_next_prev'  => TRUE,
			'next_prev_url'   =>base_url('absence/schedule/load_calendar/'),
			'day_type'         => 'long',
		);

		$prefs['template'] = '
            {table_open}<table class="calendar">{/table_open}

            {heading_row_start}<tr class="calendar-header">{/heading_row_start}
            {heading_previous_cell}<th><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
            {heading_title_cell}<th colspan="{colspan}">{heading}</th>{/heading_title_cell}
            {heading_next_cell}<th><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}
            {heading_row_end}</tr>{/heading_row_end}

            {week_row_start}<tr class="week-days">{/week_row_start}
            {week_day_cell}<td>{week_day}</td>{/week_day_cell}
            {week_row_end}</tr>{/week_row_end}

            {cal_row_start}<tr class="days">{/cal_row_start}
            {cal_cell_start}<td class="day">{/cal_cell_start}
            {cal_cell_start_today}<td class="today">{/cal_cell_start_today}

            {cal_cell_content}<div class="event">{day}<br>{content}</div>{/cal_cell_content}
            {cal_cell_content_today}<div class="event today">{day}<br>{content}</div>{/cal_cell_content_today}
            {cal_cell_no_content}{day}{/cal_cell_no_content}
            {cal_cell_no_content_today}<strong class="today">{day}</strong>{/cal_cell_no_content_today}

            {cal_cell_end}</td>{/cal_cell_end}
            {cal_cell_end_today}</td>{/cal_cell_end_today}
            {cal_row_end}</tr>{/cal_row_end}
 
            {table_close}</table>{/table_close}
        ';

		$prefs['day_names' ]    = array ('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');

		$this->load->library('calendar', $prefs);

		$data['calendar'] = $this->calendar->generate($year, $month, $jadwal);

		if ($data['user']) {
			$this->load->view('templates/index', $data);
		} else {
			$this->session->set_flashdata('forbidden', 'Silahkan login terlebih dahulu');

			redirect('fetch/login');
		}
	}

	public function load_calendar($year = NULL, $month = NULL)
	{
		$data = $this->_basicData();
		$id = $this->M_employees->findByEmail_get($data['user']['email']);
		$idEmployee = $id['id_employee'];

		$year = $year ?? date('Y');
		$month = $month ?? date('m');

		$schedule = $this->M_schedule->findByEmployeeIdAndTimeSpecific_get($idEmployee, $year, $month);
		$jadwal = [];

		if (!empty($schedule)) {
			foreach ($schedule as $schedules) {
				$tanggal = date('j', strtotime($schedules['waktu']));
				$event = '';

				switch ($schedules['status']) {
					case 1: $event = '<div class="jadwal">'.date("H:i", strtotime($schedules['clock_in'])).' - '.date("H:i", strtotime($schedules['clock_out'])).'</div>'; break;
					case 2: $event = '<div class="dayoff">Day Off</div>'; break;
					case 3: $event = '<div class="tanggal_merah">Tanggal Merah</div>'; break;
					case 4: $event = '<div class="cuti">Cuti</div>'; break;
					case 5: $event = '<div class="izin">Izin</div>'; break;
					case 6: $event = '<div class="hadir">Hadir</div>'; break;
					case 7: $event = '<div class="absen">Absen</div>'; break;
					case 7: $event = '<div class="minggu">Minggu</div>'; break;
					default: $event = '<div class="nothing">Tidak ada jadwal</div>';
				}

				$jadwal[$tanggal] = $event;
			}
		}

		$prefs = array(
			'show_next_prev'  => TRUE,
			'next_prev_url'   => base_url('absence/schedule/load_calendar/')
		);
		$prefs['template'] = '
            {table_open}<table class="calendar">{/table_open}

            {heading_row_start}<tr class="calendar-header">{/heading_row_start}
            {heading_previous_cell}<th><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
            {heading_title_cell}<th colspan="{colspan}">{heading}</th>{/heading_title_cell}
            {heading_next_cell}<th><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}
            {heading_row_end}</tr>{/heading_row_end}

            {week_row_start}<tr class="week-days">{/week_row_start}
            {week_day_cell}<td>{week_day}</td>{/week_day_cell}
            {week_row_end}</tr>{/week_row_end}

            {cal_row_start}<tr class="days">{/cal_row_start}
            {cal_cell_start}<td class="day">{/cal_cell_start}
            {cal_cell_start_today}<td class="today">{/cal_cell_start_today}

            {cal_cell_content}<div class="event">{day}<br>{content}</div>{/cal_cell_content}
            {cal_cell_content_today}<div class="event today">{day}<br>{content}</div>{/cal_cell_content_today}
            {cal_cell_no_content}{day}{/cal_cell_no_content}
            {cal_cell_no_content_today}<strong class="today">{day}</strong>{/cal_cell_no_content_today}

            {cal_cell_end}</td>{/cal_cell_end}
            {cal_cell_end_today}</td>{/cal_cell_end_today}
            {cal_row_end}</tr>{/cal_row_end}
 
            {table_close}</table>{/table_close}
        ';

		$this->load->library('calendar', $prefs);
		echo $this->calendar->generate($year, $month, $jadwal);
	}

	public function load_calendar_by_ajax($year = NULL, $month = NULL) {
		$idEmployee = $this->input->get('id_employee', true);

		if (!$idEmployee) {
			echo json_encode(['status' => false, 'message' => 'ID Employee tidak ditemukan']);
			return;
		}

		$year = is_numeric($year) ? (int) $year : date('Y');
		$month = is_numeric($month) ? (int) $month : date('m');

		$schedule = $this->M_schedule->findByEmployeeIdAndTimeSpecific_get($idEmployee, $year, $month);
		$jadwal = [];

		if (!empty($schedule)) {
			foreach ($schedule as $schedules) {
				$tanggal = (int) date('j', strtotime($schedules['waktu']));
				$event = '';

				switch ($schedules['status']) {
					case 1: $event = '<div class="jadwal">'.date("H:i", strtotime($schedules['clock_in'])).' - '.date("H:i", strtotime($schedules['clock_out'])).'</div>'; break;
					case 2: $event = '<div class="dayoff">Day Off</div>'; break;
					case 3: $event = '<div class="tanggal_merah">Tanggal Merah</div>'; break;
					case 4: $event = '<div class="cuti">Cuti</div>'; break;
					case 5: $event = '<div class="izin">Izin</div>'; break;
					case 6: $event = '<div class="hadir">Hadir</div>'; break;
					case 7: $event = '<div class="absen">Absen</div>'; break;
					case 8: $event = '<div class="minggu">Minggu</div>'; break;
					default: $event = '<div class="nothing">Tidak ada jadwal</div>';
				}

				$jadwal[$tanggal] = $event;
			}
		}

		$prefs = array(
			'show_next_prev'  => TRUE,
			'next_prev_url'   => base_url('absence/schedule/load_calendar_by_ajax/{year}/{month}?id_employee=' . $idEmployee)
		);

		$prefs['template'] = '
        {table_open}<table class="calendar">{/table_open}
        {heading_row_start}<tr class="calendar-header">{/heading_row_start}
        {heading_previous_cell}<th><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
        {heading_title_cell}<th colspan="{colspan}">{heading}</th>{/heading_title_cell}
        {heading_next_cell}<th><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}
        {heading_row_end}</tr>{/heading_row_end}
        {week_row_start}<tr class="week-days">{/week_row_start}
        {week_day_cell}<td>{week_day}</td>{/week_day_cell}
        {week_row_end}</tr>{/week_row_end}
        {cal_row_start}<tr class="days">{/cal_row_start}
        {cal_cell_start}<td class="day">{/cal_cell_start}
        {cal_cell_start_today}<td class="today">{/cal_cell_start_today}
        {cal_cell_content}<div class="event">{day}<br>{content}</div>{/cal_cell_content}
        {cal_cell_content_today}<div class="event today">{day}<br>{content}</div>{/cal_cell_content_today}
        {cal_cell_no_content}{day}{/cal_cell_no_content}
        {cal_cell_no_content_today}<strong class="today">{day}</strong>{/cal_cell_no_content_today}
        {cal_cell_end}</td>{/cal_cell_end}
        {cal_cell_end_today}</td>{/cal_cell_end_today}
        {cal_row_end}</tr>{/cal_row_end}
        {table_close}</table>{/table_close}
    	';

		$this->load->library('calendar', $prefs);
		echo json_encode([
			'status' => true,
			'calendar' => $this->calendar->generate($year, $month, $jadwal)
		]);
	}

	public function su_schedule_page()
	{
		$this->_ONLYSELECTED([1,2]);
		$data = $this->_basicData();

		$data['title'] = 'Data Schedule';
		$data['view_name'] = 'absence/data/schedule';
		$data['breadcrumb'] = 'Data - Schedule';
		$data['menu'] = 'Data';

		$data['employees'] = $this->M_employees->findAll_get();
		$data['workshifts'] = $this->m_Workshift->findAll_get();
		$data['divisions'] = $this->m_Division->findAll_get();
		$data['products'] = $this->m_Products->findAll_get();



		if($data['user']) {
			$this->load->view('templates/index' ,$data);
		} else {
			$this->session->set_flashdata('forbidden', 'Silahkan login terlebih dahulu');
			redirect('fetch/login');
		}
	}


	public function dtSideServer()
	{
		$product = $this->input->post('product');

		$list = $this->M_employees->get_datatables($product);

		$data = [];
		$no = $this->input->post('start');

		foreach($list as $item) {
			$action = '
			 			 <button 
                            class="btn btn-warning btn-sm mb-2 rounded-pill btn-riwayat-kehadiran" style="width : 120px"
                            data-bs-toggle="modal" 
                            data-bs-target="#riwayatKehadiranModal"
                            data-id-employee="'.htmlspecialchars($item['id_employee']).'"
                            data-name-karyawan="'.htmlspecialchars($item['name']).'"
                            data-name-product="'.htmlspecialchars($item['name_product']).'"
                            data-name-division="'.htmlspecialchars($item['name_division']).'">
                            Riwayat
                        </button>
						<a href="javascript:void(0)" onclick="showSchedule('.$item['id_employee'].')" 
                            class="btn gradient-btn-edit mb-2 btn-sm rounded-pill btn-edit-emp"  
                            style="width: 120px">
                                Lihat Jadwal
                        </a>
                     ';
			$row = [];
			$row[] = ++$no;
			$row[] = $item['nip'];
			$row[] = $item['name'];
			$row[] = $item['name_product'];
			$row[] = $item['name_division'];
			$row[] = $action;
			$data[] = $row;
		}

		$output = [
			"draw" =>@$_POST['draw'],
			"recordsTotal" => $this->M_employees->count_all(),
			"recordsFiltered" => $this->M_employees->count_filtered($product),
			"data" => $data,
		];

		echo json_encode($output);
	}

	public function riwayat_kehadiran()
	{
		$idEmployee = $this->input->post('id_employee', true);

		if (!$idEmployee) {
			echo json_encode([
				'status' => false,
				'message' => 'ID Employee tidak valid'
			]);
			return;
		}

		$thisMonth = [
			'izin'  => $this->m_Izin->totalIzinThisMonthByEmployeeId_get($idEmployee),
			'dayoff' => $this->m_Day_off->totalDayOffThisMonthByEmployeeId_get($idEmployee),
			'cuti'   => $this->m_Leave->totalLeaveThisMonthByEmployeeId_get($idEmployee),
			'absen'   => $this->M_schedule->totalAbsentThisMonthByEmployeeId_get($idEmployee),
		];

		$thisYear = [
			'izin'  => $this->m_Izin->totalIzinByEmployeeId_get($idEmployee),
			'dayoff' => $this->m_Day_off->totalDayOffByEmployeeId_get($idEmployee),
			'cuti'   => $this->m_Leave->totalLeaveByEmployeeId_get($idEmployee),
			'absen'   => $this->M_schedule->totalAbsentByEmployeeId_get($idEmployee),

		];

		echo json_encode([
			'status' => true,
			'thisMonth' => $thisMonth,
			'thisYear' => $thisYear
		]);
	}

	public function add_batch_schedule() {
		$this->_ONLY_SU();
		$this->_isAjax();


		$this->form_validation->set_rules('start_date', 'start_date', 'required', [
			'required' => 'Tanggal Mulai harus diisi',
		]);
		$this->form_validation->set_rules('end_date', 'end_date', 'required', [
			'required' => 'Tanggal selesai harus diisi',
		]);

		$this->form_validation->set_rules('id_workshift', 'id_workshift', 'required', [
			'required' => 'Shift harus diisi',
		]);

		if ($this->form_validation->run() == FALSE) {
			echo json_encode([
				'status' => false,
				'message' => validation_errors('<p>', '</p>'),
				'confirmationbutton' => true,
				'timer' => 0,
				'icon' => 'error',
			]);
			return;
		}

		$dataBatch = [];

		$totalDays = $this->input->post('total', true);
		$product = $this->input->post('id_product', true);
		$division = $this->input->post('id_division', true);
		$employees = $this->input->post('id_employee', true);

		if(empty($employees) || $employees == null) {
			echo json_encode([
				'status' => false,
				'message' => 'Pilih salah satu karyawan',
				'confirmationbutton' => true,
				'timer' => 0,
				'icon' => 'error',
			]);
			return;
		}


		for($i = 0; $i < $totalDays; $i++) {
			foreach ($employees as $emp) {
				$tanggal = date('Y-m-d', strtotime("+$i day", strtotime($this->input->post('start_date', true))));

				$isDayoff = $this->m_Day_off->findByEmployeeIdAtDate_get($emp, $tanggal);
				$isLeave = $this->m_Leave->findByEmployeeIdAtDate_get($emp, $tanggal);
				$isIzin = $this->m_Izin->findByEmployeeIdAtDate_get($emp,$tanggal);
				$isHolyday = $this->m_Holyday->findByProductNDivisionIdAtDate_get($product, $division, $tanggal);
				$isSunday = $this->m_Holyday->isSunday_get($product, $division, $tanggal);


				$status = 1;

				if(!empty($isDayoff)) {
					$status=2;
				} else if(!empty($isLeave)) {
					$status=4;
				} else if(!empty($isIzin)) {
					$status=5;
				} else if(!empty($isHolyday)) {
					$status = 3;
				} else if(!empty($isSunday)) {
					$status = 8;
				}




				$dataBatch[] = [
					'id_employee' => $emp,
					'id_workshift' => $this->input->post('id_workshift', true),
					'start_date' => $this->input->post('start_date', true),
					'waktu' => $tanggal,
					'end_date' =>  $this->input->post('end_date', true),
					'status' =>  $status
				];
			}

		}


		$schedule = $this->M_schedule->create_batch_post($dataBatch);
		echo json_encode([
			'status' => $schedule ? true : false,
			'message' => $schedule ? 'Jadwal berhasil dibuat' : 'Jadwal gagal dibuat',
		]);
	}



	public function delete()
	{
		$this->_ONLY_SU();
		$this->_isAjax();

		$id = $this->input->post('id');

		if($this->m_Overtime->delete($id)){
			$response = [
				'status' => true,
				'message' => 'Data lembur karyawan berhasil dihapus',
			];
		} else {
			$response = [
				'status' => false,
				'message' => 'Data lembur karyawan gagal dihapus',
			];
		}

		echo json_encode($response);

	}



}



//				switch ($schedules['status']) {
//					case 1: $event = '<div class="jadwal">'.date("H:i", strtotime($schedules['clock_in'])).' - '.date("H:i", strtotime($schedules['clock_out'])).'</div>'; break;
//					case 2: $event = '<div class="dayoff">Day Off</div>'; break;
//					case 3: $event = '<div class="tanggal_merah">Tanggal Merah</div>'; break;
//					case 4: $event = '<div class="cuti">Cuti</div>'; break;
//					case 5: $event = '<div class="izin">Izin</div>'; break;
//					case 6: $event = '<div class="hadir">Hadir</div>'; break;
//					case 7: $event = '<div class="absen">Absen</div>'; break;
//					default: $event = '<div class="nothing">Tidak ada jadwal</div>';
//				}
