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
        <li>
            <?= $this->Html->link(__('Applicants'), ['action' => 'index']) ?>
            <i class="fa fa-angle-right"></i>
        </li>
        <li><?= __('Applicant Details') ?></li>
    </ul>
</div>


<div class="row">
    <div class="col-md-12">
        <!-- BEGIN BORDERED TABLE PORTLET-->
        <div class="portlet box blue-hoki">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-picture-o fa-lg"></i><?= __('Applicant Details') ?>
                </div>
                <div class="tools">
                    <?= $this->Html->link(__('Back'), ['action' => 'index'], ['class' => 'btn btn-sm btn-success']); ?>
                </div>
            </div>

            <div class="portlet-body">


                <div class="table-scrollable">
                    <div class="col-md-6 col-md-offset-3">
                        <table class="table table-bordered table-hover">

                            <tr>
                                <th><?= __('Location Type') ?></th>
                                <td><?= $applicant['location_type']['title_bn'] ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Applicant Types') ?></th>
                                <td><?= $applicant['applicant_type']['title_bn'] ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Divisions') ?></th>
                                <td><?= $applicant['area_division']['divname'] ?></td>
                            </tr>

                            <tr>
                                <th><?= __('District') ?></th>
                                <td><?= $applicant['area_district']['zillaname'] ?></td>
                            </tr>
                            <?php if ($applicant['area_upazila']): ?>
                                <tr>
                                    <th><?= __('Upazilas') ?></th>
                                    <td><?= $applicant['area_upazila']['upazilaname'] ?></td>
                                </tr>
                            <?php endif; ?>
                            <?php if ($applicant['city_corporation']): ?>
                                <tr>
                                    <th><?= __('City_corporations') ?></th>
                                    <td><?= $applicant['city_corporation']['citycorporationname'] ?></td>
                                </tr>
                            <?php endif; ?>
                            <?php if ($applicant['municipal']): ?>

                                <tr>
                                    <th><?= __('Municipal') ?></th>
                                    <td><?= $applicant['municipal']['municipalname'] ?></td>
                                </tr>
                            <?php endif; ?>
                            <?php if ($applicant['union']): ?>

                                <tr>
                                    <th><?= __('Unions') ?></th>
                                    <td><?= $applicant['union']['unionname'] ?></td>
                                </tr>
                            <?php endif; ?>


                        </table>
                    </div>
                </div>

            </div>
        </div>
        <!-- END BORDERED TABLE PORTLET-->
    </div>
</div>

