<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Widen file_path to TEXT so it can hold a JSON-encoded array of paths
        // (supports multiple uploaded/captured files per document type).
        // Raw SQL used here to avoid requiring the doctrine/dbal package.
        DB::statement('ALTER TABLE enrollment_document MODIFY file_path TEXT NULL');

        // Convert existing single-path values into a JSON array so old data
        // still displays correctly under the new multi-file convention.
        $rows = DB::table('enrollment_document')->whereNotNull('file_path')->get();
        foreach ($rows as $row) {
            $decoded = json_decode($row->file_path, true);
            // Skip rows that are already JSON arrays (re-running this migration safely)
            if (is_array($decoded)) {
                continue;
            }
            DB::table('enrollment_document')
                ->where('enrollment_doc_id', $row->enrollment_doc_id)
                ->update(['file_path' => json_encode([$row->file_path])]);
        }
    }

    public function down(): void
    {
        // Convert JSON arrays back to a single path (keeps the first file only)
        $rows = DB::table('enrollment_document')->whereNotNull('file_path')->get();
        foreach ($rows as $row) {
            $decoded = json_decode($row->file_path, true);
            if (is_array($decoded)) {
                DB::table('enrollment_document')
                    ->where('enrollment_doc_id', $row->enrollment_doc_id)
                    ->update(['file_path' => $decoded[0] ?? null]);
            }
        }

        DB::statement('ALTER TABLE enrollment_document MODIFY file_path VARCHAR(255) NULL');
    }
};