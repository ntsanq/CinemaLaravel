import React from 'react';
import {useRecordContext} from 'react-admin';

const IFrameField = ({source}) => {
    const record = useRecordContext();
    const iframeSrc = record[source];

    return (
        <div style={{height: '100px', width: "100px", margin: "0px 20px"}}>
            <iframe src={iframeSrc} width="100%" height="100%"/>
        </div>
    );
};

export default IFrameField;
