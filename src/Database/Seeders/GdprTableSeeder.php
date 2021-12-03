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
            'agreement_label'  => 'I agree with the terms and conditions.',
            'agreement_content' => '<p>Demo Data</p>',
            'cookie_status' => 0,
            'cookie_block_position' => 'bottom-left',
            'cookie_static_block_identifier' => 'Cookie Block',
            'strictly_necessary_cookie' => 'These trackers are used for activities that are strictly necessary to operate or deliver the service you requested from us and, therefore, do not require you to consent.',
            'basic_interactions_and_functionalities_cookie' => 'These trackers enable basic interactions and functionalities that allow you to access selected features of our service and facilitate your communication with us.',
            'experience_enhancement_cookie' => 'These trackers help us to provide a personalized user experience by improving the quality of your preference management options, and by enabling the interaction with external networks and platforms.',
            'measurement_cookie' => 'These trackers help us to measure traffic and analyze your behavior with the goal of improving our service.',
            'targeting_and_advertising_cookie' => 'These trackers help us to deliver personalized marketing content to you based on your behavior and to operate, serve and track ads.'
        ]);
    }
}