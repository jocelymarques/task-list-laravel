<x-app-layout>
    <x-slot name="header">
        <form method="POST" action="{{ route('listsweb.update', $list) }}" class="flex items-center">
            @csrf
            @method('PATCH')
            <input
                type="text"
                name="title"
                value="{{ $list->title }}"
                class="text-xl font-semibold border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
            >
            <button class="ml-4 bg-blue-600 text-white px-4 py-2 rounded">
                Atualizar Título
            </button>
        </form>
    </x-slot>

    <div class="max-w-3xl mx-auto py-6">
        <form method="POST" action="{{ route('tasksweb.store') }}">
            @csrf
            <input type="hidden" name="task_list_id" value="{{ $list->id }}">

            <input
                type="text"
                name="title"
                placeholder="Nova tarefa"
                class="border p-2 w-full"
                required
            >

            <button class="mt-2 bg-green-600 text-white px-4 py-2 rounded">
                Adicionar
            </button>
        </form>

        <ul class="mt-6 space-y-2">
            @foreach($list->tasks as $task)
                <li x-data="{ editing: false }" class="flex justify-between items-center border p-2 rounded">
                    <template x-if="!editing">
                        <div class="flex-grow">
                            <form method="POST" action="{{ route('tasksweb.update', $task) }}" class="inline">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="completed" value="{{ $task->completed ? '0' : '1' }}">
                                <button type="submit" @class(['line-through' => $task->completed])>
                                    {{ $task->title }}
                                </button>
                            </form>
                        </div>
                    </template>

                    <template x-if="editing">
                        <form method="POST" action="{{ route('tasksweb.update', $task) }}" class="flex-grow">
                            @csrf
                            @method('PATCH')
                            <input type="text" name="title" value="{{ $task->title }}" class="border-gray-300 rounded-md shadow-sm" @keydown.enter.prevent="$el.closest('form').submit()" x-ref="input" x-init="$nextTick(() => $refs.input.focus())">
                            <button type="button" @click="editing = false" class="text-sm text-gray-600 ml-2">Cancelar</button>
                        </form>
                    </template>

                    <div class="flex gap-2 ml-4">
                        <button @click="editing = !editing" class="text-sm text-blue-600">Editar</button>

                        <form method="POST" action="{{ route('tasksweb.destroy', $task) }}">
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
