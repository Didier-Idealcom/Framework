<?php

namespace Modules\Page\Repositories;

use Carbon\Carbon;
use Modules\Core\Repositories\CoreModelRepository;
use Modules\Page\Entities\Page;

class PageRepository extends CoreModelRepository
{
    public function duplicate(Page $page): Page
    {
        $new_page = $page->replicateWithTranslations();
        foreach ($new_page->translations as $translation) {
            $translation->title .= ' (copy)';
        }
        $new_page->active = 'N';
        $new_page->created_at = Carbon::now();
        $new_page->updated_at = Carbon::now();
        $new_page->save();

        return $new_page;
    }
}
