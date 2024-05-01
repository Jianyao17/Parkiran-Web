<div>
    <div class="container">
        <div wire:ignore class="row p-4 justify-content-center">
            <div id="leftBox" class="col-5 p-2" style="max-width: 40%">
                <h5>Kendaraan Masuk</h5>
                <div class="nav nav-tabs rounded-top-2 bg-body-tertiary">
                    <div class="nav-link disabled fw-medium text-dark">Kendaraan Masuk : {{ $jumlahMasuk }}</div>
                </div>
                <div wire:poll class="tab-content border-start border-end border-bottom rounded-bottom-2"
                    style="height: 60vh; overflow-y: auto">
                    <div class="container-masuk d-flex flex-wrap justify-content-start align-content-start p-3 gap-3">

                    </div>
                </div>
            </div>
            <div wire:poll id="rightBox" class="col-7 p-2" style="max-width: 60%">
                <h5>Ruang Parkir</h5>
                <ul class="nav nav-tabs scrollable bg-body-tertiary rounded-top-2" id="ruangPrakirTab" role="tablist">
                    @foreach ($ruangParkir as $ruang)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link @if ($loop->first) active @endif d-flex align-items-baseline" 
                                id="{{ str_replace(' ', '', $ruang['nama_ruang']) }}-tab" data-bs-toggle="tab" type="button" 
                                data-bs-target="#{{ str_replace(' ', '', $ruang['nama_ruang']) }}-tab-pane" role="tab" 
                                aria-controls="{{ str_replace(' ', '', $ruang['nama_ruang']) }}-tab-pane" aria-selected="true">
                                <div class="fw-medium me-2">{{ $ruang['nama_ruang'] }}</div>
                                <div id="status-{{ $loop->index }}" class="text-secondary" style="font-size: 0.8rem">
                                    {{-- {{ $ruang['terpakai'] }}/{{ $ruang['kapasitas'] }} --}}
                                </div>
                            </button>
                        </li>
                    @endforeach

                </ul>
                <div class="tab-content border-start border-end border-bottom rounded-bottom-2" 
                style="height: 60vh; overflow-y: auto;" id="ruangPrakirTabContent">
                    @foreach ($ruangParkir as $ruang)
                        <div class="tab-pane @if ($loop->first) show active @endif" id="{{ str_replace(' ', '', $ruang['nama_ruang']) }}-tab-pane" 
                            role="tabpanel" aria-labelledby="{{ str_replace(' ', '', $ruang['nama_ruang']) }}-tab" tabindex="{{ $loop->index }}">
                            <div id="parkiran-{{ str_replace(' ', '', $ruang['nama_ruang']) }}" class="d-flex flex-wrap justify-content-start p-3 gap-3"></div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <div class="p-2 bg-body-tertiary border rounded-top-2" style="position: absolute; bottom: 0px"> 
                <div id="status-Updating" class="fs-6 d-flex align-items-center text-dark-emphasis visually-hidden">
                    <div class="mx-1 py-1 fw-normal" role="status">Menyimpan Perubahan...</div>
                    <span class="mx-2 py-1 spinner-border spinner-border-sm" aria-hidden="true"></span>
                </div>
                <div id="status-Updated" class="fs-6 d-flex align-items-center text-success">
                    <div class="mx-1 fw-normal" role="status">Perubahan Disimpan</div>
                    <i class="bi bi-database-fill-check mx-1" style="font-size: 1.3rem"></i>
                </div>
            </div>
        </div>        
    </div>

    @push('javascript')
        <script src="/js/scrollable.js"></script>
        <script src="/js/set-parkir.js"></script>
        <script>
            
            let m_livewire = null;

            document.addEventListener("livewire:load", () => { 
                m_livewire = @this;

                // Update Every 1 Seconds
                setInterval(() => { UpdateDatabase(m_livewire); }, 1000);
                setInterval(() => { UpdateStatus(m_livewire.ruangGroup); }, 500);
                
                // First inizialized
                UpdateStatus(m_livewire.ruangGroup);
                UpdateParkiranKendaraan(m_livewire.ruangParkir);
                UpdateKendaraanMasuk(m_livewire.kendaraanMasuk);
                UpdateKendaraanParkir(m_livewire.kendaraanParkir);

                Livewire.on('Update:RuangParkir', () => { UpdateParkiranKendaraan(m_livewire.ruangParkir); });
                Livewire.on('Update:KendaraanMasuk', () => { UpdateKendaraanMasuk(m_livewire.kendaraanMasuk); });
                Livewire.on('Update:KendaraanParkir', () => { UpdateKendaraanParkir(m_livewire.kendaraanParkir); });
            });
        </script>
    @endpush

</div>
