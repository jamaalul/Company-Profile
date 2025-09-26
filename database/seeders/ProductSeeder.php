<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Jaket HIMTI Premium',
                'description' => 'Jaket resmi HIMTI dengan bahan berkualitas tinggi. Dilengkapi dengan logo HIMTI yang elegan dan desain modern. Cocok untuk acara formal maupun casual.',
                'price' => 250000,
                'stock' => 50,
                'images' => ['/placeholder.svg?height=400&width=400'],
                'specifications' => [
                    'Material' => 'Fleece Premium',
                    'Warna' => 'Navy, Hitam',
                    'Ukuran' => 'S, M, L, XL, XXL',
                    'Fitur' => 'Waterproof, Windproof'
                ],
                // 'weight' => 600,
                'is_featured' => true,
                'status' => 'active',
            ],
            [
                'name' => 'T-Shirt HIMTI Code',
                'description' => 'Kaos dengan desain unik bertema programming. Dibuat dari bahan cotton combed yang nyaman dan tidak mudah luntur.',
                'price' => 85000,
                'stock' => 100,
                'images' => ['/placeholder.svg?height=400&width=400'],
                'specifications' => [
                    'Material' => 'Cotton Combed 30s',
                    'Warna' => 'Hitam, Putih, Abu-abu',
                    'Ukuran' => 'S, M, L, XL, XXL',
                    'Print' => 'Sablon Plastisol'
                ],
                // 'weight' => 200,
                'is_featured' => true,
                'status' => 'active',
            ],
            [
                'name' => 'Tote Bag HIMTI',
                'description' => 'Tas kanvas multifungsi dengan desain minimalis. Ideal untuk membawa laptop, buku, dan keperluan sehari-hari.',
                'price' => 45000,
                'stock' => 75,
                'images' => ['/placeholder.svg?height=400&width=400'],
                'specifications' => [
                    'Material' => 'Canvas Tebal',
                    'Warna' => 'Natural, Hitam',
                    'Ukuran' => '35x40cm',
                    'Handle' => 'Tali Kanvas Kuat'
                ],
                // 'weight' => 150,
                'is_featured' => false,
                'status' => 'active',
            ],
            [
                'name' => 'Sticker Pack HIMTI',
                'description' => 'Set sticker dengan berbagai desain menarik. Tahan air dan cocok untuk laptop, botol minum, atau gadget lainnya.',
                'price' => 15000,
                'stock' => 200,
                'images' => ['/placeholder.svg?height=400&width=400'],
                'specifications' => [
                    'Material' => 'Vinyl Waterproof',
                    'Jumlah' => '10 pcs per pack',
                    'Ukuran' => 'Berbagai ukuran',
                    'Fitur' => 'Waterproof, UV Resistant'
                ],
                // 'weight' => 50,
                'is_featured' => false,
                'status' => 'active',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
