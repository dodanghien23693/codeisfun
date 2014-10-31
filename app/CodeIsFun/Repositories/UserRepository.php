<?php namespace CodeIsFun\Accounts;


use CodeIsFun\Core\EloquentRepository;
use CodeIsFun\Core\Exceptions\EntityNotFoundException;

class UserRepository extends EloquentRepository
{
    public function __construct(User $model)
    {
        $this->model = $model;
    }



    public function requireByName($name)
    {
        $model = $this->getByName($name);

        if ( ! $model) {
            throw new EntityNotFoundException("User with name {$name} could not be found.");
        }

        return $model;
    }

    public function getByName($name)
    {
        return $this->model->where('name', '=', $name)->first();
    }

    public function getFirstX($count)
    {
        return $this->model->take($count)->get();
    }

    /**
     * Determine if an email already exists for a user
     *
     * @param string $email
     * @return bool
     */
    public function emailExists($email)
    {
        return (bool) User::where('email', $email)->count();
    }
}
