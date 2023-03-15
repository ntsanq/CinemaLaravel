import React, {useEffect, useState} from 'react';
import {createRoot} from "react-dom/client";
import { Spin } from 'antd';
export default function Loading() {

    return (
        <Spin />
    );
}

if (document.getElementById('loading')) {
    createRoot(document.getElementById('loading')).render(<Loading />);
}
