<main>
	<h1>Rekap Kehadiran</h1>

	<ul class="nav nav-tabs mt-8">
		<li class="nav-item">
			<a class="nav-link text-dark" aria-current="page" href="<?=base_url('absence/absence/absence_page')?>">Kehadiran</a>
		</li>
		<li class="nav-item">
			<a class="nav-link active text-info" href="<?=base_url('absence/attendance/attendance_page')?>">Rekap Kehadiran</a>
		</li>
	</ul>

	<?php $this->load->view($view_data)?>


</main>
