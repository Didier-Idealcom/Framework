<?php

namespace Modules\Menu\Repositories;

use Carbon\Carbon;
use Modules\Core\Repositories\CoreModelRepository;
use Modules\Menu\Entities\Menuitem;

class MenuitemRepository extends CoreModelRepository
{
    public function duplicate(Menuitem $menuitem): Menuitem
    {
        $new_menuitem = $menuitem->replicateWithTranslations();
        foreach ($new_menuitem->translations as $translation) {
            $translation->title_menu .= ' (copy)';
            $translation->title_page .= ' (copy)';
        }
        $new_menuitem->active = 'N';
        $new_menuitem->created_at = Carbon::now();
        $new_menuitem->updated_at = Carbon::now();
        $new_menuitem->save();

        return $new_menuitem;
    }
}
