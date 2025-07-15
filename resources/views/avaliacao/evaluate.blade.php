<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Avaliações') }}
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
            <h3 class="text-lg font-bold mb-4">Avaliar Trabalho</h3>

            <form method="POST" action="{{ route('avaliacoes.store', $trabalho->id) }}">
                @csrf

                <div class="mb-4">
                    <label for="nota" class="block text-sm font-medium text-gray-700">Nota</label>
                    <input type="number" name="nota" id="nota" required
                        value="{{ old('nota') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <div class="mb-4">
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" id="status" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Selecione o Status</option>
                        <option value="aprovado" {{ old('status') == 'aprovado' ? 'selected' : '' }}>Aprovado</option>
                        <option value="rejeitado" {{ old('status') == 'rejeitado' ? 'selected' : '' }}>Rejeitado</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="descricao" class="block text-sm font-medium text-gray-700">Descrição</label>
                    <textarea name="descricao" id="descricao" rows="3"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('descricao') }}</textarea>
                </div>

                <div class="flex justify-end gap-4">
                    <a href="{{ route('eventos.public') }}"
                        class="bg-slate-600 text-white px-4 py-2 rounded-md hover:bg-slate-700 transition">
                        Voltar
                    </a>

                    <button type="submit"
                        class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition">
                        Salvar Trabalho
                    </button>
                </div>  
            </form>
        </div>
    </div>
</div>

</x-app-layout>
