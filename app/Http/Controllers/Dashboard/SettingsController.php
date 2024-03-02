<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\InterFaces\Settings\SettingsRepositoryInterface;

class SettingsController extends Controller
{
    private $Settings;

    public function __construct(SettingsRepositoryInterface $Settings)
    {
        $this->Settings = $Settings;
    }

    public function index()
    {
        return $this->Settings->index();
    }

    public function smtp()
    {
        return $this->Settings->smtp();
    }
    public function smtpUpdate(Request $request)
    {
        return $this->Settings->smtpUpdate($request);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return $this->Settings->update($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
