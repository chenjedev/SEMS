<x-app-layout>
    @php
        // 1. Pata idadi ya wanafunzi
        $totalStudentsInClass = $students->count();

        // 2. Tengeneza list ya masomo yaliyokamilika kwa kutumia $all_marks pekee
        $completedSubjects = [];
        
        foreach($subjects as $subject) {
            $countForThisSubject = 0;
            
            foreach($students as $student) {
                // Tunakagua kama huyu mwanafunzi ana alama ya hili somo ndani ya $all_marks
                if (isset($all_marks[$student->id])) {
                    $hasMark = $all_marks[$student->id]->where('subject_id', $subject->id)->first();
                    if ($hasMark) {
                        $countForThisSubject++;
                    }
                }
            }

            // Kama idadi ya alama tulizozipata inalingana na idadi ya wanafunzi wote
            if ($totalStudentsInClass > 0 && $countForThisSubject === $totalStudentsInClass) {
                $completedSubjects[] = $subject->id;
            }
        }
    @endphp

    <div class="p-6 bg-white shadow-sm rounded-xl mt-4 border border-gray-100">
        
        <div class="mb-6 flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold text-gray-800 italic uppercase tracking-wide">
                    Class Performance: {{ $class->name }}
                </h2>
                <p class="text-sm text-gray-500 font-medium">Detailed terminal examination results summary.</p>
            </div>
        </div>

        @if($class->result_status == 'rejected')
            <div class="mb-6 p-4 text-red-800 rounded-lg bg-red-50 border-l-4 border-red-500 shadow-sm flex items-center">
                <span class="text-2xl mr-3">🛑</span>
                <div>
                    <p class="font-black uppercase italic">Results Rejected by Admin</p>
                    <p class="text-sm font-medium">Please review all marks, perform the necessary corrections, and click the <strong>Resubmit</strong> button below.</p>
                </div>
            </div>
        @endif

        <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-sm">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50 uppercase text-xs font-bold text-gray-600">
                    <tr>
                        <th class="px-6 py-4 text-left border-r">Student Name</th>
                        @foreach($subjects as $subject)
                            <th class="px-4 py-4 text-center border-r italic font-black">
                                <div class="flex flex-col items-center justify-center">
                                    <span>{{ $subject->code }}</span>
                                    {{-- DEBUG: Futa hii 'Count' ukishajiridhisha inafanya kazi --}}
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
                            $studentMarksCount = isset($all_marks[$student->id]) ? $all_marks[$student->id]->count() : 0;
                            $isStudentComplete = ($studentMarksCount >= $subjects->count() && $subjects->count() > 0);
                        @endphp

                        <tr class="{{ $isStudentComplete ? 'bg-green-50/50' : 'hover:bg-gray-50' }} transition duration-150">
                            <td class="px-6 py-4 whitespace-nowrap font-bold text-sm border-r {{ $isStudentComplete ? 'text-green-700' : 'text-gray-900' }}">
                                <div class="flex items-center">
                                    {{ $student->name }}
                                    @if($isStudentComplete) <span class="ml-2 text-green-500">✅</span> @endif
                                </div>
                            </td>

                            @foreach($subjects as $subject)
                                <td class="px-4 py-4 text-center border-r text-sm">
                                    @php
                                        $mark = isset($all_marks[$student->id]) 
                                                ? $all_marks[$student->id]->firstWhere('subject_id', $subject->id) 
                                                : null;
                                    @endphp

                                    @if($mark)
                                        <span class="font-bold {{ $class->result_status == 'rejected' ? 'text-red-600' : 'text-gray-800' }}">
                                            {{ $mark->terminal }}
                                        </span>
                                    @else
                                        <span class="text-red-400 italic text-xs animate-pulse">Pending</span>
                                    @endif
                                </td>
                            @endforeach

                            <td class="px-6 py-4 text-center font-black {{ $isStudentComplete ? 'bg-green-100 text-green-900' : 'bg-blue-50 text-blue-900' }} border-l">
                                {{ isset($all_marks[$student->id]) ? $all_marks[$student->id]->sum('terminal') : 0 }}
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="{{ $subjects->count() + 2 }}" class="px-6 py-12 text-center text-gray-400">No students registered.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Footer Actions section remain the same as before --}}
        <div class="mt-10 p-6 bg-gray-50 rounded-xl border-2 border-dashed border-gray-200">
            @if($class->result_status == 'submitted')
                <div class="flex items-center text-blue-800 bg-blue-50 p-4 rounded-lg border border-blue-100">
                    <span class="text-2xl mr-4">🔒</span>
                    <div>
                        <p class="font-bold">Results Locked</p>
                        <p class="text-sm">These records have been submitted and are currently under review by Administration.</p>
                    </div>
                </div>
            @elseif($class->result_status == 'approved')
                <div class="flex items-center text-green-800 bg-green-50 p-4 rounded-lg border border-green-100 shadow-sm">
                    <span class="text-2xl mr-4">🎉</span>
                    <div>
                        <p class="font-bold">Finalized & Approved</p>
                        <p class="text-sm font-medium">These results have been verified and can no longer be modified.</p>
                    </div>
                </div>
            @elseif($isComplete || $class->result_status == 'rejected')
                <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                    <div class="{{ $class->result_status == 'rejected' ? 'text-red-800' : 'text-green-800' }}">
                        <p class="font-black text-lg uppercase italic tracking-tight">
                            {{ $class->result_status == 'rejected' ? '🛑 Resubmission Required' : 'Ready for Submission ✅' }}
                        </p>
                        <p class="text-sm font-medium">
                            {{ $class->result_status == 'rejected' ? 'Please verify all marks before resubmitting.' : 'All marks are entered correctly.' }}
                        </p>
                    </div>
                    <form action="{{ route('class.submit_to_admin', $class->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-black text-green-600 px-10 py-4 rounded-lg font-black hover:bg-gray-800 transition-all shadow-xl text-xs uppercase tracking-widest active:scale-95">
                            {{ $class->result_status == 'rejected' ? 'Resubmit to Admin' : 'Finalize & Submit' }}
                        </button>
                    </form>
                </div>
            @else
                <div class="flex items-center text-yellow-900 bg-yellow-50 p-4 rounded-lg border border-yellow-200">
                    <span class="text-2xl mr-4">⏳</span>
                    <div>
                        <p class="font-bold uppercase tracking-tight italic">Awaiting Complete Data Entry</p>
                        <p class="text-xs font-mono mt-1 italic font-bold">
                            Current Status: {{ $actualMarksCount }} / {{ $totalExpectedMarks }} records entered.
                        </p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>