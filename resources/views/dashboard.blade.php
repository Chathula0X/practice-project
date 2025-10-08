<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           @if(auth('admins')->check())
               Admin Dashboard - {{auth('admins')->user()->name}}
           @else
               User Dashboard - {{auth()->user()->name}}
           @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
           this is dashboard
        </div>
    </div>
</x-app-layout>
