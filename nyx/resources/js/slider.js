document.addEventListener('DOMContentLoaded', () => {
    //
    // 1) FILTER SIDEBAR TOGGLE
    //
    const openBtn       = document.getElementById('openFilter'),
        closeBtn      = document.getElementById('closeFilter'),
        filterSidebar = document.getElementById('filterSidebar'),
        overlay       = document.getElementById('overlay');

    openBtn.addEventListener('click', () => {
        filterSidebar.classList.add('active');
        overlay.classList.add('active');
    });
    closeBtn.addEventListener('click', () => {
        filterSidebar.classList.remove('active');
        overlay.classList.remove('active');
    });
    overlay.addEventListener('click', () => {
        filterSidebar.classList.remove('active');
        overlay.classList.remove('active');
    });

    //
    // 2) CUSTOM DUAL‐THUMB PRICE SLIDER
    //
    const slider    = document.getElementById('priceSlider'),
        thumbMin  = slider.querySelector('.thumb-min'),
        thumbMax  = slider.querySelector('.thumb-max'),
        progress  = slider.querySelector('.progress'),
        inputMin  = document.getElementById('min_price'),
        inputMax  = document.getElementById('max_price'),
        maxRange  = 500,
        priceGap  = 10;
    let activeThumb = null;

    // Redraw thumbs + fill bar based on input values
    function updateUI() {
        const minVal  = parseInt(inputMin.value, 10),
            maxVal  = parseInt(inputMax.value, 10),
            leftPct = (minVal / maxRange) * 100,
            rightPct= (maxVal / maxRange) * 100;

        thumbMin.style.left    = `calc(${leftPct}% - ${thumbMin.offsetWidth/2}px)`;
        thumbMax.style.left    = `calc(${rightPct}% - ${thumbMax.offsetWidth/2}px)`;
        progress.style.left    = `${leftPct}%`;
        progress.style.width   = `${rightPct - leftPct}%`;
    }

    // While dragging, clamp and enforce gap
    function onPointerMove(e) {
        const rect   = slider.getBoundingClientRect(),
            x      = Math.min(Math.max(0, e.clientX - rect.left), rect.width),
            val    = Math.round((x / rect.width) * maxRange),
            curMin = parseInt(inputMin.value,  10),
            curMax = parseInt(inputMax.value, 10);

        if (activeThumb === 'min') {
            inputMin.value = (val <= curMax - priceGap)
                ? val
                : curMax - priceGap;
        } else {
            inputMax.value = (val >= curMin + priceGap)
                ? val
                : curMin + priceGap;
        }
        updateUI();
    }

    function onPointerUp() {
        document.removeEventListener('pointermove', onPointerMove);
        document.removeEventListener('pointerup',   onPointerUp);
        activeThumb = null;
    }

    function onThumbDown(e) {
        e.preventDefault();
        activeThumb = e.currentTarget.classList.contains('thumb-min') ? 'min' : 'max';
        document.addEventListener('pointermove', onPointerMove);
        document.addEventListener('pointerup',   onPointerUp);
    }

    // Attach dragging handlers
    thumbMin.addEventListener('pointerdown', onThumbDown);
    thumbMax.addEventListener('pointerdown', onThumbDown);

    // Also update if user manually types numbers
    inputMin.addEventListener('input', updateUI);
    inputMax.addEventListener('input', updateUI);

    // Initial defaults if inputs are empty
    if (!inputMin.value) inputMin.value = 0;
    if (!inputMax.value) inputMax.value = maxRange;   // 500

// Initial draw
    updateUI();
});
