<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registro</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
</head>

<body class="h-screen overflow-hidden flex items-center justify-center" style="background: #edf2f7;">
    <div class="min-h-screen bg-gray-100 flex flex-col justify-center sm:py-12">
        <div class="p-10 xs:p-0 mx-auto md:w-full md:max-w-md">
            <h1 class="font-bold text-center text-2xl mb-5 text-pink-500">won</h1>
            <div class="bg-white shadow w-full rounded-lg divide-y divide-gray-200">
                <div class="px-5 py-7">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <label class="font-semibold text-sm text-gray-600 pb-1 block">Nome</label>
                        @if ($errors->has('name'))
                            <span class="text-red-500">
                                {{ $errors->first('name') }}
                            </span>
                        @endif
                        <input type="text" id="name" name="name"
                            class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full" />
                        <label class="font-semibold text-sm text-gray-600 pb-1 block">Email</label>
                        @if ($errors->has('email'))
                            <span class="text-red-500">
                                {{ $errors->first('email') }}
                            </span>
                        @endif
                        <input type="email" id="email" name="email"
                            class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full" />
                        <label class="font-semibold text-sm text-gray-600 pb-1 block">Senha</label>
                        @if ($errors->has('password'))
                            <span class="text-red-500">
                                {{ $errors->first('password') }}
                            </span>
                        @endif
                        <input type="password" id="password" name="password"
                            class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full" />
                        <label class="font-semibold text-sm text-gray-600 pb-1 block">Confirmar senha</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="border rounded-lg px-3 py-2 mt-1 mb-5 text-sm w-full" />
                        <button type="submit"
                            class="transition duration-200 bg-pink-500 hover:bg-pink-600 focus:bg-pink-700 focus:shadow-sm focus:ring-4 focus:ring-pink-500 focus:ring-opacity-50 text-white w-full py-2.5 rounded-lg text-sm shadow-sm hover:shadow-md font-semibold text-center inline-block">
                            <span class="inline-block mr-2">Registrar</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" class="w-4 h-4 inline-block">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </button>
                    </form>
                    <div class="py-5">
                        <div class="grid grid-cols-2 gap-1">
                            <div class="text-center sm:text-left whitespace-nowrap">
                                <a class="inline-block ml-1 text-gray-500 hover:text-gray-900"
                                    href="{{ route('login') }}">Logar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>
