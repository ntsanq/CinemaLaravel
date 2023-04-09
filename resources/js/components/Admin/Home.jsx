import React, {useState} from 'react';
import {createRoot} from "react-dom/client";
import {Admin, Resource} from "react-admin";
import jsonServerProvider from "ra-data-json-server";
import {FilmCreate, FilmEdit, FilmIcon, FilmList} from "./Films";
import {FilmCategoryIcon, FilmCategoryList} from "./FilmCategories";

export default function Home() {

    return (
        <>
            <Admin dataProvider={jsonServerProvider('http://localhost:8000/api/admin')}>
                <Resource name="films" list={FilmList} edit={FilmEdit} create={FilmCreate} icon={FilmIcon}/>
                <Resource name="filmCategories" list={FilmCategoryList} icon={FilmCategoryIcon}/>
            </Admin>,
        </>
    )
}

if (document.getElementById('admin_dashboard')) {
    createRoot(document.getElementById('admin_dashboard')).render(<Home />);
}
