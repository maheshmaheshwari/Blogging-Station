<?php

namespace App\Http\Controllers;

use App\Option;
use App\Page;

class PageController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  string $slug
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Throwable
     */
    public function show(string $slug)
    {
        $page = Page::whereSlug($slug)->first();

        if (!$page) {
            abort(404);
        }

        if ($page->status !== 1) {
            abort(404);
        }

        if ($slug != $page->slug) {
            return redirect($page->permalink(), 301);
        }

        if (strpos($page->content, '[withdrawal_methods]') !== false) {
            $withdrawal_methods = view('public._partials.withdrawal_methods')->render();
            $page->content = str_replace('[withdrawal_methods]', $withdrawal_methods, $page->content);
        }

        if (strpos($page->content, '[payout_rates]') !== false) {
            $payout_rates = view('public._partials.payout_rates')->render();
            $page->content = str_replace('[payout_rates]', $payout_rates, $page->content);
        }

        return view('public.pages.show', [
            'page' => $page,
        ]);
    }
}
