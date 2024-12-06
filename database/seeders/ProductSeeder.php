<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // Section Salée
            [
                'name' => 'Socisso\'Fromage',
                'description' => 'Délicieuse saucisse au goût intense de fromage fondu.',
                'price' => 4.50,
                'image_url' => '/images/products/fromage.jpg',
                'stock' => 150,
                'is_available' => true,
                'is_sale' => '1'
            ],
            [
                'name' => 'Socisso\'Saumon',
                'description' => 'Saucisse raffinée au goût unique de saumon fumé.',
                'price' => 6.50,
                'image_url' => '/images/products/saumon.jpg',
                'stock' => 80,
                'is_available' => true,
                'is_sale' => '1'
            ],
            [
                'name' => 'Socisso\'Pizza',
                'description' => 'Saucisse aux saveurs intenses de pizza, avec fromage fondu et épices.',
                'price' => 5.25,
                'image_url' => '/images/products/pizza.jpg',
                'stock' => 100,
                'is_available' => true,
                'is_sale' => '1'
            ],
            [
                'name' => 'Socisso\'El Morjene',
                'description' => 'Saucisse épicée aux saveurs méditerranéennes.',
                'price' => 5.00,
                'image_url' => '/images/products/morjene.jpg',
                'stock' => 120,
                'is_available' => true,
                'is_sale' => '1'
            ],
            [
                'name' => 'Socisso\'Sel',
                'description' => 'Une saucisse classique, subtilement salée.',
                'price' => 3.50,
                'image_url' => '/images/products/sel.jpg',
                'stock' => 200,
                'is_available' => true,
                'is_sale' => '1'
            ],
            [
                'name' => 'Socisso\'Côte de Boeuf',
                'description' => 'Saucisse au goût authentique de côte de boeuf.',
                'price' => 6.00,
                'image_url' => '/images/products/cote_boeuf.jpg',
                'stock' => 80,
                'is_available' => true,
                'is_sale' => '1'
            ],
            [
                'name' => 'Socisso\'Oignons',
                'description' => 'Saucisse parfumée aux oignons caramélisés.',
                'price' => 4.75,
                'image_url' => '/images/products/oignons.jpg',
                'stock' => 100,
                'is_available' => true,
                'is_sale' => '1'
            ],
            [
                'name' => 'Socisso\'Tacos',
                'description' => 'Saucisse aux saveurs épicées et tex-mex.',
                'price' => 5.50,
                'image_url' => '/images/products/tacos.jpg',
                'stock' => 90,
                'is_available' => true,
                'is_sale' => '1'
            ],

            // Section Sucrée
            [
                'name' => 'Socisso\'Nutella',
                'description' => 'Saucisse sucrée au cœur fondant de Nutella.',
                'price' => 5.00,
                'image_url' => '/images/products/nutella.jpg',
                'stock' => 100,
                'is_available' => true,
                'is_sale' => '0'
            ],
            [
                'name' => 'Socisso\'Beurre de Cacahuète',
                'description' => 'Saucisse unique au beurre de cacahuète crémeux.',
                'price' => 5.25,
                'image_url' => '/images/products/beurre_cacahuete.jpg',
                'stock' => 70,
                'is_available' => true,
                'is_sale' => '0'
            ],
            [
                'name' => 'Socisso\'Caramel',
                'description' => 'Saucisse au goût doux et gourmand de caramel.',
                'price' => 4.75,
                'image_url' => '/images/products/caramel.jpg',
                'stock' => 120,
                'is_available' => true,
                'is_sale' => '0'
            ],
            [
                'name' => 'Socisso\'KitKat',
                'description' => 'Saucisse craquante avec des morceaux de KitKat.',
                'price' => 6.00,
                'image_url' => '/images/products/kitkat.jpg',
                'stock' => 60,
                'is_available' => true,
                'is_sale' => '0'
            ],
            [
                'name' => 'Socisso\'Maltesers',
                'description' => 'Saucisse sucrée parsemée de pépites de Maltesers.',
                'price' => 5.50,
                'image_url' => '/images/products/maltesers.jpg',
                'stock' => 75,
                'is_available' => true,
                'is_sale' => '0'
            ],
            [
                'name' => 'Socisso\'Fraise',
                'description' => 'Saucisse fruitée et acidulée à la fraise.',
                'price' => 4.25,
                'image_url' => '/images/products/fraise.jpg',
                'stock' => 110,
                'is_available' => true,
                'is_sale' => '0'
            ],
            [
                'name' => 'Socisso\'Brownies',
                'description' => 'Saucisse au chocolat intense et morceaux de brownies.',
                'price' => 6.50,
                'image_url' => '/images/products/brownies.jpg',
                'stock' => 55,
                'is_available' => true,
                'is_sale' => '0'
            ],
        ];


        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
