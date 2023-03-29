<?php
namespace App\Http\Controllers;

use App\Models\Emoji;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Like;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{

    public function index()
    {
        $posts = Post::with(['user', 'comments', 'likes'])->latest()->simplePaginate(5);
        $likedByArr = [];
        $levelData = [];

        foreach ($posts as $post) {
            $likedBy = $this->getLikedBy($post);
            $likedByArr[$post->id] = $likedBy;

            $user = $post->user;
            $points = $user->points;
            $level = ceil($points / 3);
            $levelData[$user->id] = $level;
        }

        $emoji = Emoji::all();

        return view('blog.index', compact('posts', 'likedByArr', 'emoji', 'levelData'));
    }


    public function create()
    {
        $user = Auth::user();
        $level = ceil($user->points / 3); // calculate the user's level
        $emojis = Emoji::where('level', '<=', $level)->get(); // get the emojis that are unlocked based on the user's level
        return view('blog.create', compact('emojis'));
    }


    public function store(Request $request)
    {
        // Create a new post
        $post = new Post;
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = Auth::id();
        $post->emoji_id = $request->emoji_id;
        $post->save();



        // Update the author's points
        $user = User::find(Auth::id());
        $user->points += 1;
        $user->save();




        if ($request->input('emoji_id')) {
            $emoji = Emoji::findOrFail($request->input('emoji_id'));
            $post->emoji()->associate($emoji);
            $post->save();
        }
        // Redirect to the new post's page
        return redirect()->route('blog.index', $post);
    }


    public function show($id)
    {
        $post = Post::with('user', 'comments', 'likes')->findOrFail($id);

        // Get the names of users who liked the post
        $likedBy = $this->getLikedBy($post);

        return view('blog.show', compact('post', 'likedBy'));
    }


    public function edit($id)
    {
        $post = Post::findOrFail($id);

        if ($post->user_id != Auth::id()) {
            abort(403);
        }

        return view('blog.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        $post = Post::findOrFail($id);

        if ($post->user_id != Auth::id()) {
            abort(403);
        }

        $post->title = $validatedData['title'];
        $post->body = $validatedData['body'];
        $post->save();

        return redirect()->route('blog.index', $post->id)->with('success', 'Blog post updated successfully.');
    }

    public function delete($id)
    {
        $post = Post::findOrFail($id);

        if ($post->user_id != Auth::id()) {
            abort(403);
        }

        return view('blog.delete', compact('post'));
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if ($post->user_id != Auth::id()) {
            abort(403);
        }

        $post->delete();

        return redirect()->route('blog.index')->with('success', 'Blog post deleted successfully.');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $posts = Post::where('title', 'LIKE', "%$query%")
            ->orWhere('body', 'LIKE', "%$query%")
            ->get();
        return view('blog.search', ['posts' => $posts]);
    }

    public function like($id)
    {
        $post = Post::findOrFail($id);

        // Check if the user has already liked the post
        $existingLike = $post->likes()->where('user_id', Auth::id())->first();

        if ($existingLike) {
            // User has already liked the post, so remove the like
            $existingLike->delete();
        } else {
            // User has not liked the post, so add a like
            $like = new Like();
            $like->user_id = Auth::id();
            $like->post_id = $id;
            $like->save();
        }


        return back();
    }

    /**
     * @param $post
     * @return string
     */
    public function getLikedBy($post): string
    {
        $likedBy = $post->likes->pluck('user.name')->toArray();
        $likeCount = count($likedBy);
        if ($likeCount > 3) {
            $likedBy = array_slice($likedBy, 0, 3);
            $likedBy = implode(', ', $likedBy) . " and " . ($likeCount - 3) . " others";
        } else {
            $likedBy = implode(', ', $likedBy);
        }
        return $likedBy;
    }


}
