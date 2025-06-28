<div class="document-preview-container">
    <div class="border border-gray-300 rounded-lg p-4 bg-gray-50">
        <div class="flex items-center justify-between mb-3">
            <h4 class="text-sm font-semibold text-gray-900">{{ $document_type }}</h4>
            @if($document_url)
                <div class="flex items-center space-x-2">
                    <a href="{{ $document_url }}" 
                       target="_blank" 
                       class="inline-flex items-center px-3 py-1 text-xs font-medium text-blue-700 bg-blue-100 rounded-full hover:bg-blue-200 transition-colors">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                        </svg>
                        Buka
                    </a>
                    <button onclick="previewDocument('{{ $document_url }}', '{{ $document_type }}', '{{ $tenant_name }}')"
                            class="inline-flex items-center px-3 py-1 text-xs font-medium text-green-700 bg-green-100 rounded-full hover:bg-green-200 transition-colors">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        Preview
                    </button>
                </div>
            @endif
        </div>

        @if($document_url)
            <div class="text-center bg-white rounded border-2 border-dashed border-gray-300 p-6">
                @if(Str::contains($document_file, ['.jpg', '.jpeg', '.png']))
                    <img src="{{ $document_url }}" 
                         alt="{{ $document_type }}" 
                         class="max-w-full max-h-48 mx-auto rounded shadow cursor-pointer"
                         onclick="previewDocument('{{ $document_url }}', '{{ $document_type }}', '{{ $tenant_name }}')">
                @else
                    <div class="flex flex-col items-center">
                        <svg class="w-16 h-16 text-red-500 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                        <p class="text-sm text-gray-600 mb-2">{{ $document_file }}</p>
                        <p class="text-xs text-gray-500">File PDF - Klik Preview untuk melihat</p>
                    </div>
                @endif
            </div>
        @else
            <div class="text-center py-4">
                <p class="text-sm text-gray-500">Dokumen tidak tersedia</p>
            </div>
        @endif
    </div>

    <script>
    function previewDocument(url, type, name) {
        // Create modal for document preview
        const modal = document.createElement('div');
        modal.className = 'fixed inset-0 z-50 overflow-y-auto';
        modal.innerHTML = `
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" onclick="closePreview()"></div>
                <div class="inline-block w-full max-w-6xl my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl rounded-lg">
                    <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900">${type} - ${name}</h3>
                        <button onclick="closePreview()" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="px-6 py-4" style="height: 80vh;">
                        ${url.includes('.pdf') ? 
                            `<iframe src="${url}" class="w-full h-full border-0 rounded"></iframe>` :
                            `<img src="${url}" alt="${type}" class="max-w-full max-h-full mx-auto object-contain">`
                        }
                    </div>
                    <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                        <div class="flex justify-between">
                            <a href="${url}" target="_blank" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-700">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Download
                            </a>
                            <button onclick="closePreview()" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                                Tutup
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        document.body.appendChild(modal);
    }

    function closePreview() {
        const modal = document.querySelector('.fixed.inset-0.z-50');
        if (modal) {
            modal.remove();
        }
    }
    </script>
</div>