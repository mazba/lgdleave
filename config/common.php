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
        'office_user' => 3
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
        1=>'Islam',
        2=>'Hindu',
        3=>'Buddhist',
        4=>'Christian',
    ],

    'status_options' => [
        1 => 'Active',
        2 => 'In-Active'
    ],
    'application_status'=>[
        'Pending'=>0,
        'Approve'=>1,
        'Reject'=>2
    ]
];