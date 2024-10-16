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

// desciption
function toggleDescription() {
    var shortDesc = document.getElementById("short-description");
    var fullDesc = document.getElementById("full-description");
    var toggleButton = document.getElementById("toggle-description");
    
    if (fullDesc.style.display === "none") {
        fullDesc.style.display = "block";
        toggleButton.innerText = "Collapse";
        shortDesc.style.display = "none";
    } else {
        fullDesc.style.display = "none";
        toggleButton.innerText = "See more";
        shortDesc.style.display = "block";
    }
}

// add to cart
document.getElementById("add-to-cart").addEventListener("click", function () {
    var productId = "<?php echo htmlspecialchars($product->id); ?>";
    var quantity = document.getElementById("quantity").value;

    // Clone sản phẩm hình ảnh để tạo hiệu ứng bay
    var imgElement = document.querySelector(".image_product img");
    var clonedImage = imgElement.cloneNode(true);
    clonedImage.classList.add("fly-to-cart");
    document.body.appendChild(clonedImage);

    // Lấy vị trí của sản phẩm và giỏ hàng
    var productPosition = imgElement.getBoundingClientRect();
    var cartIconPosition = document.querySelector(".shopping").getBoundingClientRect();

    // Thiết lập vị trí ban đầu của ảnh bay
    clonedImage.style.left = productPosition.left + "px";
    clonedImage.style.top = productPosition.top + "px";

    // Tạo hiệu ứng bay đến giỏ hàng
    setTimeout(function () {
        clonedImage.style.transform = `translate(${cartIconPosition.left - productPosition.left}px, ${cartIconPosition.top - productPosition.top}px) scale(0.1)`;
        clonedImage.style.opacity = "0";
    }, 100);

    // Xóa ảnh sau khi bay xong
    setTimeout(function () {
        document.body.removeChild(clonedImage);
    }, 1000);

    // AJAX: Thêm sản phẩm vào giỏ hàng
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "http://localhost/eproject/cart/add", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            alert("Product added to cart successfully!");
            // Cập nhật giỏ hàng (ví dụ: số lượng giỏ hàng ở góc phải)
            updateCart();
        }
    };
    xhr.send("product_id=" + productId + "&quantity=" + quantity);
});

// Cập nhật số lượng sản phẩm trong giỏ hàng
function updateCart() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "http://localhost/eproject/cart/getCount", true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var cartCount = JSON.parse(xhr.responseText).count;
            document.querySelector(".shopping a").textContent = "CART (" + cartCount + ")";
        }
    };
    xhr.send();
}
