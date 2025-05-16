document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.go-load-more').forEach(button => {
      button.addEventListener('click', function (e) {
        e.preventDefault();
  
        const wrapper = this.closest('.gallery-area');
        const gallery = wrapper.querySelector('.go-gallery-items');
        const offset = parseInt(this.dataset.offset, 10);
        const images = JSON.parse(this.dataset.images);
        const total = parseInt(wrapper.dataset.total, 10);
        const displayTitle = wrapper.dataset.displayTitle === '1';
  
        const nextItems = images.slice(offset, offset + 6);
        nextItems.forEach(img => {
          const div = document.createElement('div');
          div.className = 'gallery-img go-gallery-item';
          const altText = img.alt || img.title || '';
          const titleText = img.title || '';
  
          div.innerHTML = `
            ${displayTitle && titleText ? `<h2 class="gallery-title">${titleText}</h2>` : ''}
            <a data-fancybox="gal" href="${img.url}" title="${titleText}">
              <img src="${img.sizes.gallery}" alt="${altText}" />
            </a>
          `;
          gallery.insertBefore(div, this.closest('.read-more'));
        });
  
        const newOffset = offset + 6;
        this.dataset.offset = newOffset;
  
        if (newOffset >= total) {
          this.closest('.read-more').remove();
        }
      });
    });
  });
  