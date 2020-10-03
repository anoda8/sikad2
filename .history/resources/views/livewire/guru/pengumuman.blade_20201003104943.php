<div>
    @include('layouts.header')
    @include('layouts.menu_guru')
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
            <div class="mb-2 card">
                <div class="card-header-tab card-header">
                    <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                        Tambah {{ $this->heading['judul'] }}
                    </div>
                    <div class="btn-actions-pane-right text-capitalize">
                        <button class="btn btn-primary" wire:click="$emit('toggleAddForm')"><i class="fas fa-plus"></i> Tambah</button>
                    </div>
                </div>
                <div wire:ignore.self class="collapse" id="collapseTambah">
                    <div class="pt-3 card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                  <label for="">Judul Pengumuman</label>
                                  <input type="text" class="form-control" wire:model.lazy="judul"  placeholder="">
                                </div>
                                <label for="">Tujuan Pengumuman</label>
                                <div class="form-inline">
                                    <div class="form-group">
                                        <select class="form-control" wire:model.lazy="tujuan">
                                            <option value="">-- Pilih Tujuan Pengumuman --</option>
                                            <option value="all">Semua Warga Sekolah</option>
                                            <option value="guru">Semua Guru</option>
                                            <option value="siswa">Semua Siswa</option>
                                        </select>
                                    </div>
                                    <div class="form-group ml-3">
                                        <select class="form-control" wire:model.lazy="jurusanid">
                                            <option value="">-- Jurusan / Tingkat --</option>
                                            @foreach ($jurusans as $jurusan)
                                                <option value="{{ $jurusan->id }}">{{ $jurusan->tingkat }} - {{ $jurusan->singkat }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group ml-3">
                                        <select class="form-control" wire:model.lazy="kelasid">
                                            <option value="">-- Kelas --</option>
                                            @foreach ($kelases as $kelas)
                                                <option value="{{ $kelas->id }}">{{ $kelas->nama }}</option>
                                            @endforeach
                                        </select>
                                        @error('tanggal') <span class="text-danger error">{{ $message }}</span>@enderror
                                    </div>
                                </div><br>
                                <label for="">Tanggal - Waktu</label>
                                <div class="form-inline">
                                    <div class="form-group">
                                        <input type="date" class="form-control" wire:model.lazy="tanggal" placeholder="">
                                    </div>
                                    <div class="form-group ml-3">
                                        <input type="time" class="form-control" wire:model.lazy="waktu" placeholder="">
                                    </div>
                                </div>
                                @error('tanggal') <span class="text-danger error">{{ $message }}</span>@enderror
                                @error('waktu') <span class="text-danger error">{{ $message }}</span>@enderror
                                <hr>
                                <textarea name="isi_pengumuman" id="isi-pengumuman" wire:model.lazy="isipengumuman" rows="10"></textarea>
                                @error('isipengumuman') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="btn-actions-pane-right text-capitalize">
                            <button type="button" class="btn btn-success"><i class="fas fa-save"></i>&nbsp;Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer')
</div>
@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', ()=>{
    @this.on('toggleAddForm', () => {
        // @this.call('clearForm');
        CKEDITOR.instances['isi-pengumuman'].setData('');
        $('#collapseTambah').collapse('toggle');
    });
});
CKEDITOR.replace( 'isi-pengumuman' );
</script>
@endsection
