<?php

namespace App\Http\Livewire\Settings\System;

use Livewire\Component;
use Brotzka\DotenvEditor\DotenvEditor;

class General extends Component
{
    public $site_title, $site_url, $db_conn, $db_host, $db_port, $db, $db_user, $db_pass;

    protected $rules = [
        'site_title' => 'required|string',
        'site_url' => 'required|url',
        'db_conn' => 'required',
        'db_host' => 'required',
        'db_port' => 'required',
        'db' => 'required',
        'db_user' => 'required',
        'db_pass' => 'required',
    ];

    protected $validationAttributes = [
        'site_title' => 'Site Title',
        'site_url' => 'Site Url',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount()
    {
        $env = new DotenvEditor();
        $data = $env->getContent();

        $this->site_title = $data['APP_NAME'];
        $this->site_url = $data['APP_URL'];
        $this->db_conn = $data['DB_CONNECTION'];
        $this->db_host = $data['DB_HOST'];
        $this->db_port = $data['DB_PORT'];
        $this->db = $data['DB_DATABASE'];
        $this->db_user = $data['DB_USERNAME'];
        $this->db_pass = $data['DB_PASSWORD'];
    }

    public function submit()
    {
        $this->validate();
        $env = new DotenvEditor();

        $env->changeEnv([
            'APP_NAME'   =>  " " . $this->site_title . " ",
            'APP_URL'   => $this->site_url,
            'DB_CONNECTION'   =>  $this->db_conn,
            'DB_HOST'   => $this->db_host,
            'DB_PORT'   => $this->db_port,
            'DB_DATABASE'   => $this->db,
            'DB_USERNAME'   => $this->db_user,
            'DB_PASSWORD'   => $this->db_pass,
        ]);
        $this->emit('alert', ['type' => 'success', 'message' => 'Data berhasil ditambahkan !']);
        return response()->json([]);
    }

    public function render()
    {
        return view('settings.system.general');
    }
}
