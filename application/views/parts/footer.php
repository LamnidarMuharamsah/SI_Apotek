
            </div><!-- /.container-fluid -->

        </div><!-- /#page-wrapper -->

</div><!-- /#wrapper -->

<script type="text/javascript">
$(function(){
   $("#sandbox-container input").datepicker({
      autoclose: true,
        format: "dd-mm-yyyy",
        todayHighlight: true,       
        todayBtn: true,
        todayHighlight: true,
        todayBtn: true

    });
});
	function cekHapus(message){
		var cek = confirm(message);
		if(cek == true)
			return true;
		else
			return false;
	}

</script>
</body>
</html>