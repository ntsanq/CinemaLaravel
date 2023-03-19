import React, {useState} from 'react';
import {createRoot} from "react-dom/client";
import {Admin, Resource} from "react-admin";
import restProvider from 'ra-data-simple-rest';
import {PostCreate, PostEdit, PostIcon, PostList} from "./Posts";

export default function Home() {

    return (
        <>
            <Admin dataProvider={restProvider('http://jsonplaceholder.typicode:8000')}>
                <Resource name="posts" list={PostList} edit={PostEdit} create={PostCreate} icon={PostIcon}/>
            </Admin>,
        </>
    )
}

if (document.getElementById('admin_dashboard')) {
    createRoot(document.getElementById('admin_dashboard')).render(<Home />);
}
