<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Category;
use App\Models\Tool;

class CategoryPage extends Component
{
    use WithPagination;

    public string $slug;
    public $category;
    protected $paginationTheme = 'tailwind';
    public int $perPage = 20;

    public function mount($slug)
    {
        $this->slug = $slug;
        $this->category = Category::where('slug', $slug)->firstOrFail();
    }

    public function render()
    {
        $tools = Tool::where('category_id', $this->category->id)
                    ->latest('created_at')
                    ->paginate($this->perPage);

        return view('livewire.category-page', [
            'category' => $this->category,
            'tools' => $tools,
        ]);
    }
}
