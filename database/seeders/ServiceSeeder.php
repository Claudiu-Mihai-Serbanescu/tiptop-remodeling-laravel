<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['Kitchen Remodeling','Transform your kitchen into a modern, functional space where you can cook, entertain, and create lasting memories.'],
            ['Bathroom Remodeling','Upgrade your bathroom to a luxurious retreat with high-end finishes and fixtures.'],
            ['Custom Basements','Turn your unused basement space into a vibrant living area, home office, or entertainment room.'],
            ['Flooring Installation','Choose from a wide range of flooring options, including hardwood, laminate, and tile, to enhance the beauty and durability of your home.'],
            ['Carpet Installation','Add warmth and comfort to any room with our high-quality carpeting options.'],
            ['Interior and Exterior Painting','Refresh and revitalize your home\'s appearance with professional painting services.'],
            ['Drywall Repair','Ensure your walls are smooth and flawless with our expert drywall repair services.'],
            ['Doors and Windows Replacement','Improve your home\'s energy efficiency and aesthetic appeal with new doors and windows.'],
            ['Mudrooms & Laundry Rooms','Optimize your home\'s functionality with custom-designed mudrooms and laundry rooms.'],
            ['Roofing & Gutters','Protect your home from the elements with our roofing and gutter services.'],
            ['Foundations & Patios','Enhance your outdoor living with durable and stylish foundations and patios.'],
        ];

        foreach ($items as [$name, $excerpt]) {
            Service::updateOrCreate(
                ['slug' => Str::slug($name)],
                ['name' => $name, 'excerpt' => $excerpt, 'description' => null]
            );
        }
    }
}

