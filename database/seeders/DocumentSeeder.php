<?php


namespace Database\Seeders;

use App\Models\Document;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DocumentSeeder extends Seeder
{
    public function run()
    {
        $smartphones = Product::where('name', 'like', 'Smartphone%')->get();
        
        // Product Certifications
        Document::create([
            'product_id' => $smartphones[0]->id,
            'title' => 'X1 Safety Certification',
            'type' => 'Product Certification',
            'issue_date' => '2024-01-15',
            'file_path' => 'certifications/x1_safety.pdf',
        ]);

        Document::create([
            'product_id' => $smartphones[1]->id,
            'title' => 'X2 Quality Certification',
            'type' => 'Product Certification',
            'issue_date' => '2024-02-20',
            'file_path' => 'certifications/x2_quality.pdf',
        ]);

        Document::create([
            'product_id' => $smartphones[2]->id,
            'title' => 'X3 Emission Certification',
            'type' => 'Product Certification',
            'issue_date' => '2024-03-10',
            'file_path' => 'certifications/x3_emission.pdf',
        ]);

        // User Manuals
        Document::create([
            'product_id' => $smartphones[0]->id,
            'title' => 'X1 User Manual',
            'type' => 'User Manual',
            'issue_date' => '2024-01-20',
            'file_path' => 'manuals/x1_manual.pdf',
        ]);

        Document::create([
            'product_id' => $smartphones[1]->id,
            'title' => 'X2 User Manual',
            'type' => 'User Manual',
            'issue_date' => '2024-02-25',
            'file_path' => 'manuals/x2_manual.pdf',
        ]);
    }
}