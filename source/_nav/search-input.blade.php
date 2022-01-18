<button title="Start searching" type="button" class="flex md:hidden bg-gray-100 hover:bg-blue-100 justify-center items-center border border-gray-500 rounded-full focus:outline-none h-10 px-3"
    onclick="searchInput.toggle()">
    <svg class="h-4 w-4 max-w-none" viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" alt="search icon">
        <defs></defs>
        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <g transform="translate(-829.000000, -42.000000)" fill="#748294" fill-rule="nonzero">
                <path
                    d="M843.319857,54.9056439 L848.707107,60.2928932 C849.097631,60.6834175 849.097631,61.3165825 848.707107,61.7071068 C848.316582,62.0976311 847.683418,62.0976311 847.292893,61.7071068 L841.905644,56.3198574 C840.55096,57.3729184 838.848711,58 837,58 C832.581722,58 829,54.418278 829,50 C829,45.581722 832.581722,42 837,42 C841.418278,42 845,45.581722 845,50 C845,51.8487115 844.372918,53.5509601 843.319857,54.9056439 Z M837,56 C840.313708,56 843,53.3137085 843,50 C843,46.6862915 840.313708,44 837,44 C833.686292,44 831,46.6862915 831,50 C831,53.3137085 833.686292,56 837,56 Z"
                    id="Mask"></path>
            </g>
        </g>
    </svg>
</button>

<div id="js-search-input" class="docsearch-input__wrapper hidden md:block">
    <label for="search" class="hidden">Search</label>

    <input id="docsearch-input"
        class="docsearch-input relative block h-10 transition-fast w-full lg:w-2/3 bg-gray-100 outline-none rounded-full text-gray-700 border border-gray-500 focus:border-blue-400 ml-auto px-4 pb-0"
        name="docsearch" type="text" placeholder="Search">

    <button class="md:hidden absolute pin-t pin-r h-full font-light text-3xl text-blue-500 hover:text-blue-600 focus:outline-none -mt-px pr-7" onclick="searchInput.toggle()">&times;</button>
</div>

@push('scripts')
    @if ($page->docsearchApiKey && $page->docsearchIndexName)
        <script type="text/javascript">
            docsearch({
                apiKey: '{{ $page->docsearchApiKey }}',
                indexName: '{{ $page->docsearchIndexName }}',
                appId: '{{ $page->docsearchAppId }}',
                inputSelector: '#docsearch-input',
                debug: false // Set debug to true if you want to inspect the dropdown
            });

            const searchInput = {
                toggle() {
                    const menu = document.getElementById('js-search-input');
                    menu.classList.toggle('hidden');
                    menu.classList.toggle('md:block');
                    document.getElementById('docsearch-input').focus();
                },
            }
        </script>
    @endif
@endpush
