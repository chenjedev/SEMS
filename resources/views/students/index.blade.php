<x-app-layout>
    
    @if(auth()->user()->managedClass)
     <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    You are class teacher of <strong class="text-blue-400">{{ $myclass->class_name}} - {{ $myclass->stream}}</strong>
                </div>
            </div>
        </div>
    </div>


    <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold">Students Details</h3>
                    <a href="{{ route('students.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-indigo-600 px-5 py-2 rounded-lg font-bold shadow">
                        + Add New student
                    </a>
    </div>

    
    <table class="min-w-full border text-left text-sm mt-4">
        <thead class="bg-gray-100 border-b">
            <tr>
                <th class="px-6 py-4">S/N</th>
                <th class="px-6 py-4">ADMISION NUMBER</th>
                <th class="px-6 py-4">Full Name</th>
                <th class="px-6 py-4">Gender</th>
                <th class="px-6 py-4">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $key => $student)
        <tr class="border-b hover:bg-gray-50">
            <td class="px-6 py-4">{{ $key + 1}}</td>
            <td class="px-6 py-4">{{ $student->id}}</td>
            <td class="px-6 py-4">{{ $student->name}}</td>
            <td class="px-6 py-4">{{ $student->gender}}</td>
            <td class="px-6 py-4">Edit</td>
            <td class="px-6 py-4 text-red-700">Delete</td>
        </tr>
            @endforeach
        </tbody>
       
    </table>
    @endif

     @if(Str::lower(Auth::user()->role) == 'admin')
     <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold">{{ $myclass->class_name}} - {{ $myclass->stream}}</strong>  Students List</h3>
                    <a href="{{ route('students.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-indigo-600 px-5 py-2 rounded-lg font-bold shadow">
                        + Add New student
                    </a>
                    <a href="{{ route('classes.index') }}" class="bg-indigo-600 hover:bg-indigo-700 text-indigo-600 px-5 py-2 rounded-lg font-bold shadow">
                      <- Back To Classes
                    </a>
    </div>

    
    <table class="min-w-full border text-left text-sm mt-4">
        <thead class="bg-gray-100 border-b">
            <tr>
                <th class="px-6 py-4">S/N</th>
                <th class="px-6 py-4">ADMISION NUMBER</th>
                <th class="px-6 py-4">Full Name</th>
                <th class="px-6 py-4">Gender</th>
                <th class="px-6 py-4">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $key => $student)
        <tr class="border-b hover:bg-gray-50">
            <td class="px-6 py-4">{{ $key + 1}}</td>
            <td class="px-6 py-4">{{ $student->id}}</td>
            <td class="px-6 py-4">{{ $student->name}}</td>
            <td class="px-6 py-4">{{ $student->gender}}</td>
            <td class="px-6 py-4">Edit</td>
            <td class="px-6 py-4 text-red-700">Delete</td>
        </tr>
            @endforeach
        </tbody>
    </table>
    @endif

      
</x-app-layout>