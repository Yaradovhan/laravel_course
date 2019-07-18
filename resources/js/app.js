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
    var url = block.data('source');
    window.location = url;
});
