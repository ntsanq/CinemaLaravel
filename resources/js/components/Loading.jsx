import React, {useEffect, useState} from 'react';
import {createRoot} from "react-dom/client";
export default function Loading() {

    return (
        <div className="spinner-container">
            <div className="loading-spinner">
            </div>
        </div>
    );
}

if (document.getElementById('loading')) {
    createRoot(document.getElementById('loading')).render(<Loading />);
}
