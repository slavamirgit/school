<?php

namespace App\Traits;

use Livewire\Attributes\Locked;

trait IsIndex
{
    #[Locked]
    public int $pageNumber;

    public function mountIsIndex($data): void
    {
        array_multisort(array_column($data, 'id'), SORT_ASC, $data);
        $this->data = $data;
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
