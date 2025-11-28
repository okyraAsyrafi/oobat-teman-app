<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                {{ __("You're logged in!") }}
                <div class="p-4 bg-yellow-100 text-yellow-800">
                    <strong>Login sebagai:</strong> {{ auth()->user()->email }}<br>
                    <strong>Roles:</strong> {{ auth()->user()->getRoleNames()->implode(', ') ?: 'TIDAK ADA ROLE' }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
