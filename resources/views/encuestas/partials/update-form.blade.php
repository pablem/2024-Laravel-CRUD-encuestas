<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Información de la encuesta') }}
        </h2>
    </header>

    <form method="post" action="{{ route('encuestas.update', $encuesta) }}" class="mt-6 space-y-6">
        @csrf
        @method('put')        
        <div>
            <x-input-label for="titulo_encuesta" :value="__('Título de la encuesta')" />
            <x-text-input id="titulo_encuesta" name="titulo_encuesta" type="text" class="mt-1 block w-full" :value="old('titulo_encuesta', $encuesta->titulo_encuesta)" required autofocus autocomplete="titulo_encuesta" />
            <x-input-error class="mt-2" :messages="$errors->get('titulo_encuesta')" />
        </div>
        
        <div>
            <x-input-label for="descripcion" :value="__('Descripción')" />
            <textarea id="descripcion" name="descripcion" class="mt-1 block w-full resize-none h-16" autofocus autocomplete="descripcion">{{ old('descripcion', $encuesta->descripcion) }}</textarea>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Guardar') }}</x-primary-button>
        </div>
    </form>
</section>
