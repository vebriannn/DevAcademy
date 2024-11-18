const btnPromo = document.getElementById('btnPromo');
const textPromo = document.getElementById('text-potongan-harga');
const textTotalHarga = document.getElementById('totalHarga');
const hargaInput = document.querySelector('input[name="price"]');
const promoSelect = document.getElementById('promo');
const diskonInput = document.getElementById('diskonInput');
const originalPrice = parseFloat(hargaInput.value);
btnPromo.addEventListener('click', function() {
    if (promoSelect && hargaInput) {
        // Ambil nilai kode promo yang dipilih dan konversi ke angka
        const selectedPromo = parseFloat(promoSelect.value);
        // Hitung jumlah diskon dalam Rupiah berdasarkan harga asli
        const diskon = (selectedPromo / 100) * originalPrice;
        // Hitung total harga setelah diskon
        const totalHarga = originalPrice - diskon;
        // Tampilkan diskon dalam format Rupiah
        textPromo.innerHTML = 'Rp ' + diskon.toLocaleString();
        // Tampilkan total harga setelah diskon dalam format Rupiah
        textTotalHarga.innerHTML = 'Rp ' + totalHarga.toLocaleString();
        // Update nilai input harga dengan total harga setelah diskon
        hargaInput.value = totalHarga.toFixed(2);
        // Update nilai input hidden diskon dengan nilai diskon yang dihitung
        diskonInput.value = selectedPromo;
    }
});