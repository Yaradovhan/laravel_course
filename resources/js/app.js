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
    var platform = new H.service.Platform({
        apikey: 'Aokmr8E5SgH0TJGTGACpKO5aHE9MRrDUrvjFfl14B-w'
    });

    window.geocode_callback = function (response) {
        if (response.response.GeoObjectCollection.metaDataProperty.GeocoderResponseMetaData.found > 0) {
            target.val(response.response.GeoObjectCollection.featureMember['0'].GeoObject.metaDataProperty.GeocoderMetaData.Address.formatted);
        } else {
            alert('Unable to detect your address.');
        }
    };

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {

console.log(position)

            function reverseGeocode(platform) {
                var geocoder = platform.getGeocodingService(),
                    reverseGeocodingParameters = {
                        prox: '52.5309,13.3847,150', // Berlin
                        mode: 'retrieveAddresses',
                        maxresults: '1',
                        jsonattributes : 1
                    };

                geocoder.reverseGeocode(
                    reverseGeocodingParameters,
                    onSuccess,
                    onError
                );
            }






        //     var location = position.coords.longitude + ',' + position.coords.latitude;
        //     var url = 'https://geocode-maps.yandex.ru/1.x/?format=json&callback=geocode_callback&geocode=' + location;
        //     var script = $('<script>').appendTo($('body'));
        //     script.attr('src', url);
        // }, function (error) {
        //     console.warn(error.message);
        // });
    // } else {
    //     alert('Unable to detect your location.');
    })}
});

$(document).on('click', '.phone-button', function () {
    var button = $(this);
    axios.post(button.data('source')).then(function (res) {
        button.find('.number').html(res.data)
    }).catch(function (reason) {
        console.log(reason);
    });
});
