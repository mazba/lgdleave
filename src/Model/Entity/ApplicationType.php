<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ApplicationType Entity.
 *
 * @property int $id
 * @property int $parent_id
 * @property \App\Model\Entity\ParentApplicationType $parent_application_type
 * @property string $title_bn
 * @property string $title_en
 * @property string $description
 * @property bool $status
 * @property int $create_time
 * @property int $update_time
 * @property int $create_by
 * @property int $update_by
 * @property \App\Model\Entity\ChildApplicationType[] $child_application_types
 * @property \App\Model\Entity\Application[] $applications
 * @property \App\Model\Entity\ApplicationsCopy[] $applications_copy
 */
class ApplicationType extends Entity
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
