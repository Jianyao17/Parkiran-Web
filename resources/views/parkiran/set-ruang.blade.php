<div>
    <div class="container">
        <div class="row p-4 justify-content-center">
            <div id="leftBox" class="col-6 p-2">
                <h5>Kendaraan Masuk</h5>
                <div class="nav nav-tabs rounded-top-2 bg-body-tertiary">
                    <div class="nav-link disabled fw-semibold text-dark">Kendaraan Masuk : {{ $jumlahMasuk }}</div>
                </div>
                <div class="tab-content border-start border-end border-bottom rounded-bottom-2"
                    style="height: 60vh; overflow-y: auto">
                    <div wire:ignore.self class="container-masuk d-flex flex-wrap justify-content-start align-items-start p-3 gap-3">

                    </div>
                </div>
            </div>
            <div id="rightBox" class="col-6 p-2">
                <h5>Ruang Parkir</h5>
                <ul class="nav nav-tabs scrollable bg-body-tertiary rounded-top-2" id="ruangPrakirTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active d-flex align-items-baseline" id="lantai1-tab"
                            data-bs-toggle="tab" data-bs-target="#lantai1-tab-pane" type="button" role="tab"
                            aria-controls="lantai1-tab-pane" aria-selected="true">
                            <div class="fw-medium me-2">Lantai 1</div>
                            <div class="text-secondary" style="font-size: 0.8rem">0/34</div>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link d-flex align-items-baseline" id="lantai2-tab" data-bs-toggle="tab"
                            data-bs-target="#lantai2-tab-pane" type="button" role="tab"
                            aria-controls="lantai2-tab-pane" aria-selected="false">
                            <div class="fw-medium me-2">Lantai 2</div>
                            <div class="text-secondary" style="font-size: 0.8rem">0/32</div>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link d-flex align-items-baseline" id="contact-tab" data-bs-toggle="tab"
                            data-bs-target="#contact-tab-pane" type="button" role="tab"
                            aria-controls="contact-tab-pane" aria-selected="false">
                            <div class="fw-medium me-2">Lantai 3</div>
                            <div class="text-secondary" style="font-size: 0.8rem">0/24</div>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link d-flex align-items-baseline" id="contact-tab" data-bs-toggle="tab"
                            data-bs-target="#contact-tab-pane" type="button" role="tab"
                            aria-controls="contact-tab-pane" aria-selected="false">
                            <div class="fw-medium me-2">Lantai 3</div>
                            <div class="text-secondary" style="font-size: 0.8rem">0/24</div>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link d-flex align-items-baseline" id="contact-tab" data-bs-toggle="tab"
                            data-bs-target="#contact-tab-pane" type="button" role="tab"
                            aria-controls="contact-tab-pane" aria-selected="false">
                            <div class="fw-medium me-2">Lantai 3</div>
                            <div class="text-secondary" style="font-size: 0.8rem">0/24</div>
                        </button>
                    </li>


                </ul>
                <div class="tab-content border-start border-end border-bottom rounded-bottom-2" 
                style="height: 60vh; overflow-y: auto;" id="ruangPrakirTabContent">
                    <div class="tab-pane show active" id="lantai1-tab-pane" role="tabpanel"
                        aria-labelledby="lantai1-tab" tabindex="0">
                        <div id="parkiran" class="d-flex flex-wrap justify-content-start p-3 gap-3">
                            
                        </div>
                    </div>
                    <div class="tab-pane" id="lantai2-tab-pane" role="tabpanel" aria-labelledby="lantai2-tab"
                        tabindex="0">

                    </div>
                    <div class="tab-pane" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab"
                        tabindex="0">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="/js/scrollable.js"></script>
    <script type="text/javascript" src="/js/set-parkir.js"></script>
    <script type="text/javascript">
        
        let m_livewire = null;

        document.addEventListener("livewire:load", () => { 
            m_livewire = @this;
            console.log("livewire");
            UpdateKendaraanMasuk(m_livewire.jumlahMasuk);
            UpdateParkiranKendaraan(m_livewire.jumlahMasuk);
        });
    </script>
</div>
