document.addEventListener('DOMContentLoaded', () => {

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

    const slider    = document.getElementById('priceSlider'),
        thumbMin  = slider.querySelector('.thumb-min'),
        thumbMax  = slider.querySelector('.thumb-max'),
        progress  = slider.querySelector('.progress'),
        inputMin  = document.getElementById('min_price'),
        inputMax  = document.getElementById('max_price'),
        maxRange  = 500,
        priceGap  = 10;
    let activeThumb = null;

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

    thumbMin.addEventListener('pointerdown', onThumbDown);
    thumbMax.addEventListener('pointerdown', onThumbDown);

    inputMin.addEventListener('input', updateUI);
    inputMax.addEventListener('input', updateUI);

    if (!inputMin.value) inputMin.value = 0;
    if (!inputMax.value) inputMax.value = maxRange;   // 500

    updateUI();

    const rangeInputs = document.querySelectorAll('input[type="range"]');
    const priceInputs = document.querySelectorAll('input[type="number"]');
    const minGap = 100;

    priceInputs.forEach(input => {
        input.addEventListener('change', e => {
            let minPrice = parseInt(priceInputs[0].value);
            let maxPrice = parseInt(priceInputs[1].value);

            if ((maxPrice - minPrice >= minGap) && maxPrice <= rangeInputs[1].max) {
                if (e.target.className === "min-input") {
                    rangeInputs[0].value = minPrice;
                    rangeInputs[0].style.background = `linear-gradient(to right, #d3d3d3 ${(minPrice - rangeInputs[0].min) / (rangeInputs[0].max - rangeInputs[0].min) * 100}%, #722243 ${(minPrice - rangeInputs[0].min) / (rangeInputs[0].max - rangeInputs[0].min) * 100}%, #722243 ${(maxPrice - rangeInputs[0].min) / (rangeInputs[0].max - rangeInputs[0].min) * 100}%, #d3d3d3 ${(maxPrice - rangeInputs[0].min) / (rangeInputs[0].max - rangeInputs[0].min) * 100}%)`;
                } else {
                    rangeInputs[1].value = maxPrice;
                    rangeInputs[0].style.background = `linear-gradient(to right, #d3d3d3 ${(minPrice - rangeInputs[0].min) / (rangeInputs[0].max - rangeInputs[0].min) * 100}%, #722243 ${(minPrice - rangeInputs[0].min) / (rangeInputs[0].max - rangeInputs[0].min) * 100}%, #722243 ${(maxPrice - rangeInputs[0].min) / (rangeInputs[0].max - rangeInputs[0].min) * 100}%, #d3d3d3 ${(maxPrice - rangeInputs[0].min) / (rangeInputs[0].max - rangeInputs[0].min) * 100}%)`;
                }
            }
        });
    });

    rangeInputs.forEach(input => {
        input.addEventListener('input', e => {
            let minVal = parseInt(rangeInputs[0].value);
            let maxVal = parseInt(rangeInputs[1].value);

            if ((maxVal - minVal) < minGap) {
                if (e.target.className === "min-range") {
                    rangeInputs[0].value = maxVal - minGap;
                } else {
                    rangeInputs[1].value = minVal + minGap;
                }
            } else {
                priceInputs[0].value = minVal;
                priceInputs[1].value = maxVal;
                rangeInputs[0].style.background = `linear-gradient(to right, #d3d3d3 ${(minVal - rangeInputs[0].min) / (rangeInputs[0].max - rangeInputs[0].min) * 100}%, #722243 ${(minVal - rangeInputs[0].min) / (rangeInputs[0].max - rangeInputs[0].min) * 100}%, #722243 ${(maxVal - rangeInputs[0].min) / (rangeInputs[0].max - rangeInputs[0].min) * 100}%, #d3d3d3 ${(maxVal - rangeInputs[0].min) / (rangeInputs[0].max - rangeInputs[0].min) * 100}%)`;
            }
        });
    });
});

