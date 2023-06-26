@extends('framework.app')
@section('title','Home Page')
@section('content')
@if($alert)
<div class="bg-yellow-200 p-3 rounded border border-yellow-500 mb-4">{{$alert}}</div>
@endif
<h1 class="text-red-500 font-bold text-xl px-1">Index Page</h1>

<table class="px-4 border-2 w-full my-4 mb-48">
    <thead>
        <tr class="border-b-2">
            <th class="border-2 text-center p-2">ID</th>
            <th class="border-2 text-center p-2">User_ID</th>
            <th class="border-2 text-center p-2">Title</th>
            <th class="border-2 text-center p-2">Slug</th>
            <th class="border-2 text-center p-2">Access</th>
            <th class="border-2 text-center p-2">Expiry</th>
            <th class="border-2 text-center p-2">Format</th>
            <th class="border-2 text-center p-2">Created At</th>
        </tr>
    </thead>

    <tbody>
        @foreach($data as $record)
        <tr class="border-b-2">
            <td class="border-2 text-center p-2">{{$record->id}}</td>
            <td class="border-2 text-center p-2">{{Auth::user()->where('id',$record->user_id)->first()->name}}</td>
            <td class="border-2 text-center p-2">
                <a href="{{ route('post.show',$record->id) }}" class="text-blue-400">{{$record->title}}</a>
            </td>
            <td class="border-2 text-center p-2">{{$record->slug}}</td>
            <td class="border-2 text-center p-2">{{$record->access}}</td>
            <td class="border-2 text-center p-2">{{$record->expiry}}</td>
            <td class="border-2 text-center p-2">{{$record->format}}</td>
            <td class="border-2 text-center p-2">{{$record->created_at}}</td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $data->links() }}
@endsection