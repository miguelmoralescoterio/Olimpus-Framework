<?php
declare(strict_types=1);
namespace Olimpuss\Models;
umask(0000);
/**
 * Model Class for Courses
 */
use Olimpuss\Model;

class Course extends Model {
    protected $table = 'courses';
    protected $primaryKey = 'course_id';
    protected $fillable = ['course_id', 'course', 'created_at', 'updated_at', 'deleted_at'];
}
