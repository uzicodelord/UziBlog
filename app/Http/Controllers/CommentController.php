<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $id)
    {
        $validatedData = $request->validate([
            'body' => 'required',
        ]);

        $post = Post::findOrFail($id);

        $comment = new Comment;
        $comment->body = $validatedData['body'];
        $comment->user_id = Auth::id();

        $post->comments()->save($comment);


        return redirect()->route('blog.index', $post->id)->with('success', 'Comment created successfully.');
    }

    public function edit($id, $comment_id)
    {
        $post = Post::findOrFail($id);
        $comment = Comment::findOrFail($comment_id);

        if ($comment->user_id != Auth::id()) {
            abort(403);
        }

        return view('blog.comments.edit', compact('post', 'comment'));
    }

    public function update(Request $request, $id, $comment_id)
    {
        $validatedData = $request->validate([
            'body' => 'required',
        ]);

        $post = Post::findOrFail($id);
        $comment = Comment::findOrFail($comment_id);

        if ($comment->user_id != Auth::id()) {
            abort(403);
        }

        $comment->body = $validatedData['body'];
        $comment->save();

        return redirect()->route('blog.index', $post->id)->with('success', 'Comment updated successfully.');
    }

    public function delete($id, $comment_id)
    {
        $post = Post::findOrFail($id);
        $comment = Comment::findOrFail($comment_id);

        if ($comment->user_id != Auth::id()) {
            abort(403);
        }

        return view('comments.delete', compact('post', 'comment'));
    }

    public function destroy($id, $comment_id)
    {
        $post = Post::findOrFail($id);
        $comment = Comment::findOrFail($comment_id);

        if ($comment->user_id != Auth::id()) {
            abort(403);
        }

        $comment->delete();

        return redirect()->route('blog.index', $post->id)->with('success', 'Comment deleted successfully.');
    }
}
