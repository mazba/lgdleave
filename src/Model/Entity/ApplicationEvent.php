<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ApplicationEvent Entity.
 *
 * @property int $id
 * @property int $application_id
 * @property \App\Model\Entity\Application $application
 * @property string $comment
 * @property int $recipient_id
 * @property int $status
 * @property int $create_time
 * @property int $create_by
 * @property int $update_by
 * @property int $update_time
 */
class ApplicationEvent extends Entity
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
