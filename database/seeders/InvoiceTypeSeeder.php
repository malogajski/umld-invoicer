<?php

namespace Database\Seeders;

use App\Models\Host;
use App\Models\Invoices\InvoiceType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class InvoiceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        InvoiceType::truncate();

        if (!Host::find(1)) {
            Host::create([
                'id'                 => 1,
                'name'               => 'TEST',
                'description'        => 'TEST',
                'tax_id'             => '000000001',
                'number_id'          => '000000002',
                'address'            => '-',
                'city_id'            => 1,
                'country_id'         => 1,
                'email'              => 'umld@inv.com',
                'web'                => null,
                'responsible_person' => 'Darko',
                'phone'              => '0123456789',
                'mobile'             => '0123456789',
                'bank_account'       => '012-3456-789',
                'logo_img'           => null,
                'default_language'   => 'en',
            ]);
        }

        InvoiceType::insert([
            [
                'name'    => 'Invoice',
                'host_id' => 1,
                'prefix'  => 'IN',
            ],
            [
                'name' => 'Order',
                'host_id' => 1,
                'prefix' => 'OR'
            ],
        ]);
        Schema::enableForeignKeyConstraints();
    }
}
