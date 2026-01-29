<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 shadow-xl sm:rounded-lg">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Add New Product</h2>

                {{-- Display Validation Errors --}}
                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-50 border-l-4 border-red-500 text-red-700">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Name --}}
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Product Name</label>
                            <input type="text" name="name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-amber-500 focus:border-amber-500">
                        </div>

                        {{-- Category --}}
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Category</label>
                            <select name="category_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Price --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Price ($)</label>
                        <input type="number" step="0.01" name="price" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>

                    {{-- Description --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                    </div>

                    {{-- Image --}}
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700">Product Image</label>
                        <input type="file" name="image" required class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100">
                    </div>

                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200">Cancel</a>
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-amber-600 rounded-md hover:bg-amber-700">
                            Create Product
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>