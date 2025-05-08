<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modules = \DB::table('modules');
        if ($modules->count() == 0) {
            $modules->insert([
                ['name' => 'Patient', 'route_name' => 'patients.index'],
                ['name' => 'Appointment', 'route_name' => 'appointment.index'],
                ['name' => 'Queue', 'route_name' => 'queue.index'],
                ['name' => 'Inventory', 'route_name' => 'inventory.index'],
                ['name' => 'Package', 'route_name' => 'packages.index'],
                ['name' => 'Supplier', 'route_name' => 'suppliers.index'],
                ['name' => 'Purchase Order', 'route_name' => 'purchase-orders.index'],
                ['name' => 'Stock Adjustment', 'route_name' => 'stock-adjustments.index'],
                ['name' => 'Accounting Report', 'route_name' => 'accounting-reports.index'],
                ['name' => 'Inventory Report', 'route_name' => 'inventory-reports.index'],
                ['name' => 'Access Control Setup', 'route_name' => 'access-control.index'],
                ['name' => 'Branch Setup', 'route_name' => 'branches.index'],
                ['name' => 'Patient Setup', 'route_name' => 'patient-general-setup.index'],
                ['name' => 'Appointment Setup', 'route_name' => 'appointment-general-setup.index'],
                ['name' => 'Inventory Setup', 'route_name' => 'inventory-general-setup.index'],
                ['name' => 'Finance Setup', 'route_name' => 'finance.index']
                
            ]);
        }

        

        if (!\DB::table('modules')->where('name', 'Patient Report')->exists()) {
            \DB::table('modules')->insert([
                'name' => 'Patient Report',
                'route_name' => 'patient-reports.index'
            ]);
        }
    }
}
