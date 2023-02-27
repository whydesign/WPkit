import { useBlockProps } from '@wordpress/block-editor';
import { TextControl, TextareaControl, PanelBody } from '@wordpress/components';

export default function Edit({attributes, setAttributes}) {
    return(
        <div {...useBlockProps()}>
            <PanelBody>
                <TextControl label="Enter latitude" value={attributes.lat} onChange={value => setAttributes({lat: value})}/>
                <TextControl label="Enter longitute" value={attributes.lng} onChange={value => setAttributes({lng: value})}/>
                <TextareaControl label="Enter Marker Infos" onChange={value => setAttributes({content: value})} value={attributes.content}/>
            </PanelBody>
        </div>
    )
}
