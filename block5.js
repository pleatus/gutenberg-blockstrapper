/*
 *
 * Starts a Blockstrapper Block parsed as div on the front-end.
 * PHP needs code to parse a custom block still
 * save reads in blkstrprReadIn in the edit view, adding extra braces. going to have to add them somewhere else or find a method that works to remove the extra
 * 
 */
(function (blocks, editor, components, i18n, element) {
	var el = wp.element.createElement
  	var registerBlockType = wp.blocks.registerBlockType
  	var RichText = wp.editor.RichText
  	var BlockControls = wp.editor.BlockControls
  	var AlignmentToolbar = wp.editor.AlignmentToolbar
  	var MediaUpload = wp.editor.MediaUpload
  	var InspectorControls = wp.editor.InspectorControls
  	var TextControl = components.TextControl
	
	registerBlockType('gutenberg-blockstrapper/blockstrapper-custom', { 
    title: i18n.__('Blockstrapper Custom'),
    description: i18n.__('A Blockstrapper block to apply your own custom CSS bootstrap classes around block content.'),
    icon: 'editor-table',
    category: 'layout',
    attributes: { 
      subtitle: {
        type: 'array',
        source: 'children',
        selector: 'p'
      },
    },
	edit: function (props) {
      var attributes = props.attributes
	  if (attributes.subtitle.indexOf('「') !== -1) {
		let switchString = attributes.subtitle;
		let frontStripped = switchString.replace('「','');
		var allStripped = frontStripped.replace('』','');
	  }
	
      return [

		el('div', { className: props.className },
		  el('div', { className: 'blockstrapper-custom-content' },
			el(RichText, {
			  key: 'editable',
			  placeholder: i18n.__('container'),
			  keepPlaceholderOnFocus: true,
			  value: allStripped,
			  onChange: function (newSubtitle) {
				props.setAttributes({ subtitle: newSubtitle })
			  }
			}),
			)
			  )
				
			  ]
		},
		save: function (props) {
			var attributes = props.attributes
			blkstrprReadIn = '「' + attributes.subtitle + '』'
			return (
			  el('div', { className: props.className },
				  el(RichText.Content, {
					tagName: 'p',
					value: blkstrprReadIn
				  }),
			  )
				)
				 
		  }


} );
  
})(
  window.wp.blocks,
  window.wp.editor,
  window.wp.components,
  window.wp.i18n,
  window.wp.element
)