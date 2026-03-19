<x-app-layout>

   @if($students->isEmpty())
        <div class="text-center py-10">
            <div class="mb-4">
                <i class="fas fa-check-circle text-green-500 text-6xl"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-800">Class Completed!</h3>
            <p class="text-gray-600 mt-2">All students in this class have already been assigned marks for this subject.</p>
            
            <div class="mt-6">
                <a href="{{ route('marks.index', ['class_id' => $class_id, 'subject_id' => $subject_id]) }}" 
                   class="bg-indigo-600 text-indigo-600 px-6 py-2 rounded-lg hover:bg-indigo-700 transition">
                   View Marks List -> 
                </a>
            </div>
        </div>
    @else
   
      <form action="{{ route('marks.store')}}" method="POST" autocomplete="off">
        @csrf

      
          <div class="flex justify-between items-center mb-6">
                         <h2>ADD MARKS for {{ $subject->name }}  {{ $class->class_name }} - {{ $class->stream }}</h2>
                         <button type="submit"><strong class="text-indigo-400">Save Marks</strong></button>
                        <a href="{{ route('marks.index') }}" class="bg-indigo-600 hover:bg-indigo-700 text-indigo-600 px-5 py-2 rounded-lg font-bold shadow">
                         View Marked Students ->
                       </a>
          </div>


    
        <input type="hidden" name="subject_id" value="{{ $subject->id}}">
        <input type="hidden" name="class_id" value="{{ $class->id}}">
      
    
    <table class="min-w-full border text-left text-sm mt-4">
        <thead class="bg-gray-100 border-b">
            <tr>
                <th class="px-6 py-4">S/N</th>
                <th class="px-6 py-4">ADMISION NUMBER</th>
                <th class="px-6 py-4">Full Name</th>
                <th class="px-6 py-4">TEST 1</th>
                <th class="px-6 py-4">TEST 2</th>
                <th class="px-6 py-4">TERMINAL</th>
                <th class="px-6 py-4">TOTAL</th>
                <th class="px-6 py-4">GRADE</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $key => $student)
        <tr class="border-b hover:bg-gray-50">
            <td class="px-6 py-4">{{ $key + 1}}</td>
            <td class="px-6 py-4">{{ $student->id}}</td>
            <td class="px-6 py-4">{{ $student->name}}</td>
            <td class="px-6 py-4"><input type="number" name="marks[ {{$student->id}} ][test_1]" max:100></td>
            <td class="px-6 py-4"><input type="number" name="marks[ {{$student->id}} ][test_2]" min:0 max:100></td>
             <td class="px-6 py-4"><input type="number" name="marks[ {{$student->id}} ][terminal]" min:0 max:100></td>
            <td class="px-6 py-4">Edit</td>
            <td class="px-6 py-4 text-red-700">Delete</td>
        </tr>
            @endforeach
        </tbody>
       
    </table>

   
      </form>
    @endif
</x-app-layout>