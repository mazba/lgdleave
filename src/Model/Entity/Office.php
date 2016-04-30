<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Office Entity.
 *
 * @property int $id
 * @property int $parent_id
 * @property \App\Model\Entity\Office $parent_office
 * @property string $code
 * @property string $name_bn
 * @property string $name_en
 * @property string $short_name_bn
 * @property string $short_name_en
 * @property string $digital_nothi_code
 * @property string $reference_code
 * @property string $phone
 * @property string $mobile
 * @property string $fax
 * @property string $email
 * @property string $web_url
 * @property string $address
 * @property string $description
 * @property int $status
 * @property int $create_time
 * @property int $update_time
 * @property int $create_by
 * @property int $update_by
 * @property \App\Model\Entity\Designation[] $designations
 * @property \App\Model\Entity\OfficeUnitDesignation[] $office_unit_designations
 * @property \App\Model\Entity\OfficeUnit[] $office_units
 * @property \App\Model\Entity\Office[] $child_offices
 * @property \App\Model\Entity\UserDesignation[] $user_designations
 * @property \App\Model\Entity\User[] $users
 */
class Office extends Entity
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
