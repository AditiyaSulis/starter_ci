<main>
	<h1>Data Attendance</h1>


	<ul class="nav nav-tabs mt-8 ms-5">
		<li class="nav-item">
			<a class="nav-link text-dark border border-bottom-0 rounded-top bg-hover-light" aria-current="page" href="<?=base_url('absence/attendance/su_attendance_page')?>">Data Attendance</a>
		</li>
		<li class="nav-item">
			<a class="nav-link active text-info" href="<?=base_url('absence/attendance/log_attendance_page')?>">Log Attendance</a>
		</li>
	</ul>
	<?php $this->load->view($view_data)?>


</main>
