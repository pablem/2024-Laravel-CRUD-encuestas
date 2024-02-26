<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mis Encuestas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <table class="table-auto w-full text-gray-900 dark:text-gray-100">
                    <thead class="text-lg font-medium">
                        <tr>
                            <th class="px-4 py-2">{{ __('Título') }}</th>
                            <th class="px-4 py-2">{{ __('Estado') }}</th>
                            <th class="px-4 py-2">{{ __('Creador') }}</th>
                            <th class="px-4 py-2">{{ __('Última modificación') }}</th>
                            <th class="px-4 py-2">{{ __('Acciones') }}</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm divide-y divide-gray-100">
                        @forelse ($encuestas as $encuesta)
                            <tr>
                                <td class="border px-4 py-2">{{ $encuesta->titulo_encuesta }}</td>
                                <td class="border px-4 py-2">{{ $encuesta->estado }}</td>
                                <td class="border px-4 py-2">{{ $encuesta->user->name }}</td>
                                <td class="border px-4 py-2">{{ $encuesta->updated_at }}</td>
                                <td class="border px-4 py-2" style="width: 260px">
                                    <a href="{{ route('encuestas.edit', $encuesta) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">{{ __('Editar') }}</a>
                                    <!-- <form action="{{ route('encuestas.destroy', $encuesta) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">{{ __('Eliminar') }}</button>
                                    </form> -->
                                    <x-danger-button
                                        x-data=""
                                        x-on:click.prevent="$dispatch('open-modal', 'confirm-deletion')"
                                    >{{ __('Borrar') }}</x-danger-button>
                                </td>
                            </tr>
                            @empty
                            <tr class="text-center">
                                <td colspan="3" class="border px-4 py-2">{{ __('No hay encuestas para mostrar') }}</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
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
</x-app-layout>
