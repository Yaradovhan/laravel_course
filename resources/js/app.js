require('./bootstrap');

$('.region-selector').each(function () {
    var block = $(this);
    var selected = block.data('selected');
    var url = block.data('source');

    var buildSelect = function (parent, items) {
        var current = items[0];
        var select = $('<select class="ui selection dropdown">');
        var group = $('<div class="menu">');

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

$(document).on('click', 'phone-button', function () {
    var button = $(this);
    axios.post(button.data('source')).then(function (res) {
        button.find('.number').html(res.data)
    }).catch(function (reason) {
        console.log(reason);
    });
});

$('.ui.dropdown').dropdown();
$('.menu .item').tab();
$('.ui.checkbox').checkbox()
    .first().checkbox({
    onChange: function () {
        var block = $(this);
        var url = block.data('source');
        axios.post(url)
            .catch(function (error) {
                console.error(error);
            });
    }
});

$('.user_verify').click(function () {
    var block = $(this);
    var url = block.data('source');
    axios.post(url)
        .then(function () {
            location.reload()
        })
        .catch(function (error) {
            console.error(error);
        });

});

$('.user_delete').click(function () {
    var block = $(this);
    var url = block.data('source');
    axios.delete(url)
        .then(function (e) {
            window.location = e.data
        })
        .catch(function (error) {
            console.error(error);
        });
});

$('.user_edit').click(function () {
    var block = $(this);
    window.location = block.data('source');
});

$('.field .ui.embed').embed();


$(document).on('click', '.location-button', function () {
    var button = $(this);
    var target = $(button.data('target'));


    window.geocode_callback = function (response) {
        if (response.response.GeoObjectCollection.metaDataProperty.GeocoderResponseMetaData.found > 0) {
            target.val(response.response.GeoObjectCollection.featureMember['0'].GeoObject.metaDataProperty.GeocoderMetaData.Address.formatted);
        } else {
            alert('Unable to detect your address.');
        }
    };

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            var location = position.coords.longitude + ',' + position.coords.latitude;
            var url = 'https://geocode-maps.yandex.ru/1.x/?format=json&callback=geocode_callback&geocode=' + location;
            var script = $('<script>').appendTo($('body'));
            script.attr('src', url);
        }, function (error) {
            console.warn(error.message);
        });
    } else {
        alert('Unable to detect your location.');
    }
});
// $('.ui.embed.map').embed({
//     source      : 'map',
//     id          : 'O6Xo21L0ybE',
//     placeholder : '/images/bear-waving.jpg',
//     url         : 'https://www.google.com/maps?q=&output=embed'
// });
