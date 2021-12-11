@extends('base')

@section('main')
    <div class="container flex flex-col justify-start mt-8 mx-auto">
        <div class="bg-white lg:w-1/3 p-5">
            @if (session('success'))
                <div class="alert alert-success mb-2" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <form method="POST" action="{{ route('addTransactionDone') }}">
                @csrf
                <label class="block mt-2" for="category">
                    <span class="text-gray-700">Categoria</span>
                    <input
                        class="mt-1 block w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                        type="text" step="0.01" name="category" placeholder="Categoria">
                </label>
                @error('category')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
                <label class="block" for="amount">
                    <span class="text-gray-700">Valor</span>
                    <input
                        class="mt-1 block w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                        type="number" name="amount" placeholder="Valor">
                </label>
                @error('amount')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror<br />
                <input type="hidden" name="account_id" value="{{ $id }}">
                <input type="hidden" name="is_income" value="{{ $isIncome }}">
                <button type="submit"
                    class="p-2 mt-2 w-1/5 bg-pink-500 text-white rounded-lg border border-gray-300 hover:bg-pink-700">Adicionar
                    transação
                </button>
            </form>
        </div>
    </div>
@endsection
