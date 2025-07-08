<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Eventos') }}
            </h2>

            <a href="{{ route('eventos.create') }}"
               class="inline-block bg-green-600 text-white px-4 py-2 rounded-md shadow hover:bg-green-700 transition">
                Criar
            </a>
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
                @if ($eventos->isEmpty())
                    <p class="text-gray-600">Nenhum evento cadastrado.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-left text-sm text-gray-700">
                            <thead class="border-b font-medium text-gray-900">
                                <tr>
                                    <th class="px-4 py-3">Nome</th>
                                    <th class="px-4 py-3">Inscrição</th>
                                    <th class="px-4 py-3">Início</th>
                                    <th class="px-4 py-3">Fim</th>
                                    <th class="px-4 py-3">Local</th>
                                    <th class="px-4 py-3 text-right">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($eventos as $evento)
                                    <tr class="border-t hover:bg-gray-50">
                                        <td class="px-4 py-2">{{ $evento->nome }}</td>
                                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($evento->data_inscricao)->format('d/m/Y H:i') }}</td>
                                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($evento->data_inicio)->format('d/m/Y H:i') }}</td>
                                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($evento->data_fim)->format('d/m/Y H:i') }}</td>
                                        <td class="px-4 py-2">{{ $evento->local }}</td>
                                        <td class="px-4 py-2 flex justify-end gap-2">
                                            <a href="{{ route('eventos.edit', $evento->id) }}" class="text-yellow-600 hover:underline text-sm">Editar</a>

                                            <!-- Excluir com Modal -->
                                            <div x-data="{ open: false }" class="relative">
                                                <button @click="open = true" class="text-red-600 hover:underline text-sm">
                                                    Excluir
                                                </button>

                                                <!-- Modal -->
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
                                                        <h2 class="text-lg font-bold text-gray-800 mb-4">Confirmar Exclusão</h2>
                                                        <p class="text-sm text-gray-600 mb-6">
                                                            Tem certeza que deseja excluir o evento <strong>{{ $evento->nome }}</strong>?
                                                        </p>
                                                        <div class="flex justify-end gap-3">
                                                            <button @click="open = false" type="button"
                                                                    class="px-4 py-2 text-sm text-gray-600 rounded-md hover:bg-gray-100">
                                                                Cancelar
                                                            </button>

                                                            <form action="{{ route('eventos.destroy', $evento->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                        class="px-4 py-2 bg-red-600 text-white text-sm rounded-md hover:bg-red-700">
                                                                    Confirmar
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Fim Modal -->
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
