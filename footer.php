  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.3.8
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>

  
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
  <!-- price format -->
  <script src="dist/js/jquery.price_format.2.0.min.js" type="text/javascript"></script>
  <script src="dist/js/jquery.price_format.2.0.js" type="text/javascript"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="plugins/select2/select2.full.min.js"></script>
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- date-range-picker -->
<script src="dist/js/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- InputMask -->
<script src="plugins/input-mask/jquery.inputmask.js"></script>
<script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- bootstrap datepicker -->
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- SlimScroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
        //Datemask dd/mm/yyyy
    $("#datemask").inputmask("yyyy-mm-dd", {"placeholder": "yyyy-mm-dd"});
    //Money Euro
    $("[data-mask]").inputmask("yyyy-mm-dd", {"placeholder": "yyyy-mm-dd"});


    $("#example1").DataTable({
      "order": [[ 0, "desc" ]]
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
    $('#laporan').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "order": [[ 0, "desc" ]]
    });
    //Date range picker
    $('#reservation').daterangepicker({
      autoUpdateInput: false,
      locale: {
          cancelLabel: 'Clear'
      }
    });
    $('#reservation').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('YYYY-MM-DD') + ':' + picker.endDate.format('YYYY-MM-DD'));
    });
    $('#reservation').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
    });
  });
  function jenisbarang() {
    var ket = $('#jenis :selected').val();
    if (ket == 'obat') {
      document.getElementById("price2").disabled = true;
      $('#price2').val('0');
      document.getElementById("price3").disabled = true;
      $('#price3').val('0');
    } else {
      document.getElementById("price2").disabled = false;
      document.getElementById("price3").disabled = false;
    }
  }
</script>
<script type="text/javascript"> 
  $('#price').priceFormat({ prefix: '', centsSeparator: ',', thousandsSeparator: '.', centsLimit: 0 }); 
  $('#price1').priceFormat({ prefix: '', centsSeparator: ',', thousandsSeparator: '.', centsLimit: 0 }); 
  $('#price2').priceFormat({ prefix: '', centsSeparator: ',', thousandsSeparator: '.', centsLimit: 0 }); 
  $('#price3').priceFormat({ prefix: '', centsSeparator: ',', thousandsSeparator: '.', centsLimit: 0 }); 
  $('#price4').priceFormat({ prefix: '', centsSeparator: ',', thousandsSeparator: '.', centsLimit: 0 }); 
  $('#price5').priceFormat({ prefix: '', centsSeparator: ',', thousandsSeparator: '.', centsLimit: 0 }); 

  $("#keterangan").change(function(){

    if ($("#keterangan").val()=="kasir") {
      
      $("#kasir").removeClass("hidden");
      $("#kategory").addClass("hidden");

    } else if ($("#keterangan").val()=="kategory") {
      
      $("#kasir").addClass("hidden");
      $("#kategory").removeClass("hidden");

    } else {
     
      $("#kasir").addClass("hidden");
      $("#kategory").addClass("hidden");

    }
  });
</script>
</body>
</html>
