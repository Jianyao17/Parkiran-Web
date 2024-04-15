

/* Manage Ruang Parkir & Kendaraan */
const m_leftBox = document.querySelector("#leftBox");
const m_rightBox = document.querySelector("#rightBox");
const m_container = document.querySelector(".container-masuk");
const m_parkiran = document.querySelector("#parkiran");

let m_ruangKendaraan = [];
let m_kendaraan = [];
let selected = null


function UpdateKendaraanMasuk(jumlah) 
{
    m_ruangKendaraan.push(m_container);
    EventRuangKendaraan(m_container);

    for (let index = 0; index < jumlah; index++) 
    {    
        let kendaraan = MakeDivKendaraan("L0" + index, "  ");
        m_container.appendChild(kendaraan);
        m_kendaraan.push(kendaraan);
    }

    console.log(m_ruangKendaraan);
}

function UpdateParkiranKendaraan(jumlah) 
{
    for (let index = 0; index < jumlah; index++) {
        let slot = MakeDivRuangParkir("A" + index);
        m_parkiran.appendChild(slot);
        m_ruangKendaraan.push(slot);
    }
}


// Region Functions

function MakeDivKendaraan(platKendaraan, text) 
{
    let kendaraan = document.createElement("div");
    let header = document.createElement("div");
    let bodyText = document.createElement("div");

    kendaraan.className = "kendaraan py-2 pb-3 rounded-1 bg-primary";
    kendaraan.draggable = true;

    header.innerHTML = platKendaraan;
    header.className = "text-center text-white fs-5 fw-medium";
    kendaraan.appendChild(header);

    bodyText.id = "bodyText";
    bodyText.innerHTML = text;
    bodyText.className = "text-center text-white fs-6";
    bodyText.style = "--bs-text-opacity: .7;";
    kendaraan.appendChild(bodyText);

    EventKendaraan(kendaraan);
    return kendaraan;
}

function MakeDivRuangParkir(namaRuang)
{
    let ruangParkir = document.createElement("div");
    let slotId = document.createElement("div");

    ruangParkir.id = namaRuang;
    ruangParkir.className = "col slot-parkir border border-secondary-subtle rounded-1";

    slotId.className = "id-ruang text-center text-secondary fs-6";
    slotId.innerHTML = namaRuang;
    
    ruangParkir.appendChild(slotId);
    EventRuangKendaraan(ruangParkir);
    return ruangParkir;
}

function InsertKendaraan(ruang, kendaraan) 
{
    let bodyText = kendaraan.querySelector("#bodyText");
    bodyText.innerHTML = " ";
    
    let idRuang = ruang.querySelector(".id-ruang");
    if (idRuang) {
        bodyText.innerHTML = idRuang.innerHTML;
        idRuang.innerHTML = " ";
    }

    ruang.classList.remove("hovered");
    ruang?.appendChild(kendaraan);
}

function EventRuangKendaraan(ruangKendaraan) {

    ruangKendaraan.addEventListener("dragover", e => {
        e.preventDefault();
        ruangKendaraan.classList.add("hovered");
    })

    ruangKendaraan.addEventListener("dragleave", () => {
        ruangKendaraan.classList.remove("hovered");

        let idRuang = ruangKendaraan.querySelector(".id-ruang");
        if(idRuang) idRuang.innerHTML = ruangKendaraan.id;
    })

    ruangKendaraan.addEventListener("drop", () => {

        let isContainer = ruangKendaraan.classList.contains("container-masuk");

        if (isContainer == true) 
            InsertKendaraan(ruangKendaraan, selected);
        else if (ruangKendaraan.childNodes.length < 2 && !isContainer) 
            InsertKendaraan(ruangKendaraan, selected);
  
        selected = null;
    })

}

function EventKendaraan(kendaraan) {
    
    kendaraan.addEventListener("dragstart", e => {
        selected = e.target;
    })

    kendaraan.addEventListener("dragend", () => {
        selected = null;
    })

    kendaraan.addEventListener("drag", () => {
        updateDisplay = false;
    })
}


