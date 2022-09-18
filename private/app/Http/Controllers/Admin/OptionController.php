<?php

namespace App\Http\Controllers\Admin;

use App\Ad;
use App\Menu;
use App\Option;
use App\Page;
use App\Sidebar;

class OptionController extends AdminController
{
    public $options;

    public $settings;

    public function __construct()
    {
        parent::__construct();

        $this->options = Option::all();

        $settings = [];
        foreach ($this->options as $option) {
            $settings[$option->name] = [
                'id' => $option->id,
                'value' => $option->value,
            ];
        }
        $this->settings = $settings;
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::pluck('title', 'id');

        if ($this->save()) {
            buildEnvVars();

            \Cache::flush();

            session()->flash('success', __('Settings have been saved.'));

            return redirect()->route('admin.options.index');
        }

        return view('admin.options.index', [
            'options' => $this->options,
            'settings' => $this->settings,
            'pages' => $pages,
        ]);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function style()
    {
        $menus = Menu::pluck('name', 'id');

        $ads = Ad::whereStatus(1)->pluck('name', 'id');

        $sidebars = Sidebar::pluck('name', 'id')->all();

        $style = Option::where('name', 'style')->first();

        $style->value = unserialize($style->value);

        if (request()->isMethod('post')) {
            $data = request()->input('style');

            $fonts = require_once app_path('Helpers/fonts.php');

            $embed_google_fonts = [];

            foreach ($data as $key => &$value) {
                if ($value === null) {
                    $value = '';
                }

                if (is_array($value) && !empty($value['font_family'])) {
                    if (in_array($value['font_family'], $fonts['google'])) {
                        $embed_google_fonts[] = $value['font_family'];
                    }
                }
            }

            $style->value = serialize($data);

            $style->update();

            $google_fonts = Option::where('name', 'embed_google_fonts')->first();

            $google_fonts->value = serialize(array_unique($embed_google_fonts));

            $google_fonts->update();

            return redirect()->route('admin.options.style');
        }

        return view('admin.options.style', [
            'style' => $style->value,
            'menus' => $menus,
            'sidebars' => $sidebars,
            'ads' => $ads,
        ]);
    }

    protected function save()
    {
        if (request()->isMethod('post')) {
            foreach (request()->input('Options') as $key => $optionData) {
                if (is_array($optionData['value'])) {
                    $optionData['value'] = serialize($optionData['value']);
                }

                //Option::where('id', $key)->update(['value' => $optionData['value']]);
                $option = Option::find($key);

                $option->value = $optionData['value'];

                $option->save();
            }
            return true;
        }
        return false;
    }

    public function prices()
    {
        $prices = Option::where('name', 'payout_rates')->first();

        $prices->value = unserialize($prices->value);

        if (request()->isMethod('post')) {
            $data = [];
            foreach (request()->input('prices') as $country => $value) {
                if (!empty($value[1])) {
                    $data[$country] = [
                        '1' => abs($value[1]),
                        '2' => '',
                        '3' => '',
                    ];
                } elseif (!empty($value[2]) && !empty($value[3])) {
                    $data[$country] = [
                        '1' => '',
                        '2' => abs($value[2]),
                        '3' => abs($value[3]),
                    ];
                } else {
                    $data[$country] = [
                        '1' => '',
                        '2' => '',
                        '3' => '',
                    ];
                }
            }
            unset($country, $value);

            $prices->value = serialize($data);

            $prices->update();

            return redirect()->route('admin.prices');
        }

        return view('admin.options.prices', [
            'prices' => $prices,
        ]);
    }
}
