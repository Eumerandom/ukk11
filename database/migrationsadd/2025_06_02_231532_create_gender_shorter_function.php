<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGenderShorterFunction extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared("
            DROP FUNCTION IF EXISTS gender_shorter;

            CREATE FUNCTION gender_shorter(gender VARCHAR(10))
            RETURNS VARCHAR(1)
            DETERMINISTIC
            BEGIN
                RETURN CASE
                    WHEN gender = 'laki-laki' THEN 'L'
                    WHEN gender = 'perempuan' THEN 'P'
                    ELSE '-'
                END;
            END;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP FUNCTION IF EXISTS gemder_shorter");
    }
};
