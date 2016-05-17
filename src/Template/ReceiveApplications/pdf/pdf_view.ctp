<?php
use Cake\Core\Configure;
$status = array_flip(Configure::read('application_status'));
$religions = Configure::read('religions');
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
        <tr style="background-color: #d0c7cf"><th colspan="2"><?=__('Account Setup')?></th></tr>
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
        <tr><th><?= __('Applicant Type') ?></th><td><?php echo $application['applicant_type']['title_bn']; ?></td></tr>
        </tbody>
    </table>
    <table class="table table-bordered table-responsive">
        <tbody>
        <tr style="background-color: #d0c7cf"><th colspan="2"><?=__('Profile_Setup')?></th></tr>
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
        <tr><th><?= __('Religion') ?></th><td><?php echo $application['religion']?  $religions[$application['religion']]: ""; ?></td></tr>
        <tr><th><?= __('Present_address') ?></th><td><?php echo $application['present_address']; ?></td></tr>
        <tr><th><?= __('Permanent_address') ?></th><td><?php echo $application['permanent_address']; ?></td></tr>
        <tr><th><?= __('Emergency_contact') ?></th><td><?php echo $application['emergency_contact']; ?></td></tr>
        </tbody>
    </table>

    <table class="table table-bordered table-responsive">
        <tbody>
        <tr style="background-color: #d0c7cf"><th colspan="2"><?=__('Billing_Setup')?></th></tr>

        <tr><th><?= __('ApplicationTypes') ?></th><td><?php echo $application['application_type']['title_bn']; ?></td></tr>
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
        </tbody>
    </table>
</div>