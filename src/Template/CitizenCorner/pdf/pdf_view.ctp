<?php
use Cake\Core\Configure;
$status = array_flip(Configure::read('application_status'));
$religions = \Cake\Core\Configure::read('religions');
?>
<style>
    table {
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
        border: 1px solid #ddd;
    }
    th{
        text-align: left;
        border: 1px solid #ddd;
        width: 40%;
        padding: 10px !important;
    }
    td{
        text-align: left;
        border: 1px solid #ddd;
        width: 60%;
        padding: 10px !important;
    }
    .table {
        margin-bottom: 30px;
        max-width: 100%;
        width: 100%;
    }
</style>
<div class="col-md-6 col-md-offset-3">
    <h1 style="text-align: center;margin-bottom: 5px;padding-bottom: 5px"><?= 'LOCAL GOVERNMENT DIVISION' ?></h1>
    <h3 style="text-align: center;margin-top: 5px;padding-top: 5px"><?= 'Application' ?></h3>
    <hr style="border-color:#1adbd1"/>
    <br/>

    <table class="table table-bordered table-responsive">
        <tbody>
        <tr style="background-color: #d0c7cf"><th colspan="2"><?=__('Profile_Setup')?></th></tr>
        <tr><th><?= __('Applicant_name_bn') ?></th><td><?php echo $applications['applicant_name_bn']; ?></td></tr>
        <tr><th><?= __('Applicant_name_en') ?></th><td><?php echo $applications['applicant_name_bn']; ?></td></tr>
        <tr><th><?= __('Mother_name_bn') ?></th><td><?php echo $applications['mother_name_bn']; ?></td></tr>
        <tr><th><?= __('Mother_name_en') ?></th><td><?php echo $applications['mother_name_en']; ?></td></tr>
        <tr><th><?= __('Father_name_bn') ?></th><td><?php echo $applications['father_name_bn']; ?></td></tr>
        <tr><th><?= __('Father_name_en') ?></th><td><?php echo $applications['father_name_en']; ?></td></tr>
        <tr><th><?= __('Phone') ?></th><td><?php echo $applications['phone']; ?></td></tr>
        <tr><th><?= __('Email') ?></th><td><?php echo $applications['email']; ?></td></tr>
        <tr><th><?= __('Cellphone') ?></th><td><?php echo $applications['cellphone']; ?></td></tr>
        <tr><th><?= __('Nid') ?></th><td><?php echo $applications['nid']; ?></td></tr>
        <?php if( $applications['religion']):?>
        <tr><th><?= __('Religion') ?></th><td><?php echo $religions[$applications['religion']]; ?></td></tr>
        <?php endif ?>
        <tr><th><?= __('Present_address') ?></th><td><?php echo $applications['present_address']; ?></td></tr>
        <tr><th><?= __('Permanent_address') ?></th><td><?php echo $applications['permanent_address']; ?></td></tr>
        <tr><th><?= __('Emergency_contact') ?></th><td><?php echo $applications['emergency_contact']; ?></td></tr>
        </tbody>
    </table>

    <table class="table table-bordered table-responsive">
        <tbody>
        <tr style="background-color: #d0c7cf"><th colspan="2"><?=__('Billing_Setup')?></th></tr>

        <tr><th><?= __('ApplicationTypes') ?></th><td><?php echo $applications['application_type']['title_bn']; ?></td></tr>
        <tr><th><?= __('is_foregin_tour') ?></th><td><?php echo $applications['is_foregin_tour']?'হঁ্যা' : 'না'; ?></td></tr>
        <?php if($applications['is_foregin_tour']): ?>
            <tr><th><?= __('pasport_number') ?></th><td><?php echo $applications['pasport_number']; ?></td></tr>
            <tr><th><?= __('applicant_using_passport_validity') ?></th><td><?php echo $applications['applicant_using_passport_validity'] ? date('d-m-Y',$applications['applicant_using_passport_validity']):''; ?></td></tr>
            <tr><th><?= __('using_passport_issue_place') ?></th><td><?php echo $applications['using_passport_issue_place']; ?></td></tr>
        <?php endif; ?>
        <tr><th><?= __('have_foregin_tour') ?></th><td><?php echo $applications['have_foregin_tour']?'হঁ্যা' : 'না'; ?></td></tr>
        <?php if($applications['have_foregin_tour']): ?>
            <tr><th><?= __('last_foreign_tour_country') ?></th><td><?php echo $applications['last_foreign_tour_country']; ?></td></tr>
            <tr><th><?= __('last_foreign_tour_reason') ?></th><td><?php echo $applications['last_foreign_tour_reason']; ?></td></tr>
            <tr><th><?= __('last_foreign_tour_time') ?></th><td><?php echo $applications['last_foreign_tour_time']?date('d-m-Y',$applications['last_foreign_tour_time']):''; ?></td></tr>
        <?php endif; ?>
        <tr><th><?= __('Application_reason') ?></th><td><?php echo $applications['application_reason']; ?></td></tr>
        <tr><th><?= __('Start Date') ?></th><td><?php echo $applications['start_date'] ? date('d-m-Y',$applications['start_date']):''; ?></td></tr>
        <tr><th><?= __('End date') ?></th><td><?php echo $applications['end_date'] ? date('d-m-Y',$applications['end_date']):''; ?></td></tr>
        </tbody>
    </table>
</div>