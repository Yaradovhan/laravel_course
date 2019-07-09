/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// import {AxiosInstance as axios} from "axios";

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

            axios.get(url, {params: {parent}})
                .then(function (response) {
                    response.data.forEach(function (region) {
                        select.append(
                            $("<option>")
                                .attr('name', 'regions[]')
                                .attr('value', region.id)
                                .attr('selected', region.id === current)
                        );
                    });
                    if (current) {
                        buildSelect(current, items.slice(1))
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
        };
        buildSelect(null, selected);
    });
