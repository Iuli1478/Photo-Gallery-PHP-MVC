$.noty.themes.bootstrapTheme = {
    name: 'bootstrapTheme',
    modal: {
        css: {
            position: 'fixed',
            width: '100%',
            height: '100%',
            backgroundColor: '#000',
            zIndex: 10000,
            opacity: 0,
            display: 'none',
            left: 0,
            top: 0
        }
    },
    style: function() {

        var containerSelector = this.options.layout.container.selector;
        $(containerSelector).addClass('list-group');

        this.$closeButton.append('<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>');
        this.$closeButton.addClass('close');

        this.$bar.addClass( "list-group-item" ).css('padding', '0px');

        switch (this.options.type) {
            case 'alert':
            case 'notification':
                this.$bar.css({ backgroundColor: '#FFF', color: '#444' });
                break;
            case 'warning':
                this.$bar.css({ backgroundColor: '#FFEAA8', color: '#826200' });
                this.$buttons.css({ borderTop: '1px solid #FFC237' });
                break;
            case 'error':
                this.$bar.css({ backgroundColor: '#D43F3A', color: '#FFF' });
                this.$message.css({ fontWeight: 'bold' });
                this.$buttons.css({ borderTop: '1px solid darkred' });
                break;
            case 'information':
                this.$bar.css({ backgroundColor: '#78C5E7', color: '#FFF' });
                this.$buttons.css({ borderTop: '1px solid #0B90C4' });
                break;
            case 'success':
                this.$bar.css({ backgroundColor: '#96BF48', color: '#ffffff' });
                this.$buttons.css({ borderTop: '1px solid #50C24E' });
                break;
            default:
                this.$bar.css({ backgroundColor: '#FFF', color: '#444' });
                break;
        }

        this.$message.css({
            fontSize: '15px',
            lineHeight: '26px',
            textAlign: 'center',
            padding: '10px',
            width: '100%',
            position: 'relative'
        });
    },
    callback: {
        onShow: function() {  },
        onClose: function() {  }
    }
};

