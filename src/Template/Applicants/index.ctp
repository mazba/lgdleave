<?php
$status = \Cake\Core\Configure::read('status_options');
//echo "<pre>";print_r($applicants);die();
?>

<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="<?= $this->Url->build(('/Dashboard'), true); ?>"><?= __('Dashboard') ?></a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li><?= $this->Html->link(__('Users'), ['action' => 'index']) ?></li>
    </ul>
</div>

<div class="row">
    <div class="col-md-12">
        <!-- BEGIN BORDERED TABLE PORTLET-->
        <div class="portlet box blue-hoki">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-list-alt fa-lg"></i><?= __('User List') ?>
                </div>
                <div class="tools">
                    <?= $this->Html->link(__('New Applicants'), ['action' => 'add'], ['class' => 'btn btn-sm btn-primary']); ?>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-scrollable">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th><?= __('Sl. No.') ?></th>
                            <th><?= __('location_type') ?></th>
                            <th><?= __('applicant_type') ?></th>
                            <th><?= __('area_division') ?></th>
                            <th><?= __('area_district') ?></th>
                            <th><?= __('area_upazila') ?></th>
                            <th><?= __('Actions') ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($applicants as $key => $applicant) { ?>
                            <tr>
                                <td><?= $this->Number->format($key + 1) ?></td>
                                <td><?= $applicant['location_type']['title_bn'] ?></td>
                                <td><?= $applicant['applicant_type']['title_bn']?></td>
                                <td><?= $applicant['area_division']['divname'] ?></td>
                                <td><?= $applicant['area_district']['zillaname'] ?></td>
                                <td><?= $applicant['area_upazila']['upazilaname'] ?></td>
                                <td class="actions">
                                    <?php
                                    echo $this->Html->link(__('Edit'), ['action' => 'edit', $applicant->id], ['class' => 'btn btn-sm btn-warning']);
                                    echo $this->Form->postLink(__('Delete'), ['action' => 'delete', $applicant->id], ['class' => 'btn btn-sm btn-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $applicant->id)]);
                                    ?>

                                </td>
                            </tr>

                        <?php } ?>
                        </tbody>
                    </table>
                </div>
                <ul class="pagination">
                    <?php
                    echo $this->Paginator->prev('<<');
                    echo $this->Paginator->numbers();
                    echo $this->Paginator->next('>>');
                    ?>
                </ul>
            </div>
        </div>
        <!-- END BORDERED TABLE PORTLET-->
    </div>
</div>

