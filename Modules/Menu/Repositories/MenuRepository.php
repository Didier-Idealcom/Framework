<?php

namespace Modules\Menu\Repositories;

use Illuminate\Support\Facades\DB;
use Modules\Core\Repositories\CoreModelRepository;
use Modules\Menu\Entities\Menuitem;

class MenuRepository extends CoreModelRepository
{
    // Update record in the database
    public function update(int $id, array $inputs): bool
    {
        $updated = parent::update($id, $inputs);

        if (! empty(request()->get('menuitems_data'))) {
            $menuitems_data = json_decode(request()->get('menuitems_data'));
            DB::transaction(function () use ($menuitems_data) {
                foreach ($menuitems_data as $menuitem_data) {
                    Menuitem::where('id', $menuitem_data->id)
                        ->update([
                            'niveau' => $menuitem_data->depth,
                            'bg' => $menuitem_data->left - 1,
                            'bd' => $menuitem_data->right - 1,
                            'parent_id' => ! empty($menuitem_data->parent_id) ? $menuitem_data->parent_id : null,
                        ]);
                }
            });
        }

        return $updated;
    }
}
