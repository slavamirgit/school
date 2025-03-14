<?php

namespace App\Traits;

use Livewire\Attributes\Locked;

trait IsIndex
{
    #[Locked]
    public int $pageNumber;

    public function mountIsIndex(): void
    {
        $this->pageNumber = request()->page ?? 1;
    }

    public function updatingPage($pageNumber): void
    {
        $this->pageNumber = $pageNumber;
    }

    public function paginationView(): string
    {
        return 'misc.pagination';
    }
}
