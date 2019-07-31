require('./bootstrap');

$('.region-selector').each(function () {
    var block = $(this);
    var selected = block.data('selected');
    var url = block.data('source');

    var buildSelect = function (parent, items) {
        var current = items[0];
        var select = $('<select class="form-control">');
        var group = $('<div class="form-group">');

        select.append($('<option value=""></option>'));
        group.append(select);
        block.append(group);

        axios.get(url, {params: {parent: parent}})
            .then(function (response) {
                response.data.forEach(function (region) {
                    select.append(
                        $("<option>")
                            .attr('name', 'regions[]')
                            .attr('value', region.id)
                            .attr('selected', region.id === current)
                            .text(region.name)
                    );
                });
                if (current) {
                    buildSelect(current, items.slice(1))
                }
            })
            .catch(function (error) {
                console.error(error);
            });
    };
    buildSelect(null, selected);
});


$(document).on('click', '.location-button', function () {
    var button = $(this);
    var target = $(button.data('target'));

    var geocoder = new google.maps.Geocoder;
    geocodeLatLng(geocoder);


    function geocodeLatLng(geocoder) {
        navigator.geolocation.getCurrentPosition(function (position) {
            var latlng = {lat: position.coords.latitude, lng: position.coords.longitude};
            geocoder.geocode({'location': latlng}, function (results, status) {
                if (status === 'OK') {
                    if (results[0]) {
                        target.val(results[0].formatted_address);
                    } else {
                        window.alert('No results found');
                    }
                } else {
                    window.alert('Geocoder failed due to: ' + status);
                }
            });
        });
    }
});

$(document).on('click', '.phone-button', function () {
    var button = $(this);
    axios.post(button.data('source')).then(function (res) {
        button.find('.number').html(res.data)
    }).catch(function (reason) {
        console.log(reason);
    });
});
