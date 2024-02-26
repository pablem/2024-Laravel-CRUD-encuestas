<section class="space-y-6">

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-deletion')"
    >{{ __('Borrar Encuesta') }}</x-danger-button>

    <x-modal name="confirm-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('encuestas.destroy', $encuesta) }}" class="p-6">
            @csrf
            @method('delete')
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Quieres borrar la encuesta?') }}
            </h2>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancelar') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('Borrar Encuesta') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
