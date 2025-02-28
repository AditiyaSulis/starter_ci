
<style>
	table {
		width: 100%;
		border-collapse: collapse;
	}
	th, td {
		border: 1px solid #ddd;
		text-align: center;
		padding: 10px;
	}
	th {
		background: #f4f4f4;
	}
	.event {
		padding: 5px;
		border-radius: 5px;
		font-weight: bold;
	}
	.calendar { width: 100%; border-collapse: collapse; }
	.calendar th, .calendar td { padding: 10px; text-align: center; border: 1px solid #ddd; }
	.calendar-header { background-color: #f4f4f4; }
	.week-days td { font-weight: bold; background-color: #efefef; }
	.today { background-color: rgba(35, 70, 248, 0.2) !important; font-weight: bold; }
	.jadwal { background-color: #adf6bc; }
	.dayoff { background-color: #ed6f6f; }
	.tanggal_merah { background-color: #d50e0e; }
	.cuti { background-color: #e4df65; }
	.izin { background-color: #65c2e4; }
	.minggu { background-color: rgba(209, 35, 248, 0.2); }
	.absen { background-color: #e87828; }
	.nothing { background-color: #73736b; }
</style>

<main>
	<h1>Schedule</h1>

	<div id="calendar-container">
		<?= $calendar ?>
	</div>

	<script>
		$(document).on("click", "#calendar-container a", function(e) {
			e.preventDefault();

			var url = $(this).attr("href"); 
			$.ajax({
				url: url,
				type: "GET",
				beforeSend: function() {
					$("#calendar-container").html('<p>Loading...</p>'); 
				},
				success: function(response) {
					$("#calendar-container").html(response); 
				},
				error: function() {
					alert("Gagal memuat kalender.");
				}
			});
		});
	</script>
</main>
