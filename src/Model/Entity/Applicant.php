<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Applicant Entity.
 *
 * @property int $id
 * @property int $user_id
 * @property \App\Model\Entity\User $user
 * @property int $applicant_type_id
 * @property \App\Model\Entity\ApplicantType $applicant_type
 * @property int $location_type_id
 * @property \App\Model\Entity\LocationType $location_type
 * @property string $division_id
 * @property \App\Model\Entity\Division $division
 * @property string $district_id
 * @property \App\Model\Entity\District $district
 * @property string $upazila_id
 * @property \App\Model\Entity\Upazila $upazila
 * @property string $union_id
 * @property \App\Model\Entity\Union $union
 * @property string $union_ward
 * @property string $city_corporation_id
 * @property \App\Model\Entity\CityCorporation $city_corporation
 * @property string $city_corporation_ward_id
 * @property \App\Model\Entity\CityCorporationWard $city_corporation_ward
 * @property string $municipal_id
 * @property \App\Model\Entity\Municipal $municipal
 * @property string $municipal_ward_id
 * @property \App\Model\Entity\MunicipalWard $municipal_ward
 * @property int $status
 * @property int $create_time
 * @property int $update_time
 * @property int $create_by
 * @property int $update_by
 * @property \App\Model\Entity\Application[] $applications
 * @property \App\Model\Entity\ApplicationsOldAntu[] $applications_old_antu
 */
class Applicant extends Entity
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
    ];
}
