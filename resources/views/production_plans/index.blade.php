<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Production Plans</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                        role="alert">
                        <strong class="font-bold">Success!</strong>
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                <div class="flex justify-between items-center w-full">
                    <form action="{{ route('production.plans.index') }}" method="GET"
                        class="flex gap-2 w-8/12 md:w-4/12">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Search Production Plans"
                            class="bg-gray-50 border w-6/12 h-10 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2">
                        <button type="submit"
                            class="text-white h-10 w-3/12 bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-md text-sm md:px-5 py-2.5 text-center">Search</button>
                    </form>
                    <div class="w-4/12 flex justify-end md:w-6/12">
                        <a href="{{ route('production.plans.create') }}"
                            class="text-white h-10 w-8/12 md:w-2/12 bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-md text-sm md:px-5 py-2.5 text-center">
                            Add Plan
                        </a>
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1 gap-2 mt-6">
                    <div class="bg-gray-50/80 p-4 justify-between flex items-center border rounded-lg">
                        <h3 class="font-bold text-lg">Plan Name</h3>
                        <div class="flex justify-start font-bold">
                            Action
                        </div>
                    </div>
                    @forelse ($plans as $plan)
                        <div class="py-1 px-4 border justify-between flex items-center rounded-lg">
                            <h3 class="font-semibold text-base">{{ $plan->name }}</h3>
                            <div class="flex justify-between">
                                <a href="{{ route('production.plans.edit', $plan->id) }}"
                                    class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-md text-sm px-2 md:px-5 py-2 me-2">Edit</a>
                                <form action="{{ route('production.plans.destroy', $plan->id) }}" method="POST"
                                    class="inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button"
                                        class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-md text-sm px-2 md:px-5 py-2 text-center me-2 delete-button">Delete</button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-1 sm:col-span-2 lg:col-span-1 bg-gray-100 p-4 rounded-lg text-center">
                            <p class="text-gray-600">No production plans available. Please add a new production plan.
                            </p>
                        </div>
                    @endforelse
                </div>
                <div class="mt-4">
                    {{ $plans->links() }}
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-button');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const form = this.closest('.delete-form');

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "This action cannot be undone!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>

</x-app-layout>
