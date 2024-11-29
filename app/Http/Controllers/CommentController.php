<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|min:3",
            "desc" => "required|min:5",
        ]);
        $comment = new Comment;
        $comment->name = $request->name;
        $comment->desc = $request->desc;
        $comment->article_id = $request->article_id;
        $comment->user_id = Auth::id();
        if ($comment->save())
            return redirect()->back()->with('status', 'Your comment has been added!');
        else
            return redirect()->back()->with('status', 'Added failed! Please try again.');
        ;
    }

    public function delete($id)
    {
        $comment = Comment::findOrFail($id);
        Gate::authorize('update_comment', $comment);
        $comment->delete();
        return redirect()->route('article.show', ['article' => $comment->article_id])->with('status', 'Delete success');
    }
    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
        Gate::authorize('update_comment', $comment);
        return view('comments.update', ['comment' => $comment]);
    }
    public function update(Request $request, Comment $comment)
    {
        Gate::authorize('update_comment', $comment);
        $request->validate([
            "name" => "required|min:3",
            "desc" => "required|min:5",
        ]);

        $comment->name = $request->name;
        $comment->desc = $request->desc;

        if ($comment->save()) {
            return redirect()->route('article.show', ['article' => $comment->article_id])->with('status', 'Your comment has been updated!');
        } else {
            return redirect()->back()->with('status', 'Update failed! Please try again.');
        }
    }


}
