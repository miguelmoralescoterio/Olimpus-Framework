<?php
declare(strict_types=1);
namespace Olimpuss\Models;
umask(0000);
/**
 * Model Class for Students
 */
use Olimpuss\Model;

class Students extends Model {
    protected $table = 'students';
    protected $primaryKey = 'student_id';
}
