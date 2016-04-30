<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * OfficeUnitDesignation Entity.
 *
 * @property int $id
 * @property int $parent_id
 * @property \App\Model\Entity\ParentOfficeUnitDesignation $parent_office_unit_designation
 * @property int $office_id
 * @property \App\Model\Entity\Office $office
 * @property int $office_unit_id
 * @property \App\Model\Entity\OfficeUnit $office_unit
 * @property string $name_en
 * @property string $name_bn
 * @property int $level_number
 * @property int $sequence_number
 * @property int $post_number
 * @property int $status
 * @property int $created_by
 * @property int $created_date
 * @property int $updated_by
 * @property int $updated_date
 * @property \App\Model\Entity\ChildOfficeUnitDesignation[] $child_office_unit_designations
 */
class OfficeUnitDesignation extends Entity
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
