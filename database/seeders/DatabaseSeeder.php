<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            BranchSeeder::class,
            UserRoleSeeder::class,
            UserSeeder::class,
            TitleSeeder::class,
            GenderSeeder::class,
            NationalitySeeder::class,
            MaritalStatusSeeder::class,
            StateSeeder::class,
            CitySeeder::class,
            CaseTypeSeeder::class,
            AppointmentCategorySeeder::class,
            AppointmentStatusSeeder::class,
            RecurringTypeSeeder::class,
            QueueStatusSeeder::class,
            ProductTypeSeeder::class,
            ProductCategorySeeder::class,
            UomSeeder::class,
            SupplierSeeder::class,
            UsageSeeder::class,
            FrequencySeeder::class,
            DosageSeeder::class,
            ProductSeeder::class,
            PaymentOptionSeeder::class,
            PackageSeeder::class,
            StockAdjustmentTypeSeeder::class,
            TaxSeeder::class,
            PatientSeeder::class,
            ModuleSeeder::class
        ]);
    }
}
