<?php $this->view('partials/head', array(
    "scripts" => array(
        "clients/client_list.js"
    )
)); ?>

<div class="container">

    <div class="row">

        <?php $widget->view($this, 'manifests-included'); ?>
        <?php $widget->view($this, 'manifests-catalog'); ?>
        <?php $widget->view($this, 'manifests_featured_items'); ?>

    </div> <!-- /row -->

    <div class="row">

        <?php $widget->view($this, 'manifests_managed_installs'); ?>
        <?php $widget->view($this, 'manifests_managed_uninstalls'); ?>
        <?php $widget->view($this, 'manifests_managed_updates'); ?>
   
    </div> <!-- /row -->
    
    <div class="row">

        <?php $widget->view($this, 'manifests_optional_installs'); ?>
        <?php $widget->view($this, 'manifests_included_manifests'); ?>
        <?php $widget->view($this, 'manifests_self_sevice'); ?>
   
    </div> <!-- /row -->
    
    <div class="row">

        <?php $widget->view($this, 'manifests-catalog-graph'); ?>
   
    </div> <!-- /row -->

</div>  <!-- /container -->

<script src="<?php echo conf('subdirectory'); ?>assets/js/munkireport.autoupdate.js"></script>

<?php $this->view('partials/foot'); ?>
