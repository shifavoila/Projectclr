@extends('framework.app')
@section('title','View Code')
@section('content')

@if(request()->get('delete'))
<div class="rounded bg-red-300 p-3 border-2 border-red-500 mb-4">
    <h1 class="text-red-700 font-bold">Confirm delete?</h1>

    <form action="{{ route('post.destroy', $data->id) }}" method="POST">
        <input type="hidden" name="_method" value="DELETE">
        @csrf
        <button type="submit" class="inline-flex rounded text-white options px-3 my-1 bg-red-700 hover:bg-red-600 py-1">I Confirm</button>
    </form>

</div>
@endif

<h1 class="text-red-500 font-bold text-xl ps-4 mb-4">{{$data->title}}</h1>

<!--section to view code-->
<div class="rounded mx-2 mb-8 bg-blue-700 " style="height: 73vh;">

    <div class="rounded p-3 px-8 flex justify-between text-center text-md-start"> 
        <div class=" my-1 text-white">HTML | 20.9 KB</div>
            <div class="inline-flex text-md-end my-1 space-x-2">
                
                @can('update', $data)
                <button type="submit" class="inline-flex rounded text-white options px-3 bg-blue-400 hover:bg-blue-500 py-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                </svg>
                <a href="{{ route('post.edit', $data->id) }}" class="ps-1"> Edit</a>
                </button>
                @endcan

                @can('delete', $data)
                <button class="inline-flex rounded text-white options px-3 bg-blue-400 hover:bg-blue-500 py-1">
                    <a href="{{ route('post.show',$data->id) }}?delete=1" class="flex">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg>
                    <div class="ps-1"> Delete</div>
                    </a>
                </button>
                @endcan
                                                
                <button class="inline-flex rounded text-white options px-3 bg-blue-400 hover:bg-blue-500 py-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" /></svg>
                <a href="{{ route('post.index') }}" class="ps-1"> Back</a>
                </button>
            </div>
        </div>
        <pre class="mx-4 rounded">
            <code>
                {{ $data->content }}
            </code>
        </pre>
    <!-- <textarea name="enter code" id=""  class="border-0 rounded shadow p-3 bg-white-200 mx-8" style="resize: none; height:60vh; width: 95%;" disabled> {{$data->content}} </textarea> -->
</div>

@endsection