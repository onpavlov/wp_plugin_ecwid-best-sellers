let PopupEcwidBs = {
    ecwidBsPopupIsOpen: false,
    html: '',

    init: function (html, classname) {
        this.html = html;
        this.setOnWidgetAdded();
        this.setOnPopupClose();
        this.ecwidBsPopupIsOpen = false;

        if ($('.' + classname).length > 1) {
            if (!this.ecwidBsPopupIsOpen) {
                this.ecwidBsPopupIsOpen = true;
                $.fancybox.open(this.html);
            }
        }
    },

    setOnWidgetAdded: function () {
        $(document).off('widget-added').on('widget-added', function(widget) {
            if (!this.ecwidBsPopupIsOpen) {
                this.ecwidBsPopupIsOpen = true;
                $.fancybox.open(this.html);
            }
        });
    },

    setOnPopupClose: function () {
        $(document).on('afterClose.fb', function(e, instance, slide) {
            this.ecwidBsPopupIsOpen = false;
        });
    }
};