var flickrpress_positions = new Array();
function flickrpress_load_items(direction, sender) {
    var container = jQuery(sender).parent().parent();
    var items = container.find('.flickrpress-items');
    var options = container.find('[name=flickrpress-options]').val();
    var id = container.find('[name=flickrpress-id]').val();
    var prev = container.find('.flickrpress-navigation-previous');
    var next = container.find('.flickrpress-navigation-next');
    var start = flickrpress_positions[container];
    if (!start) start = 0;
    container.addClass("pending");
    jQuery.getJSON('', { flickrpress_action:direction,
        flickrpress_options:options,
        flickrpress_id:id,
        flickrpress_start:start }, function (result) {
        if (parseInt(result.count) == 0) {
            alert('Flickr is currently unavailable.');
            container.removeClass("pending");
            return;
        }
        var start = flickrpress_positions[container] = parseInt(result.start);
        var count = parseInt(result.count);
        if (start + count >= parseInt(result.total)) {
            next.hide();
        } else {
            next.show();
        }
        if (start == 0) {
            prev.hide();
        } else {
            prev.show();
        }
        container.removeClass("pending");
        items.html(result.html);
        if (typeof(myLightbox) != 'undefined' && typeof(myLightbox.updateImageList) == 'function') {
            myLightbox.updateImageList();
        }
        if (typeof(tb_init) == 'function') {
            tb_init('a.thickbox');
        }
    });
}
jQuery(function () {
    jQuery('.flickrpress-navigation .flickrpress-navigation-previous').click(function () {
        flickrpress_load_items('lastpage', this);
    });
    jQuery('.flickrpress-navigation .flickrpress-navigation-next').click(function () {
        flickrpress_load_items('nextpage', this);
    });
});
