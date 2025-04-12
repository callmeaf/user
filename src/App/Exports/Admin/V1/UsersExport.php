<?php

namespace Callmeaf\User\App\Exports\Admin\V1;

use App\Models\User;
use Callmeaf\Base\App\Enums\DateTimeFormat;
use Callmeaf\User\App\Repo\Contracts\UserRepoInterface;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomChunkSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Excel;

class UsersExport implements FromCollection,WithHeadings,Responsable,WithMapping,WithCustomChunkSize
{
    use Exportable;

    /**
     * It's required to define the fileName within
     * the export class when making use of Responsable.
     */
    private $fileName = '';

    /**
     * Optional Writer Type
     */
    private $writerType = Excel::XLSX;

    /**
     * Optional headers
     */
    private $headers = [
        'Content-Type' => 'text/csv',
    ];

    private UserRepoInterface $userRepo;
    public function __construct()
    {
        $this->userRepo = app(UserRepoInterface::class);
        $this->fileName = $this->fileName ?: \Base::exportFileName(model: $this->userRepo->getModel()::class,extension: $this->writerType);
    }

    public function collection()
    {
        if(\Base::getTrashedData()) {
            $this->userRepo->trashed();
        }

        $this->userRepo->latest()->search();

        if(\Base::getAllPagesData()) {
            return $this->userRepo->lazy();
        }

        return $this->userRepo->paginate();
    }

    public function headings(): array
    {
        return [
            'status',
            'type',
            'first_name',
            'last_name',
            'mobile',
            'email',
            'created_at',
        ];
    }

    /**
     * @param User $row
     * @return array
     */
    public function map($row): array
    {
        return [
            $row->status?->value,
            $row->type?->value,
            $row->first_name,
            $row->last_name,
            $row->mobile,
            $row->email,
            $row->createdAtText(format: DateTimeFormat::DATE_TIME),
        ];
    }

    public function chunkSize(): int
    {
        return \Base::config('export_chunk_size');
    }
}
