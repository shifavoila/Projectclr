<?php

namespace App\Http\Controllers\Codeclr;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use App\Models\Codeclr\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     * php artisan storage:link

     */
    public $app="codeclr";
    public $module="post";
    public function index(Post $post)
    {
        $alert = request()->session()->get('alert');
        $user = Auth::user();
        
        $allusers = Cache::remember('allusers',60, function () {
            User::all()->keyBy('id');
        });

        if($user->role == 'admin')
            $data = Post::paginate(3);
        else
            $data = Post::where('user_id', $user->id)->paginate(3);
            
        return view('apps.codeclr.index')->with('alert',$alert)->with('data',$data)->with('allusers',$allusers);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Post $post)
    {
        // $this->stub='create';
        $slug = strtolower(Str::random(8));
        return view('apps.codeclr.create')->with('slug',$slug);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request;

        if(isset($request->all()['image'])) {
            $file =$request->all()['image'];
            $filename='$data->id' . '.' .$file->getClientOriginalExtension();
            $path=Storage::disk('local')->putFileAs('images/', $request->file('image'),$filename,'public');
        }

        $post = new Post();
        $post->user_id = $data->user_id;
        $post->title = $data->title;
        $post->slug = $data->slug;
        $post->expiry = $data->expiry;
        $post->format = $data->format;
        $post->content = $data->content;
        $post->save();  
        
        $alert = "Succesfully created the post ".$post->title.".";
        return redirect()->route('post.index')->with('alert',$alert);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        Storage::disk('local')->put('example.txt', 'This is a sample');
        $alert = request()->session()->get('alert');
        $data = Post::where('id', $id)->first();

        $this->authorize('view', $data);

        return view('apps.codeclr.show')->with('data',$data)->with('alert',$alert);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Post::where('id', $id)->first();
        // $this->stub='edit';
        $this->authorize('update', $data);
        return view('apps.codeclr.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = Post::where('id', $id)->first();
        $this->authorize('update', $post);

        $data =  $request;
        $post->user_id = $data->user_id;
        $post->title = $data->title;
        $post->expiry = $data->expiry;
        $post->format = $data->format;
        $post->content = $data->content;
        $post->save();

        $alert = "Succesfully updated the post ".$post->title.".";
        return redirect()->route('post.index')->with('alert', $alert);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::where('id', $id)->first();
        $post->delete();

        $alert = "Succesfully deleted the post ".$post->title.".";
        return redirect()->route('post.index')->with('alert',$alert);
    }
}
