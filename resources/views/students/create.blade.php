<x-app-layout>

    <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold">Students Details</h3>
                    <a href="{{ route('students.index') }}" class="bg-indigo-600 hover:bg-indigo-700 text-indigo-600 px-5 py-2 rounded-lg font-bold shadow">
                        Back To List
                    </a>
    </div>
       <form action="{{ route("students.store")}}" method="POST" class="mt-3">
       
        @csrf
        <input type="hidden" name="class_id"  value="{{ $myclass->id}}"><br><br>

        <label>Full Name</label><br>
        <input type="text" name="name"  placeholder="John doe" autocomplete="name" required><br><br>

       
        
        <select name="gender" class="form-control" required>
            <option value="">Select Gender</option>
            <option value="Male">Male</option>  
            <option value="Female">Female</option>
        </select><br><br>

        <button type="submit" class="btn bg-blue-300">Regiter Student</button>


         <p id="teaMessage" class="message" role="status" aria-live="polite"></p>

       </form>
</x-app-layout>