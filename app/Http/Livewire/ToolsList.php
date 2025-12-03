<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Tool;
use App\Models\Category;

class ToolsList extends Component
{
    use WithPagination;

    public string $search = '';
    public ?int $category = null;
    public string $sort = 'newest';
    public int $perPage = 24;

    protected $queryString = ['search', 'category', 'sort'];
    protected $paginationTheme = 'tailwind';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatedCategory()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Tool::query();

        if ($this->search) {
            $q = $this->search;
            $query->where(function($qq) use ($q) {
                $qq->where('name', 'ilike', "%{$q}%")
                   ->orWhere('short_description', 'ilike', "%{$q}%")
                   ->orWhere('description', 'ilike', "%{$q}%");
            });
        }

        if ($this->category) {
            $query->where('category_id', $this->category);
        }

        if ($this->sort === 'popular') {
            $query->orderBy('upvotes', 'desc');
        } else {
            $query->latest('created_at');
        }

        $tools = $query->paginate($this->perPage);

        $categories = Category::orderBy('name')->get();

        return view('livewire.tools-list', [
            'tools' => $tools,
            'categories' => $categories,
        ]);
    }
}
