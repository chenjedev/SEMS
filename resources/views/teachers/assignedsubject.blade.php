<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold mb-6">Subject You Teach</h2>

            @foreach(auth()->user()->subjects as $subject)
                <div class="p-6 bg-white border-l-4 border-indigo-500 shadow-sm rounded-lg mb-4 flex justify-between items-center">
                    <div>
                        <h3 class="font-bold text-lg uppercase text-indigo-700">{{ $subject->name }}</h3>
                        <p class="text-gray-600">
                            Class: {{ ($class=  \App\Models\SchoolClass::find($subject->pivot->school_class_id)) ? "$class->class_name  $class->stream" :  'N/A' }}
                        </p>
                    </div>

                    <div>
                       
                        <a href="{{ route('teachers.addmarks' ,[$subject->id, $subject->pivot->school_class_id])}}" class="bg-indigo-600 text-indigo-600 px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
                            Add Marks →
                        </a>
                    </div>
                </div>
            @endforeach

            @if(auth()->user()->subjects->isEmpty())
                <p class="text-gray-500 italic">Your not assigned to any subject yet!.</p>
            @endif
        </div>
    </div>
</x-app-layout>