import React, {useState} from 'react';
import {createRoot} from "react-dom/client";
import {Admin, Resource} from "react-admin";
import jsonServerProvider from "ra-data-json-server";
import {FilmCreate, FilmEdit, FilmIcon, FilmList} from "./Films";
import {FilmCategoryCreate, FilmCategoryEdit, FilmCategoryIcon, FilmCategoryList} from "./FilmCategories";
import {RoomCreate, RoomEdit, RoomIcon, RoomList} from "./Rooms";
import {FilmRuleCreate, FilmRuleEdit, FilmRuleIcon, FilmRuleList} from "./FilmRules";
import {ProductionCreate, ProductionEdit, ProductionIcon, ProductionList} from "./Productions";
import {LanguageCreate, LanguageEdit, LanguageIcon, LanguageList} from "./Languages";
import {ScheduleCreate, ScheduleEdit, ScheduleIcon, ScheduleList} from "./Schedules";
import {TicketIcon, TicketList} from "./Tickets";

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
                          create={RoomCreate}
                          icon={RoomIcon}/>

                <Resource options={{label: 'Film Rules'}}
                          name="filmRules"
                          list={FilmRuleList}
                          edit={FilmRuleEdit}
                          create={FilmRuleCreate}
                          icon={FilmRuleIcon}/>

                <Resource name="productions"
                          list={ProductionList}
                          edit={ProductionEdit}
                          create={ProductionCreate}
                          icon={ProductionIcon}/>

                <Resource name="languages"
                          list={LanguageList}
                          edit={LanguageEdit}
                          create={LanguageCreate}
                          icon={LanguageIcon}/>

                <Resource name="schedules"
                          list={ScheduleList}
                          edit={ScheduleEdit}
                          create={ScheduleCreate}
                          icon={ScheduleIcon}/>

                <Resource name="tickets" options={{ label: 'Tickets' }} list={TicketList} icon={TicketIcon}/>
            </Admin>,
        </>
    )
}

if (document.getElementById('admin_dashboard')) {
    createRoot(document.getElementById('admin_dashboard')).render(<Home/>);
}
