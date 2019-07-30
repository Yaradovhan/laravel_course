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


    // window.geocode_callback = function (response) {
    //     if (response) {
    //         console.log('here');
    //         // target.val(response.response.GeoObjectCollection.featureMember['0'].GeoObject.metaDataProperty.GeocoderMetaData.Address.formatted);
    //     } else {
    //         alert('Unable to detect your address.');
    //     }
    // };

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
 var location = position.coords.latitude + ','+ position.coords.longitude;

            $.ajax({
                url: 'https://reverse.geocoder.api.here.com/6.2/reversegeocode.json',
                type: 'GET',
                dataType: 'jsonp',
                jsonp: 'jsoncallback',
                data: {
                    prox: location,
                    mode: 'retrieveAddresses',
                    maxresults: '1',
                    gen: '9',
                    app_id: 'BAqxBoWOqhhwObgD5ToS',
                    app_code: 'sIBk3mmh-ZajXg-Gn57ckg'
                },
                success: function (data) {
                    var curAddress = data.Response.View[0].Result[0].Location.Address.Label;
                    target.val(curAddress);
                    // console.log(curAddress);
                    // var script = $('<script>').appendTo($('body'));
                    // console.log(script);
                    // script.attr('src', curAddress);
                }
            });
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
