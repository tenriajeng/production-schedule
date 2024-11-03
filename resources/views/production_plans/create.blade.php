<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Production Plan and Schedule</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('production.plans.store') }}" method="POST">
                    @csrf

                    @include('production_plans.field')

                </form>
            </div>
        </div>
    </div>

</x-app-layout>
