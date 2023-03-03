import { registerBlockType } from '@wordpress/blocks';
import Edit from './edit';
import metadata from './../block.json';

registerBlockType(
    metadata,
    {
        edit: Edit,
        save: () => null,
        attributes: {
            text: {
                type: 'string'
            },
            content: {
                type: 'string',
                default: ''
            }
        }
    }
)