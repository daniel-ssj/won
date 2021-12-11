@extends('base')

@section('main')
    <div class="container mx-auto">
        @if (session('success'))
            <div class="text-green-500" role="alert">
                {{ session('success') }}
            </div>
        @endif
    </div>
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
        <div class="flex-1 font-bold text-lg text-gray-700">
            {{ $account->name }}
        </div>
        <div class="flex-1 font-bold text-lg text-gray-700">
            R${{ $account->balance }}
        </div>
        <div class="flex-1 text-gray-700">
            <a href="{{ url('accounts/' . $account->id . '/add-transaction/?inc=0') }}" class="text-red-500">Adicionar
                gasto</a> | <a href="{{ url('accounts/' . $account->id . '/add-transaction/?inc=1') }}"
                class="text-green-500">Adicionar
                entrada</a>
        </div>
    </div>
    <div class="container mx-auto">
        <h1 class="text-pink-500 text-2xl font-bold">Histórico</h1>
    </div>
    @foreach ($transactions as $t)
        <div class="container flex justify-around items-center bg-white p-5 mt-6 mx-auto">
            <span>Category:&nbsp;</span>
            <div class="flex-1 font-bold text-lg text-gray-700">
                {{ $t->category }}
            </div>
            @if ($t->isIncome)
                <div class="flex-1 font-bold text-lg text-green-500">
                    +R${{ $t->amount }}
                </div>
            @else
                <div class="flex-1 font-bold text-lg text-red-500">
                    -R${{ $t->amount }}
                </div>
            @endif
            <div class="flex-1 font-italic text-lg">
                {{ $t->created_at->toDateTimeString() }}
            </div>
        </div>
    @endforeach
    <div class="container mx-auto">
        {{ $transactions->links() }}
    </div>
@endsection
