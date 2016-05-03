<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * LocationType Entity.
 *
 * @property int $id
 * @property string $title_bn
 * @property string $title_en
 * @property string $code_format
 * @property string $description
 * @property int $status
 * @property int $create_time
 * @property int $update_time
 * @property int $create_by
 * @property int $update_by
 * @property \App\Model\Entity\Application[] $applications
 * @property \App\Model\Entity\ApplicationsCopy[] $applications_copy
 */
class LocationType extends Entity
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
