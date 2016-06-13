<?php
use Cake\Core\Configure;

$status = array_flip(Configure::read('application_status'));
$religions = \Cake\Core\Configure::read('religions');
//echo "<pre>";print_r($applications);die();
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
                                <th colspan="2"><?= __('Account Setup') ?></th>
                            </tr>
                            <tr>
                                <th><?= __('Divisions') ?></th>
                                <td><?php echo $applications['area_division']['divname']; ?></td>
                            </tr>
                            <?php if ($applications['area_district']): ?>
                                <tr>
                                    <th><?= __('Districts') ?></th>
                                    <td><?php echo $applications['area_district']['zillaname']; ?></td>
                                </tr>
                            <?php endif ?>
                            <?php if ($applications['municipal']): ?>
                                <tr>
                                    <th><?= __('Municipal') ?></th>
                                    <td><?php echo $applications['municipal']['municipalname']; ?></td>
                                </tr>
                            <?php endif ?>
                            <?php if ($applications['city_corporation']): ?>
                                <tr>
                                    <th><?= __('City_corporations') ?></th>
                                    <td><?php echo $applications['city_corporation']['citycorporationname']; ?></td>
                                </tr>
                            <?php endif ?>
                            <?php if ($applications['area_upazila']): ?>
                                <tr>
                                    <th><?= __('Upazilas') ?></th>
                                    <td><?php echo $applications['area_upazila']['upazilaname']; ?></td>
                                </tr>
                            <?php endif ?>
                            <?php if ($applications['union']): ?>
                                <tr>
                                    <th><?= __('Unions') ?></th>
                                    <td><?php echo $applications['union']['unionname']; ?></td>
                                </tr>
                            <?php endif ?>
                            <tr>
                                <th><?= __('Applicant Type') ?></th>
                                <td><?php echo $applications['applicant_type']['title_bn']; ?></td>
                            </tr>


                            </tbody>
                        </table>
                        <table class="table table-bordered table-responsive">
                            <tbody>
                            <tr style="background-color: #d0c7cf">
                                <th colspan="2"><?= __('Profile_Setup') ?></th>
                            </tr>
                            <tr>
                                <th><?= __('Applicant_name_bn') ?></th>
                                <td><?php echo $applications['applicant_name_bn']; ?></td>
                            </tr>
                            <?php if ($applications['applicant_name_en']): ?>
                                <tr>
                                    <th><?= __('Applicant_name_en') ?></th>
                                    <td><?php echo $applications['applicant_name_en']; ?></td>
                                </tr>
                            <?php endif; ?>
                            <tr>
                                <th><?= __('Mother_name_bn') ?></th>
                                <td><?php echo $applications['mother_name_bn']; ?></td>
                            </tr>
                            <?php if ($applications['mother_name_en']): ?>
                                <tr>
                                    <th><?= __('Mother_name_en') ?></th>
                                    <td><?php echo $applications['mother_name_en']; ?></td>
                                </tr>
                            <?php endif; ?>

                            <tr>
                                <th><?= __('Father_name_bn') ?></th>
                                <td><?php echo $applications['father_name_bn']; ?></td>
                            </tr>
                            <?php if ($applications['father_name_en']): ?>
                                <tr>
                                    <th><?= __('Father_name_en') ?></th>
                                    <td><?php echo $applications['father_name_en']; ?></td>
                                </tr>
                            <?php endif; ?>

                            <tr>
                                <th><?= __('Phone') ?></th>
                                <td><?php echo $applications['phone']; ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Email') ?></th>
                                <td><?php echo $applications['email']; ?></td>
                            </tr>
                            <?php if ($applications['cellphone']): ?>
                                <tr>
                                    <th><?= __('Cellphone') ?></th>
                                    <td><?php echo $applications['cellphone']; ?></td>
                                </tr>
                            <?php endif; ?>

                            <?php if ($applications['nid']): ?>
                                <tr>
                                    <th><?= __('Nid') ?></th>
                                    <td><?php echo $applications['nid']; ?></td>
                                </tr>
                            <?php endif; ?>

                            <?php if ($applications['religion']): ?>
                                <tr>
                                    <th><?= __('Religion') ?></th>
                                    <td><?php echo $religions[$applications['religion']]; ?></td>
                                </tr>
                            <?php endif ?>
                            <?php if ($applications['present_address']): ?>
                                <tr>
                                    <th><?= __('Present_address') ?></th>
                                    <td><?php echo $applications['present_address']; ?></td>
                                </tr>
                            <?php endif; ?>

                            <?php if ($applications['permanent_address']): ?>
                                <tr>
                                    <th><?= __('Permanent_address') ?></th>
                                    <td><?php echo $applications['permanent_address']; ?></td>
                                </tr>
                            <?php endif; ?>

                            <?php if ($applications['emergency_contact']): ?>
                                <tr>
                                    <th><?= __('Emergency_contact') ?></th>
                                    <td><?php echo $applications['emergency_contact']; ?></td>
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
                                <td><?php echo $applications['application_type']['title_bn']; ?></td>
                            </tr>
                            <tr>
                                <th><?= __('is_foregin_tour') ?></th>
                                <td><?php echo $applications['is_foregin_tour'] ? 'হঁ্যা' : 'না'; ?></td>
                            </tr>
                            <?php if ($applications['is_foregin_tour']): ?>
                                <tr>
                                    <th><?= __('pasport_number') ?></th>
                                    <td><?php echo $applications['pasport_number']; ?></td>
                                </tr>
                                <tr>
                                    <th><?= __('applicant_using_passport_validity') ?></th>
                                    <td><?php echo $applications['applicant_using_passport_validity'] ? date('d-m-Y', $applications['applicant_using_passport_validity']) : ''; ?></td>
                                </tr>
                                <tr>
                                    <th><?= __('using_passport_issue_place') ?></th>
                                    <td><?php echo $applications['using_passport_issue_place']; ?></td>
                                </tr>
                            <?php endif; ?>
                            <tr>
                                <th><?= __('have_foregin_tour') ?></th>
                                <td><?php echo $applications['have_foregin_tour'] ? 'হঁ্যা' : 'না'; ?></td>
                            </tr>
                            <?php if ($applications['have_foregin_tour']): ?>
                                <tr>
                                    <th><?= __('last_foreign_tour_country') ?></th>
                                    <td><?php echo $applications['last_foreign_tour_country']; ?></td>
                                </tr>
                                <tr>
                                    <th><?= __('last_foreign_tour_reason') ?></th>
                                    <td><?php echo $applications['last_foreign_tour_reason']; ?></td>
                                </tr>
                                <tr>
                                    <th><?= __('last_foreign_tour_time') ?></th>
                                    <td><?php echo $applications['last_foreign_tour_time'] ? date('d-m-Y', $applications['last_foreign_tour_time']) : ''; ?></td>
                                </tr>
                            <?php endif; ?>
                            <tr>
                                <th><?= __('Application_reason') ?></th>
                                <td><?php echo $applications['application_reason']; ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Start Date') ?></th>
                                <td><?php echo $applications['start_date'] ? date('d-m-Y', $applications['start_date']) : ''; ?></td>
                            </tr>
                            <tr>
                                <th><?= __('End date') ?></th>
                                <td><?php echo $applications['end_date'] ? date('d-m-Y', $applications['end_date']) : ''; ?></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-4 col-md-offset-0">
                        <h3><?= __('Applications File') ?></h3>
                        <?php
                        if (count($applications['applications_files'])):
                            foreach ($applications['applications_files'] as $key => $file):
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
                        <a href="<?= $this->Url->build(('/CitizenCorner/pdf_view/' . $applications['id']), true) ?>"
                           target="_blank" class="btn green-haze btn-circle btn-sm todo-projects-config">
                            <i class="fa fa-file-pdf-o"></i> PDF
                        </a>
                        <a href="<?= $this->Url->build(('/CitizenCorner/pdfViewApplication/' . $applications['id']), true) ?>"
                           target="_blank" class="btn green-haze btn-circle btn-sm todo-projects-config">
                            <i class="fa fa-file-pdf-o"></i> PDF_APPLICATION
                        </a>
                    </div>

                </div>

            </div>
        </div>
        <!-- END BORDERED TABLE PORTLET-->
    </div>
</div>

