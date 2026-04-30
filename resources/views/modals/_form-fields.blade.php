{{--
    Partial: _form-fields.blade.php
    Dipakai oleh modal form pengajuan baru & perpanjangan.
    Variable $modalId wajib dipass dari parent include.
--}}

{{-- Jenis Fasyankes --}}
<div class="d-flex flex-column mb-8 fv-row">
    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
        <span class="required">Jenis Fasyankes</span>
        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
           title="Pilih jenis fasilitas pelayanan kesehatan Anda"></i>
    </label>
    <select name="jenis_fasyankes"
            data-control="select2"
            data-dropdown-parent="#{{ $modalId }}"
            data-placeholder="Pilih Jenis Fasyankes"
            class="form-select form-select-solid">
        <option value="">Pilih Jenis Fasyankes</option>
        <option value="klinik_pratama">Klinik Pratama</option>
        <option value="klinik_utama">Klinik Utama</option>
        <option value="praktek_mandiri">Praktek Mandiri</option>
        <option value="laboratorium">Laboratorium</option>
        <option value="optik">Optik</option>
        <option value="apotek">Apotek</option>
    </select>
</div>

{{-- Nama Fasyankes --}}
<div class="d-flex flex-column mb-8 fv-row">
    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
        <span class="required">Nama Fasyankes</span>
        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
           title="Nama resmi fasilitas pelayanan kesehatan"></i>
    </label>
    <input type="text" class="form-control form-control-solid"
           placeholder="Masukkan Nama Fasyankes" name="nama_fasyankes"/>
</div>

{{-- Nama Pemilik & Penanggung Jawab --}}
<div class="row g-9 mb-8">
    <div class="col-md-6 fv-row">
        <label class="required fs-6 fw-bold mb-2">Nama Pemilik Fasyankes
            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
               title="Nama pemilik/direktur fasyankes"></i>
        </label>
        <input type="text" class="form-control form-control-solid"
               placeholder="Masukkan Nama Pemilik" name="nama_pemilik"/>
    </div>
    <div class="col-md-6 fv-row">
        <label class="required fs-6 fw-bold mb-2">Nama Penanggung Jawab Fasyankes
            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
               title="Nama dokter/penanggung jawab klinis"></i>
        </label>
        <input type="text" class="form-control form-control-solid"
               placeholder="Masukkan Nama Penanggung Jawab" name="nama_penanggung_jawab"/>
    </div>
</div>

{{-- Email & Nomor HP --}}
<div class="row g-9 mb-8">
    <div class="col-md-6 fv-row">
        <label class="required fs-6 fw-bold mb-2">Email
            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
               title="Email aktif untuk notifikasi"></i>
        </label>
        <input type="email" class="form-control form-control-solid"
               placeholder="Masukkan Email" name="email"/>
    </div>
    <div class="col-md-6 fv-row">
        <label class="required fs-6 fw-bold mb-2">Nomor HP
            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
               title="Nomor HP yang dapat dihubungi"></i>
        </label>
        <input type="text" class="form-control form-control-solid"
               placeholder="Masukkan Nomor HP" name="nomor_hp"/>
    </div>
</div>

{{-- Alamat --}}
<div class="d-flex flex-column mb-8 fv-row">
    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
        <span class="required">Alamat</span>
        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
           title="Alamat lengkap fasyankes"></i>
    </label>
    <textarea class="form-control form-control-solid" rows="3"
              name="alamat" placeholder="Masukkan Alamat Lengkap"></textarea>
</div>

{{-- Kelurahan --}}
<div class="d-flex flex-column mb-8 fv-row">
    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
        <span class="required">Kelurahan</span>
        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"
           title="Kelurahan tempat fasyankes berada (wilayah kerja Puskesmas Tebet)"></i>
    </label>
    <select name="kelurahan"
            data-control="select2"
            data-dropdown-parent="#{{ $modalId }}"
            data-placeholder="Pilih Kelurahan"
            class="form-select form-select-solid">
        <option value="">Pilih Kelurahan</option>
        <option value="bukit_duri">Bukit Duri</option>
        <option value="kebon_baru">Kebon Baru</option>
        <option value="manggarai">Manggarai</option>
        <option value="manggarai_selatan">Manggarai Selatan</option>
        <option value="menteng_dalam">Menteng Dalam</option>
        <option value="tebet_barat">Tebet Barat</option>
        <option value="tebet_timur">Tebet Timur</option>
    </select>
</div>