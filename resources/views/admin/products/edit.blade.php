<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 shadow-xl sm:rounded-lg">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Edit Product: {{ $product->name }}</h2>
                    <a href="{{ route('products.index') }}" class="text-gray-600 hover:text-gray-900">
                        <i class="fas fa-arrow-left"></i> Cancel
                    </a>
                </div>

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-50 border-l-4 border-red-500 text-red-700">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Product Name</label>
                            <input type="text" name="name" value="{{ old('name', $product->name) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Category</label>
                            <select name="category_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Price ($)</label>
                        <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">{{ old('description', $product->description) }}</textarea>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700">Current Image</label>
                        @if($product->image)
                            <img src="{{ asset($product->image) }}" alt="Current Image" class="h-32 w-auto object-cover rounded mb-2 border">
                        @else
                            <p class="text-sm text-gray-500 italic">No image uploaded</p>
                        @endif

                        <label class="block text-sm font-medium text-gray-700 mt-4">Change Image (Optional)</label>
                        <input type="file" name="image" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100">
                    </div>

                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('products.index') }}" class="px-4 py-2 text-sm text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200">Cancel</a>
                        <button type="submit" class="px-4 py-2 text-sm text-white bg-amber-600 rounded-md hover:bg-amber-700 shadow-md">
                            Update Product
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
