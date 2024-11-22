<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Comment;

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
        $comment->user_id = 1;
        if ($comment->save())
            return redirect()->back()->with('status', 'Your comment has been added!');
        else
            return redirect()->back()->with('status', 'Added failed! Please try again.');
        ;
    }

    public function delete(Comment $id)
    {
        if ($id->delete()) {
            return redirect()->back()->with('status', 'Your comment has been deleted.');
        } else {
            return redirect()->back()->with('status', 'Your comment could not be deleted!');
        }
    }
    public function edit($id)
    {
        $comment = Comment::findOrFail( $id );
        return view('comments.update', ['comment' => $comment]);
    }
    public function update(Request $request, Comment $comment)
    {
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
