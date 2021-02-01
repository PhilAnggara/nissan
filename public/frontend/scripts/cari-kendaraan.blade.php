@forelse ($items as $item)
<tr>
  <td>{{ $item->area }}</td>
  <td>{{ $item->merk }}</td>
  <td>{{ $item->model }}</td>
  <td>{{ $item->no_polisi }}</td>
  <td>{{ $item->warna }}</td>
  <td>
    <div class="text-center text-success">
          <i class="fa fa-circle text-success"></i>
          {{ \Carbon\Carbon::parse($item->jatuh_tempo_stnk)->diffForHumans() }}
    </div>
  </td>
  <td style="width: 130px !important;">
    <div class="text-center">
    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#detailModal-{{ $item->id }}">
        <i class="fa fa-eye"></i>
      </button>
      <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#editModal-{{ $item->id }}">
        <i class="fa fa-pencil-alt"></i>
      </button>
      <form action="{{ route('kendaraan.destroy', $item->id) }}" method="POST" class="d-inline">
        @csrf
        @method('delete')
        <button class="btn btn-danger btn-sm">
          <i class="fa fa-trash"></i>
        </button>
      </form>
    </div>
  </td>
</tr>
@empty
<tr>
  <td colspan="10" class="text-center">
    Data Kosong
  </td>
</tr>
@endforelse