<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EnrollmentDocument extends Model
{
    use SoftDeletes;

    protected $table      = 'enrollment_document';
    protected $primaryKey = 'enrollment_doc_id';
    public $timestamps    = false;

    protected $fillable = [
        'enrollment_id',
        'document_type_id',
        'submission_status',
        'file_path',
        'submission_date',
        'notes',
    ];

    protected $casts = [
        'submission_date' => 'date',
    ];

    /**
     * Returns the list of stored file paths as a plain array.
     * Supports both the new JSON-array format and legacy single-path strings.
     */
    public function getFilePathsAttribute(): array
    {
        if (!$this->file_path) {
            return [];
        }
        $decoded = json_decode($this->file_path, true);
        return is_array($decoded) ? $decoded : [$this->file_path];
    }

    public function getHasFileAttribute(): bool
    {
        return count($this->file_paths) > 0;
    }

    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class, 'enrollment_id', 'enrollment_id');
    }

    public function documentType()
    {
        return $this->belongsTo(DocumentType::class, 'document_type_id', 'document_type_id');
    }
}