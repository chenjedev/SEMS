<x-app-layout>
    @php
        $totalStudents = $students->count();
        
     
        $completedSubjects = [];
        foreach($subjects as $subject) {
            $marksCount = 0;
            foreach($students as $student) {
                if(isset($all_marks[$student->id]) && $all_marks[$student->id]->contains('subject_id', $subject->id)) {
                    $marksCount++;
                }
            }
            if($totalStudents > 0 && $marksCount === $totalStudents) {
                $completedSubjects[] = $subject->id;
            }
        }
    @endphp

    <div class="p-6 bg-white shadow-sm rounded-xl mt-4 border border-gray-100">
        {{-- Header Portal --}}
        <div class="mb-8 flex flex-col md:flex-row justify-between items-center border-b pb-6">
            <div>
                <h2 class="text-2xl font-black text-gray-800 uppercase italic tracking-tighter">
                    Reviewing: {{ $class->name ?? 'Class ' . $class->id }}
                </h2>
                <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest mt-1">
                    Academic Review & Verification Portal
                </p>
            </div>

            <div class="flex space-x-3 mt-4 md:mt-0">
                <form action="{{ route('admin.results.reject', ['class_id' => $class->id]) }}" method="POST">
                    @csrf
                    <button type="submit" class="px-6 py-2.5 bg-red-600 text-white text-[10px] font-black uppercase tracking-widest rounded-lg hover:bg-red-700 shadow-md transition">
                        Reject & Edit
                    </button>
                </form>

                <form action="{{ route('admin.results.approve', ['class_id' => $class->id]) }}" method="POST">
                    @csrf
                    <button type="submit" class="px-6 py-2.5 bg-green-600 text-green-600 text-[10px] font-black uppercase tracking-widest rounded-lg hover:bg-green-700 shadow-md transition">
                        Approve Results
                    </button>
                </form>
            </div>
        </div>

        <div class="overflow-x-auto rounded-xl border border-gray-200 shadow-sm custom-scrollbar">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50 text-[10px] font-black text-gray-500 uppercase">
                    <tr>
                        <th class="px-6 py-4 text-left border-r sticky left-0 bg-gray-50 z-10">Student Name</th>
                        @foreach($subjects as $subject)
                            <th class="px-4 py-4 text-center border-r min-w-[100px] italic font-black">
                                <div class="flex flex-col items-center justify-center">
                                    <span>{{ $subject->code }}</span>
                                    @if(in_array($subject->id, $completedSubjects))
                                        <span class="text-green-600 mt-1 text-base">✅</span>
                                    @endif
                                </div>
                            </th>
                        @endforeach
                        <th class="px-6 py-4 text-center bg-blue-50 text-blue-700 font-black">Total Marks</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($students as $student)
                        @php
                            $studentMarks = $all_marks[$student->id] ?? collect();
                          
                            $isStudentComplete = ($studentMarks->count() >= $subjects->count() && $subjects->count() > 0);
                        @endphp
                        
                      
                        <tr class="{{ $isStudentComplete ? 'bg-green-50/50' : 'hover:bg-gray-50' }} transition duration-150">
                            <td class="px-6 py-4 whitespace-nowrap border-r font-bold text-sm sticky left-0 {{ $isStudentComplete ? 'text-green-700 bg-green-50/50' : 'text-gray-900 bg-white' }} uppercase italic z-10 shadow-[2px_0_5px_rgba(0,0,0,0.02)]">
                                <div class="flex items-center">
                                    {{ $student->name }}
                                    @if($isStudentComplete) 
                                        <span class="ml-2 text-green-500 text-base">✅</span> 
                                    @endif
                                </div>
                            </td>
                            
                            @foreach($subjects as $subject)
                                @php 
                                    $mark = $studentMarks->firstWhere('subject_id', $subject->id); 
                                    $isColDone = in_array($subject->id, $completedSubjects);
                                @endphp
                                <td class="px-4 py-4 text-center border-r text-sm">
                                    @if($mark)
                                        <span class="font-bold text-gray-800">{{ $mark->terminal }}</span>
                                    @else
                                        <span class="text-red-400 italic text-xs animate-pulse">Pending</span>
                                    @endif
                                </td>
                            @endforeach

                            <td class="px-6 py-4 text-center font-black {{ $isStudentComplete ? 'bg-green-100 text-green-900' : 'bg-blue-50 text-blue-900' }} border-l">
                                {{ $studentMarks->sum('terminal') }}
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="{{ $subjects->count() + 2 }}" class="p-10 text-center font-bold">No records found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>