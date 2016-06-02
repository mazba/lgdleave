<div class="row">
    <div class="col-md-12">
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="dashboard-stat blue-madison ">
                <div class="visual">
                    <i class="fa fa-users"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <?php echo $this->System->eng_to_bangla_code($user_number); ?>
                    </div>
                    <div class="desc">
                        <?= __('Total User') ?>
                    </div>
                </div>
                <?php
//                echo $this->Html->link(__('View More'), ['action' => 'index','controller'=>'users'], ['class' => 'more']);
                ?>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="dashboard-stat red-intense ">
                <div class="visual">
                    <i class="fa fa-shopping-cart"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <?php echo $this->System->eng_to_bangla_code($application_number); ?>
                    </div>
                    <div class="desc">
                        <?= __('Total Applications') ?>
                    </div>
                </div>
                <?php
//                echo $this->Html->link(__('View More'), ['action' => 'index','controller'=>'items'], ['class' => 'more']);
                ?>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="dashboard-stat red-haze">
                <div class="visual">
                    <i class="fa fa-shopping-cart"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <?php echo $this->System->eng_to_bangla_code($pending_application_number); ?>
                    </div>
                    <div class="desc">
                        <?= __('Pending') ?>
                    </div>
                </div>
                <?php
//                echo $this->Html->link(__('View More'), ['action' => 'index','controller'=>'item_assigns'], ['class' => 'more']);
                ?>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="dashboard-stat blue-hoki">
                <div class="visual">
                    <i class="fa fa-bank"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <?php echo $this->System->eng_to_bangla_code($approve_application_number); ?>
                    </div>
                    <div class="desc">
                        <?= __('Approved') ?>
                    </div>
                </div>
                <?php
//                echo $this->Html->link(__('View More'), ['action' => 'index','controller'=>'office_buildings'], ['class' => 'more']);
                ?>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="dashboard-stat yellow-casablanca">
                <div class="visual">
                    <i class="fa fa-cube "></i>
                </div>
                <div class="details">
                    <div class="number">
                        <?php echo $this->System->eng_to_bangla_code($reject_application_number); ?>
                    </div>
                    <div class="desc">
                        <?= __(' Rejected') ?>
                    </div>
                </div>
                <?php
//                echo $this->Html->link(__('View More'), ['action' => 'index','controller'=>'office_rooms'], ['class' => 'more']);
                ?>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="dashboard-stat green-seagreen">
                <div class="visual">
                    <i class="fa fa-mortar-board "></i>
                </div>
                <div class="details">
                    <div class="number">
                        <?php echo $this->System->eng_to_bangla_code($number_of_application_type); ?>
                    </div>
                    <div class="desc">
                        <?= __('Application Type') ?>
                    </div>
                </div>
                <?php
//                echo $this->Html->link(__('View More'), ['action' => 'index','controller'=>'committees'], ['class' => 'more']);
                ?>
            </div>
        </div>
    </div>

</div>
<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="portlet green-haze box">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-bank"></i><?= __('Recent Pending Applications') ?>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-responsive">
                    <div class="scroller" style="height: 155px;" data-always-visible="1" data-rail-visible="0">
                        <table class="table table-hover table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><?= __('Application Code') ?></th>
                                    <th><?= __('Applicant') ?></th>
                                    <th><?= __('Applicant Type') ?></th>
                                    <th><?= __('Application Time') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if($new_applications):
                                foreach($new_applications as $application):?>
                                <tr>
                                    <th><?php echo $application['temporary_id'] ?></th>
                                    <td><?php echo $application['applicant_name_bn'] ?></td>
                                    <td><?php echo $application ['applicant_type']; ?></td>
                                    <td><?php echo $application['submission']; ?></td>
                                </tr>
                                <?php
                                    endforeach;
                                    else:
                                    ?>
                                    <tr>
                                        <td colspan="4" style="text-align: center"><?= __('No Data Found') ?></td>
                                    </tr>
                                    <?php
                                    endif
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="portlet green-haze box">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-bank"></i><?= __('Recently Accepted Application') ?>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-responsive">
                    <div class="scroller" style="height: 155px;" data-always-visible="1" data-rail-visible="0">
                        <table class="table table-hover table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><?= __('Application Code') ?></th>
                                    <th><?= __('Applicant') ?></th>
                                    <th><?= __('Applicant Type') ?></th>
                                    <th><?= __('Approved Time') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if($new_approved_applications):
                                foreach($new_approved_applications as $application):?>
                                    <tr>
                                        <th><?php echo $application['temporary_id'] ?></th>
                                        <td><?php echo $application['applicant_name_bn'] ?></td>
                                        <td><?php echo $application ['applicant_type']; ?></td>
                                        <td><?php echo $application['submission']; ?></td>
                                    </tr>
                                <?php
                                endforeach;
                                else:
                                ?>
                                <tr>
                                    <td colspan="4" style="text-align: center"><?= __('No Data Found') ?></td>
                                </tr>
                                <?php
                                endif;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= $this->request->webroot; ?>assets/admin/pages/scripts/index.js" type="text/javascript"></script>
<script src="<?php echo $this->request->webroot; ?>assets/global/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
<script src="<?php echo $this->request->webroot; ?>assets/global/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
<script src="<?php echo $this->request->webroot; ?>assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
<script>
    jQuery(document).ready(function() {
        Index.init(); // init index page
        Index.initCharts(); // init index page's custom scripts
    });
</script>