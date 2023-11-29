<?php

namespace Modules\Core\Repositories;

use Illuminate\Database\Eloquent\Model;
use Modules\Core\Classes\Slim;
use Modules\Core\Entities\Domain;
use Modules\Core\Entities\Role;
use Modules\Core\Entities\User;

class UserRepository extends CoreModelRepository
{
    // Create a new record in the database
    public function create(array $inputs): Model
    {
        $user = parent::create($inputs);

        $user->roles()->sync(request()->has('role') ? Role::whereIn('id', request()->get('role'))->get() : []);
        $user->domains()->sync(request()->has('domain') ? Domain::whereIn('id', request()->get('domain'))->get() : []);

        $this->processImages($user);

        return $user;
    }

    // Update record in the database
    public function update(int $id, array $inputs): bool
    {
        $updated = parent::update($id, $inputs);

        $user = $this->find($id);
        $user->roles()->sync(request()->has('role') ? Role::whereIn('id', request()->get('role'))->get() : []);
        $user->domains()->sync(request()->has('domain') ? Domain::whereIn('id', request()->get('domain'))->get() : []);

        $this->processImages($user);

        return $updated;
    }

    private function processImages(User $user): void
    {
        if (! empty(request()->get('slim'))) {
            // Pass Slim's getImages the name of your file input, and since we only care about one image, use Laravel's head() helper to get the first element
            $image = head(Slim::getImages());

            // Grab the ouput data (data modified after Slim has done its thing)
            if (isset($image['output']['data'])) {
                // Original file name
                $name = $image['output']['name'];
                $name = preg_replace('#(.*)\.(.*)#', 'users_avatar_'.$user->id.'.$2', $name);

                // Base64 of the image
                $data = $image['output']['data'];

                // Server path
                $path = base_path().'/public/images/users/';

                // Save the file to the server
                $file = Slim::saveFile($data, $name, $path, false);

                // Get the absolute web path to the image
                $imagePath = asset('images/users/'.$file['name']);

                $user->avatar = $imagePath;
                $user->save();
            }
        }
    }
}
