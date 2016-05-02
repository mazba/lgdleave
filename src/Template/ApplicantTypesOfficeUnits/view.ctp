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
            <?= $this->Html->link(__('Applicant Types Office Units'), ['action' => 'index']) ?>
            <i class="fa fa-angle-right"></i>
        </li>
        <li><?= __('View Applicant Types Office Unit') ?></li>
    </ul>
</div>


<div class="row">
    <div class="col-md-12">
        <!-- BEGIN BORDERED TABLE PORTLET-->
        <div class="portlet box blue-hoki">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-picture-o fa-lg"></i><?= __('Applicant Types Office Unit Details') ?>
                </div>
                <div class="tools">
                    <?= $this->Html->link(__('Back'), ['action' => 'index'],['class'=>'btn btn-sm btn-success']); ?>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-scrollable">
                    <table class="table table-bordered table-hover">
                                                                                                        <tr>
                                    <th><?= __('Applicant Type') ?></th>
                                    <td><?= $applicantTypesOfficeUnit->has('applicant_type') ? $this->Html->link($applicantTypesOfficeUnit->applicant_type->title_bn, ['controller' => 'ApplicantTypes', 'action' => 'view', $applicantTypesOfficeUnit->applicant_type->id]) : '' ?></td>
                                </tr>
                                                                                                        <tr>
                                    <th><?= __('Office Unit') ?></th>
                                    <td><?= $applicantTypesOfficeUnit->has('office_unit') ? $this->Html->link($applicantTypesOfficeUnit->office_unit->name_bn, ['controller' => 'OfficeUnits', 'action' => 'view', $applicantTypesOfficeUnit->office_unit->id]) : '' ?></td>
                                </tr>
                                                                                                                                                                                                                
                            
                                <tr>
                                    <th><?= __('Status') ?></th>
                                    <td><?= __($status[$applicantTypesOfficeUnit->status]) ?></td>
                                </tr>
                                                                                                                            </table>
                </div>
            </div>
        </div>
        <!-- END BORDERED TABLE PORTLET-->
    </div>
</div>

