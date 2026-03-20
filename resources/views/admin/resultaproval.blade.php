<x-app-layout>
    <div class="p-6 bg-white shadow-sm rounded-xl mt-4 border border-gray-100">
        
        {{-- Header Section --}}
        <div class="mb-6 flex justify-between items-center border-b pb-4">
            <div>
                <h2 class="text-2xl font-black text-gray-800 italic uppercase tracking-tighter">
                    Pending Result Approvals
                </h2>
                <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest mt-1">
                    Academic Review & Verification Portal
                </p>
            </div>
        </div>

       
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 text-[10px] font-black uppercase tracking-widest animate-pulse">
                ✅ {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 text-[10px] font-black uppercase tracking-widest">
                ❌ {{ session('error') }}
            </div>
        @endif

   
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50 uppercase text-[11px] font-black text-gray-500">
                    <tr>
                        <th class="px-6 py-5 text-left border-r tracking-wider">Class Name</th>
                        <th class="px-6 py-5 text-center border-r tracking-wider">Status</th>
                        <th class="px-6 py-5 text-center tracking-wider">Actions</th>
                    </tr>
                </thead>
                
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($submittedClasses as $class)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            
                            {{-- Class Name --}}
                            <td class="px-6 py-5 whitespace-nowrap border-r font-black text-gray-900 uppercase italic">
                                {{ $class->name ?? $class->class_name . ' - ' . $class->stream }}
                            </td>

                            {{-- Dynamic Status Badge --}}
               <td class="px-6 py-5 text-center border-r">
    {{-- Hapa tunacheki status inayotoka kwenye DB --}}
    @if($class->result_status == 'approved')
        <span class="inline-flex items-center px-4 py-1.5 rounded-full text-[10px] font-black uppercase bg-green-100 text-green-700 ring-1 ring-green-200">
            Approved ✅
        </span>
    @else
        <span class="inline-flex items-center px-4 py-1.5 rounded-full text-[10px] font-black uppercase bg-blue-50 text-blue-700 ring-1 ring-blue-200">
            Submitted
        </span>
    @endif
</td>

                            {{-- Conditional Actions --}}
                            <td class="px-6 py-5 text-center">
                                @if($class->result_status !== 'approved')
                                    <a href="{{ route('admin.results.review', ['class_id' => $class->id]) }}" 
                                       class="inline-flex items-center px-6 py-2 bg-black text-white text-[10px] font-black uppercase tracking-widest rounded shadow-sm hover:bg-gray-800 transition duration-150">
                                        Review Marks
                                    </a>
                                @else
                                    <button disabled class="inline-flex items-center px-6 py-2 bg-gray-100 text-gray-400 text-[10px] font-black uppercase tracking-widest rounded cursor-not-allowed">
                                        Verified ✅
                                    </button>
                                @endif
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-20 text-center text-gray-400 italic font-medium uppercase tracking-widest text-xs">
                                No classes have submitted results for review.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>