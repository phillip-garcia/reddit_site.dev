<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Post;
use App\Vote;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
class PostsController extends Controller
{
    protected $page_title = "Posts";
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('post_search')) {
            $search = $request->post_search;
            $page_title = "Search Results";
            $posts = Post::search($search);
            return view('posts.index')->with(['posts' => $posts, 'page_title' => $page_title]);
        } else {
            $posts = Post::with('user')->orderBy('created_at', 'desc')->paginate(5);
            return view('posts.index')->with(['posts' => $posts, 'page_title' => $this->page_title]);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $post = new  Post();
        $post->created_by = Auth::id();
        Log::info($request->all());
        return $this->validateAndSave($post, $request);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = $this->findPostOr404($id);
        $vote_score = $post->voteScore();
        $vote_up = "noVote";
        $vote_down = "noVote";
        if ($vote_score == 1) {
            $vote_up = "vote";
        } elseif ($vote_score == 0) {
            $vote_down = "vote";
        }
        return view('posts.show')->with(['post' => $post, 'vote_up' => $vote_up, 'vote_down' => $vote_down]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        if (!$post)
        {
            abort(404);
        }
        return view('posts.edit', ['post' => $post]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = $this->findPostOr404($id);
        return $this->validateAndSave($post, $request);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post =$this->findPostOr404($id);;
        $post->delete();
        $request->session()->flash('message', 'Post has been deleted');
        return redirect()->action('PostsController@index');
    }
//    Log::info()

    public function addVote($vote_value, $post_id)
    {
        $vote = Vote::with('post')->firstOrCreate([
            'post_id' => $post_id,
            'user_id' => Auth::user()->id
        ]);
        $vote->vote = $vote_value;
        $vote->save();
        $post = $vote->post;
        $post->save();
        return redirect()->action('PostsController@show', ['post_id' => $post_id]);
    }

    public function restore(Request $request, $id)
    {
        $post =Post::withTrashed()->where('id', $id)->first();
        $post->restore();
        $post->save();
        $request->session()->flash('message', 'Posts have be restored');
        return redirect()->action('PostsController@index');
    }
    protected function validateAndSave(Post $post, Request $request)
    {
        $request->session()->flash('error_message', 'Post was not saved successfully.');
        $this->validate($request, Post::$rules);
        $request->session()->forget('error_message');
        $post->title = $request->title;
        $post->content = $request->input("content");
        $post->url = $request->url;
        $post->save();
        session()->flash('success_message', 'Post saved successfully.');
        return redirect()->action('PostsController@index');
    }
    public function home()
    {
        return view('/home');
    }
    private function findPostOr404($id)
    {
        $post = Post::find($id);
        if (!$post) {
            Log::info("Post with ID $id cannot be found.");
            abort(404);
        }
        return $post;
    }
}