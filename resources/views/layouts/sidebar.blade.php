<div class="flex flex-col w-64 h-screen px-4 py-8 bg-white border-r sticky top-0">
    <div class="px-4 mb-6">
        <h2 class=" font-bold text-indigo-600 tracking-wider text-xl mt-6">SEMS PRO</h2>
    </div>

    <div class="flex flex-col justify-between flex-1 mt-2">
        <nav class="space-y-2">
            

            @if(Str::lower(Auth::user()->role) == 'admin')
                <div class="pt-4 pb-2 px-4">
                    <span class="text-lg font-semibold text-gray-400 uppercase tracking-wider">Academic Admin</span>
                </div><hr>
                
                <a href="{{ route('dashboard')}}" 
                   class="flex items-center px-4 py-2.5 text-sm font-medium transition-colors duration-200 rounded-lg {{ request()->routeIs('dashboard') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                    <span class="mx-2 font-bold text-base mt-4">Dashboard</span>
                </a><hr>

                <a href="{{ route('classes.index') }}" 
                   class="flex items-center px-4 py-2.5 text-sm font-medium transition-colors duration-200 rounded-lg {{ request()->routeIs('classes.index') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                    <span class="mx-2 font-bold text-base mt-4">Classes</span>
                </a><hr>

                 <a href="{{ route('subjects.index') }}" 
                   class="flex items-center px-4 py-2.5 text-sm font-medium transition-colors duration-200 rounded-lg {{ request()->routeIs('subjects.index') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                    <span class="mx-2 font-bold text-base mt-4">Subjects</span>
                </a><hr>

                <a href="{{ route('teachers.index') }}" 
                   class="flex items-center px-4 py-2.5 text-sm font-medium transition-colors duration-200 rounded-lg {{ request()->routeIs('teachers.index') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                    <span class="mx-2 font-bold text-base mt-4">Teachers</span>
                </a><hr>
                
                <a href="{{ route('admin.results.index') }}" 
                   class="flex items-center px-4 py-2.5 text-sm font-medium transition-colors duration-200 rounded-lg {{ request()->routeIs('admin.results.index') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                    <span class="mx-2 font-bold text-base mt-4">Results</span>
                </a><hr>
                 <a href="{{ route('admin.results.index') }}" 
                       class="inline-flex items-center px-4 py-2 bg-black border border-transparent rounded-md font-bold text-xs text-white uppercase tracking-widest hover:bg-gray-700 transition">
                      Result Approvals
                </a>

            @endif

              @if(Str::lower(Auth::user()->role) == 'teacher')
                <div class="pt-4 pb-2 px-4">
                    <span class="text-lg font-semibold text-gray-400 uppercase tracking-wider">Teacher Dashboard</span>
                </div><hr>
            
                <div class="mt-6">
                <a href="#" 
                   class="flex items-center px-4 py-2.5 text-sm font-medium transition-colors duration-200 rounded-lg {{ request()->routeIs('classes.index') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}">
                    <span class="mx-2 font-bold text-base mt-4">My class</span>
                </a><hr>

                <a href="{{ route('teachers.assignedsubject') }}" 
                   class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-600 transition-colors duration-200 rounded-lg hover:bg-gray-100 hover:text-gray-900">
                    <span class="mx-2 text-base mt-4">Subjects</span>
                </a><hr>

                <a href="#" 
                   class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-600 transition-colors duration-200 rounded-lg hover:bg-gray-100 hover:text-gray-900">
                    <span class="mx-2 text-base mt-4">Examination</span>
                </a><hr>

                <a href="#" 
                   class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-600 transition-colors duration-200 rounded-lg hover:bg-gray-100 hover:text-gray-900">
                    <span class="mx-2 text-base mt-4">Timetable</span>
                </a><hr>
                </div>

                @if(auth()->user()->managedClass)
              

                <a href="{{ route('class.performance', auth()->user()->managedClass->id) }}" 
                   class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-600 transition-colors duration-200 rounded-lg hover:bg-gray-100 hover:text-gray-900">
                    <span class="mx-2 text-base mt-4">Class Performance</span>
                </a><hr>
                <a href="{{ route('students.index')}}" 
                   class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-600 transition-colors duration-200 rounded-lg hover:bg-gray-100 hover:text-gray-900">
                    <span class="mx-2 text-base mt-4">My Students</span>
                </a><hr>
                  <a href="#" 
                   class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-600 transition-colors duration-200 rounded-lg hover:bg-gray-100 hover:text-gray-900">
                    <span class="mx-2 text-base mt-4">Class Report</span>
                </a><hr>
                  <a href="#" 
                   class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-600 transition-colors duration-200 rounded-lg hover:bg-gray-100 hover:text-gray-900">
                    <span class="mx-2 text-base mt-4">Atendance</span>
                </a><hr>
               
                @endif
            @endif
        </nav>

        <div class="mt-auto px-4 py-4 border-t border-gray-100">
            <div class="flex items-center">
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-700">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-400 capitalize">{{ Auth::user()->role }}</p>
                </div>
            </div>
        </div>
    </div>
</div>