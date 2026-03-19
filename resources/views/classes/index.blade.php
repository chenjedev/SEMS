<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold">Class List</h3>
                    <a href="{{ route('classes.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-lg font-bold shadow">
                        + Add New Class
                    </a>
                </div>

                <table class="min-w-full border text-left text-sm">
                    <thead class="bg-gray-100 border-b">
                        <tr>
                            <th class="px-6 py-4">S/N</th>
                            <th class="px-6 py-4">Class Name</th>
                            <th class="px-6 py-4">Stream</th>
                            <th class="px-6 py-4">ClassTeacher</th>
                            <th class="px-6 py-4">Students</th>
                            <th class="px-6 py-4">Actions</th>  
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($classes as $key => $class)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $key + 1 }}</td>
                            <td class="px-6 py-4 font-bold">{{ $class->class_name }}</td>
                            <td class="px-6 py-4">{{ $class->stream ?? 'N/A' }}</td>
                            <td>
                                @if($class->teacher_id && $class->classTeacher)
                                {{ $class->classteacher->name}} - {{ $class->classteacher->id}} 
                                @else
                                <a href="{{ route('classes.edit', $class->id)}}">
                                    Add Class Teacher
                                </a>
                                @endif
                            </td>
                             <td class="px-6 py-4">
                                <a href="{{ route('students.index', ['class_id' => $class->id])}}" class="text-blue-600 font-bold"><i class="fas fa-eye"></i> View</a>
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('classes.edit', $class->id)}}" class="text-blue-600 font-bold">Edit</a>

                            </td>

                            <td class="px-6 py-4">
                                  <form action="{{ route('classes.destroy', $class->id)}}"  method="POST" onsubmit="return confirm(' Do you want to delete this class? ')">
                                     @csrf
                                     @method('DELETE')
                                     <button type="submit" class="text-red-600">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>