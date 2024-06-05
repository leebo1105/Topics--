<script>
  document.addEventListener('DOMContentLoaded', function() {
    const carouselContainer = document.querySelector(".carousel-container");
    const prevBtn = document.querySelector(".prev-btn");
    const nextBtn = document.querySelector(".next-btn");

    let currentIndex = 0;
    const totalItems = carouselContainer.children.length;

    function moveCarousel(direction) {
      if (direction === "prev") {
        currentIndex = (currentIndex - 1 + totalItems) % totalItems;
      } else {
        currentIndex = (currentIndex + 1) % totalItems;
      }
      carouselContainer.style.transform = `translateX(-${
        currentIndex * (100 / totalItems)
      }%)`;
    }

    prevBtn.addEventListener("click", () => moveCarousel("prev"));
    nextBtn.addEventListener("click", () => moveCarousel("next"));
  });
</script>