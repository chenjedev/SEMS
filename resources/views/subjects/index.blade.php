<x-app-layout>

 <h2 class="text-lg">ADD  subjects</h2>   
  <form id="subForm" class="mt-3" action="{{ route('subjects.store')}}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Mathematics"><br><br>
        <input type="text" name="code" placeholder="MATH"><br><br>
        <button type="submit" >Register Subject</button>
        <p id="subMessage" class="message" role="status" aria-live="polite"></p>
    </form>

    <table class="min-w-full border text-left text-sm">
        <thead class="bg-gray-100 border-b">
            <tr >
                <th class="px-6 py-4">S/N</th>
                <th class="px-6 py-4">Name</th>
                <th class="px-6 py-4">Code</th>   
            </tr>
        </thead>
        <tbody>
            @foreach ($subjects as $key => $subject)
               <tr class="border-b hover:bg-gray-50">
                <td class="px-6 py-4">{{$key + 1}}</td>
                <td class="px-6 py-4">{{$subject->name}}</td>
                <td class="px-6 py-4">{{$subject->code}}</td>
               </tr> 
            @endforeach
        </tbody>
    </table>
</x-app-layout>