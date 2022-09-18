<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Validator;

class LanguageController extends AdminController
{
    /**
     * @return \Illuminate\Http\Response
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     * @see https://arjunphp.com/laravel-5-pagination-array/
     *
     */
    public function index()
    {
        //$this->langJsonGenerate();

        $files = \File::glob(resource_path('lang') . "/*.json");
        $languages = [];
        foreach ($files as $file) {
            $name = pathinfo($file, PATHINFO_FILENAME);
            $languages[] = $name;
        }

        $edit_language = request()->query('edit_language');

        if (in_array($edit_language, $languages)) {
            $items = json_decode(\File::get(resource_path('lang/' . $edit_language . '.json')), true);

            // Get current page form url e.x. &page=1
            $currentPage = LengthAwarePaginator::resolveCurrentPage();

            // Create a new Laravel collection from the array data
            $itemCollection = collect($items);

            // Define how many items we want to be visible in each page
            $perPage = 100;

            // Slice the collection to get the items to display in current page
            $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();

            // Create our paginator and pass it to the view
            $paginatedItems = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);

            // set url path for generated links
            $paginatedItems->setPath(request()->url());
        }

        return view('admin.languages.index', [
            'languages' => $languages,
            'edit_language' => $edit_language,
            'items' => $paginatedItems ?? [],
        ]);
    }

    public function create()
    {
        $files = \File::glob(resource_path('lang') . "/*.json");
        $languages = [];
        foreach ($files as $file) {
            $name = pathinfo($file, PATHINFO_FILENAME);
            $languages[] = $name;
        }

        $name = strtolower(request()->post('name'));

        $validator = Validator::make(['name' => $name], [
            'name' => [
                'required',
                'alpha',
                'size:2',
                function ($attribute, $value, $fail) use ($languages) {
                    if (array_key_exists($value, $languages)) {
                        return $fail(__('Language is already exists.'));
                    }
                },
            ],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if (\File::copy(resource_path('lang') . "/en.json", resource_path('lang') . '/' . $name . '.json')) {
            session()->flash('success', 'Add added.');
        }

        return redirect()->back();
    }

    public function destroy($language)
    {
        $files = \File::glob(resource_path('lang') . "/*.json");
        $languages = [];
        foreach ($files as $file) {
            $name = pathinfo($file, PATHINFO_FILENAME);
            $languages[] = $name;
        }

        if ($language === 'en') {
            session()->flash('danger', "en language cam't be deleted");
            return redirect()->back();
        }

        if (!in_array($language, $languages)) {
            session()->flash('danger', "Unknown language.");
            return redirect()->back();
        }

        \File::delete(resource_path('lang') . "/$language.json");

        session()->flash('success', 'Language has been deleted successfully.');
        return redirect()->route('admin.language.index');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function translationUpdate()
    {
        $files = \File::glob(resource_path('lang') . "/*.json");
        $languages = [];
        foreach ($files as $file) {
            $name = pathinfo($file, PATHINFO_FILENAME);
            $languages[] = $name;
        }

        $language = (string)request()->post('language');

        if (!in_array($language, $languages)) {
            session()->flash('danger', "Unknown language.");
            return redirect()->back();
        }

        $file_path = resource_path('lang/' . $language . '.json');

        $file_content = \File::get($file_path);

        $items = json_decode($file_content, true);

        $data = [
            'key' => (string)base64_decode(request()->post('key')),
            'translation' => (string)request()->post('translation'),
        ];

        $validator = Validator::make($data, [
            'key' => ['required', 'string'],
            'translation' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $items[$data['key']] = $data['translation'];


        $data = json_encode($items, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        \File::put($file_path, $data);

        return redirect()->back();
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function translationDelete()
    {
        $files = \File::glob(resource_path('lang') . "/*.json");
        $languages = [];
        foreach ($files as $file) {
            $name = pathinfo($file, PATHINFO_FILENAME);
            $languages[] = $name;
        }

        $language = (string)request()->post('language');

        if (!in_array($language, $languages)) {
            session()->flash('danger', "Unknown language.");
            return redirect()->back();
        }

        $file_path = resource_path('lang/' . $language . '.json');

        $file_content = \File::get($file_path);

        $items = json_decode($file_content, true);

        $data = [
            'key' => base64_decode(request()->post('key')),
        ];

        $validator = Validator::make($data, [
            'key' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $items[$data['key']] = '';

        $data = json_encode($items, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        \File::put($file_path, $data);

        return redirect()->back();
    }

    /**
     * @see https://github.com/barryvdh/laravel-translation-manager/blob/v0.5.2/src/Manager.php#L153
     */
    protected function langJsonGenerate()
    {
        $path = base_path();
        $stringKeys = [];
        $functions = [
            'trans',
            'trans_choice',
            'Lang::get',
            'Lang::choice',
            'Lang::trans',
            'Lang::transChoice',
            '@lang',
            '@choice',
            '__',
            '$trans.get',
        ];
        $stringPattern =
            "[^\w]" .                                     // Must not have an alphanum before real method
            '(' . implode('|', $functions) . ')' .             // Must start with one of the functions
            "\(" .                                          // Match opening parenthesis
            "(?P<quote>['\"])" .                            // Match " or ' and store in {quote}
            "(?P<string>(?:\\\k{quote}|(?!\k{quote}).)*)" . // Match any string that can be {quote} escaped
            "\k{quote}" .                                   // Match " or ' previously matched
            "[\),]";                                       // Close parentheses or new parameter
        // Find all PHP + Twig files in the app folder, except for storage
        $finder = new \Symfony\Component\Finder\Finder();
        $finder->in($path)->exclude('storage')->exclude('vendor')->name('*.php')
            ->name('*.twig')->name('*.vue')->files();
        /** @var \Symfony\Component\Finder\SplFileInfo $file */
        foreach ($finder as $file) {
            if (preg_match_all("/$stringPattern/siU", $file->getContents(), $matches)) {
                foreach ($matches['string'] as $key) {
                    if (preg_match("/(^[a-zA-Z0-9_-]+([.][^\1)\ ]+)+$)/siU", $key, $groupMatches)) {
                        // group{.group}.key format, already in $groupKeys but also matched here
                        // do nothing, it has to be treated as a group
                        continue;
                    }
                    //skip keys which contain namespacing characters, unless they also contain a
                    //space, which makes it JSON.
                    if (!(str_contains($key, '::') && str_contains($key, '.'))
                        || str_contains($key, ' ')) {
                        $stringKeys[] = $key;
                    }
                }
            }
        }
        // Remove duplicates
        $stringKeys = array_unique($stringKeys);
        $stringKeys = array_filter($stringKeys);

        $translations = array_flip($stringKeys);
        foreach ($translations as $key => &$value) {
            $value = '';
        }
        //ksort($translations);
        $data = json_encode($translations, JSON_PRETTY_PRINT);

        \File::put(resource_path('lang/en.json'), $data);
    }
}
