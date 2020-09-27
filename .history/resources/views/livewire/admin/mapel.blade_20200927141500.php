<div>
    @include('layouts.header')
    @include('layouts.menu')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            @include('livewire.templates.title', $heading)
            <div class="page-title-actions">
                <button type="button" data-toggle="tooltip" title="Example Tooltip" data-placement="bottom" class="btn-shadow mr-3 btn btn-dark">
                    <i class="fa fa-star"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="mb-5 card">
                <div class="card-header-tab card-header">
                    <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                        Tabel {{ $this->heading['judul'] }}
                    </div>
                    <div class="btn-actions-pane-right text-capitalize">
                        <button type="button" class="btn btn-primary btn-sm" wire:click="$emit('showAddForm')" />
                            <i class="fas fa-plus"></i> Tambah
                        </button>
                    </div>
                </div>
                <div class="pt-3 card-body">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Mapel</th>
                                <th>Guru</th>
                                <th>Dibuat Oleh</th>
                                <th>Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($collection as $item)

                            @endforeach
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer')
    <!-- Modal -->
    <div class="modal fade" wire:ignore.self id="modal-mapel" tabindex="-1" role="dialog" aria-labelledby="modal-mapel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal {{ $this->heading['judul'] }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Nama Mapel</label>
                        <input type="text" class="form-control" wire:model.lazy="nama">
                        @error('nama') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Pilih Guru</label>
                        <select class="form-control" wire:model.lazy="guru">
                            <option value="">== Pilih Guru ==</option>
                            @foreach ($gurus as $guru)
                                <option value="{{ $guru->id }}">{{ $guru->name }}</option>
                            @endforeach
                        </select>
                        @error('guru') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" wire:click="simpan()">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</div>
@section('scripts')
<script>
window.livewire.on('closeAddForm', () => {
    $('#modal-mapel').modal('hide');
    $('.modal-backdrop').each(function(){
        $(this).remove();
    });
});
document.addEventListener('DOMContentLoaded', ()=>{
    @this.on('showAddForm', () => {
        // @this.call('clearForm');
        $('#modal-mapel').modal('toggle');
    });
});
</script>
@endsection
