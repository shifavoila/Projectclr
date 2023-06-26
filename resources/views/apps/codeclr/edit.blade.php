@extends('framework.app')
@section('title','Edit Post')
@section('content')
<h1 class="text-red-500 font-bold text-xl ps-7">Edit Page</h1>

<form action="{{ route('post.update',$data->id) }}" method="POST" class="px-8">
    <div class="grid grid-cols-3 mt-4">
        <label for="" class="col-span-1">Title</label>
        <input type="text" value="{{ $data->title }}" name="title" class="col-span-2 rounded border border-gray-300">
    </div>
    <div class="grid grid-cols-3 mt-4">
        <label for="" class="col-span-1">Slug</label>
        <input type="text" value="{{$data->slug}}" disabled name="slug" class="col-span-2 rounded border border-gray-300">
    </div>
    <div class="grid grid-cols-3 mt-4">
        <label for="access" class="col-span-1">Access</label>
        <div class="col-span-2">
            <input type="radio" id="Public" name="access" value="public">
            <label for="Public" class="py-2 pe-4" @if($data->access == 'public') selected @endif >Public</label>
            <input type="radio" id="Private" name="access" value="private">
            <label for="Private" class="py-2 pe-3" @if($data->access == 'private') selected @endif >Private</label>
            <input type="radio" id="Protected" name="access" value="protected">
            <label for="Protected" class="py-2 pe-3" @if($data->access == 'protected') selected @endif >Protected</label>
        </div> 
    </div>
    <div class="grid grid-cols-3 mt-4">
        <label class="col-span-1">Expires</label>
  
        <div class="col-span-2">
            <select class="w-full rounded border border-gray-300" name='expiry'>
                <option name='expiry' @if($data->expiry == 'After read') selected @endif >After read</option>
                <option name='expiry' @if($data->expiry == 'After 1 day') selected @endif >After 1 day</option>
                <option name='expiry' @if($data->expiry == 'After 7 days') selected @endif >After 7 days</option>
                <option name='expiry' @if($data->expiry == 'After 30 days') selected @endif >After 30 days</option>
                <option name='expiry' @if($data->expiry == 'Never') selected @endif >Never</option>
            </select>
        </div>
    </div>  
    <div class="grid grid-cols-3 mt-4">
        <label class="col-span-1">Format</label>
  
        <div class="col-span-2">
            <select class=" w-full rounded border border-gray-300" name='format'>
                <option selected>Text</option>
                <option>Code</option>
                <option>Raw</option>
            </select>
      </div>
    </div>  
    <div class="grid grid-cols-3 mt-4">
        <label for="" class="col-span-1">Code</label>
        <textarea name="content" id="" rows="10" class="col-span-2 border border-gray-300 rounded clicked:border-gray-400">{{ $data->content }}</textarea>
    </div>

    @csrf

    <div class="my-5 text-center">
        
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        <input type="hidden" name="_method" value="PUT">
        @csrf
        <button type="submit" class="bg-blue-800 text-white rounded px-4 py-2 text-center hover:bg-blue-600">Update Post</button>
    </div>
    
</form>

@endsection 