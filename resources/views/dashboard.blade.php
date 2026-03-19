<x-app-layout>
   

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
    
    @if(Str::lower(Auth::user()->role) == 'admin')
    <div class="flex mt-4 justify-between">


         <div class="col-md-2">
            <div class="card bg-primary text-gray-800  shadow">
                <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">
                 <div class="p-6">
                  <h6 class="text-uppercase mb-1">Total Students </h6>
                  <h2 class="mb-0 text-lg"><strong>{{ $totalStudents}}</strong></h2>
                  <hr>
                  <div class="flex mt-4 justify-between">
                      <div class="px-2">
                  <h4 class="text-uppercase mb-1">Male </h4>
                  <h2 class="mb-0 text-lg"><strong>{{ $maleStudents}}</strong></h2> 
                      </div> | 
                  <div class="px-2">
                  <h4 class="text-uppercase mb-1 ">Female</h4>
                  <h2 class="mb-0 text-lg"><strong>{{ $femaleStudents}}</strong></h2>
                  </div>
                  </div>
                 </div>
                </div> 
               </div>
            </div>
        </div>

         <div class="col-md-2">
            <div class="card bg-primary text-gray-800  shadow">
                <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">
                 <div class="p-6">
                  <h6 class="text-uppercase mb-1">Total Teachers </h6>
                  <h2 class="mb-0 text-lg"><strong>{{ $totalTeachers}}</strong></h2>
                  <hr>
                  <div class="flex mt-4 justify-between">
                      <div class="px-2">
                  <h4 class="text-uppercase mb-1">Male </h4>
                  <h2 class="mb-0 text-lg"><strong>{{ $maleTeachers}}</strong></h2> 
                      </div> | 
                  <div class="px-2">
                  <h4 class="text-uppercase mb-1 ">Female</h4>
                  <h2 class="mb-0 text-lg"><strong>{{ $femaleTeachers}}</strong></h2>
                  </div>
                  </div>
                 </div>
                </div> 
               </div>
            </div>
        </div>


        <div class="col-md-2">
            <div class="card bg-primary text-gray-800  shadow">
                <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">
                 <div class="p-6">
                  <h6 class="text-uppercase mb-1">Total Subjects</h6>
                  <h2 class="mb-0 text-lg"><strong>{{ $totalSubjects}} </strong></h2>
                  <i class="fas fa-user-graduates fa-2x opacity-50"></i>
                 </div>
                </div> 
               </div>
            </div>
        </div>


        <div class="col-md-2">
            <div class="card bg-primary text-gray-800  shadow">
                <div class="card-body">

                <div class="d-flex justify-content-between align-items-center">
                 <div class="p-6 justify-center">
                  <h4 class="text-uppercase mb-1">Total Classes </h4>
                  <h2 class="mb-0 text-lg"><strong>{{ $totalClasses}}</strong></h2>
                  <i class="fas fa-user-graduates fa-2x opacity-50"></i>
                 </div>
                </div> 
                
               </div>
            </div>
        </div>

    </div>
    @endif

    @if(auth()->user()->managedClass)
    <div class="d-flex justify-content-between align-items-center">
    <div>
        <h6 class="text-uppercase mb-1">Total Students </h6>
        <h2 class="mb-0">{{ $totalStudents}}</h2>
    </div>
    </div>
    @endif
</x-app-layout>
