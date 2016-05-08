<?php
use Cake\Core\Configure;
$status = array_flip(Configure::read('application_status'));
$religions = Configure::read('religions');
?>
<div class="col-md-6 col-md-offset-3">
    <h1 style="text-align: center;margin-bottom: 5px;padding-bottom: 5px"><?= 'LOCAL GOVERNMENT DIVISION' ?></h1>
    <h3 style="text-align: center;margin-top: 5px;padding-top: 5px"><?= 'Application' ?></h3>
    <hr style="border-color:#1adbd1"/>
    <table class="table table-responsive table-bordered" style="margin-left: 200px!important;">
        <tbody style="text-align: left;">
        <tr><th><?= 'Division' ?></th><td><?php echo $application['area_division']['divname']; ?></td></tr>
        <?php if($application['area_district']): ?>
            <tr><th><?= 'District' ?></th><td><?php echo $application['area_district']['zillaname']; ?></td></tr>
        <?php endif ?>
        <?php if($application['municipal']): ?>
            <tr><th><?= 'Municipal' ?></th><td><?php echo $application['municipal']['municipalname']; ?></td></tr>
        <?php endif ?>
        <?php if($application['city_corporation']): ?>
            <tr><th><?= 'City Corporations' ?></th><td><?php echo $application['city_corporation']['citycorporationname']; ?></td></tr>
        <?php endif ?>
        <?php if($application['area_upazila']): ?>
            <tr><th><?= 'Upazila' ?></th><td><?php echo $application['area_upazila']['upazilaname']; ?></td></tr>
        <?php endif ?>
        <?php if($application['union']): ?>
            <tr><th><?= 'Unions' ?></th><td><?php echo $application['union']['unionname']; ?></td></tr>
        <?php endif ?>

        <tr><th><?= 'Location Type' ?></th><td><?php echo $application['location_type']['title_en']; ?></td></tr>
        <tr><th><?= 'Applicant Type' ?></th><td><?php echo $application['applicant_type']['title_en']; ?></td></tr>
        <tr><th><?= 'Application ID' ?></th><td><?php echo $application['temporary_id']; ?></td></tr>
        <tr><th><?= 'Application Type' ?></th><td><?php echo $application['application_type']['title_en']; ?></td></tr>
        <tr><th><?= 'Applicant Name (bn)' ?></th><td><?php echo $application['applicant_name_en']; ?></td></tr>
        <tr><th><?= 'Applicant Name (en)' ?></th><td><?php echo $application['applicant_name_en']; ?></td></tr>
        <tr><th><?= 'Mother Name (bn)' ?></th><td><?php echo $application['mother_name_en']; ?></td></tr>
        <tr><th><?= 'Mother Name (en)' ?></th><td><?php echo $application['mother_name_en']; ?></td></tr>
        <tr><th><?= 'Father Name (bn)' ?></th><td><?php echo $application['father_name_en']; ?></td></tr>
        <tr><th><?= 'Father Name (ens)' ?></th><td><?php echo $application['father_name_en']; ?></td></tr>
        <tr><th><?= 'Phone' ?></th><td><?php echo $application['phone']; ?></td></tr>
        <tr><th><?= 'Email' ?></th><td><?php echo $application['email']; ?></td></tr>
        <tr><th><?= 'Cellphone' ?></th><td><?php echo $application['cellphone']; ?></td></tr>
        <tr><th><?= 'Nid' ?></th><td><?php echo $application['nid']; ?></td></tr>
        <tr><th><?= 'Brn' ?></th><td><?php echo $application['brn']; ?></td></tr>
        <tr><th><?= 'Religion' ?></th><td><?php echo $religions[$application['religion']]; ?></td></tr>
        <tr><th><?= 'Present Address' ?></th><td><?php echo $application['present_address']; ?></td></tr>
        <tr><th><?= 'Permanent Address' ?></th><td><?php echo $application['permanent_address']; ?></td></tr>
        <tr><th><?= 'Emergency Contact' ?></th><td><?php echo $application['emergency_contact']; ?></td></tr>
        <tr><th><?= 'Is Foregin Tour' ?></th><td><?php echo $application['is_foregin_tour']?'yes' : 'no'; ?></td></tr>
        <?php if($application['is_foregin_tour']): ?>
            <tr><th><?= 'Pasport Number' ?></th><td><?php echo $application['pasport_number']; ?></td></tr>
            <tr><th><?= 'Applicant Using Passport Validity' ?></th><td><?php echo $application['applicant_using_passport_validity'] ? date('d-m-Y',$application['applicant_using_passport_validity']):''; ?></td></tr>
            <tr><th><?= 'Passport Issue Place' ?></th><td><?php echo $application['using_passport_issue_place']; ?></td></tr>
        <?php endif; ?>
        <tr><th><?= 'Have Foregin Tour' ?></th><td><?php echo $application['have_foregin_tour']?'হঁ্যা' : 'না'; ?></td></tr>
        <?php if($application['have_foregin_tour']): ?>
            <tr><th><?= 'Last Foreign Tour Country' ?></th><td><?php echo $application['last_foreign_tour_country']; ?></td></tr>
            <tr><th><?= 'Last Foreign Tour Reason' ?></th><td><?php echo $application['last_foreign_tour_reason']; ?></td></tr>
            <tr><th><?= 'Last Foreign Tour Time' ?></th><td><?php echo $application['last_foreign_tour_time']?date('d-m-Y',$application['last_foreign_tour_time']):''; ?></td></tr>
        <?php endif; ?>
        <tr><th><?= 'Application Reason' ?></th><td><?php echo $application['application_reason']; ?></td></tr>
        <tr><th><?= 'Start Date' ?></th><td><?php echo $application['start_date'] ? date('d-m-Y',$application['start_date']):''; ?></td></tr>
        <tr><th><?= 'End date' ?></th><td><?php echo $application['end_date'] ? date('d-m-Y',$application['end_date']):''; ?></td></tr>
        <tr><th><?= 'Application Create Time' ?></th><td><?php echo $application['create_time'] ? date('d-m-Y H:m:i',$application['create_time']):''; ?></td></tr>
        </tbody>
    </table>
</div>