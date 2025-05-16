
(function($) {
    $(document).ready(function () {
        jQuery(document).ready(function($) {
    
            const mobileBreakpoint = 767;
        
            function isMobile() {
                return window.innerWidth < mobileBreakpoint;
            }
        
            function collapseAdvancedSearchIfMobile() {
                if (isMobile()) {
                    $('#advancedSearch').slideUp();
                    const $toggle = $('#toggleAdvanced');
                    $toggle.find(".bi").removeClass("bi-chevron-up").addClass("bi-chevron-down");
                    $toggle.contents().filter(function() {
                        return this.nodeType === 3;
                    }).first().replaceWith("Rozwiń ");
                }
            }
        
            // Ukrycie advancedSearch na mobilu przy starcie
            if (isMobile()) {
                $("#advancedSearch").hide();
                const $toggle = $("#toggleAdvanced");
                $toggle.find(".bi").removeClass("bi-chevron-up").addClass("bi-chevron-down");
                $toggle.contents().filter(function() {
                    return this.nodeType === 3;
                }).first().replaceWith("Rozwiń ");
            }
        
            // Obsługa toggleAdvanced na desktopie i mobile
            $("#toggleAdvanced").click(function (e) {
                e.preventDefault();
                $("#advancedSearch").slideToggle();
        
                const $icon = $(this).find(".bi");
                const isExpanded = $icon.hasClass("bi-chevron-up");
        
                if (isExpanded) {
                    $icon.removeClass("bi-chevron-up").addClass("bi-chevron-down");
                    $(this).contents().filter(function() {
                        return this.nodeType === 3;
                    }).first().replaceWith("Rozwiń ");
                } else {
                    $icon.removeClass("bi-chevron-down").addClass("bi-chevron-up");
                    $(this).contents().filter(function() {
                        return this.nodeType === 3;
                    }).first().replaceWith("Zwiń ");
                }
            });
        
            // ... cały pozostały kod (ulubione, filtrowanie, fetchLokale itd.) zostaje bez zmian ...
        
            $('.js-search-btn, .clear-btn').on('click', function () {
                collapseAdvancedSearchIfMobile();
            });
        });
        
    
    
        $(".select2").select2({
            placeholder: "Wybierz opcję",
            allowClear: true,
            
        });
    
        // Initialize Range Slider
        $("#metrageRange").ionRangeSlider({
            type: "double",
            min: 24,
            max: 216,
            from: 24,
            to: 216,
            grid: false,
            prefix: "",
            // postfix: " m²",
            postfix: "",
        });
    
       
    
        // Clear button functionality
        $(".clear-btn").click(function () {
            $(".room-btn").removeClass("active");
            $(".select2").val(null).trigger("change");
    
            // Reset range slider
            var slider = $("#metrageRange").data("ionRangeSlider");
            slider.reset();
        });
    });
        var $range = $("#metrageRange");
        if ($range.length) {
            $range.ionRangeSlider({
                type: "double",
                min: $range.data('min'),
                max: $range.data('max'),
                from: $range.data('min'),
                to: $range.data('max'),
                postfix: " m²",
                onFinish: function(data) {
                    // Możesz tu odpalić AJAX automatycznie po zmianie slidera:
                    // fetchLokale();
                }
            });
        }
    
    })(jQuery);

    
