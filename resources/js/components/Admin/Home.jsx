import React, {useState} from 'react';
import {createRoot} from "react-dom/client";
import {Admin, Resource} from "react-admin";
import jsonServerProvider from "ra-data-json-server";
import {FilmCreate, FilmEdit, FilmIcon, FilmList} from "./Films";

export default function Home() {

    return (
        <>
            <Admin dataProvider={jsonServerProvider('http://localhost:8000/api')}>
                <Resource name="films" list={FilmList} edit={FilmEdit} create={FilmCreate} icon={FilmIcon}/>
            </Admin>,
        </>
    )
}

if (document.getElementById('admin_dashboard')) {
    createRoot(document.getElementById('admin_dashboard')).render(<Home />);
}
