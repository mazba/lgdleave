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
            <?= $this->Html->link(__('Offices'), ['action' => 'index']) ?>
            <i class="fa fa-angle-right"></i>
        </li>
        <li><?= __('View Office') ?></li>
    </ul>
</div>


<div class="row">
    <div class="col-md-12">
        <!-- BEGIN BORDERED TABLE PORTLET-->
        <div class="portlet box blue-hoki">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-picture-o fa-lg"></i><?= __('Office Details') ?>
                </div>
                <div class="tools">
                    <?= $this->Html->link(__('Back'), ['action' => 'index'],['class'=>'btn btn-sm btn-success']); ?>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-scrollable">
                    <table class="table table-bordered table-hover">
                                                                                                        <tr>
                                    <th><?= __('Parent Office') ?></th>
                                    <td><?= $office->has('parent_office') ? $this->Html->link($office->parent_office->id, ['controller' => 'Offices', 'action' => 'view', $office->parent_office->id]) : '' ?></td>
                                </tr>
                                                                                                        <tr>
                                    <th><?= __('Code') ?></th>
                                    <td><?= h($office->code) ?></td>
                                </tr>
                                                                                                        <tr>
                                    <th><?= __('Name Bn') ?></th>
                                    <td><?= h($office->name_bn) ?></td>
                                </tr>
                                                                                                        <tr>
                                    <th><?= __('Name En') ?></th>
                                    <td><?= h($office->name_en) ?></td>
                                </tr>
                                                                                                        <tr>
                                    <th><?= __('Short Name Bn') ?></th>
                                    <td><?= h($office->short_name_bn) ?></td>
                                </tr>
                                                                                                        <tr>
                                    <th><?= __('Short Name En') ?></th>
                                    <td><?= h($office->short_name_en) ?></td>
                                </tr>
                                                                                                        <tr>
                                    <th><?= __('Digital Nothi Code') ?></th>
                                    <td><?= h($office->digital_nothi_code) ?></td>
                                </tr>
                                                                                                        <tr>
                                    <th><?= __('Reference Code') ?></th>
                                    <td><?= h($office->reference_code) ?></td>
                                </tr>
                                                                                                        <tr>
                                    <th><?= __('Phone') ?></th>
                                    <td><?= h($office->phone) ?></td>
                                </tr>
                                                                                                        <tr>
                                    <th><?= __('Mobile') ?></th>
                                    <td><?= h($office->mobile) ?></td>
                                </tr>
                                                                                                        <tr>
                                    <th><?= __('Fax') ?></th>
                                    <td><?= h($office->fax) ?></td>
                                </tr>
                                                                                                        <tr>
                                    <th><?= __('Email') ?></th>
                                    <td><?= h($office->email) ?></td>
                                </tr>
                                                                                                        <tr>
                                    <th><?= __('Web Url') ?></th>
                                    <td><?= h($office->web_url) ?></td>
                                </tr>
                                                                                                                                                                                                                
                            
                                <tr>
                                    <th><?= __('Status') ?></th>
                                    <td><?= __($status[$office->status]) ?></td>
                                </tr>
                                                                                                                                                                                                                                                                                                                                                                            </table>
                </div>
            </div>
        </div>
        <!-- END BORDERED TABLE PORTLET-->
    </div>
</div>

