<x-app-layout>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden  p-8">
                
                <div class="mb-6 flex justify-between items-center">
                    <h3 class="text-xl font-bold">Register New Class</h3>
                    <a href="{{ route('classes.index') }}" class="text-gray-500 hover:underline">Back to List</a>
                </div>

                 <form action="{{ route('classes.store') }}" method="POST" class="space-y-6">
    @csrf
    <h3>Register Class</h3>

    <div>
        <select name="class_name" class="form-control text-black @error('name') border-red-500 @enderror">
            <option value="">Select Class</option>
            <option value="Form One">Form One</option>
            <option value="Form Two">Form Two</option>
            <option value="Form Three">Form Three</option>
            <option value="Form Four">Form Four</option>
        </select>
        @error('name')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <div class="mt-4">
        <select name="stream" class="form-control text-black @error('stream') border-red-500 @enderror">
            <option value="">Select Stream</option>
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="C">C</option>
            <option value="D">D</option>
        </select>
        @error('stream')
            <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
    </div>

    <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg mt-4">
        Register Class
    </button>
</form>

            </div>
        </div>
    </div>
    <script src="{{ asset('js/script.js')}}"></script>
</x-app-layout>