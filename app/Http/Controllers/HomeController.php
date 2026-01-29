<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function about()
    {
        // 1. Team Data
        $team = [
            [
                'name' => 'Sarah Chen',
                'role' => 'Founder & Head Brewer',
                'image' => 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?auto=format&fit=crop&q=80&w=200',
                'description' => 'Sarah brings 15 years of coffee expertise and a passion for sustainable sourcing.'
            ],
            [
                'name' => 'David Miller',
                'role' => 'Master Roaster',
                'image' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=crop&q=80&w=200',
                'description' => 'With a nose for nuances, David ensures every batch meets our gold standard.'
            ],
            [
                'name' => 'Emily Zhang',
                'role' => 'Cafe Manager',
                'image' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&q=80&w=200',
                'description' => 'Emily creates the warm, welcoming atmosphere our customers love.'
            ]
        ];

        // 2. Timeline Data
        $timeline = [
            ['year' => '2019', 'title' => 'The Beginning', 'description' => 'Golden Drip started as a humble coffee cart in the city center.'],
            ['year' => '2021', 'title' => 'First Location', 'description' => 'We opened our flagship store, creating a permanent home for our community.'],
            ['year' => '2023', 'title' => 'Roastery Launch', 'description' => 'Started roasting our own beans to ensure perfect quality control.'],
            ['year' => '2025', 'title' => 'Going Digital', 'description' => 'Launched our online ordering platform to serve you better.']
        ];

        // 3. Testimonials Data
        $testimonials = [
            [
                'content' => 'The best coffee in town, hands down. The atmosphere is perfect for working.',
                'author' => 'Michael B.',
                'role' => 'Software Engineer',
                'image' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=100&q=80'
            ],
            [
                'content' => 'I love their commitment to sustainability. And the pastries are to die for!',
                'author' => 'Jessica L.',
                'role' => 'Teacher',
                'image' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=100&q=80'
            ],
            [
                'content' => 'A true gem. The staff always remembers my name and my usual order.',
                'author' => 'Robert K.',
                'role' => 'Local Artist',
                'image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=100&q=80'
            ]
        ];

        return view('about', compact('team', 'timeline', 'testimonials'));
    }
}