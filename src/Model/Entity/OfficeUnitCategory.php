<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * OfficeUnitCategory Entity.
 *
 * @property int $id
 * @property string $name_bn
 * @property string $name_en
 * @property int $status
 * @property int $created_by
 * @property int $update_by
 * @property int $create_time
 * @property int $update_time
 * @property \App\Model\Entity\OfficeUnit[] $office_units
 */
class OfficeUnitCategory extends Entity
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
