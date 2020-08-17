<?php

namespace Webkul\GDPR\Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;


class GdprTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('gdpr')->insert([
            'gdpr_status' => 1,
            'customer_agreement_status' => 0,
            'agreement_label'  => 'I agree with the terms and conditions',
            'agreement_content' => '<p>Demo Data</p>',
            'cookie_status' => 0,
            'cookie_block_position' => 'bottom-left',
            'cookie_static_block_identifier' => 'Cookie Block',
            'data_update_request_template' => 'Data Update Request (Default)',
            'data_delete_request_template' => 'Data Delete Request (Default)',
            'request_status_update_template' => 'Request Status Update (Default)',
            'request_status_delete_template' => 'Request Status Delete (Default)'
        ]);
    }
}