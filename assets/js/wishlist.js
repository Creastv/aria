document.addEventListener('DOMContentLoaded', function () {
    const favoriteButtons = document.querySelectorAll('.favorite-btn.grid-favorite-toggle');
  
    // Ustaw aktywne serduszka przy ładowaniu strony
    const initFavorites = JSON.parse(localStorage.getItem('favoriteLokale')) || [];
    favoriteButtons.forEach(btn => {
      const id = btn.dataset.index;
      if (initFavorites.includes(id)) {
        btn.classList.add('active');
      }
    });
  
    // Obsługa kliknięcia: za każdym razem pobieramy najświeższe favorites
    favoriteButtons.forEach(btn => {
      btn.addEventListener('click', function (e) {
        e.preventDefault();
  
        // 1. Pobierz najnowszą wersję z localStorage
        let favorites = JSON.parse(localStorage.getItem('favoriteLokale')) || [];
  
        const id = this.dataset.index;
        const idx = favorites.indexOf(id);
  
        if (idx > -1) {
          // usuń
          favorites.splice(idx, 1);
          this.classList.remove('active');
        } else {
          // dodaj
          favorites.push(id);
          this.classList.add('active');
        }
  
        // 2. Zapisz zaktualizowaną tablicę
        localStorage.setItem('favoriteLokale', JSON.stringify(favorites));
      });
    });
  });
  