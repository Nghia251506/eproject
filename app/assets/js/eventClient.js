let currentIndexes = {
    'slider1': 0,
    'slider2': 0
};

function updateSlider(sliderId) {
    const slider = document.getElementById(sliderId);
    const images = slider.querySelectorAll('img');
    const currentIndex = currentIndexes[sliderId];

    // Xóa lớp active khỏi tất cả các hình ảnh
    images.forEach((img) => {
        img.classList.remove('active');
        img.style.opacity = '0.5'; // Mờ hình ảnh
    });

    // Thiết lập hình ảnh hiện tại rõ nhất
    images[currentIndex].classList.add('active');
    images[currentIndex].style.opacity = '1'; // Hình ảnh ở giữa sẽ rõ
}

function moveSlider(sliderId, direction) {
    const images = document.querySelectorAll(`#${sliderId} img`);
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

// Khởi động slider ban đầu
updateSlider('slider1');
updateSlider('slider2');
