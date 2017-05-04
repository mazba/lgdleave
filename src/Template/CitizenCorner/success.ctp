<?php
use Cake\Core\Configure;

$status = array_flip(Configure::read('application_status'));
$religions = \Cake\Core\Configure::read('religions');
//echo "<pre>";print_r($application);die();
?>
<style>
    th {
        text-align: left;
        border: 1px solid #ddd;
        width: 40%;
        padding: 10px !important;
    }

    td {
        text-align: left;
        border: 1px solid #ddd;
        width: 60%;
        padding: 10px !important;
    }
</style>
<div class="row">
    <div class="col-md-12 col-md-offset-0">
        <!-- BEGIN BORDERED TABLE PORTLET-->
        <div class="portlet box blue-hoki">
            <div class="portlet-title">


            </div>
            <div class="portlet-body">
                <div class="row">
                    <div class="col-md-8 col-md-offset-0">

                        <table class="table table-bordered table-responsive">
                            <tbody>
                            <tr style="background-color: #d0c7cf">
                                <th colspan="2"><?= __('Profile_Setup') ?></th>
                            </tr>
                            <tr>
                                <th><?= __('Applicant_name_bn') ?></th>
                                <td><?php echo $application['applicant_name_bn']; ?></td>
                            </tr>
                            <?php if ($application['applicant_name_en']): ?>
                                <tr>
                                    <th><?= __('Applicant_name_en') ?></th>
                                    <td><?php echo $application['applicant_name_en']; ?></td>
                                </tr>
                            <?php endif; ?>
                            <tr>
                                <th><?= __('Mother_name_bn') ?></th>
                                <td><?php echo $application['mother_name_bn']; ?></td>
                            </tr>
                            <?php if ($application['mother_name_en']): ?>
                                <tr>
                                    <th><?= __('Mother_name_en') ?></th>
                                    <td><?php echo $application['mother_name_en']; ?></td>
                                </tr>
                            <?php endif; ?>

                            <tr>
                                <th><?= __('Father_name_bn') ?></th>
                                <td><?php echo $application['father_name_bn']; ?></td>
                            </tr>
                            <?php if ($application['father_name_en']): ?>
                                <tr>
                                    <th><?= __('Father_name_en') ?></th>
                                    <td><?php echo $application['father_name_en']; ?></td>
                                </tr>
                            <?php endif; ?>


                            <tr>
                                <th><?= __('Email') ?></th>
                                <td><?php echo $application['email']; ?></td>
                            </tr>
                            <?php if ($application['cellphone']): ?>
                                <tr>
                                    <th><?= __('Cellphone') ?></th>
                                    <td><?php echo $application['cellphone']; ?></td>
                                </tr>
                            <?php endif; ?>

                            <?php if ($application['nid']): ?>
                                <tr>
                                    <th><?= __('Nid') ?></th>
                                    <td><?php echo $application['nid']; ?></td>
                                </tr>
                            <?php endif; ?>

                            <?php if ($application['religion']): ?>
                                <tr>
                                    <th><?= __('Religion') ?></th>
                                    <td><?php echo $religions[$application['religion']]; ?></td>
                                </tr>
                            <?php endif ?>
                            <?php if ($application['present_address']): ?>
                                <tr>
                                    <th><?= __('Present_address') ?></th>
                                    <td><?php echo $application['present_address']; ?></td>
                                </tr>
                            <?php endif; ?>

                            <?php if ($application['permanent_address']): ?>
                                <tr>
                                    <th><?= __('Permanent_address') ?></th>
                                    <td><?php echo $application['permanent_address']; ?></td>
                                </tr>
                            <?php endif; ?>

                            <?php if ($application['emergency_contact']): ?>
                                <tr>
                                    <th><?= __('Emergency_contact') ?></th>
                                    <td><?php echo $application['emergency_contact']; ?></td>
                                </tr>
                            <?php endif; ?>

                            </tbody>
                        </table>

                        <table class="table table-bordered table-responsive">
                            <tbody>
                            <tr style="background-color: #d0c7cf">
                                <th colspan="2"><?= __('Billing_Setup') ?></th>
                            </tr>

                            <tr>
                                <th><?= __('ApplicationTypes') ?></th>
                                <td><?php echo $application['application_type']['title_bn']; ?></td>
                            </tr>
                            <tr>
                                <th><?= __('is_foregin_tour') ?></th>
                                <td><?php echo $application['is_foregin_tour'] ? 'হঁ্যা' : 'না'; ?></td>
                            </tr>
                            <?php if ($application['is_foregin_tour']): ?>
                                <tr>
                                    <th><?= __('pasport_number') ?></th>
                                    <td><?php echo $application['pasport_number']; ?></td>
                                </tr>
                                <tr>
                                    <th><?= __('applicant_using_passport_validity') ?></th>
                                    <td><?php echo $application['applicant_using_passport_validity'] ? date('d-m-Y', $application['applicant_using_passport_validity']) : ''; ?></td>
                                </tr>
                                <tr>
                                    <th><?= __('using_passport_issue_place') ?></th>
                                    <td><?php echo $application['using_passport_issue_place']; ?></td>
                                </tr>
                            <?php endif; ?>
                            <tr>
                                <th><?= __('have_foregin_tour') ?></th>
                                <td><?php echo $application['have_foregin_tour'] ? 'হঁ্যা' : 'না'; ?></td>
                            </tr>
                            <?php if ($application['have_foregin_tour']): ?>
                                <tr>
                                    <th><?= __('last_foreign_tour_country') ?></th>
                                    <td><?php echo $application['last_foreign_tour_country']; ?></td>
                                </tr>
                                <tr>
                                    <th><?= __('last_foreign_tour_reason') ?></th>
                                    <td><?php echo $application['last_foreign_tour_reason']; ?></td>
                                </tr>
                                <tr>
                                    <th><?= __('last_foreign_tour_time') ?></th>
                                    <td><?php echo $application['last_foreign_tour_time'] ? date('d-m-Y', $application['last_foreign_tour_time']) : ''; ?></td>
                                </tr>
                            <?php endif; ?>
                            <tr>
                                <th><?= __('Application_reason') ?></th>
                                <td><?php echo $application['application_reason']; ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Start Date') ?></th>
                                <td><?php echo $application['start_date'] ? date('d-m-Y', $application['start_date']) : ''; ?></td>
                            </tr>
                            <tr>
                                <th><?= __('End date') ?></th>
                                <td><?php echo $application['end_date'] ? date('d-m-Y', $application['end_date']) : ''; ?></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-4 col-md-offset-0">
                        <h3><?= __('Applications File') ?></h3>
                        <?php
                        if (count($application['applications_files'])):
                            foreach ($application['applications_files'] as $key => $file):
                                ?>
                                <a href="<?php echo $this->request->webroot . $file['file']; ?>"
                                   target="_blank"  class="btn green-haze btn-circle btn-sm todo-projects-config">
                                    <i class="fa fa-file-word-o"></i> <?= $file['file_label'] ?>
                                </a>
                                <?php
                            endforeach;
                        endif
                        ?>
                    </div>
                    <div class="col-md-4 col-md-offset-0">
                        <h3><?= __('To View Pdf') ?></h3>
                        <a href="<?= $this->Url->build(('/CitizenCorner/pdf_view/' . $application['id']), true) ?>"
                           target="_blank" class="btn green-haze btn-circle btn-sm todo-projects-config">
                            <i class="fa fa-file-pdf-o"></i> <?= __('Applicant_info')?>
                        </a>
                        <a href="<?= $this->Url->build(('/CitizenCorner/pdfViewApplication/' . $application['id']), true) ?>"
                           target="_blank" class="btn green-haze btn-circle btn-sm todo-projects-config">
                            <i class="fa fa-file-pdf-o"></i> <?= __('Applicant_Application')?>
                        </a>
                    </div>

                </div>

            </div>
        </div>
        <!-- END BORDERED TABLE PORTLET-->
    </div>
</div>

