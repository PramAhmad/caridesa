<div class="document-status-wrapper">
    <div class="flex items-center justify-center space-x-1">
        @if($getRecord()->ktp)
            <div class="relative group">
                <button onclick="previewDocument('{{ $getRecord()->ktp_url }}', 'KTP', '{{ $getRecord()->nama }}')"
                        class="flex items-center justify-center w-8 h-8 text-white bg-green-500 rounded-full hover:bg-green-600 transition-colors"
                        title="Preview KTP">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V4a2 2 0 012-2h2a2 2 0 012 2v2m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V4a2 2 0 00-2-2h-2a2 2 0 00-2 2v2"></path>
                    </svg>
                </button>
                <div class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 px-2 py-1 text-xs text-white bg-black rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">
                    KTP
                </div>
            </div>
        @else
            <div class="flex items-center justify-center w-8 h-8 text-gray-400 bg-gray-200 rounded-full" title="KTP tidak tersedia">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </div>
        @endif

        @if($getRecord()->surat_desa)
            <div class="relative group">
                <button onclick="previewDocument('{{ $getRecord()->surat_desa_url }}', 'Surat Desa', '{{ $getRecord()->nama }}')"
                        class="flex items-center justify-center w-8 h-8 text-white bg-blue-500 rounded-full hover:bg-blue-600 transition-colors"
                        title="Preview Surat Desa">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </button>
                <div class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 px-2 py-1 text-xs text-white bg-black rounded opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">
                    Surat Desa
                </div>
            </div>
        @else
            <div class="flex items-center justify-center w-8 h-8 text-gray-400 bg-gray-200 rounded-full" title="Surat Desa tidak tersedia">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </div>
        @endif
    </div>

    <script>
    function previewDocument(url, type, name) {
        if (!url) return;
        
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