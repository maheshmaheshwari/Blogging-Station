<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orderBy = [
            'col' => request()->input('order', 'id'),
            'dir' => request()->input('dir', 'desc'),
        ];

        $comments = Comment::orderBy($orderBy['col'], $orderBy['dir'])
            ->paginate(20);

        $orderBy['dir'] = ($orderBy['dir'] === 'asc') ? 'desc' : 'asc';

        return view('admin.comments.index', [
            'comments' => $comments,
            'orderBy' => $orderBy,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        return view('admin.comments.edit', [
            'comment' => $comment,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        $data = $request->only([
            'status',
            'content',
        ]);

        $validator = Validator::make($data, [
            'status' => 'required',
            'content' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.comments.edit', [$comment->id]))
                ->withErrors($validator)
                ->withInput();
        }

        $comment->update($data);

        session()->flash('success', 'The comment updated.');

        return redirect(route('admin.comments.edit', [$comment->id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment $comment
     * @return \Illuminate\Http\Response
     *
     * @throws \Exception
     */
    public function destroy(Comment $comment)
    {
        if ($comment->delete()) {
            session()->flash('success', __('Comment deleted.'));
        } else {
            session()->flash('danger', 'Unable to delete this comment.');
        }

        return redirect()->route('admin.comments.index');
    }
}
