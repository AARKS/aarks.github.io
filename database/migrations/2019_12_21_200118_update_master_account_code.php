<?php

use App\Aarks\CopyMasterAccountCode;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateMasterAccountCode extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('master_account_codes', function (Blueprint $table) {
            $table->string('name');
            $table->integer('code');
            $table->string('gst_code');
            $table->text('note')->nullable();
            $table->integer('type')
                ->comment('1 = Debit, 2 = Credit');
            $table->unsignedBigInteger('category_id')
                ->nullable();
            $table->foreign('category_id')
                ->references('id')
                ->on('account_code_categories')
                ->onDelete('cascade');
            $table->unsignedBigInteger('sub_category_id')
                ->nullable();
            $table->foreign('sub_category_id')
                ->references('id')
                ->on('account_code_categories')
                ->onDelete('cascade');
            $table->unsignedBigInteger('additional_category_id')
                ->nullable();
            $table->foreign('additional_category_id')
                ->references('id')
                ->on('account_code_categories')
                ->onDelete('cascade');
            $table->unsignedBigInteger('account_code_id')
                ->nullable()
                ->change();
        });

        CopyMasterAccountCode::copy();

        if (Schema::hasColumn('master_account_codes', 'account_code_id')) {
            Schema::table('master_account_codes', function (Blueprint $table) {
                $table->dropForeign(['account_code_id']);
                $table->dropColumn('account_code_id');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('master_account_codes', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropForeign(['sub_category_id']);
            $table->dropForeign(['additional_category_id']);
            $table->dropColumn(['name','code','gst_code','note', 'category_id', 'sub_category_id', 'additional_category_id','type']);
        });
    }
}
