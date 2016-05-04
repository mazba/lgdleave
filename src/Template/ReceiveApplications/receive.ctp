<?php
use Cake\Core\Configure;
$status = array_flip(Configure::read('application_status'));
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
                    <?= $this->Html->link(__('Back'), ['action' => 'index'],['class'=>'btn btn-sm btn-success']) ?>
                </div>
            </div>
            <div class="portlet-body">
                <?= $this->Form->create(null,['class'=>'form-horizontal']) ?>
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-responsive">
                            <tbody>
                                <tr><th><?= __('Divisions') ?></th><td><?php echo $application['area_division']['divname']; ?></td></tr>
                                <?php if($application['area_district']): ?>
                                    <tr><th><?= __('Districts') ?></th><td><?php echo $application['area_district']['zillaname']; ?></td></tr>
                                <?php endif ?>
                                <?php if($application['municipal']): ?>
                                    <tr><th><?= __('Municipal') ?></th><td><?php echo $application['municipal']['municipalname']; ?></td></tr>
                                <?php endif ?>
                                <?php if($application['city_corporation']): ?>
                                    <tr><th><?= __('City_corporations') ?></th><td><?php echo $application['city_corporation']['citycorporationname']; ?></td></tr>
                                <?php endif ?>
                                <?php if($application['area_upazila']): ?>
                                    <tr><th><?= __('Upazilas') ?></th><td><?php echo $application['area_upazila']['upazilaname']; ?></td></tr>
                                <?php endif ?>
                                <?php if($application['union']): ?>
                                    <tr><th><?= __('Unions') ?></th><td><?php echo $application['union']['unionname']; ?></td></tr>
                                <?php endif ?>

                                <tr><th><?= __('Location Type') ?></th><td><?php echo $application['location_type']['title_bn']; ?></td></tr>
                                <tr><th><?= __('Applicant Type') ?></th><td><?php echo $application['applicant_type']['title_bn']; ?></td></tr>
                                <tr><th><?= __('Application ID') ?></th><td><?php echo $application['temporary_id']; ?></td></tr>
                                <tr><th><?= __('ApplicationTypes') ?></th><td><?php echo $application['application_type']['title_bn']; ?></td></tr>
                                <tr><th><?= __('Applicant_name_bn') ?></th><td><?php echo $application['applicant_name_bn']; ?></td></tr>
                                <tr><th><?= __('Applicant_name_en') ?></th><td><?php echo $application['applicant_name_bn']; ?></td></tr>
                                <tr><th><?= __('Mother_name_bn') ?></th><td><?php echo $application['mother_name_bn']; ?></td></tr>
                                <tr><th><?= __('Mother_name_en') ?></th><td><?php echo $application['mother_name_en']; ?></td></tr>
                                <tr><th><?= __('Father_name_bn') ?></th><td><?php echo $application['father_name_bn']; ?></td></tr>
                                <tr><th><?= __('Father_name_en') ?></th><td><?php echo $application['father_name_en']; ?></td></tr>
                                <tr><th><?= __('Phone') ?></th><td><?php echo $application['phone']; ?></td></tr>
                                <tr><th><?= __('Email') ?></th><td><?php echo $application['email']; ?></td></tr>
                                <tr><th><?= __('Cellphone') ?></th><td><?php echo $application['cellphone']; ?></td></tr>
                                <tr><th><?= __('Nid') ?></th><td><?php echo $application['nid']; ?></td></tr>
                                <tr><th><?= __('Brn') ?></th><td><?php echo $application['brn']; ?></td></tr>
                                <tr><th><?= __('Religion') ?></th><td><?php echo $religions[$application['religion']]; ?></td></tr>
                                <tr><th><?= __('Present_address') ?></th><td><?php echo $application['present_address']; ?></td></tr>
                                <tr><th><?= __('Permanent_address') ?></th><td><?php echo $application['permanent_address']; ?></td></tr>
                                <tr><th><?= __('Emergency_contact') ?></th><td><?php echo $application['emergency_contact']; ?></td></tr>
                                <tr><th><?= __('is_foregin_tour') ?></th><td><?php echo $application['is_foregin_tour']?'হঁ্যা' : 'না'; ?></td></tr>
                                <?php if($application['is_foregin_tour']): ?>
                                <tr><th><?= __('pasport_number') ?></th><td><?php echo $application['pasport_number']; ?></td></tr>
                                <tr><th><?= __('applicant_using_passport_validity') ?></th><td><?php echo $application['applicant_using_passport_validity'] ? date('d-m-Y',$application['applicant_using_passport_validity']):''; ?></td></tr>
                                <tr><th><?= __('using_passport_issue_place') ?></th><td><?php echo $application['using_passport_issue_place']; ?></td></tr>
                                <?php endif; ?>
                                <tr><th><?= __('have_foregin_tour') ?></th><td><?php echo $application['have_foregin_tour']?'হঁ্যা' : 'না'; ?></td></tr>
                                <?php if($application['have_foregin_tour']): ?>
                                    <tr><th><?= __('last_foreign_tour_country') ?></th><td><?php echo $application['last_foreign_tour_country']; ?></td></tr>
                                    <tr><th><?= __('last_foreign_tour_reason') ?></th><td><?php echo $application['last_foreign_tour_reason']; ?></td></tr>
                                    <tr><th><?= __('last_foreign_tour_time') ?></th><td><?php echo $application['last_foreign_tour_time']?date('d-m-Y',$application['last_foreign_tour_time']):''; ?></td></tr>
                                <?php endif; ?>
                                <tr><th><?= __('Application_reason') ?></th><td><?php echo $application['application_reason']; ?></td></tr>
                                <tr><th><?= __('Start Date') ?></th><td><?php echo $application['start_date'] ? date('d-m-Y',$application['start_date']):''; ?></td></tr>
                                <tr><th><?= __('End date') ?></th><td><?php echo $application['end_date'] ? date('d-m-Y',$application['end_date']):''; ?></td></tr>
                                <tr><th><?= __('Application Create Time') ?></th><td><?php echo $application['create_time'] ? date('d-m-Y H:m:i',$application['create_time']):''; ?></td></tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h3><?= __('Applications File') ?></h3>
                        <?php
                        if(count($application['applications_files'])):
                            foreach($application['applications_files'] as $key=>$file):
                            ?>
                                <a href="<?php echo $this->request->webroot.$file['file']; ?>" class="btn green-haze btn-circle btn-sm todo-projects-config">
                                    <i class="fa fa-file-word-o"></i> File <?= $key+1 ?>
                                </a>
                            <?php
                            endforeach;
                        endif
                        ?>
                    </div>
                    <div class="col-md-6">
                        <h3><?= __('To View Pdf') ?></h3>
                        <a href="<?=$this->Url->build(('/ReceiveApplications/pdf_view/'.$application['id']), true)?>" target="_blank" class="btn green-haze btn-circle btn-sm todo-projects-config">
                            <i class="fa fa-file-pdf-o"></i> PDF
                        </a>
                    </div>
                    <div class="col-md-6 col-md-offset-3" style="margin-top: 50px">
                        <?php
                        echo $this->Form->input('status', ['label'=>__('Action'),'options' => $status]);
                        ?>
                        <?= $this->Form->button(__('Submit'),['class'=>'btn blue pull-right','style'=>'margin-top:20px']) ?>
                    </div>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
        <!-- END BORDERED TABLE PORTLET-->
    </div>
</div>