<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php echo $headernya; ?>
</head>
<body>
<div id="wrapper">
    <?php echo $topbarnya; ?>
    <!-- /. NAV TOP  -->
    <nav class="navbar-default navbar-side" role="navigation">
        <?php echo $sidebarnya; ?>

    </nav>
    <!-- /. NAV SIDE  -->
    <div id="page-wrapper" >
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <h2><?php echo $judul; ?> </h2>
                </div>
            </div>
            <!-- /. ROW  -->
            <hr />
            <?php echo $contentnya; ?>
            <!-- /. ROW  -->
        </div>
        <!-- /. PAGE INNER  -->
    </div>
    <!-- /. PAGE WRAPPER  -->
</div>
<div class="footer">
    <?php echo $footnya; ?>
</div>


<!-- /. WRAPPER  -->
<!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
<!-- JQUERY SCRIPTS -->

<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
<script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
<script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.js')?>"></script>
<script src="<?php echo base_url('assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js')?>"></script>


<!--script src="<?php echo base_url(); ?>assets/js/jquery-1.10.2.js"></script-->
<!-- BOOTSTRAP SCRIPTS -->
<!--script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script-->
<!-- CUSTOM SCRIPTS -->
<script src="<?php echo base_url(); ?>assets/js/custom.js"></script>
<script type="text/javascript">
    $(document).ready(function(){

        $(function() {
            $('#example1').dataTable();
        });

        //datepicker
        $('.datepicker').datepicker({
            autoclose: true,
            format: "yyyy-mm-dd",
            todayHighlight: true,
            orientation: "top auto",
            todayBtn: true,
            todayHighlight: true,
        });

    });
</script>
</body>
</html>
