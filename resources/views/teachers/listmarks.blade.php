<x-app-layout>



         
    <div class="flex justify-between items-center mb-6">
          <h2>LIST OF STUDENTS WITH MARKS</h2>
            <a href="{{ route('marks.create', ['class_id' => $class_id, 'subject_id' => $subject_id]) }}" class="btn btn-primary">
               Ingiza Marks za Wanafunzi Waliobaki
            </a>       
    </div>
      
    
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
            @foreach($marks as $key => $mark)
        <tr class="border-b hover:bg-gray-50">
            <td class="px-6 py-4">{{ $key + 1}}</td>
            <td class="px-6 py-4">{{ $mark->student->id}}</td>
            <td class="px-6 py-4">{{ $mark->student->name}}</td>
            <td class="px-6 py-4">{{ $mark->test_1}}</td>
            <td class="px-6 py-4">{{ $mark->test_2}}</td>
            <td class="px-6 py-4">{{ $mark->terminal}}</td>
            <td class="px-6 py-4"><strong>{{ $mark->total}}</strong></td>
            <td class="px-6 py-4">{{ $mark->grade}}</td>
        </tr>
            @endforeach
        </tbody>
      
 
       
    </table>

   
      </form>
 
</x-app-layout>