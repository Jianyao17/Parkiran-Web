
// Horizontal Scrollable Tabs
const scrollable = document.querySelector(".scrollable");

scrollable.addEventListener("wheel", e => {
    
    if (e.wheelDelta > 0) scrollable.scrollLeft -= 200;
    else scrollable.scrollLeft += 200;
    
}, {passive: true});
