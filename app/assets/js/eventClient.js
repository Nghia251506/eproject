let currentIndexes = {
    'slider1': 0,
    'slider2': 0
};

// Tạo hàm cập nhật slider
function updateSlider(sliderId) {
    const slider = document.getElementById(sliderId);
    const images = slider.querySelectorAll('.slider-img');
    const currentIndex = currentIndexes[sliderId];

    // Xóa lớp active khỏi tất cả các hình ảnh
    images.forEach((img) => {
        img.classList.remove('active');
        img.style.opacity = '0.5'; // Mờ hình ảnh
    });

    // Thiết lập hình ảnh hiện tại rõ nhất
    images[currentIndex].classList.add('active');
    images[currentIndex].style.opacity = '1'; // Hình ảnh ở giữa sẽ rõ

    // Cập nhật vị trí của container
    const offset = -currentIndex * (images[0].clientWidth + 20); // Tính toán vị trí dựa trên width + margin
    slider.querySelector('.featured-container').style.transform = `translateX(${offset}px)`;
}

// Tạo hàm di chuyển slider
function moveSlider(sliderId, direction) {
    const images = document.querySelectorAll(`#${sliderId} .slider-img`);
    const totalImages = images.length;

    // Cập nhật chỉ số hiện tại
    if (direction === 'next') {
        currentIndexes[sliderId] = (currentIndexes[sliderId] + 1) % totalImages;
    } else if (direction === 'prev') {
        currentIndexes[sliderId] = (currentIndexes[sliderId] - 1 + totalImages) % totalImages;
    }

    updateSlider(sliderId);
}

// Hàm điều khiển chuyển sang phải
function moveRight(sliderId) {
    moveSlider(sliderId, 'next');
}

// Hàm điều khiển chuyển sang trái
function moveLeft(sliderId) {
    moveSlider(sliderId, 'prev');
}

// Tự động chuyển slide
function autoSlide(sliderId) {
    setInterval(() => {
        moveRight(sliderId);
    }, 3000); // 3000ms = 3 giây
}

// Khởi động slider ban đầu và bắt đầu tự động chuyển động
updateSlider('slider1');
updateSlider('slider2');
autoSlide('slider1');
autoSlide('slider2');
