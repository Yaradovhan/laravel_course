require('./bootstrap');

// $('.region-selector').each(function () {
//     var block = $(this);
//     var selected = block.data('selected');
//     var url = block.data('source');
//
//     var buildSelect = function (parent, items) {
//         var current = items[0];
//         var select = $('<select class="form-control">');
//         var group = $('<div class="form-group">');
//
//         select.append($('<option value=""></option>'));
//         group.append(select);
//         block.append(group);
//
//         axios.get(url, {params: {parent: parent}})
//             .then(function (response) {
//                 response.data.forEach(function (region) {
//                     select.append(
//                         $("<option>")
//                             .attr('name', 'regions[]')
//                             .attr('value', region.id)
//                             .attr('selected', region.id === current)
//                             .text(region.name)
//                     );
//                 });
//                 if (current) {
//                     buildSelect(current, items.slice(1))
//                 }
//             })
//             .catch(function (error) {
//                 console.error(error);
//             });
//     };
//     buildSelect(null, selected);
// });

$('.ui.dropdown')
    .dropdown()
;

$('.menu .item')
    .tab()
;
$('.ui.checkbox.two_factor')
    .checkbox()
    .first().checkbox({
    onChecked: function() {
        console.log('1');
    },
    onUnchecked: function() {
        console.log('2');
    },
    onEnable: function() {
        console.log('3');
    },
    onDisable: function() {
        console.log('4');
    },
    onDeterminate: function() {
        console.log('5');
    },
    onIndeterminate: function() {
        console.log('6');
    },
    onChange: function() {
        console.log('7');
    }
});
