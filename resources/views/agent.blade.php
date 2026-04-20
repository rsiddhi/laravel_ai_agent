@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto bg-white shadow-lg rounded-2xl p-6">

    <h1 class="text-2xl font-bold mb-4">
        AI Agent Dashboard
    </h1>

    <textarea
        class="w-full border rounded-lg p-3 focus:ring focus:outline-none"
        rows="4"
        placeholder="Enter your goal..."
    ></textarea>

    <button
        class="mt-4 bg-teal-600 text-white px-4 py-2 rounded-lg hover:bg-teal-700"
    >
        Run Agent
    </button>

    <div class="mt-6 space-y-3">

        <div class="border p-3 rounded-lg bg-gray-50">
            <p class="font-semibold">Action:</p>
            <p>search: AI trends</p>

            <p class="font-semibold mt-2">Result:</p>
            <p>Found latest articles...</p>
        </div>

    </div>

</div>

@endsection