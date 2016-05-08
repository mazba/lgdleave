<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserDesignation Entity.
 *
 * @property int $id
 * @property int $user_id
 * @property \App\Model\Entity\User $user
 * @property int $office_id
 * @property \App\Model\Entity\Office $office
 * @property int $office_unit_id
 * @property \App\Model\Entity\OfficeUnit $office_unit
 * @property int $is_basic
 * @property int $designation_id
 * @property \App\Model\Entity\Designation $designation
 * @property int $designation_order
 * @property int $starting_date
 * @property int $ending_date
 * @property int $status
 * @property int $create_time
 * @property int $update_time
 * @property int $create_by
 * @property int $update_by
 */
class UserDesignation extends Entity
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

//    protected function _setStartingDate($starting_date)
//    {
//        return $starting_date?strtotime($starting_date):0;
//    }
//
//    protected function _setEndingDate($ending_date)
//    {
//        return $ending_date?strtotime($ending_date):0;
//    }
}
