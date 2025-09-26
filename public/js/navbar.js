document.addEventListener("DOMContentLoaded", function () {
    // Cari semua item menu yang punya dropdown
    const dropdownItems = document.querySelectorAll(".menu-item-has-dropdown");

    // Jika tidak ada dropdown, hentikan eksekusi
    if (!dropdownItems.length) {
        return;
    }

    dropdownItems.forEach(function (item) {
        const toggle = item.querySelector(".menu > img"); // Target panahnya

        // Tambahkan event listener ke seluruh item (bukan hanya panah)
        item.addEventListener("click", function (event) {
            // Cek apakah dropdown ini sedang terbuka
            const isOpen = item.classList.contains("open");
            
            // Tutup semua dropdown lain terlebih dahulu
            dropdownItems.forEach(function (otherItem) {
                otherItem.classList.remove("open");
            });

            // Jika dropdown yang diklik tadi tidak sedang terbuka, maka buka
            if (!isOpen) {
                item.classList.add("open");
            }
            
            // Menghentikan event dari "menyebar" ke elemen window
            event.stopPropagation();
        });
    });
    
    // Tambahkan event listener untuk menutup dropdown saat klik di luar area menu
    window.addEventListener("click", function () {
        dropdownItems.forEach(function (item) {
            item.classList.remove("open");
        });
    });
});