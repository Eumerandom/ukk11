<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

class AddTriggerUpdateStatusPkl extends Migration
{
    public function up(): void
    {
        // Trigger setelah insert ke pkl
        DB::unprepared('
            CREATE TRIGGER trg_after_insert_pkl
            AFTER INSERT ON pkls
            FOR EACH ROW
            BEGIN
                UPDATE siswas
                SET status_pkl = "aktif"
                WHERE id = NEW.siswa_id;
            END
        ');

        // Trigger setelah delete dari pkl
        DB::unprepared('
            CREATE TRIGGER trg_after_delete_pkl
            AFTER DELETE ON pkls
            FOR EACH ROW
            BEGIN
                IF NOT EXISTS (
                    SELECT 1 FROM pkls WHERE siswa_id = OLD.siswa_id
                ) THEN
                    UPDATE siswas
                    SET status_pkl = "tidak_aktif"
                    WHERE id = OLD.siswa_id;
                END IF;
            END
        ');
    }

    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS trg_after_insert_pkl;');
        DB::unprepared('DROP TRIGGER IF EXISTS trg_after_delete_pkl;');
    }
}
