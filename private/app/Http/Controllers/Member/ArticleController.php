<?php

namespace App\Http\Controllers\Member;

use App\Article;
use App\Category;
use App\Http\Requests\ArticleRequest;
use App\Mail\AdminNewArticle;
use App\Mail\AdminUpdateArticle;
use App\Tag;
use Illuminate\Support\Facades\Mail;

class ArticleController extends MemberController
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
                'status',
            ];

            foreach (request()->input('Filter') as $param_name => $param_value) {
                if (!$param_value) {
                    continue;
                }
                //$value = urldecode($value);
                if (in_array($param_name, $filter_fields)) {
                    $like_params = ['title'];

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

        $articles = Article::where('user_id', auth()->id())
            ->where($conditions)
            ->orderBy($orderBy['col'], $orderBy['dir'])
            ->paginate();

        $orderBy['dir'] = ($orderBy['dir'] === 'asc') ? 'desc' : 'asc';

        return view('member.articles.index', [
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
        $categories = Category::where('status', 1)->pluck('name', 'id');

        $tags = Tag::where('status', 1)->pluck('name', 'id');

        return view('member.articles.create', [
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\ArticleRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        $data = $request->only([
            'title',
            'slug',
            'summary',
            'content',
            'upload_featured_image',
            'main_category_id',
            'category',
            'tags',
            'reason',
            'read_time',
        ]);

        /**
         * @var \App\File|null $featured_image
         */
        $featured_image = \App\Helpers\Upload::process('upload_featured_image');

        if ($featured_image) {
            $data['featured_image_id'] = $featured_image->id;
        }

        $category = $data['category'];

        $data['user_id'] = auth()->id();

        $data['status'] = 3; // 3=New Pending Review

        $data['pay_type'] = 1;

        $reason = $data['reason'];

        unset($data['upload_featured_image'], $data['category'], $data['tags'], $data['reason']);

        $article = Article::create($data);

        $article->categories()->sync([$category => ['main' => 1]]);

        if ((bool)get_option('alert_admin_new_article', 1)) {
            if (!empty(get_option('admin_email'))) {
                Mail::send(new AdminNewArticle($article, $reason));
            }
        }

        session()->flash('message', __('Your article has been added and it is pending for review.'));

        return redirect()->route('member.articles.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Article $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        /**
         * Check if this article belongs to the auth user
         */
        if ($article->user_id !== auth()->id()) {
            abort(404);
        }

        /**
         * Only active articles can be edited
         */
        if ($article->status === 2) {
            session()->flash('danger', __("Rejected articles can not be edited."));

            return redirect()->route('member.articles.index');
        }

        $article_update = $article->tmp_content;

        if (empty($article->tmp_content)) {
            $article_update = new \stdClass();
            $article_update->title = $article->title;
            $article_update->slug = $article->slug;
            $article_update->summary = $article->summary;
            $article_update->content = $article->content;
            $article_update->featured_image_id = null;
        }

        return view('member.articles.edit', [
            'article' => $article,
            'article_update' => $article_update,
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
        /**
         * Check if this article belongs to the auth user
         */
        if ($article->user_id !== auth()->id()) {
            abort(404);
        }

        /**
         * Only active articles can be edited
         */
        if ($article->status === 2) {
            abort(404);
        }

        $data = $request->only([
            'title',
            'slug',
            'summary',
            'content',
            'upload_featured_image',
            'reason',
            'read_time',
        ]);

        /**
         * @var \App\File|null $featured_image
         */
        $featured_image = \App\Helpers\Upload::process('upload_featured_image');

        if ($featured_image) {
            $data['featured_image_id'] = $featured_image->id;
        }

        /**
         * 1=active, 2=Hard Disabled, 3=New Pending Review, 5=New Need Improvements, 4=Update Pending Review,
         * 6=Update Need Improvements, 7=Soft Disabled, 8=Draft
         */
        $currentStatus = $article->status;

        if ($currentStatus === 1) {
            $data['status'] = 4;
        }

        if ($currentStatus === 5) {
            $data['status'] = 3;
        }

        if ($currentStatus === 6) {
            $data['status'] = 4;
        }

        if (in_array($currentStatus, [3, 4])) {
            $data['status'] = $currentStatus;
        }

        $reason = $data['reason'];

        unset($data['upload_featured_image'], $data['reason']);

        if (in_array($data['status'], [3, 5])) {
            $data_save = [
                'title' => $data['title'],
                'slug' => $data['slug'],
                'summary' => $data['summary'],
                'content' => $data['content'],
                'featured_image_id' => $data['featured_image_id'] ?? null,
                'read_time' => $data['read_time'],
                'status' => $data['status'],
                'tmp_content' => null,
            ];
        } else {
            $tmp_data = [
                'title' => $data['title'],
                'slug' => $data['slug'],
                'summary' => $data['summary'],
                'content' => $data['content'],
                'featured_image_id' => $data['featured_image_id'] ?? null,
                'read_time' => $data['read_time'],
            ];

            $data_save = [
                'status' => $data['status'],
                'tmp_content' => $tmp_data,
            ];
        }

        if ($article->update($data_save)) {
            if ((bool)get_option('alert_admin_update_article', 1)) {
                if (!empty(get_option('admin_email'))) {
                    Mail::send(new AdminUpdateArticle($article, $reason));
                }
            }

            session()->flash('message', __('Your article is pending for review.'));

            return redirect()->route('member.articles.index');
        }
    }
}
