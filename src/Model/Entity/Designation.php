<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Designation Entity.
 *
 * @property int $id
 * @property int $parent_id
 * @property \App\Model\Entity\ParentDesignation $parent_designation
 * @property int $office_id
 * @property \App\Model\Entity\Office $office
 * @property string $name_en
 * @property string $name_bn
 * @property int $level_number
 * @property int $sequence_number
 * @property int $post_number
 * @property int $status
 * @property int $create_by
 * @property int $create_date
 * @property int $update_by
 * @property int $update_date
 * @property \App\Model\Entity\ChildDesignation[] $child_designations
 */
class Designation extends Entity
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
