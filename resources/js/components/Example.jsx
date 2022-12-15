import React from 'react';
import { createRoot } from 'react-dom/client'

export default function Example(){
    return(
        <h1>How To Install React in Laravel 9 with Vite</h1>
    );
}

if(document.getElementById('example')){
    createRoot(document.getElementById('example')).render(<Example />)
}
