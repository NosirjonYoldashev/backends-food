<?php

namespace App\Services;


use App\Models\User;
use App\Repositories\User\UserRepository;
use App\Transformers\UserTransformer;
use Illuminate\Database\DatabaseManager;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\DB;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use Prettus\Validator\Exceptions\ValidatorException;

class UserService extends BaseService
{
    public function __construct(DatabaseManager $databaseManager, Logger $logger, UserRepository $repository)
    {
        parent::__construct($databaseManager, $logger, $repository);

    }


    public function all()
    {
        return $this->formatData($this->repository->paginate(),'users');
    }


    public function show(User $user): array
    {
        $fractal = new Manager();
        $resource = new Item($user, new UserTransformer());

        return $this->formatData($fractal->createData($resource)->toArray(),'user');
    }


    /**
     * @throws ValidatorException
     */
    public function create($data): array
    {
        $user =  $this->repository->skipPresenter()->create($data);

        $this->syncRoles($user,$data['roles']);

       return $this->show($user);
    }


    public function update(User $user,$data)
    {
        $user->update($data);

        $this->syncRoles($user,$data['roles']);


        return $this->show($user);
    }

    public function delete(User $user)
    {
        return $user->delete();
    }

    public function forceDelete(User $user)
    {
        return $user->forceDelete();
    }

    protected function syncRoles(User $user,array $roles)
    {
        DB::table('role_user')->where('user_id', $user->id)->delete();

        foreach ($roles as $role) {
            $user->roles()->attach($role);
        }
    }
}
