<?php

namespace App;

class Category extends AppModel
{
    protected $guarded = ['id'];

    /**
     * The attributes that should be cast to native types.
     *
     * @see https://laravel.com/docs/5.7/eloquent-mutators#attribute-casting
     *
     * @var array
     */
    protected $casts = [
        'parent_id' => 'integer',
        'status' => 'boolean',
        'seo' => 'array',
    ];

    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }

    // https://stackoverflow.com/q/32215035
    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id')
            ->with('children')// nest through children
            ->orderBy('name');
    }

    public function permalink()
    {
        return route('category.show', ['slug' => $this->slug, 'category' => $this->id]);
    }

    public function feed()
    {
        return route('category.feed', ['slug' => $this->slug, 'category' => $this->id]);
    }

    public function getMetaDescription()
    {
        $description = $this->description;

        return $this->getTextChars($description, 160, true);
    }

    public static function getChildrenCategoriesIds($id)
    {
        $array = [];

        $categories = self::query()->where('parent_id', $id)->select(['id'])->get();
        if (count($categories)) {
            foreach ($categories as $category) {
                $array[$category->id] = $category->id;

                $array = $array + self::getChildrenCategoriesIds($category->id);
            }
        }
        return $array;
    }

    public static function display_categories($categories, $counter = 0)
    {
        foreach ($categories as $category) {
            ?>
            <tr>
                <td><?= e($category->id) ?></td>
                <td>
                    <a href="<?= e(route('admin.categories.edit', [$category->id])) ?>">
                        <?= str_repeat("", $counter) ?> <?= e($category->name) ?>
                    </a>
                </td>
                <td><?= e($category->slug) ?></td>
                <td><?= ($category->status) ? __('Active') : __('Inactive') ?></td>
                <td><?= display_date_timezone($category->updated_at) ?></td>
                <td><?= display_date_timezone($category->created_at) ?></td>
                <td>
                    <div class="d-inline-flex">
                        <a class="btn btn-sm btn-primary" target="_blank"
                           href="<?= e($category->permalink()) ?>">
                            <i class="fa fa-eye"></i></a>

                        <?= delete_form('admin.categories.destroy', $category->id) ?>
                    </div>
                </td>
            </tr>
            <?php
            $counter++;
            if (count($category->children)) {
                self::display_categories($category->children, $counter);
            }
        }
    }

    public static function categoryTree($parent_id = 0, $type = 'list')
    {
        if ('array' === $type) {
            $array = [];

            $categories = self::where('parent_id', $parent_id)->get();

            if (count($categories)) {
                foreach ($categories as $category) {
                    $array[$category->id] = $category->toArray();

                    $array[$category->id]['children'] = self::categoryTree($category->id, $type);
                }
            }
            return $array;
        }

        if ('list' === $type) {
            $html = '';

            $categories = self::where('parent_id', $parent_id)->get();

            if (count($categories)) {
                $html .= "<ul>";
                foreach ($categories as $category) {
                    $html .= "<li>";
                    $html .= $category->name;
                    $html .= self::categoryTree($category->id, $type);
                    $html .= "</li>";
                }
                $html .= "</ul>";
            }
            return $html;
        }

        if ('select' === $type) {
            $html = '';

            $category_array = self::categoryTree($parent_id, 'array');

            $html .= "<select>";
            $html .= self::categoryOption($category_array);
            $html .= "</select>";

            return $html;
        }
    }

    protected static function categoryOption($categories)
    {
        $html = '';

        foreach ($categories as $category) {
            $html .= "<option value='{$category['id']}'>{$category['name']}</option>";
            if (count($category['children'])) {
                $html .= self::categoryOption($category['children']);
            }
        }
        return $html;
    }
}
