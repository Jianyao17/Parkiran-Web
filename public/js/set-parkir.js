

/* Manage Ruang Parkir & Kendaraan */
const m_navtabs = document.querySelector(".scrollable");
const m_container = document.querySelector(".container-masuk");
const m_parkiran = document.querySelector("#ruangPrakirTabContent");

const jumlah_masuk = document.querySelector("#jumlah_masuk");
const db_updating = document.querySelector("#status-Updating");
const db_updated = document.querySelector("#status-Updated");

let m_kendaraanMasuk = [], m_kendaraanParkir = [];
let m_ruangKendaraan = [], m_status = [];
let selected = null;

let current_data = [];
let isDragging = false;
let isUpdated = false;

m_ruangKendaraan.push(m_container);
AddEventRuangKendaraan(m_container);


function UpdateStatus(ruangGroup)
{
    let jumlah = "Kendaraan Masuk : " + Object.keys(m_kendaraanMasuk).length;
    if (jumlah_masuk.innerHTML != jumlah) jumlah_masuk.innerHTML = jumlah;
    
    for (let i = 0; i < ruangGroup.length; i++) 
    {
        if (m_status[i] == null) m_status[i] = m_navtabs.querySelector("#status-" + i);
        m_status[i].innerHTML = ruangGroup[i].terpakai + "/" + ruangGroup[i].kapasitas;
    }
}

function UpdateKendaraanMasuk(dataMasuk) 
{
    for (let i = 0; i < dataMasuk.length; i++) 
    {    
        let plat_kendaraan = dataMasuk[i].plat_kendaraan;

        // Insert Kendaraan ke dalam array kendaraanMasuk jika belum ada
        if (!m_kendaraanMasuk[plat_kendaraan] && !m_kendaraanParkir[plat_kendaraan])
        {
            let kendaraan = MakeKendaraan(plat_kendaraan, "  ");
            m_kendaraanMasuk[plat_kendaraan] = kendaraan;
            m_container.appendChild(kendaraan);
        }
    }

    // Delete kendaraan if does not exist in dataMasuk array
    for (let key in m_kendaraanMasuk) 
    {
        let isContains = item => item.plat_kendaraan == key;
        if (!dataMasuk.some(isContains)) 
        { 
            m_container.removeChild(m_kendaraanMasuk[key]); 
            delete m_kendaraanMasuk[key]; 
        }
    }
}

function UpdateKendaraanParkir(kendaraanParkir)
{
    for (let i = 0; i < kendaraanParkir.length; i++) 
    {
        let no_plat = kendaraanParkir[i].plat_kendaraan;
        let kode_ruang = kendaraanParkir[i].ruang_parkir;

        // Insert Kendaraan ke dalam array kendaraanParkir jika belum ada
        if (!m_kendaraanParkir[no_plat])
        {
            let kendaraan = MakeKendaraan(no_plat, kode_ruang);
            m_kendaraanParkir[no_plat] = kendaraan;
            m_ruangKendaraan[kode_ruang].appendChild(kendaraan);
        }
    }

    // Delete kendaraan if does not exist in kendaraanParkir array
    for (let key in m_kendaraanParkir) 
    {
        let isContains = item => item.plat_kendaraan == key;
        if (!kendaraanParkir.some(isContains))  
        {
            m_kendaraanParkir[key].parentNode.removeChild(m_kendaraanParkir[key]);
            delete m_kendaraanParkir[key];
        }  
    }
}

function UpdateParkiranKendaraan(ruangParkir) 
{
    for (let i = 0; i < ruangParkir.length; i++) 
    {
        let id_element = "#parkiran-" + ruangParkir[i].nama_ruang.replace(/ /g,"");
        let group_ruang = m_parkiran.querySelector(id_element);

        ruangParkir[i].list_kode.forEach(kode_ruang => {
            
            if (!m_ruangKendaraan[kode_ruang]) 
            {
                let ruang = MakeRuangParkir(kode_ruang);
                m_ruangKendaraan[kode_ruang] = ruang;
                group_ruang.appendChild(ruang);
            }
        });
    }
}


// Region Functions

