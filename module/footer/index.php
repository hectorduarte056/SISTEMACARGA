<!--///////////////////////////pie de pagina////////////////////-->
<footer class="text-center">
  <hr>
  <p><a href=""></a>Sistema CUVA, Curso Final De Grado 2020.</p>
</footer>

<!--///////////////////////////jquery////////////////////-->
<script type="text/javascript" src="<?php echo $nivel;?>js/jquery.min.js"></script>
<!--///////////////////////////bootstrap////////////////////-->
<script type="text/javascript" src="<?php echo $nivel;?>js/bootstrap.min.js"></script>
<!--///////////////////////////JavaScript personalizado////////////////////-->
<script type="text/javascript" src="<?php echo $nivel;?>js/function.js"></script>
<!--///////////////////////////JavaScript data_table////////////////////-->
<script type="text/javascript" src="<?php echo $nivel;?>js/data_table/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo $nivel;?>js/data_table/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo $nivel;?>js/data_table/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="<?php echo $nivel;?>js/data_table/buttons.bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo $nivel;?>js/data_table/jszip.min.js"></script>
<script type="text/javascript" src="<?php echo $nivel;?>js/data_table/pdfmake.min.js"></script>
<script type="text/javascript" src="<?php echo $nivel;?>js/data_table/vfs_fonts.js"></script>
<script type="text/javascript" src="<?php echo $nivel;?>js/data_table/buttons.html5.min.js"></script>
<script type="text/javascript" src="<?php echo $nivel;?>js/data_table/buttons.print.min.js"></script>
<script type="text/javascript" src="<?php echo $nivel;?>js/data_table/buttons.colVis.min.js"></script>
<!--
  ///////////////////////////java script//Personalizado///////////////////////
-->
<script>
     $(document).ready(function() {
  var table = $('#example').DataTable( {
    lengthChange: true,
    "order":[[0, "desc"]],
    buttons: [ 'copy', 'excel', 'pdf', 'colvis','print', ]
  } );

  table.buttons().container()
    .appendTo( '#example_wrapper .col-sm-6:eq(0)' );
} );
    </script>