jQuery(document).ready(function($) {
    function initFavoritesInGridAndTable() {
        let favorites = (JSON.parse(localStorage.getItem('favoriteLokale')) || []).map(String);
        $('.favorite-btn').each(function () {
            const postId = $(this).data('index')?.toString();
            if (!postId) return;
            if (favorites.includes(postId)) {
                $(this).addClass('active');
            } else {
                $(this).removeClass('active');
            }
        });
    }

    $(document).on('click', '.favorite-btn', function (e) {
        e.preventDefault();
        const postId = $(this).data('index')?.toString();
        if (!postId) return;

        let favorites = (JSON.parse(localStorage.getItem('favoriteLokale')) || []).map(String);
        const index = favorites.indexOf(postId);

        if (index > -1) {
            favorites.splice(index, 1);
            $(this).removeClass('active');
        } else {
            favorites.push(postId);
            $(this).addClass('active');
        }

        localStorage.setItem('favoriteLokale', JSON.stringify(favorites));
    });

    function setFiltersFromUrl() {
        var urlParams = new URLSearchParams(window.location.search);
        // $('#investment').val(urlParams.get('investment') || '').trigger('change');
        const isHiddenInvestment = $('#investment').attr('type') === 'hidden';
        const investmentFromUrl = urlParams.get('investment');
        if (investmentFromUrl !== null) {
            $('#investment').val(investmentFromUrl).trigger('change');
        } else if (isHiddenInvestment) {
            // jeśli pole hidden i ma już wartość, zostawiamy ją
            $('#investment').trigger('change');
        } else {
            $('#investment').val('').trigger('change');
        }
        $('#location').val(urlParams.get('location') || '').trigger('change');
        $('#status').val(urlParams.get('status') || '').trigger('change');

        var rooms = urlParams.get('rooms') || '';
        if (rooms) {
            $('.room-btn[data-rooms]').each(function() {
                if ($(this).data('rooms').toString() === rooms) $(this).addClass('active');
            });
        }

        var floor = urlParams.get('floor') || '';
        if (floor) {
            $('.floor-btn[data-floor]').each(function() {
                if ($(this).data('floor').toString() === floor) $(this).addClass('active');
            });
        }

        var metrage = urlParams.get('metrage') || '';
        if (metrage) {
            var slider = $('#metrageRange').data('ionRangeSlider');
            if (slider) {
                var parts = metrage.split(';');
                slider.update({ from: parseFloat(parts[0]), to: parseFloat(parts[1]) });
            }
        }
    }

    function initDataTableIfExists() {
        if (jQuery.fn.DataTable && jQuery("#dataTable").length) {
            jQuery("#dataTable").DataTable({
                paging: true,
                lengthChange: false,
                scrollX: true,
                pageLength: 10,
                searching: true,
                ordering: true,
                info: true,
                autoWidth: false,
                language: {
                    paginate: {
                        previous: '<span class="prev-icon">< Poprzednia</span>',
                        next: '<span class="next-icon">Następna > </span>',
                    },
                },
                columnDefs: [{
                    orderable: false,
                    targets: [6, 7, 8, 9],
                }],
            });
        }
    }

    let suppressChange = false;
    setFiltersFromUrl();

    function updateFilters(source = '') {
        var investment = $('#investment').val();
        var location = $('#location').val();
        var currentRooms = $('.room-btn.active').data('rooms') ?? '';
        var currentFloor = $('.floor-btn.active').data('floor') ?? '';
        var currentStatus = $('#status').val();
    
        $.ajax({
            url: ajax_vars.ajax_url,
            method: 'POST',
            data: {
                action: 'get_investment_filters',
                investment,
                location,
                rooms: currentRooms,
                floor: currentFloor,
                status: currentStatus
            },
            success: function(response) {
                // --- POKOJE ---
                if (source !== 'rooms') {
                    var pokojeContainer = $('.filter-rooms .d-flex');
                    pokojeContainer.empty();
                    response.all_pokoje.sort((a, b) => a - b).forEach(function(pokoj) {
                        var activeClass = (currentRooms.toString() === pokoj.toString()) ? 'active' : '';
                        pokojeContainer.append(
                            `<button class="room-btn btn btn-outline-secondary ${activeClass}" data-rooms="${pokoj}">${pokoj}</button>`
                        );
                    });
                }
    
                // --- PIĘTRA ---
                if (source !== 'floor') {
                    var pietraContainer = $('.filter-floors .d-flex');
                    pietraContainer.empty();
                    response.all_pietra.sort((a, b) => a - b).forEach(function(pietro) {
                        var activeClass = (currentFloor.toString() === pietro.toString()) ? 'active' : '';
                        var label = (parseInt(pietro) === 0) ? 'Parter' : pietro;
                        pietraContainer.append(
                            `<button class="floor-btn btn btn-outline-secondary ${activeClass}" data-floor="${pietro}">${label}</button>`
                        );
                    });
                }
    
                // --- STATUS ---
                suppressChange = true;
                var statusSelect = $('#status');
                if (statusSelect.hasClass("select2-hidden-accessible")) statusSelect.select2('destroy');
                statusSelect.empty().append('<option value="">Wszystkie</option>');
                var statusLabels = { '1': 'Dostępne', '2': 'Zarezerwowane', '3': 'Sprzedane' };
                response.all_statusy.forEach(function(statusOption) {
                    var isSelected = (currentStatus == statusOption) ? 'selected' : '';
                    var label = statusLabels[statusOption] || `Status ${statusOption}`;
                    statusSelect.append(`<option value="${statusOption}" ${isSelected}>${label}</option>`);
                });
                statusSelect.select2();
                suppressChange = false;
    
                // --- METRAŻ ---
                var slider = $('#metrageRange').data('ionRangeSlider');
                if (slider && response.metraz) {
                    slider.update({
                        min: response.metraz.min || 0,
                        max: response.metraz.max || 100,
                        from: response.metraz.min || 0,
                        to: response.metraz.max || 100
                    });
                }
            }
        });
    }
    
    

    $('#investment, #location, #status').on('change', function() {
        if (suppressChange) return;
        updateFilters();
    });

    $(document).on('click', '.room-btn', function(e) {
        e.preventDefault();
        const wasActive = $(this).hasClass('active');
        $('.room-btn').removeClass('active');
        if (!wasActive) {
            $(this).addClass('active');
        }
        updateFilters('rooms'); // tylko piętra i status zostaną zaktualizowane
    });
    
    $(document).on('click', '.floor-btn', function(e) {
        e.preventDefault();
        const wasActive = $(this).hasClass('active');
        $('.floor-btn').removeClass('active');
        if (!wasActive) {
            $(this).addClass('active');
        }
        updateFilters('floor'); // tylko pokoje i status zostaną zaktualizowane
    });
    
    function fetchLokale(paged = 1) {
        var view = $('.switch-grid').hasClass('active') ? 'grid' : 'table';
    
        // Używamy warunku istnienia .active przed pobraniem data-*
        var activeRoom = $('.room-btn.active').length ? $('.room-btn.active').data('rooms') : '';
        var activeFloor = $('.floor-btn.active').length ? $('.floor-btn.active').data('floor') : '';
    
        var data = {
            action: 'filter_lokale',
            investment: $('#investment').val() || '',
            location: $('#location').val() || '',
            rooms: activeRoom,
            metrage: $('#metrageRange').val() || '',
            floor: activeFloor,
            status: $('#status').val() || '',
            view: view,
            paged: paged
        };
        // Pokazujemy loader
        $('#lokale-loader').show();
        $('#lokale-results').css('opacity', '0.2');
        // Tylko na archive-lokale aktualizujemy adres URL
        if (window.location.pathname.includes('/lokale')) {
            const isInvestmentHidden = $('#investment').attr('type') === 'hidden';
            const queryParams = new URLSearchParams();
            Object.keys(data).forEach(key => {
                if ((key !== 'investment' || !isInvestmentHidden) && data[key] !== '') {
                    queryParams.set(key, data[key]);
                }
            });
            const newUrl = queryParams.toString()
                ? window.location.pathname + '?' + queryParams.toString()
                : window.location.pathname;
        
            history.replaceState(null, '', newUrl);
        }
        
    
        $.ajax({
            url: ajax_vars.ajax_url,
            data: data,
            method: 'POST',
            success: function(response) {
                $('#lokale-results').replaceWith(response.results);
                $('#lokale-pagination').html(response.pagination || '');
    
                updateFilters();
                if (view === 'table') {
                    initDataTableIfExists();
                }
                initFavoritesInGridAndTable();
                  // Ukryj loader
                $('#lokale-loader').hide();
                $('#lokale-results').css('opacity', '1');
            },
            error: function(xhr, status, err) {
                console.error('AJAX error:', err);
                  // Ukryj loader
                $('#lokale-loader').hide();
                $('#lokale-results').css('opacity', '1');
            }
        });
    }
    

    $('.js-search-btn').on('click', function(e) {
        e.preventDefault();
        const $results = $('#lokale-results');
        if ($results.length > 0) {
            $('html, body').animate({
                scrollTop: $results.offset().top - 250
            }, 400);
        }
        fetchLokale();
    });

    $('.clear-btn').on('click', function(e) {
    e.preventDefault();

    const isHiddenInvestment = $('#investment').attr('type') === 'hidden';
    const investmentValue = $('#investment').val();

    // Reset selectów
    if (isHiddenInvestment) {
        $('#location, #status').val('').trigger('change');
        $('#investment').val(investmentValue).trigger('change');
    } else {
        $('#investment, #location, #status').val('').trigger('change');
    }

    // Reset przycisków
    $('.room-btn').removeClass('active');
    $('.floor-btn').removeClass('active');

    // Reset suwaka
    const slider = $('#metrageRange').data('ionRangeSlider');
    if (slider) {
        slider.update({ from: slider.options.min, to: slider.options.max });
    }

    // Pobranie nowych filtrów i wyświetlenie mieszkań
    $.ajax({
        url: ajax_vars.ajax_url,
        method: 'POST',
        data: {
            action: 'get_investment_filters',
            investment: isHiddenInvestment ? investmentValue : '',
            location: '',
            rooms: '',
            floor: '',
            status: ''
        },
        success: function(response) {
            // UI update
            const pokojeContainer = $('.filter-rooms .d-flex');
            pokojeContainer.empty();
            response.all_pokoje.sort((a, b) => a - b).forEach(pokoj => {
                pokojeContainer.append(
                    `<button class="room-btn btn btn-outline-secondary" data-rooms="${pokoj}">${pokoj}</button>`
                );
            });

            const pietraContainer = $('.filter-floors .d-flex');
            pietraContainer.empty();
            response.all_pietra.sort((a, b) => a - b).forEach(pietro => {
                const label = parseInt(pietro) === 0 ? 'Parter' : pietro;
                pietraContainer.append(
                    `<button class="floor-btn btn btn-outline-secondary" data-floor="${pietro}">${label}</button>`
                );
            });

            const statusSelect = $('#status');
            if (statusSelect.hasClass("select2-hidden-accessible")) statusSelect.select2('destroy');
            statusSelect.empty().append('<option value="">Wszystkie</option>');
            const statusLabels = { '1': 'Dostępne', '2': 'Zarezerwowane', '3': 'Sprzedane' };
            response.all_statusy.forEach(statusOption => {
                const label = statusLabels[statusOption] || `Status ${statusOption}`;
                statusSelect.append(`<option value="${statusOption}">${label}</option>`);
            });
            statusSelect.select2();

            // Reset adresu URL (na archive-lokale)
            if (window.location.pathname.includes('/lokale')) {
                history.replaceState(null, '', window.location.pathname);
            }
            const $results = $('#lokale-results');
            if ($results.length > 0) {
                $('html, body').animate({
                    scrollTop: $results.offset().top - 150
                }, 400);
            }
            // ⚠️ Fetchuj lokale, nawet jeśli #lokale-results nie istnieje!
            fetchLokale();
        }
    });
});

    
    
    

    $(document).on('click', '.switch-grid', function() {
        localStorage.setItem('lokaleView', 'grid');
        $('.switch-grid').addClass('active');
        $('.switch-table').removeClass('active');
        const $results = $('#lokale-results');
        if ($results.length > 0) {
            $('html, body').animate({
                scrollTop: $results.offset().top - 150
            }, 400);
        }
        fetchLokale();
    });

    $(document).on('click', '.switch-table', function() {
        localStorage.setItem('lokaleView', 'table');
        $('.switch-table').addClass('active');
        $('.switch-grid').removeClass('active');
        const $results = $('#lokale-results');
        if ($results.length > 0) {
            $('html, body').animate({
                scrollTop: $results.offset().top - 150
            }, 400);
        }
        fetchLokale();
    });

    $(document).on('click', '.pagination-grid a', function (e) {
        e.preventDefault();
        const href = $(this).attr('href');
        const match = href.match(/paged=(\d+)/);
        const paged = match ? parseInt(match[1]) : 1;
        fetchLokale(paged);
        const $results = $('#lokale-results');
        if ($results.length > 0) {
            $('html, body').animate({
                scrollTop: $results.offset().top - 150
            }, 400);
        }
    });

    if (window.location.pathname.includes('/lokale')) {
        const savedView = localStorage.getItem('lokaleView') || 'grid';
        if (savedView === 'table') {
            $('.switch-table').addClass('active');
            $('.switch-grid').removeClass('active');
        } else {
            $('.switch-grid').addClass('active');
            $('.switch-table').removeClass('active');
        }
        fetchLokale();
    } else {
        // Jeśli nie jesteśmy na archive-lokale, ale mamy formularz filtrowania
        if ($('#lokale-results').length) {
            // Wymuś widok grid jako domyślny
            $('.switch-grid').addClass('active');
            $('.switch-table').removeClass('active');

            fetchLokale();
        }
    }
    const initialInvestment = $('#investment').val();
    if (initialInvestment && !window.location.pathname.includes('/lokale')) {
        // Jeżeli to podstrona inwestycji
        updateFilters();
        setTimeout(() => {
            fetchLokale();
        }, 100);
    }
    
});
