const quantityInput = document.getElementById('quantity');
const increaseBtn = document.getElementById('increase');
const decreaseBtn = document.getElementById('decrease');

increaseBtn.addEventListener('click', function () {
    let currentValue = parseInt(quantityInput.value);
    quantityInput.value = currentValue + 1;
});

decreaseBtn.addEventListener('click', function () {
    let currentValue = parseInt(quantityInput.value);
    if (currentValue > 1) {
        quantityInput.value = currentValue - 1;
    }
});


function toggleDescription() {
    var shortDesc = document.getElementById("short-description");
    var fullDesc = document.getElementById("full-description");
    var toggleButton = document.getElementById("toggle-description");
    
    if (fullDesc.style.display === "none") {
        fullDesc.style.display = "block";
        toggleButton.innerText = "Thu gọn";
        shortDesc.style.display = "none";
    } else {
        fullDesc.style.display = "none";
        toggleButton.innerText = "Xem thêm";
        shortDesc.style.display = "block";
    }
}