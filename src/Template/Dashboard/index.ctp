<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <i class="fa fa-home"></i>
            <a href="#"><?= __('Dashboard') ?></a>
            <i class="fa fa-angle-right"></i>
        </li>
    </ul>
</div>
<?php
$user_group = \Cake\Core\Configure::read('user_group');
$session = $this->request->session();
$user_group_id = $session->read('Auth.User.user_group_id');
if($user_group_id==$user_group['super_admin'] )
    echo $this->cell('Dashboard::superAdmin');
elseif ($user_group_id==$user_group['office_admin'] || $user_group_id==$user_group['office_user'])
    echo $this->cell('Dashboard::OfficeAdmin');
elseif ($user_group_id==$user_group['applicant_user'])
    echo $this->cell('Dashboard::ApplicantUser');
elseif ($user_group_id==$user_group['deactivate_applicant_user'])
    echo $this->cell('Dashboard::ApplicantUser');
//else
//    echo $this->cell('Dashboard::OfficeAdmin');
?>