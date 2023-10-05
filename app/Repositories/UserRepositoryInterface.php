<?php
namespace App\Repositories;

use App\Models\User;

interface UserRepositoryInterface
{
    public function getAll(): array;
    public function getById(int $id): User;
    public function create(array $data): User;
    public function update(int $id, array $data): bool;
    public function findByEmail(string $email): ?User;
}