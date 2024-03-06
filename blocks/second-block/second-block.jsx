const { registerBlockType } = wp.blocks;
const { RichText } = wp.blockEditor;

registerBlockType(globals.prefix + '/second-block', {
  title: 'Second Block',
  icon: 'admin-comments', // https://developer.wordpress.org/resource/dashicons/
  category: 'common', // Choose from: common, formatting, layout, widgets, embeds, etc.
  attributes: {
    title: {
      type: 'string',
      default: 'Default title',
    },
    content: {
      type: 'wysiwyg',
      default: 'Default content',
    },
  },

  // Define the editor interface
  edit: ({ attributes, setAttributes }) => {
    const onChangeTitle = (newTitle) => {
      setAttributes({ title: newTitle });
    };

    const onChangeContent = (newContent) => {
      setAttributes({ content: newContent });
    };

    return (
      <div className="second-block">
        <RichText
          tagName="h2"
          value={attributes.title}
          onChange={onChangeTitle}
        />
        <RichText
          tagName="p"
          value={attributes.content}
          onChange={onChangeContent}
        />
      </div>
    );
  },

  // Define the saved content structure
  save: ({ attributes }) => {
    return (
      <div className="second-block test">
        <h2>{attributes.title}</h2>
        <p>{attributes.content}</p>
      </div>
    );
  },
});