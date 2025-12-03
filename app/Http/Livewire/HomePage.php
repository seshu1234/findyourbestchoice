<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Tool;
use App\Models\Category;

class HomePage extends Component
{
    public $search = '';

    public function render()
    {
        return view('livewire.home-page', [
            'featuredTools' => Tool::orderBy('upvotes', 'desc')->take(8)->get(),
            'recentTools'   => Tool::latest()->take(8)->get(),
        ])
        ->layout('theme::components.layouts.marketing');
    }
}
