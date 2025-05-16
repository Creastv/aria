document.addEventListener('DOMContentLoaded', function () {
    const btn = document.getElementById('load-more');
    if (!btn) return;

    btn.addEventListener('click', function () {
        const page = parseInt(btn.dataset.page) + 1;
        const max = parseInt(btn.dataset.max);

        const data = new FormData();
        data.append('action', 'load_more_posts');
        data.append('page', page);
        data.append('query_vars', JSON.stringify(wp_loadmore.query_vars));

        fetch(wp_loadmore.ajax_url, {
            method: 'POST',
            credentials: 'same-origin',
            body: data,
        })
            .then((res) => res.text())
            .then((html) => {
                console.log('HTML z Ajaxa:', html);
                document.getElementById('posts-container').insertAdjacentHTML('beforeend', html);
                btn.dataset.page = page;
                if (page >= max) {
                    btn.style.display = 'none';
                }
            });
    });
});
