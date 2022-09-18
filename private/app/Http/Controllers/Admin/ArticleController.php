<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Category;
use App\Http\Requests\ArticleRequest;
use App\Mail\MemberApprovedNewArticle;
use App\Mail\MemberApprovedUpdateArticle;
use App\Mail\MemberUpdateArticle;
use App\Tag;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ArticleController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $conditions = [];

        if (request()->input('Filter')) {
            $filter_fields = [
                'title',
                'user_id',
                'slug',
                'status',
            ];

            foreach (request()->input('Filter') as $param_name => $param_value) {
                if (!$param_value) {
                    continue;
                }
                //$value = urldecode($value);
                if (in_array($param_name, $filter_fields)) {
                    $like_params = ['title', 'slug'];

                    if (in_array($param_name, $like_params)) {
                        $conditions[] = [$param_name, 'like', '%' . $param_value . '%'];
                    } else {
                        $conditions[] = [$param_name, '=', $param_value];
                    }
                }
            }
        }

        $orderBy = [
            'col' => request()->input('order', 'id'),
            'dir' => request()->input('dir', 'desc'),
        ];

        $articles = Article::with('user')
            ->where($conditions)
            ->whereIn('status', [1, 2, 7])
            ->orderBy($orderBy['col'], $orderBy['dir'])
            ->paginate();

        $orderBy['dir'] = ($orderBy['dir'] === 'asc') ? 'desc' : 'asc';

        return view('admin.articles.index', [
            'articles' => $articles,
            'orderBy' => $orderBy,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::pluck('username', 'id');

        $categories = Category::where('status', 1)->orderBy('name')->pluck('name', 'id');

        $tags = Tag::where('status', 1)->orderBy('name')->pluck('name', 'id');

        return view('admin.articles.create', [
            'users' => $users,
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only([
            'title',
            'slug',
            'summary',
            'content',
            'status',
            'user_id',
            'disable_earnings',
            'upload_featured_image',
            'main_category',
            'categories',
            'tags',
            'message',
            'read_time',
        ]);

        /**
         * @var \App\File|null $featured_image
         */
        $featured_image = \App\Helpers\Upload::process('upload_featured_image');

        if ($featured_image) {
            $data['featured_image_id'] = $featured_image->id;
        }

        $tags = $data['tags'] ?? [];
        $categories = $data['categories'];

        $status = (int)$data['status'];

        if ($status === 1) {
            // Article New Approved
            $data['published_at'] = now();
        }

        $data['pay_type'] = 1;
        //$data['price'] = (floatval($data['price'])) ? price_database_format($data['price']) : null;

        $data['disable_earnings'] = (isset($data['disable_earnings']) && (bool)$data['disable_earnings']) ? 1 : null;

        $main_category = $data['main_category'];

        unset($data['upload_featured_image'], $data['main_category'], $data['categories'], $data['tags'],
            $data['message']);

        $article = Article::create($data);

        if ($article->id) {
            $article->tags()->sync($tags);

            $sycCategories = [];
            foreach ($categories as $category) {
                $category = (int)$category;
                $main_category = (int)$main_category;

                $sycCategories[$category] = ['main' => 0];
                if ($category === $main_category) {
                    $sycCategories[$category] = ['main' => 1];
                }
            }

            $article->categories()->sync($sycCategories);

            \Cache::forget('homepage');

            session()->flash('message', __('Article added.'));
        }

        return redirect()->route('admin.articles.edit', [$article->id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Article $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        if (!in_array($article->status, [1, 2, 7])) {
            abort(404);
        }

        $users = User::pluck('username', 'id');

        $categories = Category::where('status', 1)->orderBy('name')->pluck('name', 'id');

        $tags = Tag::where('status', 1)->orderBy('name')->pluck('name', 'id');

        return view('admin.articles.edit', [
            'article' => $article,
            'users' => $users,
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\ArticleRequest $request
     * @param \App\Article $article
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, Article $article)
    {
        if (!in_array($article->status, [1, 2, 7])) {
            abort(404);
        }

        $data = $request->only([
            'title',
            'slug',
            'summary',
            'content',
            'status',
            'user_id',
            'disable_earnings',
            'upload_featured_image',
            'main_category',
            'categories',
            'tags',
            'message',
            'read_time',
            'seo',
        ]);

        /**
         * @var \App\File|null $featured_image
         */
        $featured_image = \App\Helpers\Upload::process('upload_featured_image');

        if ($featured_image) {
            $data['featured_image_id'] = $featured_image->id;
        }

        $tags = $data['tags'] ?? [];
        $categories = $data['categories'];

        $old_status = (int)$article->status;
        $new_status = (int)$data['status'];
        $reason = $data['message'] ?? null;

        $data['pay_type'] = 1;
        //$data['price'] = (floatval($data['price'])) ? price_database_format($data['price']) : null;

        $data['disable_earnings'] = (isset($data['disable_earnings']) && (bool)$data['disable_earnings']) ? 1 : null;

        $main_category = $data['main_category'];

        unset($data['upload_featured_image'], $data['categories'], $data['main_category'], $data['tags'],
            $data['message']);

        if ($article->update($data)) {
            $article->tags()->sync($tags);

            $sycCategories = [];
            foreach ($categories as $category) {
                $category = (int)$category;
                $main_category = (int)$main_category;

                $sycCategories[$category] = ['main' => (int)($category === $main_category)];
            }

            $article->categories()->sync($sycCategories);

            \Cache::forget('homepage');

            if ($reason) {
                Mail::send(new MemberUpdateArticle($article, $reason));
            }

            session()->flash('message', __('Article updated.'));
        }

        return redirect()->route('admin.articles.edit', [$article->id]);
    }

    /**
     * @param \App\Article $article
     * @return \Illuminate\Http\Response
     */
    public function pay(Article $article)
    {
        if ((int)$article->pay_type === 2 && (bool)$article->paid) {
            abort(404);
        }

        if (request()->isMethod('post')) {
            $user = User::find($article->user_id);

            $user->timestamps = false;

            $userData = ['author_earnings' => price_database_format($user->author_earnings + $article->price)];

            if ($user->update($userData)) {
                $article->timestamps = false;

                $articleData = ['paid' => 1];

                $article->update($articleData);
            }

            return redirect()->route('admin.articles.index');
        }

        return view('admin.articles.pay', [
            'article' => $article,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Article $article
     * @return \Illuminate\Http\Response
     *
     * @throws \Exception
     */
    public function destroy(Article $article)
    {
        if ($article->delete()) {
            $article->tags()->detach();
            $article->categories()->detach();
            \DB::table('comments')->where('article_id', $article->id)->delete();
            $article->statistics()->delete();

            \App\Helpers\Image::deleteImage($article->featured_image);
        } else {
            session()->flash('message', 'Unable to delete this article.');
        }

        return redirect(route('admin.articles.index'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexNewPending()
    {
        $conditions = [];

        if (request()->input('Filter')) {
            $filter_fields = [
                'title',
                'user_id',
                'slug',
            ];

            foreach (request()->input('Filter') as $param_name => $param_value) {
                if (!$param_value) {
                    continue;
                }
                //$value = urldecode($value);
                if (in_array($param_name, $filter_fields)) {
                    $like_params = ['title', 'slug'];

                    if (in_array($param_name, $like_params)) {
                        $conditions[] = [$param_name, 'like', '%' . $param_value . '%'];
                    } else {
                        $conditions[] = [$param_name, '=', $param_value];
                    }
                }
            }
        }

        $orderBy = [
            'col' => request()->input('order', 'id'),
            'dir' => request()->input('dir', 'desc'),
        ];

        $articles = Article::with('user')
            ->where($conditions)
            ->where('status', 3)
            ->orderBy($orderBy['col'], $orderBy['dir'])
            ->paginate();

        $orderBy['dir'] = ($orderBy['dir'] === 'asc') ? 'desc' : 'asc';

        return view('admin.articles.indexNewPending', [
            'articles' => $articles,
            'orderBy' => $orderBy,
        ]);
    }

    /**
     * @param \App\Article $article
     * @return \Illuminate\Http\Response
     */
    public function newPendingEdit(Article $article)
    {
        if ($article->status !== 3) {
            abort(404);
        }

        $users = User::pluck('username', 'id');

        $categories = Category::where('status', 1)->orderBy('name')->pluck('name', 'id');

        $tags = Tag::where('status', 1)->orderBy('name')->pluck('name', 'id');

        return view('admin.articles.newPendingEdit', [
            'article' => $article,
            'users' => $users,
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Article $article
     * @return \Illuminate\Http\Response
     */
    public function newPendingProcess(ArticleRequest $request, Article $article)
    {
        if ($article->status !== 3) {
            abort(404);
        }

        //$validated = $request->validated();

        $data = $request->only([
            'title',
            'slug',
            'summary',
            'content',
            'status',
            'user_id',
            'disable_earnings',
            'upload_featured_image',
            'main_category',
            'categories',
            'tags',
            'message',
            'read_time',
            'seo',
        ]);

        /**
         * @var \App\File|null $featured_image
         */
        $featured_image = \App\Helpers\Upload::process('upload_featured_image');

        if ($featured_image) {
            $data['featured_image_id'] = $featured_image->id;
        }

        $tags = $data['tags'] ?? [];
        $categories = $data['categories'];

        $new_status = (int)$data['status'];

        if ($new_status === 1) {
            // Article Update Approved
            $data['published_at'] = now();
        }

        $data['pay_type'] = 1;

        $data['disable_earnings'] = (isset($data['disable_earnings']) && (bool)$data['disable_earnings']) ? 1 : null;

        $main_category = $data['main_category'];

        $message = $data['message'];

        unset($data['upload_featured_image'], $data['categories'], $data['main_category'], $data['tags'],
            $data['message']);

        $data['tmp_content'] = null;

        if ($article->update($data)) {
            $article->tags()->sync($tags);

            $sycCategories = [];
            foreach ($categories as $category) {
                $category = (int)$category;
                $main_category = (int)$main_category;

                $sycCategories[$category] = ['main' => (int)($category === $main_category)];
            }

            $article->categories()->sync($sycCategories);

            if ((bool)get_option('alert_member_approved_new_article')) {
                Mail::send(new MemberApprovedNewArticle($article, $message));
            }

            \Cache::forget('homepage');

            session()->flash('message', __('Article updated.'));
        }

        return redirect()->route('admin.articles.indexNewPending');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexUpdatePending()
    {
        $conditions = [];

        if (request()->input('Filter')) {
            $filter_fields = [
                'title',
                'user_id',
                'slug',
            ];

            foreach (request()->input('Filter') as $param_name => $param_value) {
                if (!$param_value) {
                    continue;
                }
                //$value = urldecode($value);
                if (in_array($param_name, $filter_fields)) {
                    $like_params = ['title', 'slug'];

                    if (in_array($param_name, $like_params)) {
                        $conditions[] = [$param_name, 'like', '%' . $param_value . '%'];
                    } else {
                        $conditions[] = [$param_name, '=', $param_value];
                    }
                }
            }
        }

        $orderBy = [
            'col' => request()->input('order', 'id'),
            'dir' => request()->input('dir', 'desc'),
        ];

        $articles = Article::with('user')
            ->where($conditions)
            ->where('status', 4)
            ->orderBy($orderBy['col'], $orderBy['dir'])
            ->paginate();

        $orderBy['dir'] = ($orderBy['dir'] === 'asc') ? 'desc' : 'asc';

        return view('admin.articles.indexUpdatePending', [
            'articles' => $articles,
            'orderBy' => $orderBy,
        ]);
    }

    /**
     * @param \App\Article $article
     * @return \Illuminate\Http\Response
     */
    public function updatePendingEdit(Article $article)
    {
        if ($article->status !== 4) {
            abort(404);
        }

        $users = User::pluck('username', 'id');

        $categories = Category::where('status', 1)->orderBy('name')->pluck('name', 'id');

        $tags = Tag::where('status', 1)->orderBy('name')->pluck('name', 'id');

        $article_update = $article->tmp_content;

        if (empty($article->tmp_content)) {
            $article_update = new \stdClass();
            $article_update->title = $article->title;
            $article_update->slug = $article->slug;
            $article_update->summary = $article->summary;
            $article_update->content = $article->content;
            $article_update->featured_image_id = null;
            $article_update->read_time = $article->read_time;
        }

        return view('admin.articles.updatePendingEdit', [
            'article' => $article,
            'article_update' => $article_update,
            'users' => $users,
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Article $article
     * @return \Illuminate\Http\Response
     */
    public function updatePendingProcess(ArticleRequest $request, Article $article)
    {
        if ($article->status !== 4) {
            abort(404);
        }

        //$validated = $request->validated();

        $data = $request->only([
            'title',
            'slug',
            'summary',
            'content',
            'status',
            'user_id',
            'disable_earnings',
            'read_time',
            'upload_featured_image',
            'main_category',
            'categories',
            'tags',
            'message',
            'read_time',
            'seo',
        ]);


        if ((int)$data['status'] === 6) {
            $article->update([
                'status' => $data['status'],
            ]);

            if ((bool)get_option('alert_member_approved_update_article')) {
                Mail::send(new MemberApprovedUpdateArticle($article, $data['message']));
            }

            session()->flash('message', __('Article updated.'));
            return redirect()->route('admin.articles.indexUpdatePending');
        }

        /**
         * @var \App\File|null $featured_image
         */
        $featured_image = \App\Helpers\Upload::process('upload_featured_image');

        if ($featured_image) {
            $data['featured_image_id'] = $featured_image->id;
        } elseif (isset($article->tmp_content->featured_image_id) && !empty($article->tmp_content->featured_image_id)) {
            $data['featured_image_id'] = $article->tmp_content->featured_image_id;
        }

        $tags = $data['tags'] ?? [];
        $categories = $data['categories'];

        $data['pay_type'] = 1;

        $data['disable_earnings'] = (isset($data['disable_earnings']) && (bool)$data['disable_earnings']) ? 1 : null;

        $main_category = $data['main_category'];

        $message = $data['message'];

        unset($data['upload_featured_image'], $data['categories'], $data['main_category'], $data['tags'],
            $data['message']);

        $data['tmp_content'] = null;

        if ($article->update($data)) {
            $article->tags()->sync($tags);

            $sycCategories = [];
            foreach ($categories as $category) {
                $category = (int)$category;
                $main_category = (int)$main_category;

                $sycCategories[$category] = ['main' => (int)($category === $main_category)];
            }

            $article->categories()->sync($sycCategories);

            if ((bool)get_option('alert_member_approved_update_article')) {
                Mail::send(new MemberApprovedUpdateArticle($article, $message));
            }

            \Cache::forget('homepage');

            session()->flash('message', __('Article updated.'));
        }

        return redirect()->route('admin.articles.indexUpdatePending');
    }

}
