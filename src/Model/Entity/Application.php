<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Application Entity.
 *
 * @property int $id
 * @property int $temporary_id
 * @property \App\Model\Entity\Temporary $temporary
 * @property int $application_type_id
 * @property \App\Model\Entity\ApplicationType $application_type
 * @property int $applicant_type_id
 * @property \App\Model\Entity\ApplicantType $applicant_type
 * @property int $submission_time
 * @property int $location_type_id
 * @property \App\Model\Entity\LocationType $location_type
 * @property int $divsion_id
 * @property int $district_id
 * @property int $upazila_id
 * @property int $city_corporation_id
 * @property int $city_corporation_ward_id
 * @property int $municipal_id
 * @property int $municipal_ward_id
 * @property string $applicant_name_bn
 * @property string $applicant_name_en
 * @property string $mother_name_bn
 * @property string $mother_name_en
 * @property string $father_name_bn
 * @property string $father_name_en
 * @property string $phone
 * @property string $email
 * @property string $cellphone
 * @property string $nid
 * @property string $brn
 * @property int $religion
 * @property string $present_address
 * @property string $permanent_address
 * @property string $emergency_contact
 * @property int $is_foregin_tour
 * @property string $pasport_number
 * @property int $applicant_using_passport_validity
 * @property string $using_passport_issue_place
 * @property string $foregin_tour_country
 * @property int $have_foregin_tour
 * @property string $last_foreign_tour_country
 * @property string $last_foreign_tour_reason
 * @property int $last_foreign_tour_time
 * @property string $application_reason
 * @property int $start_date
 * @property int $end_date
 * @property int $status
 * @property int $create_time
 * @property int $update_time
 * @property int $create_by
 * @property int $update_by
 */
class Application extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false,
        'temporary_id' => false,
    ];

//    protected function _setStartDate($start_date){
//        return strtotime($this->start_date) ? strtotime($this->start_date) : 0;
//    }
//
//    protected function _setEndDate($end_date){
//        return strtotime($end_date) ? strtotime($end_date) : 0;
//    }
//
//    protected function _setLastForeignTourTime($last_foreign_tour_time){
//        return strtotime($last_foreign_tour_time) ? strtotime($last_foreign_tour_time) : 0;
//    }
}
