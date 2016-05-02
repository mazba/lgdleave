<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ApplicantType Entity.
 *
 * @property int $id
 * @property bool $type
 * @property int $order
 * @property string $title_bn
 * @property string $title_en
 * @property string $description
 * @property int $status
 * @property int $create_time
 * @property int $update_time
 * @property int $create_by
 * @property int $update_by
 * @property \App\Model\Entity\Application[] $applications
 */
class ApplicantType extends Entity
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
