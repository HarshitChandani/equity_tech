@extends('layouts.main')

@section('content')
      @if(isset($users))
      <div class="sub-container my-5">
         <div class="d-flex flex-row flex-wrap">
            <div class="col-12">
               <table class="table">
                  <thead>
                     <tr>
                        <th class="text-center">Full Name</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Delete Operation</th>
                        <th class="text-center">Update Operation</th>
                     </tr>
                  </thead>
                  <tbody>
                     @php $total = count($users)
                         @endphp
                     @for($i=0; $i<$total; $i++)
                        <tr>
                           <td scope="row" class="text-center">
                              {{ $users[$i]["name"] }}
                           </td>
                           <td class="text-center">
                              {{ $users[$i]["email"] }}
                           </td>
                           <td class="text-center">
                              <a href="{{ route('delete',['user_number'=>$users[$i]['parent_id']]) }}" type="button" class="btn btn-danger w-50">Remove</a>
                           </td>
                           <td class="text-center">
                              <a href="{{ route('update',['user_number'=> $users[$i]['parent_id']]) }}"type="button" class="btn btn-warning w-50">Edit</a>
                           </td>
                        </tr>
                     @endfor
                  </tbody>
               </table>
            </div>
         </div>
      </div>
      @endif
@endsection