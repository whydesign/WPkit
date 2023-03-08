import { useBlockProps, InnerBlocks, ColorPalette, InspectorControls, MediaUpload, MediaUploadCheck } from '@wordpress/block-editor';
import { TextControl, TextareaControl, PanelBody, PanelRow, Panel, RangeControl, Button, ResponsiveWrapper, Tip } from '@wordpress/components';
import { MapContainer, TileLayer, useMap, Marker, Popup, useMapEvents } from 'react-leaflet';
import React, { useRef, useState, useMemo } from 'react';
import { useSelect } from '@wordpress/data';
import '../assets/style.css';

export default function Edit(props) {

    const { attributes, setAttributes } = props;

    const markerBlocks = [
        'core/paragraph',
        'wp-gb/inner-blocks'
    ];

    const blockTemplate = [
        [ 'core/paragraph', {
            placeholder: 'Enter Marker content...'
        } ]
    ];

    const center = {
        lat: attributes.lat,
        lng: attributes.lng,
    };

    function MarkerPosition() {
        const [position, setPosition] = useState(center);
        const markerRef = useRef(null);
        const eventHandlers = useMemo(
            () => ({
                dragend() {
                    const marker = markerRef.current;
                    if (marker != null) {
                        setPosition(marker.getLatLng());
                        setAttributes({lat: marker.getLatLng().lat});
                        setAttributes({lng: marker.getLatLng().lng});
                    }
                },
            }),
            [],
        );
        const map = useMapEvents({
            zoomend: () => {
                console.log(map.getZoom());
                setAttributes({zoom: map.getZoom()});
            }
        });

        return (
            <Marker
                draggable={true}
                eventHandlers={eventHandlers}
                position={position}
                ref={markerRef}>
                <Popup minWidth={90}>
        <span>
          Marker is draggable
        </span>
                </Popup>
            </Marker>
        )
    }


    function MediaSize( {media} ) {
        const mediaMetas = useSelect(
            ( select ) => {
                return {
                    //imageSizes: select("core/editor").getEditorSettings().imageSizes,
                    image: select("core").getMedia(media),
                };
            }, []
        );

        console.log(mediaMetas);

        if (mediaMetas.image != undefined) {
            console.log(mediaMetas.image.media_details);
            const imageSize = mediaMetas.image.media_details;

            if (imageSize.width || imageSize.height > 80) {
                return (
                    <Tip>
                        Image to big. Max. 80x80 pixel.
                    </Tip>
                )
            }
            else {
                return (<Tip>ok</Tip>);
            }
        }
        else {
            return null;
        }
    }

    const onSelectMedia = (media) => {
        props.setAttributes({
            mediaId: media.id,
            mediaUrl: media.url,
            thumbnail: media.sizes.thumbnail
        });
    };

    const removeMedia = () => {
        props.setAttributes({
            mediaId: 0,
            mediaUrl: '',
            thumbnail: ''
        });
    };

    return(
        <div {...useBlockProps()}>
            <Panel header="Open Street Map">
                <PanelBody title="Map Position" initialOpen={ true }>
                    <PanelRow className={'map-wrapper'}>
                        <MapContainer center={[center.lat, center.lng]} zoom={attributes.zoom} scrollWheelZoom={false} height={'400'}>
                            <TileLayer attribution='&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors' url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"/>
                            <MarkerPosition />
                        </MapContainer>
                    </PanelRow>
                </PanelBody>

                <PanelBody title="Marker Content" initialOpen={ false }>
                        <InnerBlocks allowedBlocks={markerBlocks} template={blockTemplate}/>
                </PanelBody>
            </Panel>

            <InspectorControls key="setting">
                <Panel>
                    <PanelBody title="Map Dimensions" initialOpen={ true } onToggle={ (e) => console.log("toggled", e) }>
                        <div id="gutenpride-controls">
                            <fieldset>
                                <RangeControl label="Map Width in %" marks step={10} initialPosition={100} max={100} min={0} onChange={value => setAttributes({mapWidth: value})} value={attributes.mapWidth} />
                                <RangeControl label="Map Height in PX" marks step={100} initialPosition={400} max={1000} min={100} onChange={value => setAttributes({mapHeight: value})} value={attributes.mapHeight} />
                            </fieldset>
                        </div>
                    </PanelBody>
                    <PanelBody title="Marker Icon" initialOpen={ false } onToggle={ (e) => console.log("toggled", e) }>
                        <div id="gutenpride-controls">
                            <fieldset>
                                <MediaUploadCheck>
                                    <MediaUpload
                                        onSelect={onSelectMedia}
                                        value={attributes.mediaId}
                                        allowedTypes={ ['image'] }
                                        render={({open}) => (
                                            <Button
                                                className={attributes.mediaId == 0 ? 'editor-post-featured-image__toggle' : 'editor-post-featured-image__preview'}
                                                onClick={open}
                                            >
                                                {attributes.mediaId == 0 && 'Choose an image' }
                                                {attributes.mediaId != 0 &&
                                                <img src={attributes.mediaUrl} />
                                                }
                                            </Button>
                                        )}
                                    />
                                </MediaUploadCheck>

                                {attributes.mediaId != 0 &&
                                <MediaUploadCheck>
                                    <MediaUpload
                                        title="Replace image"
                                        value={attributes.mediaId}
                                        onSelect={onSelectMedia}
                                        allowedTypes={['image']}
                                        render={({open}) => (
                                            <Button onClick={open} isDefault isLarge>Replace image</Button>
                                        )}
                                    />
                                </MediaUploadCheck>
                                }

                                {attributes.mediaId != 0 &&
                                <MediaUploadCheck>
                                    <Button onClick={removeMedia} isLink isDestructive>Remove image</Button>
                                </MediaUploadCheck>
                                }

                                {attributes.mediaId != 0 &&
                                <MediaUploadCheck>
                                    <MediaSize media={attributes.mediaId}/>
                                </MediaUploadCheck>
                                }
                            </fieldset>
                        </div>
                    </PanelBody>
                </Panel>
            </InspectorControls>
        </div>
    )
}

/*
{attributes.mediaId == 0 && 'Choose an image' }
                                                {attributes.thumbnail != '' &&
                                                <img src={attributes.thumbnail.url} />
                                                }


                                                {attributes.mediaId != 0 &&
                                <MediaUploadCheck>
                                    <MediaSize media={attributes.mediaId}/>
                                </MediaUploadCheck>
                                }
 */