<?php
/**
 * Abstraction for all models.
 * User: eboch
 * Date: 9/10/2017
 * Time: 10:50 PM
 */

namespace itbox\Models;

use skillup\Core\Db;

abstract class AbstractModel
{
    protected $db;

    public function __construct() {
        $this->db = Db::getInstance();
    }
}