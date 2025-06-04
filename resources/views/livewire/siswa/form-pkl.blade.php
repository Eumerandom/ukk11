<div>
    <form wire:submit.prevent="create" id="pklForm">
        {{ $this->form }}

        <button type="submit"
            class="inline-block font-medium rounded-lg text-sm px-5 py-2.5 mt-2 me-2 mb-2 text-white bg-green-600 hover:bg-green-700 border border-gray-200 shadow-sm dark:bg-green-700 dark:hover:bg-green-800 dark:border-green-700 focus:outline-none">
            Submit            
        </button>
    </form>

    <x-filament-actions::modals />

    @if ($errors->any())
    <div class="mt-4 p-4 text-red-500 bg-red-100 rounded-lg">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- <script>
        document.getElementById('pklForm').addEventListener('submit', function(e) {
            document.querySelector('[data-modal-hide="authentication-modal"]').click();
        });
    </script> -->
</div>
