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
            },
            lat: {
                type: 'number',
                default: 51.3102
            },
            lng: {
                type: 'number',
                default: 12.3732
            },
            osmAttribution: {
                type: 'string',
                default: '&copy; <a href=\"http: //www.openstreetmap.org/copyright\">OpenStreetMap</a> &copy; <a href=\"https://carto.com/attribution\">CARTO</a>'
            },
            osmTheme: {
                type: 'string',
                default: 'https://tile.openstreetmap.org/{z}/{x}/{y}.png'
            }
        }
    }
)