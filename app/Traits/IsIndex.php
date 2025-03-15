<?php

namespace App\Traits;

use Illuminate\View\View;
use Livewire\Attributes\Locked;

trait IsIndex
{
    #[Locked]
    public array $data;
    #[Locked]
    public int $pageNumber;
    #[Locked]
    public string $view;

    public function mountIsIndex($data): void
    {
        $this->data = $data;
        $this->pageNumber = (int)request()->query('page', 1);
    }

    public function render(): View
    {
        $prev = parse_url($this->data['prev_page_url']);
        parse_str($prev['query'] ?? null, $prev);

        $next = parse_url($this->data['next_page_url']);
        parse_str($next['query'] ?? null, $next);

        return view($this->view, [
            'grades' => $this->data['data'],
            'prev' => $prev['page'] ?? null,
            'next' => $next['page'] ?? null
        ]);
    }
}
