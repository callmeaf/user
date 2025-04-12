<?php

namespace Callmeaf\User\App\Imports\Admin\V1;

use Callmeaf\Base\App\Services\Importer;
use Callmeaf\User\App\Enums\UserStatus;
use Callmeaf\User\App\Enums\UserType;
use Callmeaf\User\App\Repo\Contracts\UserRepoInterface;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class UsersImport extends Importer implements ToCollection,WithChunkReading,WithStartRow,SkipsEmptyRows,WithValidation,WithHeadingRow
{
    private UserRepoInterface $userRepo;

    public function __construct()
    {
        $this->userRepo = app(UserRepoInterface::class);
    }

    public function collection(Collection $collection)
    {
        $this->total = $collection->count();

        foreach ($collection as $row) {
            $this->userRepo->freshQuery()->create([
                'status' => $row['status'],
                'type' => $row['type'],
                'first_name' => $row['first_name'],
                'last_name' => $row['last_name'],
                'mobile' => $row['mobile'],
                'email' => $row['email'],
            ]);
            ++$this->success;
        }
    }

    public function chunkSize(): int
    {
        return \Base::config('import_chunk_size');
    }

    public function startRow(): int
    {
        return 2;
    }

    public function rules(): array
    {
        $table = $this->userRepo->getTable();
        return [
            'status' => ['required',Rule::enum(UserStatus::class)],
            'type' => ['required',Rule::enum(UserType::class)],
            'first_name' => ['nullable','string','max:255'],
            'last_name' => ['nullable','string','max:255'],
            'mobile' => ['required','starts_with:09',Rule::unique($table,'mobile')],
            'email' => ['nullable','email',Rule::unique($table,'email')],
        ];
    }

}
