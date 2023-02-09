jQuery( window ).on( 'elementor:init', function() {
	var ControlSvgIconItemView = elementor.modules.controls.BaseData.extend( {
		getSelect2Icons: function(css) {
			if (!css.id) { return css.text; }
			return jQuery('<span class="control-svg-span"><svg viewBox="0 0 100 100" class="control-svg-icon icon ' + css.id + '"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#' + css.id + '"></use></svg>' + css.text + '</span>');
		},

		getSelect2DefaultOptions: function() {
			return {
				allowClear: true,
				templateResult: this.getSelect2Icons.bind( this ),
				templateSelection: this.getSelect2Icons.bind( this ),
			};
		},

		getSelect2Options: function() {
			return jQuery.extend( this.getSelect2DefaultOptions(), this.model.get( 'options' ) );
		},

		onReady: function() {
			this.ui.select.select2( this.getSelect2Options() );
		},

		onBeforeDestroy: function() {
			if ( this.ui.select.data( 'select2' ) ) {
				this.ui.select.select2( 'destroy' );
			}

			this.$el.remove();
		}
	} );
	elementor.addControlView( 'svg_icon', ControlSvgIconItemView );
} );