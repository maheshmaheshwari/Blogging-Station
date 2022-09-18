<?php
/**
 * @var \Illuminate\Database\Eloquent\Builder|\App\Option[] $options
 */
?>

@extends('layouts.admin')

@section('title', e(__('Styling')))

@section('content')

    <form action="{{ route('admin.options.style') }}" method="post" enctype="multipart/form-data" id="style-settings"
          onSubmit="save_settings.disabled=true; save_settings.value='{{ __('Saving ...') }}'; return true;">
        @csrf

        <div class="nav-tabs-custom">

            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" href="#general" aria-controls="general" role="tab" data-toggle="tab">
                        <?= __('General') ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#header" aria-controls="header" role="tab" data-toggle="tab">
                        <?= __('Header') ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#footer" aria-controls="footer" role="tab" data-toggle="tab">
                        <?= __('Footer') ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#content" aria-controls="content" role="tab" data-toggle="tab">
                        <?= __('Content') ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#css" aria-controls="content" role="tab" data-toggle="tab">
                        <?= __('Custom CSS') ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#menus" aria-controls="menus" role="tab" data-toggle="tab">
                        <?= __('Menus') ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#sidebars" aria-controls="sidebars" role="tab" data-toggle="tab">
                        <?= __('Sidebars') ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#ads" aria-controls="ads" role="tab" data-toggle="tab">
                        <?= __('Ads') ?></a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">

                <div role="tabpanel" id="general" class="tab-pane fade show">

                    <div class="form-group ">
                        <label><?= __('Logo Image') ?></label>
                        {{ Form::text("style[logo_image]", old("style[logo_image]", $style['logo_image'] ?? ''),
                            ['class' => 'form-control']) }}
                    </div>

                    <div class="form-group ">
                        <label><?= __('Favicon') ?></label>
                        {{ Form::text("style[favicon]", old("style[favicon]", $style['favicon'] ?? ''),
                            ['class' => 'form-control']) }}
                        <small class="form-text text-muted"></small>
                    </div>

                    <div class="form-group ">
                        <label><?= __('Primary Color') ?></label>
                        {{ Form::text("style[primary_color]", old("style[primary_color]", $style['primary_color'] ?? ''),
                            ['class' => 'color-select form-control', 'autocomplete' => 'off']) }}
                    </div>

                    <div class="form-group ">
                        <label>{{ __('Body Typography') }}</label>
                        {!! html_typography('body_typography', $style['body_typography'] ?? '') !!}
                    </div>

                    <div class="form-group ">
                        <label>{{ __('Secondary Typography') }}</label>
                        {!! html_typography('secondary_typography', $style['secondary_typography'] ?? '') !!}
                    </div>

                    <div class="form-group ">
                        <label>{{ __('Body Background') }}</label>
                        {!! html_background('body_bg', $style['body_bg'] ?? '') !!}
                    </div>

                </div>


                <div role="tabpanel" id="header" class="tab-pane fade show">

                    <div class="form-group ">
                        <label>{{ __('Top Header Background') }}</label>
                        {!! html_background('top_header_bg', $style['top_header_bg'] ?? '') !!}
                    </div>

                    <div class="form-group ">
                        <label>{{ __('Top Header Typography') }}</label>
                        {!! html_typography('top_header_typography', $style['top_header_typography'] ?? '') !!}
                    </div>

                    <div class="form-group ">
                        <label>{{ __('Header Background') }}</label>
                        {!! html_background('header_bg', $style['header_bg'] ?? '') !!}
                    </div>

                    <div class="form-group ">
                        <label>{{ __('Main Menu Background') }}</label>
                        {!! html_background('main_menu_bg', $style['main_menu_bg'] ?? '') !!}
                    </div>

                    <div class="form-group ">
                        <label>{{ __('Main Menu Typography') }}</label>
                        {!! html_typography('main_menu_typography', $style['main_menu_typography'] ?? '') !!}
                    </div>

                </div>

                <div role="tabpanel" id="footer" class="tab-pane fade show">

                    <div class="form-group">
                        <label>{{ __('Footer Background') }}</label>
                        {!! html_background('footer_bg', $style['footer_bg'] ?? '') !!}
                    </div>

                    <div class="form-group">
                        <label>{{ __('Footer Typography') }}</label>
                        {!! html_typography('footer_typography', $style['footer_typography'] ?? '') !!}
                    </div>

                    <div class="form-group">
                        <label><?= __('Footer Widget Title Color') ?></label>
                        {{ Form::text("style[footer_widget_title_color]", old("style[footer_widget_title_color]", $style['footer_widget_title_color'] ?? ''),
                            ['class' => 'color-select form-control', 'autocomplete' => 'off']) }}
                    </div>


                </div>

                <div role="tabpanel" id="content" class="tab-pane fade show">

                    <div class="form-group">
                        <label>{{ __('Article Title Typography') }}</label>
                        {!! html_typography('article_title_typography', $style['article_title_typography'] ?? '') !!}
                    </div>

                    <div class="form-group">
                        <label>{{ __('Article Content Typography') }}</label>
                        {!! html_typography('article_content_typography', $style['article_content_typography'] ?? '') !!}
                    </div>

                    <div class="form-group">
                        <label>{{ __('Page Title Typography') }}</label>
                        {!! html_typography('page_title_typography', $style['page_title_typography'] ?? '') !!}
                    </div>

                    <div class="form-group">
                        <label>{{ __('Page Content Typography') }}</label>
                        {!! html_typography('page_content_typography', $style['page_content_typography'] ?? '') !!}
                    </div>

                </div>

                <div role="tabpanel" id="css" class="tab-pane fade show">

                    <div class="form-group">
                        <label>{{ __('Global CSS') }}</label>
                        <textarea name="style[global_css]" class="form-control" rows="10"><?= old("style[global_css]",
                                $style['global_css'] ?? '') ?></textarea>
                    </div>

                </div>

                <div role="tabpanel" id="menus" class="tab-pane fade show">

                    <div class="form-group ">
                        <label><?= __('Top Menu') ?></label>
                        {{ Form::select("style[top_menu]", $menus, old("style[top_menu]", $style['top_menu'] ?? ''),
                            ['class' => 'form-control', 'placeholder' => __('Menu Select')]) }}
                    </div>

                    <div class="form-group ">
                        <label><?= __('Main Menu') ?></label>
                        {{ Form::select("style[main_menu]", $menus, old("style[main_menu]", $style['main_menu'] ?? ''),
                            ['class' => 'form-control', 'placeholder' => __('Menu Select')]) }}
                    </div>

                    <div class="form-group ">
                        <label><?= __('Footer Menu') ?></label>
                        {{ Form::select("style[footer_menu]", $menus, old("style[footer_menu]", $style['footer_menu'] ?? ''),
                            ['class' => 'form-control', 'placeholder' => __('Menu Select')]) }}
                    </div>

                </div>

                <div role="tabpanel" id="sidebars" class="tab-pane fade show">

                    <div class="form-group row">
                        <div class="col-sm-2"><?= __('Category Sidebar') ?></div>
                        <div class="col-sm-10">
                            {{ Form::select("style[category_sidebar]", $sidebars, old("style[category_sidebar]", $style['category_sidebar'] ?? ''),
                                ['class' => 'form-control', 'placeholder' => __('Sidebar Select')]) }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-2"><?= __('Tag Sidebar') ?></div>
                        <div class="col-sm-10">
                            {{ Form::select("style[tag_sidebar]", $sidebars, old("style[tag_sidebar]", $style['tag_sidebar'] ?? ''),
                                ['class' => 'form-control', 'placeholder' => __('Sidebar Select')]) }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-2"><?= __('Article Sidebar') ?></div>
                        <div class="col-sm-10">
                            {{ Form::select("style[article_sidebar]", $sidebars, old("style[article_sidebar]", $style['article_sidebar'] ?? ''),
                                ['class' => 'form-control', 'placeholder' => __('Sidebar Select')]) }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-2"><?= __('Author Sidebar') ?></div>
                        <div class="col-sm-10">
                            {{ Form::select("style[author_sidebar]", $sidebars, old("style[author_sidebar]", $style['author_sidebar'] ?? ''),
                                ['class' => 'form-control', 'placeholder' => __('Sidebar Select')]) }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-2"><?= __('Search Sidebar') ?></div>
                        <div class="col-sm-10">
                            {{ Form::select("style[search_sidebar]", $sidebars, old("style[search_sidebar]", $style['search_sidebar'] ?? ''),
                                ['class' => 'form-control', 'placeholder' => __('Sidebar Select')]) }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-2"><?= __('Footer 1 Sidebar') ?></div>
                        <div class="col-sm-10">
                            {{ Form::select("style[footer1_sidebar]", $sidebars, old("style[footer1_sidebar]", $style['footer1_sidebar'] ?? ''),
                                ['class' => 'form-control', 'placeholder' => __('Sidebar Select')]) }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-2"><?= __('Footer 2 Sidebar') ?></div>
                        <div class="col-sm-10">
                            {{ Form::select("style[footer2_sidebar]", $sidebars, old("style[footer2_sidebar]", $style['footer2_sidebar'] ?? ''),
                                ['class' => 'form-control', 'placeholder' => __('Sidebar Select')]) }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-2"><?= __('Footer 3 Sidebar') ?></div>
                        <div class="col-sm-10">
                            {{ Form::select("style[footer3_sidebar]", $sidebars, old("style[footer3_sidebar]", $style['footer3_sidebar'] ?? ''),
                                ['class' => 'form-control', 'placeholder' => __('Sidebar Select')]) }}
                        </div>
                    </div>

                </div>

                <div role="tabpanel" id="ads" class="tab-pane fade show">

                    <div class="form-group ">
                        <label><?= __('Header Ad') ?></label>
                        {{ Form::select("style[header_ad]", $ads, old("style[header_ad]", $style['header_ad'] ?? ''),
                            ['class' => 'form-control', 'placeholder' => __('Ad Select')]) }}
                    </div>

                    <div class="form-group ">
                        <label><?= __('Above Article Ad') ?></label>
                        {{ Form::select("style[above_article_ad]", $ads, old("style[above_article_ad]", $style['above_article_ad'] ?? ''),
                            ['class' => 'form-control', 'placeholder' => __('Ad Select')]) }}
                    </div>

                    <div class="form-group ">
                        <label><?= __('Below Article Ad') ?></label>
                        {{ Form::select("style[below_article_ad]", $ads, old("style[below_article_ad]", $style['below_article_ad'] ?? ''),
                            ['class' => 'form-control', 'placeholder' => __('Ad Select')]) }}
                    </div>

                    <div class="form-group">
                        <h3><?= __('Ads Between Article Paragraphs') ?></h3>
                        <div class="form-inline mb-2">
                            <div class="form-group">
                                <label style="margin-right: 10px;"><?= __('Display the ads after paragraph') ?></label>
                                {{ Form::number("style[ads_article_paragraphs][0][p]", old("style[ads_article_paragraphs][0][p]", $style['ads_article_paragraphs'][0]['p']  ?? ''),
                                    ['class' => 'form-control', 'min' => '1', 'step' => '1']) }}

                                <label><?= __('Ad Select') ?></label>
                                {{ Form::select("style[ads_article_paragraphs][0][code]", $ads, old("style[ads_article_paragraphs][0][code]", $style['ads_article_paragraphs'][0]['code'] ?? ''),
                                    ['class' => 'form-control', 'placeholder' => __('Ad Select')]) }}
                            </div>
                        </div>

                        <div class="form-inline mb-2">
                            <div class="form-group">
                                <label style="margin-right: 10px;"><?= __('Display the ads after paragraph') ?></label>
                                {{ Form::number("style[ads_article_paragraphs][1][p]", old("style[ads_article_paragraphs][1][p]", $style['ads_article_paragraphs'][1]['p']  ?? ''),
                                    ['class' => 'form-control', 'min' => '1', 'step' => '1']) }}

                                <label><?= __('Ad Select') ?></label>
                                {{ Form::select("style[ads_article_paragraphs][1][code]", $ads, old("style[ads_article_paragraphs][1][code]", $style['ads_article_paragraphs'][1]['code'] ?? ''),
                                    ['class' => 'form-control', 'placeholder' => __('Ad Select')]) }}
                            </div>
                        </div>

                        <div class="form-inline mb-2">
                            <div class="form-group">
                                <label style="margin-right: 10px;"><?= __('Display the ads after paragraph') ?></label>
                                {{ Form::number("style[ads_article_paragraphs][2][p]", old("style[ads_article_paragraphs][2][p]", $style['ads_article_paragraphs'][2]['p']  ?? ''),
                                    ['class' => 'form-control', 'min' => '1', 'step' => '1']) }}

                                <label><?= __('Ad Select') ?></label>
                                {{ Form::select("style[ads_article_paragraphs][2][code]", $ads, old("style[ads_article_paragraphs][2][code]", $style['ads_article_paragraphs'][2]['code'] ?? ''),
                                    ['class' => 'form-control', 'placeholder' => __('Ad Select')]) }}
                            </div>
                        </div>

                        <div class="form-inline mb-2">
                            <div class="form-group">
                                <label style="margin-right: 10px;"><?= __('Display the ads after paragraph') ?></label>
                                {{ Form::number("style[ads_article_paragraphs][3][p]", old("style[ads_article_paragraphs][3][p]", $style['ads_article_paragraphs'][3]['p']  ?? ''),
                                    ['class' => 'form-control', 'min' => '1', 'step' => '1']) }}

                                <label><?= __('Ad Select') ?></label>
                                {{ Form::select("style[ads_article_paragraphs][3][code]", $ads, old("style[ads_article_paragraphs][3][code]", $style['ads_article_paragraphs'][3]['code'] ?? ''),
                                    ['class' => 'form-control', 'placeholder' => __('Ad Select')]) }}
                            </div>
                        </div>

                        <div class="form-inline mb-2">
                            <div class="form-group">
                                <label style="margin-right: 10px;"><?= __('Display the ads after paragraph') ?></label>
                                {{ Form::number("style[ads_article_paragraphs][4][p]", old("style[ads_article_paragraphs][4][p]", $style['ads_article_paragraphs'][4]['p']  ?? ''),
                                    ['class' => 'form-control', 'min' => '1', 'step' => '1']) }}

                                <label><?= __('Ad Select') ?></label>
                                {{ Form::select("style[ads_article_paragraphs][4][code]", $ads, old("style[ads_article_paragraphs][4][code]", $style['ads_article_paragraphs'][4]['code'] ?? ''),
                                    ['class' => 'form-control', 'placeholder' => __('Ad Select')]) }}
                            </div>
                        </div>


                        <div class="form-inline mb-2">
                            <div class="form-group">
                                <label style="margin-right: 10px;"><?= __('Display the ads after paragraph') ?></label>
                                {{ Form::number("style[ads_article_paragraphs][5][p]", old("style[ads_article_paragraphs][5][p]", $style['ads_article_paragraphs'][5]['p']  ?? ''),
                                    ['class' => 'form-control', 'min' => '1', 'step' => '1']) }}

                                <label><?= __('Ad Select') ?></label>
                                {{ Form::select("style[ads_article_paragraphs][5][code]", $ads, old("style[ads_article_paragraphs][5][code]", $style['ads_article_paragraphs'][5]['code'] ?? ''),
                                    ['class' => 'form-control', 'placeholder' => __('Ad Select')]) }}
                            </div>
                        </div>
                        <div class="form-inline mb-2">
                            <div class="form-group">
                                <label style="margin-right: 10px;"><?= __('Display the ads after paragraph') ?></label>
                                {{ Form::number("style[ads_article_paragraphs][6][p]", old("style[ads_article_paragraphs][6][p]", $style['ads_article_paragraphs'][6]['p']  ?? ''),
                                    ['class' => 'form-control', 'min' => '1', 'step' => '1']) }}

                                <label><?= __('Ad Select') ?></label>
                                {{ Form::select("style[ads_article_paragraphs][6][code]", $ads, old("style[ads_article_paragraphs][6][code]", $style['ads_article_paragraphs'][6]['code'] ?? ''),
                                    ['class' => 'form-control', 'placeholder' => __('Ad Select')]) }}
                            </div>
                        </div>
                        <div class="form-inline mb-2">
                            <div class="form-group">
                                <label style="margin-right: 10px;"><?= __('Display the ads after paragraph') ?></label>
                                {{ Form::number("style[ads_article_paragraphs][7][p]", old("style[ads_article_paragraphs][7][p]", $style['ads_article_paragraphs'][7]['p']  ?? ''),
                                    ['class' => 'form-control', 'min' => '1', 'step' => '1']) }}

                                <label><?= __('Ad Select') ?></label>
                                {{ Form::select("style[ads_article_paragraphs][7][code]", $ads, old("style[ads_article_paragraphs][7][code]", $style['ads_article_paragraphs'][7]['code'] ?? ''),
                                    ['class' => 'form-control', 'placeholder' => __('Ad Select')]) }}
                            </div>
                        </div>
                        <div class="form-inline mb-2">
                            <div class="form-group">
                                <label style="margin-right: 10px;"><?= __('Display the ads after paragraph') ?></label>
                                {{ Form::number("style[ads_article_paragraphs][8][p]", old("style[ads_article_paragraphs][8][p]", $style['ads_article_paragraphs'][8]['p']  ?? ''),
                                    ['class' => 'form-control', 'min' => '1', 'step' => '1']) }}

                                <label><?= __('Ad Select') ?></label>
                                {{ Form::select("style[ads_article_paragraphs][8][code]", $ads, old("style[ads_article_paragraphs][8][code]", $style['ads_article_paragraphs'][8]['code'] ?? ''),
                                    ['class' => 'form-control', 'placeholder' => __('Ad Select')]) }}
                            </div>
                        </div>
                        <div class="form-inline mb-2">
                            <div class="form-group">
                                <label style="margin-right: 10px;"><?= __('Display the ads after paragraph') ?></label>
                                {{ Form::number("style[ads_article_paragraphs][9][p]", old("style[ads_article_paragraphs][9][p]", $style['ads_article_paragraphs'][9]['p']  ?? ''),
                                    ['class' => 'form-control', 'min' => '1', 'step' => '1']) }}

                                <label><?= __('Ad Select') ?></label>
                                {{ Form::select("style[ads_article_paragraphs][9][code]", $ads, old("style[ads_article_paragraphs][9][code]", $style['ads_article_paragraphs'][9]['code'] ?? ''),
                                    ['class' => 'form-control', 'placeholder' => __('Ad Select')]) }}
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="form-group">
            <input type="submit" name="save_settings" class="btn btn-primary" value="{{ __('Save') }}">
        </div>

    </form>

@endsection

@push('footer')
    <script>
        /**
         * Bootstrap 4: Keep selected tab on page refresh
         */
        // store the currently selected tab in the localStorage
        $('#style-settings a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            var id = $(e.target).attr('href').substr(1);
            localStorage.setItem('style_settings_selectedTab', id);
        });

        // on load of the page: switch to the currently selected tab
        var selectedTab = localStorage.getItem('style_settings_selectedTab');

        if ($('#style-settings').length && selectedTab !== null) {
            $('#style-settings a[data-toggle="tab"][href="#' + selectedTab + '"]').tab('show');
        } else {
            $('#style-settings a[data-toggle="tab"]:first').tab('show');
        }

    </script>
@endpush
