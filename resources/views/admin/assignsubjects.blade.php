<x-app-layout>
    <form action="{{ route('admin.store') }}" method="POST">
    @csrf
    <select name="user_id">
        @foreach($teachers as $teacher)
            <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
        @endforeach
    </select>

    <select name="subject_id">
        @foreach($subjects as $subject)
            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
        @endforeach
    </select>

     <select name="school_class_id">
        @foreach($classes as $class)
            <option value="{{ $class->id }}">{{ $class->class_name }} - {{ $class->stream}}</option>
        @endforeach
    </select>

    <button type="submit">Assign Subject</button>
</form>



<table class="min-w-full border text-left text-sm">
    <thead class="bg-gray-100 border-b">
        <tr>
            <th class="px-6 py-4">S/N</th>
            <th class="px-6 py-4">Teacher ID</th>
            <th class="px-6 py-4">Teacher Name</th>
            <th class="px-6 py-4">Assigned Subject  & class</th>
            <th class="px-6 py-4">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($teachers as $teacher)
        <tr class="border-b hover:bg-gray-50">
             <td class="px-6 py-4">{{ $loop->iteration}}</td>
            <td class="px-6 py-4">{{ $teacher->id}}</td>
            <td class="px-6 py-4">{{ $teacher->name}}</td>

            <td class="px-6 py-4">
                @forelse($teacher->subjects as $subject)
                <span class="badge bg-info block text-xs font-semibold mb-1">
                {{ $subject->name }}- {{ ($class=  \App\Models\SchoolClass::find($subject->pivot->school_class_id)) ? "$class->class_name  $class->stream" : 'N/A' }}
                </span>
                @empty
                <span class="text-xs text-gray-400 italic text-center">N/A</span>
                @endforelse
            </td>
            <td class="px-6 py-4"><a href="#">Edit</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
</x-app-layout>