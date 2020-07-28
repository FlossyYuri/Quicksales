<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
</div>
</main>
<!-- End Main -->

<!-- Footer -->
<footer class="page-footer font-small bg-dark-main">
    <!-- Copyright -->
    <div class="container">
        <div class="py-3 d-flex justify-content-between">
            <span>Copyright © Todos direitos reservados</span>
            <span>Criado por:
                <a href="https://chillstudio.co.mz" class="text-uppercase">CS Chill Studio MZ</a></span>
        </div>
    </div>
    <!-- Copyright -->
</footer>
<!-- Footer -->

<!-- jQuery -->
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.min.js') ?>"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="<?php echo base_url('assets/js/popper.min.js') ?>"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="<?php echo base_url('assets/js/mdb.min.js') ?>"></script>
<!-- Your custom scripts (optional) -->
<script src="<?php echo base_url('assets/sweetalert2/sweetalert2.js') ?>"></script>
<script src="<?php echo base_url('assets/js/custom/custom.js'); ?>"></script>
<?php

if (isset($scripts)) {
    foreach ($scripts as $script) {
        echo '<script type="text/javascript" src=' . base_url($script) . '></script>';
    }
}

?>
</body>

</html>