<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\Eloquent\UserRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function __construct(private readonly UserRepository $userRepository)
    {
    }

    public function latestPaginated(int $perPage = 15): LengthAwarePaginator
    {
        return $this->userRepository->latestPaginated($perPage);
    }

    public function create(array $data): User
    {
        $user = $this->userRepository->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        if (!empty($data['roles'])) {
            $user->syncRoles($data['roles']);
        }

        return $user;
    }

    public function update(User $user, array $data): bool
    {
        $user->name = $data['name'];
        $user->email = $data['email'];
        if (!empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }
        $user->save();

        $user->syncRoles($data['roles'] ?? []);

        return true;
    }

    public function delete(User $user): bool
    {
        return $this->userRepository->delete($user);
    }
}
