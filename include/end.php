
		<!-- BEGIN JAVASCRIPT -->
		<!-- jquery -->
		<script src="../assets/js/libs/jquery/jquery-1.11.2.min.js"></script>
		<script src="../assets/js/libs/jquery/jquery-migrate-1.2.1.min.js"></script>
		<script src="../assets/js/libs/jquery-ui/jquery-ui.min.js"></script>
		<script src="../assets/js/libs/bootstrap/bootstrap.min.js"></script>

		<!-- libs -->
		<script src="../assets/js/libs/spin.js/spin.min.js"></script>
		<script src="../assets/js/libs/select2/select2.min.js"></script>
		<script src="../assets/js/libs/moment/moment.min.js"></script>
		<script src="../assets/js/libs/bootstrap-datepicker/bootstrap-datepicker.js"></script>
		<script src="../assets/js/libs/autosize/jquery.autosize.min.js"></script>
		<script src="../assets/js/libs/nanoscroller/jquery.nanoscroller.min.js"></script>


		<!-- core source -->
		<script src="../assets/js/libs/fullcalendar/fullcalendar.min.js"></script>
		<script src="../assets/js/core/source/App.js"></script>
		<script src="../assets/js/core/source/AppNavigation.js"></script>
		<script src="../assets/js/core/source/AppOffcanvas.js"></script>
		<script src="../assets/js/core/source/AppCard.js"></script>
		<script src="../assets/js/core/source/AppForm.js"></script>
		<script src="../assets/js/core/source/AppNavSearch.js"></script>
		<script src="../assets/js/core/source/AppVendor.js"></script>
		<script src="../assets/js/core/demo/Demo.js"></script>
		<script src="../assets/js/core/demo/DemoCalendar.js"></script>

		<!-- dataTable -->
		<script src="../assets/js/libs/DataTables/jquery.dataTables.js"></script>
		<script src="https://cdn.datatables.net/fixedheader/3.1.2/js/dataTables.fixedHeader.min.js"></script>
		<script src="../assets/js/libs/DataTables/jquery.dataTables.responsive.js"></script>
		<!--custom script -->
		<script src="../assets/js/script.js"></script>
		<script src="../assets/js/jquery.cookie.js"></script>
	
		<!-- END JAVASCRIPT -->
			
		<script type="text/javascript">
				$.ajax({
	                    type: "GET",
	                    url: '../process/ajax/get_reminders.php',
	                    success: function(data)
	                    {   
	                    	var parse = JSON.parse(data);
	                    	var today = "<?php echo date('Y-m-d'); ?>";
	                    	for (var i = 0; i < parse.length; i++) 
	                    	{
	                    		if(parse[i].start == today)
	                    		{
	                    			var alerted = localStorage.getItem('alerted') || '';
								    if (alerted != 'yes') 
								    {
								    	$("#head_eventname").val(parse[i].event_name);
	                    				$("#head_des").val(parse[i].description);
	                    				$('#reminderModal').modal('show') ;
								     	localStorage.setItem('alerted','yes');
								    }
	                    		}
	                    	}     
	                    }
	                }); // end of ajax 
		</script>
	</body>
</html>
