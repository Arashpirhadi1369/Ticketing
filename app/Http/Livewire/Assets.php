<?php

namespace App\Http\Livewire;

use App\Models\Unit;
use App\Models\User;
use App\Models\Asset;
use Livewire\Component;
use App\Traits\Sortable;
use App\Traits\BulkAction;
use App\Traits\ResetInput;
use Livewire\WithPagination;
use App\Exports\AssetsExport;
use App\Traits\AdvanceSearch;
use Livewire\WithFileUploads;
use App\Traits\ConvertNumbers;
use App\Traits\ResetSearchFilters;
use Intervention\Image\ImageManager;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Assets extends Component
{
    use ConvertNumbers, ResetInput, ResetSearchFilters, Sortable, BulkAction, WithFileUploads, WithPagination, AdvanceSearch;

    protected $paginationTheme = 'bootstrap';

    public $entity;

    public $users;

    public $units;

    public $picture;

    public $editMode;

    public $componentName = "assets";

    protected $rules = [
        'entity.asset_tag'      => 'nullable|numeric|min:1|max:999999999',
        'entity.asset_name'     => 'required|min:1|max:200',
        'entity.asset_unit_id'  => 'required',
        'entity.belong_to_user' => '',
        'entity.asset_location' => '',
        'entity.delivery_date'  => '',
    ];

    public $filter  = 'all';

    public $filters = [
        'all'            => null,
        'unit_id'        => null,
        'belong_to_user' => null,
        'asset_location' => null,
    ];

    public $headers = ['asset_tag', 'asset_name', 'asset_unit_id', 'belong_to_user', 'asset_location', 'delivery_date', 'qrcode', 'picture'];

    public $modalFields = ['asset_tag', 'asset_name', 'asset_unit_id', 'belong_to_user', 'asset_location', 'delivery_date'];

    public function mount(Asset $entity)
    {
        $this->entity = $entity;
        $this->users   = User::get();
        $this->units   = Unit::get();
    }

    public function render()
    {
        if ($this->selectAll) {
            $this->selected = $this->assetsQuery->pluck('id')->map(fn($id) => (string) $id);
        }

        return view('livewire.assets', ['entities' => $this->entities]);
    }

    public function getentitiesQueryProperty()
    {
        if ($this->filters['unit_id']) {
            $unitIds = $this->relationSearch('App\Models\Unit', 'unit_id', 'name');
        }

        if ($this->filters['belong_to_user']) {
            $userIds = $this->relationSearch('App\Models\User', 'belong_to_user', 'name');
        }

        return Asset::query()
            ->when(
                $this->filters['all'],
                fn($query, $search) => $query
                    ->where('asset_name', 'like', '%' . $search . '%')
                    ->orwhere('asset_tag', 'like', '%' . $search . '%')
            )

            ->when($this->filters['asset_name'], fn($query, $search) => $query->where('asset_name', 'like', '%' . $search . '%'))
            ->when($this->filters['asset_location'], fn($query, $search) => $query->where('asset_location', 'like', '%' . $search . '%'))
            ->when($this->filters['unit_id'], fn($query) => $query->wherein('asset_unit_id', $unitIds))
            ->when($this->filters['belong_to_user'], fn($query) => $query->wherein('belong_to_user', $userIds))
            ->orderby($this->sortField, $this->sortDirection);
    }

    public function getentitiesProperty()
    {
        return $this->entitiesQuery->paginate(10);
    }

    public function ValidatePicture()
    {
        $this->validate(['picture' => 'file|mimes:png,jpg,jpeg|max:10240']);
    }

    public function storePicture($asset)
    {
        $manager = new ImageManager(new Driver());
        $image = $manager->read($this->picture);
        $image->scale(width: 600);
        $picturePath = "storage/uploads/assets/pictures/$asset->id.png";
        $image->toPng()->save($picturePath);

        $asset->picture = $picturePath;
        $asset->save();

        $this->picture = null;
        $this->dispatchBrowserEvent('pondReset');
    }

    public function store()
    {
        $this->validate();

        if (isset($this->picture)) {
            $this->ValidatePicture();
        }

        if ($this->editMode == true) {
            $this->validate();
            $this->entity->save();

            $asset = Asset::find($this->entity->id);

            if (isset($this->picture)) {
                $this->storePicture($asset);
            }

            $this->dispatchBrowserEvent('closeModal');
            $this->resetInput();
        } else {
            $asset = Asset::create([
                'asset_tag'         => $this->entity->asset_tag,
                'asset_name'        => $this->entity->asset_name,
                'asset_unit_id'     => $this->entity->asset_unit_id,
                'belong_to_user'    => $this->entity->belong_to_user,
                'asset_location'    => $this->entity->asset_location,
                'delivery_date'     => $this->entity->delivery_date,
            ]);

            $currentPublicIp = file_get_contents('https://api.ipify.org');
            $qrCode = QrCode::size(50)->generate("http://$currentPublicIp:8000/turnovers/create/$asset->id");
            $qrcodePath = "uploads/assets/qrcodes/$asset->id.svg";
            Storage::disk('public')->put($qrcodePath, $qrCode);
            $asset->qrcode = 'storage/' . $qrcodePath;
            $asset->save();

            if (isset($this->picture)) {
                $this->storePicture($asset);
            }

            $this->dispatchBrowserEvent('closeModal');
            $this->resetInput();
        }
    }

    public function edit(Asset $entity)
    {
        $this->entity = $entity;
        $this->editMode = true;
    }

    public function destroy()
    {
        $asset = Asset::find($this->entity->id);
        $asset->delete();
        $this->resetInput();
    }

    public function exportExcel()
    {
        return Excel::download(new AssetsExport(), 'Assets.xlsx');
    }
}
