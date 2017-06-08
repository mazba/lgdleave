<?php
use Cake\Core\Configure;

$status = array_flip(Configure::read('application_event_status'));
foreach ($status as &$value) {
    $value = __($value);
}
$religions = Configure::read('religions');
?>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN BORDERED TABLE PORTLET-->
        <div class="portlet box blue-hoki">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-coffee"></i><?= __('Receive Application') ?>
                </div>
                <div class="tools">
                    <?= $this->Html->link(__('Back'), ['action' => 'index'], ['class' => 'btn btn-sm btn-success']) ?>
                </div>
            </div>
            <div class="portlet-body">
                <?= $this->Form->create(null, ['class' => 'form-horizontal']) ?>
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <table class="table table-bordered table-responsive">
                            <tbody>
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
                                <th><?= __('Location Type') ?></th>
                                <td><?php echo $applications['location_type']['title_bn']; ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Applicant Type') ?></th>
                                <td><?php echo $applications['applicant_type']['title_bn']; ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Application ID') ?></th>
                                <td><?php echo $applications['temporary_id']; ?></td>
                            </tr>
                            <tr>
                                <th><?= __('ApplicationTypes') ?></th>
                                <td><?php echo $applications['application_type']['title_bn']; ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Applicant_name_bn') ?></th>
                                <td><?php echo $applications['applicant_name_bn']; ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Applicant_name_en') ?></th>
                                <td><?php echo $applications['applicant_name_bn']; ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Mother_name_bn') ?></th>
                                <td><?php echo $applications['mother_name_bn']; ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Mother_name_en') ?></th>
                                <td><?php echo $applications['mother_name_en']; ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Father_name_bn') ?></th>
                                <td><?php echo $applications['father_name_bn']; ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Father_name_en') ?></th>
                                <td><?php echo $applications['father_name_en']; ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Phone') ?></th>
                                <td><?php echo $applications['phone']; ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Email') ?></th>
                                <td><?php echo $applications['email']; ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Cellphone') ?></th>
                                <td><?php echo $applications['cellphone']; ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Nid') ?></th>
                                <td><?php echo $applications['nid']; ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Religion') ?></th>
                                <td><?php echo $applications['religion'] ? $religions[$applications['religion']] : ""; ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Present_address') ?></th>
                                <td><?php echo $applications['present_address']; ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Permanent_address') ?></th>
                                <td><?php echo $applications['permanent_address']; ?></td>
                            </tr>
                            <tr>
                                <th><?= __('Emergency_contact') ?></th>
                                <td><?php echo $applications['emergency_contact']; ?></td>
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
                    <div class="col-md-6 col-md-offset-3">
                        <h3><?= __('Applications File') ?></h3>
                        <?php
                        if (count($applications['applications_files'])):
                            foreach ($applications['applications_files'] as $key => $file):
                                ?>
                                <a href="<?php echo $this->request->webroot . $file['file']; ?>" target="_blank"
                                   class="btn green-haze btn-circle btn-sm todo-projects-config">
                                    <i class="fa fa-file-word-o"></i> File <?= $key + 1 ?>
                                </a>
                                <?php
                            endforeach;
                        endif
                        ?>
                    </div>
                    <div class="col-md-6 col-md-offset-3">
                        <h3><?= __('To View Pdf') ?></h3>
                        <a href="<?= $this->Url->build(('/ReceiveApplications/pdf_view/' . $applications['id']), true) ?>"
                           target="_blank" class="btn green-haze btn-circle btn-sm todo-projects-config">
                            <i class="fa fa-file-pdf-o"></i> <?= __('Applicant_info') ?>
                        </a>
                        <a href="<?= $this->Url->build(('/ReceiveApplications/pdfViewApplication/' . $applications['id']), true) ?>"
                           target="_blank" class="btn green-haze btn-circle btn-sm todo-projects-config">
                            <i class="fa fa-file-pdf-o"></i> <?= __('Applicant_Application') ?>
                        </a>
                    </div>

                    <?php if(isset($application_events)):?>

                      <div class="col-md-12 ">
                          <br/><br/>
                          <table class="table table-bordered">
                              <thead>
                              <tr>
                                  <td>SL:</td>
                                  <td><?=__('Name_bn')?></td>
                                  <td><?=__('Designation')?></td>
                                  <td><?=__('Comment')?></td>
                                  <td><?=__('Approved Time')?></td>
                              </tr>
                              <?php foreach($application_events as $key=>$row):?>
                                  <?php $key+=1?>
                                  <tr>
                                      <td><?= $key?></td>
                                      <td><?= $row['full_name_bn']?></td>
                                      <td><?= $row['designations']?></td>
                                      <td><?= $row['comment']?></td>
                                      <td><?= date('d-M-Y',$row['create_time'])?></td>
                                  </tr>
                              <?php endforeach;?>
                              </thead>
                          </table>
                      </div>

                    <?php endif;?>


                    <div class="col-md-9 col-md-offset-1" style="margin-top: 50px">
                        <div class="form-group input select">
                            <label for="status" class="col-sm-3 control-label text-right">পদক্ষেপ</label>

                            <div id="container_status" class="col-sm-9">
                                <select name="status" id="status" class="form-control" required>

                                    <option value="">Select</option>
                                    <?php if (!$user_designation): ?>
                                        <option value="0">Forward</option> <?php endif; ?>
                                    <option value="1">Backward</option>
                                    <?php if ($user_designation): ?>
                                        <option value="3">Approve</option> <?php endif; ?>
                                </select>
                            </div>
                        </div>

                        <?php
                        echo $this->Form->input('comment', ['type' => 'textarea', 'required' => 'required']);
                        echo $this->Form->button(__('Submit'), ['class' => 'btn blue pull-right', 'style' => 'margin-top:20px'])
                        ?>
                    </div>
                </div>
                <?= $this->Form->end() ?>


            </div>
        </div>
        <!-- END BORDERED TABLE PORTLET-->
    </div>
</div>
<script>

    $(document).ready(function () {
        $('.datepicker').datepicker({
            dateFormat: 'dd-mm-yy'
        })
    })


</script>