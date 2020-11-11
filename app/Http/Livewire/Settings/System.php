<?php

namespace App\Http\Livewire\Settings;

use Exception;
use Livewire\Component;
use Brotzka\DotenvEditor\DotenvEditor;
use Brotzka\DotenvEditor\Exceptions\DotEnvException;

class System extends Component
{

    public $key, $value;
    public $updateMode = false;

    private function resetInputFields()
    {
        $this->key = '';
        $this->value = '';
    }

    public function updated($field)
    {
        $this->validateOnly($field, [
            'key' => 'required|string',
            'value' => 'required|string',
        ]);
    }

    public function store()
    {
        $validatedDate = $this->validate([
            'key' => 'required|string',
            'value' => 'required|string',
        ]);
    }


    public function update()
    {
        $this->validate([
            'key' => 'required',
            'value' => 'required',
        ]);
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function render()
    {

        return view('settings.system',)
            ->layout('layouts.app', ['header' => 'System Settings']);
    }
}
