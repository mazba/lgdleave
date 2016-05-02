<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CityCorporation Entity.
 *
 * @property int $rowid
 * @property string $citycorporationid
 * @property string $upazilaid
 * @property string $zillaid
 * @property string $citycorporationname
 * @property string $citycorporationnameeng
 * @property int $visible
 * @property int $divid
 * @property \App\Model\Entity\Application[] $applications
 */
class CityCorporation extends Entity
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
        'rowid' => false,
    ];
}
