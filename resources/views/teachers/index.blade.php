<x-app-layout>
    <h1>TEACHERS</h1>
    <a href="{{ route('admin.assignsubjects')}}" class="text-grey-500">View Teachers With Subjects</a>
     <form action="{{ route("teachers.store")}}" method="POST" class="mt-3">
       
        @csrf
        <input type="text" name="name"  placeholder="Lucy Mabula" autocomplete="name" required>
        <input type="email" name="email"  placeholder="example@gmail.com" autocomplete="email" required>
        <input type="tel" name="phone"  placeholder="0712345678" inputmode="tel" autocomplete="tel" required>
        <select name="gender" class="form-control" required>
            <option value="">Select Gender</option>
            <option value="Male">Male</option>  
            <option value="Female">Female</option>
        </select>

        <button type="submit" class="btn">Regiter Teacher</button>
        

         <p id="teaMessage" class="message" role="status" aria-live="polite"></p>

       </form>

        <table class="min-w-full border text-left text-sm">
        <thead class="bg-gray-100 border-b">
            <tr >
                <th class="px-6 py-4">S/N</th>
                <th class="px-6 py-4">ID</th>
                <th class="px-6 py-4">Name</th>
                <th class="px-6 py-4">Email</th>
                <th class="px-6 py-4">Phone</th>  
                <th class="px-6 py-4">Gender</th>   
                <th class="px-6 py-4">Role</th>  
            </tr>
        </thead>
        <tbody>
            @foreach ($teachers as $key => $teacher)
               <tr class="border-b hover:bg-gray-50">
                <td class="px-6 py-4">{{$key + 1}}</td>
                <td class="px-6 py-4">{{$teacher->id}}</td>
                <td class="px-6 py-4">{{$teacher->name}}</td>
                <td class="px-6 py-4">{{$teacher->email}}</td>
                <td class="px-6 py-4">{{$teacher->phone}}</td>
                <td class="px-6 py-4">{{$teacher->gender}}</td>
                <td class="px-6 py-4">{{$teacher->created_at}}</td>
               </tr> 
            @endforeach
        </tbody>
    </table>
</x-app-layout>