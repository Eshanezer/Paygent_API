<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_mkdb_entries', function (Blueprint $table) {
            $table->id();
            $table->integer('year')->nullable();
            $table->string('request_no');
            $table->string('entry_type');
            $table->string('mkdb_id_login')->nullable();
            $table->string('club_cd');
            $table->integer('card_type');
            $table->string('mkdb_id')->nullable();
            $table->string('post_cd');
            $table->string('address_state');
            $table->string('address_city');
            $table->string('address_street');
            $table->string('address_building')->nullable();
            $table->string('lastname');
            $table->string('firstname');
            $table->string('member_last_nm_kana');
            $table->string('member_first_nm_kana');
            $table->string('sex');
            $table->date('birthdate');
            $table->string('homephone')->nullable();
            $table->string('mobilephone')->nullable();
            $table->string('email');
            $table->string('process_type')->nullable();
            $table->string('category_cd')->nullable();
            $table->string('stop_flg')->nullable();
            $table->string('club_member_id')->nullable();
            $table->integer('club_member_targetyear')->nullable();
            $table->string('otp_id')->nullable();
            $table->string('member_grade_master_id')->nullable();
            $table->string('member_effective_start_ymd')->nullable();
            $table->string('member_effective_end_ymd')->nullable();
            $table->string('auto_continuation_permission')->nullable();
            $table->string('manager_member_id')->nullable();
            $table->string('manager_member_cd')->nullable();
            $table->string('settlement_status')->nullable();
            $table->string('member_ss_basic_id')->nullable();
            $table->string('member_ss_basic_target_year')->nullable();
            $table->string('stadium_seat_price_master_id')->nullable();
            $table->string('ss_start_ymd')->nullable();
            $table->string('ss_end_ymd')->nullable();
            $table->string('member_ss_detail_id')->nullable();
            $table->string('stadium_club_master_id')->nullable();
            $table->string('stadium_block_master_id')->nullable();
            $table->string('floor_no')->nullable();
            $table->string('seat_column_no')->nullable();
            $table->string('seat_no')->nullable();
            $table->string('member_device_id')->nullable();
            $table->string('device_cd')->nullable();
            $table->string('response_no')->nullable();
            $table->string('result_cd')->nullable();
            $table->string('message_id')->nullable();
            $table->string('error_msg')->nullable();
            $table->string('res_club_cd')->nullable();
            $table->string('res_club_member_id')->nullable();
            $table->string('res_otp_id')->nullable();
            $table->string('res_mkdb_id')->nullable();
            $table->string('entry_type_code')->nullable();
            $table->string('entry_type_name')->nullable();
            $table->integer('entry_flg')->default(0);
            $table->integer('payment_flg')->default(0);
            $table->string('payment_type_code')->nullable();
            $table->string('payment_type_name')->nullable();
            $table->string('bety_header_id')->nullable();
            $table->string('bety_deal_seq')->nullable();
            $table->string('fc_flg')->nullable();
            $table->string('ss_flg')->nullable();
            $table->string('referrer_otp_id')->nullable();
            $table->string('campaign_code')->nullable();
            $table->dateTime('regist_date')->nullable();
            $table->string('regist_user')->nullable();
            $table->dateTime('update_date')->nullable();
            $table->string('update_user')->nullable();
            $table->dateTime('delete_date')->nullable();
            $table->string('delete_user')->nullable();
            $table->tinyInteger('delete_flg')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_mkdb_entries');
    }
};
