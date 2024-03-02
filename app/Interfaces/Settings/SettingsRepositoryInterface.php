<?php


namespace App\InterFaces\Settings;
use Illuminate\Database\Eloquent\Model;


interface SettingsRepositoryInterface{
    public function index();

    public function update($request);

    public function smtp();

    public function smtpUpdate($request);
}
