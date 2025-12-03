<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Tool;

class ToolPage extends Component
{
    public string $slug;
    public $tool;

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->tool = Tool::where('slug', $slug)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.tool-page', [
            'tool' => $this->tool,
        ]);
    }
}
