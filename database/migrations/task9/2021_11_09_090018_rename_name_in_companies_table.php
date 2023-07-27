<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameNameInCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Add the new `name` column
        Schema::table('companies', function (Blueprint $table) {
            $table->string('name')->after('title');
        });

        // Copy data from the `title` column to the new `name` column
        DB::statement('UPDATE companies SET name = title');

        // Remove the `title` column
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn('title');
        });
    }

    public function down()
    {
        // Add the `title` column back
        Schema::table('companies', function (Blueprint $table) {
            $table->string('title')->after('name');
        });

        // Copy data from the `name` column back to the `title` column
        DB::statement('UPDATE companies SET title = name');

        // Remove the `name` column
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn('name');
        });
    }
}
