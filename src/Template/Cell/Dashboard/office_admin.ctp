<div class="row">
    <div class="col-md-6">
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="dashboard-stat blue-madison ">
                <div class="visual">
                    <i class="fa fa-users"></i>
                </div>
                <div class="details">
                    <div class="number">
                        <?php echo $user_number; ?>
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
                        <?php echo $application_number; ?>
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
                        <?php echo $pending_application_number; ?>
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
                        <?php echo $approve_application_number; ?>
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
                        <?php echo $reject_application_number; ?>
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
                        <?php echo $number_of_application_type; ?>
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
    <div class="col-md-6">
        <div class="portlet solid grey-cararra bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-bullhorn"></i><?= __('Recent Application Status') ?>
                </div>
            </div>
            <div class="portlet-body">
                <div id="site_activities_loading">
                    <img src="<?php echo $this->request->webroot; ?>assets/admin/layout/img/loading.gif" alt="loading"/>
                </div>
                <div id="site_activities_content" class="display-none">
                    <div id="site_activities" style="height: 145px;">
                    </div>
                </div>
                <div style="margin: 5px 0 10px 5px">
                </div>
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
                                if(0):
                                foreach($office_warehouse as $warehouse):?>
                                <tr>
                                    <th><?php echo $warehouse->title_bn; ?></th>
                                    <td><?php echo count($warehouse->items); ?></td>
                                    <td><?php echo count($warehouse->item_assigns); ?></td>
                                    <td><?php echo count($warehouse->item_withdrawals); ?></td>
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
                                    <th><?= __('Approve by') ?></th>
                                    <th><?= __('Approved Time') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if(0):
                                foreach($recently_assigned_item as $item):?>
                                    <tr>
                                        <td><?php echo $item->item->title_bn.'('.$item->item->office_serial_number.')'; ?></td>
                                        <td><?php echo $item->designated_user->full_name_bn; ?></td>
                                        <td><?php echo $item->formatted_assign_date; ?></td>
                                        <td><?php echo $item->quantity; ?></td>
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