<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Professores') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        @if (session('success'))
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    id="alert-pop-up"
                    class="rounded-md bg-green-100 border border-green-300 text-green-800 px-4 py-3 mb-5 text-sm shadow-sm"
                >
                    {{ session('success') }}
                </div>
            </div>
        @endif

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg px-6 py-5">
                @if ($professores->isEmpty())
                    <p class="text-gray-600">Nenhum professor cadastrado.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-left text-sm text-gray-700">
                            <thead class="border-b font-medium text-gray-900">
                                <tr>
                                    <th class="px-4 py-3">Siape</th>
                                    <th class="px-4 py-3">Nome</th>
                                    <th class="px-4 py-3">Email</th>
                                    <th class="px-4 py-3">Permissão</th>
                                    <th class="px-4 py-3 text-right">Pode avaliar?</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($professores as $professor)
                                    <tr class="border-t hover:bg-gray-50">
                                        <td class="px-4 py-2">{{ $professor->siape }}</td>
                                        <td class="px-4 py-2">{{ $professor->user->name }}</td>
                                        <td class="px-4 py-2">{{ $professor->user->email }}</td>
                                        <td class="px-4 py-2">
                                            @if ($professor->pode_avaliar)
                                                <span class="font-bold">Avaliador</span>
                                            @else
                                                <span>Básica</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-2 flex justify-end gap-2">
                                            @if (!$professor->pode_avaliar)
                                                <div x-data="{ open: false }" class="relative">
                                                    <button @click="open = true" class="bg-gray-200 rounded w-20 p-1 text-blue-600 hover:underline text-sm">
                                                        Pode
                                                    </button>

                                                    <div
                                                        x-show="open"
                                                        x-cloak
                                                        x-transition:enter="transition ease-out duration-300"
                                                        x-transition:enter-start="opacity-0"
                                                        x-transition:enter-end="opacity-100"
                                                        x-transition:leave="transition ease-in duration-200"
                                                        x-transition:leave-start="opacity-100"
                                                        x-transition:leave-end="opacity-0"
                                                        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
                                                    >
                                                        <div @click.away="open = false" class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
                                                            <h2 class="text-lg font-bold text-gray-800 mb-4">Confirmar Adição</h2>
                                                            <p class="text-sm text-gray-600 mb-6">
                                                                Tem certeza que deseja adicionar a permissão do professor de avaliar<strong>{{ $professor->user->name }}</strong>?
                                                            </p>
                                                            <div class="flex justify-end gap-3">
                                                                <button @click="open = false" type="button"
                                                                        class="px-4 py-2 text-sm text-gray-600 rounded-md hover:bg-gray-100">
                                                                    Cancelar
                                                                </button>

                                                                <form action="{{ route('admin.professores.patch', $professor) }}" method="POST">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                    <button type="submit"
                                                                            class="px-4 py-2 bg-blue-600 text-white text-sm rounded-md hover:bg-blue-700">
                                                                        Confirmar
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            @else
                                                <div x-data="{ open: false }" class="relative">
                                                    <button @click="open = true" class="bg-red-200 rounded w-20 p-2 text-red-600 hover:underline text-sm">
                                                        Não Pode
                                                    </button>

                                                    <div
                                                        x-show="open"
                                                        x-cloak
                                                        x-transition:enter="transition ease-out duration-300"
                                                        x-transition:enter-start="opacity-0"
                                                        x-transition:enter-end="opacity-100"
                                                        x-transition:leave="transition ease-in duration-200"
                                                        x-transition:leave-start="opacity-100"
                                                        x-transition:leave-end="opacity-0"
                                                        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
                                                    >
                                                        <div @click.away="open = false" class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
                                                            <h2 class="text-lg font-bold text-gray-800 mb-4">Confirmar Remoção</h2>
                                                            <p class="text-sm text-gray-600 mb-6">
                                                                Tem certeza que deseja remover a permissão do professor de avaliar<strong>{{ $professor->user->name }}</strong>?
                                                            </p>
                                                            <div class="flex justify-end gap-3">
                                                                <button @click="open = false" type="button"
                                                                        class="px-4 py-2 text-sm text-gray-600 rounded-md hover:bg-gray-100">
                                                                    Cancelar
                                                                </button>

                                                                <form action="{{ route('admin.professores.patch', $professor) }}" method="POST">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                    <button type="submit"
                                                                            class="px-4 py-2 bg-red-600 text-white text-sm rounded-md hover:bg-red-700">
                                                                        Confirmar
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
