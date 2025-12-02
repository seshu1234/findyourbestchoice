@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <h1 class="text-2xl font-semibold mb-4">Submit a Tool</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-2 rounded mb-4">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-2 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tools.store') }}" method="post" class="space-y-6">
        @csrf

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Tool Name</label>
                <input name="name" value="{{ old('name') }}" class="mt-1 block w-full border rounded px-3 py-2" required />
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Slug (optional)</label>
                <input name="slug" value="{{ old('slug') }}" class="mt-1 block w-full border rounded px-3 py-2" />
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Category ID</label>
            <input name="category_id" value="{{ old('category_id') }}" class="mt-1 block w-full border rounded px-3 py-2" />
            <p class="text-xs text-gray-500 mt-1">Enter category id (use admin to manage categories)</p>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Logo URL</label>
                <input name="logo_url" value="{{ old('logo_url') }}" class="mt-1 block w-full border rounded px-3 py-2" />
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Images (comma-separated or JSON)</label>
                <input name="images" value="{{ old('images') }}" class="mt-1 block w-full border rounded px-3 py-2" />
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Short Description</label>
            <textarea name="short_description" rows="3" class="mt-1 block w-full border rounded px-3 py-2">{{ old('short_description') }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Full Description</label>
            <textarea name="description" rows="6" class="mt-1 block w-full border rounded px-3 py-2">{{ old('description') }}</textarea>
        </div>

        <div class="grid grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Starting Price</label>
                <input name="price_from" value="{{ old('price_from') }}" class="mt-1 block w-full border rounded px-3 py-2" />
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Affiliate URL</label>
                <input name="affiliate_url" value="{{ old('affiliate_url') }}" class="mt-1 block w-full border rounded px-3 py-2" />
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Official URL</label>
                <input name="official_url" value="{{ old('official_url') }}" class="mt-1 block w-full border rounded px-3 py-2" />
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Pros (comma-separated)</label>
                <input name="pros" value="{{ old('pros') }}" class="mt-1 block w-full border rounded px-3 py-2" />
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Cons (comma-separated)</label>
                <input name="cons" value="{{ old('cons') }}" class="mt-1 block w-full border rounded px-3 py-2" />
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Meta (JSON)</label>
            <input name="meta" value="{{ old('meta') }}" class="mt-1 block w-full border rounded px-3 py-2" />
        </div>

        <div class="pt-4">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Submit Tool</button>
        </div>
    </form>
</div>
@endsection