function MakeKendaraan(platKendaraan, text) 
{
    let kendaraan = document.createElement("div");
    let header = document.createElement("div");
    let bodyText = document.createElement("div");

    kendaraan.className = "kendaraan py-2 pb-3 rounded-1 bg-primary";
    kendaraan.draggable = true;

    header.id = "platKendaraan";
    header.innerHTML = platKendaraan;
    header.className = "text-center text-white fs-5 fw-medium";
    kendaraan.appendChild(header);

    bodyText.id = "bodyText";
    bodyText.innerHTML = text;
    bodyText.className = "text-center text-white fs-6";
    bodyText.style = "--bs-text-opacity: .7;";
    kendaraan.appendChild(bodyText);

    AddEventKendaraan(kendaraan);
    return kendaraan;
}

function MakeRuangParkir(namaRuang)
{
    let ruangParkir = document.createElement("div");
    let slotId = document.createElement("div");

    ruangParkir.id = namaRuang;
    ruangParkir.className = "col slot-parkir border border-secondary-subtle rounded-1";

    slotId.className = "id-ruang text-center text-secondary fs-6";
    slotId.innerHTML = namaRuang;
    
    ruangParkir.appendChild(slotId);
    AddEventRuangKendaraan(ruangParkir);
    return ruangParkir;
}

function InsertKendaraan(ruang, kendaraan) 
{
    let plat = kendaraan.querySelector("#platKendaraan");
    let bodyText = kendaraan.querySelector("#bodyText");
    bodyText.innerHTML = " ";
    
    let idRuang = ruang.querySelector(".id-ruang");
    if (idRuang) bodyText.innerHTML = idRuang.innerHTML;

    ruang.classList.remove("hovered");
    ruang?.appendChild(kendaraan);

    SwitchKendaraanItem();
    InsertOrUpdateDataArray();

    // Insert or Update Kendarran data to current_data array
    function InsertOrUpdateDataArray() 
    {
        let isContains = (x) => x.plat_kendaraan == plat.innerHTML;
        
        let data = {
            plat_kendaraan: plat.innerHTML,
            ruang_parkir: (idRuang) ? idRuang.innerHTML : null,
        };

        // Insert or Update data to array
        if (current_data.some(isContains)) {
            let index = current_data.findIndex(isContains);
            current_data[index] = data;
            isUpdated = true;

        } else {
            current_data.push(data);
            isUpdated = true;
        }
    }

    // Switch kendaraan Item from kendaraanMasuk to kendaraanParkir or inverse
    function SwitchKendaraanItem() 
    {
        let no_plat = plat.innerHTML;

        if (!m_kendaraanParkir[no_plat] && idRuang) 
        {
            let item = m_kendaraanMasuk[no_plat];
            delete m_kendaraanMasuk[no_plat];
            m_kendaraanParkir[no_plat] = item;

        } else if (!idRuang) {

            let item = m_kendaraanParkir[no_plat];
            delete m_kendaraanParkir[no_plat];
            m_kendaraanMasuk[no_plat] = item;
        }
    }
}

function AddEventRuangKendaraan(ruangKendaraan) {

    ruangKendaraan.addEventListener("dragover", e => {
        e.preventDefault();
        ruangKendaraan.classList.add("hovered");
    })

    ruangKendaraan.addEventListener("dragleave", () => {
        ruangKendaraan.classList.remove("hovered");
    })

    ruangKendaraan.addEventListener("drop", () => {

        let isContainer = ruangKendaraan.classList.contains("container-masuk");

        if (isContainer == true) // If container insert without child limit
            InsertKendaraan(ruangKendaraan, selected);
        else if (ruangKendaraan.childNodes.length < 2 && !isContainer) 
            InsertKendaraan(ruangKendaraan, selected);
  
        selected = null;
    })

}

function AddEventKendaraan(kendaraan) {
    
    kendaraan.addEventListener("dragstart", e => {
        selected = e.target;
    })

    kendaraan.addEventListener("drag", () => { 
        isDragging = true;
    });

    kendaraan.addEventListener("dragend", () => {
        selected = null;
        isDragging = false;
    })
}


function UpdateDatabase(livewire)
{    
    // Return if drag event OR no data changes
    if (isUpdated == false) return;
    
    db_updating.classList.remove("visually-hidden");
    db_updated.classList.add("visually-hidden");
    console.log("Updated");

    livewire.UpdateDatabase(current_data).then(() => { 
        db_updating.classList.add("visually-hidden");
        db_updated.classList.remove("visually-hidden");
        current_data.splice(0, current_data.length);
    });
    isUpdated = false;
}

