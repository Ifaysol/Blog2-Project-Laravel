<x-app-layout>
    <x-slot name="header">
        <div class=" flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Blog List') }}
            </h2>
            <a  class="px-4 py-2 bg-green-600" href="{{route("blogs.create")}}">Create Blog</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{route('blogs.index')}}" method="post">
                        @csrf
                        <table class="w-full">
                            <thead>
                              <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                                <th class="px-4 py-3">ID</th>
                                <th class="px-4 py-3">Name</th>
                                <th class="px-4 py-3">Image</th>
                                <th class="px-4 py-3">Status</th>
                                <th class="px-4 py-3">Action</th>
                              </tr>
                            </thead>
                            <tbody class="bg-white">
                                @forelse ($list as $blog)
                                <tr class="text-gray-700">
                                    <td class="px-4 py-3 border">
                                      <div class="flex items-center text-sm">
                                          <div>
                                            <p class="font-semibold text-black">{{$blog->id}}</p>
                                           
                                          </div>
                                        </div>
                                      </td>
                                      <td class="px-4 py-3 text-ms font-semibold border">{{$blog->post}}</td>
                                      <td class="px-4 py-3 text-ms font-semibold border">
                                          <img width = "40" src="{{asset($blog->image)}}" alt="image">
                                      </td>
                                      <td class="px-4 py-3 text-xs border">{{$blog->is_complete? "complete" : "incomplete"}}</td>
                                      <td class="px-4 py-3 text-sm border">
                                          <a class="px-2 py-1 bg-yellow-500" href="{{route("blogs.edit", $blog->id)}}">Edit</a>
                                          @if(!$blog->is_complete)
                                          <a class="px-2 py-1 bg-green-500 complete-blog" href="{{route("blogs.complete", $blog->id)}}" data-confirm="Are you sure to complete this?">Complete</a>   
                                          @endif
                                          <a class="px-2 py-1 bg-red-500 delete-row" href="{{route("blogs.destroy", $blog->id)}}" data-confirm="Are you sure to delete this?">Delete</a>
                                      </td>
                                    </tr>  
                                @empty
                                    <tr>
                                        <td class="col-span-1">{{__("No Blog Found")}}</td>
                                    </tr>
                                @endforelse
                             
                                
                              </tbody>
                            </table>
                            <div class=my-4>
                                {{-- {{$list->links()}} --}}
                            </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </x-app-layout>
                                    
                                         
