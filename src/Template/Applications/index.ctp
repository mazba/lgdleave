<?php
$status = \Cake\Core\Configure::read('status_options');
?>

<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="<?= $this->Url->build(('/Dashboard'), true); ?>"><?= __('Dashboard') ?></a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li><?= $this->Html->link(__('Applications'), ['action' => 'index']) ?></li>
    </ul>
</div>

<div class="row">
    <div class="col-md-12">
        <!-- BEGIN BORDERED TABLE PORTLET-->
        <div class="portlet box blue-hoki">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-list-alt fa-lg"></i><?= __('Application List') ?>
                </div>

            </div>
            <div class="portlet-body">
                <div class="table-scrollable">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>   <?= __('Sl. No.') ?></th>
                            <th>   <?= __('Location Type') ?></th>
                            <th>   <?= __('Divisions') ?></th>
                            <th>    <?= __('Districts') ?></th>
                            <th>    <?= __('Applicant Type') ?></th>
                            <th>     <?= __('Application Type') ?></th>
                            <th><?= __('Actions') ?></th>


                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($new_applications as $key => $application) { ?>
                            <tr>
                                <td><?= $this->Number->format($key + 1) ?></td>
                                <td><?= $application->location_type?></td>
                                <td><?= $application->area_division ?></td>
                                <td><?= $application->area_district ?></td>
                                <td><?= $application->applicant_type ?></td>
                                <td><?= $application->application_type ?></td>

                                <td class="actions">
                                    <?php
                                    echo $this->Html->link(__('View'), ['action' => 'receive', $application->applications_id], ['class' => 'btn btn-sm btn-info']);
                                    ?>

                                </td>
                            </tr>

                        <?php } ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        <!-- END BORDERED TABLE PORTLET-->
    </div>
</div>

