<!--footer section start-->
<footer class="sticky-footer">
	<?php echo date("Y") ?> &copy; All Rights Reserverd | Developed By - Md.Shabuddin Nayan
</footer>
<!--footer section end-->


</div>
<!-- main content end-->
</section>

<!-- Placed js at the end of the document so the pages load faster -->
<script src="public/js/jquery-1.10.2.min.js"></script>
<script src="public/js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="public/js/jquery-migrate-1.2.1.min.js"></script>
<script src="public/js/bootstrap.min.js"></script>
<script src="public/js/modernizr.min.js"></script>
<script src="public/js/jquery.nicescroll.js"></script>

<!--dynamic table-->
<script type="text/javascript" language="javascript" src="public/js/advanced-datatable/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="public/js/data-tables/DT_bootstrap.js"></script>

<!--dynamic table initialization -->
<script src="public/js/dynamic_table_init.js"></script>

<!-- JavaScript for Uploaded File Preview -->
<script>
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('#blah')
				.attr('src', e.target.result);
			};
			
			reader.readAsDataURL(input.files[0]);
		}
	}
</script>
<!-- JavaScript for Uploaded File Preview -->

<!-- Summernote Start -->
<script src="public/summernote/summernote-lite.min.js"></script>
<script>
	$(document).ready(function() {
		$('#summerOne').summernote();
		$('#summerTwo').summernote();
	});
</script>
<!-- Summernote End -->

<!--Morris Chart-->
<script src="public/js/morris-chart/morris.js"></script>
<script src="public/js/morris-chart/raphael-min.js"></script>
<script src="public/js/morris-chart/morris.init.js"></script>

<!-- jQuery Flot Chart-->
<script src="js/flot-chart/jquery.flot.js"></script>
<script src="js/flot-chart/jquery.flot.tooltip.js"></script>
<script src="js/flot-chart/jquery.flot.resize.js"></script>
<script src="js/flot-chart/jquery.flot.pie.resize.js"></script>
<script src="js/flot-chart/jquery.flot.selection.js"></script>
<script src="js/flot-chart/jquery.flot.stack.js"></script>
<script src="js/flot-chart/jquery.flot.time.js"></script>
<script src="js/main-chart.js"></script>

<!--easy pie chart-->
<script src="js/easypiechart/jquery.easypiechart.js"></script>
<script src="js/easypiechart/easypiechart-init.js"></script>

<!--Sparkline Chart-->
<script src="js/sparkline/jquery.sparkline.js"></script>
<script src="js/sparkline/sparkline-init.js"></script>

<!--icheck -->
<script src="js/iCheck/jquery.icheck.js"></script>
<script src="js/icheck-init.js"></script>

<!--Chart JS-->
<script src="public/js/chart-js/Chart.js"></script>
<script src="public/js/chart-js/chartjs.init.js"></script>

<!--Editor-->
<script type="text/javascript" src="public/js/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="public/js/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
<script type="text/javascript" src="public/js/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>

<!-- DATE PICKER CONFIG -->
<script>
	$(".default-date-picker").datepicker({format: 'yyyy-mm-dd'});
</script>

<script>
    jQuery(document).ready(function(){
		$('.wysihtml5').wysihtml5();
	});
</script>

<!--common scripts for all pages-->
<script src="public/js/scripts.js"></script>

</body>

<!-- Mirrored from adminex.themebucket.net/blank_page.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 29 Sep 2015 19:55:06 GMT -->
</html>