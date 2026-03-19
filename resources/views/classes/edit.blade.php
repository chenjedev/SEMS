<x-app-layout>
    <h2>Assign Class teacher for {{ $classes->class_name}} {{ $classes->stream}} </h2>

    <form action="{{ route('classes.update', $classes->id)}}" method="POST">
        @csrf
        @method('PUT')
        <label>Select teacher</label>
        <input type="text" name="class_name" value="{{ $classes->class_name}}">
        <input type="text" name="stream" value="{{ $classes->stream}}">
        <select name="teacher_id">
            <option value="">Select teacher</option>
            @foreach ($teachers as $teacher)
                <option value="{{ $teacher->id }}">{{ $teacher->name }} </option>
            @endforeach
        </select>
        <button type="submit">Update</button>

    </form>

    <a href="{{ route('classes.index')}}">BAck To List</a>
</x-app-layout>