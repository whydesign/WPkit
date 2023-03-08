import { registerBlockType } from '@wordpress/blocks';
import { useInnerBlocksProps, InnerBlocks } from '@wordpress/block-editor';
import Edit from './edit';
import metadata from './../block.json';

registerBlockType(
    metadata,
    {
        edit: Edit,
        save: () => <InnerBlocks.Content />,
        attributes: {
            mapWidth: {
                type: 'integer',
                default: '100'
            },
            mapHeight: {
                type: 'integer',
                default: '400'
            },
            lat: {
                type: 'integer',
                default: '51.3102'
            },
            lng: {
                type: 'integer',
                default: '12.3730'
            },
            zoom: {
                type: 'integer',
                default: '11'
            },
            mediaId: {
                type: 'number',
                default: 0
            },
            mediaUrl: {
                type: 'string',
                default: ''
            },
            thumbnail: {
                type: 'object',
                default: ''
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