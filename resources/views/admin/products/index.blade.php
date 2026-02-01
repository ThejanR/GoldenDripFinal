<x-app-layout>
    <div class="min-h-screen bg-gray-50">
        <!-- Admin Header -->
        <div class="bg-white shadow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-6">
                    <div class="flex items-center">
                        <a href="{{ route('admin.dashboard') }}" class="text-amber-600 hover:text-amber-500 mr-4">
                            <i class="fas fa-arrow-left"></i> Back to Dashboard
                        </a>
                        <h1 class="text-2xl font-bold text-gray-900">Products Management (API Driven)</h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('products.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-amber-600 hover:bg-amber-700">
                            <i class="fas fa-plus mr-2"></i>
                            Add Product
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Search and Filter (Frontend Only for now or wired to API parameters) -->
            <div class="bg-white shadow rounded-lg mb-6">
                <div class="px-4 py-5 sm:p-6">
                    <div class="flex flex-col sm:flex-row gap-4">
                        <div class="flex-1">
                            <input type="text" id="searchInput" placeholder="Search products..." class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                        </div>
                        <button onclick="fetchProducts()" class="px-4 py-2 bg-amber-600 text-white rounded-md hover:bg-amber-700">
                            <i class="fas fa-search mr-2"></i>Search
                        </button>
                    </div>
                </div>
            </div>

            <!-- Success Message Placeholder -->
            <div id="successMessage" class="hidden mb-6 bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm"></div>

            <!-- Products Table -->
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <div class="px-4 py-5 sm:p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="productTableBody" class="bg-white divide-y divide-gray-200">
                                <!-- Rows will be populated by JS -->
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">Loading products via API...</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-lg shadow-xl p-6 w-96 transform transition-all scale-100">
            <div class="text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-4">
                    <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">Delete Product</h3>
                <p class="text-gray-500 text-sm mb-6">Are you sure you want to delete this product? This action cannot be undone.</p>
                <div class="flex justify-center space-x-3">
                    <button onclick="closeDeleteModal()" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 transition font-medium">Cancel</button>
                    <button onclick="executeDelete()" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition font-medium shadow-sm">Yes, Delete It</button>
                </div>
            </div>
        </div>
    </div>

    <!-- API Logic -->
    <script>
        const API_TOKEN = "{{ $apiToken }}";
        const API_URL = "/api/products";
        const EDIT_URL_BASE = "/admin/products"; // Helper to build edit link
        
        // State for deletion
        let deleteTargetId = null;

        document.addEventListener('DOMContentLoaded', () => {
            fetchProducts();
        });

        async function fetchProducts() {
            const tableBody = document.getElementById('productTableBody');
            const search = document.getElementById('searchInput').value;
            
            try {
                const response = await axios.get(API_URL, {
                    headers: {
                        'Authorization': `Bearer ${API_TOKEN}`,
                        'Accept': 'application/json'
                    }
                });

                const data = response.data;
                const products = data.data || data; 

                renderTable(products);
            } catch (error) {
                console.error(error);
                tableBody.innerHTML = `<tr><td colspan="5" class="px-6 py-4 text-center text-red-500">Error loading products. Check console.</td></tr>`;
            }
        }

        function renderTable(products) {
            const tableBody = document.getElementById('productTableBody');
            tableBody.innerHTML = '';

            if (products.length === 0) {
                tableBody.innerHTML = `<tr><td colspan="5" class="px-6 py-4 text-center text-gray-500">No products found</td></tr>`;
                return;
            }

                products.forEach(product => {
                const row = `
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                             ${product.image ? 
                                `<img src="${product.image}" class="h-12 w-12 object-cover rounded">` : 
                                `<div class="h-12 w-12 bg-gray-200 rounded flex items-center justify-center text-gray-400"><i class="fas fa-camera"></i></div>`
                            }
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">${product.name}</div>
                            <div class="text-sm text-gray-500 w-48 truncate">${product.description || ''}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            ${product.category || 'N/A'}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            $${parseFloat(product.price).toFixed(2)}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="${EDIT_URL_BASE}/${product.id}/edit" class="text-amber-600 hover:text-amber-900 mr-3">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <button onclick="openDeleteModal(${product.id})" class="text-red-600 hover:text-red-900">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </td>
                    </tr>
                `;
                tableBody.insertAdjacentHTML('beforeend', row);
            });
        }

        // --- New Modal Logic ---

        function openDeleteModal(id) {
            deleteTargetId = id;
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            deleteTargetId = null;
            document.getElementById('deleteModal').classList.add('hidden');
        }

        async function executeDelete() {
            if (!deleteTargetId) return;

            try {
                await axios.delete(`${API_URL}/${deleteTargetId}`, {
                    headers: {
                        'Authorization': `Bearer ${API_TOKEN}`,
                        'Accept': 'application/json'
                    }
                });

                showSuccess('Product deleted successfully');
                closeDeleteModal();
                fetchProducts(); // Refresh table
            } catch (error) {
                console.error(error);
                closeDeleteModal();
                alert('Failed to delete product. Check console for details.');
            }
        }

        function showSuccess(msg) {
            const el = document.getElementById('successMessage');
            el.innerText = msg;
            el.classList.remove('hidden');
            setTimeout(() => el.classList.add('hidden'), 3000);
        }
    </script>
</x-app-layout>
