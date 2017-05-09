<?php
/**
 * Created by PhpStorm.
 * User: Mazba
 * Date: 2/28/2016
 * Time: 11:27 AM
 */
return [
    'user_group' => [
        'super_admin' => 1,
        'office_admin' => 2,
        'office_user' => 3,
        'applicant_user' => 4,
        'deactivate_applicant_user' => 5
    ],
    'blood_groups'=>[
        'A+'=>'A+','A-'=>'A-','B+'=>'B+','B-'=>'B-','AB+'=>'AB+','AB-'=>'AB-','O+'=>'O+','O-'=>'O-'
    ],
    'languages'=>[
        'bangla'=>'Bangla','english'=>'English','hindi'=>'Hindi','arabic'=>'Arabic','portuguese'=>'Portuguese','russian'=>'Russian','chinese'=>'Chinese','spanish'=>'Spanish'
    ],
    'genders'=>[
        1=>'Male',
        2=>'Female'
    ],
    'religions'=>[
        1=>'ইসলাম',
        2=>'হিন্দু',
        3=>'বৌদ্ধ',
        4=>'খ্রীষ্টান',
    ],

    'status_options' => [
        1 => 'Active',
        2 => 'In-Active'
    ],
    'application_status'=>[
        'Pending'=>0,
        'Approve'=>1,
        'Reject'=>2,
        'On Process'=>3
    ],

    'application_event_status'=>[
        'Forward'=>0,
        'Backward'=>1
    ],
    'user_status'=>[
        1=>'Active',
        99=>'Deactivate'
    ],
    'applicant_status'=>[
        1=>'Active',
        99=>'Deactivate'
    ]
];