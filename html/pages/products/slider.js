/* Price range slider functionality */
/* Select all range and price input elements */
const rangeInput = document.querySelectorAll(".range-input input"),
    priceInput = document.querySelectorAll(".price-input input"),
    range = document.querySelector(".slider .progress");

/* Minimum price gap between min and max values */
let priceGap = 10;

/* Handle price input changes */
priceInput.forEach(input =>{
    input.addEventListener("input", e =>{
        let minPrice = parseInt(priceInput[0].value),
            maxPrice = parseInt(priceInput[1].value);

        /* Update range slider if price gap is valid and max price is within limits */
        if((maxPrice - minPrice >= priceGap) && maxPrice <= rangeInput[1].max){
            if(e.target.className === "input-min"){
                /* Update minimum range value and slider position */
                rangeInput[0].value = minPrice;
                range.style.left = ((minPrice / rangeInput[0].max) * 100) + "%";
            }else{
                /* Update maximum range value and slider position */
                rangeInput[1].value = maxPrice;
                range.style.right = 100 - (maxPrice / rangeInput[1].max) * 100 + "%";
            }
        }
    });
});

/* Handle range slider input changes */
rangeInput.forEach(input =>{
    input.addEventListener("input", e =>{
        let minVal = parseInt(rangeInput[0].value),
            maxVal = parseInt(rangeInput[1].value);

        /* Ensure minimum price gap is maintained */
        if((maxVal - minVal) < priceGap){
            if(e.target.className === "range-min"){
                /* Adjust minimum value to maintain gap */
                rangeInput[0].value = maxVal - priceGap
            }else{
                /* Adjust maximum value to maintain gap */
                rangeInput[1].value = minVal + priceGap;
            }
        }else{
            /* Update price inputs and slider positions */
            priceInput[0].value = minVal;
            priceInput[1].value = maxVal;
            range.style.left = ((minVal / rangeInput[0].max) * 100) + "%";
            range.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
        }
    });
});