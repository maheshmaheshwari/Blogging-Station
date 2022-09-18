<?php

namespace App\Http\Controllers\Admin;

class UpgradeController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.upgrade.index');
    }

    public function process()
    {
        @ini_set('memory_limit', '1024M');
        @set_time_limit(10 * 60);
        @ini_set('max_execution_time', 10 * 60);

        try {
            $result = \Artisan::call('migrate', ['--force' => true]);
        } catch (\Exception $ex) {
            $result = $ex->getMessage();
        }

        if ($result !== 0) {
            session()->flash('danger', $result);

            return redirect()->route('admin.upgrade');
        }

        \DB::table('options')
            ->where('name', 'version')
            ->update(['value' => APP_VERSION]);

        \Artisan::call('config:clear');

        session()->flash('success', __('Database upgraded successfully.'));

        return redirect()->route('admin.dashboard');
    }
}
