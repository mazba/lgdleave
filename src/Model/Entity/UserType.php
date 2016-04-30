<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserType Entity.
 */
class UserType extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
