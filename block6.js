/*
 *
 * Starts a Bootstrap Row classed div in the block editor.
 *
 * Using inline styles - no external stylesheet needed.  Not recommended
 * because all of these styles will appear in `post_content`.
 */
( function( blocks, i18n, element ) {
	var el = element.createElement;
	var __ = i18n.__;

	var blockStyle = {
		backgroundColor: '#090909',
		color: '#e9e9e9',
		padding: '20px',
		fontWeight: '800',
		borderBottomRightRadius: '2em',
		borderTopLeftRadius: '2em',
		textAlign: 'center',
	};

	blocks.registerBlockType( 'gutenberg-blockstrap/blockstrap-col-centered', {
		title: __( 'Blockstrap Centered Column', 'gutenberg-blockstrap' ),
		icon: 'universal-access-alt',
		category: 'layout',
		edit: props => {
			return el(
				'p',
				{ style: blockStyle },
				'「jumbotron』'
			);
		},
		save: props => {
			return (
				'「jumbotron』'
			);
		},
	} );
}(
	window.wp.blocks,
	window.wp.i18n,
	window.wp.element
) );