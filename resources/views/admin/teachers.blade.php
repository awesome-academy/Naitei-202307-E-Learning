@extends('layouts.admin')

@section('content')
    <div class="my-5 flex justify-between">
        <h2 class="mb-2 text-2xl font-bold">{{ __('Teacher List') }}</h2>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
            <thead class="bg-gray-50 text-xs uppercase text-gray-500 dark:bg-gray-500 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        {{ __('No.') }}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{ __('Name') }}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{ __('Email') }}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{ __('Date of Birth') }}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{ __('Gender') }}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{ __('Status') }}
                    </th>
                    <th scope="col" class="px-6 py-3">
                        {{ __('Action') }}
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($teachers as $index => $teacher)
                    <tr
                        class="border-b bg-white hover:bg-gray-50 dark:border-gray-500 dark:bg-gray-600 dark:hover:bg-gray-600">
                        <th scope="row" class="whitespace-nowrap px-6 py-4 font-medium text-gray-900 dark:text-white">
                            {{ $index + 1 }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $teacher->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $teacher->email }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $teacher->dob }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $teacher->gender }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $teacher->status }}
                        </td>
                        @if ($teacher->isPending())
                            <td class="flex px-6 py-4">
                                <form class="mb-0"
                                    action="{{ route('admin.teachers.update', ['teacher' => $teacher->id]) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="{{ config('constant.status.active') }}">
                                    <button type="button"
                                        class="approve-button mr-1 rounded-lg bg-green-500 px-2 py-2 text-sm font-medium text-white hover:bg-green-600 focus:outline-none focus:ring-4 focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-500 dark:focus:ring-green-600">
                                        {{ __('Approve') }}
                                    </button>
                                </form>
                                <form class="mb-0"
                                    action="{{ route('admin.teachers.update', ['teacher' => $teacher->id]) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="{{ config('constant.status.reject') }}">
                                    <button type="button"
                                        class="reject-button ml-1 rounded-lg bg-red-500 px-2 py-2 text-sm font-medium text-white hover:bg-red-600 focus:outline-none focus:ring-4 focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-500 dark:focus:ring-red-900">
                                        {{ __('Reject') }}
                                    </button>
                                </form>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-3 flex justify-end">
        {{ $teachers->links('pagination::tailwind') }}
    </div>
@endsection
