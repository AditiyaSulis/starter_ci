<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>

<main>
	<h1>Data Attendance</h1>


	<ul class="nav nav-tabs mt-8 mb-8">
		<li class="nav-item">
			<a class="nav-link active text-info" aria-current="page" href="<?=base_url('absence/attendance/su_attendance_page')?>">Data Attendance</a>
		</li>
		<li class="nav-item">
			<a class="nav-link  text-dark" href="<?=base_url('absence/attendance/log_attendance_page')?>">Log Attendance</a>
		</li>
	</ul>
	<?php $this->load->view($view_data)?>


</main>
