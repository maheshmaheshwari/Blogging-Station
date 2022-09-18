<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class V150 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('options')->insert([
            [
                'name' => 'datetime_format',
                'value' => 'MMM d, Y, h:mm a',
                'auto' => '1',
            ],
            [
                'name' => 'personal_token',
                'value' => null,
                'auto' => '1',
            ],
            [
                'name' => 'purchase_code',
                'value' => null,
                'auto' => '1',
            ],
        ]);

        Schema::table('comments', function (Blueprint $table) {
            $table
                ->unsignedTinyInteger('status')
                ->after('article_id')
                ->nullable()
                ->comment('1=active, 2=pending');
        });

        Schema::table('users', function (Blueprint $table) {
            $table
                ->bigInteger('image_id')
                ->after('description')
                ->unsigned()
                ->nullable()
                ->index('idx_imageid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
