<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CityCorporationWard Entity.
 *
 * @property int $rowid
 * @property string $citycorporationwardid
 * @property string $divid
 * @property string $zillaid
 * @property string $citycorporationid
 * @property string $upazilaid
 * @property string $wardname
 * @property string $wardnameeng
 * @property int $visible
 * @property string $ver_code
 * @property \App\Model\Entity\Application[] $applications
 */
class CityCorporationWard extends Entity
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
