	         <div class="title" style="color: #4187cf;">Calendar activity</div>
			<div id="eventCalendarLocale" style="width: 180px"></div>
			<script>
				$(document).ready(function() {
					$("#eventCalendarLocale").eventCalendar({
						eventsjson: 'eventCalendar_v042/json/events.json.php',
						monthNames: [ "Januari", "Februari", "Maret", "April", "Mei", "Juni","Juli", "Agustus", "September", "October", "November", "Desember" ],
						dayNames: [ 'Minggu','Senin','Selasa','Rabu','Kamis','Jum\'at','Sabtu' ],
						dayNamesShort: [ 'Mgu','Sen','Sel','Rab','Kam','Jum','Sab' ],
						txt_noEvents: "Tidak ada event pada hari itu",
						txt_SpecificEvents_prev: "",
						txt_SpecificEvents_after: "Event:",
						txt_next: "Selanjutnya",
						txt_prev: "Sebelumnya",
						txt_NextEvents: "Event Selanjutnya:",
						txt_GoToEventUrl: "Pergi ke laman",
						openEventInNewWindow: false,
  						showDescription: true
					});
				});
			</script>
		<button class="nice_button" onclick="window.location.href='user.php';">Ganti password</button>

        </div>
        <div class="clear"></div>