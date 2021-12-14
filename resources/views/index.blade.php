@extends('base')

@section('main')
    <main class="h-full overflow-y-auto">
        <div class="container px-6 mx-auto grid">
            <h2
                class="
                my-6
                text-2xl
                font-semibold
                text-gray-700
              ">
                Olá, {{ Auth::user()->name }}
            </h2>
            <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
                @if ($accounts->isEmpty())
                    <a href="{{ url('accounts/all/') }}" class="text-blue-500">Criar conta</a>
                @endif
                @foreach ($accounts as $a)
                    <a href="{{ url('accounts/detail/' . $a->id) }}">
                        <div
                            class="
                  flex
                  items-center
                  p-4
                  bg-white
                  rounded-lg
                  shadow-xs
                ">
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
                            <div>
                                <p
                                    class="
                      mb-2
                      text-sm
                      font-medium
                      text-gray-600
                      dark:text-gray-400
                    ">
                                    {{ $a->name }}
                                </p>
                                <p
                                    class="
                      text-lg
                      font-semibold
                      text-gray-700
                    ">
                                    R${{ $a->balance }}
                                </p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="grid gap-6 mb-8 grid-cols-3">
                <div
                    class="
                  flex
                  items-center
                  p-5
                  bg-white
                  rounded-lg
                  shadow-xs
                ">
                    <h4 class="self-start mb-4 font-semibold text-pink-500">
                        Dashboard
                    </h4>
                    <div class="p-5 flex flex-col">
                        <p
                            class="
                      mb-2
                      text-sm
                      font-medium
                      text-gray-600
                    ">
                            Saldo total
                        </p>
                        <p
                            class="
                        text-lg
                        font-semibold
                        text-gray-700
                        ">
                            R${{ $total_balance }}
                        </p>
                    </div>
                    <div class="ml-5 p-5">
                        <p
                            class="
                      mb-2
                      text-sm
                      font-medium
                      text-gray-600
                    ">
                            Fluxo de dinheiro
                        </p>
                        <p
                            class="
                        text-lg
                        font-semibold
                        text-gray-700
                        ">
                            @if ($cash_flow > 0)
                                <span class="text-green-500">R${{ $cash_flow }}</span>
                            @else
                                <span class="text-red-500">R${{ $cash_flow }}</span>
                            @endif
                        </p>
                    </div>
                    <div class="ml-5 p-5">
                        <p
                            class="
                      mb-2
                      text-sm
                      font-medium
                      text-gray-600
                    ">
                            Gasto total
                        </p>
                        <p
                            class="
                        text-lg
                        font-semibold
                        text-gray-700
                        ">
                            <span class="text-red-500">R$-{{ $total_expenses }}</span>
                        </p>
                    </div>
                </div>
                <div
                    class="
                      flex
                      items-center
                      p-5
                      bg-white
                      rounded-lg
                      shadow-xs
                      ml-5
                    ">
                    <h4 class="self-start mb-4 font-semibold text-pink-500">
                        Histórico
                    </h4>
                    <div class="p-5">
                        @foreach ($_transactions as $t)
                            <p
                                class="
                            mb-2
                            text-sm
                            font-medium
                            text-gray-600
                            ">
                                {{ $t->category }}
                            </p>
                            @if ($t->isIncome)
                                <p
                                    class="
                            text-lg
                            font-semibold
                            text-green-500
                            ">
                                    +R${{ $t->amount }}
                                </p>
                            @else
                                <p
                                    class="
                            text-lg
                            font-semibold
                            text-red-500
                            ">
                                    -R${{ $t->amount }}
                                </p>
                            @endif
                            <hr class="p-2">
                        @endforeach
                    </div>
                </div>
                <div
                    class="
                  min-w-0
                  p-4
                  bg-white
                  rounded-lg
                  shadow-xs
                  dark:bg-gray-800
                ">
                    <h4 class="mb-4 font-semibold text-pink-500">
                        Gasto por categoria
                    </h4>
                    <div class="w-72 h-72">
                        <canvas id="pie"></canvas>
                    </div>
                    <script>
                        const ctx = document.getElementById('pie').getContext('2d');
                        const _data = @json($spending_by_categories)

                        let categories = []
                        let amounts = []

                        for (category of _data) {
                            for (category of category) {
                                categories.push(category.category)
                                amounts.push(category.amount)
                            }
                        }

                        const myChart = new Chart(ctx, {
                            type: 'doughnut',
                            responsive: true,
                            data: {
                                labels: categories,
                                datasets: [{
                                    label: 'Gastos por categoria',
                                    data: amounts,
                                    backgroundColor: [
                                        'rgb(255, 99, 132)',
                                        'rgb(54, 162, 235)',
                                        'rgb(16, 79, 181)',
                                        'rgb(255, 205, 86)'
                                    ],
                                    hoverOffset: 4
                                }]
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
    </main>
@endsection
