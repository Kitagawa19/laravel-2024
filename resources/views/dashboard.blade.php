<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __("履修登録アプリ") }}
        </h2>
    </x-slot>

    <div class="py-12">
    <div class="flex items-center mt-4">
            <x-primary-button class="ms-3" onClick="location.href='{{route('register.show')}}' ">
                {{ __("登録") }}
            </x-primary-button>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
