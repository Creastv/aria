jQuery(document).ready(function($) {
    function updateFiltersHome() {
        var investment = $('select[name="investment"]').val();
        var location = $('select[name="location"]').val();
        var rooms = $('#homepage-rooms').val();

        $.post(ajax_object.ajaxurl, {
            action: 'update_filters',
            investment: investment,
            location: location,
            rooms: rooms
        }, function(response) {
            if (response.success) {
                var data = response.data;

                // Inwestycje
                var investmentSelect = $('select[name="investment"]');
                var currentInvestment = investmentSelect.val();
                investmentSelect.html('<option value="">Wszystkie</option>');
                $.each(data.inwestycje.sort(), function(i, val) {
                    investmentSelect.append('<option value="' + val + '">' + val + '</option>');
                });
                investmentSelect.val(currentInvestment);

                // Lokalizacje
                var locationSelect = $('select[name="location"]');
                var currentLocation = locationSelect.val();
                locationSelect.html('<option value="">Wszystkie</option>');
                $.each(data.lokalizacje.sort(), function(i, val) {
                    locationSelect.append('<option value="' + val + '">' + val + '</option>');
                });
                locationSelect.val(currentLocation);

                // Pokoje
                var roomContainer = $('.homepage-rooms.d-flex.flex-wrap');
                roomContainer.empty();
                $.each(data.pokoje.sort(function(a, b) { return a - b; }), function(i, val) {
                    var activeClass = (val == rooms) ? ' active' : '';
                    roomContainer.append('<button type="button" class="room-btn--home btn btn-outline-secondary' + activeClass + '" data-rooms="' + val + '">' + val + '</button>');
                });
            }
        });
    }

    // Odpalamy updateFiltersHome dla selectów
    $('select[name="investment"], select[name="location"]').on('change', updateFiltersHome);

    // Obsługa kliknięcia w pokoje
    $(document).on('click', '.room-btn--home[data-rooms]', function() {
        var room = $(this).data('rooms');
        $('#homepage-rooms').val(room);
        $('.room-btn--home[data-rooms]').removeClass('active');
        $(this).addClass('active');
        updateFiltersHome();
    });
});
