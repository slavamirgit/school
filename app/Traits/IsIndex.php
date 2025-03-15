<?php

namespace App\Traits;

use Illuminate\View\View;
use Livewire\Attributes\Locked;

trait IsIndex
{
    #[Locked]
    public array $data;
    #[Locked]
    public string $view;

    public function mountIsIndex($data): void
    {
        $this->data = $data;
    }

    public function render(): View
    {
        $prev = parse_url($this->data['prev_page_url']);
        parse_str($prev['query'] ?? null, $prev);

        $next = parse_url($this->data['next_page_url']);
        parse_str($next['query'] ?? null, $next);

        return view($this->view, [
            'items' => $this->data['data'],
            'prev' => $prev,
            'next' => $next
        ]);
    }
}
