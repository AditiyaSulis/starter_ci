// Fungsi untuk toggle tema berdasarkan pilihan user
function toggleTheme(mode) {
  // Simpan pilihan tema ke localStorage
  localStorage.setItem("data-bs-theme", mode);

  // Set atribut di elemen HTML
  document.documentElement.setAttribute("data-bs-theme", mode);

  // Ganti ikon sesuai tema
  document.querySelector(".theme-light-show").style.display =
    mode === "light" ? "inline-block" : "none";
  document.querySelector(".theme-dark-show").style.display =
    mode === "dark" ? "inline-block" : "none";

  // Update status menu active
  document.querySelectorAll('[data-kt-element="mode"]').forEach((link) => {
    link.classList.remove("active");
    if (link.getAttribute("data-kt-value") === mode) {
      link.classList.add("active");
    }
  });
}

// Fungsi untuk memuat tema yang disimpan di localStorage
function loadSavedTheme() {
  const savedTheme = localStorage.getItem("data-bs-theme") || "light"; // Default 'light' jika tidak ada di localStorage
  toggleTheme(savedTheme);
}

// Event listener untuk link dark/light mode
document.querySelectorAll('[data-kt-element="mode"]').forEach((link) => {
  link.addEventListener("click", function (e) {
    e.preventDefault();
    const mode = this.getAttribute("data-kt-value");
    toggleTheme(mode);
  });
});

// Load tema saat halaman di-refresh
loadSavedTheme();
