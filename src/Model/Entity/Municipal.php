<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Municipal Entity.
 *
 * @property int $rowid
 * @property string $municipalid
 * @property string $zillaid
 * @property string $upazilaid
 * @property string $municipalname
 * @property string $municipaleng
 * @property int $visible
 * @property string $ver_code
 */
class Municipal extends Entity
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
