<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ApplicantTypesOfficeUnit Entity.
 *
 * @property int $id
 * @property int $applicant_type_id
 * @property \App\Model\Entity\ApplicantType $applicant_type
 * @property int $office_unit_id
 * @property \App\Model\Entity\OfficeUnit $office_unit
 * @property int $status
 */
class ApplicantTypesOfficeUnit extends Entity
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
