<?php

namespace App\Http\Controllers;

use App\Models\t_mkdb_entry;
use Illuminate\Http\Request;

class mkdb_entry_Controller extends Controller
{
    public function create($data)
    {
        t_mkdb_entry::create(['year', 'request_no', 'entry_type', 'mkdb_id_login', 'club_cd', 'card_type', 'mkdb_id', 'post_cd', 'address_state', 'address_city', 'address_street', 'address_building', 'lastname', 'firstname', 'member_last_nm_kana', 'member_first_nm_kana', 'sex', 'birthdate', 'homephone', 'mobilephone', 'email', 'process_type', 'category_cd', 'stop_flg', 'club_member_id', 'club_member_targetyear', 'otp_id', 'member_grade_master_id', 'member_effective_start_ymd', 'member_effective_end_ymd', 'auto_continuation_permission', 'manager_member_id', 'manager_member_cd', 'settlement_status', 'member_ss_basic_id', 'member_ss_basic_target_year', 'stadium_seat_price_master_id', 'ss_start_ymd', 'ss_end_ymd', 'member_ss_detail_id', 'stadium_club_master_id', 'stadium_block_master_id', 'floor_no', 'seat_column_no', 'seat_no', 'member_device_id', 'device_cd', 'response_no', 'result_cd', 'message_id', 'error_msg', 'res_club_cd', 'res_club_member_id', 'res_otp_id', 'res_mkdb_id', 'entry_type_code', 'entry_type_name', 'entry_flg', 'payment_flg', 'payment_type_code', 'payment_type_name', 'bety_header_id', 'bety_deal_seq', 'fc_flg', 'ss_flg', 'referrer_otp_id', 'campaign_code', 'regist_date', 'regist_user', 'update_date', 'update_user', 'delete_date', 'delete_user', 'delete_flg']);
    }
}
