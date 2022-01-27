<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Modal extends Component
{
    public bool $open = false;

    public string $modalBodyComponent = '';

    public string $maxWidth = 'lg';

    public array $data = [];

    protected $listeners = ['openModal', 'selfCloseModal' => 'closeModal'];

    public function openModal(string $component, array $data = [], array $options = []): void
    {
        $this->modalBodyComponent = $this->getModalComponentPath($component);
        $this->data = $data;

        foreach ($options as $key => $value) {
            $this->{$key} = $value;
        }
    }

    protected function getModalComponentPath(string $component): string
    {
        return sprintf('modals.%s', $component);
    }

    public function closeModal(): void
    {
        $this->reset();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|string
     */
    public function render()
    {
        return view('livewire.modal');
    }
}
