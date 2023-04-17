import React, {useState} from 'react';
import {createRoot} from "react-dom/client";
import {Admin, Resource} from "react-admin";
import jsonServerProvider from "ra-data-json-server";
import {FilmCreate, FilmEdit, FilmIcon, FilmList} from "./Films";
import {FilmCategoryCreate, FilmCategoryEdit, FilmCategoryIcon, FilmCategoryList} from "./FilmCategories";
import {RoomEdit, RoomIcon, RoomList} from "./Rooms";
import {FilmRuleIcon, FilmRuleList} from "./FilmRules";
import {ProductionIcon, ProductionList} from "./Productions";
import {LanguageIcon, LanguageList} from "./Languages";

export default function Home() {

    return (
        <>
            <Admin dataProvider={jsonServerProvider('http://localhost:8000/api/admin')}>

                <Resource options={{label: 'Films'}}
                          name="films"
                          list={FilmList}
                          edit={FilmEdit}
                          create={FilmCreate}
                          icon={FilmIcon}/>

                <Resource options={{label: 'Film Categories'}}
                          name="filmCategories"
                          list={FilmCategoryList}
                          edit={FilmCategoryEdit}
                          create={FilmCategoryCreate}
                          icon={FilmCategoryIcon}/>

                <Resource name="rooms"
                          list={RoomList}
                          edit={RoomEdit}
                          icon={RoomIcon}/>

                <Resource options={{label: 'Film Rules'}}
                          name="filmRules"
                          list={FilmRuleList}
                          icon={FilmRuleIcon}/>

                <Resource name="productions"
                          list={ProductionList}
                          icon={ProductionIcon}/>

                <Resource name="languages"
                          list={LanguageList}
                          icon={LanguageIcon}/>

            </Admin>,
        </>
    )
}

if (document.getElementById('admin_dashboard')) {
    createRoot(document.getElementById('admin_dashboard')).render(<Home/>);
}
