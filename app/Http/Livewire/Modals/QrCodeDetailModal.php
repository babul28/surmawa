<?php

namespace App\Http\Livewire\Modals;

use Livewire\Component;

class QrCodeDetailModal extends Component
{
    public string $code;

    public function render()
    {
        return view('livewire.modals.qr-code-detail-modal');
    }
}
