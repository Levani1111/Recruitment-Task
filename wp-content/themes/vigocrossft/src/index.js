/**
 * WordPress dependencies
 */

const { registerBlockType } = wp.blocks;

registerBlockType('vigocrossft/custom-cta', {
    // built-in attributes
    title: 'Call to Action',
    description: 'Block to generate a call to action',
    icon: 'format-image',
    category: 'layout',
    // custom attributes
    attributes: {
        author: {
            type: 'string',
        },
    },
    // custom functions
    edit: function ({ attributes, setAttributes }) {
        return <input value={attributes.author} type="text" />;
    },
    // built-in functions
    save: function () {
        return <p>Front End</p>
    },

});