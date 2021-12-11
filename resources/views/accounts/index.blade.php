@extends('base')

@section('main')
    <div class="container flex flex-col justify-start mt-8 mx-auto">
        <div class="bg-white lg:w-1/3 p-5">
            @if (session('success'))
                <div class="alert alert-success mb-2" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <form method="POST" action="{{ route('addAccount') }}">
                @csrf
                <label class="block" for="account_name">
                    <span class="text-gray-700">Nome da conta</span>
                    <input
                        class="mt-1 block w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                        name="account_name" placeholder="Conta">
                </label>
                @error('account_name')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
                <label class="block" for="balance_amount">
                    <span class="text-gray-700">Saldo inicial</span>
                    <input
                        class="mt-1 block w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-200"
                        type="number" step="0.01" name="balance_amount" placeholder="Saldo">
                </label>
                @error('balance_amount')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror<br />
                <button type="submit"
                    class="p-2 mt-2 w-1/3 bg-pink-500 text-white rounded-lg border border-gray-300 hover:bg-pink-700">Criar
                    conta
                </button>
            </form>
        </div>
    </div>
    @foreach ($accounts as $a)
        <a href="{{ url('accounts/detail/' . $a->id) }}">

            <div class="container flex justify-around items-center bg-white p-5 mt-6 mx-auto">
                <div
                    class="
                    p-3
                    mr-4
                    text-green-500
                    bg-green-100
                    rounded-full
                  ">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="flex-auto font-bold text-lg text-gray-700">
                    {{ $a->name }}
                </div>
                <div class="flex-auto font-bold text-lg text-gray-700">
                    R${{ $a->balance }}
                </div>
            </div>
        </a>
    @endforeach
@endsection
