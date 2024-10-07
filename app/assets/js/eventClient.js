let currentIndexes = {
    'slider1': 0,
    'slider2': 0 // Thêm slide2
};

// Hàm chuyển slider theo hướng chỉ định
function moveSlider(sliderId, direction) {
    const slider = document.getElementById(sliderId);
    const images = slider.querySelectorAll('img');
    let currentIndex = currentIndexes[sliderId];

    images[currentIndex].classList.remove('active');
    
    if (direction === 'next') {
        currentIndexes[sliderId] = (currentIndex + 1) % images.length;
    } else if (direction === 'prev') {
        currentIndexes[sliderId] = (currentIndex - 1 + images.length) % images.length;
    }

    images[currentIndexes[sliderId]].classList.add('active');
}

// Hàm điều khiển chuyển sang phải
function moveRight(sliderId) {
    moveSlider(sliderId, 'next');
}

// Hàm điều khiển chuyển sang trái
function moveLeft(sliderId) {
    moveSlider(sliderId, 'prev');
}

// Tự động chuyển slide sau mỗi 2 giây cho cả hai slider
function autoSlide(sliderId) {
    setInterval(function() {
        moveRight(sliderId);
    }, 4000); // 4000ms = 4 giây
}

// Gọi autoSlide cho slider1 và slider2
autoSlide('slider1');
autoSlide('slider2');
