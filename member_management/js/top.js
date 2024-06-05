    // 在页面加载完成后执行
    document.addEventListener('DOMContentLoaded', function() {
        var backToTopButton = document.getElementById('backToTop');

        // 监听滚动事件
        window.addEventListener('scroll', function() {
            if (window.scrollY > 300) {
                backToTopButton.style.display = 'block';
            } else {
                backToTopButton.style.display = 'none';
            }
        });

        // 监听点击事件
        backToTopButton.addEventListener('click', function() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    });

    // 導覽列JS------------
    document.addEventListener('DOMContentLoaded', function() {
        const navItems = document.querySelectorAll('.nav-item');
    
        navItems.forEach(item => {
            item.addEventListener('mouseenter', function() {
                const dropdown = this.querySelector('.dropdown-content');
                if (dropdown) {
                    dropdown.style.display = 'block';
                    setTimeout(() => {
                        dropdown.style.opacity = '1';
                        dropdown.style.maxHeight = '300px'; // 根據內容調整
                    }, 0);
                }
            });
    
            item.addEventListener('mouseleave', function() {
                const dropdown = this.querySelector('.dropdown-content');
                if (dropdown) {
                    dropdown.style.opacity = '0';
                    dropdown.style.maxHeight = '0';
                    setTimeout(() => {
                        dropdown.style.display = 'none';
                    }, 500); // 與 CSS 中的 transition 時間保持一致
                }
            });
        });
    });
    // 前導淡入
    document.addEventListener('DOMContentLoaded', function() {
        var textElement = document.querySelector('.fade-in-text');
    
        function handleIntersection(entries, observer) {
            entries.forEach(function(entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target); // 停止观察已经可见的元素
                }
            });
        }
    
        var observer = new IntersectionObserver(handleIntersection, {
            threshold: 0.5 // 当元素50%进入视口时触发
        });
    
        observer.observe(textElement);
    });
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    