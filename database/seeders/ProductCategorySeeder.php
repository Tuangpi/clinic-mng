<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productCategories = \DB::table('product_categories');
        if ($productCategories->count() == 0) {
            $productCategories->insert([
                [ 'description' => 'ACE Inhibitors', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Aminoglycosides', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Anabolic Agents', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Analgesics', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Androgens', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Antacids', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Anti-allergics', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Anti-amoebics', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Anti-anemics', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Anti-anginal drugs', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Anti-asthmatic', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Antibacterial Combi', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Anti-coagulants', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Anti-convulsants', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Anti-depressants', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Anti-diarrheals', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Anti-flatulents', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Anti-histamines', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Anti-Hypertensive', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Anti-inflammatories', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Anti-malarials', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Anti-obesity Agt', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Anti-parkinson Drugs', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Anti-pyretics', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Anti-rheumatic', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Antisera & Immuno', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Anti-thrombotics', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Anti-thyroids', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Anti-tuberculosis', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Anti-ulcerants', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Appetite Stimu', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Beta Blockers', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Calcium/with Vit', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Cardiac Drug', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Cephalosporins', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Chloramphenicols', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'COPD Preparations', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Corticosteroid Hormo', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Cough & Cold Remedie', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Decongestions', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Diuretics', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Drug Acting on Uteru', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Ear Anti-infectives', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Ear Antisep& Cortico', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Ear Antiseptics', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Electro & Mineral', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Eye antiinfectives', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Eye antiseptics', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Eye Corticosteroids', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Fibrinolytics', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Genito-urinary sys', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'GIT Regulators', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Glaucoma Prep', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Gout Preparations', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Hypnotics & Sedative', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Immunosuppressants', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Insulins', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Intravenous', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Laxatives', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Macrolides', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Major Transquilisers', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Minor Transquilliser', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Mouth / Throat Prep', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Muscle Relaxants', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'NeuroMusc Disorder', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Nutrition', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Oestrogens', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Oral Antidiabetic ag', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Oral Contraceptive', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Others', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Other antibiotics', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Other antihypertensi', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Other Contraceptive', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Other Dermatological', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Other Ear Prep', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Other Eye Prep', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Other Nasal Prep', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Other Sterile Soln', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Pain Killer', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Penicillins', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'PrePost natal Vit', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Progesterone', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Purgatives', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Quinolones', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Related Synthetic', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Sulphonamides', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Tetracyclines', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Thyroid Prep', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Top antiinfect & cor', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Topi Anti-infect', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Topical Corticostero', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Urinary Antiseptics', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Vaccines', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36'],
                [ 'description' => 'Vasoconstrictors', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2022-10-30 15:14:36', 'updated_at' => '2022-10-30 15:14:36']
            ]);
        }
    }
}
