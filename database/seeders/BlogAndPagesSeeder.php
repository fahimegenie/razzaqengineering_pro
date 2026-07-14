<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use App\Models\BlogPost;
use App\Models\BlogComment;
use App\Models\User;

class BlogAndPagesSeeder extends Seeder
{
    public function run(): void
    {
        // Create Legal Pages
        $legalPages = [
            [
                'page_title' => 'Privacy Policy',
                'page_slug' => 'privacy-policy',
                'page_content' => '<h2>Privacy Policy</h2><p>Your privacy is important to us. This privacy policy explains how Razzaq Engineering collects, uses, and protects your personal information.</p><h3>Information We Collect</h3><p>We collect information you provide when contacting us, including your name, email, phone number, and project details.</p><h3>How We Use Your Information</h3><p>We use your information to respond to inquiries, provide services, and improve our website experience.</p>',
                'show_in_footer' => true,
                'sort_order' => 1,
            ],
            [
                'page_title' => 'Terms & Conditions',
                'page_slug' => 'terms-conditions',
                'page_content' => '<h2>Terms and Conditions</h2><p>By using our website and services, you agree to these terms and conditions.</p><h3>Services</h3><p>We provide concrete cutting, core drilling, and related engineering services as described on our website.</p><h3>Payments</h3><p>Payment terms are agreed upon before project commencement.</p>',
                'show_in_footer' => true,
                'sort_order' => 2,
            ],
            [
                'page_title' => 'Return Policy',
                'page_slug' => 'return-policy',
                'page_content' => '<h2>Return Policy</h2><p>Our return policy for products and equipment.</p>',
                'show_in_footer' => true,
                'sort_order' => 3,
            ],
            [
                'page_title' => 'Refund Policy',
                'page_slug' => 'refund-policy',
                'page_content' => '<h2>Refund Policy</h2><p>Information about our refund process and eligibility.</p>',
                'show_in_footer' => true,
                'sort_order' => 4,
            ],
        ];

        foreach ($legalPages as $page) {
            Page::create($page);
        }

        // Create Blog Categories
        $categories = [
            ['bc_name' => 'Concrete Cutting Tips', 'bc_description' => 'Expert tips and techniques for concrete cutting'],
            ['bc_name' => 'Industry News', 'bc_description' => 'Latest news in construction and engineering'],
            ['bc_name' => 'Project Updates', 'bc_description' => 'Updates on our ongoing and completed projects'],
            ['bc_name' => 'Safety Guidelines', 'bc_description' => 'Important safety information for construction'],
            ['bc_name' => 'Equipment Guide', 'bc_description' => 'Guides about concrete cutting equipment'],
        ];

        foreach ($categories as $cat) {
            BlogCategory::create($cat);
        }

        // Create Blog Tags
        $tags = [
            'Core Cutting', 'Wall Sawing', 'Wire Sawing', 'Floor Sawing',
            'Lahore Projects', 'Islamabad Projects', 'Karachi Projects',
            'RCC Cutting', 'Diamond Cutting', 'Construction Tips',
            'Safety First', 'Equipment Review', 'HILTI', 'Husqvarna'
        ];

        foreach ($tags as $tag) {
            BlogTag::create(['bt_name' => $tag]);
        }

        // Create Sample Blog Posts
        $author = User::first();
        
        $posts = [
            [
                'bp_title' => 'Top 10 Tips for Professional Concrete Core Cutting',
                'bp_excerpt' => 'Learn the essential tips for professional concrete core cutting from industry experts.',
                'bp_content' => 'Full article content here...',
                'category_id' => 1,
                'is_featured' => true,
                'bp_status' => 'published',
                'published_at' => now()->subDays(2),
            ],
            [
                'bp_title' => 'Latest Trends in Diamond Wire Sawing Technology 2024',
                'bp_excerpt' => 'Discover the latest advancements in diamond wire sawing technology.',
                'bp_content' => 'Full article content here...',
                'category_id' => 2,
                'is_featured' => true,
                'bp_status' => 'published',
                'published_at' => now()->subDays(5),
            ],
            [
                'bp_title' => 'Completed: Major Bridge Modification Project in Lahore',
                'bp_excerpt' => 'We successfully completed a major bridge modification project in Lahore.',
                'bp_content' => 'Full article content here...',
                'category_id' => 3,
                'is_featured' => false,
                'bp_status' => 'published',
                'published_at' => now()->subDays(7),
            ],
            [
                'bp_title' => 'Essential Safety Protocols for Concrete Cutting Operations',
                'bp_excerpt' => 'A comprehensive guide to safety protocols in concrete cutting.',
                'bp_content' => 'Full article content here...',
                'category_id' => 4,
                'is_featured' => false,
                'bp_status' => 'published',
                'published_at' => now()->subDays(10),
            ],
        ];

        foreach ($posts as $post) {
            $post['author_id'] = $author->id;
            BlogPost::create($post);
        }
    }
}