<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Eventos') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
    @if ($errors->any())
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div
                class="rounded-md bg-red-100 border border-red-300 text-red-800 px-4 py-3 mb-5 text-sm shadow-sm"
                id="alert-pop-up"
            >
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
    
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h3 class="text-lg font-bold mb-4">Cadastrar Evento</h3>

            <form method="POST" action="{{ route('eventos.store') }}">
                @csrf

                <!-- Nome do Evento -->
                <div class="mb-4">
                    <label for="nome" class="block text-sm font-medium text-gray-700">Nome</label>
                    <input type="text" name="nome" id="nome" required
                        value="{{ old('nome') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Data de Inscrição -->
                    <div class="mb-4">
                        <label for="data_inscricao" class="block text-sm font-medium text-gray-700">Data de Inscrição</label>
                        <input type="datetime-local" name="data_inscricao" id="data_inscricao" required
                            value="{{ old('data_inscricao') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    <!-- Data de Início -->
                    <div class="mb-4">
                        <label for="data_inicio" class="block text-sm font-medium text-gray-700">Data de Início</label>
                        <input type="datetime-local" name="data_inicio" id="data_inicio" required
                            value="{{ old('data_inicio') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    <!-- Data de Fim -->
                    <div class="mb-4">
                        <label for="data_fim" class="block text-sm font-medium text-gray-700">Data de Fim</label>
                        <input type="datetime-local" name="data_fim" id="data_fim" required
                            value="{{ old('data_fim') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                </div>

                <!-- Local -->
                <div class="mb-4">
                    <label for="local" class="block text-sm font-medium text-gray-700">Local</label>
                    <input type="text" name="local" id="local" required
                        value="{{ old('local') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <!-- Descrição -->
                <div class="mb-4">
                    <label for="descricao" class="block text-sm font-medium text-gray-700">Descrição</label>
                    <textarea name="descricao" id="descricao" rows="3"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('descricao') }}</textarea>
                </div>

                <div class="flex justify-end gap-4">
                    <a href="{{ route('eventos.index') }}"
                        class="bg-slate-600 text-white px-4 py-2 rounded-md hover:bg-slate-700 transition">
                        Voltar
                    </a>

                    <button type="submit"
                        class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition">
                        Salvar Evento
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

</x-app-layout>
