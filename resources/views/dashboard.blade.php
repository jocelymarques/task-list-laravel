<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Minhas Listas
        </h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto">
        <form method="POST" action="{{ route('listsweb.store') }}">
            @csrf
            <input
                type="text"
                name="title"
                placeholder="Nova lista"
                class="border rounded p-2 w-full"
                required
            >
            <button class="mt-2 px-4 py-2 bg-blue-600 text-white rounded">
                Criar Lista
            </button>
        </form>

        <ul class="mt-6 space-y-2">
            @foreach($lists as $list)
                <li x-data="{ editing: false }" class="border p-3 rounded flex justify-between items-center">
                    <template x-if="!editing">
                        <div class="flex-grow">
                            <a href="{{ route('listsweb.show', $list) }}" class="font-semibold">
                                {{ $list->title }}
                            </a>
                        </div>
                    </template>

                    <template x-if="editing">
                        <form method="POST" action="{{ route('listsweb.update', $list) }}" class="flex-grow">
                            @csrf
                            @method('PATCH')
                            <input
                                type="text"
                                name="title"
                                value="{{ $list->title }}"
                                class="border-gray-300 rounded-md shadow-sm"
                                @keydown.enter.prevent="$el.closest('form').submit()"
                                x-ref="input"
                                x-init="$nextTick(() => $refs.input.focus())"
                            >
                        </form>
                    </template>

                    <div class="flex gap-2 ml-4">
                        <button @click="editing = !editing" class="text-sm text-blue-600">
                            <span x-show="!editing">Editar</span>
                            <span x-show="editing">Cancelar</span>
                        </button>
                        <form method="POST" action="{{ route('listsweb.destroy', $list) }}">
                            @csrf
                            @method('DELETE')
                            <button class="text-sm text-red-600">Excluir</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</x-app-layout>